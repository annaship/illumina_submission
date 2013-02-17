<?php
if(!isset($_SESSION)) { session_start(); } 
if ($_SESSION['is_local'])
{  
    $docroot = $_SESSION['docroot'];
}
?>
    </div>
    <!-- end of content -->
    <?php include("$docroot/templates/includes/footer.php"); 
    ?>		
    <!-- end of main table -->
    </div> <!-- End contentwrapper -->
  </div> <!-- End box -->
<!--   <a href="http://jquery.com/">jQuery</a> -->
  <script type="text/javascript" src= "jquery.min.js"></script>          
  <script type="text/javascript" src="sort_table.js"></script> 
  <script type="text/javascript" src="ill_subm.js"></script> 
  </body>
</html>
