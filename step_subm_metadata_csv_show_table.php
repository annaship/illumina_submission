<?php 
// print_red_message("From metadata_csv_show_table");

// print "\$_POST:";
// print_out($_POST);
// // print "\$_SERVER:";
// // print_out($_SERVER);
// print "\$_SESSION:";
// print_out($_SESSION);


if (isset($_SESSION["csv_content"])) {
	$csv_metadata = $_SESSION["csv_content"];
}
if (isset($_SESSION["vamps_submissions_arr"])) {
	$vamps_submissions_arr = $_SESSION["vamps_submissions_arr"];
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
          foreach ($csv_metadata as $csv_metadata_row) {
//           	print_red_message("\$csv_metadata_row");
//           	print_out($csv_metadata_row);
//           	print_red_message("\$vamps_submissions_arr");
//           	print_out($vamps_submissions_arr);
          	
              $selected_adaptor				= add_zero(strtoupper($csv_metadata_row["adaptor"]));
//               print_red_message("\$selected_adaptor = $selected_adaptor");
              $selected_amp_operator		= $csv_metadata_row["op_amp"];
              $selected_barcode				= $csv_metadata_row["barcode"];
              $selected_barcode_index		= $csv_metadata_row["barcode_index"];
              $selected_user   			    = $vamps_submissions_arr[$csv_metadata_row["submit_code"]]["user"];              
              $selected_data_owner			= $contact[$vamps_submissions_arr[$csv_metadata_row["submit_code"]]["user"]];
              $selected_dataset				= $csv_metadata_row["dataset_name"];
              $selected_dataset_description	= $csv_metadata_row["tube_description"];
              $selected_domain				= get_domain_from_csv_data($csv_metadata_row["domain"], $domains_array);
              $selected_env_source_name		= $vamps_submissions_arr[$csv_metadata_row["submit_code"]]["environment"];
              $selected_funding				= $vamps_submissions_arr[$csv_metadata_row["submit_code"]]["funding"];
              $selected_lane				= $csv_metadata_row["lane"];
              $selected_project				= $csv_metadata_row["project_name"];
              $selected_project_description	= $vamps_submissions_arr[$csv_metadata_row["submit_code"]]["project_description"];
              $selected_project_title		= $vamps_submissions_arr[$csv_metadata_row["submit_code"]]["project_title"];
              $selected_run_key				= $csv_metadata_row["run_key"];
              $selected_tubelabel			= $csv_metadata_row["tube_label"];
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