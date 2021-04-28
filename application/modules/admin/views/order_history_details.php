<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <?php $this->load->view('common/header_include'); ?>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <div class="page-wrapper">
            <?php $this->load->view('common/header'); ?>
            <div class="clearfix"></div>
            <div class="page-container">
                <?php $this->load->view('common/sidebar'); ?>
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li><a href="">Dashboard</a> <i class="fa fa-circle"></i></li>
                                <li><span> Customer Orders</span></li>
                            </ul>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">        
                                <div class="page-content bill-page-content-info">

                                    <div class="design-requst-inner">
                                        <!--
									 <p>Order Number - <?= $order_master_data[0]['order_no'] ?></p>
                                        <p>Order Date
                                            - <?= date('d-m-Y', strtotime($order_master_data[0]['create_date'])) ?></p>
                                        <h4>Billing Address Details</h4>
                                        <div class="design-requst-inner-sub">
                                            <div class="request-details-page-inner">
                                                <p><b>Name :</b>
                                                    <span><?= $billing_address[0]['name'] ?></span>
                                                </p>
                                                <p><b>Address :</b>
                                                    <span><?= $billing_address[0]['address2'] ?></span>
                                                </p>
                                                <p><b>Postcode :</b>
                                                    <span><?= $billing_address[0]['postcode'] ?></span>
                                                </p>
                                                <p><b>City :</b>
                                                    <span><?= $billing_address[0]['city'] ?></span>
                                                </p>
                                                <p><b>State :</b>
                                                    <span><?= $billing_address[0]['state_name'] ?></span>
                                                </p>
                                                <p><b>Country :</b>
                                                    <span><?= $billing_address[0]['country_name'] ?></span>
                                                </p>
                                                <p><b>Email :</b>
                                                    <span><?= $billing_address[0]['email'] ?></span>
                                                </p>
                                                <p><b>Phone :</b>
                                                    <span><?= $billing_address[0]['phone'] ?></span>
                                                </p>
                                            </div>
                                        </div>-->
                                        <div class="product-details-address">
                                    <!--<a class="downlode-invoice-btn" href="#">Downlode Invoice</a>-->
                                    <p><span class="item-bold-text">Order Number -</span> <?= $order_master_data[0]['order_no'] ?>
                                     <a class="pdf-download-button" style="float:right;" href="<?php echo base_url('admin/order_order_invoice_download/'.$order_master_data[0]['id']) ?>" target="_blank">
                                        <button type="button" class="btn btn-danger">Invoice 
                                            <i class="fa fa-download" aria-hidden="true"></i></button>
                                    </a>

                                    </p>
                                            <p class="order-date"><span class="item-bold-text">Order Date</span>
                                        - <?= date('d-m-Y', strtotime($order_master_data[0]['create_date'])) ?></p>

                                       
                                
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="customarfiled">
                                                <h3>Customer Details</h3>
                                                <p><?= $customer_details[0]['first_name'] . ' ' . $customer_details[0]['last_name'] ?></p>
                                                <p>Mobile Number -<?= $customer_details[0]['dial_code'] ?>  <?= $customer_details[0]['mobile'] ?></p>
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
													<?= $billing_address[0]['std_code'] ?>
                                                    <?= $billing_address[0]['phone'] ?>                                             </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
										
									
                                    <div class="cart" id="show_hide">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet light portlet-fit portlet-form bordered">
                                                    <div class="portlet-body">
                                                        <h3 class="text-center">Order Details</h3>
                                                        <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Image</th>
                                                                    <th scope="col">Product Name</th>
                                                                    <th scope="col">SKU</th>
                                                                    <th scope="col">Unit Price</th>
                                                                    <th scope="col">Quantity</th>
                                                                    <th scope="col">Status</th>
                                                                    <th scope="col">Delivery Date</th>
                                                                    <th scope="col">Delivery Method</th>
                                                                    <th scope="col">Tax(<?php echo $order_master_data[0]['tax_percent']+ 0 ?>%)</th>
                                                                    <th scope="col">Total</th>
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
                                                                            <img src="<?= base_url('uploads/product/' . $value['image']) ?>" width="100"/>
                                                                        </td>
                                                                        <td><?php echo  $value['name'] ; 

 
                                                         foreach ($value['attributes_id'] as $key => $attr_value) {
                                                            $attr_items = getProductChildAttrName($value['product_id'],$attr_value['product_attribute_id']);
                                                            if(count($value['attributes_id']) == $key+1){
                                                                echo $attr_items[0]->child_attr_name;
                                                            }else{
                                                                 echo "<br>".$attr_items[0]->child_attr_name.', ';
                                                            }
                                                        }?>
                                                                            
                                                                        </td>

                                                                        <td><?= $value['sku'] ?></td>
                                                                        <td>SR <?= $value['selling_price'] + 0 ?></td>
                                                                        <td><?= $value['quantity'] ?></td>

                                                                        <td>
                                                                            <?php if ($value['cancel_status'] == 'YES') {
                                                                                $canceled_amount = $canceled_amount + ($value['selling_price'] * $value['quantity']);
                                                                                ?>
                                                                                Canceled
                                                                            <?php } else { ?>
<select name="order_activity" class="form-control product_order_activity" data-transaction-id="<?= $value['id'] ?>">
            <option value="">Please Select</option>
            <?php foreach ($product_status as $row) { 
                if(variable_value_check($value['pickup_address_id'])){
                if($row['id'] == 7 or $row['id'] == 8){
                //ORDER GENERATED, PickUp Show Only  
            ?>
            <option value="<?= ucwords(strtolower($row['name'])) ?>" <?= ucwords(strtolower(urldecode($row['name']))) == ucwords(strtolower(urldecode($value['order_activity']))) ? 'selected' : '' ?> <?= (empty($value['delivery_date']) || (strtotime($value['delivery_date']) < 0)) ? 'disabled' : '' ?>><?= (ucwords(strtolower($row['name']))) ?>
            </option>
            <?php }}else{
                if($row['id'] == 8){  //PickUp Not Show
                    continue;
                }
            ?>
                <option value="<?= ucwords(strtolower($row['name'])) ?>" <?= (ucwords(strtolower(urldecode($row['name']))) == ucwords(strtolower(urldecode($value['order_activity'])))) ? 'selected' : '' ?> <?= (empty($value['delivery_date']) || (strtotime($value['delivery_date']) < 0)) ? 'disabled' : '' ?>><?= ucwords(strtolower($row['name'])) ?></option>
            <?php }} ?>
        </select>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($value['cancel_status'] == 'YES') { ?>
                                                                                Not Available
                                                                            <?php } else { ?>
                                                                                <input type="text" data-transaction-id="<?= $value['id'] ?>" class="form-control ui_datepicker expected_delivery_date" name="delivery_date" value="<?= (strtotime($value['delivery_date']) > 0) ? $value['delivery_date'] : '' ?>">
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td style="text-align: center;">
                                                                            <?php if($value['cancel_status'] == 'YES'){ ?>
                                                                                Not Available
                                                                            <?php } else if (variable_value_check($value['pickup_address_id'])) { ?>
                                                                                <a href="javascript:void(0);" data-id="<?= $value['pickup_address_id'] ?>" data-toggle="modal" data-delivery="PICKUP" data-target="#delivery_view" class="show_pick_up">
                                                                                    Pickup
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <a href="javascript:void(0);" data-id="<?= $value['delivery_address'] ?>" data-toggle="modal" data-delivery="DELIVERY" data-target="#delivery_view" class="show_pick_up">
                                                                                    Delivery
                                                                                </a>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td>SR <?= $value['product_total_amount']*($order_master_data[0]['tax_percent']/100) ?></td>
                                                                        <td>SR <?= $value['product_total_amount'] + ($value['product_total_amount']*($order_master_data[0]['tax_percent']/100)) ?></td>
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
                                                                    <td colspan="9" align="right">Total Tax</td>
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
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <?php $this->load->view('common/footer'); ?>
                    </div>
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
                </div>
            </div>
            <?php $this->load->view('common/js_include'); ?>
            <script>


            </script>
        </div>
    </body>
</html>