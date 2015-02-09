<form method="post" name="project_form" id="project_form" action="step_upload_subm_metadata.php">
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
    $dna_regions = array("v6", "v4v5", "v4", "ITS1");
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
  <?php 
//   	list($project_errors, $project_results) = init_project_var($arr_to_initialize);
// 	print "<br/>UUU -";
// 	print_r($arr_to_initialize); 
// 	print " --<br/>";
	if (check_var($project_errors) == 0) {
		$project_errors = init_arr($project_errors, $arr_to_initialize);
	}
	foreach ($arr_project_fields as $field_name) {
		if ((check_var($project_errors) == 1) AND (!isset($project_errors[$field_name])))
		{
			$project_errors[$field_name] = "";
		}
		$error_message = $project_errors[$field_name];
	}	
  ?>
</td>    
<td class="message"><?php echo $project_errors["project_name1"]; echo " ".$project_errors["project_name2"];?></td>
</tr>
<?php
/*
 * project, title, project_description, rev_project_name, funding, contact_id
 * project1 project2 project_title project_description funding contact
 * 
 * TODO: Add project name validation
 * 
*/
foreach ($arr_fields_to_show as $field_name) {  
	if ((check_var($project_errors) == 1) AND (!isset($project_errors[$field_name])))
	{
		$project_errors[$field_name] = "";
	}
	$error_message = $project_errors[$field_name];
  echo '
    <tr class="fields">
    <td class="fields"><label for="project_form_'.$field_name.'">'.$field_name.'</label></td>
    <td class="fields"><input class="text_inp size_long_input" type="text" name="'.$field_name.'" id="project_form_'.$field_name.'" value="'.$project_results[$field_name].'"/></td>
    <td class="message">'.$error_message.'</td>
    </tr>
  ';  
}
// unset($value); // break the reference with the last element
// todo: Button "add new project - clear the project form"
?>
  <tr class="fields">
    <td class="fields" ><label for="env_source_name">env_source_name</label></td>
    <td colspan=1>
    <select name="env_source_name" id="form_env_source_name">
   <?php 
     print_options($env_source_names, $selected_env_source_name);
     if ((check_var($project_errors) == 1) AND (!isset($project_errors["env_source_name"])))
     {
     	$project_errors["env_source_name"] = "";
     }
     $error_message = $project_errors["env_source_name"];
      
   ?>
    </select></td>
    <td class="message"><?php print $project_errors["env_source_name"];?></td>
  </tr>

  <tr class="fields">
    <td class="fields" ><label for="project_form_contact">contact</label></td>
    <td colspan=5>
    <select name="project_form_contact" id="form_project_form_contact">
   <?php 
     print_options($contact_full, $selected_contact_full);  
   ?>
    </select></td>
  </tr>
  <tr>
	<td></td><td class="message">Please contact Anya or Andy if the PI name is not in the list.</td>
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