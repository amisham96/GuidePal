<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Calcutta"); 
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
       
        // CHECK CUSTOM SESSION DATA
       // $this->session_data();
		$this->load->model('Login_model');
		$this->load->library("pagination");
		
		require_once APPPATH.'third_party/src/Google_Client.php';
	    require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
    }
    
    
    
    public function login(){
        
        if ($this->session->userdata('glogin_id') || $this->session->userdata('flogin_id')) {
            redirect('buy');
        }
        
      if( $this->input->method() == 'post' ){
          
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('usertype','User Type','required');
        
        if( $this->form_validation->run()){
         
         if($this->input->post('usertype') == "guidepal"){  
            
         $guide_info = $this->db->get_where('guidepal_registration', [ 'email' => $this->input->post('email') ])->row_array();   
           
         if($guide_info){
             
            if($guide_info['status'] == 1){
                
               if( md5( $this->input->post('password') ) == $guide_info['password'] ){
	               $this->session->set_userdata('glogin_id', $guide_info);
	               notify( 'You are successfully logged in.', 'success', 10 );
	               
					$this->db->set('online_status', 'active');
					$this->db->where('id', $guide_info['id']);	
					$this->db->update('guidepal_registration');
					
	               redirect('buy');
	               die;
	           } else {
	               notify( 'Invalid Password.', 'warning', 3 );
	           } 
            }else {
	              notify( 'Your account is not approved wait for some time.', 'warning', 5 );
	        } 
         }else {
	             notify( 'You are not login with us.', 'warning', 5 );
	      } 
        }elseif($this->input->post('usertype') == "rent_a_friend"){
            
           $friend_info = $this->db->get_where('rent_friend', [ 'email' => $this->input->post('email') ])->row_array();   
           
           //print_r($friend_info);die;
         if($friend_info){
             
            if($friend_info['status'] == 1){
                
               if( md5( $this->input->post('password') ) == $friend_info['password'] ){
	               $this->session->set_userdata('flogin_id', $friend_info);
	               notify( 'You are successfully logged in.', 'success', 10 );
	               $this->db->set('online_status', 'active');
					$this->db->where('id', $friend_info['id']);	
					$this->db->update('rent_friend');
	               redirect('buy');
	               die;
	           } else {
	               notify( 'Invalid Password.', 'warning', 3 );
	           } 
            }else {
	              notify( 'Your account is not approved wait for some time.', 'warning', 5 );
	        } 
         }else {
	             notify( 'You are not login with us.', 'warning', 5 );
	      } 
        }
        
        }
        else 
	     {
	       notify( strip_tags( validation_errors() ), 'warning', 5 );
	     }
      }
        $page_data['page_title'] = 'Login';
        $this->load->view('frontend/default/login',$page_data);
    }

    public function register() {
        
        if ($this->session->userdata('login_id')) {
            redirect('home');
        }
        
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('gender','Gender','required');
	    $this->form_validation->set_rules('email','Email','required|valid_email');
	    $this->form_validation->set_rules('password','Password','required');
	    $this->form_validation->set_rules('country','Country','required');
	    $this->form_validation->set_rules('state','state','required');
	    $this->form_validation->set_rules('city','City','required');
	    $this->form_validation->set_rules('usertype','User Type','required');
	    $this->form_validation->set_rules('mobile_no','Mobile Number','required');
	    $this->form_validation->set_rules('aadhar_num','Aadhar number','required');
	    $this->form_validation->set_rules('age','Age','required');
	    
	    if($this->input->post('usertype') == "guidepal"){
	       $this->form_validation->set_rules('mobile_no','Mobile Number','required|regex_match[/^[0-9]{10}$/]|is_unique[guidepal_registration.phone]'); 
	    }elseif($this->input->post('usertype') == "rent_a_friend"){
	       $this->form_validation->set_rules('mobile_no','Mobile Number','required|regex_match[/^[0-9]{10}$/]|is_unique[rent_friend.phone]');  
	    }
	    
	    if($this->form_validation->run()==false){
	        
	       $page_data['page_title'] = 'register';
           $page_data['country'] = $this->Login_model->get_country();
           $this->load->view('frontend/default/register', $page_data);   
           
	    }else{
	        
	      if($this->input->post('usertype') == "guidepal"){
	          
	        $file = $this->input->upload('image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
						'required' => true
					] );
					
			$guidepal_photo = $this->input->upload('photo', './uploads/guidepal_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
						'required' => true
					] );		
					
	        
	        $data = array(
	            'name'=>$this->input->post('name'),
	            'gender'=>$this->input->post('gender'),
	            'email'=>$this->input->post('email'),
	            'phone'=>$this->input->post('mobile_no'),
	            'password'=>md5($this->input->post('password')),
	            'country'=>$this->input->post('country'),
	            'state'=>$this->input->post('state'),
	            'city'=>$this->input->post('city'),
	            'photo' => $guidepal_photo['path'],
	            'aadhar_num' => $this->input->post('aadhar_num'),
	            'aadhar_image' => $file['path'],
	            'age'=>$this->input->post('age'),
	       ); 
	       
	        $this->db->set($data);
	        $this->db->insert('guidepal_registration');
	        notify( 'Guidepal Register has been successfully', 'success', 5 );
	        redirect('register');
	       
	       }elseif($this->input->post('usertype') == "rent_a_friend"){
	          
	          $file = $this->input->upload('image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
						'required' => true
					] );
					
			  $friend_photo = $this->input->upload('photo', './uploads/rent_a_friend_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
						'required' => true
					] );		
					
	          $data1 = array(
	            'name'=>$this->input->post('name'),
	            'gender'=>$this->input->post('gender'),
	            'email'=>$this->input->post('email'),
	            'phone'=>$this->input->post('mobile_no'),
	            'password'=>md5($this->input->post('password')),
	            'country'=>$this->input->post('country'),
	            'state'=>$this->input->post('state'),
	            'city'=>$this->input->post('city'),
	            'photo' => $friend_photo['path'], 
	            'aadhar_num' => $this->input->post('aadhar_num'),
	            'aadhar_image' => $file['path'],
	            'age'=>$this->input->post('age'),
	       ); 
	       
	        $this->db->set($data1);
	        $this->db->insert('rent_friend');
	        notify('Rent as a friend Register has been successfully.', 'success', 5 );
	        redirect('register');
	       }
	    
	    }
    }
    
    public function glogout() {
        $this->load->library('session');
        $user=$this->session->userdata('glogin_id');
        $date = date('Y-m-d H:i:s');
        $this->db->set('online_status', 'offline');
        $this->db->set('last_logout', $date);
		$this->db->where('id', $user['id']);	
		$this->db->update('guidepal_registration');
        $this->session->unset_userdata('glogin_id');
        redirect('login');
    }
    
    public function flogout() {
        $this->load->library('session');
        $user=$this->session->userdata('flogin_id');
        $date = date('Y-m-d H:i:s');
        $this->db->set('online_status', 'offline');
        $this->db->set('last_logout', $date);
		$this->db->where('id', $user['id']);	
		$this->db->update('rent_friend');
        $this->session->unset_userdata('flogin_id');
        redirect('login');
    }
    
    public function ulogin() {
        
        if ($this->session->userdata('ulogin_id')) {
            redirect('home');
        }
        
        $this->form_validation->set_rules('mobile_no','Mobile number','required');
        
        if($this->form_validation->run()==false){
            
           $page_data['page_title'] = 'ulogin';
           $this->load->view('frontend/default/ulogin', $page_data);     
        }else{
          
         $mobile = $this->input->post('mobile_no');
         
         $user = $this->Login_model->check_users($mobile);

         if($user){
            
            $data = [
				'otp'	=> 6666,
			];

			// update otp in database
			$this->Login_model->update_otp($mobile, $data);
			redirect('verify');
         }else {
			$data1 = [
			    'phone' => $this->input->post('mobile_no'),
				'otp'	=> 6666,
			];
			
			$this->db->set($data1);
			$this->db->insert('users');
			redirect('verify');
		 }
            
        }
    }
    
    public function verify() {
        
        if ($this->session->userdata('ulogin_id')) {
            redirect('home');
        }    
       
       $this->form_validation->set_rules('otp1','otp number','required');
       $this->form_validation->set_rules('otp2','otp number','required');
       $this->form_validation->set_rules('otp3','otp number','required');
       $this->form_validation->set_rules('otp4','otp number','required');
       
       if($this->form_validation->run()==false){
	        
	       $page_data['page_title'] = 'verify';
           $this->load->view('frontend/default/verify', $page_data);   
	    }else{
	      $otp1 = $this->input->post('otp1');
	      $otp2 = $this->input->post('otp2');
	      $otp3 = $this->input->post('otp3');
	      $otp4 = $this->input->post('otp4');
	      
	      $otp = $otp1 . $otp2 . $otp3 . $otp4;

		// check for otp 
		$user = $this->Login_model->verify($otp);
		//print_r($user);die;
		if($user) {
			$this->session->set_userdata('ulogin_id',$user);
			$this->db->set([
						'otp' => '',
						'online_status' => 'active'
					]);
			$this->db->update('users');	
			notify('you are successfully login.', 'success', 5 );
			redirect('find');
		} else {
			//echo "Invalid OTP.";
			notify( 'Invalid OTP.', 'warning', 5 );
			redirect('verify');
			
		}  
	    }
       
	}
	
	public function ulogout() {
        $this->load->library('session');
        $user=$this->session->userdata('ulogin_id');
        $date = date('Y-m-d H:i:s');
        $this->db->set('online_status', 'offline');
        $this->db->set('last_logout', $date);
		$this->db->where('id', $user['id']);	
		$this->db->update('guidepal_registration');
		
        $this->session->unset_userdata('ulogin_id');
        $this->session->unset_userdata('google_login');
        redirect('user-login');
    }
    
    
    public function connect() {
        $page_data['page_title'] = 'letsconnect';
        $this->load->view('frontend/default/letsconnect', $page_data);
    }
    
    
    public function google_login()
    { 
       	$clientId = '990468118259-uklqtsiobjofsr7gj8mbsf8khvmt1uks.apps.googleusercontent.com'; //Google client ID
		$clientSecret = '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'; //Google client secret
		$redirectURL = base_url() .'login/google_login';
		
		$gClient = new Google_Client();
		$gClient->setApplicationName('guidepal');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		if(isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) 
		{
			$gClient->setAccessToken($_SESSION['token']);
		}
		if ($gClient->getAccessToken()) {
		    //print_r($gClient);
            $userProfile = $google_oauthV2->userinfo->get();
            
			
			
			$url = $gClient->createAuthUrl();
			
            $user = $this->db->get_where('users', ['email' => $userProfile['email']])->row_array();
            
            if($user)
            {
                $this->db->set([
					'gmailid' => $userProfile['id'],
				//	'loginby' => 'gmail',
                //    'last_modified' => time(),
                ]);
                $this->db->where('id', $user['id']);
                $this->db->update('users');
            }
            else
            {
                $this->db->set([
					'name' => $userProfile['given_name'],
				//	'last_name' => $userProfile['family_name'],
					'email' => $userProfile['email'],
				//	'phone' => '',
					'profile_pic' => $userProfile['picture'],
					'gmailid' => $userProfile['id'],
				//	'loginby' => 'gmail',
                //    'last_modified' => time(),
                //    'role_id' => 3,
                //    'date_added' => time(),
                //    'verification_code' => NULL,
                    'status' => 1,
                ]);
                $this->db->insert('users');
                $user = $this->db->get_where('users', ['email' => $userProfile['email']])->row_array();

            }
            $this->session->set_userdata('ulogin_id',$user);
            $this->session->set_userdata('google_login',$userProfile);
            //    $this->session->set_userdata('role','user');
                notify('you are successfully login.', 'success', 5 );
			
                $user_id=$this->session->userdata('ulogin_id')['id'];
                if($this->session->userdata('ulogin_id'))
                {
                  redirect('find');
                }
                else
                {
			      redirect('/');
                }
        } 
		else 
		{
            $url = $gClient->createAuthUrl();
            notify('Something Wrong! Try Again..', 'error');
		    //redirect('login');
            die;
        }
	}
    
  
    
}
