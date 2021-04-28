<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_setting_management extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text', 'file', 'gen_helper'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib', 'google', 'facebook', 'cart'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
        $this->load->model('custom_dev_model');
        $this->load->model('frontend/artist_dashboard_model', 'artist_dashboard_model');
		 $this->load->model(array('common_model', 'custom_model'));

    }

    public function design_request_hours()
    {

        $data['design_service_type_data'] = $this->custom_dev_model->fetch_design_hours();
        $this->load->view('settings_management/design_request_hours', $data);
    }
	 public function tax_settings() {
		 
      $id= $this->input->post('tax_id');
		$getData = array(
            
            'tax' => $this->input->post('percentage')
            
        );
		

		$this->common_model->AddRecord($getData, 'ds_tax');
         $getData = array(
                 'tax' => $this->input->post('percentage')
				
                
            );
          
		$this->common_model->UpdateRecord($getData, 'ds_tax', 'tax_id', $id);
		 
		  $message = '<div class="alert alert-success"><p>Tax  Percentage have been successfully updated.</p></div>';
            $this->session->set_flashdata('success', $message);
	  
		  $data['val'] = $this->common_model->RetriveRecordByWhereRow('ds_tax', array('tax_id'=> '1'));
		$this->load->view('settings_management/tax-settings',$data);
        
    }

    public function design_request_hours_save()
    {

        $design_service_type_id = $this->input->post('design_service_type_id');
        $hours = $this->input->post('hours');

        for ($i = 0; $i < count($design_service_type_id); $i++) {
            $id = $design_service_type_id[$i];
            $hour = trim($hours[$i]);
            $check = $this->custom_dev_model->check_hours($id);
            if ($check > 0) {
                $status = $this->custom_dev_model->update_check_hours($hour, $id);
            } else {
                $column_data = array(
                    'design_service_type_id' => $id,
                    'hours' => $hour
                );
                $status = $this->custom_dev_model->insert_check_hours($column_data);
            }
        }

        if ($status == TRUE) {
            $message = '<div class="alert alert-success"><p>Design request hours save successfully.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/settings/design-request-hours');
        } else {
            $message = '<div class="alert alert-danger"><p>Sorry something wrong, please try again.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/settings/design-request-hours');
        }
    }

    public function quotation_hours()
    {

        $select = '*';
        $table = 'ds_quotation_hours';
        $where = array();
        $order = '';

        $quotation_hours = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);

        if (count($quotation_hours) > 0) {
            $request_hours_to_designer = $quotation_hours[0]['request_hours_to_designer'];
            $response_hours_from_customer = $quotation_hours[0]['response_hours_from_customer'];
        } else {
            $request_hours_to_designer = 0;
            $response_hours_from_customer = 0;
        }

        $data['request_hours_to_designer'] = $request_hours_to_designer;
        $data['response_hours_from_customer'] = $response_hours_from_customer;

        $this->load->view('settings_management/quotation_hours', $data);
    }

    public function quotation_hours_save()
    {

        $table = 'ds_quotation_hours';
        $where = array('status' => 'ON');
        $this->custom_dev_model->delete_table_where($table, $where);

        $table = 'ds_quotation_hours';
        $value = $this->input->post();

        $status = $this->custom_dev_model->insert_table_value($table, $value);

        if ($status == TRUE) {
            $message = '<div class="alert alert-success"><p>Quotation hours save successfully.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/settings/quotation-hours');
        } else {
            $message = '<div class="alert alert-danger"><p>Sorry something wrong, please try again.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/settings/quotation-hours');
        }
    }

    public function quotation_milestone()
    {
        $select = 'fixed_price';
        $table = 'ds_quotation_fixed_price';
        $where = array('id' => 1);

        $fixed_price_data = $this->custom_dev_model->select_table_where_order($select, $table, $where);

        $fixed_price = '';
        if(variable_array_check($fixed_price_data)){
            $fixed_price = $fixed_price_data[0]['fixed_price'];
        }
        $data = [];
        $data['fixed_price'] = $fixed_price;
        $this->load->view('settings_management/quotation_milestone', $data);
    }

    public function quotation_milestone_save()
    {
        if(!variable_array_check($this->input->post('milestone_key'))){
            $message = '<div class="alert alert-danger"><p>Sorry something wrong, please try again.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/settings/quotation-milestone');
        }

        $table = 'ds_quotation_fixed_price';
        $value = array('fixed_price' => $this->input->post('quotation_fixed_price'));
        $where = array('id' => 1);
        $this->custom_dev_model->update_table_value_where($table, $value, $where);

        foreach ($this->input->post('milestone_key') as $key => $value){

            $table = 'ds_quotation_milestone';
            $where = array('milestone_key' => $key);
            $count_quotation_milestone = $this->custom_dev_model->count_table_where($table, $where);

            if($count_quotation_milestone > 0){
                $table = 'ds_quotation_milestone';
                $value = array('milestone_value' => $value);
                $where = array('milestone_key' => $key);
                $status = $this->custom_dev_model->update_table_value_where($table, $value, $where);
            }else{
                $table = 'ds_quotation_milestone';
                $value = array(
                    'milestone_key' => $key,
                    'milestone_value' => $value
                );
                $status = $this->custom_dev_model->insert_table_value($table, $value);
            }
        }
        if ($status == TRUE) {
            $message = '<div class="alert alert-success"><p>Quotation milestone & fixed price save successfully.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/settings/quotation-milestone');
        } else {
            $message = '<div class="alert alert-danger"><p>Sorry something wrong, please try again.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/settings/quotation-milestone');
        }
    }
    public function user_order_cancel_time()
    {
        $table = 'ds_user_order_cancel_time';
        $where = array('id' => 1);

        if(variable_value_check($this->input->post())){
            $message = '<div class="alert alert-success"><p>Time update successfully.</p></div>';
            $this->session->set_flashdata('success', $message);

            $value = ['cancel_time' => $this->input->post('cancel_time')];
            $this->custom_dev_model->update_table_value_where($table, $value, $where);
        }

        $select = 'cancel_time';
        $order = '';

        $data['user_order_cancel_time'] = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        $this->load->view('settings_management/user_order_cancel_time', $data);
    }



}
