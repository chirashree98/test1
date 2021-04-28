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
            <h1>DESIGNER DASHBOARD</h1>
        </div>

        <div class="artist-accept-decline-inner">
            <div class="row">
                <div class="col-md-3">
                    <div class="artist-left-panel">
                        <?php $this->load->view('artist/artist-left-panel'); ?>
                    </div>
                </div>
                <form action="" id="myFrm" method="post" enctype="multipart/form-data">
                    <div class="col-md-9">
						<div class="my-account-left-panel-sec1 mb15">
                            <h4>My Account</h4>
                            <div class="my-account-left-panel-sec1-inner">
                                <p><a href="<?php echo base_url(); ?>artist_edit_profile">Edit your account information</a></p>
								
                                <p><a href="<?php echo base_url(); ?>artist-changepassword">Change your password</a></p>
                                
                            </div>
                        </div>
						 <div class="my-account-left-panel-sec1 mb15">
                            <h4>Design Request</h4>
                            <div class="my-account-left-panel-sec1-inner">
                                <p><a href="<?php echo base_url(); ?>request-ad">View  your Design Request</a></p>
                                <!--<p><a href="#">Downloads</a></p>
                                <p><a href="#">Your Reward Points</a></p>
                                <p><a href="#">View your return requests</a></p>
                                <p><a href="#">Your Transactions</a></p>
                                <p><a href="#">Recurring payments</a></p>-->
                            </div>
                        </div>

                        <?php if(variable_array_check($membership_details)){ ?>
                            <div class="my-account-left-panel">
                                <div class="my-account-left-panel-sec1 mb-20">
                                    <h4>Membership Details</h4>
                                    <div class="my-account-left-panel-sec1-inner">
                                        <p>Membership Name : <?= $membership_details[0]['membership_name'] ?></p>
                                        <p>Membership Start Date : <?= date('d-m-Y', strtotime($membership_details[0]['created_at'])) ?></p>
                                        <?php if(variable_value_check($membership_details[0]['invitation_code'])){ ?>
                                            <p>Invitation Code: <?= $membership_details[0]['invitation_code'] ?></p>
                                            <p>Price : SR 0</p>
                                        <?php }else{ ?>
                                            <?php if($membership_details[0]['mem_payment_id'] == 1){ ?>
                                                <p>Membership End Date : <?= date('d-m-Y', strtotime('+ 1 year', strtotime($membership_details[0]['created_at']))) ?></p>
                                            <?php } ?>
                                            <?php if($membership_details[0]['mem_payment_id'] == 2){ ?>
                                                <p>Membership End Date : <?= date('d-m-Y', strtotime('+ 6 months', strtotime($membership_details[0]['created_at']))) ?></p>
                                            <?php } ?>
                                            <?php if($membership_details[0]['mem_payment_id'] == 3){ ?>
                                                <p>Membership End Date : <?= date('d-m-Y', strtotime('+ 3 months', strtotime($membership_details[0]['created_at']))) ?></p>
                                            <?php } ?>
                                            <?php if($membership_details[0]['mem_payment_id'] == 4){ ?>
                                                <p>Membership End Date : <?= date('d-m-Y', strtotime('+ 1 month', strtotime($membership_details[0]['created_at']))) ?></p>
                                            <?php } ?>
                                            <p>Price : SR <?= $membership_details[0]['membership_price'] ?></p>
                                        <?php } ?>
                                        <p>Membership Payment : <?= $membership_details[0]['mem_payment_type'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

						 <div class="my-account-left-panel-sec1">
                            <h4>Newsletter</h4>
                            <div class="my-account-left-panel-sec1-inner">
                                <p><a href="<?php echo base_url(); ?>user_newsletters">Subscribe / unsubscribe to
                                        newsletter</a></p>
                            </div>
                        </div>




                        
    <!--                        <div class="dashboard-btn-area col-sm-12">
                                <button type="submit" class="save">Save</button>
                            </div>-->

    </form>
    </div>
    </div>
    </div>
</section>


<div class="clearfix"></div>

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_js'); ?>  

</body>




</html> 
