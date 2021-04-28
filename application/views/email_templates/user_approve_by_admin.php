<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
      <title>Makkan</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        
        <style>
            *{padding: 0; margin: 0;}
            body{font-family: "Century Gothic", sans-serif;color: #414347; background: url(../images/back.jpg);}
            body p{font-family: "Century Gothic", sans-serif; color: #868686; font-size: 15px; line-height: 28px;}
            h1, h2 ,h3 ,h4, h5, h6{font-family: 'Josefin Sans', sans-serif;}
            .email-template-wid{width: 640px;
                                margin: 0 auto;
                                border: 1px solid #000;
                                margin-top: 20px;
                                margin-bottom: 20px;
                                padding: 25px;}


            tr td h4{
                width: 100%;
                float: left;
                margin: 20px 0 10px;
            }
            tr td p{
                width: 100%;
                float: left;
                margin-bottom: 15px;
            }
            .template-btn{background: #414347;
                          color: #fff;
                          font-size: 12px;
                          text-transform: uppercase;
                          padding: 10px 20px;
                          border-radius: 50px;
                          border: 1px solid #414347;margin-top: 20px;cursor: pointer;}
            .template-btn img{
                vertical-align: middle;
            }
			.template-footer img{
            padding-left: 22%;
        }
            .template-btn2{
                border: 1px solid #414347;
                background: transparent;
                border-radius: 50px;
                color: #414347;
                font-size: 12px;
                text-transform: uppercase;
                padding: 10px 20px; margin: 20px 0;cursor: pointer;
            }
            .template-btn2 img{
                vertical-align: middle;
                height: 15px;
            }
            .template-footer{
                width: 100%;
                text-align: center;
                float: left;
                position: relative;
                overflow: hidden;
                padding: 22px 0 20px 0;
                background-image: url(<?php echo $site_url; ?>/assets/email_template/images/footer-back.jpg);
            }

            .social-icon2{
                width: 100%;
                float: left;
                position: relative;
                margin: 15px 0;
            }
            .social-icon2 ul{}
            .social-icon2 ul li{
                display: inline-block;
            }
            .social-icon2 ul li a{    color: #b2b2b2;
                                      padding: 20px;
                                      padding-left: 0;
                                      font-size: 16px;
            }
            #template-footer p{
                font-family: 'Josefin Sans', sans-serif;
                text-transform: uppercase;
                color: #666666;
                font-size: 12px;
                width: 100%;
                float: left;
                line-height: 25px;
            }
            a{font-family: "Century Gothic", sans-serif;
              color: #6d6d6d;
              text-decoration: none;
              font-weight: 600;
            }
            @media(max-width:767px){
                .email-template-wid{width: 100%; padding: 0 15px;}  
                .template-btn{margin: 10px 0;}
                .template-btn2{margin: 10px 0;}
                .template-footer p{padding: 0 15px; font-size: 13px; width: auto;}
            }


            .logoarea{    border-bottom: 1px solid #000;
                          padding-bottom: 15px;}


        </style>
    </head>
    <body style='font-family: "Century Gothic", sans-serif;color: #414347; background: url(<?php echo $site_url; ?>/assets/email_template/images/back.jpg);'>



        <table class="email-template-wid">
            <tr>

                 <th colspan="3" class="logoarea"><img src="<?php echo $site_url; ?>/assets/email_template/images/1612187255_header_logo.png" /></th>
            </tr>
            <tr>
                <td colspan="3"> <p style="margin-top:30px">Hello <?php echo $dear_name; ?>;</p>
                   <p>We are glad to inform you that your sign-up request is approved. We welcome you aboard. Please login with the following mentioned credentials</p>
                   <h4>Email: <?php echo $user_email; ?></h4>
                   <h4>Password: <?php echo $user_pass; ?></h4>
                   

                   


            </tr>
            <tr>
                <td colspan="3" class="template-footer"> 
                     <img src="<?php echo $site_url; ?>/assets/email_template/images/1612184932_footer_logo.png" />
                    <div class="social-icon2">
                        <ul>
                            <li><a href="<?php echo $facebook_url; ?>"><img src="<?php echo $site_url; ?>/assets/email_template/images/facebook.png"  /> </a></li>
                            <li><a href="<?php echo $twitter_url; ?>"><img src="<?php echo $site_url; ?>/assets/email_template/images/twitter.png"  /> </a></li>
                            <li><a href="<?php echo $pinterest; ?>"><img src="<?php echo $site_url; ?>/assets/email_template/images/pinterest.png"  /> </a></li>
                        </ul>
                    </div>
                    <p><?php echo $footer_copyright_text; ?></p>
                </td>

            </tr>
        </table>
        <!--Required js --> 
        <script src="<?php echo $site_url; ?>/assets/email_template/js/jquery-1.11.3.js"></script>
        <script src="<?php echo $site_url; ?>/assets/email_template/js/bootstrap.min.js"></script>
        <script src="<?php echo $site_url; ?>/assets/email_template/js/bootstrap-dropdown-on-hover.js"></script>
        <script src="<?php echo $site_url; ?>/assets/email_template/js/bootsnav.js"></script>
        <script src="<?php echo $site_url; ?>/assets/email_template/js/custom.js"></script>
    </body>
</html>