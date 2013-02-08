      <tr class="odd">
        <td>
        <select name="domain_0" id="form_domain_0">
        <option selected="selected" value="Bacteria">Bacteria</option>
        <option value="Archaea">Archaea</option>
        <option value="Eukarya">Eukarya</option>
        <option value="Fungi">Fungi</option>
        </select></td>
      
        <td><input class="text_inp" type="text" name="lane_0" id="form_lane_0" value="<?php echo $selected_lane ?>" size="1"/></td>
        
        <!-- Show Suite by dna_region plus domain -->
      
        <td>
      
        <select name="data_owner_0" id="form_data_owner_0">
         <?php 
      //   TODO: how to chose if 2 the same name?
        print_options($contact, "contact", $selected_data_owner);
        
        ?>
        </select></td>
      
        <td>NNNN<input class="text_inp" type="text" name="run_key_0" id="form_run_key_0" value="" size="10"/></td>
          
        <td><input class="text_inp" type="text" name="barcode_index_0" id="form_barcode_index_0" value="" size="6"/></td>
      
        <td>
        <select name="project_0" id="form_project_0">
      
       <?php 
        print_options($project, "project");        
        ?>  
        </select></td>
      
        <td><input class="text_inp" type="text" name="dataset_0" id="form_dataset_0" value="" size="30"/></td>
        <td><input class="text_inp" type="text" name="dataset_description_0" id="form_dataset_description_0" value="" size="30"/></td>
      
        <td>
        <select name="env_source_name_0" id="form_env_source_name_0">
      
       <?php 
         print_options($env_source_names, "env_source_name", $selected_env_source_name);        
         ?>  
        </select></td>
        
      <?php 
      # _0 - number of row
      foreach ($arr_fields_add as &$value) {
        echo '
        <td><input class="text_inp" type="text" name="'.$value.'_0" id="'.$value.'_0" value="" size="10"/></td>
        ';  
      }
      unset($value); // break the reference with the last element
      ?>
      
      <tr class="even">
      </tr>
      
