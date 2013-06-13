<?php 
  ini_set("auto_detect_line_endings", true);
  $file_name = $_FILES["csv"]["tmp_name"];
  $csv_data = get_data_from_csv($file_name);
  
  $row_num = 0;
  $csv_headers_needed = array("adaptor", "barcode", "barcode_index", "dataset_description", "dataset_name", "dna_region", "domain", 
  		"id", "insert_size", "lane", "op_amp", "op_empcr", "overlap", "project_name", "read_length", "rundate", "runkey",
		"submit_code", "tube_label");
  
  /*
   * all fields on Jun 13 2013
  *
  *  "adaptor", "barcode", "barcode_index", "concentration", "dataset_description", "dataset_name", "date_initial", "date_updated", "direction", "dna_region",
  *  "domain", "duplicate", "enzyme", "id", "insert_size", "lane", "on_vamps", "op_amp", "op_empcr", "op_seq", "overlap", "platform", "pool", "primer_suite",
  *  "project_name", "quant_method", "read_length", "rundate", "runkey", "sample_received", "submit_code", "trim_distal", "tube_label", "tube_number"
  *
  * */
  
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
  
  $submit_code_arr         = get_submit_code($csv_metadata);
  
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
  
   $vamps_submissions_arr             = get_info_by_submit_code($submit_code_arr, $db_name, $connection);
//    $vamps_submissions_arr_full        = get_info_by_submit_code($csv_data_row, $db_name, $connection);
//    print_blue_out_message('$vamps_submissions_arr_full =', $vamps_submissions_arr_full);
    
   $_SESSION["vamps_submissions_arr"] = $vamps_submissions_arr;
   $_SESSION["csv_content"]           = $csv_metadata;
    
    $run_info_results = make_run_info_results($all_csv_run_info);
   
  $_SESSION["run_info"] = $run_info_results;
//   print_blue_message("FROM subm_get_csv");
//   print_out($_SESSION["run_info"]);
?>

