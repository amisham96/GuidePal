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
 <?php
if(isset($edit_faq))
          {
            ?>
           

      <!-- Breadcrumb-->
     <!-- start page title -->
						<div class="row">
							<div class="col-12">
								<div class="page-title-box d-sm-flex align-items-center justify-content-between">
									<!--<h4 class="mb-sm-0 font-size-18"><?php 
									if($page_title){
									    echo $page_title;
									}else{
									    echo 'Edit Faq';
									}
									?></h4>-->
                                    <h4 class="mb-sm-0 font-size-18"><?php 
									    echo 'Edit Faq';
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/Faqs'); ?>">Faqs</a></li>
											<li class="breadcrumb-item active">Edit Faq </li>
										</ol>
									</div>

								</div>
							</div>
						</div>
						<!-- end page title -->
        
      <!-- End Breadcrumb-->
     <div class="row">
        <div class="col-lg-12 p-0">
          <div class="">
            <div class="card-body p-t-5">
              <form id="personal-info" method="post" action="<?=base_url();?>admin/Dashboard/Add_Faq" class="item_form"  enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               
        <div class="row col-lg-11 col-sm-12 form_layout_changer">
          <div class="col-lg-12 col-md-12 col-sm-10 col-sm-1">
                <input type="hidden" name="faq_id" value="<?=$edit_faq[0]['Id'];?>">
                 <div class="form-group row input-field">
                  <label for="input-Title" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?=$edit_faq[0]['Faq_title'];?>" id="input-Title" name="faq_name" required="">
                  </div>
                </div>
                <div class="form-group row input-field">
                  <label for="Faq_code" class="col-sm-2 col-form-label">Faq</label>
                  <div class="col-sm-12">
                <textarea class="click2edit form-control" id="Faq_code"  name="Faq"><?=$edit_faq[0]['Faq_Detail'];?></textarea>      
            
                  </div>
                </div>
                <div class="form-group row input-field">
                  <label for="input-sort" class="col-sm-2 col-form-label">Sort</label>
                  <div class="col-sm-12">
                      <input type="number" id="sort" min="1" name="sequence" class="form-control" value="<?=$edit_faq[0]['sequence'];?>" required="">
                  </div>
                </div>
                <div class="form-group input-field">
                <div class="form-group input-selectfield">
                  <label for="input-2" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-12">
                    <select  id="input-status" name="status" class="form-control selector_modify">
                      <?php
                        if($edit_faq[0]['Status']==1)
                        {
                          echo '<option value="1" selected="selected">Enabled</option>';
                          echo '<option value="0" >Disabled</option>';
                        }
                        else
                        {
                          echo '<option value="1">Enabled</option>';
                          echo '<option value="0" selected >Disabled</option>';
                        }
                        ?>
                        </select>
                  </div>
                </div>
                </div>
                <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary w-lg waves-effect waves-light">Save</button>
                                        </div>
           <!-- <div class=" float-sm-right">
                    <a href="<?=base_url()?>admin/Catalog/Faq"><button type="button" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button></a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
                </div>-->  
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
     
<?php
}
else
          {
            ?>

      <!-- Breadcrumb-->
      <!-- start page title -->
						<div class="row">
							<div class="col-12">
								<div class="page-title-box d-sm-flex align-items-center justify-content-between">
									<!--<h4 class="mb-sm-0 font-size-18"><?php 
									if($page_title){
									    echo $page_title;
									}else{
									    echo 'Add Faq';
									}
									?></h4>-->
									<h4 class="mb-sm-0 font-size-18"><?php 
									  echo 'Add Faq';
									?></h4>

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/Faq'); ?>">Faqs</a></li>
											<li class="breadcrumb-item active">Add Faq </li>
										</ol>
									</div>

								</div>
							</div>
						</div>
						<!-- end page title -->  
      <!-- End Breadcrumb-->
     <div class="row">
        <div class="col-lg-12 p-0">
          <div class="">
            <div class="card-body p-t-5">
              <form id="personal-info" method="post" action="" onsubmit="return myFunction()" enctype="multipart/form-data">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               
        
          <div class="row col-lg-11 col-sm-12 form_layout_changer">
          <div class="col-lg-12 col-md-12 col-sm-10 col-sm-1">
                <div class="form-group row input-field">
                  <label for="input-Title" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="" id="input-Title" name="faq_name" required="">
                  </div>
                </div>
                <div class="form-group row input-field">
                  <label for="input-Faq" class="col-sm-2 col-form-label">Faq</label>
                  <div class="col-sm-12">
                      <textarea class="click2edit form-control" id="Faq_code"  name="Faq"></textarea>
                  </div>
                </div>
                <div class="form-group row input-field">
                  <label for="input-Sort" class="col-sm-2 col-form-label">Sort</label>
                  <div class="col-sm-12">
                      <input type="number" id="input-Sort" min="1" name="sequence" class="form-control" required="">
                  </div>
                </div>
                <div class="form-group input-field">
                <div class="form-group input-selectfield">
                  <label for="input-Status" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-12">
                    <select  id="input-status" name="status" class="form-control selector_modify">
                     <option value="1" selected>Enabled</option>';
                        <option value="0"  >Disabled</option>';
                        </select>
                  </div>
                </div>
                </div>
                <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary w-lg waves-effect waves-light">Save</button>
                                        </div>
           
                </div></div>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php
}
?>
</div>
</div>
</div>
<!--End Row-->

   
			<!-- end main content-->
  
  
  <!-- end  -->
    <?php require_once (__DIR__ . '/include/include-bottom.php'); ?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>

	<script>
  $(".click2edit").summernote({focus: true});
</script>
	</body>
	
	<script type="text/javascript">
	x_dropzone();
	</script>