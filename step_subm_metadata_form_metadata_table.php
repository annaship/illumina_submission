<!-- <form action='step_subm_metadata_form_metadata_table_submit.php' method='post'> -->
<form method="post" name="submission_metadata_form" id="submission_metadata_form" action="step_subm_metadata.php">
<div id="submission_metadata">
  <fieldset id="submission_metadata">
    <legend id="submission_metadata-legend">Submission metadata</legend>
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
              $row_num = 0;
              include("step_subm_metadata_form_metadata_table_rows.php");
          ?>     
          <tr class="repeat_row_tr">
            <td colspan = 3>Copy the row above <input class="text_inp size_number" type="text" id="copy_row_times" value="2"/> times <input type="button" value="Go!" id="add_new_rows"/></td>
          </tr>
        </tbody>
    </table>
<!--   <a href="#" title="" class="add-author">Add Author</a> -->
  </fieldset>
  <input type="submit" name="update" id="form_update_metadata_table" value="Check submission metadata"/> 
  <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
  <input type="hidden" name="submission_metadata_process" value="1">
  <input type="hidden" name="selected_dna_region_base" value="<?php echo $selected_dna_region_base?>">
  
</div>
</form>
