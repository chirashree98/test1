<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <?php $this->load->view('common/header_include'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/global/css/jquery.datetimepicker.min.css">

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <div class="page-wrapper">
            <?php $this->load->view('common/header'); ?>
            <div class="clearfix"> </div>
            <div class="page-container">
                <?php $this->load->view('common/sidebar'); ?>
                <div class="page-content-wrapper">
                    <div class="page-content">

                        <div class="row">
                            <div class="col-md-12">
                                <div id="msg_div">
                                    <?php if ($this->session->flashdata('success') != '') { ?>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    <?php } ?>
                                </div>

                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-body">
                                        <form action="" id="myFrm" method="post" class="horizontal-form" enctype="multipart/form-data">
<!--                                            <pre> <?php
                                            print_R($query);
                                            ?></pre>-->
                                            <div class="form-body">
                                              
                                                <div class="portlet-title">
                                                    <div class="caption"> <i class="icon-settings font-red"></i> <span class="caption-subject font-red sbold uppercase"> Footer Services Section </span> </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_heading_1'); ?></label>
                                                            <input type="text" name="service_heading_1" id="service_heading_1" value="<?php echo $query['service_heading_1']; ?>"  class="form-control" placeholder="">
														

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_content_1'); ?></label>
                                                            <textarea name="service_content_1" id="service_content_1"  class="form-control" ><?php echo $query['service_content_1']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_image_1'); ?></label>
                                                            <input type="file" name="service_image_1" id="service_image_1"  class="form-control" placeholder="">
															<span style="color: red;">For better display please upload image of 37px*35px</span>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">  </label>
                                                            <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $query['service_image_1']; ?>" width="100px" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_heading_2'); ?></label>
                                                            <input type="text" name="service_heading_2" id="service_heading_2" value="<?php echo $query['service_heading_2']; ?>"  class="form-control" placeholder="">
														

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_content_2'); ?></label>
                                                            <textarea name="service_content_2" id="service_content_2"  class="form-control" ><?php echo $query['service_content_2']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_image_2'); ?></label>
                                                            <input type="file" name="service_image_2" id="service_image_2"  class="form-control" placeholder="">
																		<span style="color: red;">For better display please upload image of 37px*35px</span>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">  </label>
                                                            <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $query['service_image_2']; ?>" width="100px" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_heading_3'); ?></label>
                                                            <input type="text" name="service_heading_3" id="service_heading_1" value="<?php echo $query['service_heading_3']; ?>"  class="form-control" placeholder="">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_content_3'); ?></label>
                                                            <textarea name="service_content_3" id="service_content_3"  class="form-control" ><?php echo $query['service_content_3']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo str_replace("_", " ", 'service_image_3'); ?></label>
                                                            <input type="file" name="service_image_3" id="service_image_3"  class="form-control" placeholder="">
														<span style="color: red;">For better display please upload image of 37px*35px</span>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">  </label>
                                                            <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $query['service_image_3']; ?>" width="100px" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                

                                            </div>
                                            <div class="form-actions right"><button id="frmSubmit" type="submit" class="btn blue"> <i class="fa fa-check"></i> Save  </button> </div>
                                        </form>
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
        <?php // $this->load->view('common/quick_nav');  ?>
        <?php $this->load->view('common/js_include'); ?>
        <script>


            $("#msg_div").fadeOut(7000);
        </script>

    </body>

</html>