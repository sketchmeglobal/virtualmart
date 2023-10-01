<?php 
include 'functions.php';
if (isset($_POST['p_color'])) {
	extract($_POST);
	//$html[]='';
	$html['option'] = '';
	$q = all_data("SELECT DISTINCT pd_size FROM tbl_product_dtl WHERE pd_color = '$p_color' && product_id = '$pid' ");
	$inc = 1;
	foreach ($q['all_data'] as  $value) {
		if ($inc==1) {
			$html['selected'] = $value['pd_size'];
		}
		$html['option'] .='<option value="'.$value['pd_size'].'">'.$value['pd_size'].'</option>';
	$inc++;}
	echo json_encode($html);
}


if (isset($_POST['p_size'])) {
	extract($_POST);
	$q = single_data("SELECT admin_commission, ph_qty, ph_dp FROM tbl_product_dtl
		JOIN tbl_product_hdr ON tbl_product_dtl.product_id = tbl_product_hdr.phid
	 WHERE tbl_product_dtl.pd_size = '$p_size' && tbl_product_dtl.pd_color = '$color' && tbl_product_dtl.product_id = '$pid' ");
	$calc = (($q['all_data']['ph_dp']*$q['all_data']['admin_commission'])/100);
	$return_data['price'] = number_format($q['all_data']['ph_dp']+$calc,2);
	$return_data['ph_qty'] = $q['all_data']['ph_qty'];
	echo json_encode($return_data);
}

 ?>

