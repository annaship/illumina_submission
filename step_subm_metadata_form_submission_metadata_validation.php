<?php
include_once("ill_subm_filled_variables.php");
include_once("ill_subm_functions.php");

print_red_message("FROM subm_metadata_validation");

$metadata_errors     = array();
$metadata_errors_all = array();
$result_metadata_arr_checked = $selected_metadata_arr = array();
$result_metadata_arr = separate_metadata($_POST, $arr_fields_headers);
// print_out($_POST);

// remove array #0 == check_submission
if (sizeof($result_metadata_arr) > 1 && ($_POST[submission_metadata_process] == 1))
{
  $result_metadata_arr_0 = array_shift($result_metadata_arr);
}
  
// TODO: 1) validate all data in foreach $result_metadata_arr
// TODO: 2) populate index and runkey by adapter
// TODO: 3) print out in table to show with errors in red and allow to change, 
// TODO: 4) then validate again and submit to db 

$required_fields = array();
$i = 0;
$required_fields = create_require_arr($submission_metadata_form_fields);

// 1) validate all data in foreach $result_metadata_arr
foreach ($result_metadata_arr as $result_metadata_arr1)
{
  $metadata_errors = check_required_fields($result_metadata_arr1, $required_fields);
  $field_name = "lane";
  
  if( isset($result_metadata_arr1[$field_name]) && !valid_is_number($result_metadata_arr1[$field_name]))
  {
    $metadata_errors[$field_name] = "The " . $field_name . " should be numbers.";
  }
  $metadata_errors_all[] = $metadata_errors;
  

  // 2) populate index and runkey by adapter
  if (check_var($_SESSION["run_info"]["dna_region_0"]))
  {
    $selected_dna_region_base = strtolower($_SESSION["run_info"]["dna_region_0"]);      
  }
  
  $key_ind = get_run_key_by_adaptor($result_metadata_arr1, $adaptors_full, $selected_dna_region_base);


  $result_metadata_arr1["run_key"]       = $key_ind["illumina_run_key"];
  $result_metadata_arr1["barcode_index"] = $key_ind["illumina_index"];    
  $selected_metadata_arr[] = $result_metadata_arr1;
    
}
// check for errors
$metadata_errors_count = sizeof(flat_mult_array($metadata_errors_all));

if($metadata_errors_count == 0)
{
// 	print_red_message("from metadata validation");
// 	print_out($selected_metadata_arr);
// 	TODO: change env_id and data_owner 
  $result_metadata_arr = $selected_metadata_arr;

  //   put data into the db and clean the table
  include_once 'insert_metadata.php';
//   print_red_message("FROM valid1");
//   print_out($result_metadata_arr);
  success_message('Metadata');
}

// 3) print out in table to show with errors in red and allow to change, 
  include_once "step_subm_metadata_form_metadata_table_selected.php";
?>

