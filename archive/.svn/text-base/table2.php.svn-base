works short
<?php

// <a href='./admin_submission.php'>Admin Submissions Page</a> --
// <a href='./admin_submission_table.php'>Submissions Table</a> --
// <a href='./admin_submission_tubes_table.php'>All Tubes Table</a>
    
     $q0 = "select * from vamps_submissions_tubes limit 7";
// $q0 = "select * from vamps_submissions_tubes where submit_code='$submit_code' order by date_updated DESC";
//       		     $q0 = "select * from vamps_submissions_tubes order by date_updated DESC limit 5";
      		     	
     $result = mysql_query($q0, $connection) or die("SELECT Error: ".mysql_error());
     
     /* get column metadata */
     $i = 0;
     $num_field = mysql_num_fields($result);
     $num_rows  = mysql_numrows($result);
     while ($i < $num_field) 
     {
//        echo "Information for column $i:<br />\n";
       $meta = mysql_fetch_field($result, $i);
       if (!$meta) 
       {
       echo "No information available<br />\n";
       }
       $col_name[$i] = $meta->name;        

//        echo "<pre>
//        name:         $meta->name
//        blob:         $meta->blob
//        max_length:   $meta->max_length
//        multiple_key: $meta->multiple_key
//        not_null:     $meta->not_null
//        numeric:      $meta->numeric
//        primary_key:  $meta->primary_key
//        table:        $meta->table
//        type:         $meta->type
//        unique_key:   $meta->unique_key
//        unsigned:     $meta->unsigned
//        zerofill:     $meta->zerofill
//        </pre>";
       $i++;
     }

     echo "<div #query_rendering>
     <table id='submission_tubes_table' class='sortable'>
     <thead>
     <tr>";
     
     $k = 1;
     while ($k < $num_field)
     {
       echo "<th>$col_name[$k]</th>";
       $k++;
     }      
     echo "</tr>
     </thead>
     <tbody>
     ";     
     
     while ($row = mysql_fetch_row($result))
     {
       echo "<tr>";
       $k = 1;
       while ($k < $num_field)
       {
         echo "<td>$row[$k]</td>";
         $k++;
       } 
       echo "</tr>";
     }
     
     

echo "</tbody>
     </table>
    </div>";

?>
=============
<?php
$application_data['config'] = $config;
$password_w = $application_data['config']['databases']['vamps']['users']['readwrite']['password'];
$username_w = $application_data['config']['databases']['vamps']['users']['readwrite']['username'];
$database = $application_data['config']['databases']['vamps']['name'];
$hostname = $application_data['config']['databases']['vamps']['host'];
$application_data['modules']['logger']->debug(__FILE__.":".__LINE__.":".__FUNCTION__, "USERNAME: $username_w, PASSWORD: $password_w, HOSTNAME: $hostname, DATABASE: $database.");
$connection = mysql_connect($hostname, $username_w, $password_w) or die('Not connected: ' . mysql_error());

mysql_select_db('vamps', $connection);

$submit_code = $_GET['code'];

// <a href='./admin_submission.php'>Admin Submissions Page</a> --
// <a href='./admin_submission_table.php'>Submissions Table</a> --
// <a href='./admin_submission_tubes_table.php'>All Tubes Table</a>
    
     $q0 = "select * from vamps_submissions_tubes limit 5";
// $q0 = "select * from vamps_submissions_tubes where submit_code='$submit_code' order by date_updated DESC";
//       		     $q0 = "select * from vamps_submissions_tubes order by date_updated DESC limit 5";
      		     	
     $result = mysql_query($q0, $connection) or die("SELECT Error: ".mysql_error());
     
     /* get column metadata */
     $i = 0;
     while ($i < mysql_num_fields($result)) {
//        echo "Information for column $i:<br />\n";
       $meta = mysql_fetch_field($result, $i);
       if (!$meta) {
       echo "No information available<br />\n";
       }
       $col_name[$i] = $meta->name;
//        echo "<pre>
//        name:         $meta->name
//        </pre>";
       //        blob:         $meta->blob
//        max_length:   $meta->max_length
//        multiple_key: $meta->multiple_key
//        not_null:     $meta->not_null
//        numeric:      $meta->numeric
//        primary_key:  $meta->primary_key
//        table:        $meta->table
//        type:         $meta->type
//        unique_key:   $meta->unique_key
//        unsigned:     $meta->unsigned
//        zerofill:     $meta->zerofill
       $i++;
     }
//      mysql_free_result($result);
      
     echo "<div #query_rendering>
     <table id='submission_tubes_table' class='sortable'>
     <thead>
     <tr>
     <th>$col_name[1]</th>
     <th>$col_name[2]</th>
     <th>$col_name[3]</th>
     <th>$col_name[4] Suite</th>
     <th>$col_name[5]</th>
     <th>$col_name[6]</th>
     <th>$col_name[7]</th>
     <th>$col_name[8]</th>
     <th>$col_name[9]</th>
     <th>$col_name[10]</th>
     <th>$col_name[11]</th>
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
     
     
     while($row = mysql_fetch_row($result))
     {
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
         
         //        for($i = 1; $i < $num_field; $i++)
           //        {
           //          echo "\$num_field = $num_field";
           //          echo "\$i = $i";
           //          echo "<td>$row[$i]</td>";
           //        }
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
works
<?php
$application_data['config'] = $config;
$password_w = $application_data['config']['databases']['vamps']['users']['readwrite']['password'];
$username_w = $application_data['config']['databases']['vamps']['users']['readwrite']['username'];
$database = $application_data['config']['databases']['vamps']['name'];
$hostname = $application_data['config']['databases']['vamps']['host'];
$application_data['modules']['logger']->debug(__FILE__.":".__LINE__.":".__FUNCTION__, "USERNAME: $username_w, PASSWORD: $password_w, HOSTNAME: $hostname, DATABASE: $database.");
$connection = mysql_connect($hostname, $username_w, $password_w) or die('Not connected: ' . mysql_error());

mysql_select_db('vamps', $connection);

$submit_code = $_GET['code'];

// <a href='./admin_submission.php'>Admin Submissions Page</a> --
// <a href='./admin_submission_table.php'>Submissions Table</a> --
// <a href='./admin_submission_tubes_table.php'>All Tubes Table</a>
    
     $q0 = "select * from vamps_submissions_tubes limit 5";
// $q0 = "select * from vamps_submissions_tubes where submit_code='$submit_code' order by date_updated DESC";
//       		     $q0 = "select * from vamps_submissions_tubes order by date_updated DESC limit 5";
      		     	
     $result = mysql_query($q0, $connection) or die("SELECT Error: ".mysql_error());
     
     /* get column metadata */
     $i = 0;
     $num_field = mysql_num_fields($result);      
     while ($i < $num_field) {
//        echo "Information for column $i:<br />\n";
       $meta = mysql_fetch_field($result, $i);
       if (!$meta) {
       echo "No information available<br />\n";
       }
       $col_name[$i] = $meta->name;
//        echo "<pre>
//        name:         $meta->name
//        </pre>";
       //        blob:         $meta->blob
//        max_length:   $meta->max_length
//        multiple_key: $meta->multiple_key
//        not_null:     $meta->not_null
//        numeric:      $meta->numeric
//        primary_key:  $meta->primary_key
//        table:        $meta->table
//        type:         $meta->type
//        unique_key:   $meta->unique_key
//        unsigned:     $meta->unsigned
//        zerofill:     $meta->zerofill
       $i++;
     }
//      mysql_free_result($result);
      
     echo "<div #query_rendering>
     <table id='submission_tubes_table' class='sortable'>
     <thead>
     <tr>";
     
     for($i = 1; $i < $num_field; $i++)
     {
       echo "<th>$col_name[$i]</th>";
     }
    

     echo "<tr>
     </thead>
     <tbody>
     ";     
     
     $i = 0;
     while($row = mysql_fetch_row($result))
     {
         $i++;
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
         
         echo "<tr>";
         for($i = 1; $i < $num_field; $i++)
         {
         echo "<td>$row[$i]</td>";
         }
         echo "</tr>";
           
//            <td style='white-space:nowrap;'>$tube_number - $tube_label</td>
//            <td style='white-space:nowrap;'>$domain</td>
//            <td>$psuite</td>
//            <td>$project</td>
//            <td>$dataset</td>
//            <td>$runkey</td>
//            <td>$barcode</td>
//            <td>$pool</td>
//            <td>$lane</td>
//            <td>$direction</td>
//            <td>$enzyme</td>
//            <td>$rundate</td>
//            <td>$adaptor</td>
//            <td style='white-space:nowrap;'>$init_date</td>
//            <td style='white-space:nowrap;'>$updated_date</td>
//            <td>$sample_recieved</td>
       }
echo "</tbody>
     </table>
    </div>";

?>