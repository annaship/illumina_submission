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
	$suite_name         = "";
	$suite_lanes_rundate = array();
	
// 	print_blue_out_message("from check db: \$_SESSION", $_SESSION);
	
		
	if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
		
		{
			$connection = $local_mysqli_env454;
		}		
	else
		{
			$connection = $newbpc2_connection_r;
			// 			$connection = $vampsdev_connection;
		
		}
		
	$i = 0;
	if (isset($_POST) && !empty($_POST))
	{
		
// 		print_blue_out_message("from check db: \$_POST", $_POST);
		$suite_names = get_primer_suite_name_from_db($_POST, $connection);
		
		$n = 0;
		foreach ($suite_names as $arr)
		{
			foreach ($arr as $suite_name_row)
			{
				$primer_suites[][] = $suite_name_row["primer_suite"];
			}
				
		}
		
		foreach ($primer_suites as $primer_suite)
		{
			$suite_name_arr = array_unique($primer_suite);
			$suite_name = $suite_name_arr[0];
			$suite_lanes_rundate[$i]["suite_name"] = $suite_name;
			$suite_lanes_rundate[$i]["lane"]       = $_POST["find_lane"];
			$suite_lanes_rundate[$i]["rundate"]    = $_POST["find_rundate"];
			$i++;
		}
	}
	elseif (isset($_SESSION["csv_content"]) && !empty($_SESSION["csv_content"])) {
// 		print_blue_out_message("from check db: \$_SESSION[\"csv_content\"]", $_SESSION["csv_content"]);
		
		foreach ($_SESSION["csv_content"] as $csv_arr)
		{
			$suite_name = get_primer_suite_name($csv_arr["dna_region"], $csv_arr["domain"]);
			$suite_lanes_rundate[$i]["suite_name"] = $suite_name;
			$suite_lanes_rundate[$i]["lane"]       = $csv_arr["lane"];
			$suite_lanes_rundate[$i]["rundate"]    = $csv_arr["rundate"];
			$i++;				
		}
	}
	else 
	{
		db_problem_domain_dna_region($domain, $dna_region);
	}
	
// 	print_blue_out_message("from check db: \$suite_lanes_rundate", $suite_lanes_rundate);
	
	
	$messages = array();
	foreach ($suite_lanes_rundate as $suite_lanes_rundate_one)
	{
		if ($suite_lanes_rundate_one["suite_name"] == "")
		{
			print_red_message("Please check if the domain and lane are correct - there is no such Primer suite.");
		}
		else 
		{		
			$seq_check_query = "SELECT count(*) FROM sequence_pdr_info_ill 			
				JOIN run_info_ill USING(run_info_ill_id) 			
				JOIN run USING(run_id) 			
				JOIN primer_suite USING(primer_suite_id) 
	      JOIN sequence_uniq_info_ill USING(sequence_ill_id)
				WHERE primer_suite = \"" . 
			$suite_lanes_rundate_one["suite_name"] . "\" AND run = \"" . $suite_lanes_rundate_one["rundate"] . "\" AND lane = \"" . $suite_lanes_rundate_one["lane"] . "\"";
	
			/*
			 SELECT count(*) from run_info_ill
			JOIN project USING(project_id)
			JOIN dataset USING(dataset_id)
			JOIN run USING(run_id)
			JOIN primer_suite USING(primer_suite_id)
			WHERE primer_suite = 'Bacterial V6 Suite'
			AND run = '20130322'  and lane = '1';
			*/
			$messages[] = add_env454_mysql_call($seq_check_query);
	// 		print_blue_message($seq_check);
		}
	}	
	
	foreach (array_unique($messages) as $message)
	{
		print_green_message($message);
		
	}
?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
