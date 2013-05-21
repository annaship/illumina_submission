<?php
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; insert_metadata");


  $adaptor = $amp_operator = $barcode = $barcode_index = $dataset_id = "";
  $dna_region_id = $file_prefix = $insert_size = $lane = $overlap = $primer_suite_id = ""; 
  $project_id = $read_length = $run_id = $run_key_id = $seq_operator = $tubelabel = "";

    
  if (!$_SESSION['is_local'])
  {
      $connection = $newbpc2_connection;
      $db_name    = "env454";
//     $connection = $vampsdev_connection;
//     $db_name    = "test";

  }
  else
  {
    $connection = $local_mysqli;
    $db_name    = "test";
  }

  print_red_message("From insert_metadata");
  
print_red_message("\$result_metadata_arr = ");
print_out($result_metadata_arr);
print_red_message("\$_SESSION[\"run_info\"] = ");
print_out($_SESSION["run_info"]);

  foreach ($result_metadata_arr as $row_num => $metadata_arr)
  {

    $adaptor 		  = $metadata_arr["adaptor"];
    $amp_operator     = $metadata_arr["amp_operator"];
    $barcode 		  = $metadata_arr["barcode"];
    $barcode_index 	  = $metadata_arr["barcode_index"];
    $dataset_id 	  = get_id($metadata_arr, "dataset", $db_name, $connection); 
    $domain           = $metadata_arr["domain"];
    $dna_region 	  = $_SESSION["run_info"]["dna_region_0"]; 
    $dna_region_id     = get_id($_SESSION['run_info'], "dna_region_0", $db_name, $connection);
//     CAGATC_NNNNGACTC_4
    $file_prefix      = $metadata_arr["barcode_index"] . "_NNNN" . $metadata_arr["run_key"] . "_" . $metadata_arr["lane"];
    $insert_size 	  = $_SESSION["run_info"]["insert_size"];
    $lane 			  = $metadata_arr["lane"];
    $overlap 		  = $_SESSION["run_info"]["overlap"];
    $primer_suite_id  = get_primer_suite_id($dna_region, $domain, $db_name, $connection);
    $project_id       = get_id($metadata_arr, "project", $db_name, $connection); 
    $read_length 	  = $_SESSION["run_info"]["read_length"];
    $run_id 		  = get_id($_SESSION["run_info"], "run", $db_name, $connection);
    $run_key_id 	  = get_id($metadata_arr, "run_key", $db_name, $connection);
    $seq_operator 	  = $_SESSION["run_info"]["seq_operator"];
    $tubelabel 		  = $metadata_arr["tubelabel"];
       
//   TODO: data_owner print by project, not choose
// TODO: insert into vamps subm too! 

    $insert_metadata_query = "INSERT IGNORE INTO " . $db_name . ".run_info_ill
      (adaptor, amp_operator, barcode, barcode_index, dataset_id, 
        dna_region_id, file_prefix, insert_size, lane, overlap, primer_suite_id, 
        project_id, read_length, run_id, run_key_id, seq_operator, tubelabel)
      VALUES (\"$adaptor\", \"$amp_operator\", \"$barcode\", \"$barcode_index\", \"$dataset_id\", 
      \"$dna_region_id\", \"$file_prefix\", \"$insert_size\", \"$lane\", \"$overlap\", \"$primer_suite_id\", 
      \"$project_id\", \"$read_length\", \"$run_id\", \"$run_key_id\", \"$seq_operator\", \"$tubelabel\")
    ";
    
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
//     	tubelabel       = $tubelabel,<br/>
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
   
    if ($new_run_info_ill_id)
    {
      print("==========================================");      
    }
  }
  
//   ====
  include_once 'step_subm_metadata_create_csv.php';
?>