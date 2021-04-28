<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        <div class="clearfix"></div>
        <style>
            .continue{width:142px;}
        </style> 





        <section id="my-account">
            <div class="custom-width">
                <div class="page-heading">
                    <h1>Newsletter</h1>
                </div>




                <div class="my-account-inner">
				    <div class="col-md-3">
                            <div class="artist-left-panel">
                               <?php $this->load->view('common/myaccount_side_panel'); ?> 
                            </div>
                        </div>
                    
                        <div class="col-sm-9">
                            <div id="msg_div">
                                <?php if ($this->session->flashdata('success_message') !=''){?>
                                <?php echo $this->session->flashdata('success_message'); ?>
                                <?php }?>
                            </div>
                            <div class="my-account-left-panel">
                                
                                <div class="my-account-left-panel-sec1">
                                    <h4>Newsletter</h4>
                                    <div class="my-account-left-panel-sec1-inner">
                                    <div class="my-account-left-panel-sec1-inner p0">
                                        <?php
                                        if ($query) {
                                            ?>
 <div id="msg_div">
                                <?php if ($this->session->flashdata('success') !=''){?>
                                <?php echo $this->session->flashdata('success'); ?>
                                <?php }?>
                            </div>


                                            <div id="change_sec">
                                                <div class="form-group">
                                                    <div class="form-group subscrib-text">
                                                        <h2>  <img src="http://206.189.36.119/DesignStudio/dev/uploads/tick.png" class="subscribe-tick">
                                                            Subscribed</h2><br>
                                                        <from><input type="hidden" value="<?php echo $user_email['email']; ?>" id="subemail">
                                                         <h2><!-- <input type="checkbox" name="newsletterremove" 
                                                         id = "removenewsletter"  /> Unsubscribe</h2>-->
                                                                <button  class="continue" name="newsletterremove" 
                                                                         id = "removenewsletter">Unsubscribe</button></from>
                                                    </div>  
                                                </div>


                                            </div>


                                            <?php
                                        } else {
                                            ?>


                                            


                                            <span id="msg_box">
                                                <?php if ($this->session->flashdata('success_messag') != '') { ?>
                                                    <?php echo $this->session->flashdata('success_messag'); ?>
                                                <?php } ?>
                                            </span>

                                            <form action="<?php echo base_url(); ?>frontend/user/usersubscribe" name="passwordFrm" id="passwordFrm" method="POST" enctype="multipart/form-data">


                                                <div id="change_sec">
                                                    <div class="form-group">
                                                        <label for="email">Email</label><span class = "mandate"> * </span>  
                                                        <input type="text" value="<?php echo $user_email['email']; ?>" class="form-control" name="email" id="email" placeholder="Email address" readonly/>
                                                        <p id="email_err" class = "error_msg"><?php echo form_error('email'); ?> </p>                                
                                                    </div>

                                                    <input type="submit" class="back" value="Submit" id = "addNewsletter" />

                                                </div>

                                            </form
                                            ><?php
                                        }
                                        ?>


                                    </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                        
                </div>
            </div>
        
</section>



<div class="clearfix"></div> 

<?php $this->load->view('common/footer'); ?>  


</body>
<?php $this->load->view('common/footer_js'); ?>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script>



                                                        function isEmail(email) {
                                                            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                                            return regex.test(email);
                                                        }
                                                        $('#addNewsletter').on('click', function () {
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
                                                            /* if ($('#email').val() != '' && isEmail($('#email').val())) {
                                                             $.post('<?php echo base_url(); ?>frontend/user/chechEmailExist', 'email=' + $('#email').val(), function (data) {
                                                             if (data == 'exist') {
                                                             $('#email').next(".error_msg").html('Email already exist.');
                                                             $('#email').focus();
                                                             return false;
                                                             
                                                             }
                                                             });
                                                             }*/


                                                        });

                                                        $('#removenewsletter').on('click', function () {
                                                            $(".error_msg").html('');



                                                            var email = $('#subemail').val();

                                                            $.ajax({
                                                                type: "POST",
                                                                url: "<?php echo base_url('Unsubscribe'); ?>",
                                                                data: {email: email},
                                                                async: false,
                                                                success: function (response) {

                                                                    if (response == 'sent') {


                                                                        $("#msg_box").html('<div class="alert alert-success">Succesfully Unsubscribe. <strong></div>');
                                                                        $("#email_sec").hide();
                                                                        $("#change_sec").show();
                                                                        setTimeout(function () {
                                                                            location.reload();
                                                                        }, 300)
                                                                    }
                                                                }

                                                            });

                                                        });

</script>
</html>