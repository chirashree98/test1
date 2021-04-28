<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>
    <style>
        #artist, #member, #member_by_role, #virtual_studio_sec, #products_types, #design_store, #servicesec {
            display: none;
        }

        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>
<!--+++++++++++++ Header End +++++++++++++++++++-->
<div class="clearfix"></div>
<section id="scheme-sec1">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-12">
                <div class="login-form">
                    <div class="login-form-inner registerpage">
                        <h4>Registration</h4>
                        <span id="msg_box">
                                    <?php if ($this->session->flashdata('success') != '') { ?>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    <?php } ?>
                                </span>
                        <!--<form action="<?php echo base_url(); ?>frontend/user/adduser" method="POST" enctype="multipart/form-data">-->
                        <form action="<?=base_url();?>registers" method="POST" enctype="multipart/form-data">
                            

                            <div class="form-group">
                               
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name *</label><span class="mandate"> * </span>
                                        <input type="text" name="first_name"
                                               
                                               class="form-control" id="first_name" required/>
                                        <p class="error_msg"><?php echo form_error('first_name'); ?> </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="mandate"> * </span> <label for="first_name">Last Name *</label>
                                        <input type="text" name="last_name"
                                              
                                               class="form-control" id="last_name" required/>
                                        <p class="error_msg"><?php echo form_error('last_name'); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label><span class="mandate"> * </span>
                                <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                       class="form-control" 
                                       id="email" required/>
                                <p id="email_err"
                                   class="error_msg"> <?php if ($this->session->flashdata('email_err') != '') { ?>
                                        <?php echo $this->session->flashdata('email_err'); ?>
                                    <?php } ?> </p>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password *</label><span class="mandate"> * </span>
                                        <input type="password"
                                              
                                               required="" minlength="8" name="password" class="form-control" value=""
                                               id="password"/>
                                        <p class="error_msg"><?php echo form_error('password'); ?> </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Confirm Password *</label> <span class="mandate"> * </span>
                                        <input type="password" required=""
                                              
                                               name="cpassword" class="form-control" placeholder="" id="cpassword"/>
                                        <p class="error_msg"
                                           id="cpassword_err"><?php echo form_error('cpassword'); ?> </p>
                                    </div>
                                </div>
                            </div>
                            
                           

                            <div class="loader" style="display:none;"></div>
							<div class="col-sm-12">
                            <input type="submit" class="btn btn-primary" value="Register" id="addUser"/></div>
                        </form>
                    </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

   


    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $('#addUser').on('click', function () {
        $(".error_msg").html('');
        $('.alert').remove();

      
        if ($('#first_name').val() == '') {
            $('#first_name').next(".error_msg").html('Please enter first name');
            $('#first_name').focus();
            return false;
        }
        if ($('#last_name').val() == '') {
            $('#last_name').next(".error_msg").html('Please enter last name');
            $('#last_name').focus();
            return false;
        }

        if ($('#email').val() == '') {
            $('#email').next(".error_msg").html('Please enter email id ');
            $('#email').focus();
            return false;
        }
        if (!isEmail($('#email').val())) {
            $('#email').next(".error_msg").html('Please enter a valid email id ');
            $('#email').focus();
            return false;

        }
        if ($('#email').val() != '' && isEmail($('#email').val())) {
            $.post('<?php echo base_url(); ?>frontend/user/chechUserExist', 'email=' + $('#email').val(), function (data) {
                if (data == 'exist') {
                    $('#email').next(".error_msg").html('Email already exist.');
                    $('#email').focus();
                    return false;
                }
            });
        }

        if ($('#password').val() == '') {
            $('#password').next(".error_msg").html('Please enter password');
            $('#password').focus();
            return false;
        }
        if ($('#password').val().length < parseInt('8')) {
            $('#password').next(".error_msg").html('Please enter eight or more characters');
            $('#password').focus();
            return false;
        }
        if ($('#password').val() != $('#cpassword').val()) {
            $('#cpassword').next(".error_msg").html('Password Must be Matching.');
            $('#cpassword').focus();
            return false;
        }
	})  
</script>
</html>