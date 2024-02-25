<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<title>Guidepal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- site favicon -->
	<link rel="icon" type="image/png" href="assets/images/favicon.png">
	<!-- Place favicon.ico in the root directory -->

	<!-- All stylesheet and icons css  -->
	<link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/animate.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/all.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/swiper.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/lightcase.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/style.css">
    
    <style>
        .error{
          color:red;    
        }
    </style>
</head>

<body>
	<!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
	<!-- preloader ending here -->

	<!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="fa-solid fa-angle-up"></i></a>
    <!-- scrollToTop ending here -->


    <!-- ================> Lets connect section start here <================== -->
    <section class="lets-connect">
        <div class="top-menu-area">
            <div class="container">
                <div class="row">
                    <div class="top-header-area">
                        <div class="back">
                          <a href="<?=base_url()?>" class="backto-home"><i class="fas fa-arrow-left"></i></a>  
                        </div>
                        <div class="logo text-center">
                            <a href="<?=base_url()?>"><h2>Guidepal</h2><!--<img src="assets/images/logo/logo.png" alt="logo">--></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="connect-inner">
                        <div class="section-header">
                            <div class="img_area">
                               <img src="<?=base_url()?>uploads/group.png" alt="group.png"> 
                            </div>
                            <h2 class="title">let's meeting new <br>people around you</h2>
                        </div>
                        <div class="main-content">
                                <?php
				                 $clientId = '990468118259-uklqtsiobjofsr7gj8mbsf8khvmt1uks.apps.googleusercontent.com'; //Google client ID
            		             $clientSecret = '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'; //Google client secret
            		             $redirectURL = base_url().'login/google_login';
            		
            		             $gClient = new Google_Client();
            		             $gClient->setApplicationName('guidepal');
            		             $gClient->setClientId($clientId);
            		             $gClient->setClientSecret($clientSecret);
            		             $gClient->setRedirectUri($redirectURL);
            		             $google_oauthV2 = new Google_Oauth2Service($gClient);
            		             if ($gClient->getAccessToken()) {} 
            		             else 
            		             {
                                  $url = $gClient->createAuthUrl();
                        
                                 }
				                ?>
                                <div class="log_info">
                                    <a href="<?=base_url()?>user-login" class="connect-btn reverse phone-log_btn">
                                      <div class="phone_icon">    
                                        <img src="<?=base_url()?>assets/frontend/images/login/phone.svg" alt="phone"> 
                                      </div>  
                                      <div class="phone_text">
                                        <span>Login with phone</span>
                                      </div>    
                                    </a>
                                    <a href="<?=$url;?>" class="connect-btn reverse google-log_btn">
                                      <div class="google_icon">    
                                        <img src="<?=base_url()?>assets/frontend/images/login/google.png" alt="google"> 
                                      </div>  
                                      <div class="google_text">
                                        <span>Login with Google</span>
                                      </div>    
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================> login section end here <================== -->

	
	

	<!-- All Needed JS -->
	<script src="<?=base_url()?>assets/frontend/js/vendor/jquery-3.6.0.min.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/vendor/modernizr-3.11.2.min.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/isotope.pkgd.min.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/swiper.min.js"></script>
	<!-- <script src="assets/js/all.min.js"></script> -->
	<script src="<?=base_url()?>assets/frontend/js/wow.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/counterup.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/jquery.countdown.min.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/lightcase.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/waypoints.min.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/vendor/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/plugins.js"></script>
	<script src="<?=base_url()?>assets/frontend/js/main.js"></script>
</body>
</html>