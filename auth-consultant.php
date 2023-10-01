<?php
include 'function/functions.php';
//$_SESSION['msg']='';

if (isset($_POST['insert'])) {
extract($_POST);
if ($regtoken == $_SESSION['regtoken_consultant']) {
    $ins = register($Fname,$Lname,$mobile,$email,$password,'CONSULTANT');
    if ($ins['status']==true) {
        //echo '<script>window.location.href="";</script>';
    }else{
        echo '<script>alert("Account not registered");window.location.href="";</script>';
    }
}else{
    echo '<script>alert("Please try again");window.location.href="";</script>';
}
}

$_SESSION['regtoken_consultant'] = sha1(rand());
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Sryahva Ent. Pvt. Ltd.</title>
		<meta name="keywords" content="HTML5 Template">
		<meta name="description" content="Sreyhva - Bootstrap eCommerce Template">
		<meta name="author" content="p-themes">
		<!-- Favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
		<link rel="manifest" href="assets/images/icons/site.html">
		<link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
		<link rel="shortcut icon" href="assets/images/icons/favicon.ico">
		<meta name="apple-mobile-web-app-title" content="Sreyhva">
		<meta name="application-name" content="Sreyhva">
		<meta name="msapplication-TileColor" content="#cc9966">
		<meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
		<link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
		<!-- Plugins CSS File -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
		<link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
		<!-- Main CSS File -->
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/skins/skin-demo-14.css">
		<link rel="stylesheet" href="assets/css/demos/demo-14.css">
		<style type="text/css">
			.ol{
				list-style: auto !important;
			}
		</style>
		<?php include 'cores/head-tag.php'; ?>
		<style>
		
		</style>
	</head>
	<body>
		<?php include 'cores/body-tag.php' ?>
		<div class="page-wrapper">
			<?php include 'cores/nav.php' ?>
			<!-- End .header -->
<main class="main">
<div class="mb-lg-2"></div><!-- End .mb-lg-2 -->
<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
<div class="container">
<div class="form-box">
<div class="form-tab">
<ul class="nav nav-pills nav-fill" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Become a Consultant</a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
		<form action="" method="post" class="" enctype="multipart/form-data">
		    <input type="hidden" name="regtoken" value="<?php echo $_SESSION['regtoken_consultant']; ?>">
			<?php if (isset($_GET['log_stat'])) {
				echo '<p class="d-block text-center font-weight-bold">'.$_GET['log_stat'].'</p>';
			} ?>
			<div class="second-step">
					<div class="row">
						<div class="col">
							<label for="">First Name<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="Fname" name="Fname" required placeholder="">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Last Name<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="Lname" name="Lname" required placeholder="">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Mobile<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="mobile" name="mobile" required placeholder="">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Email Address<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="email" name="email" placeholder="">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Password<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="password" name="password" placeholder="">
						</div>
					</div>
					
					<div class="form-footer">
						<button name="insert" type="submit" class="btn btn-outline-primary-2">
						<span>SIGN UP</span>
						<i class="icon-long-arrow-right"></i>
						</button>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="register-policy-2" required>
							<label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
							</div><!-- End .custom-checkbox -->
							</div><!-- End .form-footer -->
						
						</div>
						
					</form>
					</div><!-- .End .tab-pane -->
					</div><!-- End .tab-content -->
					</div><!-- End .form-tab -->
					</div><!-- End .form-box -->
					</div><!-- End .container -->
					</div><!-- End .login-page section-bg -->
					</main><!-- End .main -->
					<?php include 'cores/footer.php' ?>
					<!-- End .footer -->
					</div><!-- End .page-wrapper -->
					<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
					<!-- Mobile Menu -->
					<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->
					<?php include 'cores/mobile-nav.php'; ?>
					<!-- End .mobile-menu-container -->
					<!-- Sign in / Register Modal -->
					<?php include 'cores/modal-signin.php'; ?>
					<!-- End .modal -->
					<div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
			</div>
						<!-- Plugins JS File -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.hoverIntent.min.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/superfish.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/bootstrap-input-spinner.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.plugin.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>
<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script src="assets/js/demos/demo-14.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php include 'cores/footer-tag.php' ?>


</body>
</html>