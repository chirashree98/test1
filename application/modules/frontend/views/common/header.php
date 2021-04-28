<?php
$from_mail = $this->common_model->RetriveRecordByWhere('ds_settings', array());
foreach ($from_mail->result() as $row) {
    $settings[$row->settings_name] = $row->settings_value;
}
?> 
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content=""> 
<title><?php echo $settings['site_title']; ?></title>
<!--Required styles-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/bootsnav.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/reset.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/animate.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/slick.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/slick-theme.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/responsive.css" rel="stylesheet">





<!-- Custom Fonts -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/front/line-icons/css/helper.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/line-icons/css/pe-icon-7-stroke.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/new-font/stylesheet.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&family=Oranienbaum&display=swap" rel="stylesheet">

<link href="//db.onlinewebfonts.com/c/b6968516e7add824ac6ed94c7098bd06?family=CentGothWGL" rel="stylesheet" type="text/css"/>





