<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body>
<?php $this->load->view('common/header_nav'); ?>

<!--Body content start-->
<section id="artist-accept-decline">
    <div class="custom-width">
        <div class="artist-heading">
            <h1><?= $query['design_type'] ?></h1>
        </div>

        <div class="artist-accept-decline-inner">
            <form action="<?php echo base_url('design-consultation-action'); ?>" method="post" class="swt_form"
                  enctype="multipart/form-data">
                <input type="hidden" name="artist_id" value="<?php echo $artist_id; ?>">
                <input type="hidden" name="amount" value="<?php echo !empty($query['cost']) ? $query['cost'] : 0; ?>">
				 <input type="hidden" name="currency" value="<?php echo !empty($query['currency_name']) ? $query['currency_name'] : 0; ?>">
                <input type="hidden" name="design_type_id" value="<?= $query['design_type_id'] ?>">
                <input type="hidden" name="design_type_name" value="<?= $query['design_type'] ?>">
                <input type="hidden" name="design_code" value="">
                <div class="artist-right-panel">

                    <div class="artist-dasbord-area">
                        <span id="msg_box">
                                    <?php if ($this->session->flashdata('error') != '') { ?>
                                        <?php echo $this->session->flashdata('error'); ?>
                                    <?php } ?>
                                </span>
                        <span id="msg_box">
                                    <?php if ($this->session->flashdata('success') != '') { ?>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    <?php } ?>
                                </span>
                        <div class="col-sm-3">
                            <?php if (!empty($query['profile_image'])) { ?>
                                <img src="<?php echo base_url('uploads/artist/' . $query['profile_image']); ?>"/>
                            <?php } else { ?>
                                <img src="<?php echo base_url('assets/front/images/profile-no.png'); ?>"/>
                            <?php } ?>

                        </div>
                        <div class="col-sm-9">
                            <div class="artist-dasbord pb0">
                                <div class="artist-dasbord-item designrequest">
                                    <h5><?php echo $query['first_name'] . ' ' . $query['last_name']; ?></h5>
                                    <?php if (!empty($query['cost'])||(!empty($query['currency_name']))) { ?>
                                        <h5>Cost -<?php echo $query['currency_name']; ?> <?php echo $query['cost']; ?>/-</h5>
                                    <?php } elseif($query['design_type_id'] == 1) { ?>
                                        <h5>Ask for the fees ? <span class="i-design">i <div class="i-design-contant">Price is not fix, please sent request we will process a quotation.</div></span></h5>
                                    <?php }else{ ?>
                                        <h5>No cost define.</h5>
                                    <?php } ?>
                                </div>

                                <div class="artist-dasbord-item designaconsultation">
                                   
                                     <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                 <label>Attach all related documents</label><br>
                                                <div class="dropzone-wrapper designer_review_dropzone">
                                                    <div class="dropzone-desc">
                                                        <i class="glyphicon glyphicon-download-alt"></i>
                                                        <p>Drag & drop or browse files to upload</p>
                                                    </div>
                                                    <input type="file" name="profile_image" class="dropzone attach_file">
                                                          
                                                </div>
                                                <span>Accepted file formats .jpg, .jpeg, .png, .doc, .docx, .pdf, .xls, .xlsx</span>
                                            </div>
                                             
                                        </div>
                                       
                                    </div>
                                    <!--
                                    <div class="form-group files">
                                        <div class="file-upload">
                                            <div class="file-select">
                                                <input type="file" name="form_file[]" id="chooseFile" class="form-control" multiple=""> 
                                                 <input type="file" id="" class="form-control attach_file" multiple="">
                                            </div>
                                        </div>
                                         <span>Accepted file formats .jpg, .jpeg, .png, .doc, .docx, .pdf, .xls, .xlsx</span>
                                    </div>
                                    -->
                                    <div class="row">
                                        <div class="image_preview"></div>
                                        <div class="design_request_attach_temp_file_view"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea type="text" name="message" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-btn-area">
                        <?php if (!empty($query['cost'])) { ?>
                    <button class="save form_submit" >
                            Pay & Continue
                        <?php } elseif($query['design_type_id'] == 1) { ?>
                        <button class="save form_submit">
                            Submit your Request
                        <?php }else{ ?>
                            <button class="save form_submit" disabled >
                            Cost Not defined
                        <?php } ?>
                    </button>
                </div>
            </form>
            <?php if(!empty($query['cost'])){ ?>
                <span id="msg_box_valid_code"></span>
                <!--
            <span id="msg_box">
                <?php if ($this->session->flashdata('coupon_error') != '') { ?>
                    <?php echo $this->session->flashdata('coupon_error'); ?>
                <?php } ?>
            </span>
            <span id="msg_box">
                <?php if ($this->session->flashdata('coupon_success') != '') { ?>
                    <?php echo $this->session->flashdata('coupon_success'); ?>
                <?php } ?>
            </span>
        -->
            <!-- <form action="" method="post"> -->
                <div class="row code-sec">
                    <div class="col-md-5">
                        <input type="text" name="design_code" value="" class="form-control design_code" placeholder="Have a store code ?" required>
                        <button class="save form_submit" type="button" onclick="design_code_check()">Apply Code</button>
                    </div>
                </div>
                    
            <!-- </form> -->
            <?php } ?>
        </div>
    </div>

</section>
<!--Body content end-->

<?php
$this->load->view('common/footer');
$this->load->view('common/footer_js');
?>
</body>
</html>


<script type="text/javascript">
    function design_code_check() {
        var design_code  = $(".design_code").val();
        $.ajax({
            url: "<?php echo base_url("check_design_code_are_valid") ?>",
            method: "POST",
            data:{design_code:design_code},
            success: function (response) {
                // console.log(response);
                data = jQuery.parseJSON(response);
                $("input[name=design_code]").val(data.design_code); 
                $("#msg_box_valid_code").html(data.message);
            }
        });
        
    }

    design_request_attach_temp_file_view();

    $(".attach_file").change(function (e) {
       e.preventDefault();
      var formData = new FormData();
      var files = e.target.files;
      for (var i = 0; i < files.length; i++) {
        formData.append('form_file[]', files[i]);
      }
      formData.append('url_status',"<?php echo $this->uri->segment(1);?>");
      uploadFormData(formData);

    });

    function uploadFormData(form_data) {
      $.ajax({
        url: "<?php echo base_url("design_request_attach_file_temp_save") ?>",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            design_request_attach_temp_file_view();
        }
      });
    }

    function design_request_attach_temp_file_view() {
      $.ajax({
        url: "<?php echo base_url("design_request_attach_temp_file_view") ?>",
        method: "POST",
        data:{url_status:"<?php echo $this->uri->segment(1);?>"},
        cache:false,
        success: function (data) {
          $('.design_request_attach_temp_file_view').html(data);
            console.log(data);
        }
      });
    }
    function remove_temp_image(id){
        $.ajax({
            url: "<?php echo base_url("design_request_attach_temp_file_delete") ?>/"+id,
            method: "GET",
            success: function (data) {
                $('.remove_temp_image'+id).css('display','none');
            }
        });
    }

</script>

