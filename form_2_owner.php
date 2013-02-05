<form method="post" name="data_ownerForm" id="data_ownerForm" action="/click-examples/table/edit-form-table.htm">
<input type="hidden" name="form_name" id="data_ownerForm_form_name" value="data_ownerForm"/>
<table class="form" id="data_ownerForm-form"><tbody>
<tr><td>
<table class="fields" id="data_ownerForm-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="data_ownerForm_data_owner">
<legend id="data_ownerForm_data_owner-legend">Add new data_owner</legend>
<table class="fields" id="data_ownerForm_data_owner-fields"><tbody>

<?php 
$arr_fields = array("data_owner", "first_name", "last_name", "email", "institution");
foreach ($arr_fields as &$value) {
  echo '
    <tr class="fields">
    <td class="fields" align="left"><label for="ownerForm_'.$value.'">'.$value.'</label></td>
    <td align="left"><input class="text_inp" type="text" name="'.$value.'" id="ownerForm_'.$value.'" value="" size="30"/></td>
    </tr>
  ';  

}
// $arr is now array(2, 4, 6, 8)
unset($value); // break the reference with the last element

?>


</tbody></table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>
<tr><td align="left">
<table class="buttons" id="data_ownerForm-buttons"><tbody>
<tr class="buttons"><td class="buttons"><input type="submit" name="add" id="data_ownerForm_add"/></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>

