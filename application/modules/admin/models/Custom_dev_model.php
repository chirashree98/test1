<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Custom_dev_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function fetch_design_hours() {
        $this->db->select('ST.id AS design_service_type_id, ST.type_name, DSH.hours');
        $this->db->from('ds_services_types AS ST');
        $this->db->join('ds_design_request_hours AS DSH', 'DSH.design_service_type_id = ST.id', 'left');
        $this->db->where('ST.status', 'Y');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }


    public function check_hours($design_service_id) {

        $this->db->from('ds_design_request_hours');
        $this->db->where('design_service_type_id', $design_service_id);
        $query = $this->db->count_all_results();
        return $query;
    }

    public function update_check_hours($column, $where) {
        $this->db->set('hours', $column);
        $this->db->where('design_service_type_id', $where);
        $query = $this->db->update('ds_design_request_hours');
        return $query;
    }

    public function insert_check_hours($column_data = array()) {
        $query = $this->db->insert('ds_design_request_hours', $column_data);
        return $query;
    }

    public function get_all_record($table_name,$where_array){
        $res=$this->db->get_where($table_name,$where_array);
        return $res->result();
    }

    function AddRecord($row,$table) {
        $str = $this->db->insert($table, $row);
        /*$query = $this->db->query($str);
        $insertid = $this->db->insert_id();
        return $insertid;*/
    }

    function UpdateRecord($row,$table,$idfld,$id)
    {
        $this->db->where($idfld, $id);
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
    public function GetAllWhere($table_name,$where_clause) {
        if($where_clause != '')
            $this->db->where($where_clause);
        $this->db->select('*');
        $this->db->from($table_name);
        $query = $this->db->get();
        return $query;
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////Custom query builder class code start/////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////Re-use table models code start/////////////////////////////////////////////////
/// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        $this->db->order_by("DC.added_date_time", "asc");
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function admin_view_chat_attachments($chat_id = FALSE) {
        $this->db->select('attachment_file, attachment_type');
        $this->db->from('ds_designer_chat_attachments');
        $this->db->where('designer_chat_id', $chat_id);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function design_type_order_details($order_table_id) {
        $this->db->select('O.*, AT.first_name AS admin_designer_first_name, AT.last_name AS admin_designer_last_name, AP.profile_image AS admin_designer_profile_image, ROL.role_name, C.first_name AS customer_first_name, C.last_name AS customer_last_name, CP.profile_image AS customer_profile_image, ST.type_name');
        $this->db->from('ds_orders AS O');

        $this->db->join('ds_users AS AT', 'AT.id = O.userid', 'left');
        $this->db->join('ds_user_other_details AS AP', 'AP.user_id = O.userid', 'left');
        $this->db->join('ds_roles AS ROL', 'ROL.id = AT.role_id', 'left');

        $this->db->join('ds_users AS C', 'C.id = O.customer_id', 'left');
        $this->db->join('ds_user_other_details AS CP', 'CP.user_id = C.id', 'left');

        $this->db->join('ds_services_types AS ST', 'ST.id = O.service_id', 'left');
        $this->db->where('O.id', $order_table_id);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////Re-use table models code end//////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function select_table_where_order($select = '', $table = '', $where = array(), $order = '') {
        if (!empty($select)) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if (count($where) != 0) {
            $this->db->where($where);
        }
        if (!empty($order)) {
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function select_table_whereInColumn_whereInValues_order($select = '', $table = '', $whereInColumn = '', $whereInValues = [], $order = '') {
        if (!empty($select)) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if (!empty($whereInColumn) && count($whereInValues) > 0) {
            $this->db->where_in($whereInColumn, $whereInValues);
        }
        if (!empty($order)) {
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function first_select_table_where_order($select = '', $table = '', $where = array(), $order = '') {
        if (!empty($select)) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if (count($where) != 0) {
            $this->db->where($where);
        }
        if (!empty($order)) {
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function count_table_where($table = '', $where = array()) {
        $this->db->from($table);
        if (count($where) != 0) {
            $this->db->where($where);
        }
        $result = $this->db->count_all_results();
        return $result;
    }

    public function insert_table_value($table = '', $value = '') {
        $result = $this->db->insert($table, $value);
        return $result;
    }

    public function delete_table_where($table = '', $where = array()) {
        if(count($where) > 0){
            $this->db->where($where);
        }
        $result = $this->db->delete($table);

        return $result;
    }

    public function update_table_value_where($table = '', $value = array(), $where = array()) {

        $this->db->set($value);
        $this->db->where($where);
        $result = $this->db->update($table);

        return $result;
    }

    public function select_table_joinTable_joinOn_joinName_where_order($select = '', $table = '', $join_table = array(), $join_on = array(), $join_name = array(), $where = array(), $order = '') {

        if (!empty($select)) {
            $this->db->select($select);
        }

        if (!empty($table)) {
            $this->db->from($table);
        }

        if (count($join_table) != 0 && count($join_on) != 0 && count($join_name) != 0) {
            for ($i = 0; $i < count($join_table); $i++) {
                $this->db->join($join_table[$i], $join_on[$i], $join_name[$i]);
            }
        } else {
            for ($j = 0; $j < count($join_table); $j++) {
                $this->db->join($join_table[$j], $join_on[$j]);
            }
        }

        if (count($where) != 0) {
            $this->db->where($where);
        }

        if (!empty($order)) {
            $this->db->order_by($order);
        }

        $query = $this->db->get();
//        print_r($this->db->last_query());exit;
        $result = $query->result_array();
        return $result;
    }
    
    public function select_table_joinTable_joinOn_joinName_where_order_group($select = '', $table = '', $join_table = array(), $join_on = array(), $join_name = array(), $where = array(), $order = '', $group = '') {
        $this->db->distinct();
        if (!empty($select)) {
            $this->db->select($select);
        }

        if (!empty($table)) {
            $this->db->from($table);
        }

        if (count($join_table) != 0 && count($join_on) != 0 && count($join_name) != 0) {
            for ($i = 0; $i < count($join_table); $i++) {
                $this->db->join($join_table[$i], $join_on[$i], $join_name[$i]);
            }
        } else {
            for ($j = 0; $j < count($join_table); $j++) {
                $this->db->join($join_table[$j], $join_on[$j]);
            }
        }

        if (count($where) != 0) {
            $this->db->where($where);
        }

        if (!empty($order)) {
            $this->db->order_by($order);
        }
        if (!empty($group)) {
            $this->db->group_by($group);
        }

        $query = $this->db->get();
//        print_r($this->db->last_query());exit;
        $result = $query->result_array();
        return $result;
    }

    public function select_table_joinTable_joinOn_joinName_where_whereNotIn_order($select = '', $table = '', $join_table = array(), $join_on = array(), $join_name = array(), $where = array(), $where_not_in_column = '', $where_not_in_values = array(), $order = '') {

        if (!empty($select)) {
            $this->db->select($select);
        }

        if (!empty($table)) {
            $this->db->from($table);
        }

        if (count($join_table) != 0 && count($join_on) != 0 && count($join_name) != 0) {
            for ($i = 0; $i < count($join_table); $i++) {
                $this->db->join($join_table[$i], $join_on[$i], $join_name[$i]);
            }
        } else {
            for ($j = 0; $j < count($join_table); $j++) {
                $this->db->join($join_table[$j], $join_on[$j]);
            }
        }

        if (count($where) != 0) {
            $this->db->where($where);
        }

        if (!empty($where_not_in_column) && count($where_not_in_values) != 0) {
            $this->db->where_not_in($where_not_in_column, $where_not_in_values);
        }

        if (!empty($order)) {
            $this->db->order_by($order);
        }

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function insertGetId_table_value($table = '', $value = '') {
        $this->db->insert($table, $value);
        $id = $this->db->insert_id();
        return $id;
    }
}
//end of class
?>