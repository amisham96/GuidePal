<?php

class Dashboard_modal extends CI_Model {
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
  
  
  public function total_guidepal_register(){
      $this->db->select('*');
      $this->db->from('guidepal_registration');
      $this->db->where('status', 1);
      $q = $this->db->get();
      $result = $q->num_rows();
      return $result;
  }
  
  public function total_user_register(){
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('status', 1);
      $q = $this->db->get();
      $result = $q->num_rows();
      return $result;
  }
  
  public function total_rent_friend_register(){
      $this->db->select('*');
      $this->db->from('rent_friend');
      $this->db->where('status', 1);
      $q = $this->db->get();
      $result = $q->num_rows();
      return $result;
  }
  
  public function insert_faq($data)
	{
	    $this->db->insert('faq',$data);
    return ($this->db->affected_rows() == 0) ? false : true;
	}
	public function get_Faq($where)
	{
	        $this->db->select('*');
		$this->db->from('faq');
		if($where!='')
		{
		   
			$this->db->like($where);
		}
		$query = $this->db->get();
		
		
		$query->num_rows();
		if ( $query->num_rows() > 0 )
		{
			$row = $query->result_array();
			return $row;
		}
		else
		{
			$error=false;
			return $error;
		}
	}
	
		public function faq_status_change($id,$status)
	{
	   
		$this->db->set('Status', $status);
		$this->db->where('Id', $id);
		$this->db->update('faq');
		echo $this->db->last_query();
		return true;
	}
	public function faq_del($id)
	{
	    $this->db->query("delete  from faq where Id='".$id."'");
		return true;
	}
	
	public function faq_del_all($ids)
	{
	    $newsletter_ids=explode(",",$ids);
		foreach ($newsletter_ids as $id) 
		{
		$this->db->query("delete  from faq where Id='".$id."'");
		}
		return true;
	}
	public function update_faq($data,$id)
	{
	    $this->db->where('Id', $id);
		$this->db->update('faq',$data);

		return true;
	}
	
	public function edit_faq($id)
	{
	    $this->db->select('*');
		$this->db->from('faq');
		$this->db->where('Id',$id);
		$query = $this->db->get();
		$this->db->last_query();
		$query->num_rows();
		if ( $query->num_rows() > 0 )
		{
			$row = $query->result_array();
			return $row;
		}
		else
		{
			$error=false;
			return $error;
		}
	}
	
	
	
	
	public function insert_page($data)
	{
	    $this->db->insert('pages_management',$data);
    return ($this->db->affected_rows() == 0) ? false : true;
	}
	public function get_Page($where)
	{
	        $this->db->select('*');
		$this->db->from('pages_management');
		if($where!='')
		{
		   
			$this->db->like($where);
		}
		$query = $this->db->get();
		
		
		$query->num_rows();
		if ( $query->num_rows() > 0 )
		{
			$row = $query->result_array();
			return $row;
		}
		else
		{
			$error=false;
			return $error;
		}
	}
	
	public function page_status_change($id,$status)
	{
	   
		$this->db->set('page_status', $status);
		$this->db->where('page_id', $id);
		$this->db->update('pages_management');
		echo $this->db->last_query();
		return true;
	}
	public function page_del($id)
	{
	    $this->db->query("delete  from pages_management where page_id='".$id."'");
		return true;
	}
	
	public function page_del_all($ids)
	{
	    $newsletter_ids=explode(",",$ids);
		foreach ($newsletter_ids as $id) 
		{
		$this->db->query("delete  from pages_management where page_id='".$id."'");
		}
		return true;
	}
	public function update_page($data,$id)
	{
	    $this->db->where('page_id', $id);
		$this->db->update('pages_management',$data);

		return true;
	}
	
	public function edit_page($id)
	{
	    $this->db->select('*');
		$this->db->from('pages_management');
		$this->db->where('page_id',$id);
		$query = $this->db->get();
		$this->db->last_query();
		$query->num_rows();
		if ( $query->num_rows() > 0 )
		{
			$row = $query->result_array();
			return $row;
		}
		else
		{
			$error=false;
			return $error;
		}
	}
	
    public function add_new_page($data){
	    $this->db->insert('pages_management',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function update_new_page($data,$id){
	    $this->db->where('page_id', $id);
        $this->db->update('pages_management', $data);
        $this->db->last_query();
        return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function guide_images($id)
    {
       $this->db->select('*');
        $this->db->from('guidepal_gallery_img');
        $this->db->where('guide_id',$id);
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
    
    public function friend_images($id)
    {
       $this->db->select('*');
        $this->db->from('friend_gallery_img');
        $this->db->where('friend_id',$id);
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
    
    public function get_subscription()
    {
        $this->db->select('*, subscription.status as subscription_status,subscription.id as subscription_id');
        $this->db->from('subscription');
        $this->db->join("guidepal_registration", "guidepal_registration.id = subscription.guidepal_id","JOIN");
        //$this->db->join("rent_friend", "rent_friend.id = subscription.friend_id","LEFT");
        $this->db->join("payment", "payment.id = subscription.pkg_id","JOIN");
        $this->db->where('subscription.status','active');
        $this->db->or_where('subscription.status','deactive');
        $query = $this->db->get();
       // echo $this->db->last_query();die;
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
    
    /*public function get_friend_subscription()
    {
        $this->db->select('*,rent_friend_subscription.status as subscription_status,,rent_friend_subscription.id as subscription_id');
        $this->db->from('rent_friend_subscription');
        $this->db->join("rent_friend", "rent_friend.id = rent_friend_subscription.friend_id","JOIN");
        $this->db->join("rent_friend_payment", "rent_friend_payment.id = rent_friend_subscription.pkg_id","JOIN");
        $this->db->where('rent_friend_subscription.status','active');
        $this->db->or_where('rent_friend_subscription.status','deactive');
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
    }*/
    
 
  
  public function get_users_data()
	{
	    $this->db->select('count(id) as tot , created_on');
		$this->db->from('users');
		$this->db->order_by("created_on", "DESC");
		$this->db->group_by('created_on'); 
		$query = $this->db->get();
	//	echo $this->db->last_query();die;
		$row = $query->result_array();
		return $row;
	}
	
  
	
}    
