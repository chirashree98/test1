<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
       
    </head>
    <body>
      <style type="text/css">
	  #default-datatable22s2{
		color:red
	  }

 </style>

<!-- Header Start-->

   
    
   <div class="clearfix"></div> 
   <?php $this->load->view('common/header_nav'); ?>
    
    
<div class="clearfix"></div> 
    <?php foreach($consultations->result() as $val){?>
	<?php if($val->title!=''){?>
   <section id="artistlint-sec1">
    <div class="custom-width">
        <div class="artist-heading">
		
        <h1><?php echo $val->title;?></h1>
		<?php
}?>
	<?php if($val->description!=''){?>
        <p class="mb0"><?php echo $val->description;?></p>
		<?php
   }}?>
            </div>
			
        <div class="artist-shortby">
        <p>There are <?php echo $total_rows; ?>Top DESIGNERS</p>
            <span> 
            <div class="dropdown">
			Sort By:
  <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                <?php
                                 if (!empty($_SESSION)) {
                                    foreach ($_SESSION['search'] as $key => $val) {
                                        if ($key == 'order' && $val!='') { echo $val == 'desc' ? 'Z to A' : ' A to Z';}}}else{ echo " Z TO A"; }?>
										
											<img src="<?php echo base_url();?>assets/front/images/list-dropdown.png"/></button> 
  <ul class="dropdown-menu">
  <li><a href="<?php echo base_url(); ?>artistserviceSorting?order=asc">A To Z</a></li>
<li><a href="<?php echo base_url(); ?>artistserviceSorting?order=desc">Z TO A</a></li>
  </ul>
</div>
            
            </span>
        </div>
		 <div class="artist-searcharea">
        <p>FIND Artist</p>
		
            <div class="form-group">
            <form>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Designers Name or Country "/>
                <button class="artist-search-btn"><img src="<?php echo base_url();?>assets/front/images/search.png"/></button>
                </form>           
            </div>
        </div>
     
       <div style="background-color:gray">
        <div  class="artist-list" id="default-datatable22s2">
        <div class="row is-table-row" id="default-datatable22s">
        <?php  foreach($query->result() as $val){?>
          <div class="col-md-4 col-sm-6" id="response">
      <div class="artist-list-inner shop-details-page raconsult" id="default-datatable22s2" >
      
          <?php if($val->profile_image!=""){?>
          
            <a href="<?php echo base_url();?>artist-details/<?php echo digi_encode($val->artist_id); ?>"> <img src="<?php echo base_url();?>uploads/artist/<?php echo $val->profile_image;?>" class="img-responsive"/></a>
            
          <?php
        }else{?>
           <a href="<?php echo base_url();?>artist-details/<?php echo digi_encode($val->artist_id); ?>"><img  src="<?php echo base_url(); ?>assets/front/images/profile-no.png" class="img-responsive"/></a>
          <?php
        }?>
                <h4> <a href="<?php echo base_url();?>artist-details/<?php echo digi_encode($val->artist_id); ?>"><?php echo $val->first_name;?><?php echo "&nbsp";?><?php echo $val->last_name;?></a></h4>
                <p><strong>Country: </strong> <?php echo  $val->country_name;?></p>
                    <p><strong>City:  </strong> <?php echo  $val->city;?></p>
                    <p><strong>Speciality:  </strong> 
					<?php if(($val->service_name == 'interior')||($val->service_name == 'painter')){?><?php echo $val->service_name; ?>
                                            <?php
                                        }?><?php if($val->service_name == 'others'){?><?php echo $val->others; ?><?php }?></p>
           <hr style="height:1px;border-width:0;color:gray;background-color:gray">
		     <?php foreach($query3->result() as $val2){
					if($val2->artist_id == $val->artist_id ){
						?>
					
			 <?php if($val2->cost!=''){?><p><strong>Design Consultation Price: </strong><?php echo  $val2->currency_name;?> <?php echo  $val2->cost;?><?php }?>
			   <?php }}?>
			   </p>


			    <hr style="height:1px;border-width:0;color:gray;background-color:gray"> 
				 <p><strong>Design Review: </strong> <?php  if($val->description!=''){echo substr($val->description,0,50);}else{echo 'N/A';}?></p>
				 <?php if($val->cost!=''){?><p><strong>Price Estimate: </strong> <?php echo  $val->currency_name;?> <?php echo  $val->cost;?></p>
				 <?php 
				}
				?>
				  <hr style="height:1px;border-width:0;color:gray;background-color:gray"> 
				 <?php   foreach($query2->result() as $val3){
					if($val3->artist_id == $val->artist_id){?>
				  <p><strong>Design Request: </strong> <?php if($val3->description!=''){ echo  substr($val3->description,0,50);}else{echo 'N/A';}?></p><?php }}?>
                    <a href="<?php echo base_url();?>artist-details/<?Php echo digi_encode( $val->artist_id);?>"><button class="view-shop-details-btn">View Details</button></a>
             
			  
                   
                   
            </div>
          
            
       
        
            </div>
     <?php }?>
     </div>
         </div>     
        
       
                
        
        
      
  <div class="pagination mb50">
       <?php if ($query->num_rows() > floatval($limit)) { ?>
                                                    <span>Showing 1-<?php echo $query->num_rows(); ?> of <?php echo $total_rows; ?> item(s)</span>
                                                <?php } else { ?>
                                                    <span>Showing 1-<?php echo $query->num_rows(); ?> of <?php echo $total_rows; ?> item(s)</span>
                                                <?php } ?>
                                                <ul>
                                                    <?php echo $links; ?>
                                                </ul>
                            </ul>
                        </div>
                        </div>
	                   <div class="clearfix"></div>
       </div>

                <div class="clearfix"></div> 
                </section>
                
    
     
    
       <?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_js'); ?>
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$("#name").keyup(function(){
      //alert(123);
				if($("#name").val().length>0) {
					var name =$("#name").val();
					//alert(name);
					$.ajax({
						url:"<?php echo base_url()?>artistserviceearch",
						method:"post",
						 data:'name='+$("#name").val(),
						 success:function(response){
						//alert('234');
						 	//$("#default-datatable22s").show();
               $('#default-datatable22s').html(response);
						 	
						 	//$("#delete").hide();
						 	},
						 	error:function(){
						 		alert("Error Request");
						 	}
					});
				}
				if($("#name").val().length == 0) {
					//alert(123);
          $("#response").show();
          //alert(123);
					$.ajax({
						url:"<?php echo base_url()?>artistserviceearch",
						method:"post",
						 data:'name='+$("#name").val(),
						success:function(response){
						//$('#default-datatable22s').hide();
						$('#default-datatable22s').html(response);
						 
						 	},
						 	error:function(){
						 		alert("Error Request");
						 	}
					});
				}
			return false;
		});
		
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

</body>
</html>
