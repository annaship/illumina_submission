<?php 
  $local_mysqli = new mysqli("localhost", "root", "", "test");
  if ($local_mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $local_mysqli->connect_errno . ") " . $local_mysqli->connect_error;
  }

  $vamps_mysqli = new mysqli("vampsdev", "ashipunova", "paul_mac", "vamps");
  if ($vamps_mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $vamps_mysqli->connect_errno . ") " . $vamps_mysqli->connect_error;
  }
  else {
    echo $vamps_mysqli->host_info . "<br/>from conn_local";    
  }
  
//   echo $local_mysqli->host_info . "<br/>from conn_local";
?>
