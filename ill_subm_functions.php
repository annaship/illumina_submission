<?php 
function print_options($array_name, $val_name, $selected_val)
{
  foreach ($array_name as $val)
  {
//       html = '<option value="'+value+'" selected="selected">'+text+'</option>';
    if ($selected_val == $val)
    {
      echo '<option value="'.$val_name.'" selected="selected">'.$val.'</option>';
    }
    else {
      echo '<option value="'.$val_name.'">'.$val.'</option>';
    }
  }
}



?>