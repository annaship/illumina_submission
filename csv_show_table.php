<?php 
  $file_name = $_FILES["csv"]["tmp_name"];
  $csv_data = get_data_from_csv($file_name);
//   print_out($csv_data);
 
?>

<!-- <form method="post" name="subm_metadata_upload_form" id="subm_metadata_upload_form" action="step_subm_metadata_upload.php"> -->
<div id="subm_metadata_upload">
  <fieldset id="subm_metadata_upload">
    <legend id="subm_metadata_upload-legend">Submition metadata</legend>
    <table id="subm_metadata_upload-fields">
      <thead>
        <tr>
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
          </tr>
        </thead>
        <tbody>   
          <tr>
          <?php 
          $row_num = 0;
          foreach ($csv_data as $csv_data_row) {
//             echo "<tr>";
//             foreach ($csv_data_row as $csv_data_value)
//             {
              $selected_adaptor				= $csv_data_row["adaptor"];
//               $selected_amp_operator		= $csv_data_row["run"];
              $selected_barcode				= $csv_data_row["barcode"];
              $selected_barcode_index		= $csv_data_row["barcode_index"];
//               $selected_contact_full		= $csv_data_row["data_owner"];
// TODO: take contact name by user 
              $selected_data_owner			= $csv_data_row["data_owner"];
              $selected_dataset				= $csv_data_row["dataset"];
              $selected_dataset_description	= $csv_data_row["dataset_description"];
              $selected_dna_region_base		= $csv_data_row["dna_region"];
//               $selected_domain				= $csv_data_row["run"];
              $selected_env_source_name		= $csv_data_row["env_sample_source"];
              $selected_funding				= $csv_data_row["funding"];
              $selected_insert_size			= $csv_data_row["insert_size"];
              $selected_lane				= $csv_data_row["lane"];
              $selected_overlap				= $csv_data_row["overlap"];
              $selected_project				= $csv_data_row["project"];
              $selected_project_description	= $csv_data_row["project_description"];
              $selected_project_title		= $csv_data_row["project_title"];
              $selected_read_length			= $csv_data_row["read_length"];
              $selected_run_key				= $csv_data_row["run_key"];
              $selected_rundate				= $csv_data_row["run"];
              $selected_seq_operator		= $csv_data_row["seq_operator"];
              $selected_tubelabel			= $csv_data_row["tubelabel"];
              $row_num++;
              include 'step_subm_metadata_form_metadata_table_rows.php';
//               echo "
//               <td>".$csv_data_value."</td>
//               ";
//             }  
//             echo "</tr>";
          }
          unset($field_name); // break the reference with the last element
          
          ?>      
          </tr>
          <?php
          
          
//               $row_num = 0;
          ?>     
        </tbody>
    </table>
<!--   <a href="#" title="" class="add-author">Add Author</a> -->
  </fieldset>
<!--   <input type="submit" name="update" id="form_update" value="Check submission metadata"/>  -->
<!--   <input type="submit" name="cancel" id="form_cancel" value="Cancel"/>  -->
<!--   <input type="hidden" name="subm_metadata_upload_process" value="1"> -->
</div>
<!-- </form> -->