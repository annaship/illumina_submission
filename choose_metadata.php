<?php 
// print "<br/>";
// print_blue_message("from choose_metadata");
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; choose_metadata");

// print "<br/>";
// print_out($_POST);
// // print_r($_SERVER["SCRIPT_NAME"]);
// print_out($_SESSION);
// print_blue_message($path_to_csv);
// print "<br/>";
?>
<?php
// print_red_message("From ". $_SERVER["PHP_SELF"] . "; choose_metadata");
if(!isset($_SESSION)) {
  session_start();
}

$_SESSION["meta_from"] = $_SERVER["SCRIPT_NAME"];

$show_class = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["choose_run_m_process"]) && $_POST["choose_run_m_process"] == 1)
{
// 	print_blue_message("HERE4");
	$selected_rundate = $_POST["find_rundate"];
	$selected_machine = $_POST["find_machine"];
	$selected_domain  = $_POST["find_domain"];
	$selected_lane    = $_POST["find_lane"];
	$domain_letter    = $selected_domain[0];
	if ($selected_domain == "ITS1")
	{
		$domain_letter = "E";
	}
	
	$path_to_csv    = "/xraid2-2/g454/run_new_pipeline/illumina/" . $selected_machine . "_info/";
	$path_to_ini    = $path_to_csv  . $selected_rundate . "/" . $selected_rundate . "_" . $selected_lane . "_" . $domain_letter . "_run_info.ini";
	$ini_path_error = "";
	
	if (!file_exists($path_to_ini))
	{
		$ini_path_error = "Sorry, there is no ini file: ". $path_to_ini;
		include("step_form_get_metadata.php");						
	}
	else 
	{	
		$ini_data     = file_get_contents($path_to_ini);
		$run_info_ini = json_decode($ini_data, true);
	}
// 	UUU -Array ( 
//[rundate] => 20130322 
//[lane] => 4 
//[domain] => Bacteria 
//[dna_region] => v6 
//[path_to_raw_data] => /xraid2-2/sequencing/Illumina/20130322/Project_NMS_v6 
//[overlap] => complete ) --
}
    
?>
          
    <br />
    <input type="button" value="Choose another run" class="hide_find_run" />
    
    <table>
         <tr style="display:none;" class="hide_find_run_tr <?php echo $show_class; ?>">
           <td colspan="3">
             <?php 
				include("step_form_get_run_info.php");
			?>                 
             
        </td>
      </tr>
    </table>