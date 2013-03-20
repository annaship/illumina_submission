<!-- <form action='step_subm_metadata_form_metadata_table_submit.php' method='post'> -->
<form method="post" name="submission_metadata_form" id="submission_metadata_form" action="step_subm_metadata.php">
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
              foreach ($selected_metadata_arr as $selected_metadata_arr1)
              {
//                 take only arrays with selected values
                if(isset($selected_metadata_arr1["domain"]))
                {
                  foreach($selected_metadata_arr1 AS $key => $value)
                  {
                    ${"selected_" . $key} = $value;
                  }
                  include("step_subm_metadata_form_metadata_table_rows.php");
//                   TODO: 1) not show "check submission" 
//                   TODO: 2) not show the array #0 (from "check submission")
//                   TODO: 3) show barcode_index and run_key
                }
              }
          ?>     
        </tbody>
    </table>
<!--   <a href="#" title="" class="add-author">Add Author</a> -->
  </fieldset>
  <input type="submit" name="update" id="form_update" value="Update submission metadata"/> 
  <input type="submit" name="cancel" id="form_cancel" value="Cancel"/> 
  <input type="hidden" name="submission_metadata_process" value="2">
</div>
</form>
