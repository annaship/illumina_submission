<?php
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; insert_run_info");

$run_info_results = populate_post_vars($_POST);
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION["run_info"] = $run_info_results;
$_SESSION["run_info"]["path_to_raw_data"] = $selected_path_to_raw_data;
$_SESSION["run_info_valid"] = 1;

// insert into ini file
$lanes = get_val_from_arr($_SESSION["csv_content"], "lane");
// $_SESSION["run_info"]["lanes"] = array_unique($lanes);
$_SESSION["run_info"]["lanes"] = $lanes;
$domains = get_val_from_arr($_SESSION["csv_content"], "domain");
$rundate = $_SESSION["run_info"]["rundate"];
// print_out($_SESSION["run_info"]["lanes"]);
$lane_dom_names = create_lane_dom_names($lanes, $domains);

// 	print_blue_message("\$lanes = ");
// 	print_out($lanes);
// 	print_blue_message("\$domains = ");
// 	print_out($domains);
// 	$lane_dom_names = create_lane_dom_names($lanes, $domains);
// 	print_blue_message("\$lane_dom_names = ");
// 	print_out($lane_dom_names);
// 	print_blue_message("===========");
// foreach ($lanes as $lane)
// {
// 	foreach ($domains as $domain)
// 	{
		
// 		$domain_name 		= get_domain_from_csv_data($domain, $domains_array);
// 		$domain_letter      = $domain[0];
foreach (array_unique($lane_dom_names) as $lane_dom_name)
{
// 		$lane_name 			= $lane . "_" . $domain_letter;
		$dir_name 			= $path_to_csv  . $rundate;
		$ini_file_name      = $rundate . "_" . $lane_dom_name . "_run_info.ini";
		$run_info_file_name = $dir_name . "/" . $ini_file_name;
		if (!is_dir($dir_name)) {
			creat_dir_if_not_existst($dir_name);
		}
		set_error_handler("customError", E_USER_ERROR);		
		$fp 				= fopen($run_info_file_name, 'w') or trigger_error("Can't open $run_info_file_name: ", E_USER_ERROR);
		chmod($run_info_file_name, 0664);
		
		$ini_content = array("rundate" 			=> $_SESSION["run_info"]["rundate"],
							 "lane_domain"  	=> $lane_dom_name,
							 "dna_region"       => $_SESSION["run_info"]["dna_region_0"],
							 "path_to_raw_data" => "/xraid2-2/sequencing/Illumina/" . $_SESSION["run_info"]["path_to_raw_data"],
							 "overlap"			=> $_SESSION["run_info"]["overlap"]				
							);
// 		UUU -{"rundate":"20130322",
// "lane":"4",
// "domain":"Bacteria",
// "dna_region":"v6",
// "path_to_raw_data":"\/xraid2-2\/sequencing\/Illumina\/\"20130322\/Project_NMS_v6",
// "overlap":"complete"} --
		fwrite($fp, json_encode($ini_content));
		fclose($fp);
}

?>