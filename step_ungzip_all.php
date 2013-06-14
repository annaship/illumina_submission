<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");

	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");

	echo "<div id=\"command_line_print\">";
	server_message("any");
	foreach ($lanes as $lane_name)
	{
    	$command_line_gzip = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" . 
        					$lane_name . "/analysis/reads_overlap/; time gunzip *.gz";
        print_green_message($command_line_gzip);        
	}
	echo "</div>";
?>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
