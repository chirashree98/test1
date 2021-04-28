<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/header'); ?>
    <link href="<?php echo base_url(); ?>assets/front/css/chat.css" rel="stylesheet">
</head>

<body>
    <?php $this->load->view('common/header_nav'); ?>
    <!--+++++++++++++ Header End +++++++++++++++++++-->
    <div class="clearfix"></div>
    <section id="artist-accept-decline">
        <div class="custom-width">
            <div class="artist-heading">
                <h1>DESIGNER Dashboard</h1>
            </div>

            <div class="artist-accept-decline-inner">
                <div class="row">
                    <div class="col-md-3">
                        <div class="artist-left-panel">
                            <?php $this->load->view('artist/artist-left-panel'); ?>
                        </div>
                    </div>
                    <!--Body Start-->
                    <div class="col-md-9">
                        <div class="artist-right-panel">
                            <button class="back-to-design-request" onclick="location.href='<?= base_url('request-ad') ?>';">
                                <img src="<?= base_url('assets/front/images/back-arrow.png') ?>"> BACK TO DESIGN REQUEST
                            </button>
                            <?php if ($accept_decline_view_data[0]['service_id'] != '1' && $accept_decline_view_data[0]['request_action'] == 'ACCEPTED' && $design_conversation_status_before_action == TRUE && ($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED' && $accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED')) { ?>
                            <a class="back-to-design-request close-this-job" href="<?= base_url('job-close/' . $accept_decline_view_data[0]['order_table_id']) ?>">
                                Close this job
                            </a>
                            <?php } elseif ($accept_decline_view_data[0]['service_id'] == '1' && $accept_decline_view_data[0]['request_action'] == 'ACCEPTED' && ($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED' && $accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED') && (variable_array_check($quotation_data) == TRUE || variable_array_check($view_fixed_time_frame) == TRUE)) { ?>
                            <a class="back-to-design-request close-this-job" href="<?= base_url('job-close/' . $accept_decline_view_data[0]['order_table_id']) ?>">
                                Close this job
                            </a>
                            <?php } ?>

                            <span id="msg_box">
                                <?php if ($this->session->flashdata('error') != '') { ?>
                                <?php echo $this->session->flashdata('error'); ?>
                                <?php } ?>
                            </span>
                            <span id="msg_box">
                                <?php if ($this->session->flashdata('success') != '') { ?>
                                <?php echo $this->session->flashdata('success'); ?>
                                <?php } ?>
                            </span>
                            <div class="design-requst-inner">
                                <h4>Request Details</h4>
                                <div class="design-requst-inner-sub">
                                    <div class="request-details-page-inner">
                                        <p>
                                            <b>Job Number :</b>
                                            <span> <?= $accept_decline_view_data[0]['job_number'] ?></span>
                                        </p>
                                        <p>
                                            <b>Request Date / Date of Request :</b>
                                            <span><?= date('d-m-Y', strtotime($accept_decline_view_data[0]['created_date'])) ?></span>
                                        </p>
                                        <p>
                                            <b>Type of Request :</b>
                                            <span><?= ucwords(strtolower($accept_decline_view_data[0]['type_name'])) ?></span>

                                        </p>
                                        <p>
                                            <b>Job Fees :</b>
                                            <span> <?= $accept_decline_view_data[0]['currency']  ?> <?= $accept_decline_view_data[0]['designer_type_amount'] + 0 ?></span>
                                        </p>
										 <?php if(($accept_decline_view_data[0]['request_action'] != 'PENDING')){?>
											<P>
                                            <b>Earn money from this job:</b>
											
                                            <?php if ($accept_decline_view_data[0]['job_close_status_artist'] == 'CLOSED') { ?>
                                            <span> <?= $accept_decline_view_data[0]['currency']  ?> <?= $accept_decline_view_data[0]['designer_type_amount'] + 0 ?></span>
											 
                                            <?php } elseif ($accept_decline_view_data[0]['job_close_status_admin'] == 'CLOSED') { ?>
                                            <span><?= $accept_decline_view_data[0]['currency']  ?> 0 [Money Transfer to Main Studio]</span>
                                            <?php } elseif ($accept_decline_view_data[0]['request_action'] == 'DECLINED'){ ?>
                                            <span><?= $accept_decline_view_data[0]['currency']  ?> 0 </span>
                                            <?php }elseif(($accept_decline_view_data[0]['request_action'] == 'ACCEPTED')&&($design_conversation_status==FALSE)&&(variable_array_check($quotation_data) == TRUE || variable_array_check($view_fixed_time_frame) != TRUE)){?>
                                            <span><?= $accept_decline_view_data[0]['currency']  ?> 0 </span>

                                            <?php } else { ?>
                                            <span><?= $accept_decline_view_data[0]['currency']  ?> <?php echo $accept_decline_view_data[0]['designer_type_amount'] + 0 ;
                                                    if($accept_decline_view_data[0]['request_action'] == 'ACCEPTED'){
                                                            echo " (Payable On Job Completion)";
                                                    } 
													if(($design_conversation_status==FALSE)&&($accept_decline_view_data[0]['request_action'] == 'DECLINED')&&($accept_decline_view_data[0]['job_close_status_admin'] == 'CLOSED')){?>
                                                <span><?= $accept_decline_view_data[0]['currency']?> 0 [Money Transfer to Main Studio]</span>
                                                <?php
                                                    } 
                                                  ?>
												

                                            </span>
                                            <?php } ?>


                                        </p>
										<?php
									}?>
										
									
                                        <p>
                                            <b>Request Action :</b>
                                            <?php
										if(($accept_decline_view_data[0]['request_action'] == 'ACCEPTED')&&($design_conversation_status_before_action==FALSE)&&(variable_array_check($quotation_data) == TRUE || variable_array_check($view_fixed_time_frame) != TRUE)){?>
                                            <?php echo "Transferred to  Main Studio";?>
                                            <?php
										}else{?>
                                            <span><?php echo ($accept_decline_view_data[0]['request_action'] == 'PENDING' && $design_conversation_status_before_action)? ucfirst(strtolower($accept_decline_view_data[0]['request_action'])) : (($accept_decline_view_data[0]['request_action'] == 'PENDING' && !$design_conversation_status_before_action)? 'Expired': ucfirst(strtolower($accept_decline_view_data[0]['request_action']))) ?></span>
                                            <?php
									}?>
                                            <!--<span><?php //  $accept_decline_view_data[0]['request_action'] ?></span>-->
                                        </p>
                                        <?php //if ($accept_decline_view_data[0]['service_id'] == 2 && $design_conversation_status == TRUE) { 
                                        if ($accept_decline_view_data[0]['service_id'] == 2) {?>
                                        <p>
                                            <b>Customer Shared Cart Link :</b>
                                            <span>
                                                <a href="<?= base_url('customer-request-cart/' . strtolower(str_replace(" ", "-", $accept_decline_view_data[0]['type_name'])) . '/' . $accept_decline_view_data[0]['order_table_id']) ?>" target="_blank">Click here</a>
                                            </span>
                                        </p>
                                        <?php } ?>
                                        <?php if (($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED' && $accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED') && $design_conversation_status == TRUE && $accept_decline_view_data[0]['service_id'] == 3) { ?>
                                        <p>
                                            <b>Create Cart for Customer :</b>
                                            <span>
                                                <a href="<?= base_url('create-cart-for-customer/' . $accept_decline_view_data[0]['order_table_id']) ?>" target="_blank">Click here</a>
                                            </span>
                                        </p>
                                        <?php } ?>
                                        <?php if (count($quotation_data) == 0 && $quotation_hour_check == true && ($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED' && $accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED')) {
                                        //design request quotation and timeline add code start
                                        ?>

                                        <b></b>
                                        <span><a href="javascript:void(0);" id="show_hide" class="back-to-design-request extend-time-frame">Add quotation amount & timeline</a></span>

                                        <form class="show_hide" action="<?= base_url('quotation-amount-save') ?>" method="post" style="display: none;">
                                            <input type="hidden" name="order_id" value="<?= $order_table_id ?>">
                                            <div class="ectantarea">
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Quotation Amount for customer
                                                                :</label>
                                                            <input type="text" name="quotation_amount" class="form-control" placeholder="After Quotation submit amount will be spilt in 3 milestone">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Time frame for the project
                                                                :</label>
                                                            <input type="number" name="time_frame_in_days" class="form-control" required="" placeholder="Input in days" min="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label class="control-label">Expected completion date
                                                            :</label>
                                                        <div class="form-group">
                                                            <input type="text" name="expected_completed_date" class="form-control ui_datepicker" required="" placeholder="yyyy-mm-dd">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="back-to-design-request">Submit Quotation
                                            </button>
                                        </form>
                                        <?php } //design request quotation and timeline add code end

                                    elseif (isset($quotation_data[0]['time_frame_in_days']) && $quotation_data[0]['expected_completed_date_2nd'] == '' && ($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED' && $accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED')) {
                                        //design request timeline 2nd time add code start
                                        ?>
                                        <span><a href="javascript:void(0);" id="show_hide" class="back-to-design-request extend-time-frame">Extend time frame</a></span>
                                        <form action="<?= base_url('quotation-timeline-save-again') ?>" method="post" class="show_hide" style="display: none;">
                                            <input type="hidden" name="order_id" value="<?= $order_table_id ?>">
                                            <input type="hidden" name="old_time_frame_in_days" value="<?= $quotation_data[0]['time_frame_in_days'] ?> ?>">
                                            <div class="ectantarea">
                                                <div class="row">
                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label class="control-label">New Time frame for the project
                                                                :</label>
                                                            <input type="number" name="time_frame_in_days_2nd" class="form-control" required="" placeholder="Input in days" min="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label class="control-label">New Expected completion date
                                                                :</label>
                                                            <input type="text" name="expected_completed_date_2nd" class="form-control ui_datepicker" required="" placeholder="yyyy-mm-dd">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="back-to-design-request">AddTimeline
                                            </button>
                                        </form>

                                        <?php }
                                    //design request timeline 2nd time add code end
                                    elseif (isset($quotation_data[0]['expected_completed_date_2nd']) && $quotation_data[0]['time_frame_in_days_3rd'] == '' && ($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED' && $accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED')){
                                        //design request timeline 3rd time add code start
                                        ?>

                                        <span><a href="javascript:void(0);" id="show_hide" class="back-to-design-request">Add timeline
                                            </a></span>

                                        <form class="show_hide" action="<?= base_url('quotation-timeline-save-again-3') ?>" method="post" style="display: none;">
                                            <input type="hidden" name="order_id" value="<?= $order_table_id ?>">
                                            <input type="hidden" name="old_time_frame_in_days" value="<?= $quotation_data[0]['time_frame_in_days_2nd'] ?> ?>">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">New Time frame for the project
                                                            :</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="number" name="time_frame_in_days_3rd" class="form-control" required="" placeholder="Input in days" min="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">New Expected completion date
                                                            :</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" name="expected_completed_date_3rd" class="form-control ui_datepicker" required="" placeholder="yyyy-mm-dd">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="back-to-design-request">Extend Timeline
                                            </button>
                                        </form>
                                        <?php
                                        //design request timeline 3rd time add code end
                                    }
                                    if (count($quotation_data) == 0 && $accept_decline_view_data[0]['service_id'] == '1' && $accept_decline_view_data[0]['cost_type'] == 'FIXED' && $accept_decline_view_data[0]['request_action'] == 'ACCEPTED' && (count($view_fixed_time_frame) < 3) && ($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED' && $accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED')) {
                                        if ($accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED') {
                                            if ($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED') {
                                                //design request fixed price project timeline add code start
                                                ?>

                                        <span><a href="javascript:void(0);" id="show_hide" class="back-to-design-request">Extend  timeline</a></span>

                                        <form class="show_hide" action="<?= base_url('job-timeline-save') ?>" method="post" style="display: none;">
                                            <input type="hidden" name="order_id" value="<?= $order_table_id ?>">
                                            <input type="hidden" name="service_type" value="<?= $accept_decline_view_data[0]['service_id'] ?>">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Time frame for the project
                                                            :</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="number" name="time_frame_in_days" class="form-control" required="" placeholder="Input in days" min="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Expected completion date
                                                            :</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" name="expected_completed_date" class="form-control ui_datepicker_time_frame" required="" placeholder="yyyy-mm-dd" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="back-to-design-request">Submit Timeline
                                            </button>
                                        </form>
                                        <?php
                                                //design request fixed price project timeline add code end
                                            }
                                        }
                                    }
                                    ?>

                                        <?php
                                    //project state/job status code start
                                    if ($accept_decline_view_data[0]['job_close_status_artist'] == 'CLOSED') { ?>
                                        <p>
                                            <b>Job Status :</b>
                                            <span class="artist_close">Closed by You.</span>
                                        </p>
                                        <?php } elseif ($accept_decline_view_data[0]['job_close_status_admin'] == 'CLOSED') {
                                        ?>
                                        <p>
                                            <b>Job Status :</b>
                                            <span class="admin_close"><?= $accept_decline_view_data[0]['job_close_status_artist'] ?>Closed By Main Studio.</span>
                                        </p>
                                        <?php
                                    } elseif (($design_conversation_status_before_action == FALSE)&&($accept_decline_view_data[0]['request_action'] != 'ACCEPTED')) { ?>
                                        <p>
                                            <b>Job Status :</b>
                                            <span class="automatic_close">Transferred to Main Studio.</span>
                                        </p>
                                        <?php
                                    }else{?><?php if(($accept_decline_view_data[0]['request_action'] == 'ACCEPTED')&&($design_conversation_status_before_action == FALSE)&&(variable_array_check($quotation_data) == TRUE || variable_array_check($view_fixed_time_frame) != TRUE)){?>
                                        <p>
                                            <b>Job Status :</b>
                                            <span class="automatic_close">Closed.</span>
                                            <!--<span class="automatic_close" data-toggle="tooltip" title="Customer was not responded"></span>-->

                                            <a class="tooltip"><i class="fa fa-info" aria-hidden="true"></i>
                                                <span class="tooltiptext">customer was not responded within the stipulated time frame</span>
                                            </a>
                                        </p>

                                        <?php
										}}?>

                                    </div>

                                </div>
                            </div>

                            <?php if (count($view_fixed_time_frame) > 0) {
                            //Design request fixed price project time frame details in table view code start
                            ?>
                            <div class="design-requst-inner">
                                <h4>Project time frame details</h4>
                                <div class="design-requst-inner-sub">
                                    <div class="request-details-page-inner">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Timeframe</th>
                                                    <th scope="col">Days</th>
                                                    <th scope="col">Expected Completion Date</th>
                                                    <th scope="col">Added On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($view_fixed_time_frame as $value) { ?>
                                                <tr>
                                                    <td><?= $value['timeframe'] ?></td>
                                                    <td><?= $value['days'] ?></td>
                                                    <td><?= date('d-m-Y', strtotime($value['expected_completion_date'])) ?></td>
                                                    <td><?= date('d-m-Y', strtotime($value['added_on'])) ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php
                            //Design request fixed price project time frame details in table view code end
                        }
                        ?>
                            <?php //Design request quotation timeline table in variable price code start ?>
                            <?php if (count($quotation_data) > 0) { ?>
                            <div class="design-requst-inner">
                                <h4>Project Time Frame Details</h4>
                                <div class="design-requst-inner-sub">
                                    <div class="request-details-page-inner">
                                        <h5>Quotation Amount : <?= $accept_decline_view_data[0]['currency']?><?= $quotation_data[0]['quotation_amount'] + 0 ?></h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Timeframe</th>
                                                    <th scope="col">Days</th>
                                                    <th scope="col">Expected Completion Date</th>
                                                    <th scope="col">Added On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Initial</td>
                                                    <td><?= $quotation_data[0]['time_frame_in_days'] ?></td>
                                                    <td><?= (strtotime($quotation_data[0]['expected_completed_date']) > 0) ? date('d-m-Y', strtotime($quotation_data[0]['expected_completed_date'])) : '--' ?></td>
                                                    <td><?= (strtotime($quotation_data[0]['designer_action_date_time'])) ? date('d-m-Y', strtotime($quotation_data[0]['designer_action_date_time'])) : '--' ?></td>
                                                </tr>
                                                <?php if (variable_value_check($quotation_data[0]['time_frame_in_days_2nd'])) { ?>
                                                <tr>
                                                    <td>Extended</td>
                                                    <td><?= $quotation_data[0]['time_frame_in_days_2nd'] ?></td>
                                                    <td><?= (strtotime($quotation_data[0]['expected_completed_date_2nd']) > 0) ? date('d-m-Y', strtotime($quotation_data[0]['expected_completed_date_2nd'])) : '--' ?></td>
                                                    <td><?= (strtotime($quotation_data[0]['added_on_2nd']) > 0) ? date('d-m-Y', strtotime($quotation_data[0]['added_on_2nd'])) : '--' ?></td>
                                                </tr>
                                                <?php } ?>
                                                <?php if (variable_value_check($quotation_data[0]['time_frame_in_days_3rd'])) { ?>
                                                <tr>
                                                    <td>Extended</td>
                                                    <td><?= $quotation_data[0]['time_frame_in_days_3rd'] ?></td>
                                                    <td><?= (strtotime($quotation_data[0]['expected_completed_date_3rd']) > 0) ? date('d-m-Y', strtotime($quotation_data[0]['expected_completed_date_3rd'])) : '--' ?></td>
                                                    <td><?= (strtotime($quotation_data[0]['added_on_3rd']) > 0) ? date('d-m-Y', strtotime($quotation_data[0]['added_on_3rd'])) : '--' ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php //Design request quotation timeline table in variable price code end ?>

                            <?php if (variable_array_check($quotation_data) == TRUE) { ?>
                            <div class="design-requst-inner">
                                <h4>Quotation Details [Payment Breakups]</h4>
                                <div class="design-requst-inner-sub">
                                    <div class="request-details-page-inner">
                                        <?php //Design request quotation payment in milestone wise table code start ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Milestones</th>
                                                    <th scope="col">Payment Amount(%)</th>
                                                    <th scope="col">Payable Amount</th>
                                                    <?php if (variable_array_check($check_paid)) { ?>
                                                    <th scope="col"></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $i = 1;
                                            foreach ($quotation_data as $value) {
                                                if ($value['milestone_type_name'] == 'down_payment_percentage') {
                                                    $milestone_type_name = 'Down Payment';
                                                }
                                                if ($value['milestone_type_name'] == 'before_complete_project_percentage') {
                                                    $milestone_type_name = '1st Stage Completion ';
                                                }
                                                if ($value['milestone_type_name'] == 'after_complete_project_percentage') {
                                                    $milestone_type_name = 'Final Payment ';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?= $milestone_type_name ?></td>
                                                    <td><?= $value['milestone_percentage_value'] + 0 ?></td>
                                                    <td><?= $accept_decline_view_data[0]['currency']?> <?= $value['milestone_amount_after_percentage'] + 0 ?></td>
                                                    <?php if (variable_array_check($check_paid)) { ?>
                                                    <td>
                                                        <?php
                                                            if (strtotime($value['customer_action_date_time']) > 0) {
                                                                echo 'Paid on <br>' . date('d-m-Y h:i:sa', strtotime($value['customer_action_date_time']));
                                                            } else {
                                                                if ($value['payment_status'] == 'UNPAID' && $value['pay_button_status'] == 'OFF' && $i == 1) {
                                                                    ?>
                                                        <button class="back-to-design-request" onclick="location.href='<?= base_url('milestone-request-customer/' . $value['order_id'] . '/' . $value['milestone_type_name']) ?>';">
                                                            Payment Request
                                                        </button>
                                                        <?php
                                                                    $i++;
                                                                }
                                                            }
                                                            ?>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php //Design request quotation payment in milestone wise table code end ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>


                            <div class="design-requst-inner">
                                <h4>Details Provided by Client</h4>
                                <div class="design-requst-inner-sub">
                                    <div class="request-details-page-inner">
                                        <p><b>Uploaded Files</b></p>
                                        <div class="pdf">
                                            <?php
                                        foreach ($view_design_request_data as $value) {
                                            if (!empty($value['file_name'])) {
                                                $filename = pathinfo($value['file_name']);
                                                $file = $filename['extension'];
                                                ?>
                                            <a href="<?= base_url('uploads/service_enq_files/' . $value['file_name']) ?>" target="_blank">
                                                <?php
                                                    if ($file == 'pdf') { ?>
                                                <img src="<?= base_url('assets/front/images/pdf.png') ?>"  title="<?php echo substr($value['file_name'],6);?>"  width="40" height="40">
                                                <?php
                                                    } else {
                                                        if ($file == 'doc' || $file == 'docx') {
                                                            ?>
                                                <img src="<?= base_url('assets/front/images/icons8-word-48.png') ?>"  title="<?php echo substr($value['file_name'],6);?>" width="40" height="40">
                                                <?php
                                                        } else {
                                                            if ($file == 'mp4') {
                                                                ?>
                                                <img src="<?= base_url('assets/front/images/icons8-video-48.png') ?>"  title="<?php echo substr($value['file_name'],6);?>" width="40" height="40">
                                                <?php
                                                            } else {
                                                                if ($file == 'jpeg' || $file == 'jpg' || $file == 'png') {
                                                                    ?>
                                                <img src="<?= base_url('uploads/service_enq_files/' . $value['file_name']) ?>" title="<?php echo substr($value['file_name'],6);?>"  width="40" height="40">
                                                <?php
                                                                } else {
                                                                    ?>
                                                <img src="<?= base_url('assets/front/images/icons8-file-48.png') ?>" title="<?php echo substr($value['file_name'],6);?>"  width="40" height="40">
                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                            </a>
                                            <?php
                                            } else {
                                                echo 'No file found.';
                                            }
                                        }
                                        ?>
                                        </div>
                                        <p><b>Description</b></p>
                                        <p>
                                            <span><?= variable_value_check($accept_decline_view_data[0]['message']) ? $accept_decline_view_data[0]['message'] : 'No description found.' ?></span>
                                        </p>
                                        <?php if (($accept_decline_view_data[0]['request_action'] == 'PENDING' && $design_conversation_status_before_action == TRUE) || (empty($accept_decline_view_data[0]['request_action']) && $design_conversation_status_before_action == TRUE)) { ?>
                                        <div class="dashboard-btn-area pdf-bottom-btn">
                                            <button class="save" onclick="location.href='<?= base_url('request-ad/accept/' . $accept_decline_view_data[0]['order_table_id']) ?>';">
                                                ACCEPT
                                            </button>
                                            <button class="save cancel" onclick="location.href='<?= base_url('request-ad/decline/' . $accept_decline_view_data[0]['order_table_id']) ?>';">
                                                DECLINE
                                            </button>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ($accept_decline_view_data[0]['request_action'] == 'ACCEPTED') { ?>
                            <div class="design-requst-inner">
                                <!--Chat code start-->
                                <div class="chatbox">
                                    <h3 class=" text-center">Chat History</h3>
                                    <div class="">
                                        <div class="inbox_msg">
                                            <div class="mesgs">
                                                <div class="msg_history">
                                                    <?php
                                                    if (count($chat_data) > 0) {
                                                        ?>
                                                    <div class="incoming_msg">
                                                        <div class="incoming_msg_img">

                                                            <img src="<?= base_url('assets/front/images/pic-avatar.jpg') ?>" title="Artist" width="30" height="30">
                                                        </div>
                                                        <div class="received_msg">
                                                            <div class="received_withd_msg">
                                                                <p>Design request sent.</p>

                                                                <span class="time_date"><?= date('h:i:sa', strtotime($accept_decline_view_data[0]['created_date'])) . ' | ' . date_time_format (($accept_decline_view_data[0]['created_date']),$type=3) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        foreach ($chat_data as $value) {
                                                            if (!empty($value['customer_fname'])) {
                                                                ?>
                                                    <div class="incoming_msg">
                                                        <div class="incoming_msg_img">
                                                            <img src="<?= base_url('assets/front/images/pic-avatar.jpg') ?>" title="<?= $accept_decline_view_data[0]['job_number'] ?>" width="30" height="30">
                                                        </div>
                                                        <div class="received_msg">
                                                            <div class="received_withd_msg">
                                                                <?php
                                                                            $attachments = view_chat_attachments($value['chat_id']);
                                                                            if (count($attachments) > 0) {
                                                                                foreach ($attachments as $attach) {
                                                                                    ?>
                                                                <a href="<?= base_url('uploads/chat/attachments/' . $attach['attachment_file']) ?>" target="_blank">
                                                                    <?php
                                                                                        if ($attach['attachment_type'] == 'application/pdf') {
                                                                                            ?>

                                                                    <img src="<?= base_url('assets/front/images/pdf.png') ?>">
                                                                    <?php
                                                                                        } elseif ($attach['attachment_type'] == 'application/msword') {
                                                                                            ?>
                                                                    <img src="<?= base_url('assets/front/images/icons8-word-48.png') ?>">
                                                                    <?php
                                                                                        } elseif (explode("/", $attach['attachment_type'])[0] == 'image') {
                                                                                            ?>
                                                                    <img src="<?= base_url('uploads/chat/attachments/' . $attach['attachment_file']) ?>" width="30" height="30">
                                                                    <?php
                                                                                        } elseif (explode("/", $attach['attachment_type'])[0] == 'video') {
                                                                                            ?>
                                                                    <img src="<?= base_url('assets/front/images/icons8-video-48.png') ?>" width="30" height="30">
                                                                    <?php
                                                                                        } else {
                                                                                            ?>
                                                                    <img src="<?= base_url('assets/front/images/icons8-file-48.png') ?>" width="30" height="30">
                                                                    <?php
                                                                                        }
                                                                                        ?>
                                                                </a>
                                                                <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                <p>
                                                                    <?php if (filter_var($value['text_messages'], FILTER_VALIDATE_URL)) { ?>
                                                                    <a href="<?= $value['text_messages'] ?>" target="_blank">
                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                        <?= $value['text_messages'] ?>
                                                                        <?php if (filter_var($value['text_messages'], FILTER_VALIDATE_URL)) { ?>
                                                                    </a>
                                                                    <?php } ?>
                                                                </p>
                                                                
																<span class="time_date"><?= date('h:i:sa', strtotime($value['added_date_time'])) . ' | ' . date_time_format($value['added_date_time'],$type=3) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                            }
                                                            if (!empty($value['designer_fname'])) {
                                                                ?>
                                                    <div class="outgoing_msg">
                                                        <div class="sent_msg">
                                                            <?php
                                                                        $attachments = view_chat_attachments($value['chat_id']);
                                                                        if (count($attachments) > 0) {
                                                                            foreach ($attachments as $attach) {
                                                                                ?>
                                                            <a href="<?= base_url('uploads/chat/attachments/' . $attach['attachment_file']) ?>" target="_blank">
                                                                <?php
                                                                                    if ($attach['attachment_type'] == 'application/pdf') {
                                                                                        ?>

                                                                <img src="<?= base_url('assets/front/images/pdf.png') ?>">
                                                                <?php
                                                                                    } elseif ($attach['attachment_type'] == 'application/msword') {
                                                                                        ?>
                                                                <img src="<?= base_url('assets/front/images/icons8-word-48.png') ?>">
                                                                <?php
                                                                                    } elseif (explode("/", $attach['attachment_type'])[0] == 'image') {
                                                                                        ?>
                                                                <img src="<?= base_url('uploads/chat/attachments/' . $attach['attachment_file']) ?>" width="30" height="30">
                                                                <?php
                                                                                    } elseif (explode("/", $attach['attachment_type'])[0] == 'video') {
                                                                                        ?>
                                                                <img src="<?= base_url('assets/front/images/icons8-video-48.png') ?>" width="30" height="30">
                                                                <?php
                                                                                    } else {
                                                                                        ?>
                                                                <img src="<?= base_url('assets/front/images/icons8-file-48.png') ?>" width="30" height="30">
                                                                <?php
                                                                                    }
                                                                                    ?>
                                                            </a>
                                                            <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                            <p>
                                                                <?php if (filter_var($value['text_messages'], FILTER_VALIDATE_URL)) { ?>
                                                                <a href="<?= $value['text_messages'] ?>" target="_blank">
                                                                    <?php
                                                                                }
                                                                                ?>
                                                                    <?= $value['text_messages'] ?>
                                                                    <?php if (filter_var($value['text_messages'], FILTER_VALIDATE_URL)) { ?>
                                                                </a>
                                                                <?php } ?>
                                                            </p>
                                                            <span class="time_date"><?= date('h:i:sa', strtotime($value['added_date_time'])) . ' | ' . date_time_format($value['added_date_time'],$type=3) ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                                    <div class="incoming_msg">
                                                        <div class="incoming_msg_img">
                                                            <img src="<?= base_url('assets/front/images/pic-avatar.jpg') ?>" title="<?= $accept_decline_view_data[0]['job_number'] ?>" width="30" height="30">
                                                        </div>
                                                        <div class="received_msg">
                                                            <div class="received_withd_msg">
                                                                <p>Design request sent.</p>

                                                                <span class="time_date"><?= date('h:i:sa', strtotime($accept_decline_view_data[0]['created_date'])) . ' | ' . date_time_format (($accept_decline_view_data[0]['created_date']),$type=3) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php if (($accept_decline_view_data[0]['job_close_status_artist'] != 'CLOSED' && $accept_decline_view_data[0]['job_close_status_admin'] != 'CLOSED') && $design_conversation_status == TRUE) { ?>
                                                <div class="type_msg">
                                                    <form action="<?= base_url('designer-chat-save') ?>" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="order_table_id" value="<?= $order_table_id ?>">
                                                        <input type="hidden" name="design_type_id" value="<?= $accept_decline_view_data[0]['service_id'] ?>">
                                                    <div class="input_msg_write">
                                                        <!--   <input type="text" name="text_messages"
                                                                               class="text_messages"
                                                                               placeholder="Type a message" required/>-->
                                                        <textarea name="text_messages" class="form-control text_messages type-msg" placeholder="Type a message" required=""></textarea>
                                                        <input type="file" name="attachments[]" multiple class="chat_attachments" />
                                                        <button class="msg_send_btn" type="submit">
                                                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Chat code end-->
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--Body End-->
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>

    <div class="jquery_datepicker"></div>

    <?php $this->load->view('common/footer'); ?>
</body>
<?php $this->load->view('common/footer_js'); ?>

</html>


<script type="text/javascript">
    $(document).ready(function(e) {
        $('[name="time_frame_in_days"]').change(function() {
            var time_frame_in_days = $("[name=time_frame_in_days]").val();
            if (time_frame_in_days > 0) {
                $("[name=time_frame_in_days]").prop("readonly", true);
                $.ajax({
                    type: 'GET',
                    url: "<?php echo base_url('artist_datepicker')?>/" + time_frame_in_days,
                    success: function(data) {
                        $(".jquery_datepicker").html(data);
                        console.log(data);
                    }
                });
            } else {
                $(".expected_completed_date").css("display", "none");
            }

        });

    });

</script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
