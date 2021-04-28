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
                        <div class="artist-right-panel" id="table">
                            <div class="design-requst-inner">
                                <h4>Design requests</h4>
                                <form class="search-order-no-form">
                                    <div class="form-group col-md-6">
                                        <input type="text" id="orderno" required name="orderno" placeholder="Enter order no" width="50px" class="form-control validate"><span><i class="fa fa-search" aria-hidden="true"></i></span>
                                    </div>
                                </form>

                                <div class="design-requst-inner-sub">
                                    <div class="table-responsive" id="table">
                                        <table class="table" id="default-datatable22s">
                                            <thead>
                                                <tr>
                                                    <th>Job Number</th>
                                                    <th>Date of<br>
                                                        Request
                                                    </th>
                                                    <th>Description</th>
                                                    <th class="dropdoenstyle newdropdoenstyle">
                                                        <form action="<?= base_url('request-ad') ?>" method="post">
                                                            <select class="form-control" name="filter_design_type" onchange="this.form.submit()">
                                                                <option value="">Select Service</option>
                                                                <?php foreach ($design_service_type as $value) { ?>
                                                                <option value="<?= $value['id']; ?>" <?= ($value['id'] == $filter_design_type) ? ' selected' : '' ?>><?= $value['type_name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <noscript><input type="submit" value="submit"></noscript>
                                                        </form>
                                                    </th>
                                                    <th>Request Action</th>
                                                    <th style="text-align:center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="response2">
                                                <?php foreach ($accept_decline_data as $value) { ?>
                                                <tr>
                                                    <td><?= $value['job_number'] ?></td>

                                                    <td><?php echo date_time_format($value['created_date'],$type=3);?></td>
                                                    <td>
                                                        <?= $value['message'] ?>
                                                    </td>
                                                    <td><?= $value['type_name'] ?></td>
                                                    <td><?php
										if(($value['request_action'] == 'ACCEPTED')&&($design_conversation_status_before_action[$value['order_table_id']]==FALSE)&&($value['service_id'])!=1){?>
                                                        <?php echo "TRANSFEERED TO MAIN STUDIO";?>
                                                        <?php
										}else{?><?php echo ($value['request_action'] == 'PENDING' && $design_conversation_status_before_action[$value['order_table_id']])? $value['request_action'] : (($value['request_action'] == 'PENDING' && !$design_conversation_status_before_action[$value['order_table_id']])? 'EXPIRED': $value['request_action']) ?>
                                                        <?php
									}?></td>
                                                    <td style="text-align:center;">
                                                        <a href="<?= base_url('request-ad/view/' . $value['order_table_id']) ?>">
                                                            <?php
                                                        @$count_chat = count_chat_designer($value['order_table_id'], $value['designer_id']);
                                                        @$check_design_request_hour = check_design_request_hour($value['order_table_id']);
                                                        if ($count_chat > 0 && isset($check_design_request_hour) && $check_design_request_hour == TRUE) {
                                                            ?>
                                                            <div class="chat_count">
                                                                <?= $count_chat ?>
                                                            </div>
                                                            <?php } ?>
                                                            <img src="<?= base_url('assets/front/images/eye.png') ?>">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="table-responsive" id="default-datatable22s4" style="display:none;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Job Number</th>
                                                        <th>Date of<br>
                                                            Request
                                                        </th>
                                                        <th>Description</th>
                                                        <th class="dropdoenstyle newdropdoenstyle">
                                                            <form action="<?= base_url('request-ad') ?>" method="post">
                                                                <select class="form-control" name="filter_design_type" onchange="this.form.submit()">
                                                                    <option value="">Select Service</option>
                                                                    <?php foreach ($design_service_type as $value) { ?>
                                                                    <option value="<?= $value['id']; ?>" <?= ($value['id'] == $filter_design_type) ? ' selected' : '' ?>><?= $value['type_name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <noscript><input type="submit" value="submit"></noscript>
                                                            </form>
                                                        </th>
                                                        <th>Request Action</th>
                                                        <th style="text-align:center;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="response24">
                                                    <?php foreach ($accept_decline_data as $value) { ?>
                                                    <tr>
                                                        <td><?= $value['job_number'] ?></td>

                                                        <td><?php echo date_time_format($value['created_date'],$type=3);?></td>
                                                        <td>
                                                            <?= $value['message'] ?>
                                                        </td>
                                                        <td><?= $value['type_name'] ?></td>
                                                        <td><?php
										if(($value['request_action'] == 'ACCEPTED')&&($design_conversation_status_before_action[$value['order_table_id']]==FALSE)&&($value['service_id'])!=1){?>
                                                            <?php echo "TRANSFEERED TO MAIN STUDIO";?>
                                                            <?php
										}else{?><?php echo ($value['request_action'] == 'PENDING' && $design_conversation_status_before_action[$value['order_table_id']])? $value['request_action'] : (($value['request_action'] == 'PENDING' && !$design_conversation_status_before_action[$value['order_table_id']])? 'EXPIRED': $value['request_action']) ?>
                                                            <?php
									}?></td>
                                                        <td style="text-align:center;">
                                                            <a href="<?= base_url('request-ad/view/' . $value['order_table_id']) ?>">
                                                                <?php
                                                        @$count_chat = count_chat_designer($value['order_table_id'], $value['designer_id']);
                                                        @$check_design_request_hour = check_design_request_hour($value['order_table_id']);
                                                        if ($count_chat > 0 && isset($check_design_request_hour) && $check_design_request_hour == TRUE) {
                                                            ?>
                                                                <div class="chat_count">
                                                                    <?= $count_chat ?>
                                                                </div>
                                                                <?php } ?>
                                                                <img src="<?= base_url('assets/front/images/eye.png') ?>">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>




                            </div>
                            <!--Body End-->
                        </div>
                    
                        <div class="pagination mb50" id="page">
						
							 <?php if ($accept_decline_data2->num_rows() > floatval($limit)) { ?>
                            <span>Showing <?=abs($page+1)?>-<?php echo floatval($page + $accept_decline_data2->num_rows());?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } else { ?>
                                <span>Showing <?=$page?>-<?php echo floatval($page + $accept_decline_data2->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
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
<!--
<script>
    $(document).ready(function() {
        $(".next").click(function() {
            $(".pagination")
                .find(".pageNumber.active")
                .next()
                .addClass("active");
            $(".pagination")
                .find(".pageNumber.active")
                .prev()
                .removeClass("active");
        });
        $(".prev").click(function() {
            $(".pagination")
                .find(".pageNumber.active")
                .prev()
                .addClass("active");
            $(".pagination")
                .find(".pageNumber.active")
                .next()
                .removeClass("active");
        });
    });

</script>-->
<script>
    $(document).ready(function() {
        $("#orderno").keyup(function() {
            //alert(123);
            if ($("#orderno").val().length > 0) {
                var orderno = $("#orderno").val();
                //alert(orderno);
                $.ajax({
                    url: "<?php echo base_url()?>frontend/Artist_dashboard_controller/search_order",
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
