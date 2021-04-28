<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vereniging_management extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }

    public function all_vereniging() {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->where(array('usertype' => 'Association'));
        $this->db->order_by('users.u_id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('vereniging/all-vereniging', $data);
    }

    public function add_vereniging() {
        $data = array();
        $this->load->view('vereniging/add-vereniging', $data);
    }

    public function save_vereniging() {
        $data = array();
        $getData = array(
            'city_name' => $this->input->post('city_name'),
            'post_code' => $this->input->post('post_code'),
            'street' => $this->input->post('street'),
            'number' => $this->input->post('number'),
            'association' => $this->input->post('association'),
            'f_name' => $this->input->post('f_name'),
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'gsm' => $this->input->post('gsm'),
            'contact_email' => $this->input->post('email'),
            
            'email' => $this->input->post('login_email'),
            'password' => md5($this->input->post('login_password')),
            'usertype' => 'Association',
            'added_by' => 'Admin',
            'u_status' => 'Y',
        );


        $this->common_model->AddRecord($getData, 'users');
        $message = '<div class="alert alert-success"><p>Vereniging has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/vereniging_management/all_vereniging');
    }

    public function edit_vereniging() {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('users', array('u_id' => $id));
        $this->load->view('vereniging/edit-vereniging', $data);
    }

    public function update_vereniging() {
        $id = $this->input->post("u_id");
        $data = array();
       $getData = array(
            'city_name' => $this->input->post('city_name'),
            'post_code' => $this->input->post('post_code'),
            'street' => $this->input->post('street'),
            'number' => $this->input->post('number'),
            'association' => $this->input->post('association'),
            'f_name' => $this->input->post('f_name'),
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'gsm' => $this->input->post('gsm'),
            'contact_email' => $this->input->post('email'),
            
            'email' => $this->input->post('login_email'),
            'usertype' => 'Association',
            'added_by' => 'Admin',
            'u_status' => 'Y',
        );
        if ($this->input->post('login_password') != '') {
            $getData['password'] = md5($this->input->post('login_password'));
        }
        $getData['updated_at'] = date('Y-m-d h:m:s');

        $this->common_model->UpdateRecord($getData, 'users', 'u_id', $id);
        $message = '<div class="alert alert-success"><p>Vereniging has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/vereniging_management/all_vereniging');
    }

    public function delete_vereniging() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('users', $id, 'u_id');
        $message = '<div class="alert alert-success"><p>Vereniging has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/vereniging_management/all_vereniging');
    }

    public function change_vereniging_status() {

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

        $this->load->view('vereniging/all-vereniging-by-city', $data);
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
            redirect('admin/vereniging_management/all_vereniging_by_city');
        }
        $this->db->select('users.*')->from('users')->where(array('usertype' => 'City'))->order_by('users.u_id', 'DESC');
        $data['cities'] = $this->db->get();
        $this->load->view('vereniging/add-vereniging-by-city', $data);
    }
 public function add_vereniging_by_city_using_csv() {
        $count = 0;
            $fp = fopen($_FILES['file']['tmp_name'], 'r') or die("can't open file");
            while ($csv_line = fgetcsv($fp, 1024)) {
                $count++;
                if ($count == 1) {
                    continue;
                }//keep this if condition if you want to remove the first row
                for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                    $this->db->select('u_id');
                    $this->db->from('users');
                    $this->db->where(array('post_code' => $csv_line[0], 'usertype' => 'City'));
                    $query = $this->db->get();
                    $city_id = $query->row();

                    $insert_csv = array();
                    $insert_csv['city_id'] = $city_id->u_id;
                    $insert_csv['created_by'] = 'City Admin';
                    $insert_csv['post_code'] = $csv_line[0];
                    $insert_csv['association'] = $csv_line[2];
                }
                $i++;

                $this->common_model->AddRecord($insert_csv, 'verenigings');
            }
           
            fclose($fp) or die("can't close file");
            $this->session->set_flashdata('success', 'Successfully added.');
            
        redirect('admin/vereniging_management/all_vereniging_by_city');
       
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
            redirect('admin/vereniging_management/all_vereniging_by_city');
        }
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('verenigings', array('v_id' => $id));
        $this->db->select('users.*')->from('users')->where(array('usertype' => 'City'))->order_by('users.u_id', 'DESC');
        $data['cities'] = $this->db->get();
        $this->load->view('vereniging/edit-vereniging-by-city', $data);
    }

    public function delete_vereniging_by_city() {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('verenigings', $id, 'v_id');
        $message = '<div class="alert alert-success"><p>Verenigings has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/vereniging_management/all_vereniging_by_city');
    }

    public function change_vereniging_by_city_status() {
        //echo "here I am"; die;
        $data = array();
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $save_data['v_status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'verenigings', 'v_id', $id);
        $save_data2['u_status'] = $value; 
        $this->common_model->UpdateRecord($save_data2, 'users', 'association',$id);
if($save_data2['u_status'] == 'Y'){
### in mail association name ######
           $userDetails = $this->db->select('*')->from('users')->where(array('users.association' => $this->input->post('id')))->get()->row();
            $association_email = $userDetails->contact_email; 
            $associationDetails = $this->db->select('*')->from('verenigings')->where(array('verenigings.v_id' => $this->input->post('id')))->get()->row();
            $association_nam = $associationDetails->association;
### in mail association name ######
            $data['to'] = $association_email;
            $data['subject'] = 'Welkom bij Profiwash' . " ". $association_nam;
            $data['email_template'] = 'new-account-approval';
            $data['dear_name'] = $association_nam;
            $data['url'] = base_url() . 'login';

            $result = send_mail($data);
        }
            echo 'ok99';
    }

     public function getPostCode() {

         $data = array();
        $post_code = $this->custom_model->getPostcodeByCity($_POST['city_name']);
        $html = '';
        foreach ($post_code as $dd) {
            $html .= '<option value="' . $dd->post_code . '">' . $dd->post_code . '</option>';
        }
        
        echo $html;
    }

}
