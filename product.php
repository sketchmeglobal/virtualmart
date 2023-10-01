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
        $url_user_type = "SELECT * FROM users WHERE id = '".$url_decode_user_id."' && user_type = 'CONSULTANT'";
        $func_url_usr_ret = single_data($url_user_type);

        //print_r($url_decode_user_id); die();

        // if url user id is consultant, then update consultant id
        if ($func_url_usr_ret['data']==true) {
        if ($func_url_usr_ret['all_data']['user_type']=='CONSULTANT') {
            $consultant_id = encode($func_url_usr_ret['all_data']['id']);
        }
    }
    }


}





//print_r($pid); die();
// chekc if int, then stay, otherwise, get lost
if (intval($pid)) {

// ret product_hdr data

$product_data_sql = "SELECT 
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
    `ph_gallery_img`,
    
`admin_commission`,
(SELECT MAX(ph_price) +  ROUND((`ph_price` * `admin_commission`) / 100,2) AS MRP
  FROM tbl_product_dtl WHERE `product_id` = `phid`)
 AS MRP,
 (SELECT MIN(ph_dp) +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid`)
 AS ph_price,
 (SELECT GROUP_CONCAT(DISTINCT `pd_color` SEPARATOR ',') FROM tbl_product_dtl WHERE product_id = phid ) AS COLOR
 FROM tbl_product_hdr 
JOIN tbl_parent_category ON tbl_product_hdr.p_cat_id = tbl_parent_category.p_cid 
WHERE tbl_product_hdr.phid = '$pid' ";
$product_data_fun = single_data($product_data_sql);

//$product_data = $product_data_fun['all_data'];


//print_r($product_data_fun['all_data']);

// fetch all comments
 $sql = "SELECT * FROM user_feedback WHERE status = 1 && product_id=". $pid;
 $feedback_count = check($sql)['count'];

 $sql = "SELECT AVG(rating) AS rating FROM user_feedback WHERE product_id=". $pid;
 $feedback_avg = single_data($sql)['all_data'];
 $feedback_avg = ($feedback_avg['rating'] * 20);

 $all_ratings = all_data("SELECT * FROM user_feedback WHERE product_id = ".$pid);

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
<link rel="stylesheet" href="assets/css/demos/demo-14.css">
<link rel="stylesheet" href="assets/css/skins/skin-demo-14.css">

<link rel="stylesheet" href="assets/css/p-img-zoom.css">
<!-- img zoom -->
<!--<link rel="stylesheet" type="text/css" href="https://jquery.app/jqueryscripttop.css">-->
<!--<link rel="stylesheet" type="text/css" href="assets/css/image-zoom.css">-->

<!--image zoom new-->

<?php include 'cores/head-tag.php'; ?>
<style>
    .color_input{
              display:none;
          }
          .color_input:checked + .color_lebel{
              border-radius:20px;
            border: 3px solid;
          }
          .color_lebel{
              display:inline-block;
              border-radius:8px;
              padding:5px;
              width: 35px !important;
            height: 35px;
            margin-left: 8px;
            cursor: pointer;
            border:1px solid;
          }
          .img-magnifier-container {
  position:relative;
}

.thumbnail{
	object-fit: cover;
	max-width: 180px;
	max-height: 100px;
	cursor: pointer;
	opacity: 0.5;
	margin: 5px;
	border: 2px solid black;

}

.thumbnail:hover{
	opacity:1;
}
#img-container{
	z-index: 1;
	max-width: 347px;
	position: relative;
	overflow:hidden;
}

#lens{
	z-index: 2;
	position: absolute;

	height: 125px;
	width: 125px;
	border:2px solid black;
	background-repeat: no-repeat;
	cursor: none;

}
.img-fluidd{
    max-width: 347px;
}
</style>
</head>

<body>
<?php include_once 'cores/body-tag.php' ?>
<div class="page-wrapper">
<?php include_once 'cores/nav.php' ?>
<main class="main">
<div class="py-3"></div>
<div class="page-content">
<div class="container">
    <div class="product-details-top">
        <div class="row">
         <div class="col-md-6">
	<div class="row">
		<div class="col-12">
		    <?php 
               $gallery_explode = explode(',', $product_data_fun['all_data']['ph_gallery_img']);
               
                ?>
                
			<div id="img-container">
			   <div id="lens"></div>
			   
				   <img class="img-fluidd" id=featured src="product-images/<?=$product_data_fun['all_data']['ph_feature_img']?>" >
			   </div>
		</div>
		<div class="col-12">
		    <div id="slider" class="d-flex">
		        <?php 
                    for ($i=0; $i < count($gallery_explode); $i++) {
                    if($gallery_explode[$i] !=''){
                     ?>
                     <img class="thumbnail" src="product-images/<?=$gallery_explode[$i]?>" onclick="myFunction(this)">
                     <?php }} ?>
					
					<!--<img class="thumbnail" src="https://parthajyoti.com/wp-content/uploads/2023/05/COVER-4.jpg" onclick="myFunction(this)">-->
					<!--<img class="thumbnail" src="https://parthajyoti.com/wp-content/uploads/2023/05/COVER-1-1.jpg" onclick="myFunction(this)">-->
		
				</div>
		</div>
	</div>

   </div><!-- End .col-md-6 -->
<script>

function myFunction(smallImg) {
   var fullImg = document.querySelector("#featured");
   fullImg.src = smallImg.src;
}

</script>
            <div class="col-md-6">
        <div class="product-details">
        <h1 class="product-title"><?=$product_data_fun['all_data']['ph_title']?></h1><!-- End .product-title -->
        
        <div class="ratings-container">
        <div class="ratings">
        <div class="ratings-val" style="width: <?=$feedback_avg?>%;"></div><!-- End .ratings-val -->
        </div><!-- End .ratings -->
        <a class="ratings-text" href="#product-review-link" id="review-link">( <?=($feedback_count == FALSE) ? '0' : $feedback_count ?> Reviews )</a>
        </div><!-- End .rating-container -->
        
        <div class="product-price">
        
        </div><!-- End .product-price -->
        
        <div class="product-content">
        <?=$product_data_fun['all_data']['ph_short_desc']?>
        </div><!-- End .product-content -->
        
        <div class="details-filter-row details-row-size">
        <label>Color:</label>
        
        <div class="product-nav " id="color">
        <?php 
        $colors = (explode(',',$product_data_fun['all_data']['COLOR']));
        for ($ci=0; $ci < count($colors); $ci++) {
       ?>
        <input class="color_input" type="radio" name="color" value="<?=$colors[$ci]?>" required id="color_<?=$ci?>" <?= $ci==0? 'checked':''?>>
        <label class="color_lebel" for="color_<?=$ci?>" style="background: <?=$colors[$ci]?> ;" ></label>
        <?php } ?>
        
        </div>
        </div>
      <div class="details-filter-row details-row-size">
        <label for="size">Size:</label>
        <div class="select-custom">
        <select name="size" id="size" class="form-control" onchange="func_size(this.value)">
         
        </select>
        </div>
        
        <!-- <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a> -->
        </div>
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
        <?php if (isset($_SESSION['id'])) { 
        
        $check_cart = single_data("SELECT * FROM tbl_cart WHERE user_id = '".$_SESSION['id']."' && product_id = '$pid' && cart_status = 1 LIMIT 1 ");
        if ($check_cart['data']==true) {
            // code...
       ?>
        
        <a href="cart.php" class="btn-product btn-cart"> <span>Checkout</span></a>
        
        <?php } else{ ?>
            <a href="javaScript:void(0)" id="<?=$encode_pid?>_" class="btn-product btn-cart <?=$encode_pid?>_addtocartbtn" title="Add to cart" onclick="add_to_cart('<?=$encode_pid?>')"><span>add to cart</span></a>
            

        <?php } }if(!isset($_SESSION['id'])){ ?>
        <a href="#signin-modal" data-toggle="modal" class="btn-product btn-cart signin-modal" title="Add to cart" product="<?=$encode_pid?>" consultant="<?=$consultant_id?>" type="cart"><span>add to cart</span></a>
        <?php } ?>
        
        <div class="details-action-wrapper">
        <?php if (isset($_SESSION['id'])) { 

            $check_wishlist = single_data("SELECT * FROM tbl_wishlist WHERE user_id = '".$_SESSION['id']."' && product_id = '$pid' && cart_status = 1 LIMIT 1 ");
            if ($check_wishlist['data']==true) {
                echo '<a href="wishlist.php" class="btn-product btn-wishlist p-3 px-5" title="Wishlist" ><span>View Wishlist</span></a>';
            }else{

            ?>
        
        <input type="hidden" id="<?=$encode_pid?>_w_token" name="cart_token" value="<?=$_SESSION['add_to_wishlist_token']?>">
        
        <input type="hidden" id="<?=$encode_pid?>_product_w" name="product" value="<?=$encode_pid?>">
        
        <a href="javaScript:void(0)" id="<?=$encode_pid?>_w" class="btn-product btn-wishlist p-3 px-5 <?=$encode_pid?>_addtocartbtn_w" title="Wishlist" onclick="add_to_wishlist('<?=$encode_pid?>')"><span>Add to Wishlist</span></a>
        <?php }} ?>
        
        <?php if (!isset($_SESSION['id'])) { ?>
        <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist p-3 px-5 signin-modal" title="Wishlist" product="<?=$encode_pid?>" consultant="<?=$consultant_id?>" type="wishlist"><span>Add to Wishlist</span></a>
        <?php } ?>
        
        </div><!-- End .details-action-wrapper -->
        </div><!-- End .product-details-action -->
        <div class="out-of-stock text-danger d-none" style="font-size:16px;font-weight: 400;">
            Out of stock
        </div>
        
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
<a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (<?=$feedback_count?>)</a>
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
<h3>Reviews </h3>
<?php 
if (!empty($all_ratings['data'])) {

foreach ($all_ratings['all_data'] as $Rkey => $Rval) {
    $feedback_avg = ($Rval['rating'] * 20);
?>

<div class="review">
<div class="row no-gutters">
<div class="col-auto">
<h4><a href="#">Samanta J.</a></h4>
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val" style="width: <?=$feedback_avg?>%;"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
</div><!-- End .rating-container -->
<!-- <span class="review-date">6 days ago</span> -->
</div><!-- End .col -->
<div class="col">
<?=$Rval['review']?>
</div><!-- End .review-content -->

<!-- <div class="review-action">
<a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
<a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
</div> -->
</div><!-- End .col-auto -->
</div><!-- End .row -->
</div><!-- End .review -->
<?php } }?>


</div><!-- End .reviews -->
</div><!-- .End .tab-pane -->
</div><!-- End .tab-content -->
</div><!-- End .product-details-tab -->

<h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

<?php include 'cores/similar-products.php'; ?>
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
<script src="assets/js/jquery.elevateZoom.min.js"></script> 
 <script src="assets/js/bootstrap-input-spinner.js"></script>
 <script src="assets/js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="assets/js/custom-image-zoom.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script src="assets/js/zoom.js"></script>
<script src="assets/js/p-img-zoom.js"></script>
<?php include 'cores/footer-tag.php' ?>

 <!--image zoom new-->
<script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-1VDDWMRSTH');
</script>

<script>
    function image_src(data){
        var img_src = 'product-images/'+data;
        /*var src = $('.'+data).attr('src');
        $('#img_01').attr('src',src);
        $(".zoomWindow").css("background-image", "url(" + src + ")");*/
        $('#img_01').attr("src", img_src);
    }

    $( document ).ready(function() {
        var color = $("input[name='color']:checked").val();
        var pid = <?=$pid?>;
        var size = $('select#size option:selected').val();
        color_change(color,pid);
        func_size(size);
        
    });
    $("input[name='color']").change(function(){
        var color = $("input[name='color']:checked").val();
        var pid = <?=$pid?>;
        var size = $('select#size option:selected').val();
        color_change(color,pid);
        func_size(size);
    });

    function color_change(color,pid){
        $.ajax({
            type:'post',
            url:'function/get_size.php',
            data:{p_color:color,
            pid:pid,
            },
            success:function(data){
                var jdata = JSON.parse(data);
                $('#size').html(jdata.option);
                func_size(jdata.selected);

            }
        });
    }

    function func_size(val){

        var pid = <?=$pid?>;
        var color = $("input[name='color']:checked").val();
         $.ajax({
            type:'post',
            url:'function/get_size.php',
            data:{p_size:val,
            pid:pid,
            color:color,
            },
            success:function(data){
               var j_data = JSON.parse(data);
               $('.product-price').html('&#8377 '+ j_data.price);
               if (j_data.ph_qty <= 0) {
                $('.product-details-action').hide(100);
                $('.out-of-stock').removeClass('d-none');
               }else{
                $('.out-of-stock').addClass('d-none');
                $('.product-details-action').show(100);
               }
            }
        });
    }



</script>
<script>
document.getElementById('img-container').addEventListener('mouseover', function(){
    imageZoom('featured')
    
})

function imageZoom(imgID){
	let img = document.getElementById(imgID)
	let lens = document.getElementById('lens')

	lens.style.backgroundImage = `url( ${img.src} )`

	let ratio = 3

	lens.style.backgroundSize = (img.width * ratio) + 'px ' + (img.height * ratio) + 'px';

	img.addEventListener("mousemove", moveLens)
	lens.addEventListener("mousemove", moveLens)
	img.addEventListener("touchmove", moveLens)

	function moveLens(){
	
		let pos = getCursor()
	
		let positionLeft = pos.x - (lens.offsetWidth / 2)
		let positionTop = pos.y - (lens.offsetHeight / 2)

		//5
		if(positionLeft < 0 ){
			positionLeft = 0
		}

		if(positionTop < 0 ){
			positionTop = 0
		}

		if(positionLeft > img.width - lens.offsetWidth /3 ){
			positionLeft = img.width - lens.offsetWidth /3
		}

		if(positionTop > img.height - lens.offsetHeight /3 ){
			positionTop = img.height - lens.offsetHeight /3
		}


	
		lens.style.left = positionLeft + 'px';
		lens.style.top = positionTop + 'px';

	
		lens.style.backgroundPosition = "-" + (pos.x * ratio) + 'px -' +  (pos.y * ratio) + 'px'
	}

	function getCursor(){
	

        let e = window.event
        let bounds = img.getBoundingClientRect()

   
        let x = e.pageX - bounds.left
		let y = e.pageY - bounds.top
		x = x - window.pageXOffset;
		y = y - window.pageYOffset;
		
		return {'x':x, 'y':y}
	}

}

imageZoom('featured')
</script>

<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage", 3);
</script>
</body>
</html>