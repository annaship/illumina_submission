<?php 
  if (isset($_POST['cancel'])) 
  { 
    include("step_subm_metadata.php");
    print_r($_POST);  /* ...clear and reset stuff... */ 
  }
  else if (isset($_POST['update'])) 
  { 
    include("step_subm_metadata_update.php");        
  }
  else if (isset($_POST['copy_row'])) 
  { 
    print_r($_POST); /* Array ( 
                        [domain_0] => Bacteria 
                        [lane_0] => 1 
                        [data_owner_0] => contact ???
                        [run_key_0] => atct 
                        [barcode_index_0] => aaaaa 
                        [project_0] => project 
                        [dataset_0] => aa1 
                        [dataset_description_0] => asdas 
                        [env_source_name_0] => env_source_name ???
                        [tubelabel_0] => aa1 
                        [barcode_0] => 
                        [adaptor_0] => 
                        [amp_operator_0] => JJ 
                        [copy_row] => Go! ) */
    
    echo "<br/>";
//     html = '<option value="'+value+'" selected="selected">'+text+'</option>';
    $selected_domain			= $_POST[domain_0];
    $selected_lane				= $_POST[lane_0];
    $selected_data_owner		= $_POST[data_owner_0];
    $selected_run_key			= $_POST[run_key_0];
    $selected_barcode_index		= $_POST[barcode_index_0];
    $selected_project			= $_POST[project_0];
    $selected_dataset			= $_POST[dataset_0];
    $selected_dataset_descr		= $_POST[dataset_description_0];
    $selected_env_source_name	= $_POST[env_source_name_0];
    $selected_tubelabel			= $_POST[tubelabel_0];
    $selected_barcode			= $_POST[barcode_0];
    $selected_adaptor			= $_POST[adaptor_0];
    $selected_amp_operator		= $_POST[amp_operator_0];    

    $repeat_subm_row = intval($_POST[copy_row]);
    print "HERE\n";
    print $selected_env_source_name;
    include("step_subm_metadata.php");        
  }

?>