<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text', 'file', 'gen_helper'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib', 'google', 'facebook', 'cart'));
        $this->load->model(array('common_model', 'custom_model'));
    }
	public function registers()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		$getData = array(
                  
                    'first_name' => $this->input->post('first_name'),
					'role_id'=>'6',
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    
                    'password' => base64_encode($this->input->post('password'))
                   
                );
				//print_r($getdata);
		  $this->common_model->AddRecord($getData, 'ds_users');
     $message = '<div class="alert alert-danger">Sucessfully Registration</div>';
          $this->session->set_flashdata('success', $message);
	 
		}
        
		 
        $this->load->view('register');

	}

    public function login() {


        if ($_POST) {
          $email = $this->input->post('email');
            echo  $password = base64_encode($this->input->post('pswd'));
            
            $this->db->select('*');
            $this->db->from('ds_users');
            $this->db->where(array('email' => $email, 'password' => $password, 'role_id !=' => 0));
            $query = $this->db->get();
			echo $this->db->last_query(); 
			
       
            $row = $query->row();
            if ($query->num_rows() > 0) {
              

                   echo  $this->session->set_userdata('EMAIL', $row->email);
                    $this->session->set_userdata('USER_ID', $row->id);
                    
                    $this->session->set_userdata('USER_FNAME', $row->first_name);
                    $this->session->set_userdata('USER_LNAME', $row->last_name);

								redirect(base_url(''));
                    if (is_array($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0) {
                        foreach ($_SESSION['cart_item'] as $k => $r) {
                            $getCart = array(
                                'user_id' => $row->id,
                                'p_id' => $r['p_id'],
                                'attributes' => $r['attrpro'],
                                'qty' => $r['qty'],
                            );
							
                            //fetch save table data
                            if($r['attrpro'] == '[]' ){
                                $ret_cart = $this->common_model->RetriveRecordByWhereRow('ds_temp_cart', array('user_id' => $row->id, 'p_id' => $r['p_id'] ));
                            }else{
                                $ret_cart = $this->common_model->RetriveRecordByWhereRow('ds_temp_cart', array('user_id' =>$row->id, 'p_id' => $r['p_id'], 'attributes' =>$r['attrpro']));
                            }

                            
                            
                            $get_product_data = $this->common_model->RetriveRecordByWhereRow('ds_products',array('p_id'=>$r['p_id']));
                            
                            // check  cart table save product already 
                            if (count($ret_cart) > 0) {
                                $getCart['qty'] += $ret_cart['qty'];
                                // check stock qty
                                if($getCart['qty'] > $get_product_data['qty']){
                                    continue;
                                } else {
                                    $query = $this->common_model->UpdateRecordWhereArray($getCart,'ds_temp_cart',array('user_id'=>$row->id,'p_id'=>$r['p_id']));
                                }
                            } 
                            else {
                                $this->common_model->AddRecord($getCart, 'ds_temp_cart');
                            }
                            $_SESSION['cart_item'] = array();
							// redirect(base_url(''));

                        }
                    


                    if ($row->role_id == '6') {
                        redirect(base_url(''));
                    }
                } else {
                    $message = '<div class="alert alert-danger">Your account is not yet activated.!!</div>';
                    $this->session->set_flashdata('error', $message);
                    redirect('login');
                }
            } else {
                $message = '<div class="alert alert-danger">Invalid Email or Password!!</div>';
                $this->session->set_flashdata('error', $message);
                redirect('login');
            }
        }
        $data = array();
        $this->load->view('login', $data);
    }

    public function register($user_type = FALSE, $invitation_code = FALSE) {
        $data = array();
        if ($_POST) {

            if (variable_value_check($this->input->post('invitation_code'))) {
                $check_invitation = $this->common_model->RetriveRecordByWhere('ds_invitation_email', array('email' => $_POST['email'], 'd_code' => $_POST['invitation_code']));
                if ($check_invitation->num_rows() == 0) {
                    $this->session->set_flashdata('invitation_code_error', 'Invitation code not valid.');
                    redirect('register');
                }
            }
            $user = $this->common_model->RetriveRecordByWhere('ds_users', array('email' => $_POST['email']));
            if ($user->num_rows() > 0) {
                $this->session->set_flashdata('email_err', 'Email already exist.');
            } else {
                $getData = array();
//        print_R($_POST);
                $getData = array(
                    'role_id' => $this->input->post('role_id'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'username ' => $this->input->post('email'),
                    'password' => base64_encode($this->input->post('password')),
                    'country_id' => $this->input->post('country_id'),
                    'city' => $this->input->post('city'),
                    'mobile' => $this->input->post('mobile'),
                    'std_code'=>$this->input->post('std_code')
                );
                if ($this->input->post('role_id') == '1') {
                    $getData['accrediation_no'] = $this->input->post('accrediation_no');
                    $getData['service_id'] = $this->input->post('service_id');
                    $getData['membership_id'] = $this->input->post('membership_id');
                    $getData['others'] = $this->input->post('others');
                    $getData['virtual_studio'] = $this->input->post('virtual_studio');
                    $getData['invitation_code'] = (variable_value_check($this->input->post('invitation_code'))) ? $this->input->post('invitation_code') : '';
                    
                }

                if ($this->input->post('role_id') == '6') {
                    $getData['membership_id'] = $this->input->post('membership_id');
                    $getData['virtual_studio'] = $this->input->post('virtual_studio');
                    $getData['products_types_id'] = $this->input->post('products_types_id');
                    $getData['invitation_code'] = (variable_value_check($this->input->post('invitation_code'))) ? $this->input->post('invitation_code') : '';
                }

       //print_r($getData);
       //exit();
                if ($_FILES['certificate']['name'] != '') {
                    $ext = strtolower(pathinfo($_FILES['certificate']['name'], PATHINFO_EXTENSION));
                    $target_dir = "uploads/users/";
                    $file_name = time() . '_certificate.' . $ext;
                    $target_file = $target_dir . $file_name;
                    move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file);

                    $getData['certificate_file_name'] = $file_name;
                }

//        print_r($getData);
//        exit();
                $sendmailcount = 0;
                $this->common_model->AddRecord($getData, 'ds_users');
                $lstid = $this->db->insert_id();
                if ($getData['role_id'] == '1' || $getData['role_id'] == '6') {
                    $dcode = strtok($getData['virtual_studio'], " ") . 'DS' . $lstid;
                    $getUpData['d_code'] = strtoupper($dcode);

                    $this->common_model->UpdateRecord($getUpData, 'ds_users', 'id', $lstid);
                }


                $link = base_url() . 'validate-email/' . base64_encode($lstid);
//        ******* Send mail Start ************
                if ($sendmailcount < 1) {
                    $from_mail = $this->common_model->RetriveRecordByWhere('ds_settings', array());
                    foreach ($from_mail->result() as $row) {
                        $settings[$row->settings_name] = $row->settings_value;
                    }
                    $maildata['to'] = $getData['email'];
                    $maildata['dear_name'] = $getData['first_name'];
                    $maildata['subject'] = 'Confirm your Email ';
                    $maildata['email_template'] = 'registration_email';
                    $maildata['link'] = $link;
                    $maildata['site_url'] = base_url();
                    $maildata['from'] = $settings['admin_from_mail_id'];
                    $maildata['facebook_url'] = $settings['facebook_url'];
                    $maildata['twitter_url'] = $settings['twitter_url'];
                    $maildata['pinterest'] = $settings['pinterest'];
                    $maildata['footer_copyright_text'] = $settings['footer_copyright_text'];
                    $result = send_mail($maildata);
                    if ($result) {
                        $sendmailcount++;
                    }
                }
                $message = '<div class=""><h3>Thanks for your registration. Please check your mailbox to confirm your email address.</h3></div>';
                $this->session->set_flashdata('reg_success', $message);
                redirect('regsuccess');
            }
        }
        $data['service'] = $this->common_model->getService();
        $data['membership'] = $this->common_model->getMembership();
        $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
           $data['stdcode'] = $this->common_model->RetriveRecordByWhere('ds_country', array('dial_code!='=> ''));
       
        if (variable_value_check($user_type) && variable_value_check($invitation_code)) {
            $data['user_type'] = $user_type;
            $data['invitation_code'] = $invitation_code;
        } else {
            $data['user_type'] = '';
            $data['invitation_code'] = '';
        }

        $this->load->view('register', $data);
    }

    public function check_invitation_code($invitation_code = FALSE, $email_id = FALSE) {
        $check_invitation = $this->common_model->RetriveRecordByWhere('ds_invitation_email', array('email' => $email_id, 'd_code' => $invitation_code));

        if ($check_invitation->num_rows() > 0) {
            $data['status'] = 'success';
        } else {
            $data['status'] = 'fail';
        }
        echo json_encode($data);
    }

    public function success() {
        $data = array();
        $this->load->view('success', $data);
    }

    public function regsuccess() {
        $data = array();
        $this->load->view('reg_success', $data);
    }

    public function adduser() {
//        echo "<pre>";
        $data = array();
        $getData = array();
//        print_R($_POST);
        $getData = array(
            'role_id' => $this->input->post('role_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'username ' => $this->input->post('email'),
            'password' => base64_encode($this->input->post('password')),
            'country_id' => $this->input->post('country_id'),
            'city' => $this->input->post('city'),
            'mobile' => $this->input->post('mobile'),
            'std_code'=>$this->input->post('std_code')

        );

        if ($this->input->post('role_id') == '1') {
            $getData['accrediation_no'] = $this->input->post('accrediation_no');
            $getData['service_id'] = $this->input->post('service_id');
            $getData['membership_id'] = $this->input->post('membership_id');
			$getData['others'] = $this->input->post('others');
            $getData['virtual_studio'] = $this->input->post('virtual_studio');
        }

        if ($this->input->post('role_id') == '6') {
            $getData['membership_id'] = $this->input->post('membership_id');
            $getData['virtual_studio'] = $this->input->post('virtual_studio');
            $getData['products_types_id'] = $this->input->post('products_types_id');
        }

        if ($_FILES['certificate']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['certificate']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/users/";
            $file_name = time() . '_certificate.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file);

            $getData['certificate_file_name'] = $file_name;
        }

//        print_r($getData);
//        exit();
        $sendmailcount = 0;
        $this->common_model->AddRecord($getData, 'ds_users');
        $lstid = $this->db->insert_id();

        $link = base_url() . 'validate-email/' . base64_encode($lstid);
//        ******* Send mail Start ************
        if ($sendmailcount < 1) {
            $from_mail = $this->common_model->RetriveRecordByWhere('ds_settings', array());
            foreach ($from_mail->result() as $row) {
                $settings[$row->settings_name] = $row->settings_value;
            }
            $maildata['to'] = $getData['email'];
            $maildata['dear_name'] = $getData['first_name'];
            $maildata['subject'] = 'Confirm your Email ';
            $maildata['email_template'] = 'registration_email';
            $maildata['link'] = $link;
            $maildata['site_url'] = base_url();
            $maildata['from'] = $settings['admin_from_mail_id'];
            $maildata['facebook_url'] = $settings['facebook_url'];
            $maildata['twitter_url'] = $settings['twitter_url'];
            $maildata['pinterest'] = $settings['pinterest'];
            $maildata['footer_copyright_text'] = $settings['footer_copyright_text'];
            $result = send_mail($maildata);
            if ($result) {
                $sendmailcount++;
            }
        }
//        ******* Send mail End ************
//        echo "<pre>";
//print_r($maildata);
//echo $sendmailcount;
//
//exit();
        $message = '<div class="alert alert-success"><p>Thanks for your registration. Please check your mailbox to confirm your email address.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('registers');
    }

    public function getMembershipByUserType() {
        $data = array();

        $membership = $this->common_model->RetriveRecordByWhere('ds_membership', array('user_type' => $_POST['role_id']));
        $html = '';
        if ($membership->num_rows() > 0) {
            foreach ($membership->result() as $row) {
                $html .= ' <option value="' . $row->id . '">' . $row->name . '( ' . $row->description . '-- ' . $row->price . ' )' . '</option>';
            }
        } else {
            $html .= ' <option value="0">Default Membership</option>';
        }
        echo $html;
    }

    public function chechUserExist() {
        $data = array();

        $user = $this->common_model->RetriveRecordByWhere('ds_users', array('email' => $_POST['email']));
        if ($user->num_rows() > 0) {
            echo 'exist';
        } else {
            echo 'no';
        }
    }

    public function confirmMail($id) {
        $uid = base64_decode($this->uri->segment(2));
        $data = array();
        $getData = array(
            'email_verified' => '1',
        );
        $this->common_model->UpdateRecord($getData, 'ds_users', 'id', $uid);

        //        ******* Send mail Start ************

        $user_info = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $uid));
        if ($user_info['role_id'] == '1') {
            $usetType = 'Designer';
        } else if ($user_info['role_id'] == '6') {
            $usetType = 'Design Store';
        } else {
            $usetType = 'Customer';
        }
        $from_mail = $this->common_model->RetriveRecordByWhere('ds_settings', array());
        foreach ($from_mail->result() as $row) {
            $settings[$row->settings_name] = $row->settings_value;
        }
//        $data['to'] = 'gsr.dev.15@gmail.com';
        $maildata['to'] = $user_info['email'];
        $maildata['dear_name'] = $user_info['first_name'];
        $maildata['subject'] = 'Registration ';
        $maildata['uset_type'] = $usetType;
        $maildata['email_template'] = 'email_confirmation_by_user';
        $maildata['site_url'] = base_url();
        $maildata['from'] = $settings['admin_from_mail_id'];
        $maildata['facebook_url'] = $settings['facebook_url'];
        $maildata['twitter_url'] = $settings['twitter_url'];
        $maildata['pinterest'] = $settings['pinterest'];
        $maildata['footer_copyright_text'] = $settings['footer_copyright_text'];
        $result = send_mail($maildata);

//        ******* Send mail End ************


        $message = '<div class="alert alert-success"><p>Thanks for verifying your Email address. Your registration request is under process, upon approval you will be notified by email.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('login');
    }

    public function wishlist() {
        if ($this->session->userdata('USER_ID') != '') {
            $this->load->view('wishlist');
        } else {
            redirect('login');
        }
    }

    public function order_history() {
        if ($this->session->userdata('USER_ID') != '') {
            $this->load->view('order-history');
        } else {
            redirect('login');
        }
    }

    public function edit_account() {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $id = $this->session->userdata('USER_ID');
            $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $id));
            $data['address_data'] = $this->common_model->RetriveRecordByWhereRow('ds_users_address', array('user_id' => $id));
			 $data['products'] = $this->common_model->RetriveRecordByWhere('ds_product_types', array());
			  $data['dialcode'] = $this->common_model->RetriveRecordByWhere('ds_country', array('dial_code!='=>''));
            $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
            $data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array('country_id' => $data['query']['country_id']));

            $this->load->view('edit-account', $data);
        } else {
            redirect('login');
        }
    }

    public function update_account() {
//        print_r($_POST);exit();
        $id = $this->session->userdata('USER_ID');
        $data = array();
        $getData = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile' => $this->input->post('mobile'),
            'city' => $this->input->post('city'),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
			'virtual_studio'=> $this->input->post('virtual_studio'),
			'products_types_id'=> $this->input->post('products_types_id'),
			'std_code'=>$this->input->post('std_code')

        );

        $this->common_model->UpdateRecord($getData, 'ds_users', 'id', $id);

        $query = $this->db->select('ds_users_address.*')
                ->from('ds_users_address')
                ->where(array('user_id' => $id))
                ->get();
        //echo $this->db->last_query(); 
        $chkUserExist = $query->num_rows();

        if ($chkUserExist == 0) {
            $getaddressData = array(
                'company_name' => $this->input->post('company_name'),
                'address2' => $this->input->post('address2'),
                'postcode' => $this->input->post('postcode'),
                'user_id' => $id,
            );


            $this->common_model->AddRecord($getaddressData, 'ds_users_address');
        } else {
            $getaddressData = array(
                'company_name' => $this->input->post('company_name'),
                'address2' => $this->input->post('address2'),
                'postcode' => $this->input->post('postcode'),
            );

            $this->common_model->UpdateRecord($getaddressData, 'ds_users_address', 'user_id', $id);
        }

        $message = '<div class="alert alert-success"><p>User has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('edit-account');
    }

    public function getstate() {
        $data = array();

        $states = $this->common_model->RetriveRecordByWhere('ds_states', array('country_id' => $_POST['country_id']));
        if($this->session->userdata('billing_add_det') && $this->session->userdata('billing_add_det')['billing_add_type'] != 1){
            $stateid = $this->session->userdata('billing_add_det')['billingstate'];
        }
        
        $html = '';
        if ($states->num_rows() > 0) {
            foreach ($states->result() as $row) {
                $html .= ' <option value="' . $row->id . '" '. ($row->id == $stateid? 'selected' : '') .'>' . $row->name . '</option>';
            }
        } else {
            $html .= ' <option value="">Select State</option>';
        }
        echo $html;
    }
    
    
    public function getstatenew() {
        $data = array();

        $states = $this->common_model->RetriveRecordByWhere('ds_states', array('country_id' => $_POST['country_id']));
        $stateid = $_POST['state_id'];
        
        $html = '';
        if ($states->num_rows() > 0) {
            foreach ($states->result() as $row) {
                $html .= ' <option value="' . $row->id . '" '. ($row->id == $stateid? 'selected' : '') .'>' . $row->name . '</option>';
            }
        } else {
            $html .= ' <option value="">Select State</option>';
        }
        echo $html;
    }

    public function change_password() {
        if ($this->session->userdata('USER_ID') != '') {
            $this->load->view('change_password');
        } else {
            redirect('login');
        }
    }

    public function changepassword() {
        //If any error message exist
        if ($this->session->userdata('error_message') != "") {
            $this->data['error_message'] = $this->session->userdata('error_message');
            $this->session->unset_userdata('error_message');
        }
        $id = $this->session->userdata('USER_ID');
        $new_password = $this->input->post('new_password');
        //is form submitted?
        if ($this->input->post('save')) {
            $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $id));

            $old_password_record = $data['query']['password'];
            $old_password = base64_encode($this->input->post('old_password'));
            if ($old_password_record == $old_password) {
                $password = base64_encode($this->input->post('new_password'));

                $getaddressData = array(
                    'password' => base64_encode($this->input->post('new_password')),
                );

                $this->common_model->UpdateRecord($getaddressData, 'ds_users', 'id', $id);


                $message = '<div class="register-success-page"><div class=""><h3>Password Updated Successfully.</h3></div></div>';
                $this->session->set_flashdata('success_message', $message);
                redirect('change-password');
//                redirect('account');
            } else {
                $message = '<p class="error_msg">Old Password did not match.</p>';
                $this->session->set_flashdata('error_message', $message);
                redirect('change-password');
            }
        }
        $this->load->view('change_password', $data);
    }

    public function chechEmailExist() {
        $data = array();

        $user = $this->common_model->RetriveRecordByWhere('subscribed', array('email' => $_POST['email']));
        if ($user->num_rows() > 0) {
            echo 'exist';
        } else {
            echo 'no';
        }
    }

    public function user_newsletter() {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $id = $this->session->userdata('USER_ID');
            $data['user_email'] = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $id));

            $email = $data['user_email']['email'];

            $data['query'] = $this->common_model->RetriveRecordByWhereRow('subscribed', array('email' => $email));

            $this->load->view('newsletter', $data);
        } else {
            redirect('login');
        }
    }

    public function usersubscribe() {

        $arr['email'] = $_POST['email'];
        $arr['browser'] = $_SERVER['HTTP_USER_AGENT'];
        $arr['ip'] = $_SERVER['REMOTE_ADDR'];
        $arr['time'] = time();


        $query = $this->db->select('subscribed.*')
                ->from('subscribed')
                ->where(array('email' => $arr['email']))
                ->get();
        //echo $this->db->last_query(); 
        $chkUserExist = $query->num_rows();

        if ($chkUserExist == 0) {
            $this->common_model->AddRecord($arr, 'subscribed');
            //echo "subscribed";
            $message = '<div class="alert alert-success"><p>You Have Successfully Subscribed.</p></div>';
            $this->session->set_flashdata('success', $message);

            redirect('user-newsletter');
        }
    }

    public function Unsubscribe() {

        $email = $_POST['email'];
        $unsubscrb = $this->common_model->Delete('subscribed', $email, 'email');
        $message = '<div class="alert alert-success"><p>Email has been unsuscribe successfully.</p></div>';
        $this->session->set_flashdata('success_message', $message);
        echo 'sent';

        //redirect('user-newsletter');
    }

    public function all_addressbook() {
        if ($this->session->userdata('USER_ID') != '') {
            $user_id = $this->session->userdata('USER_ID');
            $data = array();
//            $data['query'] = $this->common_model->RetriveRecordByWhere('ds_users_address', array('user_id' => $user_id));
            // $country=$data['query']['country_id'];
            //$state=$data['query']['state_id'];
            //$data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array('id' => $country));
            //$data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array('id' => $state));

            $this->db->select('ds_users_address.*,ds_country.country_name,ds_states.name as state_name');
            $this->db->from('ds_users_address');
            $this->db->Join('ds_country', 'ds_users_address.country_id = ds_country.id', 'left');
            $this->db->Join('ds_states', 'ds_users_address.state_id = ds_states.id', 'left');
            $this->db->where('ds_users_address.user_id', $user_id);
            $this->db->order_by('ds_users_address.id', 'DESC');
            $data['query'] = $this->db->get();
            $this->load->view('user/all-addressbook', $data);
        } else {
            redirect('login');
        }
    }
	 public function email()
    {
		 if ($this->session->userdata('USER_ID') != '') {
            $user_id = $this->session->userdata('USER_ID');
        $users = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $user_id));
        //$data['user_info'] = $this->common_model->RetriveRecordByWhereRow('ds_Store_designer_email', array('id' => $id));
        //$data['from_mail'] = $this->common_model->RetriveRecordByWhere('ds_settings', array('id' => 4));


       

    
        $user_info = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $user_id ));
        $from_mail = $this->common_model->RetriveRecordByWhere('ds_settings', array());

        foreach ($from_mail->result() as $row) {
            $settings[$row->settings_name] = $row->settings_value;
        }
       
        $message = $this->input->post('message');

        $maildata['subject'] = 'A new message received from '.$user_info['virtual_studio'];
        //$maildata['message'] = $body;
        $maildata['email_template'] = 'user_approve_by_admin';
        $maildata['to'] = $settings['admin_from_mail_id'];
        $maildata['site_url'] = base_url();
        $maildata['user_email'] = $user_info['email'];
        $maildata['from'] = $user_info['email'];
        $maildata['message'] = $message;
		$maildata['message2'] = $user_info['virtual_studio'];
        $maildata['email_template'] = 'email';
        $maildata['facebook_url'] = $settings['facebook_url'];
        $maildata['twitter_url'] = $settings['twitter_url'];
        $maildata['pinterest'] = $settings['pinterest'];
        $maildata['footer_copyright_text'] = $settings['footer_copyright_text'];
        $result = send_mail($maildata);
        //pr($result);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $getdata = array('to' => $user_info['email'],
                'from' => $settings['admin_from_mail_id'],
            'message' => $this->input->post('message'),
				'user_id'=> $user_id,
				'd_code'=>$users['d_code'],
                'date' => date('Y-m-d h:m:s')
            );
				
            $this->common_model->AddRecord($getdata, 'ds_Store_designer_email');
			$message = '<div class="alert alert-success"><p>Email has been send successfully.</p></div>';
		 $this->session->set_flashdata('success', $message);
		//redirect('email');
		}
            
        }
		$this->db->select('ds_Store_designer_email.*');
        $this->db->from('ds_Store_designer_email');
       
        $this->db->where('ds_Store_designer_email.user_id', $user_id);
        $this->db->order_by('ds_Store_designer_email.id','desc');
        $data['users'] = $this->db->get();
       
			$this->load->view('email', $data);

    }
	public function emaildetails(){
		echo $id= $this->uri->segment(2);
	$user_id = $this->session->userdata('USER_ID');
	$data['users'] = $this->common_model->RetriveRecordByWhere('ds_Store_designer_email', array('id' => $user_id ));
	//$this->load->view('emaildetails', $data);
	}

    public function add_addressbook() {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
            $data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array());
             $data['stdcode'] = $this->common_model->RetriveRecordByWhere('ds_country', array('dial_code!='=> ''));
            $this->load->view('user/add-addressbook', $data);
        } else {
            redirect('login');
        }
    }

    public function save_addressbook() {
        $data = array();
        $user_id = $this->session->userdata('USER_ID');
        $getData = array(
            'user_id' => $user_id,
            'name' => $this->input->post('name'),
            'company_name' => $this->input->post('company_name'),
            'address2' => $this->input->post('address2'),
            'postcode' => $this->input->post('postcode'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'city' => $this->input->post('city'),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'dial_code'=>$this->input->post('dial_code')
        );


        $this->common_model->AddRecord($getData, 'ds_users_address');
        $message = '<div class="alert alert-success"><p>Address Book has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('all-addressbook');
    }

    public function edit_addressbook() {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $id = $this->uri->segment(2);
            $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_users_address', array('id' => $id));
            $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
            $data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array('country_id' => $data['query']['country_id']));
            $data['stdcode'] = $this->common_model->RetriveRecordByWhere('ds_country', array('dial_code!='=> ''));
            $this->load->view('user/edit-addressbook', $data);
        } else {
            redirect('login');
        }
    }

    public function update_addressbook() {
//        print_r($_POST);exit();
        $id = $this->input->post("id");
        $data = array();
        $user_id = $this->session->userdata('USER_ID');
        $getData = array(
            'user_id' => $user_id,
            'name' => $this->input->post('name'),
            'company_name' => $this->input->post('company_name'),
            'address2' => $this->input->post('address2'),
            'postcode' => $this->input->post('postcode'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'city' => $this->input->post('city'),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'dial_code'=>$this->input->post('dial_code')
        );

        //$getData['updated_at'] = date('Y-m-d h:m:s');

        $this->common_model->UpdateRecord($getData, 'ds_users_address', 'id', $id);
        $message = '<div class="alert alert-success"><p>Address Book has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('all-addressbook');
    }

    public function delete_addressbook() {
       $id = $this->uri->segment(2);
		
        $this->common_model->Delete('ds_users_address', $id, 'id');
        $message = '<div class="alert alert-success"><p>Address Book has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('all-addressbook');
    }

    public function all_products() {
        if ($this->session->userdata('USER_ID') != '') {
            $user_id = $this->session->userdata('USER_ID');
            $data = array();
            $this->db->where('u_id', $user_id);
			  $this->db->where('p_status', 'Y');
            $this->db->select('ds_products.*,ds_users.first_name,ds_users.last_name,ds_category.name as cat_name');
            $this->db->from('ds_products');
            $this->db->Join('ds_users', 'ds_products.u_id = ds_users.id', 'left');
            $this->db->Join('ds_category', 'ds_products.cat_id = ds_category.id', 'left');
            $this->db->order_by('products.p_id', 'DESC');
            $data['query'] = $this->db->get();

            $this->load->view('user/all_product', $data);
        } else {
            redirect('login');
        }
    }

    public function add_products() {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $data['product'] = $this->common_model->RetriveRecordByWhereRow('ds_products', array());
            $data['category'] = $this->common_model->RetriveRecordByWhere('ds_category', array());
            $data['products'] = $this->common_model->RetriveRecordByWhere('ds_products', array());
            $data['parent_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0, 'status' => 'Y'));
            $data['child_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('status' => 'Y'));
            $data['attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array());
            $this->load->view('user/add_products', $data);
        } else {
            redirect('login');
        }
    }

    //sourav 2/03/2021 onchange save Product Extra Images
    public function product_extra_image_temp_file_save(){

        $user_id = $this->session->userdata('USER_ID');
        $action = $this->input->post('url_status');
        if($action == 'add_products' or $action == 'edit_product'){
             $action  = 2;
        }
        else{
            $action = 0 ;
        }

        for ($i=0;$i<count($_FILES['form_file']['name']);$i++){

            $_FILES['file']['name'] = $_FILES['form_file']['name'][$i];
            $_FILES['file']['type'] = $_FILES['form_file']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['form_file']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['form_file']['error'][$i];
            $_FILES['file']['size'] = $_FILES['form_file']['size'][$i];

            $digits = 6;
            $random_number = rand(pow(10, $digits-1), pow(10, $digits)-1);

            // File upload configuration
            $uploadPath = 'uploads/product/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = '*';
            $config['file_name']   =  $random_number.$_FILES["form_file"]['name'][$i];

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $fileData = $this->upload->data();
                $file_name = $fileData['file_name'];

                $data = array(
                    'file_name' => $file_name,
                    'user_id' => $user_id,
                    'action' => $action,
                );
                $this->db->insert('temp_file_store', $data);
            }
        }
    }

    public function product_extra_image_temp_file_view(){

        $user_id = $this->session->userdata('USER_ID');
        $action = $this->input->post('url_status');
         if($action == 'add_products' or $action == 'edit_product'){
             $action  = 2;
        }
        else{
            $action = 0 ;
        }

        $service_enq_files = $this->common_model->RetriveRecordByWhere('temp_file_store',array('user_id'=>$user_id,'action'=>$action));

        foreach ($service_enq_files->result() as $key=>$value) {
            
             if(substr($value->file_name, -4) == '.pdf' ){
                echo  '<span class="pip remove_temp_image'.$value->id.'">
                    <img class="imageThumb" src="'.base_url().'/assets/front/images/pdf.png" height="120" title="'.substr($value->file_name,6).'"><br>
                    <span class="remove" onclick="remove_temp_image('.$value->id.')" ">Remove</span>
                    
                 </span>';
             }elseif(substr($value->file_name,-5) == '.xlsx' or substr($value->file_name,-5) == '.xls'){
                echo  '<span class="pip remove_temp_image'.$value->id.'">
                    <img class="imageThumb" src="'.base_url().'/assets/front/images/excel.png" height="120" title="'.substr($value->file_name,6).'"><br>
                    
                    <span class="remove" onclick="remove_temp_image('.$value->id.')" ">Remove</span>
                 </span>';
                 //<a href="javascript:void(0);" class="remove" onclick="remove_temp_image('.$value->id.')" ">Remove</a>
             }elseif(substr($value->file_name,-5) == '.doc' or substr($value->file_name,-5) == '.docx'){
                echo  '<span class="pip remove_temp_image'.$value->id.'">
                    <img class="imageThumb" src="'.base_url().'/assets/front/images/icons8-word-48.png" height="120" title="'.substr($value->file_name,6).'"><br>
                    <span class="remove" onclick="remove_temp_image('.$value->id.')" ">Remove</span>
                    
                 </span>';
             }else{
                echo  '<span class="pip remove_temp_image'.$value->id.'">
                    <img class="imageThumb" src="'.base_url().'/uploads/product/'.$value->file_name.'" height="120" title="'.substr($value->file_name,6).'"><br>
                    <span class="remove" onclick="remove_temp_image('.$value->id.')" ">Remove</span>
                 </span>';
             }
        }
    }

    public function product_extra_image_temp_file_delete($id=0){
        $user_id = $this->session->userdata('USER_ID');
        $temp_file_store = $this->common_model->RetriveRecordByWhere('temp_file_store',array('id'=>$id,'user_id'=>$user_id));
      
        foreach ($temp_file_store->result() as $key=>$value) {
            if (!file_exists(base_url('/uploads/product/'.$value->file_name))) {   
                unlink(base_url('/uploads/product/'.$value->file_name));
            }
        }
        $temp_file_store_delete = $this->common_model->Delete('temp_file_store',$id,'id');
    }
    // sourav 2/03/2021 end 

    public function save_products() {
        $user_id = $this->session->userdata('USER_ID');
        $user_type = $this->session->userdata('USER_TYPE');
        $attribute = $this->input->post('attribute');
        $getData = array(
            'added_by' => $user_id,
            'u_type' => $user_type,
            'u_id' => $user_id,
            'related_product' => json_encode($this->input->post('related_product'), true),
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'sell_price' => $this->input->post('sell_price'),
			'long_description'=>$this->input->post('long_description'),
            'cat_id' => $this->input->post('cat_id'),
            'sub_cat_id' => $this->input->post('sub_cat_id'),
            'details' => $this->input->post('details'),
            'extra_desc' => $this->input->post('extra_desc'),
			'is_cancellation' => $this->input->post('is_cancellation')=='Y'?'Y':'N',
            'store_details' => $this->input->post('store_details'),
            'sku' => $this->input->post('sku'),
            'qty' => $this->input->post('qty'),
            'attribute' => json_encode($attribute)
        );


        if ($_FILES['image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/product/";
            $file_name = time() . '_product_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $getData['image'] = $file_name;
        }
        //start sourav.paul $action = 2 (add_products -> Product Extra Images) 
        $temp_file_store = $this->common_model->RetriveRecordByWhere('temp_file_store',array('user_id'=>$user_id,'action'=>2));

        foreach ($temp_file_store->result() as $key=>$value) {
         $images[]= $value->file_name;
        }

        $temp_file_store_delete = $this->common_model->delquery('temp_file_store',array('user_id'=>$user_id,'action'=>2));
        //end sourav.paul

        $getData['extra_images'] = json_encode($images);

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
        redirect('all_products');
    }

    public function edit_product() {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $id = $this->uri->segment(2);
            $data['query'] = $this->common_model->RetriveRecordByWhereRow('products', array('p_id' => $id));
            $data['query2'] = $this->common_model->RetriveRecordByWhereRow('ds_products', array('p_id' => $id));
            $data['products'] = $this->common_model->RetriveRecordByWhere('ds_products', array());
            $data['category'] = $this->common_model->RetriveRecordByWhere('ds_category', array());
            $data['prodcuct_ids'] = json_decode($data['query2']['related_product'], true);
            $data['sub_category'] = $this->common_model->RetriveRecordByWhere('ds_sub_category', array('category_id' => $data['query']['cat_id']));
            $data['parent_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0, 'status' => 'Y'));
            $data['child_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('status' => 'Y'));
            $data['attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array());

            $this->load->view('user/edit_product', $data);
        } else {
            redirect('login');
        }
    }
public function view_product() {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $id = $this->uri->segment(2);
            $data['query'] = $this->common_model->RetriveRecordByWhereRow('products', array('p_id' => $id));
            $data['query2'] = $this->common_model->RetriveRecordByWhereRow('ds_products', array('p_id' => $id));
            $data['products'] = $this->common_model->RetriveRecordByWhere('ds_products', array());
            $data['category'] = $this->common_model->RetriveRecordByWhere('ds_category', array());
            $data['prodcuct_ids'] = json_decode($data['query2']['related_product'], true);
            $data['sub_category'] = $this->common_model->RetriveRecordByWhere('ds_sub_category', array('category_id' => $data['query']['cat_id']));
            $data['parent_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0, 'status' => 'Y'));
            $data['child_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('status' => 'Y'));
            $data['attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array());

            $this->load->view('user/view_product', $data);
        } else {
            redirect('login');
        }
    }

    public function change_product_status_product() {

        $data = array();
        $id = $this->input->post('p_id');
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

    public function update_product() {

       

        $user_id = $this->session->userdata('USER_ID');
        $user_type = $this->session->userdata('USER_TYPE');
        $id = $this->input->post("p_id");
        $data = array();
        $attribute = $this->input->post('attribute');
        $getData = array(
            'u_id' => $user_id,
            'u_type' => $user_type,
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'sell_price' => $this->input->post('sell_price'),
            'store_details' => $this->input->post('store_details'),
            'cat_id' => $this->input->post('cat_id'),
			'long_description'=>$this->input->post('long_description'),
			'is_cancellation' => $this->input->post('is_cancellation')=='Y'?'Y':'N',
            'related_product' => json_encode($this->input->post('related_product'), true),
            'sub_cat_id' => $this->input->post('sub_cat_id'),
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
        for ($i = 0; $i < count($_POST['old_extra_images']); $i++) {
            $images[] = $_POST['old_extra_images'][$i];
        }
        /*
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
        */
        //start sourav.paul $action = 2 (add_products -> Product Extra Images) 
        $temp_file_store = $this->common_model->RetriveRecordByWhere('temp_file_store',array('user_id'=>$user_id,'action'=>2));

        foreach ($temp_file_store->result() as $key=>$value) {
         $images[]= $value->file_name;
        }

        $temp_file_store_delete = $this->common_model->delquery('temp_file_store',array('user_id'=>$user_id,'action'=>2));
        //end sourav.paul

        $getData['extra_images'] = json_encode($images);


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
        redirect('all_products');
    }

    public function delete_products() {
        if ($this->session->userdata('USER_ID') != '') {
            $id = $this->uri->segment(2);

            $this->common_model->Delete('products', $id, 'p_id');
            $message = '<div class="alert alert-success"><p>Products has been deleted successfully.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('all_products');
        }
    }

    public function edit_service() {
        if ($this->session->userdata('USER_ID') != '') {

            $user_id = $this->session->userdata('USER_ID');
            $data = array();
			$data['users'] = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $user_id));
            $data['products'] = $this->common_model->RetriveRecordByWhere('ds_products', array('u_id' => $user_id));
            $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_shop_store_details', array('user_id' => $user_id));

            $this->load->view('edit-service', $data);
        } else {
            redirect('login');
        }
    }

    public function update_service() {
        $user_id = $this->session->userdata('USER_ID');
        $id = $this->input->post('id');

        $data = array();
        $getData = array(
            
            'shop_description' => $this->input->post('shop_description'),
            'featured_image' => json_encode($this->input->post('featured_product'), true),
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
            'message_heading' => $this->input->post('message_heading'),
            'message_content' => $this->input->post('message_content'),
            'products' => json_encode($this->input->post('products'), true),
            'user_id' => $user_id
        );

        if ($_FILES['banner_image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/product/";
            $file_name = time() . '_product_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target_file);

            $getData['banner_image'] = $file_name;
        }
        if ($_FILES['portfolio_image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['portfolio_image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/product/";
            $file_name = time() . '_product_main_image3.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["portfolio_image"]["tmp_name"], $target_file);

            $getData['portfolio_image'] = $file_name;
        }
        if ($_FILES['background_image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['background_image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/product/";
            $file_name = time() . '_product_main_image2.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["background_image"]["tmp_name"], $target_file);

            $getData['background_image'] = $file_name;
        }


        $this->common_model->UpdateRecord($getData, 'ds_shop_store_details', 'user_id', $user_id);

        $query = $this->db->select('ds_shop_store_details.*')
                ->from('ds_shop_store_details')
                ->where(array('user_id' => $user_id))
                ->get();
        $chkUserExist = $query->num_rows();
//echo $this->db->last_query();
        $chkUserExist = $query->num_rows();

        if ($chkUserExist == 0) {
            $getaddressData = array(
              
                'shop_description' => $this->input->post('shop_description'),
                'featured_image' => json_encode($this->input->post('featured_product'), true),
                'message_heading' => $this->input->post('message_heading'),
                'message_content' => $this->input->post('message_content'),
                'products' => json_encode($this->input->post('products'), true),
                'title' => $this->input->post('title'),
                'text' => $this->input->post('text'),
                'user_id' => $user_id
            );

            if ($_FILES['banner_image']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION));
                $target_dir = "uploads/product/";
                $file_name = time() . '_product_main_image.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target_file);

                $getData['banner_image'] = $file_name;
            }
            if ($_FILES['portfolio_image']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['portfolio_image']['name'], PATHINFO_EXTENSION));
                $target_dir = "uploads/product/";
                $file_name = time() . '_product_main_image3.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["portfolio_image"]["tmp_name"], $target_file);

                $getData['portfolio_image'] = $file_name;
            }
            if ($_FILES['background_image']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['background_image']['name'], PATHINFO_EXTENSION));
                $target_dir = "uploads/product/";
                $file_name = time() . '_product_main_image2.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["background_image"]["tmp_name"], $target_file);

                $getData['background_image'] = $file_name;
            }


            $this->common_model->AddRecord($getData, 'ds_shop_store_details');
        }


        $message = '<div class="alert alert-success"><p> Service Profile Details has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect(base_url('edit-service'));
    }

//    public function store_bankdetails() {
//        $user_id = $this->session->userdata('USER_ID');
//        $user_type = $this->session->userdata('USER_TYPE');
//        $query = $this->db->select('ds_designer_store_bank_details.*')
//                ->from('ds_designer_store_bank_details')
//                ->where(array('user_id' => $user_id))
//                ->get();
//        $chkUserExist = $query->num_rows();
//
//        $id = $this->input->post('id');
//        $getData = array(
//            'account_no' => $this->input->post('account_no'),
//            'account_holder' => $this->input->post('account_holder'),
//            'iban_code' => $this->input->post('iban_code'),
//            'user_id' => $user_id,
//            'user_type' => $user_type,
//            'branch_name' => $this->input->post('branch_name'),
//            'branch_address' => $this->input->post('branch_address')
//        );
//        print_r($getData);
//
//        if ($chkUserExist == 0) {
//
//            $this->common_model->AddRecord($getData, 'ds_designer_store_bank_details');
//
//
//            $message = '<div class="alert alert-success"><p>Bank Details For Store  has been successfully updated.</p></div>';
//            $this->session->set_flashdata('success', $message);
//            redirect('edit_banks');
//        } else {
//            $this->common_model->UpdateRecord($getData, 'ds_designer_store_bank_details', 'user_id', $id);
//
//
//            $message = '<div class="alert alert-success"><p>Bank Details For Store  has been successfully updated.</p></div>';
//            $this->session->set_flashdata('success', $message);
//            redirect('edit_banks');
//        }
//    }

    public function edit_banks() {
        if ($_POST) {
            $user_id = $this->session->userdata('USER_ID');
            $user_type = $this->session->userdata('USER_TYPE');
            $query = $this->db->select('ds_designer_store_bank_details.*')
                    ->from('ds_designer_store_bank_details')
                    ->where(array('user_id' => $user_id))
                    ->get();
            $chkUserExist = $query->num_rows();

            $id = $this->input->post('id');
            $getData = array(
                'account_no' => $this->input->post('account_no'),
                'account_holder' => $this->input->post('account_holder'),
                'iban_code' => $this->input->post('iban_code'),
                'user_id' => $user_id,
                'user_type' => $user_type,
                'branch_name' => $this->input->post('branch_name'),
                'branch_address' => $this->input->post('branch_address')
            );
//            print_r($getData);exit();

            if ($chkUserExist < 1) {

                $this->common_model->AddRecord($getData, 'ds_designer_store_bank_details');


                $message = '<div class="alert alert-success"><p>Bank Details For Store  has been successfully updated.</p></div>';
                $this->session->set_flashdata('success', $message);
                redirect('edit_banks');
            } else {
                $this->common_model->UpdateRecord($getData, 'ds_designer_store_bank_details', 'user_id', $id);


                $message = '<div class="alert alert-success"><p>Bank Details For Store  has been successfully updated.</p></div>';
                $this->session->set_flashdata('success', $message);
                redirect('edit_banks');
            }
        }
        if ($this->session->userdata('USER_ID') != '') {

            $user_id = $this->session->userdata('USER_ID');
            $data = array();

            $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_designer_store_bank_details', array('user_id' => $user_id));
            $this->load->view('bank-details', $data);
        } else {
            redirect('login');
        }
    }
    
    //s.p-01-02-2021
    public function wishlist_total_data() {
        $user_id = $this->session->userdata('USER_ID');
        $total = count(getUserWishlists($user_id));
        if($total > 0){
            echo $total;
        }
        else{
            echo 0;
        }
    }

    public function wishlists() {

        if ($this->session->userdata('USER_ID') != '') {
            $user_id = $this->session->userdata('USER_ID');
            $p_id = $this->input->post('p_id');
//$id=$this->uri->segment(2);
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                $query = $this->db->select('p_id')
                        ->from('ds_wishlist')
                        ->where(array('p_id' => $p_id))
                        ->where(array('u_id' => $user_id))
                        ->get();
                $pid = $query->num_rows();
                if ($pid == 0) {
                    $getData = array(
                        'p_id' => $this->input->post('p_id'),
                        'qty' => $this->input->post('qty'),
                        'u_id' => $user_id
                    );
                    $this->common_model->AddRecord($getData, 'ds_wishlist');
                    $message = '<div class="alert alert-success"><p>Products has been successfully add in Wishlist.</p></div>';
                } else {
                    $data['flash2'] = 'wrong';
                }
            }
            //call helper function and fetch data s.p-30-01-2021
            $data['query'] = getUserWishlists($user_id);
            $this->session->set_flashdata('success', $message);
            $this->load->view('wishlist', $data);
        } else {
            redirect('login');
        }
    }

    public function delete_wishlist() {

        if ($this->session->userdata('USER_ID') != '') {

            $id = $this->uri->segment(2);

            $this->common_model->Delete('ds_wishlist', $id, 'p_id');
            $message = '<div class="alert alert-success"><p>product has been deleted from wishlist successfully.</p></div>';
            $this->session->set_flashdata('successes', $message);

            redirect('wishlists');
        }
    }

    public function all_pickup() {
        if ($this->session->userdata('USER_ID') != '') {
            $user_id = $this->session->userdata('USER_ID');
            $data = array();
// $data['query'] = $this->common_model->RetriveRecordByWhere('ds_users_address', array('user_id' => $user_id));
// $country=$data['query']['country_id'];
//$state=$data['query']['state_id'];
//$data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array('id' => $country));
//$data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array('id' => $state));

            $this->db->select('ds_pickup_address.*,ds_country.country_name,ds_states.name as state_name');
            $this->db->from('ds_pickup_address');
            $this->db->Join('ds_country', 'ds_pickup_address.country_id = ds_country.id', 'left');
            $this->db->Join('ds_states', 'ds_pickup_address.state_id = ds_states.id', 'left');
            $this->db->where('ds_pickup_address.user_id', $user_id);
            $this->db->order_by('ds_pickup_address.id', 'DESC');
            $data['query'] = $this->db->get();
            $this->load->view('user/all-pickup', $data);
        } else {
            redirect('login');
        }
    }

    public function add_pickup() {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
            $data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array());
            $data['delivery_service'] = $this->common_model->RetriveRecordByWhere('ds_delivery_service_master', array());
            $this->load->view('user/add-pickup', $data);
        } else {
            redirect('login');
        }
    }

    public function save_pickup() {
        $data = array();
        $user_id = $this->session->userdata('USER_ID');

        if (count($this->input->post('delivery_service_id')) == 0) {
            $message = '<div class="alert alert-danger"><p>Please select service.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('add_pickup');
        }
        //pr($this->input->post('delivery_service_id'));
        $getData = array(
            'user_id' => $user_id,
            'address2' => $this->input->post('address2'),
            'postcode' => $this->input->post('postcode'),
            'phone' => $this->input->post('phone'),
            'company_name' => $this->input->post('company_name'),
            'city' => $this->input->post('city'),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
        );


        $this->common_model->AddRecord($getData, 'ds_pickup_address');
        $pickup_id = $this->db->insert_id();

        if (empty($pickup_id)) {
            $message = '<div class="alert alert-danger"><p>Pickup Id not generated.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('all_pickup');
        }

        foreach ($this->input->post('delivery_service_id') as $value) {
            $add_values = array(
                'pickup_master_id' => $pickup_id,
                'delivery_service_id' => $value,
            );
            $this->common_model->AddRecord($add_values, 'ds_delivery_service_map_pickup_master');
        }

        $message = '<div class="alert alert-success"><p>Pickup Adress has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('all_pickup');
    }

    public function delete_pickup() {
        $id = $this->uri->segment(2);
        $this->common_model->Delete('ds_pickup_address', $id, 'id');

        $this->common_model->Delete('ds_delivery_service_map_pickup_master', $id, 'pickup_master_id');

        $message = '<div class="alert alert-success"><p>Pickup Address has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('all_pickup');
    }

    public function update_pickup()
    {
        $user_id = $this->session->userdata('USER_ID');

        $this->common_model->Delete('ds_delivery_method_map', $user_id, 'store_id');

        foreach ($this->input->post('delivery_service_id') as $value){
            $add_values = array(
                'store_id' => $user_id,
                'delivery_service_id' => $value,
            );
            $this->common_model->AddRecord($add_values, 'ds_delivery_method_map');
        }
        if(variable_value_check($this->input->post('company_name'))){

            $table = 'ds_pickup_address';
            $where_clause = ['user_id' => $user_id];

            $check = $this->common_model->RetriveRecordByWhere($table,$where_clause);

            if($check->num_rows() > 0){
                $getData = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'company_name' => $this->input->post('company_name'),
                    'address2' => $this->input->post('address2'),
                    'postcode' => $this->input->post('postcode'),
                    'phone' => $this->input->post('phone'),
                    'country_id' => $this->input->post('country_id'),
                    'state_id' => $this->input->post('state_id'),
                    'city' => $this->input->post('city')
                );
                $this->common_model->UpdateRecord($getData, 'ds_pickup_address', 'user_id', $user_id);
            }else{

                $getData = array(
                    'user_id' => $user_id,
                    'company_name' => $this->input->post('company_name'),
                    'address2' => $this->input->post('address2'),
                    'postcode' => $this->input->post('postcode'),
                    'phone' => $this->input->post('phone'),
                    'country_id' => $this->input->post('country_id'),
                    'state_id' => $this->input->post('state_id'),
                    'city' => $this->input->post('city'),
                );
                $this->common_model->AddRecord($getData, 'ds_pickup_address');
            }
        }

        $message = '<div class="alert alert-success"><p>Delivery method has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('edit_pickup/'.$user_id);
    }

    public function edit_pickup()
    {
        if ($this->session->userdata('USER_ID') != '') {
            $data = array();
            $id = $this->uri->segment(2);
            $user_id = $this->session->userdata('USER_ID');
            $data['user_id'] = $user_id;
            $data['delivery_service'] = $this->common_model->RetriveRecordByWhere('ds_delivery_service_master', array());
            $selected_delivery_service = $this->common_model->RetriveRecordByWhere('ds_delivery_method_map', array('store_id' => $user_id));
            $selected_delivery_service_array = [];
            if($selected_delivery_service->num_rows() > 0){
                foreach ($selected_delivery_service->result() as $value) {
                    $selected_delivery_service_array[] = $value->delivery_service_id;
                }
            }
            $data['selected_delivery_service_array'] = $selected_delivery_service_array;
            $this->load->view('user/edit-pickup', $data);
        } else {
            redirect('login');
        }
    }

    public function get_pickup_address_ajax($store_id)
    {
        $data = array();
        $id = $store_id;
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_pickup_address', array('user_id' => $id));
        $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
        $data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array('country_id' => $data['query']['country_id']));

        echo $this->load->view('user/get_pickup_address_ajax', $data, true);
    }
	 function logout() {
        $is_user_logged_in = $this->session->userdata('USER_ID');

        if (isset($is_user_logged_in) || $is_user_logged_in == TRUE) {

            $data = Array('success_message' => 'Logged out Successfully');
            $this->session->set_userdata($data);

            $this->session->unset_userdata('USER_ID');
            $this->session->unset_userdata('USER_NAME');
            $this->session->unset_userdata('EMAIL');
            $this->session->unset_userdata('design_order_id');
            $this->session->unset_userdata('designer_id');
            $this->session->unset_userdata('customer_id');
            $this->session->unset_userdata('design_type_id');

            redirect('login');
        }
    }


}
