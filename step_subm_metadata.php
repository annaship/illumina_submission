<?php include("ill_subm_beginning.php"); ?>
<?php include('ill_subm_filled_variables.php'); ?>

    <h1>Illumina files processing</h1>
    <?php include_once("ill_subm_menu.php"); ?>

    <?php include("step_subm_metadata_form_run_info.php"); ?>      
    <br />
    <input type="button" value="Add new project" class="hide_project" />
    
    <table>
         <!-- mv to css 
                  <tr style="display:none;" class="hide">
          -->
         <tr style="display:none;" class="hide_project">
           <td colspan="3">
             <?php include("step_subm_metadata_form_project.php"); ?>                 
        </td>
      </tr>
    </table>
    
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
