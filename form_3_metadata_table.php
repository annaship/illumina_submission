
<form action='ill_submission_table.php' method='post'>
<div id="submission_metadata">
  <fieldset id="form_subm_metadata">
      <legend id="form_subm_metadata-legend">Submition metadata</legend>
      <table id="form_subm_metadata-fields">
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
        
        <?php
            include("ill_submit_rows.php");
            for ($i = 0; $i < $repeat_subm_row; $i++) {
              include("ill_submit_rows.php");
              echo "<br/>";
          } 
        ?>     
        <tr>
          <td colspan = 2>Copy the row above <input class="text_inp" type="text" name="copy_row" value="96" size="3"/> times </td>
          <td><input type="submit" value="Go!" id="add_new_rows" name="copy_row_go"/></td>
        </tr>
        </tbody>
      </table>
  </fieldset>
  <input type="submit" name="update" id="form_update" value="Update submition metadata"/> <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
</div>
</form>
