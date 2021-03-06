
<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>
    <style>
        /* Code By Webdevtrick ( https://webdevtrick.com ) */
        .container {
            padding: 50px 10%;
        }

        .box {
            position: relative;
            background: #ffffff;
            width: 100%;
        }

        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
            border-bottom: 1px solid #f4f4f4;
            margin-bottom: 10px;
        }

        .box-tools {
            position: absolute;
            right: 10px;
            top: 5px;
        }

        .dropzone-wrapper {
            border: 2px dashed #91b0b3;
            color: #92b0b3;
            position: relative;
            height: 250px;
        }

        .dropzone-desc {
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            text-align: center;
            width: 40%;
            top: 50px;
            font-size: 16px;
        }

        .dropzone,
        .dropzone:focus {
            position: absolute;
            outline: none !important;
            width: 100%;
            height: 150px;
            cursor: pointer;
            opacity: 0;
        }

        .dropzone-wrapper:hover,
        .dropzone-wrapper.dragover {
            background: #ecf0f5;
        }

        .preview-zone {
            text-align: center;
        }

        .preview-zone .box {
            box-shadow: none;
            border-radius: 0;
            margin-bottom: 0;
        }

        .btn-primary {
            background-color: crimson;
            border: 1px solid #212121;
        }
    </style>
</head>
<body>
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
                <form action="" id="myFrm" method="post" enctype="multipart/form-data">
                    <div class="col-md-9">


                        




                        <div class="my-account-left-panel">
                            <div class="my-account-left-panel-sec1">
                                <h4>Edit Your Profile[ D-CODE : <?php echo $query['d_code']; ?> ]</h4>
                                <?php // print_r($query);?>
                                <span id="msg_box">
                                            <?php if ($this->session->flashdata('success') != '') { ?>
                                                <?php echo $this->session->flashdata('success'); ?>
                                            <?php } ?>
                                        </span>
                                <div class="my-account-left-panel-sec1-inner">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="artist-right-panel">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <input type="text" name="first_name" class="form-control"
                                                                   placeholder=""
                                                                   value="<?php echo $query['first_name']; ?>"
                                                                   id="first_name" required=""/>
                                                            <p class="error_msg"><?php echo form_error('first_name'); ?> </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" name="last_name" class="form-control"
                                                                   placeholder=""
                                                                   value="<?php echo $query['last_name']; ?>"
                                                                   id="last_name" required=""/>
                                                            <p class="error_msg"><?php echo form_error('last_name'); ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" readonly="" name="email"
                                                                   class="form-control" placeholder=""
                                                                   value="<?php echo $query['email']; ?>" id="email"
                                                                   required=""/>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select name="country_id" class="form-control" id="country">
                                                        <?php

                                                        foreach ($country->result() as $val) {
                                                            ?>
                                                            <option <?php
                                                            if ($val->id == $query['country_id']) {
                                                                echo 'selected';
                                                            }
                                                            ?> value="<?php echo $val->id; ?>"> <?php echo strtoupper($val->country_name); ?> </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>


                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" name="city" class="form-control"
                                                           value="<?php echo $query['city']; ?>"
                                                           placeholder="Ex-Kolkata" required id="city"/>
                                                    <p class="error_msg"><?php echo form_error('city'); ?> </p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="mobile">Mobile</label>
                                                    <span class="number-cuntrycode"><select id="std_code" name="dialcode" class="form-control"  style="width:90px">
                                                    <option value="">STD</option>
                                                    	
                                                        <?php

                                                        foreach ($dialcode->result() as $val) {
                                                            ?>
                                                            <option <?php
                                                            if ($val->id == $query['std_code']) {
                                                                echo 'selected';
                                                            }
                                                            ?> value="<?php echo $val->id; ?>"> <?php echo $val->dial_code; ?> </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                        <p class="error_msg"><?php echo form_error('std_code'); ?> </p>
                                                    </span>
                                                    <input type="text" name="mobile" id="phone_number"
                                                           class="form-control number-cuntry"
                                                           value="<?php echo $query['mobile']; ?>"
                                                           placeholder="9007100974" max="10"
                                                           title="Please enter a valid phone number" onkeyup="if (/\D/g.test(this.value))
			                                                    this.value = this.value.replace(/\D/g, '')" id="mobile"
                                                           required/>
                                                    <p class="error_msg"><?php echo form_error('mobile'); ?> </p>
													<p class="error_msg std_code_error_msg"><?php echo form_error('std_code'); ?> </p>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Accrediation Institute Name</label>
                                                            <input type="text" name="accrediation_name"
                                                                   class="form-control" placeholder=""
                                                                   value="<?php echo $query['accrediation_name']; ?>"
                                                                   id="accrediation_name" required=""/>
                                                            <p class="error_msg"><?php echo form_error('accrediation_name'); ?> </p>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Accrediation Number</label>
                                                            <input type="text" name="accrediation_no"
                                                                   class="form-control" placeholder=""
                                                                   value="<?php echo $query['accrediation_no']; ?>"
                                                                   id="accrediation_no" required=""/>
                                                            <p class="error_msg"><?php echo form_error('accrediation_no'); ?> </p>
                                                        </div>
                                                    </div>

                                                </div>
												<?php if ($query['certificate_file_name'] != '') { ?>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group accreditationtext">
                                                            <label>Accreditation / Any supporting document</label>

                                                            <input type="file" name="certificate" class="form-control"
                                                                   value="<?php echo $query['certificate_file_name']; ?>"
                                                                   placeholder="Upload Certificate" id="certificate"/>
                                                            
                                                            <a href="<?php echo base_url(); ?>uploads/users/<?php echo $query['certificate_file_name']; ?>"
                                                               download='<?php echo $query['certificate_file_name']; ?>'
                                                               class="downlode-btn"><i
                                                                        class="glyphicon glyphicon-download-alt "></i>
                                                                Download Copy </a><span
                                                                    class="certificat-name"><?php echo $query['certificate_file_name']; ?></span>
                                                        </div>
                                                        
                                                    </div> 
                                                        
                                                    <?php } else { ?>
                                                        No copy found
                                                    <?php } ?>
                                                    <!--<p class = "error_msg"><?php echo form_error('certificate'); ?> </p>-->


                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="virtual_studio">Virtual studio name</label>
                                                            <input type="text" id="virtual_studio" name="virtual_studio"
                                                                   value="<?php echo $query['virtual_studio']; ?>"
                                                                   class="form-control"/>
                                                            <p id="virtual_studio_err"
                                                               class="error_msg"><?php echo form_error('virtual_studio'); ?> </p>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label> Services</label>
                                                            <select name="service_id" class="form-control" id="service">
                                                                <?php
                                                                foreach ($service as $key => $val) {
                                                                    ?>
                                                                    <option <?php
                                                                    if ($val['id'] == $query['service_id']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> value="<?php echo $val['id']; ?>"> <?php echo strtoupper($val['service_name']); ?> </option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <p id="service_err"
                                                               class="error_msg"><?php echo form_error('service_id'); ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
												
											<div class="row">
                                         
                                                    <div class="col-sm-6" id="text" style="display:none;" >
                                                        <div class="form-group">
                                                            <label for="virtual_studio">Service Name</label>
                                                            <input type="text" id="text" name="others" required placeholder="Specify the service name"
                                                                   value="<?php echo $query['others']; ?>"
                                                                   class="form-control"/>
                                                           
                                                        
														 <p class="error_msg"><?php echo form_error('text'); ?> </p>
                                                    </div>
													</div>


                                        <hr style="margin-top:20px; height:2px;border-width:0;color:gray;background-color:gray">


                                        <div class="form-group col-md-12">
                                            <button type="submit" class="continue savebtn" id="editUser">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!--                        <div class="dashboard-btn-area col-sm-12">
                                <button type="submit" class="save">Save</button>
                            </div>-->

    </form>
    </div>
    </div>
    </div>
</section>


<div class="clearfix"></div>

<?php $this->load->view('common/footer'); ?>


</body>
<?php $this->load->view('common/footer_js'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(window).bind("load", function () {
	var service = $('#service').val();

	//alert($('#service').val());
if (service == '4')
{
  
$("#text").show();

}
if(service=='2')
{
  
$("#text").hide();

}
if(service=='3')
{
  
$("#text").hide();

}



});


</script>
<script>
  $('#service').change(function(){
	var service = $('#service').val();
$(".error_msg").html('');
	//alert($('#service').val());
if (service == '4')
{
 
$("#text").show();
$('#editUser').on('click', function () {
 if ($('#text').val() == '') {
	 $('#text').focus();
    $('#text').next(".error_msg").html('Please enter first name');
     
      
    }
});

}
if(service=='2')
{
  
$("#text").hide();

}
if(service=='3')
{
  
$("#text").hide();

}



});


</script>



<script>

    $(document).ready(function () {
        $('#artist,#member,#member_by_role,#virtual_studio_sec,#products_types,#design_store,#servicesec').hide();
        <?php if($_POST['role_id'] == '6'){ ?>
        $('#member,#products_types,#virtual_studio_sec').show();
        <?php } ?>
        <?php if($_POST['role_id'] == '1'){ ?>
        $('#artist,#member,#virtual_studio_sec,#servicesec').show();
        <?php } ?>
			 <?php if($_POST['role_id'] == '1'){ ?>
        $('#artist,#member,#virtual_studio_sec,#servicesec').show();
        <?php } ?>
			
    });


    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $('#editUser').on('click', function () {
        $(".error_msg").html('');
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
		if ($('#std_code').val() == '') {
			$('.std_code_error_msg').html('Please enter STD code');
            $('.std_code_error_msg').focus();

            return false;
        }

        
        if ($('#phone_number').val() == '') {
            $('#phone_number').next(".error_msg").html('Please enter mobile number');
            $('#phone_number').focus();
            return false;
        }
        if ($('#phone_number').val().length > parseInt('12') || $('#phone_number').val().length < parseInt('6')) {
            if ($('#city').val() == '') {
            $('#city').next(".error_msg").html('Please enter city');
            $('#city').focus();
            return false;
        }('#phone_number').next(".error_msg").html('Please enter a valid phone number');
            $('#phone_number').focus();
            return false;
        }
        if ($('#std_code').val() == '') {
            $('#std_code').next(".error_msg").html('Please enter Std code');
            $('#std_code').focus();
            return false;
        }

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
				//alert(123);
                $('#service').next(".error_msg").html('Please select service');
                $('#service').focus();
                return false;
            }
             if ($('#text').val() == '') {
				//alert(123);
                $('#text').next(".error_msg").html('Please Enter Other Service');
                $('#text').focus();
                return false;
            }

            if ($('#membership_id').val() == '') {
                $('#membership_id').next(".error_msg").html('Please select membership');
                $('#membership_id').focus();
                return false;
            }
			
			

        }

    });

</script>
<script>
    // Code By Webdevtrick ( https://webdevtrick.com )
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var htmlPreview =
                    '<img width="200" src="' + e.target.result + '" />' +
                    '<p>' + input.files[0].name + '</p>';
                var wrapperZone = $(input).parent();
                var previewZone = $(input).parent().parent().find('.preview-zone');
                var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                wrapperZone.removeClass('dragover');
                previewZone.removeClass('hidden');
                boxZone.empty();
                boxZone.append(htmlPreview);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function reset(e) {
        e.wrap('<form>').closest('form').get(0).reset();
        e.unwrap();
    }

    $(".dropzone").change(function () {
        readFile(this);
    });

    $('.dropzone-wrapper').on('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });

    $('.dropzone-wrapper').on('dragleave', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });

    $('.remove-preview').on('click', function () {
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        var previewZone = $(this).parents('.preview-zone');
        var dropzone = $(this).parents('.form-group').find('.dropzone');
        boxZone.empty();
        previewZone.addClass('hidden');
        reset(dropzone);
    });
</script>

</html> 
