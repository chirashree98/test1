<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_management extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }
 
    

    public function all_customer()
    {
        $this->db->select('*,ds_users.id as user_id');
        $this->db->from('ds_users');
        
        $this->db->Join('ds_country', 'ds_users.country_id = ds_country.id');
        $this->db->where('ds_users.role_id', '6');
        $this->db->order_by('ds_users.id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('user/all-customer', $data);
    }
	 public function all_order()
    {
        $this->db->select('ds_order_items.*,ds_users_address.*,ds_temp_cart.*,ds_products.name as pname,ds_products.p_id,ds_temp_cart.p_id aspid');
        $this->db->from('ds_order_items');
        //$this->db->Join('ds_country', 'ds_users_address.country_id = ds_country.id');
        $this->db->Join('ds_users_address', 'ds_order_items.order_id = ds_users_address.id');
		$this->db->Join('ds_products', 'ds_products.p_id = ds_temp_cart.pid');
		$this->db->Join('ds_temp_cart', 'ds_temp_cart.id = ds_order_items.id');
		 //$this->db->Join('ds_users', 'ds_users.id = ds_users_address.user_id');
      
        //$this->db->order_by('ds_users.id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('user/orderlist', $data);
    }

  
}
