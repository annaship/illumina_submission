<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once("ill_subm_filled_variables.php");
?>

      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	print_blue_message("From ". $_SERVER["PHP_SELF"]);
// 	print_blue_message("\$machine_name = $machine_name");
	echo "<h2>Remove old data from db</h2>";
		
	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");
	
?>

<div id="command_line_print">
	
<?php 
	$suite_name = "";
		
	if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
		
		{
			$connection = $local_mysqli_env454;
		}		
	else
		{
			$connection = $newbpc2_connection_r;
			// 			$connection = $vampsdev_connection;
		
		}
		
	if (isset($_POST) && !empty($_POST))
	{
		print_green_message("HERE1");
		
		$suite_names = get_primer_suite_name_from_db($_POST, $connection);
			
		$primer_suites = array();
		foreach ($suite_names as $suite_name_row)
		{
			$primer_suites[] = $suite_name_row["primer_suite"];
				
		}
		 $suite_name_arr = array_unique($primer_suites);
		 $suite_name = $suite_name_arr[0];
		 	
	}
	elseif (isset($dna_region) && isset($domain)) 
	{
		print_green_message("HERE2: $dna_region, $domain");
		$suite_name = get_primer_suite_name($dna_region, $domain);
		
// 			$suite_names = get_primer_suite_name_from_db($_SESSION["run_info"], $connection);	 
	}
	elseif (isset($_SESSION[run_info]) && !empty($_SESSION[run_info]) && isset($_SESSION[run_info][dna_region_0])) {
		print_green_message("HERE3");
		
		$dna_region = $_SESSION[run_info][dna_region_0];
		$suite_name = get_primer_suite_name($dna_region, $domain);
	}
	else 
	{
		print_red_message("Problems with domain and dna_region: domain = $domain; dna_region = $dna_region");
	}
	
	$lanes_uniq = array_unique($lanes);
	$query_del_sequence_pdr_info_ill = $query_del_run_info_ill = ""; 
	foreach ($lanes_uniq as $lane_name)
	{
		$query_del_sequence_pdr_info_ill = "DELETE from sequence_pdr_info_ill   
  USING sequence_pdr_info_ill 
  JOIN run_info_ill using(run_info_ill_id) 
  JOIN project using(project_id) 
  JOIN dataset using(dataset_id) 
  JOIN run using(run_id) 
  JOIN primer_suite using(primer_suite_id) 
  WHERE primer_suite = \"" . $suite_name . "\" 
  AND run = \"" . $rundate . "\" 
  AND lane = \"" . $lane_name . "\";"; 
		
		$query_del_run_info_ill = "DELETE 
  FROM run_info_ill   
  USING    run_info_ill   
  JOIN project using(project_id)    
  JOIN dataset using(dataset_id)    
  JOIN run using(run_id)   
  JOIN primer_suite using(primer_suite_id)   
  WHERE primer_suite = \"" . $suite_name . "\"    
  AND run = \"" . $rundate . "\"   
  AND lane = \"" . $lane_name . "\";";

		/*
DELETE from sequence_pdr_info_ill   
  USING sequence_pdr_info_ill 
  JOIN run_info_ill using(run_info_ill_id) 
  JOIN project using(project_id) 
  JOIN dataset using(dataset_id) 
  JOIN run using(run_id) 
  JOIN primer_suite using(primer_suite_id) 
  WHERE primer_suite = 'Bacterial V4-V5 Suite' 
  AND run = '20130104' 
  AND lane = '1';  

DELETE 
  FROM run_info_ill   
  USING    run_info_ill   
  JOIN project using(project_id)    
  JOIN dataset using(dataset_id)    
  JOIN run using(run_id)   
  JOIN primer_suite using(primer_suite_id)   
  WHERE primer_suite = 'Bacterial V4-V5 Suite'   
  AND run = '20130104'  
  AND lane = '1';

		*/
		
		print_green_message(add_env454_mysql_call($query_del_sequence_pdr_info_ill));
		echo "<br/>";
		print_green_message(add_env454_mysql_call($query_del_run_info_ill));
		echo "<br/>";
		echo "<br/>";
  		
	}

$query_clean_rest = "DELETE FROM sequence_uniq_info_ill 
USING sequence_uniq_info_ill 
LEFT JOIN sequence_pdr_info_ill USING(sequence_ill_id) 
WHERE sequence_pdr_info_ill_id is NULL; 

DELETE FROM sequence_ill 
USING sequence_ill 
LEFT JOIN sequence_pdr_info_ill USING(sequence_ill_id) 
WHERE sequence_pdr_info_ill_id IS NULL;
		";
if ($query_del_sequence_pdr_info_ill != "" AND $query_del_run_info_ill != "")
{
	print_green_message(add_env454_mysql_call($query_clean_rest));
}
	?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
