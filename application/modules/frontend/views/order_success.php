<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header'); ?>   
    </head>
    <body>
        <?php $this->load->view('common/header_nav'); ?>  
        <!--+++++++++++++ Header End +++++++++++++++++++-->
        <div class="clearfix"></div> 

        <section id="order-confirmation">
            <div class="custom-width">
                <div class="page-heading">
                    <h1>Order Confirmation</h1>
                </div>

                <div class="order-confirmation">
                    <img src="images/success.png" alt="">
                    <h1>Thank you !</h1>
                    <h4>Your order has been suceessfully placed. Order no: <?php echo $order_no[0]['order_no'] ?></h4>
                    <p>Total price for <?php echo $totprod ?> item <?php echo $tot ?></p>
                    <p><a href="<?= base_url('order-history') ?>">Click Here</a> to go to your orders</p>

                    <a href="<?php echo base_url('products') ?>">
                        <button class="btn btntab" type="submit">Continue Shopping</button>
                    </a>

                </div>

            </div>
        </section>

        <div class="clearfix"></div> 
        <!--+++++++++++++ footer Start +++++++++++++++++++-->
        <?php $this->load->view('common/footer'); ?>  
    </body>
    <?php $this->load->view('common/footer_js'); ?>  
</html>