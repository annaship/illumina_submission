<?php 
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; upload_subm_metadata_form_run_info");

// print "\$run_info_results: ";
// print_out($run_info_results);
// print "\$_SESSION[run_info]: ";
// print_out($_SESSION["run_info"]);

if (!isset($run_info_errors))
{
	$run_info_errors = array();
}
if (!isset($run_info_results))
{
	$run_info_results = array();
}

if (check_var($_SESSION["run_info"]))
{
	$run_info_results = $_SESSION["run_info"];
}
if (isset($run_info_results["rundate"]))
{
	$selected_rundate = $run_info_results["rundate"];
}
else
{
    $selected_rundate = date("Ymd");
}
if (isset($run_info_results["overlap"]))
{
	$selected_overlap = $run_info_results["overlap"];	
}
else 
{
	$selected_overlap = "";
}

if (isset($run_info_results["path_to_raw_data"]))
{	
	$selected_path_to_raw_data = $run_info_results["path_to_raw_data"];
}
else 
{
	$selected_path_to_raw_data = "";
}
if (!isset($selected_dna_region_base))
{
	$selected_dna_region_base = "";
}
?>

<form method="post" name="run_info_form" id="run_info_form" action="<?php echo $_SERVER["PHP_SELF"]?>">
<input type="hidden" name="form_name" id="run_info_form_form_name" value="run_info_form"/>
<table class="form" id="run_info_form-form"><tbody>
<tr><td>
<table class="fields" id="run_info_form-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="run_info_form_run_info">
<legend id="run_info_form_run_info-legend">Run info</legend>
<table class="fields" id="run_info_form_run_info-fields"><tbody>

  <tr class="fields">
  <td class="fields" align="left"><label for="run_infoForm_rundate">rundate</label></td>
  <td align="left"><input class="text_inp size_long_input" type="text" name="rundate" id="run_infoForm_rundate" value="<?php echo $selected_rundate;?>"/></td>
  </tr>
  
  <tr class="fields">
  <td class="fields" align="left"><label for="run_infoForm_path to raw data">path to raw data</label></td>
  <td align="left"  colspan = 5><span class="emph">/xraid2-2/sequencing/Illumina/</span><input class="text_inp size_long_input" type="text" 
      name="path to raw data" id="run_infoForm_path to raw data" value="<?php echo $selected_path_to_raw_data;?>"/></td>
  </tr>

  <tr class="fields">
  <td class="fields" align="left"><label for="run_infoForm_dna_region">dna_region</label></td>
  <td>
  <select name="dna_region_0" id="form_dna_region_0">
   <?php 
   	if (!check_var($selected_dna_region_base))
   	{ 
   		$selected_dna_region_base = "";
   	}
   		print_options($dna_regions, $selected_dna_region_base);
    ?>
    </select>
    </td>
  </tr>
  
  
  <tr class="fields">
  <td class="fields" align="left"><label for="run_infoForm_overlap">overlap</label></td>
  <td>
  <select name="overlap" id="form_overlap">
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
    <td class="message"><?php 
    if (isset($run_info_errors["overlap"]))
    {
    	echo $run_info_errors["overlap"];
    }
    ?></td>
  </tr>

  <?php 

  foreach ($arr_fields_run as $field_name) {
    if (!isset($run_info_errors[$field_name]))
    {
      $run_info_errors[$field_name] = "";
    }
    $error_message = $run_info_errors[$field_name];
    $res_field     = "";
    if (isset($run_info_results[$field_name]))
    {
    	$res_field = $run_info_results[$field_name];
    }
    echo '
    <tr class="fields">
    <td class="fields"><label for="run_info_form_'.$field_name.'">'.$field_name.'</label></td>
    <td class="fields"><input class="text_inp size_abbr" type="text" name="'.$field_name.'" id="run_info_form_'.$field_name.'" value="'. $res_field .'"/></td>
    <td class="message">'.$error_message.'</td>
    </tr>
    ';
  }
 
  $_SESSION["run_info_errors"] = $run_info_errors;
  ?>
  
</tbody></table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>
<tr><td >
<?php 

if (isset($_SESSION["run_info_valid"]) && $_SESSION["run_info_valid"] == 0)
{
?>
<table class="buttons" id="run_info_form-buttons"><tbody>
<tr class="buttons"><td class="buttons"><input type="submit" name="add" id="run_info_form_add" value="Submit Run info"/>
<input type="hidden" name="run_info_process" value="1"></td></tr>
</tbody></table>
<?php 
}
?>
</td></tr>
</tbody></table>
</form>