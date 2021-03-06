<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>  
       
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?> 
    
  
    
  
    
  
    

    
   <section id="artistlint-sec1">
    <div class="custom-width">
    <span id="msg_box">
                                        <?php if ($this->session->flashdata('success') != '') { ?>
                                            <?php echo $this->session->flashdata('success'); ?>
                                        <?php } ?>
                                    </span>
        <div class="artist-heading">
		<?php foreach($query as $val){?>
		<?php if($val['details']!=''){?>
        <h1>project DETAILS</h1>
        

        <p class="mb0"><?php echo $val['details'];?></p>
		<?php
   }?>
      </div>
     
     
        <div class="project-details-page">
		<?php if($val['image']!=''){?>
        <img src="<?php echo base_url();?>uploads/artist/<?php echo $val['image'];?>"/>
		 <?php
		}else{?>
			  <img  src="<?php echo base_url(); ?>assets/front/images/Blank-Project-ver02.jpg" class="img-responsive"/></div>
                                            <?php
                                        }?>
		<?php if($val['name']!=''){?>
         <h4>Project Name: <?php echo $val['name'];?></h4>
		 <?php
		}?>
		 <?php if($val['description']!=''){?>
         <p><strong>DESCRIPTION:</strong></p>
		
            <span><?php echo  $val['description'];?></span>
			<?php
		}?>
			<?php if($val['first_name']!=''){?>
            <p><strong>Artist Name:</strong><?php echo $val['first_name'];?><?php
		}?><?php if($val['last_name']!=''){?><?php echo $val['last_name'];?></p>
		<?php
		}?>
			<?php if(($val['cost']!='')&&($val['currency_name']!='')){?>
            <p><strong>Project Cost:</strong><?php if($val['currency_name']!=''){?><?php echo $val['currency_name'];?> <?php echo $val['cost'];?><?php
			}?></p>
			<?php
			}?>
			
         <button class="view-shop-details-btn" data-toggle="modal" data-target="#exampleModal">GET A QUOTE</button>
      <?php }?>
            
            <?php
            $extra_images = json_decode($val['extra_images']);
                                //print_r( $extra_images);
                                 ?>
								 <?php if( $extra_images!=''){?>
								 <h4>PROJECT PICTURES</h4>
								 
                      
            <div class="row">
           
            <?php for ($i = 0; $i < count($extra_images); $i++) { ?>            
                                
                <div class="col-sm-6">
            <img src="<?php echo base_url(); ?>uploads/artist/<?php echo $extra_images[$i]; ?>"/>
            
                        </div> 
                        <?php }}?>
            </div>
        </div>
      
        
    </section>
    
     <div class="clearfix"></div> 
       <?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_js'); ?>
     
    
  
<!-- Modal -->
    <div class="modal fade get-a-quote" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Get a Quote</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="<?php echo base_url(); ?>add-getquotes" method="POST" enctype="multipart/form-data">
         <input type="hidden" value="<?php echo $this->uri->segment(2);?>" name="id" id="id">
		 <?php  foreach($query as $val){?>
	
          <input type="hidden" value="<?php echo  $val['user_id'];?>" name="designer_id" id="designer_id">
           
          <div class="form-group">
		  <?php
		  }?>
            <label>Name *</label>
             <input type="text" class="form-control" name="name" id="name">
              <p class = "error_msg"><?php echo form_error('name'); ?> </p>
           
            </div>
            <div class="form-group">
            <label>Email Id *</label>
              <input type="text" class="form-control" name="email" id="email">
                 <p class = "error_msg"><?php echo form_error('email'); ?> </p>
            </div>
            <div class="form-group">
            <label>Phone Number </label>
              <input type="number" class="form-control" name="phone" id="phone"/>
             <p class = "error_msg"><?php echo form_error('phone'); ?> </p>
            </div>
            <div class="form-group">
            <label>Message *</label>
              <textarea type="text" class="form-control" name="message" id="message"></textarea>
               <p class = "error_msg"><?php echo form_error('message'); ?> </p>
            </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="modal-btn" data-dismiss="modal">Close</button>
        <input type="submit" class="modal-btn" value="Submit" id = "addWorksample" />
        <!--<button type="button" class="modal-btn">Submit</button>-->
      </div>
       </form>
    </div>
  </div>
</div>   
    
<script>
function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        function isphone(phoneNum) {
       
        var phone= /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; 
        return phone.test(phoneNum );
      }
$('#addWorksample').on('click', function () {
            $(".error_msg").html('');
            
            if ($('#name').val() == '') {
                $('#name').next(".error_msg").html('Please enter name');
                $('#name').focus();
                return false;
            }
            
             if ($('#email').val() == '') {
                $('#email').next(".error_msg").html('Please enter email id ');
                $('#email').focus();
                return false;
            }
            if (!isEmail($('#email').val())) {
                $('#email').next(".error_msg").html('Please enter a valid email id ');
                $('#email').focus();
                return false;

            }
			if ($('#phone').val() == '') {
                $('#phone').next(".error_msg").html('Please enter phone no');
                $('#phone').focus();
                return false;
            }
            if (!isphone($('#phone').val())) {
                $('#phone').next(".error_msg").html('Please enter a valid phone no');
                $('#phone').focus();
                return false;

            }
            if ($('#message').val() == '') {
                $('#message').next(".error_msg").html('Please enter message');
                $('#message').focus();
                return false;
            }

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