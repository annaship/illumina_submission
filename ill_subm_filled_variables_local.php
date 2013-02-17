<?php
$docroot = $_SESSION['docroot'];
$csvroot = "../../$docroot/data/";

$arr_fields_headers = array("domain", "lane", "data_owner", "run_key", "barcode_index", "project", "dataset", "dataset_description", "env_source_name",
    "tubelabel", "barcode", "adaptor", "amp_operator");

// ---
$i = 0;
if (($handle = fopen("$csvroot/contact.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $i += 1;
      $contact[$i] = $data[1].', '.$data[0];
    }
    // print_r($contact);
    fclose($handle);
}

// ---
$i = 0;

if (($handle = fopen("$csvroot/contact_full.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $i += 1;
      $contact_full[$i] = $data[0].', '.$data[1].', '.$data[2].', '.$data[3];
    }
    fclose($handle);
}

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

?>