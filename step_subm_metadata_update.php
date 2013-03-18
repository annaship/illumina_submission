<?php 
  print "UUU\n";
  print_r($_POST); /* ...validate and submit stuff... */ 
  get_run_key_by_adaptor($selected_adaptor, $adaptors_full);
  print "TTT";
  
  // $query = "INSERT INTO last_name, first_name, email, institution FROM vampsdev.contact WHERE last_name <> '' ORDER BY last_name";
// $result_contact_full = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_contact_full: ".mysql_error());
// $i = 0;
// while($row = mysql_fetch_row($result_contact_full))
// {
//   $i += 1;
//   $contact_full[$i] = $row[0].', '.$row[1].', '.$row[2].', '.$row[3];
// }
?>