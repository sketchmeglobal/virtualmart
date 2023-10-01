<?php

if (isset($_POST['cart_header'])) {
 extract($_POST);

include 'functions.php';

// product id decode 
$decode_pid = decode($cart_header);


$remove_sql = "UPDATE tbl_cart SET cart_status = 0 WHERE product_id = '$decode_pid' && user_id = '".$_SESSION['id']."' ";

update($remove_sql);



 } ?>