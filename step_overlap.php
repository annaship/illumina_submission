<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	include_once("steps_command_line.php");
	
	print_red_message("From step_overlap!!!");
	print_red_message("\$csv_file_name = $csv_file_name");
	
	echo "<div id=\"command_line_print\">";
	
	
	$command_line_overlap = "cd " . $path_to_csv . $rundate .
	     	"; time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py
    	      -csv " . $csv_file_name .
              " -s illumina_files -l debug -p illumina -r " .
              $rundate . " -ft fastq -i " . $raw_path . " -cp " . $is_compressed . " -lane_name \"lane_" . $lane_name . "\" -do_perfect " . $do_perfect
                 ;
	print_red_message($command_line_overlap);
?>
	</div>
	
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
