<?php 
function print_options($array_name, $selected_val)
{
  foreach ($array_name as $val)
  {
//       html = '<option value="'+value+'" selected="selected">'+text+'</option>';
//     <option value="volvo">Volvo</option>
    
    if ($selected_val == $val)
    {
      echo '<option value="'.$val.'" selected="selected">'.$val.'</option>';
    }
    else {
      echo '<option value="'.$val.'">'.$val.'</option>';
    }
  }
}

// ------- validation -------
// http://www.linuxjournal.com/article/9585?page=0,3
// Validate an email address.
// Provide email address (raw input)
// Returns true if the email address has the email 
// address format and the domain exists.

function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
   }
   return $isValid;
}
// -----
function valid_project_part1($project_name1)
{
  $isValid = true;
  $len_project_name1 = strlen($project_name1);
  if ($len_project_name1 < 1 || $len_project_name1 > 4)
  {
    $isValid = false;    
  }
  if (! ctype_alpha($project_name1)) 
  {
    $isValid = false;    
  }
  return $isValid;
}

function valid_project_part2($project_name2)
{
  $isValid = true;
  $len_project_name2 = strlen($project_name2);
  if ($len_project_name2 < 1 || $len_project_name2 > 6)
  {
    $isValid = false;
  }
  if (! ctype_alnum ($project_name2))
  {
    $isValid = false;
  }
  return $isValid;
}

// -----
function populate_post_vars($post_array)
{
  $result_post = array();
  // Loop through the $_POST array, which comes from the form...
  foreach($post_array AS $key => $value)
  {
      $$key = $value;  
      $result_post[$key] = htmlspecialchars($value);
  }
  return $result_post;
}

function check_required_fields($post_array, $required_fields)
{
  $errors = array();
  foreach($post_array AS $key => $value)
  {
    // is this a required field?
    if(in_array($key, $required_fields) && $value == '')
    {
      $errors[$key] = "The field $key is required.";
//       print "in function: $key => $value; $errors[$key]<br/>";
    }    
  }
//   print "<br/>errors from functions<br/>";
  
//   print_r($errors);
  return $errors;
}

function success_message($data_name)
{
  if ($data_name)
  {
    //   print "<br/>in functions<br/>$data_name<br/>";
    $success_message = "<div class = \"success_message\"> $data_name information was sucessfully uploaded to the db</div>";
//     print $success_message;    
  }
}

function check_var($variable)
{
	if (isset($project_results['project_name1']))
	{
		$project_name1 = $project_results['project_name1'];
	}
	else $project_name1 = "";	
}

function get_contact_id($contact_full)
{
  $post_res = $_POST[project_form_contact];
//   list($last_name, $first_name, $email, $institution) = explode(",", $post_res);
  list($last_name, $first_name, $email, $institution) = array_map('trim', explode(',', $post_res));
  
  $vamps_name = array_search($post_res, $contact_full);

  $query = "SELECT contact_id FROM contact WHERE email = \"" . $email. "\" AND
  institution = \"" . $institution. "\" AND
  vamps_name = \"" . $vamps_name. "\" AND
  first_name like \"" . $first_name. "%\" AND
  last_name = \"" . $last_name. "\"";

  require 'ill_subm_conn_local.php';
  
  $res = $local_mysqli->query($query);
  
  for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();
  }
  if (isset($row['contact_id'])) 
  {
    $contact_id = $row['contact_id'];
  }
  else
  {
    $contact_id = add_new_contact($post_res, $vamps_name);
  }
  return $contact_id;
}

function get_env_sample_source_id($env_source_name)
{
  require 'ill_subm_conn_local.php';
  
  $query = "SELECT env_sample_source_id FROM env_sample_source WHERE env_source_name = \"" . $env_source_name . "\"";
  $res = $local_mysqli->query($query);
  
  $row = $res->fetch_assoc();
//   print_r($row);
  return $row['env_sample_source_id']; 
}

function add_new_contact($post_res, $vamps_name) {
//   print_r($post_res);
  list($last_name, $first_name, $email, $institution) = array_map('trim', explode(',', $post_res)); 
  $contact = $first_name. " " . $last_name;
  $query = "INSERT INTO contact (contact, email, institution, vamps_name, first_name, last_name)
            VALUES (\"" . $contact. "\", \"" . $email. "\", \"" . $institution
              . "\", \"" . $vamps_name. "\", \"" . $first_name. "\", \"" . $last_name. "\")";
  print "<br/>";
  print "<br/>";
  print $query;
  print "<br/>";
  
  validate_new_contact();
}

function validate_new_contact() {
  ;
//   return $contact_id;
}
?>