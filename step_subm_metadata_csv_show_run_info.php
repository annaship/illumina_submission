<?php 

  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["run_info_process"] == 1) {
  	include_once 'step_subm_metadata_form_run_info_validation.php';
  }
  include("step_subm_metadata_form_run_info.php");
  $_SESSION["run_info"] = $run_info_results;
?>

