<?php
include_once("ill_subm_functions.php");
$error_class_name = "";

$required_fields = array();
$i = 0;
foreach ($run_info_form_fields as $field_name => $requirement)
{
  if ($requirement == "required")
  {
    $required_fields[$i] = $field_name;
    $i += 1;
  }
}

$run_info_results      = populate_post_vars($_POST);
$selected_rundate 	   = $_POST["rundate"];
$selected_dna_region_0 = $_POST["dna_region_0"];
$selected_overlap 	   = $_POST["overlap"];
$selected_seq_operator = $_POST["seq_operator"];
$selected_insert_size  = $_POST["insert_size"];
$selected_read_length  = $_POST["read_length"];

if ($selected_dna_region_0 == "v6")
{
  $machine_name = "hs";
}
elseif ($selected_dna_region_0 == "v4v5") 
{
  $machine_name = "ms";
}

if (!isset($_POST["path_to_raw_data"]) or $_POST["path_to_raw_data"] == "")
{
  $selected_path_to_raw_data =  $selected_rundate . $machine_name . "/";
}
else
{
  $selected_path_to_raw_data  = $_POST["path_to_raw_data"];
}
print_out($selected_path_to_raw_data);

$run_info_errors         = check_required_fields($_POST, $required_fields);

if ($run_info_results["overlap"] == "")
{
  $run_info_errors["overlap"] = "Are you sure there is no overlap?";
}
// if( !valid_run_info_part1( $run_info_results["run_info_name1"] ) ) {
//   $run_info_errors["run_info_name1"] = "The first part of a run_info name could have only letters and no more then 4 of them.";
// }

// if( !valid_run_info_part2( $run_info_results["run_info_name2"] ) ) {
//   $run_info_errors["run_info_name2"] = "The second part of a run_info name could have only letters and numbers and no more then 6 of them";
// }

// if( !valid_env_source_name( $selected_env_source_name ) ) {
//   $run_info_errors["env_source_name"] = "Please choose a valid env_source_name";
// }

// // were there any errors?
// if(count($errors) == 0)
// {
// //   put data into the db and clean the table
//   include_once "insert_run_info.php";
//   success_message("run_info");
// //   include_once "success_message.php";
//   //   clean_the_table();
// //   foreach ($required_fields as $field_name)
// //   {
// //     $run_info_results[$field_name] = "";
// //   }
//   $errors = array();
  
  

// }
?>

