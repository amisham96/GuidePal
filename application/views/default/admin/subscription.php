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
									    echo 'Subscription';
									}
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item active">Subscription</li>
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
										<h4 class="card-title">Subscription &nbsp; </h4>
										
									</div>
									<div class="card-body">
										<table class="table table-bordered" id="subscription_table">
											<thead>
												<tr>
												    <th>Image</th>
													<th>Name</th>
													<th>Email</th>
													<th>Mobile No.</th>
													<th>Package</th>
													<th>Exp. Date</th>
													<th>Package Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											  <?php 
											  foreach($subscription as $row)
											  { 
											 $selected_package_expdate=strtotime(date("Y-m-d H:i:s", strtotime($row['subscription_payment_date'])) . "+".$row['pkg_duration']." months");
											  ?>  
											  <tr>
											     <td><img style="object-fit:cover;" src="<?=base_url($row['photo'])?>" width="50" height="50"></td>
											    <td><?php echo $row['name'];?></td>
											    <td><?php echo $row['email'];?></td>
											    <td><?php echo $row['phone'];?></td>
											    <td><?php echo $row['pkg_name'];?></td>
											    <td>
											       <?php echo date("d-M-Y", $selected_package_expdate);  ?> 
											    </td>
											    <td><?php echo $row['subscription_status'];?></td>
											    <td class="text-center">
									             <?php
									              echo '<div class="form-check form-switch mb-3" dir="ltr">
				                                  <label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['subscription_status'] == 'active' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/subscription_status/'.$row['subscription_id']).'?status=\'+(this.checked ? \'active\' : \'deactive\'))"></label>
			                                      </div>';
			                                     ?>
                                                </td>
                                                
											  </tr>	
											  <?php } ?>
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
	
<script>
  $(document).ready(function () {
    $('#subscription_table').DataTable();
});    
</script>	
<!--
<script type="text/javascript">
window.addEventListener('load', function(){
	$('#payment_table').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "<?php echo base_url('admin/Dashboard/subscription_datatable'); ?>",
		"columns": [
		    { "data": 'pkg_name' },
			{ "data": 'pkg_amount' },
			{ "data": 'pkg_description' },
			{ "data": 'status' },
			{ "data": 'action', "orderable": false, "searchable": false }
		]
	});
});

</script>
-->