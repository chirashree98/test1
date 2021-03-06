<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Artist_management extends MX_Controller
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

    public function all_artist()
    {
        $this->db->select('ds_designer_worksample.*,ds_users.first_name,ds_users.last_name');
        $this->db->from('ds_designer_worksample');
        $this->db->Join('ds_users', 'ds_designer_worksample.user_id = ds_users.id');
        $this->db->where('ds_users.role_id', 1);
        // $this->db->Join('ds_category', 'ds_products.cat_id = ds_category.id');
        $this->db->order_by('ds_designer_worksample.id', 'DESC');
        $data['query'] = $this->db->get();
//        print_R($data['query']);
//        exit();
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 1, 'is_approved' => '1'));
		 $data['currency'] = $this->common_model->RetriveRecordByWhere('ds_currency', array());
        $this->load->view('artist/all-artist', $data);
    }

    public function add_artist()
    {
        $data = array();
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 1, 'is_approved' => '1'));


        $this->load->view('artist/add-artist', $data);
    }

    public function save_artist()
    {
        $data = array();
        $getData = array(

            'user_id' => $this->input->post('user_id'),
            'name' => $this->input->post('name'),
            'details' => $this->input->post('details'),
            'description' => $this->input->post('description'),
            'cost' => $this->input->post('cost'),
            'currency' => $this->input->post('currency'),
            'status' => 'Y'

        );

        if ($_FILES['image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/artist/";
            $file_name = time() . '_artist_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $getData['image'] = $file_name;
        }
        for ($i = 0; $i < count($_FILES['extra_images']); $i++) {
            if ($_FILES['extra_images']['name'][$i] != '') {
                $ext = strtolower(pathinfo($_FILES['extra_images']['name'][$i], PATHINFO_EXTENSION));
                $target_dir = "uploads/artist/";
                $file_name = time() . '_' . $i . '_artist_image.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["extra_images"]["tmp_name"][$i], $target_file);

                $images[] = $file_name;
            }
        }
        $getData['extra_images'] = json_encode($images);


//        echo "<pre>";
//print_r($getData);
//exit();
        $this->common_model->AddRecord($getData, 'ds_designer_worksample');
        $message = '<div class="alert alert-success"><p>Work Samples has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/artist_management/all_artist');
    }

    public function edit_artist()
    {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_designer_worksample', array('id' => $id));
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 1, 'is_approved' => '1'));

        $this->load->view('artist/edit-artist', $data);
    }

    public function update_artist()
    {
//        print_r($_POST);exit();
        $id = $this->input->post("id");
        $data = array();
        $getData = array(
            'user_id' => $this->input->post('user_id'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'details' => $this->input->post('details'),
            'cost' => $this->input->post('cost'),
            'currency' => $this->input->post('currency')

        );

        if ($_FILES['image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/artist/";
            $file_name = time() . '_artist_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $getData['image'] = $file_name;
        }
        if ($_FILES['imagefile']['name'] == '') {
             $ext = strtolower(pathinfo($_FILES['imagefile']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/artist/";
            $file_name = time() . '_artist_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
        }
        for ($i = 0; $i < count($_POST['old_extra_images']); $i++) {
            $images[] = $_POST['old_extra_images'][$i];
        }
        for ($i = 0; $i < count($_FILES['extra_images']); $i++) {
            if ($_FILES['extra_images']['name'][$i] != '') {
                $ext = strtolower(pathinfo($_FILES['extra_images']['name'][$i], PATHINFO_EXTENSION));
                $target_dir = "uploads/artist/";
                $file_name = time() . '_' . $i . '_artist_image.' . $ext;
                $target_file = $target_dir . $file_name;
                move_uploaded_file($_FILES["extra_images"]["tmp_name"][$i], $target_file);

                $images[] = $file_name;
            }
        }
        $getData['extra_images'] = json_encode($images);
//        echo "<pre>";
//print_r($getData);
//exit();

        $this->common_model->UpdateRecord($getData, 'ds_designer_worksample', 'id', $id);
        $message = '<div class="alert alert-success"><p>Work Samples has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/artist_management/all_artist');
    }


    public function change_artist_status()
    {

        $data = array();
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $save_data['status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'ds_designer_worksample', 'id', $id);
        echo 'ok';
    }

    public function delete_worksamples()
    {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('ds_designer_worksample', $id, 'id');
        $message = '<div class="alert alert-success"><p>Work Samples has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/artist_management/all_artist');
    }

    function get_artistname()
    {
        $data = array();
        //$artist_id = $this->input->post('artist_id');
        $artist_id = $this->uri->segment(4);
        $this->db->select('ds_designer_worksample.*,ds_users.first_name,ds_users.last_name');
        $this->db->from('ds_designer_worksample');
        $this->db->Join('ds_users', 'ds_designer_worksample.user_id = ds_users.id');
        $this->db->where('ds_users.role_id', 1);
        // s.p-30-01-2021
        if($artist_id > 0){
            $this->db->where('ds_designer_worksample.user_id', $artist_id);
        }
        //$this->db->Join('ds_category', 'ds_products.cat_id = ds_category.id');
        $this->db->order_by('ds_designer_worksample.id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('artist/all-artistsorting', $data);

        // $data['rows'] = $this->assignleads_model->get_access_rows($artist_id); //get all rows
        //populate view, specific to this function
        //$this->data['maincontent'] = $this->load->view('admin/maincontents/status-sorting', $data, true);

        //render full layout, specific to this function
        //  $this->load->view('admin/layout-sorting', $this->data);
    }

    public function all_news()
    {
        $this->db->select('*');
        $this->db->from('ds_designer_news');
        //$this->db->Join('ds_users', 'ds_designer_news.user_id = ds_users.id');
        // $this->db->where('ds_designer_news.status', 1);
        // $this->db->Join('ds_category', 'ds_products.cat_id = ds_category.id');
        $this->db->order_by('ds_designer_news.id', 'DESC');
        $data['query'] = $this->db->get();
//        print_R($data['query']);
//        exit();
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 1, 'is_approved' => '1'));
        $this->load->view('artist/all-news', $data);
    }

    public function add_news()
    {
        $data = array();
        // $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 1,'is_approved' => '1'));


        $this->load->view('artist/add-news', $data);
    }

    public function save_news()
    {
        $data = array();
        $getData = array(

            //'user_id' => $this->input->post('user_id'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),

        );
        $getData['created_date'] = date('Y-m-d h:m:s');

        if ($_FILES['image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/news/";
            $file_name = time() . '_news_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $getData['image'] = $file_name;
        }


//        echo "<pre>";
//print_r($getData);
//exit();
        $this->common_model->AddRecord($getData, 'ds_designer_news');
        $message = '<div class="alert alert-success"><p>News has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/artist_management/all_news');
    }

    public function edit_news()
    {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_designer_news', array('id' => $id));
        // $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 1,'is_approved' => '1'));

        $this->load->view('artist/edit-news', $data);
    }

    public function update_news()
    {
//        print_r($_POST);exit();
        $id = $this->input->post("id");
        $data = array();
        $getData = array(
            //'user_id' => $this->input->post('user_id'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );
        $getData['updated_date'] = date('Y-m-d h:m:s');

        if ($_FILES['image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $target_dir = "uploads/news/";
            $file_name = time() . '_news_main_image.' . $ext;
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $getData['image'] = $file_name;
        }

//        echo "<pre>";
//print_r($getData);
//exit();

        $this->common_model->UpdateRecord($getData, 'ds_designer_news', 'id', $id);
        $message = '<div class="alert alert-success"><p>News has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/artist_management/all_news');
    }


    public function change_news_status()
    {

        $data = array();
        $id = $this->input->post('id');
        $value = $this->input->post('val');
        $save_data['status'] = $value;
        $this->common_model->UpdateRecord($save_data, 'ds_designer_news', 'id', $id);
        echo 'ok';
    }

    public function delete_news()
    {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('ds_designer_news', $id, 'id');
        $message = '<div class="alert alert-success"><p>News has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/artist_management/all_news');
    }

    public function all_artistquote()
    {
        $this->db->select('ds_designer_quote.*,ds_users.first_name,ds_users.last_name');
        $this->db->from('ds_designer_quote');
        $this->db->Join('ds_users', 'ds_designer_quote.designer_id = ds_users.id');
        $this->db->where('ds_users.role_id', 1);
        //$this->db->Join('ds_category', 'ds_products.cat_id = ds_category.id');
        $this->db->order_by('ds_designer_quote.id', 'DESC');
        $data['query'] = $this->db->get();
        //print_R($data['query']);
        //exit();
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 1, 'is_approved' => '1'));
        $this->load->view('artist/all-artistquote', $data);
    }
    
     public function all_projectquote()
    {

       $this->db->select('ds_designer_quote.name as ename,ds_designer_quote.phone,ds_designer_quote.message,ds_designer_quote.email,ds_designer_quote.project_id,ds_designer_quote.designer_id,ds_designer_quote.date,ds_designer_worksample.*,ds_users.*');
       $this->db->from('ds_designer_quote');
      
        $this->db->Join('ds_users', 'ds_designer_quote.designer_id = ds_users.id');
       
       
       $this->db->join('ds_designer_worksample','ds_designer_worksample.id=ds_designer_quote.project_id');
       	$this->db->order_by('ds_designer_quote.id', 'DESC');
       $data['query']=$this->db->get();
       $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 1, 'is_approved' => '1'));
        $this->load->view('artist/all-projectquote', $data);
    }

    function get_artistnamequote()
    {
        $data = array();
        //$artist_id = $this->input->post('artist_id');
        $artist_id = $this->uri->segment(4);
        $this->db->select('ds_designer_quote.*,ds_users.first_name,ds_users.last_name');
        $this->db->from('ds_designer_quote');
        $this->db->Join('ds_users', 'ds_designer_quote.designer_id = ds_users.id');
        $this->db->where('ds_users.role_id', 1);
        $this->db->where('ds_designer_quote.designer_id', $artist_id);
        $this->db->order_by('ds_designer_quote.id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('artist/all-artistsortingquote', $data);
    }
    function get_artistnamequote2()
    {
        $data = array();
        //$artist_id = $this->input->post('artist_id');
        $artist_id = $this->uri->segment(4);
         $this->db->select('ds_designer_quote.name as ename,ds_designer_quote.phone,ds_designer_quote.message,ds_designer_quote.email,ds_designer_quote.project_id,ds_designer_quote.designer_id,ds_designer_quote.date,ds_designer_worksample.*,ds_users.*');
       $this->db->from('ds_designer_quote');
      	$this->db->Join('ds_users', 'ds_designer_quote.designer_id = ds_users.id');
       $this->db->join('ds_designer_worksample','ds_designer_worksample.id=ds_designer_quote.project_id');
       $this->db->where('ds_users.role_id', 1);
        $this->db->where('ds_designer_quote.designer_id', $artist_id);
        $this->db->order_by('ds_designer_quote.id', 'DESC');
		$data['query']=$this->db->get();
        
        $this->load->view('artist/all-worksamplesortingsortingquote2', $data);
    }

    function get_designstorename()
    {
        $artist_id = $this->uri->segment(4);
        $this->db->select('ds_pickup_address.*,ds_users.first_name,ds_users.last_name');
        $this->db->from('ds_pickup_address');
        $this->db->Join('ds_users', 'ds_pickup_address.user_id = ds_users.id');
        $this->db->where('ds_users.role_id', 6);
        $this->db->where('ds_pickup_address.user_id', $artist_id);
        $this->db->order_by('ds_pickup_address.id', 'DESC');
        $data['query'] = $this->db->get();
        $this->load->view('artist/all-designstoresorting', $data);
    }

    public function getstate()
    {
        $data = array();

        $states = $this->common_model->RetriveRecordByWhere('ds_states', array('country_id' => $_POST['country_id']));
        $html = '';
        if ($states->num_rows() > 0) {
            foreach ($states->result() as $row) {
                $html .= ' <option value="' . $row->id . '">' . $row->name . '</option>';
            }
        } else {
            $html .= ' <option value="">Select State</option>';
        }
        echo $html;
    }

    public function delete_pickupaddress()
    {
        $id = $this->uri->segment(4);
        $this->common_model->Delete('ds_pickup_address', $id, 'id');
        $message = '<div class="alert alert-success"><p>Pickup Address has been deleted successfully.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('admin/artist_management/all_pickupaddress');
    }


    public function add_pickupaddress()
    {

        $data = array();
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 6, 'is_approved' => '1'));

        $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());

        $data['delivery_service'] = $this->common_model->RetriveRecordByWhere('ds_delivery_service_master', array());

        $this->load->view('artist/add-pickupaddress', $data);
    }

    public function save_pickupaddress()
    {
        $check_user = $this->common_model->RetriveRecordByWhere('ds_pickup_address', array('user_id' => $this->input->post('user_id')));

        if($check_user->num_rows() > 0){
            $message = '<div class="alert alert-danger"><p>Sorry, this user already have a delivery method.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/artist_management/add_pickupaddress');
        }

        if(count($this->input->post('delivery_service_id')) == 0){
            $message = '<div class="alert alert-danger"><p>Please select service.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/artist_management/add_pickupaddress');
        }

        $data = array();

        $getData = array(
            'user_id' => $this->input->post('user_id'),
            'company_name' => $this->input->post('company_name'),
            'address2' => $this->input->post('address2'),
            'postcode' => $this->input->post('postcode'),
            'phone' => $this->input->post('phone'),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city' => $this->input->post('city'),
        );


        $this->common_model->AddRecord($getData, 'ds_pickup_address');
        $pickup_id = $this->db->insert_id();

        if(empty($pickup_id)){
            $message = '<div class="alert alert-danger"><p>Pickup Id not generated.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('all_pickup');
        }

        foreach ($this->input->post('delivery_service_id') as $value){
            $add_values = array(
                'pickup_master_id' => $pickup_id,
                'delivery_service_id' => $value,
            );
            $this->common_model->AddRecord($add_values, 'ds_delivery_service_map_pickup_master');
        }

        $message = '<div class="alert alert-success"><p>Pickup Address has been successfully added.</p></div>';
        $this->session->set_flashdata('success', $message);

        redirect('admin/artist_management/all_pickupaddress');
    }

    public function edit_pickupaddress()
    {
        $data = array();
        $id = $this->uri->segment(4);
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_pickup_address', array('id' => $id));
        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 6, 'is_approved' => '1'));
        $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
        $data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array('country_id' => $data['query']['country_id']));

        $data['delivery_service'] = $this->common_model->RetriveRecordByWhere('ds_delivery_service_master', array());

        $selected_delivery_service = $this->common_model->RetriveRecordByWhere('ds_delivery_service_map_pickup_master', array('pickup_master_id' => $id));
        $selected_delivery_service_array = [];
        if($selected_delivery_service->num_rows() > 0){
            foreach ($selected_delivery_service->result() as $value) {
                $selected_delivery_service_array[] = $value->delivery_service_id;
            }
        }

        $data['selected_delivery_service_array'] = $selected_delivery_service_array;

        $this->load->view('artist/edit-pickupaddress', $data);
    }


    public function update_pickupaddress()
    {
// print_r($_POST);exit();
        $id = $this->input->post("id");

        if(count($this->input->post('delivery_service_id')) == 0){
            $message = '<div class="alert alert-danger"><p>Please select service.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('edit_pickupaddress/'.$id);
        }

        $data = array();
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

        $this->common_model->UpdateRecord($getData, 'ds_pickup_address', 'id', $id);

        $this->common_model->Delete('ds_delivery_service_map_pickup_master', $id, 'pickup_master_id');

        foreach ($this->input->post('delivery_service_id') as $value){
            $add_values = array(
                'pickup_master_id' => $id,
                'delivery_service_id' => $value,
            );
            $this->common_model->AddRecord($add_values, 'ds_delivery_service_map_pickup_master');
        }

        $message = '<div class="alert alert-success"><p>Pickup Address has been successfully updated.</p></div>';
        $this->session->set_flashdata('success', $message);

//        $data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
//        $data['state'] = $this->common_model->RetriveRecordByWhere('ds_states', array('country_id' => $data['query']['country_id']));
        redirect('admin/artist_management/all_pickupaddress', $data);
    }

    public function all_pickupaddress()
    {
        $this->db->select('ds_pickup_address.*,ds_users.first_name,ds_users.last_name');
        $this->db->from('ds_pickup_address');
        $this->db->Join('ds_users', 'ds_pickup_address.user_id = ds_users.id');
        $this->db->where('ds_users.role_id', 6);

        $this->db->order_by('ds_pickup_address.id', 'DESC');
        $data['query'] = $this->db->get();

        $data['ss_users'] = $this->common_model->RetriveRecordByWhere('ds_users', array('role_id' => 6, 'is_approved' => '1'));
        $this->load->view('artist/all-pickupaddress', $data);
    }

}
