                  <option value="q1" <?php if ($chosen_query_n == 'q1') echo 'selected="selected"'?>><?php print_r($queries_by_name{'q1'});?></option>
                  <option value="q2" <?php if ($chosen_query_n == 'q2') echo 'selected="selected"'?>><?php print_r($queries_by_name{'q2'});?></option>
                  <option value="q3" <?php if ($chosen_query_n == 'q3') echo 'selected="selected"'?>><?php print_r($queries_by_name{'q3'});?></option>
                  <option value="q4" <?php if ($chosen_query_n == 'q4') echo 'selected="selected"'?>><?php print_r($queries_by_name{'q4'});?></option>
                  <option value="q5" <?php if ($chosen_query_n == 'q5') echo 'selected="selected"'?>><?php print_r($queries_by_name{'q5'});?></option>
                  <option value="q6" <?php if ($chosen_query_n == 'q6') echo 'selected="selected"'?>><?php print_r($queries_by_name{'q6'});?></option>
                  <option value="q7" <?php if ($chosen_query_n == 'q7') echo 'selected="selected"'?>><?php print_r($queries_by_name{'q7'});?></option>

<a href="#" onclick="openHelpWindow('/vamps/help/general_help.php#visualization','','width=700,height=400,scrollbars=1')">(?)</a>

function query_chosen()
{
  document.getElementById('dform').onchange = function()
  {
  	alert(this.value)
    if (this.value) 
    {
  	alert('Here')
  	alert(this.value)
//    document.getElementById('dform').submit();
  	}
  }
}

<SELECT>
<?php
@ $db = mysql_connect("localhost", "smth", "smth");
mysql_select_db("database_name");
$strSQL = "SELECT * FROM select1options ORDER BY name";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["name"]."\">".$r["name"]."</OPTION>";
}
?>
</SELECT>

http://phpnmysql.blogspot.com/2007/04/php-beginners-using-html-form-elements.html

two servers:
http://bytes.com/topic/php/answers/871126-connect-two-different-database-server-using-php

on change:
http://api.jquery.com/change/

http://www.electrictoolbox.com/jquery-add-option-select-jquery/

var newOptions = {
    'red' : 'Red',
    'blue' : 'Blue',
    'green' : 'Green',
    'yellow' : 'Yellow'
};
var selectedOption = 'green';

var select = $('#example');
if(select.prop) {
  var options = select.prop('options');
}
else {
  var options = select.attr('options');
}
$('option', select).remove();

$.each(newOptions, function(val, text) {
    options[options.length] = new Option(text, val);
});
select.val(selectedOption);


===
<?php 
if (mysql_num_rows($result) > 0) {
while ($row = mysql_fetch_assoc($result)) {
$csv_output .= $row['Field'].";";
$i++;}
}
$csv_output .= "\n";
 $values = mysql_query("SELECT * FROM ".$table."");
 
while ($rowr = mysql_fetch_row($values)) {
for ($j=0;$j<$i;$j++) {
$csv_output .= $rowr[$j]."; ";
}
$csv_output .= "\n";
}
 
$filename = $file."_".date("d-m-Y_H-i",time());
 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
 
print $csv_output;

// store and print table headers
function store_table_headers($result, $num_field)
{
  //   store
  while ($i < $num_field)
  {
    $meta = mysql_fetch_field($result, $i);
    if (!$meta)
    {
      echo "No information available<br />\n";
    }
    $col_name[$i] = $meta->name;
    $i++;

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
  }

  // //   print
  //   $k = 1;
  //   while ($k < $num_field)
    //   {
    //    echo "<th>$col_name[$k]</th>";
    //    $k++;
    //   }

  $return($col_name);
}

function print_table_body($result, $num_field)
{
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
  }
  
?>
$('div.left').css('float');
.css({
  'background-color': '#ffe', 'border-left': '5px solid #ccc'}) and .css({
  backgroundColor: '#ffe', borderLeft: '5px solid #ccc'}).  
$('#csv_load').css({'color': 'green'})

function my_click_alert()
{
	$('th').click(function() {
	//return ray.ajax();
		//$('#load').css({'display': 'block'});
//		$('#load').show();
//		$('h3').css({'color': 'green'});
//  		alert("Sorting. Please hit OK");
	});
	
	//(function() {return ray.ajax()});
//	function() {
//  		alert("Handler for .click() called.");
//	});    
}
//window.onload = function() {
function get_popup_class() 
{

	// check to see that the browser supports the getElementsByTagName method
	// if not, exit the loop 
	if (!document.getElementsByTagName) 
	{
		return false; 
	} 
	// create an array of objects of each link in the document 
	var popuplinks = document.getElementsByTagName("a");
	// loop through each of these links (anchor tags) 	
	for (var i=0; i < popuplinks.length; i++) {	
		// if the link has a class of "popup"...	
		if (popuplinks[i].getAttribute("class") == "popup") {	
			// add an onclick event on the fly to pass the href attribute	
			// of the link to our second function, openPopUp 	
			popuplinks[i].onclick = function() {	
			openPopUp(this.getAttribute("href"));	
			return false; 	
			} 	
		}
	} 
} 

function openPopUp(linkURL) {
	window.open(linkURL,'popup','width=100%,height=20')
}

//$(document).ready(function(){
//  $(".show_alert").click(function(event){
//    alert("SELECT lane, count(rawseq_id) as seqcnt FROM rawseq JOIN env454.run using(run_id) WHERE run='rundate' group by lane order by lane");
//  });
//});


//var newOptions = {
//    'red' : 'Red',
//    'blue' : 'Blue',
//    'green' : 'Green',
//    'yellow' : 'Yellow'
//};


//$.each(newOptions, function(val, text) {
//    options[options.length] = new Option(text, val);
//});
//select.val(selectedOption);
 