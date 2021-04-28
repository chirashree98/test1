<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_management extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }

    public function all_membership() {
        $this->db->select('ds_membership.*,user_type_name,frequency_payment_name');
        $this->db->from('ds_membership'); 
        $this->db->join('ds_user_types', 'ds_membership.user_type=ds_user_types.id', 'left');
        $this->db->join('ds_frequency_of_payment', 'ds_membership.frequency_of_payment_id=ds_frequency_of_payment.id', 'left');
        //$this->db->order_by('ds_membership.id', 'DESC');
        $data['query'] = $this->db->get();

        // $this->db->select('*');
        // $this->db->from('ds_membership m'); 
        // $this->db->join('Category b', 'b.cat_id=a.cat_id', 'left');
        // $this->db->join('Soundtrack c', 'c.album_id=a.album_id', 'left');
        // $this->db->where('c.album_id',$id);
        // $this->db->order_by('c.track_title','asc');         
        // $query = $this->db->get(); 
        $this->load->view('membership/all-membership', $data);
    }

    public function add_membership() {
        $data = array();
        //get user name
        $this->db->select('ds_user_types.*');
        $this->db->from('ds_user_types'); 
        $this->db->where('for_membership =', 1);
        $data['user_type'] = $this->db->get();
        // get frequency of payment
        $this->db->select('ds_frequency_of_payment.*');
        $this->db->from('ds_frequency_of_payment'); 
        $data['payment'] = $this->db->get();
    
        $this->load->view('membership/add-membership', $data);
    }

    public function save_membership() {
        $data = array();
        $getData = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'frequency_of_payment_id' => $this->input->post('frequency_of_payment_id'),
            'user_type' => $this->input->post('user_type'),
            'description' => $this->input->post('description'),
        );
       

        $this->common_model->AddRecord($getData, 'membership');
        $message = '<div class="alert alert-success"><p>Membership has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/membership_management/all_membership');
    }

    public function edit_membership() {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('membership', array('id' => $id));
        $this->db->select('ds_user_types.*');
        $this->db->from('ds_user_types'); 
        $this->db->where('for_membership =', 1);
        $data['user_type'] = $this->db->get();

        // get frequency of payment
        $this->db->select('ds_frequency_of_payment.*');
        $this->db->from('ds_frequency_of_payment'); 
        $data['payment'] = $this->db->get();

        $this->load->view('membership/edit-membership', $data);
    }

    public function update_membership() {
//        print_r($_POST);exit();
        $id = $this->input->post("id");
        $data = array();
        $getData = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'frequency_of_payment_id' => $this->input->post('frequency_of_payment_id'),
            'user_type' => $this->input->post('user_type'),
            'description' => $this->input->post('description'),
        );
        
        $getData['updated_at'] = date('Y-m-d h:m:s');

        $this->common_model->UpdateRecord($getData, 'membership', 'id', $id);
        $message = '<div class="alert alert-success"><p>membership has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/membership_management/all_membership');
    }

    public function delete_membership() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('membership', $id, 'id');
        $message = '<div class="alert alert-success"><p>Membership has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/membership_management/all_membership');
    }

    // public function change_product_status() {

    //     $data = array();
    //     $id = $this->input->post('id');
    //     $value = $this->input->post('val');
    //     $save_data['p_status'] = $value;
    //     $this->common_model->UpdateRecord($save_data, 'products', 'p_id', $id);
    //     echo 'ok';
    // }

    // public function order_page_product() {
    //     $data = array();
    //     if ($_POST) {
    //         $data = array();
    //         $getData = array(
    //             'collection_by_profiwash_at_the_event' => $this->input->post('collection_by_profiwash_at_the_event'),
    //             'return_to_address' => $this->input->post('return_to_address'),
    //             'collection_by_profiwash_at_collection_point ' => $this->input->post('collection_by_profiwash_at_collection_point'),
    //             'return_via_collection_point' => $this->input->post('return_via_collection_point'),
    //             'delivery_to_profiwash' => $this->input->post('delivery_to_profiwash'),
    //             'pick_up_at_profiwash' => $this->input->post('pick_up_at_profiwash'),
    //             'terms_and_con' => json_encode($_POST['terms_and_con']),
    //         );

    //         $getData['updated_at'] = date('Y-m-d h:m:s');

    //         $this->common_model->UpdateRecord($getData, 'order_page_settings', 'id', '1');
    //         $message = '<div class="alert alert-success"><p>Successfully updated.</p></div>';
    //         $this->session->set_flashdata('success', $message);
    //         redirect('admin/product_management/order_page_product');
    //     }
    //     $data['query'] = $this->common_model->RetriveRecordByWhereRow('order_page_settings', array('id' => '1'));
    //     $this->load->view('product/order-page-settings', $data);
    // }

}
