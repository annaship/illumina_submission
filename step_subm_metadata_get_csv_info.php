<?php 
  ini_set("auto_detect_line_endings", true);
  $file_name = $_FILES["csv"]["tmp_name"];
  $csv_data = get_data_from_csv($file_name);
  
  $row_num = 0;
  $csv_headers_needed = array("adaptor", "barcode", "barcode_index", "data_owner", "dataset_name", "domain", "env_sample_source",
      "lane", "op_amp", "op_empcr", "project_name", "runkey",
      "submit_code", "tube_description", "tube_label");
  
  $csv_headers_run_info_needed = array("dna_region", "insert_size", "op_seq", "overlap", "read_length", "rundate");
  
//   take fields
  $csv_field_names = array_shift($csv_data);
  
//   create arrays by field_names
  $csv_metadata     = array();
  $all_csv_run_info = array();
  foreach ($csv_data as $csv_data_row)
  {
    $csv_metadata[]     = slice_arr_by_field_name($csv_headers_needed,          $csv_field_names, $csv_data_row);
    $all_csv_run_info[] = slice_arr_by_field_name($csv_headers_run_info_needed, $csv_field_names, $csv_data_row);
  }
  
  $submit_code_arr = get_submit_code($csv_metadata);
  
  if (!$_SESSION['is_local'])
  {
    $connection = $vampsprod_connection;
    $db_name    = "vamps";
  }
  else
  {
    $connection = $local_mysqli;
    $db_name    = "test";
  }
  
   $vamps_submissions_arr = get_info_by_submit_code($submit_code_arr, $db_name, $connection);
   $_SESSION["csv_content"] = $csv_metadata;
   print_red_message("from subm_get_csv");
   print_out($run_info_results);
    
  foreach ($all_csv_run_info as $csv_run_info_row) {
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
    $selected_rundate	= $run_info_results["rundate"];
    $selected_overlap   = $run_info_results["overlap"];
    $selected_path_to_raw_data = $run_info_results["path_to_raw_data"];
  }
  
  $_SESSION["run_info"] = $run_info_results;
//   print_out($_SESSION);
?>

