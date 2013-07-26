<?php
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; insert_metadata");
// print_blue_out_message('$_POST', $_POST);
// print_blue_out_message('6) insert_metadata, $combined_metadata', $combined_metadata);

  $adaptor = $amp_operator = $barcode = $barcode_index = $dataset_id = "";
  $dna_region_id = $file_prefix = $insert_size = $lane = $overlap = $primer_suite_id = ""; 
  $project_id = $read_length = $run_id = $run_key_id = $seq_operator = $tubelabel = "";

  if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))  
  {
    $connection = $local_mysqli;
    $db_name    = "test";
  }
  else
  {
//   	$connection = $newbpc2_connection;
//   	$db_name    = "env454";
//   	    $connection = $vampsdev_connection;
//   	    $db_name    = "test";  
  	    $connection = $vampsprod_connection_w;
  	    $db_name    = "vamps";  
  }
    
//   $combined_metadata = combine_metadata($_SESSION, $contact, $domains_array, $db_name, $connection);
//   print_blue_message("From insert_metadata");
//   print_blue_message("\$combined_metadata");
//   print_out($combined_metadata);
  
  
// print_red_message("\$result_metadata_arr = ");
// print_out($result_metadata_arr);
// print_red_message("\$_SESSION[\"run_info\"] = ");
// print_out($_SESSION["run_info"]);
// print_red_message("\$_SESSION = ");
// print_out($_SESSION);
// print_red_message("\$_SESSION[\"vamps_submissions_arr\"] = ");
// print_out($_SESSION["vamps_submissions_arr"]);
//   $combine_session_data = combine_session_data($_SESSION);
  $date_updated        = date("Y-m-d");
//   TODO: change to new table structure:
// vamps_submissions <- submit_code, vamps_auth_id, temp_project, title, project_description, funding, num_of_tubes, date_initial, date_updated, locked,
//   vamps_auth: (do not update, take a new id, if needed!)
// TODO: how to change vamps_auth_id?
//   user				= \"" . $combined_metadata_row["user"] . "\",
// 	    last_name			= \"" . $combined_metadata_row["last_name"] . "\",
// 	    first_name			= \"" . $combined_metadata_row["first_name"] . "\",
// 	    email				= \"" . $combined_metadata_row["email"] . "\",
// 	    institution			= \"" . $combined_metadata_row["institution"] . "\",

//   $new_vamps_submissions = run_query($insert_metadata_query1, "vamps_submissions_tubes", $connection);
//   print_blue_message("\$new_vamps_submissions");
//   print_out($new_vamps_submissions);

  $all_insert_metadata_queries = $all_backup_metadata_queries = Array();
  foreach ($combined_metadata as $row_num => $combined_metadata_row)
  {
    
  	$insert_metadata_query1 = "UPDATE IGNORE " . $db_name . ".vamps_submissions
	 SET
	    temp_project		= \"" . $combined_metadata_row["temp_project"] . "\",
	    title				= \"" . $combined_metadata_row["project_title"] . "\",
	    project_description	= \"" . $combined_metadata_row["project_description"] . "\",
	    funding				= \"" . $combined_metadata_row["funding"] . "\",
	    num_of_tubes		= \"" . $combined_metadata_row["num_of_tubes"] . "\",
  		    date_updated		= \"$date_updated\",
  		    locked				= \"" . $combined_metadata_row["locked"] . "\"
  	    WHERE submit_code	= \"" . $combined_metadata_row["submit_code"] . "\"
			AND id 			= \"" . $combined_metadata_row["vamps_submissions_id"] . "\"
		;					
	";
	$insert_metadata_query2 = "UPDATE IGNORE " . $db_name . ".vamps_submissions_tubes
	  SET
 		  tube_label          = \"" . $combined_metadata_row["tubelabel"] . "\",
		  dataset_description = \"" . $combined_metadata_row["dataset_description"] . "\",
		  domain              = \"" . $combined_metadata_row["domain"] . "\",
		  primer_suite        = \"" . $combined_metadata_row["primer_suite"] . "\",
		  dna_region          = \"" . $combined_metadata_row["dna_region"] . "\",
		  project_name        = \"" . $combined_metadata_row["project"] . "\",
		  dataset_name        = \"" . $combined_metadata_row["dataset"] . "\",
		  runkey              = \"" . $combined_metadata_row["run_key"] . "\",
		  barcode             = \"" . $combined_metadata_row["barcode"] . "\",
		  lane                = \"" . $combined_metadata_row["lane"] . "\",
		  op_amp              = \"" . $combined_metadata_row["amp_operator"] . "\",
		  op_empcr            = \"" . $combined_metadata_row["op_empcr"] . "\",
		  op_seq              = \"" . $combined_metadata_row["seq_operator"] . "\",	  		
		  rundate             = \"" . $combined_metadata_row["run"] . "\",
		  adaptor             = \"" . $combined_metadata_row["adaptor"] . "\",
		  date_initial        = \"" . $combined_metadata_row["date_initial"] . "\",
		  date_updated        = \"$date_updated\",
		  overlap             = \"" . $combined_metadata_row["overlap"] . "\",
		  insert_size         = \"" . $combined_metadata_row["insert_size"] . "\",
		  barcode_index       = \"" . $combined_metadata_row["barcode_index"] . "\",
		  read_length         = \"" . $combined_metadata_row["read_length"] . "\"
		WHERE submit_code = \"" . $combined_metadata_row["submit_code"] . "\"
			AND id = \"" . $combined_metadata_row["submissions_tubes_id"] . "\"
		;
";
	array_push($all_insert_metadata_queries, $insert_metadata_query1, $insert_metadata_query2);
// 	print_blue_out_message('$insert_metadata_query1', $insert_metadata_query1);
// 	print_blue_out_message('$insert_metadata_query2', $insert_metadata_query2);

// 	TODO:
// 	1) create copy of the line,
// 	2) update the old one
// 	$res = "";
	$backup_subm_metadata_query1 = "";
	$backup_subm_metadata_query1 = "CREATE TEMPORARY TABLE " . $db_name . ".tmptable_1 SELECT * FROM " . $db_name . ".vamps_submissions
  	    WHERE submit_code	= \"" . $combined_metadata_row["submit_code"] . "\"
			AND id 			= \"" . $combined_metadata_row["vamps_submissions_id"] . "\";
		UPDATE " . $db_name . ".tmptable_1 SET submit_code = CONCAT(submit_code, \"_backup_\", \"" . date("Ymdhis") . "\");
		UPDATE " . $db_name . ".tmptable_1 SET id = 0;				
		INSERT IGNORE INTO " . $db_name . ".vamps_submissions SELECT * FROM " . $db_name . ".tmptable_1 LIMIT 1;
		DROP TEMPORARY TABLE IF EXISTS " . $db_name . ".tmptable_1;
	";
	$backup_subm_metadata_query2 = "";
	$backup_subm_metadata_query2 = "CREATE TEMPORARY TABLE " . $db_name . ".tmptable_1 SELECT * FROM " . $db_name . ".vamps_submissions_tubes
		WHERE submit_code = \"" . $combined_metadata_row["submit_code"] . "\"
			AND id = \"" . $combined_metadata_row["submissions_tubes_id"] . "\";
		UPDATE " . $db_name . ".tmptable_1 SET submit_code = CONCAT(submit_code, \"_backup_\", \"" . date("Ymdhis") . "\");
		UPDATE " . $db_name . ".tmptable_1 SET id = 0;
		INSERT IGNORE INTO " . $db_name . ".vamps_submissions_tubes SELECT * FROM " . $db_name . ".tmptable_1 LIMIT 1;
		DROP TEMPORARY TABLE IF EXISTS " . $db_name . ".tmptable_1;
	";
	
	array_push($all_backup_metadata_queries, $backup_subm_metadata_query1, $backup_subm_metadata_query2);

  }
  
  $all_backup_metadata_queries_u = array_unique($all_backup_metadata_queries);
  $all_insert_metadata_queries_u = array_unique($all_insert_metadata_queries);
//   print_blue_out_message('$$all_insert_metadata_queries_u = ', $all_insert_metadata_queries_u);
  
  foreach ($all_backup_metadata_queries_u as $all_backup_metadata_query)
  {
//   	print_blue_out_message('$all_backup_metadata_query = ', $all_backup_metadata_query);
  	run_multi_query($all_backup_metadata_query, $connection);
;
  }
  foreach ($all_insert_metadata_queries_u as $all_insert_metadata_query)
  {
//   	print_blue_out_message('1) $all_insert_metadata_query', $all_insert_metadata_query);
  	run_query($all_insert_metadata_query, $db_name, $connection);
  }
  
//   ====
  include_once 'step_subm_metadata_create_csv.php';
?>