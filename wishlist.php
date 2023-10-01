<?php 
include 'function/functions.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wishlist | Sryahva Ent. Pvt. Ltd.</title>
    <meta name="keywords" content="">
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
        			<h1 class="page-title">Shopping <span>Wishlist</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Wishlist</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <table class="table table-wishlist table-mobile">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock Status</th>
                                <th>Qty.</th>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            if (isset($_SESSION['id'])) {
                                $ses_usr_id = $_SESSION['id'];
                                }else{
                                $ses_usr_id = 0;
                                }
                            $data = all_data("SELECT *, `phid`, (SELECT MIN(ph_dp) +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
                                  FROM tbl_product_dtl WHERE `product_id` = `phid`)
                                 AS DISPLAY_PRICE FROM tbl_wishlist
                                JOIN tbl_product_hdr ON tbl_wishlist.product_id = tbl_product_hdr.phid
                                WHERE user_id = '".$ses_usr_id."' && cart_status = 1 ");
                                if ($data['data']==true) {
                                    foreach ($data['all_data'] as $value) {

                                        // product id encdoing with custom formula
                                $encode_formula = encode($value['phid']);

                                $urlencode = base64_encode(urlencode($encode_formula.','.$ses_usr_id));
                                      
                             ?>
                            <tr>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="product.php?product=<?=$urlencode?>">
                                                <img src="product-images/<?=$value['ph_feature_img']?>" alt="Product image">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="product.php?product=<?=$urlencode?>"><?=$value['ph_title']?></a>
                                        </h3><!-- End .product-title -->
                                    </div><!-- End .product -->
                                </td>
                                <td class="price-col">&#8377 <?=$value['DISPLAY_PRICE']?></td>
                                <td class="stock-col"><span class="in-stock">In stock</span></td>
                                <td class="price-col"><?=$value['product_qty']?></td>
                                 <td class="price-col"><?=number_format($value['DISPLAY_PRICE']*$value['product_qty'],2)?></td>
                                <td class="action-col">
                                    <button class="btn btn-block btn-outline-primary-2" onclick="transfer_wishlist('<?=encode($value['cartid'])?>')"><i class="icon-cart-plus"></i>Add to Cart</button>
                                </td>
                                <td class="remove-col"><button class="btn-remove" onclick="product_remove_wishlist('<?=$encode_formula?>')"><i class="icon-close"></i></button></td>
                            </tr>

                        <?php } }else{ ?>
                            <tr>
                                <td colspan="4">No product found</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table><!-- End .table table-wishlist -->
                    <div class="wishlist-share">
                        <div class="social-icons social-icons-sm mb-2">
                            <label class="social-label">Share on:</label>
                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                            <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                        </div><!-- End .soial-icons -->
                    </div><!-- End .wishlist-share -->
                </div><!-- End .container -->
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
    
    <script>
        function transfer_wishlist(id){
		jQuery.ajax({
				url:'function/transfer_wishlist.php',
				type:'post',
				data:'product_id='+id,
				success:function(result){
				alert('Item transferred to cart');
				window.location.href="";
				}
			});
	}
    </script>
</body>
</html>