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
<?php 

if(isset($_SESSION['id'])){
    $encode_ss_id = $_SESSION['id'];
}else{
    $encode_ss_id = 0;
}

// token
$_SESSION['add_to_cart_token'] = sha1(md5(time()));
$_SESSION['add_to_wishlist_token'] = sha1(md5(time()));

$today_trending_query = "SELECT     `phid`,
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
    
`admin_commission`,
(SELECT MAX(ph_price) +  ROUND((`ph_price` * `admin_commission`) / 100,2) AS MRP
  FROM tbl_product_dtl WHERE `product_id` = `phid`)
 AS MRP,
 (SELECT MIN(ph_dp) +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid`)
 AS ph_price,

(SELECT MAX(ph_qty)  AS ph_qty
  FROM tbl_product_dtl WHERE `product_id` = `phid`)
 AS ph_qty FROM tbl_product_hdr 
JOIN tbl_parent_category ON tbl_product_hdr.p_cat_id = tbl_parent_category.p_cid
WHERE ph_status = 1 AND p_cat_id = '".$product_data_fun['all_data']['p_cid']."'
ORDER BY phid DESC";
$trend_ret_fun = all_data($today_trending_query);

$sess_user_id = encode($encode_ss_id);

if(!empty($trend_ret_fun['all_data'])){



foreach($trend_ret_fun['all_data'] as $key_trend => $trend_val){

// fetch all comments
 $sql = "SELECT * FROM user_feedback WHERE product_id=". $trend_val['phid'];
 $feedback_count = check($sql)['count'];

 $sql = "SELECT AVG(rating) AS rating FROM user_feedback WHERE product_id=". $trend_val['phid'];
 $feedback_avg = single_data($sql)['all_data'];
 $feedback_avg = ($feedback_avg['rating'] * 20);
 
// product id encdoing with custom formula
$encode_formula = encode($trend_val['phid']);

$urlencode = base64_encode(urlencode($encode_formula.','.$sess_user_id));

?>
<div class="product product-7 text-center">
    <div id="wishlist_msg_<?=$encode_formula?>" style="display: none;background: #00ff9370;color: #000;">Item added to Wishlist</div>
<figure class="product-media">
<span class="product-label label-new">New</span>
<a target="_blank" href="product.php?product=<?=$urlencode?>">
<img src="product-images/<?=$trend_val['ph_feature_img']?>" alt="Product image" class="product-image">
</a>

<!-- <div class="product-action-vertical">

    <?php
if (!isset($_SESSION['id'])) { ?>
<a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable signin-modal" title="Add to wishlist" product="<?=$encode_formula?>" consultant="<?=$sess_user_id?>" type="wishlist"><span>add to wishlist</span></a>    

<?php  } if(isset($_SESSION['id'])){ ?>

<div class="d-flex justify-content-center">
<input type="hidden" id="<?=$encode_formula?>_w_token" name="cart_token" value="<?=$_SESSION['add_to_wishlist_token']?>">

<input type="hidden" id="<?=$encode_formula?>_product_w" name="product" value="<?=$encode_formula?>">

<a href="javaScript:void(0)" id="<?=$encode_formula?>_w" title="Add to wishlist" class="btn-product-icon btn-wishlist btn-expandable <?=$encode_formula?>_addtocartbtn_w" onclick="add_to_wishlist('<?=$encode_formula?>')" product="<?=$encode_formula?>" consultant="<?=$sess_user_id?>" type="wishlist"><span>add to wishlist</span></a>
</div>

<?php } ?>

</div>

<div class="product-action">

       <?php 
    // add to cart function. uing jquery cores/footer-tag.php
    if (isset($_SESSION['id'])) { ?>
    <input type="hidden" id="<?=$encode_formula?>_qty_product" value="1">
    <input type="hidden" id="<?=$encode_formula?>_cart_token" name="cart_token" value="<?=$_SESSION['add_to_cart_token']?>">
    
    <input type="hidden" id="<?=$encode_formula?>_product" name="product" value="<?=$encode_formula?>">
    <input type="hidden" id="<?=$encode_formula?>_consultant" name="consultant" value="<?=$sess_user_id?>">
    
    <a href="javaScript:void(0)" id="<?=$encode_formula?>_" class="btn-product btn-cart <?=$encode_formula?>_addtocartbtn" title="Add to cart" onclick="add_to_cart('<?=$encode_formula?>')"><span>add to cart</span></a>
    <?php  } if(!isset($_SESSION['id'])){ ?>
    <a href="#signin-modal" data-toggle="modal" class="btn-product btn-cart signin-modal" title="Add to cart" product="<?=$encode_formula?>" consultant="<?=$sess_user_id?>" type="cart"><span>add to cart</span></a>
    <?php } ?> 

</div> --><!-- End .product-action -->
</figure><!-- End .product-media -->

<div class="product-body">
<div class="product-cat">
<a target="_blank" href="search-result.php?cat=<?=$trend_val['p_cat_id']?>&q=<?=$trend_val['p_cat_name']?>"><?=$trend_val['p_cat_name']?></a>
</div><!-- End .product-cat -->
<h3 class="product-title"><a target="_blank" href="product.php?product=<?=$urlencode?>"><?=$trend_val['ph_title']?></a></h3><!-- End .product-title -->
<div class="product-price">
&#8377;<?=$trend_val['ph_price']?>
</div><!-- End .product-price -->
<div class="ratings-container">
<div class="ratings">
<div class="ratings-val"style="width: <?=$feedback_avg?>%"></div><!-- End .ratings-val -->
</div><!-- End .ratings -->
<span class="ratings-text">( <?=($feedback_count == FALSE) ? '0' : $feedback_count ?> Reviews )</span>
</div><!-- End .rating-container -->

<!-- <div class="product-nav product-nav-thumbs">
<a href="#" class="active">
<img src="assets/images/products/product-4-thumb.jpg" alt="product desc">
</a>
<a href="#">
<img src="assets/images/products/product-4-2-thumb.jpg" alt="product desc">
</a>

<a href="#">
<img src="assets/images/products/product-4-3-thumb.jpg" alt="product desc">
</a>
</div> -->

<!-- End .product-nav -->
</div><!-- End .product-body -->
</div><!-- End .product -->


<?php }} ?>
</div><!-- End .owl-carousel -->