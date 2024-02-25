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
                          <a href="<?=base_url()?>user-login" class="backto-home"><i class="fas fa-arrow-left"></i></a>  
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
                        <div class="section-header inloginp">
                            <span id="timer"></span>
                            <p>Type the verification code <br> we`ve sent you</p>
                            <!--<h2 class="title">verify your otp</h2>-->
                        </div>
                        <div class="main-content inloginp">
                            <form action="<?=base_url()?>login/verify" method="post"> 
                                <div class="form-group">
                                   <!-- <label>Otp</label>-->
                                    <div class="verification-code">
                                     <input type="text" name="otp1" id="otp1" class="my-form-control" maxlength="1" style="height:65px;text-align:center;font-size:21px">
                                     <input type="text" name="otp2" id="otp2" class="my-form-control" maxlength="1" style="height:65px;text-align:center;font-size:21px">
                                     <input type="text" name="otp3" id="otp3" class="my-form-control" maxlength="1" style="height:65px;text-align:center;font-size:21px">
                                     <input type="text" name="otp4" id="otp4" class="my-form-control" maxlength="1" style="height:65px;text-align:center;font-size:21px">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="default-btn verifybtn"><span>verify</span></button>
                                </div>
                                <div class="resendotp">
                                   <a href="javascript:void(0)" id="resend" style="display:none" onClick="reSendOtpAjax()">resend otp</a>
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


	
<script>
let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  /*if(!timerOn) {
    // Do validate stuff here
    return;
  }*/
  
  // Do timeout stuff here
  //alert('Timeout for otp');
  //document.getElementById('timer').innerHTML=""
  ResendOtpCallFun()
}

timer(120); 

function ResendOtpCallFun(){
	if(timerOn == true){
			$('#resend').show()
	}
}

function reSendOtpAjax(){
	window.location.href = 'https://guidepal.maavaishodevitourstravels.in/verify';
	/*$.ajax({
       type: 'post',
       url: 'resend-otp',
        data:{},
       cache: false,
       success: function(data){
     
				if(data == 1){
					window.location.href = '';
				}
			 }
	});*/
 }
 
 //Code Verification
var verificationCode = [];
$(".verification-code input[type=text]").keyup(function (e) {
  
  // Get Input for Hidden Field
  $(".verification-code input[type=text]").each(function (i) {
    verificationCode[i] = $(".verification-code input[type=text]")[i].value; 
    $('#verificationCode').val(Number(verificationCode.join('')));
    //console.log( $('#verificationCode').val() );
  });

  //console.log(event.key, event.which);

  if ($(this).val() > 0) {
    if (event.key == 1 || event.key == 2 || event.key == 3 || event.key == 4 || event.key == 5 || event.key == 6 || event.key == 7 || event.key == 8 || event.key == 9 || event.key == 0) {
      $(this).next().focus();
    }
  }else {
    if(event.key == 'Backspace'){
        $(this).prev().focus();
    }
  }

}); // keyup

$('.verification-code input').on("paste",function(event,pastedValue){
  console.log(event)
  $('#txt').val($content)
  console.log($content)
  //console.log(values)
});

</script>



</body>
</html>