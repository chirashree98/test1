<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>  
    <style>
        /* Code By Webdevtrick ( https://webdevtrick.com ) */
        .container {
            padding: 50px 10%;
        }

        .box {
            position: relative;
            background: #ffffff;
            width: 100%;
        }

        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
            border-bottom: 1px solid #f4f4f4;
            margin-bottom: 10px;
        }

        .box-tools {
            position: absolute;
            right: 10px;
            top: 5px;
        }

        .dropzone-wrapper {
            border: 2px dashed #91b0b3;
            color: #92b0b3;
            position: relative;
            height: 250px;
        }

        .dropzone-desc {
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            text-align: center;
            width: 40%;
            top: 50px;
            font-size: 16px;
        }

        .dropzone,
        .dropzone:focus {
            position: absolute;
            outline: none !important;
            width: 100%;
            height: 150px;
            cursor: pointer;
            opacity: 0;
        }

        .dropzone-wrapper:hover,
        .dropzone-wrapper.dragover {
            background: #ecf0f5;
        }

        .preview-zone {
            text-align: center;
        }

        .preview-zone .box {
            box-shadow: none;
            border-radius: 0;
            margin-bottom: 0;
        }

        .btn-primary {
            background-color: crimson;
            border: 1px solid #212121;
        }
    </style>
</head>
<body>
    <?php $this->load->view('common/header_nav'); ?>  

    <!--+++++++++++++ Header End +++++++++++++++++++-->

    <div class="clearfix"></div>




    <section id="artist-accept-decline">
        <div class="custom-width">
            <div class="artist-heading">
                <h1>DESIGNER Dashboard</h1>
            </div>

            <div class="artist-accept-decline-inner">
                <div class="row">
                    <div class="col-md-3">
                        <div class="artist-left-panel">
                            <?php $this->load->view('artist/artist-left-panel'); ?>  
                        </div>
                    </div>
                    <form action="<?php echo base_url(); ?>artistchangepassword"  method="POST" enctype="multipart/form-data">
                        <div class="col-md-9">
                           <span id="msg_box">
                            <?php if ($this->session->flashdata('success') != '') { ?>
                                <?php echo $this->session->flashdata('success'); ?>
                            <?php } ?>
                        </span>
                        <span id="msg_box">
                            <?php if ($this->session->flashdata('success_message') != '') { ?>
                                <?php echo $this->session->flashdata('success_message'); ?>
                            <?php } ?>
                        </span>

                        <div class="my-account-left-panel">
                            <div class="my-account-left-panel-sec1">
                                <h4>Change Password</h4>
                                <?php // print_r($query);?>

                                <div class="my-account-left-panel-sec1-inner">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="artist-right-panel">


                                               
                                                    
                                                        <div class="form-group">
                                                            <label>Old Password</label>
                                                            <input type="password" class="form-control" id="old_password" placeholder="Old Password" name="old_password" >
                                                            <p id="old_password_err" class = "error_msg"><?php echo form_error('old_password'); ?> </p>
                                                            <!-- <span id="msg_box"> -->
                                                        <?php if ($this->session->flashdata('error_message') != ''){  
                                                                echo $this->session->flashdata('error_message');  
                                                            } 
                                                        ?>
                                                            <!-- </span> -->
                                                        </div>


                                                    
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password" >
                                                            <p id="new_password_err" class = "error_msg"><?php echo form_error('new_password'); ?> </p>
                                                        </div>
                                                    
                                                
                                                    
                                                        <div class="form-group">
                                                            <label>Confirm New Password</label>
                                                            <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Confirm New Password" >
                                                            <p id="conf_password_err" class = "error_msg"><?php echo form_error('conf_password'); ?> </p>
                                                        </div>
                                                   
                                               



                                                <div class="form-group">
                                                  <input type="submit" class="continue" value="Submit"  name="save" id = "changePass"/>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>


              </form>
          </div>
      </div>
  </div>
</section>


<div class="clearfix"></div> 

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

