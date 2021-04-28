<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>
<!--+++++++++++++ Header End +++++++++++++++++++-->
<div class="clearfix"></div>
<section id="artist-accept-decline">
    <div class="custom-width">
        <div class="artist-heading">
            <h1>Transaction History</h1>
        </div>

          <div class="my-account-inner">
            <div class="col-md-3">
                            <div class="artist-left-panel">
                               <?php $this->load->view('common/myaccount_side_panel'); ?> 
                            </div>
                        </div>
                <!--Body Start-->
                <div class="col-md-9">
                    <div class="artist-right-panel">
                        <div class="design-requst-inner arnamoun">
                            <div class="design-requst-inner-sub">
                                 <div class="my-account-left-panel-sec1-inner p-0">
                                <?php if(isset($total_show)){ ?>
                               
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Total Earn Amount:</label>
                                               <span> SR <?= $total_sum ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Total Admin Earning Amount:</label>
                                               <span>SR <?= $admin_paid_amount ?></span> 
                                            </div>
                                        </div>
                                        <?php if(isset($total_order)){ ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Total Orders:</label>
                                                    <span><?= $total_order ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    
                                <?php } ?>
                                <form action="" method="get" class="datepikarcls">
                                    <input type="hidden" name="designer_id" value="<?= isset($designer_id) ? $designer_id : '' ?>">
                                    <input type="hidden" name="store_id" value="<?= isset($store_id) ? $store_id : '' ?>">
                                    <input type="hidden" name="customer_id" value="<?= isset($customer_id) ? $customer_id : '' ?>">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Form Date:</label>
                                                <input type="text" name="from_date" class="form-control ui_datepicker"
                                                       value="<?= isset($form_date) ? $form_date : '' ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">To Date:</label>
                                                <input type="text" name="to_date" class="form-control ui_datepicker"
                                                       value="<?= isset($to_date) ? $to_date : '' ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success" name="submit"
                                                        value="submit">Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Order Type</th>
                                            <th>Order No/Job No</th>
                                            <th> Order Date</th>
                                            <th> Artist Name</th>
                                            <!--<th> Store Name</th>-->
                                            <th> Customer Name</th>
                                            <th> Customer Paid Amount(Without Tax)</th>
                                            <th> Tax Percent</th>
                                            <th> Tax Amount</th>
                                            <th> Paid To</th>
                                            <th> Paid Percentage</th>
                                            <th> Paid Amount</th>
                                            <th> Design Code</th>
<!--                                            <th> Main Studio's Percentage</th>
                                            <th> Main Studio's Get Amount</th>
                                            <th> Profit Share To</th>
                                            <th> Profit Share Percentage</th>
                                            <th> Profit Share Amount</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (variable_array_check($transaction_history_data)) {
                                            foreach ($transaction_history_data as $key => $row) {
                                                ?>
                                                <tr>
                                                    <td><?= variable_value_check($row['request_order_no']) ? strtoupper($row['request_service_type_name']) : ($row['order_type'] == 'checkout'? 'PRODUCT PURCHASE' :strtoupper($row['order_type'])) ?></td>
                                                    <td><?= variable_value_check($row['request_order_no']) ? $row['request_order_no'] : $row['checkout_order_no'] ?></td>
                                                    <td><?= date('d-m-Y', strtotime($row['order_date'])) ?></td>
                                                    <td><?= $row['artist_first_name'] . ' ' . $row['artist_last_name'] ?></td>
                                                    <!--<td><?php // $row['store_first_name'] . ' ' . $row['store_last_name'] ?></td>-->
                                                    <td><?= $row['customer_first_name'] . ' ' . $row['customer_last_name'] ?></td>
                                                    <td><?= $row['total_amount_customer_pay'] + 0 ?></td>
                                                    <td><?= $row['tax_percent'] ?></td>
                                                    <td><?= $row['total_amount_customer_pay'] * ($row['tax_percent']/100) ?></td>
                                                    <td><?= strtoupper($row['paid_user_type']) ?></td>
                                                    <td><?= $row['paid_percentage'] + 0 ?></td>
                                                    <td><?= $row['paid_amount'] + 0 ?><?= ($row['request_action'] == 'DECLINED') || ($row['job_close_status_admin'] == 'CLOSED') ? ' Money transfer to main studio' : '' ?></td>
                                                    <td><?= $row['design_code'] ?></td>
                                                    <td><?php // $row['admin_get_percentage'] + 0 ?></td>
                                                    <td><?php // $row['admin_get_amount'] + 0 ?><?php // ($row['request_action'] == 'DECLINED') || ($row['job_close_status_admin'] == 'CLOSED') ? '+'. $row['paid_amount'] : '' ?></td>
                                                    <td><?php // strtoupper($row['profit_user_type']) ?></td>
                                                    <td><?php // $row['profit_get_percentage'] + 0 ?></td>
                                                    <td><?php // $row['profit_get_amount'] + 0 ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="17">No record found.</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Body End-->
           
</section>
<div class="clearfix"></div>
<?php $this->load->view('common/footer'); ?>
</body>
<?php $this->load->view('common/footer_js'); ?>
</html>

