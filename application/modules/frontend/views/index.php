<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); 
//    $this->output->disable_cache();
    ?>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>

<!--+++++++++++++ Header End +++++++++++++++++++-->
<div class="clearfix"></div>
<span id="msg_box">
    <?php if ($this->session->flashdata('error') != '') { ?>
        <?php echo $this->session->flashdata('error'); ?>
    <?php } ?>
</span>
<section id="scheme-sliderarea">
    <div class="custom-width">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php if ($query['banner_image_1'] != 'NULL') { ?>
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <?php } ?>
                <?php if ($query['banner_image_2'] != 'NULL') { ?>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                <?php } ?>
                <?php if ($query['banner_image_3'] != 'NULL') { ?>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                <?php } ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php if ($query['banner_image_1'] != 'NULL') { ?>
                    <div class="item active">
                        <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $query['banner_image_1']; ?>" alt="">
                    </div>
                <?php } ?>
                <?php if ($query['banner_image_2'] != 'NULL') { ?>

                    <div class="item">
                        <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $query['banner_image_2']; ?>" alt="">
                    </div>
                <?php } ?>
                <?php if ($query['banner_image_3'] != 'NULL') { ?>
                    <div class="item">
                        <img src="<?php echo base_url(); ?>uploads/cms/<?php echo $query['banner_image_3']; ?>" alt="">
                    </div>
                <?php } ?>

            </div>


        </div>

        <div class="slider-bottom-text">
            <h5><?php echo $query['banner_text_1']; ?></h5>
            <h2><?php echo $query['banner_text_2']; ?> <img
                        src="<?php echo base_url(); ?>assets/front/images/arrow-right.png"/></h2>
        </div>

    </div>
</section>

<div class="clearfix"></div>

<section id="scheme-sec1">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-6">
                <div class="scheme-sec1-inner">
                    <h1><?php echo $query['our_story_headind']; ?></h1>
                    <span><?php echo $query['our_story_sub_headind']; ?></span>
                    <p><?php echo $query['our_story_content']; ?></p>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="scheme-sec1-inner">

                    <div class="demo">


                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                           href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                                            <?php echo $query['our_story_service_heading_1']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                     aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <?php echo $query['our_story_service_content_1']; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                                           aria-controls="collapseTwo">

                                            <?php echo $query['our_story_service_heading_2']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <?php echo $query['our_story_service_content_2']; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                           aria-controls="collapseThree">

                                            <?php echo $query['our_story_service_heading_3']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <?php echo $query['our_story_service_content_3']; ?>
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
<section id="scheme-sec2">
    <div class="custom-width">
        <div class="main-heading">
            <h1>SELECTION</h1>
            <span>Products Collection</span>
        </div>


        <div class="slick-carousel">
            <?php
                if ($product_query->num_rows() > 0) {
                foreach ($product_query->result() as $row) {
                $discount = floatval((($row->price - $row->sell_price) / $row->price) * 100);
            ?>
             <div>
                <div class="hovereffect">
                   <a  href="<?php echo base_url();?>product_detail/<?php echo digi_encode($row->p_id); ?>">
                    <img class="img-responsive"
                         src="<?php echo base_url(); ?>uploads/product/<?php echo $row->image; ?>" alt=""></a>
                    <div class="overlay buttons" data-toggle="modal" data-target="#exampleModal2"
                         data-id="<?php echo $row->p_id; ?>">
                        <a href="javascript:void(0);"><h2>ADD TO CART</h2></a>
                    </div>
                </div>
                <h4><?php echo $row->name; ?></h4>
                <p><?php echo $row->currency; ?><?php echo $row->sell_price; ?></p>
            </div>

            <?php
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

<div class="clearfix"></div>
<?php if(variable_array_check($artist_list)){ ?>
<section id="scheme-sec3">
    <div class="custom-width">
        <div class="main-heading textcolor-dark">
            <h1>Designer</h1>
            <span>Top Rated Designers</span>
        </div>

        <div class="variable-width">
            <?php foreach ($artist_list AS $value){ ?>
            <div>
                <ul>
                    <li class="wi30"><a href="<?= base_url('artist-details/'.digi_encode($value['artist_id'])) ?>"><img src="<?php echo base_url('uploads/artist/'.$value['profile_image']); ?>"/></a>
                            <a href="<?= base_url('artist-details/'.digi_encode($value['artist_id'])) ?>"><h4><?= $value['first_name'].' '.$value['last_name'] ?></h4></a>
                        <p><?= $value['artist_text'] ?> - From <?= $value['country_name'] ?></p>
                    </li>
                    <li class="wi70"><img src="<?= base_url('uploads/cms/'.$value['banner']) ?>"/>
                        <a href="<?= base_url('artist-details/'.digi_encode($value['artist_id'])) ?>" class="visite-artist-page-btn">VISIT DESIGNERS  PAGE <img src="<?php echo base_url(); ?>assets/front/images/arrow-right.png"/></a>
                    </li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
<div class="clearfix"></div>
<div class="custom-width">
    <section id="scheme-sec4"
             style="background-image: url(<?php echo base_url(); ?>uploads/cms/<?php echo $query['ad_banner_image']; ?>);">


        <div class="scheme-sec4-text">
            <h1><?php echo $query['ad_banner_heading']; ?></h1>
            <h2><?php echo $query['ad_banner_content']; ?>
            </h2>
            <a href="<?php echo $query['ad_banner_btn_url']; ?>">
                <button class="free-consultation-brn"><?php echo $query['ad_banner_btn_text']; ?> <img
                            src="<?php echo base_url(); ?>assets/front/images/arrow-right2.png"/></button>
            </a>
        </div>

    </section>
</div>
<div class="clearfix"></div>

<section id="scheme-sec5">
    <div class="custom-width">
        <div class="custom-wi30">
            <div class="scheme-sec5-inner">
                <h1><?php echo $query['client_section_heading']; ?></h1>
                <span><?php echo $query['client_section_sub_heading']; ?></span>
                <p><?php echo $query['client_section_content']; ?></p>
                <a href="<?php echo $query['client_section_btn_url']; ?>">
                    <button class="visite-artist-page-btn"><?php echo $query['client_section_btn_text']; ?> <img
                                src="<?php echo base_url(); ?>assets/front/images/arrow-right.png"/></button>
                </a>
            </div>
        </div>
        <div class="custom-wi70">
            <div class="scheme-sec5-inner2">
                <ul>
                    <?php
                    $client_name = json_decode($query['client_name']);
                    $client_image_url = json_decode($query['client_image_url']);
                    $client_image = json_decode($query['client_image']);
                    for ($i = 0; $i < count($client_name); $i++) {
                        if ($client_image[$i] != '' && $client_name[$i] != '') {
                            ?>
                            <li><a href="<?php echo $client_image_url[$i]; ?>"><img
                                            src="<?php echo base_url(); ?>uploads/cms/<?php echo $client_image[$i]; ?>"/>
                                    <p><?php echo $client_name[$i]; ?></p></a></li>
                        <?php }
                    } ?>
                </ul>
            </div>
        </div>

    </div>
</section>

<div class="clearfix"></div>

<section id="wanttoworkwithus">
    <div class="custom-width">
        <h1><?php echo $query['message_heading']; ?></h1>
        <h6><?php echo $query['message_content']; ?></h6>
    </div>
</section>

<div class="clearfix"></div>

<!-- Modal -->
<!--<div class="modal fade work-sample" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="">
       <form class="" action="<?php echo base_url('cart'); ?>" method="post" enctype="multipart/form-data">
          <h3> <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image; ?>" id="product-img" class="img-responsive"> 
          <p id="product-name"><?php echo $name; ?></p><br>
           <span id="product-price"><?php echo $price; ?></span><br>
           <span id="product-attribute">
           <?php
$obj = json_decode($attribute);
// print_r($attribute); ?>
           </span><br>
            <div id="attribute"></div>

      <input type="hidden" name="id" value="" class="p_id">
      <input type="hidden" name="name" value="" class="pname">
      <input type="hidden" name="price" value="" class="price">
      <input type="hidden" name="image" value="" class="image">
                   		<?php
//echo form_hidden('id', $p_id);
//echo form_hidden('name', $name);
// echo form_hidden('price', $price);
//echo form_hidden('image', $image);
?>
                        <input class="modal-btn" name="action" type="submit" value="Add to Cart" />
               	</form>
            <button type="button" class="modal-btn" data-dismiss="modal">Close</button></h3>
          
      </div>
      <div class="modal-footer">
       
      
      </div>
    </div>
  </div>
</div> -->


<div class="modal fade productpopup" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
     aria-hidden="true">
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
<!--+++++++++++++ footer Start +++++++++++++++++++-->

<?php $this->load->view('common/footer'); ?>


</body>
<?php $this->load->view('common/footer_js'); ?>
<script>

    $(document).ready(function () {
        
    });

    $('.buttons').click(function () {
        var rowid = $(this).attr('data-id');
        //product-details-modal.php use css,div
         $('.model_loading').css("display", "block");

        $.ajax({
            type: 'post',
            url: "<?php echo base_url('fetch_product_record'); ?>",
            data: 'id=' + rowid,

            success: function (data) {
                $('.model_loading').css("display", "none");
                $('#proDetailsBox').html(data);
            }
        });


        //$( '#exampleModal2' ).find( '.modal-body' ).html( id );
//     $.ajax({
//         type : 'post',
//                url: "<?php //echo base_url('fetch_product_record'); ?>",
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
//           $('#product-img').attr('src','<?php //echo base_url(); ?>uploads/product/'+array.image);
//		   $('#product-price').html(array.price);
//           $('#product-attribute').html(array.attribute);
//           $('#product-id').html(array.p_id);
//           $('#attribute').html(html);
//            }
//        });
    });
</script>
</html>
