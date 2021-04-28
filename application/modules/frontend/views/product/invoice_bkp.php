<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/header_v2'); ?>  
    </head>
    <body>
        <?php $this->load->view('common/header_nav_v6'); ?>  

        <!--+++++++++++++ Header End +++++++++++++++++++--> 
        <section class="voor" id="invoiceSec">
            <div class="container">
                <h1>Factuur</h1>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <img src="<?php echo base_url(); ?>assets/front/images/logo.png" alt="logo">

                            </div>
<!--                            <pre>
                                <?php print_r($ord_stng); ?>
                                <?php print_r($ord_items); ?>
                            </pre>-->
                            
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <h6 class="mb-3">Orderbevestiging</h6>
                                        <table class="invoicen">
                                            <tr>
                                                <td class="text-right">Ordernumber : </td>
                                                <td><strong><?php echo $ord_stng['id']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Datum : </td>
                                                <td><?php echo date(('d/m/Y'), strtotime($ord_stng['created_at'])); ?></td>
                                            </tr>
<!--                                            <tr>
                                                <td class="text-right">Vervaldatum : </td>
                                                <td>31/03/2020</td>
                                            </tr>-->
<!--                                            <tr>
                                                <td class="text-right">O/Ref : </td>
                                                <td>Dossier 5612</td>
                                            </tr>-->
                                        </table>
                                    </div>

                                    <!--<div class="col-sm-6">
                                    <h6 class="mb-3">To:</h6>
                                    <div>
                                    <strong>Bob Mart</strong>
                                    </div>
                                    <div>Attn: Daniel Marek</div>
                                    <div>43-190 Mikolow, Poland</div>
                                    <div>Email: marek@daniel.com</div>
                                    <div>Phone: +48 123 456 789</div>
                                    </div>-->

                                </div>

                                <div class="table-responsive-sm invoice">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Artikel</th>
                                                <th>Omschrijving</th>
                                                <th class="text-right">Aantal</th>
                                                <th class="text-right">Eenheidsprijs</th>
                                                <th class="text-right">Bedrag</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $s_tot= floatval(0); ?>
                                            <?php 
                                             foreach ($ord_items->result() as $row){
                                            ?>
                                            <tr>
                                                <td><?php echo $row->name; ?></td>

                                                <td><?php echo $row->sort_desc; ?></td>

                                                <td class="text-right"><?php echo $row->order_qty; ?></td>

                                                <td class="text-right"><?php echo $row->box_prc; ?> &#8364;</td>

                                                
                                                <td class="text-right"><?php echo floatval($row->box_prc * $row->order_qty); $s_tot +=floatval($row->box_prc * $row->order_qty);  ?> &#8364;</td>
                                            </tr>
                                            <?php } ?>
                                            
<!--                                            <tr>
                                                <td>RENT1</td>
                                                <td>PP BIER 30cl</td>
                                                <td class="text-right">720</td>
                                                <td class="text-right">0,010 &#8364;</td>
                                                <td class="text-right">7,20 &#8364;</td>
                                            </tr>
                                            <tr>
                                                <td>RENT1</td>
                                                <td>PP BIER 30cl</td>
                                                <td class="text-right">720</td>
                                                <td class="text-right">0,010 &#8364;</td>
                                                <td class="text-right">7,20 &#8364;</td>
                                            </tr>
                                            <tr>
                                                <td>RENT1</td>
                                                <td>PP BIER 30cl</td>
                                                <td class="text-right">720</td>
                                                <td class="text-right">0,010 &#8364;</td>
                                                <td class="text-right">7,20 &#8364;</td>
                                            </tr>
                                            <tr>
                                                <td>RENT1</td>
                                                <td>PP BIER 30cl</td>
                                                <td class="text-right">720</td>
                                                <td class="text-right">0,010 &#8364;</td>
                                                <td class="text-right">7,20 &#8364;</td>
                                            </tr>
                                            <tr>
                                                <td>RENT1</td>
                                                <td>PP BIER 30cl</td>
                                                <td class="text-right">720</td>
                                                <td class="text-right">0,010 &#8364;</td>
                                                <td class="text-right">7,20 &#8364;</td>
                                            </tr>-->



                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 ml-auto invoice2">
                                        <table class="table table-clear">
                                            <tbody>
                                               <?php if($ord_stng['collection_by_profiwash_at_the_event'] !=''){ ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Levering op evenement</strong>
                                                    </td>
                                                    <td class="text-right"><?php echo $ord_stng['collection_by_profiwash_at_the_event']; $s_tot += floatval($ord_stng['collection_by_profiwash_at_the_event']); ?></td>
                                                </tr>
                                                <?php } ?>
                                                
                                                 <?php if($ord_stng['return_to_address'] !=''){ ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Levering via afhaalpunt</strong>
                                                    </td>
                                                    <td class="text-right"><?php echo $ord_stng['return_to_address'];$s_tot += floatval($ord_stng['return_to_address']); ?></td>
                                                </tr>     
                                                <?php } ?>
                                                 <?php if($ord_stng['collection_by_profiwash_at_collection_point'] !=''){ ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Afleveren bij Profiwash</strong>
                                                    </td>
                                                    <td class="text-right"><?php echo $ord_stng['collection_by_profiwash_at_collection_point']; $s_tot += floatval($ord_stng['collection_by_profiwash_at_collection_point']); ?></td>
                                                </tr>
                                                <?php } ?>
                                                
                                                 <?php if($ord_stng['return_via_collection_point'] !=''){ ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Ophaen op evenement </strong>
                                                    </td>
                                                    <td class="text-right"><?php echo $ord_stng['return_via_collection_point']; $s_tot += floatval($ord_stng['return_via_collection_point']); ?></td>
                                                </tr>
                                                <?php } ?>
                                                
                                                 <?php if($ord_stng['delivery_to_profiwash'] !=''){ ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong> Terugbrengen via afhaalpunt</strong>
                                                    </td>
                                                    <td class="text-right"><?php echo $ord_stng['delivery_to_profiwash']; $s_tot += floatval($ord_stng['delivery_to_profiwash']); ?></td>
                                                </tr>
                                                <?php } ?>
                                                
                                                 <?php if($ord_stng['pick_up_at_profiwash'] !=''){ ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong> Terugbrengen bij Profiwash </strong>
                                                    </td>
                                                    <td class="text-right"><?php echo $ord_stng['pick_up_at_profiwash']; $s_tot += floatval($ord_stng['pick_up_at_profiwash']); ?></td>
                                                </tr>
                                                <?php } ?>
                                                
                                                <tr>
                                                    <td class="left">
                                                        <strong>Subtotaal</strong>
                                                    </td>
                                                    <td class="text-right"><?php echo $s_tot; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>BTW 21%</strong>
                                                    </td>
                                                    <td class="text-right"><?php echo floatval((21/100)*$s_tot); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>TOTAAL</strong>
                                                    </td>
                                                    <td class="text-right">
                                                        <strong>
                                                            <?php // echo $ord_stng['total']; ?>
                                                            <?php echo floatval($s_tot+((21/100)*$s_tot)); ?>
                                                        </strong>
                                                    </td>
                                                </tr>
<!--                                                <tr>
                                                    <td class="left">
                                                        Voorschot
                                                    </td>
                                                    <td class="text-right">
                                                        85,85
                                                    </td>
                                                </tr>-->
<!--                                                <tr>
                                                    <td class="left">
                                                        <strong>Te betalen</strong>
                                                    </td>
                                                    <td class="text-right">
                                                        <strong><?php echo floatval($s_tot+((21/100)*$s_tot));  ?> &#8364;</strong>
                                                    </td>
                                                </tr>-->
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <table class="invoicelast">
                            <tr>
                                <td><strong>PROFIWASH BV</strong></td>
                            </tr>
                            <tr>
                                <td>Wingepark 4A</td>
                                <td> </td>
                                <td>BTW BE 0479.870.579</td>
                                <td>RPR leuven</td>
                            </tr>
                            <tr>
                                <td width="25%">3110ROTSELAAR</td>
                                <td width="25%">Tel : 016/24 14 81 </td>
                                <td width="25%">BIC : KREDBEBB</td>
                                <td width="25%">IBAN : BE26 7350 0618 3029</td>
                            </tr>
                        </table>

                        <button type="button" onclick="$('#invoiceSec').print();" class="btn btn-primary submt mt-4">Print</button>
                    </div>
                </div>

            </div>

        </section>




        <!--+++++++++++++ footer Start +++++++++++++++++++-->

        <?php $this->load->view('common/footer_v2'); ?>  


    </body>
    <?php $this->load->view('common/footer_js_v2'); ?>  
    <script>
        
    $.fn.extend({
  print: function() {
    var frameName = 'printIframe';
    var doc = window.frames[frameName];
    if (!doc) {
      $('<iframe>').hide().attr('name', frameName).appendTo(document.body);
      doc = window.frames[frameName];
    }
    doc.document.body.innerHTML = this.html();
    doc.window.print();
    return this;
  }
});
    </script>
</html>
