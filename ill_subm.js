$("#add_new_row").click(function() {
	add_new_row();
	return false;

});

$('.hide_project').click(function() {
	$('tr.hide_project').toggle();
  });


$('.hide_owner').click(function() {
	$('tr.hide_owner').toggle();
  });


//function addEvent(obj, evType, fn){ 
// if (obj.addEventListener){ 
//   obj.addEventListener(evType, fn, false); 
//   return true; 
// } else if (obj.attachEvent){ 
//   var r = obj.attachEvent("on"+evType, fn); 
//   return r; 
// } else { 
//   return false; 
// } 
//}

$(document).ready(function(){
    $('#txtValue').keyup(function(){
        sendValue($(this).val());   
        
    }); 
    
});

function sendValue(str){
    $.post("ajax.php",{ sendValue: str },
    function(data){
        $('#display').html(data.returnValue);
    }, "json");
    
}

$('#add_new_row').hover(
	    function(){
	      var $this = $(this);
	      $this.data('bgcolor', $this.css('background-color')).css('background-color', '#999');
	    },
	    function(){
	      var $this = $(this);
	      $this.css('background-color', $this.data('bgcolor'));
	    }
	  );

function add_new_row()
{
	
//	  alert("Thanks for clicking me");
	  var newRow = document.all("table_subm").insertRow(-1);
	  var oCell = newRow.insertCell();
	  oCell.innerHTML = "<select name='dna_region_0' id='form_dna_region_0'> <option selected='selected' value='v6'>v6</option> <option value='v4v5'>v4v5</option> </select>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<select name='domain_0' id='form_domain_0'> <option selected='selected' value='Bacteria'>Bacteria</option> <option value='Archaea'>Archaea</option> <option value='Eukarya'>Eukarya</option> <option value='Fungi'>Fungi</option>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name='lane_0' id='form_lane_0' value='' size='1'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = " <select name='data_owner_0' id='form_data_owner_0'> <?php while($row = mysql_fetch_row($result_contact)) { echo '<option value='contact'>'.$row[1].', '.$row[0].'</option>'; } ?> </select> ";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "NNNN<input class='text_inp' type='text' name='run_key_0' id='form_run_key_0' value='' size='10'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name='barcode_index_0' id='form_barcode_index_0' value='' size='6'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<select name='project_0' id='form_project_0'> <?php while($row = mysql_fetch_row($result_project)) { echo '<option value='project'>'.$row[0].'</option>'; } ?> </select> ";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name='dataset_0' id='form_dataset_0' value='' size='30'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name='dataset_description_0' id='form_dataset_description_0' value='' size='30'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name=''.$value.'_0' id=''.$value.'_0' value='' size='10'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name=''.$value.'_0' id=''.$value.'_0' value='' size='10'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name=''.$value.'_0' id=''.$value.'_0' value='' size='10'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name=''.$value.'_0' id=''.$value.'_0' value='' size='10'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name=''.$value.'_0' id=''.$value.'_0' value='' size='10'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name=''.$value.'_0' id=''.$value.'_0' value='' size='10'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name=''.$value.'_0' id=''.$value.'_0' value='' size='10'/>";
	  var oCell = newRow.insertCell(-1);
	  oCell.innerHTML = "<input class='text_inp' type='text' name=''.$value.'_0' id=''.$value.'_0' value='' size='10'/>";
	  
	  return false;
}

/*
function addRow()
{	
//	show_alert();
    //add a row to the rows collection and get a reference to the newly added row
    var newRow = document.all("table_subm").insertRow();
    
    //add 3 cells (<td>) to the new row and set the innerHTML to contain text boxes
    
    var oCell = newRow.insertCell();
    oCell.innerHTML = "<input type='text' name='t1'>";
    
    oCell = newRow.insertCell();
    oCell.innerHTML = "<input type='text' name='t2'>";
    
    oCell = newRow.insertCell();
    oCell.innerHTML = "<input type='text' name='t3'>&nbsp;&nbsp;<input" + 
                      " type='button' id='show_alert' value='show_alert'/>";   
	#show_alert.onclick = alert("I am an alert box!");

}

addEvent(window, 'load', addRow);

function show_alert()
{
	show_alert.onclick = alert("I am an alert box!");
//	alert("I am an alert box!");
}
*/
/*
addEvent(window, 'load', pageinit);
//addEvent(window, 'load', get_popup_class);
//addEvent(window, 'load', my_click_alert);

//addEvent(window, 'load', query_chosen);


var ray={
ajax:function(st)
	{
		this.show('load');
	},
show:function(el)
	{
		this.getID(el).style.display='';
	},
getID:function(el)
	{
		return document.getElementById(el);
	}
}

function pageinit()
{
    if (document.getElementById)
    {
        var df = document.getElementById('dform');
        	df.onsubmit=function(){return ray.ajax()};        
    }
}

*/