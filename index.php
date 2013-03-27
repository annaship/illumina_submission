<?php
// $local_mysqli = new mysqli("localhost", "root", "", "test");
// if ($local_mysqli->connect_errno) {
//   echo "Failed to connect to MySQL: (" . $local_mysqli->connect_errno . ") " . $local_mysqli->connect_error;
// }
// $query = "Select * from contact limit 5";


// $res = $local_mysqli->query("Select * from contact limit 5");

// echo "Reverse order...\n";
// for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
//   $res->data_seek($row_no);
//   $row = $res->fetch_assoc();
//   print_r($row);
//   echo " contact = " . $row['contact'] . "<br/>";
// }


session_start();
$_SESSION['cur_user'] = get_current_user();
$_SESSION["run_info"] = array();

if ($_SERVER['SERVER_NAME'] == "localhost")
{
  $_SESSION['is_local'] = True;
  $_SESSION['docroot']  = "/illumina_submission_site_local_add";
  
  include_once("ill_subm_index_local.php");
  
}
else
{
  $_SESSION['is_local'] = False;
  include_once("ill_subm_index.php");
}
?>