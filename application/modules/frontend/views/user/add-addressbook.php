<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        <div class="clearfix"></div>






        <section id="my-account">
            <div class="custom-width">
                <div class="page-heading">
                    <h1>Add New Address</h1>
                </div>

                <div class="my-account-inner">
                    <div class="col-md-3">
                            <div class="artist-left-panel">
                               <?php $this->load->view('common/myaccount_side_panel'); ?> 
                            </div>
                        </div>
                    
                        <div class="col-sm-9">
                            <span id="msg_box">
                                <?php if ($this->session->flashdata('success') != '') { ?>
                                    <?php echo $this->session->flashdata('success'); ?>
                                <?php } ?>
                            </span>
                            <div class="my-account-left-panel">
                                     <button class="back-to-design-request orderback" onclick="location.href='<?= base_url('all-addressbook') ?>';"><img src="<?= base_url('assets/front/images/back-arrow.png') ?>"> BACK</button>
                                <div class="my-account-left-panel-sec1">
                                    <h4>Add New Address</h4>
                                    <?php //print_r($query);?>
                                    <div class="my-account-left-panel-sec1-inner">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <form action="<?php echo base_url(); ?>save-addressbook" id="myFrm" method="post" >

                                                    <p>Contact Information</p>
                                                    <div class="form-group">

                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control" placeholder="Name" value ="" id="name" required/>
                                                        <p class = "error_msg"><?php echo form_error('name'); ?> </p>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email" placeholder="Email" id="email" value=""/>
                                                        <p class = "error_msg"><?php echo form_error('email'); ?> </p>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                         <span class="number-cuntrycode"><select id="std_code" name="dial_code" class="form-control"  style="width:90px" required="required">
														<option value=""> STD </option>
                               
                                            <?php
                                            foreach ($stdcode->result() as $val) {
                                                ?>
                                                <option  value="<?php echo $val->id; ?>"> <?php echo $val->dial_code; ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
										
		</span>
                                                        <input type="number" name="phone" class="form-control number-cuntry" placeholder="phone" id="phone" value=""/>
                                                        <p class = "error_msg"><?php echo form_error('phone'); ?> </p> 
                                                        <p class="error_msg std_code_error_msg"><?php echo form_error('std_code'); ?> </p>
                                                    </div>

                                                    <p>Address Details</p>
                                                   <!--<div class="form-group">
                                                        <label>Company</label>
                                                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="ABC Company Pvt. Ltd." value =""/>
														 </div>
                                                        <p class = "error_msg"><?php echo form_error('company_name'); ?> </p>-->
                                                   

                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="address2" id="address2" class="form-control" placeholder="Shyamanagar" value =""/>
                                                        <p class = "error_msg"><?php echo form_error('address2'); ?> </p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" name="city" class="form-control" placeholder="City" value ="<?php echo $query['city']; ?>" id="city" />
                                                        <p class = "error_msg"><?php echo form_error('city'); ?> </p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Post Code</label>
                                                        <input type="text" name="postcode" id="postcode" class="form-control" placeholder="" value =""/>
                                                        <p class = "error_msg"><?php echo form_error('postcode'); ?> </p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select name = "country_id" class = "form-control" id = "country" >
                                                          <option value="">Select Country</option>
                                                            <?php
                                                            foreach ($country->result() as $val) {
                                                                ?>
                                                                <option <?php
                                                               // if ($val->id == $query['country_id']) {
                                                                    //echo 'selected';
                                                                //}
                                                                ?> value  = "<?php echo $val->id; ?>"  > <?php echo strtoupper($val->country_name); ?> </option>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </select>
                                                        <p class = "error_msg"><?php echo form_error('country_id'); ?> </p>
                                                    </div>

                                                    <div class="form-group" >
                                                        <label>Rigion / State</label>
                                                        <select class="form-control" name="state_id" required="" id="state">



                                                            <option value ="">Select Country First</option>



                                                        </select>
                                                        <p class = "error_msg"><?php echo form_error('state_id'); ?> </p>
                                                    </div>


                                                    <div class="form-group">
                                                        <!--
                                                        <button class="back">Back</button>
                                                        <button  class="back"href="<?php echo base_url(); ?>all-addressbook">Back</button>-->
                                                        <button class="continue" id = "editUser">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                      

                                    </div>
                                </div>

                            </div>
                        </div>
                        
             
        </section>




        <div class="clearfix"></div> 

        <?php $this->load->view('common/footer'); ?>  


    </body>
    <?php $this->load->view('common/footer_js'); ?>  

    <script>
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        $('#editUser').on('click', function () {
            $(".error_msg").html('');

            if ($('#name').val() == '') {
                $('#name').next(".error_msg").html('Please enter name');
                $('#name').focus();
                return false;
            }
            if ($('#email').val() == '') {
                $('#email').next(".error_msg").html('Please enter email id ');
                $('#email').focus();
                return false;
            }
            if (!isEmail($('#email').val())) {
                $('#email').next(".error_msg").html('Please enter a valid email id ');
                $('#email').focus();
                return false;

            }
            if ($('#std_code').val() == '') {
			$('.std_code_error_msg').html('Please enter STD code');
            $('.std_code_error_msg').focus();

            return false;
        }
            if ($('#phone').val() == '') {
                $('#phone').next(".error_msg").html('Please enter mobile number');
                $('#phone').focus();
                return false;
            }
            if ($('#phone').val().length > parseInt('12') || $('#phone').val().length < parseInt('6')) {
                $('#phone').next(".error_msg").html('Please enter a valid phone number');
                $('#phone').focus();
                return false;
            }
		
            if ($('#address2').val() == '') {
                $('#address2').next(".error_msg").html('Please enter address');
                $('#address2').focus();
                return false;
            }
            
			if ($('#city').val() == '') {
                $('#city').next(".error_msg").html('Please enter city');
                $('#city').focus();
                return false;
            }
            if ($('#postcode').val() == '') {
                $('#postcode').next(".error_msg").html('Please enter postcode');
                $('#postcode').focus();
                return false;
            }
            if ($('#country').val() == '') {
                $('#country').next(".error_msg").html('Please select country');
                $('#country').focus();
                return false;
            }
			if ($('#state').val() == '') {
                $('#state').next(".error_msg").html('Please select state');
                $('#state').focus();
                return false;
            }

        });




        $('#country').on('change', function () {
            //alert($('#country').val());
            // $('#state').hide();

            $('.loader').show();

            $.post('<?php echo base_url(); ?>frontend/user/getstate', 'country_id=' + $('#country').val(), function (data) {
                $('#state').html(data);
                $('.loader').hide();
            });
        });

    </script>

</html>
