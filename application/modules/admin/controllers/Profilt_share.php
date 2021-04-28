<!--6/11/2020-->
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profilt_share extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib'));
        $this->load->model(array('common_model', 'custom_model'));
        if ($this->session->userdata('ADMIN_ID') == '') {
            redirect('admin');
        }
    }
	
    public function edit_profitmargin_artist() {
        $data = array();
        // $id = $this->->segment(4);
		
        if ($_POST) {
			 $id = $this->input->post('id');
			 
			 $admin_with_out_dc_amount=$this->input->post('admin_with_out_dc_amount');
			 $designer_amount= $this->input->post('designer_amount');
			  $dc_holder_amount = $this->input->post('dc_holder_amount');
			  $dc_store_amount = $this->input->post('dc_store_amount');
			  $admin_with_dc_amount =$this->input->post('admin_with_dc_amount');
				$sum =  $admin_with_out_dc_amount+$designer_amount;
				$sum1 =  $dc_store_amount+$dc_holder_amount+$admin_with_dc_amount;
				if( $sum == "100"){
				$getDatas = array(
				'admin_with_out_dc_amount' => $admin_with_out_dc_amount,
                'user_type'=>'artist',
				'amount_type'=>'percentage',
				'designer_amount'=>$designer_amount
				
            );
			
			
			 
			if( $sum1 == "100"){
            $getData = array(
				'admin_with_dc_amount' => $admin_with_dc_amount,
                'user_type'=>'artist',
				'amount_type'=>'percentage',
				'dc_store_amount'=> $dc_store_amount,
				'dc_holder_amount' => $dc_holder_amount 
                
				
            );
			
			$getData['update_date'] = date('Y-m-d h:m:s');
            $this->common_model->UpdateRecord($getData, 'ds_design_commissions', 'id', $id);
			$this->common_model->UpdateRecord($getDatas, 'ds_design_commissions', 'id', $id);
            $message = '<div class="alert alert-success"><p>  Profit Margin For Artist successfully updated.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/Profilt_share/edit_profitmargin_artist');
			 
        }
		}
		}
		
        //$data['parent_attr'] = $this->common_model->RetriveRecordByWhere('ds_design_commissions', array('parent_id' => 0));
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_design_commissions', array('id' => '1','user_type'=>'artist'));
        $this->load->view('profitshare/edit_profitmargin_artist', $data);
    }
	   public function edit_profitmargin_store() {
		    $data = array();
        // $id = $this->->segment(4);
		
        if ($_POST) {
		    $id = $this->input->post('id');
        $admin_with_out_dc_amount=$this->input->post('admin_with_out_dc_amount');
			 $store_amount= $this->input->post('store_amount');
			  $dc_holder_amount = $this->input->post('dc_holder_amount');
			  $dc_store_amount = $this->input->post('dc_store_amount');
			  $admin_with_dc_amount =$this->input->post('admin_with_dc_amount');
				$sum =  $admin_with_out_dc_amount+$store_amount;
				$sum1 =  $dc_store_amount+$dc_holder_amount+$admin_with_dc_amount;
				if( $sum == "100"){
				$getDatas = array(
				'admin_with_out_dc_amount' => $admin_with_out_dc_amount,
                'user_type'=>'store',
				'amount_type'=>'percentage',
				'store_amount'=>$store_amount
				
            );
			
			
			 
			if( $sum1 == "100"){
            $getData = array(
				'admin_with_dc_amount' => $admin_with_dc_amount,
                'user_type'=>'store',
				'amount_type'=>'percentage',
				'dc_store_amount'=> $dc_store_amount,
				'dc_holder_amount' => $dc_holder_amount 
                
				
            );
			
			$getData['update_date'] = date('Y-m-d h:m:s');
            $this->common_model->UpdateRecord($getDatas, 'ds_design_commissions', 'id', $id);
			$this->common_model->UpdateRecord($getData, 'ds_design_commissions', 'id', $id);
            $message = '<div class="alert alert-success"><p>  Profit Margin For Store successfully updated.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('admin/Profilt_share/edit_profitmargin_store');
        }
		}
		}
        //$data['parent_attr'] = $this->common_model->RetriveRecordByWhere('ds_design_commissions', array('parent_id' => 0));
        $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_design_commissions', array('id' => '2','user_type'=>'store'));
        $this->load->view('profitshare/edit_profitmargin_store', $data);
    }
	
}
?>
<!--6/11/2020-->