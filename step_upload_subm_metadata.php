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
print_blue_message("From ". $_SERVER["PHP_SELF"] . "; upload_subm_metadata");

// print_red_message("\$_POST");
// print_out($_POST);
// print_red_message("\$_SERVER");
// print_out($_SERVER);
// print_red_message("\$_SESSION[run_info_valid]");
// print_out($_SESSION["run_info_valid"]);

?>

<div>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["upload_file_step"] == 1)
  {
    include_once 'step_subm_metadata_get_csv_info.php';
  	$_SESSION["run_info_valid"] = 0;
  }

  //1) show only run_info and submit run_info
  //2) verify run_info
  
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["run_info_process"] == 1) {
  	include_once 'step_subm_metadata_form_run_info_validation.php';
  }
//   print_red_message("\$_POST");
//   print_out(sizeof($_POST));
  if (sizeof($_POST))
  {
  	include("step_subm_metadata_form_run_info.php");
  }
  
  //3) show table
  if (isset($_SESSION["run_info_valid"]) && $_SESSION["run_info_valid"] == 1
  		&& !($_POST["subm_metadata_upload_process"] == 1)
		&& sizeof($_POST)
	)
  {
  	include_once 'step_subm_metadata_csv_show_table.php';
  }  
  //4) create csv
  
  if ($_SERVER["REQUEST_METHOD"] == "POST" && ($_POST["subm_metadata_upload_process"] == 1) || ($_POST["submission_metadata_selected_process"] == 1)) 
  {
//   	print_blue_message("HERE");
  	include_once 'step_subm_metadata_form_submission_metadata_validation.php';  	 
  }
  
?>
</div>
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
