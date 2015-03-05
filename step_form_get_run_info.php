<?php 
// print_out($_SERVER);
// print_red_message("From ". $_SERVER["PHP_SELF"] . "; step_form_get_run");

?>
<form method="post" name="choose_run_m_form" id="choose_run_m_form" action="<?php echo $_SERVER["PHP_SELF"]?>">
<input type="hidden" name="form_name" id="choose_run_m_form_form_name" value="choose_run_m_form"/>
<table class="form" id="choose_run_m_form-form"><tbody>
<tr><td>
<table class="fields" id="choose_run_m_form-fields"><tbody>

<tr class="fields">
<td class="fields" colspan="2">
<fieldset id="choose_run_m_form_choose_run_m">
<!-- <legend id="choose_run_m_form_choose_run_m-legend">Add new choose_run_m</legend> -->
<table class="fields" id="choose_run_m_form_choose_run_m-fields"><tbody>

<tr class="fields">
  <td class="fields"><label for="choose_run_m_form_choose_run_m">Run date</label>
  </td>
  <td>
	<select name="find_rundate" id="form_find_rundate">
    <?php 
	    if (!isset($selected_rundate))
	    {
	    	$selected_rundate = "";
	    	if (isset($_POST["find_rundate"]))
	    	{
	    		$selected_rundate = $_POST["find_rundate"];
	    	}
	    }
      	print_options($runs, $selected_rundate);
    ?>
    </select>
  </td>
</tr> 

<tr class="fields">
  <td class="fields" ><label for="find_machine">Machine name</label>
  </td>
  <td>
	<select name="find_machine" id="form_machine">
    <?php 
      if (!isset($selected_machine))
      {
      	$selected_machine = "";
      	if (isset($_POST["find_machine"]))
      	{
      		$selected_machine = $_POST["find_machine"];
      	}
      }
//       $selected_machine = from_post_or_empty($_POST, )
      print_options($machine_names, $selected_machine);
    ?>
    </select>
  </td>
</tr> 

<tr class="fields">
  <td class="fields" ><label for="find_domain">Domain</label>
  </td>
  <td>
	<select name="find_domain" id="form_domain">
    <?php 
      if (!isset($selected_domain))
      {
      	$selected_domain = "Bacteria";
      	if (isset($_POST["find_domain"]))
      	{
      		$selected_domain = $_POST["find_domain"];
      	}
      }
      print_out($domains_array);
//       $selected_domain = from_post_or_empty($_POST, )
      print_options($domains_array, $selected_domain);
    ?>
    </select>
  </td>
</tr> 

<tr class="fields">
  <td class="fields" ><label for="find_lane">Lane number</label>
  </td>
  <td>
  	<input class="text_inp size_abbr" type="text" name="find_lane" id="form_lane" value="<?php echo $selected_lane;?>"/>
  </td>
</tr> 

<!-- Full path to raw data -->
<!-- <tr class="fields"> -->
<!--   <td class="fields" align="left"><label for="run_infoForm_path to raw data">path to raw data</label></td> -->
<!--   <td align="left"  colspan = 5><span class="emph">/xraid2-2/sequencing/Illumina/</span><input class="text_inp size_long_input" type="text"  -->
<!--      name="path to raw data" id="run_infoForm_path to raw data" value="<?php #echo $selected_path_to_raw_data;?>"/></td> -->
<!-- </tr> -->

</tbody></table>
</fieldset>
</td>
</tr>
</tbody></table>
</td></tr>
<tr><td >
<table class="buttons" id="choose_run_m_form-buttons"><tbody>
<tr class="buttons"><td class="buttons">
<input type="submit" name="add" id="choose_run_m_form_add" value="Submit"/>
<input type="hidden" name="choose_run_m_process" value="1"></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</form>