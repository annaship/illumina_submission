<?php
  print_out("FROM insert metadata");
  print_out($_POST);
  
//   $env_source_name = $_POST['env_source_name'];
//   $env_sample_source_id = get_env_sample_source_id($env_source_name, $env_source_names);
//   if (!$_SESSION['is_local'])
//   {
//     //   $connection = $newbpc2_connection;
//     //   $db_name    = "env454";
//     $connection = $vampsdev_connection;
//     $db_name    = "test";
  
//   }
//   else
//   {
//     $connection = $local_mysqli;
//     $db_name    = "test";
//   }
  
//   $contact_id = get_contact_id($contact_full, $connection);
  
//   $project_name = $_POST['project_name1'] . "_" . $_POST['project_name2'] . "_" . $_POST['domain'] . $_POST['dna_region'];
//   $title      = $_POST['project_title'];
  
//   $project_query = "INSERT IGNORE INTO " . $db_name . ".project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id)
//   VALUES (\"$project_name\", \"$title\", \"$_POST[project_description]\", REVERSE(\"$project_name\"), \"$_POST[funding]\",
//   $env_sample_source_id, $contact_id)";
//   if (check_var($project_errors) == 0)
//   {
//     if ($_SESSION['is_local'])
//     {
//       $res = $local_mysqli->query($project_query);
//       $project_id = $local_mysqli->insert_id;
//     }
//     else
//     {
//       $res        = mysql_query($project_query, $connection) or die("Error in insert project: " . mysql_error());
//       $project_id = mysql_insert_id();
//     }
  
//     print_insert_message_by_id("project", $project_id);
//     $project = get_all_projects($connection, $db_name);
//     $selected_project = $project_name;
//     $selected_domain  = $_POST['domain'];
//   }
?>