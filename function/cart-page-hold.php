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

$cart_top_bar_data = "SELECT * FROM tbl_cart
JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE user_id = '".$ses_usr_id."' && cart_status = 1 ";
$top_bar_cart_func_count = check($cart_top_bar_data);
$all_cart_header_data = all_data($cart_top_bar_data);

        // check coupon code
$coupon_code_query = coupon_code_check($coupon_code);
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

            if (($_SESSION['coupon_code'] !='') && ($coupon_code_query['data']==true)) {
          
            if (($coupon_products==true) && ($_SESSION['coupon_code'] !='')) {
                if ($coupon_code_query['all_data']['COUPON_TYPE']=='FIXED') { // if coupoin fixed
                $coupon_amt = $coupon_code_query['all_data']['COUPON_AMT'];
                }elseif ($coupon_code_query['all_data']['COUPON_TYPE']=='PERCENTAGE') { // if coupon percentage
                $coupon_amt = (($value['ph_price']*$coupon_code_query['all_data']['COUPON_AMT'])/100);
                }

                $single_ph_amt = ($value['ph_price']-$coupon_amt);
                $product_val= ($value['product_qty']*$single_ph_amt);
                
            }elseif(($coupon_products==false) && ($coupon_code_query['all_data']['DISALLOW'] !='') && ($coupon_code_query['all_data']['ALLOW'] =='')){
                $coupon_code_single_p = single_data("SELECT * FROM tbl_coupons
                                                            JOIN tbl_child_coupon_code
                                                            ON tbl_coupons.coupon_id = tbl_child_coupon_code.coupon_id
                                                            WHERE tbl_child_coupon_code.product_id = '".$value['phid']."' && allow_type = 'DISALLOW' && tbl_coupons.coupon_code = '".$coupon_code."'
                        ");
                if ($coupon_code_single_p['data']==true) {
                    $coupon_amt = 0;
                    $product_val= ($value['product_qty']*$value['ph_price']);
                }else{
                    if ($coupon_code_query['all_data']['COUPON_TYPE']=='FIXED') { // if coupoin fixed
                            $coupon_amt = $coupon_code_query['all_data']['COUPON_AMT'];
                            }elseif ($coupon_code_query['all_data']['COUPON_TYPE']=='PERCENTAGE') { // if coupon percentage
                            $coupon_amt = (($value['ph_price']*$coupon_code_query['all_data']['COUPON_AMT'])/100);
                            }

                        $single_ph_amt = ($value['ph_price']-$coupon_amt);
                        $product_val= ($value['product_qty']*$single_ph_amt);
                }
            }

            elseif(($coupon_products==false) && ($coupon_code_query['all_data']['DISALLOW'] !='') && ($coupon_code_query['all_data']['ALLOW'] !='')){
                $coupon_code_single_p = single_data("SELECT tbl_child_coupon_code.allow_type AS ALLOW_TYPE FROM tbl_coupons
                                                            JOIN tbl_child_coupon_code
                                                            ON tbl_coupons.coupon_id = tbl_child_coupon_code.coupon_id
                                                            WHERE tbl_child_coupon_code.product_id = '".$value['phid']."' && tbl_coupons.coupon_code = '".$coupon_code."'
                        ");
                if ($coupon_code_single_p['data']==true) {
                    if ($coupon_code_single_p['all_data']['ALLOW_TYPE']=='DISALLOW') {
                    $coupon_amt = 0;
                    $product_val= ($value['product_qty']*$value['ph_price']);
                }else{
                    if ($coupon_code_query['all_data']['COUPON_TYPE']=='FIXED') { // if coupoin fixed
                            $coupon_amt = $coupon_code_query['all_data']['COUPON_AMT'];
                            }elseif ($coupon_code_query['all_data']['COUPON_TYPE']=='PERCENTAGE') { // if coupon percentage
                            $coupon_amt = (($value['ph_price']*$coupon_code_query['all_data']['COUPON_AMT'])/100);
                            }

                        $single_ph_amt = ($value['ph_price']-$coupon_amt);
                        $product_val= ($value['product_qty']*$single_ph_amt);
                }
                }else{
                    $coupon_amt = 0;
                    $product_val= ($value['product_qty']*$value['ph_price']);
                }
            }

            elseif(($coupon_products==false) && ($_SESSION['coupon_code'] !='')){
                    $coupon_code_single_p = single_data("SELECT * FROM tbl_coupons
                                                            JOIN tbl_child_coupon_code
                                                            ON tbl_coupons.coupon_id = tbl_child_coupon_code.coupon_id
                                                            WHERE tbl_child_coupon_code.product_id = '".$value['phid']."' && allow_type = 'ALLOW' && tbl_coupons.coupon_code = '".$coupon_code."'
                        ");
                    if ($coupon_code_single_p['data']==true) {

                        if ($coupon_code_query['all_data']['COUPON_TYPE']=='FIXED') { // if coupoin fixed
                            $coupon_amt = $coupon_code_query['all_data']['COUPON_AMT'];
                            }elseif ($coupon_code_query['all_data']['COUPON_TYPE']=='PERCENTAGE') { // if coupon percentage
                            $coupon_amt = (($value['ph_price']*$coupon_code_query['all_data']['COUPON_AMT'])/100);
                            }

                        $single_ph_amt = ($value['ph_price']-$coupon_amt);
                        $product_val= ($value['product_qty']*$single_ph_amt);
                    }
                    else{
                $coupon_amt = 0;
                $product_val= ($value['product_qty']*$value['ph_price']);
                    }
            }else{
                $coupon_amt = 0;
                $product_val= ($value['product_qty']*$value['ph_price']);
            }
        }else{
            $coupon_amt = 0;
            $product_val= ($value['product_qty']*$value['ph_price']);
        }

        $total_cart_value += $product_val;
        $encode_formula = encode($value['phid']);
        $_SESSION['coupon_amount'] = 0;
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