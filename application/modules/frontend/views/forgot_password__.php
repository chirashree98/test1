<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        
    <!-- -------------------------------forgotpassword--------------------------------------------- -->
    <div>
        
        <div class="" role="document">
            <div class="modal-content">
            <span id="msg_box">
            <?php if ($this->session->flashdata('success') != '') { ?>
                <?php echo $this->session->flashdata('success'); ?>
            <?php } ?>
        </span>

                <form method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Reset Password </h4>
                    </div>

                    <div class="modal-body">

                        <div id="email_sec">
                            <div class="form-group">
                                <input type="email" class="form-control" id="forgotemail" placeholder="Email" required="" name="email">
                            </div>
                            <button type="button" id="sendMail" class="btn btn-primary sumt">Submit</button>
                        </div>
                        <div id="change_sec" style=" display:none; ">
                            <div class="form-group">
                                <input type="text" class="form-control" id="otp" placeholder="OTP" name="otp">
                            </div>  
                            <div class="form-group">
                                <input type="password" class="form-control" id="passwor_forgot" placeholder="New Password" name="password" required="">
                            </div>                            
                            <div class="form-group">
                                <input type="password" class="form-control" id="con_password" placeholder="Confirm New Password" required="">
                            </div>
                            <button type="button" id="changePass" class="btn btn-primary sumt">Submit</button>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                        </div> -->
                </form>
            </div>
        </div>
    </div>

    <!-- -------------------------------end forgotpassword--------------------------------------------- -->



        <!--+++++++++++++ footer Start +++++++++++++++++++-->

        <?php $this->load->view('common/footer'); ?>  


    </body>
    <?php $this->load->view('common/footer_js'); ?>  


<!-- Jquery script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script>

    $('#sendMail').click(function () {

        $(".error").removeClass('error');
        $("#msg_box").html('');
        if ($('#forgotemail').val() != '') {

            var email = $('#forgotemail').val();
        } else {

            $("#forgotemail").addClass('error');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('forgot_password_submit'); ?>",
            data: {chk_type: 'email', email: email},
            async: false,
            success: function (response) {

                if (response == 'sent') {
                    $("#msg_box").html('<div class="alert alert-success"> <strong>Success!</strong> Please check your register mail for OTP. </div>');
                    $("#email_sec").hide();
                    $("#change_sec").show();
                } else if (response == 'not_sent') {
                    $("#msg_box").html('<div class="alert alert-danger">Please try again. <strong></div>');
                } else if (response == 'inactive') {
                    $("#msg_box").html('<div class="alert alert-danger">Your mail id is not active. <strong></div>');
                } else if (response == 'not') {
                    $("#msg_box").html('<div class="alert alert-danger">Your mail id is not registered. <strong></div>');
                }
            },
            error: function () {
                alert('Error occured');
            }
        });

    });
    $('#changePass').click(function () {
        $(".error").removeClass('error');
        $("#msg_box").html('');

        var email = $('#forgotemail').val();

        if ($('#otp').val() != '') {
            var otp = $('#otp').val();
        } else {
            $("#otp").addClass('error');
            return false;
        }
        if ($('#passwor_forgot').val() != '') {
            var password = $('#passwor_forgot').val();
        } else {
            $("#passwor_forgot").addClass('error');
            return false;
        }
        if ($('#con_password').val() != '') {
            var con_password = $('#con_password').val();
        } else {
            $("#con_password").addClass('error');
            return false;
        }
        if (password != '' && con_password != '') {
            if (password != con_password) {
                $("#con_password").addClass('error');
            }
        }

        $.ajax({
            type: "post",
            url: "<?php echo base_url('forgot_password_submit'); ?>",
            data: {chk_type: 'otp', otp: otp, password: password, email: email},
            async: false,
            success: function (response) {
                if (response == 'ok') {
                    $("#msg_box").html('<div class="alert alert-success"> <strong>Success!</strong> Password Update Successful. </div>');
                    $("#change_sec").hide();
                } else if (response == 'no') {
                    $("#msg_box").html('<div class="alert alert-danger">Please try again. <strong></div>');
                }
                else if (response == 'chkno') {
                    $("#msg_box").html('<div class="alert alert-danger">Otp not match. <strong></div>');
                }
            },
            error: function () {
                alert('Error occured');
            }
        });

    });
</script>

</html>