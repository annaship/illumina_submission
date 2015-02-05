<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
  	echo "<h1>Illumina files processing</h1>";
	include_once("ill_subm_menu.php");

       
   	echo "<h2>Overlap reads in already demultiplexed files</h2>";


	include_once("steps_command_line.php");

	echo "<div id=\"command_line_print\">";
	
	switch ($machine_name) {
		case "hs":
			server_message("cluster");
			break;
		case "ms":
// 			server_message("domino or minnie");
			server_message("cluster");
			break;
    // default:
    //  echo " Please provide a machine name";
	}
	
	$overlap_script_name = "";
	$overlap_script_name = get_overlap_script_name($machine_name);
// 	foreach ($lanes as $lane_num)
// 	{
// 		$lane_name = $lane_num . "_" . $domain_letter;	
//     	$command_line_uniq = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" . 
//         					$lane_name . "/analysis/reads_overlap/; " . $overlap_script_name . "; date";
	foreach ($lane_dom_names as $lane_dom_name)
	{
    	$command_line_uniq = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
        					$lane_dom_name . "/analysis/; " . $overlap_script_name . "; date";
        print_green_message($command_line_uniq);        
	}
	echo "</div>";
?>

<div id="command_line_print">
	Afterwards you can check the overlap percentage by using
<?php 
	$stat_check_command_name = "take_ill_stats.py";
// 	$stat_check_command_name = "take_" . $machine_name . "_stats.py";
// 	$lane_dom_names 		 = create_lane_dom_names($lanes, $domains);
// print_blue_out_message('$_SESSION["csv_content"] from step_overlap_only', $_SESSION["csv_content"]);
// 	$lane_dom_names 		 = create_lane_dom_names($_SESSION["csv_content"]);
// 	print_blue_message("From ". $_SERVER["PHP_SELF"] . "; step_overlap_only");
// 	print_blue_out_message('2) $lane_dom_names', $lane_dom_names);
	
	foreach ($lane_dom_names as $lane_dom_name)
	{
		$command_line_overlap_check = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
									$lane_dom_name . "/analysis/reads_overlap/; " . $stat_check_command_name . "; date";
		
		print_green_message($command_line_overlap_check);	
	}	
?>
</div>

      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
