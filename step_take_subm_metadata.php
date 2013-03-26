<?php include("ill_subm_beginning.php"); ?>
<?php include_once "ill_subm_filled_variables.php"; ?>

<h1>Illumina files processing</h1>
<?php include_once("ill_subm_menu.php"); ?>

<form method="post" name="vamps_subm_info_form" id="vamps_subm_info_form" action="step_subm_metadata.php">
<input type="hidden" name="form_name" id="vamps_subm_info_form_form_name" value="vamps_subm_info_form"/>
<table class="form" id="vamps_subm_info_form-form"><tbody>
<tr><td>
<table class="fields" id="vamps_subm_info_form-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="vamps_subm_info_form_vamps_subm_info">
<legend id="vamps_subm_info_form_vamps_subm_info-legend">Choose VAMPS submission info</legend>
<table class="fields" id="vamps_subm_info_form_vamps_subm_info-fields"><tbody>

   <tr class="fields">
     <td class="fields" ><label for="project_form_vamps_submission_info">vamps_submission_info</label></td>
     <td>
       <select name="project_form_vamps_submission_info" id="form_project_form_vamps_submission_info">
   <?php
     $selected_vamps_submission_info_show = "";
     print_options($vamps_submission_info_show, $selected_vamps_submission_info_show);
   ?>
       </select>
     </td>
   </tr>
   

</tbody></table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>
<tr><td >
<table class="buttons" id="vamps_subm_info_form-buttons"><tbody>
<tr class="buttons"><td class="buttons"><input type="submit" name="add" id="vamps_subm_info_form_add" value="Submit"/>
<input type="hidden" name="vamps_subm_info_process" value="1"></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>

      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
