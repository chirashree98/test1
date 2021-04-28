<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Custom_model extends CI_Model {

	public function __construct() {

		parent::__construct();
	}
	
	public function upload($path,$image,$file_name,$fld_nm) {
            $this->load->library('upload');
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size']	= '2000';
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
				exit();*/
	}
	public function send_email($from_mail, $from_name,$to , $subject, $mail_body)
	{		
		$config['protocol'] = 'sendmail';
		$config['charset']  = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline']  = "\r\n";
		$this->email->initialize($config);	
		$this->email->from($from_mail, $from_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($mail_body);
		$this->email->send();
               ;
	
	}
        
        public function getPostcodeByCity($keyword){
		$this->db->select('*');	
		$this->db->from('users');
		$this->db->where('u_id',$keyword);
		$query = $this->db->get();
		return $query->result();
	}

	
	
}
//end of class
?>