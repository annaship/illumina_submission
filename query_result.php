<?php include_once("ill_subm_beginning.php"); ?>
       
      <div class="queries_form">
      <div id="load" style="display:none;">Loading... Please wait</div> 
        <form action="query_result.php" method="post" id="dform">
          <table>
            <tr>
<!--         <div class="down_list"> -->
<?php //echo $PHP_SELF;

$rundate        = $_POST['rundate'];
$dna_region     = $_POST['dna_region'];
$chosen_query_n = $_POST['chosen_query'];

//   print $rundate;

// if ($dna_region == "") { $dna_region = "v6v4"; }

//   default $rundate - the last run
if ($rundate == "")
{
  $rundate_result = mysql_query("SELECT max(run) FROM env454.run WHERE run LIKE \"201%\"", $newbpc2_connection) or die("SELECT Error: $rundate_result: ".mysql_error());
  $row = mysql_fetch_row($rundate_result);
  $rundate = $row[0];
}

//   get run_id
$run_id_query = "SELECT run_id FROM env454.run WHERE run = '".$rundate."'";
$result2 = mysql_query($run_id_query, $newbpc2_connection) or die("SELECT Error: $run_id_query: ".mysql_error());
while($row = mysql_fetch_row($result2))
{
  $run_id = $row[0];
}

?>
           <td><label for="rundate">Rundate:</label></td> <td><input class="text_inp" type="text" name="rundate" value="<?php echo $rundate;?>"></td>
             
            </tr>
            <tr>
              <td><label for="rundate">Dna_region:</label></td><td><input class="text_inp" type="text" name="dna_region" value="<?php echo $dna_region;?>"></td>
            </tr>

            <tr>
            <td><label for="chosen_query">Select query:</label> </td>
            <td><select name="chosen_query">
<!--             todo: loop foreach $queries_by_name q1..q7 -->
            <?php 
              foreach ($queries_by_name as $key => $value)
              {
                echo '<option value="'.$key.'"';
                if ($chosen_query_n == $key)
                {
                  echo ' selected="selected"';
                } 
                echo ">";
                print_r($value);
                echo "</option>";
              } 
            
            ?>
                 </select>
              </td>
            </tr>
            <tr><td></td><td><div class="show_query"></div></td></tr>
          </table>
          <input type="Submit">
        </form>
        
      <div id = "csv_load">
        <a href="ill_subm_download.php">Click to download CSV file</a>
      </div>
      </div>
      <div class ="render_table">
      <?php include("table1.php"); ?>  
      </div>


    <!-- end of content -->
<?php include_once("ill_subm_end.php"); ?>
    
