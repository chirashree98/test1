<link href="<?php echo base_url(); ?>assets/front/product-details/main.css" rel="stylesheet">
  
 <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<?php
//print_r($query);
//print_r($_SESSION['cart_item']);
?>
<div class="product-details-page-inner">
    <div class="row">
        <div class="col-sm-5">
            <div class="product-details-img-area">


                <div class="show" href="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>" style="position: relative;">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>" id="show-img" style="width: 100%; height: 100%;">
                     <?php for ($i = 0; $i < count($extra_images); $i++) { ?>
                                    <div style="position: absolute; left: 321.281px; top: 74px; background-color: rgb(0, 0, 0); width: 100px; height: 100px; opacity: 0.2; border: 1px solid rgb(204, 204, 204); cursor: crosshair; display: none;"></div>
									
                                    <div style="position: absolute; overflow: hidden; left: 509px; top: 0px; width: 500px; height: 500px; display: none;">
                                        <img src="<?php echo base_url(); ?>uploads/product/<?php echo $extra_images[$i]; ?>" id="big-img"
                                             style="position: absolute; left: -1606.41px; top: -370px; width: 2520px; height: 2030px;">
											 
                                    </div>
									<?php 
										 }?></div>
                <div class="small-img">
                    <div class="small-container">
                        <div id="small-img-roll">
                            <?php
                            $extra_images = json_decode($query['extra_images']);

                            for ($i = 0; $i < count($extra_images); $i++) {
                                ?>
                                <img src="<?php echo base_url(); ?>uploads/product/<?php echo $extra_images[$i]; ?>" class="show-small-img" alt="">
                                <?php
                            }
                            ?>



                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-7">
            
            <div class="product-details-right-text">
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
                        <select class="" required="" name="attrpro[]">
                            <option value="">Select <?php echo $row[0]->p_attr_name; ?></option>
                            <?php foreach ($row as $r2) { ?>
                                <option value="<?php echo $r2->attr_id; ?>"><?php echo $r2->child_attr_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>
                    
                    <!--<img src="images/wooden.jpg">-->


                    <div class="qntatra">
                        <label>Quantityy:</label>

                         <div id="field1">
                                     <button type="button" id="subquantity" class="sub" value="<?php echo $query['qty'];?>"<?php if (floatval($query['qty']) <= 1) { ?> disabled="disabled" <?php } ?>>-</button>

                                    <input type="number" id="addquantity" name="qty" value="1" min="1" >
                                            <button type="button" onclick="add()" class="add" value="<?php echo $query['qty'];?>">+</button></br></br>
											<span id="response" style="color: red"></span>
                                    </button>
                                    </br></br>
                                    <span id="response" style="color: red"></span>
                                </div>


                    </div>
                </div>
                <div class="addtocare-btn-area">
                    <button type="button" onclick="addToCart(<?php echo $query['p_id']; ?>);" class="addtocare-btn"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
                    <a href="javascript:void(0);" class="add-wishlist wishlist_functionality"
                           id="<?php echo $query['p_id']; ?>/<?php echo $user_id; ?>">
                            <?php if($wishlist_count->num_rows() > 0){ ?>
                                <span class="content_change content_change_<?php echo $query['p_id']; ?>">
                                    <i class="fa fa-heart" style="color: #ff474e;"></i> </span>
                               
                                <span class="text_change"><strong>Remove from wishlist</strong></span>
                            <?php }else{ ?>
                                <span class="content_change content_change_<?php echo $query['p_id']; ?>">
                                    <i class="fa fa-heart-o"></i></span>
                                
                                <span class="text_change"><strong>Add to Wishlist</strong></span> 
                            <?php } ?>
                        </a>
                        
                </div>
               
                
                <div class="stokin">
                    <h6><?php echo floatval($query['qty'])>0?'In stock .':'Out of stock'; ?></h6>
                    <p><strong>Sold by:</strong> <?php echo $query['user_first_name']; ?> <?php echo $query['user_last_name']; ?></p>
                </div>


            </div>

        </div>
    </div>


</div>



<script src="<?php echo base_url(); ?>assets/front/product-details/zoom-image.js"></script>
<script src="<?php echo base_url(); ?>assets/front/product-details/main.js"></script>
<script>
    


    $('.add').click(function () {
		alerT(123);
       // var id = $(this).val();
		var maxquantity =$("#maxquantity").val();
		var addquantity =$("#addquantity").val();
		alert(maxquantity);
		//alert(addquantity);
		addquantity = parseInt(addquantity)+1;
		//alert(addquantity);
		if(addquantity> maxquantity){
		 $("#response").html('product quantity not much increase than original quantity');
            $(".add").prop("disabled", true);
		}
		else
		{
			$("#addquantity").val(addquantity);

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
		
		//alert(data);
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




<?php $this->load->view('common/footer_js'); ?>








<!--<h3> <?php //print_r($query);
                    ?>
    <form class="" action="<?php echo base_url('cart'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $query['p_id']; ?>" class="p_id">
        <input type="hidden" name="name" value="<?php echo $query['name']; ?>" class="pname">
        <input type="hidden" name="price" value="<?php echo $query['sell_price']; ?>" class="price">
        <input type="hidden" name="image" value="<?php echo $query['image']; ?>" class="image">
       
         <div><img src="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>" id="artist-img" width="687px;" height="742px;"> </div>
<?php
// $extra_images = json_decode($query['extra_images']);
// for ($i = 0; $i < count($extra_images); $i++) { 
?>
       <div> <img src="<?php echo base_url(); ?>uploads/product/<?php echo $extra_images[$i]; ?>" id="artist-img" width="100px;" height="150px;"> </div>
<?php
// }
?>
        <p id="product-name"><?php echo $query['name']; ?></p>
        <p id="product-price">SR <?php echo $query['sell_price']; ?></p>
        <p id="product-attribute">

<?php
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
                            <label> <?php echo $row[0]->p_attr_name; ?></label>
                            <select class="" required="" name="attrpro[]">
                                <option value="">Select <?php echo $row[0]->p_attr_name; ?></option>
    <?php foreach ($row as $r2) { ?>
                                                <option value="<?php echo $r2->attr_id; ?>"><?php echo $r2->child_attr_name; ?></option>
    <?php } ?>
                            </select>
<?php } ?>
        </p>
        <input class="modal-btn" name="action" type="submit" value="Add to Cart" />
        <button type="button" class="modal-btn" data-dismiss="modal">Close</button>
    </form>
</h3>



<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">   
<link href="<?php echo base_url(); ?>assets/front/product-details/main.css" rel="stylesheet">

<?php //print_r($query);  ?>

 <form class="" action="<?php echo base_url('cart'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $query['p_id']; ?>" class="p_id">
        <input type="hidden" name="name" value="<?php echo $query['name']; ?>" class="pname">
        <input type="hidden" name="price" value="<?php echo $query['sell_price']; ?>" class="price">
        <input type="hidden" name="image" value="<?php echo $query['image']; ?>" class="image">
       

<div class="product-details-page-inner">
        <div class="row">
           <div class="col-sm-5">
            <div class="product-details-img-area">
         
 
  <div class="show" href="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>">
    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>" id="show-img">
  </div>
  <div class="small-img">
    <img src="<?php echo base_url(); ?>assets/front/images/online_icon_right@2x.png" class="icon-left" alt="" id="prev-img">
    <div class="small-container">
      <div id="small-img-roll">
<?php
$extra_images = json_decode($query['extra_images']);

for ($i = 0; $i < count($extra_images); $i++) {
    ?>
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $extra_images[$i]; ?>" class="show-small-img" alt="">
    <?php
}
?>

        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
           <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">
        <img src="http://206.189.36.119/DesignStudio/dev/uploads/product/1601028210_product_main_image.jpg" class="show-small-img" alt="">

      </div>
    </div>
  
  </div>

               </div>
            </div>
            <div class="col-sm-7">
            <div class="product-details-right-text">
                <h3><?php echo $query['name']; ?></h3>
                <h5>SR <?php echo $query['sell_price']; ?></h5>
                <p><?php echo $query['details']; ?></p><br>
                 <p><?php echo $query['extra_desc']; ?></p>
              
                <ul>
                    <li>Cotton blend</li>
                    <li>Straight fit</li>
                    <li>Dry clean</li>
                </ul>
                <p class="sku"><span>SKU:</span>022</p>
                <p class="sku"><span>Category:</span>Furniture</p>
                <div class="form-group">
<?php
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
                            <label> <?php echo $row[0]->p_attr_name; ?></label>
                            <select class="" required="" name="attrpro[]">
                                <option value="">Select <?php echo $row[0]->p_attr_name; ?></option>
    <?php foreach ($row as $r2) { ?>
                                                <option value="<?php echo $r2->attr_id; ?>"><?php echo $r2->child_attr_name; ?></option>
    <?php } ?>
                            </select>
<?php } ?>
                    <img src="http://206.189.36.119/DesignStudio/dev/assets/front/images/wooden.jpg"/>
                      
                    
                    <div class="qntatra">
                    <label>Quantity:</label>
                        
                       <div id="field1">
    <button type="button" id="sub" class="sub">-</button>
    <input type="number" name="qty" id="1" value="1" min="1" max="100" />
    <button type="button" id="add" class="add">+</button>
</div> 

                    </div>
                     </div>
                    <div class="addtocare-btn-area">
                     <input class="addtocare-btn" name="action" type="submit" value="Add to Cart" />
                    <button class="addtocare-btn"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
                        <p><a href="#"><img src="http://206.189.36.119/DesignStudio/dev/assets/front/images/wishlist-icon.png"/></a> Add to Wishlist</p>
                    </div>
                    <div class="stokin">
                    <h6>In stock.</h6>
                   <p><strong>Sold by:</strong> ABC Seller</p>
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
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                        </p>
                                                        
                                                </div>
                                                <div class="tab-pane" id="tab_default_2">
                                                        
                                                        <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                        </p>
                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                        </p>
                                                        
                                                </div>
                                                
                                        </div>
                                </div>
                        </div>
                </div>   
           
    
           
           
           
           
           
           
           
        </div>

</form>








 <script>
    $('.add').click(function () {
                if ($(this).prev().val() < 100) {
        $(this).prev().val(+$(this).prev().val() + 1);
                }
});
$('.sub').click(function () {
                if ($(this).next().val() > 1) {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
                }
});
    </script>
<script src="<?php echo base_url(); ?>assets/front/product-details/zoom-image.js"></script>
<script src="<?php echo base_url(); ?>assets/front/product-details/main.js"></script>


-->





