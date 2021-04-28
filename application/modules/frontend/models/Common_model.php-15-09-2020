<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model {

	public function __construct() {

		parent::__construct();
	}
	
	public function RetriveRecordByWhereRow($table,$where_clause) {
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$query = $this->db->get();
		$row = $query->row_array();
		return $row;
	}
	
	public function RetriveRecordByWhere($table,$where_clause) {
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$query = $this->db->get();
		return $query;
	}
	
	public function RetriveRecordByWhereLimit($table,$where_clause,$limit,$orderbyfld,$orderby) {
		$this->db->select('*');
		$this->db->limit($limit);
		$this->db->from($table);
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$this->db->order_by($orderbyfld, $orderby);
		$query = $this->db->get();
		return $query;
	}
        public function RetriveRecordOrderBy($table,$where_clause,$orderbyfld,$orderby) {
		$this->db->select('*');		
		$this->db->from($table);
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$this->db->order_by($orderbyfld, $orderby);
		$query = $this->db->get();
		return $query; 
	}
        
	public function get_all_record_Where_Limit($table_name,$where_array,$limit,$orderbyfld,$orderby){
		$this->db->select('*');	
		$this->db->limit($limit);
		$this->db->from($table_name);
		if(!empty($where_array))
		$this->db->where($where_array);
		$this->db->order_by($orderbyfld, $orderby);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_all_record($table_name,$where_array){
		$res=$this->db->get_where($table_name,$where_array);
		return $res->result();
	}
	
	function AddRecord($row,$table) {
		$str = $this->db->insert($table, $row);    
	}
	
	function UpdateRecord($row,$table,$idfld,$id)
	{
		$this->db->where($idfld, $id);
		$query = $this->db->update($table, $row);
		return $query;
	}
	function UpdateRecordWhereArray($row,$table,$where_clause)
	{
		$this->db->where($where_clause);
		$query = $this->db->update($table, $row);
		return $query;
	}
	
	public function GetAll($table_name){
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get(); 
		return $query;
	}
	
	public function Count($table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();  
		$tot_rec = $query->num_rows();
		return $tot_rec;
	}
	
	public function CountWhere($table_name,$where_clause) {
		$this->db->select('*');
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$this->db->from($table_name);
		$query = $this->db->get();  
		$tot_rec = $query->num_rows();
		return $tot_rec;
	}


	public function Delete($table_name, $id, $idfld){
		$this->db->where($idfld, $id);
		$this->db->delete($table_name);
	}
	public function get_records_from_sql($sql)
	{
		
		$query = $this->db->query($sql);
		return $query->result();
		
	}
	
	public function getRandomNumber($length)
	{
			
		$random= "";
		$data1 = "";
		srand((double)microtime()*1000000);
		$data1 = "9876549876542156012";
		$data1 .= "0123456789564542313216743132136864313";
		for($i = 0; $i < $length; $i++)
		{
			$random .= substr($data1, (rand()%(strlen($data1))), 1);
		}
		return $random;
	}
	public function GetAllWhere($table_name,$where_clause,$orderbyfld, $orderby) {
		if($where_clause != '')
			$this->db->where($where_clause);
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->order_by($orderbyfld, $orderby);
		$query = $this->db->get();  
		return $query->result();
	} 

	public function GetSumWhere($table_name,$where_clause,$sum_field) {
		if($where_clause != '')
		$this->db->where($where_clause);
		$this->db->select_sum($sum_field);
		$this->db->from($table_name);
		$query = $this->db->get();  
		return $query->result();
	} 
	
	public function getUserRole()
	{
		$this->db->select("*")
			->from("ds_roles")
			->where("id <>",1)
			->order_by("id");
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;		
	}
	
	public function getService()
	{
		$this->db->select("*")
			->from("ds_artist_service")
			->where("id <>",1)
			->order_by("id");
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;		
	}
	
	public function getCountry()
	{
		$this->db->select("*")
			->from("ds_country")			
			->order_by("id");
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;		
	}
	
	public function getMembership()
	{
		$this->db->select("*")
			->from("ds_membership")
			->order_by("id");
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;		
	}
	
	/*public function getMembership_by_role(2)
	{
		$this->db->select("*")
			->from("ds_membership")
			->where("user_type",2)
			->order_by("id");
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;		
	}
	*/
	public function insertNewUser($post)
	{
		$this->db->insert('ds_users', $post);
                
         return $this->db->insert_id();
	}

	public function insertMembership($post)
	{
		$this->db->insert('ds_user_membership', $post);
                
         return true;
	}
	
	public function insertOtp($post)
	{
		$this->db->insert('ds_email_otp', $post);
                
         return true;
	}
	
	public function checkOtp($uid,$otp)
	{
		$sql= "select count(*) as total from ds_email_otp where uid = " .$uid. " and otp = " .$otp;
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result[0]['total'];
	}
	
	
	public function updateEmailVerifyCode($udata,$uid)
	{
		$this->db->where('id',$uid);
		$this->db->update('ds_users',$udata);
		return true;
	}
public function getDialCode($cid)
	{
		$this->db->select("*")
			->from("ds_country")
			->where("id",$cid);
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result[0]['dial_code'];
	}
	public function getUserData($uid)
	{
		 $this->db->join('ds_roles', 'roles.id = users.role_id', 'left');
         $this->db->where("users.id",$uid);    
        $query = $this->db->select('roles.*, users.first_name, users.last_name,users.email')->get('users');
        return $query->result_array();
	}
	
public function changeStoreStatus($codeId, $toStatus)
    {
        $this->db->where('id', $codeId);
        if (!$this->db->update('ds_users', array(
                    'is_approved' => $toStatus
                ))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }
	
}


//end of class
?>