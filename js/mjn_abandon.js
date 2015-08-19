// refer at http://api.jquery.com/jquery.ajax/
/*
function ajaxSubmit(){
    var tmpDate = $("#ntc_abandon_date").val();
    var tmpCallerid = $("#ntc_callerid").val();
    var tmpSubmit = $("#submit").val();
	
	//$('#position_that_you_show').html('Dang xu ly ...');

	if(tmpCallerid=='') {
		alert("Please fill out the form");
	} else {
		$.ajax({
		method: "POST",
		url: "ajax_mjn_abandon_test.php",
		data: { tmpDate1: tmpDate, tmpCallerid1: tmpCallerid, tmpSubmit1: tmpSubmit },
		})
		.done(function( msg ) {
			$('#position_that_you_show').html(msg);
		});			
	}
}
*/

// used in : mjn_abandon.php when user click button submit
// Nghiên cứu và tìm hiểu về nó : http://api.jquery.com/jquery.ajax/ and 
// http://www.w3schools.com/jquery/jquery_ajax_get_post.asp and http://www.w3schools.com/jquery/jquery_ref_ajax.asp 
function ajaxSubmit(){
	var valid;
	valid = validateAbandonForm();	

	if(valid) {
	    var tmpDate = $("#ntc_abandon_date").val();
	    var tmpCallerid = $("#ntc_callerid").val();
	    var tmpSubmit = $("#submit").val();

	    $('#position_that_show_process').html('Processing ...');

		$.ajax({				// refer : http://www.w3schools.com/jquery/ajax_ajax.asp
			method: "POST",
			url: "ajax_mjn_abandon_test.php",
			data: { tmpDate1: tmpDate, tmpCallerid1: tmpCallerid, tmpSubmit1: tmpSubmit },
			success: function(result){		// dùng cách này vẩn được, .done là kết thúc cuối cùng. Còn cách này là chỉ chạy khi ok. refer example: http://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_ajax_ajax_async
				$('#position_that_you_show').html(result);
			},
			error: function(xhr){
            	alert("An error occured: " + xhr.status + " " + xhr.statusText);
            },
		}).done(function( msg ) {			
			//$('#position_that_you_show').html(msg);
			$('#position_that_show_process').html('');
		});			
	}
}

// used in mjn_abandon.php : check input value
function validateAbandonForm() {
	var valid = true;
	$("#ntc_callerid").css('border-color','');

	if(!$("#ntc_callerid").val()) {
		//$("#ntc_callerid").css('border-color','red');		// nếu dùng cách này, thì nó đỏ hoài, chỉ khi submit lần nữa valid ok hết thì nó chạy ở trên để bỏ
		$("#ntc_callerid").addClass("selected");  // khi dùng addClass("selected") này, viền form cũng đỏ lên, khi click chuột vào thì form ko còn đỏ nữa	=> nên dùng cách này
		alert("Please fill out Callerid");
		valid = false;
	} else {
		if(!$("#ntc_callerid").val().match(/[0-9 -()+]+$/) | !$("#ntc_callerid").val().match(/^[0-9]{8,11}$/)) {
			$("#ntc_callerid").css('border-color','red');
			alert("Callerid required is a number and 8->11");
			valid = false;
		}
	}

	return valid;
}