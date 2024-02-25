<?php if($this->session->userdata('glogin_id')){ ?>
<section class="membership_section">
  <div class="container">
    <div class="row">
     <?php
     $active_pack_id='';
      if(isset($selected_package))
      {
                    $selected_package_id=$selected_package['pkg_id'];
                    $get_pack = $this->db->get_where('payment', ['id' => $selected_package_id])->row_array();
                    $current_date=strtotime(date('Y-m-d H:i:s'));
                    $selected_package_date=strtotime($selected_package['subscription_payment_date']);
                    //echo date("d M Y",$selected_package_date);die;
                    $selected_package_expdate=strtotime(date("Y-m-d H:i:s", strtotime($selected_package['subscription_payment_date'])) . "+".$get_pack['pkg_duration']." months");
                    if($current_date<$selected_package_expdate)
                    {
                                    $active_pack_id=$selected_package_id;
                                    $selected_package_expdate='Exp. Date : '.date("d M Y", $selected_package_expdate);
                    }
      }
      ?>
      <div class="col-lg-12 col-12">
        <div class="membership_details">
          <div class="img_area">
           <a href="<?=base_url()?>guide-profile">      
            <img src="<?=base_url()?><?=$guide_profile['photo']?>" alt="">
            <i class="fa fa-plus"></i>
           </a>    
          </div>
          <h3><?php echo $guide_profile['name'];?>, <?php echo $guide_profile['age'];?></h3>
        </div> 
        <?php if($selected_package){ ?>
        <div class="membership_plan_info">
          <div class="plan_content">
            <h3><?=$get_pack['pkg_name']?></h3> 
            <span><?=$selected_package_expdate;?></span>
          </div>   
        </div>
        <?php } ?>
        <div class="follow_list">
         <a href="<?=base_url()?>follow">    
           <div class="fav_icon">
             <i class="fa fa-heart"></i> 
             <h3>Favourite</h3>
           </div> 
           <div class="right_arrow">
             <i class="fa fa-chevron-right"></i>  
           </div>
         </a>  
        </div>
      </div>  
    </div>  
  </div>  
</section>
<?php }elseif($this->session->userdata('flogin_id')){ ?>
<section class="membership_section">
  <div class="container">
    <div class="row">
     <?php
     $active_pack_id='';
      if(isset($friend_selected_package))
      {
                  $selected_package_id=$friend_selected_package['pkg_id'];
                  $get_pack = $this->db->get_where('payment', ['id' => $selected_package_id])->row_array();
                    $current_date=strtotime(date('Y-m-d H:i:s'));
                    $selected_package_date=strtotime($friend_selected_package['subscription_payment_date']);
                    $selected_package_expdate=strtotime(date("Y-m-d H:i:s", strtotime($friend_selected_package['subscription_payment_date'])) . "+".$get_pack['pkg_duration']." months");
                    if($current_date<$selected_package_expdate)
                    {
                                    $active_pack_id=$selected_package_id;
                                    $selected_package_expdate='Exp. Date : '.date("d M Y",$selected_package_expdate);
                    }
      }
      ?>
      <div class="col-lg-12 col-12">
        <div class="membership_details">
          <div class="img_area">
           <a href="<?=base_url()?>friend-profile">      
            <img src="<?=base_url()?><?=$rent_friend_profile['photo']?>" alt=""> 
           </a>    
          </div>
          <h3><?php echo $rent_friend_profile['name'];?>, <?php echo $rent_friend_profile['age'];?></h3>
        </div> 
        <?php if($friend_selected_package){ ?>
        <div class="membership_plan_info">
          <div class="plan_content">
            <h3><?=$get_pack['pkg_name']?></h3> 
            <span><?=$selected_package_expdate;?></span>
          </div>   
        </div>
        <?php } ?>
        <div class="follow_list">
         <a href="<?=base_url()?>follow">    
           <div class="fav_icon">
             <i class="fa fa-heart"></i> 
             <h3>Favourite</h3>
           </div> 
           <div class="right_arrow">
             <i class="fa fa-chevron-right"></i>  
           </div>
         </a>  
        </div>
      </div>  
    </div>  
  </div>  
</section>
<?php } ?>