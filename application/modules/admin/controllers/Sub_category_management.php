<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_category_management extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }

    public function all_sub_category() {
        $this->db->select('ds_sub_category.*,name');
        $this->db->from('ds_sub_category'); 
        $this->db->join('ds_category', 'ds_sub_category.category_id=ds_category.id');
        //$this->db->order_by('ds_sub_category.id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('sub-category/all-sub-category', $data);
    }

    public function add_sub_category() {
        $data = array();
        $this->db->select('ds_category.*');
        $this->db->from('ds_category'); 
        $data['query'] = $this->db->get();
    
       //$query = $this->db->query('SELECT id,user_type_name FROM ds_user_types');
      // $data['user_type']= $query->result();
      //  print_r($data['user_type']);die;
        $this->load->view('sub-category/add-sub-category', $data);
    }

    public function save_sub_category() {
        $data = array();
        $getData = array(
            'sub_category_name' => $this->input->post('sub_category_name'),
            'category_id' => $this->input->post('category_id'),

        );
       

        $this->common_model->AddRecord($getData, 'sub_category');
        $message = '<div class="alert alert-success"><p>Sub category has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/sub_category_management/all_sub_category');
    }

    public function edit_sub_category() {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('sub_category', array('id' => $id));
        $this->db->select('ds_category.*');
        $this->db->from('ds_category'); 
        $data['category'] = $this->db->get();
        $this->load->view('sub-category/edit-sub-category', $data);
    }

    public function update_sub_category() {
//        print_r($_POST);exit();
        $id = $this->input->post("id");
        $data = array();
        $getData = array(
            'sub_category_name' => $this->input->post('sub_category_name'),
            'category_id' => $this->input->post('category_id'),

        );
        
        $getData['updated_at'] = date('Y-m-d h:m:s');

        $this->common_model->UpdateRecord($getData, 'sub_category', 'id', $id);
        $message = '<div class="alert alert-success"><p>Sub category has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/sub_category_management/all_sub_category');
    }

    public function delete_sub_category() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('sub_category', $id, 'id');
        $message = '<div class="alert alert-success"><p>Sub category has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/sub_category_management/all_sub_category');
    }


}
