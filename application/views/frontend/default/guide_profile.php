<style type="text/css">
		#profile_pic_preview {
			width:128px;
			height:128px;
			object-fit:cover;
			border-radius:50%;
			cursor:pointer;
		}
	</style>
<section class="profile-section">
  <div class="container">
    <div class="row">
       <div class="col-lg-12 col-md-12">
         <div class="section-title text-center">
           <h2>Profile</h2>     
         </div>  
         <div class="profile-form-wrapper">
          <form action="<?=base_url()?>guide-profile" method="post" enctype="multipart/form-data">
           <div class="form-group text-center">
			 <input type="file" id="profile_pic" name="profile_pic" accept=".jpeg,.jpg,.png,.gif" style="display:none;">
			 <img src="<?php if($profile['photo']){
			    echo base_url($profile['photo']);
			 } else {
			    echo base_url('assets/frontend/images/users/avatar.png');
			} ?>" id="profile_pic_preview">
		   </div>      
           <div class="form-group">
             <label>Name</label> 
             <input type="text" class="my-form-control" name="name" id="name" value="<?php echo $profile['name'];?>" placeholder="Enter Your Name">
           </div>
           <div class="form-group">
             <label>Gender</label>
             <div class="banner__inputlist">
              <div class="s-input me-3">
               <input type="radio" class="input-gender" name="gender" id="girl" value="girls" <?php if($profile['gender'] == "girls"){ echo "checked";}?>>
               <label for="girl">Girls</label>
              </div>
              <div class="s-input me-3">
               <input type="radio" class="input-gender" name="gender" id="boys"  value="boys" <?php if($profile['gender'] == "boys"){ echo "checked";}?>>
               <label for="boys">Boys</label>
              </div>
             </div>
            </div>
           <div class="form-group">
              <label>Email</label>
              <input type="email" class="my-form-control" name="email" id="email" value="<?php echo $profile['email'];?>" placeholder="Enter Your Email" readonly>
           </div>
           <div class="form-group">
              <label>Mobile no.</label>
              <input type="number" class="my-form-control" name="mobile_no" id="mobile_no" value="<?php echo $profile['phone'];?>" placeholder="Enter Your Mobile no." readonly>
           </div>
           <div class="form-group">
              <label>Age</label>
              <input type="text" class="my-form-control" name="age" id="guideage" value="<?php echo $profile['age'];?>" placeholder="Enter Your Age">
           </div>
           <div class="form-group">
              <label>Country</label>
              <select class="my-form-control" name="country" id="country">
               <option value="">Select Country</option>
               <?php foreach($country as $row){ ?>
               <option value="<?php echo $row['id'];?>" <?php if($profile['country'] == $row['id']){ echo "selected";}?>><?php echo $row['name'];?></option>
               <?php } ?>
              </select>
           </div>
           <div class="form-group">
              <label>State</label>
              <select class="my-form-control" name="state" id="state">
               <option value="">Select State</option>
               <?php 
		        $query = $this->db->get('states');
			    foreach ($query->result() as $row){  ?>
                <option value="<?php echo $row->id;?>" <?php if($profile['state'] == $row->id){ echo "selected";}?>><?php echo $row->name;?></option>
               <?php } ?> 
              </select>
           </div>
           <div class="form-group">
              <label>City</label>
              <input type="text" class="my-form-control" name="city" id="city" value="<?php echo $profile['city'];?>" placeholder="Enter Your City">
           </div>
           <div class="form-group">
              <label>Address</label>
              <textarea class="my-form-control" cols="5" name="address" id="address" placeholder="Enter Your Address" style="height:65px"><?php echo $profile['address'];?></textarea>
           </div>
           <div class="form-group">
              <label>About</label>
              <textarea class="my-form-control" cols="5" name="about" id="about" placeholder="Enter Your About" style="height:65px"><?php echo $profile['about'];?></textarea>
           </div>
           <div class="form-group">
              <label>Aadhar number</label>
              <input type="text" class="my-form-control" name="aadhar_num" id="aadhar_num" value="<?php echo $profile['aadhar_num'];?>" placeholder="Enter Your Aadhar number" readonly>
           </div>
           
           <!--<div class="form-group">
              <label>Upload Aadhar Image</label>
              <input type="file" class="my-form-control" name="image" id="image" >
           </div>-->
           
		   <div class="form-group mb-3">   
			<label>Aadhar Image Upload <span ></span></label>
			<div>
			  <div class="x-dropzone">
			    <div xrole="previews">
				<?php if($profile['aadhar_image']){ ?>
				<div><img src="<?php echo base_url($profile['aadhar_image']); ?>"></div>
				<?php } else { ?>
				<div xrole="placeholder">Select or Drop Files Here</div>
				<?php } ?>
			    </div>
				<div class="input-group" xrole="input-container">
				<input name="image" type="file" xrole="input" class="form-control" accept=".jpeg,.jpg,.png,.gif" readonly>
				<div class="input-group-append">
				<button class="btn btn-warning" type="button" xrole="clear">Clear</button>
				</div>
				</div>
			  </div>
			</div>
			</div>
			
			<!--<div class="form-group">
              <label>Upload Gallery Images</label>
              <input type="file" class="my-form-control" name="image[]" id="image" multiple>
           </div>-->
           <div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Upload Gallery Images </label>
														<div>
															<div class="x-dropzone">
															    
																<div xrole="previews" class="x-dropzone-multiple">
														<?php
													     $guide_image=$this->db->get_where('guidepal_gallery_img',['guide_id' => $profile['id']])->result_array();
													     foreach($guide_image as $row)
													     {
													         ?>
													         <div class="old_guide_image">
													             <img src="<?=base_url()?><?=$row['images']?>"> 
													             <i class="fa fa-trash image_remove" id="<?=$row['id']?>"  aria-hidden="true" style="color:red;position:relative;bottom: 70px;left: 50px;cursor:pointer;"></i>
													         </div>
													       
													         <?php
													     }
													    ?>	
																</div>
																<div class="input-group" xrole="input-container">
																	<input name="image[]" type="file" xrole="input" class="form-control" accept=".jpeg,.jpg,.png,.gif" multiple="multiple">
																	<div class="input-group-append">
																		<button class="btn btn-warning" type="button" xrole="clear">Clear</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											
           <div class="text-center">
              <button type="submit" class="default-btn reverse"><span>Save</span></button>
           </div>
          </form>
        </div> 
       </div> 
    </div>  
  </div>
</section>