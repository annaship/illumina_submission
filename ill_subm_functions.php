<?php 
function print_options($array_name, $selected_val)
{
  foreach ($array_name as $val)
  {
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
  $required_fields = array();
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

function get_one_value($query, $db_name, $connection)
{
  $row = array();
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
  return $row;
}

function get_contact_id($contact_full, $connection)
{
  $contact_id = 0;
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
//     $db_name = "env454";
    $db_name = "test";    
  }
    
  $query = "SELECT contact_id FROM " . $db_name . ".contact WHERE email = \"" . $email. "\" AND
  institution = \"" . $institution. "\" AND
  vamps_name = \"" . $vamps_name. "\" AND
  first_name like \"" . $first_name. "%\" AND
  last_name = \"" . $last_name. "\"";

  $row = get_one_value($query, $db_name, $connection);

  if (isset($row[key($row)]))
  {
    $contact_id = $row[key($row)];
  }
  else
  {
    $contact_id = add_new_contact($post_res, $vamps_name, $connection, $db_name);
  }
  return $contact_id;
}

function get_env_sample_source_id($env_source_name, $env_source_names)
{
  $env_source_name_id = 0;
  $env_source_name_id = array_search($env_source_name, $env_source_names);
  return $env_source_name_id;
}

function add_new_contact($post_res, $vamps_name, $connection, $db_name) {
  $new_contact_id = 0;
  $contact_info   = array_map('trim', explode(',', $post_res));
  list($last_name, $first_name, $email, $institution) =  $contact_info;
  $contact = $first_name. " " . $last_name;
//   print_out($contact);
  $query = "INSERT IGNORE INTO " . $db_name . ".contact (contact, email, institution, vamps_name, first_name, last_name)
            VALUES (\"" . $contact. "\", \"" . $email. "\", \"" . $institution
              . "\", \"" . $vamps_name. "\", \"" . $first_name. "\", \"" . $last_name. "\")";
//   print_out($query);
  
  if(validate_new_contact($contact_info, $vamps_name) == 0)
  {
    $new_contact_id = run_query($query, "contact");    
  }
  return $new_contact_id;
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
  $my_arr = array();
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
  $result_arr = array();
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

function get_all_projects($connection, $db_name)
{
  $project = "";
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
  $return_array = array(); 
  
// TODO: return selected run_key, barcode_index 
  $selected_adaptor    = strtolower($selected_arr["adaptor"]);
  $selected_dna_region = strtolower($selected_dna_region_base);
  $selected_domain     = strtolower($selected_arr["domain"]);
//     print_out($adaptors_full);
  foreach ($adaptors_full as $adaptors_arr)
  {
    if (($selected_adaptor    == strtolower($adaptors_arr["illumina_adaptor"]))
     && ($selected_dna_region == strtolower($adaptors_arr["dna_region"]))
     && ($selected_domain     == strtolower($adaptors_arr["domain"]))) 
    {
      $return_array["illumina_run_key"] = $adaptors_arr["illumina_run_key"];
      $return_array["illumina_index"]   = $adaptors_arr[illumina_index];    
    }
  }
  return $return_array;
}

function separate_metadata($metadata, $arr_fields_headers)
{
  $result_metadata_arr = array();
  foreach ($metadata as $key => $value)
  {
    $number_index = strrpos($key, "_");
    $lane_num     = substr($key, $number_index + 1); 
    $field_name   = substr($key, 0, $number_index);
    if (isset($field_name, $arr_fields_headers) && ctype_digit($lane_num))
    {
      $result_metadata_arr[$lane_num][$field_name] = $value;
    }    
  }
  return $result_metadata_arr;
}

function flat_mult_array($array_to_flat)
{
  $flat_array = array();
  foreach(new RecursiveIteratorIterator(new RecursiveArrayIterator($array_to_flat)) as $k=>$v)
  {
    $flat_array[$k] = $v;
  }
  return $flat_array;
}

function print_insert_message_by_id($field_name, $data_id)
{
  if ($data_id > 0)
  {
    printf ("<div class = \"message\">New $field_name has id %d.</div>", $data_id);    
  } 
}

function print_red_message($message)
{
  printf ("<div class = \"message\">$message</div>");
}

function run_query($query, $table_name)
{
  $success_insert = 0;
//   TODO: Why return project with run_id?
  $data_id = 0;
  if ($_SESSION['is_local'])
  {
    $res = $local_mysqli->query($query);
    $data_id = $local_mysqli->insert_id;
    print_insert_message_by_id($table_name, $data_id);
  }
  else
  {
    $success_insert = mysql_query($query);
    if ($success_insert)
    {
      $data_id = mysql_insert_id();
      print_insert_message_by_id($table_name, $data_id);
    }
  }
  return $data_id;
}

function add_new_data ($data_array, $table_name, $db_name, $connection) 
{
  $data_id = 0;
  foreach ( $data_array as $key => $value ) {
    $$key = $value;
  }
  
  if ($table_name == "dataset")
  {
    $query = "INSERT IGNORE INTO " . $db_name . "." . $table_name .
    " ($table_name, dataset_description) VALUES (\"". $$table_name . "\", \"$dataset_description\")";
  }
  elseif ($table_name == "run_key")
  {
    $query = "INSERT IGNORE INTO " . $db_name . "." . $table_name .
    " ($table_name, dataset_description) VALUES (\"NNNN". $$table_name . "\")";
  }  
  elseif ($table_name == "run")
  {
    $query = "INSERT IGNORE INTO " . $db_name . "." . $table_name .
    "($table_name, run_prefix, date_trimmed) VALUES (\"". $data_array["rundate"] . "\", \"illumin\", \"0000-00-00\")";
  } 
  elseif ($table_name == "project" || $table_name == "dna_region")
  {
    break;
  } 
  else
  {
    $query = "INSERT IGNORE INTO " . $db_name . "." . $table_name . 
              "($table_name) VALUES (\"". $$table_name . "\")";    
  }
  $data_id = run_query($query, $table_name);
  return $data_id;
}

function get_id($data_array, $table_name, $db_name, $connection) 
{
  $res_id = 0;
  if ($table_name == "run_key")
  {
    $query = "SELECT " . $table_name . "_id from " . $db_name . "." . $table_name . " where " . $table_name . " = \"NNNN" . $data_array[$table_name] . "\"";    
  }
  elseif ($table_name == "run")
  {
    $query = "SELECT " . $table_name . "_id from " . $db_name . "." . $table_name . " where " . $table_name . " = \"" . $data_array["rundate"] . "\"";
  }
  elseif ($table_name == "dna_region_0")
  {
    $table_name = "dna_region";
    $query = "SELECT " . $table_name . "_id from " . $db_name . "." . $table_name . " where " . $table_name . " = \"" . $data_array["dna_region_0"] . "\"";
  }
  else
  {    
    $query = "SELECT " . $table_name . "_id from " . $db_name . "." . $table_name . " where " . $table_name . " = \"" . $data_array[$table_name] . "\"";
  }
 
  $row = get_one_value($query, $db_name, $connection);
  
  if (isset($row[key($row)]))
  {
    $res_id = $row[key($row)];
  }
  // if it is new data - insert
  else
  {
    $res_id = add_new_data($data_array, $table_name, $db_name, $connection);
  }
  return $res_id;
}

function get_primer_suite_id($dna_region, $domain, $db_name, $connection) {
  $res_id = 0;
  $table_name = "primer_suite";
  if ($dna_region == "v4v5")
  {
    $dna_region = "V4-V5";
  }
  $primer_domain = $domain . "l";
  $suite_name    = $primer_domain . " " . $dna_region . " Suite";
  $query         = "SELECT " . $table_name . "_id from " . $db_name . "." . $table_name . " where " . $table_name . " = \"" . $suite_name . "\"";
  $row = get_one_value($query, $db_name, $connection);
  if (isset($row[key($row)]))
  {
    $res_id = $row[key($row)];
  }
  else 
  {
    print_red_message("Something is wrong with the Primer Suite name: \"$suite_name\"");
  }
  return $res_id;
}

function get_submission_info($connection, $db_name)
{
  $vamps_submission_info = array();
  
//   $query = "SELECT DISTINCT * FROM " . $db_name . ".vamps_submissions JOIN " . $db_name . ".vamps_submissions_tubes USING(submit_code);";
  $query = "SELECT DISTINCT * FROM " . $db_name . ".vamps_submissions ORDER BY id DESC limit 3";
//   print_out($query);
  if ($_SESSION['is_local'])
  {
//     $local_mysqli = $connection;
//     $results = $local_mysqli->query($query);
//     for ($row_no = $results->num_rows - 1; $row_no >= 0; $row_no--) {
//       $results->data_seek($row_no);
//       $row = $results->fetch_assoc();
//       $result_arr[] = $row[key($row)];
//     }
;
  }
  else
  {
    $results = mysql_query($query, $connection) or die("SELECT Error: $results: ".mysql_error());
    $subm_field_names = get_field_names($results);
    while($row = mysql_fetch_row($results))
    {      
      $vamps_submission_info[] = $row;
    }
  }
  return array($subm_field_names, $vamps_submission_info);  
}

function get_field_names($results) {
  $i = 0;
  $field_names = array();
  while ($i < mysql_num_fields($results))
  {
    $meta = mysql_fetch_field($results, $i);
    $field_names[] = $meta->name;
    $i += 1;
  }
  return $field_names;
}

function get_machine_name($selected_dna_region_base)
{ 
  if ($selected_dna_region_base == "v6")
  {
    $machine_name = "hs";
  }
  elseif ($selected_dna_region_base == "v4v5")
  {
    $machine_name = "ms";
  }
  return $machine_name;
}

function get_data_from_csv($file_name)
{
  $num = $row = 0;
  $csv_arr_result = array();
  $handle = fopen($file_name, "r");
  if( $handle ) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//       $num = count($data);

      $csv_arr_result[$row] = $data;
      $row++;
    }
    fclose($handle);
  }
  return $csv_arr_result;
}

?>
