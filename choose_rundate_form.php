<?php 
print "<br/>";
print_red_message("from rundate form");
print_out($_POST);
// // print_r($_SERVER["SCRIPT_NAME"]);
// // print_out($_SESSION);
// print_red_message($path_to_csv);
print "<br/>";
print "GGGG";
print_out($machine_names);
// $selected_machine = $_POST["find_machine"];
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
      <table id="rundate_form">
      <tr>
        <td>
          <select name="find_rundate" id="form_find_rundate">
          <?php 
          print_options($runs, $selected_rundate);
          ?>
          </select>        
        </td>
      </tr>

      <tr>
        <td>
          <select name="find_machine" id="form_machine">
          <?php 

          print_options($machine_names, $selected_machine);
          ?>
          </select>        
        </td>
      </tr>
      
      <tr>
        <td>
          <input type="submit" name="update" id="form_rundate" value="Choose rundate"/> 
          <input type="hidden" name="path_to_csv" id="form_path_to_csv" value="<?php echo $path_to_csv ?>"/>              
          <input type="hidden" name="find_rundate_process" value="1">  
        </td>
      </tr>
      
      </table>

  
  </div>
</form>

