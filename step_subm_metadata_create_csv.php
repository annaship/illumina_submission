<?php 
$lanes = $domains = array();
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; step_subm_metadata_create_csv");

// include_once("ill_subm_functions.php");
// include_once "ill_subm_filled_variables.php";

/* TODO:
 * 1) csv in _info directory
 * 2) take content and header from insert_metadata
 * 3) download file to a local! machine by button 
 * 
 */
//print csv file
// print_blue_message("\$result_metadata_arr");
// print_out($result_metadata_arr);
// print_out($_SESSION['run_info']);

// TODO: create array data_all (metadata + run_key) for csv
// take headers from correct metadata
// TODO: use $vamps_submissions_arr[$csv_metadata_row["submit_code"]]["user"] to get username

$table_headers = array("adaptor", "amp_operator", "barcode", "barcode_index", 
		"data_owner", "dataset", "dataset_description", "dna_region", "email", "env_sample_source_id", 
		"first_name", "funding", "insert_size", "institution", "lane", "last_name", "overlap", "primer_suite",
		"project", "project_description", "project_title", "read_length", "run", "run_key", "seq_operator", "tubelabel");
$table_headers_arr = array_flip($table_headers);
ksort($table_headers_arr);

foreach ($combined_metadata as $row_num => $combined_metadata_row)
{
	ksort($combined_metadata_row);
	
// 	print "<br/>========<br/>";
	
// 	print_blue_message("\$combined_metadata_row = ");
// 	print_out($combined_metadata_row);
// 	print "<br/>";

	
	$result_arr = array_intersect_key($combined_metadata_row, $table_headers_arr);
// 	print_blue_message("\$result_arr - array_intersect_key = ");
// 	print_out($result_arr);
	$domains[]	= $combined_metadata_row["domain"];
	$lanes[]    = $combined_metadata_row["lane"];
	$data_all[] = $result_arr;
	
}
// print_blue_out_message('7) step_subm_metadata_create_csv, $combined_metadata', $combined_metadata);

// {
//   $contact_info   = array_map('trim', explode(',', $contact_full[$metadata_arr["user"]])); 
// //   print_out($metadata_arr);
  
//   $data_for_csv["adaptor"] 		 	    = $metadata_arr["adaptor"];
//   $data_for_csv["amp_operator"]         = $metadata_arr["amp_operator"];
//   $data_for_csv["barcode"] 		        = $metadata_arr["barcode"];
//   $data_for_csv["barcode_index"] 	    = $metadata_arr["barcode_index"];
//   $data_for_csv["data_owner"]    	    = $metadata_arr["user"];
//   $data_for_csv["dataset"] 	            = $metadata_arr["dataset"];
//   if (check_var($metadata_arr["dataset_description"]))
//   {	
//   	$data_for_csv["dataset_description"]  = $metadata_arr["dataset_description"];
//   }
//   else
//   {
//   	$data_for_csv["dataset_description"]  = $metadata_arr["dataset"];
//   }
  	 
//   $domains[]							= $metadata_arr["domain"];
// //   $data_for_csv["domain"]        		= $metadata_arr["domain"];
//   $data_for_csv["dna_region"] 	 	    = $metadata_arr["dna_region"];
//   $data_for_csv["email"]         		= $metadata_arr["email"];
//   $data_for_csv["env_sample_source_id"]	= $metadata_arr["env_sample_source_id"]; 
//   $data_for_csv["first_name"]    		= $metadata_arr["first_name"];
//   $data_for_csv["funding"]       		= $metadata_arr["funding"];
//   $data_for_csv["insert_size"] 	        = $metadata_arr["insert_size"];
//   $data_for_csv["institution"] 	        = $metadata_arr["institution"] ;
//   $data_for_csv["lane"] 		 		= $metadata_arr["lane"];
//   $data_for_csv["last_name"]     		= $contact_info[0];
//   $data_for_csv["overlap"] 		 	    = $_SESSION["run_info"]["overlap"];
//   $data_for_csv["primer_suite"]  		= get_primer_suite_name($_SESSION["run_info"]["dna_region_0"], $metadata_arr["domain"]);
// //   $data_for_csv["primer_suite_id"] 	    = get_primer_suite_id($_SESSION["run_info"]["dna_region_0"], $metadata_arr["domain"], $db_name, $connection);
//   $data_for_csv["project"] 		 	    = $metadata_arr["project"];
//   $data_for_csv["project_description"]  = $metadata_arr["project_description"];
//   if (isset($metadata_arr["project_title"]) && $metadata_arr["project_title"] != "")
//   {
//   	$data_for_csv["project_title"] 		= $metadata_arr["project_title"];
//   }
//   else
//   {
//   	$data_for_csv["project_title"] 		= $metadata_arr["project"];
//   }  
//   $data_for_csv["read_length"] 	 	    = $_SESSION["run_info"]["read_length"];
//   $data_for_csv["run"]  		 		= $_SESSION["run_info"]["rundate"];
//   $data_for_csv["run_key"] 	     	    = "NNNN" . $metadata_arr["run_key"];
//   $data_for_csv["seq_operator"]  		= $_SESSION["run_info"]["seq_operator"];
//   $data_for_csv["tube_label"] 	 		= $metadata_arr["tube_label"];

//   $lanes[] = $data_for_csv["lane"];
//   $data_all[] = $data_for_csv;
// }

// $csv_creat_errors = validate_data_for_csv($data_all);
// print_blue_message("\$domains");
// print_out($domains);



array_unshift($data_all, $table_headers);
$csv_data = array_to_scv($data_all, false);
// TODO: create directory
// -----
$is_created = array();

$_SESSION["run_info"]["lanes"] = array_unique($lanes);
// print_blue_message("\$metadata_arr[\"domain\"]");
// print_out($metadata_arr["domain"]);
// $domain_letter = $metadata_arr["domain"][0];

// $lane_dom_names = create_lane_dom_names($lanes, $domains);
print_blue_out_message('$_SESSION["csv_content"] from step_subm_metadata_create_csv', $_SESSION["csv_content"]);
$lane_dom_names 		 = create_lane_dom_names($_SESSION["csv_content"]);

print_blue_message("From ". $_SERVER["PHP_SELF"] . "; step_subm_metadata_create_csv");
print_blue_out_message('4) $lane_dom_names', $lane_dom_names);

foreach ($lane_dom_names as $lane_dom_name)
{
//   $lane_name = $lane_num . "_" . $domain_letter;
  $csv_name  = create_csv_name($rundate, $lane_dom_name);
  $file_name = $path_to_csv  . $rundate . "/" . $csv_name;  
  $is_created[$file_name] = create_csv_file($data_all, $file_name);
}

if (check_var($is_created)) {
  ksort($is_created);
  foreach ($is_created as $file_path => $fp)
  {
    print_green_message("$file_path was created");
  }
}
?>