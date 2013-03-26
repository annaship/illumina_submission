<?php 
  $file_name = $_FILES["csv"]["tmp_name"];
  $csv_data = get_data_from_csv($file_name);
//   print_out($csv_data);
 
?>

<form method="post" name="subm_metadata_upload_form" id="subm_metadata_upload_form" action="step_subm_metadata_upload.php">
<div id="subm_metadata_upload">
  <fieldset id="subm_metadata_upload">
    <legend id="subm_metadata_upload-legend">Submition metadata</legend>
    <table id="subm_metadata_upload-fields">
      <thead>
        <tr>
          <!-- add auto complete -->
          <?php 
          $field_name = "";
          foreach ($csv_data[0] as $field_name) {
            echo "
            <th>".$field_name."</th>
            ";  
          
          }
          unset($field_name); // break the reference with the last element
          
          ?>      
          </tr>
        </thead>
        <tbody>   
          <tr>
          <?php 
          array_shift($csv_data);
          foreach ($csv_data as $csv_data_row) {
            echo "<tr>";
            foreach ($csv_data_row as $csv_data_value)
            {
              echo "
              <td>".$csv_data_value."</td>
              ";
            }  
            echo "</tr>";
          }
          unset($field_name); // break the reference with the last element
          
          ?>      
          </tr>
          <?php
          
          
//               $row_num = 0;
//               include("step_subm_metadata_upload_form_metadata_table_rows.php");
          ?>     
        </tbody>
    </table>
<!--   <a href="#" title="" class="add-author">Add Author</a> -->
  </fieldset>
<!--   <input type="submit" name="update" id="form_update" value="Check submission metadata"/>  -->
<!--   <input type="submit" name="cancel" id="form_cancel" value="Cancel"/>  -->
<!--   <input type="hidden" name="subm_metadata_upload_process" value="1"> -->
</div>
</form>