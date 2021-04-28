<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib', 'google', 'facebook'));
        $this->load->model(array('common_model', 'custom_model', 'user_model'));
    }

    public function allProduct() {
        if ($this->session->userdata('USER_ID') == '') {
            redirect('/login');
        }

        $data = array();
        $data['active_products'] = 'active';
        $data['cities'] = $this->common_model->RetriveRecordByWhere('users', array('usertype' => 'City', 'u_status' => 'Y'));
        $data['query'] = $this->common_model->RetriveRecordByWhere('products', array('p_status' => 'Y'));
        $data['ord_stng'] = $this->common_model->RetriveRecordByWhereRow('order_page_settings', array('id' => '1'));
        $this->load->view('product/all-product', $data);
    }

    public function invoice() {
        if ($this->session->userdata('USER_ID') == '') {
            redirect('/login');
        }
        $data = array();
        $id = $this->uri->segment(3);
        if ($id == '') {
            redirect('/user/products');
        }
        $data['ord_stng'] = $this->common_model->RetriveRecordByWhereRow('orders', array('id' => $id));

        $this->db->select('*');
        $this->db->from('order_items');
        $this->db->join('products', 'order_items.order_p_id = products.p_id');
        $this->db->where(array('order_id' => $id));
        $query = $this->db->get();
        $data['ord_items'] = $query;
        $this->load->view('product/invoice', $data);
    }

    public function populateCart() {
        $data = array();
        $data['val'] = $_POST;

        $this->load->view('product/cart-section', $data);
    }

    public function submitCart() {
//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('u_id' => $this->session->userdata('USER_ID')));
        $query = $this->db->get();
        $row = $query->row();

        $this->db->select('association')->from('verenigings')->where(array('v_id' => $row->association));
        $query2 = $this->db->get();
        $row2 = $query2->row();
        $this->session->set_userdata('USER_TYPE_NAME', $row2->association);


        $getData = array(
            'user_id' => $this->session->userdata('USER_ID'),
            'association_name' => $this->session->userdata('USER_TYPE_NAME') ? $this->session->userdata('USER_TYPE_NAME') : $row2->association,
            'event_name' => $this->input->post('event_name'),
            'number_of_visitor' => $this->input->post('number_of_visitor'),
            'cups_per_visitor' => $this->input->post('cups_per_visitor'),
            'number_of_bar' => $this->input->post('number_of_bar'),
            'postcode' => $this->input->post('postcode'),
            'street' => $this->input->post('street'),
            'number' => $this->input->post('number'),
            'event_date' => $this->input->post('event_date'),
            'collection_by_profiwash_at_the_event' => $this->input->post('collection_by_profiwash_at_the_event') ? $this->input->post('collection_by_profiwash_at_the_event') : '',
            'return_to_address' => $this->input->post('return_to_address') ? $this->input->post('return_to_address') : '',
            'collection_by_profiwash_at_collection_point' => $this->input->post('collection_by_profiwash_at_collection_point') ? $this->input->post('collection_by_profiwash_at_collection_point') : '',
            'return_via_collection_point' => $this->input->post('return_via_collection_point') ? $this->input->post('return_via_collection_point') : '',
            'delivery_to_profiwash' => $this->input->post('delivery_to_profiwash') ? $this->input->post('delivery_to_profiwash') : '',
            'pick_up_at_profiwash' => $this->input->post('pick_up_at_profiwash') ? $this->input->post('pick_up_at_profiwash') : '',
            'sub_total' => $this->input->post('sub_total'),
            'tax' => $this->input->post('tax'),
            'total' => $this->input->post('total'),
            'products' => json_encode($this->input->post('products')),
        );

        $this->common_model->AddRecord($getData, 'orders');
        $last_id = $this->db->insert_id();
        foreach ($_POST['products'] as $key => $value) {
            $p_items = array(
                'order_id' => $last_id,
                'order_p_id' => $key,
                'order_qty' => $value,
            );

            $this->common_model->AddRecord($p_items, 'order_items');
        }
        $inbox_msg = array(
            'to_u_id' => $this->session->userdata('USER_ID'),
            'created_u_id' => '1',
            'created_by' => 'Admin',
            'message' => 'Hi, You have successfully requested for your event. Your request id is ' . $last_id . '. We will get back to you soon.',
        );
        $this->common_model->AddRecord($inbox_msg, 'inbox');

        redirect('/user/invoice/' . $last_id);
    }

}
