<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/header'); ?>


</head>

<body>
    <?php $this->load->view('common/header_nav'); 
    
    
    
    ?>

    <div class="clearfix"></div>


    <section id="scheme-sliderarea">
        <div class="custom-width">
            <div class="shop-owner-ver02">


                <div class="col-sm-8">

                    <?php if ($query['banner_image'] != "") { ?>

                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $query['banner_image']; ?>" class="img-responsive" />
                    <?php
                } else { ?>
                    <img src="<?php echo base_url(); ?>assets/front/images/Blank-Store.jpg" class="img-responsive" />
                    <?php
						 }?>

                </div>


                <div class="col-sm-4">
                    <?php if ($query['portfolio_image'] != "") { ?>
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $query['portfolio_image']; ?>" class="img-responsive" />
                    <?php
                } else {?>
                    <img src="<?php echo base_url(); ?>assets/front/images/Blank-Profile.jpg" class="img-responsive" />
                    <?php
						 }?>

                </div>

            </div>
            <div class="slider-bottom-text">
                <?php  foreach ($users2->result() as $val){?>
                <?php if($val->product_types!=''){?>
                <h5>Specialist in <?php echo $val->product_types; ?></h5>
                <?php
            }} ?>
                <?php if ($users['virtual_studio'] != "") { ?>
                <h2><?php echo $users['virtual_studio']; ?> <img src="<?php echo base_url(); ?>assets/front/images/arrow-right.png" /></h2>
                <?php
            } ?>
            </div>
        </div>
        </div>
    </section>

    <div class="clearfix"></div>


    <?php
// S.Paul  25-01-2021
$prodcuct_ids = json_decode($query['featured_image']);
if (!empty($prodcuct_ids)){
?>
    <section id="scheme-sec2">
        <div class="custom-width">
            <div class="main-heading">
                <h1>Featured Products</h1>
            </div>

            <div class="slick-carousel">
                <?php

                if ($products->num_rows() > 0) {
                foreach ($products->result() as $row) {
                if (in_array($row->p_id, $prodcuct_ids)){

            ?>
                <div>
                    <div class="hovereffect">
                        <a href="<?php echo base_url();?>product_detail/<?php echo digi_encode($row->p_id); ?>">
                            <img class="img-responsive" src="<?php echo base_url(); ?>uploads/product/<?php echo $row->image; ?>" alt=""></a>
                        <div class="overlay buttons" data-toggle="modal" data-target="#exampleModal2" data-id="<?php echo $row->p_id; ?>">
                            <a href="#">
                                <h2>ADD TO CART</h2>
                            </a>
                        </div>
                    </div>
                    <h4><?php echo $row->name; ?></h4>
                    <p><?php echo $row->currency; ?><?php echo $row->sell_price; ?></p>
                </div>

                <?php
                }
                } 
                } else {
            ?>

                <div>
                    <div class="col-md-12 col-sm-12">
                        <div class="artist-list-inner">
                            <h4>No Product Found</h4>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php  } ?>


    <div class="clearfix"></div>
    <?php if ($query['background_image'] != "") { ?>
    <section id="shop-owner-offer-img">
        <div class="custom-width">
            <img src="<?php echo base_url(); ?>uploads/product/<?php echo $query['background_image']; ?>" class="img-responsive" />
        </div>
    </section>
    <?php
} ?>
    <div class="clearfix"></div>


    <section id="shop-owner-sec3">
        <div class="custom-width">
            <div class="shop-owner-sec3-inner-textarea">
                <?php if ($query['title'] != '') { ?>
                <h1><?php echo $query['title']; ?></h1>
                <?php
            } ?>
                <?php if ($query['text'] != '') { ?>
                <p><?php echo $query['text']; ?> </p>
                <?php
            } ?>
            </div>
            <?php
                $prodcuct_ids2 = json_decode($query['products']);
                if( $prodcuct_ids2!=''){
                         ?>
            <a href="<?php echo base_url(); ?>products/0/<?= digi_encode($user_id)?>">
                <button class="discover-more-btn">DISCOVER MORE <img src="<?php echo base_url(); ?>assets/front/images/arrow-right.png"></button>
            </a>
            <?php }
                 ?>
            <div class="similarproduct-area">


                <div class="row">
                    <?php
                $prodcuct_ids2 = json_decode($query['products']);
                foreach ($products->result() as $row) {
                    if (in_array($row->p_id, $prodcuct_ids2) ? "selected" : "") {
                        ?>

                    <div class="col-sm-4">

                        <div class="artist-list-inner">
                            <a href="<?php echo base_url();?>product_detail/<?php echo digi_encode($row->p_id); ?>"> <img src="<?php echo base_url(); ?>uploads/product/<?php echo $row->image; ?>" class="img-responsive"></a>
                            <h4> <a href="<?php echo base_url();?>product_detail/<?php echo digi_encode($row->p_id); ?>"><?php echo $row->name; ?></a></h4>
                            <span><?php echo $row->currency; ?><?php echo $row->sell_price; ?></span>
                        </div>

                    </div>
                    <?php }
                } ?>

                </div>
            </div>

    </section>


    <?php if ($banner['banner_image'] != '') { ?>
    <div class="clearfix"></div>
    <div class="custom-width">

        <section id="scheme-sec4" style="background-image: url(<?php echo base_url(); ?>uploads/cms/<?php echo $banner['banner_image']; ?>);">


            <div class="scheme-sec4-text raprd">
                <h1><?php echo $banner['banner_heading']; ?></h1>
                <h2><?php echo $banner['banner_content']; ?>
                </h2>
                <a href="<?php echo $banner['banner_url']; ?>">
                    <button class="free-consultation-brn"><?php echo $banner['banner_text']; ?> <img src="<?php echo base_url(); ?>assets/front/images/arrow-right2.png" /></button>
                </a>
            </div>


        </section>
    </div>
    <?php
} ?>
    <div class="clearfix"></div>


    <section id="wanttoworkwithus">
        <div class="custom-width">
            <h1><?php echo $query['message_heading']; ?></h1>
            <h6><?php echo $query['message_content']; ?></h6>
        </div>
    </section>



    <div class="clearfix"></div>
    <div class="modal fade productpopup" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="proDetailsBox">


                </div>
                <div class="modal-footer">


                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/footer_js'); ?>


    <!--Required js -->


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
        $(document).ready(function() {

        });

        $('.buttons').click(function() {
            var rowid = $(this).attr('data-id');
            //product-details-modal.php use div,css
            $('.model_loading').css("display", "block");
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('fetch_product_record'); ?>",
                data: 'id=' + rowid,

                success: function(data) {
                    $('.model_loading').css("display", "none");
                    $('#proDetailsBox').html(data);
                }
            });


            //$( '#exampleModal2' ).find( '.modal-body' ).html( id );
            //     $.ajax({
            //         type : 'post',
            //                url: "<?php echo base_url('fetch_product_record'); ?>",
            //                data: 'id='+ rowid,
            //           
            //            success : function(data){
            //            //Show fetched data from database
            //            var array=JSON.parse(data);
            //            //console.log(array.id);
            //            $('#product-name').html(array.name);
            //            $('.pname').attr('value',array.name);
            //            $('.p_id').attr('value',array.p_id);
            //           $('.price').attr('value',array.price);
            //           $('.image').attr('value',array.image);
            //           $('#product-img').attr('src','<?php echo base_url(); ?>uploads/product/'+array.image);
            //		   $('#product-price').html(array.price);
            //           $('#product-attribute').html(array.attribute);
            //           $('#product-id').html(array.p_id);
            //           $('#attribute').html(html);
            //            }
            //        });
        });

    </script>

</body>

</html>
