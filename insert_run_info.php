<?php
$run_info_results = populate_post_vars($_POST);
if (!isset($_SESSION)) {
  session_start();
  $_SESSION['run_info'] = array();
}
$_SESSION['run_info'] = $run_info_results;

?>