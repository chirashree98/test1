<?php
$from_mail = $this->common_model->RetriveRecordByWhere('ds_settings', array());
foreach ($from_mail->result() as $row) {
    $settings[$row->settings_name] = $row->settings_value;
}
$footer_query = get_footer_service_settings();
?>  
<section id="footer-up">
    <div class="custom-width">
        <div class="row"> 
            <div class="col-sm-4">
                <div class="footer-up-inner">
                    <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $footer_query['service_image_1']; ?>"/>
                    <h3> <?php echo $footer_query['service_heading_1']; ?></h3>
                    <p> <?php echo $footer_query['service_content_1']; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer-up-inner">
                    <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $footer_query['service_image_2']; ?>"/>
                    <h3> <?php echo $footer_query['service_heading_2']; ?></h3>
                    <p> <?php echo $footer_query['service_content_2']; ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer-up-inner">
                    <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $footer_query['service_image_3']; ?>"/>
                    <h3> <?php echo $footer_query['service_heading_3']; ?></h3>
                    <p> <?php echo $footer_query['service_content_3']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div> 
<section id="footer">
    <div class="custom-width">

        <div class="custom-wi20">
            <div class="footer-logo">
                <!--<img src="<?php echo base_url(); ?>assets/front/images/logo2.png"/>-->
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>uploads/<?php echo $settings['footer_logo']; ?>"/></a>
            </div>
        </div>
        <div class="custom-wi80">
            <div class="footer-right">
                <div class="row">
                    <div class="col-md-2 col-sm-6">
                        <h4>Info</h4>
                        <ul>
							<li><a href="<?php echo base_url();?>about_us">About</a></li>
							<li><a href="<?php echo base_url();?>project">Projects</a></li>
							<li><a href="<?php echo base_url();?>artists">Designers </a></li>
                          <li><a href="<?php echo base_url();?>consultation">Consultation</a></li>
                            <li><a href="<?php echo base_url();?>contact_us">Contact Us</a></li>
                            <li><a href="<?php echo base_url();?>carrers">Career</a></li>

                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <h4>Collections</h4>
                        <ul>
                             
                           <form class="proSearch" action="<?php echo base_url('frontend/product/productsSearch'); ?>" 
                                method="post">
                            <input type="hidden" value="" class="cat_search" name="cat_search"/>
                            </form> 
                            <?php 
                                $ds_category =  $this->common_model->RetriveRecordByWhere('ds_category',array('status'=>'1'));
                                foreach ($ds_category->result() as $row) { ?> 
                               
                                <li for="cat_search_<?php echo $row->id; ?>">
                                    <a href="javascript:void(0)" onclick="select_category(<?php echo $row->id; ?>)" class="select_category" id="cat_search_<?php echo $row->id; ?>"><?php echo $row->name; ?></a>
                                </li>
                              
                            <?php } ?>

                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <h4>Locations</h4>
                        <ul>
                            <li><a href="#">New York</a></li>
                            <li><a href="#">London</a></li>
                            <li><a href="#">Berlin</a></li>
                            <li><a href="#">India</a></li>
                            <li><a href="#">Japan</a></li>
                            <li><a href="#">China</a></li>

                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <h4>Newsletter</h4>
                        <p id="sub_msg_box"></p>
                        <div class="footer-newsletter">
                            <input type="text" value="" class="form-control" name="email" id="sub_email" placeholder="Email address" />
                            <p id="email_err" class = "error_msg"><?php echo form_error('email'); ?> </p>
                            <button  type="button" class="go-btn" id="homeNewsletter"  >Go </button> 


                        </div>
                        <div class="social-icon">
                            <ul>
                                <li><a href="<?php echo $settings['facebook_url']; ?>"><i class="fa fa-facebook"></i> </a></li>
                                <li><a href="<?php echo $settings['twitter_url']; ?>"><i class="fa fa-twitter"></i> </a></li>
                                <li><a href="<?php echo $settings['pinterest']; ?>"><i class="fa fa-pinterest"></i> </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p><?php echo $settings['footer_copyright_text']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li><a href="<?php echo base_url();?>term_conditions">Terms & Conditions</a></li>
                            <li><a href="<?php echo base_url();?>payment_policy">Payment Policy</a></li>
                            <li><a href="<?php echo base_url();?>faq">FAQ</a></li>
                            <li><a href="<?php echo base_url();?>shipping_policy">Shipping Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<script>
//Collections category  select and  fetch data
    function select_category(id){
          $(".cat_search").val(id);
           $(".proSearch").submit();
    }
</script>