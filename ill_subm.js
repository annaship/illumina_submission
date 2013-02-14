$("#add_new_row").click(function() {
	add_new_row();
	return false;

});

$('.hide_project').click(function() {
	$('tr.hide_project').toggle();
  });


$('button.hide_owner').click(function() {
	$('tr.hide_owner_tr').toggle();
  });

jQuery(function(){
    var counter = 1;
    jQuery('#add_new_rows').click(function(event){
        event.preventDefault();
        var copy_row_times = $('#copy_row_times').val();
        for (var i = 0; i < copy_row_times; ++i){		
		    counter++;
		    var newRow = jQuery('<tr><td><input class="text_inp" type="text" value="'+$('#form_domain_0').val()+'" name="domain' + 
		            counter + '"/></td> <td><input class="text_inp size_lane" type="text" value="'+$('#form_lane_0').val()+'" name="lane' + 
		            counter + '"/></td> <td><input class="text_inp size_data_owner" type="text" value="'+$('#form_data_owner_0').val()+'" name="data_owner' + 
		            counter + '"/></td> <td><div class="wide">NNNN<input class="text_inp size_run_key" type="text" value="'+$('#form_run_key_0').val()+'" name="run_key' + 
		            counter + '"/></td> <td><input class="text_inp size_barcode_index" type="text" value="'+$('#form_barcode_index_0').val()+'" name="barcode_index' + 
		            counter + '"/></td> <td><input class="text_inp size_project" type="text" value="'+$('#form_project_0').val()+'" name="project' + 
		            counter + '"/></td> <td><input class="text_inp size_dataset" type="text" value="'+$('#form_dataset_0').val()+'" name="dataset' + 
		            counter + '"/></td> <td><input class="text_inp size_dataset" type="text" value="'+$('#form_dataset_description_0').val()+'" name="dataset_description' + 
		            counter + '"/></td> <td><input class="text_inp size_env_source_name" type="text" value="'+$('#form_env_source_name_0').val()+'" name="env_source_name' + 
		            counter + '"/></td> <td><input class="text_inp size_tubelabel" type="text" value="'+$('#form_tubelabel_0').val()+'" name="tubelabel' + 
		            counter + '"/></td> <td><input class="text_inp size_tubelabel" type="text" value="'+$('#form_barcode_0').val()+'" name="barcode' + 
		            counter + '"/></td> <td><input class="text_inp size_tubelabel" type="text" value="'+$('#form_adaptor_0').val()+'" name="adaptor' + 
		            counter + '"/></td> <td><input class="text_inp size_tubelabel" type="text" value="'+$('#form_amp_operator_0').val()+'" name="amp_operator' + 
		            counter + '"/></td> </tr>');
		    jQuery('table#submission_metadata-fields').append(newRow);
//    	alert();
        }
    });
});

//$('#date').value = (new Date()).format("m/dd/yy");
//var newRow = "<tr><td>"+$('#building').val()+"</td><td>"+$('#floor').val()+"</td><td></td></tr>";
//$('#building-table').append(newRow);


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

//$(document).ready(function(){
//    $('#txtValue').keyup(function(){
//        sendValue($(this).val());   
//        
//    }); 
//    
//});
//
//function sendValue(str){
//    $.post("ajax.php",{ sendValue: str },
//    function(data){
//        $('#display').html(data.returnValue);
//    }, "json");
//    
//}
//
//$('#add_new_row').hover(
//	    function(){
//	      var $this = $(this);
//	      $this.data('bgcolor', $this.css('background-color')).css('background-color', '#999');
//	    },
//	    function(){
//	      var $this = $(this);
//	      $this.css('background-color', $this.data('bgcolor'));
//	    }
//	  );
//

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