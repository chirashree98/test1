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

<?php foreach($artist->result() as $val){?>
<?php if($val->title!=''){?>
        <section id="artistlint-sec1" class="topline">
            <div class="custom-width">
			
        <h1><?php echo $val->title;?></h1>
		<?php
}?>
<?php if($val->description!=''){?>
        <p><?php echo $val->description;?></p>
		<?php
   }}?>
              
                <div class="artist-shortby">
                    <p>There are <?php echo $total_rows;   if($total_rows==1){ echo " Designer";}else{ echo " Designers"; }?></p>
                    <span>Sort by : 
                        <div class="dropdown customright">
                            <form id="sortByFrom" action="<?php echo base_url(); ?>frontend/artist/artistSearch" method="post">
                                <div class="custom-select">
                            <select name = "service" class = "form-control" id="sortBy" class="dropdown-menu">
                                <option value="">All</option>
                                <?php
								
                                foreach ($service->result() as $val) {
                                    ?>
                                    <option <?php if(isset($_SESSION['search']['service']) && $_SESSION['search']['service']==$val->id){ echo 'selected' ; } ?> value = "<?php echo $val->id; ?>"  > <?php echo strtoupper($val->service_name); ?> </option>
                                        <?php
                                    }
                                    ?>
                            </select>
                                    </div>
                             </form>


<!--<button class="dropdown-toggle" type="button" data-toggle="dropdown">Top Artists <img src="images/list-dropdown.png"/></button>
<ul class="dropdown-menu">
<li><a href="#">All</a></li>
<li><a href="#">Interior Designer</a></li>
</ul>-->
                        </div>

                    </span>
                </div>
                <div class="artist-searcharea">
                    <p>FIND Designers </p> 
                    <div class="form-group">
                        <form>
                            <input type="text" class="form-control" placeholder="Enter Designers Name" name="keyword" id="keyword"  value="<?php if(isset($_SESSION['search']['keyword'])){ echo $_SESSION['search']['keyword']; } ?>"/>
                            

  <?php if (!empty($_SESSION['search']['keyword'])) {
                                    foreach ($_SESSION['search'] as $key => $val) {
                                        if ($key == 'keyword') {
                            echo '<a href="'.base_url().'artist_remove_search?value=keyword"><img src="'.base_url().'assets/front/images/cross-black.png" class="artist_remove"/></a>';
                            }
                            }
                            }
                        else
                        {
                            ?><button class="artist-search-btn"><img src="<?php echo base_url(); ?>assets/front/images/search.png"/><?php } ?></button>   
                           
                            
                            
                        </form>           
                    </div>
                </div>

                <div class="artist-list" id="dataList">
                    <div class="row" id="default-datatable22s">
                        <?php
                       // print_r($query->result());
                        if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                                ?>

                                <div class="col-md-3 col-sm-6">
                                    <div class="artist-list-inner">
                                        <a href="<?php echo base_url(); ?>artist-details/<?php echo $row->u_id; ?>"> 
                                        <?php if($row->profile_image=="")
                                        {
                                            ?>
                                           <a href="<?php echo base_url(); ?>artist-details/<?php echo  digi_encode($row->u_id); ?>"> <img src="<?php echo base_url(); ?>assets/front/images/Blank-Profile.jpg" class="img-responsive"/></a>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <a href="<?php echo base_url(); ?>artist-details/<?php echo  digi_encode($row->u_id); ?>"><img src="<?php echo base_url(); ?>uploads/artist/<?php echo $row->profile_image; ?>" class="img-responsive"/></a>
                                            <?php
                                        }?>
                                        
                                        
                                        
                                        </a>
                                        <h4><a href="<?php echo base_url(); ?>artist-details/<?php echo  digi_encode($row->u_id); ?>"><?php echo $row->first_name . " " . $row->last_name; ?></a></h4>
                                        <span><a href="<?php echo base_url(); ?>artist-details/<?php echo digi_encode($row->u_id); ?>"><?php if(($row->service_name == 'interior')||($row->service_name == 'painter')){?><?php echo $row->service_name; ?>
                                            <?php
                                        }?><?php if($row->service_name == 'others'){?><?php echo $row->others; ?><?php }?>
                                    </div>
                                </div>

                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="artist-list-inner">
                                    <h4>No Artists Found</h4>
                                </div>
                            </div>
<?php } ?>


                    </div>
                </div>


                <div class="pagination">

                    <?php if ($query->num_rows() > floatval($limit)) { ?>
                            <span>Showing <?=abs($page+1)?>-<?php echo floatval($page + $query->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } else { ?>
                                <span>Showing <?=$page?>-<?php echo floatval($page + $query->num_rows()); ?> of <?php echo $total_rows; ?> item(s)</span>
                            <?php } ?>
                    <ul>
<?php echo $links; ?>
<!--<span>Showing 1-7 of 7 item(s)</span>
    <ul>
    <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> &nbsp; Previous</a></li>
        <li><a href="#">1</a></li>
        <li class="active"><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#"> Next &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
    </ul>-->
                </div>

            </div>
        </section>

        <div class="clearfix"></div> 


        <!--+++++++++++++ footer Start +++++++++++++++++++-->
    <?php $this->load->view('common/footer'); ?>  
    </body>
<?php $this->load->view('common/footer_js'); ?>  
    <script>
 $(document).ready(function(){
     $('#sortBy').on('change', function(page_num){
		 
        $('#sortByFrom').submit();
     });
 });
//       $(document).ready(function(){
//  $('#keyword').on('keyup', function(page_num){
//   page_num = page_num?page_num:0;
//    var keyword = $('#keyword').val();
//    
//    $.ajax({
//		
//        type: 'POST',
//		url: "<?php echo base_url('artists'); ?>",
//     	data:'page='+page_num+'&keyword='+keyword,
//        beforeSend: function(){
//            $('.loading').show();
//        },
//        success: function(html){
//            $('#dataList').html(html);
//            $('.loading').fadeOut("slow");
//        }
//  });
//});
//});
//
//$(document).ready(function(){
//  $('#sortBy').on('change', function(page_num){
//   page_num = page_num?page_num:0;
//    //var keyword = $('#keyword').val();
//    var sortBy = $('#sortBy').val();
//
//	 $.ajax({
//		type: 'POST',
//		url: "<?php echo base_url('artistSearch'); ?>",
//		data:'page='+page_num+'&sortBy='+sortBy,
//        beforeSend: function(){
//            $('.loading').show();
//        },
//        success: function(html){
//            $('#dataList').html(html);
//            $('.loading').fadeOut("slow");
//        }
//  });
//});
//});


$(document).ready(function(){
		$("#keyword").keyup(function(){
      //alert(123);
				if($("#keyword").val().length>0) {
					var names =$("#keyword").val();
					//alert(names);
					$.ajax({
						url:"<?php echo base_url()?>frontend/artist/artistSearchajax",
						method:"post",
						 data:'keyword='+$("#keyword").val(),
						 success:function(response){
							//alert(response);return false;
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
				if($("#keyword").val().length == 0) {
          //$("#default-datatable22s").show();
          //alert(123);
					$.ajax({
						url:"<?php echo base_url()?>frontend/artist/artistSearchajax",
						method:"post",
						 data:'keyword='+$("#keyword").val(),
						success:function(response){
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
</html>