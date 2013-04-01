<?php 
print "<br/>";
print_red_message("from choose metadata form form");
print "<br/>";
print_out($_POST);
// print_r($_SERVER["SCRIPT_NAME"]);
// print_out($_SESSION);
// print_red_message($path_to_csv);
print "<br/>";
$selected_machine = $_POST["find_machine"];
?>
<?php 
//     print_r($_SESSION);
//     print "<br/>";
//     print_out($_POST);
    //     print "<br/>";
//     print "HERE2";
//     $new_path_to_csv = "";
    $new_path_to_csv = $path_to_csv . $_POST["find_rundate"];
//     print "<br/>";
//     print $new_path_to_csv;
//     print "<br/>";
    $csv_files = array();
    $all_dirs  = array();
    
    if ($handle = opendir($new_path_to_csv))
    {
      while (false !== ($entry = readdir($handle)))
      {
//         print_r($entry);
        // TODO: if several lines go under
        if ($entry != "." && $entry != ".." && (pathinfo($entry, PATHINFO_EXTENSION) == "csv"))
        {
          $csv_files[] = $entry;
          //         echo "$entry\n";
        }
        elseif (is_dir($entry))
        {
          $all_dirs[] = $entry;
        }
      }
      closedir($handle);
    }
    if (check_var(!$csv_files)) {
      print_red_message("There is no csv files in $new_path_to_csv<br/>")
      ;
    }
    else 
    {
    
     ?>
    <form method="post" name="find_metadata_form" id="find_metadata_form" action="<?php echo $_SESSION["meta_from"]; ?>">
    <div id="find_metadata">
    
    <select name="csv_files_find" id="form_csv_files">
    <?php 
      print_options($csv_files, $selected_csv);
    ?>
    </select>
    <input type="submit" name="update" id="form_metadata" value="Choose metadata"/> 
    <!--   <input type="submit" name="cancel" id="form_cancel" value="Cancel"/>  -->
    <input type="hidden" name="path_to_csv" value="<?php echo $new_path_to_csv; ?>">    
    <input type="hidden" name="find_machine" value="<?php echo $selected_machine; ?>">    
    <input type="hidden" name="find_metadata_process" value="1">
    
      </div>
    </form>
    <?php 
    } #else
    ?>
