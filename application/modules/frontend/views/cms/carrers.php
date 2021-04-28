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
 
    .about-innerarea p {
    width: 100%;
}
}
@media(min-width:768px) and (max-width:991px){
    .inner-banner-text h1 {
    top: 32%;
    font-size: 41px;
}
   
</style>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>
<div class="clearfix"></div> 



    
  
  
    
   <?php foreach($carrers->result() as $val){?>
   <section id="about-page">
       <div class="inner-banner">
        <img src="<?php echo base_url();?>uploads/cms/<?php echo $val->banner_image;?>">
           <div class="custom-width">
               <div class="inner-banner-text">
           <h1><?php echo $val->heading;?>
                   <ul>
               <li><a href="<?php echo base_url();?>carrers"><?php echo $val->sub_heading;?></a><li>
               </ul>
                   </h1>
               
                   </div>
           </div>
        </div>
        <div class="about-innerarea">
     <div class="custom-width">
         <h2><?php echo $val->title;?></h2>
         <h3><?php echo $val->description;?></h3>
        <p><?php echo $val->content;?></p>
		
         </div>
     </div>
   
	   <?php
	   }?>
     
   </section>
   
   
   
    
   <div class="clearfix"></div> 
    
    
    

    
    <?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>

</body>
</html>

