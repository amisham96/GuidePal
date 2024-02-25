<?php
class Messagemodel extends CI_model{
	public function ownerDetails()
	{
		if(isset($_SESSION['uniqueid'])){
			$this->db->select('*');
			$this->db->where('unique_id',$_SESSION['uniqueid']);
			$res = $this->db->get('user')->result_array();
			return $res;
		}
	}
	public function allUser(){
		if($this->session->userdata('glogin_id')){
           $mysession = $this->session->userdata('glogin_id');
		   $userid=$mysession['id'];
		   $user_type=$mysession['user_type'];
		  
			$this->db->select('user_messages.*,users.*,users.profile_pic as photo');
            $this->db->from('user_messages');
            $this->db->join('users', 'users.id = user_messages.sender_message_id OR users.id = user_messages.receiver_message_id');
            $this->db->group_start();
            $this->db->where('user_messages.sender_message_id',$userid);
            $this->db->or_where('user_messages.receiver_message_id',$userid);
            $this->db->group_end();
             $this->db->group_start();
            $this->db->where('user_messages.receiver_type',$user_type);
            $this->db->or_where('user_messages.sender_type',$user_type);
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where('users.id !=',$userid);
            $this->db->group_end();
            $this->db->group_by('users.id');
            $this->db->order_by('user_messages.time', 'desc');
            $query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result_array();
			}else{
			
				return false;
			}
        }
        if($this->session->userdata('flogin_id')){
           $mysession = $this->session->userdata('flogin_id');
		   $userid=$mysession['id'];
		   $user_type=$mysession['user_type'];
		  
			$this->db->select('user_messages.*,users.*,users.profile_pic as photo');
            $this->db->from('user_messages');
            $this->db->join('users', 'users.id = user_messages.sender_message_id OR users.id = user_messages.receiver_message_id');
            $this->db->group_start();
            $this->db->where('user_messages.sender_message_id',$userid);
            $this->db->or_where('user_messages.receiver_message_id',$userid);
            $this->db->group_end();
             $this->db->group_start();
            $this->db->where('user_messages.receiver_type',$user_type);
            $this->db->or_where('user_messages.sender_type',$user_type);
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where('users.id !=',$userid);
            $this->db->group_end();
            $this->db->group_by('users.id');
            $this->db->order_by('user_messages.time', 'desc');
            $query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result_array();
			}else{
			
				return false;
			}
        }
		if($this->session->userdata('ulogin_id'))
		{
			$mysession = $this->session->userdata('ulogin_id');
			$userid=$mysession['id'];
			$user_type=$mysession['user_type'];
			$this->db->select('user_messages.*,guidepal_registration.*');
            $this->db->from('user_messages');
            $this->db->join('guidepal_registration', 'guidepal_registration.id = user_messages.sender_message_id OR guidepal_registration.id = user_messages.receiver_message_id');
            $this->db->group_start();
            $this->db->where('user_messages.sender_message_id',$userid);
            $this->db->or_where('user_messages.receiver_message_id',$userid);
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where('user_messages.receiver_type',$user_type);
            $this->db->or_where('user_messages.sender_type',$user_type);
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where('guidepal_registration.id !=',$userid);
            $this->db->group_end();
            $this->db->group_by('guidepal_registration.id');
            $this->db->order_by('user_messages.time', 'desc');
            $query = $this->db->get();
            $guidepal=array();
			if($query->num_rows() > 0)
			{
				 $guidepal=$query->result_array();
			}
			$this->db->select('user_messages.*,rent_friend.*');
            $this->db->from('user_messages');
            $this->db->join('rent_friend', 'rent_friend.id = user_messages.sender_message_id OR rent_friend.id = user_messages.receiver_message_id');
            $this->db->group_start();
            $this->db->where('user_messages.sender_message_id',$userid);
            $this->db->or_where('user_messages.receiver_message_id',$userid);
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where('user_messages.receiver_type',$user_type);
            $this->db->or_where('user_messages.sender_type',$user_type);
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where('rent_friend.id !=',$userid);
            $this->db->group_end();
            $this->db->group_by('rent_friend.id');
            $this->db->order_by('user_messages.time', 'desc');
            $query = $this->db->get();
            $rent_friend=array();
			if($query->num_rows() > 0)
			{
				 $rent_friend=$query->result_array();
			}
			$user = array();
            foreach ($guidepal as $key => $value){
                $user[] = $value;
            }
            foreach ($rent_friend as $key => $value){
                $user[] = $value;
            }
            $time = array_column($user, 'time');

           array_multisort($time, SORT_DESC, $user);
           // print_r($user);
		
			return $user;
			
		}
		
	}
	public function notseenMessage(){
		if($this->session->userdata('glogin_id')){
           $mysession = $this->session->userdata('glogin_id');
		   $userid=$mysession['id'];
        }
		if($this->session->userdata('ulogin_id'))
		{
			$mysession = $this->session->userdata('ulogin_id');
			$userid=$mysession['id'];
		}
		if($this->session->userdata('flogin_id'))
		{
			$mysession = $this->session->userdata('flogin_id');
			$userid=$mysession['id'];
		}
		if(isset($userid))
		{
		    $this->db->select('user_messages.*');
            $this->db->from('user_messages');
            $this->db->group_start();
            $this->db->where('user_messages.receiver_message_id',$userid);
            $this->db->where('user_messages.status !=','seen');
            $this->db->group_end();
            $query = $this->db->get();
             $this->db->last_query();
			if($query->num_rows() > 0)
			{
				return $query->num_rows();
			} else {
				return 0;
			}
		}
		else
		{
		    return 0;
		}
		
	}
	public function logoutUser($status, $date)
	{
		if(isset($_SESSION['uniqueid'])){
			$currentSession = $_SESSION['uniqueid'];
			$this->db->query("UPDATE user SET user_status = '$status' , last_logout = '$date' WHERE 
			unique_id = '$currentSession'");
		}
	}
	public function sentMessage($data){
		$this->db->insert('user_messages',$data);
		return $this->db->insert_id();
	}
	
	public function getmessage($data,$userType){
		if($this->session->userdata('glogin_id')){
           $mysession = $this->session->userdata('glogin_id');
			$session_id=$mysession['id'];
		    $user_type=$mysession['user_type'];
		}
		if($this->session->userdata('flogin_id')){
           $mysession = $this->session->userdata('flogin_id');
			$session_id=$mysession['id'];
		    $user_type=$mysession['user_type'];
		}
		if($this->session->userdata('ulogin_id'))
		{
		    $mysession = $this->session->userdata('ulogin_id');
			$session_id=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		
		$this->db->select('*');
		$where = "sender_message_id = '$session_id' AND sender_type = '$user_type'  AND receiver_message_id = '$data' AND receiver_type = '$userType' OR 
		sender_message_id = '$data' AND sender_type = '$userType' AND receiver_message_id = '$session_id' AND receiver_type = '$user_type'";
		$this->db->where($where);
		// $this->db->order_by('time', 'ASC');
		$result = $this->db->get('user_messages')->result_array();
		$status='seen';
		$this->UpdateMessageStatus($status,$data,$session_id,$user_type,$userType);
		return $result;
	}
	
	public function getNewmessage($data,$userType){
		if($this->session->userdata('glogin_id')){
           $mysession = $this->session->userdata('glogin_id');
			$session_id=$mysession['id'];
		    $user_type=$mysession['user_type'];
		}
		
		if($this->session->userdata('flogin_id')){
           $mysession = $this->session->userdata('flogin_id');
			$session_id=$mysession['id'];
		    $user_type=$mysession['user_type'];
		}
		if($this->session->userdata('ulogin_id'))
		{
		    $mysession = $this->session->userdata('ulogin_id');
			$session_id=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		
		$this->db->select('*');
		$where = "sender_message_id = '$data' AND sender_type = '$userType' AND receiver_message_id = '$session_id' AND receiver_type = '$user_type' AND status != 'seen'";
		$this->db->where($where);
		// $this->db->order_by('time', 'ASC');
		$result = $this->db->get('user_messages')->result_array();
		$status='seen';
		$this->UpdateMessageStatus($status,$data,$session_id,$user_type,$userType);
		return $result;
	}
	public function getsentmessage($message_id)
	{
	    if($this->session->userdata('glogin_id')){
           $mysession = $this->session->userdata('glogin_id');
			$session_id=$mysession['id'];
		    $user_type=$mysession['user_type'];
		}
		
		if($this->session->userdata('flogin_id')){
           $mysession = $this->session->userdata('flogin_id');
			$session_id=$mysession['id'];
		    $user_type=$mysession['user_type'];
		}
		if($this->session->userdata('ulogin_id'))
		{
		    $mysession = $this->session->userdata('ulogin_id');
			$session_id=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		
		$this->db->select('*');
		$where = "sender_message_id = '$session_id' AND sender_type = '$user_type' AND message_id =$message_id";
		$this->db->where($where);
		// $this->db->order_by('time', 'ASC');
		$result = $this->db->get('user_messages')->result_array();
		return $result;
	}
	public function UpdateMessageStatus($status,$sender_message_id,$receiver_message_id,$user_type,$userType)
	{
	    $this->db->set('status', $status);
		$this->db->where('sender_message_id', $sender_message_id);	
	    $this->db->where('sender_type', $userType);	
		$this->db->where('receiver_message_id', $receiver_message_id);	
		$this->db->where('receiver_type', $user_type);	
		$this->db->where('status !=', $status);	
		$this->db->update('user_messages');
	}
	
	public function getLastMessage($data,$userType)
	{
		if($this->session->userdata('glogin_id'))
		{
           $mysession = $this->session->userdata('glogin_id');
		   $session_id=$mysession['id'];
		   $user_type=$mysession['user_type'];
        }
        
		if($this->session->userdata('ulogin_id'))
		{
		    $mysession = $this->session->userdata('ulogin_id');
			$session_id=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		if($this->session->userdata('flogin_id'))
		{
		    $mysession = $this->session->userdata('flogin_id');
			$session_id=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		
		$this->db->select('*');
		$where = "sender_message_id = '$session_id' AND sender_type = '$user_type'  AND receiver_message_id = '$data' AND receiver_type = '$userType' OR 
		sender_message_id = '$data' AND sender_type = '$userType' AND  receiver_message_id = '$session_id' AND receiver_type = '$user_type'";
		$this->db->where($where);
		$this->db->order_by('time', 'DESC');
		$result = $this->db->get('user_messages', 1)->result_array();
		return $result;
	}
	public function gettotnotseenMessage($data,$userType)
	{
	    if($this->session->userdata('glogin_id'))
		{
           $mysession = $this->session->userdata('glogin_id');
		   $session_id=$mysession['id'];
		   $user_type=$mysession['user_type'];
        }
        
		if($this->session->userdata('ulogin_id'))
		{
		    $mysession = $this->session->userdata('ulogin_id');
			$session_id=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		if($this->session->userdata('flogin_id'))
		{
		    $mysession = $this->session->userdata('flogin_id');
			$session_id=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		
		$this->db->select('*');
		$where = "sender_message_id = '$data' AND sender_type = '$userType' AND  receiver_message_id = '$session_id' AND receiver_type = '$user_type' AND status !='seen'";
		$this->db->where($where);
		$this->db->order_by('time', 'DESC');
		$result = $this->db->get('user_messages')->num_rows();
		return $result;
	}
	
	public function getIndividual($id,$usertype)
	{
		if($usertype=='u')
		{
            $this->db->select('*,users.profile_pic as profile');
    		$this->db->where('id',$id);
    		$res = $this->db->get('users')->result_array();
    		return $res;
        }
		if($usertype=='g')
		{
		    $this->db->select('*,guidepal_registration.photo as profile');
    		$this->db->where('id',$id);
    		$res = $this->db->get('guidepal_registration')->result_array();
    		return $res;
		}
		
		if($usertype=='f')
		{
		    $this->db->select('*,rent_friend.photo as profile');
    		$this->db->where('id',$id);
    		$res = $this->db->get('rent_friend')->result_array();
    		return $res;
		}
		
	}
	public function updateBio($data){
		if(isset($_SESSION['uniqueid'])){
			$session_id = $_SESSION['uniqueid'];
			$bio = $data['bio'];
			$dob = $data['dob'];
			$address = $data['address'];
			$phone = $data['phone'];

			$this->db->query("UPDATE user SET bio = '$bio', dob = '$dob', address = '$address', phone = '$phone' WHERE unique_id = '$session_id'");
			// return $data;
		}
	}
	public function blockUser($arr){
		$this->db->insert('block_user',$arr);
	}
	public function unBlockUser($val1, $val2){
		$this->db->query("DELETE FROM block_user WHERE blocked_from = '$val1' AND blocked_to = '$val2'");
	}
	public function getBlockUserData($val1, $val2){
		$this->db->select('*');
		$where = "blocked_from = '$val1' AND blocked_to = '$val2' OR blocked_from = '$val2' AND blocked_to = '$val1'";
		$this->db->where($where);
		$res = $this->db->get('block_user')->result_array();

		return $res;
	}
}


?>