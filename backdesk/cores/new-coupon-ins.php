<?php
if (isset($_POST['insert'])) {
	include '../../function/functions.php';
	extract($_POST);
	$allowed_products_implode = (empty($allowed_products)) ? NULL:implode(',', $allowed_products);
	$disallowed_products_implode = (empty($disallowed_products)) ? NULL:implode(',', $disallowed_products);


	// token checking
	if ($_SESSION['token']==$token) {
				// check coupon code 
				$coupon_code_select = "SELECT * FROM tbl_coupons WHERE coupon_code = '$coupon_code' ";
				$func1 = single_data($coupon_code_select);

				if ($func1['data']==true) {
					$_SESSION['msg'] = 'Coupon Code already exists';
				}
				else{ // else for coupon code function checking
					
					// checking products double entry or not

					if (empty($allowed_products_implode) || empty($disallowed_products)) {
						$array = NULL;
					}else{
						$array = array_intersect($allowed_products, $disallowed_products);
					}
					if (empty($array)) {
						// code...
					

					// insert coupon query
					$sql_ins = "INSERT INTO tbl_coupons SET coupon_code = '$coupon_code', allowed_products = '$allowed_products_implode', disallowed_products = '$disallowed_products_implode', coupon_type = '$coupon_type', amount = '$coupon_amount', max_limit = '$max_limit', left_limit = '$max_limit', expiary_date = '$expiary_date', status = '$coupon_status' ";
					
					$last_id_query = insert($sql_ins);
					$last_id = $last_id_query['count']; // fetch last id using insert funciton

					if (!empty($allowed_products)) {
						for ($i=0; $i < count($allowed_products); $i++) {
							insert("INSERT INTO tbl_child_coupon_code SET coupon_id = '$last_id', product_id = '".$allowed_products[$i]."', allow_type = 'ALLOW' ");
						}
					}

					if (!empty($disallowed_products)) {
						for ($i=0; $i < count($disallowed_products); $i++) {
							insert("INSERT INTO tbl_child_coupon_code SET coupon_id = '$last_id', product_id = '".$disallowed_products[$i]."', allow_type = 'DISALLOW' ");
						}
					}
					$_SESSION['msg']='Coupon added';
				} //
				 else{
				 	$_SESSION['msg']='Products duplicate entry';
				}
			
					
				}
	}else{ // else for token
		$_SESSION['msg']="Please try again";
	}
}
echo '<h2 style="text-center">';
echo $_SESSION['msg'];
header("Refresh:2; url=../coupon-new.php");
?>