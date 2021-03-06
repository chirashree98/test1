<!DOCTYPE html>
<html>
    <head>
       
		<?php $this->load->view('common/header'); ?>  
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        <div class="clearfix"></div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" />  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.min.js"></script>

 <style type="text/css">
.select2-container--default .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: #888 transparent transparent transparent;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}
  

.select2-container--open .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: transparent transparent #888 transparent;
    border-width: 0 4px 5px 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}
  </style>


        <section id="my-account">
            <div class="custom-width">
                <div class="page-heading">
                    <h1>Edit Message </h1>
                </div>
				<div class="artist-accept-decline-inner">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="artist-left-panel">
                               <?php $this->load->view('common/myaccount_side_panel'); ?> 
                            </div>
                        </div>
                 <div class="col-md-9">
<span id="msg_box">
                                <?php if ($this->session->flashdata('success') != '') { ?>
                                    <?php echo $this->session->flashdata('success'); ?>
                                <?php } ?>
                            </span>
                                <div class="my-account-left-panel">
                                    <div class="my-account-left-panel-sec1">
                            
                            
                                    <h4>Edit Message</h4>
                                    <?php //print_r($query);?>
                                    <div class="my-account-left-panel-sec1-inner">

                                        <div class="row">
                                            <div class="col-md-9 pull-md-3">

                                                <form action="<?php echo base_url(); ?>update_service" id="myFrm" method="post" enctype="multipart/form-data" >
                                                    
													<input type="hidden" name="user_id" value="<?php echo $query['user_id'];?>">
													<div class="form-group">
                                                     <div class="caption"> <i class="icon-settings font-red"></i> <span class="caption-subject font-red sbold uppercase"> Message </span> </div>
													 <textarea name="message" placeholder="message"></textarea>
                                                    </div>
                                                    
                                                  
                                                  
                                                    <div class="form-group">
                                                        <!--
                                                        <button class="back">Back</button>-->
                                                        <!--<button  class="back"href="<?php echo base_url(); ?>account">Back</button>-->
                                                        <button class="continue" id = "editservice"  >Send Email</button>
                                                    </div>
                                                </form>
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
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Order No.</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Payment Method</th>
                                                    <th>Request No</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                               if(count($users)){
                                                    foreach ($users as $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $value['order_no'] ?></td>
                                                            <td>SR <?= $value['order_amount'] + 0 ?></td>
                                                            <td><?= $value['order_status'] ?></td>
                                                            <td><?= $value['payment_method'] ?></td>
                                                            <td><?= $value['design_request_order_id'] ?></td>
                                                            <td><?= date('d-m-Y', strtotime($value['create_date'])) ?></td>
                                                            <td>
                                                                <a href="<?= base_url('order-history/details/'.$value['id']) ?>">
                                                                    <img src="<?= base_url('assets/front/images/eye.png') ?>">
                                                                </a>
                                                            </td>

                                                        </tr>
                                                       
                                                <?php
                                                 } else {
                                                    ?>
                                                <tr>
                                                    <td colspan="7" align="center">No order found.</td>
                                                </tr>
												<?php } ?>
                                                </tbody>
                                            </table>
  </div>
                        </div>
                                   

                       
            </div>
        </section>




        <div class="clearfix"></div> 

        <?php $this->load->view('common/footer'); ?>  

    </body>
	<?php $this->load->view('common/footer_js'); ?>
   
    <script>
 
 $("#products2").select2({
 placeholder: "------ Shopowner Products ------ ",
   maximumSelectionLength: 6,
  tags: true
 });
 
   $("#products2").on("select2:select", function (evt) {
     var element = evt.params.data.element;
     var $element = $(element);
     
     window.setTimeout(function () {  
   if ($("#products2").find(":selected").length > 1) {
     var $second = $("#products2").find(":selected").eq(-2);
     
     $element.detach();
     $second.after($element);
   } else {
     $element.detach();
     $("#products2").prepend($element);
   }
   
   $("#products2").trigger("change");
   }, 1);
 });
 $("#products").select2({
 placeholder: "------ similar featured Products ------ ",
  
  tags: true
 });
 
   $("#products").on("select2:select", function (evt) {
     var element = evt.params.data.element;
     var $element = $(element);
     
     window.setTimeout(function () {  
   if ($("#products").find(":selected").length > 1) {
     var $second = $("#products").find(":selected").eq(-2);
     
     $element.detach();
     $second.after($element);
   } else {
     $element.detach();
     $("#products").prepend($element);
   }
   
   $("#products").trigger("change");
   }, 1);
 });
 </script>


    <?php $this->load->view('common/footer_js'); ?>  

    <script>


        $('#editservice').on('click', function () {
            $(".error_msg").html('');
			

            if ($('#shop_name').val() == '') {
                $('#shop_name').next(".error_msg").html('Please enter Shop name');
                $('#shop_name').focus();
                return false;
            }
           if ($('#shop_description').val() == '') {
                $('#shop_description').next(".error_msg").html('Please enter Shop description');
                $('#shop_description').focus();
                return false;
            }
			
			
				if ($('#title').val() == '') {
				  //alert(123);
                $('#title').next(".error_msg").html('Please enter title');
                $('#title').focus();
                return false;
            }
			if ($('#text25').val() == '') {
				//alert(123);
                $('#text25').next(".error_msg").html('Please enter description');
                $('#text25').focus();
                return false;
            }if ($('#message').val() == '') {
				//alert(123);
                $('#message').next(".error_msg").html('Please enter message heading');
                $('#message').focus();
                return false;
            }
			
		
			
			
			
            
            
            
            /* if ($('#role_id').val() == '1') {
             
             
             if ($('#accrediation').val() == '') {
             $('#accrediation').next(".error_msg").html('Please enter accrediation number');
             $('#accrediation').focus();
             return false;
             }
             
             if ($('#virtual_studio').val() == '') {
             $('#virtual_studio').next(".error_msg").html('Please enter virtual studio name');
             $('#virtual_studio').focus();
             return false;
             }
             
             if ($('#service').val() == '') {
             $('#service').next(".error_msg").html('Please select service');
             $('#service').focus();
             return false;
             }
             
             if ($('#membership_id').val() == '') {
             $('#membership_id').next(".error_msg").html('Please select membership');
             $('#membership_id').focus();
             return false;
             }
             
             }
             if ($('#role_id').val() == '6') {
             
             if ($('#virtual_studio').val() == '') {
             $('#virtual_studio').next(".error_msg").html('Please enter virtual studio name');
             $('#virtual_studio').focus();
             return false;
             }
             if ($('#products_types1').val() == '') {
             $('#products_types1').next(".error_msg").html('Please select product types');
             $('#products_types1').focus();
             return false;
             }
             if ($('#membership_id').val() == '') {
             $('#membership_id').next(".error_msg").html('Please select membership');
             $('#membership_id').focus();
             return false;
             }
             
             */
        });




        $('#country').on('change', function () {
            //alert($('#country').val());
            // $('#state').hide();

            $('.loader').show();

            $.post('<?php echo base_url(); ?>frontend/user/getstate', 'country_id=' + $('#country').val(), function (data) {
                $('#state').html(data);
                $('.loader').hide();
            });
        });

    </script>
	

        <script src="<?php echo base_url(); ?>assets/admin/global/scripts/jquery.datetimepicker.full.min.js"></script>
        <script>


                                                                $(document).on("click", ".remove", function () {
                                                                    $(this).parent().remove();
                                                                });
                                                                function getCat() {
                                                                    $.post('<?php echo base_url(); ?>admin/product_management/get_sub_category', 'c_id=' + $('#cat_id').val(), function (data) {
                                                                        $('#sub_cat_id').html(data);
                                                                    });
                                                                }
        </script>

</html>
