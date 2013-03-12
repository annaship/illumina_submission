<?php
if(!isset($_SESSION)) { session_start(); } 
if ($_SESSION['is_local'])
{
  include_once 'ill_subm_conn_local.php';
  
}
$selected_overlap = $selected_contact_full = $selected_domain = 
	$selected_lane = $selected_data_owner = $selected_run_key = 
	$selected_barcode_index = $selected_project = $selected_dataset = 
	$selected_dataset_description = $selected_env_source_name = 
	$selected_tubelabel = $selected_barcode = $selected_adaptor = 
	$selected_amp_operator = $selected_project_title = 
	$selected_project_description = $selected_funding = "";

$arr_fields_headers = array("domain", "lane", "data_owner", "run_key", "barcode_index", "project", "dataset", "dataset_description", "env_source_name",
    "tubelabel", "barcode", "adaptor", "amp_operator");

$project_form_fields = array(
    "project_name1" => "required", "project_name2" => "required", "domain" => "select",
    "dna_region" => "select", "project_title" => "optional", "project_description" => "optional",
    "funding" => "optional", "env_source_name" => "required", "project_form_contact" => "select"
);
// ---


$arr_fields_to_show = array("project_title", "project_description", "funding");
$arr_project_fields = array("project_name1", "project_name2", "env_source_name");
$arr_to_initialize = array_merge($arr_fields_to_show, $arr_project_fields);

list($project_errors, $project_results) = init_project_var($arr_to_initialize);

if (!isset($selected_dna_region))
{
	$selected_dna_region = "";
}

if (!isset($errors))
{
	$errors = array();
}

// ---
if ($_SESSION['is_local'])
{
  $vamps_auth_table_name = "vamps_auth";
}
else
{
  $vamps_auth_table_name = "vamps.vamps_auth";
}
$query = "SELECT DISTINCT user, first_name, last_name, active, security_level, email, institution, id, date_added
            FROM ". $vamps_auth_table_name . "  WHERE last_name <> \"\"";
            
if ($_SESSION['is_local'])
{
  $res = $local_mysqli->query($query);  
  for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();

    $contact[$row['user']]      = $row['last_name'].', '.$row['first_name'];
    $contact_full[$row['user']] = $row['last_name'].', '.$row['first_name'].', '.$row['email'].', '.$row['institution'];
  }  
}
else
{
  $result_vamps_user = mysql_query($query, $vampsprod_connection) or die("SELECT Error: $result_vamps_user: ".mysql_error());
  while($row = mysql_fetch_row($result_vamps_user))
  {
    $contact[$row[0]]      = $row[2].', '.$row[1];
    $contact_full[$row[0]] = $row[2].', '.$row[1].', '.$row[5].', '.$row[6]; 
  }
}
asort($contact);
asort($contact_full);

// ---
if ($_SESSION['is_local'])
{
  $project = get_all_projects();
  
}
else
{
  $query = "SELECT DISTINCT project FROM env454.project WHERE project <> '' ORDER BY project";
  $result_project = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_project: ".mysql_error());
  $i = 0;
  while($row = mysql_fetch_row($result_project))
  {
    $i += 1;
    $project[$i] = $row[0];
  }  
}
// ---

$arr_fields_add = array("tubelabel", "barcode", "adaptor", "amp_operator");

$arr_fields_run = array("seq_operator", "insert_size", "read_length");
// ---
if ($_SESSION['is_local'])
{
  $env_sample_source_table = "env_sample_source";
}
else
{
  $env_sample_source_table = "env454.env_sample_source";  
}

$query = "SELECT DISTINCT env_sample_source_id, env_source_name FROM " . $env_sample_source_table;
if ($_SESSION['is_local'])
{
  $res_env = $local_mysqli->query($query);
	for ($row_no = $res_env->num_rows - 1; $row_no >= 0; $row_no--) {
		$res_env->data_seek($row_no);
		$row = $res_env->fetch_assoc();
		$env_source_names[$row["env_sample_source_id"]] = $row["env_source_name"];
	}
}
else
{
  $result_env_source_name = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_env_source_name: ".mysql_error());
  while($row = mysql_fetch_row($result_env_source_name))
  {
    $env_source_names[$row[0]] = $row[1];
  }
}
asort($env_source_names);

// ---
if ($_SESSION['is_local'])
{
  $db_name = "test";
  $connection = $local_mysqli;
}
else 
{
  $db_name = "env454";
  $connection = $newbpc2_connection;
}
$query = "SELECT DISTINCT overlap FROM " . $db_name . ".run_info_ill";

$overlaps = run_select_one($query, $connection);

// if ($_SESSION['is_local'])
// {
//   $query = "SELECT DISTINCT overlap FROM run_info_ill";
//   $res_overlap = $local_mysqli->query($query);
// 	for ($row_no = $res_overlap->num_rows - 1; $row_no >= 0; $row_no--) {
// 		$res_overlap->data_seek($row_no);
// 		$row = $res_overlap->fetch_assoc();
// 		$overlaps[] = $row["overlap"];
// 	}
// 	sort($overlaps);
// }
// else
// {
//   $query = "SELECT DISTINCT overlap FROM env454.run_info_ill";
//   $result_overlap = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_overlap: ".mysql_error());
//   $i = 0;
//   while($row = mysql_fetch_row($result_overlap))
//   {
//     $i += 1;
//     $overlaps[$i] = $row[0];
//   }
// }

// ---


?>