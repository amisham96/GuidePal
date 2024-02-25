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
    <section class="login-wrap log-reg">
        <div class="top-menu-area">
            <div class="container">
                <div class="row">
                    <div class="top-header-area">
                        <div class="back">
                          <a href="<?=base_url()?>register" class="backto-home"><i class="fas fa-arrow-left"></i></a>  
                        </div>
                        <div class="logo text-center">
                            <a href="<?=base_url()?>"><h2>Guidepal</h2><!--<img src="assets/images/logo/logo.png" alt="logo">--></a>
                        </div>
                    </div>
                    <!--<div class="col-lg-4 col-5">
                        <a href="<?=base_url()?>" class="backto-home"><i class="fas fa-chevron-left"></i> Back to Home</a>
                    </div>-->
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
                        <div class="main-content">
                            <form action="<?=base_url()?>login" method="post">
                                <div class="form-group">
                                    <div class="banner__inputlist">
                                        <div class="s-input me-3">
                                            <input type="radio" name="usertype" id="guidepal" value="guidepal">
                                            <label for="guidepal">Guidepal</label>
                                        </div>
                                        <div class="s-input">
                                            <input type="radio" name="usertype" id="rent_a_friend"  value="rent_a_friend">
                                            <label for="rent_a_friend">Rent as a Friend</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="my-form-control" placeholder="Enter Your Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="my-form-control" placeholder="Enter Your Password">
                                </div>
                                <!--<p class="f-pass">Forgot your password? <a href="#">recover password</a></p>-->
                                <div class="text-center">
                                    <button type="submit" class="default-btn"><span>Sign in</span></button>
                                </div>
                                <!--<div class="or">
                                    <p>OR</p>
                                </div>-->
                                <div class="or-content">
                                    <!--<p>Sign up with your email</p>
                                    <a href="#" class="default-btn reverse"><img src="<?=base_url()?>assets/frontend/images/login/google.png" alt="google"> <span>Sign Up with Google</span></a>-->
                                    <p class="or-signup"> Don't have an account? <a href="<?=base_url()?>register">Sign up here</a></p>
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
	<?php echo alertify_render( '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build', 'top-right' ); ?>
	
</body>
</html>