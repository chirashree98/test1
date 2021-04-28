<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_history_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text', 'file', 'gen_helper'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib', 'google', 'facebook', 'cart'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
        $this->load->model('frontend/artist_dashboard_model', 'custom_dev_model', 'admin/customer_dashboard_model');
    }

    public function index()
    {

        $select = 'TH.*,ORD.request_action AS request_action, ORD.request_action_customer, ORD.job_close_status_artist, ORD.job_close_status_admin, ORD.orderid AS request_order_no, OM.order_status AS orderstatus, ORD.request_action, ORD.job_close_status_admin, ST.type_name AS request_service_type_name, artist.first_name AS artist_first_name, artist.last_name AS artist_last_name, store.first_name AS store_first_name, store.last_name AS store_last_name, customer.first_name AS customer_first_name, customer.last_name AS customer_last_name, OM.order_no AS checkout_order_no, PRO.name AS product_name, OM.tax_percent AS tax_percent, OM.tax_amount AS tax_amount, ORDTRAN.cancel_status AS cancelstatus';
        $table = 'ds_transaction_history AS TH';
        $join_table = array('ds_orders AS ORD', 'ds_services_types AS ST', 'ds_users AS artist', 'ds_users AS store', 'ds_users AS customer', 'ds_order_master AS OM','ds_order_transaction AS ORDTRAN', 'ds_products AS PRO' );
        $join_on = array('ORD.id = TH.request_type_order_table_id', 'ST.id = ORD.service_id', 'artist.id = TH.artist_id', 'store.id = TH.store_id', 'customer.id = TH.customer_id', 'OM.id = TH.checkout_type_order_table_id','ORDTRAN.transaction_history_id = TH.id', 'PRO.p_id = ORDTRAN.product_id' );
        $join_name = array('LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT','LEFT');
        if(variable_value_check($this->input->get())){
            $where = [
                'TH.order_date >=' => $this->input->get('from_date'),
                'TH.order_date <=' => $this->input->get('to_date')
            ];

            $data['form_date'] = $this->input->get('from_date');
            $data['to_date'] = $this->input->get('to_date');
        }else{
            $where = [];
        }

        $order = 'TH.order_date DESC, TH.order_time DESC';

        $data['transaction_history_data'] = $this->custom_dev_model->select_table_joinTable_joinOn_joinName_where_order($select, $table, $join_table, $join_on, $join_name, $where, $order);
        //pr( $data['transaction_history_data']);
        $this->load->view('transaction_history', $data);
    }
    
    public function canceled_transaction()
    {

        $select = 'TH.*, ORD.orderid AS request_order_no, ORD.request_action, ORD.job_close_status_admin, ST.type_name AS request_service_type_name, artist.first_name AS artist_first_name, artist.last_name AS artist_last_name, store.first_name AS store_first_name, store.last_name AS store_last_name, customer.first_name AS customer_first_name, customer.last_name AS customer_last_name, OM.order_no AS checkout_order_no, PRO.name AS product_name, OM.tax_percent AS tax_percent, OM.tax_amount AS tax_amount, ORDTRAN.order_master_id, ORDTRAN.product_total_amount, ORDTRAN.cancel_status';
        $table = 'ds_transaction_history AS TH';
        $join_table = array('ds_orders AS ORD', 'ds_services_types AS ST', 'ds_users AS artist', 'ds_users AS store', 'ds_users AS customer', 'ds_order_master AS OM', 'ds_order_transaction AS ORDTRAN', 'ds_products AS PRO');
        $join_on = array('ORD.id = TH.request_type_order_table_id', 'ST.id = ORD.service_id', 'artist.id = TH.artist_id', 'store.id = TH.store_id', 'customer.id = TH.customer_id', 'OM.id = TH.checkout_type_order_table_id', 'ORDTRAN.transaction_history_id = TH.id', 'PRO.p_id = ORDTRAN.product_id');
        $join_name = array('LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT');
        if(variable_value_check($this->input->get())){
            $where = [
                'TH.order_date >=' => $this->input->get('from_date'),
                'TH.order_date <=' => $this->input->get('to_date'),
                'ORDTRAN.cancel_status' => 'YES'
            ];

            $data['form_date'] = $this->input->get('from_date');
            $data['to_date'] = $this->input->get('to_date');
        }else{
            $where = ['ORDTRAN.cancel_status' => 'YES'];
        }

        $order = 'TH.order_date DESC, TH.order_time DESC';

        $data['transaction_history_data'] = $this->custom_dev_model->select_table_joinTable_joinOn_joinName_where_order($select, $table, $join_table, $join_on, $join_name, $where, $order);
//        print_r( json_encode($data['transaction_history_data']));exit;
        $this->load->view('canceled_transaction', $data);
    }

    public function designer_transaction_history($designer_id)
    {

        $select = 'TH.*, ORD.orderid AS request_order_no, ORD.request_action, ORD.job_close_status_admin, ST.type_name AS request_service_type_name, artist.first_name AS artist_first_name, artist.last_name AS artist_last_name, store.first_name AS store_first_name, store.last_name AS store_last_name, customer.first_name AS customer_first_name, customer.last_name AS customer_last_name, OM.order_no AS checkout_order_no, PRO.name AS product_name';
        $table = 'ds_transaction_history AS TH';
        $join_table = array('ds_orders AS ORD', 'ds_services_types AS ST', 'ds_users AS artist', 'ds_users AS store', 'ds_users AS customer', 'ds_order_master AS OM', 'ds_products AS PRO');
        $join_on = array('ORD.id = TH.request_type_order_table_id', 'ST.id = ORD.service_id', 'artist.id = TH.artist_id', 'store.id = TH.store_id', 'customer.id = TH.customer_id', 'OM.id = TH.checkout_type_order_table_id', 'PRO.p_id = TH.product_id');
        $join_name = array('LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT');
        if(variable_value_check($this->input->get())){
            $where = [
                'TH.artist_id' => $designer_id,
                'TH.order_date >=' => $this->input->get('from_date'),
                'TH.order_date <=' => $this->input->get('to_date')
            ];
            $data['designer_id'] = $this->input->get('designer_id');
            $data['form_date'] = $this->input->get('from_date');
            $data['to_date'] = $this->input->get('to_date');
        }else{
            $where = ['TH.artist_id' => $designer_id];
            $data['designer_id'] = $designer_id;
        }

        $order = 'TH.order_date DESC, TH.order_time DESC';

        $data['transaction_history_data'] = $this->custom_dev_model->select_table_joinTable_joinOn_joinName_where_order($select, $table, $join_table, $join_on, $join_name, $where, $order);
        //pr( $data['transaction_history_data']);

        $select = 'SUM(paid_amount) AS sum_paid_amount';
        $table = 'ds_transaction_history';
        $where = array('artist_id' => $designer_id, 'paid_user_type' => 'artist');
        $order = '';
        $paid_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $paid_amount = variable_value_check($paid_data[0]['sum_paid_amount']) ? $paid_data[0]['sum_paid_amount'] : 0;

        $select = 'SUM(profit_get_amount) AS sum_profit_get_amount';
        $table = 'ds_transaction_history';
        $where = array('artist_id' => $designer_id, 'profit_user_type' => 'artist');
        $order = '';
        $profit_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $profit_amount = variable_value_check($profit_data[0]['sum_profit_get_amount']) ? $profit_data[0]['sum_profit_get_amount'] : 0;

        $data['total_sum'] = $paid_amount + $profit_amount;

        $select = 'SUM(admin_get_amount) AS sum_admin_paid_amount';
        $table = 'ds_transaction_history';
        $where = array('artist_id' => $designer_id);
        $order = '';
        $paid_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $data['admin_paid_amount'] = variable_value_check($paid_data[0]['sum_admin_paid_amount']) ? $paid_data[0]['sum_admin_paid_amount'] : 0;

        $data['total_show'] = true;

        $this->load->view('transaction_history', $data);
    }

    public function store_transaction_history($store_id)
    {

        $select = 'TH.*, ORD.orderid AS request_order_no, ORD.request_action, ORD.job_close_status_admin, ST.type_name AS request_service_type_name, artist.first_name AS artist_first_name, artist.last_name AS artist_last_name, store.first_name AS store_first_name, store.last_name AS store_last_name, customer.first_name AS customer_first_name, customer.last_name AS customer_last_name, OM.order_no AS checkout_order_no, PRO.name AS product_name';
        $table = 'ds_transaction_history AS TH';
        $join_table = array('ds_orders AS ORD', 'ds_services_types AS ST', 'ds_users AS artist', 'ds_users AS store', 'ds_users AS customer', 'ds_order_master AS OM', 'ds_products AS PRO');
        $join_on = array('ORD.id = TH.request_type_order_table_id', 'ST.id = ORD.service_id', 'artist.id = TH.artist_id', 'store.id = TH.store_id', 'customer.id = TH.customer_id', 'OM.id = TH.checkout_type_order_table_id', 'PRO.p_id = TH.product_id');
        $join_name = array('LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT');
        if(variable_value_check($this->input->get())){
            $where = [
                'TH.store_id' => $store_id,
                'TH.order_date >=' => $this->input->get('from_date'),
                'TH.order_date <=' => $this->input->get('to_date')
            ];
            $data['store_id'] = $this->input->get('store_id');
            $data['form_date'] = $this->input->get('from_date');
            $data['to_date'] = $this->input->get('to_date');
        }else{
            $where = ['TH.store_id' => $store_id];
            $data['store_id'] = $store_id;
        }

        $order = 'TH.order_date DESC, TH.order_time DESC';

        $data['transaction_history_data'] = $this->custom_dev_model->select_table_joinTable_joinOn_joinName_where_order($select, $table, $join_table, $join_on, $join_name, $where, $order);
        //pr( $data['transaction_history_data']);

        $select = 'SUM(paid_amount) AS sum_paid_amount';
        $table = 'ds_transaction_history';
        $where = array('store_id' => $store_id, 'paid_user_type' => 'store');
        $order = '';
        $paid_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $paid_amount = variable_value_check($paid_data[0]['sum_paid_amount']) ? $paid_data[0]['sum_paid_amount'] : 0;

        $select = 'SUM(profit_get_amount) AS sum_profit_get_amount';
        $table = 'ds_transaction_history';
        $where = array('store_id' => $store_id, 'profit_user_type' => 'store');
        $order = '';
        $profit_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $profit_amount = variable_value_check($profit_data[0]['sum_profit_get_amount']) ? $profit_data[0]['sum_profit_get_amount'] : 0;

        $data['total_sum'] = $paid_amount + $profit_amount;

        $select = 'SUM(admin_get_amount) AS sum_admin_paid_amount';
        $table = 'ds_transaction_history';
        $where = array('store_id' => $store_id);
        $order = '';
        $paid_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $data['admin_paid_amount'] = variable_value_check($paid_data[0]['sum_admin_paid_amount']) ? $paid_data[0]['sum_admin_paid_amount'] : 0;

        $data['total_show'] = true;

        $select = 'COUNT(*) AS total_order';
        $table = 'ds_transaction_history';
        $where = array('store_id' => $store_id);
        $order = '';
        $order_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $data['total_order'] = variable_value_check($order_data[0]['total_order']) ? $order_data[0]['total_order'] : 0;

        $data['total_show'] = true;

        $this->load->view('transaction_history', $data);
    }

    public function customer_transaction_history($customer_id)
    {

        $select = 'TH.*, ORD.orderid AS request_order_no, ORD.request_action, ORD.job_close_status_admin, ST.type_name AS request_service_type_name, artist.first_name AS artist_first_name, artist.last_name AS artist_last_name, store.first_name AS store_first_name, store.last_name AS store_last_name, customer.first_name AS customer_first_name, customer.last_name AS customer_last_name, OM.order_no AS checkout_order_no, PRO.name AS product_name';
        $table = 'ds_transaction_history AS TH';
        $join_table = array('ds_orders AS ORD', 'ds_services_types AS ST', 'ds_users AS artist', 'ds_users AS store', 'ds_users AS customer', 'ds_order_master AS OM', 'ds_products AS PRO');
        $join_on = array('ORD.id = TH.request_type_order_table_id', 'ST.id = ORD.service_id', 'artist.id = TH.artist_id', 'store.id = TH.store_id', 'customer.id = TH.customer_id', 'OM.id = TH.checkout_type_order_table_id', 'PRO.p_id = TH.product_id');
        $join_name = array('LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT', 'LEFT');
        if(variable_value_check($this->input->get())){
            $where = [
                'TH.customer_id' => $customer_id,
                'TH.order_date >=' => $this->input->get('from_date'),
                'TH.order_date <=' => $this->input->get('to_date')
            ];
            $data['customer_id'] = $this->input->get('customer_id');
            $data['form_date'] = $this->input->get('from_date');
            $data['to_date'] = $this->input->get('to_date');
        }else{
            $where = ['TH.customer_id' => $customer_id];
            $data['customer_id'] = $customer_id;
        }

        $order = 'TH.order_date DESC, TH.order_time DESC';

        $data['transaction_history_data'] = $this->custom_dev_model->select_table_joinTable_joinOn_joinName_where_order($select, $table, $join_table, $join_on, $join_name, $where, $order);
        //pr( $data['transaction_history_data']);

        $select = 'SUM(total_amount_customer_pay) AS sum_profit_get_amount';
        $table = 'ds_transaction_history';
        $where = array('customer_id' => $customer_id);
        $order = '';
        $profit_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $profit_amount = variable_value_check($profit_data[0]['sum_profit_get_amount']) ? $profit_data[0]['sum_profit_get_amount'] : 0;

        $data['total_sum'] = $profit_amount;

        $select = 'SUM(admin_get_amount) AS sum_admin_paid_amount';
        $table = 'ds_transaction_history';
        $where = array('customer_id' => $customer_id);
        $order = '';
        $paid_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $data['admin_paid_amount'] = variable_value_check($paid_data[0]['sum_admin_paid_amount']) ? $paid_data[0]['sum_admin_paid_amount'] : 0;

        $select = 'COUNT(*) AS total_order';
        $table = 'ds_transaction_history';
        $where = array('customer_id' => $customer_id);
        $order = '';
        $order_data = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $data['total_order'] = variable_value_check($order_data[0]['total_order']) ? $order_data[0]['total_order'] : 0;

        $data['total_show'] = true;

        $this->load->view('transaction_history', $data);
    }
}
