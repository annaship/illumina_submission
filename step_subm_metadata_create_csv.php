<?php 
// include_once("ill_subm_functions.php");
// include_once "ill_subm_filled_variables.php";

/* TODO:
 * 1) csv in _info directory
 * 2) take content and header from insert_metadata
 * 3) download file to a local! machine by button 
 * 
 */
//print csv file
$metadata_csv_good_headers = array("adaptor", "amp_operator", "barcode", "barcode_index", "data_owner", 
        "dataset", "dataset_description", "dna_region", "email", "env_sample_source", "first_name", 
        "funding", "insert_size", "institution", "lane", "last_name", "overlap", "primer_suite", 
        "project", "project_description", "project_title", "read_length", "run", "run_key", "seq_operator", "tubelabel"); 

// print_red_message("\$data_all");
// print_out($result_metadata_arr);
// print_out($_SESSION['run_info']);

// TODO: create array data_all (metadata + run_key) for csv
// take headers from correct metadata
foreach ($result_metadata_arr as $row_num => $metadata_arr)
{
  $contact_info   = array_map('trim', explode(',', $contact_full[$metadata_arr["user"]])); 
  
  $data_for_csv["adaptor"] 		 	    = $metadata_arr["adaptor"];
  $data_for_csv["amp_operator"]         = $metadata_arr["amp_operator"];
  $data_for_csv["barcode"] 		        = $metadata_arr["barcode"];
  $data_for_csv["barcode_index"] 	    = $metadata_arr["barcode_index"];
  $data_for_csv["data_owner"]    	    = $metadata_arr["data_owner"];
  $data_for_csv["dataset"] 	            = $metadata_arr["dataset"];
  $data_for_csv["dataset_description"]  = $metadata_arr["dataset_description"]; 
//   $data_for_csv["domain"]        		= $metadata_arr["domain"];
  $data_for_csv["dna_region"] 	 	    = $_SESSION["run_info"]["dna_region_0"];
  $data_for_csv["email"]         		= $contact_info[2];
  $data_for_csv["env_sample_source"]	= $metadata_arr["env_source_name"]; 
  $data_for_csv["first_name"]    		= $contact_info[1];
  $data_for_csv["funding"]       		= $metadata_arr["funding"];
  $data_for_csv["file_prefix"]   		= $metadata_arr["barcode_index"] . "_NNNN" . $metadata_arr["run_key"] . "_" . $metadata_arr["lane"];
  $data_for_csv["insert_size"] 	        = $_SESSION["run_info"]["insert_size"];
  $data_for_csv["institution"] 	        = $contact_info[3];
  $data_for_csv["lane"] 		 		= $metadata_arr["lane"];
  $data_for_csv["last_name"]     		= $contact_info[0];
  $data_for_csv["overlap"] 		 	    = $_SESSION["run_info"]["overlap"];
  $data_for_csv["primer_suite"]  		= get_primer_suite_name($_SESSION["run_info"]["dna_region_0"], $metadata_arr["domain"]);
//   $data_for_csv["primer_suite_id"] 	    = get_primer_suite_id($_SESSION["run_info"]["dna_region_0"], $metadata_arr["domain"], $db_name, $connection);
  $data_for_csv["project"] 		 	    = $metadata_arr["project"];
  $data_for_csv["project_description"]  = $metadata_arr["project_description"];
  $data_for_csv["project_title"] 		= $metadata_arr["project_title"];
  $data_for_csv["read_length"] 	 	    = $_SESSION["run_info"]["read_length"];
  $data_for_csv["run"]  		 		= $_SESSION["run_info"]["run"];
  $data_for_csv["run_key"] 	     	    = $metadata_arr["run_key"];
  $data_for_csv["seq_operator"]  		= $_SESSION["run_info"]["seq_operator"];
  $data_for_csv["tubelabel"] 	 		= $metadata_arr["tubelabel"];
  
  $data_all[] = $data_for_csv;
}



$table_headers = array("adaptor", "amp_operator", "barcode", "barcode_index", 
    "data_owner", "dataset", "dataset_description", "dna_region", "email", "env_sample_source", 
    "first_name", "funding", "file_prefix", "insert_size", "institution", "lane", "last_name", "overlap", "primer_suite", 
    "project", "project_description", "project_title", "read_length", "run", "run_key", "seq_operator", "tubelabel");

array_unshift($data_all, $table_headers);
$csv_data = array_to_scv($data_all, false);
// TODO: create directory
// -----
$is_created = array();
foreach (array_unique($lanes) as $lane_name)
{
  $csv_name  = create_csv_name($rundate, $lane_name);
  $file_name = $path_to_csv . "/" . $csv_name;
  $is_created[$file_name] = create_csv_file($data_all, $file_name);
}

if (check_var($is_created)) {
  ksort($is_created);
  foreach ($is_created as $file_path => $fp)
  {
    print_red_message("$file_path was created");
  }
}
?>