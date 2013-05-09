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
	print_blue_message('$machine_name');
	print_blue_message($machine_name);
	print_blue_message('$domain');
	print_blue_message($domain);
	print_blue_message('$dna_region');
	print_blue_message($dna_region);

	print_blue_message("POST");
	print_out($_POST);
	print_blue_message('$_SESSION["run_info"]');
	print_out($_SESSION["run_info"]);
	print_blue_message('$run_info_ini');
	print_out($run_info_ini);
	
// 	if (isset($run_info_ini))
// 	{
// 		print_out($run_info_ini);
// 		$suite_name = get_primer_suite_name($run_info_ini["dna_region"], $run_info_ini["domain"]);			
// 		print_blue_message('HERE $domain = '. $domain);
// 		print_blue_message('HERE $suite_name = ' . $suite_name . "\n");
// 	}
// 	else
// 	if (isset($_SESSION["run_info"]))
// 	{
// 		$suite_name = $domain . " Suite";
// 		print_blue_message('HERE1 $suite_name = ' . $suite_name . "\n");
// 	}
// 	else
// 	{
		
		if (!$_SESSION['is_local'])
		{
			//   $connection = $newbpc2_connection;
			$connection = $vampsdev_connection;
		
		}
		else
		{
			$connection = $local_mysqli;
		}		
		
		if (isset($_POST) && !empty($_POST))
		{
			$suite_names = get_primer_suite_name_from_db($_POST, $connection);
			print_blue_message("FROM isset(\$_POST)");
				

		print_out($suite_names);
		print_blue_message("HERE1");
		
		$primer_suites = array();
		foreach ($suite_names as $suite_name_row)
		{
			$primer_suites[] = $suite_name_row["primer_suite"];
			print_blue_message("\$suite_name_row");
			print_out($suite_name_row);
				
		}
		 $suite_name_arr = array_unique($primer_suites);
		 print_blue_message("HERE2 \$suite_name");
		 $suite_name = $suite_name_arr[0];
		 print_out($suite_name);
		 	
		 }
		 else
		 {
		 $suite_name = $domain . " Suite";
		 
// 			$suite_names = get_primer_suite_name_from_db($_SESSION["run_info"], $connection);
		 print_blue_message("FROM \$_SESSION");
		 
		}
// // 		SELECT DISTINCT primer_suite, dna_region
// // 		FROM run_info_ill
// // 		JOIN run USING(run_id)
// // 		JOIN dna_region USING(dna_region_id)
// // 		JOIN primer_suite USING(primer_suite_id)
// // 		WHERE
// // 		run = "20120613"
// // 		AND lane = 3
		
		
// 	}
	$lanes_uniq = array_unique($lanes);
	print_out($lanes_uniq);
	print_blue_message('HERE $suite_name = ' . $suite_name . "\n");
	
	foreach ($lanes_uniq as $lane_name)
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
