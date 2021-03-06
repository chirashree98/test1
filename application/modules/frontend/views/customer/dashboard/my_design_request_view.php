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
    <section id="my-account">
        <div class="custom-width">
            <div class="page-heading">
                <h1>Welcome <?php echo @$user_type['user_type_name']; ?> Account</h1>
            </div>
            <div class="my-account-inner">
                <div class="col-md-3">
                    <div class="artist-left-panel">
                        <?php $this->load->view('common/myaccount_side_panel'); ?>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="my-account-left-panel">
                        <button class="back-to-design-request" onclick="location.href='<?= base_url('my-design-requests') ?>';">
                            <img src="<?= base_url('assets/front/images/back-arrow.png') ?>"> BACK TO DESIGN REQUEST
                        </button>
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
                                    <p><b>Designer Name :</b>
                                        <span> <?= $view_design_request_data[0]['first_name'] . ' ' . $view_design_request_data[0]['last_name'] ?></span>
                                    </p>
                                    <p><b>Request Date / Date of Request :</b>
                                        <span><?= date_time_format(($view_design_request_data[0]['created_date']),$type=3) ?></span>
                                    </p>
                                    <p><b>Type of Request :</b>
                                        <span><?= ucwords(strtolower($view_design_request_data[0]['type_name'])) ?></span></p>
                                    <p>
                                        <b>Status :</b>
                                        <span>
                                            <?php if (variable_value_check($view_design_request_data[0]['job_close_status_artist'])) {
                                                echo $view_design_request_data[0]['job_close_status_artist'] . ' by artist.';
                                            } elseif (variable_value_check($view_design_request_data[0]['job_close_status_admin'] )) {
                                                echo Closed . ' by main studio.';
                                            } elseif (($view_design_request_data[0]['request_action'] == 'DECLINED') || (($view_design_request_data[0]['request_action'] == 'PENDING' || $view_design_request_data[0]['request_action'] == 'ACCEPTED') && $check_design_request_hour == FALSE)) {
                                                echo 'Transferred to Main Studio.';
                                            } else {
                                                echo ucfirst(strtolower($view_design_request_data[0]['request_action']));
                                            } ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--Quotation Code start-->
                        <!--Admin quotation code start-->
                        <?php if (variable_array_check($admin_quotation_data) == TRUE) { ?>
                        <div class="design-requst-inner">
                            <h4>Studio Owner Quotation Details [Payment Breakups]</h4>
                            <div class="design-requst-inner-sub">
                                <div class="request-details-page-inner">
                                    <h5>Quotation Amount :
                                        <?= $view_design_request_data[0]['currency'] ?> <?= $admin_quotation_data[0]['quotation_amount'] + 0 ?></h5>
                                    <h5>Time frame for the project
                                        : <?= $admin_quotation_data[0]['time_frame_in_days'] + 0 ?> days</h5>
                                    <h5>Expected completion date
                                        : <?= date('d-m-Y', strtotime($admin_quotation_data[0]['expected_completed_date'])) ?></h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Milestones</th>
                                                <th scope="col">Payment Amount(%)</th>
                                                <th scope="col">Payable Amount</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($admin_quotation_data as $value) {
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
                                                <td><?= $view_design_request_data[0]['currency']?><?= $value['milestone_amount_after_percentage'] + 0 ?></td>
                                                <?php if ($value['pay_button_status'] == 'ON') { ?>
                                                <td>
                                                    <button class="back-to-design-request" onclick="location.href='<?= base_url('admin-milestone-pay-customer/' . $value['order_id'] . '/' . $value['milestone_type_name'] . '/' . $value['milestone_amount_after_percentage']) ?>';">
                                                        Pay Now
                                                    </button>
                                                </td>
                                                <?php
                                                    } else {
                                                        if (strtotime($value['customer_action_date_time']) > 0) {
                                                            ?>
                                                <td>
                                                    Payment on<br>

                                                    <?= date_time_format($value['customer_action_date_time'],$type=3) ?>
                                                </td>
                                                <?php
                                                        } else {
                                                            echo '<td></td>';
                                                        }
                                                    }
                                                    ?>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!--Admin quotation code end-->

                        <?php //Design request quotation timeline table in variable price code start ?>
                        <?php if (count($quotation_data) > 0) { ?>
                        <div class="design-requst-inner">
                            <h4>Project Time Frame Details</h4>
                            <div class="design-requst-inner-sub">
                                <div class="request-details-page-inner">
                                    <h5>Quotation Amount : <?= $view_design_request_data[0]['currency'] ?> <?= $quotation_data[0]['quotation_amount'] + 0 ?></h5>
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
                            <h4>Quotation Details [Payment
                                Breakups] <?= (variable_array_check($admin_quotation_data) == TRUE) ? ' [Cancel Quotation]' : '' ?></h4>
                            <div class="design-requst-inner-sub">
                                <div class="request-details-page-inner">
                                    <?php //Design request quotation payment on artist in milestone wise table code start ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Milestones</th>
                                                <th scope="col">Payment Amount(%)</th>
                                                <th scope="col">Payable Amount</th>
                                                <?php if ($view_design_request_data[0]['request_action_customer'] == 'ACCEPTED') { ?>
                                                <th scope="col"></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
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
                                                <td><?= $view_design_request_data[0]['currency']?><?= $value['milestone_amount_after_percentage'] + 0 ?></td>
                                                <?php if ($view_design_request_data[0]['request_action_customer'] == 'ACCEPTED') { ?>
                                                <?php if ($value['pay_button_status'] == 'ON') { ?>
                                                <td>
                                                    <button class="back-to-design-request" onclick="location.href='<?= base_url('milestone-pay-customer/' . $value['order_id'] . '/' . $value['milestone_type_name'] . '/' . $value['milestone_amount_after_percentage']) ?>';">
                                                        Pay Now
                                                    </button>
                                                </td>
                                                <?php
                                                        } else {
                                                            if (strtotime($value['customer_action_date_time']) > 0) {
                                                                ?>
                                                <td>
                                                    Payment on<br>
                                                    <?= date('d-m-Y h:i:sa', strtotime($value['customer_action_date_time'])) ?>
                                                </td>
                                                <?php
                                                            } else {
                                                                echo '<td></td>';
                                                            }
                                                        }
                                                        ?>
                                                <?php } ?>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php //Design request quotation payment on artist in milestone wise table code end ?>

                                    <?php if ($view_design_request_data[0]['request_action_customer'] == 'PENDING' && variable_array_check($quotation_data) == TRUE && $quotation_hour_check == TRUE) { ?>
                                    <div class="dashboard-btn-area pdf-bottom-btn">
                                        <button class="save" onclick="location.href='<?= base_url('quotation-status/accept/' . $view_design_request_data[0]['order_table_id']) ?>';">
                                            ACCEPT
                                        </button>
                                        <button class="save cancel" onclick="location.href='<?= base_url('quotation-status/decline/' . $view_design_request_data[0]['order_table_id']) ?>';">
                                            DECLINE
                                        </button>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!--Quotation code start-->

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
                                            <img src="<?= base_url('assets/front/images/pdf.png') ?>"  title="<?php echo substr($value['file_name'],6);?>"width="40" height="40">
                                            <?php
                                                    } else {
                                                        if ($file == 'doc' || $file == 'docx') {
                                                            ?>
                                            <img src="<?= base_url('assets/front/images/icons8-word-48.png') ?>"title="<?php echo substr($value['file_name'],6);?>" width="40" height="40">
                                            <?php
                                                        } else {
                                                            if ($file == 'mp4') {
                                                                ?>
                                            <img src="<?= base_url('assets/front/images/icons8-video-48.png') ?>" title="<?php echo substr($value['file_name'],6);?>" width="40" height="40">
                                            <?php
                                                            } else {
                                                                if ($file == 'jpeg' || $file == 'jpg' || $file == 'png') {
                                                                    ?>
                                            <img src="<?= base_url('uploads/service_enq_files/' . $value['file_name']) ?>" title="<?php echo substr($value['file_name'],6);?>"width="40" height="40">
                                            <?php
                                                                } else {
                                                                    ?>
                                            <img src="<?= base_url('assets/front/images/icons8-file-48.png') ?>" title="<?php echo substr($value['file_name'],6);?>"width="40" height="40">
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
                                        <span><?= variable_value_check($view_design_request_data[0]['message']) ? $view_design_request_data[0]['message'] : 'No description found.' ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php if ($view_design_request_data[0]['request_action'] == 'ACCEPTED' || $check_design_request_hour == FALSE) { ?>
                        <div class="design-requst-inner">
                            <!--Chat code start-->
                            <div class="container">
                                <h3 class=" text-center">Chat History</h3>
                                <div class="messaging">
                                    <div class="inbox_msg">
                                        <div class="mesgs">
                                            <div class="msg_history">
                                                <?php
                                                    if (count($chat_data) > 0) {
                                                        ?>
                                                <div class="incoming_msg">
                                                    <div class="incoming_msg_img">
                                                        <?php
                                                                if ($view_design_request_data[0]['request_action'] == 'ACCEPTED') {
                                                                    if (!empty($view_design_request_data[0]['profile_image'])) {
                                                                        ?>
                                                        <img src="<?= base_url('uploads/artist/' . $view_design_request_data[0]['profile_image']) ?>" title="<?= $view_design_request_data[0]['first_name'] . ' ' . $view_design_request_data[0]['last_name'] ?>" width="30" height="30">
                                                        <?php } else { ?>
                                                        <img src="<?= base_url('assets/front/images/pic-avatar.jpg') ?>" title="<?= $view_design_request_data[0]['first_name'] . ' ' . $view_design_request_data[0]['last_name'] ?>" width="30" height="30">
                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                        <img src="<?= base_url('assets/front/images/pic-avatar.jpg') ?>" title="Main Studio" width="30" height="30">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="received_msg">
                                                        <div class="received_withd_msg">
                                                            <?php if ($view_design_request_data[0]['request_action'] == 'ACCEPTED') { ?>
                                                            <p>Request accepted by artist.</p>
                                                            <?php } else { ?>
                                                            <p>Request accepted by main studio.</p>
                                                            <?php } ?>
                                                            <?php if ($view_design_request_data[0]['request_action'] == 'ACCEPTED') { ?>
                                                            <span class="time_date">
                                                                <?= date('h:i:sa', strtotime($value['added_date_time'])) . ' | ' . 
																		 date_time_format(($view_design_request_data[0]['request_action_date']),$type=3) ?>
                                                            </span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                        foreach ($chat_data as $value) {
                                                            if (!empty($value['designer_fname'])) {
                                                                ?>
                                                <div class="incoming_msg">
                                                    <div class="incoming_msg_img">
                                                        <?php if (!empty($value['designer_profile_pic'])) { ?>
                                                        <img src="<?= base_url('uploads/artist/' . $value['designer_profile_pic']) ?>" width="30" height="30" title="<?= $value['designer_fname'] . ' ' . $value['designer_lname'] ?>">
                                                        <?php } else { ?>
                                                        <img src="<?= base_url('assets/front/images/pic-avatar.jpg') ?>" title="<?= $value['designer_fname'] . ' ' . $value['designer_lname'] ?>" width="30" height="30">
                                                        <?php } ?>
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
                                                                <?php if (filter_var($value['text_messages'], FILTER_VALIDATE_URL) !== false) { ?>
                                                                <a href="<?= $value['text_messages'] ?>" target="_blank">
                                                                    
                                                                    <?= $value['text_messages'] ?>
                                                                   
                                                                </a>
                                                                <?php }else{ ?><?= $value['text_messages'] ?><?php 
																}?></p>
                                                            <span class="time_date"><?= date('h:i:sa', strtotime($value['added_date_time'])) . ' | ' .date_time_format(($view_design_request_data[0]['request_action_date']),$type=3) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                            }
                                                            if (!empty($value['customer_fname'])) {
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
                                                            <?php if (filter_var($value['text_messages'], FILTER_VALIDATE_URL) !== false) { ?>
                                                            <a href="<?= $value['text_messages'] ?>" target="_blank">
                                                                <?php
                                                                                }
                                                                                ?>
                                                                <?= $value['text_messages'] ?>
                                                                <?php if (filter_var($value['text_messages'], FILTER_VALIDATE_URL) !== false) { ?>
                                                            </a>
                                                            <?php } ?>
                                                        </p>
                                                        <span class="time_date"><?= date('h:i:sa', strtotime($value['added_date_time'])) . ' | ' . date_time_format(($view_design_request_data[0]['request_action_date']),$type=3) ?></span>
                                                    </div>
                                                </div>
                                                <?php
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                                <div class="incoming_msg">
                                                    <div class="incoming_msg_img">
                                                        <?php
                                                                if ($view_design_request_data[0]['request_action'] == 'ACCEPTED') {
                                                                    if (!empty($view_design_request_data[0]['profile_image'])) {
                                                                        ?>
                                                        <img src="<?= base_url('uploads/artist/' . $view_design_request_data[0]['profile_image']) ?>" title="<?= $view_design_request_data[0]['first_name'] . ' ' . $view_design_request_data[0]['last_name'] ?>" width="30" height="30">
                                                        <?php } else { ?>
                                                        <img src="<?= base_url('assets/front/images/pic-avatar.jpg') ?>" title="<?= $view_design_request_data[0]['first_name'] . ' ' . $view_design_request_data[0]['last_name'] ?>" width="30" height="30">
                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                        <img src="<?= base_url('assets/front/images/pic-avatar.jpg') ?>" title="Main Studio" width="30" height="30">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="received_msg">
                                                        <div class="received_withd_msg">
                                                            <?php if ($view_design_request_data[0]['request_action'] == 'ACCEPTED') { ?>
                                                            <p>Request accepted by artist.</p>
                                                            <?php } else { ?>
                                                            <p>Request accepted by main studio.</p>
                                                            <?php } ?>
                                                            <?php if ($view_design_request_data[0]['request_action'] == 'ACCEPTED') { ?>
                                                            <span class="time_date"><?= date('h:i:sa', strtotime($view_design_request_data[0]['request_action_date'])) . ' | ' . date_time_format(($view_design_request_data[0]['request_action_date']),$type=3) ?></span>

                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                    ?>
                                            </div>
                                            <?php
                                                if ($view_design_request_data[0]['request_action'] == 'ACCEPTED' || $check_design_request_hour == FALSE) {
                                                    if ($view_design_request_data[0]['job_close_status_artist'] != 'CLOSED') {
                                                        if ($view_design_request_data[0]['job_close_status_admin'] != 'CLOSED') {
                                                            ?>
                                            <div class="type_msg">
                                                <form action="<?= base_url('customer-chat-save') ?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="order_table_id" value="<?= $order_table_id ?>">
                                                    <input type="hidden" name="design_type_id" value="<?= $view_design_request_data[0]['service_id'] ?>">
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
                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Chat code end-->
                        </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/footer_js'); ?>
</body>

</html>
