<?php 
include 'functions.php';

if (isset($_POST['address_id'])) {
	extract($_POST);
	
    $return_status = true;
	$user_data = single_data("SELECT * FROM users WHERE id = '".$_SESSION['id']."' ")['all_data'];
	$avail_bonus_amt = $user_data['bonus_wallet'];

	$total_bonus_amt = 0;
	
	$re_address = conditon_data('tbl_address','*',['address_id' => $address_id]);
	if($re_address['data']==true){
	$return_status = true;
	$re_address = $re_address['all_data'];
	$order_first_name = $re_address['f_name']; 
	$order_last_name = $re_address['l_name']; 
	$orde_company_name = $re_address['company'];
	$order_country = $re_address['country'];
	$order_streeet_adrs = $re_address['street_addrs'];
	$order_apartment = $re_address['apartment'];
	$order_town = $re_address['town'];
	$order_zp = $re_address['zip'];
	$order_phone = $re_address['phone'];
	$order_emai = $re_address['email'];
	$gst_number = $re_address['gst_number'];
	
	$state_name = single_data("SELECT state_name,state_tin_number FROM tbl_state WHERE state_tin_number = '$order_state' ")['all_data'];
    $state_name = $state_name['state_name'];
    $order_state  = $state_name['state_tin_number'];
	
	
	$customer_paid_amt = 0;
	$order_amount = 0;
	$TOTAL_AMT = 0;

	$actual_order_value = 0;

	$coupon_code_query = coupon_code_check($_SESSION['coupon_code'],$_SESSION['id']);

	$order_hdr_id =[];

	$dynamic_shipping_charge = 0;

	// vendor wise data checkout with order id generate
$group_by_vendor_q = all_data("SELECT
    vendors.id AS V_ID,
    `phid` AS phid,
    `admin_commission`,
    `product_dtl_id`,
    `product_qty`,

    (SELECT ph_dp +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid` && `pdid` = `product_dtl_id`) AS ph_price,

  ((SELECT ph_dp +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid` && `pdid` = `product_dtl_id`)*product_qty) AS HDR_AMNT,
  (
    SELECT
        COUNT(DISTINCT(vendor_id)) AS TOTAL_VENDOR
    FROM
        tbl_cart
    JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
    WHERE
        user_id = '".$_SESSION['id']."' && cart_status = 1 && `phid` = `phid`
) AS TOTAL_VENDOR

FROM
    vendors
JOIN tbl_product_hdr ON vendors.id = tbl_product_hdr.vendor_id
JOIN tbl_cart ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE
    tbl_cart.user_id = '".$_SESSION['id']."' && tbl_cart.cart_status = 1
GROUP BY
    vendors.id
");

$shipping_fee_amt = single_data("SELECT min_cart_val FROM common_settings WHERE csid =  1 ")['all_data'];
$shipping_charges = 0;
// start group by vendor
	foreach($group_by_vendor_q['all_data'] as $val_g_by){ 

	$shipping_charges = $dynamic_shipping_charge;
		// coupon code query 

		$coupon_amt = 0;
		$coupon_id = 0;
		$single_ph_val= ($val_g_by['product_qty']*$val_g_by['ph_price']);
		$coupon_code = NULL;
		$ACTUAL_AMT_COUPON = 0;
		$COUPON_TYPE = NULL;
		$DISCOUNT_AMT = 0;

		// start coupon code condition
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
		} //end, coupon code condition

		$TOTAL_AMT += ($val_g_by['product_qty']*$val_g_by['ph_price']);

		$order_amount += ($single_ph_val); // calculate products amount

		

		// update coupon limit

	update("UPDATE tbl_coupons SET left_limit = (left_limit-1) WHERE coupon_id = '$coupon_id' && coupon_code = '$coupon_code' ");

	$order_wise_payment = $single_ph_val;

	$products_id = [];


	// vendor wise order hdr generate
  $order_hdr_q = "INSERT INTO tbl_order_hdr SET user_id = '".$_SESSION['id']."', coupon_id = '$coupon_id', coupon_code = '$coupon_code', coupon_actual_amt = '$ACTUAL_AMT_COUPON', coupon_type = '$COUPON_TYPE', discount_amt = '$DISCOUNT_AMT', vendor_amt = '".$val_g_by['HDR_AMNT']."', customer_state_tin = '$order_state'
  ";
  $order_hdr_ins_fun = insert($order_hdr_q);


  // if, order_hdr_insert, then start again loop for, order_dtl
  if ($order_hdr_ins_fun['count'] > 0){

  	// update shipping charges
  	update("UPDATE tbl_order_hdr SET shipping_charges = 0 WHERE order_hdr_id = '".$order_hdr_ins_fun['count']."' ");

  	array_push($order_hdr_id,$order_hdr_ins_fun['count']);
  	//order id generate
    $order_id = 'INV'.str_pad($order_hdr_ins_fun['count'],5,'0', STR_PAD_LEFT);

  	  //vendor wise product finding from cart table

  $vendors_product = all_data("SELECT 
		`phid`,
		`admin_commission`,
		`product_dtl_id`,
		`size`,
		`color`,
		(SELECT ph_dp +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
		  FROM tbl_product_dtl WHERE `product_id` = `phid` && `pdid` = `product_dtl_id`)
		 AS ph_price,
		  (SELECT ph_dp FROM tbl_product_dtl WHERE `product_id` = `phid` && `pdid` = `product_dtl_id`) AS product_actual_amt,
		   `tbl_product_hdr`.`phid` AS `product_id`,
		    `cartid`,
		    `product_qty`,
		    `ph_consultant_seller`,
		     `cosultant_id_seller`,
		    `ph_consultant_supplier`,
		    `consultant_id_supplier`,
		    `ph_tax`,
		    `ph_bonus`
		   FROM
		  vendors JOIN tbl_product_hdr ON  vendors.id = tbl_product_hdr.vendor_id
		  JOIN tbl_cart ON tbl_cart.product_id = tbl_product_hdr.phid
		  WHERE tbl_cart.user_id = '".$_SESSION['id']."' && vendors.id  = '".$val_g_by['V_ID']."' && tbl_cart.cart_status = 1");

  		  // array for store order details id
  			$vendor_amt = 0;

  			$order_dtl_id = [];
            
            $shipping_charge_update_hdr = 0;
            
  			// loop start for, vendors all product
  			foreach ($vendors_product['all_data'] as $v_u_p){ 
            
            $shipping_charge_update_hdr = $v_u_p['ph_shipping_charge'];
            update("UPDATE tbl_order_hdr SET shipping_charges = shipping_charges+'".$shipping_charge_update_hdr."' WHERE order_hdr_id = '".$order_hdr_ins_fun['count']."' ");
            
  				// update stoc details

  				$sql_ins_stock_out = "INSERT INTO stock_out SET user_id='".$_SESSION['id']."', product_id='".$v_u_p['phid']."', order_id='".$order_hdr_ins_fun['count']."', quantity='".$v_u_p['product_qty']."', product_details_id = '".$v_u_p['product_dtl_id']."' ";
		      insert($sql_ins_stock_out);

		      $sql1_qty_out = "UPDATE tbl_product_dtl SET ph_qty= (ph_qty - '".$v_u_p['product_qty']."') WHERE pdid='".$v_u_p['product_dtl_id']."'";
		      update($sql1_qty_out);

		      // update tbl_cart data
    			$update_tbl_cart_q = "UPDATE tbl_cart SET cart_status = 2 WHERE cartid = '".$v_u_p['cartid']."' ";
    			update($update_tbl_cart_q);

  				// calculate bonus amount
				if ($avail_bonus_amt>0) {
				    $total_bonus_amt += ((($v_u_p['ph_price']*$v_u_p['product_qty'])*$v_u_p['ph_bonus'])/100);
				    $bonus_percent = $v_u_p['ph_bonus'];
				}else{
					$bonus_percent = 0;
				}

  				array_push($products_id, $v_u_p['product_id']); // store products id in array
  				
  					// store data 
				  $ins_product_qty = $v_u_p['product_qty'];
				  $ins_product_price = $v_u_p['ph_price'];
				  $ins_cartid = $v_u_p['cartid'];
				  $vendor_amt +=($v_u_p['ph_price']*$v_u_p['product_qty']);

				  $actual_order_value += ($v_u_p['ph_price']*$v_u_p['product_qty']);

				  // order details insert query
    		$product_details_ins_q = "INSERT INTO tbl_order_dtl SET user_id = '".$_SESSION['id']."', product_id = '".$v_u_p['phid']."', order_id = '$order_id', order_hdr_id = '".$order_hdr_ins_fun['count']."',  product_qty = '$ins_product_qty', product_price = '$ins_product_price', f_name = '$order_first_name', l_name = '$order_last_name', company = '$orde_company_name', country = '$order_country', street_addrs = '$order_streeet_adrs', apartment = '$order_apartment', town = '$order_town', state = '".$state_name['state_name']."', zip = '$order_zp', notes = '$order_notes', phone = '$order_phone', email = '$order_email', product_admin_commi = '".$v_u_p['admin_commission']."',
    		cons_supplier_percent  = '".$v_u_p['ph_consultant_supplier']."', cons_supplier_id = '".$v_u_p['consultant_id_supplier']."', cons_seller_percent = '".$v_u_p['ph_consultant_seller']."', cons_seller_id = '".$v_u_p['cosultant_id_seller']."', customer_bonus_percent = '".$bonus_percent."', product_tax = '".$v_u_p['ph_tax']."', customer_gst_number = '".$gst_number."', product_dtl_id = '".$v_u_p['product_dtl_id']."', product_color = '".$v_u_p['color']."', product_size = '".$v_u_p['size']."', product_actual_amt = '".$v_u_p['product_actual_amt']."'
    		";
    		$product_ins_det_fucn = insert($product_details_ins_q);
    		// store order details id data in array_push. for updating all id in order_hdr table. for future report finding.

    		array_push($order_dtl_id, $product_ins_det_fucn['count']); // store order_dtl_id in array

  			} // end loop for vendors all product

  			// update order_hdr for order_id & order_dtl_id, where only vendor wise loop running
  			$order_dtl_id = implode(',', $order_dtl_id);
  			update("UPDATE tbl_order_hdr SET order_id = '".$order_id."',  order_dtl_id = '".$order_dtl_id."' WHERE order_hdr_id = '".$order_hdr_ins_fun['count']."'  ");

  		} // end if condition, for vendor wis eorder_hdr_insert checking



	} // end foreach loop, as using group by vendor

	if ($avail_bonus_amt>0) {
    //$total_bonus_amt;
    
    if ($avail_bonus_amt>=$total_bonus_amt) {
        $print_bonus_amt = $total_bonus_amt;
    }
    else{
        $print_bonus_amt = $avail_bonus_amt;
         
    }

	}else{
	    $print_bonus_amt = 0;
	}

	update("UPDATE users SET bonus_wallet = bonus_wallet-$print_bonus_amt WHERE id = '".$_SESSION['id']."' ");

	
	//$customer_paid_amt = ($customer_paid_amt-$print_bonus_amt);

	

	$order_amt_master = insert("INSERT INTO tbl_order_amt_master SET user_id = '".$_SESSION['id']."' ");

	if ($order_amount>=$shipping_fee_amt['min_cart_val']) {
		$shipping_charges = 0;
	}

	if ($order_amt_master) {
		// code...
		$final_ship_charge=0;
	for ($i=0; $i < count($order_hdr_id); $i++) {

			$retrive_acutal_amt = single_data("SELECT SUM(order_value) AS order_value FROM tbl_order_dtl WHERE order_hdr_id = '".$order_hdr_id[$i]."' ")['all_data'];
			
			$customer_paid_amt += ($retrive_acutal_amt['order_value']);

			$final_ship_charge += $shipping_charges;

			update("UPDATE tbl_order_hdr SET order_amt_master_id = '".$order_amt_master['count']."', shipping_charges = '".$shipping_charges."' WHERE order_hdr_id = '".$order_hdr_id[$i]."' ");
		}
	}

	$implode_order_hdr_id = implode(',', $order_hdr_id);
	
	$order_master_id = 'OD'.str_pad($_SESSION['id'],5,'0', STR_PAD_LEFT).str_pad($order_amt_master['count'],5,'0', STR_PAD_LEFT);

	$final_coupon_amt = ($customer_paid_amt-$_SESSION['coupon_amount']);

	$customer_paid_amt  = (($customer_paid_amt+$final_ship_charge)-($print_bonus_amt+$final_coupon_amt));

	update("UPDATE tbl_order_amt_master SET order_hdr_id = '$implode_order_hdr_id', customer_bonus_amt = '$print_bonus_amt', customer_paid_amt = '$customer_paid_amt', order_master_id = '$order_master_id' WHERE master_id = '".$order_amt_master['count']."' ");


//unset($_SESSION['coupon_code']);
//unset($_SESSION['coupon_amount']);
}else{
    $return_status = false;
}
echo $return_status;
}
?>
