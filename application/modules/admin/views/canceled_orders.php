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
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div id="msg_div">
                                        <?php if ($this->session->flashdata('success') != '') { ?>
                                            <?php echo $this->session->flashdata('success'); ?>
                                        <?php } ?>
                                    </div>
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption"><i class="fa fa-globe"></i>Customer Orders</div>
                                            <div class="tools"></div>
                                        </div>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-hover" id="data_table">
                                                <thead>
                                                    <tr>
                                                        <th>SI No.</th>
                                                        <th> Order No.</th>
                                                        <th> Amount</th>
                                                        <th> Status</th>
                                                        <th> Payment Method</th>
                                                        <th> Request No</th>
                                                        <th> Date</th>
                                                        <th> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    if (variable_array_check($order_data)) {
                                                        foreach ($order_data as $key => $value) {
//                                                            echo json_encode($value);
                                                            ?>
                                                            <tr>
                                                                <th><?= $key + 1 ?></th>
                                                                <td><?= $value['order_no'] ?></td>
                                                                <td>SR <?= $value['order_amount'] + 0 ?></td>
                                                                <td>CANCELED</td>
                                                                <td><?= $value['payment_method'] ?></td>
                                                                <td><?= $value['design_request_order_id'] ?></td>
                                                                <td><?= date('d-m-Y', strtotime($value['create_date'])) ?></td>
                                                                <td>
                                                                    <a title="Edit" href="<?= base_url('admin/order-history/details/' . $value['id']) ?>" class="btn-sm btn-success rounded-corner btn-share">View</a>
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
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('common/footer'); ?>
            </div>
            <?php $this->load->view('common/js_include'); ?>
        </div>
    </body>
</html>