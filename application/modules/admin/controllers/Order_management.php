<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_management extends MX_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text','gen_helper'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }

    public function all_event() {
        $this->db->select('*','u.city_name');
        $this->db->from('orders');
        $this->db->join('users as u', 'orders.user_id = u.u_id');
        //$this->db->where(array('orders.user_id' => $this->session->userdata('USER_ID')));
        $this->db->where(array());
        $this->db->order_by('orders.id','desc');
        $query = $this->db->get();
        $data['query'] = $query;
        $this->load->view('event/all-event', $data);
    }

    public function edit_event() {
        $data = array();
        $id = $this->uri->segment(4);
        $data['ord_stng'] = $this->common_model->RetriveRecordByWhereRow('orders', array('id' => $id));

        $this->db->select('*,order_items.used_cups as order_items_used_cups,order_items.lost_cup as order_items_lost_cup');
        $this->db->from('order_items');
        $this->db->join('products', 'order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        $data['ord_items'] = $query;

        $this->load->view('event/edit-event', $data);
    }

    public function update_event() {
        

        $id = $this->input->post("order_id");
        $userInfo = $this->db->select('*')
                                ->from('orders')
                                ->where(array('orders.id' => $id))
                                ->get()
                                ->row();
        //echo $userInfo->user_id; die;                     
        $data = array();
        $getData = array(
//            'event_date' => $this->input->post('event_date'),
            'event_start_date' => $this->input->post('event_start_date'),
            'event_start_time' => $this->input->post('event_start_time'),
            'event_end_date' => $this->input->post('event_end_date'),
            'event_end_time' => $this->input->post('event_end_time'),
            'event_name' => $this->input->post('event_name'),
            'number_of_visitor' => $this->input->post('number_of_visitor'),
            'cups_per_visitor' => $this->input->post('cups_per_visitor'),
            'invoice_created_by_admin' => 1,
//            'used_cups' => $this->input->post('used_cups'),
//            'lost_cup' => $this->input->post('lost_cup'),
//            'wash_prc' => $this->input->post('wash_prc'),
//            'final_cost' => $this->input->post('final_cost'),
        );
//        print_r($_POST['item_id']);
//        echo count($_POST['used_cups']);
        for($i=0;$i<count($_POST['used_cups']);$i++){
            $getItemData = array(
            'used_cups' => $_POST['used_cups'][$i],
            'lost_cup' => $_POST['lost_cup'][$i],
        );
        $this->common_model->UpdateRecord($getItemData, 'order_items', 'id', $_POST['item_id'][$i]);
        
        }
//        exit();   
        $this->common_model->UpdateRecord($getData, 'orders', 'id', $id);
        $message = '<div class="alert alert-success"><p>Orders has been successfully updated.</p></div>';


        $msg='Hi, Invoice Generated for Your event [ ID: '.$id.' ]  By Admin.';
        $inbox_msg = array(
                'to_u_id' => $userInfo->user_id,            
                'created_u_id' => '1',
                'created_by' => 'Admin',
                'message' => $msg,
            );
        $this->common_model->AddRecord($inbox_msg, 'inbox');

############ Create invoice pdf to send in mail attachement ###########################

        $data = array();
        //$id = $this->uri->segment(4);
        $ord_stng = $this->common_model->RetriveRecordByWhereRow('orders', array('id' => $id));

        $this->db->select('*');
        $this->db->from('order_items');
        $this->db->join('products', 'order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        //echo $this->db->last_query();
        $ord_items =  $query->result_array();
        /* echo '<pre>'; 
        print_r($ord_items); die;*/
      
     // $html = '<div class="container"> <p>   '.$ord_no.'  </div>'; 
     $ord_date =  date(('d/m/Y'), strtotime($ord_stng['created_at']));  

     $html1 = '<div class="container">
                     <div class="row">
                            <div class="col-md-8">
                                  <div class="card">
                                      <div class="card-header">
                                              <img class="logo" src="'.base_url().'assets/logo.jpg" height="56px" alt="logo">
                                      </div>
                                      <div class="card-body">
                                         <div class="row mb-4">
                                            <div class="col-sm-6">
                                               <table class="invoicen">
                                                  <tbody>
                                                     <tr>
                                                        <td class="text-right">Ordernumber : </td>
                                                        <td><strong> '.$ord_stng['id'].'</strong></td>
                                                     </tr>
                                                     <tr>
                                                        <td class="text-right">Datum : </td>
                                                        <td>'.$ord_date.'</td>
                                                     </tr>
                                                  </tbody>
                                               </table>
                                            </div>
                                         </div>
                                         <div class="table-responsive-sm invoice">
                                            <table class="table table-striped">
                                               <thead>
                                                  <tr>
                                                     <th>Artikel</th>
                                                     <th>Omschrijving</th>
                                                     <th class="text-right">Aantal</th>
                                                     <th class="text-right">Eenheidsprijs</th>
                                                     <th class="text-right">Gebruikte boxen</th>
                                                     <th class="text-right">Verloren cups</th>
                                                     <th class="text-right">Bedrag</th>
                                                  </tr>
                                               </thead>
                                               <tbody>';
             $html2 = "";
             $s_tot = floatval(0);
            if ($ord_stng['collection_by_profiwash_at_the_event'] != '') { 
              $s_tot += floatval($ord_stng['collection_by_profiwash_at_the_event']);
              }
             if ($ord_stng['return_to_address'] != '') {
                 $s_tot += floatval($ord_stng['return_to_address']);
              }
            if ($ord_stng['collection_by_profiwash_at_collection_point'] != '') {
              $s_tot += floatval($ord_stng['collection_by_profiwash_at_collection_point']);
             }
             if ($ord_stng['return_via_collection_point'] != '') {
              $s_tot += floatval($ord_stng['return_via_collection_point']);
              }
              if ($ord_stng['delivery_to_profiwash'] != '') {
                $s_tot += floatval($ord_stng['delivery_to_profiwash']);
              }
              if ($ord_stng['pick_up_at_profiwash'] != '') {
                 $s_tot += floatval($ord_stng['pick_up_at_profiwash']);
               }
            foreach ($ord_items as $row) {
              $my_var = floatval(($row['box_prc'] * $row['order_qty']) + ($row['used_cups'] * $row['wash_prc'] ) + ($row['lost_cup'] * $row['loss_prc'] ));

            $s_tot += floatval(($row['box_prc'] * $row['order_qty']) + ($row['used_cups'] * $row['wash_prc'] ) + ($row['lost_cup'] * $row['loss_prc'] ));
              /* echo '<pre>';
              print_r($ord_stng); die;*/
              
              $gst_amt =  floatval((21 / 100) * $s_tot);
             $total_amt = floatval($s_tot + ((21 / 100) * $s_tot));
                 $html2.='<tr><td>  '.$row['name'].' </td> 
                             <td>'.$row['sort_desc'].'</td>
                             <td>'.$row['order_qty'].'</td>
                             <td>'.$row['box_prc'].' &#8364;</td>
                             <td>'.$row['used_cups'].'</td>
                              <td>'.$row['lost_cup'].'</td>
                               <td >'.$my_var.' &#8364;</td>
                             </tr>';
                              } 
              $html3 = '</tbody>
                         </table>
                         </div>
                             <div class="row">
                                    <div class="col-lg-12 col-sm-12 ml-auto invoice2">
                                          <table class="table table-clear">
                                              <tbody>
                                                  <tr>
                                                    <td class="left"><strong>Subtotaal</strong></td>
                                                    <td class="text-right"> '.$s_tot.' </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="left"> <strong>BTW 21%</strong> </td>
                                                    <td class="text-right"> '.$gst_amt.' </td>
                                                  </tr>
                                                   <tr>
                                                      <td class="left"><strong>TOTAAL</strong>
                                                     </td>
                                                     <td class="text-right"><strong>'.$total_amt.'</strong>
                                                     </td>
                                                  </tr>
                                              </tbody>
                                           </table>
                                            </div>
                                         </div>
                                      </div>
                             </div>
                        </div>
                      </div>
                    </div>';


   $html = $html1.$html2.$html3; 

   //echo $html; die;
    $this->load->library('pdf');  
    $this->dompdf->load_html($html);
    $this->dompdf->set_paper('A4', 'portrait');
    $this->dompdf->render();
    $opt = $this->dompdf->output();
    $filename = $id."-ivoice.pdf";


    $pdfroot = 'uploads/invoice/'.$filename;
    file_put_contents($pdfroot, $opt);
    //echo "786"; 
 
#####################################
       
    
    /*
    $userDetails = $this->db->select('*')
                                ->from('users')
                                ->where(array('users.u_id' => $userInfo->user_id))
                                ->get()
                                ->row();
        $data['to'] = $userDetails->email;
//        $data['to'] = 'gsr.dev.15@gmail.com';
        $data['dear_name'] = $userDetails->f_name;
         $data['subject'] = 'Uw factuur voor bestelling'. " ". $id . " ".'is beschikbaar in uw account';
        $data['email_template'] = 'invoice';
        $data['pdf'] = base_url().$pdfroot;
        $data['ordernumber'] = $id;
        $data['url'] = base_url().'admin/dashboard';

        $result = send_mail($data);
        
       */
    
    $this->db->select('*')->from('users')->where(array('users.u_id' => $userInfo->user_id));
        if ($this->session->userdata('USER_TYPE') == 'Super_City') {
            $userDetails = $this->db->get()->row();
            $name = $userDetails->city_name;
            $link=base_url() . 'mijidashboard';
        } else if ($this->session->userdata('USER_TYPE') == 'City') {
            $userDetails = $this->db->get()->row();
            $name = $userDetails->city_name;
            $link=base_url() . 'mijidashboard';
        } else if ($this->session->userdata('USER_TYPE') == 'Association') {
            $this->db->select('verenigings.association as asso_name');
            $this->db->join('verenigings', 'users.association = verenigings.association');
            $userDetails = $this->db->get()->row();
            $name = $userDetails->asso_name;
            $link=base_url() . 'login';
        }
        $data['to'] = 'gsr.dev.15@gmail.com';
        $data['dear_name'] = $name;
         $data['subject'] = 'Uw factuur voor bestelling '. $id .' is beschikbaar in uw account.';
        $data['email_template'] = 'invoice';
        $data['pdf'] = base_url().$pdfroot;
        $data['ordernumber'] = $id;
        $data['url'] = base_url().'admin/dashboard';
        
        $result = send_mail($data);
        redirect('admin/order_management/all_event');

//        echo "kkkkkkkkkk"; die;
    }
    
    
    
    public function test_mail() {
        $id=21212;
//        print_R($userDetails);
        
         $this->db->select('*')->from('users')->where(array('users.u_id' => $to_u_id));
        if ($this->session->userdata('USER_TYPE') == 'Super_City') {
            $userDetails = $this->db->get()->row();
            $name = $userDetails->city_name;
            $link=base_url() . 'mijidashboard';
        } else if ($this->session->userdata('USER_TYPE') == 'City') {
            $userDetails = $this->db->get()->row();
            $name = $userDetails->city_name;
            $link=base_url() . 'mijidashboard';
        } else if ($this->session->userdata('USER_TYPE') == 'Association') {
            $this->db->select('verenigings.association as asso_name');
            $this->db->join('verenigings', 'users.association = verenigings.association');
            $userDetails = $this->db->get()->row();
            $name = $userDetails->asso_name;
            $link=base_url() . 'login';
        }
//        $data['to'] = $userDetails->email;
        $data['to'] = 'gsr.dev.15@gmail.com';
        $data['dear_name'] = $name;
        $data['subject'] = 'Uw bestelling'. " ". $id. " ". 'is goedgekeurd door Profiwash';
        $data['email_template'] = 'order-confirmation-from-admin';
        $data['ordernumber'] = $last_id;
        $data['url'] = $link;
        $result = send_mail($data);
    }
    

    public function delete_order() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('orders', $id, 'id');
        $message = '<div class="alert alert-success"><p>Order has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/order_management/all_event');
    }

    public function change_event_status() {

        $data = array();
        $id = $this->input->post('id');
        $to_u_id = $this->input->post('to_u_id'); 
        $value = $this->input->post('val');
        $save_data['order_status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'orders', 'id', $id);
        if($value=='Y'){
        $msg='Hi, Your requested event [ ID: '.$id.' ] is Ativated.';
        
        /*
        $userDetails = $this->db->select('*')
                                ->from('users')
                                ->where(array('users.u_id' => $to_u_id))
                                ->get()
                                ->row();

        $data['to'] = $userDetails->email;
        $data['dear_name'] = $userDetails->f_name;
        $data['subject'] = 'Uw bestelling'. " ". $id. " ". 'is goedgekeurd door Profiwash';
        $data['email_template'] = 'order-confirmation';
        $data['ordernumber'] = $id;
        $data['url'] = 'https://www.demomtea.eu/dev/login';

        $data['url'] = ' ';

        $result = send_mail($data);
*/
        
        $this->db->select('*')->from('users')->where(array('users.u_id' => $to_u_id));
        if ($this->session->userdata('USER_TYPE') == 'Super_City') {
            $userDetails = $this->db->get()->row();
            $name = $userDetails->city_name;
            $link=base_url() . 'mijidashboard';
        } else if ($this->session->userdata('USER_TYPE') == 'City') {
            $userDetails = $this->db->get()->row();
            $name = $userDetails->city_name;
            $link=base_url() . 'mijidashboard';
        } else if ($this->session->userdata('USER_TYPE') == 'Association') {
            $this->db->select('verenigings.association as asso_name');
            $this->db->join('verenigings', 'users.association = verenigings.association');
            $userDetails = $this->db->get()->row();
            $name = $userDetails->asso_name;
            $link=base_url() . 'login';
        }
        
        $data['to'] = $userDetails->email;
        $data['dear_name'] = $name;
        $data['subject'] = 'Uw bestelling'. " ". $id. " ". 'is goedgekeurd door Profiwash';
        $data['email_template'] = 'order-confirmation-from-admin';
        $data['ordernumber'] = $last_id;
        $data['url'] = $link;
        $result = send_mail($data);
        
        
        }else{
            $msg='Hi, Your requested event [ ID: '.$id.' ] is Inacive'.'.';
        }
        $inbox_msg = array(
                'to_u_id' => $to_u_id,            
                'created_u_id' => '1',
                'created_by' => 'Admin',
                'message' => $msg,
            );
        $this->common_model->AddRecord($inbox_msg, 'inbox');

        
        echo 'ok222';
    }
    
    
    
    
    public function all_wash_order() {
        $this->db->select('*');
        $this->db->from('wash_order');
        $this->db->where(array());
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        $data['query'] = $query;
        $this->load->view('event/all-wash-order', $data);
    }

   public function invoice() {
   	//echo "1"; die;
        $data = array();
        $id = $this->uri->segment(4);
        $data['ord_stng'] = $this->common_model->RetriveRecordByWhereRow('orders', array('id' => $id));

        $this->db->select('*');
        $this->db->from('order_items');
        $this->db->join('products', 'order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        $data['ord_items'] = $query;
        $this->load->view('event/invoice', $data);
    }

     public function washinvoice() {
        
        $data = array();
        $id = $this->uri->segment(4);
        $data['ord_stng'] = $this->common_model->RetriveRecordByWhereRow('wash_order', array('id' => $id));

        $this->db->select('*');
        $this->db->from('wash_order_items');
        $this->db->join('products', 'wash_order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        $data['ord_items'] = $query;
        $this->load->view('event/washinvoice', $data);

         
     // $html = '<div class="container"> <p>   '.$ord_no.'  </div>'; 
     $ord_date =  date(('d/m/Y'), strtotime($ord_stng['created_at']));  

    }

public function downloadwashinvoice() {
        
        $data = array();
        $id = $this->uri->segment(4);
        $data['ord_stng'] = $this->common_model->RetriveRecordByWhereRow('wash_order', array('id' => $id));

        $this->db->select('*');
        $this->db->from('wash_order_items');
        $this->db->join('products', 'wash_order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        $data['ord_items'] = $query;
        //$this->load->view('event/washinvoice', $data);

         $data = array();
        //$id = $this->uri->segment(4);
        $ord_stng = $this->common_model->RetriveRecordByWhereRow('orders', array('id' => $id));

        $this->db->select('*');
        $this->db->from('order_items');
        $this->db->join('products', 'order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        //echo $this->db->last_query();
        $ord_items =  $query->result_array();
        /* echo '<pre>'; 
        print_r($ord_items); die;*/
      
     // $html = '<div class="container"> <p>   '.$ord_no.'  </div>'; 
     $ord_date =  date(('d/m/Y'), strtotime($ord_stng['created_at']));  

     $html1 = '<div class="container">
                     <div class="row">
                            <div class="col-md-8">
                                  <div class="card">
                                      <div class="card-header">
                                              <img class="logo" src="'.base_url().'assets/logo.jpg" height="56px" alt="logo">
                                      </div>
                                      <div class="card-body">
                                         <div class="row mb-4">
                                            <div class="col-sm-6">
                                               <table class="invoicen">
                                                  <tbody>
                                                     <tr>
                                                        <td class="text-right">Ordernumber : </td>
                                                        <td><strong> '.$ord_stng['id'].'</strong></td>
                                                     </tr>
                                                     <tr>
                                                        <td class="text-right">Datum : </td>
                                                        <td>'.$ord_date.'</td>
                                                     </tr>
                                                  </tbody>
                                               </table>
                                            </div>
                                         </div>
                                         <div class="table-responsive-sm invoice">
                                            <table class="table table-striped">
                                               <thead>
                                                  <tr>
                                                     <th>Artikel</th>
                                                     <th>Omschrijving</th>
                                                     <th class="text-right">Aantal</th>
                                                     <th class="text-right">Eenheidsprijs</th>
                                                     <th class="text-right">Gebruikte boxen</th>
                                                     <th class="text-right">Verloren cups</th>
                                                     <th class="text-right">Bedrag</th>
                                                  </tr>
                                               </thead>
                                               <tbody>';
             $html2 = "";
             $s_tot = floatval(0);
            if ($ord_stng['collection_by_profiwash_at_the_event'] != '') { 
              $s_tot += floatval($ord_stng['collection_by_profiwash_at_the_event']);
              }
             if ($ord_stng['return_to_address'] != '') {
                 $s_tot += floatval($ord_stng['return_to_address']);
              }
            if ($ord_stng['collection_by_profiwash_at_collection_point'] != '') {
              $s_tot += floatval($ord_stng['collection_by_profiwash_at_collection_point']);
             }
             if ($ord_stng['return_via_collection_point'] != '') {
              $s_tot += floatval($ord_stng['return_via_collection_point']);
              }
              if ($ord_stng['delivery_to_profiwash'] != '') {
                $s_tot += floatval($ord_stng['delivery_to_profiwash']);
              }
              if ($ord_stng['pick_up_at_profiwash'] != '') {
                 $s_tot += floatval($ord_stng['pick_up_at_profiwash']);
               }
            foreach ($ord_items as $row) {
              $my_var = floatval(($row['box_prc'] * $row['order_qty']) + ($row['used_cups'] * $row['wash_prc'] ) + ($row['lost_cup'] * $row['loss_prc'] ));

            $s_tot += floatval(($row['box_prc'] * $row['order_qty']) + ($row['used_cups'] * $row['wash_prc'] ) + ($row['lost_cup'] * $row['loss_prc'] ));
              /* echo '<pre>';
              print_r($ord_stng); die;*/
              
              $gst_amt =  floatval((21 / 100) * $s_tot);
             $total_amt = floatval($s_tot + ((21 / 100) * $s_tot));
                 $html2.='<tr><td>  '.$row['name'].' </td> 
                             <td>'.$row['sort_desc'].'</td>
                             <td>'.$row['order_qty'].'</td>
                             <td>'.$row['box_prc'].' &#8364;</td>
                             <td>'.$row['used_cups'].'</td>
                              <td>'.$row['lost_cup'].'</td>
                               <td >'.$my_var.' &#8364;</td>
                             </tr>';
                              } 
              $html3 = '</tbody>
                         </table>
                         </div>
                             <div class="row">
                                    <div class="col-lg-12 col-sm-12 ml-auto invoice2">
                                          <table class="table table-clear">
                                              <tbody>
                                                  <tr>
                                                    <td class="left"><strong>Subtotaal</strong></td>
                                                    <td class="text-right"> '.$s_tot.' </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="left"> <strong>BTW 21%</strong> </td>
                                                    <td class="text-right"> '.$gst_amt.' </td>
                                                  </tr>
                                                   <tr>
                                                      <td class="left"><strong>TOTAAL</strong>
                                                     </td>
                                                     <td class="text-right"><strong>'.$total_amt.'</strong>
                                                     </td>
                                                  </tr>
                                              </tbody>
                                           </table>
                                            </div>
                                         </div>
                                      </div>
                             </div>
                        </div>
                      </div>
                    </div>';


   $html = $html1.$html2.$html3; 

//   echo $html; die;
    $this->load->library('pdf');  
    $this->dompdf->load_html($html);
    $this->dompdf->set_paper('A4', 'portrait');
    $this->dompdf->render();
    $opt = $this->dompdf->output();
    $filename = "washivoice.pdf";


// Output the generated PDF to Browser
$this->dompdf->stream($filename);

    //$pdfroot = 'uploads/invoice/'.$filename;
   // file_put_contents($pdfroot, $opt);
    }
    
    
    
public function downloadwashinvoice_v2() {

        $data = array();
        $id = $this->uri->segment(4);
        $ord_stng = $this->common_model->RetriveRecordByWhereRow('wash_order', array('id' => $id));

        $this->db->select('*');
        $this->db->from('wash_order_items');
        $this->db->join('products', 'wash_order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        $ord_items = $query;

        $getUserDetails = getUserDetailsById($id);

        $html = '<style>'
                . 'h3
{
  border:1px solid black;
}
        a.bttn-green {
    margin-top: 40px;
}
a.bttn-green {
    width: 178px;
    height: 63px;
    border-radius: 5px;
    background: #67b930;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
}
.bttn-green {
    width: 308px;
    height: 63px;
    color: #fff;
    font-family: \'Poppins\', sans-serif;
    line-height: 63px;
    border-radius: 5px;
    background: #67b930;
    font-size: 20px;
    display: inline-block;
    border: 2px solid #67b930;
    font-weight: 600;
    box-shadow: -1px 3px 2px rgba(0, 0, 0, 0.10);
    margin: 15px 0 40px;
    text-transform: uppercase;
}
        .box-cards{
            background: #fff; padding: 15px;border: 2px solid #3db8da;
        }
        .box-cards .right-table h1{
            font-size: 32px;
            color: #2f788a;
            font-weight: 400;
            margin-bottom: 20px;
        }
        .box-cards .right-table h2{
            font-size: 22px;
        }
        .box-cards .right-table .table.normal-table tbody td{
            text-align: left; font-size: 15px; color: #10242b;
            font-weight: 300; padding: 8px 10px; border-top: 0;
        }
        .box-cards .right-table .table.normal-table tbody td:first-child{
            font-weight: 500;
        }
        .box-cards .right-table .table.normal-table tbody td:last-child{
            text-align: right;
        }
        .raaddress{
            padding: 15px;
            background: #f7f7f7;
            width: 100%;
            box-sizing: border-box;
            margin: 30px;
        }
        .raaddress p{ margin-bottom: 6px;}
        .raaddress h4{ font-size: 20px; margin-top: 1.5em;}
        @media (min-width: 992px){
            .col-md-6 {
            width: 50%;
            margin-left: 50%;
        }
        }</style>';
        $html .= '<div class="cart-sec" id="content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="background: #fff; padding: 15px;> 
                                                            <div class="row">
                                                                <table class="table table-striped table-inbox print-page mb-0" width="100%" >
																<tr>
																<td width="30%">						
                                                                                    <div class="col-md-8">
                                                                                <div class="left-table">
                                                                                    <img src="' . base_url() . 'assets/invoice_logo.jpg" alt="">
                                                                                    <div style="padding: 15px;
                                                                                         background: #f7f7f7;
                                                                                         width: 100%;
                                                                                         box-sizing: border-box;
                                                                                         margin: 30px;">
                                                                                        <p style="margin-bottom: 6px;">City Name :' . $getUserDetails['city_name'] . '</p>
                                                                                        <p style="margin-bottom: 6px;">Post Code : ' . $getUserDetails['post_code'] . '</p>
                                                                                        <p style="margin-bottom: 6px;">Street : ' . $getUserDetails['street'] . '</p>
                                                                                        <p style="margin-bottom: 6px;">Email : ' . $getUserDetails['email'] . '</p>
                                                                                        <h4 style="font-size: 20px; margin-top: 1.5em;">Bestelling:' . sprintf("%02d", $ord_stng['id']) . '</h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
																			<td width="40%">
																			
													&nbsp;
													<table class="normal-table table" style="width:100%;">
                                                    <tbody><tr></tr>
													</tbody></table>
													
																			</td>
                                                                            </td><td width="30%">
                                                                            <div class="">
                                            <div class="right-table">
                                               <h1 style="text-align: right;font-size: 18px;
    color: #2f788a;
    font-weight: 400;
    margin-bottom: 20px;">INVOICE / FACTUUR</h1>
                                               <h2 style="text-align: right;font-size: 16px;">Durafest BV</h2>
                                                <table class="normal-table table" style="width:100%;">
                                                    <tr>
                                                        <td style="line-height: 28px;">ADDRESS</td>
                                                        <td style="text-align: right;line-height: 28px;">Kwintijnpoort 106 9200 <br>Dendermonde Belgie</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 28px;">CONTACT DETAILS</td>
                                                        <td style="text-align: right;line-height: 28px;">koen@durafest.be<br>+32475.83.30.87</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 28px;">BTW NUMBER</td>
                                                        <td style="text-align: right;line-height: 28px;">BE 074.832.118</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 28px;">BANK IBAN BIC</td>
                                                        <td style="text-align: right;line-height: 28px;">Belfius <br>BE70 0689 0486 4325 GKCCBEBB </td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                        </td></tr></table>
                                        <div class="table-responsive">
                                        <table class="table table-striped table-inbox print-page mb-0" style="width:100%; border: 2px solid #3db8da;">
                                            <thead>
                                                <tr>
                                                    <th style="    border-bottom: 2px solid #3db8da;
    padding: 10px 12px;
    color: #fff;
    background: #3db8da;
    font-weight: 500;">Invoice Number</th>
                                                    <th style="    border-bottom: 2px solid #3db8da;
    padding: 10px 12px;
    color: #fff;
    background: #3db8da;
    font-weight: 500;">Invoice Date</th>
                                                    <th style="    border-bottom: 2px solid #3db8da;
    padding: 10px 12px;
    color: #fff;
    background: #3db8da;
    font-weight: 500;">VAT Number Client </th>
                                                    <th style="    border-bottom: 2px solid #3db8da;
    padding: 10px 12px;
    color: #fff;
    background: #3db8da;
    font-weight: 500;">Payment Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="line-height: 30px;">' . date('Y') . '/17' . sprintf("%02d", $ord_stng['id']) . '</td>
                                                    <td style="line-height: 30px;">' . date(('d/m/Y'), strtotime($ord_stng['created_at'])) . '</td>
                                                    <td style="line-height: 30px;"></td>
                                                    <td style="line-height: 30px;">' . date(('d/m/Y'), strtotime($ord_stng['created_at'] . ' +30 days')) . '</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>';

$html .= '<div class="table-responsive">
                                        <table class="table table-striped table-inbox print-page mb-0" style="width: 100%;border: 2px solid #3db8da;">
                                            <thead>
                                                <tr>
                                                   <th style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Artikel</th>
                                                                            <th style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Omschrijving</th>
                                                                            <th  style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Aantal</th>
                
                                                                            <th  style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Wasprijs/box</th>
                                                                            <th  style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Bedrag</th>
                                                                            
                                                </tr>
                                            </thead>
                                            <tbody style="    border: 2px solid #3db8da !important;">';
        $s_tot = floatval(0);


         foreach ($ord_items->result() as $row) {
            $html .= ' <tr>
                                                       
			
			
			<td style="    line-height: 30px;">' . $row->name . '</td>
            <td style="    line-height: 30px;">' . $row->sort_desc . '</td>
            <td style="    line-height: 30px;">' . $row->order_qty . '</td>
            <td style="    line-height: 30px;"> &#8364; ' .  number_format((float) $row->wash_prc, 2, ',', '') . '</td>
           
            <td>&#8364; ' .number_format(floatval($row->wash_prc * $row->order_qty), 2, ',', '');
            $s_tot += floatval($row->wash_prc * $row->order_qty). '</td>
			 </tr>';
        }
        $html .= '</tbody>
                                        </table>
                                    </div>';
        
        $html .= '<div class="right-table row">
                                        <div class="col-md-12 ">
                                           
                                            <table class="normal-table table mb-2" style="    width: 100%;">';
        if ($ord_stng['collection_by_profiwash_at_the_event'] != '') { 
         $html .= ' <tr>
                                                        <td style="    line-height: 30px;"><strong>Levering op evenement</strong></td>
                                                        <td style="text-align: right;line-height: 30px;">&#8364; '.number_format((float) $ord_stng['collection_by_profiwash_at_the_event'], 2, ',', '').'</td> </tr>';
        $s_tot += floatval($ord_stng['collection_by_profiwash_at_the_event']);
         }
         
         if ($ord_stng['return_to_address'] != '') {
         $html .= '<tr>
                                                        <td style="    line-height: 30px;"><strong>Levering via afhaalpunt</strong></td>
                                                        <td style="text-align: right;line-height: 30px;">&#8364;'.number_format((float) $ord_stng['return_to_address'], 2, ',', '').'</td></tr>';
         $s_tot += floatval($ord_stng['return_to_address']);
          }
          
          if ($ord_stng['collection_by_profiwash_at_collection_point'] != '') {
         $html .= '<tr>
                    <td style="    line-height: 30px;"><strong>Afhalen bij Durafest</strong></td>
                    <td style="text-align: right;line-height: 30px;">&#8364;'.number_format((float) $ord_stng['collection_by_profiwash_at_collection_point'], 2, ',', '').'</td></tr>';
         $s_tot += floatval($ord_stng['collection_by_profiwash_at_collection_point']);
          }
          
          
          if ($ord_stng['return_via_collection_point'] != '') {
         $html .= '<tr>
                    <td style="    line-height: 30px;"><strong>Ophalen op evenement</strong></td>
                    <td style="text-align: right; line-height: 30px;">&#8364;'.number_format((float) $ord_stng['return_via_collection_point'], 2, ',', '').'</td></tr>';
        $s_tot += floatval($ord_stng['return_via_collection_point']);
          }
          
          
          if ($ord_stng['delivery_to_profiwash'] != '') {
         $html .= '<tr>
                    <td style="    line-height: 30px;"><strong>Terugbrengen naar afhaalpunt</strong></td>
                    <td style="text-align: right; line-height: 30px;">&#8364;'.number_format((float) $ord_stng['delivery_to_profiwash'], 2, ',', '').'</td></tr>';
       $s_tot += floatval($ord_stng['delivery_to_profiwash']);
          }
         
          
          
          if ($ord_stng['pick_up_at_profiwash'] != '') {
         $html .= '<tr>
                    <td style="    line-height: 30px;"><strong>Terugbrengen naar Durafest</strong></td>
                    <td style="text-align: right;line-height: 30px;">&#8364;'.number_format((float) $ord_stng['pick_up_at_profiwash'], 2, ',', '').'</td></tr>';
          $s_tot += floatval($ord_stng['pick_up_at_profiwash']);
          }
          
          
          
         $html .= '<tr>
                                                    <td style="    line-height: 30px;">Subtotaal</td>
                                                    <td style="text-align: right;line-height: 30px;">&#8364; '. number_format((float) $s_tot, 2, ',', '').'</td>
                                                </tr>
                                                <tr>
                                                    <td style="    line-height: 30px;">BTW 21%</td>
                                                    <td style="text-align: right;line-height: 30px;">&#8364;  '.number_format(floatval((21 / 100) * $s_tot), 2, ',', '').'</td>
                                                </tr>
                                                <tr>
                                                    <td style="    line-height: 30px;">Totaal</td> 
                                                    <td style="text-align: right;line-height: 30px;">&#8364;  '. number_format(floatval($s_tot + ((21 / 100) * $s_tot)), 2, ',', '').'</td>
                                                </tr>';
          
         $html .= '</table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>';
        
//        echo $html;

      
        //echo $html;
        //die;
        $this->load->library('pdf');
        $this->dompdf->load_html($html);
        $this->dompdf->set_paper('A4', 'portrait');
        $this->dompdf->render();
        $opt = $this->dompdf->output();
        $filename = "Durafest Admin Dashboard.pdf";


// Output the generated PDF to Browser
        $this->dompdf->stream($filename);

        //$pdfroot = 'uploads/invoice/'.$filename;
        // file_put_contents($pdfroot, $opt);
    }


    public function downloadevent_invoice() {
	    $data = array();
        $id = $this->uri->segment(4);
	$ord_stng = $this->common_model->RetriveRecordByWhereRow('orders', array('id' => $id));

        $this->db->select('*');
        $this->db->from('order_items');
        $this->db->join('products', 'order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        $ord_items = $query;


        $getUserDetails = getUserDetailsById($ord_stng['user_id']);

        $html = '<style>'
                . 'h3
{
  border:1px solid black;
}
        a.bttn-green {
    margin-top: 40px;
}
a.bttn-green {
    width: 178px;
    height: 63px;
    border-radius: 5px;
    background: #67b930;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
}
.bttn-green {
    width: 308px;
    height: 63px;
    color: #fff;
    font-family: \'Poppins\', sans-serif;
    line-height: 63px;
    border-radius: 5px;
    background: #67b930;
    font-size: 20px;
    display: inline-block;
    border: 2px solid #67b930;
    font-weight: 600;
    box-shadow: -1px 3px 2px rgba(0, 0, 0, 0.10);
    margin: 15px 0 40px;
    text-transform: uppercase;
}
        .box-cards{
            background: #fff; padding: 15px;
        }
        .box-cards .right-table h1{
            font-size: 32px;
            color: #2f788a;
            font-weight: 400;
            margin-bottom: 20px;
        }
        .box-cards .right-table h2{
            font-size: 22px;
        }
        .box-cards .right-table .table.normal-table tbody td{
            text-align: left; font-size: 15px; color: #10242b;
            font-weight: 300; padding: 8px 10px; border-top: 0;
        }
        .box-cards .right-table .table.normal-table tbody td:first-child{
            font-weight: 500;
        }
        .box-cards .right-table .table.normal-table tbody td:last-child{
            text-align: right;
        }
        .raaddress{
            padding: 15px;
            background: #f7f7f7;
            width: 100%;
            box-sizing: border-box;
            margin: 30px;
        }
        .raaddress p{ margin-bottom: 6px;}
        .raaddress h4{ font-size: 20px; margin-top: 1.5em;}
        </style>';
       $html .= '<div class="cart-sec" id="content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="background: #fff; padding: 15px;> 
                                                            <div class="row">
                                                                <table class="table table-striped table-inbox print-page mb-0" width="100%" ><tr><td width="30%">						
                                                                                    <div class="">
                                                                                <div class="left-table">
                                                                                    <img src="' . base_url() . 'assets/invoice_logo.jpg" alt="">
                                                                                    <div style="padding: 15px;
                                                                                         background: #f7f7f7;
                                                                                       
                                                                                         box-sizing: border-box;
                                                                                         margin: 30px;">
                                                                                        <p style="margin-bottom: 6px;">City Name :' . $getUserDetails['city_name'] . '</p>
                                                                                        <p style="margin-bottom: 6px;">Post Code : ' . $getUserDetails['post_code'] . '</p>
                                                                                        <p style="margin-bottom: 6px;">Street : ' . $getUserDetails['street'] . '</p>
                                                                                        <p style="margin-bottom: 6px;">Email : ' . $getUserDetails['email'] . '</p>
                                                                                        <h4 style="font-size: 20px; margin-top: 1.5em;">Bestelling:' . sprintf("%02d", $ord_stng['id']) . '</h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </td>
																			<td width="40%">
																			<table class="normal-table table" style="width:100%;">
                                                    <tr>
													&nbsp;
													</tr>
													</table>
													
																			</td>
																			
																			<td width="30%">
                                                                            <div class="">
                                            <div class="right-table">
											
                                                <h1 style="text-align: right;font-size: 18px;
    color: #2f788a;
    font-weight: 400;
    margin-bottom: 20px;">INVOICE / FACTUUR</h1>
                                                <h2 style="text-align: right;font-size: 16px;">Durafest BV</h2>
                                                <table class="normal-table table" style="width:100%;">
                                                    <tr>
                                                        <td style="line-height: 28px;">ADDRESS</td>
                                                        <td style="text-align: right;line-height: 28px;">Kwintijnpoort 106 9200 <br>Dendermonde Belgie</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 28px;">CONTACT DETAILS</td>
                                                        <td style="text-align: right;line-height: 28px;">koen@durafest.be<br>+32475.83.30.87</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 28px;">BTW NUMBER</td>
                                                        <td style="text-align: right;line-height: 28px;">BE 074.832.118</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 28px;">BANK IBAN BIC</td>
                                                        <td style="text-align: right;line-height: 28px;">Belfius <br>BE70 0689 0486 4325 GKCCBEBB </td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                        </td></tr></table>
                                        <div class="table-responsive">
                                        <table class="table table-striped table-inbox print-page mb-0" style="width:100%; border: 2px solid #3db8da;">
                                            <thead>
                                                <tr>
                                                    <th style="    border-bottom: 2px solid #3db8da;
    padding: 10px 12px;
    color: #fff;
    background: #3db8da;
    font-weight: 500;">Invoice Number</th>
                                                    <th style="    border-bottom: 2px solid #3db8da;
    padding: 10px 12px;
    color: #fff;
    background: #3db8da;
    font-weight: 500;">Invoice Date</th>
                                                    <th style="    border-bottom: 2px solid #3db8da;
    padding: 10px 12px;
    color: #fff;
    background: #3db8da;
    font-weight: 500;">VAT Number Client </th>
                                                    <th style="    border-bottom: 2px solid #3db8da;
    padding: 10px 12px;
    color: #fff;
    background: #3db8da;
    font-weight: 500;">Payment Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="line-height: 30px;">' . date('Y') . '/17' . sprintf("%02d", $ord_stng['id']) . '</td>
                                                    <td style="line-height: 30px;">' . date(('d/m/Y'), strtotime($ord_stng['created_at'])) . '</td>
                                                    <td style="line-height: 30px;"></td>
                                                    <td style="line-height: 30px;">' . date(('d/m/Y'), strtotime($ord_stng['created_at'] . ' +30 days')) . '</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>';



        $html .= '<div class="table-responsive">
                                        <table class="table table-striped table-inbox print-page mb-0" style="width:100%; border: 2px solid #3db8da;">
                                            <thead>
                                                <tr>
                                                   <th style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Artikel</th>
                                                                            <th style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Omschrijving</th>
                                                                            <th  style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Aantal</th>
                                                                            <th  style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Huurprijs/box</th>
                                                                            <th  style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Wasprijs/box</th>
                                                                            <th  style="border-bottom: 2px solid #3db8da; padding: 10px 12px; color: #fff; background: #3db8da; font-weight: 500;">Bedrag</th>
                                                                            
                                                </tr>
                                            </thead>
                                            <tbody>';
        $s_tot = floatval(0);
        foreach ($ord_items->result() as $row) {
            $html .= ' <tr>
                                                       
			
			
			<td style="    line-height: 30px;">' . $row->name . '</td>
            <td style="    line-height: 30px;">' . $row->sort_desc . '</td>
            <td style="    line-height: 30px;">' . $row->order_qty . '</td>
            <td style="    line-height: 30px;"> &#8364; ' .  number_format((float) $row->box_prc, 2, ',', '') . '</td>
            <td style="    line-height: 30px;">&#8364; ' . number_format((float) $row->wash_prc, 2, ',', ''). '</td>
            <td style="    line-height: 30px;">&#8364; ' .number_format(floatval(($row->box_prc * $row->order_qty) + ($row->used_cups * $row->wash_prc ) + ($row->lost_cup * $row->loss_prc )), 2, ',', '');
                                                            $s_tot += floatval(($row->box_prc * $row->order_qty) + ($row->used_cups * $row->wash_prc ) + ($row->lost_cup * $row->loss_prc )). '</td>
			
			
			
			
                                                      
                                                    </tr>';
        }
        $html .= '</tbody>
                                        </table>
                                    </div>';
        
        $html .= '<div class="right-table row">
                                        <div class="col-md-12 ">
                                           
                                            <table class="normal-table table mb-2" style="    width: 100%;">';
        if ($ord_stng['collection_by_profiwash_at_the_event'] != '') { 
         $html .= ' <tr>
                                                        <td style="line-height: 30px;"><strong>Levering op evenement</strong></td>
                                                        <td style="text-align: right;line-height: 30px;">&#8364; '.number_format((float) $ord_stng['collection_by_profiwash_at_the_event'], 2, ',', '').'</td> </tr>';
         $s_tot += floatval($ord_stng['collection_by_profiwash_at_the_event']);
         }
         
         if ($ord_stng['return_to_address'] != '') {
         $html .= '<tr>
                                                        <td style="line-height: 30px;"><strong>Levering via afhaalpunt</strong></td>
                                                        <td style="text-align: right;line-height: 30px;">&#8364;'.number_format((float) $ord_stng['return_to_address'], 2, ',', '').'</td></tr>';
         $s_tot += floatval($ord_stng['return_to_address']);
          }
          
          if ($ord_stng['collection_by_profiwash_at_collection_point'] != '') {
         $html .= '<tr>
                    <td style="line-height: 30px;"><strong>Afhalen bij Durafest</strong></td>
                    <td style="text-align: right;line-height: 30px;">&#8364;'.number_format((float) $ord_stng['collection_by_profiwash_at_collection_point'], 2, ',', '').'</td></tr>';
         $s_tot += floatval($ord_stng['collection_by_profiwash_at_collection_point']);
          }
          
          
          if ($ord_stng['return_via_collection_point'] != '') {
         $html .= '<tr>
                    <td style="line-height: 30px;"><strong>Ophalen op evenement</strong></td>
                    <td style="text-align: right;line-height: 30px;">&#8364;'.number_format((float) $ord_stng['return_via_collection_point'], 2, ',', '').'</td></tr>';
         $s_tot += floatval($ord_stng['return_via_collection_point']);
          }
          
          
          if ($ord_stng['delivery_to_profiwash'] != '') {
         $html .= '<tr>
                    <td style="line-height: 30px;"><strong>Terugbrengen naar afhaalpunt</strong></td>
                    <td style="text-align: right;line-height: 30px;">&#8364;'.number_format((float) $ord_stng['delivery_to_profiwash'], 2, ',', '').'</td></tr>';
         $s_tot += floatval($ord_stng['delivery_to_profiwash']);
          }
         
          
          
          if ($ord_stng['pick_up_at_profiwash'] != '') {
         $html .= '<tr>
                    <td style="line-height: 30px;"><strong>Terugbrengen naar Durafest</strong></td>
                    <td style="text-align: right;line-height: 30px;">&#8364;'.number_format((float) $ord_stng['pick_up_at_profiwash'], 2, ',', '').'</td></tr>';
         $s_tot += floatval($ord_stng['pick_up_at_profiwash']);
          }
          
          
          
         $html .= '<tr>
                                                    <td style="line-height: 30px;">Subtotaal</td>
                                                    <td style="text-align: right;line-height: 30px;">&#8364; '. number_format((float) $s_tot, 2, ',', '').'</td>
                                                </tr>
                                                <tr>
                                                    <td style="line-height: 30px;">BTW 21%</td>
                                                    <td style="text-align: right;line-height: 30px;">&#8364;  '.number_format(floatval((21 / 100) * $s_tot), 2, ',', '').'</td>
                                                </tr>
                                                <tr>
                                                    <td style="line-height: 30px;">Totaal</td> 
                                                    <td style="text-align: right;line-height: 30px;">&#8364;  '. number_format(floatval($s_tot + ((21 / 100) * $s_tot)), 2, ',', '').'</td>
                                                </tr>';
          
         $html .= '</table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>';
          
          
          
//        echo $html;
       // echo $html;
        //die;



        $this->load->library('pdf');
        $this->dompdf->load_html($html);
        $this->dompdf->set_paper('A3', 'portrait');
        $this->dompdf->render();
        $opt = $this->dompdf->output();
        $filename = "Durafest_Invoice.pdf";


// Output the generated PDF to Browser
        $this->dompdf->stream($filename);

        //$pdfroot = 'uploads/invoice/'.$filename;
        // file_put_contents($pdfroot, $opt);
    }


}
