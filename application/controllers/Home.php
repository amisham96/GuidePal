<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
       
        // CHECK CUSTOM SESSION DATA
       // $this->session_data();
		$this->load->model('Home_model');
		$this->load->library("pagination");
		
    }
    

    public function index() {
        $this->home();
    }

    public function home() {
        if ($this->session->userdata('ulogin_id')) {
            redirect('find');
        }elseif($this->session->userdata('glogin_id') || $this->session->userdata('flogin_id')){
            redirect('buy');
        }
        
        $page_data['page_name'] = "home";
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
    public function find() {
        if (!$this->session->userdata('ulogin_id')) {
            redirect('home');
        }
        $page_data['page_name'] = "find";
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
    public function guide() {
        if (!$this->session->userdata('ulogin_id')) {
            redirect('home');
        }
        
        $page_data['page_name'] = "guide";
        $page_data['guide_member'] = $this->Home_model->get_guide_member();
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
    public function guide_info(){ 
       $data = $this->input->post();
       $data = $this->Home_model->get_guide_info($data);
       //print_r($data);die;
       echo json_encode($data); 
    }
    
    public function guide_details($id) {
        if (!$this->session->userdata('ulogin_id')) {
            redirect('home');
        }
        
        $page_data['page_name'] = "guide_details";
        $page_data['guide_details'] = $this->Home_model->get_guide_details($id);
        $page_data['guide_images'] = $this->Home_model->guide_images($id);
        $page_data['guide_first_img'] = $this->db->get_where('guidepal_registration', array('id' => $id))->row_array();
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
    public function favourite() {
        if (!$this->session->userdata('ulogin_id')) {
            redirect('home');
        }
        
        $page_data['page_name'] = "favourite";
        $page_data['guide_favourite'] = $this->Home_model->get_guide_favourite();
        $page_data['friend_favourite'] = $this->Home_model->get_friend_favourite();
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
    public function guide_favorite(){ 
       $id = $this->input->post('id');
       $data = $this->Home_model->guide_favorite_data($id);
       //echo json_encode($data); 
       if($data == 1){
         echo json_encode([
            'status' => 1,
            'message' => 'successfully added to favorites'
         ]);  
       }else{
        echo json_encode([
            'status' => 0,
            'message' => 'This detail is already favourite'
         ]);   
       }
    }
    
    public function guide_unfollow(){ 
       $id = $this->input->post('id');
       $data = $this->Home_model->guide_unfollow_data($id);
       //print_r($data);die;
       if($data == 1){
         echo json_encode([
            'status' => 1,
            'message' => 'successfully unfollow guide.'
         ]);  
       }
       //echo json_encode($data); 
    }
    
	
	public function rent_friend() {
        if (!$this->session->userdata('ulogin_id')) {
            redirect('home');
        }
        $page_data['page_name'] = "rent_friend";
        $page_data['rent_friend'] = $this->Home_model->get_rent_friend();
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
    public function rent_friend_info(){ 
       $data = $this->input->post();
       $data = $this->Home_model->get_rent_friend_info($data);
       //print_r($data);die;
       echo json_encode($data); 
    }
    
    public function rent_friend_details($id) {
        if (!$this->session->userdata('ulogin_id')) {
            redirect('home');
        }
        
        $page_data['page_name'] = "rent_friend_details";
        $page_data['rent_friend_details'] = $this->Home_model->get_rent_friend_details($id);
        $page_data['friend_images'] = $this->Home_model->friend_images($id);
        $page_data['friend_first_img'] = $this->db->get_where('rent_friend', array('id' => $id))->row_array();
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
    
    /*public function friend_fav(){ 
       $id = $this->input->post('id');
       $data = $this->Home_model->friend_fav($id);
       echo json_encode($data); 
    }*/
    
    public function friend_favorite(){ 
       $id = $this->input->post('id');
       $data = $this->Home_model->friend_favorite_data($id);
       //echo json_encode($data); 
       if($data == 1){
         echo json_encode([
            'status' => 1,
            'message' => 'successfully added to favorites'
         ]);  
       }else{
        echo json_encode([
            'status' => 0,
            'message' => 'This detail is already favourite'
         ]);   
       }
    }
    
    public function friend_unfollow(){ 
       $id = $this->input->post('id');
       $data = $this->Home_model->friend_unfollow_data($id);
       //print_r($data);die;
       if($data == 1){
         echo json_encode([
            'status' => 1,
            'message' => 'successfully unfollow Rent as a friend.'
         ]);  
       }
       //echo json_encode($data); 
    }
      
    
    public function user_profile(){
        
        if (!$this->session->userdata('ulogin_id')) {
            redirect('home');
        }
	    
	    if($this->input->method() == 'post' ){
	        
	      $this->load->library('form_validation');
	      $this->form_validation->set_rules('name','Name','required');
	      $this->form_validation->set_rules('email','Email','required|valid_email');
	      $this->form_validation->set_rules('mobile_no','Mobile number','required');
	      
	    if($this->form_validation->run()){
	        
                    $this->db->set([
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
						'dob' => $this->input->post('dob'),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
					//	'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						//'status' => $this->input->post('status'),
					]);
	        
	       	    try { 
	        
	                /* $file = $this->input->upload('image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
                    ] );
                    
                    if( isset($file) ){
						$this->db->set('aadhar_image', $file['path']);
					}*/
				
		            $profile_pic = $this->input->upload( 'profile_pic', './uploads/profile_pics/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
					] );
					
					if( isset($profile_pic) ){
						$this->db->set('profile_pic', $profile_pic['path']);
					}		
						
					$this->db->where('id', $this->session->userdata('ulogin_id')['id']);	
					$this->db->update('users');
					notify( 'Your Profile Details has been successfully updated.', 'success', 10 );
					redirect('user-profile');  
	          
	            }catch (\Exception $e){
					notify( $e->getMessage(), 'warning', 10 );
				} 
	           }else{
	              notify( strip_tags( validation_errors() ), 'warning', 10 );
	           }
              } 
        
          $page_data['page_name'] = 'user_profile';
          $page_data['country'] = $this->Home_model->get_country();
          $page_data['profile'] = $this->db->get_where('users', ['id' => $this->session->userdata('ulogin_id')['id']])->row_array();
          $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data); 
    }
    
    
    
    
    
    public function buy() {
        if (!$this->session->userdata('glogin_id') && !$this->session->userdata('flogin_id')) {
            redirect('home');
        }
        if($this->session->userdata('glogin_id'))
        {
         $user_id=$this->session->userdata('glogin_id')['id'];

         $page_data['selected_package'] = $this->Home_model->get_selected_package($user_id);
         
         $page_data['package'] = $this->Home_model->get_package();

        }
        if($this->session->userdata('flogin_id')){
         $user_id=$this->session->userdata('flogin_id')['id'];

         $page_data['selected_package'] = $this->Home_model->get_selected_rent_friend($user_id);
         
         $page_data['package'] = $this->Home_model->get_package();
         
        }
        $page_data['page_name'] = "buy";
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
    function randomKey($limit){
        $values = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
        $count = strlen($values);
        $count--;
        $key=NULL;
            for($x=1;$x<=$limit;$x++){
                $rand_var = rand(0,$count);
                $key .= substr($values,$rand_var,1);
            }
        
        return strtolower($key);
    }
    
    public function payment($pck_name)
    {
       if($this->session->userdata('glogin_id'))
        {
            $get_pack = $this->db->get_where('payment', ['pkg_name' => $pck_name])->row_array();
            if($get_pack)
            {
                
                $current_date=strtotime(date('Y-m-d H:i:s'));
                $user_id=$this->session->userdata('glogin_id')['id'];

                $selected_package = $this->Home_model->get_selected_package($user_id);
                if($selected_package)
                {
                    $selected_package_date=strtotime($selected_package['subscription_payment_date']);
                    $selected_package_expdate=strtotime(date("Y-m-d H:i:s", strtotime($selected_package['subscription_payment_date'])) . "+".$get_pack['pkg_duration']." months");
                    if($current_date<$selected_package_expdate)
                    {
                        redirect('buy');
                    }
                }
                
            	$this->load->library('cashier');
            	$this->cashier->driver('razorpay');
            	$guidepal = $this->db->get_where('guidepal_registration', ['id' => $this->session->userdata('glogin_id')['id']])->row_array();
            	$generate_order_id  = 'Order_'.$this->randomKey(16).''.$this->session->userdata('glogin_id')['id'];
            	
            	$current_date_time=date('Y-m-d H:i:s');
                	    $subscription=array(
                	        'order_id'=>$generate_order_id,
                	        'pkg_id'=>$get_pack['id'],
                	        'guidepal_id'=>$this->session->userdata('glogin_id')['id'],
                	        'create_date'=>$current_date_time,
                	        );
                	        
                	   $this->db->insert('subscription',$subscription);
                	   
            	$result = $this->cashier->pre_payment([
                	                'order_id' => $generate_order_id,
                            		'order_amount' => $get_pack['pkg_amount'],
                            		'order_currency' => system_settings('currency'),
                            		'customer_name' => $guidepal['name'],
                            		'customer_email' => $guidepal['email'],
                            		'customer_contact' => $guidepal['phone'],
                            		'order_note' => $get_pack['pkg_name'],
                                    "status"=> "created",
                        	    ]);
                        	    
            		if(!$result )
                	{
                	    
                		$this->session->set_flashdata('payment_error',$this->cashier->message());
                		 redirect('error');
                	}
                
        }
            else
            {
               redirect('buy'); 
            }
    	
        }elseif($this->session->userdata('flogin_id')){
          $get_pack = $this->db->get_where('payment', ['pkg_name' => $pck_name])->row_array();
            if($get_pack)
            {
                
                $current_date=strtotime(date('Y-m-d H:i:s'));
                $user_id=$this->session->userdata('flogin_id')['id'];

                $selected_package = $this->Home_model->get_selected_package($user_id);
                if($selected_package)
                {
                    $selected_package_date=strtotime($selected_package['subscription_payment_date']);
                    $selected_package_expdate=strtotime(date("Y-m-d H:i:s", strtotime($selected_package['subscription_payment_date'])) . "+".$get_pack['pkg_duration']." months");
                    if($current_date<$selected_package_expdate)
                    {
                        redirect('buy');
                    }
                }
                
            	$this->load->library('cashier');
            	$this->cashier->driver('razorpay');
            	$friend = $this->db->get_where('rent_friend', ['id' => $this->session->userdata('flogin_id')['id']])->row_array();
            	$generate_order_id  = 'Order_'.$this->randomKey(16).''.$this->session->userdata('flogin_id')['id'];
            	
            	$current_date_time=date('Y-m-d H:i:s');
                	    $subscription=array(
                	        'order_id'=>$generate_order_id,
                	        'pkg_id'=>$get_pack['id'],
                	        'friend_id'=>$this->session->userdata('flogin_id')['id'],
                	        'create_date'=>$current_date_time,
                	        );
                	        
                	   $this->db->insert('subscription',$subscription);
                	   
            	$result = $this->cashier->pre_payment([
                	                'order_id' => $generate_order_id,
                            		'order_amount' => $get_pack['pkg_amount'],
                            		'order_currency' => system_settings('currency'),
                            		'customer_name' => $friend['name'],
                            		'customer_email' => $friend['email'],
                            		'customer_contact' => $friend['phone'],
                            		'order_note' => $get_pack['pkg_name'],
                                    "status"=> "created",
                        	    ]);
                        	    
            		if(!$result )
                	{
                	    
                		$this->session->set_flashdata('payment_error',$this->cashier->message());
                		 redirect('error');
                	}
                
        }
            else
            {
               redirect('buy'); 
            }  
        }
        else
        {
            redirect('home');
        }
 
    }
    public function payment_success()
    {
     /*if (!$this->session->userdata('glogin_id'))
         {
         redirect('home');
         }*/
    $this->load->library('cashier');
	$result = $this->cashier->post_payment(100, system_settings('currency')); 
    if($this->session->userdata('glogin_id')){     
	if( $result )
	{
		// confirm order and save reference_id in database
		if($result['tx_status']=='paid')
		{

          $subscription=$this->db->get_where('subscription', ['order_id' => $result['order_id']])->row_array();
          
          //print_r($subscription);die;
          if($subscription)
          {
              $guidepal = $this->db->get_where('guidepal_registration', ['id' => $subscription['guidepal_id']])->row_array();
		      $get_pack = $this->db->get_where('payment', ['id' => $subscription['pkg_id']])->row_array();
              
               $current_date_time=date('Y-m-d H:i:s');
    		   
    		   $subscription_payment=array(
    		       'guidepal_id'=>$guidepal['id'],
    		       'guidepal_name'=>$guidepal['name'],
    		       'guidepal_email'=>$guidepal['email'],
    		       'guidepal_phone'=>$guidepal['phone'],
    		       'pkg_id'=>$get_pack['id'],
    		       'pkg_name'=>$get_pack['pkg_name'],
    		       'pkg_amount'=>$get_pack['pkg_amount'],
    		       'order_id'=>$result['order_id'],
    		       'order_amount'=>$result['order_amount']/100,
    		       'reference_id'=>$result['reference_id'],
    		       'tx_status'=>$result['tx_status'],
    		       'payment_mode'=>$result['payment_mode'],
    		       'tx_time'=>$result['tx_time'],
    		       'provider'=>$result['provider'],
    		       'create_date'=>$current_date_time,
    		       );
    		      $this->db->insert('subscription_payment',$subscription_payment); 
    		      $subscription_payment_id=$this->db->insert_id();
    		      
    		      $subscription_update=array(
    		          'status'=>'expired'
    		          );
    		         $this->db->where('guidepal_id', $guidepal['id']);	
    		        $this->db->where('order_id !=', $result['order_id']);	
					$this->db->update('subscription',$subscription_update);
					
    		      
    		      $subscription_update=array(
    		          'subscription_payment_id'=>$subscription_payment_id,
    		          'subscription_payment_date'=>$current_date_time,
    		          'status'=>'active'
    		          );
    		          
    		        $this->db->where('order_id', $result['order_id']);	
					$this->db->update('subscription',$subscription_update);
					
					    $this->load->library('email');
						//$smtp_data=$this->Setting->smtp_data();
						$subscription_payment['duration']=$get_pack['pkg_duration'];
						$this->email->initialize([
							'protocol' => 'mail',
							'smtp_host' => 'maavaishodevitourstravels.in',
							'smtp_user' => 'guidepal@guidepal.maavaishodevitourstravels.in',
							'smtp_pass' => '$fSY*wQ}SEE$',
							'smtp_port' => '587',
							'mailtype'  => 'html', 
                            'charset'   => 'utf-8'
						]);
						$message=$this->load->view('/email/invoice_temp', ['subscription_payment' => $subscription_payment], true) ;
						$this->email->from('guidepal@guidepal.maavaishodevitourstravels.in', system_settings('site_title'));
						$this->email->to($guidepal['email']);
						$this->email->subject('Subscribe Invoice | '.system_settings('site_title'));
						$this->email->message($message);
						$this->email->send();
						
						
					
					redirect('success');
					
              } 
		    
		}
	}
    }elseif($this->session->userdata('flogin_id')){
     //$this->load->library('cashier');
	 //$result = $this->cashier->post_payment(100, system_settings('currency'));
	if( $result )
	{
		// confirm order and save reference_id in database
		if($result['tx_status']=='paid')
		{

          $subscription=$this->db->get_where('subscription', ['order_id' => $result['order_id']])->row_array();
          if($subscription)
          {
              $friend = $this->db->get_where('rent_friend', ['id' => $subscription['friend_id']])->row_array();
		      $get_pack = $this->db->get_where('payment', ['id' => $subscription['pkg_id']])->row_array();
              
               $current_date_time=date('Y-m-d H:i:s');
    		   
    		   $subscription_payment=array(
    		       'friend_id'=>$friend['id'],
    		       'guidepal_name'=>$friend['name'],
    		       'guidepal_email'=>$friend['email'],
    		       'guidepal_phone'=>$friend['phone'],
    		       'pkg_id'=>$get_pack['id'],
    		       'pkg_name'=>$get_pack['pkg_name'],
    		       'pkg_amount'=>$get_pack['pkg_amount'],
    		       'order_id'=>$result['order_id'],
    		       'order_amount'=>$result['order_amount']/100,
    		       'reference_id'=>$result['reference_id'],
    		       'tx_status'=>$result['tx_status'],
    		       'payment_mode'=>$result['payment_mode'],
    		       'tx_time'=>$result['tx_time'],
    		       'provider'=>$result['provider'],
    		       'create_date'=>$current_date_time,
    		       );
    		      $this->db->insert('subscription_payment',$subscription_payment); 
    		      $subscription_payment_id=$this->db->insert_id();
    		      
    		      $subscription_update=array(
    		          'status'=>'expired'
    		          );
    		         $this->db->where('friend_id', $friend['id']);	
    		        $this->db->where('order_id !=', $result['order_id']);	
					$this->db->update('subscription',$subscription_update);
					
    		      
    		      $subscription_update=array(
    		          'subscription_payment_id'=>$subscription_payment_id,
    		          'subscription_payment_date'=>$current_date_time,
    		          'status'=>'active'
    		          );
    		          
    		        $this->db->where('order_id', $result['order_id']);	
					$this->db->update('subscription',$subscription_update);
					
					    $this->load->library('email');
						//$smtp_data=$this->Setting->smtp_data();
						$subscription_payment['duration']=$get_pack['pkg_duration'];
						$this->email->initialize([
							'protocol' => 'mail',
							'smtp_host' => 'maavaishodevitourstravels.in',
							'smtp_user' => 'guidepal@guidepal.maavaishodevitourstravels.in',
							'smtp_pass' => '$fSY*wQ}SEE$',
							'smtp_port' => '587',
							'mailtype'  => 'html', 
                            'charset'   => 'utf-8'
						]);
						$message=$this->load->view('/email/invoice_temp', ['subscription_payment' => $subscription_payment], true) ;
						$this->email->from('guidepal@guidepal.maavaishodevitourstravels.in', system_settings('site_title'));
						$this->email->to($friend['email']);
						$this->email->subject('Subscribe Invoice | '.system_settings('site_title'));
						$this->email->message($message);
						$this->email->send();
						
						
					
					redirect('success');
					
              } 
		    
		}
	}   
    }
	else 
	{
	    redirect('error');
	} 
}

public function amount_success()
{
    if (!$this->session->userdata('glogin_id') || !$this->session->userdata('flogin_id')) {
            redirect('home');
    }
        $page_data['page_name'] = "payment_success";
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
}

public function amount_error()
{
    if (!$this->session->userdata('glogin_id') || !$this->session->userdata('flogin_id')) {
            redirect('home');
        }
        $page_data['page_name'] = "payment_error";
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
}
    
    public function guide_profile(){
        
        if (!$this->session->userdata('glogin_id')) {
            redirect('home');
        }
	    
	    if($this->input->method() == 'post' ){
	        
	      $this->load->library('form_validation');
	      $this->form_validation->set_rules('name','Name','required');
	      $this->form_validation->set_rules('email','Email','required|valid_email');
	      $this->form_validation->set_rules('mobile_no','Mobile number','required');
	      
	    if($this->form_validation->run()){
	        
                    $this->db->set([
						'name' => $this->input->post('name'),
						'gender' => $this->input->post('gender'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
						'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						'about' => $this->input->post('about'),
						'age' => $this->input->post('age'),
					//	'aadhar_image' => $file['path'],
					//	'profile_pic' => $profile_pic['path'],
						//'status' => $this->input->post('status'),
					]);
	        
	       	    try { 
	        
	                 $file = $this->input->upload('image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
                    ] );
                    
                    if( isset($file) ){
						$this->db->set('aadhar_image', $file['path']);
					}
				
		            $profile_pic = $this->input->upload( 'profile_pic', './uploads/guidepal_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
					] );
					
					if( isset($profile_pic) ){
						$this->db->set('photo', $profile_pic['path']);
					}		
						
					$this->db->where('id', $this->session->userdata('glogin_id')['id']);	
					$this->db->update('guidepal_registration');
					
				if($_FILES['image']['name'])
                {
                $this->load->library('upload');
                  $image = array();
                  $ImageCount = count($_FILES['image']['name']);
                        for($i = 0; $i < $ImageCount; $i++){
                            $_FILES['file']['name']       = $_FILES['image']['name'][$i];
                            $_FILES['file']['type']       = $_FILES['image']['type'][$i];
                            $_FILES['file']['tmp_name']   = $_FILES['image']['tmp_name'][$i];
                            $_FILES['file']['error']      = $_FILES['image']['error'][$i];
                            $_FILES['file']['size']       = $_FILES['image']['size'][$i];
                
                            // File upload configuration
                            $uploadPath = './uploads/guidepal_image/galleryImage/';
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                
                            // Load and initialize upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                           
                            // Upload file to server
                            if($this->upload->do_upload('file')){
                                // Uploaded file data
                                $errors = $this->upload->display_errors();
                                $imageData = $this->upload->data();
                                 
                        if(!empty($imageData))
                        {
                            // Insert files data into the database
                           	$this->db->set([
                						'guide_id' => $this->session->userdata('glogin_id')['id'],
                						'images' => $uploadPath.$imageData['file_name'],
                						]);
                					$this->db->insert('guidepal_gallery_img');   
                        }
                            }    
                                
                            }
                        }
					
					notify( 'Your Profile Details has been successfully updated.', 'success', 10 );
					redirect('guide-profile');  
	          
	            }catch (\Exception $e){
					notify( $e->getMessage(), 'warning', 10 );
				} 
	           }else{
	              notify( strip_tags( validation_errors() ), 'warning', 10 );
	           }
              } 
        
          $page_data['page_name'] = 'guide_profile';
          $page_data['country'] = $this->Home_model->get_country();
          $page_data['profile'] = $this->db->get_where('guidepal_registration', ['id' => $this->session->userdata('glogin_id')['id']])->row_array();
          $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data); 
    }
    
    public function guide_change_pass(){
        
     if(!$this->session->userdata('glogin_id')) {
       redirect('home');
     } 
     
     if( $this->input->method() == 'post' ){
			$this->form_validation->set_rules('old_pass', 'Old Password', 'required');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required');
			$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'required|matches[new_pass]');
			
			if( $this->form_validation->run() ){
				$user = $this->db->get_where('guidepal_registration', ['id' => $this->session->userdata('glogin_id')['id']])->row_array();

				if( $user['password'] == md5($this->input->post('old_pass'))){
					$this->db->set('password', md5($this->input->post('new_pass')));
					$this->db->where('id', $this->session->userdata('glogin_id')['id']);
					$this->db->update('guidepal_registration');
					
					notify( 'Your Password has been successfully updated.', 'success', 3 );
					redirect('guide-change-password');
					die;
				} else {
					notify( 'Invalid Old Password.', 'warning', 5 );
				}
			} else {
				notify( strip_tags( validation_errors() ), 'warning', 5 );
			}
		}
		
     $page_data['page_name'] = 'guide_change_pass';
     $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);   
    }
    
    public function guide_image_del()
	{
	    if (!$this->session->userdata('glogin_id')) {
            redirect('home');
        }
	    $id=$this->input->post('id');
	    $this->db->set('status', '0');
		$this->db->where('id', $id);
		$this->db->delete('guidepal_gallery_img');
		return true;
	}
	
	public function membership(){
	    if (!$this->session->userdata('glogin_id') && !$this->session->userdata('flogin_id')) {
            redirect('home');
        }
	    if($this->session->userdata('glogin_id'))
        {
         $user_id=$this->session->userdata('glogin_id')['id'];
         $page_data['selected_package'] = $this->Home_model->get_selected_package($user_id);
         $page_data['guide_profile'] = $this->db->get_where('guidepal_registration', ['id' => $user_id])->row_array();

        }
        
        if($this->session->userdata('flogin_id'))
        {
         $user_id=$this->session->userdata('flogin_id')['id'];
         $page_data['friend_selected_package'] = $this->Home_model->get_selected_rent_friend($user_id);
         $page_data['rent_friend_profile'] = $this->db->get_where('rent_friend', ['id' => $user_id])->row_array();

        }
	    $page_data['page_name'] = "membership";
        //$page_data['package'] = $this->Home_model->get_package();
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
	}
    
    
    public function friend_profile(){
        
        if (!$this->session->userdata('flogin_id')) {
            redirect('home');
        }
	    
	    if($this->input->method() == 'post' ){
	        
	      $this->load->library('form_validation');
	      $this->form_validation->set_rules('name','Name','required');
	      $this->form_validation->set_rules('email','Email','required|valid_email');
	      $this->form_validation->set_rules('mobile_no','Mobile number','required');
	      
	    if($this->form_validation->run()){
	        
                    $this->db->set([
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
						'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						'about' => $this->input->post('about'),
					//	'aadhar_image' => $file['path'],
					//	'profile_pic' => $profile_pic['path'],
						//'status' => $this->input->post('status'),
					]);
	        
	       	    try { 
	        
	                 $file = $this->input->upload('image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
                    ] );
                    
                    if( isset($file) ){
						$this->db->set('aadhar_image', $file['path']);
					}
				
		            $profile_pic = $this->input->upload( 'profile_pic', './uploads/rent_a_friend_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
					] );
					
					if( isset($profile_pic) ){
						$this->db->set('photo', $profile_pic['path']);
					}		
						
					$this->db->where('id', $this->session->userdata('flogin_id')['id']);	
					$this->db->update('rent_friend');
					
				if($_FILES['image']['name'])
                {
                $this->load->library('upload');
                  $image = array();
                  $ImageCount = count($_FILES['image']['name']);
                        for($i = 0; $i < $ImageCount; $i++){
                            $_FILES['file']['name']       = $_FILES['image']['name'][$i];
                            $_FILES['file']['type']       = $_FILES['image']['type'][$i];
                            $_FILES['file']['tmp_name']   = $_FILES['image']['tmp_name'][$i];
                            $_FILES['file']['error']      = $_FILES['image']['error'][$i];
                            $_FILES['file']['size']       = $_FILES['image']['size'][$i];
                
                            // File upload configuration
                            $uploadPath = './uploads/rent_a_friend_image/galleryImage/';
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                
                            // Load and initialize upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                           
                            // Upload file to server
                            if($this->upload->do_upload('file')){
                                // Uploaded file data
                                $errors = $this->upload->display_errors();
                                $imageData = $this->upload->data();
                                 
                        if(!empty($imageData))
                        {
                            // Insert files data into the database
                           	$this->db->set([
                						'friend_id' => $this->session->userdata('flogin_id')['id'],
                						'images' => $uploadPath.$imageData['file_name'],
                						]);
                					$this->db->insert('friend_gallery_img');   
                        }
                            }    
                                
                            }
                        }
                        
					notify( 'Your Profile Details has been successfully updated.', 'success', 10 );
					redirect('friend-profile');  
	          
	            }catch (\Exception $e){
					notify( $e->getMessage(), 'warning', 10 );
				} 
	           }else{
	              notify( strip_tags( validation_errors() ), 'warning', 10 );
	           }
              } 
        
          $page_data['page_name'] = 'friend_profile';
          $page_data['country'] = $this->Home_model->get_country();
          $page_data['profile'] = $this->db->get_where('rent_friend', ['id' => $this->session->userdata('flogin_id')['id']])->row_array();
          $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data); 
    }
    
    public function friend_change_pass(){
        
     if(!$this->session->userdata('flogin_id')) {
       redirect('home');
     } 
     
     if( $this->input->method() == 'post' ){
			$this->form_validation->set_rules('old_pass', 'Old Password', 'required');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required');
			$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'required|matches[new_pass]');
			
			if( $this->form_validation->run() ){
				$user = $this->db->get_where('rent_friend', ['id' => $this->session->userdata('flogin_id')['id']])->row_array();

				if( $user['password'] == md5($this->input->post('old_pass'))){
					$this->db->set('password', md5($this->input->post('new_pass')));
					$this->db->where('id', $this->session->userdata('flogin_id')['id']);
					$this->db->update('rent_friend');
					
					notify( 'Your Password has been successfully updated.', 'success', 3 );
					redirect('friend-change-password');
					die;
				} else {
					notify( 'Invalid Old Password.', 'warning', 5 );
				}
			} else {
				notify( strip_tags( validation_errors() ), 'warning', 5 );
			}
		}
		
     $page_data['page_name'] = 'friend_change_pass';
     $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);   
    }
    
    public function friend_image_del()
	{
	    if (!$this->session->userdata('flogin_id')) {
            redirect('home');
        }
        
	    $id=$this->input->post('id');
	    $this->db->set('status', '0');
		$this->db->where('id', $id);
		$this->db->delete('friend_gallery_img');
		return true;
	}
	
    
    public function contact_us() {
	    $this->form_validation->set_rules('name','Name','required|alpha');
	    $this->form_validation->set_rules('email','Email','required|valid_email');
	    $this->form_validation->set_rules('tel','Mobile Number','required|regex_match[/^[0-9]{10}$/]');
	    $this->form_validation->set_rules('message','Message','required');
	    if($this->form_validation->run()==false){
	    $page_data['page_name'] = "contact_us";
        $page_data['page_title'] = site_phrase('contact_us');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);   
	    }
	    else{
	        $name = $this->input->post('name');
	        $email = $this->input->post('email');
	        $tel = $this->input->post('tel');
	        $message = $this->input->post('message');
	        
	        $data = array(
	            'name'=>$name,
	            'email'=>$email,
	            'phone'=>$tel,
	            'message'=>$message,
	            );
	       $res = $this->Home_model->insert_contact_us($data);   
	       if($res){
	           $this->session->set_flashdata('success','Inquiry Submited Successfully!!');
	           redirect('Home/contact_us');
	       }
	       else{
	          $this->session->set_flashdata('error','Inquiry Not Submited'); 
	           redirect('Home/contact_us');
	       }
	    }
       
    }
    
    public function get_city(){ 
       $postData = $this->input->post();
       $this->load->model('Home_model');
       $data = $this->Home_model->get_state($postData);
       echo json_encode($data); 
    }
	

   
  private function upload_helper($file, $target_dir, $isRequired = true, $allowedExt = [], $allowedSize = '*')
  {
	if(isset($_FILES[ $file ]) &&  $_FILES[ $file ]['error'] == 0) { $FILE_array = $_FILES[ $file ]; }
	elseif($isRequired == true){ throw new Exception('File was not uploaded to Server.'); }
	else{ return true; } // File is not required.

	if($FILE_array['name'] == ''){ throw new Exception('File name is not valid.'); }

	if($allowedSize != '*')
	{
		$allowedSize = $allowedSize * 1024;  /* In KB */
		if( filesize( $FILE_array['tmp_name'] ) > $allowedSize ) { throw new Exception('Uploaded File Size was Too Large'); }
	}
	
	$target_file_name = preg_replace('/[^A-Za-z0-9\.\-\_]/', '', basename( $FILE_array['name'] ) );

	$target_file_details = pathinfo( $target_file_name );
	$target_file_wo_ext = $target_file_details['filename'];
	$target_file_ext = strtolower( $target_file_details['extension'] );

	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	if(!$finfo){ throw new Exception('FINFO : Internal Error Occured.'); }
	$file_mime = finfo_file($finfo, $FILE_array['tmp_name']);
	finfo_close($finfo);
	
	$allowedExt = array_map('strtolower', $allowedExt);
	if( ! in_array($target_file_ext, $allowedExt) ){
		throw new Exception('File type is not supported.');
	}

	if( $file_mime == 'text/plain' && $target_file_ext != 'txt' ){
		$target_file_ext = 'txt';
	} else if ( $target_file_ext == '' ){
		$target_file_ext = 'file';
	}

	$i = 0;
	$target_path = $target_dir . '/' . $target_file_name;
	while( file_exists( $target_path ) ){
		$target_file_name = $target_file_wo_ext . ' ('.$i.').' . $target_file_ext;
		$target_path = $target_dir . '/' . $target_file_name;
		$i++;
	}

	if(!is_dir($target_dir)){
		if( ! mkdir($target_dir, 0777, true) ){
			throw new Exception('Upload Directory is not available.');
		}
	}
	
	if(!@move_uploaded_file($FILE_array['tmp_name'], $target_path))
		{ throw new Exception('File Could not be uploaded.'); }

	return array(
		'file_name' => $target_file_name,
		'file_ext' => $target_file_ext,
		'file_mime'=> $file_mime,
		'orig_name' => $FILE_array['name']
	);
   }

    
   public function rating(){ 
       $guide_id = $this->input->post('guide_id');
       $rating = $this->input->post('rating');
       $comment = $this->input->post('comment');
       $data = array(
              'user_id' =>  $this->session->userdata('ulogin_id')['id'],
              'guide_id' => $guide_id,
              'rating' => $rating,
              'comment' => $comment,
           );
        $create = $this->Home_model->create_rating($data);
        echo json_encode(array(
				"status"=>200
			));
        //echo json_encode($response); 
    }
    
    public function friendRating(){ 
       $friend_id = $this->input->post('friend_id');
       $rating = $this->input->post('rating');
       $comment = $this->input->post('comment');
       $data = array(
              'user_id' =>  $this->session->userdata('ulogin_id')['id'],
              'friend_id' => $friend_id,
              'rating' => $rating,
              'comment' => $comment,
           );
        $create = $this->Home_model->create_friend_rating($data);
        echo json_encode(array(
				"status"=>200
			));
        //echo json_encode($response); 
    }
    
    
    public function follow() {
        if (!$this->session->userdata('glogin_id') && !$this->session->userdata('flogin_id')) {
            redirect('home');
        }
        if($this->session->userdata('glogin_id'))
        {
         $guide_id=$this->session->userdata('glogin_id')['id'];    
         $page_data['guide_follow'] = $this->Home_model->get_guide_follow($guide_id);
        }
        
        if($this->session->userdata('flogin_id'))
        {
         $friend_id=$this->session->userdata('flogin_id')['id'];
         $page_data['rentfriend_follow'] = $this->Home_model->get_rentfriend_follow($friend_id);
        }
        
        $page_data['page_name'] = "follow";
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    
}
