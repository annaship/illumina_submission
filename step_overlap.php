<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; step_overlap");
		
	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");
	include_once("steps_command_line_print.php");

// 	if (check_var($csv_path_error) == 1)
// 	{
?>

<div id="command_line_print">
	Afterwards you can check the overlap percentage by using
<?php 
	$stat_check_command_name = "take_" . $machine_name . "_stats.py";
	$lane_dom_names = create_lane_dom_names($lanes, $domains);
	
	foreach ($lane_dom_names as $lane_dom_name)
	{
// 		$lane_name = $lane_num . "_" . $domain_letter;
// 		$csv_name  = create_csv_name($rundate, $lane_dom_name);
	
// 	foreach ($lanes as $lane_num)
// 	{		
// 		$lane_name = $lane_num . "_" . $domain_letter;
// 		$command_line_overlap_check = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
// 									$lane_name . "/analysis/reads_overlap/; " . $stat_check_command_name . "; date";
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
