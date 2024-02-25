<style>
 .show-read-more .more-text{
        display: none;
  }    
</style>
<!-- ================> details section start here <================== -->
  <section class="details_section">
		<div class="container">
			<div class="section__wrapper">
				<div class="row g-0 wow fadeInUp" data-wow-duration="1.5s">
				<?php foreach($guide_details as $details){ ?>    
				<div class="col-lg-12 col-md-12 col-12">    
				 <div class="img_area">
				   <div class="backlink">
				    <a href="<?=base_url()?>guide">   
				     <img src="<?=base_url()?>assets/frontend/images/icon/back.png" class="backicon">  
				    </a> 
				   </div>     
				   <!--<img src="<?=base_url()?><?=$details['photo']?>" alt="member-img" class="memberimg">--> 
				   <div class="details__slider overflow-hidden">
					 <div class="swiper-wrapper">
					   <?php
				         $first_img = $this->db->get_where('guidepal_registration', array('id' => $guide_first_img['id']))->row_array();
				        ?> 
				        <?php if($first_img['photo']){ ?>
				        <div class="swiper-slide">
							<div class="details__thumb">
							  <img src="<?=base_url($first_img['photo']);?>" alt="">
							</div>
						</div>
						<?php } 
				        if($guide_images){
				        foreach($guide_images as $key => $images){  
				        ?>
						<div class="swiper-slide">
							<div class="details__thumb">
							  <img src="<?=base_url($images['images']);?>" alt="">
							</div>
						</div>
						<?php } }else {?>
						<div class="swiper-slide">
							<div class="details__thumb">
							  <img src="<?=base_url()?>uploads/static/placeholder.png" alt="">
							</div>
						</div>
						<?php } ?>
					  </div>
					</div>
				   <div class="info_wrap">
				     <div class="left_area">
				       <div class="item">
				          <div class="details-prev"><img src="<?=base_url()?>assets/frontend/images/icon/previcon.png"></div> 
				       </div>   
				     </div> 
				     <div class="middle_area">
				      <a href="javascript:void(0)" class="add_guidefav" data-id="<?=$details['id']?>">     
				       <div class="item">
				          <img src="<?=base_url()?>assets/frontend/images/icon/det_icon.png"> 
				       </div>
				      </a> 
				     </div>
				     <div class="right_area">
				      <a href="javascript:void(0)" onclick="starrate('<?=$details['id']?>')">     
				       <div class="item">
				          <img src="<?=base_url()?>assets/frontend/images/icon/starico.png"> 
				       </div> 
				      </a> 
				     </div>
				   </div>
				 </div>
				 <div class="content_area">
				  <div class="title">
				    <h3><?php echo $details['name'];?></h3>
				    <div class="social">
				      <div class="sendicon" id="sendmessge" data-type="g" data-image="<?=base_url($first_img['photo']);?>" data-id="<?=$details['id']?>">
				        <img src="<?=base_url()?>assets/frontend/images/icon/send.png" alt="send.png">    
				      </div>  
				    </div>
				  </div>     
				   <div class="location">
				     <h4>Location</h4>
				     <p><?php echo $details['address'];?></p>
				   </div>
				   <div class="about">
				     <h4>About</h4>
				     <p class="show-read-more"><?php echo $details['about'];?></p>
				   </div>
				   <div class="price">
				     <h4>Hiring Price</h4>
				     <span class="price"><span class="pricesign">$</span>1500</span>
				   </div>
				 </div>
				 <div class="gallery_area">
				    <div class="title_header">
				     <div class="gallery_left_content">
				       <h4>Gallery</h4>    
				     </div>    
				     <!--<div class="gallery_right_content">
				       <a href="#">See all</a>    
				     </div>-->
				    </div> 
				    <div class="galleryimg">
				     <?php
				     if($guide_images){
				     foreach($guide_images as $images){ ?>  
				     <a class="imgitem" href="<?=base_url()?><?=$images['images'];?>" data-fancybox="gallery" data-width="500" data-height="500">
				        <img src="<?=base_url()?><?=$images['images'];?>" class="gallery_img"> 
				     </a>   
				      <?php }
				       }else{ ?>
				       <div class="text-center">No Gallery Images Found!</div>
				      <?php  }
				      ?>
				    </div>
				 </div>
				 </div> 
				 <?php } ?>
				</div>
			</div>
		</div>
  </section>	
    <!-- ================> details section end here <================== -->
    
<!-- Star Rating Modal -->
	<div class="modal fade rating_modal" id="starrating" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Comment</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				    <!--<div class="filter_head">
				       <h2>Rating</h2>
				    </div>-->
					<form id="rating_form" method="post">
					    <input type="hidden" name="guide_id" id="guide_id" value="">
						<div class="banner__list">
							<div class="row align-items-center row-cols-1">
								<div class="col mb-4">
								  <label class="d-block">Rating</label>    
								  <div class="star-rating">
                                   <input id="star-5" class="star_rate" type="radio" name="rating" value="5.0" />
                                   <label for="star-5" title="5 stars">
                                     <i class="fa fa-star" aria-hidden="true"></i>
                                   </label>
                                   <input id="star-4" class="star_rate" type="radio" name="rating" value="4.0" />
                                   <label for="star-4" title="4 stars">
                                     <i class="fa fa-star" aria-hidden="true"></i>
                                   </label>
                                   <input id="star-3" class="star_rate" type="radio" name="rating" value="3.0" />
                                   <label for="star-3" title="3 stars">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                   </label>
                                   <input id="star-2" class="star_rate" type="radio" name="rating" value="2.0" />
                                   <label for="star-2" title="2 stars">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                   </label>
                                   <input id="star-1" class="star_rate" type="radio" name="rating" value="1.0" />
                                   <label for="star-1" title="1 star">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                   </label>
                                  </div>
								</div>
								<div class="col mb-4">
								  <div class="comment">
								    <label>Comment</label>  
								    <textarea class="form-control comment" name="comment" id="comment" rows="7" placeholder="Comment"></textarea>   
								  </div>
								</div>
								<div class="col">
									<button type="submit" id="btnsubmit" class="default-btn reverse d-block w-100"><span>Submit</span></button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- modal --> 
    