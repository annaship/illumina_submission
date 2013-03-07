<?php
include_once 'ill_subm_conn_local.php';

$docroot = $_SESSION['docroot'];
$csvroot = "../$docroot/data/";
$selected_overlap = $selected_contact_full = $selected_domain = $selected_lane = $selected_data_owner = $selected_run_key = $selected_barcode_index = $selected_project = $selected_dataset = $selected_dataset_description = $selected_env_source_name = $selected_tubelabel = $selected_barcode = $selected_adaptor = $selected_amp_operator = "";

$arr_fields_headers = array("domain", "lane", "data_owner", "run_key", "barcode_index", "project", "dataset", "dataset_description", "env_source_name",
    "tubelabel", "barcode", "adaptor", "amp_operator");

$project_form_fields = array(
    "project_name1" => "required", "project_name2" => "required", "domain" => "select",
    "dna_region" => "select", "project_title" => "optional", "project_description" => "optional",
    "funding" => "optional", "project_form_contact" => "select"
);

// ---
$i = 0;
if (($handle = fopen("$csvroot/project.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $i += 1;
      $project[$i] = $data[0];
    }
    // print_r($contact);
    fclose($handle);
}
// ---
$query = "SELECT DISTINCT user, first_name, last_name, active, security_level, email, institution, id, date_added
FROM vamps_auth ORDER BY last_name ASC";

$res = $local_mysqli->query($query);

echo "From filled_ver_loc...<br/>";
$i = 0;
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
  $i += 1;
  $res->data_seek($row_no);
  $row = $res->fetch_assoc();
  $contact[$i]      = $row['last_name'].', '.$row['first_name'];
  $contact_full[$row['user']] = $row['last_name'].', '.$row['first_name'].', '.$row['email'].', '.$row['institution'];
}

// ---

$arr_fields_add = array("tubelabel", "barcode", "adaptor", "amp_operator");

$arr_fields_run = array("seq_operator", "insert_size", "read_length");
// ---
$i = 0;
if (($handle = fopen("$csvroot/env_source_name.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $i += 1;
      $env_source_names[$i] = $data[0];
    }
    // print_r($contact);
    fclose($handle);
}

// ---

$i = 0;
if (($handle = fopen("$csvroot/overlap.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $i += 1;
      $overlaps[$i] = $data[0];
    }
    // print_r($contact);
    fclose($handle);
}

// ---
if (!isset($project_errors))
{
	$project_errors = array();
}
if (!isset($project_results))
{
	$project_results = array();
}


?>
