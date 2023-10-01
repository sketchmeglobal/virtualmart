<?php
include 'functions.php';

require_once('../razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

// checkout query
if (isset($_POST['pay_id'])) {
// data collect from checkout form
extract($_POST);


// razorpay 
$raz_data = single_data("SELECT key_id, secret_id FROM tbl_razorpay_setting WHERE razid = 1 ")['all_data'];
$api = new Api($raz_data['key_id'], $raz_data['secret_id']);

$razorpay_pay_details = $api->payment->fetch($payment_id);



$order_first_name;
$order_last_name;
$orde_company_name;
$order_country;
$order_streeet_adrs;
$order_town;
$order_state;
$order_zp;
$order_phone;
$order_email;
$order_apartment;
$order_notes;
// retrive avail products from tbl_cart
// calculate total price
//
$products_query = "SELECT 
`phid`,
`ph_title`,
`ph_shipping_charge`,
`ph_feature_img`,
`admin_commission`,
(SELECT MIN(ph_dp) +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid`)
 AS ph_price,
    `product_id`,
    `product_qty`,
    `cartid`
 FROM tbl_cart
JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE cart_status = 1 && user_id = '".$_SESSION['id']."' ";
$products_q_func = all_data($products_query);
$order_amount = 0;

//echo '<pre>',print_r($products_q_func),'</pre>'; die;
// data store

$coupon_code_query = coupon_code_check($_SESSION['coupon_code'],$_SESSION['id']);

$TOTAL_AMT = 0;

// add data in tbl_payments data

conditon_update('tbl_payments',['raz_pay_id'=>$payment_id, 'pay_status'=>'success', 'pay_by'=> $razorpay_pay_details['method'], 'gateway_charges'=>(($razorpay_pay_details['fee']/100)-($razorpay_pay_details['tax']/100)), 'gst_charges'=>($razorpay_pay_details['tax']/100)],['tpid'=>$pay_id,'raz_order_id'=>$razorpay_order_id]);


// vendor wise data checkout with order id generate
$group_by_vendor_q = all_data("SELECT 
  vendors.id AS V_ID, 
  `phid` AS phid,
`admin_commission`,
product_qty,
(SELECT MIN(ph_dp) +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid`)
 AS ph_price,

  ((SELECT MIN(ph_dp) +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid`)*product_qty)+ph_shipping_charge AS HDR_AMNT
  FROM
vendors JOIN tbl_product_hdr ON  vendors.id = tbl_product_hdr.vendor_id
JOIN tbl_cart ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE tbl_cart.user_id = '".$_SESSION['id']."' && tbl_cart.cart_status = 1
GROUP BY vendors.id
");

foreach($group_by_vendor_q['all_data'] as $val_g_by){


// coupon code query 

$coupon_amt = 0;
$coupon_id = 0;
$single_ph_val= ($val_g_by['product_qty']*$val_g_by['ph_price']);
$coupon_code = NULL;
$ACTUAL_AMT_COUPON = 0;
$COUPON_TYPE = NULL;
$DISCOUNT_AMT = 0;


if ($coupon_code_query['data']==true) {
  if (isset($_SESSION['coupon_code']) && $_SESSION['coupon_code'] !='') {
    $coupon_products = $coupon_code_query['coupon_products'];
        $apply_coupon_code = apply_coupon_code($_SESSION['coupon_code'],$coupon_products,$coupon_code_query,$val_g_by['product_qty'],$val_g_by['ph_price'],$val_g_by['phid']);
        $DISCOUNT_AMT = $apply_coupon_code['coupon_amt'];
        $single_ph_val = $apply_coupon_code['product_val'];

        $coupon_id = $apply_coupon_code['COUPON_ID'];
        $coupon_code = $apply_coupon_code['COUPON_CODE'];
        $COUPON_TYPE = $apply_coupon_code['COUPON_TYPE'];
        $ACTUAL_AMT_COUPON = $apply_coupon_code['COUPON_AMT'];

}
}

$TOTAL_AMT += ($val_g_by['product_qty']*$val_g_by['ph_price']);

$order_amount += ($single_ph_val); // calculate products amount

// update coupon limit

update("UPDATE tbl_coupons SET left_limit = (left_limit-1) WHERE coupon_id = '$coupon_id' && coupon_code = '$coupon_code' ");

$order_wise_payment = $single_ph_val;

$products_id = [];

// vendor wise order hdr generate
  $order_hdr_q = "INSERT INTO tbl_order_hdr SET user_id = '".$_SESSION['id']."', payment_id = '$pay_id', coupon_id = '$coupon_id', coupon_code = '$coupon_code', coupon_actual_amt = '$ACTUAL_AMT_COUPON', coupon_type = '$COUPON_TYPE', discount_amt = '$DISCOUNT_AMT', pay_amnt = '$order_wise_payment', total_amt = '".$val_g_by['ph_price']."', vendor_amt = '".$val_g_by['HDR_AMNT']."'
  ";
  $order_hdr_ins_fun = insert($order_hdr_q);

   // check data for insert or not. And, count = last insert id
  if ($order_hdr_ins_fun['count'] > 0) {


  $last_id = $order_hdr_ins_fun['count'];


  //vendor wise product finding from cart table

  $vendors_product = all_data("SELECT 
`phid`,
`ph_title`,
`ph_shipping_charge`,
`ph_feature_img`,
`admin_commission`,
(SELECT MIN(ph_dp) +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid`)
 AS ph_price,
    `product_id`,
   `phid` AS `product_id`,
    `cartid`

   FROM
  vendors JOIN tbl_product_hdr ON  vendors.id = tbl_product_hdr.vendor_id
  JOIN tbl_cart ON tbl_cart.product_id = tbl_product_hdr.phid
  JOIN tbl_product_dtl ON tbl_product_dtl.product_id = tbl_product_hdr.phid
  WHERE tbl_cart.user_id = '".$_SESSION['id']."' && vendors.id  = '".$val_g_by['V_ID']."' && tbl_cart.cart_status = 1");

  // array for store order details id
  $order_dtl_ids = [];

  $vendor_amt = 0;
  foreach ($vendors_product['all_data'] as $k_u_p => $v_u_p) {
    
    array_push($products_id, $v_u_p['product_id']); // store products id in array

  // store data 
  $ins_product_qty = $v_u_p['product_qty'];
  $ins_product_price = $v_u_p['ph_price'];
  $ins_cartid = $v_u_p['cartid'];
  $vendor_amt +=($v_u_p['ph_price']*$v_u_p['product_qty']);
  //consultant id
  $consultant_id = consultant_calc($ins_cartid,$last_id,$_SESSION['id']);

    //order id generate
    $order_id = 'OD'.str_pad($_SESSION['id'],5,'0', STR_PAD_LEFT).str_pad($last_id,3,'0', STR_PAD_LEFT); // order id generate

    // order details insert query
    $product_details_ins_q = "INSERT INTO tbl_order_dtl SET user_id = '".$_SESSION['id']."', product_id = '".$v_u_p['phid']."', order_id = '$order_id', order_hdr_id = '$last_id', merge_p_id = '$implode_products_id', product_qty = '$ins_product_qty', product_price = '$ins_product_price', total_paid_amnt = '$pay_amnt', f_name = '$order_first_name', l_name = '$order_last_name', company = '$orde_company_name', country = '$order_country', street_addrs = '$order_streeet_adrs', apartment = '$order_apartment', town = '$order_town', state = '$order_state', zip = '$order_zp', notes = '$order_notes', phone = '$order_phone', email = '$order_email', admin_commission = '$admin_commission' ";
    $product_ins_det_fucn = insert($product_details_ins_q);
    // store order details id data in array_push. for updating all id in order_hdr table. for future report finding.

    if ($product_ins_det_fucn['count']>0) {
    array_push($order_dtl_ids, $product_ins_det_fucn['count']);
    }

    // update tbl_cart data
    $update_tbl_cart_q = "UPDATE tbl_cart SET cart_status = 2 WHERE cartid = '$ins_cartid' ";
    update($update_tbl_cart_q);


    // Update stock out table and quantity of product header table

      foreach ($vendors_product['all_data'] as $ckey => $cvalue) {

      // echo '<pre>', print_r($products_q_func) , '</pre>';
      $user = $_SESSION['id'];
      $pid = $cvalue['product_id'];
      $qty = $cvalue['product_qty'];

      $sql = "INSERT INTO stock_out SET user_id=$user, product_id=$pid, order_id=$last_id, quantity=$qty";
      insert($sql);
      $sql1 = "UPDATE tbl_product_hdr SET ph_qty= (ph_qty - $qty) WHERE phid=$pid";
      update($sql1);


      } // end loop for product qty stock

    } // end loop for vendor wise all products

    $implode_products_id = implode(',',$products_id);

    $implode_order_det_id = implode(',', $order_dtl_ids);
    // update order_hdr order details & order_dtl ids
    $update_product_hdr_query = "UPDATE tbl_order_hdr SET consultant_id = '$consultant_id', order_id = '$order_id', order_dtl_id = '$implode_order_det_id', products_id = '$implode_products_id', vendor_amt = '$vendor_amt' WHERE order_hdr_id = '$last_id' ";
    update($update_product_hdr_query);

  }


}
}

?>
