<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/header'); ?>
    <style>
        #artist,
        #member,
        #member_by_role,
        #virtual_studio_sec,
        #products_types,
        #design_store,
        #servicesec {
            display: none;
        }

        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>

<body>
    <?php $this->load->view('common/header_nav'); ?>


    <section id="my-cart">
        <div class="custom-width">
            <div class="page-heading">
                <h1>Cart</h1>
            </div>

            <?php if (count($query) > 0) { ?>
            <div class="cart">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        if (count($query) > 0) {
                            $sub_tot = floatval(0);
                            $tot = floatval(0);
                            foreach ($query as $key_val=>$row) {
                                ?>
                            <input type="hidden" name="p_id[]" value="<?php echo $row->p_id; ?>" />
                            <input type="hidden" name="varient[]" value='<?php echo $row->cart_attr; ?>' />
                            <input type="hidden" name="cart_id[]" value="<?php echo @($row->cart_id) ? $row->cart_id : 0; ?>" />
                            <tr>
                                <td><a href="<?php echo base_url();?>product_detail/<?php echo digi_encode($row->p_id); ?>"><img height="100px" src="<?php echo base_url(); ?>uploads/product/<?php echo $row->image; ?>" /></a>
                                </td>
                                <td><a style="color:black" href="<?php echo base_url();?>product_detail/<?php echo digi_encode($row->p_id); ?>"><?php echo $row->name; ?></a><br>
                                    <?php 
                                            foreach (json_decode($row->cart_attr) as $key=> $attr_val) {
                                               $attr_items = getProductChildAttrName($row->p_id,$attr_val);
                                               if(count(json_decode($row->cart_attr)) == $key+1){
                                                    echo $attr_items[0]->child_attr_name;
                                                }else{
                                                     echo $attr_items[0]->child_attr_name.', ';
                                                }
                                            }
                                        ?>

                                </td>
                                <td><a style="color:black" href="<?php echo base_url();?>product_detail/<?php echo digi_encode($row->p_id); ?>"><?php echo $row->sku; ?></a></td>
                                <td>

                                   

                                    <?php if ($share_cart_status == FALSE && @$row->block_status == $block_status) { ?>
                                    <div class="product-quantity">
                                        <input data-min="1" data-max="0" type="text" id="quantity_<?php echo $key_val+1; ?>" name="quantity[]" value="<?php echo $row->cart_qty; ?>" readonly>
										

                                        <div class="quantity-selectors-container">
                                            <div class="quantity-selectors">
											

                                                <button type="button" class="increment-quantity" data-id2="<?php echo $row->qty;?>" data-id="<?php echo $key_val+1; ?>" aria-label="Add one" data-direction="1"><span>&#43;</span></button>
												
                                                <button type="button" class="decrement-quantity" data-id2="<?php echo $row->qty;?>" data-id="<?php echo $key_val+1; ?>" aria-label="Subtract one" data-direction="-1" <?php if (floatval($row->cart_qty) <= 1) { ?> disabled="disabled" <?php } ?>>
                                                    <span>&#8722;</span></button>
													
 
                                            </div>
                                        </div>
									<span id="response_<?php echo $key_val+1;?>" style="color:red" style="width:1px"></span>
                                    </div>
                                    <span id="response_<?php echo $row->p_id; ?>" style="color: red"></span>
                                    <div class="refresh-delete-btn-area">
                                        <button class="refresh-btn" onclick='updateCart(<?php echo $key_val+1; ?>,<?php echo $row->p_id;?>,<?php echo $row->cart_attr;?>);' data-id="<?php echo $row->p_id; ?>"><img src="<?php echo base_url(); ?>assets/front/images/refresh-btn.png" />
                                        </button>
                                        <button class="delete-btn" onclick='deleteCart(<?php echo $row->p_id; ?>, <? echo $row->cart_attr; ?>);'>
                                            <img src="<?php echo base_url(); ?>assets/front/images/delete-btn.png" />
                                        </button>
                                    </div>
                                    <?php } else { ?>
                                    <?php if ($share_cart_status != 1 ) { ?>   
                                    <div class="product-quantity">
                                        <input data-min="1" data-max="0" type="text" id="quantity_<?php echo $key_val+1; ?>" name="quantity[]" value="<?php echo $row->cart_qty; ?>" readonly>
                                        <div class="quantity-selectors-container">
                                            <div class="quantity-selectors">
                                                <button type="button" class="increment-quantity" data-id2="<?php echo $row->qty;?>" data-id="<?php echo $key_val+1; ?>" aria-label="Add one" data-direction="1"><span>&#43;</span></button>
                                                <button type="button" class="decrement-quantity" data-id2="<?php echo $row->qty;?>" data-id="<?php echo $key_val+1; ?>" aria-label="Subtract one" data-direction="-1" <?php if (floatval($row->cart_qty) <= 1) { ?> disabled="disabled" <?php } ?>>
                                                    <span>&#8722;</span></button>

                                            </div>

                                        </div>

                                    </div>
                                    <span id="response_<?php echo $row->p_id; ?>" style="color: red"></span>
                                    <div class="refresh-delete-btn-area">
                                        <button class="refresh-btn" onclick='updateCart(<?php echo $key_val+1; ?>,<?php echo $row->p_id;?>,<?php echo $row->cart_attr;?>);' data-id="<?php echo $row->p_id; ?>"><img src="<?php echo base_url(); ?>assets/front/images/refresh-btn.png" />
                                        </button>
                                        <button class="delete-btn" onclick='deleteCart(<?php echo $row->p_id; ?>, <? echo $row->cart_attr; ?>);'>
                                            <img src="<?php echo base_url(); ?>assets/front/images/delete-btn.png" />
                                        </button>
                                    </div>
                                    <?php }else{ ?>
                                    <!-- designer share cart then cart page only show qty  S.Paul  09-03-2021-->
                                        <div class="product-quantity">
                                        <input data-min="1" data-max="0" type="text" id="quantity_<?php echo $key_val+1; ?>" name="quantity[]" value="<?php echo $row->cart_qty; ?>" readonly>
                                    </div>
                                    <?php }  ?>

                                    <?php } ?>
                                <td>SR <?php echo $row->sell_price; ?></td>
                                <td>SR <?php echo floatval($row->sell_price * $row->cart_qty); ?></td>
                            </tr>

                            <?php
                                $sub_tot += floatval($row->sell_price * $row->cart_qty);
                                $tot += floatval($row->sell_price * $row->cart_qty);
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="">No Product Found</td>

                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="cart-table-below-area">
                <?php if ($design_conversation_status == TRUE) { ?>
                <h4>What would you like to do next?</h4>
               <!--<button class="back-to-design-request left_position onclick_show">
                     <span>Create cart link to share customer</span><i class="fa fa-link" aria-hidden="true"></i>
                    </button>-->
                <div class="tooltip left_position onclick_show"><a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                    <span class="tooltiptext">Create cart link to share customer</span>
                </div>
             
                <div class="cart_link customize_link" style="display: none;">
                    <?= base_url('share-cart-link/' . $design_order_id) ?>
                </div>
                <?php }
                if ($this->session->userdata('USER_TYPE') == '4') { ?>
                <span id="msg_box">
                    <?php if ($this->session->flashdata('coupon_error') != '') { ?>
                    <?php echo $this->session->flashdata('coupon_error'); ?>
                    <?php } ?>
                </span>
                <span id="msg_box">
                    <?php if ($this->session->flashdata('coupon_success') != '') { ?>
                    <?php echo $this->session->flashdata('coupon_success'); ?>
                    <?php } ?>
                </span>
                <p style="text-align: center;"><?php if ($share_cart_product_has_order == 1){ echo "This product already purchased"; }?></p>
                    <?php if ($share_cart_product_has_order != 1){ ?>
                    <form action="" method="post">
                        <div class="row code-sec">
                            <div class="col-md-5">
                                <input type="text" name="design_code" value="<?= (isset($design_code)) ? $design_code : '' ?>" class="form-control" placeholder="Have a designer code ?" required>
                                <button class="save form_submit">Apply Code</button>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                <?php } ?>
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-7">
                        <div class="cart-table-below-area-right">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td>SR <?php echo $sub_tot; ?></td>
                                        </tr>
                                        
                                        <?php if ($design_conversation_status == 1) { ?>
                                            <td class="borderbnone">
                                                 <a href="<?php echo base_url('products'); ?>" class="continue-shopping-btn">Add Products Here </a>
                                            </td>
                                            
                                         <?php }else{ ?>
                                            <?php if ($share_cart_status != 1 ) { ?>
                                            <td class="borderbnone">
                                                <a href="<?php echo base_url(); ?>" class="continue-shopping-btn">Continue 
                                                    Shopping</a>
                                            </td>
                                             <?php } ?>


                                           <?php if($_SESSION['USER_ID']!=''){?>
                                            <td class="borderbnone">
                                                <a href="<?php echo  base_url('checkouts'); ?>" class="continue-shopping-btn checkout-btn">PROCEED TO CHECKOUT</a>
                                            </td>
											<?php
										}?>
                                           
                                        <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { ?>

            <div class="cart-table-below-area empty-cart">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="cart-empty">
                            <img src="<?= base_url('uploads/empty-cart.png') ?>" />
                            <h5> Your cart is empty.</h5>
                       <a href="<?php echo base_url(); ?>" class="continue-shopping-btn">Continue Shopping</a>
                       
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </section>

    <div class="clearfix"></div>

    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/footer_js'); ?>


    <script>
        $(document).on('click', '.increment-quantity,.decrement-quantity', function() {
            var id2 = $(this).attr('data-id2');
            //alert(id2);

            var id = $(this).attr('data-id');
            var currentQty = $('#quantity_' + id).val();
            //alert(currentQty);
            //alert(id);
            //alert(currentQty);
            var qtyDirection = $(this).data("direction");
            //alert(qtyDirection);




            if (qtyDirection == "1") {
                var id = $(this).attr('data-id');
                //alert(id);
                var id2 = $(this).attr('data-id2');

                var currentQty = $('#quantity_' + id).val();

                var currentQty = parseInt(currentQty) + 1;

                //alert(currentQty);
                if (currentQty > id2) {

                    $("#response_" + id).html("Sorry! We don't have any more unites for this items");
                    $(".increment-quantity_" + id).prop("disabled", true);
                    //$(".decrement-quantity").prop("disabled", false);
                }
                //alert(newQty);
                else {
                    $('#quantity_' + id).val(currentQty);
                }

            } else if (qtyDirection == "-1") {
                var id = $(this).attr('data-id');
                //alert(id);

                var currentQty = $('#quantity_' + id).val();
                if (parseInt(currentQty) > 1) {
                    newQty = parseInt(currentQty) - 1;
                    //alert(newQty);
                    $('#quantity_' + id).val(newQty);
                    $("#response_" + id).html('');

                    $(".increment-quantity_" + id).prop("disabled", true);

                } else {

                    $("#response_" + id).html('');
                    $(".decrement-quantity").prop("disabled", true);
                    $(".increment-quantity").prop("disabled", false);
                }
            }





        });

    </script>
</body>

</html>
