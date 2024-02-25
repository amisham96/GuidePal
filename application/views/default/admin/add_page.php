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
if(isset($edit_page))
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
									    echo 'Edit Page';
									}
									?></h4>-->

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/Page'); ?>">Pages</a></li>
											<li class="breadcrumb-item active">Edit Page </li>
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
			<form id="personal-info" method="post" class="form_setter"  action="<?=base_url();?>admin/Dashboard/Update_page" onsubmit="return submit_new_page()" enctype="multipart/form-data">
		    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

               
        <div class="row col-lg-11 col-sm-12 form_layout_changer">
          
           
              
              <div class="col-lg-12 col-md-12 col-sm-10 col-sm-1">
                <input type="hidden" name="pageid" value="<?=$edit_page[0]['page_id'];?>">
				
				 
				
                 <div class="form-group row input-field">
                  <label for="input-page_title" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?=$edit_page[0]['page_name'];?>" id="input-page_title" name="page_name" required="">
                  </div>
                </div>
             
                
                  <div class="form-group row input-field">
             
              <div class="custom_outline" style="margin-bottom:0;">
                 <label>Image Upload <span >( 500 X 500 px )</span></label>
				                                    <div>
				                                     <div class="x-dropzone">
					                                   <div xrole="previews">
														<?php if($edit_page[0]['page_banner']){ ?>
														<div><img src="<?php echo base_url('./uploads/products/'.$edit_page[0]['page_banner']); ?>"></div>
														<?php } else { ?>
														<div xrole="placeholder">Select or Drop Files Here</div>
														<?php } ?>
													   </div>
							                         <div class="input-group" xrole="input-container">
							                           <input name="page_banner" type="file" xrole="input" class="form-control" accept=".jpeg,.jpg,.png,.gif">
							                           <div class="input-group-append">
							                            <button class="btn btn-warning" type="button" xrole="clear">Clear</button>
							                           </div>
							                         </div>
							                        </div>
							                        </div> </div>
              <img src="<?=base_url()?>./uploads/products/<?=$edit_page[0]['page_banner']?>"  class="imglogo"  style="width:75px; height: 75px;display:none;">
             
            </div>   
            
                  <div class="form-group row input-field">
                  <label for="input-Heading" class="col-sm-2 col-form-label">Heading</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?=$edit_page[0]['page_heading'];?>" id="input-Heading" name="page_heading" required=""  placeholder="Provide Heading OF Page">
                  </div>
                </div>
                <div class="form-group row input-field">
                  <label for="input-desc" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-12">
                      <textarea class="click2edit" id="page_desc" style="display:none;" name="Description"><?=$edit_page[0]['page_description'];?></textarea>
                  </div>
                </div>
                
                
                 <div class="input-field">
                <div class="form-group input-selectfield">

                  <label for="input-2" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-12">
                    <select  id="input-status" name="pagestatus" class="selector_modify form-control" required>
                      <?php
                        if($edit_page[0]['page_status']==1)
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
                </div></div>
                
                
                
                 <div class="form-group row input-field">
                  <label for="input-head" class="col-sm-2 col-form-label">Sort</label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" value="<?=$edit_page[0]['page_sort'];?>" id="input-head" name="pagesortingg" required=""  placeholder="Page Sorting Order">
                  </div>
                </div>
               
               
                
                
                
                
                <!--SEO MANAGEMENT-->
                <h4 class="col-12">SEO Management</h4>
                  <div class="form-group row input-field">
                  <label for="meta_title" class="col-sm-2 col-form-label">Meta Title</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?=$edit_page[0]['meta_title'];?>" id="meta_title" name="meta_title" >
                  </div>
                </div>
                 <div class="form-group row input-field">
                  <label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?=$edit_page[0]['meta_keyword'];?>" id="meta_keyword" name="meta_keyword" >
                  </div>
                </div>
                 <div class="form-group row input-field">
                  <label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?=$edit_page[0]['meta_description'];?>" id="meta_description" name="meta_description" >
                  </div>
                </div>
                
                       <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary w-lg waves-effect waves-light">Save</button>
                                        </div>
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
									    echo 'Add Page';
									}
									?></h4>-->

									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/'); ?>">Dashboard</a></li>
											<li class="breadcrumb-item"><a href="<?php echo base_url('/admin/Dashboard/Page'); ?>">Pages</a></li>
											<li class="breadcrumb-item active">Add Page </li>
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
               <form id="personal-info" method="post" action="<?=base_url();?>admin/Dashboard/create_page_now" onsubmit="return submit_new_page()" enctype="multipart/form-data">
		      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

         <div class="row col-lg-11 col-sm-12 form_layout_changer">
          
           
              
              <div class="col-lg-12 col-md-12 col-sm-10 col-sm-1">
      
              
                
                
                
                 
                <div class="form-group row input-field">
                  <label for="input-page_name" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?php echo set_value('page_name'); ?>" id="input-page_name" name="page_name" required="" >
                    <?php echo form_error('page_name'); ?>
                  </div>
                </div>
                 <!--<div class="form-group row input-field">
                  <label for="input-Banner" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-12">
                    <input type="file" class="form-control" id="input-Banner" name="page_banner">
                  </div>
                </div>-->
               <div class="form-group row input-field">
             
              <div class="custom_outline" style="margin-bottom:0;">
					                                  <label>Image Upload </label>
				                                  <div>
				                                  <div class="x-dropzone">
					                                <div xrole="previews">
						                            <div xrole="placeholder">Select or Drop Files Here</div>
							                        </div>
							                        <div class="input-group" xrole="input-container">
							                         <input name="image" required type="file" xrole="input" class="form-control" accept=".jpeg,.jpg,.png,.gif">
							                        <div class="input-group-append">
							                         <button class="btn btn-warning" type="button" xrole="clear">Clear</button>
							                        </div>
							                        </div>
							                      </div>
							                      </div>
							                       </div>
					                             </div>
                
                     
                  <div class="form-group row input-field">
                  <label for="input-head" class="col-sm-2 col-form-label">Heading</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?php echo set_value('page_heading'); ?>" id="input-head" name="page_heading" required="" >
                    <?php echo form_error('page_heading'); ?>
                  </div>
                </div>
                <div class="form-group row input-field">
                  <label for="input-page_desc" class="col-sm-2 col-form-label"> Description</label>
                  <div class="col-sm-12">
                     <textarea class="click2edit" id="page_desc" style="display:none;" name="Description"></textarea>
                       <?php echo form_error('Description'); ?>
                  </div>
                </div>
            
               <!-- <div class="form-group row input-field">
                  <label for="input-2" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-12">
                    <select  id="input-status" name="pagestatus" class="form-control">
                     <option value="1" selected>Enabled</option>';
                        <option value="0"  >Disabled</option>';
                        </select>
                  </div>
                </div>-->
                
                 
                  <div class="form-group row input-field">
                  <label for="input-pagesorting" class="col-sm-2 col-form-label">Sort</label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" value="<?php echo set_value('pagesorting'); ?>" id="input-pagesorting" name="pagesorting" required="">
                    <?php echo form_error('pagesorting'); ?>
                  </div>
                </div>
                
                  <div class="input-field">
                <div class="form-group input-selectfield">
                  <Label for="input-2" class="col-form-label">Status</Label>
                  <div class="col-sm-12">
                    <select  id="input-status" name="pagestatus" class="form-control selector_modify">
                     <option value="1" selected>Enabled</option>;
                        <option value="0"  >Disabled</option>;
                        </select>
                  </div>
                </div></div> 
                 
                
                
               
               
                
                
               <!--SEO MANAGEMENT-->
                 <h4 class="col-12">SEO Management</h4>
                  <div class="form-group row input-field">
                  <label for="meta_title" class="col-sm-2 col-form-label">Meta title</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="" id="meta_title" name="meta_title" >
                  </div>
                </div>
                 <div class="form-group row input-field">
                  <label for="meta_keyword" class="col-sm-2 col-form-label">Meta keyword</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="" id="meta_keyword" name="meta_keyword" >
                  </div>
                </div>
                 <div class="form-group row input-field">
                  <label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="" id="meta_description" name="meta_description" >
                  </div>
                </div> 
                <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary w-lg waves-effect waves-light">Save</button>
                                        </div>
             </div>  
                 </div>  
                  </div>  
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