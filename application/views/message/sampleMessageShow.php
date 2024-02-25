<?php
if($this->session->userdata('glogin_id')){
           $mysession = $this->session->userdata('glogin_id');
           $profile=$mysession['photo'];
			$mysession=$mysession['id'];
        }
		if($this->session->userdata('ulogin_id'))
		{
		    $mysession = $this->session->userdata('ulogin_id');
		    $profile=$mysession['profile_pic'];
			$mysession=$mysession['id'];
		}
		if($this->session->userdata('flogin_id'))
		{
		    $mysession = $this->session->userdata('flogin_id');
		    $profile=$mysession['photo'];
			$mysession=$mysession['id'];
		}
		
    $count = count($data);
    for($i = 0; $i < $count; $i++){
        if($data[$i]['sender_message_id'] == $mysession)
        {
        ?>
            <div id="receiver_msg_container">
                <div id="receiver_msg">
                        <p class="m-0" id="receiver_ptag"><?php echo $data[$i]['message'];?></p>
                         <p class="m-0" id="receiver_ptag_time"><?php echo date("d M Y h:i a",strtotime($data[$i]['time']));?></p>
                </div>
                <div id="receiver_image" style="background-size: 100% 100%; background-image:url('<?=base_url()?><?php echo $profile;?>')"></div>
            </div>
        <?php
        }else{
        ?><div id="sender_msg_container">
                <div id="sender_image" style="background-size: 100% 100%; background-image:url('<?php echo $image;?>')"></div>
                <div id="sender_msg">
                        <p class="m-0" id="receiver_ptag">
                            <?php echo $data[$i]['message'];?>
                           
                        </p>
                        <p class="m-0" id="receiver_ptag_time">
                            <?php echo date("d M Y h:i a",strtotime($data[$i]['time']));?>
                        </p>
                </div>
            </div>
        <?php
        }
    }
?>

