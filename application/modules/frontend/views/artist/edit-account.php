<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>
        <style>
            /* Code By Webdevtrick ( https://webdevtrick.com ) */
            .container {
                padding: 50px 10%;
            }

            .box {
                position: relative;
                background: #ffffff;
                width: 100%;
            }

            .box-header {
                color: #444;
                display: block;
                padding: 10px;
                position: relative;
                border-bottom: 1px solid #f4f4f4;
                margin-bottom: 10px;
            }

            .box-tools {
                position: absolute;
                right: 10px;
                top: 5px;
            }

            .dropzone-wrapper {
                border: 2px dashed #91b0b3;
                color: #92b0b3;
                position: relative;
                height: 250px;
            }

            .dropzone-desc {
                position: absolute;
                margin: 0 auto;
                left: 0;
                right: 0;
                text-align: center;
                width: 40%;
                top: 50px;
                font-size: 16px;
            }

            .dropzone,
            .dropzone:focus {
                position: absolute;
                outline: none !important;
                width: 100%;
                height: 150px;
                cursor: pointer;
                opacity: 0;
            }

            .dropzone-wrapper:hover,
            .dropzone-wrapper.dragover {
                background: #ecf0f5;
            }

            .preview-zone {
                text-align: center;
            }

            .preview-zone .box {
                box-shadow: none;
                border-radius: 0;
                margin-bottom: 0;
            }

            .btn-primary {
                background-color: crimson;
                border: 1px solid #212121;
            }
        </style>
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
                        <form action="" id="myFrm" method="post" enctype="multipart/form-data">
                            <div class="col-md-9">

                                <div class="my-account-left-panel">
                                    <div class="my-account-left-panel-sec1">
                                        <h4>Edit Your Service Profile</h4>
                                        <span id="msg_box">
                                            <?php if ($this->session->flashdata('success') != '') { ?>
                                                <?php echo $this->session->flashdata('success'); ?>
                                            <?php } ?>
                                        </span>
                                        <div class="my-account-left-panel-sec1-inner">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="artist-right-panel">

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Profile Image</label><br>
                                                                    <div class="dropzone-wrapper col-sm-8">
                                                                        <div class="dropzone-desc">
                                                                            <i class="glyphicon glyphicon-download-alt"></i>
                                                                            <p>Choose an image file or drag it here.</p>
                                                                        </div>
                                                                        <input type="file" <?php echo $query['profile_image'] != '' ? '' : 'required=""'; ?>
                                                                               name="profile_image" class="dropzone">
																			   &nbsp; <span style="color: red;">For better display please upload image  of 626px*500px </span>
                                                                    </div>
                                                                    <div class="preview-zone <?php echo $query['profile_image'] != '' ? '' : 'hidden'; ?> col-sm-4">
                                                                        <div class="box box-solid">
                                                                            <div class="box-header with-border">

                                                                            </div>
                                                                            <div class="box-body">
                                                                                <img width="200"
                                                                                     src="<?php echo base_url(); ?>uploads/artist/<?php echo $query['profile_image']; ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label>About The Designer / Studio</label>
                                                            <textarea name="about_work" id="about_work" class="form-control"
                                                                      placeholder=""><?php echo $query['about_work']; ?></textarea>
                                                            <p class="error_msg"><?php echo form_error('about_work'); ?> </p>
                                                        </div>


                                                        <h4 class="mb15 linehight">Services
                                                        </h4>

                                                        <div class="form-group">

                                                            <label>Service Type</label>
                                                            <select class="form-control" id="choose_service">
                                                                <?php foreach ($services->result() as $row) { ?>
                                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->type_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <?php
                                                        foreach ($services->result() as $row) {
                                                            $getServiceDetails = getServiceDetails($query['user_main_id'], $row->id);
                                                            ?>
                                                            <div id="ser_sec_<?php echo $row->id; ?>" class="ser_sec"
                                                                 style="display:none;">

                                                                <div class="form-group">
                                                                    <input type="hidden"
                                                                           name="service_id[<?php echo $row->id; ?>]"
                                                                           value="<?php echo $row->id; ?>"
                                                                           class="form-control"/>

                                                                </div>


                                                                <div class="form-group">
                                                                    <label>Give a Description</label>
                                                                    <textarea class="form-control" placeholder=""
                                                                              id="service_description_<?php echo $row->id; ?>"
                                                                              name="service_description[<?php echo $row->id; ?>]"><?php echo isset($getServiceDetails['description']) ? $getServiceDetails['description'] : ''; ?></textarea>
                                                                </div>

                                                                <div class="form-group cost_type" style="display: none;"
                                                                     id="cost_type_<?= $row->id ?>">
                                                                    <label>Cost Type</label>
                                                                    <select class="form-control cost_type_select"
                                                                            name="cost_type[<?php echo $row->id; ?>]">
                                                                        <option value="FIXED" <?= ('FIXED' == $getServiceDetails['cost_type']) ? 'selected' : '' ?>>
                                                                            Fixed
                                                                        </option>
                                                                        <option value="VARIABLE" <?= ('VARIABLE' == $getServiceDetails['cost_type']) ? 'selected' : '' ?>>
                                                                            Send a Quote on Service Request
                                                                        </option>
                                                                    </select>
                                                                </div>




                                                                <div class="form-group divcurrrency" id="currency_id_<?= $row->id ?>">
                                                                    <label>Currency</label>
                                                                    <select  name="currency_id[<?php echo $row->id; ?>]" class="form-control" >

                                                                    <?php foreach ($currency->result() as $val) { ?>


                                                                        <option <?php
                                                                        if ($val->currency_id == $getServiceDetails['currency_id']) {
                                                                            echo 'selected';
                                                                        }
                                                                        ?> value="<?php echo $val->currency_id; ?>"><?php echo $val->currency_name; ?></option>
                                                                        <?php } ?>
                                                                </select>
                                                                </div> 


                                                                <div class="form-group add_cost" id="add_cost_<?= $row->id ?>">
                                                                    <label>Add Cost [ <?php echo $row->cost_type; ?> ] </label>
                                                                    <input type="number" min="0.0"
                                                                           name="service_cost[<?php echo $row->id; ?>]"
                                                                           id="service_cost_<?php echo $row->id; ?>]"
                                                                           class="form-control"
                                                                           value="<?php echo isset($getServiceDetails['cost']) ? $getServiceDetails['cost'] : ''; ?>"/>
                                                                </div>
                                                            </div>
<!--                                                            <div class="form-group divcurrrency" style="display:none;"   id="currency_id_<?= $row->id ?>">

                                                                <label> Currency</label>
                                                                <select  name="currency_id[<?php echo $row->id; ?>]" class="form-control" >

                                                                    <?php foreach ($currency->result() as $row) { ?>


                                                                        <option <?php
                                                                        if ($row->currency_id == $getServiceDetails['currency_id']) {
                                                                            echo 'selected';
                                                                        }
                                                                        ?> value="<?php echo $row->currency_id; ?>"><?php echo $row->currency_name; ?></option>
                                                                        <?php } ?>
                                                                </select>
                                                            </div>-->
                                                        <?php } ?>
                                                        <div class="form-group">
                                                            <button type="submit" class="continue" id="editUser">Save</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <div class="clearfix"></div>

        <?php $this->load->view('common/footer'); ?>


    </body>
    <?php $this->load->view('common/footer_js'); ?>

    <!-- Jquery script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>


        $(window).bind("load", function () {
            var ser_id = $('#choose_service').val();
            $('#ser_sec_' + ser_id).show();
            if (ser_id == 1) {
                $('.cost_type').hide();

                $('#cost_type_' + ser_id).show();
                //$('#currency').show();

                $('#currency_id_' + ser_id).show();
                $('#add_cost_' + ser_id).hide();
            }
            var value = $('.cost_type_select').val();
            //alert(value);
            if (value == 'FIXED') {

                $('#currency').show();
                $('#currency_id_' + ser_id).show();
                $('.add_cost').show();
            } else {

                $('#currency_id_' + ser_id).hide();
                //$('#currency_'+value).hide();
                $('.add_cost').hide();
            }
        });
        $(document).on('change', '#choose_service', function () {
            var ser_id = $('#choose_service').val();
            $('.divcurrrency').hide();
            $('.ser_sec').hide();
            $('#ser_sec_' + ser_id).show();
            var value = $('.cost_type_select').val();
            if ((ser_id == 1) && (value == 'FIXED')) {
                $('.cost_type').hide();
                $('#cost_type_' + ser_id).show();

                $('#currency_id_' + ser_id).show();
                $('#add_cost_' + ser_id).show();

                //$('#currency_'+value).hide();
            } else if ((ser_id == 1) && (value != 'FIXED'))
            {

                $('#currency_id_' + ser_id).hide();
                $('#add_cost_' + ser_id).hide();
            } else {

                //$('#currency').show();
                $('#currency_id_' + ser_id).show();
                $('#add_cost_' + ser_id).show();
            }

        });
        $(document).on('change', '.cost_type_select', function () {
            var ser_id = $('#choose_service').val();
            var value = $('.cost_type_select').val();
            if (ser_id = 1) {
                if (value == 'FIXED') {

                    $('#currency_id_1').show();
                    $('#add_cost_1').show();
                } else {
                    $('#add_cost_1').hide();
                    $('#currency_id_1').hide();
                }
            }
        });
    </script>
    <script>
        // Code By Webdevtrick ( https://webdevtrick.com )
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var htmlPreview =
                            '<img width="200" src="' + e.target.result + '" />' +
                            '<p>' + input.files[0].name + '</p>';
                    var wrapperZone = $(input).parent();
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                    wrapperZone.removeClass('dragover');
                    previewZone.removeClass('hidden');
                    boxZone.empty();
                    boxZone.append(htmlPreview);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function reset(e) {
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        $(".dropzone").change(function () {
            readFile(this);
        });

        $('.dropzone-wrapper').on('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        $('.dropzone-wrapper').on('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        $('.remove-preview').on('click', function () {
            var boxZone = $(this).parents('.preview-zone').find('.box-body');
            var previewZone = $(this).parents('.preview-zone');
            var dropzone = $(this).parents('.form-group').find('.dropzone');
            boxZone.empty();
            previewZone.addClass('hidden');
            reset(dropzone);
        });
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/tiny-mce.js"></script>
</html> 

