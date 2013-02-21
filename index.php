<?php
session_start();
if ($_SERVER['SERVER_NAME'] == "localhost")
{
  $_SESSION['is_local'] = True;
  $_SESSION['docroot']  = "/illumina_submission_site_local_add";
  $_SESSION['cur_user'] = get_current_user();
  include_once("ill_subm_index_local.php");
  
}
else
{
  $_SESSION['is_local'] = False;
  include_once("ill_subm_index.php");
}
?>