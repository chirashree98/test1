$(function () {
    if ($(".jquery_ui_date_picker").length > 0) {
        $(".jquery_ui_date_picker").datepicker({
            dateFormat: 'yy-mm-dd',
        });
    }
});
$(function () {
    if ($("#data_table").length > 0) {
        $('#data_table').dataTable({
            "ordering": false
        });
    }
});

$('.admin_add_to_cart').click(function () {
    var product_id = $(this).attr('data-productId');
    var order_id = $(this).attr('data-orderID');
    
    if (product_id != '') {
        // alert(product_id+'  '+order_id);
        // return false;

        $.ajax({
            url: base_url + 'admin-add-to-cart-modal/' + product_id + '/' + order_id,
            type: 'GET',
            dataType: 'json',
            success: function (result) {

                if (result) {
                    // console.log(result);
                // return false;

                    $('.product_details_ajax').html(result);
                    $("#modal_add_to_cart").modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something wrong, please try again again',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Something wrong, please try again',
            showConfirmButton: false,
            timer: 3000
        })
    }
});

$(document).on('click', '.increment-quantity,.decrement-quantity', function () {
    var id = $(this).attr('data-id');
    var currentQty = $('#quantity_' + id).val();
    var qtyDirection = $(this).data("direction");
    var newQty = 0;

    if (qtyDirection == "1") {
        newQty = parseInt(currentQty) + 1;
    } else if (qtyDirection == "-1") {
        newQty = parseInt(currentQty) - 1;
    }

    // make decrement disabled at 1
    if (newQty == 1) {
        $(".decrement-quantity").attr("disabled", "disabled");
    }

    // remove disabled attribute on subtract
    if (newQty > 1) {
        $(".decrement-quantity").removeAttr("disabled");
    }

    if (newQty > 0) {
        newQty = newQty.toString();
        $('#quantity_' + id).val(newQty);
    } else {
        $('#quantity_' + id).val("1");
    }
    $.ajax({
        url: base_url + '/add-to-cart/' + id + '/' + newQty,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            if (result.status == true) {
                location.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Something wrong, please try again again',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        }
    });
});

$(document).on("click", '.delete_cart', function (e) {
    e.preventDefault(e);
    var url = $(this).attr('data-url');
    var cart_id = $(this).data('cart-id');
    if (url != '') {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (result) {
                if (result.status == true) {

                    $('.row_cart_delete_' + cart_id).remove();

                    if ($('.row_count').length == 0) {
                        $('#show_hide').hide();

                        $('.cart').html('');
                    }

                    setInterval(function () {
                        location.reload();
                    }, 1000);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something wrong, please try again again',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Something wrong, please try again',
            showConfirmButton: false,
            timer: 3000
        })
    }
});

$(document).ready(function () {
    $(document).on("click", '.add_to_cart', function (e) {
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: base_url + "admin-add-to-cart-modal/save",
            data: $('.add_to_cart_form').serialize(),
            success: function (value) {
                console.log(value);
                $("#modal_add_to_cart").modal('hide');

                $('.notifications').html(value);
                $('.notifications').animate({right: 0}, 1000);
                intrval = setInterval(function () {
                    $('.notifications').animate({right: -($('.notifications').width() + 30)}, 1000);
                    clearInterval(intrval);
                }, 5000);
            }
        })
    });
});

$(document).on("click", '.show_cart_link', function (e) {
    e.preventDefault(e);
    $('.show_hide').show();
});

function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copied: " + copyText.value;
}

$(document).ready(function () {
    $('.expected_delivery_date').change(function () {
        var transaction_id = $(this).data('transaction-id');
        var expected_delivery_date = $(this).val();
        if (expected_delivery_date) {
            $.ajax({
                type: "GET",
                url: base_url + '/admin-product-expected-delivery-date-change/' + transaction_id + '/' + expected_delivery_date,
                success: function (res) {
                    location.reload();
                }
            });
        }
    });
});

$(document).ready(function () {
    $('.product_order_activity').change(function () {
        var transaction_id = $(this).data('transaction-id');
        var product_order_activity = $(this).val();
        if (product_order_activity) {
            $.ajax({
                type: "GET",
                url: base_url + 'admin-product-order-activity-change/' + transaction_id + '/' + product_order_activity,
                success: function (res) {
                    location.reload();
                }
            });
        }
    });
});

$(function () {
    if ($('.ui_datepicker').length > 0) {
        $(".ui_datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "button",
            buttonImage: base_url + 'assets/front/images/calendar.png',
            buttonImageOnly: true,
        });
    }
});

$(document).on("click", '.show_pick_up', function (e) {
    var id = $(this).attr('data-id');
    var delivery_method = $(this).attr('data-delivery');
    if (id != '') {
        $.ajax({
            url: base_url + 'admin-show-pickup-address/' + id + '/' + delivery_method,
            type: 'GET',
            success: function (result) {
                $('.pickup_details_ajax').html(result);
                $('.delivery_method').html(delivery_method +' ADDRESS');
            }
        });
    }
});

$(document).on("click", '.delivery_service_id', function (e) {

    var store_id = $('#id').val();

    if($('.delivery_service_id').is(":checked")){
        $.ajax({
            url: base_url + 'admin/get-pickup-address-ajax/' + store_id,
            type: 'GET',
            success: function (result) {
                $('.pickup_address_ajax').html(result);
            }
        });
    }else{
        $('.pickup_address_ajax').html('');
    }
});

$(document).ready(function () {
    $("#show_hide").click(function () {
        if($('.show_hide').is(":hidden")){
            $(".show_hide").show();
        }else{
            $(".show_hide").hide();

        }
    });
});