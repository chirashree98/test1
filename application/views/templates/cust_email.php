<link href="<?php echo base_url(); ?>frontend/css/style1.css" rel="stylesheet">

<section id="template-header">
					<div class="custom-width">
						<img src="<?php echo base_url(); ?>frontend/images/logo.png"/>
						</div>
					</section>
					
<section id="template-contant">
					<div class="custom-width">
						<h4>Email Verification to <?php echo $utype; ?> </h4>
	<p> Thanks for choosing Design Studio. We have received your registration request. Before you get started, please verify your email address below </p>
	<p> <?php echo base_url(); ?>confirmmail/<?php echo $uid; ?>/<?php echo $otp; ?> </p>
     <p>Thanks & Regards, <br/>
Design Studio Team.   </p>
        </div>
</section>