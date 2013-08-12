<?php
  if(!isset($_SESSION)) {
    session_start();
    $db_name    = "test_env454";
  	$connection = $local_mysqli_env454;
  }

  include_once 'ill_subm_conn_local.php';
//   print "I'm in insert_owner<br/>";
  
  $contact = $owner_results["first_name"] ." ". $owner_results["last_name"]; 
  $sql     = "INSERT INTO " . $db_name . ".contact (contact, email, institution, vamps_name, first_name, last_name)
    VALUES (\"$contact\", \"".$owner_results["email"]."\", \"".$owner_results["institution"]."\", 
      \"".$owner_results["data_owner"]."\", \"".$owner_results["first_name"]."\",
      \"".$owner_results["last_name"]."\"
  )";
  
//   echo 'Current script owner: ' . $_SESSION["cur_user"];
  
  if ($_SESSION["cur_user"] == "ashipunova" AND !$connection->query($sql))
  {
    echo "<br/>--- From insert_owner ---<br/>SQL ($sql) failed: (<strong>" . $connection->errno . ") " . $connection->error."</strong>";
  }
//   print "$sql<br/>";
  ?>