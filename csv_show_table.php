<?php 
  $file_name = $_FILES["csv"]["tmp_name"];
  $csv_data = get_data_from_csv($file_name);
  print_out($csv_data);
?>