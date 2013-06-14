<?php 
	print_blue_message("From ". $_SERVER["PHP_SELF"] . "; subm_meta_selected");
    print_out($_POST);
    
    if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
    {
    	$connection = $local_mysqli;
    	$db_name    = "test";
    }
    else
    {
    	$connection = $newbpc2_connection;
    	$db_name    = "env454";
    	//     $connection = $vampsdev_connection;
    	//     $db_name    = "test";
    }    
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
// 			print_blue_out_message('$_SESSION', $_SESSION);

			          

// 			renew $combined_metadata
			foreach ($combined_metadata as $num => $combined_metadata_arr)
			{
				print_blue_out_message('$separate_post_val[$num]', $separate_post_val[$num]);
					
				$separate_post_val[$num] = populate_key_ind($separate_post_val[$num], $adaptors_full, $_SESSION["run_info"]["dna_region_0"], $db_name, $connection);
				
				foreach ($combined_metadata_arr as $field_name => $filed_value)
				{
// 					print_blue_out_message('$field_name', $field_name);
// 					print_blue_out_message('$filed_value', $filed_value);
// 					print_blue_out_message('$separate_post_val[$num][$field_name]', $separate_post_val[$num][$field_name]);
					$combined_metadata[$num][$field_name] = $separate_post_val[$num][$field_name];
						
				}
			}
			
			
//           foreach ($_POST as )
          foreach ($combined_metadata as $num_key => $selected_metadata_arr1)
          {
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
    <?php 
    	print_blue_out_message('submission_metadata_selected_process: $combined_metadata', $combined_metadata);
    ?>
  </fieldset>
  <input type="submit" name="update" id="form_update_selected" value="Update submission metadata file"/> 
  <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
  <input type="hidden" name="submission_metadata_selected_process" value="1">
  </div>
</form>
