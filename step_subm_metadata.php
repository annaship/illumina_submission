<?php include("ill_subm_beginning.php"); ?>
<?php include_once "ill_subm_filled_variables.php"; ?>

<h1>Illumina files processing</h1>
<?php include_once("ill_subm_menu.php"); ?>

<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["run_info_process"] == 1) {   
      include_once 'step_subm_metadata_form_run_info_validation.php';
    }
    include("step_subm_metadata_form_run_info.php"); 
?>
    
    <?php
    print_out("from subm_met 1");
    $show_class = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["project_process"] == 1) {
      $show_class = "show_block";
      print_out("from subm_met 2");
      
      include_once 'step_subm_metadata_form_project_validation.php';
    }
    print_out("from subm_met 3");
    
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
        if ((!($_SERVER["REQUEST_METHOD"] == "POST") || !($_POST["submission_metadata_process"])) and !($_POST["submission_metadata_selected_process"])) 
        {   
          include("step_subm_metadata_form_metadata_table.php");
          $metadata_errors_count = 0;          
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submission_metadata_process"] == 1) 
        {   
          include_once 'step_subm_metadata_form_submission_metadata_validation.php';
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submission_metadata_selected_process"] == 1) 
        {   
          include_once 'step_subm_metadata_form_submission_metadata_validation.php';
        }
      ?>
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
