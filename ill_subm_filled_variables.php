<?php

$arr_fields_headers = array("domain", "lane", "data_owner", "run_key", "barcode_index", "project", "dataset", "dataset_description", "env_source_name",
    "tubelabel", "barcode", "adaptor", "amp_operator");

// ---

$query = "SELECT DISTINCT user, first_name, last_name, active, security_level, email, institution, id, date_added
            FROM vamps.vamps_auth ORDER BY last_name";
$result_vamps_user = mysql_query($query, $vampsprod_connection) or die("SELECT Error: $result_vamps_user: ".mysql_error());
$i = 0;
while($row = mysql_fetch_row($result_vamps_user))
{
  $i += 1;
  $contact[$i]      = $row[2].', '.$row[1];
  $contact_full[$i] = $row[2].', '.$row[1].', '.$row[5].', '.$row[6]; 
}
print "<br/>contact: <br/>";
print_r($contact); 
print "<br/>contact: <br/>";
print_r($contact_full);

// ---
$query = "SELECT DISTINCT project FROM env454.project WHERE project <> '' ORDER BY project";
$result_project = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_project: ".mysql_error());
$i = 0;
while($row = mysql_fetch_row($result_project))
{
  $i += 1;
  $project[$i] = $row[0];
}
// ---

$arr_fields_add = array("tubelabel", "barcode", "adaptor", "amp_operator");

$arr_fields_run = array("seq_operator", "insert_size", "read_length");
// ---

$query = "SELECT DISTINCT env_source_name FROM env454.env_sample_source ORDER BY env_source_name";
$result_env_source_name = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_env_source_name: ".mysql_error());
$i = 0;
while($row = mysql_fetch_row($result_env_source_name))
{
  $i += 1;
  $env_source_names[$i] = $row[0];
}
// ---


$query = "SELECT DISTINCT overlap FROM env454.run_info_ill";
$result_overlap = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_overlap: ".mysql_error());
$i = 0;
while($row = mysql_fetch_row($result_overlap))
{
  $i += 1;
  $overlaps[$i] = $row[0];
}
?>