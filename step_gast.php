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

	echo "<div id=\"command_line_print\">";
	echo "
	          <p>
	            This command line(s) can be run on any server:
	          </p>
	          <br/>
	        ";
	foreach ($lanes as $lane_name)
	{
    	$command_line_gast = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" . 
        					$lane_name . "/analysis/reads_overlap/; run_gast_ill.sh; date";
        print_green_message($command_line_gast);        
	}
	echo "</div>";
?>

<div id="command_line_print">
	<p>
		Afterwards you can check the percent of "Unknown" taxa by using:	
	</p>
    <br/>
<?php 
	foreach ($lanes as $lane_name)
	{
		$check_gast_unknowns = "check_gast_unknowns.sh";
		$command_line_gast_check = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
									$lane_name . "/analysis/reads_overlap/; " . $check_gast_unknowns . "; date";
		print_green_message($command_line_gast_check);	
	}	
?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
