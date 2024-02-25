<?php
class Message extends CI_controller
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
		$this->load->model('Messagemodel');
		$this->load->library("pagination");
    }
    
	public function index()
	{
// 		if(isset($_SESSION['image'])){
// 			$data['data'] = $this->Messagemodel->ownerDetails();
// 			$this->load->view('message/message',$data);
// 		}else{
// 			$this->load->view('error/error');
// 		}
	}
	public function ownerDetails(){
		$res = $this->Messagemodel->ownerDetails();
		print_r(json_encode($res));
	}
	public function allUser()
	{
	$data['data'] = $this->Messagemodel->allUser();
 // print_r($data['data']);
		$data['last_msg'] = array();
		$this->load->helper('url');
		if(!is_array($data['data'])){
			echo "<p class='text-center'>No user available.</p>";
		}else{
			$count = count($data['data']);
			for($i = 0; $i < $count; $i++){
				$unique_id = $data['data'][$i]['id'];
				$userType = $data['data'][$i]['user_type'];
				$msg = $this->Messagemodel->getLastMessage($unique_id,$userType);
				$data['data'][$i]['totnotseenMessage'] = $this->Messagemodel->gettotnotseenMessage($unique_id,$userType);
				for($j = 0; $j < count($msg); $j++){
					$time = explode(" ",$msg[0]['time']); //00:00:00.0000
					$time = explode(".", $time[1]);      //00:00:00
					$time = explode(":",$time[0]);      //00 00 00
					
					if((int)$time[0] == 12){
						$time = $time[0].":".$time[1]." PM";
					}
					elseif((int)$time[0] > 12){
						$time = ($time[0] - 12).":".$time[1]." PM";
					}else{
						$time = $time[0].":".$time[1]." AM";
					}
					array_push($data['last_msg'],array(
						'message' => $msg[0]['message'],
						'sender_id' => $msg[0]['sender_message_id'],
						'receiver_id' => $msg[0]['receiver_message_id'],
						'time' => $time //00:00
					));
				}
			}
			$this->load->view('message/sampleDataShow',$data);
		}
	}
	
	public function notseenMessage()
	{
		echo  $data['data'] = $this->Messagemodel->notseenMessage();
	}
	
	public function getIndividual(){
		$returnVal = $this->Messagemodel->getIndividual($_POST['data'],$_POST['userType']);
		print_r(json_encode($returnVal,true));
	}
	
	public function setNoMessage()
	{
		$data['image'] = $_POST['image'];
		$data['name'] = $_POST['name'];
		$this->load->view('message/notmessageyet',$data);
	}
	public function sendMessage()
	{
		if(isset($_POST['data']))
		{
		$jsonDecode = json_decode($_POST['data'],true);
		
		if($this->session->userdata('glogin_id'))
		{
            $mysession = $this->session->userdata('glogin_id');
			$uniq=$mysession['id'];
			$user_type=$mysession['user_type'];
        }
		if($this->session->userdata('ulogin_id'))
		{
		    $mysession = $this->session->userdata('ulogin_id');
			$uniq=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		if($this->session->userdata('flogin_id'))
		{
		    $mysession = $this->session->userdata('flogin_id');
			$uniq=$mysession['id'];
			$user_type=$mysession['user_type'];
		}
		
		$arr = array(
			'time' => $jsonDecode['datetime'],
			'sender_message_id' => $uniq,
			'receiver_message_id' => $jsonDecode['uniq'],
			'receiver_type' => $jsonDecode['usertype'],
			'sender_type' => $user_type,
			'message' => $jsonDecode['message'],
			'status' => 'sent',
		);
			$message_id=$this->Messagemodel->sentMessage($arr);
			$data['data'] = $this->Messagemodel->getsentmessage($message_id);
			$data['image'] = '';
			$this->load->view('message/sampleMessageShow',$data);
		}
	}
	public function getMessage(){
		if(isset($_POST['data'])){
			$data['data'] = $this->Messagemodel->getmessage($_POST['data'],$_POST['userType']);
			$data['image'] = $_POST['image'];
			$this->load->view('message/sampleMessageShow',$data);
		}
	}
	public function getNewmessage(){
		if(isset($_POST['data'])){
			$data['data'] = $this->Messagemodel->getNewmessage($_POST['data'],$_POST['userType']);
			$data['image'] = $_POST['image'];
			$this->load->view('message/sampleMessageShow',$data);
		}
	}
	
	public function updateBio(){
		if($_POST){
			$this->Messagemodel->updateBio($_POST);
		}
	}
	public function blockUser(){
		if(isset($_POST['time']) && isset($_POST['uniq'])){
			$arr = array(
				'blocked_from' => $_SESSION['uniqueid'],
				'blocked_to' => $_POST['uniq'],
				'time' => $_POST['time']
			);
			$this->Messagemodel->blockUser($arr);
			return 1;
		}
	}
	public function getBlockUserData(){
		if(isset($_POST['uniq'])){
			$res = $this->Messagemodel->getBlockUserData($_POST['uniq'],$_SESSION['uniqueid']);
			print_r(json_encode($res));
		}
	}
	public function unBlockUser()
	{
		if(isset($_POST['uniq'])){
			$from = $_SESSION['uniqueid'];
			$to = $_POST['uniq'];
			$this->Messagemodel->unBlockUser($from, $to);
		}
	}
}


?>