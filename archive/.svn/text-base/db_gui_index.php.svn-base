<?php
// Include the web application configuration file.
include("vamps_virtual_setup.php");
// Enable or disable debugging...
$application_data['modules']['logger']->debug = false;
$application_data['config'] = $config;
include_once($application_data['config']['paths']['root']."/docs/includes/debug_header.php");


$state = $_SESSION['state'];
require_once('checkSession.php');
$user = checkSession();

$TITLE = "VAMPS - Data Base Queries";
//include "$docroot/templates/includes/header_start.php";

$logged_in_msg = "Logged in as: $current_login_name";

//include("$docroot/templates/includes/header_main_start.php"); 
?>
<!--  <link rel='stylesheet'  type='text/css' href="/portals/portal.css"  />-->
  <link rel='stylesheet'  type='text/css' href="/templates/vamps.css"  />
  <link rel='stylesheet'  type='text/css' href="/vamps/css/cv_vamps.css"  />
  <link rel='stylesheet'  type='text/css' href="db_gui.css"/>
  
</head>
<!--  AAV 20081203
Do not remove the attributes in the body tag {onload="init()" onunlood="close_windows()"}
evidently they are needed for the manual moving of the heatmap rows on the site_by_site_heatmap page
and proper updating of the state variable to the heatmap and crosstabs windows
-->
<body onload="init()" onunload="close_windows()">
<div id="header_cv">
  <a href="http://vamps.mbl.edu/"><img id="header_top" src="/templates/images/jbpc_header_top6.jpg" alt="VAMPS Header -Top" /></a>
  <a href="http://jbpc.mbl.edu/"><img id="header_bottom" src="/templates/images/jbpc_header_bottom6.jpg" alt="VAMPS Header -Bottom" /></a>
  <a href="http://www.mbl.edu/"><img id="mbl_logo" src="/templates/images/logo_mbl.png" alt="MBL Logo" height="90" /></a>
  <img id="dna" src="/templates/images/DNA_header_trans.gif" alt="dna" height='100'/>

	
</div>

    <!-- end header -->
    <!-- begin main table -->

<?php include("/templates/includes/nav-left.php"); ?>
    
<div id='box'> <!-- the box div is needed to make IE look normal -->
<div id='contentwrapper'>
    
<?php 
  if(isset($_SESSION["authenticatedUser"]))
  {
    include("$docroot/templates/includes/extras.php");
  }
?>
<div id='content' class='db_gui'>
My awesome content!

<?
$application_data['config'] = $config;
$password_w = $application_data['config']['databases']['vamps']['users']['readwrite']['password'];
$username_w = $application_data['config']['databases']['vamps']['users']['readwrite']['username'];
$database = $application_data['config']['databases']['vamps']['name'];
$hostname = $application_data['config']['databases']['vamps']['host'];
$application_data['modules']['logger']->debug(__FILE__.":".__LINE__.":".__FUNCTION__, "USERNAME: $username_w, PASSWORD: $password_w, HOSTNAME: $hostname, DATABASE: $database.");
$connection = mysql_connect($hostname, $username_w, $password_w) or die('Not connected: ' . mysql_error());

mysql_select_db('vamps', $connection);

// //$q0 = "select * from new_rank_number";
// //$q1 = "SELECT * FROM vamps_submissions JOIN vamps_submissions_tubes USING (submit_code)";
// if (!isset($sort)){
//   $sort = "rundate"; // the one to sort by default
// }

// $q1 = "SELECT * FROM vamps_submissions JOIN vamps_submissions_tubes USING (submit_code) ORDER BY $sort limit 5";

// $result = mysql_query($q1, $connection) or die("SELECT Error: ".mysql_error()); 
// //while($row = mysql_fetch_row($result))
// //{
// //
// //  print_r($row);
// //}



// $num_rows = mysql_num_rows($result);
// print "There are $num_rows records.<P>";
// print "<table width=400 border=1>\n";
// while ($get_info = mysql_fetch_row($result))
//   {
//     print "<tr>\n";
//     foreach ($get_info as $field)
//     print "\t<td><font face=arial size=1/>$field</font></td>\n";
//     print "</tr>\n";
// }
// print "</table>\n";


// //print the table
// echo '<table><tr><td>column1</td><td>column2</td><td>column3</td></tr>';
// while($row = mysql_fetch_assoc($q1))
// {
//   //echo the results
//   echo '<tr><td><a href="'.$page.'?sort=column1>"'.$row['column1'].'</a></td><td><a href="'.$page.'?sort=column2>"'.$row['column2'].'</a></td><td>a href="'.$page.'?sort=column3>"'.$row['column3'].'</a></td></tr>\n';
// }
// //close the table
// echo '</table>';

// //sortable table: <?php
// echo "<h2>List of Submitted Tubes for $submit_code</h2>";
// //echo "<div style=''><table>
// //        <tr>
// //          <td><a href='./admin_submission.php'>Admin Submissions Page</a></td><td>|</td>
// //          <td><a href='./admin_submission_table.php'>Submissions Table</a></td><td>|</td>
// //          <td><a href='./admin_submission_tubes_tableSC.php'>Tubes By Submit Code</a></td><td>|</td>
// //          <td><a href='./admin_submission_tubes_tableRD.php'>Tubes By Rundate</a></td><td>|</td>
// //          <td>
// //            <form method='POST' name='delete_form' action='admin_submission_table.php'>
// //              <input type='button' value='Delete this Submission: $submit_code' onclick=\"delete_submit('".$submit_code."')\" />
// //              <input type='hidden' name='delete' value='$submit_code'>
// //            </form>
// //          </td>
// //        </tr>
// //      </table>
// //     </div>";

?>


</div>

<div id='box'> <!-- the box div is needed to make IE look normal -->
<div id='contentwrapper'>
        <?php include("$path/templates/includes/extras.php"); ?>
        <!-- begin main table -->
<div id="sortable_table">
<?php


$submit_code = $_GET['code'];


echo "<div style=''>
	    <a href='./admin_submission.php'>Admin Submissions Page</a> -- 
    	<a href='./admin_submission_table.php'>Submissions Table</a> -- 
      	<a href='./admin_submission_tubes_table.php'>All Tubes Table</a>
      	<table id='submission_tubes_table' class='sortable' border='1' style='border-collapse:collapse;'>
      	  <thead>
      	    <tr>
              <th>Submission Code</th>
              <th>Tube</th>
              <th>Domain</th>
              <th>Primer Suite</th>
              <th>Project</th>
              <th>Dataset</th>
              <th>Runkey</th>
              <th>Barcode</th>
              <th>Pool</th>
              <th>Lane</th>
              <th>Direction</th>
              <th>Enzyme</th>
              <th>Rundate</th>
              <th>Adaptor</th>
              <th>Initial Date</th>
              <th>Date Updated</th>
              <th>Sample Recieved</th>
            </tr>
          </thead>
      <tbody>
      ";
      
      		     $q0 = "select * from vamps_submissions_tubes limit 5";
// $q0 = "select * from vamps_submissions_tubes where submit_code='$submit_code' order by date_updated DESC";
//       		     $q0 = "select * from vamps_submissions_tubes order by date_updated DESC limit 5";
      		     	
      		     $result = mysql_query($q0, $connection) or die("SELECT Error: ".mysql_error());
      		     while($row = mysql_fetch_row($result))
      		       {
      		       
//       		        print_r($row);
//       		       }
//       		     $result = mysql_query($q0, $connection) or die("SELECT Error: ".mysql_error());
      		     	
//                  $result = $connection->createResultSet($q0,'vamps');
//        foreach($result as $row){
//          print_r($row);
          
//            $submit_code = $row['submit_code'];
//            $tube_number = $row['tube_number'];
//            $tube_label = $row['tube_label'];
//            $duplicate = $row['duplicate'];
//            $domain = $row['domain'];
//            $psuite = $row['primer_suite'];
//            $source= $row['source'];
//            $project = $row['project_name'];
//            $dataset = $row['dataset_name'];
//            $runkey = $row['runkey'];
//            $barcode = $row['barcode'];
//            $pool = $row['pool'];
//            $lane = $row['lane'];
//            $direction = $row['direction'];
//            $op_amp = $row['op_amp'];
//            $op_empcr = $row['op_empcr'];           
//            $op_seq = $row['op_seq'];
//            $enzyme = $row['enzyme'];
//            $rundate = $row['rundate'];
//            $adaptor = $row['adaptor'];
//            $init_date = $row['date_initial'];
//            $updated_date = $row['date_updated'];
//            $sample_recieved = $row['sample_recieved'];
         $submit_code = $row[1];
         $tube_number = $row[2];
         $tube_label = $row[3];
         $duplicate = $row[4];
         $domain = $row[5];
         $psuite = $row[6];
         $source= $row[7];
         $project = $row[8];
         $dataset = $row[9];
         $runkey = $row[10];
         $barcode = $row[11];
         $pool = $row[12];
         $lane = $row[13];
         $direction = $row[14];
         $op_amp = $row[15];
         $op_empcr = $row[16];
         $op_seq = $row[17];
         $enzyme = $row[18];
         $rundate = $row[19];
         $adaptor = $row[20];
         $init_date = $row[21];
         $updated_date = $row[22];
         $sample_recieved = $row[23];
         
           echo "<tr>
           <td>$submit_code</td>
           <td style='white-space:nowrap;'>$tube_number - $tube_label</td>
           <td style='white-space:nowrap;'>$domain</td>
           <td>$psuite</td>
           <td>$project</td>
           <td>$dataset</td>
           <td>$runkey</td>
           <td>$barcode</td>
           <td>$pool</td>
           <td>$lane</td>
           <td>$direction</td>
           <td>$enzyme</td>
           <td>$rundate</td>
           <td>$adaptor</td>
           <td style='white-space:nowrap;'>$init_date</td>
           <td style='white-space:nowrap;'>$updated_date</td>
           <td>$sample_recieved</td>
           </tr>";
       }
echo "</tbody>
      </table>
      </div>";
      

 



?>

</div>
</div>
</div>

<!-- end of content -->
<?php include("$docroot/templates/includes/footer.php"); ?>		
<!-- end of main table -->
<!-- Begin Hidden HTML -->
<!-- End Hidden HTML -->
</div> <!-- End contentwrapper -->
</div> <!-- End box -->
<!-- 	<link rel="shortcut icon" href="/templates/images/favicon.ico" /> -->
    <script type="text/javascript" src='/library/dhtmlxtreegrid/dhtmlxGrid/codebase/dhtmlxcommon.js'></script>
    <script type="text/javascript" src='/library/dhtmlxtreegrid/dhtmlxGrid/codebase/dhtmlxgrid.js'></script>
    <script type="text/javascript" src='/library/dhtmlxtreegrid/dhtmlxGrid/codebase/dhtmlxgridcell.js'></script>
    <script src="/library/dhtmlxtreegrid/dhtmlxCombo/codebase/dhtmlxcombo.js" type="text/javascript"></script>
    <script src="/library/dhtmlxtreegrid/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>
    <script src="/library/dhtmlxtreegrid/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>
    <script src="/library/dhtmlxtreegrid/dhtmlxGrid/codebase/excells/dhtmlxgrid_excell_combo.js"></script>
    <script src="/library/dhtmlxtreegrid/dhtmlxTreeGrid/codebase/dhtmlxtreegrid.js"></script>
    <script src="/library/dhtmlxtreegrid/dhtmlxGrid/codebase/ext/dhtmlxgrid_splt.js"></script>
    <script src="/library/dhtmlxtreegrid/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js"></script>    
    
    <script language="javascript" type="text/javascript" src="../javascript/AJAX_utils.js"></script>
    <script language="javascript" type="text/javascript" src="../utils/submissions/admin_submit.js">     </script>
     
    <script type="text/javascript" src="sort_table.js"></script>
    <script language="JavaScript" type='text/javascript'>
      function init(){}
      function close_windows(){}
    </script>

</body>
</html>
