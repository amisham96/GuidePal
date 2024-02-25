    <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>
                            <li>
                                <a href="<?php echo base_url('/admin/Dashboard'); ?>">
                                    <i class="fas fa-desktop"></i>
                                    <span >Dashboard</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="javascript:void(0)" class="has-arrow">
                                   <i class=" fas fa-cog"></i>
                                    <span data-key="t-apps">Web Configuration</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
									<!--<li>
                                        <a href="<?php echo base_url('/admin/Dashboard/social_config'); ?>">
                                            <span >Social info</span>
                                        </a>
                                    </li>-->
        
                                    <li>
                                        <a href="<?php echo base_url('/admin/Dashboard/system_setting'); ?>">
                                            <span >Web Settings</span>
                                        </a>
                                    </li>
									 
                                </ul>
                            </li>
                          
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                     <i class=" fas fa-users"></i>
                                    <span >User Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?=base_url()?>admin/Dashboard/guidepal_register" data-key="t-login">Guidepal Registration</a></li>
                                    <li><a href="<?=base_url()?>admin/Dashboard/user_register" data-key="t-login">User Registration</a></li>
                                    <li><a href="<?=base_url()?>admin/Dashboard/rent_friend" data-key="t-login">Rent as a friend</a></li>
                                </ul>
                            </li>
                          
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                     <i class="fa fa-star"></i>
                                    <span>Ratesus</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?=base_url()?>admin/Dashboard/ratesus" data-key="t-login">Guide Ratesus</a></li>
                                    <li><a href="<?=base_url()?>admin/Dashboard/rent_friend_ratesus" data-key="t-login">Rent Friend Ratesus</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                     <i class="fas fa-tasks"></i>
                                    <span>Payment</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?=base_url()?>admin/Dashboard/payment" data-key="t-login">Payment</a></li>
                                    <!--<li><a href="<?=base_url()?>admin/Dashboard/rent_friend_payment" data-key="t-login">Rent Friend Payment</a></li>-->
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                     <i class="fa fa-list-ol"></i>
                                    <span>Subscription</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?=base_url()?>admin/Dashboard/subscription" data-key="t-login">Subscription</a></li>
                                    <!--<li><a href="<?=base_url()?>admin/Dashboard/friend_subscription" data-key="t-login">Rent Friend Subscription</a></li>-->
                                </ul>
                            </li>
                            
                           <!--<li>
                                <a href="javascript: void(0);" class="has-arrow">
                                     <i class="fa fa-box"></i>
                                    <span>Slider</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?=base_url()?>admin/Dashboard/sliders" data-key="t-login">Slider</a></li>
                                </ul>
                            </li>
                           
                           <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                     <i class="fa fa-quote-right"></i>
                                    <span>Faq</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?=base_url()?>admin/Dashboard/Faq" data-key="t-login">Faq</a></li>
                                </ul>
                            </li>
                           
                           <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                     <i class="fa fa-file"></i>
                                    <span>Pages</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?=base_url()?>admin/Dashboard/Page" data-key="t-login">Pages</a></li>
                                </ul>
                            </li>-->
                            
                            <li>
                                <a href="<?=base_url('/admin/Auth/logout')?>" class="has-arrow">
                                     <i class="mdi mdi-logout"></i>
                                    <span >Logout</span>
                                </a>
                                
                            </li>
                          

                        </ul>

                     
                    </div>
                    <!-- Sidebar -->
                    
                </div>
            </div>
            <!-- Left Sidebar End -->

            
