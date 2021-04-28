<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }

    public function index() {
        $data = array();


//        $data['query'] = $this->db->select('*','MONTH(CAST(event_start_date AS datetime))')->from('orders')->order_by('MONTH(CAST(event_start_date AS datetime))','asc')->get();


        $this->load->view('dashboard', $data);
    }

    public function settings() {
        $data = array();
        if ($_POST) {
            foreach ($_POST['settings_name'] as $key => $row) {
                $getData['settings_value'] = $row;

                $this->common_model->UpdateRecord($getData, 'ds_settings', 'id', $key);
            }
            if ($_FILES['header_logo']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['header_logo']['name'], PATHINFO_EXTENSION));
                $target_dir = "uploads/";
                $file_name = time() . '_header_logo.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["header_logo"]["tmp_name"], $target_file);

                $getData['settings_value'] = $file_name;
                $this->common_model->UpdateRecord($getData, 'ds_settings', 'settings_name', 'header_logo');
            }

            if ($_FILES['footer_logo']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['footer_logo']['name'], PATHINFO_EXTENSION));
                $target_dir = "uploads/";
                $file_name = time() . '_footer_logo.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["footer_logo"]["tmp_name"], $target_file);

                $getData['settings_value'] = $file_name;
                $this->common_model->UpdateRecord($getData, 'ds_settings', 'settings_name', 'footer_logo');
            }
//            print_r($getData);
//exit();
            $message = '<div class="alert alert-success"><p>Successfully updated.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/dashboard/settings');
        }
        $data['query'] = $this->common_model->RetriveRecordByWhere('ds_settings', array());
        $this->load->view('settings', $data);
    }

    public function footer_service_settings() {
        $data = array();
        if ($_POST) {
            $getData = array(
                'service_heading_1' => $this->input->post('service_heading_1'),
                'service_content_1' => $this->input->post('service_content_1'),
                'service_heading_2' => $this->input->post('service_heading_2'),
                'service_content_2' => $this->input->post('service_content_2'),
                'service_heading_3' => $this->input->post('service_heading_3'),
                'service_content_3' => $this->input->post('service_content_3'),
            );


            if ($_FILES['service_image_1']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['service_image_1']['name'], PATHINFO_EXTENSION));
                $target_dir = "uploads/cms/";
                $file_name = time() . '_service_image_1.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["service_image_1"]["tmp_name"], $target_file);

                $getData['service_image_1'] = $file_name;
            }

            if ($_FILES['service_image_2']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['service_image_2']['name'], PATHINFO_EXTENSION));
                $target_dir = "uploads/cms/";
                $file_name = time() . '_service_image_2.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["service_image_2"]["tmp_name"], $target_file);

                $getData['service_image_2'] = $file_name;
            }
            if ($_FILES['service_image_3']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['service_image_1']['name'], PATHINFO_EXTENSION));
                $target_dir = "uploads/cms/";
                $file_name = time() . '_service_image_3.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["service_image_3"]["tmp_name"], $target_file);

                $getData['service_image_3'] = $file_name;
            }


            $this->common_model->UpdateRecord($getData, 'ds_footer_service_settings', 'id', '1');
            $message = '<div class="alert alert-success"><p>Successfully updated.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/dashboard/footer_service_settings');
        }

        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_footer_service_settings', array('id' => '1'));
        $this->load->view('footer_service_settings', $data);
    }

    public function profile() {
        $data = array();

        if ($_POST) {
            $id = $this->input->post("id");
            $data['fname'] = $this->input->post("fname");
            $data['lname'] = $this->input->post("lname");
            $data['email'] = $this->input->post("email");
            if ($this->input->post("password") != '') {
                $data['password'] = md5($this->input->post("password"));
            } else {
                $data['password'] = $this->input->post("old_password");
            }


            $this->common_model->UpdateRecord($data, 'users', 'id', $id);
            $message = '<div class="alert alert-success"><p>Successfully updated.</p></div>';
            $this->session->set_flashdata('success', $message);
        }

        $data['query'] = $this->common_model->get_all_record('users', array('id' => $this->session->userdata('ADMIN_ID')));
        $this->load->view('my_profile', $data);
    }

}
