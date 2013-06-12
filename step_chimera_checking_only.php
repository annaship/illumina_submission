<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	echo "<h2>Chimera checking</h2>";
	$pipeline_command = "illumina_chimera_only";
	
	include_once("steps_command_line.php");
	
	echo "
			<br/>
      		<br/>
      		<p>
	            This command line(s) should be run on <strong>grendel</strong>:
	          </p>
	        ";
	include_once("steps_command_line_print.php");
	

?>
	
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
