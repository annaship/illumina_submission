<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	echo "<h2>Gunzip all files</h2>";
	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");

	echo "<div id=\"command_line_print\">";
	
	server_message("any");

	foreach ($lane_dom_names as $lane_dom_name)
	{
    	$command_line_gunzip = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" . 
        					$lane_dom_name . "/analysis/; time gunzip *.gz";
        print_green_message($command_line_gunzip);        
	}
	echo "</div>";
?>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
