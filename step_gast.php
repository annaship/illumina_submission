<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	echo "<h2>Gast</h2>";
	
	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");

	echo "<div id=\"command_line_print\">";
	
	server_message("cluster");
	
	foreach ($lane_dom_names as $lane_dom_name)
	{
		$gast_command_name = get_gast_command_name($lane_dom_name, $machine_name);
		
    	$command_line_gast = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
        					$lane_dom_name . "/analysis/reads_overlap/; " . $gast_command_name . "; date";
		
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
// 	foreach ($lanes as $lane_num)
// 	{
// 		$lane_name = $lane_num . "_" . $domain_letter;	
// // 		$check_gast_unknowns = "check_gast_unknowns.sh";
// 		$check_gast_unknowns = "percent10_gast_unknowns.sh";
// 		$command_line_gast_check = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
// 									$lane_name . "/analysis/reads_overlap/; " . $check_gast_unknowns . "; date";
	foreach ($lane_dom_names as $lane_dom_name)
	{
		$check_gast_unknowns = "percent10_gast_unknowns.sh";
		$command_line_gast_check = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
									$lane_dom_name . "/analysis/reads_overlap/; " . $check_gast_unknowns . "; date";
		print_green_message($command_line_gast_check);	
	}	
?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
