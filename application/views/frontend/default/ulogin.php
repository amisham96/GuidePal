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


    <!-- ================> login section start here <================== -->
    <section class="log-reg">
        <div class="top-menu-area">
            <div class="container">
                <div class="row">
                    <div class="top-header-area">
                        <div class="back">
                          <a href="<?=base_url()?>letsconnect" class="backto-home"><i class="fas fa-arrow-left"></i></a>  
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
                <div class="image image-log"></div>
                <div class="col-lg-7">
                    <div class="log-reg-inner">
                        <!--<div class="section-header inloginp">
                            <h2 class="title">Welcome to Guidepal</h2>
                        </div>-->
                        <div class="main-content inloginp">
                            <form action="<?=base_url()?>login/ulogin" method="post">
                                <div class="form-group">
                                    <label>Sign in using mobile number </label>
                                    <input type="number" name="mobile_no" id="mobile_no" class="my-form-control" placeholder="Enter your mobile number">
                                     <?php echo form_error('mobile_no', '<div class="error">', '</div>');?>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="default-btn"><span>Send otp</span></button>
                                </div>
                                <div class="or">
                                    <p>OR</p>
                                </div>
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
                                <div class="or-content">
                                    <p>Sign up with your email</p>
                                    <a href="<?=$url;?>" class="default-btn reverse"><img src="<?=base_url()?>assets/frontend/images/login/google.png" alt="google"> <span>Sign Up with Google</span></a>
                            
                                </div>
                            </form>
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