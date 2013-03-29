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

  $adaptor 		  = $metadata_arr["adaptor"];
  $amp_operator   = $metadata_arr["amp_operator"];
  $barcode 		  = $metadata_arr["barcode"];
  $barcode_index  = $metadata_arr["barcode_index"];
  $data_owner     = get_data_owner("");
  $dataset 	      = $metadata_arr["dataset"];
  $dataset_description = ""; 
  $domain         = $metadata_arr["domain"];
  $dna_region 	  = $_SESSION["run_info"]["dna_region_0"];
  $email = "";
  $env_sample_source = ""; 
  $first_name = "";
  $funding = "";
  $file_prefix    = $metadata_arr["barcode_index"] . "_NNNN" . $metadata_arr["run_key"] . "_" . $metadata_arr["lane"];
  $insert_size 	  = $_SESSION["run_info"]["insert_size"];
  $lane 		  = $metadata_arr["lane"];
  $last_name = "";
  $overlap 		  = $_SESSION["run_info"]["overlap"];
  $primer_suite = "";
  $primer_suite_id  = get_primer_suite_id($dna_region, $domain, $db_name, $connection);
  $project 		  = $metadata_arr["project"];
  $project_description = "";
  $project_title = "";
  $read_length 	  = $_SESSION["run_info"]["read_length"];
  $run  		  = $_SESSION["run_info"]["run"];
  $run_key 	      = $metadata_arr["run_key"];
  $seq_operator   = $_SESSION["run_info"]["seq_operator"];
  $tubelabel 	  = $metadata_arr["tubelabel"];

}


// array_unshift($data_all, $table_headers);

// print_red_message("\$data_all; \$table_headers");
// print_out($data_all);
// print_out($table_headers);

//           $csv_data = array_to_scv($data_all, false);

//           print_red_message("\$data_all");
//           print_out($csv_data);

// $dir = dirname(__FILE__);
//           print_out($dir);

// $file_name = "/usr/local/tmp/table_result_ill1.csv";
// TODO: create directory
// -----
foreach ($lanes as $lane_name)
{
  $csv_name = create_csv_name($rundate, $lane_name);
  //           "metadata_" . $rundate . "_" . $lane_name . ".csv";
  $file_name = $path_to_csv . "/" . $csv_name;

//   print_out($file_name);
//   $file_name = "/usr/local/tmp/table_result_ill11.csv";
//     $file_name = "/xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20120315/table_result_ill.csv";
//   print_out($file_name);

//   $data_all = array();
  create_csv_file($data_all, $file_name);
}
// -----
//           $fh = fopen($myFile, 'w') or die("Can't open file");
//           fwrite($fh, $csv_data);
//           fclose($fh);
// print_out("HERE");

?>