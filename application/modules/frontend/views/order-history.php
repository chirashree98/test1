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
							<form class="search-order-no-form">
                                    <div class="form-group col-md-6">
                                        <input type="text" id="orderno" required name="orderno" placeholder="Enter order no" width="50px" class="form-control validate"><span><i class="fa fa-search" aria-hidden="true"></i></span>
                                    </div>
                                </form>
                                <p>Your Order History</p>
								 
                                <div class="wishlist-area">
                                    <div class="cart mb-0">
                                        <div class="table-responsive"  id="table">
                                            <table class="table" id="default-datatable22s">
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
                                                <tbody id="response2">
                                                <?php
                                                if (variable_array_check($order_data)) {
                                                    foreach ($order_data as $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $value['order_no'] ?></td>
                                                            <td>SR <?= $value['order_amount'] + 0 ?></td>
                                                            <td><?= ucwords(strtolower($value['order_status'])) ?></td>
                                                            <td><?= ucwords(strtolower($value['payment_method'])) ?></td>
                                                            <td><?= $value['design_request_order_id'] ?></td>
                                                            <td><?= date('d-m-Y', strtotime($value['create_date'])) ?></td>
                                                            <td>
                                                                <a href="<?= base_url('order-history/details/'.$value['id']) ?>">
                                                                    <img src="<?= base_url('assets/front/images/eye.png') ?>">
                                                                </a>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                <tr>
                                                    <td colspan="7" align="center">No order found.</td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
											<div class="wishlist-area"id="default-datatable22s4"style="display:none;">
                                    <div class="cart">
                                        <div class="table-responsive"  id="table">
                                            <table class="table" id="default-datatable22s4">
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
                                                <tbody id="response24">
                                                <?php
                                                if (variable_array_check($order_data)) {
                                                    foreach ($order_data as $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $value['order_no'] ?></td>
                                                            <td>SR <?= $value['order_amount'] + 0 ?></td>
                                                            <td><?= ucwords(strtolower($value['order_status'])) ?></td>
                                                            <td><?= ucwords(strtolower($value['payment_method'])) ?></td>
                                                            <td><?= $value['design_request_order_id'] ?></td>
                                                            <td><?= date('d-m-Y', strtotime($value['create_date'])) ?></td>
                                                            <td>
                                                                <a href="<?= base_url('order-history/details/'.$value['id']) ?>">
                                                                    <img src="<?= base_url('assets/front/images/eye.png') ?>">
                                                                </a>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
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
                            </div>
                        </div>
					
				<div class="pagination mb23" id="page">
						
							 <?php if ($order_data2->num_rows() > floatval($limit)) { ?>
                            <span>Showing <?=abs($page+1)?>-<?php echo floatval($page + $order_data2->num_rows());?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } else { ?>
                                <span>Showing <?=$page?>-<?php echo floatval($page + $order_data2->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } ?>
                            <ul>
                               
								<?php echo $links; ?>
                                <!--<span>Showing 1-7 of 7 item(s)</span>
    <ul>
    <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> &nbsp; Previous</a></li>
        <li><a href="#">1</a></li>
        <li class="active"><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#"> Next &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
    </ul>-->
                            </ul>
                        </div>
               	
                    </div>
                </div>
      

                 
</section>


<div class="clearfix"></div>

<?php $this->load->view('common/footer'); ?>


</body>
<?php $this->load->view('common/footer_js'); ?>

</html>
<script>
    $(document).ready(function() {
        $("#orderno").keyup(function() {
           ///alert(123);
            if ($("#orderno").val().length > 0) {
                var orderno = $("#orderno").val();
                //alert(orderno);
                $.ajax({
                    url: "<?php echo base_url()?>frontend/Customer_dashboard_controller/search_order_job",
                    method: "post",
                    data: 'orderno=' + $("#orderno").val(),
                    success: function(response) {
                        //alert(response);
                        //alert(response);return false;
                        //alert('234');
                        //$("#default-datatable22s").show();
                        $('#response2').show();
                        $('#response2').html(response);
                        $('#default-datatable22s').show();
                        $('#default-datatable22s4').hide();
                        $('#response24').hide();
						$('#page').hide();


                        //$("#delete").hide();
                    },
                    error: function() {
                        //alert("Error Request");
                    }
                });
            }
            if ($("#orderno").val().length == 0) {
                //alert(123);

                $('#table').show();
                $('#default-datatable22s4').show();
                $('#response24').show();
                $('#response2').hide();
                $('#default-datatable22s').hide();
				$('#page').show();
				
                //$("#default-datatable22s").show();
                //alert(123);

            }
            return false;
        });

    });

</script>
