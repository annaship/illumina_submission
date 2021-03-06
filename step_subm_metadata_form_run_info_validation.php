<?php
include_once("ill_subm_functions.php");

// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; upload_subm_metadata_form_run_info_validation");

$error_class_name = "";

$required_fields = $run_info_errors = array();
$i = 0;
$required_fields = create_require_arr($run_info_form_fields);

$run_info_results      = populate_post_vars($_POST);


$selected_rundate 	   = $_POST["rundate"];
$selected_dna_region_base = $_POST["dna_region_0"];
$selected_overlap 	   = $_POST["overlap"];
$selected_seq_operator = $_POST["seq_operator"];
$selected_insert_size  = $_POST["insert_size"];
$selected_read_length  = $_POST["read_length"];

if (!isset($_POST["path_to_raw_data"]) or $_POST["path_to_raw_data"] == "")
{
  $selected_path_to_raw_data = make_path_to_raw_data($selected_rundate, $selected_dna_region_base, $dna_regions_hiseq, $dna_regions_miseq);
}
else
{
  $selected_path_to_raw_data  = $_POST["path_to_raw_data"];
}

$run_info_errors         = check_required_fields($_POST, $required_fields);

if ($run_info_results["overlap"] == "")
{
  $run_info_errors["overlap"] = "Are you sure there is no overlap?";
}
if( !valid_seq_operator( $run_info_results["seq_operator"] ) ) {
  $run_info_errors["seq_operator"] = "The seq_operator could have only letters and numbers and no more then 4 of them.";
}

$field_check = array("insert_size", "read_length");

foreach ($field_check as $field_name)
{
  if( !valid_is_number( $run_info_results[$field_name] ) ) 
  {
    $run_info_errors[$field_name] = "The " . $field_name . " should be numbers.";
  }
}

$run_info_errors_count = sizeof($run_info_errors);
if ($run_info_errors_count == 0)
{
	include_once "insert_run_info.php";
    success_message("run_info");
//     clean_the_table();
}
else 
{
  $_SESSION["run_info_errors"] = $run_info_errors;
}

?>

