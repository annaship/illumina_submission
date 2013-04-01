<?php include_once("ill_subm_beginning.php"); ?>
<?php
  include_once("ill_subm_functions.php");
  include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
      <?php 
      include_once("ill_subm_menu.php");
            
//       print_out($_SERVER);
      include_once 'choose_metadata.php';
?>
      <div id="command_line_print">
<?php 
      if (!check_var($_SESSION["run_info"]))
      {
        print_red_message("Please submit metadata first here: 
                <a href\"http://vampsdev.mbl.edu/illumina_submission/step_upload_subm_metadata.php\">Upload Submission Metadata</a>");
      }
      else 
      {       
        echo "
          <p>
            This command line(s) can be run on any server:
          </p>
          <br/>
        ";
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
        
        foreach ($lanes as $lane_name)
        {

          $csv_name = create_csv_name($rundate, $lane_name); 
         
          $command_line_overlap = "cd " . $path_to_csv . $rundate .
          "; time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py
          -csv " . $path_to_csv  . $rundate . "/" . $csv_name .  
          " -s illumina_files -l debug -p illumina -r " .
          $rundate . " -ft fastq -i " . $raw_path . " -cp " . $is_compressed . " -lane_name \"lane_" . $lane_name . "\" -do_perfect " . $do_perfect
          ;
          
          print_red_message($command_line_overlap);        
        }
      }      
//         UUU -Array ( [form_name] => run_info_form [rundate] => 20130326 [path_to_raw_data] => 20130326hs/
//                 [dna_region_0] => v6 [overlap] => complete [seq_operator] => AA [insert_size] => 111
//                 [read_length] => 222 [add] => Submit Run info [run_info_process] => 1 [lanes] => Array ( [0] => 1 [1] => 3 ) ) --

//       cd /xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20121221; 
// time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py 
// -csv /xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20121221/Project_SLM_NIH_Bv6_plt_both/Project_SLM_NIH_Bv6_plts.csv
//  -s illumina_files -l debug -p illumina -r 20121221 -ft fastq -i /xraid2-2/sequencing/Illumina/20121221hs/Project_SLM_NIH_Bv6_plt2 
// -cp True -lane_name 'lane_2' -do_perfect True
      
      
?>

</div>
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
