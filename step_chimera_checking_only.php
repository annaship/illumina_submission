<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	echo "<h2>Chimera checking</h2>";
	$pipeline_command = "illumina_chimera_only";
	
	include_once("steps_command_line.php");
	
	server_message("grendel");
	include_once("steps_command_line_print.php");

	print "<br/>";
	print "<br/>";
	print "Afterwards you can run the following command(s) to get chimera checking statistics.";
	server_message("any");
	
	print_blue_out_message('$lane_dom_names', $lane_dom_names);
	foreach ($lane_dom_names as $lane_dom_name)
	{
		$check_chimera_stat = "chimera_stats.py";
		$command_line_check_chimera_stat = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
				$lane_dom_name . "/analysis/chimera/; " . $check_chimera_stat . "; date";
		print_green_message($command_line_check_chimera_stat);
	}

?>
	
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
