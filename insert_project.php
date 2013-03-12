<?php
//   print_r($_POST);
$env_source_name = $_POST['env_source_name'];
$env_sample_source_id = get_env_sample_source_id($env_source_name, $env_source_names);

if ($_SESSION['is_local'])
{
  $contact_id = get_contact_id($contact_full);
  
  $project_name = $_POST['project_name1'] . "_" . $_POST['project_name2'] . "_" . $_POST['domain'] . $_POST['dna_region'];
  $title      = $_POST['project_title'];
  
  $project_query = "INSERT INTO project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id) 
                    VALUES (\"$project_name\", \"$title\", \"$_POST[project_description]\", REVERSE(\"$project_name\"), \"$_POST[funding]\", 
                      $env_sample_source_id, $contact_id)";
    
  if (check_var($project_errors) == 0)
  {
  	$res = $local_mysqli->query($project_query);
  	$project_id = $local_mysqli->insert_id;
  	printf ("<br/>New project record has id %d.<br/>", $local_mysqli->insert_id);
  	if (!$_SESSION['is_local'])
  	{
  	  $connection = $newbpc2_connection;
  	}
  	else
  	{
  	  $connection = $local_mysqli;
  	}
  	
  	$project = get_all_projects($connection);
  	$selected_project    = $project_name;  
//   	print_out($contact_full);
//   	$selected_data_owner = ;
  	$selected_domain     = $_POST['domain'];
//  TODO: add 	$selected_data_owner to use in subm table;  	 
  }
}
else
{
  $contact_id = get_contact_id($contact_full);
  
  $project_name = $_POST['project_name1'] . "_" . $_POST['project_name2'] . "_" . $_POST['domain'] . $_POST['dna_region'];
  $title      = $_POST['project_title'];
  $project_query = "INSERT INTO project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id)
  VALUES (\"$project_name\", \"$title\", \"$_POST[project_description]\", REVERSE(\"$project_name\"), \"$_POST[funding]\",
          $env_sample_source_id, $contact_id)";
  
  print_out($project_query);
}

?>