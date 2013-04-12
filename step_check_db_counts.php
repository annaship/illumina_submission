<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>

      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	print_blue_message("From ". $_SERVER["PHP_SELF"]);
	
	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");
// 	include_once("steps_command_line_print.php");
	
?>

<div id="command_line_print">
	check the overlap percentage by using
	
<?php 
	$stat_check_command_name = "take_" . $machine_name . "_stats.py";

	$suite_name = "";
	if (isset($run_info_ini))
	{
		$suite_name = get_primer_suite_name($run_info_ini["dna_region"], $run_info_ini["domain"]);			
	}
// 	else
// 	{
// 		print_blue_message("POST");
// 		print_out($_POST);
// 		print_out($_SESSION["run_info"]);
		
// 		if (!$_SESSION['is_local'])
// 		{
// 			//   $connection = $newbpc2_connection;
// 			$connection = $vampsdev_connection;
		
// 		}
// 		else
// 		{
// 			$connection = $local_mysqli;
// 		}		
// 		print_blue_message("HERE");
// 		if (!isset($_POST))
// 		{
// 			$suite_name = get_primer_suite_name_from_db($_POST, $connection);
// 		}
// 		else 
// 		{
// 			$suite_name = get_primer_suite_name_from_db($_SESSION["run_info"], $connection);
// 		}
// 		print_blue_message("HERE1");
		
// // 		SELECT DISTINCT primer_suite, dna_region
// // 		FROM run_info_ill
// // 		JOIN run USING(run_id)
// // 		JOIN dna_region USING(dna_region_id)
// // 		JOIN primer_suite USING(primer_suite_id)
// // 		WHERE
// // 		run = "20120613"
// // 		AND lane = 3
		
		
// 	}
	foreach ($lanes as $lane_name)
	{
// 		TODO: 'Bacterial V6 Suite'
		$seq_check = "mysql -h newbpcdb2 env454 -e 'select count(*) from sequence_pdr_info_ill 			
			JOIN run_info_ill using(run_info_ill_id) 			
			JOIN project using(project_id) 			
			JOIN dataset using(dataset_id) 			
			JOIN run using(run_id) 			
			JOIN primer_suite using(primer_suite_id) WHERE primer_suite = \"" . $suite_name . "\" AND run = \"" . $rundate . "\" AND lane = \"" . $lane_name . "\"'";

		/*
		 select count(*) from run_info_ill
		JOIN project using(project_id)
		JOIN dataset using(dataset_id)
		JOIN run using(run_id)
		JOIN primer_suite using(primer_suite_id)
		WHERE primer_suite = 'Bacterial V6 Suite'
		AND run = '20130322'  and lane = '1';
		*/
		

		print_green_message($seq_check);	
	}	
?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
