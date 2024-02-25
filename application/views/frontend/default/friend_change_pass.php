<section class="changepass-section">
  <div class="container">
    <div class="row">
       <div class="col-lg-12 col-md-12">
         <div class="section-title text-center">
           <h2>Change Password</h2>     
         </div>  
         <div class="changepass-form-wrap">
          <form action="<?=base_url()?>friend-change-password" method="post" enctype="multipart/form-data">
           <div class="form-group">
             <label>Old Password</label> 
             <input type="password" class="my-form-control" name="old_pass" id="old_pass" placeholder="Enter Your Old Password">
           </div>
           <div class="form-group">
              <label>New Password</label>
              <input type="password" class="my-form-control" name="new_pass" id="new_pass" placeholder="Enter Your New Password">
           </div>
           <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" class="my-form-control" name="confirm_pass" id="confirm_pass"  placeholder="Enter Your Confirm Password">
           </div>
           <div class="text-center">
              <button type="submit" class="default-btn reverse"><span>Save</span></button>
           </div>
          </form>
        </div> 
       </div> 
    </div>  
  </div>
</section>