<!--<pre>
    <?php print_R($_POST); ?>
</pre>-->
<?php
$tot= floatval(0);
$sub_tot= floatval(0);
$tax= floatval(0);
?>
<div class="col-md-12">
    <div class="table-responsive">
               <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Aantal</th>
                        <th>Product</th>
                        <th>Huurprijs/box</th>
                        <th>Wasprijs/box</th>
                        <th>Maximale kost <span>(Excl: lost and unusable cups)</span></th>
                      </tr>
                    </thead>
                        <tbody>
                            <?php  foreach ($_POST['products'] as $key => $value){ if($value!=''){ ?>
                            <tr> 
                                <td data-title="Hoeveelheid"><?=$value?></td>
                                <td data-title="Model"><?=$_POST['fashion_model'][$key]?></td>
                                <td data-title="Huurprijs/kist" class="numeric">&#128; <?=number_format((float)$_POST['box_prc'][$key], 2, ',', '')?></td>
                                <td data-title="Reinigen & drogen bekers/kist" class="numeric">&#128; <?=number_format((float)$_POST['wash_prc'][$key], 2, ',', '')?></td> 
                                <td data-title="Maximale Kost(Excl:verloren en onbruikbare bekers)" class="numeric">&#128; <?php echo number_format(floatval(($_POST['wash_prc'][$key] + $_POST['box_prc'][$key])*$value ), 2, ',', ''); ?></td>

                            </tr>
                            <?php $tot += floatval(($_POST['wash_prc'][$key] + $_POST['box_prc'][$key])*$value ); } } ?>
                        </tbody>
                </table>
    </div>
    <?php  
        $sub_tot = floatval( $tot + $_POST['collection_by_profiwash_at_the_event']+ $_POST['return_to_address'] + $_POST['collection_by_profiwash_at_collection_point'] + $_POST['return_via_collection_point']+ $_POST['delivery_to_profiwash'] + $_POST['pick_up_at_profiwash'] ) 
                ?>
<table class="table table-striped blue-table">
     <tr>
            <td class="mwdt">Totale hoeveelheid bekers:</td>
            <td>&#128; <?=number_format((float)$tot, 2, ',', '')?></td>
        </tr>
    <?php if($_POST['collection_by_profiwash_at_the_event'] !=''){ ?>
        <tr>
            <td class="pt-3 mwdt"><b> Levering op evenement  </b> </td>
            <td>&#128; <?php echo number_format((float)$_POST['collection_by_profiwash_at_the_event'], 2, ',', '') ?></td>
        <tr>
    <?php
          }
       ?>
       <?php if($_POST['return_via_collection_point'] !=''){ ?>
        <tr>
            <td class="pt-3 mwdt"><b>Ophalen op evenement </b></td>
            <td>&#128; <?php echo  number_format((float)$_POST['return_via_collection_point'], 2, ',', '') ?> </td>
        <tr>
    <?php
          }
       ?>
        <?php if($_POST['return_to_address'] !=''){ ?>
        <tr>
            <td class="pt-3 mwdt"><b>Levering via afhaalpunt</b></td>
            <td>&#128;  <?php echo number_format((float)$_POST['return_to_address'], 2, ',', '') ?> </td>
        <tr>
    <?php
          }
       ?>
    <?php if($_POST['collection_by_profiwash_at_collection_point'] !=''){ ?>
        <tr>
            <td class="pt-3 mwdt"><b> Afhalen bij Durafest  </b> </td>
            <td>&#128; <?php echo number_format((float)$_POST['collection_by_profiwash_at_collection_point'], 2, ',', '') ?></td>
        <tr>
    <?php
          }
       ?>
    <?php if($_POST['delivery_to_profiwash'] !=''){ ?>
        <tr>
            <td class="pt-3 mwdt"><b> Terugbrengen naar afhaalpunt </b> </td>
            <td>&#128; <?php echo number_format((float)$_POST['delivery_to_profiwash'], 2, ',', '') ?></td>
        <tr>
    <?php
          }
       ?>
    <?php if($_POST['pick_up_at_profiwash'] !=''){ ?>
        <tr>
            <td class="pt-3 mwdt"><b> Terugbrengen naar Durafest </b> </td>
            <td>&#128; <?php echo number_format((float)$_POST['pick_up_at_profiwash'], 2, ',', '') ?></td>
        <tr>
    <?php
          }
       ?>
        <tr>
            <td class="pt-3 mwdt">Subtotaal excl: verloren & onbruikbare bekers </td>
            <td>&#128; <?php echo number_format((float)$sub_tot, 2, ',', '') ?></td>
        </tr>
        <tr>
            <td>+21% BTW</td>
            <td>&#128; <?php  $tax=floatval((21 / 100) * $sub_tot); echo number_format((float)$tax, 2, ',', '');  ?></td>
        </tr>
        <tr>
            <td class="pb-3">Totale Kosten excl: verloren & onbruikbare bekers </td>
            <td>&#128; <?php echo number_format(floatval( $tax + $sub_tot), 2, ',', '');  ?></td>
        </tr>
    </table>
    
    <form action="<?php echo base_url(); ?>user/checkout" id="submitCartFrm" method="post">
    <input type="hidden" name="association_name" value="<?php echo $this->session->userdata('USER_TYPE_NAME'); ?>"/>
    <input type="hidden" name="event_name" value="<?php echo $_POST['event_name']; ?>"/>
    <input type="hidden" name="number_of_visitor" value="<?php echo $_POST['number_of_visitor']; ?>"/>
    <input type="hidden" name="cups_per_visitor" value="<?php echo $_POST['cups_per_visitor']; ?>"/>
    <input type="hidden" name="number_of_bar" value="<?php echo $_POST['number_of_bar']; ?>"/>
    <input type="hidden" name="postcode" value="<?php echo $_POST['postcode']; ?>"/>
    <input type="hidden" name="street" value="<?php echo $_POST['street']; ?>"/>
    <input type="hidden" name="number" value="<?php echo $_POST['number']; ?>"/>
    <!-- <input type="hidden" name="event_date" value="<?php echo $_POST['event_date']; ?>"/> -->
    
    <input type="hidden" name="event_start_date" value="<?php echo $_POST['event_start_date']; ?>"/>
    <!--<input type="hidden" name="event_start_time" value="<?php echo $_POST['event_start_time']; ?>"/>-->
    
    <input type="hidden" name="event_start_time_hr" value="<?php echo $_POST['event_start_time_hr']; ?>"/>
    <input type="hidden" name="event_start_time_min" value="<?php echo $_POST['event_start_time_min']; ?>"/>
    
    <input type="hidden" name="event_end_date" value="<?php echo $_POST['event_end_date']; ?>"/>
    <!--<input type="hidden" name="event_end_time" value="<?php echo $_POST['event_end_time']; ?>"/>-->
    
    
    <input type="hidden" name="event_end_time_hr" value="<?php echo $_POST['event_end_time_hr']; ?>"/>
    <input type="hidden" name="event_end_time_min" value="<?php echo $_POST['event_end_time_min']; ?>"/>



    <?php foreach ($_POST['products'] as $key => $value){ if($value!=''){ ?>
    <input type="hidden" name="products[<?php echo $key; ?>]" value="<?php echo $value; ?>"/>
    <?php } } ?>
    <input type="hidden" name="collection_by_profiwash_at_the_event" value="<?php echo $_POST['collection_by_profiwash_at_the_event']?$_POST['collection_by_profiwash_at_the_event']:''; ?>"/>
    <input type="hidden" name="return_to_address" value="<?php echo $_POST['return_to_address']?$_POST['return_to_address']:''; ?>"/>
    <input type="hidden" name="collection_by_profiwash_at_collection_point" value="<?php echo $_POST['collection_by_profiwash_at_collection_point']?$_POST['collection_by_profiwash_at_collection_point']:''; ?>"/>
    <input type="hidden" name="return_via_collection_point" value="<?php echo $_POST['return_via_collection_point']?$_POST['return_via_collection_point']:''; ?>"/>
    <input type="hidden" name="delivery_to_profiwash" value="<?php echo $_POST['delivery_to_profiwash']?$_POST['delivery_to_profiwash']:''; ?>"/>
    <input type="hidden" name="pick_up_at_profiwash" value="<?php echo $_POST['pick_up_at_profiwash']?$_POST['pick_up_at_profiwash']:''; ?>"/>
    
    <input type="hidden" name="sub_total" value=" <?php echo $sub_tot ?>"/>
    <input type="hidden" name="tax" value=" <?php echo floatval((21 / 100) * $sub_tot);  ?>"/>
    <input type="hidden" name="total" value=" <?php echo floatval( $tax + $sub_tot);  ?>"/>


    <!-- <button type="submit" id="submitCart" class="btn btn-primary float-right submt">Bestelling Plaatsen</button> -->

    <div class="row">
              <div class="col-md-12 text-center">
                   <button type="submit" id="submitCart" class="bttn-green">Ga verder</button>
              </div>
    </div>

</form>
</div>



