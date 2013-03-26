<?php
$run_info_results = populate_post_vars($_POST);
if (!isset($_SESSION)) {
  session_start();
  $_SESSION["run_info"] = array();
}
$_SESSION["run_info"] = $run_info_results;
$_SESSION["run_info"]["path_to_raw_data"] = $selected_path_to_raw_data;

?>