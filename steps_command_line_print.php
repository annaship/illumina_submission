      <?php 
print_red_message("From ". $_SERVER["PHP_SELF"] . "; steps_command_line_print");
      
      
	if (check_var($csv_path_error) == 0)
	{
		print_red_message($csv_path_error);
	}
	else
	{
		echo "<div id=\"command_line_print\">";
		echo "
	          <p>
	            This command line(s) can be run on any server:
	          </p>
	          <br/>
	        ";
		
		foreach ($lanes as $lane_name)
		{
			print_red_message("lane_name = $lane_name");
			$csv_name      = create_csv_name($rundate, $lane_name);
			$csv_file_name =  $path_to_csv  . $rundate . "/" . $csv_name;
			 
			$command_line = "cd " . $path_to_csv . $rundate .
			"; time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py
		          -csv " . $path_to_csv  . $rundate . "/" . $csv_name .
			          " -s " . $pipeline_command . " -l debug -p illumina -r " .
			          $rundate . " -ft fastq -i " . $raw_path . " -cp " . $is_compressed . " -lane_name \"lane_" . $lane_name . "\" -do_perfect " . $do_perfect
			          ;
			           
			print_red_message($command_line);
		}
	}
	echo "</div>";
	
?>

      
