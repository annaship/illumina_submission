<?php 
//download.php from http://www.vijayjoshi.org/2008/11/25/how-to-allow-users-to-download-files-in-php/
//content type
header('Content-type: text/plain');
//open/save dialog box
print "GGGG";
print $_SESSION;
header('Content-Disposition: attachment; filename="metadata.csv"');
//read from server and write to buffer
readfile('/usr/local/tmp/metadata.csv');
?>