      <tr class="odd">
        <td>
          <select name="domain_<?php echo $row_num;?>" id="form_domain_<?php echo $row_num;?>">
           <?php 
             print_options(array_values($domains_array), $selected_domain);
            ?>
          </select>                
        </td>
      
        <td><input class="text_inp size_number" type="text" name="lane_<?php echo $row_num;?>" id="form_lane_<?php echo $row_num;?>" value="<?php echo $selected_lane ?>"/></td>
        
        <!-- Show Suite by dna_region plus domain -->     
        <td>

        <select name="data_owner_<?php echo $row_num;?>" id="form_data_owner_<?php echo $row_num;?>">
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
      
        <td>NNNN<input class="text_inp wide"           type="text" name="run_key_<?php echo $row_num;?>"       
        id="form_run_key_<?php echo $row_num;?>"        
        value="<?php echo $selected_run_key ?>"/></td>
        <td><input class="text_inp size_barcode_index" type="text" name="barcode_index_<?php echo $row_num;?>" 
        id="form_barcode_index_<?php echo $row_num;?>"  
        value="<?php echo $selected_barcode_index ?>"/></td>
      
        <td>
        <select name="adaptor_<?php echo $row_num;?>" id="form_adaptor_<?php echo $row_num;?>">
      
       <?php
  		 print_options(array_values($adaptors), $selected_adaptor);    
        ?>  
        </select></td>
        <td>
        <select name="project_<?php echo $row_num;?>" id="form_project_<?php echo $row_num;?>">
      
       <?php
			print_options($project, $selected_project);        
        ?>  
        </select></td>
      
        <td><input class="text_inp size_dataset" type="text" name="dataset_<?php echo $row_num;?>" id="form_dataset_<?php echo $row_num;?>" value="<?php echo $selected_dataset ?>"/></td>
        <td><input class="text_inp size_dataset" type="text" name="dataset_description_<?php echo $row_num;?>" id="form_dataset_description_<?php echo $row_num;?>" value="<?php echo $selected_dataset_description ?>"/></td>
      
        <td>
        <select name="env_source_name_<?php echo $row_num;?>" id="form_env_source_name_<?php echo $row_num;?>">
      
       <?php 
         print_options($env_source_names, $selected_env_source_name);        
         ?>  
        </select></td>
        
      <?php 
      foreach ($arr_fields_add as &$value) {        
        echo '
        <td><input class="text_inp size_tubelabel" type="text" name="'.$value.'_'.$row_num.'" id="form_'.$value.'_'.$row_num.'" value="'.${'selected_'.$value}.'"/></td>
        ';  
      }
      unset($value); // break the reference with the last element
      ?>
      
      <tr class="even">
      </tr>
      
