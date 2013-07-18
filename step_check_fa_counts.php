<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
<?php 
	include_once("ill_subm_menu.php");
	echo "<h2>Check counts in fasta files</h2>";
	$pipeline_command = "illumina_files";
	
	include_once("steps_command_line.php");
// 	include_once("steps_command_line_print.php");
	
?>

<div id="command_line_print">
<?php 
	$file_ext = "";
	if ($machine_name == "hs")
	{
		$file_ext = "*-PERFECT_reads.fa.unique";
	}
	else 
	{
		$file_ext = "*_MERGED" . $merge_filter_suffix . ".unique.nonchimeric.fa";
	}
	
// 	print_blue_out_message('$POST from fa_counts', $_POST);
// 	print_blue_out_message('$SESSION from fa_counts', $_SESSION);
// 	print_blue_out_message('4) $lane_dom_names', $lane_dom_names);
	if (isset($_POST) && !empty($_POST)) {
		$lane_dom_names = create_lane_dom_names(array($_POST));
	}
// 	print_blue_out_message('$lane_dom_names from fa count', $lane_dom_names);
	foreach ($lane_dom_names as $lane_dom_name)
	{
		$fa_count_command = "grep '>' " . $file_ext . " | wc -l";
		$fa_count_check = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" .
						$lane_dom_name . "/analysis/reads_overlap/; " . $fa_count_command . "; date";
		print_green_message($fa_count_check);	
	}	
?>
</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
