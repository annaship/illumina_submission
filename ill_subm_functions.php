<?php 
function print_options($array_name, $selected_val)
{
  foreach ($array_name as $val)
  {
//       html = '<option value="'+value+'" selected="selected">'+text+'</option>';
//     <option value="volvo">Volvo</option>
    
    if ($selected_val == $val)
    {
      echo '<option value="'.$val.'" selected="selected">'.$val.'</option>';
    }
    else {
      echo '<option value="'.$val.'">'.$val.'</option>';
    }
  }
}



?>