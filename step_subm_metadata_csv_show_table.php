<?php 
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; metadata_csv_show_table");

// print "\$_POST:";
// print_out($_POST);
// print "\$_SERVER:";
// print_out($_SERVER);
// print "\$_SESSION:";
// print_out($_SESSION);
// print "\$contact:";
// print_blue_out_message('$contact', $contact);


if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
{
	$connection = $local_mysqli_env454;
	$db_name = "test_env454";
}
else
{
	$connection = $newbpc2_connection;
	$db_name    = "env454";
	//     $connection = $vampsdev_connection;
	//     $db_name    = "test";
}

?>
<form method="post" name="subm_metadata_upload_form" id="subm_metadata_upload_form" action="<?php echo $_SERVER["PHP_SELF"]?>">
<div id="subm_metadata_upload">
  <fieldset id="subm_metadata_upload">
    <legend id="subm_metadata_upload-legend">Submission metadata</legend>
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
/*
UUU -Array ( [jreveillaud556288] => Array ( [id] => 515 [submit_code] => jreveillaud556288 
[user] => jreveillaud [last_name] => Reveillaud [first_name] => Julie [email] => julie.reveillaud@ugent.be 
[institution] => MBL [temp_project] => JCR_SP [title] => sponge microbiome 
[project_description] => Microbial diversity within sponge species Hexadella sp [environment] => host associated [env_source_id] => 30 
[funding] => [num_of_tubes] => 6 [date_initial] => 2012-03-13 [date_updated] => 2012-03-13 [locked] => 1 ) ) --
*/		  $row_num = 0;
//           		print_blue_out_message('$$combined_metadata  = ', $combined_metadata);
//           print_blue_out_message('3) metadata_csv_show_table: $combined_metadata', $combined_metadata);
          
          foreach ($combined_metadata as $metadata_row) {
			
              $selected_adaptor				= $metadata_row["adaptor"];
              $selected_amp_operator		= $metadata_row["amp_operator"];
              $selected_barcode				= $metadata_row["barcode"];
              $selected_barcode_index		= $metadata_row["barcode_index"];
              $selected_user   			    = $metadata_row["user"];              
              $selected_contact_name		= $metadata_row["contact_name"];
              $selected_dataset				= $metadata_row["dataset"];
              $selected_dataset_description	= $metadata_row["dataset_description"];
              $selected_domain				= $metadata_row["domain"];
              $selected_env_source_name		= $metadata_row["env_source_name"];
              $selected_funding				= $metadata_row["funding"];
              $selected_lane				= $metadata_row["lane"];
              $selected_project				= $metadata_row["project"];
              $selected_project_description	= $metadata_row["project_description"];
			  $selected_run_key				= $metadata_row["run_key"];              
              $selected_tubelabel			= $metadata_row["tubelabel"];
              include 'step_subm_metadata_form_metadata_table_rows.php';
//            dinamically add row number to any field name
              $row_num++;
              
         }       
        ?>   
        </tbody>
    </table>
  </fieldset>
  <input type="submit" name="update" id="form_update_from_csv" value="Create submission metadata file"/> 
  <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
  <input type="hidden" name="subm_metadata_upload_process" value="1">
  
  </div>
</form>