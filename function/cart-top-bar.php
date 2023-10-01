<?php
include 'functions.php';
if (isset($_SESSION['id'])) {
$ses_usr_id = $_SESSION['id'];
}else{
$ses_usr_id = 0;
}
if (isset($_POST['cart_header'])) {
// code...
$cart_top_bar_data = "SELECT 
 `phid`,
`ph_title`,
`ph_shipping_charge`,
`ph_feature_img`,
`admin_commission`,
`product_dtl_id`,
(SELECT ph_dp +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid` && `pdid` = `product_dtl_id`)
 AS ph_price,
    `product_id`,
    `product_qty`,
    `cartid`
 FROM tbl_cart
JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE user_id = '".$ses_usr_id."' && cart_status = 1 ";
$top_bar_cart_func_count = check($cart_top_bar_data);
$all_cart_header_data = all_data($cart_top_bar_data);
?>
<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
    <i class="icon-shopping-cart"></i>
    <span class="cart-count"><?= ($top_bar_cart_func_count['count']==false) ? 0:$top_bar_cart_func_count['count'];?></span>
    <span class="cart-txt">Cart</span>
</a>    <div class="dropdown-menu dropdown-menu-right">
<div class="dropdown-cart-products">
    <?php
    if(!empty($all_cart_header_data['all_data'])){
    $total_cart_value = 0;
    foreach ($all_cart_header_data['all_data'] as $key => $value) {
    $total_cart_value += ($value['product_qty']*$value['ph_price']);
    
    $encode_formula = encode($value['phid']); //
    ?>
    <div class="product"> <!-- start product -->
    <div class="product-cart-details">
        <h4 class="product-title">
        <a target="_blank" href="product.php?product=<?=$encode_formula?>"><?=substr($value['ph_title'],0,40)?></a>
        </h4>
        <span class="cart-product-info">
            <span class="cart-product-qty">
                <?php echo $value['product_qty']. ' x &#8377 ' .$value['ph_price'] ?>
            </span>
            
        </span>
        </div><!-- End .product-cart-details -->
        <figure class="product-image-container">
            <a href="product.php" class="product-image">
                <img src="product-images/<?=$value['ph_feature_img']?>" alt="product">
            </a>
        </figure>
        <a href="#" class="btn-remove" title="Remove Product" onclick="product_remove('<?=$encode_formula?>')"><i class="icon-close"></i></a>
        </div><!-- End .product -->
        <?php } ?>
        </div><!-- End .cart-product -->
        <div class="dropdown-cart-total">
            <span>Total</span>
            <span class="cart-total-price">&#8377;<?=number_format($total_cart_value,2)?></span>
            </div><!-- End .dropdown-cart-total -->
            
            <div class="dropdown-cart-action">
                <a href="cart.php" class="btn btn-primary">View Cart</a>
                <a href="checkout.php" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                </div><!-- End .dropdown-cart-total -->
                <?php } else {echo '<div class="text-center">No data found</div>';} ?>
                </div><!-- End .dropdown-menu -->
                <?php } ?>