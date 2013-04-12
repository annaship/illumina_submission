<?php
include_once 'choose_metadata.php';


// 	print_blue_message("From ". $_SERVER["PHP_SELF"] . "; steps_command_line");
//     print_out($_SESSION["run_info"]);
// 	print_blue_message("\$_POST:");
//       print_out($_POST);
// print_blue_message("\$run_info_ini:");
// print_out($run_info_ini);
// print_blue_message("\$_SESSION[\"run_info\"]");
// print_out($_SESSION["run_info"]);

/*
1) just uploaded csv
2) there is ini file
3) not 1 nor 2
*/

$command_line = $csv_file_name = $csv_name = $do_perfect = $is_compressed = $lane_name = $path_to_csv = $raw_path = $rundate = "";
$lanes        = array();
$is_compressed = "True";
$do_perfect    = "True";

// 1) just uploaded csv

if  ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$rundate       = $_POST["find_rundate"];
	$lane_name     = $_POST["find_lane"];
	$lanes 		   = array($lane_name);
	$machine_name  = array_search($_POST["find_machine"], $machine_names);
	$csv_name      = create_csv_name($rundate, $lane_name);
	
	// 2) there is ini file
	if (isset ($_POST["choose_run_m_process"]) && $_POST["choose_run_m_process"] == 1)
	{
// 		print_blue_message("HERE1");
		/*
		 * POST:
		* UUU -Array ( [form_name] => choose_run_m_form [find_rundate] => 20130322 [find_machine] => hiseq [find_lane] => 4 [add] => Submit [choose_run_m_process] => 1 ) --
		$run_info_ini:
		UUU -Array ( [rundate] => 20130322 [lane] => 4 [domain] => Bacteria [dna_region] => v6 [path_to_raw_data] => /xraid2-2/sequencing/Illumina/20130322/Project_NMS_v6 [overlap] => complete ) --
		*
		* */
		$raw_path 	 = $run_info_ini["path_to_raw_data"];
		if ($run_info_ini["overlap"] == "partial")
		{
			$do_perfect = "False";
		}
	}
// 	3) not 1 nor 2	
	elseif ($_POST["choose_meta_w_path_process"] == 1)
	{
// 		print_blue_message("HERE2");
		// 	 UUU -Array ( [form_name] => choose_run_m_form [find_rundate] => 20130322 [find_machine] => hiseq [find_lane] => 1 [path_to_raw_data] => 20130322 [add] => Submit [choose_run_w_path_process] => 1 ) --
		$raw_path     = "/xraid2-2/sequencing/Illumina/" . $_POST["path_to_raw_data"];
		if ($_POST["find_machine"] == "miseq")
		{
			$do_perfect = "False";
		}
	
	}
} #no session
elseif (check_var($_SESSION["run_info"]))
{
	/*
	 * UUU -Array ( [form_name] => run_info_form [rundate] => 20120315 [path_to_raw_data] => 20120315hs/test [dna_region_0] => v6 [overlap] => complete [seq_operator] => JR [insert_size] => 95 [read_length] => 111 [add] => Submit Run info [run_info_process] => 1 [lanes] => Array ( [0] => 1 ) ) --
	*/
	$rundate       = $_SESSION["run_info"]["rundate"];
	$machine_name  = get_machine_name($_SESSION["run_info"]["dna_region_0"]);
	$raw_path      = "/xraid2-2/sequencing/Illumina/" . $_SESSION["run_info"]["path_to_raw_data"];
	if ($_SESSION["run_info"]["overlap"] == "partial")
	{
		$do_perfect = "False";
	}
	$lanes = $_SESSION["run_info"]["lanes"];
}
$path_to_csv   = "/xraid2-2/g454/run_new_pipeline/illumina/" . $machine_names[$machine_name] . "_info/";

// // ---

// if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choose_run_m_process"] == 1)
// {
// 	print_blue_message("HERE1");
// 	/*
// 	 * POST:
// 	* UUU -Array ( [form_name] => choose_run_m_form [find_rundate] => 20130322 [find_machine] => hiseq [find_lane] => 4 [add] => Submit [choose_run_m_process] => 1 ) --
// 	$run_info_ini:
// 	UUU -Array ( [rundate] => 20130322 [lane] => 4 [domain] => Bacteria [dna_region] => v6 [path_to_raw_data] => /xraid2-2/sequencing/Illumina/20130322/Project_NMS_v6 [overlap] => complete ) --
// 	*
// 	* */
// 	$raw_path 	 = $run_info_ini["path_to_raw_data"];
// 	if ($run_info_ini["overlap"] == "partial")
// 	{
// 		$do_perfect = "False";
// 	}
// }
// elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choose_run_w_path_process"] == 1)
// {
// 	print_blue_message("HERE2");
// 	// 	 UUU -Array ( [form_name] => choose_run_m_form [find_rundate] => 20130322 [find_machine] => hiseq [find_lane] => 1 [path_to_raw_data] => 20130322 [add] => Submit [choose_run_w_path_process] => 1 ) --
// 	$raw_path     = "/xraid2-2/sequencing/Illumina/" . $_POST["path_to_raw_data"];
// 	if ($_POST["find_machine"] == "miseq")
// 	{
// 		$do_perfect = "False";
// 	}

// }




//       if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choose_run_m_process"] == 1)
//       {
//       	$rundate = $lane_name = $raw_path = $path_to_csv = $csv_name = $is_compressed = $do_perfect = $machine_name = "";
// //       	TODO: move repetitions from below
//       	$rundate      = $_POST["find_rundate"];
//       	$lane_name    = $_POST["find_lane"];
//       	$raw_path     = "/xraid2-2/sequencing/Illumina/" . $_POST["path_to_raw_data"];
//       	$machine_name = array_search($_POST["find_machine"], $machine_names);
//       	$path_to_csv  = "/xraid2-2/g454/run_new_pipeline/illumina/" . $machine_names[$machine_name] . "_info/";   
// print_blue_message($path_to_csv);
      	
//         $csv_name = create_csv_name($rundate, $lane_name);
//         $is_compressed = "True";
//         $do_perfect    = "True";
//         if ($_SESSION["run_info"]["overlap"] == partial)
//         {
//         	$do_perfect = "False";
//         }        
//         $csv_file_name =  $path_to_csv  . $rundate . "/" . $csv_name;
        
//         $csv_path_error = "";
//         if (!file_exists($csv_file_name))
//         {
//         	$csv_path_error = "Sorry, there is no such file: ". $path_to_csv;
//         }
//         $lanes = array($lane_name);        

//       }
//       else
//       {
// 	      if (!check_var($_SESSION["run_info"]))
// 	      {
// 	        print_blue_message("Please submit metadata first here: 
// 	                <a href\"http://vampsdev.mbl.edu/illumina_submission/step_upload_subm_metadata.php\">Upload Submission Metadata</a>.<br/>
// 	                Or choose one by clicking the button above.");
// 	        include_once 'choose_metadata.php';
// 	      }
// 	      else #we just uploaded a csv
// 	      {    
// 	//       	$rundate = $lane_name = $raw_path = $path_to_csv = $csv_name = $is_compressed = $do_perfect = "";

// 	        $lanes         = array();
// 	  //       $rundate       = $_SESSION["run_info"]["rundate"];
// 	  //       $machine_name  = get_machine_name($_SESSION["run_info"]["dna_region_0"]);
// 	  //       $raw_path      = "/xraid2-2/sequencing/Illumina/" . $_SESSION["run_info"]["path_to_raw_data"];
// 	  //       $path_to_csv   = "/xraid2-2/g454/run_new_pipeline/illumina/" . $machine_names[$machine_name] . "_info/" . $rundate;
// 	        $is_compressed = "True";
// 	        $do_perfect    = "True";      
// 	        if ($_SESSION["run_info"]["overlap"] == partial)
// 	        {
// 	          $do_perfect = "False";         
// 	        }
	        
	  
// 	        $lanes = $_SESSION["run_info"]["lanes"];
// 	      }      
// 	//         UUU -Array ( [form_name] => run_info_form [rundate] => 20130326 [path_to_raw_data] => 20130326hs/
// 	//                 [dna_region_0] => v6 [overlap] => complete [seq_operator] => AA [insert_size] => 111
// 	//                 [read_length] => 222 [add] => Submit Run info [run_info_process] => 1 [lanes] => Array ( [0] => 1 [1] => 3 ) ) --
	
// 	//       cd /xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20121221; 
// 	// time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py 
// 	// -csv /xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20121221/Project_SLM_NIH_Bv6_plt_both/Project_SLM_NIH_Bv6_plts.csv
// 	//  -s illumina_files -l debug -p illumina -r 20121221 -ft fastq -i /xraid2-2/sequencing/Illumina/20121221hs/Project_SLM_NIH_Bv6_plt2 
// 	// -cp True -lane_name 'lane_2' -do_perfect True
	      
// 	} #else
// print "====================================================================";

// print "<br/>"; print_blue_message("\$do_perfect");
// print_out($do_perfect);

// print "<br/>"; print_blue_message("\$is_compressed");
// print_out($is_compressed);


// print "<br/>"; print_blue_message("\$path_to_csv");
// print_out($path_to_csv);

// print "<br/>"; print_blue_message("\$pipeline_command");
// print_out($pipeline_command);

// print "<br/>"; print_blue_message("\$raw_path");
// print_out($raw_path);

// print "<br/>"; print_blue_message("\$rundate");
// print_out($rundate);



?>

      
