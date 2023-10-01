<?php
include 'functions.php';
if(isset($_POST['product_id'])){
    extract($_POST);
    $decode_pid = decode($_POST['product_id']);
    $check_wishlist = single_data("SELECT * FROM tbl_wishlist WHERE cartid = '".$decode_pid."' && cart_status = 1 && user_id = '".$_SESSION['id']."'");
    print_r($check_wishlist['all_data']);
if ($check_wishlist['data']==true){
    
    $data = $check_wishlist['all_data'];
    
    update("UPDATE tbl_wishlist SET cart_status = 0 WHERE cartid = '".$decode_pid."' ");
    
    $check_already_exist_cart = single_data("SELECT * FROM tbl_cart WHERE product_id = '".$data['product_id']."' && cart_status = 1 && user_id = '".$_SESSION['id']."'");
    
    if($check_already_exist_cart['data']==true){
        update("UPDATE tbl_cart SET  product_dtl_id = '".$data['product_dtl_id']."', size = '".$data['size']."', color = '".$data['color']."', product_qty = '".$data['product_qty']."' ");
    
    }else{
         insert("INSERT INTO tbl_cart SET user_id = '".$_SESSION['id']."', product_id = '".$data['product_id']."', product_dtl_id = '".$data['product_dtl_id']."', 
    size = '".$data['size']."', color = '".$data['color']."', cosultant_id_seller = '".$data['cosultant_id_seller']."', consultant_id_supplier = '".$data['consultant_id_supplier']."',
    product_qty = '".$data['product_qty']."' ");
    }
    
   
    
}
echo true;
}

?>