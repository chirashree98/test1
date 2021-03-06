<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Artist_dashboard_model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();
    }

    public function design_service_type()
    {
        $this->db->select('*');
        $this->db->from('ds_services_types');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function get_design_type_slug($design_id)
    {
        $this->db->select('*');
        $this->db->from('ds_services_types');
        $this->db->where('status', 'Y');
        $this->db->where('id', $design_id);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
	 public function search($orderno)
	{
		 
    
        $this->db->select('O.orderid AS job_number,O.service_id, O.created_date, C.first_name, C.last_name, O.message, O.request_action, O.id AS order_table_id, ST.type_name, O.customer_id');
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
	 public function ordercount()
	{
		 
    
        $this->db->select('O.orderid AS job_number,O.service_id, O.created_date, C.first_name, C.last_name, O.message, O.request_action, O.id AS order_table_id, ST.type_name, O.customer_id');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
		$this->db->order_by('O.created_date', 'DESC');
        $query = $this->db->get();
         
        return $query->num_rows();
    }


    public function accept_decline_request_list($artist_id, $filter_designer_id = FALSE,$limit, $start)
    {
        $this->db->select('O.orderid AS job_number,O.service_id, O.created_date, C.first_name, C.last_name, O.message, O.request_action, O.id AS order_table_id, ST.type_name, O.customer_id');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
        if ($filter_designer_id) {
            $this->db->where('O.service_id', $filter_designer_id);
        }
		 
        $this->db->where('O.userid', $artist_id);
		$this->db->limit($limit,$start);
        $this->db->order_by('O.created_date', 'DESC');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
	 public function accept_decline_request_list2($artist_id, $filter_designer_id = FALSE,$limit, $start)
    {
        $this->db->select('O.orderid AS job_number,O.service_id, O.created_date, C.first_name, C.last_name, O.message, O.request_action, O.id AS order_table_id, ST.type_name, O.customer_id');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
        if ($filter_designer_id) {
            $this->db->where('O.service_id', $filter_designer_id);
        }
		 
        $this->db->where('O.userid', $artist_id);
		$this->db->limit($limit,$start);
        $this->db->order_by('O.created_date', 'DESC');
        $query = $this->db->get();
		return $query;
        
    }

    public function accept_decline_request_view($order_table_id)
    {
        $this->db->select('O.created_date, C.first_name, C.last_name, CP.profile_image, O.message, O.request_action, O.id AS order_table_id, ST.type_name, SEF.file_name, O.request_action, O.created_date, O.service_id, O.customer_id, O.userid AS designer_id, O.totalamount AS designer_type_amount, ASD.cost_type AS designer_service_cost_type, ASD.cost AS designer_service_cost');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_user_other_details AS CP', 'CP.user_id = C.id', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
        $this->db->join('service_enq_files AS SEF', 'SEF.order_table_id = O.id', 'left');
        $this->db->join('ds_all_artist_services_details AS ASD', 'ASD.artist_id = O.userid', 'left');
		$this->db->where('O.id', $order_table_id);
		$this->db->group_by('O.id'); 
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function accept_decline_request_view_artist($order_table_id)
    {
        $this->db->select('O.job_close_status_artist, O.job_close_date, O.job_close_status_admin, O.created_date, O.orderid AS job_number, O.message, O.request_action, O.id AS order_table_id, ST.type_name, SEF.file_name, O.request_action, O.created_date, O.service_id, O.customer_id, O.userid AS designer_id, O.totalamount AS designer_type_amount, ASD.cost_type,O.currency');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
        $this->db->join('service_enq_files AS SEF', 'SEF.order_table_id = O.id', 'left');
        $this->db->join('ds_all_artist_services_details AS ASD', 'ASD.artist_id = O.userid', 'left');
        $this->db->where('O.id', $order_table_id);
        $query = $this->db->get();
//        echo $this->db->last_query();exit;
        $row = $query->result_array();
        return $row;
    }

    function update_order_action($order_table_id, $value)
    {
        $this->db->set('request_action', $value);
        $this->db->set('request_action_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $order_table_id);
        $query = $this->db->update('ds_orders');
        return $query;
    }

    public function chat_data_fetch($order_table_id)
    {
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

    public function insert_chat_data($column_data = array())
    {
        $this->db->insert('ds_designer_chat', $column_data);
        $query = $this->db->insert_id();
        return $query;
    }

    public function insert_chat_attachments($column_data = array())
    {
        $query = $this->db->insert('ds_designer_chat_attachments', $column_data);
        return $query;
    }

    public function update_unseen_messages($order_table_id = FALSE, $customer_id = FALSE)
    {
        $this->db->set('chat_show_status', 'SEEN');
        $this->db->where('order_table_id', $order_table_id);
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->update('ds_designer_chat');
        return $query;
    }

    public function count_chat_customer($order_table_id = FALSE, $customer_id = FALSE)
    {
        $this->db->where('order_table_id', $order_table_id);
        $this->db->where('customer_id', $customer_id);
        $this->db->where('chat_show_status', 'UNSEEN');
        $this->db->from('ds_designer_chat');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function total_count_chat_customer($customer_id = FALSE)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('chat_show_status', 'UNSEEN');
        $this->db->from('ds_designer_chat');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function check_design_request_hour($order_id = FALSE)
    {
        $this->db->select('DRH.hours, O.created_date AS design_request_date_time');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_design_request_hours AS DRH', 'O.service_id = DRH.design_service_type_id', 'left');
        $this->db->where('O.id', $order_id);
        $this->db->where('O.request_action', 'ACCEPTED');
        $query = $this->db->get();

        $design_conversation_status = FALSE;

        if ($query->num_rows() > 0) {
            $design_request_hour = $query->result_array();

            $design_request_date_time = $design_request_hour[0]['design_request_date_time'];
            $design_request_hours = $design_request_hour[0]['hours'];
            $current_date_time = time();

            $expire_date_time = strtotime($design_request_date_time) + ($design_request_hours * 3600);

            if ($expire_date_time >= $current_date_time) {
                $design_conversation_status = TRUE;
            } else {
                $design_conversation_status = FALSE;
            }
        }

        return $design_conversation_status;
    }

    public function check_design_request_hour_before_action($order_id = FALSE)
    {
        $this->db->select('DRH.hours, O.created_date AS design_request_date_time');
        $this->db->from('ds_orders AS O');
        $this->db->join('ds_design_request_hours AS DRH', 'O.service_id = DRH.design_service_type_id', 'left');
        $this->db->where('O.id', $order_id);
        $query = $this->db->get();

        $design_conversation_status = FALSE;

        if ($query->num_rows() > 0) {
            $design_request_hour = $query->result_array();

            $design_request_date_time = $design_request_hour[0]['design_request_date_time'];
            $design_request_hours = $design_request_hour[0]['hours'];
            $current_date_time = time();

            $expire_date_time = strtotime($design_request_date_time) + ($design_request_hours * 3600);

            if ($expire_date_time >= $current_date_time) {

                $design_conversation_status = TRUE;
            } else {
                $design_conversation_status = FALSE;
            }
        }

        return $design_conversation_status;
    }

    public function quotation_hour_check_from_designer($order_id = FALSE)
    {
        $this->db->select('OR.created_date AS order_date_time');
        $this->db->from('ds_orders AS OR');
        $this->db->join('ds_all_artist_services_details AS ASD', 'ASD.artist_id = OR.userid', 'left');
        $this->db->join('ds_design_request_quotation_milestones AS DRMS', 'DRMS.order_id = OR.id', 'left');
        $this->db->where(['OR.id' => $order_id, 'OR.service_id' => 1, 'OR.request_action' => 'ACCEPTED', 'ASD.cost_type' => 'VARIABLE', 'ASD.service_type_id' => 1, 'DRMS.order_id' => NULL]);
        $query = $this->db->get();

        $quotation_hour_status = FALSE;

        if ($query->num_rows() > 0) {

            $order_result = $query->row_array();

            $this->db->select('request_hours_to_designer');
            $this->db->from('ds_quotation_hours');
            $this->db->where('status', 'ON');
            $result = $this->db->get()->row_array();

            $order_date_time = $order_result['order_date_time'];
            $request_hours_to_designer = $result['request_hours_to_designer'];

            $current_date_time = time();
            $expire_date_time = strtotime($order_date_time) + ($request_hours_to_designer * 3600);

            if ($expire_date_time >= $current_date_time) {
                $quotation_hour_status = TRUE;
            }
        }

        return $quotation_hour_status;
    }

    public function quotation_hour_check_from_customer($order_id = FALSE)
    {
        //$this->db->select('OR.created_date AS order_date_time');
        $this->db->select('DRMS.designer_action_date_time AS order_date_time');
        $this->db->from('ds_orders AS OR');
        $this->db->join('ds_all_artist_services_details AS ASD', 'ASD.artist_id = OR.userid', 'left');
        $this->db->join('ds_design_request_quotation_milestones AS DRMS', 'DRMS.order_id = OR.id', 'left');
        $this->db->where(['OR.id' => $order_id, 'OR.service_id' => 1, 'OR.request_action' => 'ACCEPTED', 'ASD.cost_type' => 'VARIABLE', 'ASD.service_type_id' => 1, 'DRMS.order_id' => $order_id]);
        $query = $this->db->get();

        $quotation_hour_status = FALSE;

        if ($query->num_rows() > 0) {

            $order_result = $query->row_array();

            $this->db->select('response_hours_from_customer');
            $this->db->from('ds_quotation_hours');
            $this->db->where('status', 'ON');
            $result = $this->db->get()->row_array();

            $order_date_time = $order_result['order_date_time'];
            $request_hours_to_customer = $result['response_hours_from_customer'];

            $current_date_time = time();
            $expire_date_time = strtotime($order_date_time) + ($request_hours_to_customer * 3600);

            if ($expire_date_time >= $current_date_time) {
                $quotation_hour_status = TRUE;
            }
        }

        return $quotation_hour_status;
    }

    public function get_designer_type_order_details($order_id = FALSE)
    {
        $this->db->select('ORD.customer_id, ORD.userid AS designer_id, ORD.totalamount AS order_amount, ORD.created_date AS order_date, ORD.request_action AS order_status, ORD.service_id, SRT.type_name AS service_type_name, COS.cost_type AS service_cost_type, COS.cost AS service_cost_amount, CONCAT(CUS.first_name, " ", CUS.last_name) AS customer_full_name, CONCAT(DES.first_name, " ", DES.last_name) AS designer_full_name', FALSE);
        $this->db->from('ds_orders AS ORD');
        $this->db->join('ds_services_types AS SRT', 'SRT.id = ORD.service_id', 'left');
        $this->db->join('ds_users AS CUS', 'CUS.id = ORD.customer_id', 'left');
        $this->db->join('ds_users AS DES', 'DES.id = ORD.userid', 'left');
        $this->db->join('ds_all_artist_services_details AS COS', 'COS.service_type_id = ORD.service_id AND COS.artist_id = ORD.userid');
        $this->db->where('ORD.id', $order_id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_wallet_amount($user_id)
    {
        $this->db->select('wallet_amount');
        $this->db->from('ds_users');
        $this->db->where('id', $user_id);
        $result = $this->db->get()->row_array();

        return $result;
    }

    public function get_paid_amount_from_order($order_id)
    {
        $this->db->select('amountpaid');
        $this->db->from('ds_orders');
        $this->db->where('id', $order_id);
        $result = $this->db->get()->row_array();

        return $result;
    }

    public function update_wallet_amount($user_id, $wallet_amount)
    {

        $this->db->set('wallet_amount', $wallet_amount);
        $this->db->where('id', $user_id);
        $this->db->update('ds_users');
    }

    public function customer_request_cart($order_table_id)
    {
        $this->db->select('ds_products.*,ds_temp_cart.attributes as cart_attr,ds_temp_cart.qty as cart_qty,ds_temp_cart.cart_id  as cart_id, ds_temp_cart.block_status');
        $this->db->from('ds_temp_cart');
        $this->db->join('ds_products', 'ds_temp_cart.p_id=ds_products.p_id', 'left');
        $this->db->where(array('ds_temp_cart.design_order_id' => $order_table_id));
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function customer_request_cart_with_pick_up_address($order_table_id)
    {
        $this->db->select('PRO.u_id AS store_id, PRO.name AS product_name, PRO.currency, PRO.sell_price, PRO.image AS product_image, PRO.sku');
        $this->db->select('CRT.p_id AS product_id, CRT.attributes, CRT.qty AS cart_quantity, CRT.cart_id');

        $this->db->from('ds_temp_cart AS CRT');
        $this->db->join('ds_products AS PRO', 'CRT.p_id = PRO.p_id', 'left');

        $this->db->where(array('CRT.design_order_id' => $order_table_id));
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_cart_products_with_delivery_details_all($customer_id,$order_table_id=0)
    {
        $this->db->select('PRO.u_id AS store_id, PRO.name AS product_name, PRO.currency, PRO.sell_price, PRO.image AS product_image, PRO.sku');
        $this->db->select('CRT.p_id AS product_id, CRT.attributes, CRT.qty AS cart_quantity, CRT.cart_id,CRT.delivery_met as delivery_met');

        $this->db->from('ds_temp_cart AS CRT');
        $this->db->join('ds_products AS PRO', 'PRO.p_id = CRT.p_id', 'left');

        //$this->db->join('ds_delivery_method_map AS MAP', 'PRO.u_id = MAP.store_id', 'left');
        if($order_table_id > 0){
            $this->db->where(array('CRT.design_order_id' => $order_table_id));
        }else{
            $this->db->where(array('CRT.user_id' => $customer_id, 'PRO.p_status' => 'Y', 'CRT.block_status' => 'NO'));
        }
        //$this->db->where(array('CRT.user_id' => $customer_id, 'PRO.p_status' => 'Y', 'CRT.block_status' => 'NO'));

        $query = $this->db->get();
//        print_r($this->db->last_query());exit;
        $result = $query->result();
        return $result;
    }

    public function get_cart_products_with_delivery_details($customer_id)
    {
        $this->db->select('PRO.u_id AS store_id, PRO.name AS product_name, PRO.currency, PRO.sell_price, PRO.image AS product_image, PRO.sku');
        $this->db->select('CRT.p_id AS product_id, CRT.attributes, CRT.qty AS cart_quantity, CRT.cart_id,CRT.delivery_met as delivery_met');

        $this->db->from('ds_temp_cart AS CRT');
        $this->db->join('ds_products AS PRO', 'PRO.p_id = CRT.p_id', 'left');
        $this->db->join('ds_delivery_method_map AS MAP', 'PRO.u_id = MAP.store_id', 'left');

        $this->db->where(array('CRT.user_id' => $customer_id, 'PRO.p_status' => 'Y', 'CRT.block_status' => 'NO','MAP.delivery_service_id'=>2));

        $query = $this->db->get();
//        print_r($this->db->last_query());exit;
        $result = $query->result();
        return $result;
    }
    public function get_cart_products_with_delivery_details2($customer_id,$order_table_id=0)
    {
        $this->db->select('PRO.u_id AS store_id, PRO.name AS product_name, PRO.currency, PRO.sell_price, PRO.image AS product_image, PRO.sku');
        $this->db->select('CRT.p_id AS product_id, CRT.attributes, CRT.qty AS cart_quantity, CRT.cart_id,CRT.delivery_met as delivery_met');

        $this->db->from('ds_temp_cart AS CRT');
        $this->db->join('ds_products AS PRO', 'PRO.p_id = CRT.p_id', 'left');

        if($order_table_id > 0){
             $this->db->where(array('CRT.design_order_id' => $order_table_id,'PRO.p_status' => 'Y', 'CRT.block_status' => 'NO', 'CRT.delivery_met !='=>2));
        }else{
             $this->db->where(array('CRT.user_id' => $customer_id,'PRO.p_status' => 'Y', 'CRT.block_status' => 'NO', 'CRT.delivery_met !='=>2));
        }

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_cart_products_with_pickup_count($customer_id)
    {
        //$this->db->select('PRO.u_id AS store_id, PRO.name AS product_name, PRO.currency, PRO.sell_price, PRO.image AS product_image, PRO.sku');
        $this->db->select('CRT.cart_id');

        $this->db->from('ds_temp_cart AS CRT');
        $this->db->join('ds_products AS PRO', 'PRO.p_id = CRT.p_id', 'left');
        $this->db->join('ds_delivery_method_map AS MAP', 'PRO.u_id = MAP.store_id', 'left');

        $this->db->where(array('CRT.user_id' => $customer_id, 'PRO.p_status' => 'Y', 'CRT.block_status' => 'NO','CRT.delivery_met'=>2,'MAP.delivery_service_id'=>2));

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function check_cart_product_pickup_address_exist_old($store_id)
    {
        $this->db->select('PICADD.*');
        $this->db->select('ST.name AS state_name');
        $this->db->select('CN.country_name');
        $this->db->select('MAS.service_name AS delivery_type');

        $this->db->from('ds_pickup_address AS PICADD');
        $this->db->join('ds_states AS ST', 'ST.id = PICADD.state_id', 'left');
        $this->db->join('ds_country AS CN', 'CN.id = PICADD.country_id', 'left');

        $this->db->join('ds_delivery_service_map_pickup_master AS MAP', 'MAP.pickup_master_id = PICADD.id', 'left');
        $this->db->join('ds_delivery_service_master AS MAS', 'MAS.id = MAP.delivery_service_id', 'left');

        $this->db->where(['PICADD.user_id' => $store_id, 'MAS.id' => 2]);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function check_cart_product_pickup_address_exist($store_id)
    {
        $this->db->select('PICADD.*');
        $this->db->select('ST.name AS state_name');
        $this->db->select('CN.country_name');
        $this->db->select('MAS.service_name AS delivery_type, MAS.id AS dService_id');
        $this->db->from('ds_delivery_method_map AS MAP');
        $this->db->join('ds_delivery_service_master AS MAS', 'MAS.id = MAP.delivery_service_id', 'left');
        $this->db->join('ds_pickup_address AS PICADD', 'PICADD.user_id = MAP.store_id', 'left');
        $this->db->join('ds_states AS ST', 'ST.id = PICADD.state_id', 'left');
        $this->db->join('ds_country AS CN', 'CN.id = PICADD.country_id', 'left');
        $this->db->where(['MAP.store_id' => $store_id]);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function dynamic_get($select = array(),$table = '',$condition = array()){
        $this->db->select($select);
        $qry = $this->db->from($table);
        $this->db->where($condition);
        $qry = $this->db->get();
        return $qry->result_array();
    }
    public function get_update($tablename, $condition = array(), $data = array()) {
        $result = $this->db->where($condition)
                ->update($tablename, $data);
//        print_r($this->db->last_query());exit;
        return $this->db->affected_rows();
    }
}

?>