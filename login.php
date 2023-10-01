<?php
include 'function/functions.php';
//$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5(time().rand()));
$ref = isset($_GET['join']) ? $_GET['join'] : NULL;
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
		/*.form-box{width:800px;}*/
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
		<a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Become a Seller</a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
		<div class="joining-steps">
			<p class="text-center" > <strong>Become a seller, we need to verify with basic details. Please read carefully & update your details.</strong> </p>
			<ol class="ol">
				<li>Comapny Name<sup class="text-danger">*</sup></li>
				<li>Comapny Email<sup class="text-danger">*</sup></li>
				<li>Comapny Mobile<sup class="text-danger">*</sup></li>
				<li>Contact Person Name<sup class="text-danger">*</sup></li>
				<li>Contact Person Mobile<sup class="text-danger">*</sup></li>
				<li>Contact Person Email<sup class="text-danger">*</sup></li>
				<li>Contact Person PAN Card<sup class="text-danger">*</sup></li>
				<li>Contact Person Aadhaar Card<sup class="text-danger">*</sup></li>
				<li>Comapny GST<sup class="text-danger">-Optional</sup></li>
				<li>Company Trade License<sup class="text-danger">-Optional</sup></li>
				<li>Comapny Logo<sup class="text-danger">-Optional</sup></li>
			</ol>
			<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input check_points" id="first_check" required>
							<label class="custom-control-label" for="first_check">I have read all points<sup class="text-danger">*</sup></label>
							</div><!-- End .custom-checkbox -->
			<div class="text-center">
				<a href="javascript:void(0)" onclick="joining_steps()" class="btn btn-outline-primary-2 text-center">
					<span>CONTINUE</span>
					<i class="icon-long-arrow-right"></i>
				</a>
			</div>
		</div>
		<form id="vendor_reg_form" method="post" class="" enctype="multipart/form-data">
			<?php if (isset($_GET['log_stat'])) {
				echo '<p class="d-block text-center font-weight-bold">'.$_SESSION['msg'].'</p>';
			} ?>
			<div class="first-step" style="display: none;">
				<input type="hidden" value="<?=$_SESSION['token']?>" name="token">
				<input type="hidden" name="ref" value="<?=$ref?>">
				<p class="d-block text-center font-weight-bold text-danger">
					<?=(isset($_GET['log_stat']) == 'success') ? 'Thanks for connecting. Please Login to continue.' : ''?>
				</p>
				
				<div class="row">
					<div class="col">
						<label for="company_name">Company Name<sup class="text-danger">*</sup></label>
						<input type="text" class="form-control" id="company_name" name="company_name" required>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="company_mobile">Company Mobile<sup class="text-danger">*</sup></label>
						<input type="text" class="form-control" id="company_mobile" name="company_mobile" required>
					</div>
					<div class="col">
						<label for="company_mail">Company Mail Id<sup class="text-danger">*</sup></label>
						<input type="text" class="form-control" id="company_mail" name="company_mail" required>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="ufname">User First Name<sup class="text-danger">*</sup></label>
						<input type="text" class="form-control" id="ufname" name="ufname" required>
					</div>
					<div class="col">
						<label for="ulname">User Last Name</label>
						<input type="text" class="form-control" id="ulname" name="ulname" required>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="user_mobile">User Mobile<sup class="text-danger">*</sup></label>
						<input type="text" class="form-control" id="user_mobile" name="user_mobile" required>
					</div>
					<div class="col">
						<label for="user_mail">User Mail Id<sup class="text-danger">*</sup></label>
						<input type="text" class="form-control" id="user_mail" name="user_mail" required>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="vendor_password">Strong Password<sup class="text-danger">*</sup></label>
						<input type="password" class="form-control" id="vendor_password" name="vendor_password" required>
					</div>
					<div class="col">
						<label for="vendor_password">State<sup class="text-danger">*</sup></label>
						<select name="vendor_state" class="form-control" id="vendor_state">
							<?php $select_state = all_data('SELECT * FROM tbl_state ORDER BY state_name ASC');
							foreach($select_state['all_data'] as $state_val){?>
							<option value="<?=$state_val['state_tin_number']?>"><?=$state_val['state_name']?></option>
						<?php } ?>
						</select>
					</div>
				</div><!-- End .form-group -->
					<a href="javascript:void(0)" onclick="next_step()" class="btn btn-outline-primary-2">
						<span>NEXT </span>
						<i class="icon-long-arrow-right"></i>
					</a>
					<a href="javascript:void(0)" onclick="first_back()" class="btn btn-outline-success" style="float: right;">
						<i class="icon-long-arrow-left"></i>
						<span>BACK </span>
					</a>
				</div>
				<div class="second-step" style="display:none;">
					<div class="row">
						<div class="col">
							<label for="">Aadhaar Number<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="aadhaar_number" name="aadhaar_number" required placeholder="">
						</div>
						<div class="col">
							<label for="ulname">PAN Number<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="pan_number" name="pan_number" required placeholder="">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Aadhaar Front Side Picture<sup class="text-danger">*</sup></label>
							<input type="file" class="form-control" id="aadhaar_front" name="aadhaar_front" required>
						</div>
						<div class="col">
							<label for="">Aadhaar Back Side Picture<sup class="text-danger">*</sup></label>
							<input type="file" class="form-control" id="aadhaar_back" name="aadhaar_back" required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">PAN Picture<sup class="text-danger">*</sup></label>
							<input type="file" class="form-control" id="pan_pic" name="pan_pic" required>
						</div>
						<div class="col">
							<label for="">Trade license</label>
							<input type="file" class="form-control" id="trade_license" name="trade_license" >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">GST Number</label>
							<input type="text" class="form-control" id="gst_number" name="gst_number" placeholder="">
						</div>
						<div class="col">
							<label for="">GST File</label>
							<input type="file" class="form-control" id="" name="gst_file" placeholder="">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Company Address</label>
							<input type="text" class="form-control" id="vendor_address" name="vendor_address" placeholder="">
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
							<a href="javascript:void(0)" onclick="last_back()" class="btn btn-outline-info">
								<i class="icon-long-arrow-left"></i>
								<span>BACK </span>
							</a>
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
			<div class="row justify-content-center">
				<div class="col-10">
					<div class="row no-gutters bg-white newsletter-popup-content">
						<div class="col-xl-3-5col col-lg-7 banner-content-wrap">
							<div class="banner-content text-center">
								<img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
								<h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
								<p>Subscribe to the Sreyhva eCommerce newsletter to receive timely updates from your favorite products.</p>
								<form action="#">
									<div class="input-group input-group-round">
										<input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
										<div class="input-group-append">
											<button class="btn" type="submit"><span>go</span></button>
										</div>
									</div>
								</form>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="register-policy-2" required>
									<label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
									</div><!-- End .custom-checkbox -->
								</div>
							</div>
							<div class="col-xl-2-5col col-lg-5 ">
								<img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
							</div>
						</div>
					</div>
				</div>
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

<!-- vendor form ajax resource -->
<script type="text/javascript" src="assets/js/vendor.js?v=<?=time()?>"></script>

</body>
</html>