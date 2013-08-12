<?php include("ill_subm_beginning.php"); ?>
<?php include_once "ill_subm_filled_variables.php"; ?>

<h1>Illumina files processing</h1>
<?php 
  include_once("ill_subm_menu.php"); 
  include_once("step_upload_csv_instruction.php");
?>

<div id = "csv_load">
<form action="step_upload_subm_metadata.php" method="POST" enctype="multipart/form-data" name="form_upload_csv" id="form_upload_csv">
  Upload this file: <input name="csv" type="file" id="csv"/>
  <input type="submit" name="Submit" value="Submit" />
  <input type="hidden" name="upload_file_step" value="1">  
</form> 
</div>

<?php 
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; upload_subm_metadata");

// print_blue_message("\$_POST");
// print_out($_POST);
// print_blue_message("\$_SERVER");
// print_out($_SERVER);
// print_blue_message("\$_SESSION[run_info_valid]");
// print_out($_SESSION["run_info_valid"]);

if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
{
	$connection_env454 = $local_mysqli_env454;
	$db_name_env454    = "test_env454";
	$connection_vamps  = $local_mysqli_vamps;
	$db_name_vamps     = "test_vamps";
}
else
{
	$connection_env454 = $newbpc2_connection;
	$db_name_env454    = "env454";
	$connection_vamps  = $vampsprod_connection_r;
	$db_name_vamps     = "vamps";
}
?>

<div>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload_file_step"]) && $_POST["upload_file_step"] == 1)
  {
    include_once 'step_subm_metadata_get_csv_info.php';
  	$_SESSION["run_info_valid"] = 0;
  }

  //1) show only run_info and submit run_info
  //2) verify run_info
  
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["run_info_process"]) && $_POST["run_info_process"] == 1) {
  	include_once 'step_subm_metadata_form_run_info_validation.php';
  }
   //print_blue_message("\$_POST");
   //print_out(sizeof($_POST));
  if (sizeof($_POST))
  {
  	include("step_subm_metadata_form_run_info.php");
  }
  
  $show_class = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["project_process"]) && $_POST["project_process"] == 1) {
  	$show_class = "show_block";
  
  	include_once 'step_subm_metadata_form_project_validation.php';
  }
  
  ?>
            
      <br />
      <input type="button" value="Add new project" class="hide_project" />
      
      <table>
           <tr style="display:none;" class="hide_project_tr <?php echo $show_class; ?>">
             <td colspan="3">
               <?php include("step_subm_metadata_form_project.php"); ?>                 
          </td>
        </tr>
      </table>
      <br />
      
  <?php
//   print_blue_message("\$_SESSION");
//   print_out($_SESSION);
  $submission_tubes_id_arr     = get_submission_tubes_ids($_SESSION["csv_content"]);
//   $vamps_submissions_tubes_arr = get_tubes_info_by_submit_code($submission_tubes_id_arr, $vamps_submission_tubes_info, $db_name, $connection);
// 	print_blue_out_message('$vamps_submissions_tubes_arr', $vamps_submissions_tubes_arr); 
// 	print_blue_out_message('$submission_tubes_id_arr', $submission_tubes_id_arr);
	
  if (isset($submission_tubes_id_arr) && !empty($submission_tubes_id_arr))
  {
  	$submission_tubes_info_by_id = get_tubes_info_by_submit_code_by_id($submission_tubes_id_arr, $db_name_vamps, $connection_vamps);
  }
	  
  if (isset($submission_tubes_info_by_id) && !empty($submission_tubes_info_by_id))
  {
  	 
  	$combined_metadata = combine_metadata($_SESSION, $contact_full, $domains_array, $adaptors_full, $submission_tubes_info_by_id, $env_source_names, $db_name_env454, $connection_env454, $db_name_vamps, $connection_vamps);  	 
  }
  
  //3) show table
  if (isset($_SESSION["run_info_valid"]) && $_SESSION["run_info_valid"] == 1
  		&& !(isset($_POST["subm_metadata_upload_process"]) && $_POST["subm_metadata_upload_process"] == 1)
		&& !(isset($_POST["submission_metadata_selected_process"]) && $_POST["submission_metadata_selected_process"] == 1)
		&& sizeof($_POST)
	)
  {
  	 
  	include_once 'step_subm_metadata_csv_show_table.php';
  }

  //4) create csv
//   phpinfo();
  if ($_SERVER["REQUEST_METHOD"] == "POST" && 
  (
	(isset($_POST["subm_metadata_upload_process"])         && $_POST["subm_metadata_upload_process"] == 1)
 || 
	(isset($_POST["submission_metadata_selected_process"]) && $_POST["submission_metadata_selected_process"] == 1)
  )
) 
  {
//   	print_blue_message("2a) step_upload_subm_metadata before step_subm_metadata_form_submission_metadata_validation.php, \$combined_metadata");
//   	print_blue_out_message('$combined_metadata', $combined_metadata);
//   	print_blue_out_message('$_POST', $_POST);
  	//   	error_reporting(E_ALL);
//   	ini_set('max_execution_time', 300);
// 	print_blue_message("HERE11");
  	include_once 'step_subm_metadata_form_submission_metadata_validation.php';  	 
// 	print_blue_message("HERE12");
  }
  
?>
</div>
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
