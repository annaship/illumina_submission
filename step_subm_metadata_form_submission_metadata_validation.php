<?php
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; subm_metadata_validation");

include_once("ill_subm_filled_variables.php");
include_once("ill_subm_functions.php");

// print_out($_SESSION["run_info"]["lanes"]);

$metadata_errors     = array();
$metadata_errors_all = array();
// print_blue_message("\$_POST");
// print_out($_POST);

// TODO: 1) validate all data in foreach $result_metadata_arr
// TODO: 2) populate index and runkey by adapter
// TODO: 3) print out in table to show with errors in red and allow to change, 
// TODO: 4) then validate again and submit to db 

$required_fields = array();
$i = 0;
$required_fields = create_require_arr($submission_metadata_form_fields);

array_push($required_fields, "funding", "project_description");

// 1) validate all data in foreach $result_metadata_arr
// print_blue_message("from metadata validation");
//   print_blue_message("FROM valid1");
//   print_out($result_metadata_arr);

foreach ($combined_metadata as $combined_metadata_row)
{
// 	print_blue_message("\$combined_metadata_row");
// 	print_out($combined_metadata_row);
	
  $metadata_errors = check_required_fields($combined_metadata_row, $required_fields);
  
  $field_name = "lane";
  if( isset($combined_metadata_row[$field_name]) && !valid_is_number($combined_metadata_row[$field_name]))
  {
    $metadata_errors[$field_name] = "The " . $field_name . " should be numbers.";
  }
  $metadata_errors_all[] = $metadata_errors;
  

  // 2) populate index and runkey by adapter

}
// check for errors
$all_errors_uniq       = flat_mult_array($metadata_errors_all);
$metadata_errors_count = sizeof($all_errors_uniq);

$submit_code_arr       = array_keys($_SESSION["vamps_submissions_arr"]);
$current_submit_code   = $submit_code_arr[0];

// submit_code table errors
$error_field_names = implode('", "', array_keys($all_errors_uniq));
if ($error_field_names != "")
{
	print_red_message("
	<br/>
	<br/>
	There is no data for: \"$error_field_names\". 
	Probably the metadata were not properly submitted via <a href=\"http://vamps.mbl.edu/utils/submissions/project_submit.php\" target=\"_blank\">Project Submission</a> on VAMPS. 
	<br/>
	The \"submit_code\" to check is $current_submit_code.
	<br/>
	<br/>
	");
}

// 3) print out in table to show with errors in red and allow to change,
include_once "step_subm_metadata_form_metadata_table_selected.php";

if($metadata_errors_count == 0)
{
// 	TODO: change env_id and data_owner 
//   print_blue_message("\$result_metadata_arr");
//   print_out($result_metadata_arr);
  //   put data into the db and clean the table
// 	print_blue_message("FROM valid10");
	
  include_once 'insert_metadata.php';
//   print_blue_message("FROM valid11");
//   print_out($result_metadata_arr);
  success_message('Metadata');
}

?>

