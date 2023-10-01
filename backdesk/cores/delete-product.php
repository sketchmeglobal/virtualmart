<?php 
if (isset($_GET['product'])) {
	include '../../function/functions.php';
	$id = decode($_GET['product']);

	$delet_sql = "UPDATE tbl_product_hdr SET ph_status = 2 WHERE phid = '$id' ";
	$func = update($delet_sql);
	if ($func==true) {
		echo '<script>alert("Product Deleted");window.location.href="../all-products.php";</script>';
	}else{
		echo '<script>alert("Please try again");window.location.href="../all-products.php";</script>';
	}

}

 ?>