<?php if($this->session->userdata('glogin_id')){ ?>
  <section class="follow_section">
	<div class="member member--style3">
		<div class="container">
			<div class="section__wrapper">
			  <div class="section__header"> 
			    <div class="member__info">
					<div class="member__info--left">
					  <h2>Follow</h2>
					</div>
                </div> 
              </div>    
				<div class="row mx-12-none justify-content-center wow fadeInUp" data-wow-duration="1.5s">
				 <div class="col-lg-12 col-12"> 
				  <?php if($guide_follow){ ?> 
				   <div class="follow_content">
				   <?php foreach($guide_follow as $follow){ ?>       
				    <div class="follow_item">
				      <img src="<?php if($follow['profile_pic']){
					    echo base_url($follow['profile_pic']);
					  } else {
					    echo base_url('assets/frontend/images/users/man.png');
					  } ?>">     
				      <h5><?php echo $follow['name'];?></h5>
				    </div>
				   <?php } ?> 
				   </div>
				  <?php }else{ ?>
				   <div class="text-center">No data found!</div>
				  <?php } ?>
				 </div> 	
				</div>
			</div>
		</div>
	</div>
  </section>
<?php } elseif($this->session->userdata('flogin_id')){ ?>
  <section class="follow_section">
	<div class="member member--style3">
		<div class="container">
			<div class="section__wrapper">
			  <div class="section__header"> 
			    <div class="member__info">
					<div class="member__info--left">
					  <h2>Follow</h2>
					</div>
                </div> 
              </div>    
				<div class="row mx-12-none justify-content-center wow fadeInUp" data-wow-duration="1.5s">
				 <div class="col-lg-12 col-12"> 
				  <?php if($rentfriend_follow){ ?> 
				   <div class="follow_content">
				   <?php foreach($rentfriend_follow as $follow){ ?>       
				    <div class="follow_item">
				      <img src="<?php if($follow['profile_pic']){
					    echo base_url($follow['profile_pic']);
					  } else {
					    echo base_url('assets/frontend/images/users/man.png');
					  } ?>">     
				      <h5><?php echo $follow['name'];?></h5>
				    </div>
				   <?php } ?> 
				   </div>
				  <?php }else{ ?>
				   <div class="text-center">No data found!</div>
				  <?php } ?>
				 </div> 	
				</div>
			</div>
		</div>
	</div>
  </section>
<?php } ?>
  



