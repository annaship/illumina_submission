<?php
print_blue_message("From ". $_SERVER["PHP_SELF"] . "; insert_metadata");


  $adaptor = $amp_operator = $barcode = $barcode_index = $dataset_id = "";
  $dna_region_id = $file_prefix = $insert_size = $lane = $overlap = $primer_suite_id = ""; 
  $project_id = $read_length = $run_id = $run_key_id = $seq_operator = $tube_label = "";

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
  print_blue_message("\$combined_metadata");
  print_out($combined_metadata);
  
//   print_red_message("From insert_metadata");
  
// print_red_message("\$result_metadata_arr = ");
// print_out($result_metadata_arr);
// print_red_message("\$_SESSION[\"run_info\"] = ");
// print_out($_SESSION["run_info"]);
// print_red_message("\$_SESSION = ");
// print_out($_SESSION);
// print_red_message("\$_SESSION[\"vamps_submissions_arr\"] = ");
// print_out($_SESSION["vamps_submissions_arr"]);
//   $combine_session_data = combine_session_data($_SESSION);

  foreach ($_SESSION["csv_content"] as $row_num => $csv_content_arr)
  {
//   	print_red_message("\$csv_content_arr = ");
// 	print_out($csv_content_arr);
  	
//     $adaptor 		  = $csv_content_arr["adaptor"];
//     $amp_operator     = $csv_content_arr["op_amp"];
//     $barcode 		  = $csv_content_arr["barcode"];
//     $barcode_index 	  = $csv_content_arr["barcode_index"];
//     $data_owner 	  = $csv_content_arr["data_owner"];
//     $dataset_name 	  = $csv_content_arr["dataset_name"];    
//     $dataset_id 	  = get_id($csv_content_arr, "dataset", $db_name, $connection); 
//     $domain           = $csv_content_arr["domain"];
//     $env_sample_source = $csv_content_arr["env_sample_source"];
//     $dna_region 	  = $_SESSION["run_info"]["dna_region_0"]; 
//     $dna_region_id     = get_id($_SESSION['run_info'], "dna_region_0", $db_name, $connection);
// //     CAGATC_NNNNGACTC_4
//     $file_prefix      = $csv_content_arr["barcode_index"] . "_NNNN" . $csv_content_arr["run_key"] . "_" . $csv_content_arr["lane"];
//     $insert_size 	  = $_SESSION["run_info"]["insert_size"];
//     $lane 			  = $csv_content_arr["lane"];
//     $op_empcr		  = $csv_content_arr["op_empcr"];    
//     $overlap 		  = $_SESSION["run_info"]["overlap"];
//     $primer_suite     = get_primer_suite_name($dna_region, $domain);
//     $primer_suite_id  = get_primer_suite_id($dna_region, $domain, $db_name, $connection);    
//     $project_id       = get_id($csv_content_arr, "project", $db_name, $connection); 
//     $project_name     = $csv_content_arr["project_name"];
//     $read_length 	  = $_SESSION["run_info"]["read_length"];
//     $run_id 		  = get_id($_SESSION["run_info"], "run", $db_name, $connection);
//     $run_key_id 	  = get_id($csv_content_arr, "run_key", $db_name, $connection);
//     $runkey 		  = $csv_content_arr["runkey"];
//     $seq_operator 	  = $_SESSION["run_info"]["seq_operator"];
//     $submit_code      = $csv_content_arr["submit_code"];
//     $tube_label 		  = $csv_content_arr["tube_label"];
//     $tube_description = $csv_content_arr["tube_description"];
    
//   TODO: data_owner print by project, not choose
// TODO: insert into vamps subm only! 

// // 	$date_initial        = date_initial;
	$date_updated        = date("Y-m-d");
	
	
// 	$id                  = $_SESSION["vamps_submissions_arr"][$submit_code]["id"];
// 	$user                = $_SESSION["vamps_submissions_arr"][$submit_code]["user"];
// 	$last_name           = $_SESSION["vamps_submissions_arr"][$submit_code]["last_name"];
// 	$first_name          = $_SESSION["vamps_submissions_arr"][$submit_code]["first_name"];
// 	$email               = $_SESSION["vamps_submissions_arr"][$submit_code]["email"];
// 	$institution         = $_SESSION["vamps_submissions_arr"][$submit_code]["institution"];
// 	$temp_project        = $_SESSION["vamps_submissions_arr"][$submit_code]["temp_project"];
// 	$title               = $_SESSION["vamps_submissions_arr"][$submit_code]["title"];
// 	$project_description = $_SESSION["vamps_submissions_arr"][$submit_code]["project_description"];
// 	$environment         = $_SESSION["vamps_submissions_arr"][$submit_code]["environment"];
// 	$env_source_id       = $_SESSION["vamps_submissions_arr"][$submit_code]["env_source_id"];
// 	$funding             = $_SESSION["vamps_submissions_arr"][$submit_code]["funding"];
// 	$num_of_tubes        = $_SESSION["vamps_submissions_arr"][$submit_code]["num_of_tubes"];
// 	$date_initial        = $_SESSION["vamps_submissions_arr"][$submit_code]["date_initial"];
// 	$locked              = $_SESSION["vamps_submissions_arr"][$submit_code]["locked"];
    
	$insert_metadata_query1 = "UPDATE IGNORE " . $db_name . ".vamps_submissions
	 SET 
	    user = \"$user\",
	    last_name = \"$last_name\",
	    first_name = \"$first_name\",
	    email = \"$email\",
	    institution = \"$institution\",
	    temp_project = \"$temp_project\",
	    title = \"$title\",
	    project_description = \"$project_description\",
	    environment = \"$environment\",
	    env_source_id = \"$env_source_id\",
	    funding = \"$funding\",
	    num_of_tubes = \"$num_of_tubes\",
	    date_updated = \"$date_updated\"
	WHERE submit_code = \"$submit_code\" AND id = \"$id\"      
	";
    
$insert_metadata_query2 = "UPDATE IGNORE " . $db_name . ".vamps_submissions_tubes
  SET
    tube_label = \"$tube_label\",
    tube_description = \"$tube_description\",
    domain = \"$domain\",
    primer_suite = \"$primer_suite\",
    dna_region = \"$dna_region\",
    project_name = \"$project_name\",
    dataset_name = \"$dataset_name\",
    runkey = \"$runkey\",
    barcode = \"$barcode\",
    lane = \"$lane\",
    op_amp = \"$op_amp\",
    op_empcr = \"$op_empcr\",
    rundate = \"$rundate\",
    adaptor = \"$adaptor\",
    date_initial = \"$date_initial\",
    date_updated = \"$date_updated\",
    overlap = \"$overlap\",
    insert_size = \"$insert_size\",
    barcode_index = \"$barcode_index\",
    read_length = \"$read_length\"
  WHERE submit_code = \"$submit_code\"
";
    
    
//     $insert_metadata_query2 = "UPDATE " . $db_name . ".vamps_submissions_tubes
//     	(tube_number, tube_label, tube_description, duplicate, domain,
//     		primer_suite, dna_region, project_name, dataset_name, runkey, 
//     		barcode, pool, lane, direction, platform, op_amp, op_seq, 
//     		op_empcr, enzyme, rundate, adaptor, date_initial, date_updated,
//     		on_vamps, sample_received, concentration, quant_method, overlap, 
//     		insert_size, barcode_index, file_prefix, read_length, trim_distal)
// 		VALUES(\"$tube_number\", \"$tube_label\", \"$tube_description\", \"$duplicate\", \"$domain\",
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
//         project_id, read_length, run_id, run_key_id, seq_operator, tube_label)
//       VALUES (\"$adaptor\", \"$amp_operator\", \"$barcode\", \"$barcode_index\", \"$dataset_id\", 
//       \"$dna_region_id\", \"$file_prefix\", \"$insert_size\", \"$lane\", \"$overlap\", \"$primer_suite_id\", 
//       \"$project_id\", \"$read_length\", \"$run_id\", \"$run_key_id\", \"$seq_operator\", \"$tube_label\")
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
tube_label

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
//     		($tube_label       == "")
//     )
//     {
//     	print_blue_message("One of the follow field is empty:
//     	run_key_id      = $run_key_id,<br/>
//     	run_id          = $run_id,<br/>
//     	lane            = $lane,<br/>
//     	dataset_id      = $dataset_id,<br/>
//     	project_id      = $project_id,<br/>
//     	tube_label      = $tube_label,<br/>
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