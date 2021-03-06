<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/product-details/main.css">
        
        
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>        
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>        
        
    </head>
    <body>


        <?php $this->load->view('common/header_nav'); ?>
        <!--+++++++++++++ Header End +++++++++++++++++++-->
        <?php
        if ($this->session->flashdata('error') != '') {
            $msg = $this->session->flashdata('error');
            ?>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $('.notifications').html("<?php echo $msg; ?>");
                $('.notifications').animate({right: 0}, 1000);
                intrval = setInterval(function () {
                    $('.notifications').animate({right: -($('.notifications').width() + 30)}, 1000);
                    clearInterval(intrval);
                }, 5000);
            </script>
<?php } ?>

        <div class="clearfix"></div>
        <section id="product-details-page">
            <div id="messagees" class="col-md-6" >
            </div>
            <div class="custom-width">
                <div class="product-details-page-inner">
                    <div class="row">
                        <div class="col-sm-5">
<!--
                            <div class="product-details-img-area">


                                <div class="show" href="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>"
                                     style="position: relative;">
                                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>"
                                         id="show-img" style="width: 100%; height: 100%;">
										 <?php for ($i = 0; $i < count($extra_images); $i++) { ?>
                                    <div style="position: absolute; left: 321.281px; top: 74px; background-color: rgb(0, 0, 0); width: 100px; height: 100px; opacity: 0.2; border: 1px solid rgb(204, 204, 204); cursor: crosshair; display: none;"></div>
									
                                    <div style="position: absolute; overflow: hidden; left: 509px; top: 0px; width: 500px; height: 500px; display: none;">
                                        <img src="<?php echo base_url(); ?>uploads/product/<?php echo $extra_images[$i]; ?>" id="big-img"
                                             style="position: absolute; left: -1606.41px; top: -370px; width: 2520px; height: 2030px;">
											 
                                    </div>
									<?php 
										 }?>
                                </div>


                                <div class="small-img">

                                    <img src="<?php echo base_url(); ?>assets/front/images/online_icon_right@2x.png"
                                         class="icon-left" alt="" id="prev-img">
                                    <div class="small-container">
                                        <?php
                                        $extra_images = json_decode($query['extra_images']);
                                        ?>
<?php for ($i = 0; $i < count($extra_images); $i++) { ?>
                                            <div id="small-img-roll">

                                              <img src="<?php echo base_url(); ?>uploads/product/<?php echo $extra_images[$i]; ?>"
                                                     class="show-small-img">


                                            </div>
<?php } ?>
                                    </div>

                                </div>

                            </div>
-->

                            <div class="product-details-img-area">
                                <?php 
                                    $extra_images = json_decode($query['extra_images']);
                                    $images = $query['image'];
                                ?>
                                <div class="slider-for">
                                    
                                    <div class="item">
                                        <a href="javascript:void(0);">
                                            <img src="<?php echo base_url('uploads/product/'.$images);?>"/>
                                        </a>  
                                    </div>

                                    <?php for ($i = 0; $i < count($extra_images); $i++) { ?>
                                    <div class="item">
                                        <a href="javascript:void(0);">
                                            <img src="<?php echo base_url('uploads/product/'.$extra_images[$i]);?>"/>
                                        </a>  
                                    </div>
                                     <?php } ?>

                                   <!--  <div class="item">
                                  <a href="#"><img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg"/>
                                      </a>  
                                    </div>
                                -->
                                </div>
                                <div class="slider-nav">
                                    <div class="item active-slider-nav">
                                       <a href="javascript:void(0);">
                                            <img src="<?php echo base_url('uploads/product/'.$images);?>">
                                        </a>
                                    </div>

                                    <?php for ($i = 0; $i < count($extra_images); $i++) { ?>
                                       <div class="item active-slider-nav">
                                           <a href="javascript:void(0);">
                                                <img src="<?php echo base_url(); ?>uploads/product/<?php echo $extra_images[$i]; ?>">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            </div>

                        <div class="col-sm-7">
                            <div class="product-details-right-text">
                                <h3><?php echo $query['name']; ?></h3>
                                <h5><?php echo $query['currency']; ?><?php echo $query['sell_price']; ?></h5>
                                <p><?Php echo $query['details']; ?></p>
                                <ul>
                                    <li><?php echo $query['extra_desc']; ?></li>
                                    <!--<li>Straight fit</li>
                                    <li>Dry clean</li>-->
                                </ul>
                                <p class="sku"><span>SKU:</span><?php echo $query['sku']; ?></p>
                                <p class="sku"><span>Category:</span>

                                    <?php foreach ($category->result() as $row) { ?>
                                        <?php
                                        if ($query['cat_id'] == $row->id) {
                                            ?><?php echo $row->name; ?>
                                        <?php }
                                    }
                                    ?>

                                <form action="<?php echo base_url(); ?>add-cart" id="myFrm" method="post" enctype="multipart/form-data">
                                    <div class="form-group">

                                        <?php
//                    print_R($items->result());
                                        $p_attr = array();
                                        foreach ($items->result() as $row) {
                                            if (!in_array($row->parent_id, $p_attr)) {
                                                $p_attr[$row->parent_id][] = $row;
                                            }
                                        }
//            print_r($p_attr);
                                        ?>
                                        <?php
                                        foreach ($p_attr as $row) {
                                            ?>
                                            <div class="wi33">
                                                <label> <?php echo $row[0]->p_attr_name; ?></label>
                                                <select class="" required="required" name="attrpro[]">

                                                    <?php foreach ($row as $r2) { ?>
                                                        <option value="<?php echo $r2->attr_id; ?>"><?php echo $r2->child_attr_name; ?></option>
    <?php } ?>
                                                </select>
                                            </div>
<?php } ?>

                                    </div>

                                    <div class="qntatra">
                                        <input type="hidden" name="p_id" value="<?php echo $query['p_id']; ?>">
                                        <input type="hidden" name="name" value="<?php echo $query['name']; ?>">
                                        <input type="hidden" name="sell_price" value="<?php echo $query['sell_price']; ?>">
                                        <input type="hidden" name="stock" id="maxquantity" value="<?php echo $query['qty']; ?>">
                                        <p class="sku"><span>Quantity:</span></p>

                                        <div id="field1">
                                            <button type="button" id="subquantity" class="sub" value="<?php echo $query['qty']; ?>"<?php if (floatval($query['qty']) <= 1) { ?> disabled="disabled" <?php } ?>>-</button>

                                            <input type="number" id="addquantity" name="qty" value="1" min="1" >
                                            <button type="button" onclick="add()" class="add active-add-btn " value="<?php echo $query['qty']; ?>">+</button>
                                            <span id="response" style="color:red"></span>
                                        </div>

                                    </div>
                            </div>
                            <div class="addtocare-btn-area">
                                    <button type="submit" class="addtocare-btn" <?php echo floatval($query['qty'] < 1)? "disabled" : '';?> >
                                     <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
                                    </button>
                                </form>


                             
                                
                            </div>
                            <div class="stokin">
                                <?php if (floatval($query['qty'] >= 1)) { ?>
                                    <h6>In stock.</h6>
                                <?php } else { ?>
                                    <h6 style="color: red">Out of stock.</h6>
<?php } ?>

                                <p><strong>Sold by:</strong><?php foreach ($user as $val) { ?>
                                        <?php if ($val['virtual_studio']) { ?>
                                            <?php echo $val['virtual_studio']; ?>
                                            <?php } else {
                                            ?>
                                            <?php echo $val['first_name'] . ' ' . $val['last_name']; ?>
                                            <?php
                                        }
                                    }
                                    ?></p>
                            </div>


                        </div>

                    </div>
                </div>


                <div class="product-details-tabarea">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">
                                        DESCRIPTION</a>
                                </li>
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab">
                                        eStore Details</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">

                                    <p>
									<?php
                        
                        if (count($query['long_description']) > 0) {
							if($query['long_description']!=''){?>
<?php echo $query['long_description']; ?>
<?php 
}}else{?>
No Description Found
<?php
}?>
                                    </p>

                                </div>
                                <div class="tab-pane" id="tab_default_2">

                                    <p>
									<?php
                        
                        if (count($query['store_details']) > 0) {
							if($query['store_details']!=''){?>
<?php echo $query['store_details']; ?>
<?php 
}}else{?>
No Estore Details Found
<?php
}?>
                                    </p>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="similarproduct-area">
                    <h5>Related Products</h5>
                    <p>
                        <?php
                        $prodcuct_ids = json_decode($query['related_product']);
                        if (count($prodcuct_ids) > 0) {
                            foreach ($products->result() as $row) {
                                if (in_array($row->p_id, $prodcuct_ids) ? "selected" : "") {
                                    ?>

                                    <div class="col-md-3 col-sm-6">

                                        <div class="artist-list-inner">
                                            <a href="<?php echo base_url(); ?>product_detail/<?php echo digi_encode($row->p_id); ?>"><img
                                                    src="<?php echo base_url(); ?>uploads/product/<?php echo $row->image; ?>"
                                                    class="img-responsive"></a>
                                                    <a href="<?php echo base_url(); ?>product_detail/<?php echo digi_encode($row->p_id); ?>"><h4><?php echo $row->name; ?></h4></a>
                                            <span><?php echo $row->currency; ?><?php echo $row->sell_price; ?></span>
                                        </div>

                                    </div>
                                    <?php
                                }
                            }
                        } else {
                            ?>
                            No Related Product Found
<?php } ?>

                    </p
                </div>

            </div>
        
</section>
<div class="clearfix"></div>


<!--+++++++++++++ footer Start +++++++++++++++++++-->

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_js'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script src="<?php echo base_url(); ?>assets/front/js/zoom-image.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/main.js"></script>

<script>
 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  arrows: true,
	  infinite:false,
	  prevArrow:false,
      nextArrow:false,
	  asNavFor: '.slider-for',
	  dots: false,
	  centerMode: false,
	  focusOnSelect: true,
      autoplay: true,
      autoplaySpeed: 3000,
	  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: false,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 4,
        dots: false,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
	});
</script>



<script>



    $('.add').click(function () {
        if($('.sub').hasClass('active-add-btn')){
            $('.sub').removeClass('active-add-btn');
        }
        $('.add').addClass('active-add-btn');

        // var id = $(this).val();
        var maxquantity = $("#maxquantity").val();
        var addquantity = $("#addquantity").val();
        //alert(maxquantity);
        //alert(addquantity);
        addquantity = parseInt(addquantity) + 1;
		
        //alert(addquantity);
        if (addquantity > maxquantity) {
            $("#response").html("Sorry! We don't have any more unites for this items");
            $(".add").prop("disabled", true);
			$(".add").addClass('add active-add-btn');
			$(".add").addClass('cart-quantity');
			 
        } else
        {
            $("#addquantity").val(addquantity);
			$(".add").addClass('add active-add-btn');
			$(".add").addClass('cart-quantity');

        }
        //alert(counter);
        //alert(id);
        //if (id == 1) {
        //alert(123);
        //$("#response").html('product quantity not much increase than original quantity');
        //$(".add").prop("disabled", true);
        //}

        //if ($(this).prev().val() < 100) {
        //$(this).prev().val(+$(this).prev().val() + 1);
        // }



        //if (addquantity<maxquantity) {
        //$("#response").html('product quantity not much increase than original quantity');
        //$(".add").prop("disabled", true);
        //}


    });
    $('.sub').click(function () {
         if($('.add').hasClass('active-add-btn')){
            $('.add').removeClass('active-add-btn');
        }
        $('.sub').addClass('active-add-btn');

        //alert(data);
        var addquantity = $("#addquantity").val();
        //alert(addquantity);
        if (parseInt(addquantity) > 1) {
            addquantity = parseInt(addquantity) - 1;

        }
        $("#addquantity").val(addquantity);
        $(".add").prop("disabled", false);
        $("#response").html('');
    });
</script>

<script>

    $(".input").focus(function () {
        $("#search").addClass("move");
    });
    $(".input").focusout(function () {
        $("#search").removeClass("move");
        $(".input").val("");
    });

    $(".search").click(function () {
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
<script>
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
</script>
<script>
    function CartFunction() {
        //alert(123);
        Swal.fire({
            icon: 'error',
            title: 'Please login, then you can add product in Cart.',
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>

</body>
</html>