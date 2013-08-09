<?php 
function print_options($array_name, $selected_val)
{
  foreach ($array_name as $val)
  {
  	if ($selected_val == $val)
    {
      echo '<option value="'.$val.'" selected="selected">'.$val.'</option>';
    }
    else 
    {
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

function separate_post_vars($post_array)
{
	$result_post = array();
	// Loop through the $_POST array, which comes from the form...
	foreach($post_array AS $key => $value)
	{
// 		print_blue_out_message('$key', $key);
// 		print_blue_out_message('$value', $value);
		
		$subject = $key;
		$pattern = '/(.+)_(\d+)/';
		preg_match($pattern, $subject, $matches);
// 		print_blue_out_message('$key', $key);
// 		print_blue_out_message('$matches[2]', $matches[2]);
		
// 		$$key = $value;
		if (isset($matches[2])) {
			$result_post[$matches[2]][$matches[1]] = htmlspecialchars($value);
		}
	}
	return $result_post;
}

function create_require_arr($form_fields)
{
  $i = 0;
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
//   set_error_handler("customError", E_USER_ERROR);
  $row = array();
  if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
  {
    $res = $connection->query($query); //or die("Query failed. The last error: (" . $connection->errno . ") " . $connection->error);
  	if (isset($res) && isset($res->num_rows))
  	{
	    for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) 
	    {
	      $res->data_seek($row_no);
	      $row = $res->fetch_assoc();
	    }
    }
  }
  else
  {
  	$results = mysql_query($query, $connection);
  	 
//     $results = mysql_query($query, $connection) or trigger_error($query . ": ", E_USER_ERROR);
    $row     = mysql_fetch_assoc($results);
  }
//   	error_reporting(E_ERROR | E_WARNING | E_PARSE);
    return $row;
}

function get_contact_id($contact_full, $connection)
{
  $contact_id = 0;
  $post_res = $_POST['project_form_contact'];
  //   list($last_name, $first_name, $email, $institution) = explode(",", $post_res);
  list($last_name, $first_name, $email, $institution) = array_map('trim', explode(',', $post_res));

  
  if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
  {
    $db_name = "test";
  }
  else
  {
    $db_name = "env454";
//     $db_name = "test";    
  }
  $vamps_name = array_search($post_res, $contact_full);
 
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
  $query = "INSERT IGNORE INTO " . $db_name . ".contact (contact, email, institution, vamps_name, first_name, last_name)
            VALUES (\"" . $contact. "\", \"" . $email. "\", \"" . $institution
              . "\", \"" . $vamps_name. "\", \"" . $first_name. "\", \"" . $last_name. "\")";
//   print_out($query);
  
  if(validate_new_contact($contact_info, $vamps_name) == 0)
  {
    $new_contact_id = run_query($query, "contact", $connection);    
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
// 	if (isset($variable) && !empty($variable))
// 	{
// 		return 1;
// 	}
// 	else
// 	{
// 		return 0;
// 	}
	if (!isset($variable) || empty($variable))
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
  if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
  {
    $local_mysqli = $connection;
    $results = $local_mysqli->query($query);
    if (isset($results) && isset($results->num_rows))
    {
	    for ($row_no = $results->num_rows - 1; $row_no >= 0; $row_no--) 
	    {
	      $results->data_seek($row_no);
	      $row = $results->fetch_assoc();
	      $result_arr[] = $row[key($row)];
	    }
    }
  }
  else
  {
    $results = mysql_query($query, $connection) or die("SELECT Error: $query. $results: ".mysql_error());
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
  $isValid = true;
  if (! ctype_digit ($field_name))
  {
    $isValid = false;
  }
  return $isValid;
}

function get_run_key_by_adaptor($selected_adaptor, $selected_domain, $adaptors_full, $selected_dna_region_base)
{
  $return_array = array(); 

//   $selected_adaptor = A01
//   $selected_domain = Bacteria
//   $selected_dna_region_base = v6
  
  foreach ($adaptors_full as $adaptors_arr)
  {
    if ((strtolower($selected_adaptor)         == strtolower($adaptors_arr["illumina_adaptor"]))
     && (strtolower($selected_dna_region_base) == strtolower($adaptors_arr["dna_region"]))
     && (strtolower($selected_domain)          == strtolower($adaptors_arr["domain"]))) 
    {
      $return_array["illumina_run_key"] = $adaptors_arr["illumina_run_key"];
      $return_array["illumina_index"]   = $adaptors_arr["illumina_index"];    
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
  print("<div class = \"message\">$message</div>");
}

function print_green_message($message)
{
	print ("<div class = \"green_message\">$message</div>");
}

function print_blue_message($message)
{
	print ("<div class = \"blue_message\">$message</div>");
}

function print_blue_out_message($message, $array_name)
{
	echo "<br/>";
	print ("<div class = \"blue_message\">$message</div>");
	print "<br/>UUU -";
	print_r($array_name);
	print " --<br/>";
}


function run_query_and_get_all($query, $connection)
{
	$result_arr = array();
	if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
	{
		$local_mysqli = $connection;
		$results = $local_mysqli->query($query);
		if (isset($results->num_rows))
		{
			for ($row_no = $results->num_rows - 1; $row_no >= 0; $row_no--)
			{
			$results->data_seek($row_no);
			$row                     = $results->fetch_assoc();
			$subm_field_names        = array_keys($row);
			$vamps_submission_tubes_info[] = $row;
			}
		}
	}
	else
	{
		$results = mysql_query($query, $connection) or die("SELECT Error: $query. $results: ".mysql_error());
		$subm_field_names = get_field_names($results);
		while($row = mysql_fetch_row($results))
		{
			$vamps_submission_tubes_info[] = $row;
		}
	}
	return $vamps_submission_tubes_info;	
}


function run_query($query, $table_name, $connection)
{
  $success_insert = 0;
//   TODO: Why return project with run_id?
  $data_id = 0;
  if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
  {
//   	if (isset($local_mysqli))
//   	{
	    $res = $connection->query($query);
	    $data_id = $local_mysqli->insert_id;
	    print_insert_message_by_id($table_name, $data_id);
//   	}
  }
  else
  {
/*
 * set_error_handler("customError", E_USER_ERROR);
  	$results = mysql_query($query, $connection) or trigger_error($query . ": ", E_USER_ERROR);
  
 */
  	$success_insert = mysql_query($query, $connection) or die(mysql_error());
    if ($success_insert)
    {
      $data_id = mysql_insert_id();
      if ($data_id == 0)
      {
      	$query_get_last_id = "SELECT LAST_INSERT_ID() as last_id;";
      	$select_result     = mysql_query($query_get_last_id, $connection) or die(mysql_error());
      	$row = mysql_fetch_assoc($select_result);
      	$data_id = $row["last_id"];
      }
//       print_insert_message_by_id($table_name, $data_id);
    }
  }
  return $data_id;
}

function run_multi_query($multi_query, $connection)
{
// 	print_blue_out_message('$connection', $connection);
	
	if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
	{
		$connection->multi_query($multi_query) or die("Multi query failed. Query: $multi_query. The last error: (" . $connection->errno . ") " . $connection->error);
		do {
			if ($res = $connection->store_result()) 
			{
				var_dump($res->fetch_all(MYSQLI_ASSOC));
				$res->free();
			}
		} while ($connection->more_results() && $connection->next_result());
	}
	else
	{
// 		mysql_connect() or die(mysql_error());
// 		mysqli_multi_query($connection, $multi_query) or die("Multi query failed. Query: $multi_query. The last error: " . mysqli_error( $connection ) . mysqli_error());
		
		$my_queries    = split(';', $multi_query);
		$trimmed_queries = array_map('trim', $my_queries);
		$my_queries_ok = array_filter($trimmed_queries);
		$db_name = "vamps";
		foreach ($my_queries_ok as $my_query)
		{
// 			$result = mysql_query($my_query) or die("Query failed. Query: $my_query. The last error: " . mysql_error( ));
			run_query($my_query, $db_name, $connection);			
		}
		
// 		$results = mysql_query($multi_query) or die("Multi query failed. Query: $multi_query. The last error: " . mysql_error( ));
// 		while($row = mysql_fetch_row($results))
// 		{
// 			print_blue_out_message('$row 625 func', $row);
// 		}
// 		Multi query failed. Query: CREATE TEMPORARY TABLE vamps.tmptable_1 SELECT * FROM vamps.vamps_submissions WHERE submit_code = "tdelmont433407" AND id = "697"; UPDATE vamps.tmptable_1 SET submit_code = CONCAT(submit_code, "_backup_", "20130724120850"); UPDATE vamps.tmptable_1 SET id = 0; INSERT IGNORE INTO vamps.vamps_submissions SELECT * FROM vamps.tmptable_1 LIMIT 1; DROP TEMPORARY TABLE IF EXISTS vamps.tmptable_1; . The last error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'UPDATE vamps.tmptable_1 SET submit_code = CONCAT(submit_code, "_backup_", "20130' at line 4				
// 	    do {
// 	        /* store first result set */
	    	
// 	        if ($result = mysqli_store_result($connection)) 
// 	        {
// 	        	$subresult = mysqli_fetch_assoc( $result );
// 	            mysqli_free_result($result);
// 	        }
// 	    } while (mysqli_more_results($connection) && mysqli_next_result($connection));
	}
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
    " ($table_name) VALUES (\"NNNN". $$table_name . "\")";
  }  
  elseif ($table_name == "run")
  {
    $query = "INSERT IGNORE INTO " . $db_name . "." . $table_name .
    "($table_name, run_prefix, date_trimmed) VALUES (\"". $data_array["rundate"] . "\", \"illumin\", \"0000-00-00\")";
  } 
  elseif ($table_name == "project")
  {
//   	TODO: move to a function
  	$contact_query = "SELECT contact_id from " . $db_name . ".contact WHERE vamps_name = \"" . $data_array["user"] . "\"";
//   	print_blue_message("contact query = $contact_query");
  	$row = get_one_value($contact_query, $db_name, $connection);
  	
  	if (isset($row[key($row)]))
  	{
  		$contact_id = $row[key($row)];
  	}
  	else 
  	{
  		print_red_message("Please add the user to VAMPS");
  	}
  	
  	$env_sample_source_query = "SELECT env_sample_source_id from " . $db_name . ".env_sample_source WHERE env_source_name = \"" . $data_array["env_source_name"] . "\"";
  	$row = get_one_value($env_sample_source_query, $db_name, $connection);
  	 
  	if (isset($row[key($row)]))
  	{
  		$env_sample_source_id = $row[key($row)];
  	}
  	else
  	{
  		print_red_message("Please check the env_source_name");
  	}
  	 	 
  	$project_name = $data_array['project'];
  	$query = "INSERT IGNORE INTO " . $db_name . ".project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id)
  	VALUES (\"" . $project_name . "\", \"" . $data_array['project_title'] . "\", \"" . $data_array['project_description'] . "\", REVERSE(\"$project_name\"), \"" . $data_array['funding'] . "\",
  	$env_sample_source_id, $contact_id)";
  	
  } 
  elseif ($table_name == "dna_region")
  {
  	//   	TODO: print out dna_region and existing ones
  	  
  	print_red_message("Please check the dna_region");
  }
  else
  {
    $query = "INSERT IGNORE INTO " . $db_name . "." . $table_name . 
              "($table_name) VALUES (\"". $$table_name . "\")";    
  }
  $data_id = run_query($query, $table_name, $connection);
  
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
 
//   print_blue_out_message('$query', $query);
//   print_blue_out_message('$db_name', $db_name);
//   print_blue_out_message('$connection', $connection);
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

function get_primer_suite_name($dna_region, $domain) 
{
  if ($dna_region == "v4v5")
  {
    $dna_region = "V4-V5";
  }
  $primer_domain = ucfirst($domain) . "l";
  $suite_name    = $primer_domain . " " . $dna_region . " Suite";
  return $suite_name;
}

function get_primer_suite_id($dna_region, $domain, $db_name, $connection) {
  $res_id = 0;
  $table_name = "primer_suite";  
  $suite_name = get_primer_suite_name($dna_region, $domain);
  $query      = "SELECT " . $table_name . "_id from " . $db_name . "." . $table_name . " where " . $table_name . " = \"" . $suite_name . "\"";
  $row        = get_one_value($query, $db_name, $connection);
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
  if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
  {
    $local_mysqli = $connection;
    $results = $local_mysqli->query($query);
    if (isset($results->num_rows))
    {
	    for ($row_no = $results->num_rows - 1; $row_no >= 0; $row_no--) 
	    {
	      $results->data_seek($row_no);
	      $row                     = $results->fetch_assoc();
	      $subm_field_names        = array_keys($row);
	      $vamps_submission_info[] = $row;
	    }
    }
  }
  else
  {
    $results = mysql_query($query, $connection) or die("SELECT Error: $query. $results: ".mysql_error());
    $subm_field_names = get_field_names($results);
    while($row = mysql_fetch_row($results))
    {      
      $vamps_submission_info[] = $row;
    }
  }
  return array($subm_field_names, $vamps_submission_info);  
}

function get_submission_tubes_info($connection, $db_name)
{
	$vamps_submission_tubes_info = array();

	//   $query = "SELECT DISTINCT * FROM " . $db_name . ".vamps_submission_tubess JOIN " . $db_name . ".vamps_submission_tubess_tubes USING(submit_code);";
	$query = "SELECT DISTINCT * FROM " . $db_name . ".vamps_submissions_tubes ORDER BY id DESC";

	if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
	{
		$local_mysqli = $connection;
		$results = $local_mysqli->query($query);
		if (isset($results->num_rows))
		{
			for ($row_no = $results->num_rows - 1; $row_no >= 0; $row_no--)
			{
			$results->data_seek($row_no);
			$row                     = $results->fetch_assoc();
			$subm_field_names        = array_keys($row);
			$vamps_submission_tubes_info[] = $row;
			}
		}
	}
	else
	{
		$results = mysql_query($query, $connection) or die("SELECT Error: $query. $results: ".mysql_error());
		$subm_field_names = get_field_names($results);
		while($row = mysql_fetch_row($results))
		{
			$vamps_submission_tubes_info[] = $row;
		}
	}
	return array($subm_field_names, $vamps_submission_tubes_info);
}

function get_tubes_info_by_submit_code_by_id($submission_tubes_id_arr, $db_name, $connection)
{
	$vamps_submission_tubes_info_by_id = array();
	$submission_tubes_ids              = join(", ", $submission_tubes_id_arr);
	$query = "SELECT DISTINCT * FROM " . $db_name . ".vamps_submissions_tubes WHERE id IN (" .  $submission_tubes_ids . ")";
	$vamps_submission_tubes_info_by_id = run_query_and_get_all($query, $connection);
	$id_hash   = make_id_hash($vamps_submission_tubes_info_by_id); 
	return $id_hash;
}

function make_id_hash($multi_array)
{
	$id_hash   = array();
	$named_arr = array();
	foreach ($multi_array as $array)
	{
		if (isset($array["id"]))
		{
			$id_hash[$array["id"]] = $array;
		}
		else 
		{
			$named_arr = rename_vamps_submissions_tubes_arr_to_hash($array);
			$id_hash[$array[0]]    = $named_arr;
		}
	}
	return $id_hash;
}

function rename_vamps_submissions_tubes_arr_to_hash($array)
{
	$named_arr = array();
	$named_arr["id"]               = $array[0];
	$named_arr["submit_code"]      = $array[1];
	$named_arr["tube_number"]      = $array[2];
	$named_arr["tube_label"]       = $array[3];
	$named_arr["dataset_description"] = $array[4];
	$named_arr["duplicate"]        = $array[5];
	$named_arr["domain"]           = $array[6];
	$named_arr["primer_suite"]     = $array[7];
	$named_arr["dna_region"]       = $array[8];
	$named_arr["project_name"]     = $array[9];
	$named_arr["dataset_name"]     = $array[10];
	$named_arr["runkey"]           = $array[11];
	$named_arr["barcode"]          = $array[12];
	$named_arr["pool"]             = $array[13];
	$named_arr["lane"]             = $array[14];
	$named_arr["direction"]        = $array[15];
	$named_arr["platform"]         = $array[16];
	$named_arr["op_amp"]           = $array[17];
	$named_arr["op_seq"]           = $array[18];
	$named_arr["op_empcr"]         = $array[19];
	$named_arr["enzyme"]           = $array[20];
	$named_arr["rundate"]          = $array[21];
	$named_arr["adaptor"]          = $array[22];
	$named_arr["date_initial"]     = $array[23];
	$named_arr["date_updated"]     = $array[24];
	$named_arr["on_vamps"]         = $array[25];
	$named_arr["sample_received"]  = $array[26];
	$named_arr["concentration"]    = $array[27];
	$named_arr["quant_method"]     = $array[28];
	$named_arr["overlap"]          = $array[29];
	$named_arr["insert_size"]      = $array[30];
	$named_arr["barcode_index"]    = $array[31];
	$named_arr["read_length"]      = $array[32];
	$named_arr["trim_distal"]      = $array[33];
	$named_arr["env_sample_source_id"] = $array[34];
	return $named_arr;
}

function get_tubes_info_by_submit_code($submission_tubes_id_arr, $vamps_submission_tubes_info, $db_name, $connection)
{
	foreach ($vamps_submission_tubes_info as $val) 
	{
		foreach ($submission_tubes_id_arr as $submission_tubes_id)
		{	
			if ($val['id'] === $submission_tubes_id) 
			{
				$vamps_submission_tubes_info_short[$submission_tubes_id] = $val;
				break;
			}
		}		
	}	
	return $vamps_submission_tubes_info_short;
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

function slice_arr_by_field_name($need_names, $subm_field_names, $subm_data)
{
  $arr_by_fields = array();

  foreach ($need_names as $field_name)
  {
    $key_num = array_search($field_name, $subm_field_names);
    $arr_by_fields[$field_name] = $subm_data[$key_num];
  }
  return $arr_by_fields;
}

function make_arr_by_key_field_name($subm_field_names, $subm_data, $need_names, $key_field_name)
{

  $arr_by_key_field_name = array();
  $key_field_name_idx    = array_search($key_field_name, $subm_field_names);
  foreach ($subm_data as $subm_data_arr)
    {
      $arr_by_key_field_name_1 = slice_arr_by_field_name($need_names, $subm_field_names, $subm_data_arr);
      $arr_by_key_field_name[$subm_data_arr[$key_field_name_idx]] = implode(", ", $arr_by_key_field_name_1);
    }
  return $arr_by_key_field_name;
}

function get_domain_from_csv_data($csv_domain, $domains_array)
{
  $csv_domain_1 = explode(" ", $csv_domain);
  $domain       = $domains_array[$csv_domain_1[0]];
  return $domain;
}

function make_path_to_raw_data($selected_rundate, $selected_dna_region_base)
{
  
  $machine_name = get_machine_name($selected_dna_region_base);
  $selected_path_to_raw_data =  $selected_rundate . $machine_name . "/";
  return $selected_path_to_raw_data;
}



/**
 * Generatting CSV formatted string from an array.
 * By Sergey Gurevich.
 */
function array_to_scv($array, $header_row = true, $col_sep = ",", $row_sep = "\n", $qut = '"')
{
  $output = "";
  if (!is_array($array) or !is_array($array[0])) return false;

  //Header row.
  if ($header_row)
  {
    foreach ($array[0] as $key => $val)
    {
      //Escaping quotes.
      $key = str_replace($qut, "$qut$qut", $key);
      $output .= "$col_sep$qut$key$qut";
    }
    $output = substr($output, 1)."\n";
  }
  print_r($output);
  //Data rows.
  foreach ($array as $key => $val)
  {
    $tmp = '';
    foreach ($val as $cell_key => $cell_val)
    {
      //Escaping quotes.
      $cell_val = str_replace($qut, "$qut$qut", $cell_val);
      $tmp .= "$col_sep$qut$cell_val$qut";
    }
    $output .= substr($tmp, 1).$row_sep;
  }

  return $output;
}

//error handler function
function customError($errno, $errstr)
{
//   print_r(debug_backtrace());
//   print_r(debug_print_backtrace());

  $err_arr     = error_get_last();
  $err_message = $err_arr["message"];
  $err_file    = $err_arr["file"];
  $err_line    = $err_arr["line"];
  echo "<b>Error:</b> [$errno] \"$err_message\" occured in $err_file on the line $err_line<br>";
  echo "Ending Script";
  die();
}

function create_csv_file($csv_data, $file_name) {
  //set error handler
  set_error_handler("customError", E_USER_ERROR);
//   set_error_handler("E_ALL");
  $fp = fopen($file_name, 'w') or trigger_error("Can't open $file_name: ", E_USER_ERROR);
  error_reporting(E_ERROR | E_PARSE);

  foreach ($csv_data as $fields) {
    fputcsv($fp, $fields);
  }
  fclose($fp);
  chmod($file_name, 0664);
  return $fp;
}

function create_csv_name($rundate, $lane_name)
{
  $csv_file_name = "metadata_" . $rundate . "_" . $lane_name . ".csv";
  return $csv_file_name;
}

function get_submit_code($csv_metadata)
{
    $submit_code_arr = array();
    foreach ($csv_metadata as $csv_metadata_arr1)
    {
  //     print_out($csv_metadata_arr1);
      $submit_code_arr[] = $csv_metadata_arr1["submit_code"];
    }
  //   $submit_code_arr_uniq = array_unique($submit_code_arr);
  
    return $submit_code_arr;
}

function get_submission_tubes_ids($csv_metadata)
{
	$submission_tubes_id_arr = array();
	foreach ($csv_metadata as $csv_metadata_arr1)
	{
		//     print_out($csv_metadata_arr1);
		$submission_tubes_id_arr[] = $csv_metadata_arr1["id"];
	}
	//   $submission_tubes_id_arr_uniq = array_unique($submission_tubes_id_arr);

	return $submission_tubes_id_arr;
}

function get_info_by_submit_code($submit_code_arr, $db_name, $connection)
{
// 	print_blue_out_message('$connection', $connection);
    $vamps_submissions_arr = array();
    $submit_code_arr_uniq  = array_unique($submit_code_arr);
    foreach ($submit_code_arr_uniq as $submit_code)
    {
      $query = "SELECT subm.*, auth.user, auth.passwd, auth.first_name, auth.last_name, auth.active, auth.security_level, auth.email, auth.institution, auth.date_added 
      		FROM " . $db_name . ".vamps_submissions AS subm
      		JOIN " . $db_name . ".vamps_auth AS auth
      			ON (auth.id = subm.vamps_auth_id)
      		WHERE submit_code = \"" . $submit_code. "\"";
      
//       print_blue_out_message('$query = ', $query);
      $row = get_one_value($query, $db_name, $connection);
//       print_blue_out_message('$row', $row);
      $vamps_submissions_arr[$submit_code] = $row;
      
    }
    return $vamps_submissions_arr;
}

function add_zero($adaptor) {
	if (strlen($adaptor) == 2)
	{
		$pattern = '/([A-Za-z])([0-9])/';
		preg_match($pattern, $adaptor, $matches);
		$adaptor0 = $matches[1] . "0" . $matches[2];
		return $adaptor0;
	}
	else 
	{
		return $adaptor;
	}

}

function make_run_info_results($run_info)
{
	foreach ($run_info as $csv_run_info_row)
	{
		//     TODO: deal with different dna_regions in one csv
		$run_info_results = array(
				"dna_region_0"	   => $csv_run_info_row["dna_region"],
				"insert_size"	   => $csv_run_info_row["insert_size"],
				"overlap"		   => $csv_run_info_row["overlap"],
				"read_length"	   => $csv_run_info_row["read_length"],
				"rundate"          => $csv_run_info_row["rundate"],
				"seq_operator"	   => $csv_run_info_row["op_seq"],
				"path_to_raw_data" => make_path_to_raw_data($csv_run_info_row["rundate"], $csv_run_info_row["dna_region"])
		);
	}
	return $run_info_results;
}

function get_val_from_arr($array, $field_name)
{
	$field_names = $all_field_names = array();
	foreach ($array as $row_num => $metadata_arr)
	{
		$field_names[] = $metadata_arr[$field_name];
	}
// 	$all_field_names = array_unique($field_names);
	return $field_names;
}

function get_primer_suite_name_from_db($data_arr, $connection)
{
// 	print_blue_message($domain);
// 	print_blue_message($dna_region);
	
	if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
	{
		$db_name = "test";
	}
	else
	{
		$db_name    = "env454";
// 		$db_name    = "test";		
	}
	
	$rundate     = "";
	$lanes	     = array();
	$suite_names = array();
	
	if (isset($data_arr["find_rundate"]) && isset($data_arr["find_lane"]))
	{
		$rundate = $data_arr["find_rundate"];
		$lanes 	 = array($data_arr["find_lane"]);
	}
	elseif (isset($data_arr["rundate"]) && isset($data_arr["lane"]))
	{
		$rundate = $data_arr["rundate"];
		$lanes 	 = $data_arr["lanes"];		
	}
	else 
	{
		$rundate = $data_arr["rundate"];
		$lanes 	 = $data_arr["lanes"];
		
	}
	
	foreach ($lanes as $lane)
	{
		$query = "
	SELECT DISTINCT primer_suite, dna_region
	 		FROM " . $db_name . ".run_info_ill
	 		JOIN " . $db_name . ".run USING(run_id)
	 		JOIN " . $db_name . ".dna_region USING(dna_region_id)
	 		JOIN " . $db_name . ".primer_suite USING(primer_suite_id)
	 		WHERE
	 		run = \"" . $rundate . "\"
	 		AND lane = " . $lane . "			
				";

		$suite_names[] = get_one_value($query, $db_name, $connection);
	}
	return $suite_names;
}

function creat_dir_if_not_existst($dir_name)
{

	mkdir($dir_name);
	umask(0002);
	chmod($dir_name, 02775);
}

// function create_lane_dom_names($session_csv_content)
// {
// // 	NOT uniqued arrays!
// 	$lane_dom_names = array();
// 	foreach ($session_csv_content as $session_or_posr_content_arr)
// 	{
// 		$lane_dom_names[] = $session_or_posr_content_arr[lane] . "_" . strtoupper($session_or_posr_content_arr[domain][0]);		
// 	}
// // 	print_blue_out_message('$lane_dom_names', $lane_dom_names);
// // 	$lane_dom_names = array();
// // 	$domain = strtoupper($domains[$row_num][0]);
// // 	foreach ($lanes as $row_num => $lane)
// // 	{
// // 		foreach ($domains as $domain)
// // 		{
// // 			$lane_dom_names[] = $lane . "_" . strtoupper($domain[0]);
// // 		}
// // 	}		
// 	return array_unique($lane_dom_names);
	
// }

function create_lane_dom_names($session_or_posr_content)
{
	// 	NOT uniqued arrays!
	$lane_dom_names = array();
	foreach ($session_or_posr_content as $session_or_posr_content_arr)
	{
		$lane   = '';
		$domain = '';
		if (isset($session_or_posr_content_arr["domain"]))
		{
// 			print_green_message("HERE1");
// 			print_blue_out_message('FROM func: 1) $session_or_posr_content_arr', $session_or_posr_content_arr);
// 			print_blue_out_message('$session_or_posr_content_arr["domain"]', $session_or_posr_content_arr["domain"]);
			$lane   = $session_or_posr_content_arr["lane"];
			$domain = strtoupper($session_or_posr_content_arr["domain"][0]);
// 			print_blue_out_message('1 $lane', $lane);
// 			print_blue_out_message('1 $domain', $domain);
		}
		if (isset($session_or_posr_content_arr["find_domain"]))		
		{
// 			print_green_message("HERE2");
// 			print_blue_out_message('FROM func: 2) $session_or_posr_content_arr', $session_or_posr_content_arr);
				
			$lane   = $session_or_posr_content_arr["find_lane"];
			$domain = strtoupper($session_or_posr_content_arr["find_domain"][0]);
// 			print_blue_out_message('2 $lane', $lane);
// 			print_blue_out_message('2 $domain', $domain);
		}
		
		$lane_dom_names[] = $lane . "_" . $domain;
	}
	// 	print_blue_out_message('$lane_dom_names', $lane_dom_names);
	// 	$lane_dom_names = array();
	// 	$domain = strtoupper($domains[$row_num][0]);
	// 	foreach ($lanes as $row_num => $lane)
		// 	{
		// 		foreach ($domains as $domain)
			// 		{
		// 			$lane_dom_names[] = $lane . "_" . strtoupper($domain[0]);
		// 		}
		// 	}
		return array_unique($lane_dom_names);

}
function check_raw_path($dir_name)
{
// That will not work, because vampsdev has no permission to look into /xraid2-2/sequencing/Illumina
	$raw_exists = 0;
	if (is_dir($dir_name)) {
		
		$raw_exists = 1;
	}
	print_blue_message("\$raw_exists = $raw_exists");
	
	return $raw_exists;
}

function get_overlap_script_name($machine_name)
{
	
	switch ($machine_name) {
		case "hs":
			$overlap_script_name = "run_perfect_overlap_clust.sh";
			break;
		case "ms":
// 			$overlap_script_name = "run_partial_overlap_clust.sh";
			$overlap_script_name = "run_partial_overlap_no_clust.sh";
			break;
		default:
			echo "Please provide a machine name";
	}
	return $overlap_script_name;
}

function add_env454_mysql_call($query) {
	return "mysql -h newbpcdb2 env454 -e '" . $query . "'";
}

function server_message($server_name)
{
	if ($server_name == "grendel")
	{
		$server_name = "<strong>grendel</strong>";
	}
	elseif ($server_name == "any")
	{
		$server_name = "any server";
	}
	else
	{
		$server_name = "<strong>$server_name</strong>";
	}

	echo "
	<br/>
	<br/>
	<p>
	This command line(s) can be run on " . $server_name .

	":
	</p>
	";

}

function check_domain($current_domain, $domains_array)
{	
	$csv_domain_1 = explode(" ", $current_domain);
	$domain_1     = $domains_array[$csv_domain_1[0]];
	if (in_array($domain_1, $domains_array))
	{
// 		print_blue_message("HERE!!!");
		$domain_correct = $domain_1;
// 		print_blue_out_message('$domain_correct', $domain_correct);
		$current_domain = $domain_correct;
	}
	return $current_domain;
}

function populate_key_ind($arr_name, $adaptors_full, $dna_region, $db_name, $connection)
{
	$key_ind 				   = get_run_key_by_adaptor($arr_name["adaptor"], $arr_name["domain"], $adaptors_full, $dna_region);
	$arr_name["barcode_index"] = $key_ind["illumina_index"];
	$arr_name["run_key"]       = $key_ind["illumina_run_key"];
	$arr_name["run_key_id"]    = get_id($arr_name, "run_key", $db_name, $connection);
	$arr_name["file_prefix"]   = $key_ind["illumina_index"] . "_NNNN" . $key_ind["illumina_run_key"] . "_" . $arr_name["lane"];
	return $arr_name;
}

function to_underscore($my_string) {
	$my_string1 = str_replace("_", "%", $my_string);
	$my_string2  = str_replace(" ", "%", $my_string1);
	return $my_string2;
}

// http://php.net/manual/en/function.in-array.php
function in_multiarray($elem, $array)
{
	$top = sizeof($array) - 1;
	$bottom = 0;
	while($bottom <= $top)
	{
		if($array[$bottom] == $elem)
			return true;
		else
			if(is_array($array[$bottom]))
			if(in_multiarray($elem, ($array[$bottom])))
			return true;
			
		$bottom++;
	}
	return false;
}

function get_user_info($user_info)
{
	return split(', ', $user_info);
}

function get_vamps_auth_id($vamps_username, $db_name, $connection)
{
	$query = "SELECT auth.id
    		FROM " . $db_name . ".vamps_auth AS auth
      		WHERE auth.user = \"" . $vamps_username. "\"";
	$row = get_one_value($query, $db_name, $connection);
	return $row;
}


function combine_metadata($session, $contact_full, $domains_array, $adaptors_full, $vamps_submissions_tubes_arr, $env_source_names, $db_name, $connection) 
{
	$num = 0;
	$combined_metadata = "";
	
// 	include 'ill_subm_filled_variables.php';
// 	print_blue_message("adaptors_full from func = ");
// 	print_out($adaptors_full);
	
//   	print_blue_message("FROM combine_metadata function");
// 	print_blue_message("\$session: ");
// 	print_out($session);
// 	print_blue_message("\$vamps_submissions_tubes_arr: ");
// 	print_out($vamps_submissions_tubes_arr);
// 	print_blue_message("\$POST: ");
// 	print_out($_POST);
	
	foreach ($session["csv_content"] as $csv_metadata_row) {
		$vamps_username = $csv_metadata_row["user"];
		$user_info_arr  = get_user_info($contact_full[$vamps_username]);
		if (check_var($session["run_info"]["dna_region_0"]))
		{
			$selected_dna_region_base = strtolower($session["run_info"]["dna_region_0"]);
		}
		$combined_metadata[$num]["adaptor"]				= add_zero(strtoupper($csv_metadata_row["adaptor"]));
		$combined_metadata[$num]["amp_operator"]		= $csv_metadata_row["op_amp"];
		$combined_metadata[$num]["barcode"]				= $csv_metadata_row["barcode"];
		$user_names = $user_info_arr[0].', '.$user_info_arr[1];
		$combined_metadata[$num]["data_owner"]			= $user_names;
// 		$combined_metadata[$num]["data_owner"]			= $contact[$csv_metadata_row["user"]];
		
		$combined_metadata[$num]["dataset"]				= $csv_metadata_row["dataset_name"];
		$combined_metadata[$num]["dataset_description"]	= $csv_metadata_row["dataset_description"];
		$combined_metadata[$num]["dataset_id"] 	        = get_id($combined_metadata[$num], "dataset", $db_name, $connection);
		$combined_metadata[$num]["date_initial"]        = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["date_initial"];
		$combined_metadata[$num]["date_updated"]        = date("Y-m-d");
		$combined_metadata[$num]["dna_region"] 	  		= $csv_metadata_row["dna_region"];
// 		$session["run_info"]["dna_region_0"];
		$combined_metadata[$num]["dna_region_id"]     	= get_id($session["run_info"], "dna_region_0", $db_name, $connection);
		$combined_metadata[$num]["domain"]				= $csv_metadata_row["domain"];
		$combined_metadata[$num]["domain"]              = check_domain($combined_metadata[$num]["domain"], $domains_array);
		$combined_metadata[$num]["domain"]              =  ucfirst($combined_metadata[$num]["domain"]);		
// 		$combined_metadata[$num]["email"]               = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["email"];
		$combined_metadata[$num]["email"]               = $user_info_arr[2];
		$combined_metadata[$num]["env_sample_source_id"] = $csv_metadata_row["env_sample_source_id"];
		$combined_metadata[$num]["env_source_name"]		= $env_source_names[$combined_metadata[$num]["env_sample_source_id"]];
// 		$combined_metadata[$num]["first_name"]          = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["first_name"];
		$combined_metadata[$num]["first_name"]          = $user_info_arr[1];
		$combined_metadata[$num]["funding"]				= $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["funding"];
		$combined_metadata[$num]["insert_size"] 	  	= $session["run_info"]["insert_size"];
// 		$combined_metadata[$num]["institution"]         = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["institution"];
		$combined_metadata[$num]["institution"]         = $user_info_arr[3];
		$combined_metadata[$num]["lane"]				= $csv_metadata_row["lane"];
// 		$combined_metadata[$num]["last_name"]           = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["last_name"];
		$combined_metadata[$num]["last_name"]           = $user_info_arr[0];
		$combined_metadata[$num]["locked"]              = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["locked"];
		$combined_metadata[$num]["num_of_tubes"]        = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["num_of_tubes"];
		$combined_metadata[$num]["op_empcr"]			= $csv_metadata_row["op_empcr"];
		$combined_metadata[$num]["overlap"] 		  	= $session["run_info"]["overlap"];
		$combined_metadata[$num]["primer_suite"]     	= get_primer_suite_name($combined_metadata[$num]["dna_region"], $combined_metadata[$num]["domain"]);
// 		print_blue_out_message('$combined_metadata[$num]["dna_region"]', $combined_metadata[$num]["dna_region"]);
// 		print_blue_out_message('$combined_metadata[$num]["domain"]', $combined_metadata[$num]["domain"]);
		$combined_metadata[$num]["primer_suite_id"]  	= get_primer_suite_id($combined_metadata[$num]["dna_region"], $combined_metadata[$num]["domain"], $db_name, $connection);
		$combined_metadata[$num]["project"]				= $csv_metadata_row["project_name"];
		$combined_metadata[$num]["project_title"]       = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["title"];
		if (isset($session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["project_title"]))
		{
			$combined_metadata[$num]["project_title"]		= $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["project_title"];
		}
		$combined_metadata[$num]["project_description"]	= $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["project_description"];
		$combined_metadata[$num]["project_id"]       	= get_id($combined_metadata[$num], "project", $db_name, $connection);
		$combined_metadata[$num]["read_length"] 	  	= $session["run_info"]["read_length"];
		$combined_metadata[$num]["run"] 		  		= $session["run_info"]["rundate"];
		$combined_metadata[$num]["run_id"] 		  		= get_id($session["run_info"], "run", $db_name, $connection);
		$combined_metadata[$num]["seq_operator"] 	  	= $session["run_info"]["seq_operator"];
		$combined_metadata[$num]["submit_code"]			= $csv_metadata_row["submit_code"];
		$combined_metadata[$num]["submissions_tubes_id"] = $csv_metadata_row["id"];
		$combined_metadata[$num]["temp_project"]        = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["temp_project"];
		$combined_metadata[$num]["tubelabel"]			= $csv_metadata_row["tube_label"];
// 		$combined_metadata[$num]["user"]   			    = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["user"];
		$combined_metadata[$num]["user"]   			    = $username;
// 		$combined_metadata[$num]["vamps_auth_id"]       = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["vamps_auth_id"];
		$combined_metadata[$num]["vamps_auth_id"]       = get_vamps_auth_id($vamps_username, $db_name, $connection);
		print_blue_out_message('$combined_metadata[$num]["vamps_auth_id"]', $combined_metadata[$num]["vamps_auth_id"]);
		$combined_metadata[$num]["vamps_submissions_id"] = $session["vamps_submissions_arr"][$csv_metadata_row["submit_code"]]["id"];

		$combined_metadata[$num] = populate_key_ind($combined_metadata[$num], $adaptors_full, $selected_dna_region_base, $db_name, $connection);
		$num += 1;
	}
// 	print_blue_out_message('1) functions: $combined_metadata', $combined_metadata);
	
	return $combined_metadata;
}



?>
