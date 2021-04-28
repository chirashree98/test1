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
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li> <a href="">Dashboard</a> <i class="fa fa-circle"></i> </li>
                            <li> <span>Sub category List</span> </li>
                        </ul>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right "> <a href="<?php echo base_url(); ?>admin/sub_category_management/add_sub_category" class="btn btn-success">Add Sub category</a> <br></div>
                        </div>
                        <div class="col-md-12">
                            <div id="msg_div">
                                <?php if ($this->session->flashdata('success') !=''){?>
                                <?php echo $this->session->flashdata('success'); ?>
                                <?php }?>
                            </div>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption"> <i class="fa fa-globe"></i>All sub category (
                                        <?php echo $query->num_rows(); ?>)</div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>SI No.</th>
                                                <th> Category Name </th>
                                                <th>Sub Category Name </th>
                                                <th>Created</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($query->num_rows() > 0){$i=1; foreach ($query->result() as $row){?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->sub_category_name; ?>
                                                </td>
                                                
                                                <td>
                                                    <?=date_time_format($row->created_at,$type=14);?>
                                                </td>
                                                <td> 
						    <a title="Edit" href="<?php echo base_url(); ?>admin/sub_category_management/edit_sub_category/<?php echo $row->id; ?>" class="btn-sm btn-success rounded-corner btn-share">Edit</a> 
                                                    <a title="Delete" onClick="return confirm('Would you like to delete this ?');" href="<?php echo base_url(); ?>admin/sub_category_management/delete_sub_category/<?php echo $row->id; ?>" class="btn-sm btn-danger rounded-corner btn-share">Delete</a> 
						</td>
                                            </tr>
                                            <?php $i++;}}else{?>
                                            <tr>
                                                <td colspan="9" class="dataTables_empty">No record found.</td>
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
   
</body>
</html>