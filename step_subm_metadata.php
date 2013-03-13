<?php include("ill_subm_beginning.php"); ?>
<?php
// if(!isset($_SESSION)) { session_start(); } 
// if ($_SESSION["is_local"])
// {  
//     include("ill_subm_filled_variables_local.php");
// }
// else
// { include("ill_subm_filled_variables.php"); }
include_once "ill_subm_filled_variables.php";
?>

    <h1>Illumina files processing</h1>
    <?php include_once("ill_subm_menu.php"); ?>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["run_info_process"] == 1) {   
      include_once 'step_subm_metadata_form_run_info_validation.php';
    }
    print_out($run_info_results);
    include("step_subm_metadata_form_run_info.php"); ?>
    
    <?php
//     $show_class = "hide_block";
    $show_class = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["project_process"] == 1) {
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
      <?php include("step_subm_metadata_form_metadata_table.php"); ?>      
      
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
