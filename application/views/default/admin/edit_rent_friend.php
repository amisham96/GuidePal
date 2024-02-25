<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once (__DIR__ . '/include/head.php'); ?>
</head>
<body>
	<?php require_once (__DIR__ . '/include/header.php'); ?>
	<?php require_once (__DIR__ . '/include/sidebar.php'); ?>
    <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

						<!-- start page title -->
						<div class="row">
							<div class="col-12">
								<div class="page-title-box d-sm-flex align-items-center justify-content-between">
									<h4 class="mb-sm-0 font-color-18"><?php 
									if($page_title){
									    echo $page_title;
									}else{
									    echo 'Edit Rent as a Friend';
									}
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/rent_friend/'); ?>">Rent as a Friend</a></li>
											<li class="breadcrumb-item active">Edit Rent as a Friend </li>
										</ol>
									</div>

								</div>
							</div>
						</div>
						<!-- end page title -->
						
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<form id="add_slider" method="post" style="max-width: 700px; margin: 0 auto;" enctype="multipart/form-data">
											<?php echo $this->security->csrf_input(); ?>
											<div class="row">
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Name</label>
														<input type="text"  name="name" class="form-control" placeholder="Name" value="<?php echo addslashes($edit_rent_friend['name']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mt-1 mb-4 d-flex" style="gap:20px;">
													  <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="girl" value="girls" <?php if($edit_rent_friend['gender'] == "girls"){ echo "checked";}?>>
                                                        <label class="form-check-label" for="girl">Girls</label>
                                                      </div>
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="boy" value="boys" <?php if($edit_rent_friend['gender'] == "boys"){ echo "checked";}?>>
                                                        <label class="form-check-label" for="boy">Boys</label>
                                                      </div>
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="both" value="both" <?php if($edit_rent_friend['gender'] == "both"){ echo "checked";}?>>
                                                        <label class="form-check-label" for="both">Both</label>
                                                      </div>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Email</label>
														<input type="email"  name="email" class="form-control" placeholder="Email" value="<?php echo addslashes($edit_rent_friend['email']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Mobile no.</label>
														<input type="number"  name="mobile_no" class="form-control" placeholder="Mobile no." value="<?php echo addslashes($edit_rent_friend['phone']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Age</label>
														<input type="text"  name="age" class="form-control" placeholder="Age" value="<?php echo addslashes($edit_rent_friend['age']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
													  <label>Country</label>
													  <select class="form-control" id="country" name="country">
                                                        <option selected>Select Category</option>
					                                    <?php foreach($country as $row){ ?>
					                                    <option value="<?php echo $row['id'];?>" <?php if($edit_rent_friend['country'] == $row['id']){ echo "selected";}?>><?php echo $row['name'];?></option>
					                                    <?php } ?>
                                                      </select>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
													  <label>State</label>
													  <select class="form-control" id="state" name="state">
                                                        <option selected>Select state</option>
					                                    <?php 
														$query = $this->db->get('states');
                                                        foreach ($query->result() as $row){  ?>
					                                    <option value="<?php echo $row->id;?>" <?php if($edit_rent_friend['state'] == $row->id){ echo "selected";}?>><?php echo $row->name;?></option>
					                                    <?php } ?>
                                                      </select>
													</div>
												</div>
												
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>City</label>
														<input type="text" name="city" class="form-control" placeholder="City" value="<?php echo addslashes($edit_rent_friend['city']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Address</label>
														<textarea class="form-control" rows="2" name="address" id="address" placeholder="Address"><?php echo addslashes($edit_rent_friend['address']); ?></textarea>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>About</label>
														<textarea class="form-control" rows="2" name="about" id="about" placeholder="About"><?php echo addslashes($edit_rent_friend['about']); ?></textarea>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Aadhar number</label>
														<input type="text" name="aadhar_num" class="form-control" placeholder="Aadhar number" value="<?php echo addslashes($edit_rent_friend['aadhar_num']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Rent a Friend Image</label>
														<input type="file" name="photo" class="form-control"/>
														<?php if($edit_rent_friend['photo']){ ?>
														<img src="<?php echo base_url($edit_rent_friend['photo']); ?>" width="70" height="70">
														<?php } else{ ?>
														<img src="<?=base_url()?>assets/backend/images/users/avatar.png" width="70" height="70">
														<?php } ?>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Aadhar Image Upload <span ></span></label>
														<div>
															<div class="x-dropzone">
																<div xrole="previews">
																	<?php if($edit_rent_friend['aadhar_image']){ ?>
																	<div><img src="<?php echo base_url($edit_rent_friend['aadhar_image']); ?>"></div>
																	<?php } else { ?>
																	<div xrole="placeholder">Select or Drop Files Here</div>
																	<?php } ?>
																</div>
																<div class="input-group" xrole="input-container">
																	<input name="aadhar_image" type="file" xrole="input" class="form-control" accept=".jpeg,.jpg,.png,.gif">
																	<div class="input-group-append">
																		<button class="btn btn-warning" type="button" xrole="clear">Clear</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Upload Gallery Images </label>
														<div>
															<div class="x-dropzone">
															    
																<div xrole="previews" class="x-dropzone-multiple">
														<?php
													     $friend_image=$this->db->get_where('friend_gallery_img',['friend_id' => $edit_rent_friend['id']])->result_array();
													     foreach($friend_image as $row)
													     {
													         ?>
													         <div class="old_friend_image">
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
											
											</div>                                                
											<div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary w-lg waves-effect waves-light">Save</button>
                                        </div>
										</form>
									</div>
								</div>
							</div>
						</div>
						
				    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            <!-- footer -->
             <?php require_once( __DIR__ . '/include/footer.php' ); ?>
            <!-- footer End -->
            </div>
            <!-- end main content-->
  
  
  <!-- end  -->
    <?php require_once (__DIR__ . '/include/include-bottom.php'); ?>
	
	</body>
	<script type="text/javascript">
	x_dropzone();
	
	</script>
	
<script>
 $( document ).ready(function() {	
	$(".image_remove").click(function(event) {
    event.preventDefault();
    var id=$(this).attr('id');
    $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/Dashboard/friend_image_del'); ?>",
                data: "id="+ id,
                success: function(){
                     
                }
        });
    $(this).parents('.old_friend_image').remove();       
  
});
});    
</script>	