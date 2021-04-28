<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>

<!--Body content start-->
<section id="artist-accept-decline">
    <div class="custom-width">
        <div class="artist-heading">
            <h1>Quotation Payment Breakup</h1>
        </div>

        <div class="artist-accept-decline-inner">
            <form action="<?php echo base_url('milestone-amount-update'); ?>" method="post" class="swt_form">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <input type="hidden" name="milestone_type_name" value="<?php echo $milestone_type_name; ?>">
                <input type="hidden" name="amount" value="<?= $amount ?>">
                <input type="hidden" name="created_by" value="<?= isset($created_by) ? $created_by : 'designer' ?>">

                <div class="artist-right-panel">
                    <div class="artist-dasbord-area">
                        <div class="col-sm-12">
                            <div class="artist-dasbord pb0">
                                <div class="artist-dasbord-item designrequest">
                                    <?php
                                    if($milestone_type_name == 'down_payment_percentage'){
                                        $milestone_name = 'Down Payment ';
                                    }
                                    if($milestone_type_name == 'before_complete_project_percentage'){
                                        $milestone_name = 'First Stage Payment ';
                                    }
                                    if($milestone_type_name == 'after_complete_project_percentage'){
                                        $milestone_name = 'Final Payment ';
                                    }
                                    ?>
                                    <h5><?php echo $milestone_name; ?></h5>
                                    <h5>Cost - SR <?php echo $amount + 0; ?>/-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-btn-area">
                    <button class="save form_submit">
                        Pay <?= $milestone_name ?>
                    </button>

                </div>
            </form>
        </div>
    </div>

</section>
<!--Body content end-->

<?php
$this->load->view('common/footer');
$this->load->view('common/footer_js');
?>
</body>
</html>