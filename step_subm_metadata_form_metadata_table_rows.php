<?php 
// print_out($selected_dna_region);
// print_out(array_values($adaptors));
// print_out($selected_adaptor);

?>
      <tr class="odd">
        <td>
          <select name="domain_0" id="form_domain_0">
           <?php 
              $domain_wo_abbr = array("Bacteria" => "B", "Archaea" => "A", "Eukarya" => "E", "Fungi" => "F");
              foreach ($domain_wo_abbr as $full_name => $abbr)
              {
                if ($selected_domain == $abbr)
                {
                  echo '<option value="'.$abbr.'" selected="selected">'.$full_name.'</option>';
                }
                else 
                {
                  echo '<option value="'.$abbr.'">'.$full_name.'</option>';
                }
              }
            ?>
          </select>                
        </td>
      
        <td><input class="text_inp size_number" type="text" name="lane_0" id="form_lane_0" value="<?php echo $selected_lane ?>"/></td>
        
        <!-- Show Suite by dna_region plus domain -->     
        <td>

        <select name="data_owner_0" id="form_data_owner_0">
         <?php 
      //   TODO: how to chose if 2 the same name?
//          $selected_data_owner = "Anderson, Rika";
         if (!isset($selected_data_owner) or $selected_data_owner == "")
         {
           $contact_full_selected = $_POST['project_form_contact'];
           $vamps_name = array_search($contact_full_selected, $contact_full);
           $selected_data_owner = $contact[$vamps_name];
         }
         print_options($contact, $selected_data_owner);
          
        ?>
        </select></td>
      
        <td><div class="wide">NNNN<?php echo $selected_run_key ?></div></td>
          
        <td><div class="size_barcode_index" <?php echo $selected_barcode_index ?>/></div></td>
      
        <td>
        <select name="adaptor_0" id="form_adaptor_0">
      
       <?php
         print_out($adaptors_full);
  		 print_options(array_values($adaptors), $selected_adaptor);        
        ?>  
        </select></td>
        <td>
        <select name="project_0" id="form_project_0">
      
       <?php
			print_options($project, $selected_project);        
        ?>  
        </select></td>
      
        <td><input class="text_inp size_dataset" type="text" name="dataset_0" id="form_dataset_0" value="<?php echo $selected_dataset ?>"/></td>
        <td><input class="text_inp size_dataset" type="text" name="dataset_description_0" id="form_dataset_description_0" value="<?php echo $selected_dataset_description ?>"/></td>
      
        <td>
        <select name="env_source_name" id="form_env_source_name_0">
      
       <?php 
         print_options($env_source_names, $selected_env_source_name);        
         ?>  
        </select></td>
        
      <?php 
      # _0 - number of row
//       TODO add value="<?php echo $selected_dataset " to each
      foreach ($arr_fields_add as &$value) {        
        echo '
        <td><input class="text_inp size_tubelabel" type="text" name="'.$value.'_0" id="form_'.$value.'_0" value="'.${'selected_'.$value}.'"/></td>
        ';  
      }
      unset($value); // break the reference with the last element
      ?>
      
      <tr class="even">
      </tr>
      
