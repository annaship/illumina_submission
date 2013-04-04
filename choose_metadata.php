<?php 
// print "<br/>";
// print_red_message("from choose metadata");
// print "<br/>";
// print_out($_POST);
// // print_r($_SERVER["SCRIPT_NAME"]);
// // print_out($_SESSION);
// print_red_message($path_to_csv);
print "<br/>";
?>
<?php
// print_out($_SERVER["SCRIPT_NAME"]);
if(!isset($_SESSION)) {
  session_start();
}
// $path_to_csv = "";

$_SESSION["meta_from"] = $_SERVER["SCRIPT_NAME"];
// print_out($_SESSION);

    $show_class = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["find_rundate_process"] == 1) 
  {      
    $show_class = "show_block";
      
      include_once 'choose_metadata_form.php';
  }
  elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["find_metadata_process"] == 1)
  {
//     print "HERE";
//     print_out($_POST);
    list($first_part, $file_rundate, $file_line) = explode("_", pathinfo($_POST["csv_files_find"],  PATHINFO_FILENAME));
//     print_red_message(pathinfo($_POST["csv_files_find"],  PATHINFO_FILENAME));
//     print_red_message($file_line);
  }
  
    
?>
          
    <br />
    <input type="button" value="Choose another run" class="hide_find_run" />
    
    <table>
         <tr style="display:none;" class="hide_find_run_tr <?php echo $show_class; ?>">
           <td colspan="3">
             <?php include("choose_rundate_form.php"); ?>                 
        </td>
      </tr>
    </table>