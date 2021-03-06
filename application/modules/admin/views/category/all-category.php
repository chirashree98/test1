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
                            <li> <span>Category List</span> </li>
                        </ul>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right "> <a href="<?php echo base_url(); ?>admin/category_management/add_category" class="btn btn-success">Add Category</a> <br></div>
                        </div>
                        <div class="col-md-12">
                            <div id="msg_div">
                                <?php if ($this->session->flashdata('success') !=''){?>
                                <?php echo $this->session->flashdata('success'); ?>
                                <?php }?>
                            </div>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption"> <i class="fa fa-globe"></i>All Category (
                                        <?php echo $query->num_rows(); ?>)</div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>SI No.</th>
                                                <th> Name </th>

                                              
                                               
												
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
						    <a title="Edit" href="<?php echo base_url(); ?>admin/category_management/edit_category/<?php echo $row->id; ?>" class="btn-sm btn-success rounded-corner btn-share">Edit</a> 
                                                    <a title="Delete" onClick="return confirm('Would you like to delete this ?');" href="<?php echo base_url(); ?>admin/category_management/delete_category/<?php echo $row->id; ?>" class="btn-sm btn-danger rounded-corner btn-share">Delete</a> 
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
	 <!--<script>
        function Status(id, val) {
			
            $.post('<?php echo base_url(); ?>admin/category_management/change_category_status', 'id=' + id + '&val=' + val, function(data) {
                $('#statusDiv' + id).html('<i class="fa fa-spinner"></i>');
                if (val == '0') {
					alert(123);
					
                    var val2 = "'1'";
                    var text = '<a href="javascript: void(0);"  onclick="Status(' + id + ',' + val2 + ');"><input type="checkbox" name="status" value="0"></a>';
                    $('#statusDiv' + id).html(text);
                    $("#msgDiv").show("");
                } else {
                    var val2 = "'0'";
                    var text = '<a href="javascript: void(0);"  onclick="Status(' + id + ',' + val2 + ');"><input type="checkbox" name="status" value="1"></a>';
                    $('#statusDiv' + id).html(text);
                }
            });
        }
    </script>-->
	<script>
        function Status(id, val) {
			//alert(123);
//			console.log($('#statusDiv'+id));
			if($('#statusDiv'+id).prop('checked')){
				console.log($('input:checkbox:checked').length);

				if($('input:checkbox:checked').length <= 6){
					$.post('<?php echo base_url(); ?>admin/category_management/change_category_status', 'id=' + id + '&val=' + val, function(data) {

						$('#statusDiv' + id).attr('onchange', 'Status('+id+', "0")');
					});
				} else {
					
					$('#statusDiv'+id).removeAttr('checked');
					$('#statusDiv' + id).attr('onchange', 'Status('+id+', "1")');
					alert('Maximum 6 category can be selected');
				}
			} else {

				$.post('<?php echo base_url(); ?>admin/category_management/change_category_status', 'id=' + id + '&val=' + val, function(data) {

						$('#statusDiv' + id).attr('onchange', 'Status('+id+', "1")');
					});
			}

				
            //
                //$('#statusDiv' + id).html('<i class="fa fa-spinner"></i>');
				//var bol = $( '#checkbox' + ':checked').length;
				//alert(bol);
				//var maxAllowed = 3;
				//if (bol < maxAllowed) {
                //if (val == '1') {
					
                    //var val2 = "'0'";
                    //var text = '<a href="javascript: void(0);"  onclick="Status(' + id + ',' + val2 + ');"><input type ="checkbox" id="checkbox"checked="true"></a>';
                    //$('#statusDiv' + id).html(text);
                    //$("#msgDiv").show("");
                //} else {
                    //var val2 = "'1'";
                    //var text = '<a href="javascript: void(0);"  onclick="Status(' + id + ',' + val2 + ');"><input type ="checkbox" id="checkbox" ></a>';
                    //$('#statusDiv' + id).html(text);
               // }
			//}
				//if (bol == maxAllowed) 
				//{
         
				//alert('Select maximum ' + maxAllowed + 'category');
				//}
            
        }
    </script>
   
</body>
</html>