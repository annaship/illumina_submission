<?php

//// The config variable is a multidimensional array that contains the 
//// web application's configuration information.


// Email addresses of site administrators
// I'd really like to have this as a more useful complex array that describes 
// the administrators individually and contains information like, name, 
// telephone, email, etc.
$config['admin']['contact']['email'][] = "r2f0x2@chupachups.mbl.edu";
$config['admin']['contact']['email'][] = "vamps@mbl.edu";


// Various forms of database access, databases and table specifications
//////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
///
/// ATTENTION - the mysql database host name is different for vamps and vampsdev
/// so this file IS NOT a mirror of the one on vamps. It has to be changed by hand.
///
/// HOSTNAME for VAMPSDEV is 'vampsdev.mbl.edu'
    $config['databases']['vamps']['host'] = "vampsdev";
///
/// HOSTNAME for VAMPS is 'vampsdb'
///  $config['databases']['vamps']['host'] = "vampsdb";
////////////////////////////////////////////////////////////////
$config['databases']['vamps']['port'] = "3306";
$config['databases']['vamps']['name'] = "vamps";
//$config['databases']['vamps']['hostname'] = "vampsdb";
$config['databases']['vamps']['users']['readonly']['username'] = "vamps_r";   
$config['databases']['vamps']['users']['readonly']['password'] = "3l35Ant";   
$config['databases']['vamps']['users']['readwrite']['username'] = "vamps_w";  
$config['databases']['vamps']['users']['readwrite']['password'] = "g1r55nck"; 
$config['databases']['microbis']['name'] = "microbis";
$config['databases']['microbis']['host'] = "bpcweb1";
$config['databases']['microbis']['users']['readonly']['username'] = "microbis";   
$config['databases']['microbis']['users']['readonly']['password'] = "3l35Ant";  

// Database table specifications
$config['databases']['vamps']['tables']['combinations']       = 'vamps_combinations';
$config['databases']['vamps']['tables']['custom_datasets']    = 'vamps_custom_datasets';
$config['databases']['vamps']['tables']['custom_projects']    = 'vamps_custom_projects';
$config['databases']['vamps']['tables']['env_data']           = 'vamps_env_data';
$config['databases']['vamps']['tables']['users']              = 'vamps_users';
$config['databases']['vamps']['tables']['exports']            = 'vamps_export';
$config['databases']['vamps']['tables']['taxonomy']           = 'vamps_taxonomy';
$config['databases']['vamps']['tables']['data_cube_uploads']  = 'vamps_data_cube_uploads';
$config['databases']['vamps']['tables']['projects']           = 'vamps_projects';
$config['databases']['vamps']['tables']['project_dataset']    = 'vamps_projects_datasets';
$config['databases']['vamps']['tables']['project_info']       = 'vamps_projects_info';
$config['databases']['vamps']['tables']['dataset_counts']     = 'vamps_junk_data_cube';
$config['databases']['vamps']['tables']['frequencies']        = 'vamps_data_cube';
$config['databases']['vamps']['tables']['tax_by_tax']         = 'vamps_data_cube';
$config['databases']['vamps']['tables']['tax_by_ref']         = 'vamps_sequences';
$config['databases']['vamps']['tables']['tax_by_seq']         = 'vamps_sequences';
$config['databases']['vamps']['tables']['sequences']          = 'vamps_sequences';
$config['databases']['vamps']['tables']['clusters']           = 'vamps_clusters';
$config['databases']['vamps']['tables']['auth']               = 'vamps_auth'; 
$config['databases']['vamps']['tables']['runkeys']            = 'vamps_run_keys'; 
$config['databases']['vamps']['tables']['primers']            = 'vamps_primers';
$config['databases']['vamps']['tables']['pipeline']['exports']        = 'vamps_export_pipe';
$config['databases']['vamps']['tables']['pipeline']['sequences']      = 'vamps_sequences_pipe';
$config['databases']['vamps']['tables']['pipeline']['tax_by_tax']     = 'vamps_data_cube_pipe';
$config['databases']['vamps']['tables']['pipeline']['dataset_counts'] = 'vamps_junk_data_cube_pipe';
$config['databases']['vamps']['tables']['pipeline']['taxonomy']       = 'vamps_taxonomy_pipe';
$config['databases']['vamps']['tables']['pipeline']['project_dataset']= 'vamps_projects_datasets_pipe';
$config['databases']['vamps']['tables']['project_upload_info']= 'vamps_upload_info';
$config['databases']['vamps']['tables']['rawseq_upload']      = 'vamps_upload_rawseq'; 
$config['databases']['vamps']['tables']['rawqual_upload']     = 'vamps_upload_rawqual';
$config['databases']['vamps']['tables']['trimseq_upload']     = 'vamps_upload_trimseq';
$config['databases']['vamps']['tables']['trimqual_upload']    = 'vamps_upload_trimqual';
//$config['databases']['vamps']['tables']['seqs_upload']        = 'vamps_upload_upseqs';
$config['databases']['vamps']['tables']['upload_info']        = 'vamps_upload_info';
// The 'Junk Data Cube' is considered the most important of all of the tables.
$config['databases']['vamps']['tables']['data_cube']          = 'vamps_junk_data_cube';
$config['databases']['vamps']['tables']['data_cube_51']       = 'vamps_data_cube_b80_m51';
$config['databases']['vamps']['tables']['data_cube_66']       = 'vamps_data_cube_b80_m66';
$config['databases']['vamps']['tables']['data_cube_80']       = 'vamps_data_cube_b80_m80';
$config['databases']['vamps']['tables']['metadata']           = 'vamps_metadata';
$config['databases']['vamps']['tables']['project_source']     = 'vamps_metadata_source';

// Paths to files, directories, and applications..
// The root of the site's installation as it pertains to the paths
// used in the web application.
// Please omit the trailing slash.
$config['paths']['root'] = "/usr/local/www/vamps";

// This log is for the authentication mechanism for logging successful logins
// Set to the empty string to disable.
//$config['logs']['authentications']    = $config['paths']['root']."/tmp/authentications.log";
$config['paths']['authentication_log']  = $config['paths']['root']."/tmp/authentications.log";
$config['paths']['uploads_directory']   = $config['paths']['root']."/tmp";
$config['paths']['outfile_directory']   = $config['paths']['root']."/docs/downloads";
$config['paths']['db_downloads_dir']    = "data_downloads";
$config['paths']['downloads_directory'] = "downloads";
$config['paths']['dotur_downloads_dir'] = "data_downloads/dotur";
$config['paths']['cluster_downloads_dir'] = "data_downloads/clusters";
$config['paths']['atv_trees']           = $config['paths']['root']."/docs/library/ATV/trees";
$config['paths']['apache_passwords_file']    = $config['paths']['root']."/authconfig/passwords";
// cluster_path is different for vamps and vampsdev
// this is where the cluster scripts need to live to access the cluster



$config['paths']['backwards_compatible']['path_to_apps'] = $config['paths']['root']."/docs/apps";
// used to check length of uploaded fasta files...
$config['paths']['grep'] = "/bin/grep";
// A script that verifies formatting for uploaded files before handing them off 
// to RDP for processing.
//$config['paths']['rdp_file_checker'] = $config['paths']['root']."/special/perl/scripts/rdpfile_checker.pl"; 
$config['paths']['rdp_file_checker'] = $config['paths']['root']."/docs/apps/rdpfile_checker"; 

//// runtime enviroment variables (Note: these may not automatically be
//// usable just because they're defined here, you still should handle that in 
//// your code where necessary)
// Add the special/perl/lib for PERL libraries (for rdp_checker.pl, 
// rdpfile_checker.pl, etc)
$config['environment']['PERL5LIB'][] = $config['paths']['root']."/special/perl/lib";
$config['paths']['perl']['scripts'] = $config['paths']['root']."/special/perl/scripts";

/**
 * Caches used by facilities within the vamps website...
 */
$config['paths']['cache_dir']  = $config['paths']['root']."/special/caches";
$config['paths']['caches']['taxonomy']['normalized']['php_array'] = $config['paths']['cache_dir']."/php_normalized_taxonomy_array.php";

//// Aliases are similar to aliases in a UNIX shell
//// They are system commands with options that may change from platform to 
//// platform. They can be defined after config['paths'] to benefit from that 
//// variable.

// options used with grep for returning a count of hits instead of the 
// hits.
$config['aliases']['grepcount'] = $config['paths']['grep']." -cs";

// Define data length limits for import. This will  not affect file size 
// limitations on uploads within PHP. This will only affect the scripts used to 
// process and import files once they have 
// been uploaded to the server.

// maximum length of user uploaded sequence data
$config['data_max_length']['upload']['fasta']    = 1000; 
$config['data_max_length']['upload']['raw']      = 1000; 
// maximum length of user uploaded taxonomy data
$config['data_max_length']['upload']['taxonomy'] = 1000;

// Limit the number of expansions of the taxonomic tree in custom using double 
// click to this numeric level
// That is, limit expansion via double-clicking to the following level:
// 1 - Domain
// 2 - Phylum
// 3 - Class
// 4 - Order
// 5 - Family
// 6 - Genus
// 7 - Species
// 8 - Strain
// > 8 - no limit
$config['javascript']['custom']['taxonomy_tree']['max_tree_depth'] = 9;

// Definition of access level for projects, datasets, etc
$config['access_levels'][0]['id'] = "1";
$config['access_levels'][0]['name'] = "Global Access";
$config['access_levels'][0]['description'] = "Provides access to all projects defined. JBPC and administrative staff should get this level of access.";
$config['access_levels'][0]['default'] = 0;

$config['access_levels'][1]['id'] = "50";
$config['access_levels'][1]['name'] = "User Projects and Public Data";
$config['access_levels'][1]['description'] = "Users with this security level may only access their own projects and public data.";
$config['access_levels'][1]['default'] = 1;

$config['access_levels'][2]['id'] = "75";
$config['access_levels'][2]['name'] = "User Projects Only";
$config['access_levels'][2]['description'] = "Users with this security level may only access their own projects.";
$config['access_levels'][2]['default'] = 0;

$config['access_levels'][3]['id'] = "99";
$config['access_levels'][3]['name'] = "Demonstration Level";
$config['access_levels'][3]['description'] = "Users with this security level may only access public data.";
$config['access_levels'][3]['default'] = 0;

// view mode used for taxonomy table view, absolute or normalized
$config['view_mode']['absolute'] = 1;
$config['view_mode'][1]['name'] = "Absolute Number";
$config['view_mode']['frequency'] = 2;
$config['view_mode'][2]['name'] = "Show by Frequency";
$config['view_mode']['frequency'] = 3;
$config['view_mode'][3]['name'] = "Normalized to Maximum";
//$config['defaults']['view_mode'] = $config['view_mode']['absolute'];
//$config['defaults']['view_mode_name'] = $config['view_mode'][1]['name'];
// Another alias to default view mode...
$config['view_mode']['default'] = $config['view_mode']['absolute'];

// External links used in the web application
$config['links']['ncbi'] = "http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?id=";
$config['links']['ncbi2'] = "http://www.ncbi.nlm.nih.gov/sites/entrez?db=nuccore&amp;cmd=search&amp;term=";
$config['links']['wikipedia'] = "http://en.wikipedia.org/wiki/";
$config['links']['eol'] = "http://www.eol.org/search?q=";
$config['links']['microbis'] = "http://icomm.mbl.edu/microbis/";  //microbis
$config['links']['iem'] = "http://iem.mbl.edu/stats/cluster";  //microbis google-earth 
$config['links']['microbis_projects'] = "http://icomm.mbl.edu/microbis/project_pages/pp_by_name/";

// Other variables
$config['other']['filter']['target_array']  = array('Av6','Bv6','Bv3','Bv5','Bv6v4','Bv5v6','Bv4v5','Bv3v5','Ev9','none');
$config['other']['filter']['private_array'] = array('Public Data','Private Data');
$config['other']['filter']['private_array_admin'] = array('Public Data','Private Data','User Data','Non-User Data','Bay Paul Data');
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//////////// PLEASE DO NOT USE THE FOLLOWING VARIABLES IN NEW CODE /////////////
//////////////// (use the $config convention above) ////////////////////////////
////////// THESE ARE ONLY INCLUDED HERE FOR BACKWARDS COMPATIBILITY ////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$scopecfg['db_host']          = $config['databases']['vamps']['host'];                  //database host
$scopecfg['db_name']          = $config['databases']['vamps']['name'];                  //database to use
$scopecfg['db_user']          = $config['databases']['vamps']['users']['readonly']['username'];       //database user
$scopecfg['db_pass']          = $config['databases']['vamps']['users']['readonly']['password'];   //database password for user
$scopecfg['db_user_w']        = $config['databases']['vamps']['users']['readwrite']['username'];    //database user
$scopecfg['db_pass_w']        = $config['databases']['vamps']['users']['readwrite']['password'];    //database password for user
$hostname                     = $config['databases']['vamps']['host'];
$databaseName                 = $config['databases']['vamps']['name'];
$username                     = $config['databases']['vamps']['users']['readonly']['username']; 
$password                     = $config['databases']['vamps']['users']['readonly']['password'];
$username_w                   = $config['databases']['vamps']['users']['readwrite']['username'];
$password_w                   = $config['databases']['vamps']['users']['readwrite']['password'];
$data_cube_table_name         = $config['databases']['vamps']['tables']['data_cube'];
$data_cube                    = $config['databases']['vamps']['tables']['data_cube'];
$combinations_table_name      = $config['databases']['vamps']['tables']['combinations'];
$vamps_env_data_table_name    = $config['databases']['vamps']['tables']['env_data'];
$user_table_name              = $config['databases']['vamps']['tables']['users'];
//$data_cube['51']              = $config['databases']['vamps']['tables']['data_cube']['51'];
//$data_cube['66']              = $config['databases']['vamps']['tables']['data_cube']['66'];
//$data_cube['80']              = $config['databases']['vamps']['tables']['data_cube']['80'];
$table_export                 = $config['databases']['vamps']['tables']['exports'];
$data_cube_uploads            = $config['databases']['vamps']['tables']['data_cube_uploads'];
$upload_dir = $config['paths']['root']."/tmp";
$path_to_apps = $config['paths']['root'] . "/docs/apps";
$path_to_rdp = $path_to_apps;

$security_level_array = $config['access_levels'];

// Definition of site administrator users.
// Used by includes/functions.inc
$admin_user[] = 'ashipunova';
$admin_user[] = 'Sue';
$admin_user[] = 'rfox';
$admin_user[] = 'avoorhis';


?>
