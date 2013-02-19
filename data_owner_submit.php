<?php
include_once("ill_subm_functions.php");

// define variables and initialize with empty values
$data_owner = $first_name = $last_name = $email = $institution = "";
$data_owner_err = $first_name_err = $last_name_err = $email_err = $institution_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
              $errors[] = "The field $key is required.";
          }
          print "$key = $value</br>";
      }  
  }

  // were there any errors?
  if(count($errors) > 0)
  {
      $errorString = '<p>There was an error processing the form.</p>';
      $errorString .= '<ul>';
      foreach($errors as $error)
      {
          $errorString .= "<li>$error</li>";
          print "<br/>$error<br/>";
      }
      $errorString .= '</ul>';

      // display the previous form
      include("step_subm_metadata.php");
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

  

}
// the HTML code starts here