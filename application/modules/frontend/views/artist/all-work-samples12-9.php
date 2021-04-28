<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        <div class="clearfix"></div>



        <section id="artist-accept-decline">
            <div class="custom-width">
                <div class="artist-heading">
                    <h1>Artist Dashboard</h1>
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
                                <button class="add-work-samplas-btn" data-toggle="modal" data-target="#exampleModal">ADD WORK SAMPLE</button>
                                <div class="design-requst-inner">

                                    <h4>Existing Work Samplas</h4>
                                    <div class="design-requst-inner-sub">
                                        <div class="artist-shortby samole-back">
                                            <p>There are 14 Work Samples</p>
                                            <span>Sort by : 
                                                <div class="dropdown">
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Date, new to old <img src="<?php echo base_url(); ?>assets/front/images/list-dropdown2.png"></button>
                                                    <ul class="dropdown-menu right7">
                                                        <li><a href="#">All</a></li>
                                                        <li><a href="#">Date, new to old</a></li>
                                                    </ul>
                                                </div>

                                            </span>
                                        </div>


                                    </div>

                                    <div class="artist-list design-sample-inner-item">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="artist-list-inner">
                                                    <div class="design-sample-inner-item-img">
                                                        <img src="<?php echo base_url(); ?>assets/front/images/artist-work-sample-img.jpg" class="img-responsive">
                                                        <span><div class="dropdown">
                                                                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Edit</a></li>
                                                                    <li><a href="#" class="bbnone">Delete</a></li>
                                                                </ul>
                                                            </div></span>
                                                    </div>

                                                    <h4>BIG SEETING SOFA</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="pagination">
                                            <span>There are 14 Work Samples</span>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> &nbsp; Previous</a></li>
                                                <li><a href="#">1</a></li>
                                                <li class="active"><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                                <li><a href="#"> Next &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
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
        <div class="modal fade artistmodel" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Work Sample</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">



                            <div class="form-group files">
                                <div class="file-upload">
                                    <div class="file-select">
                                        <input type="file" id="chooseFile" class="form-control" multiple>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Or Add Image</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="backwhite">    
                                <div class="form-group">
                                    <label>Image Name</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Enter Description</label>
                                    <textarea type="text" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-btn" data-dismiss="modal">Cancel</button>
                            <button type="button" class="modal-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="clearfix"></div> 

        <?php $this->load->view('common/footer'); ?>  


    </body>
    <?php $this->load->view('common/footer_js'); ?>  
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
        $('#chooseFile').bind('change', function () {
            var filename = $("#chooseFile").val();
            if (/^\s*$/.test(filename)) {
                $(".file-upload").removeClass('active');
                $("#noFile").text("No file chosen...");
            } else {
                $(".file-upload").addClass('active');
                $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
            }
        });

    </script>


</html>
