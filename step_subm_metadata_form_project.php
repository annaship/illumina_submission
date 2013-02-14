<form method="post" name="projectForm" id="projectForm" action="insert_project.php">
<input type="hidden" name="form_name" id="projectForm_form_name" value="projectForm"/>
<table class="form" id="projectForm-form"><tbody>
<tr><td>
<table class="fields" id="projectForm-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="projectForm_project">
<legend id="projectForm_project-legend">Add new project</legend>
<table class="fields" id="projectForm_project-fields"><tbody>



<tr class="fields">
<td class="fields" ><label for="projectForm_project">project</label></td>
<td ><input class="text_inp" type="text" name="project_name1" id="projectForm_project_name1" value="" size="4"/>
_ <input class="text_inp" type="text" name="project_name3" id="projectForm_project_name2" value="" size="4"/>
_
  <select name="domain" id="form_domain">
  <option selected="selected" value="B">Bacteria (B)</option>
  <option value="A">Archaea (A)</option>
  <option value="E">Eukarya (E)</option>
  <option value="F">Fungi (F)</option>
  </select>

  <select name="dna_region" id="form_dna_region">
  <option selected="selected" value="v6">v6</option>
  <option value="v4v5">v4v5</option>
  </select>
</td>
</tr>

<?php
/*
 * project, title, project_description, rev_project_name, funding, contact_id
 * 
 * TODO: Add project name validation
 * 
 * */

$arr_fields = array("project_title", "project_description", "funding");
foreach ($arr_fields as &$value) {
  echo '
    <tr class="fields">
    <td class="fields" ><label for="projectForm_'.$value.'">'.$value.'</label></td>
    <td><input class="text_inp" type="text" name="'.$value.'" id="projectForm_'.$value.'" value="" size="30"/></td>
    </tr>
  ';  

}
unset($value); // break the reference with the last element
?>
  <tr class="fields">
    <td class="fields" ><label for="projectForm_contact">contact</label></td>
    <td>
    <select name="project_0" id="form_project_0">
   <?php 
     print_options($contact_full, $selected_contact_full);  
   ?>
    </select></td>
  </tr>

</tbody></table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>
<tr><td >
<table class="buttons" id="projectForm-buttons"><tbody>
<tr class="buttons"><td class="buttons"><input type="submit" name="add" id="projectForm_add"/></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>
