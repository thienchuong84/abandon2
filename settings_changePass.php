<?php 
	//session_start();
	if(!isset($_SESSION['id'])) header("Location:login.php"); 
?>
<div class="row"><div class="col-md-6">
	<h4><label id="pwmatch-alert"></label></h4>
	<h4 style="color: red"><label id="result_return"></label></h4>
</div></div>
<div class="row">
	<div class="col-md-6 col-md-offset-0">		
		<form role="form" method="post" id="changePassword">
			<div class="form-group">
				<label for="cur_pass"><h4>Current Password</h4></label>
				<input type="password" class="input-lg form-control" name="name_cur_pass" id="cur_pass" placeholder="Password Hiện Tại" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label for="new_pass1"><h4>New Password</h4></label>
				<input type="password" class="input-lg form-control" name="name_new_pass1" id="new_pass1" placeholder="Password Mới" autocomplete="off" required>
				<div class="row">
					<div class="col-md-6">
						<span id="6char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 6 Characters Long
					</div>
					<div class="col-md-6">
						<span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One lowercase Letter
					</div>
				</div>
				<input style="margin-top:0.5em;" type="password" class="input-lg form-control" name="name_new_pass2" id="new_pass2" placeholder="Nhập Lại Password Mới" autocomplete="off" required>
				<span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Password Match

			</div>
			<input type="button" id="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Change Password..." value="Change Password">
		</form>
	</div>
</div>



<script type="text/javascript">
// tham khảo link sau check khi submit form : http://api.jquery.com/submit/

//$("#changePassword").submit(function(event){		// khi dùng cách này, trang của ta luôn luôn bị reload, thành ra khi lấy giá trị trả về, nó vừa hiện ta cái là reload mất tiêu kết quả, cực kì chú ý vấn đề này
$("#submit").click(function(event){			// Phải luôn luôn nhớ 1 điều: làm ajax ko bao giờ dùng submit, thay đổi từ cái trên, bắt sự kiện có id="submit" và click thì mới ok. Change type input từ "submit" -> "button"
	var valid;
	valid = validateChangePass();

	if(valid){
		var tmpCurPass 	= $("#cur_pass").val();
		var tmpNewPass 	= $("#new_pass1").val();
		var tmpSubmit	= $("#submit").val();

		$.ajax({
			method: 	"POST",
			url: 		"settings_ajax.php",
			data: 		{ curPass: tmpCurPass, newPass: tmpNewPass, submitChangePass: tmpSubmit},
			//beforeSend: function(xhr){alert("test "+tmpSubmit)},		// hàm này dùng để test value của tmpSubmit
			success: function(result){		// refer example: http://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_ajax_ajax_async
				//$('#result_return').html(result);
				$('#result_return').html(result).show().fadeOut(4000);
			},
			error: function(xhr){
            	alert("An error occured: " + xhr.status + " " + xhr.statusText);
            },
		}).done(function(msg){
			// code want use
			//alert(msg);
			//$("#result_return2").html(msg);
		})
	}else {
		event.preventDefault();
	}

})

function validateChangePass(){
	var valid = true;
	if($("#new_pass1").val() != $("#new_pass2").val()) {
		//$("#pwmatch-alert").text("Password does not match!!!");
		$("#pwmatch-alert").css("color","red");
		$("#pwmatch-alert").text("Password does not match!!!").show().fadeOut( 4000 );
		valid = false;
	}
	else if(!$("#new_pass1").val().match(/^[A-Za-z0-9]{6,14}$/)) {		// Regular Express for number from 6->14: /^[0-9]{6,14}$/
		$("#pwmatch-alert").css("color","red");
		$("#pwmatch-alert").text("Password much 6 to 14 characters!!!").show().fadeOut( 4000 );
		valid = false;
	}

	return valid;
}

$("input[type=password]").keyup(function(){
	//var ucase	= new RegExp("[A-Z]+");
	//var num	= new RegExp("[0-9]+");
	var lcase 	= new RegExp("[a-z]+");

	// xét điều kiện lớn hơn 6 ký tự thì addclass
	if($("#new_pass1").val().length >=6){
		$("#6char").removeClass("glyphicon-remove");
		$("#6char").addClass("glyphicon-ok");
		$("#6char").css("color","#00A41E");
	}else {
		$("#6char").removeClass("glyphicon-ok");
		$("#6char").addClass("glyphicon-remove");
		$("#6char").css("color","#FF0004");
	}

	if(lcase.test($("#new_pass1").val())){
		$("#lcase").removeClass("glyphicon-remove");
		$("#lcase").addClass("glyphicon-ok");
		$("#lcase").css("color","#00A41E");
	}else {
		$("#lcase").removeClass("glyphicon-ok");
		$("#lcase").addClass("glyphicon-remove");
		$("#lcase").css("color","#FF0004");
	}

	if($("#new_pass1").val() == $("#new_pass2").val()) {
		$("#pwmatch").removeClass("glyphicon-remove");
		$("#pwmatch").addClass("glyphicon-ok");
		$("#pwmatch").css("color","#00A41E");
	}else {
		$("#pwmatch").removeClass("glyphicon-ok");
		$("#pwmatch").addClass("glyphicon-remove");
		$("#pwmatch").css("color","#FF0004");
	}

	/* làm tương tự nếu muốn có số và chử hoa
	if(ucase.test($("#password1").val()))
	if(num.test($("#password1").val()))



	*/
});
</script>

