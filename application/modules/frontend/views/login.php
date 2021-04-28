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
                <div class="row">
                    <div class="col-sm-12">
                    
                        <div class="login-form">
                        
                            <div class="login-form-inner">
                             
                                <h4>Login</h4>
                                
                                <span id="msg_box">
                                    <?php if ($this->session->flashdata('error') != '') { ?>
                                        <?php echo $this->session->flashdata('error'); ?>
                                    <?php } ?>
                                </span>
                                <span id="msg_box">
                                    <?php if ($this->session->flashdata('success') != '') { ?>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    <?php } ?>
                                </span>
                               
                                <form action="<?php echo base_url(); ?>login" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="uname">Email</label>
                                            <input type="text" class="form-control" placeholder="Enter Your Email" name="email" id="email" required>
                                        <p class="error_msg" id="email_err"><?php echo form_error('email'); ?> </p>
										</div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="psw">Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Password" id="pswd" name="pswd" required>
                                        <p class="error_msg" id="pswd_err"><?php echo form_error('pswd'); ?> </p>

										</div>
                                        </div>
                                        
                                    </div>
                                    <button type="submit" id="loginchk" class="login-btn">Login</button>
                                    <span class="psw"> <a href="<?php echo base_url(); ?>forgot_password">Forgot password?</a></span>


                                </form>
                            </div>




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



<script>

 
	 function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
	
	 $('#loginchk').on('click', function () {
            $(".error_msg").html('');
			
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
			 if ($('#pswd').val() == '') {
                $('#pswd').next(".error_msg").html('Please enter password');
                $('#pswd').focus();
                return false;
            }
            
            /*if ($('#pswd').val().length < parseInt('8')) {
                $('#pswd').next(".error_msg").html('Please enter eight or more characters');
                $('#pswd').focus();
                return false;
            }*/
           
       
        });
</script>

</html>
