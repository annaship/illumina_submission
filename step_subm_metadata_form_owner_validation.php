<?php
include_once("ill_subm_functions.php");

// define variables and initialize with empty values
$data_owner = $first_name = $last_name = $email = $institution = "";
$data_owner_err = $first_name_err = $last_name_err = $email_err = $institution_err = "";
$error_class_name = "";

// Specify the field names that you want to require...
$required_fields = array(
    'data_owner',
    'first_name',
    'last_name',
    'email',
    'institution',
);

$allowed_fields = $required_fields;

// Loop through the $_POST array, which comes from the form...
$owner_post_array = $_POST;
$owner_results    = populate_post_vars($owner_post_array, $required_fields);
$errors           = check_required_fields($owner_post_array, $required_fields);
print_r($errors);

// $errors = array();
// foreach($_POST AS $key => $value)
// {
//     // first need to make sure this is an allowed field
//     if(in_array($key, $allowed_fields))
//     {
//         $$key = $value;

//         // is this a required field?
//         if(in_array($key, $required_fields) && $value == '')
//         {
//             $errors[$key] = "The field $key is required.";
//         }
//     }  
// }
// were there any errors?
if(count($errors) > 0)
{
//   foreach ($errors as $key => $value)
//   {
//     $error_class_name = $key . "_error";
//   }
//     $errorString = '<p>There was an error processing the form.</p>';
//     $errorString .= '<ul>';
//     foreach($errors as $error)
//     {
//         $errorString .= "<li>$error</li>";
//         print "<br/>$error<br/>";
//     }
//     $errorString .= '</ul>';
//     $emailclass = "errortext";
//     print "<br/>\$data_owner = $data_owner<br/>";
    // display the previous form
//     include("step_subm_metadata.php");
    // include 'index.php';
}
else
{
//   put data into the db and clean the table
//   clean_the_table()
//   foreach ($required_fields as $field_name)
//   {
//     $$field_name = "";
//   }
//   $errors = array();
  
  
//   print "data_owner = $data_owner</br>
//          first_name = $first_name</br>
//          last_name  = $last_name</br>
//          email = $email</br>
//          institution = $institution</br>";
  
    // At this point you can send out an email or do whatever you want
    // with the data...

    // each allowed form field name is now a php variable that you can access

    // display the thank you page
    // header("Location: thanks.html");
}
print "<br/>errors<br/>";
print_r($errors);
print "<br/>\$owner_results[\"email\"]<br/>";
print $owner_results["email"];
print "<br/>\$errors[\"email\"]<br/>";
print $errors["email"];

if( validEmail( $owner_results["email"] ) ) {
//   print $email;
//   print "<br/>valid</br>";
  // print your success message here
} else {
  $errors["email"] = "Please provide a valid email address.";
//   print $email;
//   print "<br/>not valid</br>";
  // print your fail message here
}
