<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        <div class="clearfix"></div> 

        <section id="scheme-sec1">
            <div class="custom-width">
                <div class="">
                    <div class="login-form">


                        <div class="login-form-inner">
                            <span id="msg_box mb15">
                                <?php if ($this->session->flashdata('success') != '') { ?>
                                    <?php echo $this->session->flashdata('success'); ?>
                                <?php } ?>
                            </span>

                            <h4>Reset Password</h4>
                            <div class="modal-body">

                                <form method="POST" id="forgotResetFrm" action="<?php echo base_url('forgot_password_submit'); ?>">
                                    <div id="email_sec">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="forgotemail" placeholder="Email" required="required" name="email">
                                            <p class="error_msg" id="forgotemail_err"><?php echo form_error('forgotemail'); ?> </p>
                                        </div>
                                        <button type="button" id="sendMail" class="btn btn-primary sumt">Submit</button>
                                    </div>
                                    <div id="change_sec" style=" display:none; ">                                        
                                        <input type="hidden" name="chk_type" value="otp" />
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="otp" placeholder="OTP" name="otp">
                                            <p class="error_msg" id="otp_err"><?php echo form_error('otp'); ?> </p>
                                        </div>  
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="passwor_forgot" placeholder="New Password" name="password" required="required">
                                            <p class="error_msg" id="passwor_forgot_err"><?php echo form_error('passwor_forgot'); ?> </p> 
                                        </div>                            
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="con_password" placeholder="Confirm New Password" required="required">
                                            <p class="error_msg" id="con_password_err"><?php echo form_error('con_password'); ?> </p>
                                        </div>
                                        <button type="button" id="changePass" class="btn btn-primary sumt">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
        </section>



        <div class="clearfix"></div> 


        <!--+++++++++++++ footer Start +++++++++++++++++++-->

        <?php $this->load->view('common/footer'); ?>  


    </body>
    <?php $this->load->view('common/footer_js'); ?>  

    <!-- Jquery script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <script>

        $('#sendMail').click(function () {
            $(".error_msg").html('');
            if ($('#forgotemail').val() != '') {
                var email = $('#forgotemail').val();
            } else {
                $('#forgotemail').next(".error_msg").html('Please enter your register email id..');
                $('#forgotemail').focus();
                return false;
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('forgot_password_submit'); ?>",
                data: {chk_type: 'email', email: email},
                async: false,
                success: function (response) {

                    if (response == 'sent') {
                        $("#msg_box").html('<div class="alert alert-success">Success!. OTP sent successfully. Please check your registered email for OTP. <strong></div>');
                        $("#email_sec").hide();
                        $("#change_sec").show();
                    } else if (response == 'not_sent') {
                        //$("#msg_box").html('Please try again. ');
                        $('#forgotemail').next(".error_msg").html('Please try again.');
                        $('#forgotemail').focus();
                        return false;
                    } else if (response == 'inactive') {
                        //$("#msg_box").html('Your account is not yet activated. ');
                        $('#forgotemail').next(".error_msg").html('Your account is not yet activated.');
                        $('#forgotemail').focus();
                        return false;
                    } else if (response == 'not') {
                        //$("#msg_box").html('Email address is not registered.');
                        $('#forgotemail').next(".error_msg").html('Email address is not registered.');
                        $('#forgotemail').focus();
                        return false;
                    }
                },
                error: function () {
                    alert('Error occured');
                }
            });

        });
        $('#changePass').click(function () {

            $(".error_msg").html('');
            $("#msg_box").html('');
            var email = $('#forgotemail').val();
            var otp = $('#otp').val();
            var password = $('#passwor_forgot').val();
            var con_password = $('#con_password').val();
            if ($('#otp').val() == '') {
                $('#otp').next(".error_msg").html('Please enter OTP.');
                $('#otp').focus();
                return false;
            } else if ($('#passwor_forgot').val() == '') {
                $('#passwor_forgot').next(".error_msg").html('Please Enter New Password.');
                $('#passwor_forgot').focus();
                return false;
            } else if ($('#passwor_forgot').val().length < parseInt('8')) {
                $('#passwor_forgot').next(".error_msg").html('Please enter eight or more characters');
                $('#passwor_forgot').focus();
                return false;
            } else if ($('#con_password').val() == '') {
                $('#con_password').next(".error_msg").html('Please Confirm your Password.');
                $('#con_password').focus();
                return false;
            } else if (password != con_password) {
                $('#con_password').next(".error_msg").html('Password Must be Matching.');
                $('#con_password').focus();
                return false;
            } else {


                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('forgot_password_submit'); ?>",
                    data: {chk_type: 'otp_chk', otp: otp, email: email},
                    async: false,
                    success: function (response) {
                        if (response == 'ok') {
                            $('#forgotResetFrm').submit();
                        } else if (response == 'not') {
                            $('#otp').next(".error_msg").html('You have entered incorrect OTP, please try again!');
                            $('#otp').focus();
                            return false;
                        }
                    },
                    error: function () {
                        alert('Error occured');
                    }
                });

            }


            /*
             $.ajax({
             type: "post",
             url: "<?php echo base_url('forgot_password_submit'); ?>",
             data: {chk_type: 'otp', otp: otp, password: password, email: email},
             async: false,
             success: function (response) {
             if (response == 'ok') {
             $("#msg_box").html('<div class="alert alert-success"> <strong>Success!</strong> Password changed successfully. </div>');
             $("#change_sec").hide();
             } else if (response == 'no') {
             $('#con_password').next(".error_msg").html('Please try again.');
             $('#con_password').focus();
             return false;
             //$("#passmsg_box").html('<p class="error_msg">Please try again. <strong></p>');
             }
             else if (response == 'chkno') {
             $('#otp').next(".error_msg").html('OTP not matched.');
             $('#otp').focus();
             return false;
             //$("#msg_box").html('<div class="alert alert-danger">OTP not matched. <strong></div>');
             
             },
             error: function () {
             alert('Error occured');
             }
             });
             */
        });
    </script>

</html>
