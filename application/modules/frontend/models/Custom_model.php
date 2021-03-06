<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Custom_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function upload($path, $image, $file_name, $fld_nm) {
        $this->load->library('upload');
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = '2000';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $file_name;
        $config['orig_name'] = $image;
        $config['image'] = $file_name;
        $this->upload->initialize($config);
        $this->upload->do_upload($fld_nm);
        /* $error = array('error' => $this->upload->display_errors());
          print_r($error);
          exit(); */
    }
	function digi_encode($id){
    $add = $id + 8038;
    return base64_encode(base64_encode($add));
}
function digi_decode($e_id){
    $id = base64_decode(base64_decode($e_id));
    return ($id-8038);
}

    public function send_email($from_mail, $from_name, $to, $subject, $mail_body, $attachment = null) {
        $config['protocol'] = 'sendmail';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $this->email->from($from_mail, $from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($mail_body);
        if ($attachment != null) {
            $this->email->attach($attachment);
        }
        $this->email->send();
        ;
    }

    public function getVerenigingByPostcode($keyword) {
        $this->db->select('*');
        $this->db->from('verenigings');
        $this->db->where("post_code LIKE '%$keyword%'");
        $this->db->order_by('verenigings.association', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getPostcodeByCity($keyword) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('u_id', $keyword);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_count() 
	{
		 //$where = "ds_users.role_id = '1'  ";
        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {
                    if ($key == 'cat_search') {
                        $where .= " AND`cat_id` = '" . $val . "' ";
                    }
                    if ($key == 'attr_search') {
                        $i = 0;
                        foreach ($val as $k => $v) {
                            if ($i < 1) {
                                $where .= " AND (  `attribute` LIKE '%" . $v . "%' ";
                            } else {
                                $where .= " OR `attribute` LIKE '%" . $v . "%' ";
                            }
                            $i++;
//                            echo count($val);exit();
                            if ($i == count($val)) {
                                $where .= " ) ";
                            }
                        }
                    }
                }
            }
        }
       

       $this->db->select('ds_users.country_id,ds_users.products_types_id,ds_users.city,ds_shop_store_details.banner_image,ds_users.role_id,ds_country.id,ds_country.country_name,ds_shop_store_details.user_id,ds_shop_store_details.shop_description,ds_product_types.id,ds_users.products_types_id,ds_product_types.product_types,ds_users.virtual_studio,ds_users.id');
        $this->db->from('ds_users');
		
        $this->db->Join('ds_shop_store_details', 'ds_shop_store_details.user_id = ds_users.id','left');
        $this->db->Join('ds_country', 'ds_country.id = ds_users.country_id');
		$this->db->Join('ds_product_types', 'ds_product_types.id=ds_users.products_types_id','left');
		$this->db->where('ds_users.role_id','6');
		$this->db->where('ds_users.is_approved', '1');
        $query = $this->db->get();
		//print_r($query->result());
	   return $query->num_rows();
	}
	public function get_artist_service_count() 
	{
         $where = " ds_users.role_id = '1'  ";
$where .= " AND ds_users.`is_approved = '1'  ";
        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                 if ($val != '') {
                    if ($key == 'cat_search') {
                        $where .= " AND`cat_id` = '" . $val . "' ";
                    }
                    if ($key == 'attr_search') {
                        $i = 0;
                        foreach ($val as $k => $v) {
                            if ($i < 1) {
                                $where .= " AND (  `attribute` LIKE '%" . $v . "%' ";
                            } else {
                                $where .= " OR `attribute` LIKE '%" . $v . "%' ";
                            }
                            $i++;
//                            echo count($val);exit();
                            if ($i == count($val)) {
                                $where .= " ) ";
                            }
                        }
                    }
                    
                    
                    if ($key == 'order') {
//                       $where .= "   ORDER BY `sell_price`  " . $val . " ";
                    }
                }
            }
        }
        if(isset($_SESSION['search']['order']) && $_SESSION['search']['order']!='' ){
            $where .= "ORDER BY `ds_users`.`first_name`  " . $_SESSION['search']['order'] . " ";
        }
		$this->db->select('ds_users.first_name,ds_users.service_id,ds_users.*,ds_user_other_details.user_id,ds_users.country_id,ds_country.id,ds_country.country_name,ds_artist_service.id,ds_user_other_details.profile_image,ds_all_artist_services_details.artist_id,ds_all_artist_services_details.service_type_id,ds_all_artist_services_details.*');
		$this->db->from('ds_users');
		//$this->db->where("ds_users.first_name LIKE '%$keyword%'");
        $this->db->Join('ds_artist_service', 'ds_artist_service.id=ds_users.service_id','left' );
        $this->db->Join('ds_country', 'ds_country.id = ds_users.country_id','left' );
		 $this->db->Join('ds_user_other_details', 'ds_user_other_details.user_id = ds_users.id','left');
		 //$this->db->Join('ds_services_types', 'ds_services_types.id=ds_artist_service.id','left');
		  //$this->db->Join('ds_all_artist_services_details', 'ds_all_artist_services_details.service_type_id=ds_services_types.id','left');
		    $this->db->Join('ds_all_artist_services_details', 'ds_all_artist_services_details.artist_id=ds_users.id','left');
			$this->db->where('ds_users.is_approved','1');
			$this->db->where('ds_all_artist_services_details.service_type_id','2');
			
        $query = $this->db->get();
		
		return $query->num_rows();
}
	 public function getArtistservice($limit, $start) {
        $where = "ds_users.role_id = '1'  ";
$where .= " AND ds_users.is_approved = '1'  ";
//        if (!empty($_SESSION)) {
//            foreach ($_SESSION['search'] as $key => $val) {
//
//                 if ($val != '') {
//                    if ($key == 'cat_search') {
//                        $where .= " AND`cat_id` = '" . $val . "' ";
//                    }
//                    if ($key == 'attr_search') {
//                        $i = 0;
//                        foreach ($val as $k => $v) {
//                            if ($i < 1) {
//                                $where .= " AND (  `attribute` LIKE '%" . $v . "%' ";
//                            } else {
//                                $where .= " OR `attribute` LIKE '%" . $v . "%' ";
//                            }
//                            $i++;
////                            echo count($val);exit();
//                            if ($i == count($val)) {
//                                $where .= " ) ";
//                            }
//                        }
//                    }
//                    
//                    
//                    if ($key == 'order') {
////                       $where .= "   ORDER BY `sell_price`  " . $val . " ";
//                    }
//                }
//            }
//        }
        if(isset($_SESSION['search']['order']) && $_SESSION['search']['order']!='' ){
            $where .= "ORDER BY `ds_users`.`first_name` " . $_SESSION['search']['order'] . " ";
        }
		
		 $where .= "LIMIT $start , $limit";
		 

		$this->db->select('ds_users.first_name,ds_users.service_id,ds_users.*,ds_user_other_details.user_id,ds_users.country_id,ds_country.id,ds_country.country_name,ds_artist_service.id,ds_user_other_details.profile_image,ds_all_artist_services_details.artist_id,ds_all_artist_services_details.service_type_id,ds_all_artist_services_details.*,ds_artist_service.*,ds_currency.*');
		$this->db->from('ds_users');
		$this->db->Join('ds_artist_service', 'ds_artist_service.id=ds_users.service_id' );
		$this->db->Join('ds_country', 'ds_country.id = ds_users.country_id' );
		 $this->db->Join('ds_user_other_details', 'ds_user_other_details.user_id = ds_users.id');
		$this->db->Join('ds_all_artist_services_details', 'ds_all_artist_services_details.artist_id=ds_users.id','left');
		$this->db->Join('ds_currency', 'ds_all_artist_services_details.currency_id=ds_currency.currency_id','left');
		$this->db->where('ds_all_artist_services_details.service_type_id','2');
		//$this->db->order_by('ds_users.id','desc');
		//$this->db->group_by('ds_all_artist_services_details.artist_id');
		$this->db->where($where);
		$query= $this->db->get();
		//print_r($query->result());

      
        return $query;
    }
	 public function getArtistservices($limit, $start) {
        $where = "ds_users.role_id = '1'  ";
$where .= " AND ds_users.is_approved = '1'  ";
        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                 if ($val != '') {
                    if ($key == 'cat_search') {
                        $where .= " AND`cat_id` = '" . $val . "' ";
                    }
                    if ($key == 'attr_search') {
                        $i = 0;
                        foreach ($val as $k => $v) {
                            if ($i < 1) {
                                $where .= " AND (  `attribute` LIKE '%" . $v . "%' ";
                            } else {
                                $where .= " OR `attribute` LIKE '%" . $v . "%' ";
                            }
                            $i++;
//                            echo count($val);exit();
                            if ($i == count($val)) {
                                $where .= " ) ";
                            }
                        }
                    }
                    
                    
                    if ($key == 'order') {
//                       $where .= "   ORDER BY `sell_price`  " . $val . " ";
                    }
                }
            }
        }
        if(isset($_SESSION['search']['order']) && $_SESSION['search']['order']!='' ){
            $where .= "ORDER BY `ds_users`.`first_name` " . $_SESSION['search']['order'] . " ";
        }
		
		
		  $where .= "LIMIT $start , $limit";
		$this->db->select('ds_users.first_name,ds_users.service_id,ds_users.*,ds_user_other_details.user_id,ds_users.country_id,ds_country.id,ds_country.country_name,ds_artist_service.id,ds_user_other_details.profile_image,ds_all_artist_services_details.artist_id,ds_all_artist_services_details.service_type_id,ds_all_artist_services_details.*,ds_artist_service.*,ds_currency.*');
		$this->db->from('ds_users');
		$this->db->Join('ds_artist_service', 'ds_artist_service.id=ds_users.service_id' );
		$this->db->Join('ds_country', 'ds_country.id = ds_users.country_id' );
		 $this->db->Join('ds_user_other_details', 'ds_user_other_details.user_id = ds_users.id');
		$this->db->Join('ds_all_artist_services_details', 'ds_all_artist_services_details.artist_id=ds_users.id','left');
		$this->db->Join('ds_currency', 'ds_all_artist_services_details.currency_id=ds_currency.currency_id','left');
		$this->db->where('ds_all_artist_services_details.service_type_id','1');
		//$this->db->order_by('ds_users.id','desc');
		//$this->db->group_by('ds_all_artist_services_details.artist_id');
		$this->db->where($where);
		$query= $this->db->get();
		//print_r($query->result());

      
        return $query;
    }
	 
	public function getProducts2($limit, $start) {
       // $where = "`p_status` = 'Y'  ";
  //$where = "ds_users.role_id = '1'  ";
		$where = "ds_users.is_approved = '1'  ";
        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

//                if ($val != '') {
//                    if ($key == 'cat_search') {
//                        $where .= " AND`cat_id` = '" . $val . "' ";
//                    }
//                    if ($key == 'attr_search') {
//                        $i = 0;
//                        foreach ($val as $k => $v) {
//                            if ($i < 1) {
//                                $where .= " AND (  `attribute` LIKE '%" . $v . "%' ";
//                            } else {
//                                $where .= " OR `attribute` LIKE '%" . $v . "%' ";
//                            }
//                            $i++;
////                            echo count($val);exit();
//                            if ($i == count($val)) {
//                                $where .= " ) ";
//                            }
//                        }
//                    }
//                    
//                    
//                    if ($key == 'order') {
////                       $where .= "   ORDER BY `sell_price`  " . $val . " ";
//                    }
//                }
            }
        }
        if(isset($_SESSION['search']['order']) && $_SESSION['search']['order']!='' ){
            $where .= "ORDER BY `virtual_studio`  " . $_SESSION['search']['order'] . " ";
        }
		
        $where .= "   LIMIT $start , $limit ";
  $this->db->select('ds_users.country_id,ds_users.products_types_id,ds_users.city,ds_shop_store_details.banner_image,ds_users.role_id,ds_country.id,ds_country.country_name,ds_shop_store_details.user_id,ds_shop_store_details.shop_description,ds_product_types.id,ds_users.products_types_id,ds_product_types.product_types,ds_users.virtual_studio,ds_users.id');
        
        $this->db->from('ds_users');
		
        $this->db->Join('ds_shop_store_details', 'ds_shop_store_details.user_id = ds_users.id','left');
        $this->db->Join('ds_country', 'ds_country.id = ds_users.country_id');
		$this->db->Join('ds_product_types', 'ds_product_types.id=ds_users.products_types_id','left');
		$this->db->where('ds_users.role_id','6');
		$this->db->where($where);
        $query2 = $this->db->get();
    	//echo  $this->db->last_query();
        return $query2;
    }

    public function search($keyword){


        $this->db->select('ds_users.country_id,ds_users.products_types_id,ds_users.city,ds_shop_store_details.banner_image,ds_users.role_id,ds_country.id,ds_country.country_name,ds_shop_store_details.user_id,ds_shop_store_details.shop_description,ds_product_types.id,ds_users.products_types_id,ds_product_types.product_types,ds_users.virtual_studio,ds_users.id,ds_users.is_approved,ds_users.role_id');
        $this->db->from('ds_users');
        $this->db->where('ds_users.role_id','6');
	
			$this->db->where('ds_users.is_approved','1');
			$this->db->group_start();
			$this->db->or_like('ds_users.virtual_studio',$keyword);
		$this->db->or_like('ds_product_types.product_types',$keyword); 
		$this->db->group_end();

		
        $this->db->Join('ds_shop_store_details', 'ds_shop_store_details.user_id = ds_users.id','left');
        $this->db->Join('ds_country', 'ds_country.id = ds_users.country_id');
		$this->db->Join('ds_product_types', 'ds_product_types.id=ds_users.products_types_id','left');
		
        	
		
        $query=$this->db->get();
		$this->db->last_query();
        return $query->result_array();
//return true;
//return $query->result_array();

    }
   public function getdetails($where){
    $this->db->select('ds_products.*');
		$this->db->from('ds_products');
		
		$this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    
       }
    
    

   
    public function getProducts($limit, $start) {
        $where = "`p_status` = 'Y'  ";

        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {
                    if ($key == 'cat_search') {
                        $where .= " AND ds_products.cat_id = '" . $val . "' ";
                    }
                    if ($key == 'attr_search') {
                        $i = 0;
                        foreach ($val as $k => $v) {
                            if ($i < 1) {
                                $where .= " AND (  ds_products.attribute LIKE '%" . $v . "%' ";
                            } else {
                                $where .= " OR ds_products.attribute LIKE '%" . $v . "%' ";
                            }
                            $i++;
//                            echo count($val);exit();
                            if ($i == count($val)) {
                                $where .= " ) ";
                            }
                        }
                    }
                    
                    
                    
                    if ($key == 'order') {
//                       $where .= "   ORDER BY `sell_price`  " . $val . " ";
                    }
                }
            }
            if (isset($_SESSION['prod_name_search']) && !empty($_SESSION['prod_name_search'])) {
                $where .= " AND `name` LIKE '%" . $_SESSION['prod_name_search'] . "%' ";
            }
        }
        if(isset($_SESSION['search']['order']) && $_SESSION['search']['order']!='' ){
            $where .= "   ORDER BY `sell_price`  " . $_SESSION['search']['order'] . " ";
        }

        $where .= "   LIMIT $start , $limit ";
	
        
		$this->db->select('ds_products.*');
		$this->db->from('ds_products');
		
		$this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    public function getProductsByShop($limit, $start, $shop='') {
        
        $where = "`p_status` = 'Y'  ";

        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {
                    if ($key == 'cat_search') {
                        $where .= " AND`cat_id` = '" . $val . "' ";
                    }
                    if ($key == 'attr_search') {
                        $i = 0;
                        foreach ($val as $k => $v) {
                            if ($i < 1) {
                                $where .= " AND (  `attribute` LIKE '%" . $v . "%' ";
                            } else {
                                $where .= " OR `attribute` LIKE '%" . $v . "%' ";
                            }
                            $i++;
//                            echo count($val);exit();
                            if ($i == count($val)) {
                                $where .= " ) ";
                            }
                        }
                    }
                    
                    
                    
                    
                    if ($key == 'order') {
//                       $where .= "   ORDER BY `sell_price`  " . $val . " ";
                    }
                }
            }
            if (isset($_SESSION['prod_name_search']) && !empty($_SESSION['prod_name_search'])) {
                $where .= " AND `name` LIKE '%" . $_SESSION['prod_name_search'] . "%' ";
            }
        }
        if(isset($shop) && $shop !=''){
            $where .= " AND ds_products.u_id = '".($shop)."'";
        }
        if(isset($_SESSION['search']['order']) && $_SESSION['search']['order']!='' ){
            $where .= "   ORDER BY `sell_price`  " . $_SESSION['search']['order'] . " ";
        }

        $where .= "   LIMIT $start , $limit ";
	
        
		$this->db->select('ds_users.*,ds_products.*');
		$this->db->from('ds_users');
		$this->db->Join('ds_products', 'ds_products.u_id = ds_users.id');
		$this->db->where($where);
        $query = $this->db->get();
//        print_r($this->db->last_query());
        return $query;
    }

    public function getTotalProducts() {
        $where = "`p_status` = 'Y'  ";

        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {
                
                if ($val != '') {
                    if ($key == 'cat_search') {
                        $where .= " AND`cat_id` = '" . $val . "' ";
                    }
                    if ($key == 'attr_search') {
                        $i = 0;
                        foreach ($val as $k => $v) {
                            if ($i < 1) {
                                $where .= " AND (  `attribute` LIKE '%" . $v . "%' ";
                            } else {
                                $where .= " OR `attribute` LIKE '%" . $v . "%' ";
                            }
                            $i++;
//                            echo count($val);exit();
                            if ($i == count($val)) {
                                $where .= " ) ";
                            }
                        }
                    }
                }
            }
            
            if (isset($_SESSION['prod_name_search']) && !empty($_SESSION['prod_name_search'])){
                $where .= " AND `name` LIKE '%" . $_SESSION['prod_name_search'] . "%' ";
            }
        }

      $this->db->select('ds_products.*');
		$this->db->from('ds_products');
		
		$this->db->where($where);
                
		$query =$this->db->get();
                
        return $query->num_rows();
    }
    
    public function getTotalProductsByShop($shop = '') {
        $where = "`p_status` = 'Y'  ";

        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {
                
                if ($val != '') {
                    if ($key == 'cat_search') {
                        $where .= " AND`cat_id` = '" . $val . "' ";
                    }
                    if ($key == 'attr_search') {
                        $i = 0;
                        foreach ($val as $k => $v) {
                            if ($i < 1) {
                                $where .= " AND (  `attribute` LIKE '%" . $v . "%' ";
                            } else {
                                $where .= " OR `attribute` LIKE '%" . $v . "%' ";
                            }
                            $i++;
//                            echo count($val);exit();
                            if ($i == count($val)) {
                                $where .= " ) ";
                            }
                        }
                    }
                }
            }
            
            if (isset($_SESSION['prod_name_search']) && !empty($_SESSION['prod_name_search'])){
                $where .= " AND `name` LIKE '%" . $_SESSION['prod_name_search'] . "%' ";
            }
        }
        
        if(isset($shop) && $shop !=''){
            $where .= " AND ds_users.id = '".($shop)."'";
        }

      $this->db->select('ds_users.*,ds_products.*');
		$this->db->from('ds_users');
		$this->db->Join('ds_products', 'ds_products.u_id = ds_users.id');
		$this->db->where($where);
                
		$query =$this->db->get();
                
        return $query->num_rows();
    }

    public function getProductsCount() {
        $this->db->where('p_status', 'Y');
        $query = $this->db->count_all("ds_products");
        return $query;
    }
    
    public function getShop($shop = ''){
        
        $where = 'id = '.$shop;
        $this->db->select('ds_users.*');
        $this->db->from('ds_users');
        $this->db->where($where);
        $query =$this->db->get();
                
        return $query;
    }

    public function getArtists($limit, $start) {
        //print_R($_SESSION['search']);
        /*
          $this->db->where('ds_users.role_id', 1);
          if (!empty($_SESSION)) {
          foreach ($_SESSION['search'] as $key => $val) {

          if ($val != '') {
          if ($key == 'service') {
          $this->db->where('ds_artist_service.id', $val);
          }
          if ($key == 'keyword') {

          // foreach ($val as $k => $v) {
          $this->db->like('ds_users.first_name', $val);
          $this->db->or_like('ds_users.last_name', $val);
          //}
          }
          }
          }
          }
          $this->db->select('ds_users.*,ds_artist_service.id as s_id,ds_artist_service.service_name');
          $this->db->from('ds_users');
          $this->db->Join('ds_artist_service', 'ds_users.service_id = ds_artist_service.id', 'left');
          //$this->db->Join('designer', 'ds_users.id = designer.uid', 'left');

          $this->db->order_by('ds_users.id', 'DESC');
          $this->db->limit($limit, $start);

          $query = $this->db->get();
         */







        $where = " `ds_users`.`role_id` = '1'  ";
$where .= " AND `ds_users`.`is_approved` = '1'  ";
        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {

                    if ($key == 'service') {
                        $where .= " AND `ds_artist_service`.`id` = '" . $val . "' ";
                    }
                    if ($key == 'keyword') {
                        $where .= " AND ( `ds_users`.`first_name` LIKE '%" . $val . "%' or `ds_users`.`last_name` LIKE '%" . $val . "%' or CONCAT(`ds_users`.`first_name`,' ' ,`ds_users`.`last_name`) LIKE '%" . $val . "%') ";
                    }
                }
            }
        }

        $where .= "  ORDER BY `ds_users`.`id` DESC";
        $where .= "   LIMIT $start , $limit ";

        //$sql = "SELECT * FROM `ds_users` LEFT JOIN `ds_artist_service` ON `ds_users`.`service_id` = `ds_artist_service`.`id`  WHERE $where ";
        $sql = "SELECT ds_users.*,ds_user_other_details.profile_image,ds_users.id as u_id,ds_artist_service.* FROM `ds_users` LEFT JOIN `ds_artist_service` ON `ds_users`.`service_id` = `ds_artist_service`.`id` LEFT JOIN `ds_user_other_details` ON `ds_users`.`id` = `ds_user_other_details`.`user_id` WHERE $where ";
        $query = $this->db->query($sql);




        /* $this->db->where('is_approved', 1);
          $this->db->limit($limit, $start);
          $query = $this->db->get("ds_users"); */
//        echo $this->db->last_query();
        return $query;
    }
    
    public function getArtistsnewsearch($keyword) {
        
        $where = " `ds_users`.`role_id` = '1'  ";
        $where .= " AND `ds_users`.`is_approved` = '1'  ";
        
        $where .= " AND ( `ds_users`.`first_name` LIKE '%" . $keyword . "%' or `ds_users`.`last_name` LIKE '%" . $keyword . "%' or CONCAT(`ds_users`.`first_name`,' ' ,`ds_users`.`last_name`) LIKE '%" . $keyword . "%') ";

        $where .= "  ORDER BY `ds_users`.`id` DESC";
        $where .= "   LIMIT 0 , 12 ";

        //$sql = "SELECT * FROM `ds_users` LEFT JOIN `ds_artist_service` ON `ds_users`.`service_id` = `ds_artist_service`.`id`  WHERE $where ";
        $sql = "SELECT ds_users.*,ds_user_other_details.profile_image,ds_users.id as u_id,ds_artist_service.* FROM `ds_users` LEFT JOIN `ds_artist_service` ON `ds_users`.`service_id` = `ds_artist_service`.`id` LEFT JOIN `ds_user_other_details` ON `ds_users`.`id` = `ds_user_other_details`.`user_id` WHERE $where ";
        $query = $this->db->query($sql);
        $this->db->last_query();
        return $query->result_array();




        /* $this->db->where('is_approved', 1);
          $this->db->limit($limit, $start);
          $query = $this->db->get("ds_users"); */
//        echo $this->db->last_query();
        return $query;
    }

    public function getTotalArtists() {
        /*
        $this->db->where('ds_users.role_id', 1);
        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {
                    if ($key == 'sortBy') {
                        $this->db->where('ds_artist_service.id', $val);
                    }
                    if ($key == 'keyword') {

                        // foreach ($val as $k => $v) {
                        $this->db->like('ds_users.first_name', $val);
                        $this->db->or_like('ds_users.last_name', $val);
                        //}
                    }
                }
            }
        }
        $this->db->select('ds_users.*,ds_artist_service.id as s_id,ds_artist_service.service_name');
        $this->db->from('ds_users');
        $this->db->Join('ds_artist_service', 'ds_users.service_id = ds_artist_service.id', 'left');
        //$this->db->Join('designer', 'ds_users.id = designer.uid', 'left');

        $this->db->order_by('ds_users.id', 'DESC');
        $this->db->limit($limit, $start);

        $query = $this->db->get();


*/

//        $where = " `ds_users`.`role_id` = '1'  ";
//$where .= " AND `ds_users`.`is_approved` = '1'  ";
//        if (!empty($_SESSION)) {
//            foreach ($_SESSION['search'] as $key => $val) {
//
//                if ($val != '') {
//
//                    if ($key == 'service') {
//                        $where .= " AND `ds_artist_service`.`id` = '" . $val . "' ";
//                    }
//                    if ($key == 'keyword') {
//                        $where .= " AND ( `ds_users`.`first_name` LIKE '%" . $val . "%' or `ds_users`.`last_name` LIKE '%" . $val . "%' ) ";
//                    }
//                }
//            }
//        }
//
//        $where .= "  ORDER BY `ds_users`.`id` DESC";
        
        $where = " `ds_users`.`role_id` = '1'  ";
$where .= " AND `ds_users`.`is_approved` = '1'  ";
        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {

                    if ($key == 'service') {
                        $where .= " AND `ds_artist_service`.`id` = '" . $val . "' ";
                    }
                    if ($key == 'keyword') {
                        $where .= " AND ( `ds_users`.`first_name` LIKE '%" . $val . "%' or `ds_users`.`last_name` LIKE '%" . $val . "%' or CONCAT(`ds_users`.`first_name`,' ' ,`ds_users`.`last_name`) LIKE '%" . $val . "%') ";
                    }
                }
            }
        }

        $where .= "  ORDER BY `ds_users`.`id` DESC";

        //$sql = "SELECT * FROM `ds_users` LEFT JOIN `ds_artist_service` ON `ds_users`.`service_id` = `ds_artist_service`.`id`  WHERE $where ";
        $sql = "SELECT ds_users.*,ds_user_other_details.profile_image,ds_users.id as u_id,ds_artist_service.* FROM `ds_users` LEFT JOIN `ds_artist_service` ON `ds_users`.`service_id` = `ds_artist_service`.`id` LEFT JOIN `ds_user_other_details` ON `ds_users`.`id` = `ds_user_other_details`.`user_id` WHERE $where ";
        $query = $this->db->query($sql);

        //$this->db->where('is_approved', 1);
        //$query = $this->db->get("ds_users");
        return $query->num_rows();
    }

    public function getArtistsCount() {

        $this->db->where('role_id', 1);
        $query = $this->db->count_all("ds_users");
        return $query;
    }

    public function getworksamples($limit, $start) {
        

        $where = " `ds_designer_worksample`.`user_id` = '" . $this->session->userdata('USER_ID') . "'  ";

        
       if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {
//echo $key;die;
                if ($val != '') {
                    if ($key == 'order') {
                        //$this->db->order_by('id', $val);
                        $where .= "  ORDER BY `ds_designer_worksample`.`id` " . $val . "";
                    }
					}
					}
					}
                else{
                $where .= "  ORDER BY `ds_designer_worksample`.`id` DESC";
                }

        
        $where .= "   LIMIT $start , $limit ";

        $sql = "SELECT * FROM `ds_designer_worksample` WHERE $where ";
        $query = $this->db->query($sql);
//echo $this->db->last_query();die;
        return $query;
    }
    public function worksamples($limit, $start) {
        

      
 $where.= "ds_users.is_approved = '1'  ";
 //$where.= "ORDER BY `ds_designer_worksample`.`id` DESC";  
        
       if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {
//echo $key;die;
                if ($val != '') {
                    if ($key == 'order') {
                        //$this->db->order_by('id', $val);
                        $where .= "  ORDER BY `ds_designer_worksample`.`id` " . $val . "";
                    }
					}
					}
					}
                else{
                $where .= "  ORDER BY `ds_designer_worksample`.`id` DESC";
                }

        
        $where .= "   LIMIT $start , $limit ";

       $this->db->select('ds_users.*,ds_designer_worksample.*');
		$this->db->from('ds_users');
		$this->db->Join('ds_designer_worksample', 'ds_designer_worksample.user_id = ds_users.id');
		$this->db->where($where);
        $query = $this->db->get();
      
        return $query;
    }

    public function getTotalworksamples() {
       
       $where = " `ds_designer_worksample`.`user_id` = '" . $this->session->userdata('USER_ID') . "'  ";

      
       if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {
//echo $key;die;
                if ($val != '') {
                    if ($key == 'order') {
                        //$this->db->order_by('id', $val);
                        $where .= "  ORDER BY `ds_designer_worksample`.`id` " . $val . "";
                    }
					}
					}
					}
            else{
                $where .= "  ORDER BY `ds_designer_worksample`.`id` DESC";
                }

         $sql = "SELECT * FROM `ds_designer_worksample` WHERE $where ";
        $query = $this->db->query($sql);

        return $query->num_rows();
    }
    public function getTotalwork() {
       
        //$where = " `ds_designer_worksample`.`user_id` = '" . $this->session->userdata('USER_ID') . "'  ";
 $where.= "ds_users.is_approved = '1'  ";
       
        if (!empty($_SESSION)) {
             foreach ($_SESSION['search'] as $key => $val) {
 //echo $key;die;
                 if ($val != '') {
                     if ($key == 'order') {
                         //$this->db->order_by('id', $val);
                         $where .= "  ORDER BY `ds_designer_worksample`.`id` " . $val . "";
                     }
                     }
                     }
                     }
             else{
                 $where .= "  ORDER BY `ds_designer_worksample`.`id` DESC";
                 }
 
               $this->db->select('ds_users.*,ds_designer_worksample.*');
		$this->db->from('ds_users');
		$this->db->Join('ds_designer_worksample', 'ds_designer_worksample.user_id = ds_users.id');
		$this->db->where($where);
        $query = $this->db->get();
         //print_r($query->result());
         //echo $this->db->last_query();
 
         return $query->num_rows();
     }
public function getworksamplesCount() {
$user_id=$this->session->userdata('USER_ID');
        $this->db->where('user_id', $user_id);
        $query = $this->db->count_all("ds_designer_worksample");
        return $query;
    }
public function getquotes() {
        

        $where = " `ds_designer_quote`.`designer_id` = '" . $this->session->userdata('USER_ID') . "'  ";

        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {
                    if ($key == 'order') {
                        $this->db->order_by('id', $val);
                    }
					}
					}
					}
					$where .= "  ORDER BY `ds_designer_quote`.`id` DESC";

        //$where .= "  ORDER BY `ds_designer_worksample`.`id` DESC";
        //$where .= "   LIMIT $start , $limit ";

        $sql = "SELECT * FROM `ds_designer_quote` WHERE $where ";
        $query = $this->db->query($sql);

        return $query;
    }
public function getquoteswork(){
	 $where = " ds_designer_quote.designer_id = '" . $this->session->userdata('USER_ID') . "'  ";

        if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {
                    if ($key == 'order') {
                        $this->db->order_by('id', $val);
                    }
					}
					}
					}

        $where .= "  ORDER BY `ds_designer_quote`.`id` DESC";
       // $where .= "   LIMIT $start , $limit ";

       $this->db->select('ds_designer_quote.name as ename,ds_designer_quote.phone,ds_designer_quote.message,ds_designer_quote.email,ds_designer_quote.project_id,ds_designer_quote.designer_id,ds_designer_quote.date,ds_designer_worksample.*');
       $this->db->from('ds_designer_worksample');
       $this->db->join('ds_designer_quote','ds_designer_worksample.id=ds_designer_quote.project_id');
       $this->db->where($where);
       $query=$this->db->get();

        return $query;


}
    public function getTotalquotes() {
       
       $where = " `ds_designer_quote`.`designer_id` = '" . $this->session->userdata('USER_ID') . "'  ";

       if (!empty($_SESSION)) {
            foreach ($_SESSION['search'] as $key => $val) {

                if ($val != '') {
                    if ($key == 'order') {
                        $this->db->order_by('id', $val);
                    }
					}
					}
					}


        //$where .= "  ORDER BY `ds_designer_worksample`.`id` DESC";

         $sql = "SELECT * FROM `ds_designer_quote` WHERE $where ";
        $query = $this->db->query($sql);

        return $query->num_rows();
    }
		public function getquotesCount() {
		$user_id=$this->session->userdata('USER_ID');
        $this->db->where('designer_id', $user_id);
        $query = $this->db->count_all("ds_designer_quote");
        return $query;
    }



}

//end of class
?>