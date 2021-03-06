<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_dashboard_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function design_service_type() {
        $this->db->select('*');
        $this->db->from('ds_services_types');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
	public function  orders25()
	{
		 $this->db->select('MAORD.*, OLORD.orderid AS design_request_order_id, USR.id AS customer_id');
		 $this->db->from('ds_order_master AS MAORD');
		 $this->db->join('ds_orders AS OLORD','MAORD.design_request_order_id = OLORD.id','left');
		  $this->db->join('ds_users AS USR','MAORD.customer_id = USR.id','left');
			//$this->db->where('MAORD.order_no',$orderno);
			$this->db->order_by('MAORD.create_date', 'DESC');
			
			//$this->db->order_by('MAORD.create_time', 'DESC');
			   $this->db->where('USR.id',$this->session->userdata('USER_ID'));
        
       
       
       
        
        $query = $this->db->get();
        $row = $query->num_rows();
        return $row;
		
		
		
		  //$where = array('USR.id' => $this->session->userdata('USER_ID') );
       
       
        //$this->db->order_by('O.created_date', 'DESC');
     

    }


   public function design_request_list($customer_id,$filter_designer_id = FALSE,$limit,$start) {
        $this->db->select('O.orderid, O.payment_type, O.created_date, AT.first_name,O.service_id, AT.last_name, O.message, O.request_action AS order_status, O.id AS order_table_id, ST.type_name, O.userid AS designer_id');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
       
		  if ($filter_designer_id) {
            $this->db->where('O.service_id', $filter_designer_id);
        }
		 $this->db->where('O.customer_id', $customer_id);
		 $this->db->limit($limit,$start);
        $this->db->order_by('O.created_date', 'DESC');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
	public function design_request_list2($customer_id,$filter_designer_id = FALSE,$limit,$start) {
        $this->db->select('O.orderid, O.payment_type, O.created_date, AT.first_name,O.service_id, AT.last_name, O.message, O.request_action AS order_status, O.id AS order_table_id, ST.type_name, O.userid AS designer_id');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
       
		  if ($filter_designer_id) {
            $this->db->where('O.service_id', $filter_designer_id);
        }
		 $this->db->where('O.customer_id', $customer_id);
        $this->db->order_by('O.created_date', 'DESC');
		 $this->db->limit($limit,$start);
        $query = $this->db->get();
       
        return $query;
    }
	 public function search($orderno)
	{
		 
    
       $this->db->select('O.orderid, O.payment_type, O.created_date, AT.first_name,O.service_id, AT.last_name, O.message, O.request_action AS order_status, O.id AS order_table_id, ST.type_name, O.userid AS designer_id');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
     
            $this->db->where('O.orderid', $orderno);
			$this->db->where("O.orderid LIKE '%$orderno%'");
       
       
        $this->db->order_by('O.created_date', 'DESC');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
	 public function searchorder($orderno)
	{
		 $this->db->select('MAORD.*, OLORD.orderid AS design_request_order_id, USR.id AS customer_id');
		 $this->db->from('ds_order_master AS MAORD');
		 $this->db->join('ds_orders AS OLORD','MAORD.design_request_order_id = OLORD.id','left');
		  $this->db->join('ds_users AS USR','MAORD.customer_id = USR.id','left');
     $this->db->where('MAORD.order_no',$orderno);
        
        $this->db->where("MAORD.order_no LIKE '%$orderno%'");
        $this->db->where('USR.id',$this->session->userdata('USER_ID'));
       
        //$this->db->order_by('O.created_date', 'DESC');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
		
		
		
		  //$where = array('USR.id' => $this->session->userdata('USER_ID') );
       
       
        //$this->db->order_by('O.created_date', 'DESC');
     

    }
	 public function  ordersdata($limit,$start)
	{
		 $this->db->select('MAORD.*, OLORD.orderid AS design_request_order_id, USR.id AS customer_id');
		 $this->db->from('ds_order_master AS MAORD');
		 $this->db->join('ds_orders AS OLORD','MAORD.design_request_order_id = OLORD.id','left');
		  $this->db->join('ds_users AS USR','MAORD.customer_id = USR.id','left');
			//$this->db->where('MAORD.order_no',$orderno);
			$this->db->order_by('MAORD.create_date', 'DESC');
			$this->db->limit($limit,$start);
			//$this->db->order_by('MAORD.create_time', 'DESC');
			 $this->db->where('USR.id',$this->session->userdata('USER_ID'));
			 
        
       
       
       
        
        $query = $this->db->get();
        $row = $query->result_array();
		
        return $row;
		
		
		
		  //$where = array('USR.id' => $this->session->userdata('USER_ID') );
       
       
        //$this->db->order_by('O.created_date', 'DESC');
     


    }
	public function  orders2($limit,$start)
	{
		 $this->db->select('MAORD.*, OLORD.orderid AS design_request_order_id, USR.id AS customer_id');
		 $this->db->from('ds_order_master AS MAORD');
		 $this->db->join('ds_orders AS OLORD','MAORD.design_request_order_id = OLORD.id','left');
		  $this->db->join('ds_users AS USR','MAORD.customer_id = USR.id','left');
			//$this->db->where('MAORD.order_no',$orderno);
			$this->db->order_by('MAORD.create_date', 'DESC');
			$this->db->limit($limit,$start);
			//$this->db->order_by('MAORD.create_time', 'DESC');
			 $this->db->where('USR.id',$this->session->userdata('USER_ID'));
			 
        
       
       
       
        
        $query = $this->db->get();
        
       
       
       
        
        
        
        return $query;
		
		
		
		  //$where = array('USR.id' => $this->session->userdata('USER_ID') );
       
       
        //$this->db->order_by('O.created_date', 'DESC');
     

    }



    public function design_request_view($order_table_id) {
        $this->db->select('O.job_close_status_artist, O.job_close_status_admin, O.created_date, AT.first_name, AT.last_name, ATP.profile_image, O.message, O.request_action AS order_status, O.id AS order_table_id, O.request_action, O.request_action_date, O.service_id, O.userid, O.customer_id, ST.type_name, SEF.file_name, O.request_action_customer,O.currency');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');

        $this->db->join('ds_user_other_details AS ATP', 'ATP.user_id = AT.id', 'left');

        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
        $this->db->join('service_enq_files AS SEF', 'SEF.order_table_id = O.id', 'left');
        $this->db->where('O.id', $order_table_id);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function chat_data_fetch($order_table_id) {
        $this->db->select('AT.first_name AS designer_fname, AT.last_name AS designer_lname, ATP.profile_image AS designer_profile_pic, C.first_name AS customer_fname, C.last_name AS customer_lname, CP.profile_image AS customer_profile_pic, DC.text_messages, DC.added_date_time, DC.chat_show_status, O.created_date AS order_created_date, O.request_action_date AS request_accepted_date, O.request_action, DC.id AS chat_id');
        $this->db->from('ds_designer_chat AS DC');
        $this->db->join('ds_orders AS O', 'O.id = DC.order_table_id', 'left');

        $this->db->join('ds_users AS AT', 'AT.id = DC.chat_person_id', 'left');
        $this->db->join('ds_users AS C', 'C.id = DC.customer_id', 'left');

        $this->db->join('ds_user_other_details AS ATP', 'ATP.user_id = AT.id', 'left');
        $this->db->join('ds_user_other_details AS CP', 'CP.user_id = C.id', 'left');

        $this->db->join('ds_services_types AS ST', 'ST.id = DC.design_type_id', 'left');
        $this->db->where('DC.order_table_id', $order_table_id);
        $this->db->where('O.request_action', 'ACCEPTED');
        $this->db->order_by("DC.added_date_time", "asc");
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function insert_chat_data($column_data = array()) {
        $this->db->insert('ds_designer_chat', $column_data);
        $query = $this->db->insert_id();
        return $query;
    }

    public function insert_chat_attachments($column_data = array()) {
        $query = $this->db->insert('ds_designer_chat_attachments', $column_data);
        return $query;
    }

    public function view_chat_attachments($chat_id = FALSE) {
        $this->db->select('attachment_file, attachment_type');
        $this->db->from('ds_designer_chat_attachments');
        $this->db->where('designer_chat_id', $chat_id);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function update_unseen_messages($order_table_id = FALSE, $chat_person_id = FALSE)
    {
        $this->db->set('chat_show_status', 'SEEN');
        $this->db->where('order_table_id', $order_table_id);
        $this->db->where('chat_person_id', $chat_person_id);
        $query = $this->db->update('ds_designer_chat');
        return $query;
    }

    public function count_chat_designer($order_table_id = FALSE, $designer_id = FALSE)
    {
        $this->db->where('order_table_id', $order_table_id);
        $this->db->where('chat_person_id', $designer_id);
        $this->db->where('chat_show_status', 'UNSEEN');
        $this->db->from('ds_designer_chat');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function total_count_chat_designer($designer_id = FALSE)
    {
        $this->db->where('chat_person_id', $designer_id);
        $this->db->where('chat_show_status', 'UNSEEN');
        $this->db->from('ds_designer_chat');
        $query = $this->db->count_all_results();
        return $query;
    }
	 public function ordercount_job()
	{
		 
    
        $this->db->select('O.orderid, O.payment_type, O.created_date, AT.first_name,O.service_id, AT.last_name, O.message, O.request_action AS order_status, O.id AS order_table_id, ST.type_name, O.userid AS designer_id');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
      $this->db->order_by('O.created_date', 'DESC');
        $query = $this->db->get();
         
        return $query->num_rows();
    }

    //Design request code start

    public function check_cart_exist($user_id = FALSE) {
        $this->db->where('block_status', 'NO');
        $this->db->where('user_id', $user_id);
        $query = $this->db->count_all_results('ds_temp_cart');
        return $query;
    }

    public function pay_charge_design_page_data($designer_id, $service_type_id) {

        $this->db->select('ds_users.first_name,ds_users.last_name, ds_users.id as user_main_id,ds_user_other_details.profile_image, ds_all_artist_services_details.cost, ST.type_name AS design_type, ST.id AS design_type_id,ds_all_artist_services_details.currency_id,ds_currency.*');
        $this->db->from('ds_users');
        $this->db->Join('ds_user_other_details', 'ds_user_other_details.user_id = ds_users.id', 'left');
        $this->db->Join('ds_all_artist_services_details', 'ds_all_artist_services_details.artist_id = ds_users.id', 'left');
        $this->db->Join('ds_services_types AS ST', 'ST.id = ds_all_artist_services_details.service_type_id', 'left');
		  $this->db->Join('ds_currency', 'ds_currency.currency_id = ds_all_artist_services_details.currency_id', 'left');
        $this->db->where('ds_users.id', $designer_id);
        $this->db->where('ds_all_artist_services_details.service_type_id', $service_type_id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function product_block_in_cart($user_id, $update_columns = array()) {

        $this->db->where('block_status', 'NO');
        $this->db->where('user_id', $user_id);
        $this->db->update('ds_temp_cart', $update_columns);
    }

    public function get_wallet_amount($user_id)
    {
        $this->db->select('wallet_amount');
        $this->db->from('ds_users');
        $this->db->where('id', $user_id);
        $result = $this->db->get()->row_array();

        return $result;
    }

    public function update_wallet_amount($user_id, $wallet_amount) {

        $this->db->set('wallet_amount', $wallet_amount);
        $this->db->where('id', $user_id);
        $this->db->update('ds_users');
    }

}
?>