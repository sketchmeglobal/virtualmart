<?php 
include 'function/functions.php';

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
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">About us 2<span>Pages</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About us 2</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content pb-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="about-text text-center mt-3">
                                <h2 class="title text-center mb-2">Who We Are</h2><!-- End .title text-center mb-2 -->
                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, uctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. </p>
                                <img src="assets/images/about/about-2/signature.png" alt="signature" class="mx-auto mb-5">

                                <img src="assets/images/about/about-2/img-1.jpg" alt="image" class="mx-auto mb-6">
                            </div><!-- End .about-text -->
                        </div><!-- End .col-lg-10 offset-1 -->
                    </div><!-- End .row -->
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-sm-6">
                            <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-puzzle-piece"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Design Quality</h3><!-- End .icon-box-title -->
                                    <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero <br>eu augue.</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-4 col-sm-6 -->

                        <div class="col-lg-4 col-sm-6">
                            <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-life-ring"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Professional Support</h3><!-- End .icon-box-title -->
                                    <p>Praesent dapibus, neque id cursus faucibus, <br>tortor neque egestas augue, eu vulputate <br>magna eros eu erat. </p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-4 col-sm-6 -->

                        <div class="col-lg-4 col-sm-6">
                            <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-heart-o"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Made With Love</h3><!-- End .icon-box-title -->
                                    <p>Pellentesque a diam sit amet mi ullamcorper <br>vehicula. Nullam quis massa sit amet <br>nibh viverra malesuada.</p> 
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-4 col-sm-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->

                <div class="mb-2"></div><!-- End .mb-2 -->

                <div class="bg-image pt-7 pb-5 pt-md-12 pb-md-9" style="background-image: url(assets/images/backgrounds/bg-4.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 col-md-3">
                                <div class="count-container text-center">
                                    <div class="count-wrapper text-white">
                                        <span class="count" data-from="0" data-to="40" data-speed="3000" data-refresh-interval="50">41</span>k+
                                    </div><!-- End .count-wrapper -->
                                    <h3 class="count-title text-white">Happy Customer</h3><!-- End .count-title -->
                                </div><!-- End .count-container -->
                            </div><!-- End .col-6 col-md-3 -->

                            <div class="col-6 col-md-3">
                                <div class="count-container text-center">
                                    <div class="count-wrapper text-white">
                                        <span class="count" data-from="0" data-to="20" data-speed="3000" data-refresh-interval="50">20</span>+
                                    </div><!-- End .count-wrapper -->
                                    <h3 class="count-title text-white">Years in Business</h3><!-- End .count-title -->
                                </div><!-- End .count-container -->
                            </div><!-- End .col-6 col-md-3 -->

                            <div class="col-6 col-md-3">
                                <div class="count-container text-center">
                                    <div class="count-wrapper text-white">
                                        <span class="count" data-from="0" data-to="95" data-speed="3000" data-refresh-interval="50">97</span>%
                                    </div><!-- End .count-wrapper -->
                                    <h3 class="count-title text-white">Return Clients</h3><!-- End .count-title -->
                                </div><!-- End .count-container -->
                            </div><!-- End .col-6 col-md-3 -->

                            <div class="col-6 col-md-3">
                                <div class="count-container text-center">
                                    <div class="count-wrapper text-white">
                                        <span class="count" data-from="0" data-to="15" data-speed="3000" data-refresh-interval="50">15</span>
                                    </div><!-- End .count-wrapper -->
                                    <h3 class="count-title text-white">Awards Won</h3><!-- End .count-title -->
                                </div><!-- End .count-container -->
                            </div><!-- End .col-6 col-md-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .bg-image pt-8 pb-8 -->

                <div class="bg-light-2 pt-6 pb-7 mb-6">
                    <div class="container">
                        <h2 class="title text-center mb-4">Meet Our Consutants</h2><!-- End .title text-center mb-2 -->

                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="member member-2 text-center">
                                    <figure class="member-media">
                                        <img src="assets/images/team/about-2/member-1.jpg" alt="member photo">

                                        <figcaption class="member-overlay">
                                            <div class="social-icons social-icons-simple">
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title">Samanta Grey<span>Founder &amp; CEO</span></h3><!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="member member-2 text-center">
                                    <figure class="member-media">
                                        <img src="assets/images/team/about-2/member-2.jpg" alt="member photo">

                                        <figcaption class="member-overlay">
                                            <div class="social-icons social-icons-simple">
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title">Bruce Sutton<span>Sales &amp; Marketing Manager</span></h3><!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="member member-2 text-center">
                                    <figure class="member-media">
                                        <img src="assets/images/team/about-2/member-3.jpg" alt="member photo">

                                        <figcaption class="member-overlay">
                                            <div class="social-icons social-icons-simple">
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title">Janet Joy<span>Product Manager</span></h3><!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="member member-2 text-center">
                                    <figure class="member-media">
                                        <img src="assets/images/team/about-2/member-4.jpg" alt="member photo">

                                        <figcaption class="member-overlay">
                                            <div class="social-icons social-icons-simple">
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title">Mark Pocket<span>Product Manager</span></h3><!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="member member-2 text-center">
                                    <figure class="member-media">
                                        <img src="assets/images/team/about-2/member-5.jpg" alt="member photo">

                                        <figcaption class="member-overlay">
                                            <div class="social-icons social-icons-simple">
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title">Damion Blue<span>Sales &amp; Marketing Manager</span></h3><!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="member member-2 text-center">
                                    <figure class="member-media">
                                        <img src="assets/images/team/about-2/member-6.jpg" alt="member photo">

                                        <figcaption class="member-overlay">
                                            <div class="social-icons social-icons-simple">
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title">Lenard Smith<span>Product Manager</span></h3><!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="member member-2 text-center">
                                    <figure class="member-media">
                                        <img src="assets/images/team/about-2/member-7.jpg" alt="member photo">

                                        <figcaption class="member-overlay">
                                            <div class="social-icons social-icons-simple">
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title">Rachel Green<span>Product Manager</span></h3><!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="member member-2 text-center">
                                    <figure class="member-media">
                                        <img src="assets/images/team/about-2/member-8.jpg" alt="member photo">

                                        <figcaption class="member-overlay">
                                            <div class="social-icons social-icons-simple">
                                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            </div><!-- End .soial-icons -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title">David Doe<span>Product Manager</span></h3><!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-lg-3 -->
                        </div><!-- End .row -->

                        <div class="text-center mt-3">
                            <a href="blog.html" class="btn btn-sm btn-minwidth-lg btn-outline-primary-2">
                                <span>LETS START WORK</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .text-center -->
                    </div><!-- End .container -->
                </div><!-- End .bg-light-2 pt-6 pb-6 -->

                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="brands-text text-center mx-auto mb-6">
                                <h2 class="title">The world's premium design brands in one destination.</h2><!-- End .title -->
                            </div><!-- End .brands-text -->
                            <div class="brands-display">
                                <div class="row justify-content-center">
                                    <?php
                                        $sql3 = "SELECT * FROM vendors WHERE status=1";
                                        $vendors_data = all_data($sql3);
                                        foreach($vendors_data['all_data'] as $vd){
                                            // echo '<pre>',print_r($vendors_data), '</pre>';
                                            ?>
                                            <div class="col-6 col-sm-4 col-md-3">
                                                <a href="#" class="brand">
                                                    <img src="vendor-images/<?=$vd['logo']?>" alt="Brand Name">
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    
                                </div><!-- End .row -->
                            </div><!-- End .brands-display -->
                        </div><!-- End .col-lg-10 offset-lg-1 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main>

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