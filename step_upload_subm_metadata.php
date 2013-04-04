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
  include("step_subm_metadata_form_run_info.php");
  if (isset($_SESSION["run_info_valid"]) && $_SESSION["run_info_valid"] == 1)
  {
  	include_once 'step_subm_metadata_csv_show_table.php';
  	 
  }  
  //3) show table
  //4) create csv
  
?>
</div>
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
