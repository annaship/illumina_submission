<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>

      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
// 	print_blue_message("From ". $_SERVER["PHP_SELF"]);
	echo "<h2>Check counts in db</h2>";
	
	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");
	
?>

<div id="command_line_print">
	
<?php 
	$suite_name = "";
		
	if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
		
		{
			$connection = $local_mysqli;
		}		
	else
		{
			$connection = $newbpc2_connection_r;
			// 			$connection = $vampsdev_connection;
		
		}
		
		if (isset($_POST) && !empty($_POST))
		{
			$suite_names = get_primer_suite_name_from_db($_POST, $connection);
		
			$primer_suites = array();
			foreach ($suite_names as $suite_name_row)
			{
				$primer_suites[] = $suite_name_row["primer_suite"];
					
			}
			 $suite_name_arr = array_unique($primer_suites);
			 $suite_name = $suite_name_arr[0];
			 	
			 }
			 else
			 {
			 $suite_name = $domain . " Suite";
			 
	// 			$suite_names = get_primer_suite_name_from_db($_SESSION["run_info"], $connection);
		 
		}

	$lanes_uniq = array_unique($lanes);
	
	foreach ($lanes_uniq as $lane_name)
	{
// 		TODO: 'Bacterial V6 Suite'
		$seq_check_query = "select count(*) from sequence_pdr_info_ill 			
			JOIN run_info_ill using(run_info_ill_id) 			
			JOIN project using(project_id) 			
			JOIN dataset using(dataset_id) 			
			JOIN run using(run_id) 			
			JOIN primer_suite using(primer_suite_id) WHERE primer_suite = \"" . 
		$suite_name . "\" AND run = \"" . $rundate . "\" AND lane = \"" . $lane_name;

		/*
		 select count(*) from run_info_ill
		JOIN project using(project_id)
		JOIN dataset using(dataset_id)
		JOIN run using(run_id)
		JOIN primer_suite using(primer_suite_id)
		WHERE primer_suite = 'Bacterial V6 Suite'
		AND run = '20130322'  and lane = '1';
		*/
		
// 		print_blue_message($seq_check);
		print_green_message(add_env454_mysql_call($seq_check_query));	
	}	
?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
