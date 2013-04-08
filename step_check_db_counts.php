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
// 	include_once("steps_command_line_print.php");
	
?>

<div id="command_line_print">
	check the overlap percentage by using
	
<?php 
	$stat_check_command_name = "take_" . $machine_name . "_stats.py";
	
	foreach ($lanes as $lane_name)
	{
// 		TODO: 'Bacterial V6 Suite'
		$suite_name = "";
		$seq_check = "mysql -h newbpcdb2 env454 -e 'select count(*) from sequence_pdr_info_ill 			
			JOIN run_info_ill using(run_info_ill_id) 			
			JOIN project using(project_id) 			
			JOIN dataset using(dataset_id) 			
			JOIN run using(run_id) 			
			JOIN primer_suite using(primer_suite_id) WHERE primer_suite = \"" . $suite_name . "\" AND run = \"" . $rundate . "\" AND lane = \"" . $lane_name . "\"'";
// 		select count(*) from sequence_pdr_info_ill 
// 			JOIN run_info_ill using(run_info_ill_id) 
// 			JOIN project using(project_id) 
// 			JOIN dataset using(dataset_id) 
// 			JOIN run using(run_id) 
// 			JOIN primer_suite using(primer_suite_id) 
// 			WHERE primer_suite = 'Bacterial V6 Suite' 
// 				AND run = '20130322' 
// 				AND lane = '1'; 

		print_red_message($seq_check);	
	}	
?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
