<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"><span></span></div>
            </li>
            <li class="nav-item start <?php if ($this->uri->segment(2) == 'dashboard') { ?> active open <?php } ?>">
                <a href="<?php echo base_url(); ?>admin/dashboard" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>

           
                    <li class="nav-item">
                   
                           

            <li class="nav-item <?php if ($this->uri->segment(2) == 'category_management') { ?> active open <?php } ?>">
                <a href="javascript:" class="nav-link nav-toggle">
                    <i class="icon-wrench"></i>
                    <span class="title"> Category Management </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/category_management/all_category"
                           class="nav-link  <?php if ($this->uri->segment(3)== 'all_category') { ?> active open <?php } ?> ">
                            <span class="title">Category</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/sub_category_management/all_sub_category"
                           class="nav-link  <?php if ($this->uri->segment(3)== 'all_sub_category') { ?> active open <?php } ?> ">
                            <span class="title">Sub Category</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?php if ($this->uri->segment(2) == 'user_management') { ?> active open <?php } ?>">
                <a href="javascript:" class="nav-link nav-toggle">
                    <i class="icon-wrench"></i>
                    <span class="title"> User Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/user_management/all_customer"
                           class="nav-link  <?php if ($this->uri->segment(3) == 'all_customer') { ?> active open <?php } ?> ">
                            <span class="title">Customer List </span>
                        </a>
                    </li>

                 
                   

                 
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/user_management/all_order"
                           class="nav-link  <?php if ($this->uri->segment(3) == 'all_order') { ?> active open <?php } ?> ">
                            <span class="title">Order List</span>
                        </a>
                    </li>

<!--                    <li class="nav-item ">-->
<!--                        <a href="--><?php //echo base_url(); ?><!--admin/user_management/email_template"-->
<!--                           class="nav-link --><?php //if ($this->uri->segment(3) == 'email_template') { ?><!-- active open --><?php //} ?><!-- ">-->
<!--                            <span class="title">Email Template For Invitation Email</span>-->
<!--                        </a>-->
<!--                    </li>-->
                 
                </ul>
            </li>


            <li class="nav-item <?php if ($this->uri->segment(2) == 'product_management') { ?> active open <?php } ?>">
                <a href="javascript:" class="nav-link nav-toggle">
                    <i class="icon-wrench"></i>
                    <span class="title"> Product Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/product_management/all_product"
                           class="nav-link  <?php if ($this->uri->segment(3) == 'all_product') { ?> active open <?php } ?> ">
                            <span class="title">All Product</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>admin/product_management/all_attribute"
                           class="nav-link  <?php if ($this->uri->segment(3) == 'all_attribute') { ?> active open <?php } ?> ">
                            <span class="title">All Attribute</span>
                        </a>
                    </li>
                </ul>
            </li>

        
        
					
                  
          
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>