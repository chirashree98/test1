<!DOCTYPE html>
<html>

<head> <?php
        $this->load->view('common/header');
        $cart_share_id = $this->uri->segment(2) !='' ? $this->uri->segment(2) : 0;
        ?> </head>

<body>
    <?php
        $this->load->view('common/header_nav');
        ?>
    <section id="my-account">
        <div class="custom-width">
            <div class="page-heading">
                <h1>Checkout</h1>
            </div>
            <div class="user-right-panel">
                <div class="user-dasbord-area">
                    <div class="my-account-left-panel">
                        <div class="my-account-left-panel-sec1 checkoutpage">
                          
                                <form action="<?php  echo base_url('checkouts') ?>" method="post">
                                 
                                        <div id="collapseOne" class="collapse <?php echo $this->session->userdata('USER_ID') != '' ? 'in' : ''; ?>" aria-labelledby="headingOne" data-parent="#accordionExample" aria-expanded="true">
                                            <div class="card-body"> <?php
                                                            //if ($this->session->userdata('USER_TYPE') == '4' || $this->session->userdata('USER_ID') != '') {
                                                                        ?>
                                                <div class="row">
                                                    <div class="col-sm-12"> 
                                                 
                                                              <span class="checkout-address checkout-detailsaddress">
                                                            <div class="col-sm-6">
                                                                <p>Your Personal Details</p>
                                                                <div class="form-group">
                                                                    <label>Name *</label> <?php // echo json_encode($new_address_data); ?>
                                                                    <input type="text" class="form-control" name="billingname" id="billingname" >
                                                                    <span id="billingname_error" style="color:red;"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Email *</label>
                                                                    <input type="email" class="form-control" name="billingemail" id="billingemail" >
                                                                    <span id="billingemail_error" style="color:red;"></span>
                                                                </div>


                                                               

                                                             

                                                            
                                                            
                                                                <div class="form-group">
                                                                    <label>Address *</label>
                                                                    <input type="text" class="form-control" name="billingaddress" id="billingaddress"> 
                                                                    <span id="billingaddress_error" style="color:red;"></span>
                                                                </div>
                                                              
                                                                
                                                    
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input type="submit" id="submit" name="submit" value="submit" class="continue-btn">
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                    
</script>

</html>
  <div class="clearfix"></div> <?php
$this->load->view('common/footer');
?>
</body> <?php
    $this->load->view('common/footer_js');
?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
			//alert(123);
                $('.notifications').html("<?php echo $msg; ?>");
				//alert(123);
                $('.notifications').animate({right: 0}, 1000);
                intrval = setInterval(function () {
                    $('.notifications').animate({right: -($('.notifications').width() + 30)}, 1000);
                    clearInterval(intrval);
                }, 5000);
            </script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

$('#submit').on('click', function () {
        $(".error_msg").html('');
        $('.alert').remove();

        if ($('#billingname').val() == '') {
            $('#billingname').next("#billingname_error").html('Please enter Name ');
            $('#billingname').focus();
            return false;
        }

        if ($('#billingemail').val() == '') {
            $('#billingemail').next("#billingemail_error").html('Please enter Email');
            $('#billingemail').focus();
            return false;
        }
        if ($('#billingaddress').val() == '') {
            $('#billingaddress').next("#billingaddress_error").html('Please enter Address');
            $('#billingaddress').focus();
            return false;
        }
       
	})  
</script>