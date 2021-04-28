<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'text', 'file'));
        $this->load->library(array('session', 'form_validation', 'email', 'upload', 'image_lib', 'google', 'facebook', 'cart'));
        $this->load->model(array('common_model', 'custom_model'));

        $this->load->library("pagination");
    }
	 public function index($page = null) {
		   $data = array();

        $config = array();
        $config["base_url"] = base_url() . "products";
        $data["total_rows"] = $config["total_rows"] = $this->custom_model->getTotalProducts();
        $config["per_page"] = 6;
        $config["uri_segment"] = 2;

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i> &nbsp; Previous';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data["page"] = $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['query'] = $this->custom_model->getProducts($config["per_page"], $page);
        $data['category'] = $this->common_model->RetriveRecordByWhere('ds_category', array());
		 //ata['shop'] = $this->common_model->RetriveRecordByWhere('ds_shop_store_details', array());
        $data['parent_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0, 'status' => 'Y'));
        $data['child_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('status' => 'Y'));
		 //data['banner'] =$this->common_model->RetriveRecordByWhereRow('ds_cms_all_products',array('id'=>'1'));
                  unset($_SESSION['prod_name_search']);
        $this->load->view('products/all-product', $data);
	 }
	 public function allProductList($page = null) {

        $data = array();

        $config = array();
        $config["base_url"] = base_url() . "products";
        $data["total_rows"] = $config["total_rows"] = $this->custom_model->getTotalProducts();
        $config["per_page"] = 6;
        $config["uri_segment"] = 2;

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i> &nbsp; Previous';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data["page"] = $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['query'] = $this->custom_model->getProducts($config["per_page"], $page);
        $data['category'] = $this->common_model->RetriveRecordByWhere('ds_category', array());
		//data['shop'] = $this->common_model->RetriveRecordByWhere('ds_shop_store_details', array());
        $data['parent_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0, 'status' => 'Y'));
        $data['child_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('status' => 'Y'));
		 //data['banner'] =$this->common_model->RetriveRecordByWhereRow('ds_cms_all_products',array('id'=>'1'));
                  unset($_SESSION['prod_name_search']);
        $this->load->view('products/all-product', $data);
    }

	
	public function  product_detail(){
        
         $id = digi_decode($this->uri->segment(2));
         $data['products'] = $this->common_model->RetriveRecordByWhere('ds_products', array('p_id !=' => $id));
         $data['user']=$this->custom_model->getdetails(array('p_id' => $id));
         $data['category'] = $this->common_model->RetriveRecordByWhere('ds_category', array());
         $data['query'] = $this->common_model->RetriveRecordByWhereRow('ds_products', array('p_id' => $id));
         $data['parent_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('parent_id' => 0, 'status' => 'Y'));
         $data['child_attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array('status' => 'Y'));
         $data['attribute'] = $this->common_model->RetriveRecordByWhere('ds_products_attribute', array());
		$this->db->select('ds_product_items.*, attr.parent_id,attr.id as sub_attr_id,attr.attr_name as child_attr_name,parent_attr.attr_name as p_attr_name,parent_attr.id as p_attr_id');
        $this->db->from('ds_product_items');
        $this->db->Join('ds_products_attribute as attr', 'ds_product_items.attr_id = attr.id', 'left');
        $this->db->Join('ds_products_attribute as parent_attr', 'attr.parent_id = parent_attr.id', 'left');
        $this->db->where('ds_product_items.p_id', $id);
        $this->db->order_by('p_attr_id', 'asc');
        $data['items'] = $this->db->get();
       
        $user_id = $this->session->userdata('USER_ID');
        $user_id = variable_value_check($user_id) ? $user_id : 0;
        $data['user_id'] = $user_id;
    
        // echo "<pre>";print_r($data);die();
        $this->load->view('products/product_details',$data);
    }

    
   


 public function addcart(){
       $p_id = $_POST['p_id'];
      $price =$_POST['sell_price'];
     
      
//       print_r($_POST['attrpro']);exit;
        if ($this->session->userdata('USER_ID') != '') {
            $user_id = $this->session->userdata('USER_ID');
            $subtotal = $price *$_POST['qty'];
            $query = $this->common_model->RetriveRecordByWhereRow('ds_temp_cart', array('user_id' => $user_id, 'p_id' => $p_id, 'attributes' => json_encode($_POST['attrpro']),'price'=>$price,'subtotal'=>$subtotal));
            print_r($this->db->last_query());
            $getUpData['p_id'] = $p_id;
            $getUpData['user_id'] = $user_id;
//           
            $getUpData['attributes'] = (empty($_POST['attrpro']))? json_encode([]) : json_encode($_POST['attrpro']);
            $getUpData['qty'] = $_POST['qty'];
            $getUpData['price'] =$_POST['sell_price'];
            $getUpData['subtotal'] =$subtotal;
          
            if (count($query) > 0) {
                
                $getUpData['qty']+=  $query['qty'];

                if($getUpData['qty'] > $_POST['stock']){
                    $messagees = 'Sorry! We dont have any more unites for this items';
                    $this->session->set_flashdata('error', $messagees);
                    redirect('product_detail/'.digi_encode($p_id));
                } else {
                    $messagees = 'Product successfully update to cart list';
                    $this->db->update('ds_temp_cart', $getUpData, array('user_id' => $user_id, 'p_id' => $p_id,  'attributes' => json_encode($_POST['attrpro']),'price'=>$price,'subtotal'=>$subtotal));
                }
                
            } else {
//                print_r($query);exit;
                $this->common_model->AddRecord($getUpData, 'ds_temp_cart');
                $messagees = 'Product successfully add to cart list';
            }
        } 
        else{

            $newData['p_id'] = $p_id;
           
                $newData['attrpro'] = (empty($_POST['attrpro']))? json_encode([]) : json_encode($_POST['attrpro']);
                $newData['qty'] = $_POST['qty'];

                if (is_array($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0) {
                    if (array_key_exists($p_id, $_SESSION['cart_item'])) {

                        $newData['qty']+=  $_SESSION['cart_item'][$p_id]['qty'];
                        
                        if($newData['qty'] > $_POST['stock']){

                            $messagees = 'Sorry! We dont have any more unites for this items';
                            $this->session->set_flashdata('error', $messagees);
                            redirect('product_detail/'.digi_encode($p_id));
                        }
                        else{
                            $_SESSION['cart_item'][$p_id] = $newData;
                            $messagees = 'Product successfully update to cart list';
                        }
                    
                    } else {

                        $_SESSION['cart_item'][$p_id] = $newData;
                        $messagees = 'Product successfully added to cart list';
                    }
                } else {
                    $_SESSION['cart_item'][$p_id] = $newData;
                    $messagees = 'Product successfully added to cart list';
                }

        }

        // model section product details add to cart  then show msg
        $action = !empty($_POST['attrpro']) ? $_POST['attrpro'] : '';
        if($action == 'product_details_model'){
            echo $messagees;
        
        }else{
            $this->session->set_flashdata('error', $messagees);
            redirect('product_detail/'.digi_encode($p_id));
        }
    }

    

     public function remove_cart($rowid)
    {
        
        if ($rowid === "all") {
            
            $this->cart->destroy();
        } else {
            
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        redirect('cart');
    }
    
  
    
    public function update_cart($rowid)
    {
       // print_r($_POST['cart']);die;
        $cart_info = $_POST['cart'];
       
        
        foreach ($cart_info as $id => $cart) {
            $rowid  = $cart['rowid'];
            $price  = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty    = $cart['qty'];
           
            $data = array(
                'rowid' => $cart['rowid'],
                'price' => $price,
                'amount' => $amount,
                'qty' => $qty,
               
            );
            
            $this->cart->update($data);
    }
        redirect('cart'); 
    }

   
    public function checkouts()
    {
		
		// $id2 =$this->input->post('id');
		$id = $this->session->userdata('USER_ID');
		//$data['dialcode'] = $this->common_model->RetriveRecordByWhere('ds_country', array('dial_code!='=>''));
        //$data['country'] = $this->common_model->RetriveRecordByWhere('ds_country', array());
		if($id!=''){
		if($_SERVER['REQUEST_METHOD']=="POST"){
		$row = array(
                'user_id' => $id,
                
                'address2' =>$this->input->post('billingaddress'),
               
                'name' => $this->input->post('billingname'),
				
			
                'email' => $this->input->post('billingemail')
                
            );
			///print_r($value);
            $table = 'ds_users_address';
//            echo ($this->session->userdata('billing_add_det'));
    $this->common_model->AddRecord( $row,$table);
$order_id= $this->db->insert_id();


	if($order_id){
	
       
            $item =$this->db->where('user_id',$id)->get('ds_temp_cart')->result_array();
			
            foreach($item as $val){
          echo $val->cart_id;
            $data = array(
				
                'order_id' => $order_id,
                'item_id' => $val['p_id'],
                'price'=> $val['price'],
                'subtotal'=>$val['subtotal']
                
               
            );
			//print_r($data);
			
            
            $this->common_model->AddRecord($data, 'ds_order_items');
			
		$message = '<div class="alert alert-danger">Thanks response </div>';
                $this->session->set_flashdata('error', $message);
				$status= array(
					'status'=>'1'
			);
			unset($_SESSION['cart_item']);
				$data = $this->common_model->UpdateRecord($status,'ds_temp_cart','cart_id',$val->order_id);
				redirect(base_url('confirm'));
				
			}
    }
		
		


		
		}
		
		
				 

       $this->load->view('products/checkouts',$data);
		}
    }

   

    public function getCart() {
        $data = array();
         $design_conversation_status = FALSE;
        $design_order_id = '';

        if ($this->session->userdata('USER_ID') != '') {
            $uid = $this->session->userdata('USER_ID');

            $this->db->select('ds_products.*,ds_temp_cart.attributes as cart_attr,ds_temp_cart.qty as cart_qty,ds_temp_cart.cart_id  as cart_id');
            $this->db->from('ds_temp_cart');
            $this->db->join('ds_products', 'ds_temp_cart.p_id=ds_products.p_id', 'left');
			$this->db->where('status','0');
			$this->db->order_by('ds_temp_cart.cart_id','desc');
            

            $query = $this->db->get()->result();
            $data['query'] = $query;
        } else {
           //print_R($_SESSION['cart_item']);
          


            foreach ($_SESSION['cart_item'] as $k => $row) {
                $this->db->select('ds_products.*');
                $this->db->from('ds_products');
                $this->db->where(array('ds_products.p_id' => $k));

                $q = $this->db->get()->row();
                $q->cart_qty = $_SESSION['cart_item'][$k]['qty'];
                $q->cart_attr = $_SESSION['cart_item'][$k]['attrpro'];
                $query[] = $q;
//                print_r($query);
            }

            $data['query'] = $query;
        }

        //pr($query);

      
       
        
        $this->load->view('products/cart', $data);
    }

    /*
    public function addToCart() {
            //        $_SESSION['cart_item']=array();exit();
        $p_id = $_POST['p_id'];

        if ($this->session->userdata('USER_ID') != '') {
            $user_id = $this->session->userdata('USER_ID');
            $query = $this->common_model->RetriveRecordByWhereRow('ds_temp_cart', array('user_id' => $user_id, 'p_id' => $p_id, 'block_status' => 'NO'));

            $getUpData['p_id'] = $_POST['p_id'];
            $getUpData['user_id'] = $user_id;
            $getUpData['attributes'] = json_encode($_POST['attrpro']);
            $getUpData['qty'] = $_POST['qty'];

            if (!empty($this->session->userdata('design_order_id'))) {

                $design_order_id = $this->session->userdata('design_order_id');

                $design_conversation_status = $this->artist_dashboard_model->check_design_request_hour($design_order_id);

                if ($design_conversation_status == TRUE) {

                    $getUpData['design_order_id'] = $this->session->userdata('design_order_id');
                    $getUpData['designer_id'] = $this->session->userdata('designer_id');
                    $getUpData['customer_id'] = $this->session->userdata('customer_id');
                    $getUpData['design_type_id'] = $this->session->userdata('design_type_id');
                    $getUpData['block_status'] = 'YES';
                }
            }

            if (count($query) > 0) {
                $this->db->update('ds_temp_cart', $getUpData, array('user_id' => $user_id, 'p_id' => $p_id, 'block_status' => 'NO'));
                echo 'update';
            } else {
                $this->common_model->AddRecord($getUpData, 'ds_temp_cart');
                echo 'add';
            }
        } else {
            $newData['p_id'] = $_POST['p_id'];
            $newData['attrpro'] = json_encode($_POST['attrpro']);
            $newData['qty'] = $_POST['qty'];
            if (is_array($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0) {
                if (array_key_exists($p_id, $_SESSION['cart_item'])) {
                    $_SESSION['cart_item'][$p_id] = $newData;
                    echo 'update';
                } else {
                    $_SESSION['cart_item'][$p_id] = $newData;
                    echo 'add';
                }
            } else {
                $_SESSION['cart_item'][$p_id] = $newData;
                echo 'add';
            }
        }
    }
    */

    public function updateCart() {
//        $_SESSION['cart_item']=array();
//        print_r($_SESSION['cart_item']);
//        exit();
        $p_id = $_POST['p_id'];

        if ($this->session->userdata('USER_ID') != '') {
            //Start code of design type request
            if (!empty($this->session->userdata('design_order_id'))) {

                $design_order_id = $this->session->userdata('design_order_id');
                $customer_id = $this->session->userdata('customer_id');
                $design_type_id = $this->session->userdata('design_type_id');

                $designer_id = $this->session->userdata('USER_ID');

                $where_columns = array(
                    'p_id' => $p_id,
                    'design_order_id' => $design_order_id,
                    'designer_id' => $designer_id,
                    'customer_id' => $customer_id,
                    'design_type_id' => $design_type_id
                );
            } else {
                $user_id = $this->session->userdata('USER_ID');
                $where_columns = array(
                    'user_id' => $user_id,
                    'p_id' => $p_id,
                );
            }
            //end code of design type request

            $query = $this->common_model->RetriveRecordByWhereRow('ds_temp_cart', $where_columns);

            $getUpData['qty'] = $_POST['qty'];

            if (count($query) > 0) {
                $this->db->update('ds_temp_cart', $getUpData, $where_columns);
                echo 'update';
            }
        } else {
            $newData['p_id'] = $_POST['p_id'];
            $newData['qty'] = $_POST['qty'];
            if (array_key_exists($p_id, $_SESSION['cart_item'])) {
                $_SESSION['cart_item'][$p_id] = $newData;
                echo 'update';
            }
        }
    }

    public function deleteCart() {
        $p_id = $_POST['p_id'];
        $attr = empty($_POST['attr'])? '[]' : json_encode($_POST['attr']);
            
//            print_r($_POST);exit;

        if ($this->session->userdata('USER_ID') != '') {
            $user_id = $this->session->userdata('USER_ID');
            $query = $this->common_model->RetriveRecordByWhereRow('ds_temp_cart', array('user_id' => $user_id, 'p_id' => $p_id, 'attributes' => $attr, 'block_status' => 'NO'));
            if (count($query) > 0) {
                $this->common_model->Delete('ds_temp_cart', $query['cart_id'], 'cart_id');
                echo 'update';
            }
        } else {
            $newData['p_id'] = $_POST['p_id'];
            if (array_key_exists($p_id, $_SESSION['cart_item'])) {
                unset($_SESSION['cart_item'][$p_id]);
                echo 'update';
            }
        }
    }

    public function getCartCount() {
        if ($this->session->userdata('USER_ID') != '') {

            
                $user_id = $this->session->userdata('USER_ID');
                $where_columns = array(
                    'user_id' => $user_id,
					'status'=>1
                   
                );
            

            $query = $this->common_model->RetriveRecordByWhere('ds_temp_cart', $where_columns);
            echo count($query->result());
        } else {
            echo @count($_SESSION['cart_item']);
        }
    }
    public function confirm(){if ($this->session->userdata('USER_ID') != '') {

            
                
            

        $this->load->view('products/confirm');
    }
	}
   
}
