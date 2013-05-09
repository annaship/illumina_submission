<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
	include_once("ill_subm_menu.php");
?>
       
      <h1>Filtering v4v5 merged. Maximum number of mismatches allowed in the overlapped region is 3.</h1>
<?php 

	include_once("steps_command_line.php");

	echo "<div id=\"command_line_print\">";
	echo "
	          <p>
	            This command line(s) should be run on <strong>grendel</strong>:
	          </p>
	          <br/>
	        ";
	foreach ($lanes as $lane_num)
	{
		$lane_name = $lane_num . "_" . $domain_letter;	
    	$command_line_mism = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" . 
        					$lane_name . "/analysis/reads_overlap/; run_mismatch_filter.sh; date";
        print_green_message($command_line_mism);        
	}
	echo "</div>";
?>

      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
