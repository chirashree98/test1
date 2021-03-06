<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/product-details/main.css">
</head>
<body>


<?php $this->load->view('common/header_nav'); ?>
<!--+++++++++++++ Header End +++++++++++++++++++-->
<div class="clearfix"></div>
<section id="product-details-page">
    <div class="custom-width">
        <div class="product-details-page-inner">
            <div class="row">
                <div class="col-sm-5">
                    <div class="product-details-img-area">


                        <div class="show" href="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>"
                             style="position: relative;">
                            <img src="<?php echo base_url(); ?>uploads/product/<?php echo $query['image']; ?>"
                                 id="show-img" style="width: 100%; height: 100%;">
                            <div style="position: absolute; left: 321.281px; top: 74px; background-color: rgb(0, 0, 0); width: 100px; height: 100px; opacity: 0.2; border: 1px solid rgb(204, 204, 204); cursor: crosshair; display: none;"></div>
                            <div style="position: absolute; overflow: hidden; left: 509px; top: 0px; width: 500px; height: 500px; display: none;">
                                <img src="<?php echo base_url(); ?>assets/front/images/product-details.jpg" id="big-img"
                                     style="position: absolute; left: -1606.41px; top: -370px; width: 2520px; height: 2030px;">
                            </div>
                        </div>


                        <div class="small-img">

                            <img src="<?php echo base_url(); ?>assets/front/images/online_icon_right@2x.png"
                                 class="icon-left" alt="" id="prev-img">
                            <div class="small-container">
                                <?php
                                $extra_images = json_decode($query['extra_images']);
                                ?>
                                <?php for ($i = 0; $i < count($extra_images); $i++) { ?>
                                    <div id="small-img-roll">

                                        <img src="<?php echo base_url(); ?>uploads/product/<?php echo $extra_images[$i]; ?>"
                                             class="show-small-img">


                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-sm-7">
                    <div class="product-details-right-text">
                        <h3><?php echo $query['name']; ?></h3>
                        <h5><?php echo $query['currency']; ?><?Php echo $query['price']; ?></h5>
                        <p><?Php echo $query['details']; ?></p>
                        <ul>
                            <li><?php echo $query['extra_desc']; ?></li>
                            <!--<li>Straight fit</li>
                            <li>Dry clean</li>-->
                        </ul>
                        <p class="sku"><span>SKU:</span><?php echo $query['sku']; ?></p>
                        <p class="sku"><span>Category:</span>

                            <?php foreach ($category->result() as $row) { ?>
                                <?php
                                if ($query['cat_id'] == $row->id) {

                                    ?><?php echo $row->name; ?>
                                <?php }
                            } ?>

                        <div class="form-group">


                            <?php

                            $pro_attribute = (array)json_decode($query['attribute']);
                            foreach ($parent_attribute->result() as $row) {
                                foreach ($child_attribute->result() as $c_row) {
                                    if ($row->id == $c_row->parent_id) {
                                        if (in_array($c_row->id, $pro_attribute)) {
                                            ?>

                                            <label><?php echo $row->attr_name; ?> </label>
                                            <select>
                                                <?php
                                                foreach ($child_attribute->result() as $c_row) { ?>

                                                    <?php
                                                    if ($row->id == $c_row->parent_id) {
                                                        if (in_array($c_row->id, $pro_attribute)) {
                                                            ?>


                                                            <option><?php echo "<br>" . $c_row->attr_name; ?></option>
                                                        <?php }
                                                    }
                                                } ?>
                                            </select>
                                            <?php
                                        }
                                    }
                                }
                            } ?>

                        </div>

                        <form action="<?php echo base_url(); ?>addcart" id="myFrm" method="post"
                              enctype="multipart/form-data">
                            <div class="qntatra">
                                <input type="hidden" name="id" value="<?php echo $query['p_id']; ?>">
                                <input type="hidden" name="name" value="<?php echo $query['name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $query['price']; ?>">
								 <input type="hidden" name="qty" value="<?php echo $query['qty']; ?>">
                                <label>Quantity:</label>

                                <div id="field1">
                                    <button type="button" id="sub" class="sub">-</button>

                                    <input type="number" id="1" name="qty" value="<?php echo $query['qty']; ?>">
                                    <button type="button" id="add" class="add" value="<?php echo $query['qty']; ?>">+
                                    </button>
                                    </br></br>
                                    <span id="response" style="color: red"></span>
                                </div>

                            </div>
                    </div>
                    <div class="addtocare-btn-area">

                        <button class="addtocare-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
                        </button>

                        </form>
                        <a href="javascript:void(0);" class="add-wishlist wishlist_functionality"
                           id="<?php echo $query['p_id']; ?>/<?php echo $user_id; ?>">
                            <?php if($wishlist_count->num_rows() > 0){ ?>
                                <div class="content_change content_change_<?php echo $query['p_id']; ?>">
                                    <i class="fa fa-heart" style="color: #ff474e;"></i>
                                </div>
                                <span class="text_change"><strong>Remove from wishlist</strong></span>
                            <?php }else{ ?>
                                <div class="content_change content_change_<?php echo $query['p_id']; ?>">
                                    <i class="fa fa-heart-o"></i>
                                </div>
                                <span class="text_change"><strong>Add to Wishlist</strong></span>
                            <?php } ?>
                        </a>
                        <?php /* ?>
                        <form action="<?php echo base_url(); ?>wishlists" id="myFrm" method="post"
                              enctype="multipart/form-data">
                            <input type="hidden" name="p_id" value="<?php echo $query['p_id']; ?>">
                            <input type="hidden" id="1" name="qty" value="<?php echo $query['qty']; ?>">
                            <button><img src="<?php echo base_url(); ?>assets/front/images/wishlist-icon.png">Add to
                                Wishlist
                            </button>
                        </form>
                        <?php */ ?>
                    </div>
                    <div class="stokin">
                        <h6>In stock.</h6>

                        <p><strong>Sold by:</strong><?php foreach ($user as $val) { ?>
                                <?php if ($val['virtual_studio']) { ?>
                                    <?php echo $val['virtual_studio']; ?>
                                    <?php
                                } else { ?>
                                    <?php echo $val['first_name'] . ' ' . $nal['last_name']; ?>
                                    <?php
                                }
                            } ?></p>
                    </div>


                </div>

            </div>
        </div>


        <div class="product-details-tabarea">
            <div class="tabbable-panel">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_default_1" data-toggle="tab">
                                DESCRIPTION</a>
                        </li>
                        <li>
                            <a href="#tab_default_2" data-toggle="tab">
                                eStore Details</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">

                            <p>
                                <?php echo $query['store_details']; ?>
                            </p>

                        </div>
                        <div class="tab-pane" id="tab_default_2">

                            <p>
                                <?php echo $query['store_details']; ?>
                            </p>


                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="similarproduct-area">
            <h5>Related Products</h5>
            <div class="row">
                <?php
                $prodcuct_ids = json_decode($query['related_product']);
                if (count($prodcuct_ids) > 0) {
                    foreach ($products->result() as $row) {
                        if (in_array($row->p_id, $prodcuct_ids) ? "selected" : "") {
                            ?>

                            <div class="col-md-3 col-sm-6">

                                <div class="artist-list-inner">
                                    <a href="<?php echo base_url(); ?>product_detail/<?php echo $row->p_id; ?>"><img
                                                src="<?php echo base_url(); ?>uploads/product/<?php echo $row->image; ?>"
                                                class="img-responsive"></a>
                                    <h4><?php echo $row->name; ?></h4>
                                    <span><?php echo $row->currency; ?><?php echo $row->sell_price; ?></span>
                                </div>

                            </div>
                            <?php
                        }
                    }
                } else {
                    ?>
                    No Related Product Found
                <?php } ?>

            </div>
        </div>

    </div>
    </div>


    </div>
    </div>
</section>
<div class="clearfix"></div>


<!--+++++++++++++ footer Start +++++++++++++++++++-->

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_js'); ?>

<script src="<?php echo base_url(); ?>assets/front/product-details/zoom-image.js"></script>
<script src="<?php echo base_url(); ?>assets/front/product-details/main.js"></script>
<script>
    var counter = 1;


    $('.add').click(function () {
        var id = $(this).val();
        //alert(counter);
        //alert(id);
        if (id == 1) {
            //alert(123);
            $("#response").html('product quantity not much increase than original quantity');
            $(".add").prop("disabled", true);
        }

        if ($(this).prev().val() < 100) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
        counter++;


        if (counter == id) {
            $("#response").html('product quantity not much increase than original quantity');
            $(".add").prop("disabled", true);
        }


    });
    $('.sub').click(function () {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1)
                $(this).next().val(+$(this).next().val() - 1);
            $("#response").html('');
            $(".add").prop("disabled", false);
        }
    });
</script>

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
</body>
</html>