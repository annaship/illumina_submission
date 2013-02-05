<?php
// Include the web application configuration file.
include("vamps_virtual_setup.php");
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
  
  <link rel='stylesheet'  type='text/css' href="db_gui.css"/>
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

<!--     <div class="where_form"> -->
<!--       <form action="select_where.php" method="post"> -->
<!--         submit_code: <input type="text" name="submit_code"><br> -->
<!--         <input type="Submit"> -->
<!--       </form> -->
<!--     </div> -->


    <div id='content'>
    <?php include("table1.php"); ?>  
    </div>
     
    <!-- end of content -->
    <?php include("$docroot/templates/includes/footer.php"); ?>		
    <!-- end of main table -->
    </div> <!-- End contentwrapper -->
  </div> <!-- End box -->
  <script type="text/javascript" src="sort_table.js"></script> 
</body>
</html>
