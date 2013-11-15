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
// 	print_blue_out_message('$combined_metadata_row', $combined_metadata_row);
	
	
	$result_arr = array_intersect_key($combined_metadata_row, $table_headers_arr);
	$domains[]	= $combined_metadata_row["domain"];
	$lanes[]    = $combined_metadata_row["lane"];
	$result_arr["run_key"] = "NNNN" . $combined_metadata_row["run_key"]; 
	$data_all[] = $result_arr;
	$lane_dom  = $combined_metadata_row["lane"] . "_" . $combined_metadata_row["domain"][0];
	$data_all_dom[$lane_dom][] = $result_arr;
}

// print_blue_out_message('$data_all before unshift', $data_all);
// print_blue_out_message('$data_all after unshift', $data_all);
// $csv_data = array_to_scv($data_all, false);
$is_created = array();

$_SESSION["run_info"]["lanes"] = array_unique($lanes);
// print_blue_out_message('$_SESSION', $_SESSION);

$lane_dom_names 		       = create_lane_dom_names($_SESSION["csv_content"]);

foreach ($lane_dom_names as $lane_dom_name)
{
  array_unshift($data_all_dom[$lane_dom_name], $table_headers); 
  
  $csv_name  = create_csv_name($rundate, $lane_dom_name);
  $file_name = $path_to_csv  . $rundate . "/" . $csv_name;  
  $is_created[$file_name] = create_csv_file($data_all_dom[$lane_dom_name], $file_name);
}

if (check_var($is_created)) {
  ksort($is_created);
  foreach ($is_created as $file_path => $fp)
  {
    print_green_message("$file_path was created");
  }
}
?>