<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_management extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }

    public function all_category() {
        $this->db->select('ds_category.*');
        $this->db->from('ds_category'); 
        $this->db->order_by('ds_category.id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('category/all-category', $data);
    }

    public function add_category() {
        $data = array();
        $this->load->view('category/add-category', $data);
    }
	 public function change_category_status() {

        $data = array();
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $save_data['status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'ds_category', 'id', $id);
        echo 'ok';
    }

    public function save_category() {

        $data = array();
        $getData = array(
            'name' => $this->input->post('name'),
            
        );
        $getData['updated_at'] = date('Y-m-d h:m:s');

        $this->common_model->AddRecord($getData, 'category');
        $message = '<div class="alert alert-success"><p>Category has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/category_management/all_category');
    }

    public function edit_category() {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('category', array('id' => $id));
        $this->load->view('category/edit-category', $data);
    }

    public function update_category() {
//        print_r($_POST);exit();
        $id = $this->input->post("id");
        $data = array();
        $getData = array(
            'name' => $this->input->post('name'),
           
        );
        
        $getData['updated_at'] = date('Y-m-d h:m:s');

        $this->common_model->UpdateRecord($getData, 'category', 'id', $id);
        $message = '<div class="alert alert-success"><p>Category has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/category_management/all_category');
    }

    public function delete_category() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('category', $id, 'id');
        $message = '<div class="alert alert-success"><p>Category has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/category_management/all_category');
    }

   
}
