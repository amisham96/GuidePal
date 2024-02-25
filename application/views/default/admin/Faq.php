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
									<!--<h4 class="mb-sm-0 font-size-18"><?php 
									if($page_title){
									    echo $page_title;
									}else{
									    echo 'Faqs';
									}
									?></h4>-->
									<h4 class="mb-sm-0 font-size-18"><?php 
									 echo 'Faqs';
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/Faq'); ?>">Faqs</a></li>
										</ol>
									</div>

								</div>
							</div>
						</div>
						
  <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body ">
               <form id="signupForm" method="post" action="<?=base_url()?>admin/Dashboard/Faq">
                   <div class="row col-12">
                       <div class="col-4">
                     <div class="form-group row input-field">
                        <input type="hidden" name="Filter" value="filter">
                        <label for="input-10" class="col-form-label">Faq Title</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" id="input-10" name="faq_name_filter">
                        </div>
                    </div>
                    </div>
                     <div class="col-4">
                         <div class="input-field">
                    <div class="form-group input-selectfield">
                        <label for="input-11" class="col-form-label">Status</label>
                        <div class="col-sm-12">
                           <select class="form-control selector_modify" id="input-6" id="status" name="status_filter">
                              <option value="">All</option>
                          <option value="1">Enabled</option>
                           <option value="0">Disabled</option>
                           </select>
                        </div>
                     </div>
                      </div>
                     </div>
                     <div class="col-2" style="text-align: right;">
                      <button type="submit" style="margin-top: 35px;" id="button-filter"  class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
                     </div>
					 <div class="col-2">
					 <?php //if(in_array('createFaq', $user_permission)): ?>      
					<a href="<?=base_url(); ?>admin/Dashboard/Add_Faq" ><button type="button"  style="margin-top: 35px;" class="btn btn-info notika-btn-info waves-effect"><i class="fa fa-plus"></i> Add Faq</button></a>
					  <?php //endif; ?>
					  </div>
                     </div>
                  </form>
            </div>
         </div>
      </div>
   </div>
   <!--End Row-->
   <div class="row">
      <div class="col-lg-12 p-0">
      <div class="">
         <div class="card-body p-t-5">
         
         <form >
            <div class="table-responsive">
               <table class="table-bordered table-hover" id="faqdata">
                           <thead>
                              <tr>
                                
                                 <th class="text-center">Title
                                 </th>
                                 <th class="text-center">Detail
                                 </th>
                                 <th class="text-center">Sort
                                 </th>
                                 <th class="text-center">Status
                                 </th>
                                 <th class="text-center">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                              if($Faq==false) 
                              {
                                 ?>
                                    <tr>
                                       <td colspan="6" align="center" style="color: #ff0023;">Data Not Found !!</td>

                                    </tr>
                                 <?php
                              }
                              else
                              {
                              foreach ($Faq as $row) 
                              {
                                 ?>
                              <tr>
                                 
                                  <td><?php echo $row['Faq_title']; ?></td>
                                   <td><?php echo $row['Faq_Detail']; ?></td>
                                   <td><?php echo $row['sequence']; ?></td>
                                     <td class="text-center">
									 <?php
									 
									 echo '<div class="form-check form-switch mb-3" dir="ltr">
				<label class="form-check-label"><input type="checkbox" class="form-check-input" '.($row['Status'] == '1' ? 'checked' : '').' onchange="confirm_ajax(\''.base_url('/admin/Dashboard/faq_status_change/'.$row['Id']).'?status=\'+(this.checked ? \'1\' : \'0\'))"></label>
			</div>';
			?>
                                    
                                 </td>
                                 <td class="text-right">
								 <?php
								 echo '<div class="dropdown">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="'.base_url('admin/Dashboard/Edit_Faq?id='.$row['Id']).'">Edit</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="confirm_redirect(\''.base_url('/admin/Dashboard/faq_del?id='.$row['Id']).'\')">Delete</a>
				</div>
			</div>';
								 ?>
                                   
                                 </td>
                              </tr>
                              <?php
                                 }
                              }
                              ?>
                           </tbody>
               </table>
            </div>
         </form>
      </div>
      </div>
      </div>
   </div>
   <!-- End container-fluid-->
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
	<script type="text/javascript">
window.addEventListener('load', function(){
	$('#faqdata').DataTable({
		
	});
});

</script>