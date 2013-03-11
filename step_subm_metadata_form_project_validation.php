<?php
include_once("ill_subm_functions.php");

// define variables and initialize with empty values
$error_class_name = "";

// Specify the field names that you want to require...
// $project_form_fields = array(
//     "project_name1" => "required", "project_name2" => "required", "domain" => "select",
//     "dna_region" => "select", "project_title" => "optional", "project_description" => "optional",
//     "funding" => "optional", "project_form_contact" => "select"
// );
$required_fields = array();
$i = 0;
foreach ($project_form_fields as $field_name => $requirement)
{
  if ($requirement == 'required')
  {
    $required_fields[$i] = $field_name;
    $i += 1;
  }
}

$project_results        = populate_post_vars($_POST);
$selected_env_source_name = $_POST['project_form_env_source'];
$selected_contact_full  = $_POST['project_form_contact'];
$selected_domain        = $_POST['domain'];
$selected_dna_region    = $_POST['dna_region'];


$project_errors         = check_required_fields($_POST, $required_fields);

if( !valid_project_part1( $project_results["project_name1"] ) ) {
  $project_errors["project_name1"] = "The first part of a project name could have only letters and no more then 4 of them.";
}

if( !valid_project_part2( $project_results["project_name2"] ) ) {
  $project_errors["project_name2"] = "The second part of a project name could have only letters and numbers and no more then 6 of them";
}

print_out(valid_env_source_name($selected_env_source_name));
  print "---$selected_env_source_name---";
if (valid_env_source_name($selected_env_source_name))
{
  print "URRRA";
}
else 
{
  print "UVY!";
}

// were there any errors?
if(count($errors) == 0)
{
//   put data into the db and clean the table
  include_once 'insert_project.php';
  success_message('Project');
//   include_once 'success_message.php';
  //   clean_the_table();
//   foreach ($required_fields as $field_name)
//   {
//     $project_results[$field_name] = "";
//   }
  $errors = array();
  
  
//   print "data_project = $data_project</br>
//          first_name = $first_name</br>
//          last_name  = $last_name</br>
//          email = $email</br>
//          institution = $institution</br>";
}


