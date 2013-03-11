<?php
// if(!isset($_SESSION)) {
//   session_start();
// }
if ($_SESSION['is_local'])
{
//   print_r($_POST);
  
  $env_sample_source_id = get_env_sample_source_id($_POST[project_form_env_source]);
  $contact_id  = get_contact_id($contact_full);
  
  $project     = $_POST[project_name1] . "_" . $_POST[project_name2] . "_" . $_POST[domain] . $_POST[dna_region];
  $title       = $_POST[project_title];
  $project_sql = "INSERT INTO project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id) 
                    VALUES (\"$project\", \"$title\", \"$_POST[project_description]\", REVERSE($project), \"$_POST[funding]\", 
                      $env_sample_source_id, $contact_id";
  
//   print "<br>";
//   print($project_sql);
//   print "<br>";
}

?>