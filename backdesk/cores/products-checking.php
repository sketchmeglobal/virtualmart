<?php 
if (isset($_POST['allow_check'])) {
  extract($_POST);
$allowed_products = explode(',',$allowed_products);
$disallowed_products = explode(',',$disallowed_products);
$arr = array_intersect($allowed_products, $disallowed_products);
  if (!empty($arr)) {
     echo 'Product already disallowed';
  }else{
    echo 1;
  }

}

if (isset($_POST['disallow_check'])) {
  extract($_POST);
$allowed_products = explode(',',$allowed_products);
$disallowed_products = explode(',',$disallowed_products);
$arr = array_intersect($allowed_products, $disallowed_products);
  if (!empty($arr)) {
     echo 'Product already allowed';
  }else{
    echo 1;
  }

}

?>