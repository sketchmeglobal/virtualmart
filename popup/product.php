<?php 
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/
include 'function/functions.php';
$url_decod = urldecode(base64_decode($_GET['product']));

$product_id_explode = explode(',',$url_decod);

// token
$_SESSION['add_to_cart_token'] = sha1(md5(time()));
$_SESSION['add_to_wishlist_token'] = sha1(md5(time()));


$encode_pid = $product_id_explode[0];
$pid = decode($product_id_explode[0]); // decode product id. from functions.php


// url user id
$url_encode_user_id = $product_id_explode[1];
$url_decode_user_id = decode($url_encode_user_id);

//print_r($product_id_explode); die();

// consultant id 
$consultant_id = $product_id_explode[1];



if (isset($_SESSION['id'])) {
    $encode_sess_user_id = encode($_SESSION['id']);
    $decode_sess_user_id = decode($encode_sess_user_id);


    // check session user consultant type
    $cons_user_type = "SELECT * FROM users WHERE id = '".$_SESSION['id']."' ";
    $func_sess_ret = single_data($cons_user_type);

    // if my id & url id is same then stop

    if ($url_encode_user_id != $encode_sess_user_id) {
        // if my id is consultant, then update url
        if ($func_sess_ret['all_data']['user_type']=='CONSULTANT') {
            $urlencode = base64_encode(urlencode($encode_pid.','.$encode_sess_user_id));
            header('location:product.php?product='.$urlencode);
        }

        // check url user consultant
        $url_user_type = "SELECT * FROM users WHERE id = '".$url_decode_user_id."' ";
        $func_url_usr_ret = single_data($url_user_type);

        //print_r($url_decode_user_id); die();

        // if url user id is consultant, then update consultant id
        if ($func_url_usr_ret['all_data']['user_type']=='CONSULTANT') {
            $consultant_id = encode($func_url_usr_ret['all_data']['id']);
        }
    }


}





//print_r($pid); die();
// chekc if int, then stay, otherwise, get lost
if (intval($pid)) {

// ret product_hdr data

$product_data_sql = "SELECT * FROM tbl_product_hdr 
JOIN tbl_parent_category ON tbl_product_hdr.p_cat_id = tbl_parent_category.p_cid 
WHERE tbl_product_hdr.phid = '$pid'";
$product_data_fun = single_data($product_data_sql);

//$product_data = $product_data_fun['all_data'];


//print_r($product_data_fun['all_data']);

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
<title>Product | Sryahva Ent. Pvt. Ltd.</title>
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

<!-- img zoom -->
<!--<link rel="stylesheet" type="text/css" href="https://jquery.app/jqueryscripttop.css">-->
<!--<link rel="stylesheet" type="text/css" href="assets/css/image-zoom.css">-->

<!--image zoom new-->

<?php include 'cores/head-tag.php'; ?>
</head>

<body>
<?php include 'cores/body-tag.php' ?>
<div class="page-wrapper">
<?php include 'cores/nav.php' ?>
<main class="main">
<div class="py-3"></div>
<div class="page-content">
<div class="container">
    <div class="product-details-top">
        <div class="row">
            <div class="col-md-6">
                
                <img id="img_01" class="w-100 position-relative d-block mx-auto" src="https://static.toiimg.com/photo/80482429.cms?imgsize=92297" data-zoom-image="https://static.toiimg.com/photo/80482429.cms?imgsize=92297"/>

                <div id="gal1" class="d-flex justify-content-around">
                
                    <a href="#" data-image="assets/images/products/single/1-small.jpg" data-zoom-image="assets/images/products/single/1-small.jpg">
                        <img id="img_01" src="assets/images/products/single/1-small.jpg"/>
                    </a>
                
                    <a href="#" data-image="assets/images/products/single/2-small.jpg" data-zoom-image="assets/images/products/single/2-small.jpg">
                        <img id="img_01" src="assets/images/products/single/2-small.jpg"/>
                    </a>
                
                    <a href="#" data-image="assets/images/products/single/3-small.jpg" data-zoom-image="assets/images/products/single/3-small.jpgjpg">
                        <img id="img_01" src="assets/images/products/single/3-small.jpg"/>
                    </a>
                
                    <a href="#" data-image="assets/images/products/single/4-small.jpg" data-zoom-image="assets/images/products/single/4-small.jpg">
                        <img id="img_01" src="assets/images/products/single/4-small.jpg"/>
                    </a>
                
                </div>

                
            </div><!-- End .col-md-6 -->
        
            <div class="col-md-6">
        <div class="product-details">
        <h1 class="product-title"><?=$product_data_fun['all_data']['ph_title']?></h1><!-- End .product-title -->
        
        <div class="ratings-container">
        <div class="ratings">
        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
        </div><!-- End .ratings -->
        <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
        </div><!-- End .rating-container -->
        
        <div class="product-price">
        &#8377;<?=number_format($product_data_fun['all_data']['ph_price'])?>
        </div><!-- End .product-price -->
        
        <div class="product-content">
        <?=$product_data_fun['all_data']['ph_short_desc']?>
        </div><!-- End .product-content -->
        
        <!-- <div class="details-filter-row details-row-size">
        <label>Color:</label>
        
        <div class="product-nav product-nav-thumbs">
        <a href="#" class="active">
        <img src="assets/images/products/single/1-thumb.jpg" alt="product desc">
        </a>
        <a href="#">
        <img src="assets/images/products/single/2-thumb.jpg" alt="product desc">
        </a>
        </div>
        </div> -->
        
        
        <!-- <div class="details-filter-row details-row-size">
        <label for="size">Size:</label>
        <div class="select-custom">
        <select name="size" id="size" class="form-control">
        <option value="#" selected="selected">Select a size</option>
        <option value="s">Small</option>
        <option value="m">Medium</option>
        <option value="l">Large</option>
        <option value="xl">Extra Large</option>
        </select>
        </div>
        
        <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
        </div>-->
        <!-- End .details-filter-row -->
        
        <div class="details-filter-row details-row-size">
        <label for="qty">Qty:</label>
        <div class="product-details-quantity">

            
        <input type="hidden" id="<?=$encode_pid?>_cart_token" name="cart_token" value="<?=$_SESSION['add_to_cart_token']?>">
        
        <input type="hidden" id="<?=$encode_pid?>_product" name="product" value="<?=$encode_pid?>">
        <input type="hidden" id="<?=$encode_pid?>_consultant" name="consultant" value="<?=$consultant_id?>">
        <input type="number" name="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required id="<?=$encode_pid?>_qty_product">
        <input type="hidden" id="<?=$encode_pid?>_cart_token" name="cart_token" value="<?=$_SESSION['add_to_cart_token']?>">
        </div><!-- End .product-details-quantity -->
        </div><!-- End .details-filter-row -->
        
        <div class="product-details-action">
        <?php if (isset($_SESSION['id'])) { ?>
        
        
        <a href="javaScript:void(0)" id="<?=$encode_pid?>_" class="btn-product btn-cart <?=$encode_pid?>_addtocartbtn" title="Add to cart" onclick="add_to_cart('<?=$encode_pid?>')"><span>add to cart</span></a>
        
        <?php } if(!isset($_SESSION['id'])){ ?>
        <a href="#signin-modal" data-toggle="modal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
        <?php } ?>
        
        <div class="details-action-wrapper">
        <?php if (isset($_SESSION['id'])) { ?>
        
        <input type="hidden" id="<?=$encode_pid?>_w_token" name="cart_token" value="<?=$_SESSION['add_to_wishlist_token']?>">
        
        <input type="hidden" id="<?=$encode_pid?>_product_w" name="product" value="<?=$encode_pid?>">
        
        <a href="javaScript:void(0)" id="<?=$encode_pid?>_w" class="btn-product btn-wishlist p-3 px-5 <?=$encode_pid?>_addtocartbtn_w" title="Wishlist" onclick="add_to_wishlist('<?=$encode_pid?>')"><span>Add to Wishlist</span></a>
        <?php } ?>
        
        <?php if (!isset($_SESSION['id'])) { ?>
        <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist p-3 px-5" title="Wishlist"><span>Add to Wishlist</span></a>
        <?php } ?>
        
        </div><!-- End .details-action-wrapper -->
        </div><!-- End .product-details-action -->
        
        <div class="product-details-footer">
        <div class="product-cat">
        <span>Category:</span>
        <a href="#"><?=$product_data_fun['all_data']['p_c_name']?></a>
        </div><!-- End .product-cat -->
        
        <div class="social-icons social-icons-sm">
        <span class="social-label">Share:</span>
        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
        </div>
        </div><!-- End .product-details-footer -->
        </div><!-- End .product-details -->
        </div><!-- End .col-md-6 -->
        </div><!-- End .row -->
    
    </div><!-- End .product-details-top -->

    <div class="product-details-tab">
<ul class="nav nav-pills justify-content-center" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
</li>
<!-- <li class="nav-item">
<a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
</li> -->
<li class="nav-item">
<a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
</li>
<li class="nav-item">
<a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
<div class="product-desc-content">
<h3>Product Information</h3>
<div class="table-responsive">
<table class="table table-bordered">
<?php 
$desc_decode = json_decode($product_data_fun['all_data']['ph_desc']);
foreach($desc_decode as $key_head => $val_data){

?>
<tr>
<th class="p-3"><?=$key_head?></th>
<td class="p-3"><?=$val_data?></td>
</tr>
<?php } ?>
</table>
</div> <!-- end of table responsive -->
</div><!-- End .product-desc-content -->
</div><!-- .End .tab-pane -->
<!-- <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
<div class="product-desc-content">
<h3>Information</h3>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

<h3>Fabric & care</h3>
<ul>
<li>Faux suede fabric</li>
<li>Gold tone metal hoop handles.</li>
<li>RI branding</li>
<li>Snake print trim interior </li>
<li>Adjustable cross body strap</li>
<li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
</ul>

<h3>Size</h3>
<p>one size</p>
</div>
</div> -->
<!-- .End .tab-pane -->
<div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
<div class="product-desc-content">
<h3>Delivery & returns</h3>
<p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
</div><!-- End .product-desc-content -->
</div><!-- .End .tab-pane -->
<div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
<div class="reviews">
<h3>Reviews (2)</h3>
<div class="review">
<div class="row no-gutters">
<div class="col-auto">
<h4><a href="#">Samanta J.</a></h4>
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
</div><!-- End .rating-container -->
<span class="review-date">6 days ago</span>
</div><!-- End .col -->
<div class="col">
<h4>Good, perfect size</h4>

<div class="review-content">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
</div><!-- End .review-content -->

<div class="review-action">
<a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
<a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
</div><!-- End .review-action -->
</div><!-- End .col-auto -->
</div><!-- End .row -->
</div><!-- End .review -->

<div class="review">
<div class="row no-gutters">
<div class="col-auto">
<h4><a href="#">John Doe</a></h4>
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
</div><!-- End .rating-container -->
<span class="review-date">5 days ago</span>
</div><!-- End .col -->
<div class="col">
<h4>Very good</h4>

<div class="review-content">
<p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
</div><!-- End .review-content -->

<div class="review-action">
<a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
<a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
</div><!-- End .review-action -->
</div><!-- End .col-auto -->
</div><!-- End .row -->
</div><!-- End .review -->
</div><!-- End .reviews -->
</div><!-- .End .tab-pane -->
</div><!-- End .tab-content -->
</div><!-- End .product-details-tab -->

<h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

<div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
data-owl-options='{
"nav": false, 
"dots": true,
"margin": 20,
"loop": false,
"responsive": {
"0": {
"items":1
},
"480": {
"items":2
},
"768": {
"items":3
},
"992": {
"items":4
},
"1200": {
"items":4,
"nav": true,
"dots": false
}
}
}'>
<div class="product product-7 text-center">
<figure class="product-media">
<span class="product-label label-new">New</span>
<a href="product.html">
<img src="assets/images/products/product-4.jpg" alt="Product image" class="product-image">
</a>

<div class="product-action-vertical">
<a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
<a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
<a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
</div><!-- End .product-action-vertical -->

<div class="product-action">
<a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
</div><!-- End .product-action -->
</figure><!-- End .product-media -->

<div class="product-body">
<div class="product-cat">
<a href="#">Women</a>
</div><!-- End .product-cat -->
<h3 class="product-title"><a href="product.html">Brown paperbag waist <br>pencil skirt</a></h3><!-- End .product-title -->
<div class="product-price">
$60.00
</div><!-- End .product-price -->
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
<span class="ratings-text">( 2 Reviews )</span>
</div><!-- End .rating-container -->

<div class="product-nav product-nav-thumbs">
<a href="#" class="active">
<img src="assets/images/products/product-4-thumb.jpg" alt="product desc">
</a>
<a href="#">
<img src="assets/images/products/product-4-2-thumb.jpg" alt="product desc">
</a>

<a href="#">
<img src="assets/images/products/product-4-3-thumb.jpg" alt="product desc">
</a>
</div><!-- End .product-nav -->
</div><!-- End .product-body -->
</div><!-- End .product -->

<div class="product product-7 text-center">
<figure class="product-media">
<span class="product-label label-out">Out of Stock</span>
<a href="product.html">
<img src="assets/images/products/product-6.jpg" alt="Product image" class="product-image">
</a>

<div class="product-action-vertical">
<a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
<a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
<a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
</div><!-- End .product-action-vertical -->

<div class="product-action">
<a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
</div><!-- End .product-action -->
</figure><!-- End .product-media -->

<div class="product-body">
<div class="product-cat">
<a href="#">Jackets</a>
</div><!-- End .product-cat -->
<h3 class="product-title"><a href="product.html">Khaki utility boiler jumpsuit</a></h3><!-- End .product-title -->
<div class="product-price">
<span class="out-price">$120.00</span>
</div><!-- End .product-price -->
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
<span class="ratings-text">( 6 Reviews )</span>
</div><!-- End .rating-container -->
</div><!-- End .product-body -->
</div><!-- End .product -->

<div class="product product-7 text-center">
<figure class="product-media">
<span class="product-label label-top">Top</span>
<a href="product.html">
<img src="assets/images/products/product-11.jpg" alt="Product image" class="product-image">
</a>

<div class="product-action-vertical">
<a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
<a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
<a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
</div><!-- End .product-action-vertical -->

<div class="product-action">
<a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
</div><!-- End .product-action -->
</figure><!-- End .product-media -->

<div class="product-body">
<div class="product-cat">
<a href="#">Shoes</a>
</div><!-- End .product-cat -->
<h3 class="product-title"><a href="product.html">Light brown studded Wide fit wedges</a></h3><!-- End .product-title -->
<div class="product-price">
$110.00
</div><!-- End .product-price -->
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
<span class="ratings-text">( 1 Reviews )</span>
</div><!-- End .rating-container -->

<div class="product-nav product-nav-thumbs">
<a href="#" class="active">
<img src="assets/images/products/product-11-thumb.jpg" alt="product desc">
</a>
<a href="#">
<img src="assets/images/products/product-11-2-thumb.jpg" alt="product desc">
</a>

<a href="#">
<img src="assets/images/products/product-11-3-thumb.jpg" alt="product desc">
</a>
</div><!-- End .product-nav -->
</div><!-- End .product-body -->
</div><!-- End .product -->

<div class="product product-7 text-center">
<figure class="product-media">
<a href="product.html">
<img src="assets/images/products/product-10.jpg" alt="Product image" class="product-image">
</a>

<div class="product-action-vertical">
<a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
<a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
<a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
</div><!-- End .product-action-vertical -->

<div class="product-action">
<a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
</div><!-- End .product-action -->
</figure><!-- End .product-media -->

<div class="product-body">
<div class="product-cat">
<a href="#">Jumpers</a>
</div><!-- End .product-cat -->
<h3 class="product-title"><a href="product.html">Yellow button front tea top</a></h3><!-- End .product-title -->
<div class="product-price">
$56.00
</div><!-- End .product-price -->
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
<span class="ratings-text">( 0 Reviews )</span>
</div><!-- End .rating-container -->
</div><!-- End .product-body -->
</div><!-- End .product -->

<div class="product product-7 text-center">
<figure class="product-media">
<a href="product.html">
<img src="assets/images/products/product-7.jpg" alt="Product image" class="product-image">
</a>

<div class="product-action-vertical">
<a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
<a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
<a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
</div><!-- End .product-action-vertical -->

<div class="product-action">
<a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
</div><!-- End .product-action -->
</figure><!-- End .product-media -->

<div class="product-body">
<div class="product-cat">
<a href="#">Jeans</a>
</div><!-- End .product-cat -->
<h3 class="product-title"><a href="product.html">Blue utility pinafore denim dress</a></h3><!-- End .product-title -->
<div class="product-price">
$76.00
</div><!-- End .product-price -->
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
<span class="ratings-text">( 2 Reviews )</span>
</div><!-- End .rating-container -->
</div><!-- End .product-body -->
</div><!-- End .product -->
</div><!-- End .owl-carousel -->
</div><!-- End .container -->
</div><!-- End .page-content -->
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

<!-- Plugins JS File -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.hoverIntent.min.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/superfish.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/bootstrap-input-spinner.js"></script>
<!-- <script src="assets/js/jquery.elevateZoom.min.js"></script> -->
<script src="assets/js/bootstrap-input-spinner.js"></script>
<!-- <script src="assets/js/jquery.magnific-popup.min.js"></script> -->
<!--<script type="text/javascript" src="assets/js/custom-image-zoom.js"></script>-->

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<?php include 'cores/footer-tag.php' ?>
<script type="text/javascript">

// 	function data_zoom(data){
// 		$(".magnifier").css("background-image", "url(assets/images/products/single/" + data + ")");
// 	}

</script>

// <!--image zoom new-->
<script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>
<script>
    $('#img_01').ezPlus({
        gallery: 'gal1', cursor: 'pointer', galleryActiveClass: 'active',
        imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
    });
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-1VDDWMRSTH');
</script>
</body>
</html>