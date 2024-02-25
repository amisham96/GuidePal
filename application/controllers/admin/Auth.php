<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
    
   /* public function index()
	{
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	    }
	    else{
	       redirect(base_url('login'), 'refresh'); 
	    }
		
	}*/
	
	public function login(){
	    if( $this->session->userdata('login_user') ){
	        redirect('/admin/Dashboard/');
	        die;
	    }
	    
	    if( $this->input->method() == 'post' ){
	        $this->form_validation->set_rules('email','Email','required');
	        $this->form_validation->set_rules('password','Password','required');
	        
	        if( $this->form_validation->run() )
	        {
	           
               
                 $user = $this->db->get_where('admin', [ 'email' => $this->input->post('email') ])->row_array();
            //     $result = $this->user_model->user_group($user['id']);
            //     $user['user_group'] = $result['group_name'];
                 //print_r($user['user_group']);die;
	            if( $user ){
	                    if( md5($this->input->post('password')) == $user['password'] ){
	                        $this->session->set_userdata('login_user', $user);
	                        notify( 'You are successfully logged in.', 'success', 3 );
	                        redirect('/admin/Dashboard/');
	                        die;
	                    } else {
	                        notify( 'Invalid Password.', 'warning', 3 );
	                    }
	                 
	            } else {
	                notify( 'You are not registered with us.', 'warning', 3 );
	            }   
                
             
	            
	            
	        } 
	        else 
	        {
	            notify( strip_tags( validation_errors() ), 'warning', 3 );
	        }
	    }
	    
        $page_data['page_title']='Login';
        $this->load->view('default/admin/auth-login',$page_data);
	}
	
	public function logout(){
	    $this->session->unset_userdata('login_user');
	    notify( 'Successfully Logged Out.', 'success', 3 );
	    redirect('/admin/Auth/login/');
        die;
	}
	
	public function forgot_password(){
	    if( $this->session->userdata('login_user') ){
	        redirect('/admin/Dashboard/');
	        die;
	    }
	    
	    if( $this->input->method() == 'post' ){
	        $this->form_validation->set_rules('email','Email','required');
	        
	        if( $this->form_validation->run() ){
	            $user = $this->db->get_where('admin', [ 'email' => $this->input->post('email') ])->row_array();
	            
	            if( $user ){
	                if( $user['status'] == 1){
	                    $token = md5( time() . '-' . str_pad(rand(0,999999),6,'0') . '-' . str_pad(rand(0,999999),6,'0') . '-' . str_pad(rand(0,999999),6,'0') );
	                    
	                    $this->db->where('id', $user['id']);
	                    $this->db->set('pw_reset_token', $token);
	                    $this->db->update('admin');
	                    
	                    $this->load->library('Mailer');
	                    
	                    $this->mailer->addAddress($user['email']);
	                    $this->mailer->Subject = 'Reset Password';
	                    $this->mailer->Body = 'Dear User, Your password reset link is : ' . base_url('/admin/Auth/reset_password/' . $token);
	                    $this->mailer->Send();
	                    
	                    notify( 'Password Reset Link has been sent to your email address.', 'success', 3 );
	                } else {
	                    notify( 'Your account is not in Active state.', 'warning', 3 );
	                }
	            } else {
	                notify( 'You are not registered with us.', 'warning', 3 );
	            }
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 3 );
	        }
	    }
	    
	    $page_data['page_title']='Forgot Password?';
        $this->load->view('default/admin/auth-forget',$page_data);
	}
	
	public function reset_password($token){
	    if( $this->session->userdata('login_user') ){
	        redirect('/admin/Dashboard/');
	        die;
	    }
	    
	    $user = $this->db->get_where('admin',['pw_reset_token' => $token])->row_array();
	    
	    if( ! $user ){
	        notify( 'Invalid Password Reset Link.', 'warning', 3 );
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    
	    if( $this->input->method() == 'post' ){
	        $this->form_validation->set_rules('new_pass', 'New Password', 'required');
	        $this->form_validation->set_rules('confirm_pass','Confirm Password', 'required|matches[new_pass]');
	        
	        if( $this->form_validation->run() ){
	            $this->db->set('password', md5($this->input->post('new_pass')));
	            $this->db->set('pw_reset_token', NULL);
	            $this->db->where('id', $user['id']);
	            $this->db->update('users');
	            
	            notify( 'Password has been successfully updated.', 'success', 3 );
	            redirect('/admin/Auth/login/');
	            die;
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 3 );
	        }
	    }
	    
	    $page_data['page_title']='Reset Password';
        $this->load->view('default/admin/auth-reset',$page_data);
	}
}
