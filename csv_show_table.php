<?php 
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
  
  include_once 'step_subm_metadata_form_run_info.php';
  $_SESSION["run_info"] = $run_info_results;
?>

<form method="post" name="subm_metadata_upload_form" id="subm_metadata_upload_form" action="step_subm_metadata.php">
<div id="subm_metadata_upload">
  <fieldset id="subm_metadata_upload">
    <legend id="subm_metadata_upload-legend">Submition metadata</legend>
    <table id="subm_metadata_upload-fields">

    <?php 
      echo "
      <thead>
        <tr>";
      foreach ($arr_fields_headers as &$value) 
      {
        echo '
        <th>'.$value.'</th>
        ';  
          
      }
          unset($value); // break the reference with the last element
          echo "
            </tr>
          </thead>";
          ?>      

        <tbody>   
          <tr>
          <?php 


          foreach ($csv_metadata as $csv_metadata_row) {

              $selected_adaptor				= strtoupper($csv_metadata_row["adaptor"]);
              $selected_amp_operator		= $csv_metadata_row["op_amp"];
              $selected_barcode				= $csv_metadata_row["barcode"];
              $selected_barcode_index		= $csv_metadata_row["barcode_index"];
              $selected_user   			    = $vamps_submissions_arr[$csv_metadata_row["submit_code"]]["user"];              
              $selected_data_owner			= $contact[$vamps_submissions_arr[$csv_metadata_row["submit_code"]]["user"]];
              $selected_dataset				= $csv_metadata_row["dataset_name"];
              $selected_dataset_description	= $csv_metadata_row["tube_description"];
              $selected_domain				= get_domain_from_csv_data($csv_metadata_row["domain"], $domains_array);
              $selected_env_source_name		= $vamps_submissions_arr[$csv_metadata_row["submit_code"]]["environment"];
              $selected_funding				= $csv_metadata_row["funding"];
              $selected_lane				= $csv_metadata_row["lane"];
              $selected_project				= $csv_metadata_row["project"];
              $selected_project_description	= $csv_metadata_row["project_description"];
              $selected_project_title		= $csv_metadata_row["project_title"];
              $selected_run_key				= $csv_metadata_row["run_key"];
              $selected_tubelabel			= $csv_metadata_row["tube_label"];
              include 'step_subm_metadata_form_metadata_table_rows.php';
              
              print_red_message($selected_user);
//            dinamically add row number to any field name
              $row_num++;
              
         }       
        ?>   
        </tbody>
    </table>
  </fieldset>
  <input type="submit" name="update" id="form_update_from_csv" value="Check submission metadata"/> 
  <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
  <input type="hidden" name="subm_metadata_upload_process" value="1">
  
  </div>
</form>