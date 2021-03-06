<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Quotation_admin_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text', 'file', 'gen_helper'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib', 'google', 'facebook', 'cart', 'user_agent'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
        $this->load->model('frontend/artist_dashboard_model', 'custom_dev_model');
    }

    public function rejected_quotation()
    {

        $select = 'ORD.orderid AS order_no, ORD.id AS order_id, ORD.created_date AS date_of_request, ORD.payment_type, DES.first_name AS designer_first_name, DES.last_name AS designer_last_name, CUS.first_name AS customer_first_name, CUS.last_name AS customer_last_name, ORD.request_action AS request_action_artist, ORD.request_action_customer, ORD.request_action_date AS customer_quotation_action_date, ORD.job_close_status_artist, ORD.job_close_status_admin';
        $table = 'ds_orders AS ORD';

        $join_table = array('ds_users AS DES', 'ds_users AS CUS', 'ds_all_artist_services_details AS COST_TYPE');
        $join_on = array('ORD.userid = DES.id', 'ORD.customer_id = CUS.id', 'COST_TYPE.artist_id = ORD.userid');
        $join_name = array('LEFT', 'LEFT', 'LEFT');

        $where = "COST_TYPE.cost_type = 'VARIABLE' AND ORD.service_id = 1 AND ORD.job_close_status_artist IS NULL AND ORD.job_close_status_admin IS NULL";

        $order = 'ORD.request_action_date DESC, ORD.created_date DESC';

        $data['rejected_quotation'] = $this->custom_dev_model->select_table_joinTable_joinOn_joinName_where_order($select, $table, $join_table, $join_on, $join_name, $where, $order);

        //Fetch quotation hours check data code start
        $select = 'request_hours_to_designer, response_hours_from_customer';
        $table = 'ds_quotation_hours';
        $where = array('status' => 'ON');
        $order = '';
        $data['quotation_hours_check_data'] = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);
        //Fetch quotation hours check data code end

////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////
        $this->load->view('quotation/rejected', $data);
    }

    public function rejected_quotation_details($order_id)
    {
        $data['order_id'] = $order_id;

        $select = 'ORD.orderid AS order_no, ORD.id AS order_id, ORD.created_date AS date_of_request, ORD.request_action_date AS date_of_rejected, ORD.payment_type, DES.first_name AS designer_first_name, DES.last_name AS designer_last_name, CUS.first_name AS customer_first_name, CUS.last_name AS customer_last_name, ORD.service_id';
        $table = 'ds_orders AS ORD';
        $join_table = array('ds_users AS DES', 'ds_users AS CUS');
        $join_on = array('ORD.userid = DES.id', 'ORD.customer_id = CUS.id');
        $join_name = array('LEFT', 'LEFT');
        $where = array(
            'ORD.service_id' => 1,
            'ORD.id' => $order_id
        );
        $order = 'ORD.request_action_date DESC, ORD.created_date DESC';
        $rejected_quotation = $this->custom_dev_model->select_table_joinTable_joinOn_joinName_where_order($select, $table, $join_table, $join_on, $join_name, $where, $order);
        $data['rejected_quotation'] = $rejected_quotation[0];

        $select = 'file_name';
        $table = 'ds_service_enq_files';
        $where = array('order_table_id' => $order_id);
        $order = 'id';
        $data['attachments'] = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);

        $select = 'order_id, customer_action_date_time, quotation_amount, milestone_type_name, milestone_percentage_value, milestone_percentage_amount, milestone_amount_after_percentage, payment_status, pay_button_status, designer_action_date_time, time_frame_in_days, expected_completed_date, time_frame_in_days_2nd, expected_completed_date_2nd, added_on_2nd, time_frame_in_days_3rd, expected_completed_date_3rd, added_on_3rd';
        $table = 'ds_design_request_quotation_milestones';
        $where = ['order_id' => $order_id];
        $order = 'id ASC';
        $data['quotation_data'] = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);

        $chat_data = $this->artist_dashboard_model->chat_data_fetch($order_id);
        //pr($chat_data);
        $data['chat_data'] = $chat_data;

        $accept_decline_view_data = $this->artist_dashboard_model->accept_decline_request_view($order_id);
        $data['accept_decline_view_data'] = $accept_decline_view_data;

        $select = 'order_id, customer_action_date_time, quotation_amount, milestone_type_name, milestone_percentage_value, milestone_percentage_amount, milestone_amount_after_percentage, payment_status, pay_button_status, time_frame_in_days, expected_completed_date, designer_action_date_time, time_frame_in_days_2nd, expected_completed_date_2nd, added_on_2nd, time_frame_in_days_3rd, expected_completed_date_3rd, added_on_3rd';
        $table = 'ds_design_request_quotation_milestones_admin';
        $where = ['order_id' => $order_id];
        $order = 'id ASC';
        $data['admin_quotation_data'] = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);

        $select = 'payment_status';
        $table = 'ds_design_request_quotation_milestones_admin';
        $where = ['payment_status' => 'paid', 'order_id' => $order_id];
        $order = '';

        $data['check_paid'] = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);

        $select = 'id AS master_id, messages, added_date, added_time';
        $table = 'ds_work_report_master';
        $where = array('order_id' => $order_id);
        $order = 'added_date DESC, added_time DESC';
        $data['comment_answer'] = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);

        $this->load->view('quotation/rejected_quotation_details', $data);
    }

    public function save_milestone_by_admin()
    {
        $order_id = $this->input->post('order_id');

        $select = 'fixed_price';
        $table = 'ds_quotation_fixed_price';
        $where = ['id' => 1];
        $order = 'id ASC';
        $fixed_price = $this->custom_dev_model->select_table_where_order($select, $table, $where, $order);

        if (variable_array_check($fixed_price) == FALSE) {
            $message = '<div class="alert alert-danger"><p>Fixed price not define.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        }

        //get milestone percentage value code start
        $select = 'milestone_key, milestone_value';
        $table = 'ds_quotation_milestone';
        $whereInColumn = 'milestone_key';
        $whereInValues = ['down_payment_percentage', 'before_complete_project_percentage', 'after_complete_project_percentage'];
        $order = 'id ASC';
        $quotation_milestone_values = $this->custom_dev_model->select_table_whereInColumn_whereInValues_order($select, $table, $whereInColumn, $whereInValues, $order);

        if (variable_array_check($quotation_milestone_values) == FALSE) {
            $message = '<div class="alert alert-danger"><p>Milestone percentage not define.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        }
        //pr($quotation_milestone_values);

        $order_data = $this->artist_dashboard_model->get_designer_type_order_details($order_id);
        $i = 1;

        $quotation_amount = $fixed_price[0]['fixed_price'];

        foreach ($quotation_milestone_values as $values) {

            $key = $values['milestone_key'];
            $value = (int)$values['milestone_value'];
            $milestone_percentage_amount = $quotation_amount * ($value / 100);

            $table = 'ds_design_request_quotation_milestones_admin';
            $value = [
                'order_id' => $order_id,
                'customer_id' => $order_data['customer_id'],
                'designer_id' => $order_data['designer_id'],
                'designer_action_date_time' => ($i == 1) ? date('Y-m-d H:i:s') : '',
                'quotation_amount' => $quotation_amount,
                'milestone_type_name' => $key,
                'milestone_percentage_value' => $value,
                'milestone_percentage_amount' => $milestone_percentage_amount,
                'milestone_amount_after_percentage' => $milestone_percentage_amount,
                'pay_button_status' => ($key == 'down_payment_percentage') ? 'ON' : 'OFF',
                'time_frame_in_days' => $this->input->post('time_frame_in_days'),
                'expected_completed_date' => $this->input->post('expected_completed_date'),
            ];

            $insert_status = $this->custom_dev_model->insert_table_value($table, $value);
        }
        //get milestone percentage value code end
        if ($insert_status == TRUE) {
            $message = '<div class="alert alert-success"><p>Quotation added successfully.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        } else {
            $message = '<div class="alert alert-danger"><p>Sorry, Quotation not added.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        }
    }

    public function admin_milestone_request_customer($order_id, $milestone_type_name)
    {
        if ($milestone_type_name == 'down_payment_percentage') {
            $milestone_name = 'Down Payment ';
        }
        if ($milestone_type_name == 'before_complete_project_percentage') {
            $milestone_name = 'First Stage Payment ';
        }
        if ($milestone_type_name == 'after_complete_project_percentage') {
            $milestone_name = 'Final Payment ';
        }

        $table = 'ds_design_request_quotation_milestones_admin';
        $value = [
            'pay_button_status' => 'ON'
        ];
        $where = [
            'order_id' => $order_id,
            'milestone_type_name' => $milestone_type_name,
        ];

        $status = $this->custom_dev_model->update_table_value_where($table, $value, $where);

        if ($status == TRUE) {
            $message = '<div class="alert alert-success"><p>' . $milestone_name . ' payment request sent.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        } else {
            $message = '<div class="alert alert-danger"><p>Sorry, something wrong please try again.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        }

    }

    public function admin_work_report()
    {
        $order_id = $this->input->post('order_id');
        $work_progress = $this->input->post('work_progress');
        $redirect_url = $this->input->post('redirect_url');

        $table = 'ds_work_report_master';
        $value = [
            'order_id' => $order_id,
            'messages' => $work_progress,
            'added_date' => date('Y-m-d'),
            'added_time' => date('H:i:s')
        ];
        $master_id = $this->custom_dev_model->insertGetId_table_value($table, $value);

        if ($master_id == TRUE && variable_value_check($_FILES['attachments']['name'][0])) {

            for ($i = 0; $i < count($_FILES['attachments']['name']); $i++) {

                $_FILES['attachment']['name'] = $_FILES['attachments']['name'][$i];
                $_FILES['attachment']['type'] = $_FILES['attachments']['type'][$i];
                $_FILES['attachment']['tmp_name'] = $_FILES['attachments']['tmp_name'][$i];
                $_FILES['attachment']['error'] = $_FILES['attachments']['error'][$i];
                $_FILES['attachment']['size'] = $_FILES['attachments']['size'][$i];

                $config['upload_path'] = 'uploads/work_report/attachments/';
                $config['allowed_types'] = '*';
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('attachment')) {
                    $result = $this->upload->data();
                    $file_name = $result['file_name'];
                } else {
                    $file_name = FALSE;
                }

                if ($file_name == FALSE) {
                    $this->session->set_flashdata("error", $this->upload->display_errors());
                    if(variable_value_check($redirect_url)){
                        redirect($redirect_url.'/'. $order_id);
                    }else{
                        redirect($this->agent->referrer());
                    }
                } else {
                    $table = 'ds_work_report_transaction';
                    $value = [
                        'master_id' => $master_id,
                        'attachment' => $file_name
                    ];
                    $status = $this->custom_dev_model->insert_table_value($table, $value);
                }
            }
        }

        $select = 'CUS.first_name AS customer_first_name, CUS.last_name AS customer_last_name, CUS.email AS email_id';
        $table = 'ds_design_request_quotation_milestones_admin AS ORD';
        $join_table = array('ds_users AS CUS');
        $join_on = array('ORD.customer_id = CUS.id');
        $join_name = array('LEFT');
        $where = array('ORD.order_id' => $order_id);
        $order = '';
        $order_data = $this->custom_dev_model->select_table_joinTable_joinOn_joinName_where_order($select, $table, $join_table, $join_on, $join_name, $where, $order);

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'paik.test.mails@gmail.com',
            'smtp_pass' => 'paik.test.mails_123',
            'smtp_port' => 465,
            'mailtype' => 'html'
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('paik.test.mails@gmail.com', 'Design Studio');
        $this->email->to($order_data[0]['email_id'], $order_data[0]['customer_first_name'].' '.$order_data[0]['customer_last_name']);
        //$this->email->to('somnath.test.mails@gmail.com', $order_data[0]['customer_first_name'].' '.$order_data[0]['customer_last_name']);
        $this->email->subject('Work progress report');
        $this->email->message($work_progress);
        if(count($_FILES['attachments']['name']) > 0){
            $this->email->attach('uploads/work_report/attachments/'.$file_name);
        }

        $mail_sent_status = $this->email->send();

        if ($master_id == TRUE) {
            $message = '<div class="alert alert-success"><p>Sent work progress to customer.</p></div>';
            $this->session->set_flashdata('success', $message);
            if(variable_value_check($redirect_url)){
                redirect($redirect_url.'/'. $order_id);
            }else{
                redirect($this->agent->referrer());
            }

        } else {
            $message = '<div class="alert alert-danger"><p>Sorry, work progress not sent.</p></div>';
            $this->session->set_flashdata('error', $message);
            if(!empty($redirect_url)){
                redirect($redirect_url.'/'. $order_id);
            }else{
                redirect($this->agent->referrer());
            }
        }
    }

    public function quotation_timeline_save_again()
    {
        $order_id = $this->input->post('order_id');

        $time_frame_in_days_2nd = $this->input->post('time_frame_in_days_2nd');
        //$old_time_frame_in_days = $this->input->post('old_time_frame_in_days');

        //$new_time_frame = (int)$time_frame_in_days_2nd + (int)$old_time_frame_in_days;
        $new_time_frame = $time_frame_in_days_2nd;

        $table = 'ds_design_request_quotation_milestones_admin';
        $value = array(
            'time_frame_in_days_2nd' => $new_time_frame,
            'expected_completed_date_2nd' => $this->input->post('expected_completed_date_2nd'),
            'added_on_2nd' => date('Y-m-d')
        );
        $where = array('order_id' => $this->input->post('order_id'));

        $status = $this->custom_dev_model->update_table_value_where($table, $value, $where);

        if ($status == TRUE) {
            $message = '<div class="alert alert-success"><p>project time frame extend successfully</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        } else {
            $message = '<div class="alert alert-danger"><p>Sorry, something wrong please try again.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        }
    }

    public function quotation_timeline_save_again_3()
    {
        $order_id = $this->input->post('order_id');

        $time_frame_in_days_3rd = $this->input->post('time_frame_in_days_3rd');
        //$old_time_frame_in_days = $this->input->post('time_frame_in_days_2nd');

        //$new_time_frame = (int)$time_frame_in_days_2nd + (int)$old_time_frame_in_days;
        $new_time_frame = $time_frame_in_days_3rd;

        $table = 'ds_design_request_quotation_milestones_admin';
        $value = array(
            'time_frame_in_days_3rd' => $new_time_frame,
            'expected_completed_date_3rd' => $this->input->post('expected_completed_date_3rd'),
            'added_on_3rd' => date('Y-m-d')
        );
        $where = array('order_id' => $this->input->post('order_id'));

        $status = $this->custom_dev_model->update_table_value_where($table, $value, $where);

        if ($status == TRUE) {
            $message = '<div class="alert alert-success"><p>project time frame extend successfully</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        } else {
            $message = '<div class="alert alert-danger"><p>Sorry, something wrong please try again.</p></div>';
            $this->session->set_flashdata('error', $message);
            redirect('admin/rejected-quotation/details/' . $order_id);
        }
    }
}
