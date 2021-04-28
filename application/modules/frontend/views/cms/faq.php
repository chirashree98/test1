<!DOCTYPE html>
<?php $this->load->view('common/header'); ?>
<?php $this->load->view('common/header_nav'); ?>
<style>
    .inner-banner-text {
        width: 100%;
        float: left;
    }

    .inner-banner-text h1 {
        text-transform: uppercase;
        font-weight: bold;
        color: #fff;
        position: absolute;
        top: 40%;
        font-size: 44px;
    }

    .inner-banner-text ul { /* float: left; *//* width: 100%; */
    }

    .inner-banner-text ul li {
        display: inline-block;
        color: #fff;
        font-size: 15px;
        font-family: 'Josefin Sans', sans-serif;
        margin-right: 5px;
        font-weight: 600;
    }

    .inner-banner-text ul li a {
        color: #c5c5c5;
        padding-right: 5px;
    }

    .inner-banner-text ul li a:hover {
        color: #fff;
    }

    .footer-right ul li a:hover {
        color: #fff;
    }

    #contact-page {
        width: 100%;
        float: left;
        position: relative;
    }

    .inner-banner {
        width: 100%;
        float: left;
        position: relative;
    }

    .inner-banner img {
        width: 100%;
    }

    .contact-formarea {
        width: 100%;
        float: left;
        position: relative;
        padding-top: 50px;
    }

    .inner-banner-text {
        width: 100%;
        float: left;
    }

    .inner-banner-text h1 {
        text-transform: uppercase;
        font-weight: bold;
        color: #fff;
        position: absolute;
        top: 40%;
        font-size: 44px;
    }

    .inner-banner-text ul { /* float: left; *//* width: 100%; */
    }

    .inner-banner-text ul li {
        display: inline-block;
        color: #fff;
        font-size: 15px;
        font-family: 'Josefin Sans', sans-serif;
        margin-right: 5px;
        font-weight: 600;
    }

    .inner-banner-text ul li a {
        color: #c5c5c5;
        padding-right: 5px;
    }

    .inner-banner-text ul li a:hover {
        color: #fff;
    }

    .footer-right ul li a:hover {
        color: #fff;
    }

    .faq {
    }

    .faq .inner-faq {
        margin: 0 auto;
        max-width: 80%;
    }

    .faq .scheme-sec1-inner {
        width: 100%;
        float: left;
        padding: 50px 0;
    }

    .faq .panel-default > .panel-heading {
        padding: 0;
        border-radius: 0;
        color: #212121;
        background-color: transparent;
        border-color: #666;
    }

    .faq .panel-title {
        font-size: 14px;
        background: transparent;
    }

    .faq .panel-title > a {
        display: block;
        padding: 15px;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: 'Josefin Sans', sans-serif;
        font-size: 16px;
        background: transparent;
        border-bottom: 1px solid #414347;
    }

    .faq .more-less {
        float: left;
        color: #212121;
        padding-right: 10px;
    }

    .faq .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
    }

    .faq .panel-default {
        border-color: transparent;
    }

    .faq .panel {
        background: transparent;
        box-shadow: none;
    }

    @media (max-width: 767px) {
        .faq .inner-faq {
            margin: 0 auto;
            max-width: 100%;
        }
    }


</style>
<div class="clearfix"></div>

<?php foreach ($faqs->result() as $val){ ?>
<section id="contact-page" class="faq">
    <div class="inner-banner">
        <img src="<?php echo base_urL(); ?>uploads/cms/<?php echo $val->banner_image; ?>"/>
        <div class="custom-width">
            <div class="inner-banner-text">

                <h1><?php echo $val->heading; ?>
                    <ul>
                        <li><a href="#"><?php echo $val->sub_heading; ?></a></li>
                    </ul>
                </h1>

            </div>
        </div>
    </div>
    <?php
    } ?>
    <div class="custom-width">
        <div class="inner-faq">
            <div class="scheme-sec1-inner">

                <div class="demo">


                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        <?php
                        //print_r($service);
                        //if ($service->num_rows() > 0) {
                        $i == 0;
                        foreach ($faq->result() as $val2) {
                            $i++;
                            ?>


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?= $i ?>">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                           href="#collapse<?= $i ?>" aria-expanded="true"
                                           aria-controls="collapse<?= $i ?>" <?= ($i == 1) ? 'class="bordertop"' : '' ?>>

                                            <?php echo $val2->question; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?= $i ?>" class="panel-collapse collapse
            <?= $i ?>" aria-labelledby="heading
             <?= $i ?>" style="">
                                    <div class="panel-body">
                                        <p><?php echo $val2->answer; ?></p>

                                    </div>
                                </div>
                            </div>
                            <?php //}

                        } ?>


                    </div>
                </div>
            </div>

</section>


<div class="clearfix"></div>

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_js'); ?>

</body>
</html>