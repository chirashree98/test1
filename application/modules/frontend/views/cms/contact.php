<!DOCTYPE html>
<?php $this->load->view('common/header'); ?>
<style>
 .inner-banner-text{width: 100%;float: left;}
.inner-banner-text h1{text-transform: uppercase;font-weight: bold;color: #fff;position: absolute;top: 40%;font-size: 44px;}
.inner-banner-text ul{/* float: left; *//* width: 100%; */}
.inner-banner-text ul li{
    display: inline-block;
    color: #fff;
    font-size: 15px;
    font-family: 'Josefin Sans', sans-serif;
    margin-right: 5px;
    font-weight: 600;
}
.inner-banner-text ul li a{
    color: #c5c5c5;
    padding-right: 5px;
}
.inner-banner-text ul li a:hover{color: #fff;}
.footer-right ul li a:hover{color: #fff;}
#contact-page{width: 100%;float: left;position: relative;}
.inner-banner{width: 100%; float: left; position: relative;}
.inner-banner img{width: 100%;}
.contact-formarea{width: 100%; float: left; position: relative; padding-top: 50px;}
.inner-banner-text{width: 100%;float: left;}
.inner-banner-text h1{text-transform: uppercase;font-weight: bold;color: #fff;position: absolute;top: 40%;font-size: 44px;}
.inner-banner-text ul{/* float: left; *//* width: 100%; */}
.inner-banner-text ul li{
    display: inline-block;
    color: #fff;
    font-size: 15px;
    font-family: 'Josefin Sans', sans-serif;
    margin-right: 5px;
    font-weight: 600;
}
.inner-banner-text ul li a{
    color: #c5c5c5;
    padding-right: 5px;
}
.inner-banner-text ul li a:hover{color: #fff;}
.footer-right ul li a:hover{color: #fff;}
.contact-info{
    width: 100%;
    float: left;
    padding: 25px;
    border-bottom: 3px solid #000000;
    background: #272819;
    }
.contact-info h3{
    color: #edb064;
    font-family: 'Josefin Sans', sans-serif;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 20px;
    border-bottom: 1px solid #484a2b;
    }
.contact-info .form-group{}
.contact-info .form-control{
    height: 45px;
    margin-bottom: 0;
    border-radius: 0;
    box-shadow: none;
    background: #ffffff26;
    color: #fff;
    font-family: 'Josefin Sans', sans-serif;
    font-size: 16px;
    }
.contact-info  textarea{ height: 80px !important; resize: none;}
.contact-info .form-control:focus {
    border-color: #000;
}
.contact-info .form-group label{
    font-family: 'Josefin Sans', sans-serif;
    font-size: 16px;
    font-weight: normal;
    color: #fff;
    padding-bottom: 5px;
    }
.contact-info .mandate{color: #fff;}
.contact-address{
    width: 100%;
    float: left;
    padding: 25px;
    border-bottom: 3px solid #ccc;
    background: #e0e0e0;
    box-shadow: 0px 0px 20px #00000021;
    }
.contact-address h3{
    color: #272819;
    font-family: 'Josefin Sans', sans-serif;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 20px;
    border-bottom: 1px solid #c3c3c3;
    }
.contact-address ul li a{color: #272819;font-size: 18px;}
.contact-address p{
    margin-bottom: 24px;
    color: #272819;
}
.contact-address p .fa{
    width: 35px;
    float: left;
    border-radius: 50%;
    border: 1px solid #272819;
    height: 35px;
    margin-right: 10px;
    text-align: center;
    font-size: 18px;
    line-height: 34px;
    background: #272819;
    color: #fff;
}
.contact-address p span{}
.contact-address p span a{ color: #272819;}
.contact-submit-btn{
    background: #edb064;
    color: #272819;
    border: 1px solid #272819;
    padding: 10px 22px;
    font-family: "Century Gothic", sans-serif;
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition-duration: 0.8s;
    }
.contact-submit-btn:hover{background: #d08220;}
#contact-page iframe{width: 100%; margin-top: 30px; float: left;}
.about-innerarea{ width: 100%; float: left; position: relative; padding: 30px 0; text-align: center;}
.about-innerarea h3{
    font-size: 21px;
    color: #464646;
    margin-bottom: 15px;
    position: relative;
    padding-bottom: 20px;
}
.about-innerarea h3:before{content: "";border-bottom: 7px double #989898;width: 70px;position: absolute;bottom: 0;text-align: center;left: 48%;}
.about-innerarea h2{
    font-size: 30px;
    font-weight: bold;
    color: #353535;
    margin-bottom: 8px;
}
.about-innerarea p{
    width: 80%;
    margin: 0 auto;
    margin-bottom: 15px;
}
@media(max-width:767px){
    .inner-banner-text h1 {
    top: 24%;
    font-size: 22px;
    margin-bottom: 5px;
    line-height: normal;
}
    .inner-banner-text ul li {
    font-size: 12px;
}
 .contact-formarea {
    padding-top: 30px;
} 
    .about-innerarea p {
    width: 100%;
}
}
@media(min-width:768px) and (max-width:991px){
    .inner-banner-text h1 {
    top: 32%;
    font-size: 41px;
}
    .about-innerarea p {
    width: 100%;
}
</style>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>
<div class="clearfix"></div> 



    
  
  
    
   <?php foreach($contact->result() as $val){?>
   <section id="contact-page">
       <div class="inner-banner">
        <img src="<?php echo base_url();?>uploads/cms/<?php echo $val->banner_image;?>">
           <div class="custom-width">
               <div class="inner-banner-text">
           <h1><?php echo $val->heading;?>
                   <ul>
               <li><a href="<?php echo base_url();?>contact_us"><?php echo $val->sub_heading;?></a>
                      
                       <li>
               </ul>
                   </h1>
               
                   </div>
           </div>
        </div>
       <div class="contact-formarea">
	   <div class="col-md-6">
	   <div id="msg2_div">
	   <?php if ($this->session->flashdata('success') != '') { ?>
            <?php echo $this->session->flashdata('success'); ?>
           <?php } ?>
		   </div>
		   </div>
    <div class="custom-width">
       <div class="row">
        <div class="col-sm-7">
           <div class="contact-info">
            <h3>Send A Message</h3>
               <form method="post" action="">
              <div class="row">
                   <div class="col-sm-6">
                  <div class="form-group">
            <label for="first_name">First Name</label><span class="mandate"> * </span>
            <input type="text" name="first_name" id="first_name"  class="form-control">
             <p style="height:0px" class = "error_msg"><?php echo form_error('first_name'); ?> </p>
                  </div>
				 </div>
                   <div class="col-sm-6">
                  <div class="form-group">
            <label for="first_name">Last Name</label><span class="mandate"> * </span>
            <input type="text" name="last_name" id="last_name"  class="form-control">
            <p class = "error_msg"><?php echo form_error('last_name'); ?> </p>
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
            <label for="first_name">Email</label><span class="mandate"> * </span>
            <input type="text" name="email" id="email" value="" class="form-control">
             <p class = "error_msg"><?php echo form_error('email'); ?> </p>
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
            <label for="first_name">Phone no</label><span class="mandate"> * </span>
            <input type="number" name="phone" id="phone" value="" class="form-control">
             <p class = "error_msg"><?php echo form_error('phone'); ?> </p>
                  </div>
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
            <label for="first_name">Message</label><span class="mandate"> * </span>
                      <textarea type="text" name="message" id="message" value="" class="form-control"></textarea>
            <p class = "error_msg"><?php echo form_error('message'); ?> </p>
                  </div>
                  </div>
                   </div>
                   <button class="contact-submit-btn" id="btn">Submit</button>
               </form>
            </div>
            </div>
           <div class="col-sm-5">
           <div class="contact-address">
           <h3>Connect with Us</h3>
               <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span><?php echo $val->address;?></span></p>
               <p>
                   <a href="tel:<?php echo $val->phone;?>">
                        <i class="fa fa-phone" aria-hidden="true"></i> <span><?php echo $val->phone;?></span>
                   </a>
               </p>
               <p>
                   <a href="mailto:<?php echo $val->email;?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> <span><?php echo $val->email;?></span></a>
               </p>
              
           </div>
           </div>
        </div>
        </div>
       </div>
	   <?php
	   }?>
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14948587.0221749!2d36.048417009176184!3d23.834333622055485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15e7b33fe7952a41%3A0x5960504bc21ab69b!2sSaudi%20Arabia!5e0!3m2!1sen!2sin!4v1607082196660!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
   </section>
   
   
   
    
   <div class="clearfix"></div> 
    
     <script>
function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        function isphone(phoneNum) {
       
        var phone= /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; 
        return phone.test(phoneNum );
      }
$('#btn').on('click', function () {
	//alert(123);
            $(".error_msg").html('');
            
            if ($('#first_name').val() == '') {
                $('#first_name').next(".error_msg").html('Please enter first name');
                $('#first_name').focus();
                return false;
            }
             if ($('#last_name').val() == '') {
                $('#last_name').next(".error_msg").html('Please enter last name');
                $('#last_name').focus();
                return false;
            }
            
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
			if ($('#phone').val() == '') {
                $('#phone').next(".error_msg").html('Please enter phone no');
                $('#phone').focus();
                return false;
            }
            if (!isphone($('#phone').val())) {
                $('#phone').next(".error_msg").html('Please enter a valid phone no');
                $('#phone').focus();
                return false;

            }
            if ($('#message').val() == '') {
                $('#message').next(".error_msg").html('Please enter message');
                $('#message').focus();
                return false;
            }

        });

    </script>
    
    
    <script>
	

            $("#msg2_div").fadeOut(7000);
        </script>
    

    
    <?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>

</body>
</html>

