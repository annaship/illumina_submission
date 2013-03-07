<?php
// if(!isset($_SESSION)) {
//   session_start();
// }
if ($_SESSION['is_local'])
{
  print_r($_POST);
//   print_r($contact_env454);

  $contact_id = get_contact_id($contact_full);
  print "contact_id = $contact_id<br/>";
  $project    = $_POST[project_name1] . "_" . $_POST[project_name2] . "_" . $_POST[domain] . $_POST[dna_region];
  $title      = $_POST[project_title];
  // $env_sample_source_id = get_env_source_id($_POST[$env_sample_source]);
  // $contact_id = get_contact_id($_POST[project_form_contact]);
  // , project_description, rev_project_name, funding, env_sample_source_id, contact_id
  $env_sample_source_id = "";
  $project_sql = "INSERT INTO project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id) 
                    VALUES (\"$project\", \"$title\", \"$_POST[project_description]\", REVERSE($project), \"$_POST[funding]\", 
                      $env_sample_source_id, $contact_id";
  
  print "<br>";
  print($project_sql);
  print "<br>";
}
// $sql="INSERT INTO Persons (FirstName, LastName, Age) VALUES ('1', '2', '3')";
// try {
//   if (!mysql_query($sql,$con))
//       {
//       die('Error: ' . mysql_error());
//       }
//     echo "1 record added";
// } catch (Exception $e) {
//   print_r($e);
// }

// VALUES
// ('$_POST[project_name1]', '$_POST[project_name2]', '$_POST[project_title]', '$_POST[project_description]', '$_POST[funding]', '$_POST[age]', '$_POST[age]', '$_POST[contact]')";

// if (!mysql_query($sql,$con))
//   {
//   die('Error: ' . mysql_error());
//   }
// echo "1 record added";

// mysql_close($con);
?>