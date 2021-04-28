<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('view_chat_attachments')) {
    function view_chat_attachments($chat_id)
    {
        $CI = &get_instance();
        $data = $CI->customer_dashboard_model->view_chat_attachments($chat_id);
        return $data;
    }
}

if (!function_exists('admin_view_chat_attachments')) {
    function admin_view_chat_attachments($chat_id)
    {
        $CI = &get_instance();
        $data = $CI->custom_dev_model->admin_view_chat_attachments($chat_id);
        return $data;
    }
}

if (!function_exists('count_chat_customer')) {
    function count_chat_customer($order_table_id, $customer_id)
    {
        $CI = &get_instance();
        $data = $CI->artist_dashboard_model->count_chat_customer($order_table_id, $customer_id);
        return $data;
    }

    if (!function_exists('count_chat_designer')) {
        function count_chat_designer($order_table_id, $designer_id)
        {
            $CI = &get_instance();
            $data = $CI->customer_dashboard_model->count_chat_designer($order_table_id, $designer_id);
            return $data;
        }
    }

    if (!function_exists('total_count_chat_customer')) {
        function total_count_chat_customer($order_table_id, $customer_id)
        {
            $CI = &get_instance();
            $data = $CI->artist_dashboard_model->total_count_chat_customer($customer_id);
            return $data;
        }
    }

    if (!function_exists('total_count_chat_designer')) {
        function total_count_chat_designer($order_table_id, $designer_id)
        {
            $CI = &get_instance();
            $data = $CI->customer_dashboard_model->total_count_chat_designer($designer_id);
            return $data;
        }
    }

    if (!function_exists('check_design_request_hour')) {
        function check_design_request_hour($order_table_id)
        {
            $CI = &get_instance();
            $data = $CI->artist_dashboard_model->check_design_request_hour($order_table_id);
            return $data;
        }
    }
    if (!function_exists('get_wallet_amount')) {
        function get_wallet_amount($user_id)
        {
            $CI = &get_instance();
            $data = $CI->artist_dashboard_model->get_wallet_amount($user_id);
            return $data;
        }
    }
    if (!function_exists('get_design_type_slug')) {
        function get_design_type_slug($design_id)
        {
            $CI = &get_instance();
            $data = $CI->artist_dashboard_model->get_design_type_slug($design_id);
            if(isset($data) && $data != 'NULL' && count($data) > 0){
                $slug = strtolower(str_replace(" ","-",$data[0]['type_name']));
                return $slug;
            }
            return false;
        }
    }
    if (!function_exists('variable_value_check')) {
        function variable_value_check($variable)
        {
            if(isset($variable) && $variable != 'NULL' && !empty($variable)){
                return TRUE;
            }else{
                return false;
            }

        }
    }
    if (!function_exists('variable_array_check')) {
        function variable_array_check($variable)
        {
            if(isset($variable) && $variable != 'NULL' && is_array($variable) && count($variable) > 0){
                return TRUE;
            }
            return false;
        }
    }
    if (!function_exists('first_select_table_where_order')) {
        function first_select_table_where_order($select = '', $table = '', $where = array(), $order = '')
        {
            $CI = &get_instance();
            $result = $CI->custom_dev_model->first_select_table_where_order($select, $table, $where, $order);
            return $result;
        }
    }
    if (!function_exists('check_file_type')) {
        function check_file_type($file_name = '')
        {
            $filename = pathinfo($file_name);
            $file = $filename['extension'];
            return $file;
        }
    }
    if (!function_exists('check_cart_product_pickup_address_exist')) {
        function check_cart_product_pickup_address_exist($id)
        {
            $CI = &get_instance();
            $data = $CI->artist_dashboard_model->check_cart_product_pickup_address_exist($id);
            return $data;
        }
    }

    if (!function_exists('check_minute_time')) {
        function check_minute_time($added_time, $check_time)
        {
            $current_date_time = time();

            $expire_date_time = strtotime($added_time) + ($check_time * 60);

            if ($expire_date_time >= $current_date_time) {
                $status = TRUE;
            } else {
                $status = FALSE;
            }
            return $status;
        }
    }
    function get_delivery_met($store_id = ''){
        $CI =& get_instance();
        $CI->db->select(array('delivery_service_id'));
        $qry = $CI->db->from('ds_delivery_method_map');
        $CI->db->where(array('store_id'=>$store_id));
        $qry = $CI->db->get();
        $res = $qry->result_array();
        return $res;

    }
    function get_only_pickup_check($store_id = ''){
        $CI =& get_instance();
        $CI->db->select(array('delivery_service_id'));
        $qry = $CI->db->from('ds_delivery_method_map');
        $CI->db->where(array('store_id'=>$store_id));
        $qry = $CI->db->get();
        $res = $qry->result_array();
        if(count($res) > 1){
            return 0;
        }else if(count($res) == 1){
            if($res[0]['delivery_service_id'] == 2){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}