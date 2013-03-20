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
      $domain    = substr($email, $atIndex+1);
      $local     = substr($email, 0, $atIndex);
      $localLen  = strlen($local);
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
function valid_env_source_name($env_source_name)
{
  $isValid = true;
  $len_env_source_name = strlen($env_source_name);
  if ($len_env_source_name < 1 or $env_source_name == "env_source_name")
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

function create_require_arr($form_fields)
{
  foreach ($form_fields as $field_name => $requirement)
  {
    if ($requirement == "required")
    {
      $required_fields[$i] = $field_name;
      $i += 1;
    }
  }
  return $required_fields;
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
    }    
  }
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

function get_contact_id($contact_full, $connection)
{
  $post_res = $_POST['project_form_contact'];
  //   list($last_name, $first_name, $email, $institution) = explode(",", $post_res);
  list($last_name, $first_name, $email, $institution) = array_map('trim', explode(',', $post_res));
  
  $vamps_name = array_search($post_res, $contact_full);
  
  if ($_SESSION['is_local'])
  {
    $db_name = "test";
  }
  else
  {
    $db_name = "env454";
  }
    
  $query = "SELECT contact_id FROM " . $db_name . ".contact WHERE email = \"" . $email. "\" AND
  institution = \"" . $institution. "\" AND
  vamps_name = \"" . $vamps_name. "\" AND
  first_name like \"" . $first_name. "%\" AND
  last_name = \"" . $last_name. "\"";

  if ($_SESSION['is_local'])
  {
    $res = $connection->query($query);
    
    for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
      $res->data_seek($row_no);
      $row = $res->fetch_assoc();
    }
  }
  else
  {
    $results = mysql_query($query, $connection) or die("SELECT Error: $results: ".mysql_error());
    $row     = mysql_fetch_assoc($results);    
  }
  if (isset($row[key($row)]))
  {
    $contact_id = $row[key($row)];
  }
  else
  {
    $contact_id = add_new_contact($post_res, $vamps_name, $connection);
  }
  return $contact_id;
}

function get_env_sample_source_id($env_source_name, $env_source_names)
{
  $env_source_name_id = array_search($env_source_name, $env_source_names);
  return $env_source_name_id;
}

function add_new_contact($post_res, $vamps_name, $connection) {
//   print_r($post_res);
  $contact_info = array_map('trim', explode(',', $post_res));
  list($last_name, $first_name, $email, $institution) =  $contact_info;
  $contact = $first_name. " " . $last_name;
//   print_out($contact);
  $query = "INSERT INTO contact (contact, email, institution, vamps_name, first_name, last_name)
            VALUES (\"" . $contact. "\", \"" . $email. "\", \"" . $institution
              . "\", \"" . $vamps_name. "\", \"" . $first_name. "\", \"" . $last_name. "\")";
//   print_out($query);
  
  if(validate_new_contact($contact_info, $vamps_name) == 0)
  {
    if ($_SESSION['is_local'])
    {
      $res = $local_mysqli->query($query);
      $contact_id = $local_mysqli->insert_id;
      printf ("New Contact record has id %d.\n", $local_mysqli->insert_id);      
    }
    else 
    {     
      mysql_query($query);
      $contact_id = mysql_insert_id();
      printf("Last inserted record has id %d\n", $contact_id);
    }
    
  }
  return $contact_id;
}

function validate_new_contact($contact_info, $vamps_name) {
  $contact_valid_err = 0;
  $field_names = array("contact", "email", "institution", "vamps_name", "first_name", "last_name");
  $contact_info[] = $vamps_name;
//   print_r($contact_info);
  foreach ($contact_info as $i => $value)
  {
    if (!$value)
    {
      print "</br>";
      $n = $i - 1;
      print "<br>Please provide all contact info; <strong>$field_names[$n]</strong> cannot be empty!<br/>";
      $contact_valid_err = 1;
    }
  }
  if( !validEmail( $contact_info[2] ) ) {
    print "<br/>---<br/>Please provide a valid email address instead of \"<strong>" . $contact_info[2] . "</strong>\".";
    $contact_valid_err = 1;
  }
  
  if ($contact_valid_err)
  {
  //   TODO: link to form to submit contact
    ;
  }
  return $contact_valid_err;
}

function check_var($variable)
{
	if (!isset($variable) OR empty($variable))
	{
		return 0;
	}
	else
	{
		return 1;
	}
}

function init_arr($arr_name, $key_names) {
	foreach ($key_names as $field_name) {
		if (!isset($arr_name[$field_name]))
		{
			$arr_name[$field_name]  = "";
		}
	}
	return $arr_name;
}

function init_project_var($arr_to_initialize) {
	foreach ($arr_to_initialize as $field_name) {
		if (!isset($project_errors[$field_name]))
		{
			$project_errors[$field_name]  = "";
		}
	}
	foreach ($arr_to_initialize as $field_name) {
		if (!isset($project_results[$field_name]))
		{
			$project_results[$field_name]  = "";
		}
	}
	$my_arr = array($project_errors, $project_results);
	return $my_arr;
}

function print_out($array_name)
{
	print "<br/>UUU -";
	print_r($array_name);
	print " --<br/>";
}

function run_select_one_field($query, $connection) {

  if ($_SESSION['is_local'])
  {
    $local_mysqli = $connection;
    $results = $local_mysqli->query($query);
    for ($row_no = $results->num_rows - 1; $row_no >= 0; $row_no--) {
      $results->data_seek($row_no);
      $row = $results->fetch_assoc();
      $result_arr[] = $row[key($row)];
    }
  }
  else
  {
    $results = mysql_query($query, $connection) or die("SELECT Error: $results: ".mysql_error());
    while($row = mysql_fetch_row($results))
    {
      $result_arr[] = $row[0];
    }
  }
  asort($result_arr);
  return $result_arr;
}

function get_all_projects($connection)
{
  if (!$_SESSION['is_local'])
  {
    $db_name = "env454";
  }
  else
  {
    $db_name = "test";
  }

  $query = "SELECT DISTINCT project FROM " . $db_name . ".project WHERE project <> ''";
  $project = run_select_one_field($query, $connection);
  return $project;

}

function valid_seq_operator($seq_operator)
{
  $isValid = true;
  $len_seq_operator = strlen($seq_operator);
  if ($len_seq_operator < 1 || $len_seq_operator > 4)
  {
    $isValid = false;
  }
  if (! ctype_alnum ($seq_operator))
  {
    $isValid = false;
  }
  return $isValid;
}

function valid_dataset($dataset)
{
  $isValid = true;
  $len_dataset = strlen($dataset);
  if ($len_dataset < 3 || $len_dataset > 40)
  {
    $isValid = false;
  }
//   allow alnum and underscore
  $aValid = array("_"); 
  if(!ctype_alnum(str_replace($aValid, '', $dataset))) {
    $isValid = false;
  }
  return $isValid;
}

// insert_size, read_length
function valid_is_number($field_name)
{
//   print_out($field_name);
  $isValid = true;
  if (! ctype_digit ($field_name))
  {
    $isValid = false;
  }
  return $isValid;
}

function get_run_key_by_adaptor($selected_arr, $adaptors_full, $selected_dna_region_base)
{
//   print_out($selected_arr);
  print_out("\$selected_adaptor = " . $selected_arr["adaptor"]);
  print_out("\$selected_dna_region_base = " . $selected_dna_region_base);
  print_out("\$selected_domain = " . $selected_arr["domain"]);
  
// TODO: send $selected_adaptor, $selected_dna_region, $selected_domain from metadata validation
// TODO: return selected run_key, barcode_index 
//   $selected_adaptor    = "A05";
//   $selected_dna_region = "v6";
//   $selected_domain     = "archaea";
  foreach ($adaptors_full as $value_arr)
  {
    if (in_array($selected_adaptor, $value_arr) AND in_array($selected_dna_region, $value_arr) AND in_array($selected_domain, $value_arr)) {
//       print_out($value_arr);
//       print_out($value_arr[illumina_run_key]);
//       print_out($value_arr[illumina_index]);      
    }
  }
}

function separate_metadata($metadata, $arr_fields_headers)
{
  $result_metadata_arr = array();
  foreach ($metadata as $key => $value)
  {
    $number_index = strrpos($key, "_");
    $lane_num     = substr($key, $number_index + 1);    
    $field_name   = substr($key, 0, $number_index);
    if (isset($field_name, $arr_fields_headers))
    {
      $result_metadata_arr[$lane_num][$field_name] = $value;
    }    
  }
  return $result_metadata_arr;
}
?>