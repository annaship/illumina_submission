<?php 
include_once 'filled_variables.php';
?>

<!-- <form action="step_ungzip_all.php" method="post"> -->
<!-- Name: <input class="text_inp" type="text" name="fname"> -->
<!-- Age: <input class="text_inp" type="text" name="age"> -->
<!-- <input type="submit"> -->
<!-- <input type="button" value="Go!" id="add_new_rows" name="copy_row"/> -->
<!-- </form> -->

<!-- <form action='step_ungzip_all.php' method='post'> -->
<!--   <button type='submit' name='reset'>Clear</button> -->
<!--   <button type='submit' name='submit'>Submit</button> -->
<!-- </form> -->

<form action='ill_submission_table.php' method='post'>
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
      unset($value); // break the reference with the last element
      
      ?>
      
      </tr>
      </thead>
      <tbody>
        
      <?php include_once("ill_submit_rows.php") ?>
      </tbody></table>
      <!-- <span class="pagebanner">20 items found, displaying 1 to 5.</span><span class="pagelinks">[First/Prev] <strong>1</strong>, <a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=1" title="Go to page 2">2</a>, <a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=2" title="Go to page 3">3</a>, <a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=3" title="Go to page 4">4</a> [<a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=1" title="Go to next page">Next</a>/<a href="step_subm_metadata.php?actionLink=table-controlLink&amp;page=3" title="Go to last page">Last</a>]</span></td>
       -->
      </tr>
      
      <tr><td align="left">
      <table class="buttons" id="form-buttons"><tbody>
      <tr><td colspan = 3>Copy the row above <input class="text_inp" type="text" name="copy_row" value="96" size="3"/> times </td>
      <td><input type="submit" value="Go!" id="add_new_rows" name="copy_row_go"/></td>
    </tr>
      
    </tbody>
  </table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>

<tr class="buttons">
<!-- <td><input type="button" value="Add another row" id="add_new_row" /></td> -->
<td class="buttons"><input type="submit" name="update" id="form_update" value="Update submition metadata"/> <input type="submit" name="cancel" id="form_cancel" value="Cancel"/></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>
