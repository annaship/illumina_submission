<?php
////////////////////////////////////////////////////////////////////////////////
// Initialize the application_data array to an empty array before we start 
// populating it.
$application_data = Array(); 
date_default_timezone_set('America/New_York');

////////////////////////////////////////////////////////////////////////////////
// Include the global configuration file...
require("vamps_config.php");


////////////////////////////////////////////////////////////////////////////////
// Instantiate modules used throughout the site...
// Bring in necessary class definitions...
require_once("module_class.php"); // Use the module class for debug & error logging.
require_once("MySQLException.php");
require_once("MySQLConnect.php");
require_once("MySQLResultSet.php");
//require_once("vamps_dataset.php"); // handles single dataset, project, and count


// instantiate the logging module for debug and error logging...
$application_data['modules']['logger'] = new module();
$application_data['modules']['logger']->set_debug(true);
//$application_data['modules']['logger']->debug(__FILE__.":".__LINE__.":".__FUNCTION__, "Beginning execution.");

////////////////////////////////////////////////////////////////////////////////
// Start the session so this file can access session variables...
// session_start();
if(!isset($_SESSION)) { session_start(); }

////////////////////////////////////////////////////////////////////////////////
// In many locations, ideally, the user can change the "view_mode" (see the wiki
// information about view_mode). The view_mode is stored in the session array.
// The view mode can be changed arbitrarily so this code checks to see if it is
// explicitly set and if so, updates the current session data.

// If view mode is present in $_REQUEST, then the user is explicitly setting it...
if (isset($_REQUEST['view_mode'])) {
  $application_data['modules']['logger']->debug(__FILE__.":".__LINE__,"view mode is present in request variable and is of type: ".gettype($_REQUEST['view_mode']));
  // sanitize by inspecting type
  if (is_numeric($_REQUEST['view_mode'])) {
        $application_data['modules']['logger']->debug(__FILE__.":".__LINE__,"view mode is numeric, setting session variable.");
    $_SESSION['view_mode'] = $_REQUEST['view_mode'];
        $application_data['modules']['logger']->debug(__FILE__.":".__LINE__,"view mode set to ".$_SESSION['view_mode']." after pulling from the REQUEST variable.");
  } else {
    $_SESSION['view_mode'] = $config['view_mode']['default'];
        $application_data['modules']['logger']->debug(__FILE__.":".__LINE__,"view mode set to ".$_SESSION['view_mode']." by default.");
  }
}
elseif(isset($_SESSION['view_mode'])){

}else{
    $_SESSION['view_mode'] = $config['view_mode']['default'];
    //$application_data['modules']['logger']->debug(__FILE__.":".__LINE__,"view mode set to ".$_SESSION['view_mode']." by default.");
  }

////////////////////////////////////////////////////////////////////////////////
// wacky way to determine the vamps version.
// In this case, we're setting the data_cube_uploads
// variable differently, depending on if we are in 
// vampsdev versus vamps.
$docroot = $_SERVER['DOCUMENT_ROOT'];
$pattern = '/\/usr\/local\/www\/|\/docs\//';
$replacement = '';
$vamps_version = preg_replace($pattern, $replacement, $docroot);

////////////////////////////////////////////////////////////////////////////////
//$_SESSION['data_cube'] = $data_cube;
$_SESSION['data_cube_table_name']       = $config['databases']['vamps']['tables']['data_cube'];
$_SESSION['combinations_table_name']    = $config['databases']['vamps']['tables']['combinations'];
$_SESSION['vamps_env_data_table_name']  = $config['databases']['vamps']['tables']['env_data'];
$_SESSION['project_dataset_table_name'] = $config['databases']['vamps']['tables']['project_dataset'];
$_SESSION['project_table_name']         = $config['databases']['vamps']['tables']['projects'];
$_SESSION['project_info_name']          = $config['databases']['vamps']['tables']['project_info'];
$_SESSION['project_upload_info']          = $config['databases']['vamps']['tables']['project_upload_info'];

$_SESSION['auth_table_name']            = $config['databases']['vamps']['tables']['auth'];
$_SESSION['users']                      = $config['databases']['vamps']['tables']['users'];
$_SESSION['dataset_counts']             = $config['databases']['vamps']['tables']['dataset_counts'];
$_SESSION['projdsets']                  = $config['databases']['vamps']['tables']['pipeline']['project_dataset'];

$_SESSION['microbis_host']              = $config['databases']['microbis']['host'];
//$_SESSION['microbis_user']              = $config['databases']['microbis']['users']['readonly']['username'];   
//$_SESSION['microbis_pass']              = $config['databases']['microbis']['users']['readonly']['password']; 
$_SESSION['microbis_db']                = $config['databases']['microbis']['name'];
////////////////////////////////////////////////////////////////////////////////
// Create a MySQL link for read-only access and store it in the session data 
// for this user.
$mysql_link   = mysql_connect($scopecfg['db_host'],$scopecfg['db_user'], $scopecfg['db_pass']);
if (mysql_error($mysql_link)) {
  $application_data['modules']['logger']->set_error(__FILE__.":".__LINE__.":".__FUNCTION__, "An error has occured in attempting to create a read-only link in MySQL for storage in sesssion data: ".mysql_error($mysql_link),"An application error has occured.");
  //echo "<p>".$application_data['modules']['logger']->get_error()." For assistance please contact a site administrator.</p>";
  exit;
}
$_SESSION['mysql_link'] = $mysql_link;

// Create a MySQL link for read-write access and store it in the session data 
// for this user.
$mysqlUpdateLink   = mysql_connect($scopecfg['db_host'],$scopecfg['db_user_w'], $scopecfg['db_pass_w']);
if (mysql_error($mysqlUpdateLink)) {
  $application_data['modules']['logger']->set_error(__FILE__.":".__LINE__.":".__FUNCTION__, "An error has occured in attempting to create a read-write link in MySQL for storage in sesssion data: ".mysql_error($mysqlUpdateLink),"An application error has occured.");
  //echo "<p>".$application_data['modules']['logger']->get_error()." For assistance please contact a site administrator.</p>";
  exit;
}
$_SESSION['mysqlUpdateLink'] = $mysqlUpdateLink;


// create a microbis mysql link and stor it in the SESSION variable
#$microbis_mysql_link = mysql_connect($_SESSION['microbis_host'] ,$_SESSION['microbis_user'] , $_SESSION['microbis_pass']  );
#$_SESSION['microbis_mysql_link'] = $microbis_mysql_link;
$googleearth_key = 'ABQIAAAAmbGYae7MfmJOBlSCCEidIRR9qQtsM7B7dUSBoJSahBUTSlDZTRTYQG8xhafIC4mcNl-fhEzauE7i0g';

#  MONGO Testing
#$mongo_conn = new Mongo();
#$mongo_db = $mongo_conn->vamps;
?>
