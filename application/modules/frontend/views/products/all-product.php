<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>   
        <style>
            .artist-list-inner img {
                height: 290px;
            }
        </style>
    </head> 
    <body>
        <?php $this->load->view('common/header_nav'); ?>  
        <!--+++++++++++++ Header End +++++++++++++++++++-->
        <div class="clearfix"></div> 
        <section id="artistlint-sec1">
            <div class="custom-width">
            <div class="innerpageproducts">
                <div class="row"> 
				
              
                    <div class="col-md-3 col-sm-4">
					
                        <div class="desktop-sec-hide">
							
                             <h1><?php echo $banner['title'];?></h1>
							
                            <p><?php echo $banner['description'];?></p>
							
							
                            <div class="artist-shortby">
                                <p>There are <?php echo $total_rows; ?><?php echo $banner->title;?></p>
                                <span>Sort by : 
                                    <div class="dropdown customright">
                                     
                                    </div>

                                </span>
                            </div>

                            <div class="artist-searcharea">
                                
                                <!--<button class="glass-products-btn">Glass Products <img src="<?php echo base_url(); ?>assets/front/images/cross.png"/></button>-->
                            </div>
                        </div>
                       

                    </div>
                    <div class="col-md-12 col-sm-8">
                        <div class="mobile-sec-hide">
                          
							
                            <div class="artist-shortby">
                                <p>There are <?php echo $total_rows; ?> products</p>
                                <span>
                                    <div class="dropdown customright">
                                     
                                     
                                    </div>

                                </span>
                            </div>
                            
                             <div class="artist-searcharea">
                                
                                <!--<button class="glass-products-btn">Glass Products <img src="<?php echo base_url(); ?>assets/front/images/cross.png"/></button>-->
                            </div>
                        </div>
                           
                        <div class="artist-list">
                            <div class="row">

<!--                                <pre>
                                <?php
                                // print_r($query->result());
                                ?>
                                </pre>-->
                                <?php
                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        $discount = floatval((($row->price - $row->sell_price) / $row->price) * 100);
                                        ?>
                                        <div class="col-md-4 col-sm-6">
                                        
                                            <div class="artist-list-inner">
                                            <a href="<?php echo base_url();?>product_detail/<?php echo digi_encode($row->p_id); ?>"><img src="<?php echo base_url(); ?>uploads/product/<?php echo $row->image; ?>" class="img-responsive"/></a>
                                                <?php if (floatval($discount) > floatval(0)) { ?><div class="sale">-<?php echo round($discount, 2); ?>%</div><?php } ?>
                                               
                                                
                                                <span><?php echo $row->currency; ?> <?php echo $row->sell_price; ?></span>
                                            </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="artist-list-inner">
                                            <h4>No Product Found</h4>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>


                        <div class="pagination">

<!--<span>Showing 1-10 item(s)</span>-->
                            <?php if ($query->num_rows() > floatval($limit)) { ?>
                            <span>Showing <?=abs($page+1)?>-<?php echo floatval($page + $query->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } else { ?>
                                <span>Showing <?=$page?>-<?php echo floatval($page + $query->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } ?>
                            <ul>
                                <?php echo $links; ?>
<!--                                <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> &nbsp; Previous</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li ><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"> Next &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>-->
                            </ul>
                        </div>

                    </div>
                    
                    </div>
                </div>
            </div>
        </section>

        <div class="clearfix"></div> 


        <?php if($banner['banner_image']!=''){?>
   <div class="clearfix"></div> 
  <div class="custom-width">
 
 </div>
    <?php
	}?>
        </div>

        <div class="clearfix"></div> 



        <!--+++++++++++++ footer Start +++++++++++++++++++-->
        <?php $this->load->view('common/footer'); ?>  
    </body>
    <?php $this->load->view('common/footer_js'); ?>  
    <script>

        $(document).ready(function () {
            $('#proSearch input').on('change', function () {
				
//		 $.ajax({
//                type: "POST",
//                url: "<?php echo base_url('frontend/product/productsSearchAjax'); ?>",
//                data: { data: $('#proSearch').serialize()},
//                async: false,
//                success: function (response) {
//
//                   
//				 }
//                
//            });

$("#proSearch").submit();

            });
        });



    </script>
</html>