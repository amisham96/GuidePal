<style>
    Expire
    {
        position: absolute;
    /* left: -1px; */
    background: #d70610;
    padding: 0px 14px;
    border-radius: 5px 0px 0px 0px;
    color: #f3efefde;
    font-size: 12px;
    font-family: revert;
    }
    .deactive_pack
    {
        opacity: 0.2;
    }
    .active_pack
    {
        box-shadow: 0 10px 20px rgb(136 136 136 / 30%);
    }
    
</style>
<?php
 $active_pack_id='';
      if(isset($selected_package))
      {
                  $selected_package_id=$selected_package['pkg_id'];
                  $get_pack = $this->db->get_where('payment', ['id' => $selected_package_id])->row_array();
                    $current_date=strtotime(date('Y-m-d H:i:s'));
                    $selected_package_date=strtotime($selected_package['subscription_payment_date']);
                    $selected_package_expdate=strtotime(date("Y-m-d H:i:s", strtotime($selected_package['subscription_payment_date'])) . "+".$get_pack['pkg_duration']." months");
                    if($current_date<$selected_package_expdate)
                    {
                                    $active_pack_id=$selected_package_id;
                                    $selected_package_expdate='Exp. Date : '.date("d M Y",$selected_package_expdate);
                    }
      }
?>
<?php if($this->session->userdata('glogin_id')){ ?>
<?php if(isset($selected_package_expdate)){ 
    redirect('membership');
?>
<?php }else{ ?>
<section class="package-section bgcode">
  <div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="section-title text-center">
            <h2>Pricing</h2>     
          </div> 
        </div>
    </div> 
    <div class="row">
      <?php 
      if($package){
      foreach($package as $pkg)
      { 
          if($active_pack_id!='')
          {
              if($active_pack_id==$pkg['id'])
              {
                  $acive_class='active_pack';
                  $active_pack=1;
              }
              else
              {
                  $acive_class='deactive_pack';
                  $active_pack=2;
              }
          }
          else
            {
                $active_pack='';
                $acive_class="";
            }
            
      ?>    
       <div class="col-lg-4 col-md-4 col-12 pkg_bx ">
            <?php
                if($active_pack==1)
                {
                    ?>
                    <Expire><?=$selected_package_expdate?></Expire>
                   
                    <?php
                }
                ?>
          <div class="package_item <?=$acive_class?>">
             
            <div class="package_single_item">
                
              <div class="top_content">
                   
                <h4>
                   
                    <?php echo $pkg['pkg_name'];?></h4>
                <div class="amount">
                 <sup>$</sup>
                 <span class="price"><?php echo $pkg['pkg_amount'];?></span>
                </div>
                
                
              </div>
              
              <div class="content_area">
                <?php echo $pkg['pkg_description'];?> 
                
              </div> 
              <div class="buy text-center">
                  <?php
                  if($active_pack==1)
                  {
                    ?>
                    <span class="buy_btn">Activated</span>  
                    <?php  
                  }
                  else
                  {
                      if($active_pack==2)
                      {
                          ?>
                        <span class="buy_btn">Buy</span>  
                        <?php 
                      }
                      if($active_pack=='')
                      {
                  ?>
                     <a href="<?=base_url()?>payment/<?php echo $pkg['pkg_name'];?>" class="buy_btn">Buy</a>  
                   <?php
                      }
                    }
                   ?>
              </div>
              
            </div>  
          </div>  
       </div>
       <?php }
        }else{ 
       ?>
       <div class="text-center">No Packages Found !</div>
       <?php } ?>
    </div>    
  </div>
</section>
<?php } ?>
<?php } elseif($this->session->userdata('flogin_id')){ ?>
<?php if(isset($selected_package_expdate)){ 
    redirect('membership');
?>
<?php }else{ ?>
<section class="package-section bgcode">
  <div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="section-title text-center">
            <h2>Pricing</h2>     
          </div> 
        </div>
    </div> 
    <div class="row">
      <?php 
      $active_pack_id='';
      if(isset($selected_package))
      {
                  $selected_package_id=$selected_package['pkg_id'];
                  $get_pack = $this->db->get_where('payment', ['id' => $selected_package_id])->row_array();
                    $current_date=strtotime(date('Y-m-d H:i:s'));
                    $selected_package_date=strtotime($selected_package['subscription_payment_date']);
                    $selected_package_expdate=strtotime(date("Y-m-d H:i:s", strtotime($selected_package['subscription_payment_date'])) . "+".$get_pack['pkg_duration']." months");
                    if($current_date<$selected_package_expdate)
                    {
                                    $active_pack_id=$selected_package_id;
                                    $selected_package_expdate='Exp. Date : '.date("d M Y",$selected_package_expdate);
                    }
      }
      
      if($package){
      foreach($package as $pkg)
      { 
          if($active_pack_id!='')
          {
              if($active_pack_id==$pkg['id'])
              {
                  $acive_class='active_pack';
                  $active_pack=1;
              }
              else
              {
                  $acive_class='deactive_pack';
                  $active_pack=2;
              }
          }
          else
            {
                $active_pack='';
                $acive_class="";
            }
            
      ?>    
       <div class="col-lg-4 col-md-4 col-12 pkg_bx ">
            <?php
                if($active_pack==1)
                {
                    ?>
                    <Expire><?=$selected_package_expdate?></Expire>
                   
                    <?php
                }
                ?>
          <div class="package_item <?=$acive_class?>">
             
            <div class="package_single_item">
                
              <div class="top_content">
                   
                <h4>
                   
                    <?php echo $pkg['pkg_name'];?></h4>
                <div class="amount">
                 <sup>$</sup>
                 <span class="price"><?php echo $pkg['pkg_amount'];?></span>
                </div>
                
                
              </div>
              
              <div class="content_area">
                <?php echo $pkg['pkg_description'];?> 
                
              </div> 
              <div class="buy text-center">
                  <?php
                  if($active_pack==1)
                  {
                    ?>
                    <span class="buy_btn">Activated</span>  
                    <?php  
                  }
                  else
                  {
                      if($active_pack==2)
                      {
                          ?>
                        <span class="buy_btn">Buy</span>  
                        <?php 
                      }
                      if($active_pack=='')
                      {
                  ?>
                     <a href="<?=base_url()?>payment/<?php echo $pkg['pkg_name'];?>" class="buy_btn">Buy</a>  
                   <?php
                      }
                    }
                   ?>
              </div>
              
            </div>  
          </div>  
       </div>
       <?php }
        }else{ 
       ?>
       <div class="text-center">No Packages Found !</div>
       <?php } ?>
    </div>    
  </div>
</section>
<?php }?>
<?php } ?>