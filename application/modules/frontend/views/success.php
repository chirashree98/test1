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
            <div class="custom-width" >
                <div class="row">
                    <div class="col-sm-12" >
                        <div class="login-form"> 
                            <div class="login-form-inner registerpage register-success-page">
                                <!--<h4>Registration</h4>-->
                                <span id="msg_box">
<!--                                    <div class=""><h3>Thanks for your registration. Please check your mailbox to confirm your email address.</h3></div>-->
                                    <?php if ($this->session->flashdata('reg_success') != '') { ?>
                                        <?php echo $this->session->flashdata('reg_success'); ?>
                                    <?php }else if ($this->session->flashdata('success') != '') { ?>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    <?php } ?>
                                </span>
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
</html>