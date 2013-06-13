<?php
include_once("ill_subm_functions.php");

// define variables and initialize with empty values
// $data_owner = $first_name = $last_name = $email = $institution = "";
// $data_owner_err = $first_name_err = $last_name_err = $email_err = $institution_err = "";
$error_class_name = "";

// Specify the field names that you want to require...
$required_fields = array(
    "data_owner",
    "first_name",
    "last_name",
    "email",
    "institution",
);

$allowed_fields = $required_fields;

// Loop through the $_POST array, which comes from the form...
$owner_results    = populate_post_vars($_POST);
$errors           = check_required_fields($owner_post_array, $required_fields);
if( !validEmail( $owner_results["email"] ) ) {
  $errors["email"] = "Please provide a valid email address.";
}

// print "<br/><br/>step_subm_metadata_form_owner_validation.php: count(\$errors): ";
// print_r(count($errors));

// were there any errors?
if(count($errors) == 0)
{
//   put data into the db and clean the table
  include_once 'insert_owner.php';
  success_message('Data_owner');
//   include_once 'success_message.php';
  //   clean_the_table();
  foreach ($required_fields as $field_name)
  {
    $owner_results[$field_name] = "";
  }
  $errors = array();
  
  
//   print "data_owner = $data_owner</br>
//          first_name = $first_name</br>
//          last_name  = $last_name</br>
//          email = $email</br>
//          institution = $institution</br>";
}


