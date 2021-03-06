<?php 
// production
$application_data['config'] = $config;

$hostname   = $config['databases']['vamps_production']['host'];
$database   = $config['databases']['vamps_production']['name'];
$port_v     = $config['databases']['vamps_production']['port'];
$username_v = $config['databases']['vamps_production']['users']['readonly']['username'];
$password_v = $config['databases']['vamps_production']['users']['readonly']['password'];
$application_data['modules']['logger']->debug(__FILE__.":".__LINE__.":".__FUNCTION__, "USERNAME: $username_v, PASSWORD: $password_v, 
        HOSTNAME: $hostname, DATABASE: $database.");
$vampsprod_connection_r = mysql_connect($hostname, $username_v, $password_v) or die("Not connected with $hostname: " . mysql_error());

// production read and wright
$username_w = $config['databases']['vamps_production']['users']['readwrite']['username'];
$password_w = $config['databases']['vamps_production']['users']['readwrite']['password'];
$application_data['modules']['logger']->debug(__FILE__.":".__LINE__.":".__FUNCTION__, "USERNAME: $username_w, PASSWORD: $password_w,
		HOSTNAME: $hostname, DATABASE: $database.");
$vampsprod_connection_w = mysql_connect($hostname, $username_w, $password_w) or die("Not connected with $hostname: " . mysql_error());

// $db_vamps = mysql_select_db('vamps', $vampsdev_connection);

$hostname_n = $config['databases']['bpcdb1']['host']; 
$database_n = $config['databases']['bpcdb1']['name']; 
$port_n     = $config['databases']['bpcdb1']['port'];
$username_n = $config['databases']['bpcdb1']['users']['readonly']['username'];
$password_n = $config['databases']['bpcdb1']['users']['readonly']['password'];
$newbpc2_connection_r = mysql_connect($hostname_n, $username_n, $password_n) or die("Not connected with $hostname_n: " . mysql_error());
// print_blue_out_message('$newbpc2_connection_r', $newbpc2_connection_r);

// env454 read and write
$hostname_nw = $config['databases']['bpcdb1']['host'];
$database_nw = $config['databases']['bpcdb1']['name'];
$port_nw     = $config['databases']['bpcdb1']['port'];
$username_nw = $config['databases']['bpcdb1']['users']['readwrite']['username']; #vampsdev_rw
$password_nw = $config['databases']['bpcdb1']['users']['readwrite']['password'];
$newbpc2_connection = mysql_connect($hostname_nw, $username_nw, $password_nw) or die("Not connected with $hostname_nw: " . mysql_error());
// print_blue_out_message('$newbpc2_connection rw', $newbpc2_connection);
// development
// vampsdev.test
$hostname_d = $config['databases']['vamps']['host'];
// $database_d = 'test';
$password_d = $config['databases']['vamps']['users']['readwrite']['password'];
$username_d = $config['databases']['vamps']['users']['readwrite']['username'];
// $application_data['modules']['logger']->debug(__FILE__.":".__LINE__.":".__FUNCTION__, "USERNAME: $username_d, PASSWORD: $password_v, HOSTNAME: $hostname, DATABASE: $database.");

$vampsdev_connection = mysql_connect($hostname_d, $username_d, $password_d) or die("Not connected with $hostname_d: " . mysql_error());

// print_out($config['databases']);

// $config['databases']['vamps_production']['users']['readwrite']['username'];
// $config['databases']['vamps_production']['users']['readwrite']['password'];


// $db_env454 = mysql_select_db('env454', $newbpc2_connection);
// $newbpc2_mysqli = new mysqli($hostname_n, $username_n, $password_n, "env454");
// if ($newbpc2_mysqli->connect_errno) {
//   echo "Failed to connect to MySQL: (HERE" . $newbpc2_mysqli->connect_errno . ") " . $newbpc2_mysqli->connect_error;
// }

// echo $newbpc2_mysqli->host_info . "<br/>from DB_CONNECT";
// print_out($config['databases']['vamps_production']);
// print_out($config['databases']['bpcdb1']);
?>
