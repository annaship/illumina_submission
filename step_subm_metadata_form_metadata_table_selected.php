<?php 
print_blue_message("From ". $_SERVER["PHP_SELF"] . "; subm_meta_selected");
    print_out($_POST);
?>
            
<form method="post" name="submission_metadata_selected_form" id="submission_metadata_selected_form" action="step_upload_subm_metadata.php">
<div id="submission_metadata">
  <fieldset id="submission_metadata">
    <legend id="submission_metadata-legend">Submission metadata</legend>
    <table id="submission_metadata-fields">
      <thead>
        <tr>
          <?php 
            foreach ($arr_fields_headers as &$value) 
            {
              echo "
              <th>".$value."</th>
              ";              
            }
            unset($value); // break the reference with the last element          
          ?>      
          </tr>
        </thead>
        <tbody>   
          <?php
			$row_num = 0;
			$separate_post_val = separate_post_vars($_POST);
			print_blue_out_message('$separate_post_val', $separate_post_val);
			          
//           foreach ($_POST as )
          foreach ($separate_post_val as $num_key => $selected_metadata_arr1)
          {
          	
          	$key_ind = get_run_key_by_adaptor($selected_metadata_arr1["adaptor"], $selected_metadata_arr1["domain"], $adaptors_full, $selected_dna_region_base);
          	$selected_metadata_arr1["barcode_index"] 		= $key_ind["illumina_index"];
          	$selected_metadata_arr1["run_key"]       		= $key_ind["illumina_run_key"];
          	$selected_metadata_arr1["run_key_id"] 	  		= get_id($separate_post_val[$num_key], "run_key", $db_name, $connection);
          	$selected_metadata_arr1["file_prefix"]      	= $key_ind["illumina_index"] . "_NNNN" . $key_ind["illumina_run_key"] . "_" . $csv_metadata_row["lane"];
          	
          	
//           	print_blue_out_message('$selected_metadata_arr1', $selected_metadata_arr1);
            if(isset($selected_metadata_arr1["domain"]))
            {
              foreach($selected_metadata_arr1 AS $key => $value)
              {
                ${"selected_" . $key} = $value;
              }
              include("step_subm_metadata_form_metadata_table_rows.php");
              $row_num += 1;
              
            }
            if (isset($metadata_errors_all[$num_key]))
            {
              echo "<tr class=\"even\">";
              foreach ($arr_fields_headers as &$value) 
              {
                echo "<td class=\"message\">";
                if (isset($metadata_errors_all[$num_key][$value]))
                {
                  print $metadata_errors_all[$num_key][$value];
                }
                echo "</td>";
              }
              echo "</tr>";
            }
          }
          
          ?>     
        </tbody>
    </table>
    
  </fieldset>
  <input type="submit" name="update" id="form_update_selected" value="Update submission metadata file"/> 
  <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
  <input type="hidden" name="submission_metadata_selected_process" value="1">
  </div>
</form>
