<?php
$run_info_results = populate_post_vars($_POST);
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION["run_info"] = $run_info_results;
$_SESSION["run_info"]["path_to_raw_data"] = $selected_path_to_raw_data;
$_SESSION["run_info_valid"] = 1;

// insert into ini file
$lanes = get_val_from_arr($_SESSION["csv_content"], "lane");
$_SESSION["run_info"]["lanes"] = array_unique($lanes);
$domains = get_val_from_arr($_SESSION["csv_content"], "domain");
$rundate = $_SESSION["run_info"]["rundate"];
// print_red_message("From ". $_SERVER["PHP_SELF"] . "; insert_run_info");
// print_out($_SESSION["run_info"]["lanes"]);

foreach ($lanes as $lane)
{
	foreach ($domains as $domain)
	{
		$run_info_file_name = $path_to_csv  . $rundate . "/" . $rundate . "_" . $lane . "_run_info.ini";
		$fp 				= fopen($run_info_file_name, 'w') or trigger_error("Can't open $file_name: ", E_USER_ERROR);
		$domain_name 		= get_domain_from_csv_data($domain, $domains_array);
		$ini_content = array("rundate" => $_SESSION["run_info"]["rundate"],
							 "lane"    => $lane,
							 "domain"  => $domain_name,
							 "dna_region" => $_SESSION["run_info"]["dna_region_0"],
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
}

?>