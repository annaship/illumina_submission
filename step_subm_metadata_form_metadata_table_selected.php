<form method="post" name="submission_metadata_selected_form" id="submission_metadata_selected_form" action="step_subm_metadata.php">
<div id="submission_metadata">
  <fieldset id="submission_metadata">
    <legend id="submission_metadata-legend">Submition metadata</legend>
    <table id="submission_metadata-fields">
      <thead>
        <tr>
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
          foreach ($selected_metadata_arr as $num_key => $selected_metadata_arr1)
              {
                if(isset($selected_metadata_arr1["domain"]))
                {
                  foreach($selected_metadata_arr1 AS $key => $value)
                  {
                    ${"selected_" . $key} = $value;
                  }
                  include("step_subm_metadata_form_metadata_table_rows.php");
                }
                if (isset($metadata_errors_all[$num_key]))
                {
                  echo "<tr class=\"even\">";
                  foreach ($arr_fields_headers as &$value) 
                  {
                    echo "<td class=\"message\">";
                      print $metadata_errors_all[$num_key][$value];
                    echo "</td>";
                  }
                  echo "</tr>";
                }
              }
          ?>     
        </tbody>
    </table>
  </fieldset>
  <input type="submit" name="update" id="form_update" value="Update submission metadata"/> 
  <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
  <input type="hidden" name="submission_metadata_process" value="2">
</div>
</form>
