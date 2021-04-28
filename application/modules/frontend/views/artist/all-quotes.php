<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> 
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        <div class="clearfix"></div>



        <section id="artist-accept-decline">
            <div class="custom-width">
                <div class="artist-heading">
                    <h1>DESIGNERS Dashboard</h1>
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
                                  <h4>Received Quotes</h4>
                                   
                                    <span id="msg_box">
                                        <?php if ($this->session->flashdata('success') != '') { ?>
                                            <?php echo $this->session->flashdata('success'); ?>
                                        <?php } ?>
                                    </span>
                                  

                                    <div class="artist-list allquo">
                                        
                                                        <div class="artist-list-inner mb0">
                                                            <div class="design-sample-inner-item-img">
                                                                    
                                                             <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="sample_2">

                                                <thead>
                                       
                                            <tr>
                                                <th>SI No.</th>
                                              
                                                <th> Name </th>
                                               	<th> Email </th>
                                                <th> Phone </th>
												<th> Message </th>
												<th> Date </th>
                                               
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
                                                     <?php echo $row->email; ?>
                                                </td>
												<td>
                                                    <?php echo $row->phone; ?>
                                                </td>
												<td>
                                                    <?php echo $row->message; ?>
                                                </td>

												<td>
                                                    <?php echo date_time_format($row->date,$type=14);?>
                                                </td>

                                                
                                            </tr>
                                            <?php $i++;}}else{?>
                                            <tr>
                                                <td colspan="9" class="dataTables_empty">No record found.</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                     

                                  




                            
                 
                                                                    <div class="table-responsive">
															
                                   
                                            <table class="table table-striped table-bordered table-hover" id="sample_2">
                                                <thead>
                                  <h5>Received Quotes On Projects</h5>
                                            <tr>
                                                <th>SI No.</th>
                                              
                                                <th>Project Name </th>
                                                <th>Name </th>
                                               	<th> Email </th>
                                                <th> Phone </th>
												<th> Message </th>
												<th> Date </th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($query2->num_rows() > 0){$i=1; foreach ($query2->result() as $row){?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                              
                                                <td>
                                                    <?php echo $row->name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->ename; ?>
                                                </td>
                                                
                                                <td>
                                                     <?php echo $row->email; ?>
                                                </td>
												<td>
                                                    <?php echo $row->phone; ?>
                                                </td>
												<td>
                                                    <?php echo $row->message; ?>
                                                </td>
                                                <td>
                                                   <?php echo date_time_format($row->date,$type=14);?>
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
                
            
        </section>



        <!-- Modal -->
        <div class="modal fade artistmodel" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Work Sample</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url(); ?>addwork-sample" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">


                            <div class="form-group files">
                                <div class="file-upload">
                                    <div class="file-select" id="dragimg">
                                        <input type="file"  name="drag_image" id="chooseFile" class="form-control">

                                    </div>
                                </div>
                            </div>


                            <div class="form-group" id="imgdiv">
                                <label>Or Add Image</label>
                                <input type="file" class="form-control" name="imagefile" id="imagefile">
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
                                    <input type="text" class="form-control" name="name" id="name">
                                    <p class = "error_msg"><?php echo form_error('name'); ?> </p>
                                </div>

                                <div class="form-group">
                                    <label>Enter Description</label>
                                    <textarea type="text" class="form-control" name="description" id="description"></textarea>
                                    <p class = "error_msg"><?php echo form_error('description'); ?> </p>
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


                                <div class="form-group" id="imgdiv">
                                    <label>Or Add Image</label>
                                    <input type="file" class="form-control" name="imagefile" id="imagefile">
                                </div>
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
        $('.slick-carousel').slick({
            centerMode: true,
            arrows: false,
            dots: true,
            infinite: true,
            slidesToShow: 4,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        dots: true,
                        infinite: true,
                        centerMode: true,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        dots: true,
                        infinite: true,
                        centerMode: true,
                        slidesToShow: 1
                    }
                }
            ]
        });
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
            if ($('#description').val() == '') {
                $('#description').next(".error_msg").html('Please enter description');
                $('#description').focus();
                return false;
            }

        });


        function deleteFunction() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
                title: "Are you sure?",
                text: "Would you like to delete this ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            form.submit();          // submitting the form when user press yes
                        } else {
                            swal("Cancelled", "Your data is safe :)", "error");
                        }
                    });
        }


    </script>


</html>
