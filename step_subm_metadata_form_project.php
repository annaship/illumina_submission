<form method="post" name="project_form" id="project_form" action="step_subm_metadata.php">
<input type="hidden" name="form_name" id="project_form_form_name" value="project_form"/>
<table class="form" id="project_form-form"><tbody>
<tr><td>
<table class="fields" id="project_form-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="project_form_project">
<legend id="project_form_project-legend">Add new project</legend>
<table class="fields" id="project_form_project-fields"><tbody>

<tr class="fields">
<td class="fields" ><label for="project_form_project">project</label></td>

<td ><input class="text_inp size_abbr" type="text" name="project_name1" id="project_form_project_name1" value="<?php echo $project_results['project_name1']; ?>"/>
_ <input class="text_inp size_abbr" type="text" name="project_name2" id="project_form_project_name2" value="<?php echo $project_results['project_name2']; ?>"/>
_

  <select name="domain" id="form_domain">
  <?php 
    $domain_w_abbr = array("Bacteria (B)" => "B", "Archaea (A)" => "A", "Eukarya (E)" => "E", "Fungi (F)" => "F");
    foreach ($domain_w_abbr as $full_name => $abbr)
    {
      if ($selected_domain == $abbr)
      {
        echo '<option value="'.$abbr.'" selected="selected">'.$full_name.'</option>';
      }
      else 
      {
        echo '<option value="'.$abbr.'">'.$full_name.'</option>';
      }
    }
  ?>
  </select>

  <select name="dna_region" id="form_dna_region">
  <?php 
    $dna_regions = array("v6", "v4v5");
    foreach ($dna_regions as $dna_region)
    {
      if ($selected_dna_region == $dna_region)
      {
        echo '<option value="'.$dna_region.'" selected="selected">'.$dna_region.'</option>';
      }
      else 
      {
        echo '<option value="'.$dna_region.'">'.$dna_region.'</option>';
      }
    }
   ?>  
  </select>
</td>    <td class="message"><?php echo $project_errors["project_name1"]; echo " ".$project_errors["project_name2"];?></td>
</tr>
<?php
/*
 * project, title, project_description, rev_project_name, funding, contact_id
 * project1 project2 project_title project_description funding contact
 * 
 * TODO: Add project name validation
 * 
*/

$arr_fields_to_show = array("project_title", "project_description", "funding");
foreach ($arr_fields_to_show as $field_name) {
  
  $error_message = $project_errors[$field_name];
  echo '
    <tr class="fields">
    <td class="fields" ><label for="project_form_'.$field_name.'">'.$field_name.'</label></td>
    <td><input class="text_inp size_long_input" type="text" name="'.$field_name.'" id="project_form_'.$field_name.'" value="'.$project_results[$field_name].'"/></td>
    <td class="message">'.$error_message.'</td>
    </tr>
  ';  
  
}
unset($value); // break the reference with the last element
?>
  <tr class="fields">
    <td class="fields" ><label for="project_form_contact">contact</label></td>
    <td colspan=5>
    <select name="project_form_contact" id="form_project_form_contact">
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
<table class="buttons" id="project_form-buttons"><tbody>
<tr class="buttons"><td class="buttons"><input type="submit" name="add" id="project_form_add" value="Submit New Project"/><input type="hidden" name="project_process" value="1"></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>
