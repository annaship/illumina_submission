<?php
include_once 'choose_metadata.php';


// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; steps_command_line");
// print_blue_message("\$_POST:");
// print_out($_POST);
// print_blue_message("\$run_info_ini:");
// print_out($run_info_ini);
// print_blue_message("\$_SESSION[\"run_info\"]");
// print_out($_SESSION["run_info"]);

// print_blue_message("domains");
// print_out($domains);
// print_blue_message("lanes");
// print_out($lanes);
// print_blue_message("\$lane_dom_names = ");
// print_out($lane_dom_names);
// print_blue_message("===========");

/*
1) just uploaded csv
2) there is ini file
3) not 1 nor 2
*/

$command_line = $csv_file_name = $csv_name = $do_perfect = $is_compressed = $lane_name = $path_to_csv = $raw_path = $rundate = "";
$lanes        = array();
$is_compressed = "True";
$do_perfect    = "True";

// 1) just uploaded csv

if  ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$rundate       = $_POST["find_rundate"];
	$domain        = $_POST["find_domain"];
	$lane_name     = $_POST["find_lane"];
	$lanes 		   = array($lane_name);
	$machine_name  = array_search($_POST["find_machine"], $machine_names);
	$csv_name      = create_csv_name($rundate, $lane_name);
	$domains 	   = array($domain);
	// 2) there is ini file
	if (isset ($_POST["choose_run_m_process"]) && $_POST["choose_run_m_process"] == 1)
	{
// 		print_blue_message("HERE1");
		/*
		 * POST:
		* UUU -Array ( [form_name] => choose_run_m_form [find_rundate] => 20130322 [find_machine] => hiseq [find_lane] => 4 [add] => Submit [choose_run_m_process] => 1 ) --
		$run_info_ini:
		UUU -Array ( [rundate] => 20130322 [lane] => 4 [domain] => Bacteria [dna_region] => v6 [path_to_raw_data] => /xraid2-2/sequencing/Illumina/20130322/Project_NMS_v6 [overlap] => complete ) --
		*
		* */
		$raw_path 	 = $run_info_ini["path_to_raw_data"];
		if ($run_info_ini["overlap"] == "partial")
		{
			$do_perfect = "False";
		}
	}
// 	3) not 1 nor 2	
	elseif ($_POST["choose_meta_w_path_process"] == 1)
	{
// 		print_blue_message("HERE2");
		// 	 UUU -Array ( [form_name] => choose_run_m_form [find_rundate] => 20130322 [find_machine] => hiseq [find_lane] => 1 [path_to_raw_data] => 20130322 [add] => Submit [choose_run_w_path_process] => 1 ) --
		$raw_path     = "/xraid2-2/sequencing/Illumina/" . $_POST["path_to_raw_data"];
		if ($_POST["find_machine"] == "miseq")
		{
			$do_perfect = "False";
		}
	
	}
} #no session
elseif (check_var($_SESSION["run_info"]))
{
// 		print_blue_message("HERE3");
	/*
	 * UUU -Array ( [form_name] => run_info_form [rundate] => 20120315 [path_to_raw_data] => 20120315hs/test [dna_region_0] => v6 [overlap] => complete [seq_operator] => JR [insert_size] => 95 [read_length] => 111 [add] => Submit Run info [run_info_process] => 1 [lanes] => Array ( [0] => 1 ) ) --
	*/
	
	foreach ($_SESSION["csv_content"] as $arr_data)
	{
		$domains[] = $arr_data["domain"];
	}
	$dom_arr_uniq = array_unique($domains);
	$domain       = $dom_arr_uniq[0];
// 	print_blue_message("\$domains");
// 	print_out($domains);	
	$rundate       = $_SESSION["run_info"]["rundate"];
	$machine_name  = get_machine_name($_SESSION["run_info"]["dna_region_0"]);
	$raw_path      = "/xraid2-2/sequencing/Illumina/" . $_SESSION["run_info"]["path_to_raw_data"];
	if ($_SESSION["run_info"]["overlap"] == "partial")
	{
		$do_perfect = "False";
	}
	$lanes = $_SESSION["run_info"]["lanes"];
}
$path_to_csv   = "/xraid2-2/g454/run_new_pipeline/illumina/" . $machine_names[$machine_name] . "_info/";
$domain_letter = $domain[0];


?>

      
