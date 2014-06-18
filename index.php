<?php
//phpinfo();

session_start();
$_SESSION['cur_user'] = get_current_user();
$_SESSION["run_info"] = array();
$_SESSION["run_info_errors"] = array();

if ($_SERVER['SERVER_NAME'] == "localhost")
{
  $_SESSION['is_local'] = True;
  $_SESSION['docroot']  = "../illumina_submission_site_local_add";
  
  include_once("ill_subm_index_local.php");
  
}
else
{
  $_SESSION['is_local'] = False;
  include_once("ill_subm_index.php");
}
?>