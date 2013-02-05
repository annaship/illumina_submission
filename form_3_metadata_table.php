<?php 
include_once 'filled_variables.php';
?>


<form method="post" name="form" id="form" action="step_subm_metadata.php">
<input type="hidden" name="page" id="form_page" value=""/>
<input type="hidden" name="column" id="form_column" value=""/>
<input type="hidden" name="ascending" id="form_ascending" value=""/>
<input type="hidden" name="SUBMIT_CHECK_form_table_edit-form-table.htm" id="form_SUBMIT_CHECK_form_table_edit-form-table_htm" value="1359742287604"/>
<input type="hidden" name="form_name" id="form_form_name" value="form"/>
<table class="form" id="form-form"><tbody>

<tr><td>
<table class="fields" id="form-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="form_subm_metadata">
<legend id="form_subm_metadata-legend">Submition metadata</legend>
<table class="fields" id="form_subm_metadata-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<table id="table_subm" class="simple">
<thead>

<tr>
<!-- add auto complete -->
<?php 

foreach ($arr_fields_headers as &$value) {
  echo '
  <th class="sortable"><a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=0&amp;column='.$value.'">'.$value.'</a></th>
  ';  

}
// $arr is now array(2, 4, 6, 8)
unset($value); // break the reference with the last element

?>

</tr>
</thead>
<tbody>
  
<tr class="odd">
  <td>
  <select name="dna_region_0" id="form_dna_region_0">
  <option selected="selected" value="v6">v6</option>
  <option value="v4v5">v4v5</option>
  </select></td>

  <td>
  <select name="domain_0" id="form_domain_0">
  <option selected="selected" value="Bacteria">Bacteria</option>
  <option value="Archaea">Archaea</option>
  <option value="Eukarya">Eukarya</option>
  <option value="Fungi">Fungi</option>
  </select></td>

  <td><input class="text_inp" type="text" name="lane_0" id="form_lane_0" value="" size="1"/></td>
  
  <!-- Show Suite by dna_region plus domain -->

  <td>

  <select name="data_owner_0" id="form_data_owner_0">
   <?php 
//   TODO: how to chose if 2 the same name?
  while($row = mysql_fetch_row($result_contact))
  {
    echo '<option value="contact">'.$row[1].', '.$row[0].'</option>';
  }
  
  ?>
  </select></td>

  <td>NNNN<input class="text_inp" type="text" name="run_key_0" id="form_run_key_0" value="" size="10"/></td>
    
  <td><input class="text_inp" type="text" name="barcode_index_0" id="form_barcode_index_0" value="" size="6"/></td>

  <td>
  <select name="project_0" id="form_project_0">

 <?php 
  while($row = mysql_fetch_row($result_project))
  {
    echo '<option value="project">'.$row[0].'</option>';
  }
  
  ?>  
  </select></td>

  <td><input class="text_inp" type="text" name="dataset_0" id="form_dataset_0" value="" size="30"/></td>
  <td><input class="text_inp" type="text" name="dataset_description_0" id="form_dataset_description_0" value="" size="30"/></td>

<?php 
# _0 - number of row
foreach ($arr_fields_add as &$value) {
  echo '
  <td><input class="text_inp" type="text" name="'.$value.'_0" id="'.$value.'_0" value="" size="10"/></td>
  ';  
}
unset($value); // break the reference with the last element
?>

<tr class="even">
</tr>

</tbody></table>
<!-- <span class="pagebanner">20 items found, displaying 1 to 5.</span><span class="pagelinks">[First/Prev] <strong>1</strong>, <a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=1" title="Go to page 2">2</a>, <a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=2" title="Go to page 3">3</a>, <a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=3" title="Go to page 4">4</a> [<a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=1" title="Go to next page">Next</a>/<a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=3" title="Go to last page">Last</a>]</span></td>
 -->
</tr>
</tbody></table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>

<tr><td align="left">
<table class="buttons" id="form-buttons"><tbody>
<tr><td><div id="add_new_row">Add another row</div></td>
</tr>
<tr class="buttons">
<!-- <td><input type="button" value="Add another row" id="add_new_row" /></td> -->
<td class="buttons"><input type="submit" name="update" id="form_update" value="Update submition metadata"/></td><td class="buttons"><input type="submit" name="cancel" id="form_cancel" value="Cancel"/></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>

    <label for="txtValue">Enter a value : </label>
    <input type="text" class="text_inp" name="txtValue" value="" id="txtValue">
    
    <div id="display"></div>
