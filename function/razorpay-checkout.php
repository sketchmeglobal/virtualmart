<?php
include 'functions.php';


require_once('../razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

if (isset($_POST) && isset($_POST['name']) && isset($_POST['p_token']) && $_POST['p_token']==$_SESSION['razorpay_token']) {

// amount calculator
  $checkout_products = "SELECT * FROM tbl_cart 
JOIN tbl_product_hdr ON tbl_cart.product_id =  tbl_product_hdr.phid
JOIN tbl_product_dtl ON tbl_product_dtl.product_id = tbl_product_hdr.phid
WHERE user_id = '".$_SESSION['id']."' && cart_status = 1 ";

$checkout_func = all_data($checkout_products);
$checkout_amount = 0;

$shipping_free_amt = single_data("SELECT min_cart_val FROM common_settings WHERE csid =  1 ")['all_data'];
$shipping_charges = 0;

foreach ($checkout_func['all_data'] as $key_p => $value_p) { 
$checkout_amount +=($value_p['product_qty']*$value_p['ph_price']);
$shipping_charges += $value_p['ph_shipping_charge'];
}

  if (isset($_SESSION['coupon_amount']) && $_SESSION['coupon_amount']>0 && $checkout_amount>0) {
   $checkout_amount = $_SESSION['coupon_amount'];
  }else{
      $checkout_amount =0;
  }

if ($checkout_amount<=$shipping_free_amt['min_cart_val']) {
  $checkout_amount +=$shipping_charges;
}


// razorpay 
$raz_data = single_data("SELECT key_id, secret_id FROM tbl_razorpay_setting WHERE razid = 1 ")['all_data'];
$api = new Api($raz_data['key_id'], $raz_data['secret_id']);

$raz_order = $api->order->create(array('receipt' => '123', 'amount' => ($checkout_amount*100), 'currency' => 'INR'));

// insert tbl_payments
$data_ins_arr = [
  'raz_order_id'=>$raz_order['id'],
  'pay_amount'=>$checkout_amount, 
  'raz_name'=>$_POST['name'], 
  'raz_email'=>$_POST['email'], 
  'raz_mobile'=>$_POST['contact']
];
$pay_ins = bind_insert('tbl_payments',$data_ins_arr);
if ($pay_ins['count']>0) {
  $ret_data['raz_order_id'] = $raz_order['id'];
  $ret_data['key_id'] = $raz_data['key_id'];
  $ret_data['amount'] = ($checkout_amount*100);
  $ret_data['name'] = $_POST['name'];
  $ret_data['email'] = $_POST['email'];
  $ret_data['contact'] = $_POST['contact'];
  $ret_data['status'] = true;
  $ret_data['pay'] = $pay_ins['count'];
}else{
  $ret_data['status'] = $raz_order;
}

  echo json_encode($ret_data);
}
?>
