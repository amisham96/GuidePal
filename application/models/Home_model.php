<?php

class Home_model extends CI_Model {
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
    
    public function get_guide_info($data){
      //  print_r($data);die;
      $response = array();
      $current_date=strtotime(date('Y-m-d H:i:s'));
      $this->db->select('guidepal_registration.*, subscription_payment.guidepal_id');
      $this->db->join('subscription_payment','subscription_payment.guidepal_id = guidepal_registration.id');
      if($data['gender']!= ""){
        $this->db->where('gender', $data['gender']);  
      }
      if($data['location']!= ""){
        $this->db->where('city', $data['location']);  
      }
      if($data['age']!= ""){
          $agedata = explode("-",$data['age']);
          $this->db->where('age >=', $agedata[0] );
          $this->db->where('age  <=', $agedata['1']);
      }
      if($data['variable']!= "view_all"){
        $this->db->limit(4,0);  
      }
      
      $query = $this->db->get('guidepal_registration');
     //$response = $q->result_array();
      //echo $this->db->last_query();die;
      $response = $query->num_rows();
        if ($query->num_rows() > 0) {
            $response = $query->result_array();
            return $response;
        }
        else {
            $response = 0;
            return $response;
        }
      //return $response;
    }
    
    public function get_rent_friend_info($data){
      //  print_r($data);die;
      $response = array();
      $this->db->select('rent_friend.*,');
      $this->db->join('subscription_payment','subscription_payment.friend_id = rent_friend.id');
      if($data['gender']!= ""){
        $this->db->where('gender', $data['gender']);  
      }
      if($data['location']!= ""){
        $this->db->where('city', $data['location']);  
      }
      if($data['age']!= ""){
          $agedata = explode("-",$data['age']);
          $this->db->where('age >=', $agedata[0]);
          $this->db->where('age  <=', $agedata['1']);
      }
    //  $this->db->limit(2,0); 
      $query = $this->db->get('rent_friend');
    //$response = $q->result_array();
    //echo $this->db->last_query();die;
      $query->num_rows();
        if ($query->num_rows() > 0) {
            $response = $query->result_array();
            return $response;
        }
        else {
            $response = 0;
            return $response;
        }
      //return $response;
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
    
    public function get_package(){
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_selected_package($user_id){
        $this->db->select('*');
        $this->db->from('subscription');
        $this->db->where('guidepal_id',$user_id);
        $this->db->where('status','active');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function get_guide_member(){
        $this->db->select('*');
        $this->db->from('guidepal_registration');
        $this->db->where('status',1);
        //$this->db->limit(4,0); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_guide_details($id){
        $this->db->select('*');
        //$this->db->join('guidepal_gallery_img', 'guidepal_gallery_img.guide_id = guidepal_registration.id');
        $this->db->from('guidepal_registration');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_rent_friend(){
        $this->db->select('*');
        $this->db->from('rent_friend');
        $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_rent_friend_details($id){
        $this->db->select('*');
        $this->db->from('rent_friend');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
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
    
    
    public function guide_favorite_data($id){
     $guide_details = $this->db->get_where('guide_favourite', ['guide_id' =>$id, 'user_id' => $this->session->userdata('ulogin_id')['id']])->row_array();
     if(isset($guide_details)){
        return $response = 0; 
     }else{
      $this->db->set([
                    'user_id' => $this->session->userdata('ulogin_id')['id'],
					'guide_id' => $id
				]);
      $this->db->insert('guide_favourite');
      return $response = 1;
     }
    }
    
    public function guide_unfollow_data($id){
      $guide_unfollow_details = $this->db->get_where('guide_favourite', ['guide_id' =>$id, 'user_id' =>$this->session->userdata('ulogin_id')['id']])->row_array();
      if(isset($guide_unfollow_details)){
        $this->db->where('guide_id',$id);
        $this->db->where('user_id',$this->session->userdata('ulogin_id')['id']);
        $response = $this->db->delete('guide_favourite');
        return $response = 1;
      }
    }
    
    public function get_guide_favourite(){
        $this->db->select('guide_favourite.*, guidepal_registration.name as name, guidepal_registration.photo as photo, users.id');
        $this->db->join("guidepal_registration", "guidepal_registration.id = guide_favourite.guide_id","JOIN");
        $this->db->join("users", "users.id = guide_favourite.user_id","JOIN");
        $this->db->where('guide_favourite.user_id', $this->session->userdata('ulogin_id')['id']);
        $this->db->from('guide_favourite');
        $query = $this->db->get();
    //    echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_friend_favourite(){
        $this->db->select('rent_friend_favourite.*, rent_friend.name as name, rent_friend.photo as photo, users.id');
        $this->db->join("rent_friend", "rent_friend.id = rent_friend_favourite.friend_id","JOIN");
        $this->db->join("users", "users.id = rent_friend_favourite.user_id","JOIN");
        $this->db->where('rent_friend_favourite.user_id', $this->session->userdata('ulogin_id')['id']);
        $this->db->from('rent_friend_favourite');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function create_rating($data){
        $this->db->insert('ratesus', $data);
        return $this->db->insert_id();
    }
    
    public function create_friend_rating($data){
        $this->db->insert('rent_friend_ratesus', $data);
        return $this->db->insert_id();
    }
    
    /*public function get_selected_member_package($user_id){
        $this->db->select('subscription.*, subscription_payment.pkg_name as pkg_name');
        $this->db->from('subscription');
        $this->db->join('subscription_payment','subscription_payment.guidepal_id = subscription.guidepal_id');
    //    $this->db->join('guidepal_registration','guidepal_registration.id = subscription.guidepal_id');
        $this->db->where('subscription.guidepal_id',$user_id);
        $this->db->where('subscription.status','active');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }*/
    
    
    /*public function friend_fav($id){
      $friend_details = $this->db->get_where('rent_friend_favourite', ['friend_id' =>$id])->row_array();
      //  print_r($details);
      if($friend_details['friend_id'] == $id){
         return $response = 1; 
      }else{
      $this->db->set([
                    'user_id' => $this->session->userdata('ulogin_id')['id'],
					'friend_id' => $id
				]);
      $this->db->insert('rent_friend_favourite');
      return $response = 0;
      }
    }*/
    
    public function friend_favorite_data($id){
     $friend_details = $this->db->get_where('rent_friend_favourite', ['friend_id' =>$id, 'user_id' => $this->session->userdata('ulogin_id')['id']])->row_array();
     if(isset($friend_details)){
        return $response = 0; 
     }else{
      $this->db->set([
                    'user_id' => $this->session->userdata('ulogin_id')['id'],
					'friend_id' => $id
				]);
      $this->db->insert('rent_friend_favourite');
      return $response = 1;
     }
    }
    
    public function friend_unfollow_data($id){
      $friend_unfollow_details = $this->db->get_where('rent_friend_favourite', ['friend_id' =>$id, 'user_id' =>$this->session->userdata('ulogin_id')['id']])->row_array();
      if(isset($friend_unfollow_details)){
        $this->db->where('friend_id',$id);
        $this->db->where('user_id',$this->session->userdata('ulogin_id')['id']);
        $response = $this->db->delete('rent_friend_favourite');
        return $response = 1;
      }
    }
    
    
    // rent friend package
    
    public function get_selected_rent_friend($user_id){
        $this->db->select('*');
        $this->db->from('subscription');
        $this->db->where('friend_id',$user_id);
        $this->db->where('status','active');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function get_guide_follow($guide_id){
        $this->db->select('guide_favourite.*, users.name as name, users.profile_pic as profile_pic');
        $this->db->join("users", "users.id = guide_favourite.user_id","JOIN");
        $this->db->where('guide_favourite.guide_id', $guide_id);
        $this->db->from('guide_favourite');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_rentfriend_follow($friend_id){
        $this->db->select('rent_friend_favourite.*, users.name as name, users.profile_pic as profile_pic');
        $this->db->join("users", "users.id = rent_friend_favourite.user_id","JOIN");
        $this->db->where('rent_friend_favourite.friend_id', $friend_id);
        $this->db->from('rent_friend_favourite');
        $query = $this->db->get();
        return $query->result_array();
    }
    

}    