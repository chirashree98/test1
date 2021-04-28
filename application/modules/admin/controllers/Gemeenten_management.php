<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gemeenten_management extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }

    public function all_gemeenten() {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->where(array('usertype' => 'City'));
        $this->db->order_by('users.u_id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('gemeenten/all-gemeenten', $data);
    }

    public function add_gemeenten() {
        $data = array();
        $this->load->view('gemeenten/add-gemeenten', $data);
    }

    public function save_gemeenten() {
        $data = array();
        $getData = array(
            'city_name' => $this->input->post('city_name'),
            'post_code' => $this->input->post('post_code'),
            'street' => $this->input->post('street'),
            'number' => $this->input->post('number'),
            'email' => $this->input->post('login_email'),
            'password' => md5($this->input->post('login_password')),
            'usertype' => 'City',
            'added_by' => 'Admin',
            'u_status' => 'Y',
        );
        $getContact['Voornaam'] = $_POST['Voornaam'];
        $getContact['Naam'] = $_POST['Naam'];
        $getContact['Dienst'] = $_POST['Dienst'];
        $getContact['Functie'] = $_POST['Functie'];
        $getContact['Telefoon'] = $_POST['Telefoon'];
        $getContact['GSM'] = $_POST['GSM'];
        $getContact['Emailadres'] = $_POST['Emailadres'];

        $getData['contact_details'] = json_encode($getContact);


        $this->common_model->AddRecord($getData, 'users');
        $message = '<div class="alert alert-success"><p>Gemeenten has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/gemeenten_management/all_gemeenten');
    }

    public function edit_gemeenten() {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('users', array('u_id' => $id));
        $this->load->view('gemeenten/edit-gemeenten', $data);
    }

    public function update_gemeenten() {
        $id = $this->input->post("u_id");
        $data = array();
        $getData = array(
            'city_name' => $this->input->post('city_name'),
            'post_code' => $this->input->post('post_code'),
            'street' => $this->input->post('street'),
            'number' => $this->input->post('number'),
            'email' => $this->input->post('login_email'),
        );
        if ($this->input->post('login_password') != '') {
            $getData['password'] = md5($this->input->post('login_password'));
        }
        $getContact['Voornaam'] = $_POST['Voornaam'];
        $getContact['Naam'] = $_POST['Naam'];
        $getContact['Dienst'] = $_POST['Dienst'];
        $getContact['Functie'] = $_POST['Functie'];
        $getContact['Telefoon'] = $_POST['Telefoon'];
        $getContact['GSM'] = $_POST['GSM'];
        $getContact['Emailadres'] = $_POST['Emailadres'];

        $getData['contact_details'] = json_encode($getContact);
        $getData['updated_at'] = date('Y-m-d h:m:s');

        $this->common_model->UpdateRecord($getData, 'users', 'u_id', $id);
        $message = '<div class="alert alert-success"><p>Gemeenten has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/gemeenten_management/all_gemeenten');
    }

    public function delete_gemeenten() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('users', $id, 'u_id');
        $message = '<div class="alert alert-success"><p>Gemeenten has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/gemeenten_management/all_gemeenten');
    }

    public function change_gemeenten_status() {

        $data = array();
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $save_data['u_status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'users', 'u_id', $id);
        echo 'ok';
    }

    public function check_email_exist() {
        $username = $this->input->post('username');
        if (isset($_POST['userid']) && $_POST['userid'] != '') {
            $userid = $this->input->post('userid');
        } else {
            $userid = 0;
        }
        $getUsername = $this->common_model->RetriveRecordByWhereRow('users', array('username' => $username, 'id !=' => $userid));
        if (count($getUsername) > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function all_vereniging_by_city() {
        $this->db->select('verenigings.*,users.city_name')->from('verenigings')->join('users', 'verenigings.city_id=users.u_id')->order_by('verenigings.v_id', 'DESC');
        $data['query'] = $this->db->get();

        //echo $this->db->last_query(); die;

        $this->load->view('gemeenten/all-vereniging-by-city', $data);
    }

    public function add_vereniging_by_city() {
        $data = array();
        if ($_POST) {
            $data = array();
            $getData = array(
                'city_id' => $this->input->post('city_name'),
                'post_code' => $this->input->post('post_code'),
                'association' => $this->input->post('association'),
                'created_by' => 'Admin',
                'v_status' => 'Y',
            );


            $this->common_model->AddRecord($getData, 'verenigings');
            $message = '<div class="alert alert-success"><p>Verenigings has been successfully added.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/gemeenten_management/all_vereniging_by_city');
        }
        $this->db->select('users.*')->from('users')->where(array('usertype' => 'City'))->order_by('users.u_id', 'DESC');
        $data['cities'] = $this->db->get();
        $this->load->view('gemeenten/add-vereniging-by-city', $data);
    }

    public function edit_vereniging_by_city() {
        $data = array();
        $id = $this->uri->segment(4);
        if ($_POST) {
            $id = $this->input->post("v_id");
            $data = array();
            $getData = array(
                'city_id' => $this->input->post('city_name'),
                'post_code' => $this->input->post('post_code'),
                'association' => $this->input->post('association'),
                'created_by' => 'Admin',
                'v_status' => 'Y',
            );
            $getData['updated_at'] = date('Y-m-d h:m:s');

            $this->common_model->UpdateRecord($getData, 'verenigings', 'v_id', $id);
            $message = '<div class="alert alert-success"><p>Verenigings has been successfully updated.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/gemeenten_management/all_vereniging_by_city');
        }
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('verenigings', array('v_id' => $id));
        $this->db->select('users.*')->from('users')->where(array('usertype' => 'City'))->order_by('users.u_id', 'DESC');
        $data['cities'] = $this->db->get();
        $this->load->view('gemeenten/edit-vereniging-by-city', $data);
    }

    public function delete_vereniging_by_city() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('verenigings', $id, 'v_id');
        $message = '<div class="alert alert-success"><p>Verenigings has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/gemeenten_management/all_vereniging_by_city');
    }

    public function change_vereniging_by_city_status() {
       // echo "here I am"; die;
        $data = array();
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $save_data['v_status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'verenigings', 'v_id', $id);

        $save_data2['u_status'] = $value; 
        $this->common_model->UpdateRecord($save_data2, 'users', 'association',$id);

        #################Sending Mail ##########################################
        if($value=="Y"){
                            $userDetails = $this->db->select('*')
                            ->from('users')
                            ->where(array('users.association' => $id))
                            ->get()
                            ->row();

            //echo $userDetails->email; die;

                 /*echo '<pre>';
                 print_r($userDetails); die;*/
                   
                            $data['to'] = $userDetails->email;
                            $data['subject'] = 'Welkom bij Profiwash ' . $userDetails->f_name . '..';
                            $data['email_template'] = 'new-account-approval';
                            $data['dear_name'] = 'Name'. $userDetails->f_name . '..';
                            $data['url'] = base_url() . '/login';
                            $result = send_mail($data);
        }
        echo 'ok111';
    }
    
    public function all_super_city() {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->where(array('usertype' => 'Super_City'));
        $this->db->order_by('users.u_id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('gemeenten/all-super-city', $data);
    }
    
     public function edit_supercity() {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('users', array('u_id' => $id));
        $this->load->view('gemeenten/edit-supercity', $data);
    }

    public function update_supercity() {
        $id = $this->input->post("u_id");
        $data = array();
        $getData = array(
//            'city_name' => $this->input->post('city_name'),
//            'post_code' => $this->input->post('post_code'),
//            'street' => $this->input->post('street'),
//            'number' => $this->input->post('number'),
            'email' => $this->input->post('login_email'),
        );
        if ($this->input->post('login_password') != '') {
            $getData['password'] = md5($this->input->post('login_password'));
        }
        $getContact['Voornaam'] = $_POST['Voornaam'];
        $getContact['Naam'] = $_POST['Naam'];
        $getContact['Dienst'] = $_POST['Dienst'];
        $getContact['Functie'] = $_POST['Functie'];
        $getContact['Telefoon'] = $_POST['Telefoon'];
        $getContact['GSM'] = $_POST['GSM'];
        $getContact['Emailadres'] = $_POST['Emailadres'];

        $getData['contact_details'] = json_encode($getContact);
        $getData['updated_at'] = date('Y-m-d h:m:s');

        $this->common_model->UpdateRecord($getData, 'users', 'u_id', $id);
        $message = '<div class="alert alert-success"><p>Gemeenten has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/gemeenten_management/all_super_city');
    }

}
