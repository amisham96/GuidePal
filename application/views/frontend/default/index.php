<!DOCTYPE html>
<html lang="en">
<head>

	<title>Guidepal</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="" />

	<meta name="keywords" content=""/>
	<meta name="description" content="" />
	<link name="favicon" type="image/x-icon" href="" rel="shortcut icon" />
	<?php include 'includes_top.php';?>

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
    
	<div class="page-wrapper">
     <h1 class="d-none">Guidepal</h1>
		<?php
		if ($this->session->userdata('ulogin_id') || $this->session->userdata('glogin_id') || $this->session->userdata('flogin_id') ) {
			include 'logged_in_header.php';
		}else {
			include 'logged_out_header.php';
		}

		/*if(get_frontend_settings('cookie_status') == 'active'):
			include 'eu-cookie.php';
		endif;*/
		
		include $page_name.'.php';
		include 'footer.php';
		include 'includes_bottom.php';
		include 'modal.php';
	//	include 'common_scripts.php';
		?>
	</div>
</body>
</html>
