<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/header'); ?>

</head>

<body>
    <?php $this->load->view('common/header_nav'); ?>

    <!--+++++++++++++ Header End +++++++++++++++++++-->

    <div class="clearfix"></div>
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


    <section id="artist-accept-decline">
        <div class="custom-width">
            <div class="artist-heading">
                <h1>DESIGNER Dashboard</h1>
            </div>
            <span id="msg_box">
                <?php if ($this->session->flashdata('success') != '') { ?>
                <?php echo $this->session->flashdata('success'); ?>
                <?php } ?>
            </span>
            <div class="artist-accept-decline-inner">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="artist-left-panel">
                            <?php $this->load->view('artist/artist-left-panel'); ?>
                        </div>
                   
					
						 </div>

                    <div class="col-md-9">
                        <div class="my-account-left-panel">
						<button class="back-to-design-request orderback" onclick="location.href='<?= base_url('all_work_samples') ?>';"><img src="<?= base_url('assets/front/images/back-arrow.png') ?>"> BACK
                        </button>
                            <div class="my-account-left-panel-sec1">
                                <h4>Edit Work Samples</h4>
								  
                                <?php // print_r($query);?>
                                <div class="my-account-left-panel-sec1-inner">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="artist-right-panel">


                                                <form action="<?php echo base_url(); ?>update-worksamples" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" id="id" value="<?php echo $query_update['id']; ?>" />

                                                    <div class="form-group">
                                                        <label>Edit image</label>
                                                        <div class="dropzone-wrapper col-sm-8">
                                                            <div class="dropzone-desc">
                                                                <i class="glyphicon glyphicon-download-alt"></i>
                                                                <p>Choose an image file or drag it here.</p>
                                                            </div>

                                                            <input type="file" name="imagefile" class="dropzone" id='fileupload'>
															  &nbsp; <span style="color: red;">For better display please upload image of 1252px*1252px</span>
                                                            <input type="hidden" name="imagefile" value="<?php echo $query_update['image']; ?>">
                                                        </div>

                                                        <div class="preview-zone col-sm-4">
                                                            <div class="box box-solid">
                                                                <div class="box-body">
                                                                    <img src="<?php echo base_url('uploads/artist/'.$query_update['image']); ?>" class="img-responsive">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <!--
                            <div class="form-group" id="imgdiv">
                                <label>Or Add Image</label>
                                <input type="file" class="form-control" name="imagefile" id="imagefile"><br>
                                <input type="hidden" name="imagefile"  value="<?php echo $query_update['image']; ?>">
                                <img src="<?php echo base_url(); ?>uploads/artist/<?php echo $query_update['image']; ?>"  name="imagefile" class="img-responsive">
                            </div>
							-->

                                                    <!-- <div class="backwhite">     -->
                                                    <div class="form-group">
                                                        <label>Image Name</label>
                                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $query_update['name']; ?>">
                                                        <p class="error_msg"><?php echo form_error('name'); ?> </p>
                                                    </div>





                                                    <div class="form-group">
                                                        <label>Enter Project Details</label>
                                                        <textarea type="text" class="form-control" name="details" id="details"><?php echo $query_update['details']; ?></textarea>
                                                        <p class="error_msg"><?php echo form_error('details'); ?> </p>
                                                    </div>

                                                    <div class="form-group divcurrrency" id="currency">

                                                        <label> Currency</label>
                                                        <select id="currency" name="currency" class="form-control">

                                                            <?php foreach ($currency->result() as $row) { ?>


                                                            <option <?php 
                                                            if($row->currency_id ==$query_update['currency']) 
                                                             {
                                                                echo 'selected';
                                                            }
                                                            ?> value="<?php echo $row->currency_id; ?>"><?php echo $row->currency_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <p class="error_msg"><?php echo form_error('currency'); ?> </p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Project Cost</label>
                                                        <input type="number" min="0" class="form-control" name="cost" id="cost" value="<?php echo $query_update['cost']; ?>">
                                                        <p class="error_msg"><?php echo form_error('cost'); ?> </p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Enter Description</label>
                                                        <textarea type="text" class="form-control" name="description" id="description"><?php echo $query_update['description']; ?></textarea>
                                                        <p class="error_msg"><?php echo form_error('description'); ?> </p>
                                                    </div>
                                                    <!-- <label>Previous Project Images </label> -->
                                                    

                                                    

                                                   


                                                        <div class="form-group">
                                                        <label>Multiple Project Images </label>
                                                        <div class="dropzone-wrapper col-sm-12 extra-image-dropzone-wrapper dropzone-single-product-image">
                                                            <div class="dropzone-desc">
                                                                <i class="glyphicon glyphicon-download-alt"></i>
                                                                <p>Choose multiple image file or drag it here.</p>
                                                            </div>

                                                            <input type="file" name="extra_images[]" class="dropzone project_images" id='fileupload' multiple><span style="color: red;">For better display please upload image of 611px*611px</span>
                                                        </div>
                                                        <div class="preview-zone <?php echo  $extra_images[$i] != '' ? '' : 'hidden'; ?> col-sm-4">
                                                        </div>
                                                       

                                                    </div>

                                                     <div class="form-group">  
                                                        <?php
                                                          $extra_images = json_decode($query_update['extra_images']);
                                                           for ($i = 0; $i < count($extra_images); $i++) { 
                                                        ?>                                   
                                                        <div class="pip remove_temp_image">
                                                            <input type="hidden" name="old_extra_images[]" value="<?php echo $extra_images[$i]; ?>" />
                                                            <img class="imageThumb" src="<?php echo base_url(); ?>uploads/artist/<?php echo $extra_images[$i]; ?>"><br>
                                                            <span class="btn blue remove">Remove</span>
                                                        </div>
                                                        <?php } ?>
                                                         <div class="new_work_sample_attach_temp_file_view"></div> 
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <!-- <button type="button" class="modal-btn" data-dismiss="modal">Cancel</button> -->
                                                        <input type="submit" class="modal-btn" value="Save" id="addWorksample" />
                                                        <!-- <button type="button" class="modal-btn">Save</button>-->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>








    <div class="clearfix"></div>

    <?php $this->load->view('common/footer'); ?>


</body>
<style>
    #image {
        display: none
    }

</style>
<?php $this->load->view('common/footer_js'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- mutiple extra_images preview s.p-30/01/2021 -->
<script type="text/javascript">
    // onchange save image to database
     new_work_sample_attach_temp_file_view();
    $(".project_images").change(function (e) {
       e.preventDefault();
      var formData = new FormData();
      var files = e.target.files;
      for (var i = 0; i < files.length; i++) {
        formData.append('form_file[]', files[i]);
      }
      formData.append('url_status',"<?php echo $this->uri->segment(1);?>");
      uploadFormData(formData);

    });

    function uploadFormData(form_data) {
      $.ajax({
        url: "<?php echo base_url("new_work_sample_attach_file_temp_save") ?>",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            // console.log(data);
         new_work_sample_attach_temp_file_view();
        }
      });
    }

    function new_work_sample_attach_temp_file_view() {

      $.ajax({
        url: "<?php echo base_url("new_work_sample_attach_temp_file_view") ?>",
        method: "POST",
        data:{url_status:"<?php echo $this->uri->segment(1);?>"},
        cache:false,
        success: function (data) {
          $('.new_work_sample_attach_temp_file_view').html(data);
            // console.log(data);
        }
      });
    }

    function remove_temp_image(id){
        $.ajax({
            url: "<?php echo base_url("new_work_sample_attach_temp_file_delete") ?>/"+id,
            method: "GET",
            success: function (data) {
                $('.remove_temp_image'+id).css('display','none');
            }
        });
    }

    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            /*
            $(".extra_images").on("change", function(e) {

                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" style=\"width:100px\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Remove</span>" +
                            "</span>").insertAfter(".extra-image-dropzone-wrapper");

                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
            */
        } else {
            alert("Your browser doesn't support to File API")
        }
    });

</script>

<script>
    $(".input").focus(function() {
        $("#search").addClass("move");
    });
    $(".input").focusout(function() {
        $("#search").removeClass("move");
        $(".input").val("");
    });

    $(".search").click(function() {
        $(".input").toggleClass("active");
        $("#search").toggleClass("active");
    });

</script>
<script>
    /*******************************
     * ACCORDION WITH TOGGLE ICONS
     *******************************/
    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

</script>

<script>
    $('.variable-width').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
    });

</script>
<script>
    $('#chooseFile').bind('change', function() {
        var filename = $("#chooseFile").val();
        if (/^\s*$/.test(filename)) {
            $(".file-upload").removeClass('active');
            $("#noFile").text("No file chosen...");
        } else {
            $(".file-upload").addClass('active');
            $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
        }
    });



    $('#addWorksample').on('click', function() {
        $(".error_msg").html('');
        /* if ($('#image').val() == '') {
             $('#image').next(".error_msg").html('Please Select image');
             $('#image').focus();
             return false;
         }*/
        if ($('#name').val() == '') {
            $('#name').next(".error_msg").html('Please enter name');
            $('#name').focus();
            return false;
        }


        if ($('#details').val() == '') {
            $('#details').next(".error_msg").html('Please enter details');
            $('#details').focus();
            return false;
        }

        if ($('#cost').val() == '') {
            $('#cost').next(".error_msg").html('Please enter Cost');
            $('#cost').focus();
            return false;
        }
        var currency = $("#currency option:selected").val();
        if (currency == '') {
            $('#currency').next(".error_msg").html('Please enter currency');
            $('#currency').focus();
            return false;
        }
        if ($('#description').val() == '') {
            $('#description').next(".error_msg").html('Please enter description');
            $('#description').focus();
            return false;
        }



    });

</script>
<script>
    // Code By Webdevtrick ( https://webdevtrick.com )
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var htmlPreview =
                    '<img src="' + e.target.result + '" />';
                var wrapperZone = $(input).parent();
                var previewZone = $(input).parent().parent().find('.preview-zone');
                var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                wrapperZone.removeClass('dragover');
                previewZone.removeClass('hidden');
                boxZone.empty();
                boxZone.append(htmlPreview);
            };
            // $('.dropzone-wrapper-preview').attr('style', 'width: 70% !important');
            // $('.preview-zone-preview').attr('style', 'width: 30% !important;float: right;');
            reader.readAsDataURL(input.files[0]);
        }
    }

    function reset(e) {
        e.wrap('<form>').closest('form').get(0).reset();
        e.unwrap();
    }

    $(".dropzone").change(function() {
        readFile(this);
    });

    $('.dropzone-wrapper').on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });

    $('.dropzone-wrapper').on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });

    $('.remove-preview').on('click', function() {
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        //alert(boxZone);
        var previewZone = $(this).parents('.preview-zone');
        var dropzone = $(this).parents('.form-group').find('.dropzone');
        boxZone.empty();
        previewZone.addClass('hidden');
        reset(dropzone);
    });

</script>
<script>
    $(document).on("click", ".remove", function() {
        $(this).parent().remove();
    });

</script>
<script>
    // Add restrictions
    Dropzone.options.fileupload = {
        acceptedFiles: 'image/*',
        maxFilesize: 1 // MB
    };

</script>



</html>
