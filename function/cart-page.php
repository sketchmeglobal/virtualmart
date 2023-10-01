<?php
include 'functions.php';
if (isset($_SESSION['id'])) {
$ses_usr_id = $_SESSION['id'];
}else{
$ses_usr_id = 0;
}

if (isset($_POST['cart_page'])) {

$_SESSION['coupon_msg'] = '';
$_SESSION['coupon_code'] = '';
$_SESSION['coupon_state'] = false;
$_SESSION['total_amount'] = false;
$coupon_products = false;
$coupon_code = ($_POST['coupon_code']) == 'undefined' ? '':$_POST['coupon_code'];

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
    `cartid`,
    `color`,
    `size`
 FROM tbl_cart
JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE user_id = '".$ses_usr_id."' && cart_status = 1 ";
$top_bar_cart_func_count = check($cart_top_bar_data);
$all_cart_header_data = all_data($cart_top_bar_data);

// check coupon code
$coupon_code_query = coupon_code_check($coupon_code,$_SESSION['id']);
$_SESSION['coupon_code'] =$coupon_code_query['coupon_code'];
$_SESSION['coupon_msg'] = $coupon_code_query['coupon_msg'];
$_SESSION['coupon_state'] = $coupon_code_query['coupon_state'];
$coupon_products = $coupon_code_query['coupon_products'];
// echo '<pre>';
// print_r($coupon_code_query);
?>
<table class="table table-cart table-mobile">
    <thead>
        <tr>
            <th>Product</th>
            <th>Color</th>
            <th>Size</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Dsicount</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($top_bar_cart_func_count['count'] !=false ) {
        $total_cart_value = 0;
        foreach ($all_cart_header_data['all_data'] as $key => $value) {

            

        if (isset($_SESSION['coupon_code']) && $_SESSION['coupon_code'] !='') {
            $apply_coupon_code = apply_coupon_code($_SESSION['coupon_code'],$coupon_products,$coupon_code_query,$value['product_qty'],$value['ph_price'],$value['phid']);
            $coupon_amt = $apply_coupon_code['coupon_amt'];
            $product_val= $apply_coupon_code['product_val'];
            $_SESSION['coupon_amount'] += $coupon_amt;
    }else{
        $_SESSION['coupon_amount'] = 0;
        $coupon_amt = 0;
        $product_val= ($value['product_qty']*$value['ph_price']);
        
    }
        $total_cart_value += $product_val;
        $encode_formula = encode($value['phid']);
        
        ?>
        
        <tr>
            <td class="product-col">
                <div class="product">
                    <figure class="product-media">
                        <a href="#">
                            <img src="product-images/<?=$value['ph_feature_img']?>" alt="Product image">
                        </a>
                    </figure>
                    <h3 class="product-title">
                    <a href="#"><?=$value['ph_title']?></a>
                    </h3><!-- End .product-title -->
                    </div><!-- End .product -->
                </td>
                <td class="price-col"> <div style="margin: auto;float: none;background: <?=($value['color'])?>;height: 25px;width: 25px;border-radius: 5px;border: 1px solid">&nbsp;</div></td>
                <td class="price-col"><?=($value['size'])?></td>
                <td class="price-col">&#8377; <?=number_format($value['ph_price'],2)?></td>
               
                     
                    
                <td class="quantity-col">
                    <div class="cart-product-quantity">
                        <input type="number" class="form-control" onchange="update_qty(this.value,'<?=$encode_formula?>')" onkeyup="update_qty(this.value,'<?=$encode_formula?>')" value="<?=$value['product_qty']?>" min="1" max="10" step="1" data-decimals="0" required id="cart_product_qty_<?=$encode_formula?>">
                        </div><!-- End .cart-product-quantity -->
                    </td>
                    <td class="price-col">&#8377; <?=number_format($coupon_amt*$value['product_qty'],2)?></td>
                    <td class="total-col">&#8377;<?php echo number_format($product_val,2);?></td>
                    <td class="remove-col"><button class="btn-remove" onclick="product_remove('<?=$encode_formula?>')"><i class="icon-close"></i></button></td>
                </tr>
                <?php } $_SESSION['coupon_amount']=$total_cart_value;}else{ echo '<tr class="text-center"><td colspna=5>Iteam not found</td></tr>'; } ?>
            </tbody>
            </table><!-- End .table table-wishlist -->
            <div class="cart-bottom">
                <div class="cart-discount">
                    <!-- <form action="#"> -->
                        <?php  echo ($_SESSION['coupon_state']==true)? $_SESSION['coupon_msg']:''; ?>
                        <div class="input-group">
                            <input type="text" class="form-control" required placeholder="coupon code" id="coupon_code" value="<?=($_SESSION['coupon_code']=='')?'':$_SESSION['coupon_code']?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary-2" type="submit" onclick="coupon_code()"><i class="icon-long-arrow-right"></i></button>
                                </div><!-- .End .input-group-append -->
                        </div><!-- End .input-group -->
                            <!-- </form> -->
                            </div><!-- End .cart-discount -->
                            <!-- <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a> -->
                            </div><!-- End .cart-bottom -->
                            <?php } ?>