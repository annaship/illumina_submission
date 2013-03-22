<?php 
// production
$application_data['config'] = $config;
// $password_w = $application_data['config']['databases']['vamps']['users']['readwrite']['password'];
// $username_w = $application_data['config']['databases']['vamps']['users']['readwrite']['username'];
// $database = $application_data['config']['databases']['vamps']['name'];
// $hostname = $application_data['config']['databases']['vamps']['host'];
$hostname   = $config['databases']['vamps_production']['host'];
$database   = $config['databases']['vamps_production']['name'];
$port_v     = $config['databases']['vamps_production']['port'];
$username_v = $config['databases']['vamps_production']['users']['readonly']['username'];
$password_v = $config['databases']['vamps_production']['users']['readonly']['password'];
$application_data['modules']['logger']->debug(__FILE__.":".__LINE__.":".__FUNCTION__, "USERNAME: $username_v, PASSWORD: $password_v, 
        HOSTNAME: $hostname, DATABASE: $database.");
$vampsprod_connection = mysql_connect($hostname, $username_v, $password_v) or die("Not connected with $hostname: " . mysql_error());

// $db_vamps = mysql_select_db('vamps', $vampsdev_connection);

$hostname_n = $config['databases']['newbpcdb2']['host']; 
$database_n = $config['databases']['newbpcdb2']['name']; 
$port_n     = $config['databases']['newbpcdb2']['port'];
$username_n = $config['databases']['newbpcdb2']['users']['readonly']['username'];
$password_n = $config['databases']['newbpcdb2']['users']['readonly']['password'];
$newbpc2_connection = mysql_connect($hostname_n, $username_n, $password_n) or die("Not connected with $hostname_n: " . mysql_error());

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
// print_out($config['databases']['newbpcdb2']);
?>