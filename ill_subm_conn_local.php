<?php 
  $local_mysqli = new mysqli("localhost", "root", "", "test");
  if ($local_mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $local_mysqli->connect_errno . ") " . $local_mysqli->connect_error;
  }
  
//   echo $local_mysqli->host_info . "<br/>from conn_local";
?>
