<script>
    var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery-1.11.3.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/bootstrap-dropdown-on-hover.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/bootsnav.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/slick.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="<?php echo base_url(); ?>assets/front/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/dev_custom.js"></script>




<script>
    getCartCount();
    function addToCart(id) {
        $.post('<?php echo base_url(); ?>frontend/product/addcart', $('#addCartFrom_' + id).serialize(), function (data) {
            $('#exampleModal2').modal('hide');
            getCartCount();
            $('.notifications').html(data);
            $('.notifications').animate({right: 0}, 1000);
            intrval = setInterval(function () {
                $('.notifications').animate({right: -($('.notifications').width() + 30)}, 1000);
                clearInterval(intrval);
            }, 5000);
        });
    }
    function updateCart(key_id,id,attr) {  
        var qty = $('#quantity_' + key_id).val();
        $.post('<?php echo base_url(); ?>frontend/product/updateCart', {'p_id': id, 'qty': qty, 'attr': attr}, function (data) {
//           console.log(data);
            //getCartSection();
            $('.notifications').html('Your cart update successful');

            $('.notifications').animate({right: 0}, 1000);
            intrval = setInterval(function () {
                $('.notifications').animate({right: -($('.notifications').width() + 30)}, 1000);
                clearInterval(intrval);
            }, 5000);
            location.reload();
        });
    }
    function deleteCart(id, attr) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>frontend/product/deleteCart",
            data: {'p_id': id, 'attr': attr},
            async: false,
            success: function (data) {
                // console.log(data)
                if(data === 'update'){
                    $('.notifications').html('Your cart update successful');
                    $('.notifications').animate({right: 0}, 1000);
                    intrval = setInterval(function () {
                        $('.notifications').animate({right: -($('.notifications').width() + 30)}, 1000);
                        clearInterval(intrval);
                    }, 5000);
                    location.reload();
                }
            }
        });
    }

    function getCartSection() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('frontend/product/getCartSection'); ?>",
            data: {},
            async: false,
            success: function (response) {
                $('#my-cart').html(response);
            }

        });
    }
    function getCartCount() {
        $.post('<?php echo base_url(); ?>frontend/product/getCartCount', function (data) {
            $('.cart-btn a').html('CART(' + data + ')');
        });
    }

    
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
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    dots: true,
                    infinite: true,
                    slidesToShow: 1
                }
            }
        ]
    });
</script>


