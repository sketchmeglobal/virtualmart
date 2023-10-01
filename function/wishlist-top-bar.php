<?php
include 'functions.php';
if (isset($_SESSION['id'])) {
$ses_usr_id = $_SESSION['id'];
}else{
$ses_usr_id = 0;
}
if (isset($_POST['wishlist_header'])) {
// code...
$cart_top_bar_data = "SELECT * FROM tbl_wishlist
JOIN tbl_product_hdr ON tbl_wishlist.product_id = tbl_product_hdr.phid
WHERE user_id = '".$ses_usr_id."' && cart_status = 1 ";
$top_bar_cart_func_count = check($cart_top_bar_data);
?>
<a href="wishlist.php" class="wishlist-link">
  <i class="icon-heart-o"></i>
  <span class="wishlist-count"><?=($top_bar_cart_func_count['count']>0)? $top_bar_cart_func_count['count']:0?></span>
  <span class="wishlist-txt">Wishlist</span>
</a>
<?php } ?>