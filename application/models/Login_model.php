<?php

class Login_model extends CI_Model {
    public function __construct() {
        
        $this->load->database();
        
    }
    
    
    public function get_country(){
      $response = array();
      $this->db->select('*');
      $q = $this->db->get('countries');
      $response = $q->result_array();
      return $response;
    }
    
    // Get state
    public function get_state($postData){
      $response = array();
      $this->db->select('id,name');
      $this->db->where('country_id', $postData['country']);
      $q = $this->db->get('states');
      $response = $q->result_array();
      return $response;
    }
    
    public function check_users($mobile) {
		$this->db->where(['phone' => $mobile]);
		$query 	= $this->db->get('users');
		$result = $query->num_rows();
		return $result;
	}
	
	public function update_otp($mobile, $data) {
		return $this->db->update('users', $data, ["phone"=>$mobile]);
	}
	
	public function insert_otp($mobile, $data1) {
		return $this->db->insert('users', $data1, ["phone"=>$mobile]);
	}
	
	public function verify($otp) {
		$data = [];
		$this->db->where(['otp' => $otp]);
		$query = $this->db->get('users');
		$result = $query->row_array();
		//print_r($result);die;
		
		/*if($result) {
			$data = [
				'ulogin_id' => $result['id'],
			];
		}*/
		return $result;
	}
    
    
    /*public function categories()
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('status','1');
        $this->db->order_by('sort_order', 'asc');
        
        $query = $this->db->get();
        $this->db->last_query();
        $query->num_rows();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
        else {
            $error = false;
            return $error;
        }
    }
    */
    
    

}    