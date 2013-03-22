<?php
  print_out("POST FROM insert metadata");
  print_out($_POST);
  
  $adaptor = $amp_operator = $barcode = $barcode_index = $dataset_id = "";
  $dna_region_id = $file_prefix = $insert_size = $lane = $overlap = $primer_suite_id = ""; 
  $project_id = $read_length = $run_id = $run_key_id = $seq_operator = $tubelabel = "";
  
  if (!$_SESSION['is_local'])
  {
    //   $connection = $newbpc2_connection;
    //   $db_name    = "env454";
    $connection = $vampsdev_connection;
    $db_name    = "test";

  }
  else
  {
    $connection = $local_mysqli;
    $db_name    = "test";
  }
  
//   $result_metadata_arr = separate_metadata($_POST, $arr_fields_headers);
  
  print "\$result_metadata_arr";
  print_out($result_metadata_arr);
  if (isset($run_info_results))
  {
    print "\$run_info_results";
    print_out($run_info_results);
  }
  
  foreach ($result_metadata_arr as $row_num => $metadata_arr)
  {
    $adaptor 		  = $metadata_arr["adaptor"];
    $amp_operator     = $metadata_arr["amp_operator"];
    $barcode 		  = $metadata_arr["barcode"];
    $barcode_index 	  = $metadata_arr["barcode_index"];
    $dataset_id 	  = get_dataset_id($metadata_arr["dataset"]);
    $domain           = $metadata_arr["domain"];
//     !!!$dna_region_id 	  = $metadata_arr["AA"];
// TODO: send dna_region, insert_size, overlap, read_length, rundate, seq_operator from run_info; barcode_index, run_key from adaptor to here
    $file_prefix      = $metadata_arr["barcode_index"] . $metadata_arr["run_key"] . $metadata_arr["lane"];
    $insert_size 	  = $metadata_arr["insert_size"];
    $lane 			  = $metadata_arr["lane"];
    $overlap 		  = $metadata_arr["overlap"];
    $primer_suite_id  = get_primer_suite_id($dna_region, $domain);
    $project_id       = get_project_id($metadata_arr["project"]);
//     TODO: add new, if no project
    $read_length 	  = $metadata_arr["read_length"];
    $run_id 		  = get_run_id($metadata_arr["rundate"]);
    $run_key_id 	  = get_run_key_id($metadata_arr["run_key"]);
    $seq_operator 	  = $metadata_arr["seq_operator"];
    $tubelabel 		  = $metadata_arr["tubelabel"];
  
//   TODO: data_owner print by project, not choose

// UUU -Array ( [0] => Array ( [domain] => Bacteria [lane] => 5 [data_owner] => 2010, MicroDiversity [run_key] =>       
//         [barcode_index] => [adaptor] => A02 [project] => AB_HGB1_Bv6v4 [dataset] => dat1 [dataset_description] => dat11 
// [env_source_name] => extreme habitat [tubelabel] => dat111 [barcode] => bar [amp_operator] => amp ) 
// [1] => Array ( [domain] => Bacteria [lane] => 5 [data_owner] => 2010, MicroDiversity [run_key] => [barcode_index] => [adaptor] => A03 [project] => AB_HGB1_Bv6v4 
//         [dataset] => dat1 [dataset_description] => dat11 [env_source_name] => extreme habitat [tubelabel] => dat111 [barcode] => bar [amp_operator] => amp ) ) --    

    $insert_metadata_query = "INSERT IGNORE INTO " . $db_name . ".run_info_ill
      (adaptor, amp_operator, barcode, barcode_index, dataset_id, 
        dna_region_id, file_prefix, insert_size, lane, overlap, primer_suite_id, 
        project_id, read_length, run_id, run_key_id, seq_operator, tubelabel)
      VALUES (\"$adaptor\", \"$amp_operator\", \"$barcode\", \"$barcode_index\", \"$dataset_id\", 
      \"$dna_region_id\", \"$file_prefix\", \"$insert_size\", \"$lane\", \"$overlap\", \"$primer_suite_id\", 
      \"$project_id\", \"$read_length\", \"$run_id\", \"$run_key_id\", \"$seq_operator\", \"$tubelabel\")
    ";
    print_out($insert_metadata_query);
  }
  
  //   $project_query = "INSERT IGNORE INTO " . $db_name . ".project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id)
  //   VALUES (\"$project_name\", \"$title\", \"$_POST[project_description]\", REVERSE(\"$project_name\"), \"$_POST[funding]\",
  //   $env_sample_source_id, $contact_id)";
  
//   $env_source_name = $_POST['env_source_name'];
//   $env_sample_source_id = get_env_sample_source_id($env_source_name, $env_source_names);
//   if (!$_SESSION['is_local'])
//   {
//     //   $connection = $newbpc2_connection;
//     //   $db_name    = "env454";
//     $connection = $vampsdev_connection;
//     $db_name    = "test";
  
//   }
//   else
//   {
//     $connection = $local_mysqli;
//     $db_name    = "test";
//   }
  
//   $contact_id = get_contact_id($contact_full, $connection);
  
//   $project_name = $_POST['project_name1'] . "_" . $_POST['project_name2'] . "_" . $_POST['domain'] . $_POST['dna_region'];
//   $title      = $_POST['project_title'];
  
//   $project_query = "INSERT IGNORE INTO " . $db_name . ".project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id)
//   VALUES (\"$project_name\", \"$title\", \"$_POST[project_description]\", REVERSE(\"$project_name\"), \"$_POST[funding]\",
//   $env_sample_source_id, $contact_id)";
//   if (check_var($project_errors) == 0)
//   {
//     if ($_SESSION['is_local'])
//     {
//       $res = $local_mysqli->query($project_query);
//       $project_id = $local_mysqli->insert_id;
//     }
//     else
//     {
//       $res        = mysql_query($project_query, $connection) or die("Error in insert project: " . mysql_error());
//       $project_id = mysql_insert_id();
//     }
  
//     print_insert_message_by_id("project", $project_id);
//     $project = get_all_projects($connection, $db_name);
//     $selected_project = $project_name;
//     $selected_domain  = $_POST['domain'];
//   }
?>