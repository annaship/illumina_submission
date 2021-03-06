 <?php include("ill_subm_beginning.php"); ?>
<?php include_once "ill_subm_filled_variables.php"; ?>

<h1>Illumina files processing</h1>
<?php include_once("ill_subm_menu.php"); ?>


<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["vamps_subm_info_process"]) && $_POST["vamps_subm_info_process"] == 1) {
    list($user, $last_name, $first_name, $email, $institution, $selected_project, $selected_project_title, $selected_project_description, 
            $selected_env_source_name, $selected_env_source_name_id, $selected_funding) = array_map('trim', explode(', ', $_POST["project_form_vamps_submission_info"]));
    
    $selected_contact_name = $last_name . ", " . $first_name;
    $selected_contact_full = $contact_full[$user];
    
//     TODO: $_POST[project_form_vamps_submission_info] to selected variables
//     UUU -Array ( [form_name] => vamps_subm_info_form 
//             [project_form_vamps_submission_info] => ashipunova, Shipunova, Anna, ashipunova@mbl.edu, MBL, AS_temp_Bv6, temp project title, temp project description, water-freshwater, 120, 0 
//             [add] => Submit [vamps_subm_info_process] => 1 ) --
  }

?>

<?php
  if (isset($_SESSION["run_info"]) && $_SESSION["run_info"] != array()) {
    $run_info_results = array();
    $run_info_results         = $_SESSION["run_info"];
    $selected_rundate 	      = $_SESSION["run_info"]["rundate"];
    $selected_dna_region_base = $_SESSION["run_info"]["dna_region_0"];
    $selected_overlap 	      = $_SESSION["run_info"]["overlap"];
    $selected_seq_operator    = $_SESSION["run_info"]["seq_operator"];
    $selected_insert_size     = $_SESSION["run_info"]["insert_size"];
    $selected_read_length     = $_SESSION["run_info"]["read_length"];
    $selected_path_to_raw_data = $_SESSION["run_info"]["path_to_raw_data"];
  } 
?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["run_info_process"]) && $_POST["run_info_process"] == 1) {   
      include_once 'step_subm_metadata_form_run_info_validation.php';
    }
    include("step_subm_metadata_form_run_info.php"); 
?>
    
    <?php
    $show_class = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["project_process"]) && $_POST["project_process"] == 1) {
      $show_class = "show_block";
      
      include_once 'step_subm_metadata_form_project_validation.php';
    }
    
?>
          
    <br />
    <input type="button" value="Add new project" class="hide_project" />
    
    <table>
         <tr style="display:none;" class="hide_project_tr <?php echo $show_class; ?>">
           <td colspan="3">
             <?php include("step_subm_metadata_form_project.php"); ?>                 
        </td>
      </tr>
    </table>
    
<?php
//     if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["owner_process"] == 1) {
//       include_once 'step_subm_metadata_form_owner_validation.php';
//     }
?>
    
<!--     <br /> -->
<!--     <input type="button" value="Add new owner" class="hide_owner" /> -->
    
<!--     <table> -->
<!--          <tr class="hide_owner_tr"> -->
<!--            <td colspan="3"> -->
             <?php #include("step_subm_metadata_form_owner.php"); 
             ?>                 
<!--         </td> -->
<!--       </tr> -->
<!--     </table>         -->
    <br />
      <?php
//         print_out($_SESSION["run_info_errors"]);
        if (check_var($_SESSION["run_info_errors"]))
        {
//           echo "<div class=\"big\">";
            print_red_message("<span class=\"big\">Please fix the run info above</span>");
//           echo "</div>";
          
        }
        elseif ((!($_SERVER["REQUEST_METHOD"] == "POST") || !($_POST["submission_metadata_process"])) 
                && !($_POST["submission_metadata_selected_process"])
                && !($_POST["subm_metadata_upload_process"])
                ) 
        {   
//           print_blue_message("HERE1");
          include("step_subm_metadata_form_metadata_table.php");
          $metadata_errors_count = 0;          
//           print_blue_message("HERE11");
//           print_out($_SESSION["run_info_errors"]);
          
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && 
                (  $_POST["submission_metadata_process"] == 1 
                || $_POST["submission_metadata_selected_process"] == 1
                )
           ) 
        {   
//           print_blue_message("HERE2");
          include_once 'step_subm_metadata_form_submission_metadata_validation.php';
//           print_blue_message("HERE21");
//           print_out($_SESSION["run_info_errors"]);
          
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "POST" &&
                (  $_POST["subm_metadata_upload_process"] == 1
                )
        )
        {
//           print_blue_message("HERE3");        
          include_once 'step_subm_metadata_form_submission_metadata_validation.php';
          
//           echo "
//                 <div id = \"csv_load\">
//                   <a href=\"csv_download.php\">Click to download CSV file</a>
//                 </div>
//           ";
//           print_blue_message("HERE31");
//           print_out($_SESSION["run_info_errors"]);          
        }        
      ?>

      
      <!-- end of content -->
          
<?php include_once("ill_subm_end.php"); ?>     
