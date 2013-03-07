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
// // ---
// $i = 0;
// if (($handle = fopen("$csvroot/contact.csv", "r")) !== FALSE) {
//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//       $i += 1;
//       $contact[$i] = $data[1].', '.$data[0];
//     }
//     // print_r($contact);
//     fclose($handle);
// }

// // ---
// $i = 0;

// if (($handle = fopen("$csvroot/contact_full.csv", "r")) !== FALSE) {
//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//       $i += 1;
//       $contact_full[$i] = $data[0].', '.$data[1].', '.$data[2].', '.$data[3];
//     }
//     fclose($handle);
// }

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
FROM vamps_auth ORDER BY last_name";
// $result_vamps_user = mysql_query($query, $vampsprod_connection) or die("SELECT Error: $result_vamps_user: ".mysql_error());
// $i = 0;
// while($row = mysql_fetch_row($result_vamps_user))
// {
//   $i += 1;
//   $contact[$i]      = $row[2].', '.$row[1];
//   $contact_full[$i] = $row[2].', '.$row[1].', '.$row[5].', '.$row[6];
// }


$res = $local_mysqli->query($query);

echo "From filled_ver_loc...<br/>";
$i = 0;
// $contact_env454 = array();
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
  $i += 1;
  $res->data_seek($row_no);
  $row = $res->fetch_assoc();
//   print_r($row);
//   echo " first_name = " . $row['first_name'] . "<br/>";
  $contact[$i]      = $row['last_name'].', '.$row['first_name'];
  $contact_full[$row['user']] = $row['last_name'].', '.$row['first_name'].', '.$row['email'].', '.$row['institution'];
//   $contact_env454[] = $row;
}

// print_r($contact_env454);
// print $contact_env454[0][user];


// $query = "Select * from contact limit 5";

// $query = "SELCET * from contact limit 5";

// $res = $local_mysqli->query("Select * from contact where contact, email, institution, vamps_name, first_name, last_name");

// echo "From filled_ver_loc...<br/>";
// for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
//   $res->data_seek($row_no);
//   $row = $res->fetch_assoc();
//   print_r($row);
//   echo " contact = " . $row['contact'] . "<br/>";
// }

// $res = $local_mysqli->query($query);

// echo "From filled_ver_loc...<br/>";
// for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
//   $res->data_seek($row_no);
//   $row = $res->fetch_assoc();
//   print_r($row);
//   echo " contact = " . $row['contact'] . "<br/>";
// }

// ---
// Get contact_id from env454 or local.test
// $email       = "kjvenkat@jpl.nasa.gov";
// $institution = "JPL";
// $vamps_name  = "jpl";
// $first_name  = "Kasthuri";
// $last_name   = "Venkateswaran";
// $query = "SELECT * FROM contact WHERE email = \"" . $email . "\" AND
// institution = \"" . $institution . "\" AND
// vamps_name = \"" . $vamps_name . "\" AND
// first_name = \"" . $first_name . "\" AND
// last_name = \"" . $last_name . "\"";
// print $query;
// print "<br/>";
// $res = $local_mysqli->query($query);

// echo "From filled_ver_loc...<br/>";
// for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
//   $res->data_seek($row_no);
//   $row = $res->fetch_assoc();
//   print_r($row);
//   echo " contact = " . $row['contact'] . "<br/>";
//   echo " contact_id = " . $row['contact_id'] . "<br/>";
// }

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
