<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  



        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

    <div class="clearfix"></div>




    <section id="artist-accept-decline">
        <div class="custom-width">
            <div class="artist-heading">
                <h1>DESIGNER DASHBOARD</h1>
            </div>

            <div class="artist-accept-decline-inner">
                <div class="row">
                    <div class="col-md-3">
                        <div class="artist-left-panel">
                            <?php $this->load->view('artist/artist-left-panel'); ?>  
                        </div>
                    </div>
                    <form action="<?php echo base_url(); ?>designer_store_bankdetails" id="myFrm" method="post"  enctype="multipart/form-data" >
                        <div class="col-md-9">
						<span id="msg">
                                        <?php if ($this->session->flashdata('success') != '') { ?>
                                            <?php echo $this->session->flashdata('success'); ?>
                                        <?php } ?>
                                    </span>
                            <div class="my-account-left-panel">
                                <div class="my-account-left-panel-sec1">
                                    <h4>Bank  Account Details</h4>
                                    <?php // print_r($query);?>
                                    
                                    <div class="my-account-left-panel-sec1-inner">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="artist-right-panel">


<!--                                    <p>Edit Profile</p>-->
<!--                                                        <pre>
                                                    <?php
                                                    print_R($query);
                                                    ?>
                                                        </pre>-->




                                                   
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" id="user_id" value="<?php echo $query['user_id']; ?>" />
                                                        <label>Account Number</label>
                                                        <input type="number" name="account_no" class="form-control" onblur="accountno()" placeholder="Account no" value="<?php echo $query['account_no']; ?>" id="account_no" required/>
                                                        <p class = "error_msg"><?php echo form_error('account_no'); ?> </p>
                                                        <p class="registrationFormAlert col-md-12" id="divCheckPasswordMatch"></p>
                                                    </div>
                                                    <div class="form-group">

                                                        <label>Account Holder  Name</label>
                                                        <input type="text" name="account_holder" class="form-control" placeholder="Account Holder" value="<?php echo $query['account_holder']; ?>" id="account_holder" required/>
                                                        <p class = "error_msg"><?php echo form_error('account_holder'); ?> </p>
                                                    </div>
                                                    <div class="form-group">

                                                        <label>IBAN Code </label>
                                                        <input type="text" name="iban_code" class="form-control" placeholder="Iban Code" value="<?php echo $query['iban_code']; ?>" id="iban_code" required/>
                                                        <p class = "error_msg"><?php echo form_error('iban_code'); ?> </p>
                                                        <p class="registrationFormAlert col-md-12" id="divCheckPasswordMatch2"></p>


                                                        <label>Branch Name  </label>
                                                        <input type="text" name="branch_name" class="form-control" placeholder="Branch Name" value="<?php echo $query['branch_name']; ?>" id="branch_name" required/>
                                                        <p class = "error_msg"><?php echo form_error('branch_name'); ?> </p>


                                                        <label>Branch Address </label>
                                                        <textarea name="branch_address" id="branch_address" class="form-control" placeholder="Branch Address"><?php echo $query['branch_address']; ?></textarea>
                                                        <p class = "error_msg"><?php echo form_error('branch_address'); ?> </p>
                                                    </div>

                                                    <div class="form-group">


                                                    </div>





                                                    <div class="form-group">
                                                        <button type="submit" class="continue savebtn" id="editUser">Save</button>
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
                <!--                        <div class="dashboard-btn-area col-sm-12">
                                            <button type="submit" class="save">Save</button>
                                        </div>-->

            </div>
        </div>
    </div>
</section>




<div class="clearfix"></div> 

<?php $this->load->view('common/footer'); ?>  


</body>

<?php $this->load->view('common/footer_js'); ?>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

                                                            $('#editUser').on('click', function () {
                                                                //alert(123);
                                                                $(".error_msg").html('');

                                                                if ($('#account_no').val() == '') {
                                                                    $('#account_no').next(".error_msg").html('Please enter Account No');
                                                                    $('#account_no').focus();

                                                                    return false;
                                                                } else {
                                                                    var value2 = $("#account_no").val().length;
                                                                    //alert(value2);
                                                                   if ((value2>=12)&&(value2<18)) {
                                                                        $("#divCheckPasswordMatch").html('');

                                                                    } else {
                                                                        $("#divCheckPasswordMatch").html('<span style="color:red">Please enter Valid Account No</span>');
                                                                        return false;
                                                                    }

                                                                }

                                                                if ($('#account_holder').val() == '') {
                                                                    $('#account_holder').next(".error_msg").html('Please enter Account Holder Name');
                                                                    $('#account_holder').focus();
                                                                    return false;
                                                                }

                                                                if ($('#iban_code').val() == '') {
                                                                    $('#iban_code').next(".error_msg").html('Please enter Iban code');
                                                                    $('#iban_code').focus();
                                                                    return false;
                                                                } else {
                                                                    var value21 = $("#iban_code").val().length;
                                                                    //alert(value2);
                                                                    if ((value21>=12)&&(value21<18)) {
                                                                        $("#divCheckPasswordMatch2").html('');

                                                                    } else {
                                                                        $("#divCheckPasswordMatch2").html('<span style="color:red">Please enter Valid Iban Code</span>');
                                                                        return false;
                                                                    }

                                                                }


                                                                if ($('#branch_name').val() == '') {
                                                                    $('#branch_name').next(".error_msg").html('Please enter Branch Name');
                                                                    $('#branch_name').focus();
                                                                    return false;
                                                                }

                                                                if ($('#branch_address').val() == '') {
                                                                    $('#branch_address').next(".error_msg").html('Please enter Branch Address');
                                                                    $('#branch_address').focus();
                                                                    return false;
                                                                }

                                                            });



</script>
<script>


    $("#msg").fadeOut(3000);
</script>



</html> 
