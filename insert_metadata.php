<?php
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; insert_metadata");


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
  	$connection = $newbpc2_connection;
  	$db_name    = "env454";
  	//     $connection = $vampsdev_connection;
  	//     $db_name    = "test";  
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
  $db_name = "test";
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
	";
	$insert_metadata_query2 = "UPDATE IGNORE " . $db_name . ".vamps_submissions_tubes
	  SET
 		  tube_label = \"" . $combined_metadata_row["tubelabel"] . "\",
		  tube_description = \"" . $combined_metadata_row["tube_description"] . "\",
		  domain = \"" . $combined_metadata_row["domain"] . "\",
		  primer_suite = \"" . $combined_metadata_row["primer_suite"] . "\",
		  dna_region = \"" . $combined_metadata_row["dna_region"] . "\",
		  project_name = \"" . $combined_metadata_row["project"] . "\",
		  dataset_name = \"" . $combined_metadata_row["dataset"] . "\",
		  runkey = \"" . $combined_metadata_row["run_key"] . "\",
		  barcode = \"" . $combined_metadata_row["barcode"] . "\",
		  lane = \"" . $combined_metadata_row["lane"] . "\",
		  op_amp = \"" . $combined_metadata_row["amp_operator"] . "\",
		  op_empcr = \"" . $combined_metadata_row["op_empcr"] . "\",
		  op_seq = \"" . $combined_metadata_row["seq_operator"] . "\",	  		
		  rundate = \"" . $combined_metadata_row["run"] . "\",
		  adaptor = \"" . $combined_metadata_row["adaptor"] . "\",
		  date_initial = \"" . $combined_metadata_row["date_initial"] . "\",
		  date_updated = \"$date_updated\",
		  overlap = \"" . $combined_metadata_row["overlap"] . "\",
		  insert_size = \"" . $combined_metadata_row["insert_size"] . "\",
		  barcode_index = \"" . $combined_metadata_row["barcode_index"] . "\",
		  read_length = \"" . $combined_metadata_row["read_length"] . "\"
		WHERE submit_code = \"" . $combined_metadata_row["submit_code"] . "\"
			AND id = \"" . $combined_metadata_row["submissions_tubes_id"] . "\"
";
//     	 $new_vamps_submissions_tubes = run_query($insert_metadata_query2, "vamps_submissions_tubes", $connection);
//     	 print_blue_message("\$new_vamps_submissions_tubes");
//     	 print_out($new_vamps_submissions_tubes);
    
//     $insert_metadata_query2 = "UPDATE " . $db_name . ".vamps_submissions_tubes
//     	(tube_number, tubelabel, tube_description, duplicate, domain,
//     		primer_suite, dna_region, project_name, dataset_name, runkey, 
//     		barcode, pool, lane, direction, platform, op_amp, op_seq, 
//     		op_empcr, enzyme, rundate, adaptor, date_initial, date_updated,
//     		on_vamps, sample_received, concentration, quant_method, overlap, 
//     		insert_size, barcode_index, file_prefix, read_length, trim_distal)
// 		VALUES(\"$tube_number\", \"$tubelabel\", \"$tube_description\", \"$duplicate\", \"$domain\",
// 			\"$primer_suite\", \"$dna_region\", \"$project_name\", \"$dataset_name\", \"$runkey\",
// 			\"$barcode\", \"$pool\", \"$lane\", \"$direction\", \"$platform\", \"$op_amp\", \"$op_seq\",
// 			\"$op_empcr\", \"$enzyme\", \"$rundate\", \"$adaptor\", \"$date_initial\", \"$date_updated\",
// 			\"$on_vamps\", \"$sample_received\", \"$concentration\", \"$quant_method\", \"$overlap\",
// 			\"$insert_size\", \"$barcode_index\", \"$file_prefix\", \"$read_length\", \"$trim_distal\"
// 		)    		
// 		WHERE submit_code = \"$submit_code\"
//     ";
    
//     $insert_metadata_query = "INSERT IGNORE INTO " . $db_name . ".run_info_ill
//       (adaptor, amp_operator, barcode, barcode_index, dataset_id, 
//         dna_region_id, file_prefix, insert_size, lane, overlap, primer_suite_id, 
//         project_id, read_length, run_id, run_key_id, seq_operator, tubelabel)
//       VALUES (\"$adaptor\", \"$amp_operator\", \"$barcode\", \"$barcode_index\", \"$dataset_id\", 
//       \"$dna_region_id\", \"$file_prefix\", \"$insert_size\", \"$lane\", \"$overlap\", \"$primer_suite_id\", 
//       \"$project_id\", \"$read_length\", \"$run_id\", \"$run_key_id\", \"$seq_operator\", \"$tubelabel\")
//     ";
    
    /* Upload metadata only from run_info_upload step for now
     * 
+adaptor
+amp_operator
+barcode
+barcode_index
+dataset_id
+dna_region_id
file_prefix
insert_size
lane
overlap
primer_suite_id
project_id
read_length
run_id
run_key_id
seq_operator
tubelabel

     * 
     * */
//     if (
//     		($adaptor         == "") ||
//     		($amp_operator    == "") ||
//     		($barcode         == "") ||
//     		($barcode_index   == "") ||
//     		($dataset_id      == 0)  ||
//     		($dna_region_id   == 0)  ||
//     		($file_prefix     == "") ||
//     		($insert_size     == "") ||
//     		($lane            == "") ||
//     		($overlap         == "") ||
//     		($primer_suite_id == 0)  ||
//     		($project_id      == 0)  ||
//     		($read_length     == "") ||
//     		($run_id          == 0)  ||
//     		($run_key_id      == 0)  ||
//     		($seq_operator    == "") ||
//     		($tubelabel       == "")
//     )
//     {
//     	print_blue_message("One of the follow field is empty:
//     	run_key_id      = $run_key_id,<br/>
//     	run_id          = $run_id,<br/>
//     	lane            = $lane,<br/>
//     	dataset_id      = $dataset_id,<br/>
//     	project_id      = $project_id,<br/>
//     	tubelabel      = $tubelabel,<br/>
//     	barcode         = $barcode,<br/>
//     	adaptor         = $adaptor,<br/>
//     	dna_region_id   = $dna_region_id,<br/>
//     	amp_operator    = $amp_operator,<br/>
//     	seq_operator    = $seq_operator,<br/>
//     	barcode_index   = $barcode_index,<br/>
//     	overlap         = $overlap,<br/>
//     	insert_size     = $insert_size,<br/>
//     	file_prefix     = $file_prefix,<br/>
//     	read_length     = $read_length,<br/>
//     	primer_suite_id = $primer_suite_id,<br/>
//     	");
//     }
//     else
//     {
// //     print_out($insert_metadata_query);
//     	 $new_run_info_ill_id = run_query($insert_metadata_query, "run_info_ill", $connection);
//     }
    print_blue_message('$insert_metadata_query1 = ' . $insert_metadata_query1);
    print_blue_message('$insert_metadata_query2 = ' . $insert_metadata_query2);
    
    if ($new_run_info_ill_id)
    {
      print("==========================================");      
    }
  }
  
//   ====
  include_once 'step_subm_metadata_create_csv.php';
?>