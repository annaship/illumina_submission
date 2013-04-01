<?php

    $show_class = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["find_rundate_process"] == 1) 
  {      
    $show_class = "show_block";
      
      include_once 'choose_metadata_form.php';
  }
    
?>
          
    <br />
    <input type="button" value="Choose run" class="hide_find_run" />
    
    <table>
         <tr style="display:none;" class="hide_find_run_tr <?php echo $show_class; ?>">
           <td colspan="3">
             <?php include("choose_rundate_form.php"); ?>                 
        </td>
      </tr>
    </table>