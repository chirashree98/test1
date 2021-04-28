<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->model(array('common_model', 'adminlogin'));
    }

    public function index() {
        $this->load->view('login');
    }

    public function login() {
         $username = $this->input->post('username');
   $password = md5($this->input->post('password'));
		
        //// Login check//////
        $query = $this->adminlogin->loginCheck($username, $password);
        //echo $this->db->last_query(); exit();
        $row = $query->row();
        
//                print_r($row);echo $row->u_status;exit();
        if ($query->num_rows() > 0) {
          
                $this->session->set_userdata('EMAIL', $row->email);
                $this->session->set_userdata('ADMIN_ID', $row->id);                
                $this->session->set_userdata('USERTYPE', $row->usertype);
                redirect('admin/dashboard');
           
                $message = '<div class="alert alert-danger">Your account is inactive!!</div>';
                $this->session->set_flashdata('success', $message);
                redirect('admin');
            }
         else {

            $message = '<div class="alert alert-danger">Invalid username or password!!</div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin');
        }
    }

     public function all_subscribed_emails() {
        //echo "lll"; die;
        $this->db->select('subscribed.*')->from('subscribed')->order_by('id','desc');;
        $data['query'] = $this->db->get();

        $this->load->view('vereniging/all_subscribed_email', $data);
    }

public function all_user() {
        $this->db->select('ds_users.*');
		//$this->db->where('role_id!=', 1);
        $this->db->from('ds_users'); 
        $this->db->order_by('id', 'DESC');
        $data['users'] = $this->db->get();
		 if (isset($_GET['edit']) && !isset($_POST['edit'])) {
		$data = array();
        $id = $this->uri->segment(4);
        $data['user'] = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $id));
		$this->load->view('user/all-user', $data);
		}
        $this->load->view('user/all-user', $data);
    }
	
	
	public function all_designer() {
        $this->db->select('ds_users.*');
		$this->db->where('role_id', 1);
        $this->db->from('ds_users'); 
        $this->db->order_by('id', 'DESC');
        $data['users'] = $this->db->get();
		
        $this->load->view('user/all-designer', $data);
    }
	
	public function all_designerstore() {
        $this->db->select('ds_users.*');
		$this->db->where('role_id', 6);
        $this->db->from('ds_users'); 
        $this->db->order_by('id', 'DESC');
        $data['users'] = $this->db->get();
		
        $this->load->view('user/all-designerstore', $data);
    }
public function all_customer() {
        $this->db->select('ds_users.*');
		$this->db->where('role_id', 4);
        $this->db->from('ds_users'); 
        $this->db->order_by('id', 'DESC');
        $data['users'] = $this->db->get();
		
        $this->load->view('user/all-customer', $data);
    }

	
	
	 public function edit_user() {
        $data = array();
        $id = $this->uri->segment(3);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $id));
        $this->load->view('user/edit-user', $data);
    }

    public function update_user() {
//        print_r($_POST);exit();
        $id = $this->input->post("id");
        $data = array();
        $getData = array(
            
            'is_approved' => $this->input->post('is_approved'),
        );
        
        //$getData['updated_at'] = date('Y-m-d h:m:s');
		
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_users', array('id' => $id));
					$data['name'] = $data['query']['first_name'] . ' ' .$_POST['last_name'];
					$data['email'] = $data['query']['email'];
					$data['password'] = $data['query']['password'];
					$from_email = "designstoreowner@gmail.com";
					$to_email = $data['query']['email'];
					$this->email->from($from_email, 'Design Studio');
					$this->email->to($to_email);
					$this->email->subject('Approval of Registration Request');
					
					$mesg = $this->load->view('user/approve_email',$data,true);				
					$this->email->set_mailtype("html");
					$this->email->message($mesg);
					//Send mail
					if($this->email->send()) {
						
						$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
					}
					else{
						$this->session->set_flashdata("email_sent","You have encountered an error");		    
					}			

        $this->common_model->UpdateRecord($getData, 'ds_users', 'id', $id);
        $message = '<div class="alert alert-success"><p>User has been Approved successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/all_user');
    }

 public function delete_user() {
        $id = $this->uri->segment(3);
        $this->common_model->Delete('ds_users', $id, 'id');
        $message = '<div class="alert alert-success"><p>User has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/all_user');
    }	
		public function users_approval()
    {        
        //$this->login_check();
        
      
					if($_POST['is_approved'] == 0)
                    {
						$data['approve'] = 'Deactivate';
					}
					else{
						$data['approve'] = 'Approve';
						
					}
					
					
          if (isset($_GET['tostatus']) && isset($_GET['codeid'])) {
           $this->common_model->changeStoreStatus($_GET['codeid'], $_GET['tostatus']);
            redirect('admin/all_user');
        }

      
       

         $this->load->view('user/all_user', $data);
    }


	

}
