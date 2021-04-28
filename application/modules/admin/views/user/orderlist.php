<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<?php $this->load->view('common/header_include'); ?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<div class="page-wrapper">
    <?php $this->load->view('common/header'); ?>
    <div class="clearfix"></div>
    <div class="page-container">
        <?php $this->load->view('common/sidebar'); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li><a href="">Dashboard</a> <i class="fa fa-circle"></i></li>
                        <li><span> Order List </span></li>
                    </ul>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div id="msg_div">
                                <?php if ($this->session->flashdata('success') != '') { ?>
                                    <?php echo $this->session->flashdata('success'); ?>
                                <?php } ?>
                            </div>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-globe"></i>Order List(
                                        <?php echo $query->num_rows(); ?>)
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" >
                                        <thead>
                                        <tr>
                                            <th>SI No.</th>
                                            <th> Name</th>
											<th> Address</th>
											
											
                                          
										    <th> Product Name</th>
											 <th> Order No</th>
                                            <th> Qty</th>
											<th> Price</th>
                                           
                                            <th>Subtotal</th>
                                          
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($query->num_rows() > 0) {
                                            $i = 1;
                                            foreach ($query->result() as $row) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->name;?>
                                                    </td>
													 <td>
                                                        <?php echo $row->address2;?>
                                                    </td>
													
													
													 
													 <td>
                                                        <?php echo $row->pname;?>
                                                    </td>
                                                 <td>
                                                        <?php echo $row->order_id; ?>
                                                    </td>
													<td>
                                                        <?php echo $row->qty ; ?>
                                                    </td>
													<td>
                                                        <?php echo $row->price; ?>
                                                    </td>
													<td>
                                                        <?php echo $row->subtotal; ?>
                                                    </td>
													
                                                   

                                                  
                                                </tr>
                                                <?php $i++;
                                            }
                                        } else { ?>
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
    <?php // $this->load->view('common/quick_nav'); ?>
    <?php $this->load->view('common/js_include'); ?>
    
</body>
</html>