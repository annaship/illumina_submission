<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	echo "<h2>Demultiplex Illumina files by index/run_key/lane</h2>";
	$pipeline_command = "illumina_files_demultiplex_only";
	
	include_once("steps_command_line.php");
	include_once("steps_command_line_print.php");
	

?>
<!-- 	</div> -->
	
<!-- </div> -->
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
<?php include_once("ill_subm_beginning.php"); ?>
       
      <h1>Illumina files processing</h1>
      <?php include_once("ill_subm_menu.php"); ?>

      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
