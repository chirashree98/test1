<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
        <style>
            .register-success-page div {
                padding: 10px;
            }
            .register-success-page {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        <div class="clearfix"></div> 

        <section id="my-account">
            <div class="custom-width">
                <div class="page-heading">
                    <h1>Change Password</h1>
                </div>
                <div class="my-account-inner">
				<div class="row">
                        <div class="col-md-3">
                            <div class="artist-left-panel">
                               <?php $this->load->view('common/myaccount_side_panel'); ?> 
                            </div>
                        </div>
                  
                        <div class="col-sm-9">
                            <div class="my-account-left-panel">
                                <span id="msg_box" class="mb15" >
                                        <?php if ($this->session->flashdata('success_message') != '') { ?>
                                            <?php echo $this->session->flashdata('success_message'); ?>
                                        <?php } ?>
                                    </span>
                                <div class="my-account-left-panel-sec1" style="">
                                    
                                    <h4>Change Password</h4>

                                    <div class="my-account-left-panel-sec1-inner">




                                        <form action="<?php echo base_url(); ?>changepassword"  method="POST" enctype="multipart/form-data">


                                            <div id="change_sec">
<div class="row">
    <div class="col-sm-6">
     <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control" id="old_password" placeholder="Old Password" name="old_password" required>
                                                    <p id="old_password_err" class = "error_msg"><?php echo form_error('old_password'); ?> </p>
                                                    <span id="msg_box" >
                                        <?php if ($this->session->flashdata('error_message') != '') { ?>
                                            <?php echo $this->session->flashdata('error_message'); ?>
                                        <?php } ?>
                                    </span>
                                                </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password" required>
                                                    <p id="new_password_err" class = "error_msg"><?php echo form_error('new_password'); ?> </p>
                                                </div>  
    </div>
                                                </div>

                                               





                                                                          
                                                <div class="form-group">
                                                    <label>Confirm New Password</label>
                                                    <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Confirm New Password" required>
                                                    <p id="conf_password_err" class = "error_msg"><?php echo form_error('conf_password'); ?> </p>
                                                </div>
                                                <input type="submit" class=" sumt back" value="Submit"  name="save" id = "changePass" />
                                                <!--<button type="button" id="changePass" name="save" class="btn btn-primary sumt">Submit</button>-->
                                            </div>
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    
                                            </div> -->
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

    <!-- Jquery script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <script>




        $('#changePass').on('click', function () {
            $(".error_msg").html('');

            if ($('#old_password').val() == '') {
                $('#old_password').next(".error_msg").html('Please enter old password');
                $('#old_password').focus();
                return false;
            }

            if ($('#new_password').val() == '') {
                $('#new_password').next(".error_msg").html('Please enter new password');
                $('#new_password').focus();
                return false;
            }
            if ($('#new_password').val().length < parseInt('8')) {
                $('#new_password').next(".error_msg").html('Please enter eight or more characters');
                $('#new_password').focus();
                return false;
            }
            if ($('#conf_password').val() == '') {
                $('#conf_password').next(".error_msg").html('Please enter confirm password');
                $('#conf_password').focus();
                return false;
            }
            if ($('#new_password').val() != $('#conf_password').val()) {
                $('#conf_password').next(".error_msg").html('Password Must be Matching.');
                $('#conf_password').focus();
                return false;
            }


        });
    </script>

</html>
