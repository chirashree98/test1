<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>

<!--+++++++++++++ Header End +++++++++++++++++++-->

<div class="clearfix"></div>


<section id="my-account">
    <div class="custom-width">
        <div class="page-heading">
            <h1>Order History</h1>
        </div>

        <div class="my-account-inner">
            <div class="col-md-3">
                <div class="artist-left-panel">
                    <?php $this->load->view('common/myaccount_side_panel'); ?>
                </div>
            </div>


            <div class="col-sm-9">
                <div class="my-account-left-panel">
                    <div class="my-account-left-panel-sec1">
                        <h4>Order History</h4>
                        <div class="my-account-left-panel-sec1-inner wishlisttable">
                            <p>Your Order History</p>
                            <div class="wishlist-area">
                                <div class="cart">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Total Price</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Delivery Method</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($order_transaction_data as $value) { ?>
                                            <tr>
                                                <td><?= $value['order_no'] ?></td>
                                                <td>
                                                     <a href="<?php echo base_url();?>product_detail/<?php echo  digi_encode(($value['product_id'])); ?>"><img src="<?= base_url('uploads/product/' . $value['image']) ?>"
                                                        class="wishlistimg"></a>
                                                </td>
                                                <td> <a style="color:black" href="<?php echo base_url();?>product_detail/<?php echo  digi_encode(($value['product_id'])); ?>"><?= $value['name'] ?></a><br><span>
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
                                                    </span>
												</td>
												
                                                <td>
                                                    SR <?= $value['product_total_amount']+($value['product_total_amount']*($value['tax_percent']/100)) ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    if($value['cancel_status'] == 'YES'){
                                                        echo 'Canceled';
                                                        // echo $value['pickup_address_id'];
                                                    }else{
                                                        echo ucwords(strtolower(urldecode($value['order_activity'])));
                                                    }

                                                    ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if($value['cancel_status'] == 'YES'){ ?>
                                                        NA
                                                    <?php } else if (variable_value_check($value['pickup_address_id'])) { ?>
                                                        Pickup
                                                    <?php } else { ?>
                                                        Delivery
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('store-order-history/details/' . $value['id']) ?>">
                                                        <img src="<?= base_url('assets/front/images/eye.png') ?>">
                                                    </a></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

</section>


<div class="clearfix"></div>

<?php $this->load->view('common/footer'); ?>


</body>
<?php $this->load->view('common/footer_js'); ?>

</html>
