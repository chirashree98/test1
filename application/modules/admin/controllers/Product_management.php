<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_management extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }

    public function all_product() {
        $this->db->select('ds_products.*,ds_category.name as cat_name');
        $this->db->from('ds_products');
        
        $this->db->Join('ds_category', 'ds_products.cat_id = ds_category.id', 'left');
        $this->db->order_by('products.p_id', 'DESC');
        $data['query'] = $this->db->get();
//        print_R($data['query']);
//        exit();
        $this->load->view('product/all-product', $data);
    }

    public function add_product() {
        $data = array();
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 6,'is_approved' => '1'));
        $data['category'] = $this->common_model->RetriveRecordByWhere('ds_category', array());
        $data['parent_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0, 'status' => 'Y'));
        $data['child_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('status' => 'Y'));
        $data['attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array());
        $data['products'] = $this->common_model->RetriveRecordByWhere('ds_products', array());
        

        $this->load->view('product/add-product', $data);
    }

    public function save_product() {
        $data = array();
        $attribute = $this->input->post('attribute');
        $getData = array(
           
            
            
            'name' => $this->input->post('name'),
           
            'sell_price' => $this->input->post('sell_price'),
            'related_product'=>json_encode($this->input->post('related_product'), true),
            'store_details' => $this->input->post('store_details'),
			'long_description'=>$this->input->post('long_description'),
            'cat_id' => $this->input->post('cat_id'),
            'sub_cat_id' => $this->input->post('sub_cat_id'),
            'is_featured' => $this->input->post('is_featured'),
            'is_cancellation' => $this->input->post('is_cancellation')=='Y'?'Y':'N',
            'details' => $this->input->post('details'),
            'extra_desc' => $this->input->post('extra_desc'),
            'sku' => $this->input->post('sku'),
            'qty' => $this->input->post('qty'),
            'attribute' => json_encode($attribute),
        );

        if ($_FILES['image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/product/";
            $file_name = time() . '_product_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $getData['image'] = $file_name;
        }
        for ($i = 0; $i < count($_FILES['extra_images']); $i++) {
            if ($_FILES['extra_images']['name'][$i] != '') {
                $ext = strtolower(pathinfo($_FILES['extra_images']['name'][$i], PATHINFO_EXTENSION));
                $target_dir = "uploads/product/";
                $file_name = time() . '_' . $i . '_product_image.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["extra_images"]["tmp_name"][$i], $target_file);

                $images[] = $file_name;
            }
        }
        $getData['extra_images'] = json_encode($images);

//        echo "<pre>";
//print_r($getData);
//exit();
        $this->common_model->AddRecord($getData, 'ds_products');
        $lstid = $this->db->insert_id();
        for ($i = 0; $i < count($attribute); $i++) {
            $getAttrData = array(
                'p_id' => $lstid,
                'attr_id' => $attribute[$i],
            );
            $this->common_model->AddRecord($getAttrData, 'ds_product_items');
        }


        $message = '<div class="alert alert-success"><p>Products has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/product_management/all_product');
    }

    public function edit_product() {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_products', array('p_id' => $id));
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 6,'is_approved' => '1'));
        $data['category'] = $this->common_model->RetriveRecordByWhere('ds_category', array());
        $data['sub_category'] = $this->common_model->RetriveRecordByWhere('ds_sub_category', array('category_id' => $data['query']['cat_id']));
        $data['parent_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0, 'status' => 'Y'));
        $data['child_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('status' => 'Y'));
        $data['attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array());
        $data['products'] = $this->common_model->RetriveRecordByWhere('ds_products', array('p_id !=' => $id));

        $this->load->view('product/edit-product', $data);
    }

    public function update_product() {
//        echo "<pre>";print_r($_POST);
//        exit();
        $id = $this->input->post("p_id");
        $data = array();
        $attribute = $this->input->post('attribute');
        $getData = array(
            
            'name' => $this->input->post('name'),
            
            'sell_price' => $this->input->post('sell_price'),
            'cat_id' => $this->input->post('cat_id'),
            'sub_cat_id' => $this->input->post('sub_cat_id'),
            'is_featured' => $this->input->post('is_featured'),
            'is_cancellation' => $this->input->post('is_cancellation')=='Y'?'Y':'N',
            'details' => $this->input->post('details'),
            'extra_desc' => $this->input->post('extra_desc'),
			'long_description'=>$this->input->post('long_description'),
            'sku' => $this->input->post('sku'),
            'qty' => $this->input->post('qty'),
            'attribute' => json_encode($attribute),
            'related_product'=>json_encode($this->input->post('related_product'), true),
            'store_details' => $this->input->post('store_details'),
        );

        if ($_FILES['image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/product/";
            $file_name = time() . '_product_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $getData['image'] = $file_name;
        }
        for ($i = 0; $i < count($_POST['old_extra_images']); $i++) {
            $images[] = $_POST['old_extra_images'][$i];
        }
        for ($i = 0; $i < count($_FILES['extra_images']); $i++) {
            if ($_FILES['extra_images']['name'][$i] != '') {
                $ext = strtolower(pathinfo($_FILES['extra_images']['name'][$i], PATHINFO_EXTENSION));
                $target_dir = "uploads/product/";
                $file_name = time() . '_' . $i . '_product_image.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["extra_images"]["tmp_name"][$i], $target_file);

                $images[] = $file_name;
            }
        }
        $getData['extra_images'] = json_encode($images);
//        echo "<pre>";
//print_r($getData);
//exit();

        $this->common_model->UpdateRecord($getData, 'ds_products', 'p_id', $id);
        $this->common_model->Delete('ds_product_items', $id, 'p_id');
        for ($i = 0; $i < count($attribute); $i++) {
            $getAttrData = array(
                'p_id' => $id,
                'attr_id' => $attribute[$i],
            );
            $this->common_model->AddRecord($getAttrData, 'ds_product_items');
        }
        $message = '<div class="alert alert-success"><p>Products has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/product_management/all_product');
    }

    public function delete_product() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('products', $id, 'p_id');
        $message = '<div class="alert alert-success"><p>Products has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/product_management/all_product');
    }

    public function change_product_status() {

        $data = array();
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $save_data['p_status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'products', 'p_id', $id);
        echo 'ok';
    }

    public function get_sub_category() {
        $data = array();

        $sub_category = $this->common_model->RetriveRecordByWhere('ds_sub_category', array('category_id' => $_POST['c_id']));
        $sub_cat = '';
        if ($sub_category->num_rows() > 0) {
            foreach ($sub_category->result() as $row) {
                $sub_cat .= ' <option value="' . $row->id . '">' . $row->sub_category_name . '</option>';
            }
        } else {
            $sub_cat .= ' <option value="0">No Sub Category found</option>';
        }
        echo $sub_cat;
    }

    public function all_attribute() {
        $this->db->select('ds_products_attribute.* ,pp.attr_name as parent_attr_name');
        $this->db->from('ds_products_attribute');
        $this->db->Join('ds_products_attribute as pp', 'ds_products_attribute.parent_id = pp.id', 'left');
        $this->db->order_by('ds_products_attribute.id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('product/all-attribute', $data);
    }

    public function add_attribute() {
        $data = array();
        if ($_POST) {
            $getData = array(
                'parent_id' => $this->input->post('parent_id'),
                'attr_name' => $this->input->post('attr_name'),
            );
            $this->common_model->AddRecord($getData, 'ds_products_attribute');
            $message = '<div class="alert alert-success"><p>Attribute has been successfully added.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/product_management/all_attribute');
        }

        $data['parent_attr'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0));
        $this->load->view('product/add-attribute', $data);
    }

    public function edit_attribute() {
        $data = array();
        $id = $this->uri->segment(4);
        if ($_POST) {
            $getData = array(
                'parent_id' => $this->input->post('parent_id'),
                'attr_name' => $this->input->post('attr_name'),
            );
            $this->common_model->UpdateRecord($getData, 'ds_products_attribute', 'id', $id);
            $message = '<div class="alert alert-success"><p>Attribute has been successfully updated.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/product_management/all_attribute');
        }
        $data['parent_attr'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0));
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_products_attribute', array('id' => $id));
        $this->load->view('product/edit-attribute', $data);
    }

    public function delete_attribute() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('ds_products_attribute', $id, 'id');
        $message = '<div class="alert alert-success"><p>Attribute has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/product_management/all_attribute');
    }

    public function change_attribute_status() {
        $data = array();
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $save_data['status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'ds_products_attribute', 'id', $id);
        echo 'ok';
    }

}
