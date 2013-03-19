$("#add_new_row").click(function() {
	add_new_row();
	return false;

});

$('.hide_project').click(function() {
	$('tr.hide_project_tr').toggle();
  });

$('.hide_owner').click(function() {
//	$('tr.hide_owner_tr').show();
	$('tr.hide_owner_tr').toggle();
//	$('tr.hide_owner_tr').css("display","block");
  });

$('#submission_metadata-fields').delegate('#delete_row', 'click', function(){
    $(this).closest('tr').remove();
});
//.delegate('.add', 'click', function(){
//    $(this).closest('tr').clone().appendTo( $(this).closest('tbody') );
//});

jQuery(function(){
    var counter = 0;
    jQuery('#add_new_rows').click(function(event){
        event.preventDefault();
//        alert($('#form_project_0').val());
        var copy_row_times = $('#copy_row_times').val();
        for (var i = 0; i < copy_row_times; ++i){		
		    counter++;
		    var newRow = jQuery('<tr class="repeated_row" id="delete_row_' + 
		            counter + '"><td><input class="text_inp" type="text" readonly="readonly" value="'+$('#form_domain_0').val()+'" name="domain_' + 
		            counter + '"/></td> <td><input class="text_inp" type="text" value="'+$('#form_lane_0').val()+'" name="lane_' + 
		            counter + '"/></td> <td><input class="text_inp" type="text" value="'+$('#form_data_owner_0').val()+'" name="data_owner_' + 
		            counter + '"/></td> <td><div class="wide" id="form_run_key_' + 
		            counter + '">NNNN</td> <td><div id="barcode_index_' + 
		            counter + '"</td> <td><input class="text_inp size_tubelabel" type="text" value="'+$('#form_adaptor_0').val()+'" name="adaptor_' + 
		            counter + '"/></td> <td><input class="text_inp" type="text" readonly="readonly" value="'+$('#form_project_0').val()+'" name="project_' + 
		            counter + '"/></td> <td><input class="text_inp size_dataset" type="text" value="'+$('#form_dataset_0').val()+'" name="dataset_' + 
		            counter + '"/></td> <td><input class="text_inp size_dataset" type="text" value="'+$('#form_dataset_description_0').val()+'" name="dataset_description_' + 
		            counter + '"/></td> <td><input class="text_inp" type="text" readonly="readonly" value="'+$('#form_env_source_name_0').val()+'" name="env_source_name_' + 
		            counter + '"/></td> <td><input class="text_inp size_tubelabel" type="text" value="'+$('#form_tubelabel_0').val()+'" name="tubelabel_' + 
		            counter + '"/></td> <td><input class="text_inp size_tubelabel" type="text" value="'+$('#form_barcode_0').val()+'" name="barcode_' + 
		            counter + '"/></td> <td><input class="text_inp size_tubelabel" type="text" value="'+$('#form_amp_operator_0').val()+'" name="amp_operator_' + 
		            counter + '"/></td> <td><input type="button" value="Delete" id="delete_row" /></td> </tr>');
		    jQuery('table#submission_metadata-fields').append(newRow);
//    	alert();  onclick="return window.confirm('Please confirm delete');"
        }
        return false;
    });
});




//$('#date').value = (new Date()).format("m/dd/yy");

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