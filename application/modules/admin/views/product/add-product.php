<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <?php $this->load->view('common/header_include'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" />  
            <style type="text/css">
.select2-container--default .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: #888 transparent transparent transparent;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}
  

.select2-container--open .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: transparent transparent #888 transparent;
    border-width: 0 4px 5px 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}
  </style>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <div class="page-wrapper">
            <?php $this->load->view('common/header'); ?>
            <div class="clearfix"> </div>
            <div class="page-container">
                <?php $this->load->view('common/sidebar'); ?>
                <div class="page-content-wrapper">
                    <div class="page-content">

                        <div class="row">
                            <div class="col-md-12">
                                <div id="msg_div"> 
                                    <?php if ($this->session->flashdata('success') != '') { ?>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    <?php } ?>
                                </div>
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="icon-settings font-red"></i> <span class="caption-subject font-red sbold uppercase"> Add Product</span> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <form action="<?php echo base_url(); ?>admin/product_management/save_product" id="myFrm" method="post" class="horizontal-form" enctype="multipart/form-data">
                                            <div class="form-body">


                                               
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Product Name</label>
                                                            <input type="text" required name="name" id="p_name" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Product Price</label>
                                                            <input type="number" min="0.0" step="0.01" required name="price" id="price" class="form-control" placeholder="">
                                                        </div>
                                                    </div>-->
                                                    <div class="col-md-6">                                                        
                                                        <div class="form-group">
                                                            <label class="control-label">Product Sell Price</label>
                                                            <input type="number" min="0.0" step="0.01" value=""  required="" name="sell_price" id="sell_price" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label class="control-label">SKU</label>
                                                            <input type="text" required name="sku" id="sku" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label class="control-label">Quantity</label>
                                                            <input type="number" min="0" required name="qty" id="qty" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Description</label>
                                                            <textarea required name="details" id="details" class="form-control"></textarea>
                                                        </div>
														<div class="form-group">
                                                            <label class="control-label">Long Description </label>
                                                            <textarea required name="long_description" id="long_description" class="form-control" placeholder=""></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Extra Description [ Please Use comma (,) separator ]</label>
                                                            <input type="text" required name="extra_desc" id="extra_desc" class="form-control" placeholder="">
                                                        </div>
														
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label>E-Store</label>
                                                    <textarea type="text"  required class="form-control" name="store_details"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Product Category</label>
                                                            <select class="form-control" required="" onchange="getCat();" id="cat_id" name="cat_id">
                                                                <option value="">Select Category</option>
                                                                <?php foreach ($category->result() as $row) { ?>
                                                                    <option value="<?php echo $row->id ?>"><?php echo $row->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Product Sub Category</label>
                                                            <select class="form-control"  id="sub_cat_id" name="sub_cat_id">
                                                                <option value="0">Select Sub Category </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Related Products </label>
                                                            <select id="products"  class="form-control"  multiple="multiple" name="related_product[]">

                                                                <?php foreach ($products->result() as $row) { ?>
                                                                    <option value="<?php echo $row->p_id ?>"><?php echo $row->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Product Is Featured:</label>
                                                            <?php echo form_checkbox(array('name' => 'is_featured', 'value' => 'Y', 'checked' => '')); ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Is this cancellation product?</label>
                                                            <?php echo form_checkbox(array('name' => 'is_cancellation', 'value' => 'Y', 'checked' => '')); ?>

                                                        </div>
                                                    </div>
                                                </div>
												
                                                 
                                         
												  <div class="row">
                                                    <div class="col-md-6">
												 
														
                                              
                                                        <div class="form-group">
                                                            <label class="control-label">Product Main Image</label>
														
                                                            <input type="file"  name="image"  id="image" class="form-control uploal_project_img" placeholder="">
                                                            <span style="color: red;">For better display please upload image of 600px*600px</span>
																 
                                                        </div>
														
                                                    </div>
													<div class="col-md-6">
                                                        <div class="form-group">
														<img class="view_project_images" title="Project Images" alt="Project Images" 
														style="width:100px;display: none;"/>
                                                           
                                                        </div>
                                                    </div>
													
                                                    <?php
                                                    $extra_images = json_decode($query['extra_images']);
                                                    ?>
													<div class="col-md-12"> </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
														
                                                            <label class="control-label">Product Extra Images</label>
                                                            <input type="file"  name="extra_images[]" multiple id="file-input" class="form-control" placeholder="">
															  <span style="color: red;">For better display please upload image of 600px*600px</span>
																 
                                                        </div>
                                                    </div>
													

                                                    <div class="col-md-6">
                                                <div class="form-group">
                                                                
																<div id="preview"  style="width:200px"></div>
                                                                
                                                            </div>
                                                    </div>
                                                </div>
													

                                         
												 

                                                  
                                                
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Product Attribute</label>
                                                            <br>
                                                            <?php
                                                            foreach ($parent_attribute->result() as $row) {
                                                                ?>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $row->attr_name; ?></label>
                                                                    </div>

                                                                    <div class="form-group addproductcheckitem">
                                                                        <?php
                                                                        foreach ($child_attribute->result() as $c_row) {
                                                                            if ($row->id == $c_row->parent_id) {
                                                                                ?>
                                                                                <div>
                                                                                    <span><?php echo $c_row->attr_name; ?></span>                                                                            <div class="addproductcheck">
                                                                                        <input type="checkbox" value="<?php echo $c_row->id; ?>" name="attribute[]" class="">
                                                                                    </div>
                                                                                </div>
                                                                            <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>

                                                                </div>
<?php } ?>


                                                        </div>
                                                    </div>
                                                </div>
                                                <!--
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group">
                                                                                                            <label class="control-label">Product Attribute</label>
                                                                                                            <br>
                                                <?php
                                                foreach ($attribute->result() as $row) {
                                                    ?>
                                                                                                                            <div class="col-md-4">
                                                                                                                                <div class="form-group">
                                                                                                                                    <label class="control-label"><?php echo $row->attr_name; ?></label>
                                                                                                                                </div>
                                                            
                                                                                                                                <div class="form-group addproductcheckitem">
                                                    <?php
                                                    $attr_value = json_decode($row->attr_value);
                                                    foreach ($attr_value as $val) {
                                                        ?>
                                                                                                                                                    <div>
                                                        <?php
                                                        echo '<span>' . $val . '</span>';
                                                        ?>
                                                                                                                                                        <div class="addproductcheck">
                                                                                                                                                            <input type="checkbox" value="<?php echo $val; ?>"  name="attribute[<?php echo $row->attr_name; ?>][]" class="" >
                                                                                                                                                        </div>
                                                                                                                                                    </div>
    <?php } ?>
                                                                                                                                </div>
                                                            
                                                                                                                            </div>
<?php } ?>
                                                
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>-->

                                            </div>
                                            <div class="form-actions right"><button id="frmSubmit" type="submit" class="btn blue"> <i class="fa fa-check"></i> Add Product </button> </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        <?php $this->load->view('common/footer'); ?>
        </div>
        <?php // $this->load->view('common/quick_nav'); ?>
<?php $this->load->view('common/js_include'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.min.js"></script>
<script>
 
 $("#products").select2({
 placeholder: "------ Related Products ------ ",
  
  tags: true
 });
 
   $("#products").on("select2:select", function (evt) {
     var element = evt.params.data.element;
     var $element = $(element);
     
     window.setTimeout(function () {  
   if ($("#products").find(":selected").length > 1) {
     var $second = $("#products").find(":selected").eq(-2);
     
     $element.detach();
     $second.after($element);
   } else {
     $element.detach();
     $("#products").prepend($element);
   }
   
   $("#products").trigger("change");
   }, 1);
 });
 </script>
 <script>
	 $(document).on("click", ".remove", function () {
     $(this).parent().remove();
     });


    function readURL(input) {
      if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.view_project_images').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
        $(".view_project_images").css("display", "block");
      }
    }

    $(".uploal_project_img").change(function() {
      readURL(this);
    });

   </script>
   <script>
   function previewImages() {

  var $preview = $('#preview').empty();
  if (this.files) $.each(this.files, readAndPreview);

  function readAndPreview(i, file) {
    
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
      return alert(file.name +" is not an image");
    } // else...
    
    var reader = new FileReader();

    $(reader).on("load", function() {
      $preview.append($("<img/>", {src:this.result, height:100,}));
    });

    reader.readAsDataURL(file);
    
  }

}

$('#file-input').on("change", previewImages);
</script>
        <script>
            function getCat() {
                $.post('<?php echo base_url(); ?>admin/product_management/get_sub_category', 'c_id=' + $('#cat_id').val(), function (data) {
                    $('#sub_cat_id').html(data);
                });
            }

        </script>
    </body>

</html>