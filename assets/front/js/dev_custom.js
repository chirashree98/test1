$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {
        $("#chooseFile").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
//            $('.files').hide();
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();

                var file_ck = this.files[i];
                var fileType = file_ck["type"];
                var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

                fileReader.onload = (function (e) {
                    var file = e.target;

                    if ($.inArray(fileType, validImageTypes) > 0) {
                        $("<div class=\"pip col-md-2 temp_image\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" height='120' title=\"" + file.name + "\"/>" +
                            "<br/><a href='javascript:void(0);' class=\"remove\">Remove</a>" +
                            "</div>").insertAfter(".image_preview");

                    } else {
                        $("<div class=\"pip col-md-2 temp_image\">" +
                            "<img src='" + base_url + "assets/front/images/icons8-file-48.png' height='120'/>" +
                            "<br/><a href='javascript:void(0);' class=\"remove\">Remove</a>" +
                            "</div>").insertAfter(".image_preview");
                    }

                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                        if ($('.pip').length == 0) {
                            $('.files').show();
                        }
                    });

                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});


//$(document).on('click', '.form_submit', function (e) {
//    swal({
//        title: "Are you sure ?",
//        text: "Please recheck the form before submitting!",
//        type: "warning",
//        buttons: [
//            'No',
//            'Yes'
//        ],
//        reverseButtons: true,
//        confirmButtonColor: "#ff0000",
//        confirmButtonText: "Yes",
//        showCancelButton: true,
//        focusCancel: true,
//        cancelButtonColor: "#4caf50",
//        cancelButtonText: "No",
//    }).then(function(value) {
//        if (value) {
//            $(".swt_form").submit();
//        }
//    });
//});

$(document).on('click', '.onclick_show', function () {
    $(".cart_link").show();
});


//related product assign to vendor code end
$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function (e) {
            $('.files').hide();
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    var file = e.target;
                    $("<div class=\"pip col-md-2\">" +
                        "<img src='" + base_url + "assets/front/images/icons8-file-48.png' width='50' height='50'/>" +
                        "<br/><a href='javascript:void(0);' class=\"remove\">Remove</a>" +
                        "</div>").insertAfter(".image_preview");

                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                        if ($('.pip').length == 0) {
                            $('.files').val();
                            $('.files').show();
                        }
                    });

                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});






//Message code end