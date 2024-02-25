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
									    echo 'User Registration';
									}
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item active">User Registration</li>
										</ol>
									</div>

								</div>
							</div>
						</div>
						<!-- end page title -->
						
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header groupformheader">
										<h4 class="card-title">User Registration &nbsp; </h4>
										<a href="<?=base_url('admin/Dashboard/add_user_register')?>">	
									<button type="button" class="btn btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add User</button>
									</a>
									</div>
									<div class="card-body">
										<table class="table table-bordered" id="user_register_table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Email</th>
													<th>Mobile no.</th>
													<th>Date of Birth</th>
												<!--	<th>Country</th>
													<th>State</th>
													<th>City</th>
													<th>Address</th>-->
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
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
window.addEventListener('load', function(){
	$('#user_register_table').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "<?php echo base_url('admin/Dashboard/user_register_datatable'); ?>",
		"columns": [
			{ "data": 'name' },
			{ "data": 'email' },
			{ "data": 'phone' },
			{ "data": 'dob' },
		//	{ "data": 'country' },
		//	{ "data": 'state' },
		//	{ "data": 'city' },
		//	{ "data": 'address' },
		//	{ "data": 'aadhar_num' },
		//	{ "data": 'aadhar_image' },
			{ "data": 'status' },
			{ "data": 'action', "orderable": false, "searchable": false }
		]
	});
});

</script>