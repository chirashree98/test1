<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
       
    </head>
    <body>
        
 

<!-- Header Start-->

    
   
    
   <div class="clearfix"></div> 
   <?php $this->load->view('common/header_nav'); ?>
    
    
<div class="clearfix"></div> 
    
   <section id="artistlint-sec1">
    <div class="custom-width">
        <div class="artist-heading">
		<?php if($banner['title']!=''){?>
        <h1><?php echo $banner['title'];?></h1>
        <p class="mb0"><?php echo $banner['description'];?></p>
		<?php
		}?>
            </div>
        <div class="artist-shortby">
        <p>There are <?php echo $total_rows; ?>
		<?php if($banner['title']!=''){?><?php echo $banner['title'];?>
		<?php
   }?></p>
            <span>
            <div class="dropdown">
			Sort By:
  <button class="dropdown-toggle" type="button" data-toggle="dropdown"><?php 
                                
                                if (!empty($_SESSION)) {
                                    foreach ($_SESSION['search'] as $key => $val) {
                                        if ($key == 'order' && $val!='') { echo $val == 'desc' ? 'New to Old' : 'Old to New';}}}else{ echo "Old to New"; }?> <img src="<?php echo base_url();?>assets/front/images/list-dropdown.png"/></button>
  <ul class="dropdown-menu">
  <li><a href="<?php echo base_url(); ?>projectsamplesSorting?order=asc">Old to New</a></li>
<li><a href="<?php echo base_url(); ?>projectsamplesSorting?order=desc">New to Old</a></li>
  </ul>
</div>
            
            </span>
        </div>
     
        
        <div class="artist-list project-page">
        <div class="row">
        <?php foreach($query->result() as $val){?>
            <div class="col-md-3 col-sm-6">
            <?php if($val->image!="")
                                        {
                                            ?>
                <div class="artist-list-inner">
                <a href="<?php echo base_url();?>worksampledetails/<?php echo digi_encode($val->id); ?>"> <img src="<?php echo base_url();?>uploads/artist/<?php echo $val->image;?>" class="img-responsive"/></a>
                <?php
              }else{?>
               <a href="<?php echo base_url();?>worksampledetails/<?php echo digi_encode($val->id); ?>"><img  src="<?php echo base_url(); ?>assets/front/images/Blank-Project.jpg" class="img-responsive"/></a></div>
                                            <?php
                                        }?>
                <h4> <a href="<?php echo base_url();?>worksampledetails/<?php echo digi_encode($val->id); ?>"><?php echo $val->name;?></a></h4>
                <span><?php echo substr($val->description, 0, 80);?></span>
</div>
           
            
       
        
           </div>
    <?php }?>
   
                </div>
            
        
        
                <div class="pagination">
                                            <span>There are <?php echo $total_rows;  ?> Projetcs</span>
                                            <ul>

                                                 <?php if ($query->num_rows() > floatval($limit)) { ?>
                            <span>Showing <?=abs($page+1)?>-<?php echo floatval($page + $query->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } else { ?>
                                <span>Showing <?=$page?>-<?php echo floatval($page + $query->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } ?>
                                                <ul>
                                                    <?php echo $links; ?>
                                                </ul>
                                        </div>
                                    </div>
        
        
        
       
    
      
  <div class="clearfix"></div> </br>
  <div class="">
  <?php if($banner['banner_image']!=''){?>
        <section id="scheme-sec4" style="background-image: url(<?php echo base_url(); ?>uploads/cms/<?php echo $banner['banner_image']; ?>);">
          

                <div class="scheme-sec4-text raprd">
                    <h1><?php echo $banner['banner_heading']; ?></h1>
                    <h2><?php echo $banner['banner_content']; ?>
                    </h2>
                    <a href="<?php echo $banner['banner_url']; ?>"><button class="free-consultation-brn"><?php echo $banner['banner_text']; ?> <img src="<?php echo base_url(); ?>assets/front/images/arrow-right2.png"/></button></a>
                </div>
				
           
        </section>
 </div>
    <?php
	}?>
          
   
    
        
       </div>
    </section>
    
     <div class="clearfix"></div> 
    
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

</body>
</html>