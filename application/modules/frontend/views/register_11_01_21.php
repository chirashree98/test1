<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>
    <style>
        #artist, #member, #member_by_role, #virtual_studio_sec, #products_types, #design_store, #servicesec {
            display: none;
        }

        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>
<!--+++++++++++++ Header End +++++++++++++++++++-->
<div class="clearfix"></div>
<section id="scheme-sec1">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-12">
                <div class="login-form">
                    <div class="login-form-inner registerpage">
                        <h4>Registration</h4>
                        <span id="msg_box">
                                    <?php if ($this->session->flashdata('success') != '') { ?>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    <?php } ?>
                                </span>
                        <!--<form action="<?php echo base_url(); ?>frontend/user/adduser" method="POST" enctype="multipart/form-data">-->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <?php if(variable_value_check($user_type)){ ?>
                                <input type="hidden" name="role_id" value="<?= $user_type ?>">
                            <?php } ?>

                            <div class="form-group">
                                <label>Types of User </label><span class="mandate"> * </span>
                                <select name="role_id" id="role_id" class="form-control" <?= (variable_value_check($user_type)) ? '' : 'required' ?>>
                                    <option value="" <?= (variable_value_check($user_type)) ? 'disabled' : '' ?>> Select User Type</option>
                                    <?php
                                    foreach ($user_types->result() as $val) {
                                        ?>
                                        <option <?php
                                        if ((isset($_POST['role_id']) && $val->id == $_POST['role_id']) || (variable_value_check($user_type)) && $user_type == $val->id) {
                                            echo ' selected';
                                        }
                                        if(variable_value_check($user_type)){
                                            echo ' disabled';
                                        }
                                        ?> value="<?php echo $val->id; ?>"> <?php echo strtoupper($val->user_type_name); ?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_msg"><?php echo form_error('first_name'); ?> </p>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label><span class="mandate"> * </span>
                                        <input type="text" name="first_name"
                                               value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>"
                                               class="form-control" id="first_name" required/>
                                        <p class="error_msg"><?php echo form_error('first_name'); ?> </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="mandate"> * </span> <label for="first_name">Last Name</label>
                                        <input type="text" name="last_name"
                                               value="<?= isset($_POST['first_name']) ? $_POST['last_name'] : '' ?>"
                                               class="form-control" id="last_name" required/>
                                        <p class="error_msg"><?php echo form_error('last_name'); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label><span class="mandate"> * </span>
                                <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                       class="form-control" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>"
                                       id="email" required/>
                                <p id="email_err"
                                   class="error_msg"> <?php if ($this->session->flashdata('email_err') != '') { ?>
                                        <?php echo $this->session->flashdata('email_err'); ?>
                                    <?php } ?> </p>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password</label><span class="mandate"> * </span>
                                        <input type="password"
                                               value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>"
                                               required="" minlength="8" name="password" class="form-control" value=""
                                               id="password"/>
                                        <p class="error_msg"><?php echo form_error('password'); ?> </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Confirm Password</label> <span class="mandate"> * </span>
                                        <input type="password" required=""
                                               value="<?= isset($_POST['cpassword']) ? $_POST['cpassword'] : '' ?>"
                                               name="cpassword" class="form-control" placeholder="" id="cpassword"/>
                                        <p class="error_msg"
                                           id="cpassword_err"><?php echo form_error('cpassword'); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Country </label><span class="mandate"> * </span>
                                        <select name="country_id" class="form-control" id="country">
                                            <?php
                                            foreach ($country->result() as $val) {
                                                ?>
                                                <option <?php
                                                if (isset($_POST['country_id']) && $val->id == $_POST['country_id']) {
                                                    echo 'selected';
                                                }
                                                ?> value="<?php echo $val->id; ?>"> <?php echo strtoupper($val->country_name); ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <p class="error_msg"><?php echo form_error('country_id'); ?> </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="city">City</label><span class="mandate"> * </span>
                                        <input type="text" name="city" class="form-control"
                                               value="<?= isset($_POST['city']) ? $_POST['city'] : '' ?>"
                                               placeholder="Ex-Kolkata" required id="city"/>
                                        <p class="error_msg"><?php echo form_error('city'); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label><span class="mandate"> * </span>
                                <span class="number-cuntrycode">+966</span>
                                <input type="text" name="mobile" id="phone_number" class="form-control number-cuntry"
                                       value="<?= isset($_POST['mobile']) ? $_POST['mobile'] : '' ?>"
                                       placeholder="9007100974" max="10" title="Please enter a valid phone number"
                                       onkeyup="if (/\D/g.test(this.value))
                                                    this.value = this.value.replace(/\D/g, '')" id="mobile" required/>
                                <p class="error_msg"><?php echo form_error('mobile'); ?> </p>
                                <input type="hidden" name="email_verified" class="form-control"
                                       value="<?= isset($_POST['email_verified']) ? $_POST['email_verified'] : '' ?>"
                                       id="everify"/>
                                <input type="hidden" name="is_approved" class="form-control"
                                       value="<?= isset($_POST['is_approved']) ? $_POST['is_approved'] : '0' ?>"
                                       id="approved"/>
                            </div>

                            <div id="artist">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="accrediation_no">Accrediation Number</label><span
                                                    class="mandate"> * </span>
                                            <input type="text" name="accrediation_no" class="form-control"
                                                   value="<?= isset($_POST['accrediation_no']) ? $_POST['accrediation_no'] : '' ?>"
                                                   placeholder="Accrediation Number" id="accrediation"/>
                                            <p id="accrediation_err"
                                               class="error_msg"><?php echo form_error('accrediation_no'); ?> </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="certificate_copy">Accreditation / Any supporting
                                                document</label>
                                            <input type="file" name="certificate" class="form-control"
                                                   value="<?= isset($_POST['certificate']) ? $_POST['certificate'] : '' ?>"
                                                   placeholder="Upload Certificate" id="certificate"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="virtual_studio_sec">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div id="for_designer">
                                                <label for="virtual_studio">Virtual studio name </label>
                                            </div>
                                            <div id="for_store">
                                                <label for="virtual_studio">Virtual store name </label>
                                            </div>
                                            <span
                                                    class="mandate"> * </span>
                                            <input type="text" id="virtual_studio" name="virtual_studio"
                                                   value="<?= isset($_POST['virtual_studio']) ? $_POST['virtual_studio'] : '' ?>"
                                                   class="form-control"/>
                                            <p id="virtual_studio_err"
                                               class="error_msg"><?php echo form_error('virtual_studio'); ?> </p>

                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label> Services </label><span class="mandate"> * </span>
                                        <select name="service_id" class="form-control" id="service">
                                            <?php
                                            foreach ($service as $key => $val) {
                                                ?>
                                                <option <?php
                                                if (isset($_POST['service_id']) && $val['id'] == $_POST['service_id']) {
                                                    echo 'selected';
                                                }
                                                ?> value="<?php echo $val['id']; ?>"> <?php echo strtoupper($val['service_name']); ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <p id="service_err"
                                           class="error_msg"><?php echo form_error('service_id'); ?>
                                        </p>
                                    </div>
                                
								 
                            <div class="form-group col-sm-12" id="text" style="display:none;">
                                                        <div class="form-group">
                                                            <label  id="text2"for="virtual_studio">Service Name</label>
                                                            <input type="text" id="text" name="others"
                                                                   value="<?php echo $query['others']; ?>"placeholder="Specify the service name"
                                                                   class="form-control"/>
                                                            <p id="virtual_studio_err"
                                                               class="error_msg"><?php echo form_error('others'); ?> </p>
                                                        </div>
                                                 </div>   

                                <div id="products_types">
                                    <div class="form-group col-sm-6">
									 <select class="form-control" name="products_types_id" required="" id="products_types1">
									 <option value="">----Select Product Types---</option>
                                        <label> Products Types </label> <span class="mandate"> * </span>
                                        <?php
                                                            if (count($products->result()) > 0) {

                                                                foreach ($products->result() as $sval) {
                                                                    ?>
                                                                    <option  value = "<?php echo $sval->id; ?>"  > <?php echo strtoupper($sval->product_types); ?> </option>
                                                                        <?php
                                                                    }
														  }
                                                            ?>
															</select>
                                        <p id="products_types_err" class="error_msg"><?php echo form_error('products_types_id'); ?>
                                    </div>
                                </div>

                                <div id="member">
                                    <div class="form-group col-sm-12">
                                        <label> Membership </label><span class="mandate"> * </span>
                                        <select name="membership_id" class="form-control" id="membership_id">
                                            <option value="0"> Select Membership</option>
                                        </select>
                                        <p class="error_msg"><?php echo form_error('membership_id'); ?> </p>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group invitation_code">
                                           <span><label for="invitation_code">Invitation Code</label>
                                            <span class="mandate"> * </span>
                                            <input type="text" id="invitation_code" name="invitation_code" value="<?= (isset($_POST['invitation_code'])) ? $_POST['invitation_code'] : '' ?><?= (variable_value_check($invitation_code)) ? $invitation_code : '' ?>" class="form-control" placeholder="Enter invitation code"/>
                                            <p class="error_msg"><?php echo form_error('invitation_code_error'); ?> </p>
                                            </span> 
                                             <a href="javascript:void(0);" id="check_invitation_code" class="btn btn-primary">Verify</a>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div id="design_store">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="design_store">Design Store</label><span
                                                    class="mandate"> * </span>
                                            <input type="text" name="design_store"
                                                   value="<?= isset($_POST['design_store']) ? $_POST['design_store'] : '' ?>"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                            <div class="loader" style="display:none;"></div>
							<div class="col-sm-12">
                            <input type="submit" class="btn btn-primary" value="Register" id="addUser"/></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<!--+++++++++++++ footer Start +++++++++++++++++++-->
<?php $this->load->view('common/footer'); ?>
</body>
<?php $this->load->view('common/footer_js'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$('#service').change(function(){
	//alert($('#service').val());
if($('#service').val()=='4')
{
  
$("#text").show();

}
if($('#service').val()=='2')
{
  
$("#text").hide();

}
if($('#service').val()=='3')
{
  
$("#text").hide();

}



});
});

</script>
<script>

    $(document).ready(function () {
        $('#artist,#member,#member_by_role,#virtual_studio_sec,#products_types,#design_store,#servicesec, #for_designer, #for_store').hide();

        <?php if(isset($_POST['role_id']) && $_POST['role_id'] == '6'){ ?>
        $('#member,#products_types,#virtual_studio_sec,  #for_store').show();
        $.post('<?php echo base_url(); ?>frontend/user/getMembershipByUserType', 'role_id=' +<?php echo $_POST['role_id']; ?>, function (data) {
            $('#membership_id').html(data);
            $('#membership_id [value=<?php echo $_POST['membership_id']; ?>]').attr('selected', 'true');
        });
        <?php } ?>

        <?php if($user_type == '6'){ ?>
        $('#member,#products_types,#virtual_studio_sec,  #for_store').show();
        $.post('<?php echo base_url(); ?>frontend/user/getMembershipByUserType', 'role_id=' +<?php echo $user_type; ?>, function (data) {
            $('#membership_id').html(data);
            $('#member,#products_types,#virtual_studio_sec, #for_store').show();
			$("#service").hide();
            $('.loader').hide();
        });
        <?php } ?>

        <?php if(isset($_POST['role_id']) && $_POST['role_id'] == '1'){ ?>
        $('#artist,#member,#virtual_studio_sec,#service, #for_designer').show();
        $.post('<?php echo base_url(); ?>frontend/user/getMembershipByUserType', 'role_id=' +<?php echo $_POST['role_id']; ?>, function (data) {
            $('#membership_id').html(data);
            $('#membership_id [value=<?php echo $_POST['membership_id']; ?>]').attr('selected', 'true');
        });
        <?php } ?>

        <?php if($user_type == '1'){ ?>
        $('#artist,#member,#virtual_studio_sec,#service, #for_designer').show();
        $.post('<?php echo base_url(); ?>frontend/user/getMembershipByUserType', 'role_id=' +<?php echo $user_type; ?>, function (data) {
            $('#membership_id').html(data);
            $('#artist,#member,#virtual_studio_sec,#service,  #for_designer').show();
            $('.loader').hide();
        });
        <?php } ?>
    });


    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $('#addUser').on('click', function () {

        // alert($('#role_id').val());


        $(".error_msg").html('');
        $('.alert').remove();

        if ($('#role_id').val() == '') {
            $('#role_id').next(".error_msg").html('Please Select user type ');
            $('#role_id').focus();
            return false;
        }

        if ($('#role_id').val() == '') {
            $('#role_id').next(".error_msg").html('Please Select user type ');
            $('#role_id').focus();
            return false;
        }
        if ($('#first_name').val() == '') {
            $('#first_name').next(".error_msg").html('Please enter first name');
            $('#first_name').focus();
            return false;
        }
        if ($('#last_name').val() == '') {
            $('#last_name').next(".error_msg").html('Please enter last name');
            $('#last_name').focus();
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
        if ($('#email').val() != '' && isEmail($('#email').val())) {
            $.post('<?php echo base_url(); ?>frontend/user/chechUserExist', 'email=' + $('#email').val(), function (data) {
                if (data == 'exist') {
                    $('#email').next(".error_msg").html('Email already exist.');
                    $('#email').focus();
                    return false;
                }
            });
        }

        if ($('#password').val() == '') {
            $('#password').next(".error_msg").html('Please enter password');
            $('#password').focus();
            return false;
        }
        if ($('#password').val().length < parseInt('8')) {
            $('#password').next(".error_msg").html('Please enter eight or more characters');
            $('#password').focus();
            return false;
        }
        if ($('#password').val() != $('#cpassword').val()) {
            $('#cpassword').next(".error_msg").html('Password Must be Matching.');
            $('#cpassword').focus();
            return false;
        }
        if ($('#city').val() == '') {
            $('#city').next(".error_msg").html('Please enter city');
            $('#city').focus();
            return false;
        }
        if ($('#phone_number').val() == '') {
            $('#phone_number').next(".error_msg").html('Please enter mobile number');
            $('#phone_number').focus();
            return false;
        }
        if ($('#phone_number').val().length > parseInt('12') || $('#phone_number').val().length < parseInt('6')) {
            $('#phone_number').next(".error_msg").html('Please enter a valid phone number');
            $('#phone_number').focus();
            return false;
        }
        var invitation_code = $('#invitation_code').val();
        var role_id = $('#role_id').val();
        var email = $('#email').val();

        if(invitation_code != '') {
            $.ajax({
                url: base_url + 'check-invitation-code/' + invitation_code + '/' + role_id + '/' + email,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    if (result.status == 'fail') {
                        $('#invitation_code').after('<div class="alert alert-danger" role="alert">Invitation code is not valid.</div>');
                        $('#invitation_code').focus();
                        return false;
                    }
                }
            });
        }

        $('#role_id').val();

        if ($('#role_id').val() == '1') {


            if ($('#accrediation').val() == '') {
                $('#accrediation').next(".error_msg").html('Please enter accrediation number');
                $('#accrediation').focus();
                return false;
            }

            if ($('#virtual_studio').val() == '') {
                $('#virtual_studio').next(".error_msg").html('Please enter virtual studio name');
                $('#virtual_studio').focus();
                return false;
            }
			

            if ($('#service').val() == '') {
                $('#service').next(".error_msg").html('Please select service');
                $('#service').focus();
                return false;
            }
			

            if ($('#membership_id').val() == '') {
                $('#membership_id').next(".error_msg").html('Please select membership');
                $('#membership_id').focus();
                return false;
            }

        }
        if ($('#role_id').val() == '6') {

            if ($('#virtual_studio').val() == '') {
                $('#virtual_studio').next(".error_msg").html('Please enter virtual studio name');
                $('#virtual_studio').focus();
                return false;
            }
           

            if ($('#products_types1').val() == '') {
                $('#products_types1').next(".error_msg").html('Please select product types');
                $('#products_types1').focus();
                return false;
            }
            if ($('#membership_id').val() == '') {
                $('#membership_id').next(".error_msg").html('Please select membership');
                $('#membership_id').focus();
                return false;
            }

        }
    });
    $('#role_id').on('change', function () {
        $('#artist,#member,#member_by_role,#virtual_studio_sec,#products_types,#design_store,#servicesec, #for_designer,  #for_store').hide();
           
        $('.loader').show();
        if ($('#role_id').val() == '6') {
            $.post('<?php echo base_url(); ?>frontend/user/getMembershipByUserType', 'role_id=' + $('#role_id').val(), function (data) {
                $('#membership_id').html(data);
                $('#member,#products_types,#virtual_studio_sec, #for_store').show();
				$("#service").hide();
                $('.loader').hide();
            });
        }
        if ($('#role_id').val() == '1') {
            $.post('<?php echo base_url(); ?>frontend/user/getMembershipByUserType', 'role_id=' + $('#role_id').val(), function (data) {
                
                console.log(data);

                $('#membership_id').html(data);
                $('#artist,#member,#virtual_studio_sec, #for_designer,#service').show();
                $('.loader').hide();
            });
        } else {
            $('#artist,#member,#member_by_role,#virtual_studio_sec,#products_types,#design_store,#service,  #for_designer, #text, #for_store,#text2').hide();
            $('.loader').hide();
        }
    });
</script>
</html>