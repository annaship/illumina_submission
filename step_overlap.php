<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
print_red_message("From ". $_SERVER["PHP_SELF"]);
		
	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");

	include_once("steps_command_line_print.php");
	
?>

<div id="command_line_print">
	Afterwards you can check the overlap percentage by using
<?php 
	$stat_check_command_name = "take_" . $machine_name . "_stats.py";
	
	foreach ($lanes as $lane_name)
	{
		$command_line_overlap_check = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
									$lane_name . "/analysis/reads_overlap/; " . $stat_check_command_name . "; date";
		print_red_message($command_line_overlap_check);	
	}	
?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
