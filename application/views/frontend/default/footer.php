<!-- ================> Footer section start here <================== -->
 <footer class="bottom_menu">
    <div class="container">
      <div class="menu_item">
        <ul>
          <li>
            <?php if($this->session->userdata('ulogin_id') || $this->session->userdata('glogin_id') || $this->session->userdata('flogin_id') ){ ?>  
            <a href="<?=base_url()?>find" class="<?php if($this->uri->segment(1)=="find" || $this->uri->segment(1)=="buy"){echo "active";}?>">
              <img src="<?=base_url()?>assets/frontend/images/icon/home.png" class="menuicon" style="position:relative;left:4px; z-index:1;width: 20px;"> 
              <!--<img src="<?=base_url()?>assets/frontend/images/icon/menu1_2.png" class="menuicon" style="position:relative;left:-5px;">-->
            </a>
            <?php } ?>
           </li> 
           <li>
            <a href="<?=base_url()?>favourite" class="<?php if($this->uri->segment(1)=="favourite"){echo "active";}?>">
              <img src="<?=base_url()?>assets/frontend/images/icon/menu2_1.png" class="menuicon" style="position: relative;left: 16px;"> 
              <img src="<?=base_url()?>assets/frontend/images/icon/menu2_2.png" class="menuicon" style="position: relative;top:-6px;right:-4px;"> 
            </a>
           </li> 
           <li>
            <a href="javascript:void(0)" id="chatbot-open-container">
              <img src="<?=base_url()?>assets/frontend/images/icon/menu3.png" class="menuicon" style="position: relative;left: 18px;"> 
              <img src="<?=base_url()?>assets/frontend/images/icon/menu3_1.png" class="menuicon" style="position: relative;top:-3px;right: 2px;"> 
              <img src="<?=base_url()?>assets/frontend/images/icon/menu3_2.png" class="menuicon" style="position: relative;top:1px;right: 17px;">
              <img src="<?=base_url()?>assets/frontend/images/icon/menu3_3.png" class="menuicon" style="position: relative;top:5px;right: 32px;">
            <span class="chat-badge">0</span>
            </a>
            

           </li> 
           <li>
            <?php if($this->session->userdata('ulogin_id') || $this->session->userdata('google_login')){ ?>
            <a href="<?=base_url()?>user-profile" class="<?php if($this->uri->segment(1)=="user-profile"){echo "active";}?>">
              <img src="<?=base_url()?>assets/frontend/images/icon/menu4_1.png" class="menuicon" style="position: relative;top:-6px;left: 12px;"> 
              <img src="<?=base_url()?>assets/frontend/images/icon/menu4_2.png" class="menuicon" style="position: relative;top:6px;right: 7px;"> 
            </a>
            <?php }elseif($this->session->userdata('glogin_id')){ ?>
            <a href="<?=base_url()?>membership" class="<?php if($this->uri->segment(1)=="guide-profile" || $this->uri->segment(1)=="membership"){echo "active";}?>">
              <img src="<?=base_url()?>assets/frontend/images/icon/menu4_1.png" class="menuicon" style="position: relative;top:-6px;left: 12px;"> 
              <img src="<?=base_url()?>assets/frontend/images/icon/menu4_2.png" class="menuicon" style="position: relative;top:6px;right: 7px;"> 
            </a>
            <?php }elseif($this->session->userdata('flogin_id')){ ?>
            <a href="<?=base_url()?>membership" class="<?php if($this->uri->segment(1)=="friend-profile" || $this->uri->segment(1)=="membership"){echo "active";}?>">
              <img src="<?=base_url()?>assets/frontend/images/icon/menu4_1.png" class="menuicon" style="position: relative;top:-6px;left:12px;"> 
              <img src="<?=base_url()?>assets/frontend/images/icon/menu4_2.png" class="menuicon" style="position: relative;top:6px;right:7px;"> 
            </a>
            <?php } ?>
           </li> 
        </ul>  
      </div>  
    </div> 
 </footer>	
<!-- ================> Footer section end here <================== -->
