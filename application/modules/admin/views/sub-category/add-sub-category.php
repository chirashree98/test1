<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <?php $this->load->view('common/header_include'); ?>
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
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="icon-settings font-red"></i> <span class="caption-subject font-red sbold uppercase"> Add Sub category</span> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <form action="<?php echo base_url(); ?>admin/sub_category_management/save_sub_category" id="myFrm" method="post" class="horizontal-form">
                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group"> <label class="control-label">Category Name</label> 
                                                            <select required="" class="form-control" name ="category_id">
                                                                <option value="">No Selected</option>
                                                                <?php
                                                                foreach ($query->result() as $row) {
                                                                    echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Sub Category Name</label>
                                                            <input type="text" required="" name="sub_category_name" id="sub_category_name" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>





                                            </div>
                                            <div class="form-actions right"><button id="frmSubmit" type="submit" class="btn blue"> <i class="fa fa-check"></i> Add sub_category </button> </div>
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
            <?php // $this->load->view('common/quick_nav'); ?>
        <?php $this->load->view('common/js_include'); ?>

    </body>

</html>