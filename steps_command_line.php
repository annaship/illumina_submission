      <?php 

      //       include_once("ill_subm_menu.php");
      print_red_message("From step_command_line, POST = ");
      print_out($_POST);
      print_out($_SESSION["run_info"]);
      include_once 'choose_metadata.php';
      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choose_run_m_process"] == 1)
      {
      	$rundate = $lane_name = $raw_path = $path_to_csv = $csv_name = $is_compressed = $do_perfect = $machine_name = "";
//       	TODO: move repetitions from below
      	$rundate      = $_POST["find_rundate"];
      	$lane_name    = $_POST["find_lane"];
      	$raw_path     = "/xraid2-2/sequencing/Illumina/" . $_POST["path_to_raw_data"];
      	$machine_name = array_search($_POST["find_machine"], $machine_names);
      	$path_to_csv  = "/xraid2-2/g454/run_new_pipeline/illumina/" . $machine_names[$machine_name] . "_info/";      
        $csv_name = create_csv_name($rundate, $lane_name);
        $is_compressed = "True";
        $do_perfect    = "True";
        if ($_SESSION["run_info"]["overlap"] == partial)
        {
        	$do_perfect = "False";
        }        
        $csv_file_name =  $path_to_csv  . $rundate . "/" . $csv_name;
        
        $csv_path_error = "";
        if (!file_exists($csv_file_name))
        {
        	$csv_path_error = "Sorry, there is no such file: ". $path_to_csv;
        }
        $lanes = array($lane_name);        

      }
      else
      {
	      if (!check_var($_SESSION["run_info"]))
	      {
	        print_red_message("Please submit metadata first here: 
	                <a href\"http://vampsdev.mbl.edu/illumina_submission/step_upload_subm_metadata.php\">Upload Submission Metadata</a>.<br/>
	                Or choose one by clicking the button above.");
	        include_once 'choose_metadata.php';
	      }
	      else 
	      {    
	//       	$rundate = $lane_name = $raw_path = $path_to_csv = $csv_name = $is_compressed = $do_perfect = "";

	        $lanes         = array();
	  //       $rundate       = $_SESSION["run_info"]["rundate"];
	  //       $machine_name  = get_machine_name($_SESSION["run_info"]["dna_region_0"]);
	  //       $raw_path      = "/xraid2-2/sequencing/Illumina/" . $_SESSION["run_info"]["path_to_raw_data"];
	  //       $path_to_csv   = "/xraid2-2/g454/run_new_pipeline/illumina/" . $machine_names[$machine_name] . "_info/" . $rundate;
	        $is_compressed = "True";
	        $do_perfect    = "True";      
	        if ($_SESSION["run_info"]["overlap"] == partial)
	        {
	          $do_perfect = "False";         
	        }
	        
	  
	        $lanes = $_SESSION["run_info"]["lanes"];
	      }      
	//         UUU -Array ( [form_name] => run_info_form [rundate] => 20130326 [path_to_raw_data] => 20130326hs/
	//                 [dna_region_0] => v6 [overlap] => complete [seq_operator] => AA [insert_size] => 111
	//                 [read_length] => 222 [add] => Submit Run info [run_info_process] => 1 [lanes] => Array ( [0] => 1 [1] => 3 ) ) --
	
	//       cd /xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20121221; 
	// time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py 
	// -csv /xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20121221/Project_SLM_NIH_Bv6_plt_both/Project_SLM_NIH_Bv6_plts.csv
	//  -s illumina_files -l debug -p illumina -r 20121221 -ft fastq -i /xraid2-2/sequencing/Illumina/20121221hs/Project_SLM_NIH_Bv6_plt2 
	// -cp True -lane_name 'lane_2' -do_perfect True
	      
	} #else

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
	echo "</div>";
	
?>

      
