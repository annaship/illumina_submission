<?php
include_once "ill_subm_filled_variables.php";
include_once("ill_subm_functions.php");
$metadata_errors     = array();
$metadata_errors_all = array();
$result_metadata_arr_checked = $selected_metadata_arr = array();
$result_metadata_arr = separate_metadata($_POST, $arr_fields_headers);
// TODO: create "clean" array, only with real data arrays; if only 1 line - use it instead

// remove array #0 == check_submission
$result_metadata_arr_0 = array_shift($result_metadata_arr);

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
//   print_out($result_metadata_arr1);
  $metadata_errors = check_required_fields($result_metadata_arr1, $required_fields);
  $field_name = "lane";
  if( isset($result_metadata_arr1[$field_name]) && !valid_is_number($result_metadata_arr1[$field_name]))
  {
    $metadata_errors[$field_name] = "The " . $field_name . " should be numbers.";
  }
  $metadata_errors_all[] = $metadata_errors;
//   print_out("\$result_metadata_arr1[\$field_name] = " . $result_metadata_arr1[$field_name]);
//   print_out($metadata_errors);

  // 2) populate index and runkey by adapter  
  $selected_dna_region_base = $_POST["selected_dna_region_base"];
  
  $key_ind = get_run_key_by_adaptor($result_metadata_arr1, $adaptors_full, $selected_dna_region_base);
  $result_metadata_arr1["run_key"]       = $key_ind["illumina_run_key"];
  $result_metadata_arr1["barcode_index"] = $key_ind["illumina_index"];    
  $selected_metadata_arr[] = $result_metadata_arr1;
}
// 3) print out in table to show with errors in red and allow to change,
// TODO: show errors
if (!array_key_exists("domain", $selected_metadata_arr[0]))
{
//   todo: use $result_metadata_arr_0
;
}
  
  include_once "step_subm_metadata_form_metadata_table_selected.php";
?>

