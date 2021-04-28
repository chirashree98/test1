<?php

$from_mail = $this->common_model->RetriveRecordByWhere('ds_settings', array());
foreach ($from_mail->result() as $row) {
    $settings[$row->settings_name] = $row->settings_value;
}
?>
<div class="notifications"
     style="border: 1px solid #e41648; border-bottom-left-radius: 4px; border-top-left-radius: 4px; background: #e41648; color: #ffffff; width: auto; padding: 9px; font-weight: bold; position: fixed; right: -20px; z-index: 999999;"></div>
<section id="scheme-top-nav">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-6">
               
            </div>
            <div class="col-sm-6">
                <div class="scheme-top-nav-right userdropdown">
                    <ul>
                        <?php
                        if ($this->session->userdata('USER_ID') != '') {
                            ?>

                            <div class="dropdown">
                                <img src="<?php echo base_url(); ?>assets/front/images/user.jpg" class="img-circle" data-toggle="dropdown">
                                <button class="dropdown-toggle" type="button"
                                        data-toggle="dropdown"><?php echo $this->session->userdata('USER_FNAME') . " " . $this->session->userdata('USER_LNAME'); ?>
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>myaccount" class="">My Account</a></li>
                                    <li><a href="<?php echo base_url(); ?>logout" class="">Logout</a></li>
                                </ul>
                            </div>


                            <?php
                        } else {
                            ?>
                            <li><a href="<?php echo base_url(); ?>login">Login</a> |</li>
                            <li><a href="<?php echo base_url(); ?>registers" class="">Register</a></li>
                            <?php
                        }
                        ?>


                    </ul>
                </div>
            </div>
        </div>
        <div class="mobilesearch">
            <form>
              
            </form>
        </div>
    </div>
</section>

<div class="clearfix"></div>

<section id="scheme-navbar">

    <nav class="navbar navbar-default">
        <div class="custom-width">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/logo.png"/></a>-->
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><img
                            src="<?php echo base_url(); ?>uploads/<?php echo $settings['header_logo']; ?>"/></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url(); ?>products">Products</a></li>
                   
                    <!--<li><a href="#">EVENTS</a></li>-->
                    <li class="cart-btn">
                        
                       
                           <a href="<?php echo base_url('cart'); ?>">CART()</a>
                       
                    </li>
                   
                </ul>
                
                
                <div class="form">
                    <form id="mainSearch" action="<?php echo base_url('frontend/product/productsSearch'); ?>" method="post">
                        <!--<label id="search">Search Here</label><br>-->
                        <?php        
                        if (!empty($_SESSION['prod_name_search']) && isset($_SESSION['prod_name_search'])) { ?>
                            <input type="text" class="input" id="searchproductbyname" name="searchproductbyname" value="<?php echo $_SESSION['prod_name_search']?>" placeholder="Search Here">
                        <?php }else{ ?>
                            <input type="text" class="input" id="searchproductbyname" name="searchproductbyname" placeholder="Search Here">
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>

    </nav>
</section>

<!-- add edit users -->




<!-- Jquery script -->

