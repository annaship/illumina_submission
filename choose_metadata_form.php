<?php 
//     print_r($_SESSION);
//     print "<br/>";
//     print "HERE2";
    $path_to_csv = $_POST["path_to_csv"] . $_POST["find_rundate"];
//     print "<br/>";
//     print $path_to_csv;
//     print "<br/>";
    $csv_files = array();
    $all_dirs  = array();
    
    if ($handle = opendir($path_to_csv))
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
//     print_r($csv_files);
// //     print_red_message($all_dirs)
    
//     ?>
    <form method="post" name="find_metadata_form" id="find_metadata_form" action="<?php echo $_SESSION["meta_from"]; ?>">
    <div id="find_metadata">
    
    <select name="csv_files_find" id="form_csv_files">
    <?php 
      print_options($csv_files, $selected_csv);
    ?>
    </select>
    <input type="submit" name="update" id="form_metadata" value="Choose metadata"/> 
    <!--   <input type="submit" name="cancel" id="form_cancel" value="Cancel"/>  -->
    <input type="hidden" name="path_to_csv" value="<?php echo $path_to_csv; ?>">    
    <input type="hidden" name="find_metadata_process" value="1">
    
      </div>
    </form>

