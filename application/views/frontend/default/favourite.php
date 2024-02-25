
<section class="favourite_section">
 <div class="container">   
  <div class="title">
   <h2>Favourite</h2>     
  </div>
 </div>   
  <ul class="nav nav-tabs" id="myTab" role="tablist">
   <li class="nav-item" role="presentation">
    <button class="nav-link active" id="Guide-tab" data-bs-toggle="tab" data-bs-target="#Guide" type="button" role="tab" aria-controls="Guide" aria-selected="true">Guide</button>
   </li>
   <li class="nav-item" role="presentation">
    <button class="nav-link" id="RentFriend-tab" data-bs-toggle="tab" data-bs-target="#RentFriend" type="button" role="tab" aria-controls="RentFriend" aria-selected="false">Rent as a Friend</button>
   </li>
  </ul>
  <div class="tab-content" id="myTabContent">
   <div class="tab-pane fade show active" id="Guide" role="tabpanel" aria-labelledby="Guide-tab">
    <section class="guide_favourite">
	 <div class="member member--style3">
		<div class="container">
			<div class="section__wrapper">
			  <div class="section__header"> 
			    <div class="member__info">
					<div class="member__info--left">
					  <h2>Guide Favourite</h2>
					</div>
                </div> 
              </div>    
				<div class="row mx-12-none justify-content-center wow fadeInUp" data-wow-duration="1.5s">
				 <div class="col-lg-12 col-12"> 
				 <div class="guidefav_content">
				 <?php 
				  if($guide_favourite){
				  foreach($guide_favourite as $fav){
				 ?> 
				   <div class="fav_item">
				     <a href="<?=base_url()?>guide-details/<?=$fav['guide_id']?>" class="fav_single_content">  
				     <div class="img_area">
				       <img src="<?=base_url()?><?=$fav['photo']?>" alt="">
				       <h5><?php echo $fav['name'];?></h5>
				     </div>
				     <div class="content_area">
				        <!--<a href="javascript:void(0)"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>-->
				        <buttion class="btn-unfollow guide_unfollow unfollowguide<?=$fav['guide_id']?>" data-id="<?=$fav['guide_id']?>">unfollow</buttion> 
				     </div>
				    </a> 
				   </div>
				  <?php } 
				  }else{ ?> 
				  <p>No data found!</p>
				  <?php } ?>
				  </div>
				 </div> 	
				</div>
			</div>
		</div>
	</div>
  </section>
  </div>
   <div class="tab-pane fade" id="RentFriend" role="tabpanel" aria-labelledby="RentFriend-tab">
    <section class="friend_favourite">
	 <div class="member member--style3">
		<div class="container">
			<div class="section__wrapper">
			  <div class="section__header"> 
			    <div class="member__info">
					<div class="member__info--left">
					  <h2>Rent as a Friend Favourite</h2>
					</div>
                </div> 
              </div>    
				<div class="row mx-12-none justify-content-center wow fadeInUp" data-wow-duration="1.5s">
				 <div class="col-lg-12 col-12"> 
				 <?php 
				  if($friend_favourite){
				  foreach($friend_favourite as $fav){
				 ?> 
				   <div class="fav_item">
				     <a href="<?=base_url()?>rent-as-a-friend-details/<?=$fav['friend_id']?>">  
				     <div class="img_area">
				       <img src="<?=base_url()?><?=$fav['photo']?>" alt="">
				       <h5><?php echo $fav['name'];?></h5>
				     </div>
				     <!--<div class="content_area">
				        <a href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true"></i></a>
				     </div>-->
				     <div class="content_area">
				        <!--<a href="javascript:void(0)"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>-->
				        <buttion class="btn-unfollow friend_unfollow unfollowfriend<?=$fav['friend_id']?>" data-id="<?=$fav['friend_id']?>">unfollow</buttion> 
				     </div>
				    </a> 
				   </div>
				  <?php } 
				  }else{ ?> 
				  <p>No data found!</p>
				  <?php } ?>
				 </div> 	
				</div>
			</div>
		</div>
	</div>
  </section>
   </div>
  </div>
</section>

  



