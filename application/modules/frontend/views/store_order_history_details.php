<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/header'); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

                <div class="my-account-inner">
                    <div class="col-md-3">
                        <div class="artist-left-panel">
                            <?php $this->load->view('common/myaccount_side_panel'); ?>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="my-account-left-panel">
                            <button class="back-to-design-request orderback" onclick="location.href='<?= base_url('store-order-history') ?>';"><img src="<?= base_url('assets/front/images/back-arrow.png') ?>"> BACK
                            </button>
                            <div class="my-account-left-panel-sec1">
                                <h4>Order Information</h4>
                                <div class="my-account-left-panel-sec1-inner wishlisttable">
                                    <div class="product-details-address">
                                        <!--<a class="downlode-invoice-btn" href="#">Downlode Invoice</a>-->
                                        <p>Order Number - <?= $order_master_data[0]['order_no'] ?></p>
                                        <p>Order Date
                                            - <?= date('d-m-Y', strtotime($order_master_data[0]['create_date'])) ?></p>
                                        <a class="pdf-download-button" href="<?php echo base_url('store_order_invoice_download/'.$order_transaction_data[0]['id']) ?>" target="_blank">
                                            <button type="button" class="btn btn-danger">INVOICE <i class="fa fa-download" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="customarfiled">
                                                    <h3>Customer Details</h3>
                                                    <p><?= $customer_details[0]['first_name'] . ' ' . $customer_details[0]['last_name'] ?></p>
                                                    <p>Mobile Number -<?= $customer_details[0]['dial_code'] ?> <?= $customer_details[0]['mobile'] ?></p>
                                                    <a href="mailto:<?= $customer_details[0]['email'] ?>"><?= $customer_details[0]['email'] ?></a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">

                                                <div class="customarfiled">
                                                    <?php if (variable_array_check($pick_up_address)) { ?>
                                                    <h3>Pickup Address</h3>
                                                    <p><?= $pick_up_address[0]['name'] ?></p>
                                                    <p>
                                                        <?= $pick_up_address[0]['address2'] ?>,
                                                        <?= $pick_up_address[0]['postcode'] ?>,
                                                        <?= $pick_up_address[0]['city'] ?>,
                                                        <?= $pick_up_address[0]['state_name'] ?>,
                                                        <?= $pick_up_address[0]['country_name'] ?>,
                                                        <?= $pick_up_address[0]['email'] ?>,
                                                        <?= $pick_up_address[0]['phone'] ?>
                                                    </p>
                                                    <?php } else { ?>
                                                    <h3>Delivery Address</h3>
                                                    <p><?= $shipping_address[0]['name'] ?></p>
                                                    <p>
                                                        <?= $shipping_address[0]['address2'] ?>,
                                                        <?= $shipping_address[0]['postcode'] ?>,
                                                        <?= $shipping_address[0]['city'] ?>,
                                                        <?= $shipping_address[0]['state_name'] ?>,
                                                        <?= $shipping_address[0]['country_name'] ?>,
                                                        <?= $shipping_address[0]['email'] ?>,
                                                        <?= $shipping_address[0]['std_code'] ?>
                                                        <?= $shipping_address[0]['phone'] ?>
                                                    </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
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
                                                        <?= $billing_address[0]['std_code'] ?>
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
                                                            <th>Unit Price</th>
                                                            <th style="text-align: center;">Quantity</th>
                                                            <th style="text-align: center;">Status</th>
                                                            <th style="text-align: center;">Delivery Date</th>
                                                            <th style="text-align: center;">Delivery Method</th>
                                                            <th style="text-align: center;">Net Amount
                                                                <!--Total(Without Tax)-->
                                                            </th>
                                                            <th style="text-align: center;">Tax(<?= $order_master_data[0]['tax_percent'] + 0 ?>%)</th>
                                                            <th style="text-align: center;">
                                                                <!--Total(With Tax)--->Total Amount </th>
                                                            <!--                                                    <th>&nbsp;</th>-->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($order_transaction_data as $value) { 
                                                            if($value['cancel_status'] == 'YES'){
                                                                $delivery_method =  'Not Available';
                                                            }
                                                            else if(variable_value_check($value['pickup_address_id'])){ 
                                                                $delivery_method =  'Pickup';
                                                            }
                                                            else{ 
                                                                $delivery_method =  'Delivery';
                                                            }

                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo base_url();?>product_detail/<?php echo  digi_encode(($value['product_id'])); ?>"> <img src="<?= base_url('uploads/product/' . $value['image']) ?>" class="wishlistimg" /></a>
                                                            </td>
                                                            <td><a style="color:black" href="<?php echo base_url();?>product_detail/<?php echo digi_encode(($value['product_id'])); ?>">
                                                                    <?php echo $value['name'] ;
echo '<span>';

foreach ($value['attributes_id'] as $key => $attr_value) {
$attr_items = getProductChildAttrName($value['product_id'],$attr_value['product_attribute_id']);
if(count($value['attributes_id']) == $key+1){
echo $attr_items[0]->child_attr_name;
}else{
echo "<br>".$attr_items[0]->child_attr_name.', ';
}
}
echo '</span>';

?>
                                                                </a>
                                                            </td>
                                                            <td><?= $value['sku'] ?></td>
                                                            <td>SR <?= $value['selling_price'] + 0 ?></td>
                                                            <td style="text-align: center;"><?= $value['quantity'] ?></td>
                                                            <td style="text-align: center;">
                                                                <?php if($value['cancel_status'] == 'YES'){ ?>
                                                                Canceled
                                                                <?php }else{ ?>
                                                                <select name="order_activity" class="form-control product_order_activity" data-transaction-id="<?= $value['id'] ?>">
                                                                    <option value="">Please Select</option>
                                                                    <?php foreach ($product_status as $row) { 
                                                                        if(variable_value_check($value['pickup_address_id'])){
                                                                            if($row['id'] == 7 or $row['id'] == 8){
                                                                            //ORDER GENERATED, PickUp Show Only  
																			
                                                                    ?>
                                                                    <option value="<?= ucwords(strtolower($row['name'])) ?>" <?= ucwords(strtolower(urldecode($row['name']))) == ucwords(strtolower(urldecode($value['order_activity'])))? 'selected' : '' ?> <?= (empty($value['delivery_date']) || (strtotime($value['delivery_date']) < 0)) ? 'disabled' : '' ?>><?= (ucwords(strtolower($row['name']))) ?></option>

                                                                    <?php }}else{
                                                                        if($row['id'] == 8){  //PickUp Not Show
                                                                            continue;
                                                                        }
                                                                    ?>
                                                                    <option value="<?= ucwords(strtolower($row['name'])) ?>" <?= ucwords(strtolower(urldecode($row['name']))) == ucwords(strtolower(urldecode($value['order_activity']))) ? 'selected' : '' ?> <?= (empty($value['delivery_date']) || (strtotime($value['delivery_date']) < 0)) ? 'disabled' : '' ?>><?= ucwords(strtolower($row['name'])) ?></option>
                                                                    <?php  }} ?>
                                                                </select>
                                                                <?php } ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php if($value['cancel_status'] == 'YES'){ ?>
                                                                Not Available
                                                                <?php }else{ ?>
                                                                <input type="text" data-transaction-id="<?= $value['id'] ?>" class="form-control ui_datepicker expected_delivery_date" name="delivery_date" value="<?= (strtotime($value['delivery_date']) > 0) ? $value['delivery_date'] : '' ?>">
                                                                <?php } ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php if($value['cancel_status'] == 'YES'){ ?>
                                                                Not Available
                                                                <?php }else if(variable_value_check($value['pickup_address_id'])){ ?>
                                                                Pickup
                                                                <?php }else{ ?>
                                                                Delivery
                                                                <?php } ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                SR <?= $value['product_total_amount'] + 0 ?></td>
                                                            <td style="text-align: center;">
                                                                SR <?= $value['product_total_amount']*($order_master_data[0]['tax_percent']/100) ?></td>
                                                            <td style="text-align: center;">
                                                                SR <?= $value['product_total_amount'] + $value['product_total_amount']*($order_master_data[0]['tax_percent']/100) ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
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
                    <h5 class="modal-title" id="exampleModalLabel">Pickup Address</h5>
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
