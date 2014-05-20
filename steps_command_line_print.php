      <?php 
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; steps_command_line_print");
//       print_blue_message("\$csv_path_error");
//       print_out($csv_path_error);
//       print_out(check_var($csv_path_error));
      if (!check_var($csv_path_error) == 0)
	{
		print_red_message($csv_path_error);
	}
	else
	{
		echo "<div id=\"command_line_print\">";

		
// 			print_blue_message("\$lanes = ");
// 			print_out($lanes);
// 			print_blue_message("\$domains = ");
// 			print_out($domains);
// 			$lane_dom_names = create_lane_dom_names($lanes, $domains);
// 		print_blue_out_message('$_SESSION["csv_content"] from steps_command_line_print', $_SESSION["csv_content"]);
// 		$lane_dom_names 		 = create_lane_dom_names($_SESSION["csv_content"]);
// 		if (isset($_POST) && !empty($_POST)) {
// 			$lane_dom_names = create_lane_dom_names(array($_POST));
// 		}
// 		print_blue_message("From ". $_SERVER["PHP_SELF"] . "; steps_command_line_print");
// 			print_blue_out_message('02) $lane_dom_names', $lane_dom_names);
				
// 			print_blue_message("\$lane_dom_names = ");
// 			print_out($lane_dom_names);
// 			print_blue_message("===========");	
// 		TODO: change to $lane_dom_names
// 		foreach ($lanes as $lane_num)
// 		{
// 			$lane_name     = $lane_num . "_" . $domain_letter;
// 			$csv_name      = create_csv_name($rundate, $lane_name);
// ...
// 		$rundate . " -ft fastq -i " . $raw_path . " -cp " . $is_compressed . " -lane_name \"lane_" . $lane_name . "\" -do_perfect " . $do_perfect

		foreach ($lane_dom_names as $lane_dom_name)
		{			
			$csv_name      = create_csv_name($rundate, $lane_dom_name);				
			$csv_file_name =  $path_to_csv  . $rundate . "/" . $csv_name;
			
// 			TODO: validation here, 1) if exists $csv_file_name, 2) raw_data
			if ($raw_path == "")
			{
				print_red_message("Path to raw data is empty!");
			}
			else 
			{
				print_red_message("Please check if the path to raw data exists: " . $raw_path);
				
				$command_line = "cd " . $path_to_csv . $rundate .
				"; time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py
			          -csv " . $csv_file_name .
				          " -s " . $pipeline_command . " -l debug -p illumina -r " .
				          $rundate . " -ft fastq -i " . $raw_path . " -cp " . $is_compressed . " -lane_name lane_" . $lane_dom_name . " -do_perfect " . $do_perfect
				          ;
				print_green_message($command_line);
				          
			}
				          
			           
// print "<br/>"; print_blue_message("\$command_line");
// print_out($command_line);

// print "<br/>"; print_blue_message("\$csv_file_name");
// print_out($csv_file_name);

// print "<br/>"; print_blue_message("\$csv_name");
// print_out($csv_name);

// print "<br/>"; print_blue_message("\$lane_name");
// print_out($lane_name);

		}
	}
	echo "</div>";
	
?>

      
