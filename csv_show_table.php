<?php 
  $file_name = $_FILES["csv"]["tmp_name"];
  $csv_data = get_data_from_csv($file_name);
  $row_num = 0;
  $csv_headers_needed = array("adaptor", "barcode", "barcode_index", "data_owner", "dataset_name", "domain", "env_sample_source",
      "lane", "op_amp", "op_empcr", "project_name", "runkey",
      "submit_code", "tube_description", "tube_label");
  
  $csv_headers_run_info_needed = array("dna_region", "insert_size", "op_seq", "overlap", "read_length", "rundate");
  
  $csv_field_names = array_shift($csv_data);
  
  foreach ($csv_data as $csv_data_row) {
    $arr_by_headers_run_info = slice_arr_by_field_name($csv_headers_run_info_needed, $csv_field_names, $csv_data_row);
//     TODO: deal with different dna_regions in one csv
    $run_info_results = array(
        "dna_region_0"	   => $arr_by_headers_run_info["dna_region"],
        "insert_size"	   => $arr_by_headers_run_info["insert_size"],
        "overlap"		   => $arr_by_headers_run_info["overlap"],
        "read_length"	   => $arr_by_headers_run_info["read_length"],
        "rundate"          => $arr_by_headers_run_info["rundate"],
        "seq_operator"	   => $arr_by_headers_run_info["op_seq"],
        "path_to_raw_data" => make_path_to_raw_data($arr_by_headers_run_info["rundate"], $arr_by_headers_run_info["dna_region"])
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
<!--       <thead> -->
<!--         <tr> -->
          <!-- add auto complete -->
          <?php 
//           $field_names = array_shift($csv_data);
//           $field_name = "";
//           foreach ($field_names as $field_name) {
//             echo "
//             <th>".$field_name."</th>
//             ";  
          
//           }
//           unset($field_name); // break the reference with the last element
          
          ?>      
<!--           </tr> -->
<!--         </thead> -->

          <!-- add auto complete -->
          <?php 
          echo "
          <thead>
            <tr>";
          foreach ($arr_fields_headers as &$value) {
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

          
          foreach ($csv_data as $csv_data_row) {
            $arr_by_headers = slice_arr_by_field_name($csv_headers_needed, $csv_field_names, $csv_data_row);
            
              $selected_adaptor				= strtoupper($arr_by_headers["adaptor"]);
              $selected_amp_operator		= $arr_by_headers["op_amp"];
              $selected_barcode				= $arr_by_headers["barcode"];
              $selected_barcode_index		= $arr_by_headers["barcode_index"]; 
              $selected_data_owner			= $contact[$arr_by_headers["data_owner"]];
              $selected_dataset				= $arr_by_headers["dataset_name"];
              $selected_dataset_description	= $arr_by_headers["tube_description"];
              $selected_domain				= get_domain_from_csv_data($arr_by_headers["domain"], $domains_array);
              $selected_env_source_name		= $arr_by_headers["env_sample_source"];
              $selected_funding				= $arr_by_headers["funding"];
              $selected_lane				= $arr_by_headers["lane"];
              $selected_project				= $arr_by_headers["project"];
              $selected_project_description	= $arr_by_headers["project_description"];
              $selected_project_title		= $arr_by_headers["project_title"];
              $selected_run_key				= $arr_by_headers["run_key"];
              $selected_tubelabel			= $arr_by_headers["tube_label"];
              include 'step_subm_metadata_form_metadata_table_rows.php';
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