<?php
 
$env_source_name = $_POST['env_source_name'];
$env_sample_source_id = get_env_sample_source_id($env_source_name, $env_source_names);
if (!$_SESSION['is_local'])
{
  $connection = $newbpc2_connection;
  $db_name    = "env454";
//   $connection = $vampsdev_connection;
//   $db_name    = "test";
  
}
else
{
  $connection = $local_mysqli;
  $db_name    = "test";
}
print_blue_message("From insert project; \$db_name = $db_name");
var_dump($connection);

$contact_id = get_contact_id($contact_full, $connection);
// var_dump($connection);
print_blue_message("\$contact_id = $contact_id");
// print_out($contact_full);

$project_name = $_POST['project_name1'] . "_" . $_POST['project_name2'] . "_" . $_POST['domain'] . $_POST['dna_region'];
$title      = $_POST['project_title'];

$project_query = "INSERT IGNORE INTO " . $db_name . ".project (project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id)
  VALUES (\"$project_name\", \"$title\", \"$_POST[project_description]\", REVERSE(\"$project_name\"), \"$_POST[funding]\",
  $env_sample_source_id, $contact_id)";

var_dump($connection);
// print_blue_message($db_name);
// print_out($project_query);
print_blue_message("HERE");
print_out($project_errors);
if (check_var($project_errors) == 0)
{
  if ($_SESSION['is_local'])
  {     
  	$res = $local_mysqli->query($project_query);
//   	var_dump($res);
  	$project_id = $local_mysqli->insert_id;
   }
  else
  {
  	print_blue_message("HERE");
  	print_blue_message("\$project_query = $project_query");
  	 
  	set_error_handler("customError", E_USER_ERROR);
  	//   set_error_handler("E_ALL");
//   	$fp = fopen($file_name, 'w') or trigger_error("Can't open $file_name: ", E_USER_ERROR);
/*
 *   if(validate_new_contact($contact_info, $vamps_name) == 0)
  {
    $new_contact_id = run_query($query, "contact");    
  }
  return $new_contact_id;*/
  	

  	
    $res        = mysql_query($project_query, $connection) or trigger_error("Error in insert project: " . E_USER_ERROR);
  	var_dump($res);
    $project_id = mysql_insert_id();
    print_blue_message($project_id);
    
  }

  print_insert_message_by_id("project", $project_id);
  $project = get_all_projects($connection, $db_name);
  $selected_project = $project_name;
  $selected_domain  = $_POST['domain'];  
}
?>