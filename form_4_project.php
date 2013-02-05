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

<?php
/*
 * project, title, project_description, rev_project_name, funding, env_sample_source_id, contact_id
 * 
 * TODO: Add project name validation
 * 
 * */

$arr_fields = array("project", "project_title", "project_description", "funding");
foreach ($arr_fields as &$value) {
  echo '
    <tr class="fields">
    <td class="fields" align="left"><label for="projectForm_'.$value.'">'.$value.'</label></td>
    <td align="left"><input class="text_inp" type="text" name="'.$value.'" id="projectForm_'.$value.'" value="" size="30"/></td>
    </tr>
  ';  

}
unset($value); // break the reference with the last element
?>
  <tr class="fields">
    <td class="fields" align="left"><label for="projectForm_env_sample_source">env_sample_source</label></td>
    <td>
    <select name="project_0" id="form_project_0">
   <?php 
    $query = "SELECT DISTINCT env_source_name FROM env454.env_sample_source ORDER BY env_source_name";
    $result = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $rundate_result: ".mysql_error());
    
    while($row = mysql_fetch_row($result))
    {
      echo '<option value="contact">'.$row[0].'</option>';
    }
  ?>
    </select></td>
  </tr>

  <tr class="fields">
    <td class="fields" align="left"><label for="projectForm_contact">contact</label></td>
    <td>
    <select name="project_0" id="form_project_0">
   <?php 
    $query = "SELECT DISTINCT last_name, first_name, email, institution FROM env454.contact WHERE last_name <> '' ORDER BY last_name";
    $result = mysql_query($query, $newbpc2_connection) or die("SELECT Error: $rundate_result: ".mysql_error());
    
    while($row = mysql_fetch_row($result))
    {
      echo '<option value="contact">'.$row[0].', '.$row[1].', '.$row[2].', '.$row[3].'</option>';
    }
  ?>
    </select></td>
  </tr>

</tbody></table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>
<tr><td align="left">
<table class="buttons" id="projectForm-buttons"><tbody>
<tr class="buttons"><td class="buttons"><input type="submit" name="add" id="projectForm_add"/></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>
