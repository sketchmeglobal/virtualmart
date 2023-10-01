<?php
include 'function/functions.php';
// product details based on parent category
if (isset($_GET['cat'])) {
$cat = $_GET['cat'];
$sql = "
SELECT
    `phid`,
    `ph_title`,
    `p_cat_id`,
    `p_cat_name`,
    `c_cat_id`,
    `c_cat_name`,
    `ph_shipping_charge`,
    `ph_short_desc`,
    `ph_desc`,
    `ph_feature_img`,
    `ph_status`,
    `show_trending_today`,
    `vendor_id`,
    `p_c_name`,
    `p_cid`,
    `ph_qty`,
    `ph_dp` + ROUND(
        (
        SELECT
            (
                (`ph_dp` * `admin_commission`) / 100
            )
        WHERE
            `phid` = `phid`
    ),
    2
    ) AS ph_price,
    `ph_price`+ ROUND(
        (
        SELECT
            (
                (`ph_price` * `admin_commission`) / 100
            )
        WHERE
            `phid` = `phid`
    ),
    2
    ) AS MRP
    
FROM
    tbl_product_hdr
    JOIN tbl_parent_category ON tbl_product_hdr.p_cat_id = tbl_parent_category.p_cid
 WHERE ph_status = 1 AND p_cat_id='".$_GET['cat']."'" ;
$all_products = all_data($sql)['all_data'];
// echo '<pre>', print_r($all_products), '</pre>';
}else{
header('location:index.php');
}
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
<h1 class="page-title">Filter your search &<span>shop</span></h1>
</div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
<div class="container">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Home</a></li>
<li class="breadcrumb-item"><a href="#">Search</a></li>
<li class="breadcrumb-item active text-uppercase" aria-current="page"><?=$_GET['q']?></li>
</ol>
</div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="page-content">
<div class="container">
<div class="row">
<div class="col-lg-9">
<div class="toolbox">
</div><!-- End .toolbox -->
<div class="products mb-3">
<div class="row justify-content-center">
<?php
if(isset($_SESSION['id'])){
$encode_ss_id = $_SESSION['id'];
}else{
$encode_ss_id = 0;
}
// token
$_SESSION['add_to_cart_token'] = sha1(md5(time()));
$_SESSION['add_to_wishlist_token'] = sha1(md5(time()));
$sess_user_id = encode($encode_ss_id);
//if(!empty($all_products['all_data'])){
foreach($all_products as $ap)
{
// product id encdoing with custom formula
$encode_formula = encode($ap['phid']);
$urlencode = base64_encode(urlencode($encode_formula.','.$sess_user_id));
?>
<div class="all-product-details col-6 col-md-4 col-lg-4 col-xl-3 cat-<?=$ap['c_cat_id']?>" id="">
<div class="product product-7 text-center border border-danger shadow-md">
<div id="wishlist_msg_<?=$encode_formula?>" style="display: none;background: #00ff9370;color: #000;">Item added to Wishlist</div>
<figure class="product-media">
<?php
if($ap['ph_qty'] == 0){
?>
<span class="product-label label-out">Out of Stock</span>
<?php
}else if($ap['show_trending_today']){
?>
<span class="product-label label-new">New</span>
<?php
}
?>
<a href="product.php?product=<?=$urlencode?>">
<img <?= ($ap['ph_qty']==0) ? 'style="filter: grayscale(100%)"' : '' ?> src="product-images/<?=$ap['ph_feature_img']?>" alt="Product image" class="product-image border-bottom">
</a>
<div class="product-action-vertical">
<?php
if (!isset($_SESSION['id'])) { ?>
<a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable" title="Add to wishlist" product="<?=$encode_formula?>" consultant="<?=$sess_user_id?>" type="wishlist"><span>add to wishlist</span></a>
<?php  } if(isset($_SESSION['id'])){ ?>
<input type="hidden" id="<?=$encode_formula?>_w_token" name="cart_token" value="<?=$_SESSION['add_to_wishlist_token']?>">
<input type="hidden" id="<?=$encode_formula?>_product_w" name="product" value="<?=$encode_formula?>">
<a href="javaScript:void(0)" id="<?=$encode_formula?>_w" title="Add to wishlist" class="btn-product-icon btn-wishlist btn-expandable <?=$encode_formula?>_addtocartbtn_w" onclick="add_to_wishlist('<?=$encode_formula?>')"><span>add to wishlist</span></a>
<?php } ?>
<!--<a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>-->
</div><!-- End .product-action-vertical -->
<div class="product-action">
<?php
// add to cart function. uing jquery cores/footer-tag.php
if (isset($_SESSION['id'])) { ?>
<input type="hidden" id="<?=$encode_formula?>_qty_product" value="1">
<input type="hidden" id="<?=$encode_formula?>_cart_token" name="cart_token" value="<?=$_SESSION['add_to_cart_token']?>">
<input type="hidden" id="<?=$encode_formula?>_product" name="product" value="<?=$encode_formula?>">
<input type="hidden" id="<?=$encode_formula?>_consultant" name="consultant" value="<?=$sess_user_id?>">
<a href="javaScript:void(0)"id="<?=$encode_formula?>_" class="btn-product btn-cart <?=$encode_formula?>_addtocartbtn" onclick="add_to_cart('<?=$encode_formula?>')"><span>add to cart</span></a>
<?php  } if(!isset($_SESSION['id'])){ ?>
<a href="#signin-modal" data-toggle="modal" class="btn-product btn-cart" product="<?=$encode_formula?>" consultant="<?=$sess_user_id?>" type="cart"><span>add to cart</span></a>
<?php } ?>
</div><!-- End .product-action -->
</figure><!-- End .product-media -->
<div class="product-body">
<div class="product-cat">
<p><?=$ap['c_cat_name']?> / <?=$ap['c_cat_name']?></p>
</div><!-- End .product-cat -->
<h3 class="product-title"><a class="h6" href="product.php?product=<?=$urlencode?>"><?=$ap['ph_title']?></a></h3><!-- End .product-title -->
<div class="product-price">
<span class="new-price">&#8377;<?=$ap['ph_price']?></span> &nbsp;<span class="old-price">&#8377;<s><?=$ap['MRP']?></s></span>
</div><!-- End .product-price -->
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
<span class="ratings-text">( 6 Reviews )</span>
</div><!-- End .rating-container -->
</div><!-- End .product-body -->
</div><!-- End .product -->
</div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
<?php
}
//} ?>
</div><!-- End .row -->
</div><!-- End .products -->
<nav aria-label="Page navigation">
<ul class="pagination justify-content-center">
<li class="page-item disabled">
<a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
<span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
</a>
</li>
<li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item-total">of 6</li>
<li class="page-item">
<a class="page-link page-link-next" href="#" aria-label="Next">
Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
</a>
</li>
</ul>
</nav>
</div><!-- End .col-lg-9 -->
<aside class="col-lg-3 order-lg-first">
<div class="sidebar sidebar-shop">
<div class="widget widget-clean">
<label>Filters:</label>
<a href="#" class="sidebar-filter-clear">Clean All</a>
</div><!-- End .widget widget-clean -->
<div class="widget widget-collapsible">
<h3 class="widget-title">
<a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
Sub - Category
</a>
</h3><!-- End .widget-title -->
<div class="collapse show" id="widget-1">
<div class="widget-body">
<div class="filter-items filter-items-count">
<?php
$all_sub_categories = "SELECT * FROM `tbl_child_category` WHERE `tc_parent_cat_id` = ".$_GET['cat']." AND `tc_status` = 1 ORDER BY tc_name";
$sc_data = (all_data($all_sub_categories)['all_data']);
foreach($sc_data as $scd){
?>
<!--fetch no of items in each subcategory-->
<?php
$sql_count = "SELECT * FROM tbl_product_hdr WHERE c_cat_id =".$scd['tccid'];
$sc_items = check($sql_count);
?>
<div class="filter-item">
<div class="custom-control custom-checkbox">
    <input type="checkbox" <?=($sc_items['count'] == '') ? 'disabled' : ''?> class="custom-control-input" id="cat-<?=$scd['tccid']?>">
    <label class="custom-control-label" for="cat-<?=$scd['tccid']?>"><?=$scd['tc_name']?></label>
    </div><!-- End .custom-checkbox -->
    <span class="item-count"><?=($sc_items['count'] != '') ? $sc_items['count'] : '0' ?></span>
</div>
<?php
}
?>
</div><!-- End .filter-items -->
</div><!-- End .widget-body -->
</div><!-- End .collapse -->
</div><!-- End .widget -->
<div class="widget widget-collapsible">
    <h3 class="widget-title">
    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
        Colour
    </a>
    </h3><!-- End .widget-title -->
    <div class="collapse show" id="widget-3">
        <div class="widget-body">
            <div class="filter-colors">
                <a href="#" style="background: #b87145;"><span class="sr-only">Color Name</span></a>
                <a href="#" style="background: #f0c04a;"><span class="sr-only">Color Name</span></a>
                <a href="#" style="background: #333333;"><span class="sr-only">Color Name</span></a>
                <a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>
                <a href="#" style="background: #3399cc;"><span class="sr-only">Color Name</span></a>
                <a href="#" style="background: #669933;"><span class="sr-only">Color Name</span></a>
                <a href="#" style="background: #f2719c;"><span class="sr-only">Color Name</span></a>
                <a href="#" style="background: #ebebeb;"><span class="sr-only">Color Name</span></a>
                </div><!-- End .filter-colors -->
                </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
                </div><!-- End .widget -->
                <div class="widget widget-collapsible">
                    <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                        Vendor
                    </a>
                    </h3><!-- End .widget-title -->
                    <div class="collapse show" id="widget-4">
                        <div class="widget-body">
                            <div class="filter-items">
                                <?php
                                $all_sub_vendors = "SELECT vendors.id,vendors.company_name FROM `tbl_product_hdr`
                                INNER JOIN vendors ON vendors.id = tbl_product_hdr.vendor_id WHERE p_cat_id = ".$_GET['cat']." ORDER BY vendors.company_name";
                                $vendor_data = (all_data($all_sub_vendors)['all_data']);
                                // print_r($vendor_data);
                                foreach($vendor_data as $vd){
                                ?>
                                <div class="filter-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cat-<?=$vd['id']?>">
                                        <label class="custom-control-label" for="cat-<?=$vd['id']?>"><?=$vd['company_name']?></label>
                                        </div><!-- End .custom-checkbox -->
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                    </div><!-- End .widget -->
                                    </div><!-- End .sidebar sidebar-shop -->
                                    </aside><!-- End .col-lg-3 -->
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
                                    <script>
                                    $("#widget-1 input[type=checkbox]").on('click',function(){
                                    $class = $(this).attr('id')
                                    $('.all-product-details').each(function() {
                                    if($(".filter-item input[type=checkbox]").is(':checked')){
                                    if(!$(this).hasClass($class)){
                                    $(this).hide(0);
                                    }
                                    }else{
                                    $(this).show(100);
                                    }
                                    });
                                    })
                                    </script>
                                </body>
                            </html>