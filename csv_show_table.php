<?php 
  $file_name = $_FILES["csv"]["tmp_name"];
  $csv_data = get_data_from_csv($file_name);
//   print_out($csv_data);
 
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
          $row_num = 0;
          $csv_headers_needed = array("adaptor", "barcode", "barcode_index", "dataset_name", "dna_region", "domain", "insert_size", "lane", 
                                      "op_amp", "op_empcr", "op_seq", "overlap", "project_name", "read_length", "rundate", "runkey", 
                                      "submit_code", "tube_description", "tube_label");
          
          $csv_field_names = array_shift($csv_data);

          foreach ($csv_data as $csv_data_row) {
            $arr_by_headers = slice_arr_by_field_name($csv_headers_needed, $csv_field_names, $csv_data_row);
            
              $selected_adaptor				= strtoupper($arr_by_headers["adaptor"]);
              $selected_amp_operator		= $arr_by_headers["op_amp"];
              $selected_barcode				= $arr_by_headers["barcode"];
              $selected_barcode_index		= $arr_by_headers["barcode_index"];
//               $selected_contact_full		= $arr_by_headers["data_owner"];
// TODO: take contact name by user 
              $selected_data_owner			= $arr_by_headers["data_owner"];
              $selected_dataset				= $arr_by_headers["dataset_name"];
              $selected_dataset_description	= $arr_by_headers["tube_description"];
              $selected_dna_region_base		= $arr_by_headers["dna_region"];
              $selected_domain				= get_domain_from_csv_data($arr_by_headers["domain"], $domains_array);
              $selected_env_source_name		= $arr_by_headers["env_sample_source"];
              $selected_funding				= $arr_by_headers["funding"];
              $selected_insert_size			= $arr_by_headers["insert_size"];
              $selected_lane				= $arr_by_headers["lane"];
              $selected_overlap				= $arr_by_headers["overlap"];
              $selected_project				= $arr_by_headers["project"];
              $selected_project_description	= $arr_by_headers["project_description"];
              $selected_project_title		= $arr_by_headers["project_title"];
              $selected_read_length			= $arr_by_headers["read_length"];
              $selected_run_key				= $arr_by_headers["run_key"];
              $selected_rundate				= $arr_by_headers["run"];
              $selected_seq_operator		= $arr_by_headers["seq_operator"];
              $selected_tubelabel			= $arr_by_headers["tubelabel"];
              include 'step_subm_metadata_form_metadata_table_rows.php';
//            dinamically add row number to any field name
              $row_num++;
          }       
        ?>   
        </tbody>
    </table>
  </fieldset>
  <input type="submit" name="update" id="form_update" value="Check submission metadata"/> 
  <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
  <input type="hidden" name="subm_metadata_upload_process" value="1">
  </div>
</form>