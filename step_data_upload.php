<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	echo "<h2>Data upload to db</h2>";
	$pipeline_command = "env454upload";
	
	include_once("steps_command_line.php");
	server_message("any");
	
	
	include_once("steps_command_line_print.php");
	

?>
	
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
