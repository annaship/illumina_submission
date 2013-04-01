<?php 
// print "<br/>";
// print_r($_SERVER["SCRIPT_NAME"]);
// print_out($_SESSION);

// print "<br/>";
?>
<form method="post" name="find_rundate_form" id="find_rundate_form" action="<?php echo $_SESSION["meta_from"]; ?>">
<div id="find_rundate">
      <?php
        if (check_var($_SESSION["run_info"]["rundate"])) 
        {
          $selected_rundate = $_SESSION["run_info"]["rundate"];
        }
        
//         print_red_message($path_to_csv);
//         print_red_message($selected_rundate);
        
      ?>
       <select name="find_rundate" id="form_find_rundate">
         <?php 
         print_options($runs, $selected_rundate);
        ?>
        </select>
  <input type="submit" name="update" id="form_rundate" value="Choose rundate"/> 
<!--   <input type="submit" name="cancel" id="form_cancel" value="Cancel"/>  -->
  <input type="hidden" name="path_to_csv" id="form_path_to_csv" value="<?php echo $path_to_csv ?>"/>
  <input type="hidden" name="find_rundate_process" value="1">
  
  </div>
</form>

