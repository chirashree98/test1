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
                                    <div class="caption"> <i class="icon-settings font-red"></i> <span class="caption-subject font-red sbold uppercase"> Add Attribute</span> </div>
                                </div>
                                <div class="portlet-body">
                                    <form action="" id="myFrm" method="post" class="horizontal-form aditattribute" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Attribute Parent Name</label>
                                                        <select name="parent_id" class="form-control">
                                                            <option value="0">Select Parent Attribute</option>
                                                            <?php foreach ($parent_attr->result() as $row) { ?>
                                                            <option value="<?php echo $row->id ?>"><?php echo $row->attr_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Attribute Name</label>
                                                        <input type="text" required="" name="attr_name" id="attr_name" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right"><button id="frmSubmit" type="submit" class="btn blue"> <i class="fa fa-check"></i> Add Attribute </button> </div>
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
    <script>
       $(document).on("click", ".remove", function () {
           $(this).parent().remove();
       }); 
       $(document).on("click", ".addmore", function () {
           $('#addattr').append('<div ><input type="text" required="" name="attr_value[]"  class="form-control" placeholder=""><button type="button" class="btn red remove"> Remove </button></div>');
       });  
    </script>

</body>

</html>