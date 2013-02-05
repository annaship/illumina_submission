<?php
$arr_fields_headers = array("dna_region", "domain", "lane", "data_owner", "run_key", "barcode_index", "project", "dataset", "dataset_description",
    "tubelabel", "barcode", "adaptor", "amp_operator", "seq_operator", "overlap", "insert_size", "read_length");

$query = "SELECT DISTINCT first_name, last_name FROM env454.contact WHERE last_name <> '' ORDER BY last_name";
$result_contact = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_contact: ".mysql_error());

$query = "SELECT DISTINCT project FROM env454.project WHERE project <> '' ORDER BY project";
$result_project = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $result_project: ".mysql_error());

$arr_fields_add = array("tubelabel", "barcode", "adaptor", "amp_operator", "seq_operator", "overlap", "insert_size", "read_length");


?>