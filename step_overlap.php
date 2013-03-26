<?php include_once("ill_subm_beginning.php"); ?>
<?php
  include_once("ill_subm_functions.php");
  include_once "ill_subm_filled_variables.php"; 
?>
       
      <h1>Illumina files processing</h1>
      <?php include_once("ill_subm_menu.php"); 
      $machine_name = get_machine_name($_SESSION["run_info"]["dna_region_0"]);
      $rundate      = $_SESSION["run_info"]["rundate"];
      $raw_path     = "/xraid2-2/sequencing/Illumina/" . $_SESSION["run_info"]["path_to_raw_data"];
      $lane_name    = "5"; # TODO: change to a variable! 
      $do_perfect   = "True";      
      if ($_SESSION["run_info"]["overlap"] == partial)
      {
        $do_perfect = "False";         
      }
      
      $command_line_overlap = "cd /xraid2-2/g454/run_new_pipeline/illumina/" . $machine_names[$machine_name] . "_info/" . $rundate . 
        "; time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py -s illumina_files -l debug -p illumina " .
        $rundate . " -ft fastq -i " . $raw_path . "-cp True -lane_name " . $lane_name . "-do_perfect " . $do_perfect
      ;
      
//       print_out($command_line_overlap)
        print_red_message($command_line_overlap);
      ?>
<!--       cd /xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20121004;  -->
<!--       time python /bioware/linux/seqinfo/bin/python_pipeline/py_mbl_sequencing_pipeline/pipeline-ui.py  -->
<!--       -csv /xraid2-2/g454/run_new_pipeline/illumina/hiseq_info/20121004/metadata_template_HGM_20121014.csv  -->
<!--       -s illumina_files -l debug -p illumina -r 20121004 -ft fastq -i /xraid2-2/sequencing/Illumina/20121026hs/Project_HGM_Bv6_L5  -->
<!--       -cp True -lane_name 'lane_5' -do_perfect True -->
      
      
<!--       [run_info] => Array ( [form_name] => run_info_form [rundate] => 20130326  [path_to_raw_data] => 20130326ms/  -->
<!--       [dna_region_0] => v4v5 [overlap] => partial [seq_operator] => AA [insert_size] => 111 [read_length] => 222  -->
<!--       [add] => Submit Run info [run_info_process] => 1 ) ) -- -->
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
