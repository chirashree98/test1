    <!DOCTYPE html>
    <html>

    <head>
        <title>Makkan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet"> -->

    </head>
    <style>
        body {
            
        }

    </style>
    <?php 
    foreach ($billing_address as $key => $value) {
       $company_name = $value['company_name'];
       $address2 = $value['address2'];
       $postcode = $value['postcode'];
       $bill_name = $value['name'];
       $bill_email = $value['email'];
	   $bill_phone = $value['phone'];
		$bill_stdcode = $value['std_code'];
       $city = $value['city'];
       $state_name = $value['state_name'];
       $country_name = $value['country_name'];
    }

    foreach ($customer_details as $key => $value) {
       $first_name = $value['first_name'];
       $last_name = $value['last_name'];
       $email = $value['email'];
       $mobile = $value['mobile'];
    }

    foreach ($order_master_data as $key => $value) {
       $order_no = $value['order_no'];
       $pickup_status = $value['pickup_status'];
       $sub_total_amount = $value['sub_total_amount'];
       $order_amount = $value['order_amount'];
       $order_status = $value['order_status'];
       $payment_method = $value['payment_method'];
       $create_date = $value['create_date'];
       $tax_percent = $value['tax_percent'];
       $tax_amount = $value['tax_amount'];
    }

    ?>


    <body>
        <section class="invoice-page" style="margin: 28px 0 50px;">
            <div class="container" style="width: 100%;
            margin: 0 auto;">
            <div style="text-align: center; padding-bottom: 22px;">
                <img src="<?php echo base_url('assets/templates/');?>/images/1612187255_header_logo.png" alt="">
            </div>

            <table cellspadding="0" cellsspacing="0" class="table invoice-table1" style="width: 100%; text-align: center;     border-collapse: collapse;">
                <thead style="">

                    <tr>
                        <th style="text-align: left; border: 0;">
                            <h3 style="color: #414347;
                            text-transform: uppercase;
                            font-weight: 600;
                            font-size: 18px;
                            line-height: 22px;
                            margin: 0 0 25px;
                            ">invoice</h3>
                        </th>
                        <th style="text-align: right; border: 0;">
                            <h3 style="color: #414347;
                            text-transform: uppercase;
                            font-weight: 600;
                            font-size: 18px;
                            line-height: 22px;
                            margin: 0 0 25px;">
                            Order No. <?php echo $order_no; ?>
                        </h3>
                    </th>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <td style="text-align: left;
                    background-color: #c4c3c8;

                    margin-top: 18px;
                    padding: 10px 10px;
                    color: #222;
                    font-size: 17px;
                    font-weight: 600;
                    border-left: 1px solid #000;
                    border-top: 1px solid #000;">Billed To:
                </td>
                <td style="text-align: right;  background-color: #c4c3c8;

                margin-top: 18px;
                padding: 10px 10px;
                color: #222;
                font-size: 17px;
                font-weight: 600;  border-right: 1px solid #000;
                border-top: 1px solid #000;">
            </td>
        </tr>
        <tr>
            <td style="text-align: left;padding: 7px 12px 0px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;
            text-transform: uppercase;
            color: #31343d;
            font-weight: 600; border-left: 1px solid #000;"><?php echo $bill_name ?></td>
            <td style="text-align: right;padding: 0px 12px 0px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;
            text-transform: uppercase;
            color: #31343d;
            font-weight: 600;  border-right: 1px solid #000;"></td>
        </tr>
        <!--
            <tr>
                <td style="text-align: left;padding: 10px 12px 10px 12px;
                font-size: 14px;
                line-height: 17px;
                border: 0;

                color: #31343d;
                font-weight: 600; border-left: 1px solid #000;">Email: <?php echo $bill_email; ?></td>
                <td style="text-align: right;padding: 10px 12px 10px 12px;
                font-size: 14px;
                line-height: 17px;
                border: 0;

                color: #31343d;
                font-weight: 600;  border-right: 1px solid #000;"></td>
            </tr>
        -->

        <tr>
            <td style="text-align: left;padding: 0px 12px 0px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600; border-left: 1px solid #000;"><?php echo $address2 ?> </td>
            <td style="text-align: right;padding: 0px 12px 0px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600;  border-right: 1px solid #000;"> </td>
        </tr>
        <tr>
            <td style="text-align: left;padding: 0px 12px 0px 12px;
            font-size: 14px;line-height: 17px;border: 0;color: #31343d;
            font-weight: 600; border-left: 1px solid #000;">
                <?php echo $city.', '.$state_name.', '.$country_name.', '.$postcode; ?>
            </td>
            <td style="text-align: right;padding: 0px 12px 00px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600;  border-right: 1px solid #000;"></td>
        </tr>
        <!--
        <tr>
            
            <td style="text-align: left;padding: 7px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600; border-left: 1px solid #000;"><?php echo $state_name; ?></td>
             <td style="text-align: right;padding: 7px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;
            text-transform: uppercase;
            color: #31343d;
            font-weight: 600;  border-right: 1px solid #000;"></td>
            
        </tr>

        <tr>
            
            <td style="text-align: left;padding: 7px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600; border-left: 1px solid #000;"><?php echo $country_name; ?></td>
             <td style="text-align: right;padding: 7px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;
            text-transform: uppercase;
            color: #31343d;
            font-weight: 600;  border-right: 1px solid #000;"></td>
        </tr>
            -->
        <tr>
            <td style="text-align: left;padding: 0px 12px 0px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600; border-left: 1px solid #000;"> Number :<?php echo $bill_stdcode;?> <?php echo $bill_phone; ?></td>
            <td style="text-align: right;padding: 0px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600;  border-right: 1px solid #000;"></td>
        </tr>

        <tr>
            <td style="text-align: left;padding: 0px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600; border-left: 1px solid #000;"> Email : <?php echo $bill_email; ?></td>
            <td style="text-align: right;padding: 7px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600;  border-right: 1px solid #000;"></td>
        </tr>
         
        <tr>
            <td style="text-align: left;
            font-size: 14px;
            line-height: 17px;
            border: 0;
            color: #222;
            font-size: 17px;
            font-weight: 600;
            border-left: 1px solid #000;
            background-color: #c4c3c8;
            padding: 7px 12px 11px 12px;">Payment Method:</td>
            <td style="text-align: right; padding: 7px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;
            color: #222;
            font-size: 17px;
            font-weight: 600;  border-right: 1px solid #000;background-color: #c4c3c8;">Order Date:</td>
        </tr>
        <tr>
            <td style="text-align: left;padding: 7px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;

            color: #31343d;
            font-weight: 600; border-left: 1px solid #000;
            border-bottom: 1px solid #000;"><?php echo $payment_method; ?></td>
            <td style="text-align: right;padding: 7px 12px 11px 12px;
            font-size: 14px;
            line-height: 17px;
            border: 0;
            color: #31343d;
            font-weight: 600;
            border-right:1px solid #000;border-bottom: 1px solid #000;"> 
            <?php echo  date_time_format($create_date,3); ?></td>
        </tr>

    </tbody>

</table>
<h2 style=" text-align: center;
margin: 0;
padding: 40px 0 25px;
font-size: 26px;
color: #535354;
font-weight: 700;">ORDER SUMMARY</h2>
<table cellspadding="0" cellsspacing="0" class="table invoice-table2" style="width: 100%; text-align: center;     border-collapse: collapse;">

    <thead style="    background: #c4c3c8;">
        <tr>
            <th style="    padding: 10px 10px;border: 1px solid #000;
            border-collapse: collapse;font-size: 14px;
            line-height: 15px;
            color: #313131;
            font-weight: 700;">Product </th>
            <th style="    padding: 10px 10px;border: 1px solid #000;
            border-collapse: collapse;font-size: 14px;
            line-height: 15px;
            color: #313131;
            font-weight: 700;">SKU </th>
            <th style="    padding: 10px 10px;border: 1px solid #000;
            border-collapse: collapse;font-size: 14px;
            line-height: 15px;
            color: #313131;
            font-weight: 700;">Unit Price </th>
            <th style="    padding: 10px 10px;border: 1px solid #000;
            border-collapse: collapse;font-size: 14px;
            line-height: 15px;
            color: #313131;
            font-weight: 700;">Quantity </th>
        <!--
                            <th style="    padding: 10px 10px;border: 1px solid #000;
        border-collapse: collapse;font-size: 14px;
        line-height: 15px;
        color: #313131;
        font-weight: 700;">Amount </th>
    -->
    <th style="    padding: 10px 10px;border: 1px solid #000;
    border-collapse: collapse;font-size: 14px;
    line-height: 15px;
    color: #313131;
    font-weight: 700;">Pickup Address </th>
    <th style="    padding: 10px 10px;border: 1px solid #000;
    border-collapse: collapse;font-size: 14px;
    line-height: 15px;
    color: #313131;
    font-weight: 700;">Delivery Address </th>
    <th style="    padding: 10px 10px;border: 1px solid #000;
    border-collapse: collapse;font-size: 14px;
    line-height: 15px;
    color: #313131;
    font-weight: 700;">Tax(%) </th>
    <th style="    padding: 10px 10px;border: 1px solid #000;
    border-collapse: collapse;font-size: 14px;
    line-height: 15px;
    color: #313131;
    font-weight: 700;">Total </th>

</tr>
</thead>
<tbody>
    <?php  
// echo "<pre>";print_r($order_transaction_data);die();
    foreach ($order_transaction_data as $value) {  
        if($value['cancel_status'] == 'YES'){
            continue;
        }
        

    $delivery_method = $value['delivery_method'];
    $delivery_address = 'NA';
    $pick_up_address = 'NA';
    //
    // echo "<pre>";print_r($value['delivery_address'][0]);die();
    // foreach ($value['delivery_address'][0] as $val) {


    //    $address_data = implode(", ",$val['name'],$val['company_name'],$val['address2'],$val['city'],$val['state'],$val['state'],$val['country_name'],$val['postcode'],$val['phone'],$val['email']) ;
    // }
    $delivery_address_data = $value['delivery_address'][0] ;


    $name = $delivery_address_data['name'] !='' ? $delivery_address_data['name'] : 'NA, ';
    $company_name = $delivery_address_data['company_name'] !=''? $delivery_address_data['company_name'].', ' : ' ';
    $address2 = $delivery_address_data['address2'] !='' ? $delivery_address_data['address2'].', '  : 'NA ';
    $city = $delivery_address_data['city'] !='' ? $delivery_address_data['city'].', ' : '';
    $state = $delivery_address_datatate['state'] !='' ? $delivery_address_datatate['state'].', ' :'';
    $country_name = $delivery_address_data['country_name'] !='' ? $delivery_address_data['country_name'].', ' :'NA ';
    $postcode = $delivery_address_data['postcode'] !='' ? $delivery_address_data['postcode'].', ' :'NA ';
	$std_code = $delivery_address_data['std_code'] !='' ? $delivery_address_data['std_code'].' ' : 'NA, ';
    $phone = $delivery_address_data['phone'] !='' ? $delivery_address_data['phone'].', ' : 'NA, ';
    $email = $delivery_address_data['email'] !='' ? $delivery_address_data['email'] : 'NA';
      
    

        if($delivery_method == 'pick_up'){
            $pick_up_address = $name.$company_name.$address2.$city.$state.$country_name.$postcode.$phone.$email;
        }
        if($delivery_method == 'delivery'){
            $delivery_address = $name.$company_name.$address2.$city.$state.$country_name.$postcode.$std_code.$phone.$email;
        }


        ?>
        <tr>
            <td style="border: 1px solid #000;
            border-collapse: collapse;padding: 10px 10px;font-size: 13px;
            line-height: 16px;color: #000;font-weight: 400;">
            <?php 
            echo $value['name'].'<br>'; 
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
        <td style="border: 1px solid #000;
        border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
        line-height: 16px;
        color: #000;
        font-weight: 400;"> <?php echo $value['sku']; ?></td>
        <td style="border: 1px solid #000;
        border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
        line-height: 16px;
        color: #000;
        font-weight: 400;"> SR <?php echo  number_format($value['selling_price']); ?></td>
        <td style="border: 1px solid #000;
        border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
        line-height: 16px;
        color: #000;
        font-weight: 400;"><?php echo $value['quantity'] ?></td>
       
    <td style="border: 1px solid #000;
    border-collapse: collapse;padding: 12px 10px;font-size: 13px;
    line-height: 16px;color: #000;font-weight: 400;"> 
       <?php echo $pick_up_address; ?>
    </td>
    <td style="border: 1px solid #000;
    border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
    line-height: 16px;color: #000;font-weight: 400;"> 
        <?php echo $delivery_address; ?>
    </td>

    <td style="border: 1px solid #000;
        border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
        line-height: 16px;color: #000;font-weight: 400;"> (<?php 
           echo  str_replace(".00", "", (string)number_format ($tax_percent, 2, ".", "")).'%';?>): 
         SR <?php echo $value['product_total_amount'] *($tax_percent/100); ?>
    </td>

<td style="border: 1px solid #000;
border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
line-height: 16px;
color: #000;
font-weight: 400;"> SR
<?php echo
$value['product_total_amount'] + $value['product_total_amount']*($order_master_data[0]['tax_percent']/100);
?>
 <?php //echo ($value['product_total_amount'] * $value['quantity']) + $value['product_total_amount'] *($tax_percent/100); ?>
     
 </td>

</tr>
<?php  }?>
<tr>
    <td colspan="6" style="border: 1px solid #000;
        border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
        line-height: 16px;color: #000;font-weight: 400;">
    </td>


    <td colspan="2" style="border: 1px solid #000;
        border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
        line-height: 16px;color: #000;font-weight: 400;">Tax : <?php echo 'SR '.$tax_amount; ;?>
    </td>
                
</tr>

<tr>
    <td colspan="6" style="border: 1px solid #000;
        border-collapse: collapse;padding: 12px 10px;    font-size: 13px;
        line-height: 16px;color: #000;font-weight: 400;">
    </td>


    <td colspan="2" style="border: 1px solid #000;
        border-collapse: collapse;padding: 12px 10px;    font-size: 13px;

        line-height: 16px;color: #000;font-weight: 400;">Total : <?php echo 'SR '.$order_amount; ;?>
    </td>
                
</tr>

</tbody>
</table>
<table cellspadding="0" cellsspacing="0" class="table invoice-table2" style="width: 100%; border-collapse: collapse;">
    <tbody>
        <tr>
            <td style="text-align: left;     padding-top: 41px;"><span style="font-weight: 700;">Amount in words:</span>
             <!-- Sixty-nine thousand one hundred thirty-four rupees only -->
             <?php echo number_to_word($order_amount) ;  ?>

            </td>
        </tr>
    </tbody>
</table>
</div>
</section>
</body>

</html>
