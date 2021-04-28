<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++-->

        <div class="clearfix"></div>


<div id="messagees" class="col-md-6" >
                                                <?php if ($this->session->flashdata('error') != '') { ?>
                                                    <?php echo $this->session->flashdata('error'); ?>
                                                <?php } ?>
                                            </div>

        <section id="my-account">
            <div class="custom-width">
                <div class="page-heading">
                    <h1>Wish List</h1>
                </div>

                <div class="my-account-inner">
                    <div class="col-md-3">
                            <div class="artist-left-panel">
                               <?php $this->load->view('common/myaccount_side_panel'); ?> 
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="my-account-left-panel">
                                <div class="my-account-left-panel-sec1">
                                    <h4>Wish List</h4>
                                    <div class="my-account-left-panel-sec1-inner wishlisttable">
                                        
                                        <?php if(count($query) > 0){ ?>
                                            <p>Your Wish List</p>
                                          
                                         <?php }else{ ?>
                                              <p style="text-align:center;">Your Wishlist Is Empty</p>
                                         <?php } ?>

                                        <div class="wishlist-area">
										  <div id="msg_div">
    <?php if ($this->session->flashdata('success') !=''){?>
     <?php echo $this->session->flashdata('success'); ?>
       <?php }elseif(isset($flash2) && $flash2=='wrong') {?>
            <div class="alert alert-danger">
                <a href="#"  data-dismiss="alert" ></a>
  <strong>Warning!</strong> Product already exist in wishlist ..
</div>
        <?php 
		}
	   
		?>
        <?php if ($this->session->flashdata('successes') !=''){?>
     <?php echo $this->session->flashdata('successes'); ?>
       <?php }?>
       </div>
	       
            <?php if(count($query) > 0){ ?>
                                            <div class="cart wishlistpage">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Image</th>
                                                                <th>Product</th>
                                                                <th>SKU</th>
                                                                <th>Unit Price</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
														
									
									
														<?php  foreach($query as $val){?>
                                                        <tbody>
													
													 <form action="<?php echo base_url(); ?>add-cart" id="myFrm" method="post" enctype="multipart/form-data" >
														
                                                            <tr>
                                                                <input type ="hidden" name="qty" value="1">
                                                            <input type ="hidden" name="stock" value="<?php echo $val['qty'];?>">
                                                                <?php 
                                                            $attributes_data = '';
                                                            foreach(json_decode($val['slct_attribute']) as $_val){
                                                                $attributes_data .= $_val.',';
                                                            }
                                                            $attributes_data = substr($attributes_data,0,-1);
                                                            
                                                            ?>
                                                             <input type ="hidden" name="slct_attributes"  
                                                        value="<?php echo $attributes_data;?>">

																<input type ="hidden" name="p_id" value="<?php echo $val['p_id'];?>">
                                                                <input type ="hidden" name="price" value="<?php echo $val['price'];?>">
                                                                <td><a  href="<?php echo base_url();?>product_detail/<?php echo   digi_encode($val['p_id']); ?>"><input type ="hidden" name="image" value="<?php echo $val['image'];?>"><img class="wishlistimg" src="<?php echo base_url(); ?>uploads/product/<?php echo $val['image'];?>"></a></td>
                                                                <td><a  style="color:black" href="<?php echo base_url();?>product_detail/<?php echo digi_encode($val['p_id']); ?>"><input type ="hidden" name="name" value="<?php echo $val['name'];?>"><?php echo $val['name'];?></a>

                                                                <?php 
                                                                foreach (json_decode($val['slct_attribute']) as $key=> $attr_val) {?>
                                                                    
                                                                <?php    
                                                                   $attr_items = getProductChildAttrName($val['p_id'],$attr_val);
                                                                   if(count(json_decode($val['slct_attribute'])) == $key+1){
                                                                        echo $attr_items[0]->child_attr_name;
                                                                    }else{
                                                                         echo '<br>'.$attr_items[0]->child_attr_name.', ';
                                                                    }
                                                                }
                                                                ?>

                                                                </td>
                                                                <td><input type ="hidden" name="sku" value="<?php echo $val['sku'];?>"><?php echo $val['sku'];?></td>
                                                                <td><input type ="hidden" name="sell_price" value="<?php echo $val['sell_price'];?>">
																<?php echo $val['currency'];?> <?php echo $val['sell_price'];?>
																 <input type ="hidden" name="attributes" value="<?php echo $val['attributes'];?>"><?php echo $val['attributes'];?></td>
																<input type ="hidden" name="attrpro" value=""> 
																   
																
                                                                <td>
                                                                    <button class="add-to-cart">Add to Cart</button>
																		</form>
                                                    <a title="delete"  href="#"
                                                    onClick="return ConfirmDelete(event,<?php echo $val['p_id'];?>);" >
                                                    <button class="add-to-cart wishlist-delete-btn">Delete</button>
                                                    </a>
                                                            </tr>
                                                           

                                                        </tbody>
													
														
                                                        <?php } ?>  
                                                    </table>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                           
        </section>




        <div class="clearfix"></div> 

        <?php $this->load->view('common/footer'); ?>  


    </body>
    <?php $this->load->view('common/footer_js'); ?>  
	<script>
$("#messagees").fadeOut(3000);
 function ConfirmDelete(e,id){
                e.preventDefault();
                swal({
                    // title: "Are you sure!",
                    text: "Are you sure to remove this item ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete)=>{
                    if(willDelete){
                      window.location = '<?php echo  base_url('delete_wishlist'); ?>/'+id ;
                    } 
                    else {
                        return false;
                    }
                });
            }
</script>

</html>
