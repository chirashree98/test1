// Required Java Script
$("#sid").on('change',function () {
    var mid = this.value;
	//alert(mid);
	if(mid == 2 ){
		$("#member_by_role").show();
		$("#products_types").show();
		$("#design_store").show();
		$("#virtual_studio").hide();
		$("#member").hide();
		$("#artist").hide();
		$("#accrediation").val("");
		$("#service").val("0");
		
	}
	else if(mid == 3){
		$("#member").show();
		$("#virtual_studio").hide();
		$("#products_types").hide();
		$("#design_store").hide();
		$("#member_by_role").hide();
		$("#artist").hide();
		$("#accrediation").val("");
		$("#service").val("0");
		
	}
	else if(mid == 5){
	$("#member").show();
		$("#member_by_role").hide();
		$("#virtual_studio").show();
		$("#products_types").hide();
		$("#design_store").hide();
	$("#artist").show();
	}	
	else if(mid == 0 || mid == 6){
		$("#member").hide();
		$("#member_by_role").hide();
		$("#virtual_studio").hide();
		$("#products_types").hide();
		$("#design_store").hide();
		$("#artist").hide();
		$("#accrediation").val("");
		$("#service").val("0");
		$("#member").val("0");
	}
	
});

$('#cpassword').blur(function(){
	
	var upass=$("#password").val();
	var cpass = $("#cpassword").val();
	if(upass != cpass)
	{
		$('#error_msg').text('Password and Confirm Password is mismatched');
		$("#register").prop('disabled',true);
	}
	else{
		$('#error_msg').text('');
		$("#register").prop('disabled',false);
	}
});


$(document).ready(function () {
	        var mval = $("#mval").val();
			if(mval == 1){
            $("#add_edit_users").modal('show');
			
			var mid = $('#sid').val();
				if(mid == 2 ){
				$("#member_by_role").show();
					$("#products_types").show();
				$("#design_store").show();
				$("#virtual_studio").hide();
				$("#member").hide();
				$("#artist").hide();
				$("#accrediation").val("");
				$("#service").val("0");
				
			}
				
				if(mid == 3){
					$("#member").show();
					$("#virtual_studio").show();
					$("#products_types").hide();
					$("#design_store").hide();
					$("#member_by_role").hide();
					$("#artist").hide();
					$("#accrediation").val("");
					$("#service").val("0");
					
				}
				else if(mid == 5){
				$("#member").show();
				$("#member_by_role").hide();
				$("#virtual_studio").show();
				$("#products_types").hide();
				$("#design_store").hide();	
				$("#artist").show();
				}	
				else if(mid == 0 || mid == 6){
					$("#member").hide();
					$("#virtual_studio").hide();
					$("#products_types").hide();
					$("#design_store").hide();
					$("#member_by_role").hide();
					$("#artist").hide();
					$("#accrediation").val("");
					$("#service").val("0");
					$("#member").val("0");
				}
			
			}
			if(mval == 2){
				$("#regist_users").modal('show');				
			}
			if(mval == 3){
				$("#login_err").text("Invalid username or password");
				$("#login_users").modal('show');				
			}
			if(mval == 4){
				$("#login_err").text("Invalid username or password");
				
			}
        });