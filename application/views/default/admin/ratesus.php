<!DOCTYPE html><html lang="en"><head>    <?php require_once (__DIR__ . '/include/head.php'); ?></head><body>	<?php require_once (__DIR__ . '/include/header.php'); ?>	<?php require_once (__DIR__ . '/include/sidebar.php'); ?>    <!-- Start right Content here -->            <!-- ============================================================== -->            <div class="main-content">                <div class="page-content">                    <div class="container-fluid">						<!-- start page title -->						<div class="row">							<div class="col-12">								<div class="page-title-box d-sm-flex align-items-center justify-content-between">									<h4 class="mb-sm-0 font-size-18"><?php 									if($page_title){									    echo $page_title;									}else{									    echo 'Guide Ratesus';									}									?></h4>									<div class="page-title-right">										<ol class="breadcrumb m-0">											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>											<li class="breadcrumb-item active">Guide Ratesus</li>										</ol>									</div>								</div>							</div>						</div>						<!-- end page title -->						<div class="row">							<div class="col-md-12">								<div class="card">									<div class="card-header groupformheader">										<h4 class="card-title">Guide Ratesus &nbsp; </h4>									</div>									<div class="card-body">										<table class="table table-bordered" id="ratesus_table">											<thead>												<tr>												    <th>User Name</th>													<th>Rating</th>                                                    <th>Comment</th>													<th>Created</th>													<!--<th>Action</th>-->												</tr>											</thead>											<tbody>											</tbody>										</table>									</div>								</div>							</div>						</div>										    </div>                    <!-- container-fluid -->                </div>                <!-- End Page-content -->            <!-- footer -->             <?php require_once( __DIR__ . '/include/footer.php' ); ?>            <!-- footer End -->            </div>            <!-- end main content-->      <!-- end  -->    <?php require_once (__DIR__ . '/include/include-bottom.php'); ?>		</body><script type="text/javascript">window.addEventListener('load', function(){	$('#ratesus_table').DataTable({		"processing": true,		"serverSide": true,		"ajax": "<?php echo base_url('admin/Dashboard/ratesus_datatable'); ?>",		"columns": [		    { "data": 'user_name' },			{ "data": 'rating' },			{ "data": 'comment' },			{ "data": 'created' },			//{ "data": 'action', "orderable": false, "searchable": false }		]	});});</script>