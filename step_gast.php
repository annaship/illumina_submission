<?php include_once("ill_subm_beginning.php"); ?>
<?php
  include_once("ill_subm_functions.php");
  include_once "ill_subm_filled_variables.php";
?>
       
      <h1>Illumina files processing</h1>
      <?php 
      include_once("ill_subm_menu.php");
      
      if (!check_var($_SESSION["run_info"]))
      {
        print_red_message("Please submit metadata first here: 
                <a href\"http://vampsdev.mbl.edu/illumina_submission/step_upload_subm_metadata.php\">Upload Submission Metadata</a>");
      }
      else 
      {       
        echo "
          <p>
            Please run the command line below from a cluster (e.g. grendel).
          </p>
        ";
        $lanes         = array();
  //       $rundate       = $_SESSION["run_info"]["rundate"];
  //       $machine_name  = get_machine_name($_SESSION["run_info"]["dna_region_0"]);
  //       $raw_path      = "/xraid2-2/sequencing/Illumina/" . $_SESSION["run_info"]["path_to_raw_data"];
  //       $path_to_csv   = "/xraid2-2/g454/run_new_pipeline/illumina/" . $machine_names[$machine_name] . "_info/" . $rundate;
  
        $lanes = $_SESSION["run_info"]["lanes"];
        
        foreach ($lanes as $lane_name)
        {
//           cd /xraid2-2/g454/run_new_pipeline/illumina/20130104/lane_1/analysis/reads_overlap/; run_gast_ill.sh; date
          $command_line_gast = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $rundate . "/lane_" . 
                  $lane_name . "/analysis/reads_overlap/; run_gast_ill.sh; date";
          
          print_red_message($command_line_gast);        
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


      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
