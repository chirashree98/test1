<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>
        <style>
            .artist-list-inner img {
                height: 290px;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>

        <?php //print_r($query_country);?>
        <section id="designer-sec1">

            <div class="custom-width">
                <span id="msg_box">
                    <?php if ($this->session->flashdata('success') != '') { ?>
                        <?php echo $this->session->flashdata('success'); ?>
                    <?php } ?>
                </span>

                <div class="wi50">
                    <?php
                    if ($service_query['profile_image'] != "") {
                        ?>
                        <img src="<?php echo base_url(); ?>uploads/artist/<?php echo $service_query['profile_image']; ?>"
                             class="img-responsive"/>
                         <?php } else {
                             ?>
                        <img src="<?php echo base_url(); ?>assets/front/images/Blank-Profile.jpg" class="img-responsive"/>
                        <?php }
                    ?>
                </div>
                <div class="wi50">
                    <div class="designer-sec1-text">
                        <h1><?php echo $query['virtual_studio']; ?></h1>
                        <h4><?php echo $query_country['country_name']; ?>
                            <br/>
                            <?php echo $query_country['state_name']; ?>
                            <br/>
                            <?php echo $query_country['accrediation_name']; ?></h4>

                        <button class="get-a-quote-brn" data-toggle="modal" data-target="#exampleModal">Get a Quote <img
                                src="<?php echo base_url(); ?>assets/front/images/arrow-right3.png"/></button>
                    </div>
                </div>
            </div>
        </section>




        <div class="clearfix"></div> 
        <?php if ($service_query['about_work'] != '') { ?>
            <section id="designer-sec2">
                <div class="custom-width">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="designer-sec2-left">
                                <h1>about the</h1>
                                <h2>studio/designer</h2>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="designer-sec2-right">

                                <?php echo $service_query['about_work']; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php }
        ?>
        <div class="clearfix"></div> </br>
        <div class="custom-width">
            <?php if ($banner['banner_image'] != '') { ?>
                <section id="scheme-sec4" style="background-image: url(<?php echo base_url(); ?>uploads/cms/<?php echo $banner['banner_image']; ?>);">


                    <div class="scheme-sec4-text">
                        <h1><?php echo $banner['banner_heading']; ?></h1>
                        <h2><?php echo $banner['banner_content']; ?>
                        </h2>
                        <a href="<?php echo $banner['banner_url']; ?>"><button class="free-consultation-brn"><?php echo $banner['banner_text']; ?> <img src="<?php echo base_url(); ?>assets/front/images/arrow-right2.png"/></button></a>
                    </div>


                </section>
            </div>
            <?php }
        ?>


        <div class="clearfix"></div>

        <section id="designer-sec3">
            <div class="custom-width">
                <h1>work samples</h1>

                <div class="designer-sec3-inner">


                    <?php
                    if ($query_worksample->num_rows() > 0) {
                        foreach ($query_worksample->result() as $row) {
                            ?>

                            <div class="col-sm-4">
                                <div class="buttons" data-toggle="modal" data-target="#exampleModal2"
                                     data-id="<?php echo $row->id; ?>">
                                    <div class="butFrame">
                                        <img src="<?php echo base_url(); ?>uploads/artist/<?php echo $row->image; ?>"/>
                                        <div class="butTextWrap">
                                            <p><?php echo $row->name; ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="artist-list-inner">
                                <h4>No Work Samples Found</h4>
                            </div>
                        </div>
                    <?php } ?>


                </div>


            </div>
        </section>

        <div class="clearfix"></div>

        <?php
        //print_r($service);
        //if ($service->num_rows() > 0) {
        if ($service) {
            ?>
            <section id="designer-sec4">
                <div class="custom-width">

                    <div class="col-sm-12">
                        <div class="designer-sec4-right">

                            <div class="demo rapanel">


                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">


                                    <?php $i == 0;
                                    foreach ($service as $servicerow) {
                                        ?>





                                        <div class="panel panel-default">
                                            <div class="panel-heading" data-toggle="collapse" role="tab" id="heading<?php
                                if ($i == 0) {
                                    echo 'One';
                                } elseif ($i == 1) {
                                    echo 'Two';
                                } else {
                                    echo 'Three';
                                }
                                        ?>">
                                                <h4 class="panel-title" data-toggle="tooltip" data-placement="top" title="Please click here to view this details of <?= strtolower($servicerow['type_name']) ?>">
                                                    <a role="button" data-toggle="collapse"  data-parent="#accordion" href="#collapse<?php
                                                    if ($i == 0) {
                                                        echo 'One';
                                                    } elseif ($i == 1) {
                                                        echo 'Two';
                                                    } else {
                                                        echo 'Three';
                                                    }
                                                    ?>" aria-expanded="true" aria-controls="collapse<?php
                                                       if ($i == 0) {
                                                           echo 'One';
                                                       } elseif ($i == 1) {
                                                           echo 'Two';
                                                       } else {
                                                           echo 'Three';
                                                       }
                                                       ?>" class="">

        <?php echo $servicerow['type_name']; ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse<?php
                                            if ($i == 0) {
                                                echo 'One';
                                            } elseif ($i == 1) {
                                                echo 'Two';
                                            } else {
                                                echo 'Three';
                                            }
                                            ?>" class="panel-collapse collapse <?php
                                                 if ($i == 0) {
                                                     echo 'in';
                                                 }
                                                 ?>" role="<?php
                                                 if ($i == 2) {
                                                     echo 'tabpanel';
                                                 } else {
                                                     echo 'tab';
                                                 }
                                                 ?>" aria-labelledby="heading<?php
                                                 if ($i == 0) {
                                                     echo 'One';
                                                 } elseif ($i == 1) {
                                                     echo 'Two';
                                                 } else {
                                                     echo 'Three';
                                                 }
                                                 ?>" aria-expanded="<?php
                                         if ($i == 0) {
                                             echo 'true';
                                         } else {
                                             echo 'false';
                                         }
                                                 ?>" style="">
                                                <div class="panel-body">
                                                    <p><?php echo $servicerow['description']; ?></p>
                                                    <?php
                                                    if (trim($servicerow['type_name']) == 'Design request') {
                                                        $url = base_url('design-request/' . $this->uri->segment(2));
                                                        $button_name = strtoupper($servicerow['type_name']);
                                                    } elseif (trim($servicerow['type_name']) == 'Design review') {
                                                        $url = base_url('design-review/' . $this->uri->segment(2));
                                                        $button_name = strtoupper($servicerow['type_name']);
                                                    } elseif (trim($servicerow['type_name']) == 'Design consultation') {
                                                        $url = base_url('design-consultation/' . $this->uri->segment(2));
                                                        $button_name = strtoupper($servicerow['type_name']);
                                                    } else {
                                                        $url = '#';
                                                        $button_name = 'DESIGN';
                                                    }
                                                    
                                                    ?>
                                                    <button class="consult-btn" onclick="location.href = '<?= $url; ?>'">
                                                    <?= $button_name; ?>
                                                        <img src="<?php echo base_url(); ?>assets/front/images/arrow-right3.png"/>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
        <?php
        //}
        $i++;
    }
}
?>
                                <!--<div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        
                                                design consultation
                                                </a>
                                        </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                                        <div class="panel-body">
                                                <p>Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> 
                            <button class="consult-btn">CONSULT FOR DESIGN REVIEW <img src="<?php echo base_url(); ?>assets/front/images/arrow-right3.png"/> </button>
                                        </div>
                                </div>
                        </div>
        
                        <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        
                                                        design request
                                                </a>
                                        </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                                        <div class="panel-body">
                                                <p>Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> 
                            <button class="consult-btn">CONSULT FOR DESIGN REVIEW <img src="<?php echo base_url(); ?>assets/front/images/arrow-right3.png"/> </button>
                                        </div>
                                </div>
                        </div-->

                            </div>


                        </div>


                    </div>
                </div>


            </div>
        </section>

        <div class="clearfix"></div>

        <section id="designer-sec5">
            <div class="custom-width">
                <h1>NEWS & EVENTS</h1>
                <div class="row">

                            <?php
                            //print_r($query_news);
                            if ($query_news) {
                                foreach ($query_news as $row) {
                                    ?>
                            <div class="col-sm-4">
                                <img src="<?php echo base_url(); ?>uploads/news/<?php echo $row['image']; ?>"
                                     class="img-responsive"/>
                                <h5> <?php
                            $data = explode("-", $row->created_date);
                            $data1 = explode(":", $data[2]);
                            //print_r($data1);
                            //echo $date=$data1[0]." ".$data[1]." ".$data[0];
                            //date('l jS F Y');
                            echo date("jS F Y", strtotime($row['created_date']));
                            ?></h5>
                                <h3><?php echo $row['name']; ?></h3>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="artist-list-inner">
                                <h4>No News & Events Found</h4>
                            </div>
                        </div>
        <?php } ?>

                </div>
            </div>
        </section>


        <div class="clearfix"></div>

        <!--+++++++++++++ footer Start +++++++++++++++++++-->
<?php $this->load->view('common/footer'); ?>
        <!-- Modal -->
        <div class="modal fade get-a-quote" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Get a Quote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url(); ?>add-getquote" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $this->uri->segment(2); ?>" name="designer_id"
                                   id="designer_id">
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <p class="error_msg"><?php echo form_error('name'); ?> </p>

                            </div>
                            <div class="form-group">
                                <label>Email Id *</label>
                                <input type="text" class="form-control" name="email" id="email">
                                <p class="error_msg"><?php echo form_error('email'); ?> </p>
                            </div>
                            <div class="form-group">
                                <label>Phone Number </label>
                                <input type="number" class="form-control" name="phone" id="phone"/>
                                <!-- <p class = "error_msg"><?php echo form_error('phone'); ?> </p>-->
								 <p class = "error_msg"><?php echo form_error('phone'); ?> </p>
                            </div>
                            <div class="form-group">
                                <label>Message *</label>
                                <textarea type="text" class="form-control" name="message" id="message"></textarea>
                                <p class="error_msg"><?php echo form_error('message'); ?> </p>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-btn" data-dismiss="modal">Close</button>
                        <input type="submit" class="modal-btn" value="Submit" id="addWorksample"/>
                        <!--<button type="button" class="modal-btn">Submit</button>-->
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade work-sample" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="a">
<?php //print_r($worksample_query); ?>
                        <h3><img src="<?php echo base_url(); ?>uploads/artist/<?php echo $image; ?>" id="artist-img"> work
                            sample <p id="artist-desc"></p>
                            <button type="button" class="modal-btn" data-dismiss="modal">Close</button>
                        </h3>

                    </div>
                    <div class="modal-footer">


                    </div>
                </div>
            </div>
        </div>

    </body>
<?php $this->load->view('common/footer_js'); ?>
    <script>

        $(document).ready(function () {

        });

        $('#exampleModal').on('hide.bs.modal', '#exampleModal', function (e) {
            //$('#exampleModal form')[0].reset();
            $(this).removeData('bs.modal');
        });

        $('.buttons').click(function () {
            var rowid = $(this).attr('data-id');

            //$( '#exampleModal2' ).find( '.modal-body' ).html( id );
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('fetch_worksample_record'); ?>",
                data: 'id=' + rowid,

                success: function (data) {
                    //Show fetched data from database
                    var array = JSON.parse(data);
                    console.log(array.id);
                    $('#artist-desc').html(array.description);
                    $('#artist-img').attr('src', '<?php echo base_url(); ?>uploads/artist/' + array.image);
                }
            });
        });

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
		 function isphone(phoneNum) {
       
        var phone= /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; 
        return phone.test(phoneNum );
      }

        $('#addWorksample').on('click', function () {
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
			if ($('#phone').val() == '') {
                $('#phone').next(".error_msg").html('Please enter phone no');
                $('#phone').focus();
                return false;
            }
            if (!isphone($('#phone').val())) {
                $('#phone').next(".error_msg").html('Please enter a valid phone no');
                $('#phone').focus();
                return false;

            }
            if ($('#message').val() == '') {
                $('#message').next(".error_msg").html('Please enter message');
                $('#message').focus();
                return false;
            }

        });
    </script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</html>