<?php
include 'functions.php';
if (isset($_SESSION['id'])) {
$ses_usr_id = $_SESSION['id'];

$user_data = single_data("SELECT * FROM users WHERE id = '$ses_usr_id' ")['all_data'];
$avail_bonus_amt = $user_data['bonus_wallet'];

}else{
$ses_usr_id = 0;
$avail_bonus_amt = 0;
}
if (isset($_POST['cart_page_sidebar'])) {
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
    `cartid`,
    `ph_bonus`

 FROM tbl_cart
JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE user_id = '".$ses_usr_id."' && cart_status = 1 ";
$top_bar_cart_func_count = check($cart_top_bar_data);
$all_cart_header_data = all_data($cart_top_bar_data);
$total = 0;
$shipping_charges = 0;

$total_bonus_amt = 0;

if (!empty($all_cart_header_data['all_data'])) {
// code...

foreach ($all_cart_header_data['all_data'] as $key => $value) {

// calculate bonus amount
if ($avail_bonus_amt>0) {
    $total_bonus_amt += ((($value['ph_price']*$value['product_qty'])*$value['ph_bonus'])/100);
}


$product_val= ($value['product_qty']*$value['ph_price']);

$total += $product_val;
$shipping_charges += $value['ph_shipping_charge'];
}
}

if (isset($_SESSION['coupon_amount']) && $_SESSION['coupon_amount']>0 && $total>0) {
   $total = $_SESSION['coupon_amount'];
}else{
    $total =0;
}

$shipping_free_amt = single_data("SELECT min_cart_val FROM common_settings WHERE csid =  1 ")['all_data'];
?>
<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->
<table class="table table-summary">
    <tbody>
        <tr class="summary-subtotal">
            <td>Subtotal:</td>
            <td>&#8377;<?=number_format($total,2)?></td>
            </tr><!-- End .summary-subtotal -->
            <tr class="summary-shipping">
                <td>Shipping:</td>
                <td>&nbsp;</td>
            </tr>
            <tr class="summary-shipping-row">
                <td>
                    <!-- <div class="custom-control custom-radio"> -->
                        <!-- <input type="radio" id="free-shipping" name="shipping" class="custom-control-input"> -->
                        <?php 
                        if ($total>=$shipping_free_amt['min_cart_val']) {
                         ?>
                        <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                    <?php } else{ ?>
                        Shipping Charges
                        <br>
                        <br>
                        <b>
                            Free shipping for minimum total order <?=number_format($shipping_free_amt['min_cart_val'],2)?>
                        </b>
                    <?php } ?>
                        <!-- </div> -->
                        <!-- End .custom-control -->
                    </td>
                    <td>
                    <?php 
                        if ($total>=$shipping_free_amt['min_cart_val']) {
                         ?>
                     &#8377;0.00
                     <?php } else{ echo $shipping_charges; $total += $shipping_charges;} ?>
                 </td>
                    </tr><!-- End .summary-shipping-row -->
                    <tr class="summary-total">
                        <td>Bonus Applied:</td>
                        <td>
                            <?php 
                            if ($avail_bonus_amt>0) {
                                //$total_bonus_amt;
                                
                                if ($avail_bonus_amt>=$total_bonus_amt ) {
                                    $print_bonus_amt = $total_bonus_amt;
                                }
                                else{
                                    $print_bonus_amt = $avail_bonus_amt;
                                     
                                }

                            }else{
                                $print_bonus_amt = 0;
                            }

                            echo ($print_bonus_amt);
                             ?>

                        </td>
                    </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>&#8377;<?=number_format($total-$print_bonus_amt,2)?></td>
                                            </tr><!-- End .summary-total -->
                                        </tbody>
                                        </table><!-- End .table table-summary -->
                                        <a href="checkout.php" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                        <?php } ?>