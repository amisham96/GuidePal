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
									    echo 'View Guidepal Registration';
									}
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/guidepal_register'); ?>">Guidepal Registration</a></li>
											<li class="breadcrumb-item active">View Guidepal Registration</li>
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
												  <div class="row">    
													<div class="form-group mb-3 col-md-3">
														<label>Image :</label>
													</div>
													<div class="form-group mb-3 col-md-9">
													  <?php if($view_guidepal_register['photo']){ ?>  
													   <img src="<?php echo base_url($view_guidepal_register['photo']); ?>" width="60" height="60">
													  <?php }else{ ?>
													   <img src="<?=base_url()?>assets/backend/images/users/avatar.png" width="60" height="60">
													  <?php } ?>
													</div>
												  </div>	
												</div>
												<div class="col-xl-12 col-md-12">
												   <div class="row">
												      <div class="form-group mb-3 col-md-3">
														<label>Name :</label>
													  </div>
													   <div class="form-group mb-3 col-md-9">
													    <?php echo $view_guidepal_register['name']; ?> 
													   </div> 
												   </div>
												</div>
												<div class="col-xl-12 col-md-12">
												   <div class="row">
												      <div class="form-group mb-3 col-md-3">
														<label>Email :</label>
													  </div>
													   <div class="form-group mb-3 col-md-9">
													    <?php echo $view_guidepal_register['email']; ?> 
													   </div> 
												   </div>
												</div>
												<div class="col-xl-12 col-md-12">
												   <div class="row">
												      <div class="form-group mb-3 col-md-3">
														<label>Mobile no. :</label>
													  </div>
													   <div class="form-group mb-3 col-md-9">
													    <?php echo $view_guidepal_register['phone']; ?> 
													   </div> 
												   </div>
												</div>
												<div class="col-xl-12 col-md-12">
												   <div class="row">
												      <div class="form-group mb-3 col-md-3">
														<label>Age:</label>
													  </div>
													   <div class="form-group mb-3 col-md-9">
													    <?php echo $view_guidepal_register['age']; ?> 
													   </div> 
												   </div>
												</div>
												<div class="col-xl-12 col-md-12">
												  <div class="row">
													<div class="form-group mb-3 col-md-3">
														<label>Country :</label>
													</div>
													<div class="form-group mb-3 col-md-9">
													    <?php foreach($country as $row){ ?>
                                                         <span><?php if($view_guidepal_register['country'] == $row['id']){ echo $row['name'];}?></span>
                                                         <?php } ?> 
													</div>
												  </div>
												</div>
												<div class="col-xl-12 col-md-12">
												  <div class="row">
													<div class="form-group mb-3 col-md-3">
														<label>State :</label>
													</div>
													<div class="form-group mb-3 col-md-9">
													    <?php 
													     $query = $this->db->get('states');
													     foreach ($query->result() as $row){  ?>
                                                         <span><?php if($view_guidepal_register['state'] == $row->id){ echo $row->name;}?></span>
                                                         <?php } ?> 
													</div>
												  </div>
												</div>
												<div class="col-xl-12 col-md-12">
												   <div class="row">
												      <div class="form-group mb-3 col-md-3">
														<label>City :</label>
													  </div>
													   <div class="form-group mb-3 col-md-9">
													    <?php echo $view_guidepal_register['city']; ?> 
													   </div> 
												   </div>
												</div>
												<div class="col-xl-12 col-md-12">
												  <div class="row">    
													<div class="form-group mb-3 col-md-3">
														<label>Address :</label>
													</div>
													<div class="form-group mb-3 col-md-9">
													  <?php echo $view_guidepal_register['address']; ?>
													</div>
												  </div>	
												</div>
												<div class="col-xl-12 col-md-12">
												  <div class="row">    
													<div class="form-group mb-3 col-md-3">
														<label>Aadhar number :</label>
													</div>
													<div class="form-group mb-3 col-md-9">
													  <?php echo $view_guidepal_register['aadhar_num']; ?>
													</div>
												  </div>	
												</div>
												<div class="col-xl-12 col-md-12">
												  <div class="row">    
													<div class="form-group mb-3 col-md-3">
														<label>Aadhar Image :</label>
													</div>
													<div class="form-group mb-3 col-md-9">
													  <img src="<?php echo base_url($view_guidepal_register['aadhar_image']); ?>" width="60" height="60">
													</div>
												  </div>	
												</div>
												
												<div class="col-xl-12 col-md-12">
												  <div class="row">    
													<div class="form-group mb-3 col-md-3">
														<label>Gallery Images :</label>
													</div>
													<div class="form-group mb-3 col-md-9">
													 <?php 
													 if($guide_images){
													 foreach($guide_images as $images){ ?>   
													  <img src="<?php echo base_url($images['images']); ?>" width="60" height="60">
													 <?php }
													 }else{
													 ?> 
													 <div class="">-</div>
													 <?php } ?>
													</div>
												  </div>	
												</div>
												
							                    <div class="col-xl-12 col-md-12">
												  <div class="row">
													<div class="form-group mb-3 col-md-3">
														<label>Status :</label>
													</div>
													<div class="form-group mb-3 col-md-9">
													    <?php if($view_guidepal_register['status']==1) {
													        echo "Enabled"; 
													     }
													     else{
													         echo "Disabled";
													     }
													     ?>
													</div>
												  </div>
												</div>
                                               <!--<div class="col-xl-12 col-md-12">
                                                   <div class="form-group mb-3">
                                                       <label for="input-2" class="col-sm-12 col-form-label">Status</label>
                                                       <select  id="input-status" name="status" class="form-control selector_modify">
                                                         <option value="1" <?php if($edit_info['status']==1) { echo "selected"; } ?>>Enabled</option>';
                                                         <option value="0" <?php if($edit_info['status']==0) { echo "selected"; } ?> >Disabled</option>';
                                                       </select>
                                                   </div>
                                               </div>-->
               
             
												
											</div>                                                
											<!--<div class="text-center mt-4">
                                             <button type="submit" class="btn btn-primary w-lg waves-effect waves-light">Save</button>
                                            </div>-->
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