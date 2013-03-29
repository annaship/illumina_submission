<?php 
//download.php from http://www.vijayjoshi.org/2008/11/25/how-to-allow-users-to-download-files-in-php/
//content type
header('Content-type: text/csv');
//open/save dialog box
// header('Content-Disposition: attachment; filename="table_result_ill.csv"');
header('Content-Disposition: attachment; filename="metadata_20120315_1.csv"');

//read from server and write to buffer
// readfile('/usr/local/tmp/table_result_ill.csv');
// readfile("/xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20120315/check_this.txt")
// readfile("/usr/local/tmp/check_this.txt");
// $my_dir = "/xraid2-2/g454/";
// $my_dir = "/xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/";
$my_dir = "/xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20120315/";

$file_to_read = $my_dir . "metadata_20120315_1.csv";
readfile("$file_to_read");

?>
