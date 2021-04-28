
<!-- <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> -->
 
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>         -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>   -->
<div class="product-details-page-inner">

<div class="model_loading" style="display: none;"></div>

    <div class="row">
        <div class="col-sm-5">
          
             <div class="product-details-img-area product-details-modal-img-area">
                               
                                 <?php 
                                    $extra_images = json_decode($query['extra_images']);
                                    if(empty($extra_images)){
                                        $extra_images = array();
                                    }
                                    $images = array($query['image']);
                                    $marge_image = array_merge($images,$extra_images) ;
                                    
                                ?>

                                <div class="slider-for">


                                    <?php for ($i = 0; $i < count($marge_image); $i++) { ?>
                                    <div class="item">
                                        <a href="javascript:void(0);">
                                            <img src="<?php echo base_url('uploads/product/'.$marge_image[$i]);?>"/>
                                        </a>  
                                    </div>
                                     <?php } ?>

                                   
                                </div>
                                <div class="slider-nav">

                                    <?php for ($i = 0; $i < count($marge_image); $i++) { ?>
                                       <div class="item active-slider-nav">
                                           <a href="javascript:void(0);">
                                                <img class="product_details_slider" src="<?php echo base_url(); ?>uploads/product/<?php echo $marge_image[$i]; ?>">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
        </div>
        <div class="col-sm-7">
            
            <div class="product-details-right-text product-details-modal-right-text">
                <h3><?php echo $query['name']; ?></h3>
                <h5>SR <?php echo $query['sell_price']; ?></h5>
                <p> <?php echo $query['details']; ?></p>
                <ul>
                    <?php
                    $extra_desc = explode(',', $query['extra_desc']);
                    foreach ($extra_desc as $key => $row) {
                        echo '<li>' . $row . '</li>';
                    }
                    ?>

                </ul>
                <p class="sku"><span>SKU:</span><?php echo $query['sku']; ?></p>
                <p class="sku"><span>Category:</span><?php echo $query['cat_name']; ?></p>
                <form id="addCartFrom_<?php echo $query['p_id']; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="p_id" value="<?php echo $query['p_id']; ?>" />
                    <input type="hidden" name="stock" value="<?php echo $query['stock']; ?>" />
                    <input type="hidden" name="action" value="product_details_model" />
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
                        <select class="attrpro" required="" name="attrpro[]">
                            <!-- <option value="">Select <?php echo $row[0]->p_attr_name; ?></option> -->
                            <?php foreach ($row as $r2) { ?>
                                <option value="<?php echo $r2->attr_id; ?>"><?php echo $r2->child_attr_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>
                    
                    <!--<img src="images/wooden.jpg">-->


                    <div class="qntatra">
                        <label>Quantity:</label>

                         <div id="field1">
                                     <button type="button" id="subquantity" class="sub" value="<?php echo $query['qty'];?>"<?php if (floatval($query['qty']) <= 1) { ?> disabled="disabled" <?php }?> >-</button>
 <input type="hidden" name="qty" id="maxquantity" value="<?php echo $query['qty']; ?>">
                                    <input type="number" id="addquantity" name="qty" value="1" min="1" >
                                            <button type="button" onclick="add()" class="add active-add-btn" value="<?php echo $query['qty'];?>">+</button>
											<span id="response" style="color: red"></span>
                                  
                                   
                                    <span id="response" style="color: red"></span>
                                </div>


                    </div>
                </div>
                <div class="addtocare-btn-area">
                    <?php // if (floatval($query['qty'] >= 1)) { ?>
                    <button type="button" class="addtocare-btn" <?php echo floatval($query['qty'] < 1)? "disabled" : 'onclick="addToCart(' .$query['p_id'].');"' ?> > <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
                    
                    <a href="javascript:void(0);" class="add-wishlist wishlist_functionality"
                           id="<?php echo $query['p_id']; ?>/<?php echo $user_id; ?>"
                           data-userid="<?php echo $user_id; ?>" data-Pid="<?php echo $query['p_id']; ?>">
                            <?php if($wishlist_count->num_rows() > 0){ ?>
                                <span class="content_change content_change_<?php echo $query['p_id']; ?>">
                                    <i class="fa fa-heart" style="color: #ff474e;"></i> </span>
                               
                                <span class="text_change wishlisremove wishlist-active"><strong>Remove from wishlist</strong></span>
                            <?php }else{ ?>
                                <span class="content_change content_change_<?php echo $query['p_id']; ?>">
                                    <i class="fa fa-heart-o"></i></span>
                                
                                <span class="text_change"><strong>Add to Wishlist</strong></span> 
                            <?php } ?>
                        </a>
                        
                </div>
               
                
                <div class="stokin">
                    <?php if (floatval($query['qty'] >= 1)) { ?>
                        <h6>In stock.</h6>
                    <?php } else { ?>
                        <h6 style="color: red">Out of stock.</h6>
                    <?php } ?>
                    <p><strong>Sold by:</strong> <?php echo $query['user_first_name']; ?> <?php echo $query['user_last_name']; ?></p>
                </div>


            </div>

        </div>
    </div>


</div>

<script>
 $(function() {
  if ($('.slider div').length == 1) {
      $('.slider div').clone().appendTo('.slider');
  }
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
      infinite:true,
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
    
  ]
    });
});


    $('.add').click(function () {
        
        if($('.sub').hasClass('active-add-btn')){
            $('.sub').removeClass('active-add-btn');
        }
        $('.add').addClass('active-add-btn');
       // var id = $(this).val();
        var maxquantity =$("#maxquantity").val();
        var addquantity =$("#addquantity").val();
        //alert(maxquantity);
        //alert(addquantity);
        addquantity = parseInt(addquantity)+1;
        //alert(addquantity);
        if(addquantity> maxquantity){
        

            $("#response").html("Sorry! We don't have any more unites for this items");
            $(".add").prop("disabled", true);
            $(".add").addClass('add active-add-btn');
            $(".add").addClass('cart-quantity');

        }
        else
        {
            $("#addquantity").val(addquantity);
            $(".add").addClass('add active-add-btn');
            $(".add").addClass('cart-quantity');

        }
       

    });
    $('.sub').click(function () {
        
        if($('.add').hasClass('active-add-btn')){
            $('.add').removeClass('active-add-btn');
        }
        $('.sub').addClass('active-add-btn');

       var addquantity =$("#addquantity").val();
       //alert(addquantity);
       if( parseInt(addquantity)>1){
        addquantity = parseInt(addquantity)-1;

       }
       $("#addquantity").val(addquantity);
        $(".add").prop("disabled", false);
        $("#response").html('');
    });
</script>




<!-- <script src="<?php //echo base_url(); ?>assets/front/product-details/zoom-image.js"></script>
<script src="<?php echo base_url(); ?>assets/front/product-details/main.js"></script>
 -->

 <style type="text/css">
     .product-details-img-area .slick-current a .product_details_slider{
        border: 1px solid #ff474e
     }
     
    .model_loading {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(<?php echo base_url('assets/front/images/loding_img.gif') ?>) 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
    }
 </style>



<?php $this->load->view('common/footer_js'); ?>
