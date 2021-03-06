<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> 
</head>
<body>
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

<?php $this->load->view('common/header_nav'); ?>  

<!--+++++++++++++ Header End +++++++++++++++++++-->

<div class="clearfix"></div>



<section id="artist-accept-decline">
    <div class="custom-width">
        <div class="artist-heading">
            <h1>Designer Dashboard</h1>
        </div>

        <div class="artist-accept-decline-inner">
            <div class="row">
                <div class="col-sm-3">
                    <div class="artist-left-panel">
                        <?php $this->load->view('artist/artist-left-panel'); ?>  
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="artist-right-panel">

                        <div class="design-requst-inner">

                            <h4>Existing Work Samplas</h4>

                            <span id="msg_box">
                                <?php if ($this->session->flashdata('success') != '') { ?>
                                    <?php echo $this->session->flashdata('success'); ?>
                                <?php } ?>
                            </span>
                            <div class="design-requst-inner-sub">
                               <button class="add-work-samplas-btn" data-toggle="modal" data-target="#exampleModal">ADD WORK SAMPLE</button>
                               <div class="artist-shortby samole-back">


                                <p>There are <?php echo $total_rows; ?> Work Samples</p>
                                <span>Sort by : 
                                    <div class="dropdown">
                                          <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
										<?php
										  if (!empty($_SESSION)) {
                                    foreach ($_SESSION['search'] as $key => $val) {
                                        if ($key == 'order' && $val!='') { echo $val == 'desc' ? 'New to Old' : 'Old to New';}}}else{ echo "Old to New"; }?> <img src="<?php echo base_url();?>assets/front/images/list-dropdown.png"/></button>
                                        <ul class="dropdown-menu right7">
                                            <li><a href="<?php echo base_url(); ?>sorting_worksamples?order=asc">Old to New</a></li>
                                            <li><a href="<?php echo base_url(); ?>sorting_worksamples?order=desc">New to Old</a></li>

                                        </ul>
                                    </div>

                                </span>
                            </div>


                        </div>

                        <div class="artist-list design-sample-inner-item">
                            <div class="row">


                                <?php
                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        ?>


                                        <div class="col-sm-4">
                                            <div class="artist-list-inner">
                                                <div class="design-sample-inner-item-img">
                                                    <img src="<?php echo base_url(); ?>uploads/artist/<?php echo $row->image; ?>" class="img-responsive">
                                                    <span class="all-work-samples-action"><div class="dropdown">
                                                        <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                        <ul class="dropdown-menu">
                                                            <li> <li><a title="Edit" href="<?php echo base_url(); ?>edit-worksamples/<?php echo $row->id; ?>" class=" rounded-corner btn-share">Edit</a> </li>
                                                            <li><a title="delete"  href="#"
                                                    onClick="return ConfirmDelete(event,<?php echo $row->id ;?>);" >Delete</a></li>
                                                   
                                                   
                                                        </ul>
                                                    </div></span>
                                                </div>

                                                <h4><?php echo $row->name; ?></h4>
                                                <p><?php echo substr($row->description, 0, 30); ?></p>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="artist-list-inner">
                                            <h4>No Product Found</h4>
                                        </div>
                                    </div>
                                <?php } ?>


                            </div>
                            <div class="pagination">
                                <span>There are <?php echo $total_rows; ?> Work Samples</span>
                                <ul>
                                    <!-- s.p-28-01-2021 -->
                                    <span><?php if ($query->num_rows() > floatval($limit)) { ?>
                            <span>Showing <?=abs($page+1)?>-<?php echo floatval($page + $query->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } else { ?>
                                <span>Showing <?=$page?>-<?php echo floatval($page + $query->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } ?> </span>
                                    
                                    <ul>
                                        <?php echo $links; ?>
                                    </ul>
                                </div>
                            </div>







                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Modal -->
<div class="modal fade artistmodel all-work-sample-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Work Sample</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url(); ?>addwork-sample" method="POST" enctype="multipart/form-data">
                <div class="modal-body ">
                        <div class="form-group">
                            <div class="preview-zone col-sm-4 preview-zone-preview ">
                                <div class="box box-solid">
                                    <div class="box-body">
                                    </div>
                                </div>
                            </div>

                            <div class="dropzone-wrapper col-sm-8 dropzone-wrapper-preview">
                               <div class="dropzone-desc">
                                  <i class="glyphicon glyphicon-download-alt"></i>
                                  <label>Choose an image file or drag it here.</label>
                              </div>
                              <input type="file" required name="drag_image"  class="dropzone dropzone-image" 
                                     id='fileupload' >
									  &nbsp; <span style="color: red;">For better display please upload image of 1252px*1252px</span>
                            </div>

                           

                        </div>

                     <!-- 

                    <div class="form-group files">
                        <label>Profile Image</label><br>
                        <div class="file-upload">
                            <div class="file-select" id="dragimg">
                                <i class="glyphicon glyphicon-download-alt"></i>

                                <input type="file"  name="drag_image" id="chooseFile" 
                                class="form-control">

                            </div>
                        </div>
                    </div>


                    <div class="form-group" id="imgdiv">
                        <label>Or Add Image</label>
                        <input type="file" class="form-control" name="imagefile" id="imagefile">
                    </div>
                    -->
                            <!-- <div id="imgdiv">
                                 <div class="form-group" >
                                     <label>Or Add Image</label>
                                     <input type="file" class="form-control" name="image" id="image">
                                     <p class = "error_msg"><?php echo form_error('image'); ?> </p>
                                 </div></div>-->


                                 <div class="form-group">
                                    <label>Image Name</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                    <p class = "error_msg"><?php echo form_error('name'); ?> </p>
                                </div>
                                
                                <div class="form-group">
                                    <label>Enter Project Details</label>
                                    <textarea type="text" class="form-control" name="details" id="details"></textarea>
                                    <p class = "error_msg"><?php echo form_error('details'); ?> </p>
                                </div>

                                <div class="form-group" >

                                    <label>Currency</label>


                                    <select  id="currency" name="currency"  class="form-control" required> currency 	
                                        <option value="">Choose Currency</option>
                                        <?php foreach ($currency->result() as $row) { ?>


                                            <option value="<?php echo $row->currency_id; ?>"><?php echo $row->currency_name; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <p class = "error_msg"><?php echo form_error('currency'); ?> </p></div>
                                    <div class="form-group">
                                        <label>Project cost</label>
                                        <input type="number" min="0" class="form-control" name="cost" id="cost">
                                        <p class = "error_msg"><?php echo form_error('cost'); ?> </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Enter Description</label>
                                        <textarea type="text" class="form-control" name="description" id="description"></textarea>
                                        <p class = "error_msg"><?php echo form_error('description'); ?> </p>
                                    </div>

                                    <div class="form-group">
                                       <label>Multiple Project  Images </label>
                                       <div class="dropzone-wrapper col-sm-8 extra-image-dropzone-wrapper">
                                           <div class="dropzone-desc">
                                              <i class="glyphicon glyphicon-download-alt"></i>
                                              <p>Choose multiple image file or drag it here.</p>
                                          </div>
                                          <!--<input type="file"  required name="extra_images[]"  class="dropzone extra_images" id='fileupload'  multiple>-->
                                          <input type="file"  required name="project_images[]"  class="dropzone project_images"   multiple>
										   &nbsp; <span style="color: red;">For better display please upload image of 611px*611px</span>
                                      </div>
                                        <div class="new_work_sample_attach_temp_file_view"></div>
                                  </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="modal-btn" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="modal-btn" value="Save" id = "addWorksample" />
                                <!-- <button type="button" class="modal-btn">Save</button>-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if ($query_update) {
                ?>

                <div class="modal fade artistmodel" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Work Sample</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?php echo base_url(); ?>addwork-sample" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" value ="<?php echo $query_update['id']; ?>" />
                                <div class="modal-body">


                                    <div class="form-group files">
                                        <div class="file-upload">
                                            <div class="file-select" id="dragimg">
                                                <input type="file"  name="drag_image" id="chooseFile" class="form-control">

                                            </div>
                                        </div>
                                    </div>

                                    <!--
                                    <div class="form-group" id="imgdiv">
                                        <label>Or Add Image</label>
                                        <input type="file" class="form-control" name="imagefile" id="imagefile">
                                    </div>
                                    -->
                                    <div class="form-group" >
                                        <img src="<?php echo base_url(); ?>uploads/artist/<?php echo $query_update['image']; ?>" class="img-responsive">
                                    </div>
                                <!-- <div id="imgdiv">
                                     <div class="form-group" >
                                         <label>Or Add Image</label>
                                         <input type="file" class="form-control" name="image" id="image">
                                         <p class = "error_msg"><?php echo form_error('image'); ?> </p>
                                     </div></div>-->

                                     <div class="backwhite">    
                                        <div class="form-group">
                                            <label>Image Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $query_update['name']; ?>">
                                            <p class = "error_msg"><?php echo form_error('name'); ?> </p>
                                        </div>

                                        <div class="form-group">
                                            <label>Enter Description</label>
                                            <textarea type="text" class="form-control" name="description" id="description"><?php echo $query_update['description']; ?></textarea>
                                            <p class = "error_msg"><?php echo form_error('description'); ?> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <label>Product Extra Images </label>
                                       <div class="dropzone-wrapper col-sm-8 extra-image-dropzone-wrapper">
                                            <div class="extra_images_preview"></div>
                                           <div class="dropzone-desc ">
                                              <i class="glyphicon glyphicon-download-alt"></i>
                                              <p>Choose multiple image file or drag it here.</p>
                                          </div>
                                          <input type="file"  required name="extra_images[]"  class="extra_images dropzone" id='fileupload'  multiple>
                                      </div>
                                  </div>


                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="modal-btn" data-dismiss="modal">Cancel</button>
                <input type="submit" class="modal-btn" value="Save" id = "addWorksample" />
                <!-- <button type="button" class="modal-btn">Save</button>-->
            </div>
        </form>
    </div>
</div>
</div>

<?php
}
?>


<div class="clearfix"></div> 

<?php $this->load->view('common/footer'); ?>  


</body>

<?php $this->load->view('common/footer_js'); ?>  
<!-- mutiple extra_images preview s.p-27/01/2021 -->
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
            console.log(data);
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
            console.log(data);
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
            $(".extra_images").on("change", function(e) {

              var files = e.target.files,
                filesLength = files.length;
              for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                  var file = e.target;
                  $("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<br/><span class=\"remove\">Remove</span>" +
                    "</span>").insertAfter(".extra-image-dropzone-wrapper");
                    
                  $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                  });
                });
                fileReader.readAsDataURL(f);
              }
            });
            
          } else {
            alert("Your browser doesn't support to File API")
          }
        });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    $(".input").focus(function () {
        $("#search").addClass("move");
    });
    $(".input").focusout(function () {
        $("#search").removeClass("move");
        $(".input").val("");
    });

    $(".search").click(function () {
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
        /*  $('#chooseFile').bind('change', function () {
         var filename = $("#chooseFile").val();
         if (/^\s*$/.test(filename)) {
         $(".file-upload").removeClass('active');
         $("#noFile").text("No file chosen...");
         } else {
         $(".file-upload").addClass('active');
         $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
         }
     });*/
     $("#chooseFile").change(function (e) {
        if ($(this).val() != "") {
                //$("#imgdiv").hide();
                $('#imagefile').attr("disabled", "disabled");
            } else {
                $("#dragimg").show();
            }
        });

     $("#imagefile").change(function (e) {
        if ($(this).val() != "") {
                //$("#dragimg").hide();
                $('#chooseFile').attr("disabled", "disabled");

            } else {
                $("#imgdiv").show();
            }
        });
     $(".close").on('click', function () {
        $('#imagefile').attr("disabled", false);
        $('#chooseFile').attr("disabled", false);
    });

//$('#exampleModal').on('hidden.bs.modal', function () { 
   // $('#imagefile').attr("disabled", false);
 //$('#chooseFile').attr("disabled", false); });

 $(".modal-btn").on('click', function () {
    $('#imagefile').attr("disabled", false);
    $('#chooseFile').attr("disabled", false);
});



 $('#addWorksample').on('click', function () {
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

        if ($('#currency').val() == '') {
            	//alert(123);
                $('#currency').next(".error_msg").html('Please enter Currency');
                $('#currency').focus();
                return false;
            }
            if ($('#cost').val() == '') {
                $('#cost').next(".error_msg").html('Please enter Cost');
                $('#cost').focus();
                return false;
            }

            

            if ($('#description').val() == '') {
                $('#description').next(".error_msg").html('Please enter description');
                $('#description').focus();
                return false;
            }
    });


      // function deleteFunction() {
           // event.preventDefault(); // prevent form submit
            //var form = event.target.form; // storing the form
            //swal({
                //title: "Are you sure?",
                //text: "Would you like to delete this ?",
                //type: "warning",
                //showCancelButton: true,
                //confirmButtonColor: "#DD6B55",
               // confirmButtonText: "Yes",
                //cancelButtonText: "No, cancel please!",
                //closeOnConfirm: false,
               // closeOnCancel: false
            //},
            //function (isConfirm) {
                //if (isConfirm) {
                            //form.submit();          // submitting the form when user press yes
                        //} else {
                           // swal("Cancelled", "Your data is safe :)", "error");
                        //}
                    //});
        //}
		
$("#messagees").fadeOut(3000);
 function ConfirmDelete(e,id){
                e.preventDefault();
                swal({
                    // title: "Are you sure!",
                    text: "Are you sure to remove this item ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete)=>{
                    if(willDelete){
                      window.location = '<?php echo  base_url('delete-worksamples'); ?>/'+id ;
                    } 
                    else {
                        return false;
                    }
                });
            }



        // Code By Webdevtrick ( https://webdevtrick.com )
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var htmlPreview =
                    '<img src="' + e.target.result + '" />';
                    //'<p>' + input.files[0].name + '</p>'
                    var wrapperZone = $(input).parent();
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                    wrapperZone.removeClass('dragover');
                    previewZone.removeClass('hidden');
                    boxZone.empty();
                    boxZone.append(htmlPreview);
                };
                $('.dropzone-wrapper-preview').attr('style', 'width: 70% !important');
                $('.preview-zone-preview').attr('style', 'width: 30% !important;float: right;');
                reader.readAsDataURL(input.files[0]);
            }
        }

        function reset(e) {
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        $(".dropzone-image").change(function () {

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
<!-- 
<style type="text/css">
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style> -->