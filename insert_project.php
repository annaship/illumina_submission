<?php
// if(!isset($_SESSION)) {
//   session_start();
// }
if ($_SESSION['is_local'])
{
  print_r($_POST);
//   print_r($contact_env454);

  
  $env_sample_source_id = get_env_sample_source_id($_POST['project_form_env_source']);
  $contact_id = get_contact_id($contact_full);
  
  $project    = $_POST['project_name1'] . "_" . $_POST['project_name2'] . "_" . $_POST['domain'] . $_POST['dna_region'];
  $title      = $_POST['project_title'];
  // $env_sample_source_id = get_env_source_id($_POST[$env_sample_source]);
  // $contact_id = get_contact_id($_POST[project_form_contact]);
  // , project_description, rev_project_name, funding, env_sample_source_id, contact_id
//   $env_sample_source_id = "";
  $project_query = "INSERT INTO project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id) 
                    VALUES (\"$project\", \"$title\", \"$_POST[project_description]\", REVERSE(\"$project\"), \"$_POST[funding]\", 
                      $env_sample_source_id, $contact_id)";
  
  print "<br>";
  print($project_query);
  print "<br>";
  
//   require 'ill_subm_conn_local.php';
  $res = $local_mysqli->query($project_query);
  $project_id = $local_mysqli->insert_id;
  printf ("New project record has id %d.\n", $local_mysqli->insert_id);
}

?>