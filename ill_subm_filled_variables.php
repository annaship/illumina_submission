<?php
if(!isset($_SESSION)) { session_start(); } 

if ($_SESSION['is_local'])
{
  include_once 'ill_subm_conn_local.php';  
  $db_name = "test";
  $connection = $local_mysqli;
}

$selected_overlap = $selected_contact_full = $selected_domain = 
	$selected_lane = $selected_data_owner = $selected_run_key = 
	$selected_barcode_index = $selected_project = $selected_dataset = 
	$selected_dataset_description = $selected_env_source_name = 
	$selected_tubelabel = $selected_barcode = $selected_adaptor = 
	$selected_amp_operator = $selected_project_title = 
	$selected_project_description = $selected_funding = "";

$arr_fields_headers = array("domain", "lane", "data_owner", "run_key", "barcode_index", "adaptor", "project", "dataset", "dataset_description", "env_source_name",
    "tubelabel", "barcode", "amp_operator");

$project_form_fields = array(
    "project_name1" => "required", "project_name2" => "required", "domain" => "select",
    "dna_region" => "select", "project_title" => "optional", "project_description" => "optional",
    "funding" => "optional", "env_source_name" => "required", "project_form_contact" => "select"
);

$run_info_form_fields = array("seq_operator" => "required", "insert_size" => "required",  "read_length" => "required");
// ---
$dna_regions = array("v6", "v4v5");
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
if (!$_SESSION['is_local'])
{
  $db_name = "vamps";
}
$query = "SELECT DISTINCT user, first_name, last_name, active, security_level, email, institution, id, date_added
            FROM ". $db_name . ".vamps_auth WHERE last_name <> \"\"";
            
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
// if (!$_SESSION['is_local'])
// {
//   $db_name = "env454";
//   $connection = $newbpc2_connection;
// }
// $query = "SELECT DISTINCT project FROM " . $db_name . ".project WHERE project <> '' ORDER BY project";
// print_out($db_name);
// print_out($query);
// $project = run_select_one_field($query, $connection);
// asort($project);
// if ($_SESSION['is_local'])
// {
if (!$_SESSION['is_local'])
{
  $connection = $newbpc2_connection;
}

  $project = get_all_projects($connection);
  
// }
// else
// {
//   $query = "SELECT DISTINCT project FROM env454.project WHERE project <> '' ORDER BY project";
//   $result_project = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_project: ".mysql_error());
//   $i = 0;
//   while($row = mysql_fetch_row($result_project))
//   {
//     $i += 1;
//     $project[$i] = $row[0];
//   }  
// }
// ---

$arr_fields_add = array("tubelabel", "barcode", "amp_operator");

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
if (!$_SESSION['is_local'])
{
  $db_name = "env454";
  $connection = $newbpc2_connection;
}
$query = "SELECT DISTINCT overlap FROM " . $db_name . ".run_info_ill";

$overlaps = run_select_one_field($query, $connection);

// ---

// $illumina_adaptor_ref 
$query = "select
illumina_adaptor, illumina_index, illumina_run_key, dna_region, domain, illumina_adaptor_id, illumina_index_id, illumina_run_key_id, dna_region_id
FROM " . $db_name . ".illumina_adaptor_ref
JOIN " . $db_name . ".illumina_adaptor USING(illumina_adaptor_id)
JOIN " . $db_name . ".illumina_index USING(illumina_index_id)
JOIN " . $db_name . ".illumina_run_key USING(illumina_run_key_id)
JOIN " . $db_name . ".dna_region USING(dna_region_id)
";
if ($_SESSION['is_local'])
{
  $res_adaptor = $local_mysqli->query($query);
  for ($row_no = $res_adaptor->num_rows - 1; $row_no >= 0; $row_no--) 
  {
    $res_adaptor->data_seek($row_no);
    $row = $res_adaptor->fetch_assoc();
//     print_out($row);
    $adaptors_full[] = array(
        "illumina_adaptor"    => $row["illumina_adaptor"],
        "illumina_index"      => $row["illumina_index"],
        "illumina_run_key"    => $row["illumina_run_key"],
        "dna_region"          => $row["dna_region"],
        "domain"              => $row["domain"],
        "illumina_adaptor_id" => $row["illumina_adaptor_id"],
        "illumina_index_id"   => $row["illumina_index_id"],
        "illumina_run_key_id" => $row["illumina_run_key_id"],
        "dna_region_id"       => $row["dna_region_id"]
    ); 
    $adaptors_all[] = $row["illumina_adaptor"];
    
//     $row["illumina_index"].", ".$row["illumina_run_key"].", 
//       ".$row["dna_region"].", ".$row["domain"].", ".$row["illumina_adaptor_id"].", ".$row["illumina_index_id"].", 
//       ".$row["illumina_run_key_id"].", ".$row["dna_region_id"];    
//     //     $env_source_names[$row["env_sample_source_id"]] = $row["env_source_name"];
  }
  $adaptors = array_unique($adaptors_all);
  asort($adaptors);
  print_out($adaptors_full[0]);
}
else
{
  $res_adaptor = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $res_adaptor: ".mysql_error());
  while($row = mysql_fetch_row($res_adaptor))
  {
    $adaptors[$row[0]] = $row[1];
  }
}
?>