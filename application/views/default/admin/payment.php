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
									    echo 'Payment';
									}
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item active">Payment</li>
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
										<h4 class="card-title">Payment &nbsp; </h4>
										<a href="<?=base_url('admin/Dashboard/add_payment')?>">	
									<button type="button" class="btn btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add Payment</button>
									</a>
									</div>
									<div class="card-body">
									   <div class="table-responsive">
										<table class="table table-bordered" id="payment_table">
											<thead>
												<tr>
												    <th>Package Order</th>
													<th>Package Name</th>
													<th>Package Amount</th>
													<th>Package Duration</th>
													
													<th>Package Description</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											  <?php foreach($payment as $row){ ?>  
											  <tr>
											      <td><?php echo $row['pkg_order'];?></td>

											    <td><?php echo $row['pkg_name'];?></td>
											    <td><?php echo $row['pkg_amount'];?></td>
											    <td><?php echo $row['pkg_duration'];?> Months</td>
											    <td><?php echo html_entity_decode($row['pkg_description']);?></td>
											    <td class="text-center">
									             <?php
									              echo '<div class="form-check form-switch mb-3" dir="ltr">
				                                  <label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['status'] == '1' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/payment_status/'.$row['id']).'?status=\'+(this.checked ? \'1\' : \'0\'))"></label>
			                                      </div>';
			                                     ?>
                                                </td>
                                                <td class="text-right">
								                 <?php
								                  echo '<div class="dropdown">
				                                  <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
				                                  <div class="dropdown-menu">
					                                <a class="dropdown-item" href="'.base_url('admin/Dashboard/edit_payment/'.$row['id']).'">Edit</a>
					                                <a class="dropdown-item" href="javascript:void(0)" onclick="confirm_redirect(\''.base_url('/admin/Dashboard/delete_payment/'.$row['id']).'\')">Delete</a>
				                                  </div>
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
    $('#payment_table').DataTable();
});    
</script>	
<!--
<script type="text/javascript">
window.addEventListener('load', function(){
	$('#payment_table').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "<?php echo base_url('admin/Dashboard/payment_datatable'); ?>",
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

<script>
 function confirm_btn_status(id,status)
   {
      swal({
                    title: "Are you sure?",
                    text: "Change Data Status!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      swal("Your Data Status Successfully Changed!", {
                        icon: "success",
                      }).then(function() {
                     window.location.href="<?php echo base_url(); ?>admin/Dashboard/payment_status?id="+id+"&status="+status;
                  });
                    } else {
                      swal("Your imaginary Data is Not Changed!");
                    }
                  });
   }    
</script>