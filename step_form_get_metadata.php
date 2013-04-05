<?php 
print_out($_SERVER);

?>
<form method="post" name="choose_run_m_form" id="choose_run_m_form" action="<?php echo $_SERVER["PHP_SELF"]?>">
<input type="hidden" name="form_name" id="choose_run_m_form_form_name" value="choose_run_m_form"/>
<table class="form" id="choose_run_m_form-form"><tbody>
<tr><td>
<table class="fields" id="choose_run_m_form-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="choose_run_m_form_choose_run_m">
<!-- <legend id="choose_run_m_form_choose_run_m-legend">Add new choose_run_m</legend> -->
<table class="fields" id="choose_run_m_form_choose_run_m-fields"><tbody>

<tr class="fields">
  <td class="fields" ><label for="choose_run_m_form_choose_run_m">Run date</label>
  </td>
  <td>
	<select name="find_rundate" id="form_find_rundate">
    <?php 
      print_options($runs, $selected_rundate);
    ?>
    </select>
  </td>
</tr> 

<tr class="fields">
  <td class="fields" ><label for="find_machine">Run date</label>
  </td>
  <td>
	<select name="find_machine" id="form_machine">
    <?php 
      print_options($machine_names, $selected_machine);
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
<table class="buttons" id="choose_run_m_form-buttons"><tbody>
<tr class="buttons"><td class="buttons">
<input type="submit" name="add" id="choose_run_m_form_add" value="Submit"/>
<input type="hidden" name="choose_run_m_process" value="1"></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>