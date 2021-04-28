<!--<pre><?php print_R($val); ?>
</pre>-->
<?php
$tot = floatval(0);
$sub_tot = floatval(0);
$tax = floatval(0);
?>

        <div class="col-md-8">
            <table class="totaal">
                <tr>
                    <td width="80%">Totaal :</td>
                    <td>&#128;0,00</td>
                </tr>
            </table>
            
<button type="submit" class="btn btn-primary submt">Bestelling plaasen</button>
<?php 
    $sub_tot = floatval( $tot + $_POST['collection_by_profiwash_at_the_event']+ $_POST['return_to_address'] + $_POST['collection_by_profiwash_at_collection_point'] + $_POST['return_via_collection_point']+ $_POST['delivery_to_profiwash'] + $_POST['pick_up_at_profiwash'] ) 
    ?>
    
    <form action="<?php echo base_url(); ?>user/checkout" id="submitCartFrm" method="post">
        <input type="hidden" name="association_name" value="<?php echo $this->session->userdata('USER_TYPE_NAME'); ?>"/>
        <input type="hidden" name="event_name" value="<?php echo $_POST['event_name']; ?>"/>
        <input type="hidden" name="number_of_visitor" value="<?php echo $_POST['number_of_visitor']; ?>"/>
        <input type="hidden" name="cups_per_visitor" value="<?php echo $_POST['cups_per_visitor']; ?>"/>
        <input type="hidden" name="number_of_bar" value="<?php echo $_POST['number_of_bar']; ?>"/>
        <input type="hidden" name="postcode" value="<?php echo $_POST['postcode']; ?>"/>
        <input type="hidden" name="street" value="<?php echo $_POST['street']; ?>"/>
        <input type="hidden" name="number" value="<?php echo $_POST['number']; ?>"/> 
        <input type="hidden" name="event_date" value="<?php echo $_POST['event_date']; ?>"/>
        <?php foreach ($_POST['products'] as $key => $value) {
            if ($value != '') { ?>
                <input type="hidden" name="products[<?php echo $key; ?>]" value="<?php echo $value; ?>"/>
    <?php }
} ?>
        <input type="hidden" name="collection_by_profiwash_at_the_event" value="<?php echo $_POST['collection_by_profiwash_at_the_event'] ? $_POST['collection_by_profiwash_at_the_event'] : ''; ?>"/>
        <input type="hidden" name="return_to_address" value="<?php echo $_POST['return_to_address'] ? $_POST['return_to_address'] : ''; ?>"/>
        <input type="hidden" name="collection_by_profiwash_at_collection_point" value="<?php echo $_POST['collection_by_profiwash_at_collection_point'] ? $_POST['collection_by_profiwash_at_collection_point'] : ''; ?>"/>
        <input type="hidden" name="return_via_collection_point" value="<?php echo $_POST['return_via_collection_point'] ? $_POST['return_via_collection_point'] : ''; ?>"/>
        <input type="hidden" name="delivery_to_profiwash" value="<?php echo $_POST['delivery_to_profiwash'] ? $_POST['delivery_to_profiwash'] : ''; ?>"/>
        <input type="hidden" name="pick_up_at_profiwash" value="<?php echo $_POST['pick_up_at_profiwash'] ? $_POST['pick_up_at_profiwash'] : ''; ?>"/>

        <input type="hidden" name="sub_total" value=" <?php echo $sub_tot ?>"/>
        <input type="hidden" name="tax" value=" <?php echo floatval((21 / 100) * $sub_tot); ?>"/>
        <input type="hidden" name="total" value=" <?php echo floatval($tax + $sub_tot); ?>"/>
        <button type="submit" id="submitCart" class="btn btn-primary float-right submt">Bestelling Plaatsen</button>
    </form>
</div>



