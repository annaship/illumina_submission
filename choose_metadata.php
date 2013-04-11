<?php 
// print "<br/>";
// print_red_message("from choose_metadata");
print_red_message("From ". $_SERVER["PHP_SELF"] . "; choose_metadata");

// print "<br/>";
// print_out($_POST);
// // print_r($_SERVER["SCRIPT_NAME"]);
// // print_out($_SESSION);
// print_red_message($path_to_csv);
// print "<br/>";
?>
<?php
// print_out($_SERVER["SCRIPT_NAME"]);
if(!isset($_SESSION)) {
  session_start();
}

$_SESSION["meta_from"] = $_SERVER["SCRIPT_NAME"];

$show_class = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["choose_run_m_process"] == 1)
{
	$path_to_csv = "/xraid2-2/g454/run_new_pipeline/illumina/" . $_POST["find_machine"] . "_info/";
	$path_to_ini = $path_to_csv  . $_POST["find_rundate"] . "/" . $_POST["find_rundate"] . "_" . $_POST["find_lane"] . "_run_info.ini";
	$ini_path_error = "";
	if (!file_exists($path_to_ini))
	{
		$ini_path_error = "Sorry, there is no such file: ". $path_to_ini;
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
				if ($ini_path_error == "") {
					include("step_form_get_run_info.php");
				}
				else
				{
					include("step_form_get_metadata.php");						
				}

			?>                 
             
        </td>
      </tr>
    </table>