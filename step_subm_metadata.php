<?php include("ill_subm_beginning.php"); ?>
<?php
if(!isset($_SESSION)) { session_start(); } 
if ($_SESSION['is_local'])
{  
    include('ill_subm_filled_variables_local.php');
}
else
{ include('ill_subm_filled_variables.php'); }
?>

    <h1>Illumina files processing</h1>
    <?php include_once("ill_subm_menu.php"); ?>

    <?php include("step_subm_metadata_form_run_info.php"); ?>      
    <br />
    <input type="button" value="Add new project" class="hide_project" />
    
    <table>
         <tr style="display:none;" class="hide_project_tr">
           <td colspan="3">
             <?php include("step_subm_metadata_form_project.php"); ?>                 
        </td>
      </tr>
    </table>
    
<?php
    $message    = "";
    $emailclass = "basictext";
    $username   = "";

    if ($_POST['owner_process'] == 1) {

        $pattern = '/.*@.*\..*/';
        $email   = $_POST['email'];
        $urlname = urlencode($$_POST['data_owner']);

        if (preg_match($pattern, $_POST['email']) > 0) {
            // Here's where you would store 
            // the data in a database...
            header(
              "location: thankyou.php?&username=$urlname");
        }
        $message    = "Please enter a valid email address.";
        $username   = $_POST['data_owner'];
        $emailclass = "errortext";
    }
?>
    
    <br />
    <input type="button" value="Add new owner" class="hide_owner" />
    
    <table>
         <tr style="display:none;" class="hide_owner_tr">
           <td colspan="3">
             <?php include("step_subm_metadata_form_owner.php"); ?>                 
        </td>
      </tr>
    </table>        
    <br />
    
      <?php include("step_subm_metadata_form_metadata_table.php"); ?>      
      
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
