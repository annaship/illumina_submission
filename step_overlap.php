<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; step_overlap");
	echo "<h2>Demultiplex and overlap reads</h2>";
	include_once("steps_command_line.php");
	
	echo "<h3>Demultiplex Illumina files by index/run_key/lane</h3>";

	$pipeline_command = "illumina_files_demultiplex_only";
		
	server_message("any");
	
	include("steps_command_line_print.php");
	
	echo "<h3>Overlap, filter and unique reads in already demultiplexed files</h3>";
	
	$pipeline_command = "illumina_files";
		
	server_message("cluster");
	include("steps_command_line_print.php");

// 	if (check_var($csv_path_error) == 1)
// 	{
?>

<div id="command_line_print">
	Afterwards you can check the overlap percentage by using
<?php 
	$stat_check_command_name = "take_" . $machine_name . "_stats.py";
// 	$lane_dom_names 		 = create_lane_dom_names($lanes, $domains);
// 	print_blue_out_message('$_SESSION["csv_content"] from step_overlap', $_SESSION["csv_content"]);
// 	$lane_dom_names 		 = create_lane_dom_names($_SESSION["csv_content"]);
// 	print_blue_message("From ". $_SERVER["PHP_SELF"] . "; step_overlap");
// 	print_blue_out_message('03) $lane_dom_names', $lane_dom_names);
	
	foreach ($lane_dom_names as $lane_dom_name)
	{
		$command_line_overlap_check = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
									$lane_dom_name . "/analysis/reads_overlap/; " . $stat_check_command_name . "; date";
		
		print_green_message($command_line_overlap_check);	
	}	
?>
</div>
<?php // }#!$csv_path_error
?>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
