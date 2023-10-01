<?php 
include 'function/functions.php';

if(isset($_SESSION['id'])){
$ret_account_data = "SELECT * FROM tbl_order_hdr WHERE user_id = '".$_SESSION['id']."' ";

$ret_account_data_func = all_data($ret_account_data);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account | Sreyhva Ent. Pvt. Ltd.</title>
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
        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">My<span>Account</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Account</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="cart my-account">
	                <div class="container">
	                	<div class="row d-flex justify-content-center px-3">
	                		 
                             <?php if (isset($_SESSION['id'])) {
                           
                            if (!empty($ret_account_data_func['all_data'])) {
                                foreach($ret_account_data_func['all_data'] as $Pkey => $Pval){
                             ?>
                            <div class="col-md-6 card">
	                			<div class="row">
                                    <div class="col-sm-6">
                                    <span>Order ID: <b><?=$Pval['order_id']?></b></span> 
                                    <br>                                   
                                    <span>Date: <b><?= date("d M, Y - h:i:s", strtotime($Pval['added_on'])); ?></b></span>                                    
                                    </div>
                                    <div class=" col-sm-6 float-right">
                                        <span>Amount: <b><?=$Pval['pay_amnt']?></b></span>
                                        <br>
                                        <span>Status: <b>
                                            <?php
                                            if ($Pval['order_status']==1) {
                                                echo 'Order Plcaed';
                                            }elseif($Pval['order_status']==2){
                                                echo 'Order Delivered';
                                            }else{
                                                echo 'Order Cancelled';
                                            }
                                             ?>
                                            

                                        </b></span>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <a href="invoice.php?order=<?=$Pval['order_id']?>" class=""><b>Download Invoice</b></a>
                                    </div>
                                </div>
	                		</div><!-- End .col-md-6 end card -->
                        <?php } } else{
                             ?>

                             <div class="col-md-6 card">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="javaScript:void(0)">No order found</a>
                                    </div>
                                </div>
                            </div><!-- End .col-md-6 end card -->

                         <?php } }else{ ?>

                                               <div class="text-center">
                        <button href="#signin-modal" data-toggle="modal" class="btn btn-primary">SIGN IN</button>
                   </div>
               <?php } ?>
                        </div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

       <?php include 'cores/footer.php' ?>
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <?php include 'cores/mobile-nav.php'; ?>
    <!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <?php include 'cores/modal-signin.php'; ?>
    
    <!-- End .modal -->

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <?php include 'cores/footer-tag.php' ?>
</body>
</html>