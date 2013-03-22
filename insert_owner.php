<?php
  if(!isset($_SESSION)) {
    session_start();
    $db_name = "test";
  }

  include_once 'ill_subm_conn_local.php';
//   print "I'm in insert_owner<br/>";
//   print "data_owner  = ".$owner_results["data_owner"]."</br>
//          first_name  = ".$owner_results["first_name"]."</br>
//          last_name   = ".$owner_results["last_name"]."</br>
//          email       = ".$owner_results["email"]."</br>
//          institution = ".$owner_results["institution"]."</br>";
//   $local_mysqli = new mysqli("localhost", "root", "", "test");
//   echo $local_mysqli->host_info . "\n <br/>from owner<br/>";
  
  if ($local_mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $local_mysqli->connect_errno . ") " . $local_mysqli->connect_error;
  }
  $contact = $owner_results["first_name"] ." ". $owner_results["last_name"]; 
  $sql     = "INSERT INTO " . $db_name . ".contact (contact, email, institution, vamps_name, first_name, last_name)
    VALUES (\"$contact\", \"".$owner_results["email"]."\", \"".$owner_results["institution"]."\", 
      \"".$owner_results["data_owner"]."\", \"".$owner_results["first_name"]."\",
      \"".$owner_results["last_name"]."\"
  )";
  
//   echo 'Current script owner: ' . $_SESSION["cur_user"];
  
  if ($_SESSION["cur_user"] == "ashipunova" AND !$local_mysqli->query($sql))
  {
    echo "<br/>--- From insert_owner ---<br/>SQL ($sql) failed: (<strong>" . $local_mysqli->errno . ") " . $local_mysqli->error."</strong>";
  }
//   print "$sql<br/>";
  ?>