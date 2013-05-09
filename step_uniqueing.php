<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
	include_once("ill_subm_menu.php");
?>
       
      <h1>Uniqueing fasta files</h1>
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
    	$command_line_uniq = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" . 
        					$lane_name . "/analysis/reads_overlap/; run_unique_fa.sh; date";
        print_green_message($command_line_uniq);        
	}
	echo "</div>";
?>

      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
