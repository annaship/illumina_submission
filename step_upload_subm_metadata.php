<?php include("ill_subm_beginning.php"); ?>
<?php include_once "ill_subm_filled_variables.php"; ?>

<h1>Illumina files processing</h1>
<?php include_once("ill_subm_menu.php"); ?>

<form action="step_upload_subm_metadata.php" method="POST" enctype="multipart/form-data" name="form_upload_csv" id="form_upload_csv">
  Upload this file: <input name="csv" type="file" id="csv"/>
  <input type="submit" name="Submit" value="Submit" />
  <input type="hidden" name="upload_file_step" value="1">  
</form> 

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["upload_file_step"] == 1)
  {
    
    print_out($_FILES);   
    include_once 'csv_show_table.php';

  }
?>

      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
