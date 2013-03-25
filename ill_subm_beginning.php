<?php
if(!isset($_SESSION)) { session_start(); } 
// $_SESSION["run_info"] = array();
if ($_SESSION['is_local'])
{  
    $docroot = $_SESSION['docroot'];
    include_once("ill_subm_functions.php");
  ?>

  <link rel='stylesheet'  type='text/css' href="ill_subm.css"/>
  </head>
    <body>
      <div id="header_cv">
        <a href="http://vamps.mbl.edu/"><img id="header_top" src="<?php echo "$docroot"?>/templates/images/jbpc_header_top6.jpg" alt="VAMPS Header -Top" /></a>
        <a href="http://jbpc.mbl.edu/"><img id="header_bottom" src="<?php echo "$docroot"?>/templates/images/jbpc_header_bottom6.jpg" alt="VAMPS Header -Bottom" /></a>
        <a href="http://www.mbl.edu/"><img id="mbl_logo" src="<?php echo "$docroot"?>/templates/images/logo_mbl.png" alt="MBL Logo" height="90" /></a>
        <img id="dna" src="<?php echo "$docroot"?>/templates/images/DNA_header_trans.gif" alt="dna" height='100'/>

      <?php include("left_menu.php"); ?>  

      </div>  
          <!-- end header -->
          <!-- begin main table -->
        <div id='box'> <!-- the box div is needed to make IE look normal -->
          <div id='contentwrapper'>                  
            <div id='content'>
<?php
}
else
{
// Include the web application configuration file.
include("vamps_virtual_setup.php");
include_once("ill_subm_functions.php");
$total_subm_rows = 0;

// Enable or disable debugging...
$application_data['modules']['logger']->debug = false;
$application_data['config'] = $config;
include_once($application_data['config']['paths']['root']."/docs/includes/debug_header.php");

$state = $_SESSION['state'];
require_once('checkSession.php');
$user          = checkSession();
$TITLE         = "VAMPS - TITLE GOES HERE";
$logged_in_msg = "Logged in as: $current_login_name";   
?>
  
  <link rel='stylesheet'  type='text/css' href="ill_subm.css"/>
</head>
<!--  AAV 20081203
Do not remove the attributes in the body tag {onload="init()" onunlood="close_windows()"}
evidently they are needed for the manual moving of the heatmap rows on the site_by_site_heatmap page
and proper updating of the state variable to the heatmap and crosstabs windows
-->
<body>
  <div id="header_cv">
    <a href="http://vamps.mbl.edu/"><img id="header_top" src="/templates/images/jbpc_header_top6.jpg" alt="VAMPS Header -Top" /></a>
    <a href="http://jbpc.mbl.edu/"><img id="header_bottom" src="/templates/images/jbpc_header_bottom6.jpg" alt="VAMPS Header -Bottom" /></a>
    <a href="http://www.mbl.edu/"><img id="mbl_logo" src="/templates/images/logo_mbl.png" alt="MBL Logo" height="90" /></a>
    <img id="dna" src="/templates/images/DNA_header_trans.gif" alt="dna" height='100'/>

  <?php include("left_menu.php"); ?>  
  
  </div>
  
      <!-- end header -->
      <!-- begin main table -->
  
  <?php // include("/templates/includes/nav-left.php"); ?>
      
  <div id='box'> <!-- the box div is needed to make IE look normal -->
    <div id='contentwrapper'>        
    <?php 
      if(isset($_SESSION["authenticatedUser"])){
        include("$docroot/templates/includes/extras.php");
      }
      include("db_connect.php");
    ?>


    <div id='content'>
<!--       <div class="where_form"> -->
<!--         <form action="ill_subm_index.php" method="post"> -->
<!--           submit_code: <input class="text_inp" type="text" name="submit_code"><br> -->
<!--           WHERE statement: <input class="text_inp" type="text" name="whole_where"><br> -->
<!--           <input type="Submit"> -->
<!--         </form> -->
       
<?php 
// What you see in drop down select:
$queries_by_name = array(
    'q1' => "Determine the number of reads that made it into the database",
//     "SELECT lane, count(rawseq_id) as seqcnt FROM rawseq JOIN env454.run using(run_id) WHERE run='rundate' group by lane",
    'q2' => "Check the number of reads that were loaded into gast_rundate_dna_region", 
//     "SELECT COUNT(distinct read_id) FROM gast_rundate_dna_region",
    'q3' => "Check that the initial set of sequences is correct", 
//     "SELECT COUNT(DISTINCT trimsequence_id) FROM trimseq
//               JOIN run using(run_id)
//               JOIN dna_region using(dna_region_id)
//               WHERE run = 'rundate' AND dna_region = '<em>dna_region</em>'",
    'q4' => "Count the reads in the tagtax table for your run",
//     "SELECT count(read_id) from tagtax
//               JOIN trimseq using(read_id)
//               JOIN run using(run_id)
//               WHERE run='rundate'",
    'q5' => "Taxonomic diversity of your run", 
//     "SELECT taxonomy, count(read_id) as count_all from tagtax JOIN taxonomy USING(taxonomy_id)
//               JOIN trimseq using(read_id)
//               JOIN run using(run_id)
//               WHERE run='rundate' group by taxonomy",
    'q6' => "Taxonomy by project and dataset", 
//     "SELECT project, dataset, taxonomy, count(read_id) from tagtax
//               JOIN taxonomy USING(taxonomy_id)
//               JOIN trimseq using(read_id)
//               JOIN project using(project_id)
//               JOIN dna_region using(dna_region_id)
//               JOIN dataset using(dataset_id)
//               JOIN run using (run_id)
//               WHERE run=rundate group by project, dataset, taxonomy;",
    'q7' => "Delete reason / project / dataset for your run",  
    'q8' => "Billing info from Vamps submission",    
    'q9' => "Overview of your run from Vamps submission",
    'q10' => "Project / dataset / run uploaded on vamps",
    'q11' => "New project / dataset uploaded on vamps",
// SELECT project, dataset, user FROM vamps.vamps_projects_datasets 
//                   LEFT JOIN vamps.vamps_projects_datasets_previous USING(project, dataset, dataset_count, has_sequence, date_trimmed, dataset_info) 
//                   LEFT JOIN vamps.vamps_users USING(project)
//                   WHERE vamps.vamps_projects_datasets_previous.id IS NULL
    
); 

$submit_code = $_GET['code'];

}
?>
