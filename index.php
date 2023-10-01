<?php
include 'function/functions.php';
// Home image
$sql = "SELECT position,front_image, p_c_name, p_cid FROM `tbl_front_images` LEFT JOIN tbl_parent_category ON tbl_front_images.category=tbl_parent_category.p_cid WHERE position='Left'";
$sql1 = "SELECT position,front_image, p_c_name, p_cid FROM `tbl_front_images` LEFT JOIN tbl_parent_category ON tbl_front_images.category=tbl_parent_category.p_cid WHERE position='Right'";
$sql2 = "SELECT position,front_image, p_c_name, p_cid FROM `tbl_front_images` LEFT JOIN tbl_parent_category ON tbl_front_images.category=tbl_parent_category.p_cid WHERE position='Bottom'";
$left_images = single_data($sql)['all_data'];
$right_images = single_data($sql1)['all_data'];
$bottom_images = single_data($sql2)['all_data'];
// home images ends
$sql3 = "SELECT * FROM vendors WHERE status=1";
$vendors_data = all_data($sql3);
// echo '<pre>',print_r($vendors_data), '</pre>'; die;
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
<?php include 'cores/head-tag.php'; ?>
</head>
<body>
<?php include 'cores/body-tag.php' ?>
<div class="page-wrapper">
<?php include 'cores/nav.php' ?>
<!-- End .header -->
<main class="main">
<div class="mb-lg-2"></div><!-- End .mb-lg-2 -->
<div class="container-fluid">
<div class="row d-flex">
<div class="col-md-6 col-xl-2 order-1">
<div class="banner banner-overlay banner-content-stretch ">
<a href="search-result.php?cat=<?=$left_images['p_cid']?>&q=<?=$left_images['p_c_name']?>">
<img src="slider-images/<?=$left_images['front_image']?>" alt="Banner img desc">
</a>
<div class="banner-content text-right">
<a href="search-result.php?cat=<?=$left_images['p_cid']?>&q=<?=$left_images['p_c_name']?>" class="btn btn-custom">
<span>Discover Now</span>
<i class="icon-long-arrow-right"></i>
</a>
</div><!-- End .banner-content -->
</div><!-- End .banner banner-overlay -->
</div><!-- End .col-xl-3 col-xxl-2 -->
<div class="col-xl-8 order-3 order-xl-2">
<div class="intro-slider-container slider-container-ratio mb-2">
<div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
"autoPlay" : 5000,
"stopOnHover" : false,
"nav": false,
"dots": true
}'>

<?php
$sql = "SELECT tbl_slider.*, tbl_parent_category.p_c_name FROM `tbl_slider` LEFT JOIN tbl_parent_category ON tbl_slider.category=tbl_parent_category.p_cid";
$slider_data = all_data($sql)['all_data'];
// echo '<pre>',print_r($slider_data), '</pre>';
foreach($slider_data as $sd){
?>
<div class="intro-slide">
<figure class="slide-image">
<picture>
<source media="(max-width: 480px)" srcset="slider-images/<?=$sd['slider_image']?>">
<img src="slider-images/<?=$sd['slider_image']?>" alt="Image Desc">
</picture>
</figure><!-- End .slide-image -->

<div class="intro-content">
<h3 class="intro-subtitle"><?=$sd['p_c_name']?></h3><!-- End .h3 intro-subtitle -->
<h1 class="intro-title text-white">
<?=$sd['header']?>
</h1><!-- End .intro-title -->

<div class="intro-text text-white">
<?=$sd['muted_text']?>
</div><!-- End .intro-text -->

<a href="https://sketchmeglobal.com/404.html/" class="btn btn-custom">
<span><?=$sd['button_label']?></span>
<i class="icon-long-arrow-right"></i>
</a>
</div><!-- End .intro-content -->
</div><!-- End .intro-slide -->
<?php
}
?>

</div><!-- End .intro-slider owl-carousel owl-simple -->
<span class="slider-loader"></span><!-- End .slider-loader -->
</div><!-- End .intro-slider-container -->
</div><!-- End .col-xl-9 col-xxl-10 -->
<div class="col-md-6 col-xl-2 order-2 order-xl-3">
<div class="banner banner-overlay  banner-content-stretch ">
<a href="search-result.php?cat=<?=$right_images['p_cid']?>&q=<?=$right_images['p_c_name']?>">
<img src="slider-images/<?=$right_images['front_image']?>" alt="Banner img desc">
</a>
<div class="banner-content text-right">
<a href="search-result.php?cat=<?=$right_images['p_cid']?>&q=<?=$right_images['p_c_name']?>" class="btn btn-custom">
<span>Discover Now</span>
<i class="icon-long-arrow-right"></i>
</a>
</div><!-- End .banner-content -->
</div><!-- End .banner banner-overlay -->
</div><!-- End .col-xl-3 col-xxl-2 -->
</div><!-- End .row -->
</div><!-- End .container-fluid -->
<div class="container-fluid">
<div class="row p-3 mb-2">

<div class="owl-carousel owl-simple brands-carousel" data-toggle="owl"
data-owl-options='{
"autoPlay" : 5000,
"stopOnHover" : false,
"nav": false,
"dots": false,
"margin": 20,

"loop": false,
"responsive": {
"0": {
"items":2
},
"420": {
"items":3
},
"600": {
"items":4
},
"900": {
"items":5
},
"1600": {
"items":6,
"nav": true
}
}
}'>

<?php
foreach($vendors_data['all_data'] as $vd){
// echo '<pre>',print_r($vendors_data), '</pre>';
?>
<a href="#" class="brand">
<img src="vendor-images/<?=$vd['logo']?>" alt="Brand Name">
</a>
<?php
}
?>
</div><!-- End .owl-carousel -->
</div>
</div>
<div class="container-fluid">

<div class="row d-flex justify-content-center">
<a href="search-result.php?cat=<?=$bottom_images['p_cid']?>&q=<?=$bottom_images['p_c_name']?>" class="w-100">
<img class="w-100" src="slider-images/<?=$bottom_images['front_image']?>" alt="Banner img desc">
</a>
</div>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-xl-12">

<div class="bg-lighter trending-products">
<?php include 'cores/today-trending.php' ?>
</div>
<div class="mb-5"></div><!-- End .mb-5 -->
<div class="icon-boxes-container bg-white">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 col-lg-3">
<div class="icon-box icon-box-side">
<span class="icon-box-icon text-dark">
<i class="icon-rocket"></i>
</span>
<div class="icon-box-content">
<h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
<p>Orders $50 or more</p>
</div><!-- End .icon-box-content -->
</div><!-- End .icon-box -->
</div><!-- End .col-sm-6 col-lg-3 -->
<div class="col-sm-6 col-lg-3">
<div class="icon-box icon-box-side">
<span class="icon-box-icon text-dark">
<i class="icon-rotate-left"></i>
</span>
<div class="icon-box-content">
<h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
<p>Within 30 days</p>
</div><!-- End .icon-box-content -->
</div><!-- End .icon-box -->
</div><!-- End .col-sm-6 col-lg-3 -->
<div class="col-sm-6 col-lg-3">
<div class="icon-box icon-box-side">
<span class="icon-box-icon text-dark">
<i class="icon-info-circle"></i>
</span>
<div class="icon-box-content">
<h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
<p>When you sign up</p>
</div><!-- End .icon-box-content -->
</div><!-- End .icon-box -->
</div><!-- End .col-sm-6 col-lg-3 -->
<div class="col-sm-6 col-lg-3">
<div class="icon-box icon-box-side">
<span class="icon-box-icon text-dark">
<i class="icon-life-ring"></i>
</span>
<div class="icon-box-content">
<h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
<p>24/7 amazing services</p>
</div><!-- End .icon-box-content -->
</div><!-- End .icon-box -->
</div><!-- End .col-sm-6 col-lg-3 -->
</div><!-- End .row -->
</div><!-- End .container-fluid -->
</div><!-- End .icon-boxes-container -->
<div class="mb-5"></div><!-- End .mb-5 -->
</div><!-- End .col-lg-9 col-xxl-10 -->
</div><!-- End .row -->
</div><!-- End .container-fluid -->
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
<?php include 'cores/footer-tag.php' ?>
</body>
</html>