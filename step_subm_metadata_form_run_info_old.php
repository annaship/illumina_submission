<form method="post" name="run_info_form" id="run_info_form" action="step_subm_metadata.php">
<input type="hidden" name="form_name" id="run_infoForm_form_name" value="run_infoForm"/>
<table class="form" id="run_infoForm-form"><tbody>
<tr><td>
<table class="fields" id="run_infoForm-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="run_infoForm_run_info">
<legend id="run_infoForm_run_info-legend">Run info</legend>
<table class="fields" id="run_infoForm_run_info-fields"><tbody>

  <tr class="fields">
  <?php $today = date("Ymd");?>
  <td class="fields" align="left"><label for="run_infoForm_rundate">rundate</label></td>
  <td align="left"><input class="text_inp size_long_input" type="text" name="rundate" id="run_infoForm_rundate" value="<?php PRINT "$today";?>"/></td>
  </tr>
  
  <tr class="fields">
  <td class="fields" align="left"><label for="run_infoForm_Path to raw data">Path to raw data</label></td>
  <td align="left"><span class="emph">/xraid2-2/sequencing/Illumina/</span><input class="text_inp size_long_input" type="text" name="Path to raw data" id="run_infoForm_Path to raw data" value=""/></td>
  </tr>

<!--   <tr class="fields"> -->
<!--   <td class="fields" align="left"><label for="run_infoForm_dna_region">dna_region</label></td> -->
<!--   <td> -->
<!--   <select name="dna_region" id="form_dna_region"> -->
<!--   <option selected="selected" value="v6">v6</option> -->
<!--   <option value="v4v5">v4v5</option> -->
<!--   </select></td> -->
<!--   </tr> -->
  
  <tr class="fields">
  <td class="fields" align="left"><label for="run_infoForm_dna_region">dna_region</label></td>
  <td>
  <select name="dna_region_0" id="form_dna_region_0">
   <?php 
       print_options($dna_regions, $selected_dna_region);    
    ?>
    </select>
    </td>
  </tr>
  
  
  <tr class="fields">
  <td class="fields" align="left"><label for="run_infoForm_overlap">overlap</label></td>
  <td>
  <select name="overlap_0" id="form_overlap_0">
   <?php 
       if ($selected_dna_region == "v6")
       {
         $selected_overlap = "complete";
       }
       elseif ($selected_dna_region == "v4v5") {
         $selected_overlap = "partial";
       }
       print_options($overlaps, $selected_overlap);    
    ?>
      <option value="None"></option>
    </select>
    </td>
  </tr>

  <?php 
    foreach ($arr_fields_run as &$value) {
      echo '
        <tr class="fields">
          <td class="fields" align="left"><label for="run_infoForm_'.$value.'">'.$value.'</label></td>
          <td align="left"><input class="text_inp size_abbr" type="text" name="'.$value.'" id="run_infoForm_'.$value.'" value=""/></td>
        </tr>      
      ';  
    }
    unset($value); // break the reference with the last element
  ?>
  
</tbody></table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>
<tr><td align="left">
<table class="buttons" id="run_infoForm-buttons"><tbody>
<tr class="buttons"><td class="buttons"><input type="submit" name="add" id="run_infoForm_add" value="Submit Run info"/></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>


