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
        .agediv{
           display:none;    
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
                          <a href="<?=base_url()?>" class="backto-home"><i class="fas fa-arrow-left"></i></a>  
                        </div>
                        <div class="logo text-center">
                            <a href="<?=base_url()?>">
							<h2>Guidepal</h2>
							<!--<img src="assets/images/logo/logo.png" alt="logo">-->
							</a>
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
                <div class="image">
                </div>
                <div class="col-lg-7">
                    <div class="log-reg-inner">
                        <!--<div class="section-header">
                            <h2 class="title">Welcome to Guidepal</h2>
                            <p>Let's create your profile! Just fill in the fields below, and we’ll get a new account. </p>
                        </div>-->
                        <div class="main-content">
                            <form method="post" action="<?=base_url()?>login/register" enctype="multipart/form-data">
                                <!--<h4 class="content-title">Acount Details</h4>-->
                                <div class="form-group">
                                    <label>I am a*</label>
                                    <div class="banner__inputlist">
                                        <div class="s-input me-3">
                                            <input type="radio" name="usertype" id="guidepal" value="guidepal" checked>
                                            <label for="guidepal">Guidepal</label>
                                            
                                        </div>
                                        <div class="s-input">
                                            <input type="radio" name="usertype" id="rent_a_friend"  value="rent_a_friend">
                                            <label for="rent_a_friend">Rent as a Friend</label>
                                        </div>
                                    </div>
                                    <?php echo form_error('usertype', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>Name*</label>
                                    <input type="text" class="my-form-control" name="name" id="name" value="<?=set_value('name')?>" placeholder="Enter Your Name">
                                    <?php echo form_error('name', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>Gender*</label>
                                    <div class="banner__inputlist">
                                        <div class="s-input me-3">
                                            <input type="radio" name="gender" id="girl" value="girls">
                                            <label for="girl">Girls</label>
                                        </div>
                                        <div class="s-input me-3">
                                            <input type="radio" name="gender" id="boys"  value="boys">
                                            <label for="boys">Boys</label>
                                        </div>
                                        <!--<div class="s-input">
                                            <input type="radio" name="gender" id="other"  value="other">
                                            <label for="both">Other</label>
                                        </div>-->
                                    </div>
                                    <?php echo form_error('gender', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>Email*</label>
                                    <input type="email" class="my-form-control" name="email" id="email" value="<?=set_value('email')?>" placeholder="Enter Your Email">
                                    <?php echo form_error('email', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>Mobile no.*</label>
                                    <input type="number" class="my-form-control" name="mobile_no" id="mobile_no" value="<?=set_value('mobile_no')?>" placeholder="Enter Your Mobile no.">
                                    <?php echo form_error('mobile_no', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>Photo Upload*</label>
                                    <input type="file" class="my-form-control" name="photo" id="photo">
                                </div>
                                <div class="form-group">
                                    <label>Password*</label>
                                    <input type="password" class="my-form-control" name="password" id="password"  value="<?=set_value('password')?>" placeholder="Enter Your Password">
                                    <?php echo form_error('password', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group" id="agebox">
                                    <label>Age*</label>
                                    <input type="text" class="my-form-control" name="age" id="age" value="<?=set_value('age')?>" placeholder="Enter Your Age">
                                    <?php echo form_error('age', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>Country*</label>
                                    <select class="my-form-control" name="country" id="country">
                                      <option value="">Select Country</option>
                                      <?php foreach($country as $row){ ?>
                                       <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                      <?php } ?>
                                    </select>
                                    <?php echo form_error('country', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>State*</label>
                                    <select class="my-form-control" name="state" id="state">
                                      <option value="">Select State</option>   
                                    </select>
                                    <?php echo form_error('state', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>City*</label>
                                    <input type="text" class="my-form-control" name="city" id="city" value="<?=set_value('city')?>" placeholder="Enter Your City">
                                    <?php echo form_error('city', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>Aadhar number*</label>
                                    <input type="text" class="my-form-control" name="aadhar_num" id="aadhar_num" value="<?=set_value('aadhar_num')?>" placeholder="Enter Your Aadhar number">
                                    <?php echo form_error('aadhar_num', '<div class="error">', '</div>');?>
                                </div>
                                <div class="form-group">
                                    <label>Aadhar Image*</label>
                                    <input type="file" class="my-form-control" name="image" id="image">
                                </div>
                                
                               <!-- <div class="form-group">
                                    <label>Birthday*</label>
                                    <input type="date" class="my-form-control">
                                </div>
                                <div class="form-group">
                                    <label>I am a*</label>
                                    <div class="banner__inputlist">
                                        <div class="s-input me-3">
                                            <input type="radio" name="gender1" id="males1"><label for="males1">Man</label>
                                        </div>
                                        <div class="s-input">
                                            <input type="radio" name="gender1" id="females1"><label
                                                for="females1">Woman</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Looking for a*</label>
                                    <div class="banner__inputlist">
                                        <div class="s-input me-3">
                                            <input type="radio" name="gender2" id="males"><label for="males">Man</label>
                                        </div>
                                        <div class="s-input">
                                            <input type="radio" name="gender2" id="females"><label
                                                for="females">Woman</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Marial status*</label>
                                    <div class="banner__inputlist">
                                        <select>
                                            <option value="Single" selected>Single</option>
                                            <option value="Marid">Marid</option>
                                        </select>
                                    </div>
                                </div>-->
                                
                                <div class="text-center">
                                  <button type="submit" class="default-btn reverse"><span>Register</span></button>
                                </div>
                                
                                <div class="or-content pt-3">
                                    <p class="or-signup"> Already have an account?  <a href="<?=base_url()?>login">Sign in here</a></p>
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
	
	<script type='text/javascript'>
  // baseURL variable
  var baseURL= "<?php echo base_url();?>";
 
  $(document).ready(function(){
 
    // City change
    $('#country').change(function(){
      var country = $(this).val();

      // AJAX request
      $.ajax({
        url:'<?=base_url()?>Home/get_city',
        method: 'post',
        data: {country: country},
        dataType: 'json',
        success: function(response){

          // Remove options 
         // $('#sel_user').find('option').not(':first').remove();
          $('#state').find('option').not(':first').remove();

          // Add options
          $.each(response,function(index,data){
             $('#state').append('<option value="'+data['id']+'">'+data['name']+'</option>');
          });
        }
     });
   });
  });
</script>

<!--
<script>
const agebox = document.getElementById('agebox');

function handleRadioClick() {
  if (document.getElementById('rent_a_friend').checked) {
    agebox.style.display = 'block';
  } else {
    agebox.style.display = 'none';
  }
}

const radioButtons = document.querySelectorAll('input[name="usertype"]');
radioButtons.forEach(radio => {
  radio.addEventListener('click', handleRadioClick);
});    
</script>
-->

</body>
</html>