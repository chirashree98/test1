<!DOCTYPE html>
<?php $this->load->view('common/header'); ?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

    <![endif]-->
    <style>
    .view-shop-details-btn{
    background: #272819;
    color: #fff;
    border: 1px solid #272819;
    padding: 7px 20px;
    font-family: "Century Gothic", sans-serif;
    font-size: 13px;
    margin-top: 10px;
    margin-bottom: 26px;
    }
    .shop-details-page span{margin:0;padding-top: 5px;}
.mb50{margin-bottom: 50px;}
/********PROJECT DETAILS***************/
.project-details-page{width: 100%; float: left; position: relative;}
.project-details-page img{width: 100%;}
.project-details-page h4{
    color: #222222;
    font-family: "Century Gothic", sans-serif;
    width: 100%;
    float: left;
    font-size: 24px;
    padding: 0;
    margin-top: 12px;
    margin-bottom: 20px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 1px;
    }
    </style>
</head>
<body>
<!-- Header Start-->
<div class="clearfix"></div> 
   
<?php $this->load->view('common/header_nav'); ?>
<?php  foreach($shop->result() as $val){?>
<?php if($val->title!=''){?>
   <section id="artistlint-sec1">

    <div class="custom-width">
         <div class="artist-heading">
		 
        <h1><?php echo $val->title;?></h1>
		<?php
}?>
<?php if($val->description!=''){?>

        <p class="mb0"><?php echo $val->description;?></p>
        </div>
		<?php
   }}?>
        <div class="artist-shortby">
        
        <p>There are <?php echo $total_rows; ?> Top  Shops 12345</p>
        
            <span> 
            <div class="dropdown" >
              Sort By:
  <button class="dropdown-toggle" type="button" data-toggle="dropdown"><?php 
                               
                                if (!empty($_SESSION)) {
                                    foreach ($_SESSION['search'] as $key => $val) {
                                        if ($key == 'order' && $val!='') { echo $val == 'desc' ? 'Z to A' : 'A to Z';}}}else{ echo " Z TO A"; }?> <img src="<?php echo base_url();?>assets/front/images/list-dropdown.png"/></button> 
  <ul class="dropdown-menu" >
  <li><a href="<?php echo base_url(); ?>namesearch?order=asc"> A to Z</a></li>
    <li><a href="<?php echo base_url(); ?>namesearch?order=desc">Z to A </a></li>
    
    
  </ul>
 
</div>
       
           
            </span>
        </div>
		
     
     
                
        <div class="artist-searcharea">
        <p>FIND SHOP</p>
		
            <div class="form-group">
            <form>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Shop or category Name "/>
                <button class="artist-search-btn"><img src="<?php echo base_url();?>assets/front/images/search.png"/></button>
                </form>           
            </div>
        </div>
       
             
       
        <div class="artist-list" >
        <div class="row" id="default-datatable22s">
        <?php print_r($query2->result()); foreach($query2->result() as $val){?>
          <div class="col-md-3 col-sm-6" >
      <div class="artist-list-inner shop-details-page" id="default-datatable22s2" >
	   <?php if($val->banner_image=="")
                                        {
                                            ?>
                                            <img src="<?php echo base_url(); ?>assets/front/images/profile-no.png" class="img-responsive"/>
                                            <?php
                                        }
                                        else{
                                            ?>
                                           <img src="<?php echo base_url();?>uploads/product/<?php echo $val->banner_image;?>" class="img-responsive"/>
                                            <?php
                                        }?>
           
                <h4><?php echo $val->shop_name;?></h4>
                <p><strong>Country: </strong> <?php echo  $val->country_name;?></p>
                    <p><strong>City:  </strong> <?php echo  $val->city;?></p>
                    <p><strong>Speciality:  </strong> <?php echo $val->product_types;?></p>
                <span><?php echo $val->shop_description;?>.</span>
                    <a href="<?php echo base_url();?>shopdetails/<?php echo $val->user_id; ?>"><button class="view-shop-details-btn">View Shop  Details</button></a>
              
                   
                   
            </div>
           
            
       
        
            </div>
     <?php }?>
     </div>
        <!--<div class="pagination mb50">
        <span>Showing  of 7 item(s)</span>
            <ul>
            <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> &nbsp; Previous</a></li>
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#"> Next &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        
       </div>
       </div>-->
       <div class="pagination mb50">
       <?php if ($query2->num_rows() > floatval($limit)) { ?>
                                                    <span>Showing 1-<?php echo $query2->num_rows(); ?> of  <?php echo $total_rows; ?>  item(s)</span>
                                                <?php } else { ?>
                                                    <span>Showing 1-<?php echo $query2->num_rows(); ?> of  <?php echo $total_rows; ?>  item(s)</span>
                                                <?php } ?>
                                                <ul>
                                                    <?php echo $links; ?>
                                                </ul>
                            </ul>
                        </div>
                        </div>
       </div>

                
                </div>
                
    
     <div class="clearfix"></div> 
    
     
    
    <?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_js'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$("#name").keyup(function(){
      //alert(123);
				if($("#name").val().length>0) {
					var names =$("#name").val();
					//alert(names);
					$.ajax({
						url:"<?php echo base_url()?>searches",
						method:"post",
						 data:'name='+$("#name").val(),
						 success:function(response){
						//alert('234');
						 	//$("#default-datatable22s").show();
               $('#default-datatable22s').html(response);
						 	
						 	//$("#delete").hide();
						 	},
						 	error:function(){
						 		alert("Error Request");
						 	}
					});
				}
				if($("#name").val().length == 0) {
          //$("#default-datatable22s").show();
          //alert(123);
					$.ajax({
						url:"<?php echo base_url()?>searches",
						method:"post",
						 data:'name='+$("#name").val(),
						success:function(response){
						$('#default-datatable22s').html(response);
						 
						 	},
						 	error:function(){
						 		alert("Error Request");
						 	}
					});
				}
			return false;
		});
		
	});
</script>

    <script>

$(".input").focus(function() {
  $("#search").addClass("move");
});
$(".input").focusout(function() {
  $("#search").removeClass("move");
  $(".input").val("");
});

$(".search").click(function() {
  $(".input").toggleClass("active");
  $("#search").toggleClass("active");
});
    </script>
    <script>
/*******************************
* ACCORDION WITH TOGGLE ICONS
*******************************/
	function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
    </script>
<!--     <script>
$('.slick-carousel').slick({
  centerMode: true,
    arrows: false,
    dots: true,
  infinite: true,
  slidesToShow: 4,
    autoplay: true,
		autoplaySpeed: 3000,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
          dots: true,
  infinite: true,
        centerMode: true,
        slidesToShow: 1
      }
    }
  ]
});
    </script>
    <script>
    $('.variable-width').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
});
    </script>-->
</body>
</html>
