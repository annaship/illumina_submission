      <tr class="odd">
        <td>
          <select name="domain_0" id="form_domain_0">
           <?php 
              $domain_wo_abbr = array("Bacteria" => "B", "Archaea" => "A", "Eukarya" => "E", "Fungi" => "F");
              foreach ($domain_wo_abbr as $full_name => $abbr)
              {
                if ($selected_domain == $abbr)
                {
                  echo '<option value="'.$full_name.'" selected="selected">'.$full_name.'</option>';
                }
                else 
                {
                  echo '<option value="'.$full_name.'">'.$full_name.'</option>';
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
      
        <td><input class="text_inp wide"               type="text" name="run_key_0"       id="form_run_key_0"       readonly="readonly" 
        value="<?php echo $selected_run_key ?>"/></td>
        <td><input class="text_inp size_barcode_index" type="text" name="barcode_index_0" id="form_barcode_index_0" readonly="readonly" 
        value="<?php echo $selected_barcode_index ?>"/></td>
      
        <td>
        <select name="adaptor_0" id="form_adaptor_0">
      
       <?php
  		 print_options(array_values($adaptors), $selected_adaptor);    
//   		 get_run_key_by_adaptor($selected_adaptor);
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
        <select name="env_source_name_0" id="form_env_source_name_0">
      
       <?php 
         print_options($env_source_names, $selected_env_source_name);        
         ?>  
        </select></td>
        
      <?php 
      foreach ($arr_fields_add as &$value) {        
        echo '
        <td><input class="text_inp size_tubelabel" type="text" name="'.$value.'_0" id="form_'.$value.'_0" value="'.${'selected_'.$value}.'"/></td>
        ';  
      }
      unset($value); // break the reference with the last element
      ?>
      
      <tr class="even">
      </tr>
      
