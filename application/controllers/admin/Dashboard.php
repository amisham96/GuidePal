<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        //$this->load->database();
		
		$this->db->query('SET sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""));');
		
        $this->load->model('Dashboard_modal');
        if (function_exists('date_default_timezone_set'))
		{
		  date_default_timezone_set('Asia/Kolkata');
		}
        // CHECK CUSTOM SESSION DATA
    
		//$this->load->model('Home_model');
		//$this->load->library("pagination");
		$this->load->helper('common_helper');
		//$this->load->library('notifier');
    }

	public function index()
	{
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
        $page_data['page_title']='Dashboard';
        $page_data['total_guidepal_register'] = $this->Dashboard_modal->total_guidepal_register();
        $page_data['total_user_register'] = $this->Dashboard_modal->total_user_register();
        $page_data['total_rent_friend_register'] = $this->Dashboard_modal->total_rent_friend_register();
        $this->load->view('default/admin/index',$page_data);
	}

	
	public function pager($total_result, $current_page, $per_page = 15, $payload = array())
	{
		$total_page = ceil( $total_result / $per_page );
		$links_limit = 7; $html = '';

		if( $total_page <= 1 ){ return $html; }

		$temp_GET = array_merge($_GET, $payload);
		$html .= '<ul class="pagination">';

		$side = ($links_limit - 1) / 2;
		$start = $current_page - $side; $end = $current_page + $side;

		if($start < 1)
		{
			$end = $end - $start + 1;
			$start = 1;
		}

		if($end > $total_page)
		{
			$start = $total_page - (2 * $side);
			$end = $total_page;
		}

		if($start < 1){ $start = 1; }

		if($current_page > 1)
		{
			$temp_GET['page'] = $current_page - 1;
			$html .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($temp_GET).'">Previous</a></li>';
		}

		for($i = $start; $i <= $end; $i++)
		{
			$temp_GET['page'] = $i;
			if( $current_page == $i ){
				$html .= '<li class="page-item active"><a class="page-link" href="javascript:void(0)">'.$i.'</a></li>';
			} else {
				$html .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($temp_GET).'">'.$i.'</a></li>';
			}
		}

		if($current_page < $total_page)
		{
			$temp_GET['page'] = $current_page + 1;
			$html .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($temp_GET).'">Next</a></li>';
		}

		$html .= '</ul>';

		return $html;
	}
	
	protected function slugify($text, string $divider = '-'){
		$text = preg_replace('~[^\pL\d]+~u', $divider, $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, $divider);
		$text = preg_replace('~-+~', $divider, $text);
		$text = strtolower($text);

		if( $text == '' ){
			return (time() . $divider . str_pad( rand(0,999999), 6, '0', STR_PAD_LEFT ));
		}
		return $text;
	}

	protected function slugify_db($table, $column, $text, $divider = '-'){
		$db = clone get_instance()->db;
		$db->reset_query();
		
		$i = 0; 
		$slug = $this->slugify($text);
		$temp_slug = $slug;
		
		while( true ){
			$count = $db->get_where($table, [$column => $temp_slug])->num_rows();
			if( $count > 0 ){
				$i++;
				$temp_slug = $slug . $divider . $i;
			} else {
				break;
			}
		}
		
		return $temp_slug;
	}

	
	public function change_pass(){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		if( $this->input->method() == 'post' ){
			$this->form_validation->set_rules('old_pass', 'Old Password', 'required');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required');
			$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'required|matches[new_pass]');
			
			if( $this->form_validation->run() ){
				$user = $this->db->get_where('admin', ['id' => $this->session->userdata('login_user')['id']])->row_array();

				if( $user['password'] == md5($this->input->post('old_pass'))){
					$this->db->set('password', md5($this->input->post('new_pass')));
					$this->db->where('id', $this->session->userdata('login_user')['id']);
					$this->db->update('admin');
					
					notify( 'Your Password has been successfully updated.', 'success', 3 );
					redirect('/admin/Dashboard/change_pass/');
					die;
				} else {
					notify( 'Invalid Old Password.', 'warning', 3 );
				}
			} else {
				notify( strip_tags( validation_errors() ), 'warning', 3 );
			}
		}
		
		$page_data['page_title'] = 'Change Password';
		$this->load->view('default/admin/change_password',$page_data);
	}
	
	public function profile(){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		if( $this->input->method() == 'post' ){
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required');
			$this->form_validation->set_rules('phone_num', 'Phone Number', 'required');
			
			if( $this->form_validation->run() ){
				$this->db->set([
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'phone_num' => $this->input->post('phone_num')
				]);
				
				try {
					$file = $this->input->upload( 'profile_pic', './uploads/profilepic/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
					] );
					
					if( isset($file) ){
						$this->db->set('profile_pic', $file['path']);
					}
					
					$this->db->where('id', $this->session->userdata('login_user')['id']);
					$this->db->update('admin');
					
					notify( 'Your Profile Details has been successfully updated.', 'success', 3 );
					redirect('/admin/Dashboard/profile/');
				} catch (\Exception $e){
					notify( $e->getMessage(), 'warning', 3 );
				}
			} else {
				notify( strip_tags( validation_errors() ), 'warning', 3 );
			}
		}
		
		$page_data['profile_data'] = $this->db->get_where('admin', ['id' => $this->session->userdata('login_user')['id']])->row_array();
		$page_data['page_title'] = 'Update Profile';
		$this->load->view('default/admin/update_profile',$page_data);
	}
	
	
	
	public function system_setting(){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		if( $this->input->method() == 'post' ){
			$this->form_validation->set_rules('site_title', 'Site Title', 'required');
			$this->form_validation->set_rules('site_tagline', 'Site Tagline', 'required');
			$this->form_validation->set_rules('company_email', 'Company Email', 'required');
			$this->form_validation->set_rules('company_phone', 'Company Phone', 'required');
			$this->form_validation->set_rules('company_address', 'Company Address', 'required');
			
			if( $this->form_validation->run() ){
				try {
					$file = $this->input->upload( 'company_logo', './uploads/settings/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
					] );
					
				    if( isset($file) ){
						$this->db->set('company_logo', $file['path']);
					}
					
					$favicon = $this->input->upload( 'favicon', './uploads/settings/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
					] );
					
					if( isset($favicon) ){
						$this->db->set('favicon', $favicon['path']);
					}
					
					$this->db->set([
					  'site_title' => $this->input->post('site_title'),
					  'site_tagline	' => $this->input->post('site_tagline'),
					  'company_email' => $this->input->post('company_email'),
					  'company_phone' => $this->input->post('company_phone'),
					  'company_address' => $this->input->post('company_address'),
					  'copyright_text' => $this->input->post('copyright_text'),
					  'home_page_keywords' => $this->input->post('home_page_keywords'),
					  'home_page_meta_title' => $this->input->post('home_page_meta_title'),
					  'home_page_meta_descr' => $this->input->post('home_page_meta_descr'),
					  'keyId' => $this->input->post('keyId'),
					  'keySecret' => $this->input->post('keySecret'),
				    ]);
				    
				    $this->db->where('id', $this->session->userdata('login_user')['id']);
					$this->db->update('system_settings');
					
					notify( 'System Setting Details has been successfully updated.', 'success', 3 );
					redirect('/admin/Dashboard/system_setting/');
				} catch (\Exception $e){
					notify( $e->getMessage(), 'warning', 3 );
				}
			} else {
				notify( strip_tags( validation_errors() ), 'warning', 3 );
			}
		}
		
		$page_data['system_settings'] = $this->db->get_where('system_settings', ['id' => $this->session->userdata('login_user')['id']])->row_array();
		$page_data['page_title'] = 'Web Configuration';
		$this->load->view('default/admin/web_config',$page_data);
	}
	
	
	public function mail_config(){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		if( $this->input->method() == 'post' ){
			$this->form_validation->set_rules('mailer_method', 'Mailer Method', 'required');
			
			if( $this->form_validation->run() ){
				foreach($this->input->post() as $key => $value){
					$this->db->set('key_value', $value);
					$this->db->where('key_name', $key);
					$this->db->update('settings');
				}
				
				notify( 'Mail Config Details has been successfully updated.', 'success', 3 );
				redirect('/admin/Dashboard/mail_config/');
			} else {
				notify( strip_tags( validation_errors() ), 'warning', 3 );
			}
		}
		
		$page_data['profile'] = [];
		$temp = $this->db->get('settings')->result_array();
		foreach($temp as $temp_single){
			$page_data['profile'][ $temp_single['key_name'] ] = $temp_single['key_value'];
		}
		
		$page_data['page_title'] = 'Mail Config';
		$this->load->view('default/admin/mail_config',$page_data);
	}
	
	public function social_config(){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		if( $this->input->method() == 'post' ){
			$this->db->where('1=1');
			$this->db->delete('social_config');
			
			foreach($this->input->post('socials') as $social){
				$this->db->set($social);
				$this->db->insert('social_config');
			}			
			
			notify( 'Mail Config Details has been successfully updated.', 'success', 3 );
			redirect('/admin/Dashboard/social_config/');
		}
		
		$page_data['rows'] = $this->db->get('social_config')->result_array();
		
		$page_data['page_title'] = 'Social Config';
		$this->load->view('default/admin/social_config',$page_data);
	}
	
	public function sliders(){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		$page = 1;
		if( $this->input->get('page') ){
			$page = $this->input->get('page');
		}
		
		$limit = 30;
		if( $this->input->get('limit') ){
			$limit = $this->input->get('limit');
		}
		
		$this->db->limit($limit, ($page - 1) * $limit);
		$page_data['sliders'] = $this->db->get('sliders')->result_array();
		
		$page_data['pager'] = $this->pager($this->db->get('sliders')->num_rows(), $page, $limit);
		
		$page_data['page_title'] = 'Slider';
		$this->load->view('default/admin/slider',$page_data);
	}
	
	
	public function add_slider(){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		if( $this->input->method() == 'post' ){
		    
					$file = $this->input->upload( 'image', './uploads/sliders/', [
						'allowed' => ['image/jpeg','image/png','image/gif'],
						'required' => true
					] );
					
					$this->db->set([
						'title' => $this->input->post('title'),
						'tagline' => $this->input->post('tagline'),
						'image' => $file['path']
					]);
					
					$this->db->insert('sliders');
					
					notify( 'Slider has been successfully added.', 'success', 3 );
					redirect('/admin/Dashboard/sliders/');
				
			} 

		$page_data['page_title'] = 'Add slider';
		$this->load->view('default/admin/add_slider',$page_data);
	}
	
	public function slider_status($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $id);
		$this->db->update('sliders');
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	public function edit_slider($id){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		if( $this->input->method() == 'post' ){
			
					$file = $this->input->upload( 'image', './uploads/sliders/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($file) ){
						$this->db->set('image', $file['path']);
					}
					
					$this->db->set([
						'title' => $this->input->post('title'),
						'tagline' => $this->input->post('tagline'),
					]);
					$this->db->where('id', $id);
					$this->db->update('sliders');
					
					notify( 'Slider has been successfully updated.', 'success', 3 );
					redirect('/admin/Dashboard/sliders/');
				
			} 

		$slider = $this->db->get_where('sliders', ['id' => $id])->row_array();
		
		if( ! $slider ){
			redirect('/admin/Dashboard/sliders/');
		}
		
		$page_data['slider'] = $slider;
		
		$page_data['page_title'] = 'Edit slider';
		$this->load->view('default/admin/edit_slider',$page_data);
	}
	
	public function delete_slider($id){
		if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		
		$this->db->where('id', $id);
		$this->db->delete('sliders');
		
		redirect('/admin/Dashboard/sliders/');
	}
	
	

 	public function guidepal_register()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $page_data['page_title'] = 'Guidepal Registration';
		$this->load->view('default/admin/guidepal_register',$page_data);
	}
	
	
	public function guidepal_register_datatable()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $this->load->library('datatable');
		$this->db->order_by("id", "desc");
		$query = $this->db->from('guidepal_registration');
		
		/*$this->datatable->set_column('status', function($row, $db){
			return '<div class="form-check form-switch mb-3" dir="ltr">
				<label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['status'] == '1' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/guidepal_register_status/'.$row['id']).'?status=\'+(this.checked ? \'1\' : \'0\'))"></label>
			</div>';
		});*/
		
		$this->datatable->set_column('status', function($row, $db){
			return '<select class="form-select" onchange="update_guide_status('.$row['id'].', this.value)">
			 <option value="1" '.($row['status'] == '1' ? 'selected' : '').'>Approved</option>
			 <option value="0" '.($row['status'] == '0' ? 'selected' : '').'>Pending</option>
			</select>';
		});
		
		$this->datatable->set_column('photo', function($row, $db){
			if(!$row['photo']){
			    return '-';
			}
			return '<img style="object-fit:cover;" src="'.base_url($row['photo']).'" width="50" height="50">';
		});
		
		$this->datatable->set_column('aadhar_image', function($row, $db){
			if(!$row['aadhar_image']){
			    return '-';
			}
			return '<img style="object-fit:cover;" src="'.base_url($row['aadhar_image']).'" width="50" height="50">';
		});
		
		$this->datatable->set_column('action', function($row, $db){
			return '<div class="dropdown">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
				<div class="dropdown-menu">
				    <a class="dropdown-item" href="'.base_url('/admin/Dashboard/view_guidepal_register/'.$row['id']).'">view</a>
					<a class="dropdown-item" href="'.base_url('/admin/Dashboard/edit_guidepal_register/'.$row['id']).'">Edit</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="confirm_redirect(\''.base_url('/admin/Dashboard/delete_guidepal_register/'.$row['id']).'\')">Delete</a>
				</div>
			</div>';
		}, 'id');
		
		$this->datatable->raw_columns(['status','aadhar_image','photo','action']);
		echo $this->datatable->run($query);
	}
	
	
	public function add_guidepal_register(){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('name','Name','required');
	        $this->form_validation->set_rules('email','Email','required|valid_email');
	        $this->form_validation->set_rules('mobile_no','Mobile number','required');
	        $this->form_validation->set_rules('password','Password','required');
	        
	        if( $this->form_validation->run() ){
	            try {
					$file = $this->input->upload('aadhar_mage', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($file) ){
					    $this->db->set('aadhar_image', $file['path']);
					}
					
					$photo = $this->input->upload('photo', './uploads/guidepal_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($photo) ){
					    $this->db->set('photo', $photo['path']);
					}
					
					
					$this->db->set([
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
						'password' => md5($this->input->post('password')),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
						'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						'about' => $this->input->post('about'),
						'age' => $this->input->post('age'),
						'gender' => $this->input->post('gender'),
						//'status' => $this->input->post('status'),
						]);
					$this->db->insert('guidepal_registration');
					$guide_id = $this->db->insert_id();
					
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
                						'guide_id' => $guide_id,
                						'images' => $uploadPath.$imageData['file_name'],
                						]);
                					$this->db->insert('guidepal_gallery_img');   
                        }
                            }    
                                
                            }
                        }
					
					notify( 'Guidepal Registration has been successfully added.', 'success', 15 );
					redirect('/admin/Dashboard/guidepal_register/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['page_title'] = 'Add Guidepal Registration';
	    $page_data['country'] = $this->Dashboard_modal->get_country();
		$this->load->view('default/admin/add_guidepal_register',$page_data);
	}

	public function edit_guidepal_register($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('name','Name','required');
	        $this->form_validation->set_rules('email','Email','required|valid_email');
	        $this->form_validation->set_rules('mobile_no','Mobile number','required');
	        //$this->form_validation->set_rules('password','Password','required');
	        
	        if( $this->form_validation->run() ){
	            try {
				    
				    $file = $this->input->upload('aadhar_mage', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($file) ){
					    $this->db->set('aadhar_image', $file['path']);
					}
					
					$photo = $this->input->upload('photo', './uploads/guidepal_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($photo) ){
					    $this->db->set('photo', $photo['path']);
					}
					
					$this->db->set([
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
					//	'password' => md5($this->input->post('password')),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
						'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						'about' => $this->input->post('about'),
						'age' => $this->input->post('age'),
						'gender' => $this->input->post('gender'),
					]);
					$this->db->where('id',$id);
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
                						'guide_id' => $id,
                						'images' => $uploadPath.$imageData['file_name'],
                						]);
                					$this->db->insert('guidepal_gallery_img');   
                        }
                            }    
                                
                            }
                        }
					
					notify('Guidepal Registration has been successfully updated.', 'success', 15 );
					redirect('/admin/Dashboard/guidepal_register/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['edit_guidepal_register'] = $this->db->get_where('guidepal_registration',['id' => $id])->row_array();
	    $page_data['country'] = $this->Dashboard_modal->get_country();
	    $page_data['page_title'] = 'Edit Guidepal Registration';
		$this->load->view('default/admin/edit_guidepal_register',$page_data);
	}
	
	public function view_guidepal_register($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	
	    $page_data['view_guidepal_register'] = $this->db->get_where('guidepal_registration',['id' => $id])->row_array();
	    $page_data['page_title'] = 'View Guidepal Registration';
	    $page_data['country'] = $this->Dashboard_modal->get_country();
	    $page_data['guide_images'] = $this->Dashboard_modal->guide_images($id);
		$this->load->view('default/admin/view_guidepal_register',$page_data);
	}
	
	
	public function delete_guidepal_register($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    
	    $this->db->where('id', $id);
	    $this->db->delete('guidepal_registration');
	    
	    redirect('/admin/Dashboard/guidepal_register/');
	}
	
	
	public function guidepal_register_status($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $id);
		$this->db->update('guidepal_registration');
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	public function update_guide_status(){
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $this->input->get('id'));
		$this->db->update('guidepal_registration');
		
		if($this->input->get('status') == 1){
		    
		  $guidedetail = $this->db->get_where('guidepal_registration', ['id' => $this->input->get('id')])->row_array();
          $guide_email = $guidedetail['email']; 
          
          $config = Array(
               'protocol' => 'smtp',
               'smtp_host' => 'ssl://mail.webdealsoft.com',
               'smtp_port' => '465',
               'smtp_user' => 'noreply@webdealsoft.com',
               'smtp_pass' => 'd+6S}~I7i2Kj',
               'charset'   => 'utf-8'
                );
              $this->load->library('email',$config);
              $this->email->set_newline("\r\n");
              $this->email->set_mailtype("html");
              $this->email->from('noreply@webdealsoft.com', 'Guidepal');
              $this->email->to($guide_email);

              $this->email->subject('Request for your account approved');
              //$body = $this->load->view('email/quotationemail',$data,TRUE);
              $message = $this->email->message("your account is approved you can login now");
              $result = $this->email->send();
              //echo $this->email->print_debugger();
              /*if($result == true){
                echo json_encode(['status' => 1, 'message' => 'Email Send successfully.']);
                //redirect('admin/Dashboard/guidepal_register');  
              }else{
                notify( strip_tags( validation_errors() ), 'warning', 3 );  
              }*/
		}
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	public function guidepal_register_json($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$student = $this->db->get_where('guidepal_register',['id' => $id])->row_array();
		echo json_encode(['status' => 1, 'data' => $student]);
	}
	
	public function guide_image_del()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
        
	    $id=$this->input->post('id');
	    $this->db->set('status', '0');
		$this->db->where('id', $id);
		$this->db->delete('guidepal_gallery_img');
		return true;
	}
	
	public function get_city(){ 
       $postData = $this->input->post();
       $this->load->model('Dashboard_modal');
       $data = $this->Dashboard_modal->get_state($postData);
       echo json_encode($data); 
    }
    
    
    public function user_register()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $page_data['page_title'] = 'User Registration';
		$this->load->view('default/admin/user_register',$page_data);
	}
	
	
	public function user_register_datatable()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $this->load->library('datatable');
		
		$query = $this->db->from('users');
			$this->datatable->set_column('name', function($row, $db){
			return $row['name'];
		});
		
		$this->datatable->set_column('status', function($row, $db){
			return '<div class="form-check form-switch mb-3" dir="ltr">
				<label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['status'] == '1' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/user_register_status/'.$row['id']).'?status=\'+(this.checked ? \'1\' : \'0\'))"></label>
			</div>';
		});
		
		$this->datatable->set_column('dob', function($row, $db){
		    if($row['dob'] == ""){ return '-'; }
			return date("d/m/Y",strtotime($row['dob']));
		}, 'dob');
		
		/*$this->datatable->set_column('aadhar_image', function($row, $db){
			if(!$row['aadhar_image']){
			    return '-';
			}
			return '<img style="object-fit:cover;" src="'.base_url($row['aadhar_image']).'" width="50" height="50">';
		});*/
		
		$this->datatable->set_column('action', function($row, $db){
			return '<div class="dropdown">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
				<div class="dropdown-menu">
				    <a class="dropdown-item" href="'.base_url('/admin/Dashboard/view_user_register/'.$row['id']).'">view</a>
					<a class="dropdown-item" href="'.base_url('/admin/Dashboard/edit_user_register/'.$row['id']).'">Edit</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="confirm_redirect(\''.base_url('/admin/Dashboard/delete_user_register/'.$row['id']).'\')">Delete</a>
				</div>
			</div>';
		}, 'id');
		
		$this->datatable->raw_columns(['name','dob','aadhar_image','status','action']);
		echo $this->datatable->run($query);
	}
	
	
	public function add_user_register(){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('name','Name','required');
	        $this->form_validation->set_rules('email','Email','required|valid_email');
	        $this->form_validation->set_rules('mobile_no','Mobile number','required');
	        $this->form_validation->set_rules('password','Password','required');
	        
	        if( $this->form_validation->run() ){
	            try {
					/*$file = $this->input->upload('image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($file) ){
					    $this->db->set('aadhar_image', $file['path']);
					}*/
					
					$this->db->set([
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
						'dob' => $this->input->post('dob'),
						'password' => md5($this->input->post('password')),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
					//	'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						//'status' => $this->input->post('status'),
						]);
					$this->db->insert('users');
					
					notify( 'User Registration has been successfully added.', 'success', 15 );
					redirect('/admin/Dashboard/user_register/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['page_title'] = 'Add User Registration';
	    $page_data['country'] = $this->Dashboard_modal->get_country();
		$this->load->view('default/admin/add_user_register',$page_data);
	}

	public function edit_user_register($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('name','Name','required');
	        $this->form_validation->set_rules('email','Email','required|valid_email');
	        $this->form_validation->set_rules('mobile_no','Mobile number','required');
	        //$this->form_validation->set_rules('password','Password','required');
	        
	        if( $this->form_validation->run() ){
	            try {
				    
				    /*$file = $this->input->upload('image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($file) ){
					    $this->db->set('aadhar_image', $file['path']);
					}*/
					
					$this->db->set([
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
						'dob' => $this->input->post('dob'),
					//	'password' => md5($this->input->post('password')),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
					//	'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						
					]);
					$this->db->where('id',$id);
					$this->db->update('users');
					
					notify('User Registration has been successfully updated.', 'success', 15 );
					redirect('/admin/Dashboard/user_register/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['edit_user_register'] = $this->db->get_where('users',['id' => $id])->row_array();
	    $page_data['country'] = $this->Dashboard_modal->get_country();
	    $page_data['page_title'] = 'Edit User Registration';
		$this->load->view('default/admin/edit_user_register',$page_data);
	}
	
	public function view_user_register($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	
	    $page_data['view_user_register'] = $this->db->get_where('users',['id' => $id])->row_array();
	    $page_data['page_title'] = 'View User Registration';
	    $page_data['country'] = $this->Dashboard_modal->get_country();
		$this->load->view('default/admin/view_user_register',$page_data);
	}
	
	
	public function delete_user_register($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	   
	    $this->db->where('id', $id);
	    $this->db->delete('users');
	    
	    redirect('/admin/Dashboard/user_register/');
	}
	
	
	public function user_register_status($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $id);
		$this->db->update('users');
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	public function user_register_json($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$student = $this->db->get_where('users',['id' => $id])->row_array();
		echo json_encode(['status' => 1, 'data' => $student]);
	}
	
	
	public function rent_friend()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $page_data['page_title'] = 'Rent as a friend';
		$this->load->view('default/admin/rent_friend',$page_data);
	}
	
	
	public function rent_friend_datatable()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $this->load->library('datatable');
		
		$query = $this->db->from('rent_friend');
			$this->datatable->set_column('name', function($row, $db){
			return $row['name'];
		});
		
		/*$this->datatable->set_column('status', function($row, $db){
			return '<div class="form-check form-switch mb-3" dir="ltr">
				<label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['status'] == '1' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/rent_friend_status/'.$row['id']).'?status=\'+(this.checked ? \'1\' : \'0\'))"></label>
			</div>';
		});*/
		
		$this->datatable->set_column('status', function($row, $db){
			return '<select class="form-select" onchange="update_rent_friend_status('.$row['id'].', this.value)">
			 <option value="1" '.($row['status'] == '1' ? 'selected' : '').'>Approved</option>
			 <option value="0" '.($row['status'] == '0' ? 'selected' : '').'>Pending</option>
			</select>';
		});
		
		$this->datatable->set_column('photo', function($row, $db){
			if(!$row['photo']){
			    return '-';
			}
			return '<img style="object-fit:cover;" src="'.base_url($row['photo']).'" width="50" height="50">';
		});
		
		$this->datatable->set_column('aadhar_image', function($row, $db){
			if(!$row['aadhar_image']){
			    return '-';
			}
			return '<img style="object-fit:cover;" src="'.base_url($row['aadhar_image']).'" width="50" height="50">';
		});
		
		$this->datatable->set_column('action', function($row, $db){
			return '<div class="dropdown">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
				<div class="dropdown-menu">
				    <a class="dropdown-item" href="'.base_url('/admin/Dashboard/view_rent_friend/'.$row['id']).'">view</a>
					<a class="dropdown-item" href="'.base_url('/admin/Dashboard/edit_rent_friend/'.$row['id']).'">Edit</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="confirm_redirect(\''.base_url('/admin/Dashboard/delete_rent_friend/'.$row['id']).'\')">Delete</a>
				</div>
			</div>';
		}, 'id');
		
		$this->datatable->raw_columns(['name','aadhar_image','photo','status','action']);
		echo $this->datatable->run($query);
	}
	
	
	public function add_rent_friend(){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('name','Name','required');
	        $this->form_validation->set_rules('email','Email','required|valid_email');
	        $this->form_validation->set_rules('mobile_no','Mobile number','required');
	        $this->form_validation->set_rules('password','Password','required');
	        
	        if( $this->form_validation->run() ){
	            try {
					$file = $this->input->upload('aadhar_image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($file) ){
					    $this->db->set('aadhar_image', $file['path']);
					}
					
					$photo = $this->input->upload('photo', './uploads/rent_a_friend_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($photo) ){
					    $this->db->set('photo', $photo['path']);
					}
					
					
					$this->db->set([
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
						'password' => md5($this->input->post('password')),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
						'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						'about' => $this->input->post('about'),
						'age' => $this->input->post('age'),
						'gender' => $this->input->post('gender'),
						//'status' => $this->input->post('status'),
						]);
					$this->db->insert('rent_friend');
					
					$friend_id = $this->db->insert_id();
					
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
                						'friend_id' => $friend_id,
                						'images' => $uploadPath.$imageData['file_name'],
                						]);
                					$this->db->insert('friend_gallery_img');   
                        }
                            }    
                                
                            }
                        }
					
					notify( 'Rent Friend has been successfully added.', 'success', 15 );
					redirect('/admin/Dashboard/rent_friend/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['page_title'] = 'Add Rent Friend';
	    $page_data['country'] = $this->Dashboard_modal->get_country();
		$this->load->view('default/admin/add_rent_friend',$page_data);
	}

	public function edit_rent_friend($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('name','Name','required');
	        $this->form_validation->set_rules('email','Email','required|valid_email');
	        $this->form_validation->set_rules('mobile_no','Mobile number','required');
	        //$this->form_validation->set_rules('password','Password','required');
	        
	        if( $this->form_validation->run() ){
	            try {
				    
				    $file = $this->input->upload('aadhar_image', './uploads/aadhar_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($file) ){
					    $this->db->set('aadhar_image', $file['path']);
					}
					
					$photo = $this->input->upload('photo', './uploads/rent_a_friend_image/', [
						'allowed' => ['image/jpeg','image/png','image/gif']
					] );
					
					if( isset($photo) ){
					    $this->db->set('photo', $photo['path']);
					}
					
					$this->db->set([
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('mobile_no'),
					//	'password' => md5($this->input->post('password')),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
						'aadhar_num' => $this->input->post('aadhar_num'),
						'address' => $this->input->post('address'),
						'about' => $this->input->post('about'),
						'age' => $this->input->post('age'),
						'gender' => $this->input->post('gender'),
					]);
					$this->db->where('id',$id);
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
                						'friend_id' => $id,
                						'images' => $uploadPath.$imageData['file_name'],
                						]);
                					$this->db->insert('friend_gallery_img');   
                        }
                            }    
                                
                            }
                        }
					
					notify('Rent Friend has been successfully updated.', 'success', 15 );
					redirect('/admin/Dashboard/rent_friend/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['edit_rent_friend'] = $this->db->get_where('rent_friend',['id' => $id])->row_array();
	    $page_data['country'] = $this->Dashboard_modal->get_country();
	    $page_data['page_title'] = 'Edit Rent Friend';
		$this->load->view('default/admin/edit_rent_friend',$page_data);
	}
	
	public function view_rent_friend($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	
	    $page_data['view_rent_friend'] = $this->db->get_where('rent_friend',['id' => $id])->row_array();
	    $page_data['page_title'] = 'View Rent Friend';
	    $page_data['country'] = $this->Dashboard_modal->get_country();
	    $page_data['friend_images'] = $this->Dashboard_modal->friend_images($id);
		$this->load->view('default/admin/view_rent_friend',$page_data);
	}
	
	
	public function delete_rent_friend($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    
	    $this->db->where('id', $id);
	    $this->db->delete('rent_friend');
	    
	    redirect('/admin/Dashboard/rent_friend/');
	}
	
	
	public function rent_friend_status($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $id);
		$this->db->update('rent_friend');
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	
	public function update_rent_friend_status(){
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $this->input->get('id'));
		$this->db->update('rent_friend');
		
		if($this->input->get('status') == 1){
		    
		  $rent_friend_detail = $this->db->get_where('rent_friend', ['id' => $this->input->get('id')])->row_array();
          $rent_friend_email = $rent_friend_detail['email']; 
          
          $config = Array(
               'protocol' => 'smtp',
               'smtp_host' => 'ssl://mail.webdealsoft.com',
               'smtp_port' => '465',
               'smtp_user' => 'noreply@webdealsoft.com',
               'smtp_pass' => 'd+6S}~I7i2Kj',
               'charset'   => 'utf-8'
                );
              $this->load->library('email',$config);
              $this->email->set_newline("\r\n");
              $this->email->set_mailtype("html");
              $this->email->from('noreply@webdealsoft.com', 'Guidepal');
              $this->email->to($rent_friend_email);

              $this->email->subject('Request for your account approved');
              //$body = $this->load->view('email/quotationemail',$data,TRUE);
              $message = $this->email->message("your account is approved you can login now");
              $result = $this->email->send();
              //echo $this->email->print_debugger();
              /*if($result == true){
                echo json_encode(['status' => 1, 'message' => 'Email Send successfully.']);
                redirect('admin/Dashboard/guidepal_register');  
              }else{
                notify( strip_tags( validation_errors() ), 'warning', 3 );  
              }*/
		}
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	public function rent_friend_json($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$student = $this->db->get_where('rent_friend',['id' => $id])->row_array();
		echo json_encode(['status' => 1, 'data' => $student]);
	}
	
	public function friend_image_del()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
        
	    $id=$this->input->post('id');
	    $this->db->set('status', '0');
		$this->db->where('id', $id);
		$this->db->delete('friend_gallery_img');
		return true;
	}
	
	/*public function friend_subscription()
	{
	     if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $page_data['page_title'] = 'Rent Friend Subscription';
	    //$this->db->order_by("pkg_order", "asc");
	    $page_data['friend_subscription'] = $this->Dashboard_modal->get_friend_subscription();
		$this->load->view('default/admin/friend_subscription',$page_data);
	}
	
	public function friend_subscription_status($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $id);
		$this->db->update('rent_friend_subscription');
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}*/
	
	
	public function payment()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $page_data['page_title'] = 'Payment';
	    $this->db->order_by("pkg_order", "asc");
	    $page_data['payment'] = $this->db->get('payment')->result_array();
		$this->load->view('default/admin/payment',$page_data);
	}
	
	public function subscription()
	{
	     if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $page_data['page_title'] = 'Subscription';
	    //$this->db->order_by("pkg_order", "asc");
	    $page_data['subscription'] = $this->Dashboard_modal->get_subscription();
		$this->load->view('default/admin/subscription',$page_data);
	}
	
	
   /*	public function payment_datatable()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $this->load->library('datatable');
		
		$query = $this->db->from('payment');
			
		$this->datatable->set_column('status', function($row, $db){
			return '<div class="form-check form-switch mb-3" dir="ltr">
				<label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['status'] == '1' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/rent_friend_status/'.$row['id']).'?status=\'+(this.checked ? \'1\' : \'0\'))"></label>
			</div>';
		});
		
		$this->datatable->set_column('action', function($row, $db){
			return '<div class="dropdown">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="'.base_url('/admin/Dashboard/edit_payment/'.$row['id']).'">Edit</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="confirm_redirect(\''.base_url('/admin/Dashboard/delete_rent_friend/'.$row['id']).'\')">Delete</a>
				</div>
			</div>';
		}, 'id');
		
		$this->datatable->raw_columns(['name','aadhar_image','photo','status','action']);
		echo $this->datatable->run($query);
	}
	*/
	
	
	public function add_payment(){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('pkg_name','Package Name','required');
	        $this->form_validation->set_rules('pkg_amount','Package Amount','required');
	        $this->form_validation->set_rules('pkg_description','Package Description','required');
	         $this->form_validation->set_rules('pkg_duration','Package Duration','required|regex_match[/^[0-9]$/]');
	        $this->form_validation->set_rules('pkg_order','Package Order','required|regex_match[/^[0-9]$/]');
	        
	        if( $this->form_validation->run() ){
	            try {
					
					$this->db->set([
						'pkg_name' => $this->input->post('pkg_name'),
						'pkg_amount' => $this->input->post('pkg_amount'),
						'pkg_description' => $this->input->post('pkg_description'),
						'pkg_duration' => $this->input->post('pkg_duration'),
						'pkg_order' => $this->input->post('pkg_order'),
						//'status' => $this->input->post('status'),
						]);
					$this->db->insert('payment');
					
					notify( 'payment has been successfully added.', 'success', 15 );
					redirect('/admin/Dashboard/payment/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['page_title'] = 'Add Payment';
	    $page_data['country'] = $this->Dashboard_modal->get_country();
		$this->load->view('default/admin/add_payment',$page_data);
	}

	public function edit_payment($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('pkg_name','Package Name','required');
	        $this->form_validation->set_rules('pkg_amount','Package Amount','required');
	        $this->form_validation->set_rules('pkg_description','Package Description','required');
	        $this->form_validation->set_rules('pkg_duration','Package Duration','required|numeric');
	        $this->form_validation->set_rules('pkg_order','Package Order','required|numeric');
	        
	        if( $this->form_validation->run() ){
	            try {
					
					$this->db->set([
						'pkg_name' => $this->input->post('pkg_name'),
						'pkg_amount' => $this->input->post('pkg_amount'),
						'pkg_description' => $this->input->post('pkg_description'),
						'pkg_duration' => $this->input->post('pkg_duration'),
						'pkg_order' => $this->input->post('pkg_order'),
						
					]);
					$this->db->where('id',$id);
					$this->db->update('payment');
					
					notify('Payment has been successfully updated.', 'success', 15 );
					redirect('/admin/Dashboard/payment/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['edit_payment'] = $this->db->get_where('payment',['id' => $id])->row_array();
	    $page_data['country'] = $this->Dashboard_modal->get_country();
	    $page_data['page_title'] = 'Edit Payment';
		$this->load->view('default/admin/edit_payment',$page_data);
	}
	
	
	public function delete_payment($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    
	    $this->db->where('id', $id);
	    $this->db->delete('payment');
	    
	    redirect('/admin/Dashboard/payment/');
	}
	
	
	public function payment_status($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $id);
		$this->db->update('payment');
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	public function subscription_status($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $id);
		$this->db->update('subscription');
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	
	
	public function payment_json($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$student = $this->db->get_where('rent_friend',['id' => $id])->row_array();
		echo json_encode(['status' => 1, 'data' => $student]);
	}
	


	public function Faq()
	{
	    if($this->input->post('Filter'))
		{
		$where=array();
			if($this->input->post('faq_name_filter')!='')
			{
			$where['Faq_title']=$this->input->post('faq_name_filter');
			$where['language']=$this->set_language;	
			}
			if($this->input->post('status_filter')!='')
			{
			$where['Status']=$this->input->post('status_filter');
			$where['language']=$this->set_language;			
			}
			if($this->input->post('faq_name_filter')=='' && $this->input->post('status_filter')=='')
			{
				$where['language']=$this->set_language;	
			}
		}
		else
		{
			$where['language']=$this->set_language;	
		}
		
		$data['Faq']=$this->Dashboard_modal->get_Faq($where);
	    $this->load->view('default/admin/Faq',$data); 
	}
	
	public function Add_Faq()
	{
	    if($this->input->post('faq_id'))
		{
		    
			if($this->input->post('faq_name'))
			{
			  $id=$this->input->post('faq_id');
			   $data = array(
								'Faq_title' => $this->input->post('faq_name'),
								'Faq_Detail' => $this->input->post('Faq'),
								'sequence'=>$this->input->post('sequence'),
								'Status' => $this->input->post('status')
							);
				$result = $this->Dashboard_modal->update_faq($data,$id);
				if($result=='true')
				{
					//$this->load->view('admin/Color_Stones');
					redirect('/admin/dashboard/Faq');
				}
			}	
		}
		else
		{
	    if($this->input->post('faq_name'))
			{
			  
			   $data = array(
								'Faq_title' => $this->input->post('faq_name'),
								'Faq_Detail' => $this->input->post('Faq'),
								'sequence'=>$this->input->post('sequence'),
								'Status' => $this->input->post('status'),
								'language' => $this->set_language
							);
				$result = $this->Dashboard_modal->insert_faq($data);
				if($result=='true')
				{
					//$this->load->view('admin/Color_Stones');
					redirect('/admin/dashboard/faq');
				}
				
				
			}
		}
			
	    $this->load->view('default/admin/add_faq',$datar);

	}
	public function Edit_Faq()
	{
	    $id=$this->input->get('id');
		$result['edit_faq'] = $this->Dashboard_modal->edit_faq($id);
		$this->load->view('default/admin/add_faq',$result);
	}
	public function faq_status_change($id)
	{
		
		$status=$this->input->get('status');
		$result = $this->Dashboard_modal->faq_status_change($id,$status);
		redirect('/admin/dashboard/faq'); 
	}
	public function faq_del()
	{
	    $id=$this->input->get('id');
		$result = $this->Dashboard_modal->faq_del($id);
		redirect('/admin/dashboard/faq'); 
	}
	public function faq_del_all()
	{
	    $ids=$this->input->get('value');
		$result = $this->Dashboard_modal->faq_del_all($ids);
		redirect('/admin/dashboard/faq');
	}


	/*page create*/
	public function Page()
	{
	    if($this->input->post('Filter'))
		{
		$where=array();
			if($this->input->post('page_name_filter')!='')
			{
			$where['Page_title']=$this->input->post('page_name_filter');
			$where['language']=$this->set_language;	
			}
			if($this->input->post('status_filter')!='')
			{
			$where['Status']=$this->input->post('status_filter');
			$where['language']=$this->set_language;			
			}
				
		}
		else
		{
			$where['language']=$this->set_language;	
		}
		
		$data['Page']=$this->Dashboard_modal->get_Page($where);
	   $this->load->view('default/admin/Page',$data); 
	}
	
	public function Add_Page()
	{
	    $data['Page'] = "";
	    $this->load->view('default/admin/add_page',$data);

	}
	public function create_page_now(){
    
    
    $page_name= $this->input->post('page_name');
    $page_heading= $this->input->post('page_heading');
    $page_description= trim($this->input->post('Description'));
    $page_status= $this->input->post('pagestatus');
    $page_sort= $this->input->post('pagesorting');
    
       $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
       $this->form_validation->set_rules('page_name', 'Page Name', 'required');
        $this->form_validation->set_rules('page_heading', 'Heading', 'required');
         $this->form_validation->set_rules('Description', 'Description', 'required');
          $this->form_validation->set_rules('pagestatus', 'Status', 'required');
          
		 
		 
		 
		 
		 if(empty($_FILES['page_banner']['name'])){
            $slider =time().'banner';
		 	$config['upload_path'] = './uploads/products/'; 
				$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				$config['file_name'] = $slider;
				$this->load->library('upload',$config);
	   		   $upload = $this->upload->do_upload('page_banner');
	   		   $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
              $slider = $upload_data['file_name'];
       }else{
          $slider ="";  
       }
       
       
       
   
     if ($this->form_validation->run() == FALSE)
                {
                      redirect('/admin/dashboard/Add_Page'); 
                }
                else
                {
                     /*PRODUCT SLUG CODE*/
	 $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($this->input->post('page_name'))));
     $result=$this->db->select('*')->from('pages_management')->where("page_slug LIKE '$slug%'")->get()->result_array();
     $total_row = $this->db->select('*')->from('pages_management')->where("page_slug LIKE '$slug%'")->get()->num_rows(); 
        if($total_row > 0)
        {
        foreach($result as $row)
            {
            $data[] = $row['page_slug'];
            }
                if(in_array($slug, $data))
               {
                $count = 0;
                while( in_array( ($slug . '-' . ++$count ), $data) );
                $slug = $slug . '-' . $count;
               }
        }
    /*PRODUCT Slug Code Ends*/
                    $data=array('page_name'=>$page_name,
                    'page_banner'=>$slider,
                    'page_slug'=>$slug,
                    'page_heading'=>$page_heading,
                    'page_description'=>$page_description,
                    'page_sort'=>$page_sort,
                    'page_status'=>$page_status,
                    'page_created_on'=>date('Y-m-d h:i:sa'),
                    'meta_title' => $this->input->post('meta_title'),
					'meta_keyword' => $this->input->post('meta_keyword'),
					'meta_description' => $this->input->post('meta_description'),
                    );
                     $exe=$this->Dashboard_modal->add_new_page($data);
                     if($exe=='true'){
                          
                         	redirect('/admin/dashboard/page'); 
                     }
                       
                }
}
	public function Edit_Page()
	{
	    $id=$this->input->get('id');
		$result['edit_page'] = $this->Dashboard_modal->edit_page($id);
		$this->load->view('default/admin/add_page',$result);
	}
public function Update_page()
{	
	$pageid= $this->input->post('pageid'); 
   $page_name= $this->input->post('page_name');
    $page_heading= $this->input->post('page_heading');
     $page_description= trim($this->input->post('Description'));
      $page_status= $this->input->post('pagestatus');
      $page_sort= $this->input->post('pagesortingg');
       
       
       $this->form_validation->set_rules('page_name', 'Page Name', 'required');
        $this->form_validation->set_rules('page_heading', 'Heading', 'required');
         $this->form_validation->set_rules('Description', 'Description', 'required');
          $this->form_validation->set_rules('pagestatus', 'Status', 'required');
                
       	$file_image =$_FILES['page_banner']['name'];
		 
		 
		 
		 
		 if($file_image!=''){
            $slider =time().'banner';
		 	$config['upload_path'] = './uploads/products/'; 
				$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				$config['file_name'] = $slider;
				$this->load->library('upload',$config);
	   		   $upload = $this->upload->do_upload('page_banner');
	   		   $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
              $slider = $upload_data['file_name'];
       }else{
          $slider =$this->input->post('page_old_banner');  
       }
       
   
     if ($this->form_validation->run() == FALSE)
                {
                  $this->edit_page();
                }
                else
                {
                     /*PRODUCT SLUG CODE*/
	 $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($this->input->post('page_name'))));
     $result=$this->db->select('*')->from('pages_management')->where("page_slug LIKE '$slug%'")->get()->result_array();
     $total_row = $this->db->select('*')->from('pages_management')->where("page_slug LIKE '$slug%'")->get()->num_rows(); 
        if($total_row > 0)
        {
        foreach($result as $row)
            {
            $data[] = $row['page_slug'];
            }
                if(in_array($slug, $data))
               {
                $count = 0;
                while( in_array( ($slug . '-' . ++$count ), $data) );
                $slug = $slug . '-' . $count;
               }
        }
    /*PRODUCT Slug Code Ends*/
                    $data=array('page_name'=>$page_name,
                    'page_banner'=>$slider,
                    'page_heading'=>$page_heading,
                    'page_description'=>$page_description,
                    'page_status'=>$page_status,
                    'page_sort'=>$page_sort,
                    'page_created_on'=>date('Y-m-d h:i:sa'),
                    'meta_title' => $this->input->post('meta_title'),
					'meta_keyword' => $this->input->post('meta_keyword'),
					'meta_description' => $this->input->post('meta_description')
                    );
                     $exe=$this->Dashboard_modal->update_new_page($data,$pageid);
                     if($exe=='true'){
                       redirect('/admin/dashboard/page'); 
                     }
                       
                }
}	
	public function page_status_change($id)
	{
		
		$status=$this->input->get('status');
		$result = $this->Dashboard_modal->page_status_change($id,$status);
		redirect('/admin/dashboard/page'); 
	}
	public function page_del()
	{
	    $id=$this->input->get('id');
		$result = $this->Dashboard_modal->page_del($id);
		redirect('/admin/dashboard/page'); 
	}
	public function page_del_all()
	{
	    $ids=$this->input->get('value');
		$result = $this->Dashboard_modal->page_del_all($ids);
		redirect('/admin/dashboard/page');
	}
	
	
/*-------------- Ratesus -----------------*/
	
	public function ratesus()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    
	    $page_data['page_title'] = 'Guide Ratesus';
		$this->load->view('default/admin/ratesus',$page_data);
	}
	
	public function ratesus_datatable(){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->load->library('datatable');
	    $this->db->select('ratesus.*, users.id as uid, users.name as user_name');
		$this->db->join('users', 'users.id = ratesus.user_id');
	    $query = $this->db->from('ratesus');
		
	    //$this->datatable->set_default_table('subcategory');
		/*
		$this->datatable->set_column('status', function($row, $db){
			return '<div class="form-check form-switch mb-3" dir="ltr">
				<label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['status'] == '1' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/subcategory_status/'.$row['subcat_id']).'?status=\'+(this.checked ? \'1\' : \'0\'))"></label>
			</div>';
		});
		
		$this->datatable->set_column('action', function($row, $db){
			return '<div class="dropdown">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="'.base_url('/admin/Dashboard/edit_subcategory/'.$row['subcat_id']).'">Edit</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="confirm_redirect(\''.base_url('/admin/Dashboard/delete_subcategory/'.$row['subcat_id']).'\')">Delete</a>
				</div>
			</div>';
		}, 'id');
		*/
		$this->datatable->set_colmap([
			'user_name' => 'users.name',
		]);
		$this->datatable->raw_columns(['status','action']);
		echo $this->datatable->run($query);
	}
	
    
    public function rent_friend_ratesus()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    
	    $page_data['page_title'] = 'Rent Friend Ratesus';
		$this->load->view('default/admin/rent_friend_ratesus',$page_data);
	}
	
	public function rent_friend_ratesus_datatable(){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->load->library('datatable');
	    $this->db->select('rent_friend_ratesus.*, users.id as uid, users.name as user_name');
		$this->db->join('users', 'users.id = rent_friend_ratesus.user_id');
	    $query = $this->db->from('rent_friend_ratesus');
		
	    //$this->datatable->set_default_table('subcategory');
		/*
		$this->datatable->set_column('status', function($row, $db){
			return '<div class="form-check form-switch mb-3" dir="ltr">
				<label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['status'] == '1' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/subcategory_status/'.$row['subcat_id']).'?status=\'+(this.checked ? \'1\' : \'0\'))"></label>
			</div>';
		});
		
		$this->datatable->set_column('action', function($row, $db){
			return '<div class="dropdown">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="'.base_url('/admin/Dashboard/edit_subcategory/'.$row['subcat_id']).'">Edit</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="confirm_redirect(\''.base_url('/admin/Dashboard/delete_subcategory/'.$row['subcat_id']).'\')">Delete</a>
				</div>
			</div>';
		}, 'id');
		*/
		$this->datatable->set_colmap([
			'user_name' => 'users.name',
		]);
		$this->datatable->raw_columns(['status','action']);
		echo $this->datatable->run($query);
	}
	
	
	public function rent_friend_payment()
	{
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    $page_data['page_title'] = 'Rent Friend Payment';
	    $this->db->order_by("pkg_order", "asc");
	    $page_data['rent_friend_payment'] = $this->db->get('rent_friend_payment')->result_array();
		$this->load->view('default/admin/rent_friend_payment',$page_data);
	}
	
	public function add_rent_friend_payment(){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('pkg_name','Package Name','required');
	        $this->form_validation->set_rules('pkg_amount','Package Amount','required');
	        $this->form_validation->set_rules('pkg_description','Package Description','required');
	         $this->form_validation->set_rules('pkg_duration','Package Duration','required|regex_match[/^[0-9]$/]');
	        $this->form_validation->set_rules('pkg_order','Package Order','required|regex_match[/^[0-9]$/]');
	        
	        if( $this->form_validation->run() ){
	            try {
					
					$this->db->set([
						'pkg_name' => $this->input->post('pkg_name'),
						'pkg_amount' => $this->input->post('pkg_amount'),
						'pkg_description' => $this->input->post('pkg_description'),
						'pkg_duration' => $this->input->post('pkg_duration'),
						'pkg_order' => $this->input->post('pkg_order'),
						//'status' => $this->input->post('status'),
						]);
					$this->db->insert('rent_friend_payment');
					
					notify( 'Rent Friend Payment has been successfully added.', 'success', 15 );
					redirect('/admin/Dashboard/rent_friend_payment/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['page_title'] = 'Add Rent Friend Payment';
	    $page_data['country'] = $this->Dashboard_modal->get_country();
		$this->load->view('default/admin/add_rent_friend_payment',$page_data);
	}

	public function edit_rent_friend_payment($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    if( $this->input->method() == 'post' ){
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('pkg_name','Package Name','required');
	        $this->form_validation->set_rules('pkg_amount','Package Amount','required');
	        $this->form_validation->set_rules('pkg_description','Package Description','required');
	        $this->form_validation->set_rules('pkg_duration','Package Duration','required|numeric');
	        $this->form_validation->set_rules('pkg_order','Package Order','required|numeric');
	        
	        if( $this->form_validation->run() ){
	            try {
					
					$this->db->set([
						'pkg_name' => $this->input->post('pkg_name'),
						'pkg_amount' => $this->input->post('pkg_amount'),
						'pkg_description' => $this->input->post('pkg_description'),
						'pkg_duration' => $this->input->post('pkg_duration'),
						'pkg_order' => $this->input->post('pkg_order'),
						
					]);
					$this->db->where('id',$id);
					$this->db->update('rent_friend_payment');
					
					notify('Rent Friend Payment has been successfully updated.', 'success', 15 );
					redirect('/admin/Dashboard/rent_friend_payment/');
				} catch (\Exception $e){ 
					notify( $e->getMessage(), 'warning', 15 );
				}
	        } else {
	            notify( strip_tags( validation_errors() ), 'warning', 15 );
	        }
	    }
	    
	    $page_data['edit_rent_friend_payment'] = $this->db->get_where('rent_friend_payment',['id' => $id])->row_array();
	    $page_data['country'] = $this->Dashboard_modal->get_country();
	    $page_data['page_title'] = 'Edit Rent Friend Payment';
		$this->load->view('default/admin/edit_rent_friend_payment',$page_data);
	}
	
	
	public function delete_rent_friend_payment($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
	    
	    $this->db->where('id', $id);
	    $this->db->delete('rent_friend_payment');
	    
	    redirect('/admin/Dashboard/rent_friend_payment/');
	}
	
	
	public function rent_friend_payment_status($id){
	    if( ! $this->session->userdata('login_user') ){
	        redirect('/admin/Auth/login/');
	        die;
	    }
		$this->db->set('status', $this->input->get('status'));
		$this->db->where('id', $id);
		$this->db->update('rent_friend_payment');
		
		echo json_encode(['status' => 1, 'message' => 'Status has been successfully updated.']);
	}
	
	public function users_data(){ 
	    
       $usersdata = $this->Dashboard_modal->get_users_data();
       
       foreach($usersdata as $user){
         $date[] = date('Y-m-d',strtotime($user['created_on']));  
         $tot[] = $user['tot'];  
       }
       //print_r($data);die;
       $data=array('perdate'=>$date,
                  'total'=>$tot
                  );
       echo json_encode($data); 
    }


}
?>