<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/header'); ?>
    <link href="<?php echo base_url(); ?>assets/front/css/chat.css" rel="stylesheet">
</head>

<body>
    <?php $this->load->view('common/header_nav'); ?>
    <!--+++++++++++++ Header End +++++++++++++++++++-->
    <div class="clearfix"></div>
    <section id="my-account">
        <div class="custom-width">
            <div class="page-heading mb10">
                <h1>Order Details</h1>
            </div>



            <div class="my-account-inner">
                <div class="col-md-3">
                    <div class="artist-left-panel">
                        <?php $this->load->view('common/myaccount_side_panel'); ?>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="my-account-left-panel">
                        <button class="back-to-design-request orderback" onclick="location.href='<?= base_url('order-history') ?>';"><img src="<?= base_url('assets/front/images/back-arrow.png') ?>"> BACK
                        </button>
                        <div class="my-account-left-panel-sec1">
                            <h4>Order Information</h4>

                            <div class="my-account-left-panel-sec1-inner wishlisttable">
                                <div class="product-details-address">
                                    <!--<a class="downlode-invoice-btn" href="#">Downlode Invoice</a>-->
                                    <p>Order Number - <?= $order_master_data[0]['order_no'] ?></p>
                                    <p class="order-date">Order Date
                                        - <?= date('d-m-Y', strtotime($order_master_data[0]['create_date'])) ?></p>
                                    <a class="pdf-download-button" href="<?php echo base_url('order_details_invoice_download/'.$order_master_data[0]['id']) ?>" target="_blank">
                                        <button type="button" class="btn btn-danger">Download</button>
                                    </a>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="customarfiled">
                                                <h3>Customer Details</h3>
                                                <p><?= $customer_details[0]['first_name'].' '.$customer_details[0]['last_name'] ?></p>
                                                <p>Mobile Number - <?= $customer_details[0]['mobile'] ?></p>
                                                <a href="mailto:<?= $customer_details[0]['email'] ?>"><?= $customer_details[0]['email'] ?></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="customarfiled bnone">
                                                <h3>Billing Address</h3>

                                                <p><?= $billing_address[0]['name'] ?></p>
                                                <p>
                                                    <?= $billing_address[0]['address2'] ?>,
                                                    <?= $billing_address[0]['postcode'] ?>,
                                                    <?= $billing_address[0]['city'] ?>,
                                                    <?= $billing_address[0]['state_name'] ?>,
                                                    <?= $billing_address[0]['country_name'] ?>,
                                                    <?= $billing_address[0]['email'] ?>,
                                                    <?= $billing_address[0]['phone'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="wishlist-area">
                                    <div class="cart">
                                        <p style="display: inline-block;">Product List</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Product Name</th>
                                                        <th>SKU</th>
                                                        <th>Unit Price</th>
                                                        <th style="text-align: center;">Quantity</th>
                                                        <th style="text-align: center;">Status</th>
                                                        <th style="text-align: center;">Delivery Method</th>
                                                        <th style="text-align: center;">Delivery Date</th>
                                                        <th style="text-align: center;">Tax(<?= $order_master_data[0]['tax_percent'] + 0 ?>%)</th>
                                                        <th style="text-align: center;">Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                $canceled_amount = 0.00;
                                                $subval = 0.00;
                                                foreach ($order_transaction_data as $value) { 

                                                    
                                                    $subval = $subval + ($value['selling_price'] * $value['quantity']);
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo base_url();?>product_detail/<?php echo  digi_encode(($value['product_id'])); ?>"> <img src="<?= base_url('uploads/product/' . $value['image']) ?>" class="wishlistimg"></a>
                                                        </td>
                                                        <td><a style="color:black" href="<?php echo base_url();?>product_detail/<?php echo  digi_encode(($value['product_id'])); ?>"><?php echo  $value['name'];?></a><?php echo'<br>';?>
														<?php

                                                         foreach ($value['attributes_id'] as $key => $attr_value) {
                                                            $attr_items = getProductChildAttrName($value['product_id'],$attr_value['product_attribute_id']);
                                                            if(count($value['attributes_id']) == $key+1){
                                                                echo $attr_items[0]->child_attr_name;
                                                            }else{
                                                                 echo $attr_items[0]->child_attr_name.', ';
                                                            }
                                                        }
                                                         ?>

                                                        </td>
                                                        <td><?= $value['sku'] ?></td>
                                                        <td>SR <?= $value['selling_price'] + 0 ?></td>
                                                        <td style="text-align: center;"><?= $value['quantity'] ?></td>
                                                        <td style="text-align: center;">
                                                            <?php
                                                            if($value['cancel_status'] == 'YES'){
                                                                echo 'Cancelled';
                                                                $canceled_amount = $canceled_amount + ($value['selling_price'] * $value['quantity']);
                                                            }else{
                                                                echo ucwords(strtolower(urldecode($value['order_activity'])));
                                                            }
                                                            ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <?php if($value['cancel_status'] == 'YES'){ ?>
                                                            NA
                                                            <?php } else if(variable_value_check($value['pickup_address_id'])){ ?>
                                                            <a href="javascript:void(0);" data-id="<?= $value['pickup_address_id'] ?>" data-toggle="modal" data-delivery="PICKUP" data-target="#delivery_view" class="show_pick_up">
                                                                Pickup
                                                            </a>
                                                            <?php }else{ ?>
                                                            <a href="javascript:void(0);" data-id="<?= $value['delivery_address'] ?>" data-toggle="modal" data-delivery="DELIVERY" data-target="#delivery_view" class="show_pick_up">
                                                                Delivery
                                                            </a>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <?php if($value['cancel_status'] == 'YES'){ ?>
                                                            NA
                                                            <?php } else { echo (strtotime($value['delivery_date']) > 0) ? date('d-m-Y', strtotime($value['delivery_date'])) : '--'; } ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            SR <?= $value['product_total_amount']*($order_master_data[0]['tax_percent']/100) ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            SR <?= $value['product_total_amount'] + $value['product_total_amount']*($order_master_data[0]['tax_percent']/100) ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                        if($check_cancel_time && $value['is_cancellation'] == 'Y' && $value['cancel_status'] != 'YES'){ ?>

                                                            <a href="<?= base_url('order-product-cancel/'.$value['order_transaction_id']) ?>" class="add-to-cart wishlist-delete-btn">Cancel</a>

                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="9" align="right">Subtotal</td>
                                                        <td>SR <?= $subval + ($subval*$order_master_data[0]['tax_percent'])/100.00 ?></td>
                                                    </tr>
                                                    <?php if($canceled_amount > 1) { ?>
                                                    <tr>
                                                        <td colspan="9" align="right">Cancelled Amount</td>
                                                        <td>SR <?php echo $canceled_amount + ($canceled_amount*$order_master_data[0]['tax_percent'])/100.00 ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="9" align="right">Total Tax(<?php echo $order_master_data[0]['tax_percent'] +0?>%)</td>
                                                        <td>SR <?= $order_master_data[0]['tax_amount'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="9" align="right">Total</td>
                                                        <td>SR <?= $order_master_data[0]['order_amount'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




    </section>
    <div class="modal fade" id="delivery_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title delivery_method" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pickup_details_ajax"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/footer_js'); ?>
</body>

</html>
