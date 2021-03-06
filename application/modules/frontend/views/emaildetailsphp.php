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
            <button class="back-to-design-request orderback" onclick="location.href='<?= base_url('order-history') ?>';"><img src="<?= base_url('assets/front/images/back-arrow.png') ?>"> BACK
            </button>
            <div class="row">
                <div class="col-sm-9">
                    <div class="my-account-left-panel">
                        <div class="my-account-left-panel-sec1">
                            <h4>Email History</h4>
                            <div class="my-account-left-panel-sec1-inner wishlisttable">
                                <div class="product-details-address">
                                    <!--<a class="downlode-invoice-btn" href="#">Downlode Invoice</a>-->
                                    <p>Order Number - <?= $order_master_data[0]['order_no'] ?></p>
                                    <p>Order Date
                                        - <?= date('d-m-Y', strtotime($order_master_data[0]['create_date'])) ?></p>
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
                                        <p>Product List</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Product Name</th>
                                                    <th>SKU</th>
                                                    <th>Price</th>
                                                    <th style="text-align: center;">Quantity</th>
                                                    <th style="text-align: center;">Status</th>
                                                    <th style="text-align: center;">Delivery Method</th>
                                                    <th style="text-align: center;">Delivery Date</th>
                                                    <th style="text-align: center;">Total</th>
<!--                                                    <th>&nbsp;</th>-->
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($order_transaction_data as $value) { ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= base_url('uploads/product/' . $value['image']) ?>"
                                                                 width="100"/>
                                                        </td>
                                                        <td><?= $value['name'] ?></td>
                                                        <td><?= $value['sku'] ?></td>
                                                        <td>SR <?= $value['selling_price'] + 0 ?></td>
                                                        <td style="text-align: center;"><?= $value['quantity'] ?></td>
                                                        <td style="text-align: center;"><?= $value['order_activity'] ?></td>
                                                        <td style="text-align: center;">
                                                            <?php if(variable_value_check($value['pickup_address_id'])){ ?>
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
                                                            <?= (strtotime($value['delivery_date']) > 0) ? date('d-m-Y', strtotime($value['delivery_date'])) : '--' ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            SR <?= $value['product_total_amount'] + 0 ?>
                                                        </td>
<!--                                                        <td>-->
<!--                                                            <button class="add-to-cart wishlist-delete-btn">Cancel-->
<!--                                                            </button>-->
<!--                                                        </td>-->
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="8" align="right">Subtotal</td>
                                                    <td>SR <?= $order_master_data[0]['sub_total_amount'] + 0 ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8" align="right">Total</td>
                                                    <td>SR <?= $order_master_data[0]['order_amount'] + 0 ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="my-account-right-panel">
                        <?php $this->load->view('common/myaccount_side_panel'); ?>
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
