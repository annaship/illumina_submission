<?php
$arr_fields_headers = array("domain", "lane", "data_owner", "run_key", "barcode_index", "project", "dataset", "dataset_description", "env_source_name",
    "tubelabel", "barcode", "adaptor", "amp_operator");

$query = "SELECT DISTINCT first_name, last_name FROM env454.contact WHERE last_name <> '' ORDER BY last_name";
$result_contact = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_contact: ".mysql_error());

$query = "SELECT DISTINCT project FROM env454.project WHERE project <> '' ORDER BY project";
$result_project = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_project: ".mysql_error());

$arr_fields_add = array("tubelabel", "barcode", "adaptor", "amp_operator");

$arr_fields_run = array("seq_operator", "insert_size", "read_length");

$query = "SELECT DISTINCT env_source_name FROM env454.env_sample_source ORDER BY env_source_name";
$result_env_source_name = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_env_source_name: ".mysql_error());

$query = "SELECT DISTINCT overlap FROM env454.run_info_ill";
$result_overlap = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_overlap: ".mysql_error());

?>