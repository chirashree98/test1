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
                    <h1>DESIGNER Dashboard</h1>
                </div>

                <div class="artist-accept-decline-inner">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="artist-left-panel">
                                <?php $this->load->view('artist/artist-left-panel'); ?>  
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="artist-right-panel">
                                <div class="">
                                    <div class="artist-dasbord-area">
                                        <div class="col-sm-3">
                                            <img src="<?php echo base_url(); ?>assets/front/images/artist-dashboard-user-img.jpg">
                                            <button class="change-picture">CHANGE PICTURE</button>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="artist-dasbord">
                                                <div class="artist-dasbord-item">
                                                    <h6>Name</h6>
                                                    <p>John Heanry</p>
                                                </div>

                                                <div class="artist-dasbord-item">
                                                    <h6>Description</h6>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>

                                                <div class="artist-dasbord-item">
                                                    <h6>About The Designer / Studio</h6>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>

                                                <div class="artist-dasbord-item">
                                                    <h6>About Me</h6>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="artist-dasbord-area">
                                        <h4>Services</h4>
                                        <div class="col-sm-3">

                                        </div>
                                        <div class="col-sm-9">
                                            <div class="artist-dasbord">

                                                <div class="artist-dasbord-item">
                                                    <h6>Services</h6>
                                                    <p>Design Consultation</p>
                                                </div>

                                                <div class="artist-dasbord-item">
                                                    <h6>Give a Description</h6>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </div>

                                                <div class="artist-dasbord-item">
                                                    <h6>Add A Fixed Cost</h6>
                                                    <p class="pwidth">$125</p>
                                                </div>



                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-btn-area">
                            <button class="save">Save</button>
                            <button class="save cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <div class="clearfix"></div> 

        <?php $this->load->view('common/footer'); ?>  


    </body>
    <?php $this->load->view('common/footer_js'); ?>  

</html>
