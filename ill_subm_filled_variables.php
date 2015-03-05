<?php
// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; ill_subm_filled_variables");

if(!isset($_SESSION)) { session_start(); } 

if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
{
  include_once 'ill_subm_conn_local.php';  
  $db_name = "test_env454";
  $connection = $local_mysqli_env454;
}

    $selected_overlap = $selected_contact_full = $selected_domain = 
	$selected_lane = $selected_contact_name = $selected_run_key = 
	$selected_barcode_index = $selected_project = $selected_dataset = 
	$selected_dataset_description = $selected_env_source_name = 
	$selected_tubelabel = $selected_barcode = $selected_adaptor = 
	$selected_amp_operator = $selected_project_title = 
	$selected_project_description = $selected_funding = "";

// $domain_w_abbr = array("Bacteria (B)" => "B", "Archaea (A)" => "A", "Eukarya (E)" => "E", "Fungi (F)" => "F");
$domain_w_abbr = array("Bacteria (B)" => "B", "Archaea (A)" => "A", "Eukarya (E)" => "E", "Fungi ()" => "");
//               $domain_wo_abbr = array("Bacteria" => "B", "Archaea" => "A", "Eukarya" => "E", "Fungi" => "F");

$domains_array = array("Bacterial" => "Bacteria", "Archaeal" => "Archaea", "Eukaryal" => "Eukarya", "Fungal" => "ITS1");
    
$arr_fields_headers = array("domain", "lane", "contact_name", "run_key", "barcode_index", "adaptor", "project", "dataset", "dataset_description", "env_source_name",
    "tubelabel", "barcode", "amp_operator");

$project_form_fields = array(
    "project_name1" => "required", "project_name2" => "required", "domain" => "select",
    "dna_region" => "select", "project_title" => "optional", "project_description" => "required",
    "funding" => "required", "env_source_name" => "required", "project_form_contact" => "select"
);

$submission_metadata_form_fields = array("domain"=> "required", "lane"=> "required", "contact_name"=> "required", 
    "run_key"=> "select", "barcode_index"=> "select", "adaptor"=> "required", "project"=> "required", 
    "dataset"=> "required", "dataset_description"=> "optional", "env_source_name"=> "required",
    "tubelabel"=> "optional", "barcode"=> "optional", "amp_operator"=> "required");

$run_info_form_fields = array("seq_operator" => "required", "insert_size" => "required",  "read_length" => "required");
// ---
$dna_regions = array("v6", "v4v5", "v4", "its1");
$dna_regions_miseq = array("v4v5", "v4", "its1");
$dna_regions_hiseq = array("v6");
// ---
// TODO: check what's needed after db change
$need_names = array("user", "last_name", "first_name", "email", "institution", "temp_project", "title",
    "project_description", "environment", "env_source_id", "funding");
// , "tubelabel", "tube_description", "domain", "primer_suite", "dna_region"
// ---

$arr_fields_to_show = array("project_title", "project_description", "funding");
$arr_project_fields = array("project_name1", "project_name2", "env_source_name");
$arr_to_initialize = array_merge($arr_fields_to_show, $arr_project_fields);

list($project_errors, $project_results) = init_project_var($arr_to_initialize);

if (!isset($selected_dna_region))
{
	$selected_dna_region = "";
}

if (!isset($errors))
{
	$errors = array();
}

// ---
if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
{
	$db_name = "test_env454";
	$connection = $local_mysqli_env454;
}
else 
{
	$db_name = "env454";
	$connection = $newbpc2_connection_r;
}
// $query = "SELECT DISTINCT user, first_name, last_name, active, security_level, email, institution, id, date_added
//             FROM ". $db_name . ".vamps_auth WHERE last_name <> \"\"";
$query = "SELECT DISTINCT contact_id, contact, email, institution, vamps_name as user, first_name, last_name
            FROM ". $db_name . ".contact WHERE last_name <> \"\"";
            
if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
{
  $res = $connection->query($query);  
  for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();
    
    $contact[$row['user']]      = $row['last_name'].', '.$row['first_name'];
    $contact_full[$row['user']] = $row['last_name'].', '.$row['first_name'].', '.$row['email'].', '.$row['institution'];
  }  
}
else
{
  
//   $result_vamps_user = mysql_query($query, $vampsprod_connection_r) or die("SELECT Error: $result_vamps_user: ".mysql_error());
//   while($row = mysql_fetch_row($result_vamps_user))
//   {
//     $contact[$row[0]]      = $row[2].', '.$row[1];
//     $contact_full[$row[0]] = $row[2].', '.$row[1].', '.$row[5].', '.$row[6]; 
//   }

	$result_env454_user = mysql_query($query, $connection) or die("SELECT Error: $query. $result_env454_user: ".mysql_error());
	while($row = mysql_fetch_row($result_env454_user))
	{
// 		print_blue_out_message('$row = ', $row);
// UUU -Array ( [0] => 24 [1] => Jan Pawlowski [2] => Jan.Pawlowski@zoo.unige.ch [3] => University of Geneva [4] => pawlowski [5] => Jan [6] => Pawlowski ) --
		
		$contact[$row[4]]      = $row[6].', '.$row[5];
		$contact_full[$row[4]] = $row[6].', '.$row[5].', '.$row[2].', '.$row[3];		
		
		// for vamps:		
// 		$contact[$row[0]]      = $row[2].', '.$row[1];
// 		$contact_full[$row[0]] = $row[2].', '.$row[1].', '.$row[5].', '.$row[6];
	}
}
// print_blue_message('$contact BEFORE = ');
// print_out($contact);

asort($contact);
asort($contact_full);



// print_blue_message('$contact AFTER sort = ');
// print_out($contact);
// ---
if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
	{
	//   $db_name = "env454";
		$connection = $local_mysqli_env454;
		$db_name = "test_env454";
	}
else
	{
		$connection = $newbpc2_connection;
		$db_name = "env454";
	}
	
$project = get_all_projects($connection, $db_name);

// ---

$arr_fields_add = array("tubelabel", "barcode", "amp_operator");

$arr_fields_run = array("seq_operator", "insert_size", "read_length");
// ---
  $env_sample_source_table = $db_name . ".env_sample_source";

$query = "SELECT DISTINCT env_sample_source_id, env_source_name FROM " . $env_sample_source_table;
if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
{
  $res_env = $connection->query($query);
	for ($row_no = $res_env->num_rows - 1; $row_no >= 0; $row_no--) {
		$res_env->data_seek($row_no);
		$row = $res_env->fetch_assoc();
		$env_source_names[$row["env_sample_source_id"]] = $row["env_source_name"];
	}
}
else
{
  $result_env_source_name = mysql_query($query, $connection) or die("SELECT Error: $query. $result_env_source_name: ".mysql_error());
  while($row = mysql_fetch_row($result_env_source_name))
  {
    $env_source_names[$row[0]] = $row[1];
  }
}
asort($env_source_names);

// ---
if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
{
	$db_name = "test_env454";
	$connection = $local_mysqli_env454;		
}
else
{
	$db_name = "env454";
	$connection = $newbpc2_connection;
}
// $query = "SELECT DISTINCT overlap FROM " . $db_name . ".run_info_ill";
// $overlaps = run_select_one_field($query, $connection);
// `overlap` enum('complete','partial','none') NOT NULL DEFAULT 'none',
// $overlaps = array('complete','partial','none');
// Array ( [0] => [2] => complete [1] => partial )

$overlaps = array('','partial','complete');

// $illumina_adaptor_ref 
$adaptors_full = $adaptors = array();
$query = "select
illumina_adaptor, illumina_index, illumina_run_key, dna_region, domain, illumina_adaptor_id, illumina_index_id, illumina_run_key_id, dna_region_id
FROM " . $db_name . ".illumina_adaptor_ref
JOIN " . $db_name . ".illumina_adaptor USING(illumina_adaptor_id)
JOIN " . $db_name . ".illumina_index USING(illumina_index_id)
JOIN " . $db_name . ".illumina_run_key USING(illumina_run_key_id)
JOIN " . $db_name . ".dna_region USING(dna_region_id)
";

if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
{
  $res_adaptor = $connection->query($query);
  for ($row_no = $res_adaptor->num_rows - 1; $row_no >= 0; $row_no--) 
  {
    $res_adaptor->data_seek($row_no);
    $row = $res_adaptor->fetch_assoc();
    $adaptors_full[] = array(
        "illumina_adaptor"    => $row["illumina_adaptor"],
        "illumina_index"      => $row["illumina_index"],
        "illumina_run_key"    => $row["illumina_run_key"],
        "dna_region"          => $row["dna_region"],
        "domain"              => $row["domain"],
        "illumina_adaptor_id" => $row["illumina_adaptor_id"],
        "illumina_index_id"   => $row["illumina_index_id"],
        "illumina_run_key_id" => $row["illumina_run_key_id"],
        "dna_region_id"       => $row["dna_region_id"]
    ); 
    $adaptors_all[] = $row["illumina_adaptor"];
  }
  $adaptors = array_unique($adaptors_all);
  asort($adaptors);
}
else
{
  $res_adaptor = mysql_query($query, $connection) or die("SELECT Error: $query. $res_adaptor: ".mysql_error());
  while($row = mysql_fetch_row($res_adaptor))
  {
    $adaptors_full[] = array(
        "illumina_adaptor"    => $row[0],
        "illumina_index"      => $row[1],
        "illumina_run_key"    => $row[2],
        "dna_region"          => $row[3],
        "domain"              => $row[4],
        "illumina_adaptor_id" => $row[5],
        "illumina_index_id"   => $row[6],
        "illumina_run_key_id" => $row[7],
        "dna_region_id"       => $row[8]
    );
    $adaptors_all[] = $row[0];
  }
  $adaptors = array_unique($adaptors_all);
  asort($adaptors);
}

// -------
if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
	{
	  //   $db_name = "env454";
		$connection = $local_mysqli_vamps;
		$db_name = "test_vamps";	  
// 	  $db_name = "test";
	}
else
	{
		$connection = $vampsprod_connection_r;
		$db_name = "vamps";
	}
	
list($subm_field_names, $vamps_submission_info) = get_submission_info($connection, $db_name);
list($subm_tubes_field_names, $vamps_submission_tubes_info) = get_submission_tubes_info($connection, $db_name);
// print_blue_message("\$subm_tubes_field_names - ");
// print_out($subm_tubes_field_names);
// print_blue_message("\$vamps_submission_tubes_info - ");
// print_out($vamps_submission_tubes_info);


$vamps_submission_info_show = array();
$vamps_submission_info_show = make_arr_by_key_field_name($subm_field_names, $vamps_submission_info, $need_names, "submit_code");

// -------
$machine_names = array("ms" => "miseq", "hs" => "hiseq");

if (isset($_SESSION["run_info"]))
{
	if (isset($_SESSION["run_info"]["rundate"]))
	{
		$rundate       = $_SESSION["run_info"]["rundate"];
	}
	if (isset($_SESSION["run_info"]["dna_region_0"]))
	{
// 		print_blue_out_message('from var: $_SESSION["run_info"]["dna_region_0"]', $_SESSION["run_info"]["dna_region_0"]);
		
		$machine_name  = get_machine_name($_SESSION["run_info"]["dna_region_0"], $dna_regions_hiseq, $dna_regions_miseq);
		$pat_to_csv_root = "";
		if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
		{
			$pat_to_csv_root = "../illumina_submission_site_local_add/";
		}
		else 
		{
			$pat_to_csv_root   = "/xraid2-2/g454/run_new_pipeline/illumina/";
				
		}
		$path_to_csv   = $pat_to_csv_root . $machine_names[$machine_name] . "_info/";		
	}
	if (isset($_SESSION["run_info"]["path_to_raw_data"]))
	{
		$raw_path      = "/xraid2-2/sequencing/Illumina/" . $_SESSION["run_info"]["path_to_raw_data"];
	}
	if (isset($_SESSION["run_info"]["lanes"]))
	{
		$lanes     = $_SESSION["run_info"]["lanes"];
	}
}
// -----
if (isset($_SESSION['is_local']) && !empty($_SESSION['is_local']))
	{
// 	  $db_name = "test";
// 	  $connection = $local_mysqli;
		$connection = $local_mysqli_env454;
		$db_name = "test_env454";	
	}
else
	{
		$db_name = "env454";
		$connection = $newbpc2_connection;
	}
	
$query = "SELECT DISTINCT run FROM " . $db_name . ".run WHERE run REGEXP '^201[4-9]'";

$runs = run_select_one_field($query, $connection);
rsort($runs);
// print_blue_message('$runs', $runs);

// print_blue_message("From ". $_SERVER["PHP_SELF"] . "; ill_subm_filled_variables; END");
$merge_filter_suffix = "-MAX-MISMATCH-3";

?>