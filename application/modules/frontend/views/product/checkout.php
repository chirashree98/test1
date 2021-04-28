<!DOCTYPE html>
<html>
    <head> <?php
        $this->load->view('common/header');
        ?> </head>
    <body>
        <?php
        $this->load->view('common/header_nav');
        ?>
        <section id="my-account">
            <div class="custom-width">
                <div class="page-heading"><h1>Checkout</h1></div>
                <div class="user-right-panel">
                    <div class="user-dasbord-area">
                        <div class="my-account-left-panel">
                            <div class="my-account-left-panel-sec1 checkoutpage">
                                <div class="accordion" id="accordionExample">
                                    <form action="<?php  echo base_url('checkout-confirm') ?>" method="post">
                                        <input type="hidden" id="checkout_position" name="checkout_position" value="<?php echo $checkout_position; ?>" >
                                        <input type="hidden" name="order_id" value="<?= $order_id ?>">
                                        <input type="hidden" name="customer_id" value="<?= $customer_id ?>">
                                        <div class="card">
                                            <div class="card-header" id="headingzero">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link <?php
        echo $this->session->userdata('USER_ID') != '' ? 'collapsed' : '';
        ?>"
                                                            type="button" data-toggle="collapse" data-target="#collapsezero"
                                                            aria-expanded="false" aria-controls="collapsezero">Step 1: Checkout
                                                        Options<i class="fa fa-caret-down" aria-hidden="true"></i></button>
                                                </h2>
                                            </div>
                                            <div id="collapsezero"
                                                 class="collapse <?php
                                                    echo $this->session->userdata('USER_ID') != '' ? '' : 'in';
        ?>"
                                                 aria-labelledby="headingzero" data-parent="#accordionExample">
                                                <div class="card-body"> <?php
                                                 if ($this->session->userdata('USER_TYPE') != '4' || $this->session->userdata('USER_ID') == '') {
            ?>
                                                        <div class="row">
                                                            <div class="col-sm-6"><p>New Customer</p><span>Checkout Options:</span>
                                                                <h6>
                                                                    Register Account</h6><span>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</span><a
                                                                    href="<?php
                                                    echo base_url();
            ?>register"
                                                                    style="color:#fff;float:left"
                                                                    class="continue-btn flotchnage">Continue</a>
                                                            </div>
                                                            <div class="col-sm-6"><span
                                                                    id="msg_box"> <?php
                                                                if ($this->session->flashdata('success') != '') {
                ?><?php
                                                                            echo $this->session->flashdata('success');
                                                                            ?><?php
                                                                        }
                                                                        ?> </span>
                                                                <form action="<?php
                                                                    echo base_url();
                                                                        ?>checkout-login" method="POST"
                                                                      enctype="multipart/form-data"><span
                                                                        id="msg_box"> <?php
                                                            if ($this->session->flashdata('error') != '') {
                                                                            ?><?php
                                                                                echo $this->session->flashdata('error');
                                                                                ?><?php
                                                                            }
                                                                            ?> </span>
                                                                    <p>Returning Customer</p><span>I am a returning customer</span>
                                                                    <div class="form-group"><label>Email *</label><input type="text"
                                                                                                                         class="form-control"
                                                                                                                         placeholder="Enter Your Email"
                                                                                                                         name="email"
                                                                                                                         id="email"
                                                                                                                         required>
                                                                        <p class="error_msg"
                                                                           id="email_err"><?php
                                                                        echo form_error('email');
                                                                            ?> </p></div>
                                                                    <div class="form-group"><label>Password *</label><input
                                                                            type="password" class="form-control"
                                                                            placeholder="Enter Password" id="pswd" name="pswd"
                                                                            required>
                                                                        <p class="error_msg"
                                                                           id="pswd_err"><?php
                                                                           echo form_error('pswd');
                                                                            ?> </p><a
                                                                            href="<?php
                                                                           echo base_url();
                                                                            ?>forgot_password">Forgotten
                                                                            Password</a></div>
                                                                    <button type="submit" id="loginchk"
                                                                            class="continue-btn flotchnage">
                                                                        Login
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> <?php
                                                                    } else {
                                                                        echo "Already LoggedIn";
                                                                    }
                                                                        ?> </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                    <button id="billingDetailsTab"
                                                            class="btn btn-link <?php
                                                echo $this->session->userdata('USER_ID') != '' ? '' : 'collapsed';
                                                                        ?>"
                                                            type="button" data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">Step 2: Billing
                                                        Details<i class="fa fa-caret-down" aria-hidden="true"></i></button>
                                                </h2>
                                            </div>
                                            <div id="collapseOne" class="collapse <?php echo $this->session->userdata('USER_ID') != '' ? 'in' : ''; ?>" aria-labelledby="headingOne" data-parent="#accordionExample" aria-expanded="true">
                                                <div class="card-body"> <?php
                                                            //if ($this->session->userdata('USER_TYPE') == '4' || $this->session->userdata('USER_ID') != '') {
                                                                        ?>
                                                    <div class="row">
                                                        <div class="col-sm-12"> <?php
//                                                    print_r($new_address_data);
                                                    if ($address_data->num_rows() > 0) {
                                                        $i = 1;
                                                        foreach ($address_data->result() as $row) { ?>
                                                            <div class="delivery-detailsarea-checkoutpage">
                                                            <h6><input type="radio" name="billing_address" <?php
                                                            if ($this->session->userdata('billing_add_det')['billing_add_type'] == 1 && $row->id == $this->session->userdata('billing_add_det')['billing_add_id']) {
                                                                echo 'checked';
                                                            } else if($this->session->userdata('billing_add_det')['billing_add_type'] == 2) {
                                                                echo '';
                                                            } else if(empty($this->session->userdata('billing_add_det')['billing_add_id']) ) {
                                                                echo 'checked';
                                                            }
                                                            ?> value="<?php
                                                               echo $row->id;
                                                               ?>"
                                                               class="billing_address_details"><span
                                                               class="checkout-detailsaddress"><ul><li><?php
                                                       echo $row->name . ' - ' . $row->phone;
                                                               ?></li><li><?php
                                                                    echo variable_array_check($row->company_name) ? $row->company_name . ',' : '';
                                                                    ?> <?php
                                                                    echo $row->address2;
                                                                    ?>, <?php
                                                                        echo $row->city;
                                                                        ?>, <?php
                                                                    echo $row->postcode;
                                                                    ?>,</li></ul></span>
                                                                        </h6>
                                                                    </div> <?php
                                                                                $i++;
                                                                            }
                                                                            
                                                                        }
//                                                            print_r($this->session->userdata('billing_add_det'));                    ?> 
                                                            
                                                                <button type="button"
                                                                        class="btn add_new_billing_address addressbtncheckout"
                                                                        data-toggle="collapse" data-target="#demo" aria-expanded="true">
                                                                    <img src="<?php echo base_url(); ?>assets/front/images/plus-black.png"> Add a New Address 
                                                                </button> 
                                                        </div>
                                                        <div id="demo" class="collapse<?= ($address_data->num_rows() < 1 || (!empty($this->session->userdata('billing_add_det')) && $this->session->userdata('billing_add_det')['billing_add_type'] == 2)) ? ' in' : '' ?>">
                                                            <input type="radio" style="display:none" id="newAdd" name="billing_address" <?php if ($address_data->num_rows() < 1 || (!empty($this->session->userdata('billing_add_det')) && $this->session->userdata('billing_add_det')['billing_add_type'] == 2)) {
                                                                echo 'checked';
                                                            } ?> value="new_address" class="billing_address_details">
                                                            <span class="checkout-detailsaddress">
                                                                <div class="col-sm-6">
                                                                    <p>Your Personal Details</p>
                                                                    <div class="form-group">
                                                                        <label>Name *</label> <?php // echo json_encode($new_address_data); ?>
                                                                        <input type="text" class="form-control" name="billingname" id="billingname" value="<?php echo ($new_address_data)? $new_address_data['billingname'] : ''; ?>">
                                                                        <span id="billingname_error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email *</label>
                                                                        <input type="email" class="form-control" name="billingemail" id="billingemail" value="<?php echo ($new_address_data)? $new_address_data['billingemail'] : ''; ?>">
                                                                        <span id="billingemail_error" style="color:red;"></span>
                                                                    </div>
																	
                                                                    <div class="form-group">
                                                                        <label>Phone *</label>
																		 
																		  <!--<select id="std_code" name="billingstdcode" class="form-control" style="width:90px" required="required">
                                                        <option value="">STd</option>

                                                        <?php
                                                            foreach ($dialcode->result() as $val) {
                                                                ?>
                                                         <option value="<?php echo $val->id; ?>" <?php echo $val->id == $new_address_data['billingstdcode']? 'selected': '' ?> ><?php echo strtoupper($val->dial_code); ?></option>
                                                        <?php
                                                                }
                                                                ?>

                                                    </select>
													   <p class="error_msg"><?php echo form_error('std_code'); ?> </p>-->
                                              
                                                                        <input type="text" class="form-control" name="billingphone" maxlength="10" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" id="billingphone" value="<?php echo ($new_address_data)? $new_address_data['billingphone'] : ''; ?>">
                                                                        <span id="billingphone_error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p>Your Address</p>
                                                                    <div class="form-group">
                                                                        <label>Company</label>
                                                                        <input type="text" class="form-control" name="billing_company_name" id="billing_company_name" value="<?php echo ($new_address_data)? $new_address_data['billing_company_name'] : ''; ?>">
                                                                        <span id="billing_company_name_error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Address *</label>
                                                                        <input type="text" class="form-control" name="billingaddress" id="billingaddress" value="<?php echo ($new_address_data)? $new_address_data['billingaddress'] : ''; ?>">
                                                                        <span id="billingaddress_error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>City *</label>
                                                                        <input type="text" class="form-control" name="billingcity" id="billingcity" value="<?php echo ($new_address_data)? $new_address_data['billingcity'] : ''; ?>">
                                                                        <span id="billingcity_error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Post Code *</label>
                                                                        <input type="text" class="form-control" name="billingzip" id="billingzip" value="<?php echo ($new_address_data)? $new_address_data['billingzip'] : ''; ?>">
                                                                        <span id="billingzip_error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Country *</label>
                                                                        <select name="billingcountry" class="form-control country" id="billingcountry" >
                                                                            <option value="">Select Country</option>
                                                                            <?php
                                                                            foreach ($country->result() as $val) {
                                                                                ?>
                                                                            <option value="<?php echo $val->id; ?>" <?php echo $val->id == $new_address_data['billingcountry']? 'selected': '' ?> ><?php echo strtoupper($val->country_name); ?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span id="billingcountry_error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Region / State *</label>
                                                                        <select class="form-control state" name="billingstate" id="billingstate">
                                                                            <option value="">Select Country First</option>
                                                                        </select>
                                                                        <span id="billingstate_error" style="color:red;" ></span>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <span id="billing_add_err" style="color:red;font-weight:bold;margin-left: 35px;"></span>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <button type="button"
                                                                        class="continue-btn" onclick="return save_billing_address();">Continue
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingDeliveryMethod">
                                                <h2 class="mb-0">
                                                    <button id="deliveryMethodTab" class="btn btn-link collapsed <?php echo count($query) < 1? 'readonly_view': '' ;?>"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseDeliveryMethodTab"
                                                            aria-expanded="false" aria-controls="collapseDeliveryMethodTab" <?php echo count($query) < 1? 'disabled="disabled"': '' ;?>>Step 3:
                                                        Select product to pickup <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseDeliveryMethodTab" class="collapse" aria-labelledby="headingDeliveryMethod" data-parent="#accordionExample" aria-expanded="false">
                                                <div class="card-body"> 
                                                    <div style="float: right;font-weight: bold; display: none" id="pickup_count"> <?php echo $pickup_selected_count; ?> product selected for pickup</div>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Image</th>
                                                                <th>Product</th>
                                                                <th>SKU</th>
                                                                <th>Pickup Address</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> <?php
                                                            foreach ($query as $row) {
//                                                                echo json_encode($row)
                                                                $pick_up_status = get_only_pickup_check($row->store_id);
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                        $pickup_data = check_cart_product_pickup_address_exist($row->store_id);
                                                                        ?>
                                                                        <?php
                                                                        if (variable_array_check($pickup_data)) {
                                                                            $pickup_id = $pickup_data[0]->id;
                                                                            if($pick_up_status == 1){
                                                                        ?>
                                                                        <input type="checkbox" checked class="total_cart_product_count" name="pickup_product[cart_id][]" value="<?php echo $row->cart_id; ?>"  onclick="return false;">
                                                                            Pickup Service <br>
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            
                                                                            <input type="checkbox" name="pickup_product[cart_id][]" id="pickup_pro_chk"
                                                                            value="<?php echo $row->cart_id; ?>" class="total_cart_product_count" <?php if ($row->delivery_met == 2) {
                                                                            echo 'checked';
                                                                            } ?> onclick="return get_pickup_count();">
                                                                            Pickup Service <br>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><img height="100px" src="<?php
                                                                             echo base_url();
                                                                             ?>uploads/product/<?php
                                                                         echo $row->product_image;
                                                                         ?>">
                                                                    </td>
                                                                    
                                                                    <td><?php
                                                                         echo $row->product_name.'<br>';
                                                                         foreach (json_decode($row->attributes) as $key=> $attr_val) {
                                               $attr_items = getProductChildAttrName($row->product_id,$attr_val);
                                               if(count(json_decode($row->attributes)) == $key+1){
                                                    echo $attr_items[0]->child_attr_name;
                                                }else{
                                                     echo $attr_items[0]->child_attr_name.', ';
                                                }
                                            }
                                                                             ?></td>
                                                                    <td><?php
                                                                    echo $row->sku;
                                                                             ?></td>
                                                                    <td>
                                                                        <?php
//                                                                        echo json_encode($pickup_data);
                                                                        if (variable_array_check($pickup_data)) {
                                                                            ?>
                                                                    <?= !empty($pickup_data[0]->name) ? $pickup_data[0]->name. ', '  : '' ?> <?= !empty($pickup_data[0]->company_name) ? $pickup_data[0]->company_name : '' ?> <?= !empty($pickup_data[0]->address2) ? ', ' . $pickup_data[0]->address2 : '' ?> <?= !empty($pickup_data[0]->postcode) ? ', ' . $pickup_data[0]->postcode : '' ?> <?= !empty($pickup_data[0]->city) ? ', ' . $pickup_data[0]->city : '' ?> <?= !empty($pickup_data[0]->state_name) ? ', ' . $pickup_data[0]->state_name : '' ?> <?= !empty($pickup_data[0]->country_name) ? ', ' . $pickup_data[0]->country_name : '' ?> <?= !empty($pickup_data[0]->email) ? ', ' . $pickup_data[0]->email : '' ?> <?= !empty($pickup_data[0]->phone) ? ', ' . $pickup_data[0]->phone : '' ?>
                                                                        <input type="hidden" name="pickup_product[address_id_<?php echo $row->cart_id ?>]" value="<?php echo $pickup_data[0]->id ?>" >
                                                                        <input type="hidden" name="pickup_product[prod_id_<?php echo $row->cart_id ?>]" value="<?php echo $row->product_id ?>" >
                                                                        
                                                                <?php 
                                                                
                                                                        } ?>
                                                                    </td>
                                                                </tr> <?php
                                                            }
                                                            ?> </tbody>
                                                    </table>
<!--                                                    <span style="float: right;font-weight: bold;">
                                                        <input type="checkbox" name="confirm_pickup" id="confirm_pickup" value="1" class="total_cart_product_count"> 
                                                        Confirm to avail pickup service for the selected products</span> <br>-->
                                                        <!--<span id="confirm_err" style="color:red;font-weight:bold;"></span>-->
                                                    <!--                    <button class="continue-btn delivery_method_continue" type="button" onclick="return save_pickup_details();">
                                                                            Continue
                                                                        </button>-->

                                                    <button class="continue-btn" type="button" onclick="return save_pickup_details();">
                                                        Continue
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(count($delivery_list) > 0){ ?>
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h2 class="mb-0">
                                                    <button id="deliveryDetailsTab" class="btn btn-link collapsed"
                                                            type="button" data-toggle="collapse" data-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">Step 4:
                                                        Delivery Details<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" aria-expanded="false">
                                                
                                                <div class="card-body">
                                                    <div id="delivery_view">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>Image</th>
                                                                <th>Product</th>
                                                                <th>SKU</th>
                                                                <th>Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> <?php
                                                            foreach ($delivery_list as $row) {
                                                                ?>
                                                                <tr>
                                                                    
                                                                    <td><img height="100px" src="<?php
                                                                             echo base_url();
                                                                             ?>uploads/product/<?php
                                                                         echo $row->product_image;
                                                                         ?>">
                                                                    </td>
                                                                    <td><?php
                                                                         echo $row->product_name.'<br>';
                                                                          foreach (json_decode($row->attributes) as $key=> $attr_val) {
       $attr_items = getProductChildAttrName($row->product_id,$attr_val);
       if(count(json_decode($row->attributes)) == $key+1){
            echo $attr_items[0]->child_attr_name;
        }else{
             echo $attr_items[0]->child_attr_name.', ';
        }
    }
                                                                             ?></td>
                                                                    <td><?php
                                                                    echo $row->sku;
                                                                             ?></td>
                                                                    <td><?php
                                                                    echo $row->cart_quantity;
                                                                             ?></td>
                                                                </tr> <?php
                                                            }
                                                            ?> </tbody>
                                                    </table>
                                                    </div>
                                                    <div class="delivery_type_delivery"> <?php
                                                            if ($this->session->userdata('USER_TYPE') == '4' || $this->session->userdata('USER_ID') != '') {
                                                                ?>
                                                            <div class="row">
                                                                <div class="col-sm-12"> <?php
                                                                    if ($address_data->num_rows() > 0) {
                                                                        $i = 1;
                                                                        foreach ($address_data->result() as $row) {
                                                                            ?>
                                                                            <div class="delivery-detailsarea-checkoutpage">
                                                                                <h6><input type="radio"
                                                                                           name="delivery_address" <?php
                                                                                           if ($this->session->userdata('delivery_add_det')['delivery_address_type'] == 1 && $row->id == $this->session->userdata('delivery_add_det')['delivery_address_id']) {
                                                                echo 'checked';
                                                            } else if($this->session->userdata('delivery_add_det')['delivery_address_type'] == 2 || $this->session->userdata('delivery_add_det')['delivery_address_type'] == 3) {
                                                                echo '';
                                                            } else if(empty($this->session->userdata('delivery_add_det')['delivery_address_id']) ) {
                                                                echo 'checked';
                                                            }
                                                                                           ?> value="<?php
                                                                               echo $row->id;
                                                                               ?>"
                                                                                           class="billing_address_details"><span
                                                                                           class="checkout-detailsaddress"><ul><li><?php
                                                                                                echo $row->name . ' - ' . $row->phone;
                                                                                                ?></li><li><?php
                                                                                                echo variable_array_check($row->company_name) ? $row->company_name . ',' : '';
                                                                                                ?> <?php
                                                                                                    echo $row->address2;
                                                                                                    ?>, <?php
                                                                                                echo $row->city;
                                                                                                ?>, <?php
                                                                                    echo $row->postcode;
                                                                                    ?> </li></ul></span>
                                                                                </h6>
                                                                            </div> <?php
                                                                            $i++;
                                                                        }
                                                                    }
                                                                    ?> </div>
                                                            </div> <?php
                                                        }
                                                        
                                                        if ($address_data->num_rows() > 0) {
                                                            ?>
                                                            <button type="button"
                                                                    class="btn add_new_delivery addressbtncheckout"
                                                                    data-toggle="collapse"
                                                                    data-target="#add_new_delivery_address_accordion"><img
                                                                    src="<?php
                                                            echo base_url();
                                                            ?>assets/front/images/plus-black.png">
                                                                Add a New Address
                                                            </button> <?php
                                                        }
                                                        ?>
                                                        <div class="new_delivery_address_form" >
                                                            <div id="add_new_delivery_address_accordion" class="collapse <?= ($address_data->num_rows() < 1 || (!empty($this->session->userdata('delivery_add_det')) && $this->session->userdata('delivery_add_det')['delivery_address_type'] != 1)) ? ' in' : '' ?>">
                                                                <span>Delivery charge will be included for your final billing amount</span>
                                                                
                                                                <h5 style="<?php echo ($this->session->userdata('billing_add_det')['billing_add_type'] == 1)? 'display:none': '' ?>"><input type="checkbox" id="copy_address"
                                                                           name="copy_address" onclick="return get_delivery_add();" > My delivery and billing address are the same</h5>
                                                                <div class="row" id="delivery_address_view">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <input type="radio" id="new_add_delivery" style="display:none" value="new_address" name="delivery_address" <?= ($address_data->num_rows() < 1) ? 'checked' : '' ?>/>
                                                                            <label>Name *</label>
                                                                            <input type="text" class="form-control" name="shippingname" id="shippingname" value="<?php echo ($new_delivery_address_data)? $new_delivery_address_data['shippingname'] : ($this->session->userdata('delivery_add_det')['delivery_address_type'] == 3? $new_address_data['billingname']:'' ); ?>">
                                                                            <span id="shippingname_error" style="color:red;"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Email *</label>
                                                                            <input type="email" class="form-control" name="shippingemail" id="shippingemail" value="<?php echo ($new_delivery_address_data)? $new_delivery_address_data['shippingemail'] : ($this->session->userdata('delivery_add_det')['delivery_address_type'] == 3? $new_address_data['billingemail']:'' ); ?>">
                                                                            <span id="shippingemail_error" style="color:red;"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Phone *</label>
                                                                            <input type="text" class="form-control" name="shippingphone" id="shippingphone" maxlength="10" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="<?php echo ($new_delivery_address_data)? $new_delivery_address_data['shippingphone'] : ($this->session->userdata('delivery_add_det')['delivery_address_type'] == 3? $new_address_data['billingphone']:'' ); ?>">
                                                                            <span id="shippingphone_error" style="color:red;"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Company </label>
                                                                            <input type="text" class="form-control" name="shipping_company_name" id="shipping_company_name" value="<?php echo ($new_delivery_address_data)? $new_delivery_address_data['shipping_company_name'] : ($this->session->userdata('delivery_add_det')['delivery_address_type'] == 3? $new_address_data['billing_company_name']:'' ); ?>">
                                                                            <span id="shipping_company_name_error" style="color:red;"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Address *</label>
                                                                            <input type="text" class="form-control" name="shippingaddress" id="shippingaddress" value="<?php echo ($new_delivery_address_data)? $new_delivery_address_data['shippingaddress'] : ($this->session->userdata('delivery_add_det')['delivery_address_type'] == 3? $new_address_data['billingaddress']:'' ); ?>">
                                                                            <span id="shippingaddress_error" style="color:red;"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>City *</label>
                                                                            <input type="text" class="form-control" name="shippingcity" id="shippingcity" value="<?php echo ($new_delivery_address_data)? $new_delivery_address_data['shippingcity'] : ($this->session->userdata('delivery_add_det')['delivery_address_type'] == 3? $new_address_data['billingcity']:'' ); ?>">
                                                                            <span id="shippingcity_error" style="color:red;"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Post Code *</label>
                                                                            <input type="text" class="form-control" name="shippingzip" id="shippingzip" value="<?php echo ($new_delivery_address_data)? $new_delivery_address_data['shippingzip'] : ($this->session->userdata('delivery_add_det')['delivery_address_type'] == 3? $new_address_data['billingzip']:'' ); ?>">
                                                                            <span id="shippingzip_error" style="color:red;"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Country *</label>
                                                                            <select name="shippingcountry" class="form-control delivery_country" id="shippingcountry" >
                                                                                <option value="">Select Country</option>
                                                                                    <?php foreach ($country->result() as $val) { ?>
                                                                                    <option value="<?php echo $val->id; ?>" <?php echo ($new_delivery_address_data)? ($val->id == $new_delivery_address_data['shippingcountry']? 'selected': ''):($this->session->userdata('delivery_add_det')['delivery_address_type'] == 3? $new_address_data['billingcountry']:'' ) ?>>
                                                                                <?php echo strtoupper($val->country_name); ?></option>
                                                                            <?php } ?>
                                                                            </select>
                                                                            <span id="shippingcountry_error" style="color:red;"></span>
                                                                            <input type="hidden" name="shippingcountry" id="shippingcountryinput" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Region / State *</label>
                                                                            <select class="form-control delivery_state"
                                                                                    name="shippingstate" id="shippingstate">
                                                                                <option value="">Select Country First
                                                                                </option>
                                                                            </select>
                                                                            <span id="shippingstate_error" style="color:red;"></span>
                                                                            <input type="hidden" name="shippingstate" id="shippingstateinput" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span id="delivery_add_err" style="color:red;font-weight:bold;margin-left: 35px;"></span>
                                                    <button class="continue-btn delivery_pickup_continue" type="button" onclick="return save_delivery_details()">Continue
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }else{ ?>
                                            <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h2 class="mb-0">
                                                    <button id="deliveryDetailsTab" class="btn btn-link collapsed readonly_view"
                                                            type="button" data-toggle="collapse" data-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">Step 4:
                                                        Delivery Details<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" aria-expanded="false">
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h2 class="mb-0">
                                                    <button id="confirmOrderTab" class="btn btn-link collapsed"
                                                            type="button" data-toggle="collapse" data-target="#collapseFour"
                                                            aria-expanded="false" aria-controls="collapseFour">Step 5:
                                                        Confirm Order<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample" aria-expanded="false">
                                                <div class="card-body">
                                                    <div class="cart conform-order">
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
                                                                        <th class="th_delivery_method">
                                                                            Delivery Method
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody> <?php
                                                                    $sub_tot = floatval(0);
                                                                    $tot = floatval(0);
                                                                    foreach ($totquery as $row) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><img height="100px"
                                                                                     src="<?php
                                                                                     echo base_url();
                                                                                     ?>uploads/product/<?php
                                                                                 echo $row->product_image;
                                                                                 ?>">
                                                                            </td>
                                                                            <td><?php
                                                                                 echo $row->product_name.'<br>';
                                                                                foreach (json_decode($row->attributes) as $key=> $attr_val) {
       $attr_items = getProductChildAttrName($row->product_id,$attr_val);
       if(count(json_decode($row->attributes)) == $key+1){
            echo $attr_items[0]->child_attr_name;
        }else{
             echo $attr_items[0]->child_attr_name.', ';
        }
    }     ?></td>
                                                                            <td><?php
                                                                            echo $row->sku;
                                                                                     ?></td>
                                                                            <td><?php
                                                                            echo $row->cart_quantity;
                                                                                     ?></td>
                                                                            <td>SR <?php
                                                                            echo $row->sell_price;
                                                                            ?></td>
                                                                            <td>
                                                                                SR <?php
                                                                            echo floatval($row->sell_price * $row->cart_quantity);
                                                                            ?>
                                                                            </td>
                                                                            <td class="td_delivery_method"
                                                                                id="td_delivery_method_id_<?= $row->cart_id ?>"
                                                                                ><?php if($row->delivery_met != 2){
                                                                                    echo 'Delivery';
                                                                                } else {
                                                                                    echo 'Pickup';
                                                                                } ?>
                                                                            </td>
                                                                        </tr> <?php
                                                                        $sub_tot += floatval($row->sell_price * $row->cart_quantity);
                                                                        $tot += floatval($row->sell_price * $row->cart_quantity);
                                                                    }
                                                                    ?> </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-sm-8 btnone">
                                                            <div class="col-sm-12">
                                                                <?php if (!empty($d_code)) { ?>
                                                                    <input type="hidden" name="design_code" value="<?= $d_code ?>">
                                                                    <strong>Applied Design Code :</strong> <?= $d_code ?>
                                                                <?php } else { ?>
                                                                    <input type="hidden" name="design_code" value="">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 btnone">
                                                            <div class="row">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><b>Subtotal</b></td>
                                                                                <td style="text-align:right">
                                                                                    SR <?php
                                                                            echo $sub_tot;
                                                                            ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Tax(<?php echo $tax->tax ?>%)</b></td>
                                                                                <td style="text-align:right">
                                                                                    SR <?php
                                                                            echo $sub_tot * ($tax->tax/100);
                                                                            ?></td>
                                                                            </tr>
                                                                            <?php $tot += $tot * ($tax->tax/100) ?>
                                                                            <tr class="borderbnone">
                                                                                <td class="borderbnone"><b>Total</b></td>
                                                                                <td class="borderbnone"
                                                                                    style="text-align:right">
                                                                                    SR <?php
                                                                            echo $tot;
                                                                            ?> </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <a href="javascript:void(0);" class="continue-btn"
                                                                       id="product_confirm">Confirm</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h2 class="mb-0">
                                                    <button id="paymentMethodTab" class="btn btn-link collapsed"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseThree" aria-expanded="false"
                                                            aria-controls="collapseThree">Step 6: Payment Method<i
                                                            class="fa fa-caret-down" aria-hidden="true"></i></button>
                                                </h2>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" aria-expanded="false">
                                                <div class="card-body">CASH ON DELIVERY 
                                                    <div class="form-group">
                                                        <button class="continue-btn" type="submit" id="paymentContinue">
                                                            Confirm Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div> <?php
$this->load->view('common/footer');
?>
    </body> <?php
    $this->load->view('common/footer_js');
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>function isEmail(e) {
            return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(e)
        }

        $(document).ready(function () {
            $("#goReg").on("click", function () {
                $("#goRegLink").click()
            }), $(".add_new_billing_address").on("click", function () {
                $("#newAdd").click();
            })
        }), $("#loginchk").on("click", function () {
            return $(".error_msg").html(""), "" == $("#email").val() ? ($("#email").next(".error_msg").html("Please enter email id "), $("#email").focus(), !1) : isEmail($("#email").val()) ? "" == $("#pswd").val() ? ($("#pswd").next(".error_msg").html("Please enter password"), $("#pswd").focus(), !1) : void 0 : ($("#email").next(".error_msg").html("Please enter a valid email id "), $("#email").focus(), !1)
        })
        </script>
    <script type="text/javascript">$(document).ready(function () {
            $("#copy_address").click(function () {
                if ($('input[name="copy_address"]').is(":checked")) {
                    $("#shippingname").val($("#billingname").val()), $("#shipping_company_name").val($("#billing_company_name").val()), $("#shippingemail").val($("#billingemail").val()), $("#shippingaddress").val($("#billingaddress").val()), $("#shippingcity").val($("#billingcity").val()), $("#shippingzip").val($("#billingzip").val()), $("#shippingphone").val($("#billingphone").val());
                    $("#shippingname").attr('readonly', 'readonly'), $("#shipping_company_name").attr('readonly', 'readonly'), $("#shippingemail").attr('readonly', 'readonly'), $("#shippingaddress").attr('readonly', 'readonly'), $("#shippingcity").attr('readonly', 'readonly'), $("#shippingzip").attr('readonly', 'readonly'), $("#shippingphone").attr('readonly', 'readonly');
                    
//            var i = $("#billingstate option:selected").val();
//                    $("#shippingstate option[value='" + i + "']").attr("selected", "selected");
                    var l = $("#billingcountry option:selected").val();
                    $("#shippingcountry option[value='" + l + "']").attr("selected", "selected");
                    $("#shippingcountry").val(l);
                    $.post(base_url + 'frontend/user/getstate', 'country_id=' + $('.delivery_country').val(), function (data) {
                        $('.delivery_state').html(data);
                        $("#shippingcountryinput").val($('.delivery_country').val());
                        $("#shippingstateinput").val($('#shippingstate').val());
                    });
                    
                    $(".delivery_country").attr('disabled', 'disabled'), $(".delivery_state").attr('disabled', 'disabled');
                    $("#shippingcountryinput").removeAttr('disabled'), $("#shippingstateinput").removeAttr('disabled');
                    
                } else{
                    $("#shippingname").val(""), $("#shipping_company_name").val(""), $("#shippingemail").val(""), $("#shippingaddress").val(""), $("#shippingcity").val(""), $("#shippingstate").val(""), $("#shippingcountry").val(""), $("#shippingzip").val(""), $("#shippingphone").val("")
                    $("#shippingname").removeAttr('readonly'), $("#shipping_company_name").removeAttr('readonly'), $("#shippingemail").removeAttr('readonly'), $("#shippingaddress").removeAttr('readonly'), $("#shippingcity").removeAttr('readonly'), $("#shippingzip").removeAttr('readonly'), $("#shippingphone").removeAttr('readonly');
                    $(".delivery_country").removeAttr('disabled'), $(".delivery_state").removeAttr('disabled');
                     $("#shippingcountryinput").attr('disabled', 'disabled'), $("#shippingstateinput").attr('disabled', 'disabled');
                }
            });
            
            if(<?php echo $this->session->userdata('delivery_add_det')['delivery_address_type'] != ''? $this->session->userdata('delivery_add_det')['delivery_address_type']: 0 ?> === 3){
                $("#copy_address").click();
            }
        })</script>
    <script>
        function save_pickup_details() {
//            if ($("#confirm_pickup").prop('checked') == true) {
////                $('#deliveryMethodTab').trigger('click');
////                $('#deliveryDetailsTab').trigger('click');
//            } else {
//                $("#confirm_err").html('Please tick the confirm box!');
//                return false;
//            }
            //$(this).toggleClass("collapse");
            
            var list = $("input[name='pickup_product[cart_id][]']").map(function () {
                
                var cart_id = this.value;
                var check = (this.checked? 1: 0);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('pickup-selection-submit'); ?>",
                    data: 'cart_id=' + cart_id + '&picksts=' + check,
                    success: function (result) {
//                        alert(result);
                        window.location.href = "<?php echo base_url('checkout/4') ?>";
                    },
                    error: function(){
                        window.location.href = "<?php echo base_url('checkout/4') ?>";
                    }
                });
            }).get();
            window.location.href = "<?php echo base_url('checkout/4') ?>";
            return false;
        }
        function get_pickup_count() {
            var temp_count = 0;
            var list = $("input[name='pickup_product[cart_id][]']:checked").map(function () {
                temp_count++;
            }).get();
            //alert(temp_count);
            if(temp_count > 0){
                $("#pickup_count").css('display','block');
                $("#pickup_count").html(temp_count + ' product selected for pickup');
            } else {
                $("#pickup_count").css('display','none');
            }
            
            return true;
        }
        window.onload = function() {
            var checkout_position = $("#checkout_position").val();
            if(checkout_position == 4){
                $('#billingDetailsTab').trigger('click');
                $('#deliveryDetailsTab').trigger('click');
            }else if(checkout_position == 5){
                $('#billingDetailsTab').trigger('click');
                $('#confirmOrderTab').trigger('click');
            }else if(checkout_position == 3){
                $('#billingDetailsTab').trigger('click');
                $('#deliveryMethodTab').trigger('click');
            }
            var temp_count = 0;
            var list = $("input[name='pickup_product[]']:checked").map(function () {
                temp_count++;
            }).get();
            //alert(temp_count);
            if(temp_count > 0){
                $("#pickup_count").css('display','block');
                $("#pickup_count").html(temp_count + ' product selected for pickup');
            } else {
                $("#pickup_count").css('display','none');
            }
        };
        function save_billing_address(){
            var billing_add = $("input[name=billing_address]:checked").val();
            if(billing_add == 'new_address'){
                if($.trim($("#billingname").val()) == ''){
                    $("#billingname_error").html('enter Name!');
                    $("#billingname").focus();
                    return false;
                }else{
                    var billingname = $.trim($("#billingname").val());
                    $("#billingname_error").html('');
                }
                
                if($.trim($("#billingemail").val()) == ''){
                    $("#billingemail_error").html('enter emailID!');
                    $("#billingemail").focus();
                    return false;
                }else if (!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/).test($.trim($("#billingemail").val()))){
                    $("#billingemail_error").html('enter valid emailID!');
                    $("#billingemail").focus();
                    return false;
                } else {
                    var billingemail = $.trim($("#billingemail").val());
                    $("#billingemail_error").html('');
                }
                
                if($.trim($("#billingphone").val()) == ''){
                    $("#billingphone_error").html('enter mobile no!');
                    $("#billingphone").focus();
                    return false;
                }else{
                    var billingphone = $.trim($("#billingphone").val());
                    $("#billingphone_error").html('');
                }
                
                if($.trim($("#billing_company_name").val()) == ''){
                    $("#billing_company_name_error").html('enter company name!');
                    $("#billing_company_name").focus();
                    return false;
                }else{
                    var billing_company_name = $.trim($("#billing_company_name").val());
                    $("#billing_company_name_error").html('');
                }
                
                if($.trim($("#billingaddress").val()) == ''){
                    $("#billingaddress_error").html('enter address!');
                    $("#billingaddress").focus();
                    return false;
                }else{
                    var billingaddress = $.trim($("#billingaddress").val());
                }
                if($.trim($("#billingcity").val()) == ''){
                    $("#billingcity_error").html('enter city!');
                    $("#billingcity").focus();
                    return false;
                }else{
                    var billingcity = $.trim($("#billingcity").val());
                }
                if($.trim($("#billingzip").val()) == ''){
                    $("#billingzip_error").html('enter Zipcode!');
                    $("#billingzip").focus();
                    return false;
                }else{
                    var billingzip = $.trim($("#billingzip").val());
                }
                if($.trim($("#billingcountry").val()) == ''){
                    $("#billingcountry_error").html('enter Zipcode!');
                    $("#billingcountry").focus();
                    return false;
                }else{
                    var billingcountry = $.trim($("#billingcountry").val());
                }
                if($.trim($("#billingstate").val()) == ''){
                    $("#billingstate_error").html('enter state!');
                    $("#billingstate").focus();
                    return false;
                }else{
                    var billingstate = $.trim($("#billingstate").val());
                }
                var billing_add_type = 2;// 1 from database, 2 from input
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('set-billing-address-for-orders'); ?>",
                    data: 'billing_add_type=' + billing_add_type+'&billingname='+billingname+'&billingemail='+billingemail+'&billingphone='+billingphone+'&billing_company_name='+billing_company_name+'&billingaddress='+billingaddress+'&billingcity='+billingcity+'&billingzip='+billingzip+'&billingcountry='+billingcountry+'&billingstate='+billingstate,
                    success: function (result) {
                        //alert(result);return false;
                        window.location.href = "<?php echo count($query) > 0 ? base_url('checkout/3'): base_url('checkout/4') ?>";
                    },
                    error: function(){
                        $("#billing_add_err").html('Please select address properly!');
                        return false;
                    }
                });
            }else{
                var billing_add_type = '1'; // 1 from database, 2 from input
                var billing_add_id = billing_add;
                if(billing_add_id !=''){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('set-billing-address-for-orders'); ?>",
                        data: 'billing_add_type=' + billing_add_type+'&billing_add_id='+billing_add_id,
                        success: function (result) {
                            window.location.href = "<?php echo count($query) > 0 ? base_url('checkout/3'): base_url('checkout/4') ?>";
                        },
                        error: function(){
                            $("#billing_add_err").html('Please select address properly!');
                            return false;
                        }
                    });
                }else{
                    $("#billing_add_err").html('Please select address properly!');
                    return false;
                }
            }
        }
        function save_delivery_details(){
            if($("#copy_address").prop('checked') == true){
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('set-delivery-address-for-orders'); ?>",
                    data: 'delivery_address_type=' + '3',
                    success: function (result) {
                        window.location.href = "<?php echo base_url('checkout/5') ?>";
                    },
                    error: function(){
                        $("#delivery_add_err").html('Please select address properly!');
                        return false;
                    }
                });
            }else{
                var delivery_address = $("input[name=delivery_address]:checked").val();
                if(delivery_address == 'new_address'){
                
                    if($.trim($("#shippingname").val()) == ''){
                        $("#shippingname_error").html('enter Name!');
                        $("#shippingname").focus();
                        return false;
                    }else{
                        var shippingname = $.trim($("#shippingname").val());
                    }
                    if($.trim($("#shippingemail").val()) == ''){
                        $("#shippingemail_error").html('enter emailID!');
                        $("#shippingemail").focus();
                        return false;
                    }else{
                        var shippingemail = $.trim($("#shippingemail").val());
                    }
                    if($.trim($("#shippingphone").val()) == ''){
                        $("#shippingphone_error").html('enter Mobile No.!');
                        $("#shippingphone").focus();
                        return false;
                    }else{
                        var shippingphone = $.trim($("#shippingphone").val());
                    }
                    if($.trim($("#shipping_company_name").val()) == ''){
                        $("#shipping_company_name_error").html('enter Company name.!');
                        $("#shipping_company_name").focus();
                        return false;
                    }else{
                        var shipping_company_name = $.trim($("#shipping_company_name").val());
                    }
                    if($.trim($("#shippingaddress").val()) == ''){
                        $("#shippingaddress_error").html('enter address!');
                        $("#shippingaddress").focus();
                        return false;
                    }else{
                        var shippingaddress = $.trim($("#shippingaddress").val());
                    }
                    if($.trim($("#shippingcity").val()) == ''){
                        $("#shippingcity_error").html('enter city!');
                        $("#shippingcity").focus();
                        return false;
                    }else{
                        var shippingcity = $.trim($("#shippingcity").val());
                    }
                    if($.trim($("#shippingzip").val()) == ''){
                        $("#shippingzip_error").html('enter zip code!');
                        $("#shippingzip").focus();
                        return false;
                    }else{
                        var shippingzip = $.trim($("#shippingzip").val());
                    }
                    if($.trim($("#shippingcountry").val()) == ''){
                        $("#shippingcountry_error").html('select country!');
                        $("#shippingcountry").focus();
                        return false;
                    }else{
                        var shippingcountry = $.trim($("#shippingcountry").val());
                    }
                    if($.trim($("#shippingstate").val()) == ''){
                        $("#shippingstate_error").html('select state!');
                        $("#shippingstate").focus();
                        return false;
                    }else{
                        var shippingstate = $.trim($("#shippingstate").val());
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('set-delivery-address-for-orders'); ?>",
                        data: 'delivery_address_type=' + '2'+'&shippingname='+shippingname+'&shippingemail='+shippingemail+'&shippingphone='+shippingphone+'&shipping_company_name='+shipping_company_name+'&shippingaddress='+shippingaddress+'&shippingcity='+shippingcity+'&shippingzip='+shippingzip+'&shippingcountry='+shippingcountry+'&shippingstate='+shippingstate,
                        success: function (result) {
                            window.location.href = "<?php echo base_url('checkout/5') ?>";
                        },
                        error: function(){
                            $("#delivery_add_err").html('Please select address properly!');
                            return false;
                        }
                    });
                }else{
                
                    var delivery_address_type = '1'; // 1 from database, 2 from input,3 for same as bill
                    var delivery_address_id = delivery_address;
                    if(delivery_address !=''){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('set-delivery-address-for-orders'); ?>",
                            data: 'delivery_address_type=' + delivery_address_type+'&delivery_address_id='+delivery_address_id,
                            success: function (result) {
                                window.location.href = "<?php echo base_url('checkout/5') ?>";
                            },
                            error: function(){
                                $("#delivery_add_err").html('Please select address properly!');
                                return false;
                            }
                        });
                    }else{
                        $("#delivery_add_err").html('Please select address properly!');
                        return false;
                    }
                }
            }
        }
        function get_delivery_add(){
//            $("#delivery_address_view").toggle();
        }
    </script>
</html>