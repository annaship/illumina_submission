<?php
include_once("ill_subm_functions.php");
// print "HERE in step_subm_metadata_form_owner_validation";
 
// $pattern = "/.*@.*\..*/";
// $email   = $_POST["email"];
// $urlname = urlencode($$_POST["data_owner"]);

// if (preg_match($pattern, $_POST["email"]) > 0) {
//   // Here's where you would store
//   // the data in a database...
//   header(
//           "location: thankyou.php?&username=$urlname");
// }
// $message    = "Please enter a valid email address.";
// $username   = $_POST["data_owner"];
// $emailclass = "errortext";

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
$errors = array();
foreach($_POST AS $key => $value)
{
    // first need to make sure this is an allowed field
    if(in_array($key, $allowed_fields))
    {
        $$key = $value;

        // is this a required field?
        if(in_array($key, $required_fields) && $value == '')
        {
            $errors[$key] = "The field $key is required.";
        }
    }  
}
// were there any errors?
if(count($errors) > 0)
{
  foreach ($errors as $key => $value)
  {
    $error_class_name = $key . "_error";
  }
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
  print "data_owner = $data_owner</br>
         first_name = $first_name</br>
         last_name  = $last_name</br>
         email = $email</br>
         institution = $institution</br>";
  
    // At this point you can send out an email or do whatever you want
    // with the data...

    // each allowed form field name is now a php variable that you can access

    // display the thank you page
    // header("Location: thanks.html");
}

if( validEmail( $email ) ) {
  print $email;
  print "<br/>valid</br>";
  // print your success message here
} else {
  print $email;
  print "<br/>not valid</br>";
  // print your fail message here
}
