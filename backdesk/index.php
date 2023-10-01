<?php

include 'cores/comm-head.php';
$dash = single_data("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
$dash_data = $dash['all_data'];

if ($dash_data['user_type']=='CONSULTANT') {
  header('location:consultant.php');
  //include 'consultant-pages/consultant.php';
}

elseif ($dash_data['user_type']=='VENDOR') {
  header('location:vendor.php');
}

else{
  include 'call-index.php';
}
?>