<form action='step_subm_metadata_form_metadata_table_submit.php' method='post'>
<div id="submission_metadata">
  <fieldset id="submission_metadata">
    <legend id="submission_metadata-legend">Submition metadata</legend>
    <table id="submission_metadata-fields">
      <thead>
        <tr>
          <!-- add auto complete -->
          <?php 
          
          foreach ($arr_fields_headers as &$value) {
            echo '
            <th>'.$value.'</th>
            ';  
          
          }
          unset($value); // break the reference with the last element
          
          ?>      
          </tr>
        </thead>
        <tbody>   
          <?php
              include("step_subm_metadata_form_metadata_table_rows.php");
          ?>     
          <tr class="repeat_row_tr">
            <td colspan = 3>Copy the row above <input class="text_inp size_abbr" type="text" id="copy_row_times" value="2"/> times </td>
            <td><input type="button" value="Go!" id="add_new_rows"/></td>
          </tr>
        </tbody>
    </table>
<!--   <a href="#" title="" class="add-author">Add Author</a> -->
  </fieldset>
  <input type="submit" name="update" id="form_update" value="Update submition metadata"/> <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
</div>
</form>
