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
									    echo 'Edit User Registration';
									}
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/user_register/'); ?>">User Registration</a></li>
											<li class="breadcrumb-item active">Edit User Registration </li>
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
														<input type="text"  name="name" class="form-control" placeholder="Name" value="<?php echo addslashes($edit_user_register['name']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Email</label>
														<input type="email"  name="email" class="form-control" placeholder="Email" value="<?php echo addslashes($edit_user_register['email']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Mobile no.</label>
														<input type="number"  name="mobile_no" class="form-control group_text" placeholder="Mobile no." value="<?php echo addslashes($edit_user_register['phone']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Date of Birth</label>
														<input type="date"  name="dob" class="form-control group_text" placeholder="Date of Birth" value="<?php echo addslashes($edit_user_register['dob']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
													  <label>Country</label>
													  <select class="form-control" id="country" name="country">
                                                        <option selected>Select Category</option>
					                                    <?php foreach($country as $row){ ?>
					                                    <option value="<?php echo $row['id'];?>" <?php if($edit_user_register['country'] == $row['id']){ echo "selected";}?>><?php echo $row['name'];?></option>
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
					                                    <option value="<?php echo $row->id;?>" <?php if($edit_user_register['state'] == $row->id){ echo "selected";}?>><?php echo $row->name;?></option>
					                                    <?php } ?>
                                                      </select>
													</div>
												</div>
												
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>City</label>
														<input type="text" name="city" class="form-control" placeholder="City" value="<?php echo addslashes($edit_user_register['city']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Address</label>
														<textarea class="form-control" rows="2" name="address" id="address" placeholder="Address"><?php echo addslashes($edit_user_register['address']); ?></textarea>
													</div>
												</div>
												<!--<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Aadhar number</label>
														<input type="text" name="aadhar_num" class="form-control" placeholder="Aadhar number" value="<?php echo addslashes($edit_user_register['aadhar_num']); ?>"  required/>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Aadhar Image Upload <span >( 1932 X 462 px )</span></label>
														<div>
															<div class="x-dropzone">
																<div xrole="previews">
																	<?php if($edit_user_register['aadhar_image']){ ?>
																	<div><img src="<?php echo base_url($edit_user_register['aadhar_image']); ?>"></div>
																	<?php } else { ?>
																	<div xrole="placeholder">Select or Drop Files Here</div>
																	<?php } ?>
																</div>
																<div class="input-group" xrole="input-container">
																	<input name="image" type="file" xrole="input" class="form-control" accept=".jpeg,.jpg,.png,.gif">
																	<div class="input-group-append">
																		<button class="btn btn-warning" type="button" xrole="clear">Clear</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>-->
											
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