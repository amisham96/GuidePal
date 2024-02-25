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
									<h4 class="mb-sm-0 font-size-18"><?php 
									if($page_title){
									    echo $page_title;
									}else{
									    echo 'Add User Registration';
									}
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/user_register'); ?>">User Registration</a></li>
											<li class="breadcrumb-item active">Add User Registration </li>
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
														<input type="text" name="name" class="form-control" placeholder="Name" />
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Email</label>
														<input type="email" name="email" class="form-control" placeholder="Email" />
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Mobile no.</label>
														<input type="number" name="mobile_no" class="form-control" placeholder="Mobile no." />
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Date of Birth</label>
														<input type="date" name="dob" class="form-control" placeholder="Date of Birth" />
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Password</label>
														<input type="password" name="password" class="form-control" placeholder="Password" />
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Country</label>
														<select class="form-control" name="country" id="country" required>
															<option value="">Select country</option>
															<?php foreach($country as $row){ ?>
															 <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>State</label>
														<select class="form-control" name="state" id="state" required>
															<option value="">Select state</option>
														</select>
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>City</label>
														<input type="text" name="city" class="form-control" placeholder="City" />
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Address</label>
														<textarea class="form-control" rows="2" name="address" id="address" placeholder="Address"></textarea>
													</div>
												</div>
												<!--<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Aadhar number</label>
														<input type="text" name="aadhar_num" class="form-control" placeholder="Aadhar number" />
													</div>
												</div>
												<div class="col-xl-12 col-md-12">
													<div class="form-group mb-3">
														<label>Aadhar Image Upload <span >( 1932 X 462 px )</span></label>
														<div>
															<div class="x-dropzone">
																<div xrole="previews">
																	<div xrole="placeholder">Select or Drop Files Here</div>
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
	
<script type='text/javascript'>
  // baseURL variable
  var baseURL= "<?php echo base_url();?>";
 
  $(document).ready(function(){
 
    // City change
    $('#country').change(function(){
      var country = $(this).val();

      // AJAX request
      $.ajax({
        url:'<?=base_url()?>admin/Dashboard/get_city',
        method: 'post',
        data: {country: country},
        dataType: 'json',
        success: function(response){

          // Remove options 
         // $('#sel_user').find('option').not(':first').remove();
          $('#state').find('option').not(':first').remove();

          // Add options
          $.each(response,function(index,data){
             $('#state').append('<option value="'+data['id']+'">'+data['name']+'</option>');
          });
        }
     });
   });
  });
</script>