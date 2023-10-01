<?php
/*$servername = "localhost:8888";
$username = "root";
$password = "";
$database = "new_ca_ecomm";*/

$servername = "localhost";
$username = "fyivtamy_main_db_usr";
$password = "q6SVUZ}L(j%]";
$database = "fyivtamy_Main_dB";
$con = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();

/*define url*/
$website_url = 'https://virtualmart.co.in/';
define("base_url",$website_url);
define("site_url",$website_url);
define("home_url",$website_url);
define("site_name","Virtualmart");


date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = date("H:i:s");


$sql = $con->prepare("SET sql_mode='' ");
$sql->execute();


// Store the cipher method
$ssl_ciphering = "AES-128-CTR";

$ssl_server_key = '0';

// Non-NULL Initialization Vector for encryption
$ssl_private_key = 'sfvgfsgfg';

// Store the encryption key
$ssl_public_key = "4354364364";



function soft_delete($table,$p_key,$id){
    global $con;
  $daat = [];

$sql = $con->prepare("UPDATE $table SET row_status =  0 WHERE $p_key = :$p_key ");

$sql->bindValue(":$p_key",$id);

$sql->execute();
$count = $sql->rowCount();
if ($count>0) {
    $data['status'] = true;
}else{
    $data['status'] = false;
}

  return $data;
}


function openssl_enc($data){
  global $ssl_ciphering, $ssl_public_key, $ssl_server_key, $ssl_private_key;

  return $encryption = openssl_encrypt($data, $ssl_ciphering, $ssl_public_key, $ssl_server_key, $ssl_private_key);
}

function openssl_dec($data){
  global $ssl_ciphering, $ssl_public_key, $ssl_server_key, $ssl_private_key;

  return $dec = openssl_decrypt($data, $ssl_ciphering, $ssl_public_key, $ssl_server_key, $ssl_private_key);
}

function login($userid,$pass,$admin=false){
global $con, $date, $time;
$data = [];
$salt = 'salt0';
$password = $pass;
$enc_pass = md5($salt.$pass);
$sql = $con->prepare("SELECT * FROM `users` WHERE (`contact` = :userid ||  `email` = :userid) && `pass` = :enc_pass && `row_status` = 1 ");

$sql->bindValue(":userid",$userid);
$sql->bindValue(":enc_pass",$enc_pass);

$sql->execute();
$count = $sql->rowCount();
if ($count>0) {
$fetch = $sql->fetch();
// check user role for, admin login
if ($fetch['role']==0) {
$_SESSION['admin'] = false;
}else{
$_SESSION['admin'] = $admin;
}
if($fetch['status']==1){
  $data['status'] = true;
  $_SESSION['id'] =$fetch['id'];
  $_SESSION['fullname'] =$fetch['f_name'] . ' ' .$fetch['l_name'];
  $_SESSION['contact'] =$fetch['contact'];
  $_SESSION['status'] =$fetch['status'];
  $_SESSION['role'] =$fetch['role'];
  $_SESSION['user_type'] =$fetch['user_type'];
}else{
  $data['status'] = false;
}

}else{
$data['status'] = false;
}
return $data;
}

function gst($vendor_state_tin,$customer_state_tin,$tax,$amount){
  $daat = [];

  $tax_calc = ($tax*2);
  $tax_amount = (($amount*$tax_calc)/100);

  $data['TAX_AMT'] = $tax_amount;
  if ($vendor_state_tin==$customer_state_tin) {
      
      $data['TYPE'] = 'INNER';
      $data['S_GST'] = ($tax_amount/2);
      $data['C_GST'] = ($tax_amount/2);
  }else{
    $data['TYPE'] = 'OUTER';
    $data['I_GST'] = ($tax_amount);
  }

  return $data;
}

function register($Fname,$Lname,$mobile,$email,$pass, $user_type = 'USER'){
global $con, $date, $time;
$data = [];
$salt = 'salt0';
$password = $pass;
$enc_pass = md5($salt.$pass);
$check = $con->prepare("SELECT * FROM `users` WHERE `contact` = :mobile ||  `email` = :email ");
$check -> bindValue(':mobile',$mobile);
$check -> bindValue(':email',$email);
$check->execute();

$count = $check->rowCount();
if ($count>0) {
$data['status'] = false;
}else{
$sql = $con->prepare("INSERT INTO users SET f_name = :Fname, l_name = :Lname, contact = :mobile, email = :email, pass = :enc_pass, status = '1', user_type = '$user_type' ");

$sql -> bindValue(':Fname',$Fname);
$sql -> bindValue(':Lname',$Lname);
$sql -> bindValue(':mobile',$mobile);
$sql -> bindValue(':email',$email);
$sql -> bindValue(':enc_pass',$enc_pass);

$sql->execute();
if ($sql->rowCount()>0) {
$data['status'] = true;
$_SESSION['id'] = $con->lastInsertId();
$_SESSION['fullname'] =$Fname . ' ' .$Lname;
$common_settings = single_data("SELECT * FROM common_settings WHERE csid =  1 ")['all_data'];
login($mobile,$pass);
insert("INSERT INTO tbl_signup_bonus_history SET user_id = '".$_SESSION['id']."', bonus_amt = '".$common_settings['customer_signup_bonus']."' ");
update("UPDATE users SET bonus_wallet = '".$common_settings['customer_signup_bonus']."' WHERE id = '".$_SESSION['id']."' ");

insert("INSERT INTO tbl_accounts SET pk = '".$_SESSION['id']."', pk_type = '$user_type', amount = '".$common_settings['customer_signup_bonus']."', from_status = 'new user registration', to_status = 'signup bonus added' ");

}else{
$data['status'] = false;
}
}
return $data;
}
function insert($sql){
try{

global $con, $date, $time;

$data = [];
$query = $con->prepare($sql);
$query->execute();

if ($query->rowCount()>0) {
$data['status'] = true;
$data['count'] = $con->lastInsertId();
}else{
$data['count'] = -1;
$data['status'] = false;
}
return $data;

}
catch (PDOException $e) {
echo $e->getMessage();
}
}
function check($sql){

global $con, $date, $time;
$data = [];
$query = $con->prepare($sql);
$query->execute();

if ($query->rowCount()>0) {
$data['status'] = true;
$data['count'] = $query->rowCount();
}else{
$data['count'] = false;
$data['status'] = false;
}

return $data;
}
function all_data($sql){

global $con, $date, $time;

try {
$query = $con->prepare($sql);
$query->execute();
$rowCount = $query->rowCount();

if ($rowCount>0) {
$data['data']     = true;
$data['all_data'] = $query->fetchAll();
}else{
$data['data']     = false;
$data['all_data']   = NULL;
}
}
catch (PDOException $e) {
//error
$data['data'] = NULL;
$data['all_data'] = "Error: " . $e->getMessage();
}

return $data;

}


function conditon_update($table,$data=[],$condition=[]){
  try{
    global $con;
    $sql = "UPDATE " .$table;
    $sql .= ' SET '; 

    // data update value 
    $i = 0;
  
    foreach ($data as $key => $value) {
      $pre = ($i > 0)?' , ':''; 

      if (strpos($key, ".") !== false) {
        $explode = explode('.', $key);
        $sql .= $pre.$key." = :".$explode[1]; 
      }
      else{
        $sql .= $pre.$key." = :".$key;
      }

      
      $i++; 
    }


    // condtion data set
    $sql .= ' WHERE ';

    $l = 0;
  
    foreach ($condition as $ky => $val) {
      $pre_l = ($l > 0)?' AND ':''; 

      if (strpos($ky, ".") !== false) {
        $explode_l = explode('.', $ky);
        $sql .= $pre_l.$ky." = :".$explode_l[1]; 
      }
      else{
        $sql .= $pre_l.$ky." = :".$ky;
      }

      
      $l++; 
    }


    $query = $con->prepare($sql);

    // value bind for data value
    foreach ($data as $k => $v) {

      if (strpos($k, ".") !== false) {

        $explode = explode('.', $k);
        $query->bindValue(":".$explode[1], $v);
      }
      else{
        $query->bindValue(":".$k, $v);
      }
    }


    // where condition data added

    foreach ($condition as $k_l => $v_l) {

      if (strpos($k_l, ".") !== false) {

        $l_explode = explode('.', $k_l);
        $query->bindValue(":".$l_explode[1], $v_l);
      }
      else{
        $query->bindValue(":".$k_l, $v_l);
      }
    }

    $query->execute();
    $rowCount = $query->rowCount();
    if ($rowCount>0) {
    $return['data']     = true;
    }else{
    $return['data']     = false;
    }

    return $return;
  }
  catch (PDOException $e){
    echo $e->getMessage();
  }

}



function conditon_data($table,$data,$condition=[],$additional = ''){
  try{
    global $con;
    $sql = "SELECT " .$data;
    $sql .= ' FROM '.$table. ' WHERE '; 

    $i = 0;
  
    foreach ($condition as $key => $value) {
      $pre = ($i > 0)?' AND ':''; 

      if (strpos($key, ".") !== false) {
        $explode = explode('.', $key);
        $sql .= $pre.$key." = :".$explode[1]; 
      }
      else{
        $sql .= $pre.$key." = :".$key;
      }

      
      $i++; 
    }

    $sql .= ' '. $additional;


    $query = $con->prepare($sql);

    foreach ($condition as $k => $v) {

      if (strpos($k, ".") !== false) {

        $explode = explode('.', $k);
        $query->bindValue(":".$explode[1], $v);
      }
      else{
        $query->bindValue(":".$k, $v);
      }

      
    }

    $query->execute();
    $rowCount = $query->rowCount();
    if ($rowCount>0) {
    $return['data']     = true;
    $return['all_data'] = $query->fetch();
    }else{
    $return['data']     = false;
    }

    return $return;
  }
  catch (PDOException $e){
    echo $e->getMessage();
  }

}


function bind_insert($table,$data=[]){
  try{
    global $con;
    $sql = "INSERT INTO " .$table;
    $sql .= ' SET '; 

    $i = 0;
  
    foreach ($data as $key => $value) {
      $pre = ($i > 0)?', ':''; 
      $sql .= $pre.$key." = :".$key;
      $i++; 
    }

    $query = $con->prepare($sql);

    foreach ($data as $k => $v) {
        $query->bindValue(":".$k, $v);
    }

    $query->execute();
    if ($query->rowCount()>0) {
    $data['status'] = true;
    $data['count'] = $con->lastInsertId();
    }else{
    $data['count'] = -1;
    $data['status'] = false;
    }

    return $data;
  }
  catch (PDOException $e){
    echo $e->getMessage();
  }

}


// history / logs function
function user_log($table_name, $tbl_primary_id, $action, $old_data,$log_type){
  extract($_SERVER);
  $HTTP_SEC_CH_UA_PLATFORM; // action device
  $HTTP_USER_AGENT; // action browser
  $HTTP_REFERER; // action url
  $REMOTE_ADDR; // server ip
  $old_data = json_encode($old_data);

  bind_insert('tbl_logs',['user_id'=> $_SESSION['id'], 'log_type'=>$log_type, 'table_name'=> $table_name,  'tbl_primary_id'=> $tbl_primary_id,  'action'=> $action,  'old_data'=> $old_data,  'user_ip'=> $REMOTE_ADDR, 'user_browser'=> $HTTP_USER_AGENT,  'user_device'=> $HTTP_SEC_CH_UA_PLATFORM, 'action_url'=>$HTTP_REFERER]);


}


function single_data($sql){

try{
global $con;
$query = $con->prepare($sql);
$query->execute();
$rowCount = $query->rowCount();
if ($rowCount>0) {
$data['data']     = true;
$data['all_data'] = $query->fetch();
}else{
$data['data']     = false;
}
return $data;
}catch (PDOException $e) {
echo $e->getMessage();
}
}
function update($sql){
try{
global $con;
$query = $con->prepare($sql);
$query->execute();
$rowCount = $query->rowCount();

if ($rowCount>0) {
$data     = true;
}else{
$data     = false;
}

return $data;
}
catch (PDOException $e) {
echo $e->getMessage();
}

}
function delete($sql){
global $con;
$query = $con->prepare($sql);
$query->execute();
$rowCount = $query->rowCount();
if ($rowCount>0) {
$data     = true;
}else{
$data     = false;
}
return $data;
}

### start encryption

function encode($plainText){
  $key = hextobin(md5('$key'));
  $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
  $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
  $encryptedText = bin2hex($openMode);
  return $encryptedText;
}

function decode($encryptedText){
  $key = hextobin(md5('$key'));
  $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
  $encryptedText = hextobin($encryptedText);
  $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
  return $decryptedText;
}

function hextobin($hexString) 
 { 
  $length = strlen($hexString); 
  $binString="";   
  $count=0; 
  while($count<$length) 
  {       
      $subString =substr($hexString,$count,2);           
      $packedString = pack("H*",$subString); 
      if ($count==0)
      {
      $binString=$packedString;
      } 
      
      else 
      {
      $binString.=$packedString;
      } 
      
      $count+=2; 
  } 
        return $binString; 
  } 


### end encoding & decoding
// add to cart function
function tbl_cart($product_id,$consultant_id,$user_id,$color,$size,$qty=1){
global $con;
$decode_pid = decode($product_id);

$decode_consultant_id = decode($consultant_id); // cosultant id from jquery <- products add to cart
$add_to_cart_cons_id = 0; //
$consultant_id_supplier = 0;
$cosultant_id_seller = 0;

// checking this product having referral vendor

$ref_vendor = conditon_data('tbl_product_hdr JOIN vendors ON tbl_product_hdr.vendor_id = vendors.id','vendors.ref_user_id AS ref_user_id',['tbl_product_hdr.phid'=>$decode_pid],$additional = '');
if ($ref_vendor['all_data']['ref_user_id']>0) {
  $add_to_cart_cons_id = $ref_vendor['all_data']['ref_user_id'];
  $consultant_id_supplier = $ref_vendor['all_data']['ref_user_id'];
}
  //check this is consultant id
$ret_user_cons_query = "SELECT * FROM users WHERE id = '".$decode_consultant_id."' && user_type = 'CONSULTANT' ";
$data_array_func = single_data($ret_user_cons_query);
if ($data_array_func['data']==true) {
if ($data_array_func['all_data']['user_type'] == 'CONSULTANT') {
  $add_to_cart_cons_id = $data_array_func['all_data']['id'];
  $cosultant_id_seller = $data_array_func['all_data']['id'];
}
}

// ret prodcuct details id
$ret_product_dtl_id = single_data("SELECT pdid FROM tbl_product_dtl WHERE product_id = '".$decode_pid."' && pd_color = '$color' && pd_size = '$size' ")['all_data'];

// check pid exist
$check_pid_q = "SELECT * FROM tbl_product_hdr WHERE phid = '$decode_pid' ";
$check_pid_func = check($check_pid_q);
// if status true, then insert
if ($check_pid_func['status']==true) {
// check this product already in cart
$check_cart = "SELECT * FROM tbl_cart WHERE user_id = '".$user_id."' && product_id = '".$decode_pid."' && cart_status = 1 ";
$check_cart_func = check($check_cart);
if ($check_cart_func['status']==true) {
$sql_update = "UPDATE tbl_cart SET product_dtl_id = '".$ret_product_dtl_id['pdid']."', size = '$size', color = '$color', product_qty = product_qty+'$qty' WHERE user_id = '".$user_id."' && product_id = '$decode_pid'";
update($sql_update);
return '<span>Item added to cart</span>';
}else{ // else for cart,

$check_wishlist = single_data("SELECT * FROM tbl_wishlist WHERE user_id = '".$user_id."' && product_id = '$decode_pid' && cart_status = 1 && (cosultant_id_seller > 0 || consultant_id_supplier > 0) LIMIT 1 ");
if ($check_wishlist['data']==true) {


  if ($check_wishlist['all_data']['consultant_id_supplier']>0) {
    $consultant_id_supplier = $check_wishlist['all_data']['consultant_id_supplier'];
  }

  if ($check_wishlist['all_data']['cosultant_id_seller']>0) {
    $cosultant_id_seller = $check_wishlist['all_data']['cosultant_id_seller'];
  }
  
  //delete("DELETE FROM tbl_wishlist WHERE user_id = '".$user_id."' && product_id = '".$decode_pid."' ");
}


$sql_ins_cart = "INSERT INTO tbl_cart SET product_dtl_id = '".$ret_product_dtl_id['pdid']."', size = '$size', color = '$color', product_qty = '$qty', user_id = '".$user_id."', product_id = '".$decode_pid."', cosultant_id_seller = '".$cosultant_id_seller."', consultant_id_supplier = '".$consultant_id_supplier."' ";
insert($sql_ins_cart);
return '<span>Item added to cart</span>';
}
}else{ // else checking for product
return 0;
}
}


// add wishlist function
function tbl_wishlist($product_id,$user_id,$consultant_id,$color,$size,$qty){
  global $con;
  // product id decode
  $decode_pid = decode($product_id);

  $consultant_id_supplier = 0;
  $cosultant_id_seller = 0;
  $decode_consultant_id = decode($consultant_id); // cosultant id from jquery <- products add to cart

  $ret_product_dtl_id = single_data("SELECT pdid FROM tbl_product_dtl WHERE product_id = '".$decode_pid."' && pd_color = '$color' && pd_size = '$size' ")['all_data'];

  // checking this product having referral vendor

  $ref_vendor = conditon_data('tbl_product_hdr JOIN vendors ON tbl_product_hdr.vendor_id = vendors.id','vendors.ref_user_id AS ref_user_id',['tbl_product_hdr.phid'=>$decode_pid],$additional = '');
    if ($ref_vendor['all_data']['ref_user_id']>0) {
      $add_to_cart_cons_id = $ref_vendor['all_data']['ref_user_id'];
      $consultant_id_supplier = $ref_vendor['all_data']['ref_user_id'];
    }
    //check this is consultant id
  $ret_user_cons_query = "SELECT * FROM users WHERE id = '".$decode_consultant_id."' && user_type = 'CONSULTANT' ";
  $data_array_func = single_data($ret_user_cons_query);

    if ($data_array_func['data']==true) {
      if ($data_array_func['all_data']['user_type'] == 'CONSULTANT') {
        $add_to_cart_cons_id = $data_array_func['all_data']['id'];
        $cosultant_id_seller = $data_array_func['all_data']['id'];
      }
    }

  // check pid exist
  $check_pid_q = "SELECT * FROM tbl_product_hdr WHERE phid = '$decode_pid' ";
  $check_pid_func = check($check_pid_q);
    

// check data already exis in to the cart or not
$check_cart_data = single_data("SELECT * FROM tbl_cart WHERE user_id = '".$user_id."' && product_id = '$decode_pid' && cart_status = 1 && (cosultant_id_seller > 0 || consultant_id_supplier > 0) LIMIT 1 ");
if ($check_cart_data['data']==true) {


  if ($check_cart_data['all_data']['consultant_id_supplier']>0) {
    $consultant_id_supplier = $check_cart_data['all_data']['consultant_id_supplier'];
  }

  if ($check_cart_data['all_data']['cosultant_id_seller']>0) {
    $cosultant_id_seller = $check_cart_data['all_data']['cosultant_id_seller'];
  }
  
}


    // if status true, then insert
    if ($check_pid_func['status']==true) {

      // check this product already in cart
      $check_cart = "SELECT * FROM tbl_wishlist WHERE user_id = '".$user_id."' && product_id = '".$decode_pid."' && cart_status = 1 ";

      $check_cart_func = check($check_cart);
        if ($check_cart_func['status']==true) {
          $sql_update = "UPDATE tbl_wishlist SET product_dtl_id = '".$ret_product_dtl_id['pdid']."', size = '$size', color = '$color', product_qty = product_qty+$qty WHERE user_id = '".$user_id."' && product_id = '$decode_pid'";
          update($sql_update);
          return '<span>Item added to wishlist</span>';

        }else{ // else for cart,
          $sql_ins_cart = "INSERT INTO tbl_wishlist SET product_dtl_id = '".$ret_product_dtl_id['pdid']."', product_qty = $qty, size = '$size', color = '$color', user_id = '".$user_id."', product_id = '$decode_pid', cosultant_id_seller = '".$cosultant_id_seller."', consultant_id_supplier = '".$consultant_id_supplier."'  ";
          insert($sql_ins_cart);
        return '<span>Item added to wishlist</span>';
        }
    }else{ // else checking for product
      return 0;
    }
}






// add to cart query
if (isset($_POST['product']) && isset($_SESSION['id'])) {
extract($_POST);
// check token
if ($_SESSION['add_to_cart_token']==$cart_token) {
$call_tabl_cart  = tbl_cart($product,$consultant,$_SESSION['id'],$color,$size,$qty);
echo $call_tabl_cart;
}else{ // else checking session token
echo 0;
}

}
// add to wishlist query
if (isset($_POST['product_w']) && isset($_SESSION['id'])) {
extract($_POST);
// check token
if ($_SESSION['add_to_wishlist_token']==$cart_token_w) {
$call_tbl_wishlist = tbl_wishlist($product_w,$_SESSION['id'],$consultant_w,$color,$size,$qty);
echo $call_tbl_wishlist;
}else{ // else checking session token
echo 0;
}

}
// cart page update with quantity
if (isset($_POST['cart_page_update_qty'])) {
extract($_POST);
// product id decode
$decode_pid = decode($cart_page_qty_product);
// check pid exist
$check_pid_q = "SELECT * FROM tbl_product_hdr WHERE phid = '$decode_pid' ";
$check_pid_func = check($check_pid_q);
// if status true, then insert
if ($check_pid_func['status']==true) {
// check this product already in cart
$check_cart = "SELECT * FROM tbl_cart WHERE user_id = '".$_SESSION['id']."' && product_id = '".$decode_pid."' && cart_status = 1 ";
$check_cart_func = check($check_cart);
if ($check_cart_func['status']==true) {
$sql_update = "UPDATE tbl_cart SET product_qty = $product_qty WHERE user_id = '".$_SESSION['id']."' && product_id = '$decode_pid'";
update($sql_update);
}
}else{ // else checking for product
echo 0;
}
}


function consultant_commission($product_id, $product_dtl_id, $user_id, $consultant_id, $order_hdr_id){
  global $con;
  $query = "";
}


function consultant_calc($tbl_cart_id,$order_id,$purchase_user_id){
global $con;
// retrive consultant seller data from users table, retrive cart data, retrive product data for pricing
$query1 = "SELECT
    `id`,
    `phid`,
    `ph_title`,
    `ph_shipping_charge`,
    `admin_commission`,
    `ph_consultant_seller`,
    `ph_tax` * 2 AS ph_tax,
    (
    SELECT
        MIN(ph_dp) AS ph_price
    FROM
        tbl_product_dtl
    WHERE
        `product_id` = `phid`
) AS ph_price,
`product_qty`
    FROM
        tbl_product_dtl
    WHERE
        `product_id` = `phid`
) AS consultant_seller,
`product_id`,
`cartid`,
`cosultant_id_seller`
FROM
    tbl_cart
JOIN users ON tbl_cart.cosultant_id_seller = users.id
JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE
    tbl_cart.cartid = '$tbl_cart_id' ";
$func1 = single_data($query1);
if(!empty($func1['data'])){
if ($func1['all_data']['cosultant_id_seller']>0) {
// total product value
$ttl_product_amt = ($func1['all_data']['product_qty']*$func1['all_data']['ph_price']);

$sum1 = ($func1['all_data']['ph_price'] + ($func1['all_data']['ph_price']*$func1['all_data']['admin_commission'])/100);
$tax_calc = ((($func1['all_data']['ph_price'] + $func1['all_data']['ph_shipping_charge']) * $func1['all_data']['ph_tax'])/100);

$consultant_seller = ((($sum1 - $tax_calc) * $func1['all_data']['ph_consultant_seller'])/100);

$commission = $consultant_seller;
// update consultant ewallet
$query2 = "UPDATE users SET ewallet = ewallet+$commission WHERE id = '".$func1['all_data']['id']."' ";
update($query2);
// add consultant commission amount data
$query3 = "INSERT INTO tbl_commission_added SET product_id = '".$func1['all_data']['phid']."', order_hdr_id = '".$order_id."', purchase_usr_id = '".$purchase_user_id."', product_qty = '".$func1['all_data']['product_qty']."', product_price = '".$func1['all_data']['ph_price']."', total_price = '".$ttl_product_amt."', consultant_id = '".$func1['all_data']['cosultant_id_seller']."', commission_amt = '".$commission."', commission_percen = '".$func1['all_data']['ph_consultant_seller']."' ";
insert($query3);
$data = $func1['all_data']['id'];
}
}



$query1 = "SELECT
    `id`,
    `phid`,
    `ph_title`,
    `ph_shipping_charge`,
    `admin_commission`,
    `ph_consultant_supplier`,
    `ph_tax` * 2 AS ph_tax,
    (
    SELECT
        MIN(ph_dp) AS ph_price
    FROM
        tbl_product_dtl
    WHERE
        `product_id` = `phid`
) AS ph_price,
`product_qty`,
`product_id`,
`cartid`,
`cosultant_id_seller`
FROM
    tbl_cart
JOIN users ON tbl_cart.consultant_id_supplier = users.id
JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE
    tbl_cart.cartid = '$tbl_cart_id' ";
$func1 = single_data($query1);
if(!empty($func1['data'])){
if ($func1['all_data']['consultant_id_supplier']>0) {
// total product value
$ttl_product_amt = ($func1['all_data']['product_qty']*$func1['all_data']['ph_price']);

//$consultant_supplier = ($func1['all_data']['product_qty']*$func1['all_data']['consultant_supplier']);

$sum1 = ($func1['all_data']['ph_price'] + ($func1['all_data']['ph_price']*$func1['all_data']['admin_commission'])/100);
$tax_calc = ((($func1['all_data']['ph_price'] + $func1['all_data']['ph_shipping_charge']) * $func1['all_data']['ph_tax'])/100);

$consultant_supplier = ((($sum1 - $tax_calc) * $func1['all_data']['ph_consultant_supplier'])/100);

$commission = $consultant_supplier;

// update consultant ewallet
$query2 = "UPDATE users SET ewallet = ewallet+$commission WHERE id = '".$func1['all_data']['id']."' ";
update($query2);
// add consultant commission amount data
$query3 = "INSERT INTO tbl_commission_added SET product_id = '".$func1['all_data']['phid']."', order_hdr_id = '".$order_id."', purchase_usr_id = '".$purchase_user_id."', product_qty = '".$func1['all_data']['product_qty']."', product_price = '".$func1['all_data']['ph_price']."', total_price = '".$ttl_product_amt."', consultant_id = '".$func1['all_data']['consultant_id_supplier']."', commission_amt = '".$commission."', commission_percen = '".$func1['all_data']['ph_consultant_supplier']."' ";
insert($query3);
$data = $func1['all_data']['id'];
}
}

return $data;
}


// function bank details update
function bank_data_update($bank_name,$bank_ifsc,$bank_ac_no,$bank_branch,$user_id,$conf_bank_ac_no){

// checking bank account no
if ($bank_ac_no == $conf_bank_ac_no) {
// check user already added or not
$check_bak_bind = "SELECT * FROM tbl_kyc WHERE user_id = '".$user_id."' ";
$check_user_func = single_data($check_bak_bind);
if ($check_user_func['data']==true) {
$update_bank = "UPDATE tbl_kyc SET bank_name = '$bank_name', bank_ifsc = '$bank_ifsc', bank_ac_no = '$bank_ac_no', bank_branch = '$bank_branch' WHERE user_id = '".$user_id."' ";
update($update_bank);
$data = 'Bank details updated';
}else{
$update_bank = "INSERT INTO tbl_kyc SET user_id = '".$user_id."', bank_name = '$bank_name', bank_ifsc = '$bank_ifsc', bank_ac_no = '$bank_ac_no', bank_branch = '$bank_branch' ";
update($update_bank);
$data = 'Bank Details added';
}
}else{ // else bank account checking
$data = 'A/C no. do not match';
}

return $data;
}


// document function
function doc_check($file){
  $data = [];
  $file_explode = explode('.',$file);
  $file_strlower = strtolower(end($file_explode));
  $file_rename = sha1(date("YmdHis").md5($file.time())).'.'.$file_strlower;
  $allow_file = ['jpg','jpeg','png','pdf'];

  if (in_array($file_strlower, $allow_file)) {
      $data['data'] = true;
      $data['file_name'] = $file_rename;
  }else{
    $data['data']=false;
  }
  return $data;

}

// image file checking function
function img_check($file){
  $data = [];
  $file_explode = explode('.',$file);
  $file_strlower = strtolower(end($file_explode));
  $file_rename = sha1(date("YmdHis").md5($file.time())).'.'.$file_strlower;
  $allow_file = ['jpg','jpeg','png','gif'];

  if (in_array($file_strlower, $allow_file)) {
      $data['data'] = true;
      $data['file_name'] = $file_rename;
  }else{
    $data['data']=false;
  }
  return $data;

}


// update bank details from user
if (isset($_POST['bank_name']) && !isset($_POST['user'])) {
extract($_POST);
$bank_name;
$bank_ifsc;
$bank_ac_no;
$conf_bank_ac_no;
$bank_branch;
  $bank_data_update_func = bank_data_update($bank_name,$bank_ifsc,$bank_ac_no,$bank_branch,$_SESSION['id'],$conf_bank_ac_no);
  echo $bank_data_update_func;
}

// update bank details from admin
if (isset($_POST['bank_name']) && isset($_POST['user'])) {
extract($_POST);
$bank_name;
$bank_ifsc;
$bank_ac_no;
$conf_bank_ac_no;
$bank_branch;
  $bank_data_update_func = bank_data_update($bank_name,$bank_ifsc,$bank_ac_no,$bank_branch,$user,$conf_bank_ac_no);
  echo $bank_data_update_func;
}

/// withdrawal request for user
if (isset($_POST['request_amt']) && !isset($_POST['wid'])) {
extract($_POST);
$check_bak_bind_s = "SELECT * FROM tbl_kyc WHERE user_id = '".$_SESSION['id']."' ";
$check_user_func_s = single_data($check_bak_bind_s);
if ($check_user_func_s['data']==true) {
// check only available amount
$only_user_data_s = single_data("SELECT * FROM users WHERE id = '".$_SESSION['id']."' ");
// add condition for request amt available from current balance
if (($only_user_data_s['all_data']['ewallet'] >= $request_amt) && $request_amt >0 ) {

  // check min withdrawal
  $check_min_withdrawal = single_data("SELECT * FROM tbl_withdrawal_setting WHERE wsid = 1")['all_data'];

  if ($request_amt>=$check_min_withdrawal['min_withdrawal']) {

    // calculate admin charges or transfer charges

    $tbl_tds = (($request_amt*$check_min_withdrawal['tds'])/100);
    $tbl_imps = (($request_amt*$check_min_withdrawal['imps'])/100);
    $tbl_admin = (($request_amt*$check_min_withdrawal['admin'])/100);
    $tbl_gst = (($request_amt*$check_min_withdrawal['gst'])/100);

    $total_charges = ($tbl_tds+$tbl_imps+$tbl_admin+$tbl_gst);
    $payout = ($request_amt-$total_charges);
    // code...
 


insert("INSERT INTO tbl_withdrawal SET user_id = '".$_SESSION['id']."', request_amt = '$request_amt', tds = '$tbl_tds', imps = '$tbl_imps', admin = '$tbl_admin', gst = '$tbl_gst', payout = '$payout' ");

update("UPDATE users SET ewallet = ewallet-$request_amt WHERE id = '".$_SESSION['id']."' ");
echo ($only_user_data_s['all_data']['ewallet']-$request_amt);
}else{
  echo 'Minimum Withdrawal '.$check_min_withdrawal['min_withdrawal'];
}
}else{
echo 'Insufficient balance';
}
}else{
echo 'Please update bank details';
}
}
// withdrawal history change
if (isset($_POST['wid']) && isset($_POST['withdrawal_status'])) {
extract($_POST);
// check already updated or not
$check_wid = single_data("SELECT * FROM tbl_withdrawal
JOIN users ON users.id = tbl_withdrawal.user_id
JOIN tbl_kyc ON tbl_kyc.user_id = users.id
WHERE tbl_withdrawal.withdrawal_id = '$wid' && tbl_withdrawal.withdrawal_status = 0 ");
if ($check_wid['data']==true) {
// amount refund if reject or delete
if ($withdrawal_status == 2 || $withdrawal_status == 3) {
$refund_func = single_data("SELECT * FROM tbl_withdrawal
JOIN users ON users.id = tbl_withdrawal.user_id
JOIN tbl_kyc ON tbl_kyc.user_id = users.id
WHERE tbl_withdrawal.withdrawal_id = '$wid' ");
$refund_func_data = $refund_func['all_data'];
$refund_request_amt = $refund_func_data['request_amt'];
update("UPDATE users SET ewallet = ewallet+$refund_request_amt WHERE id = '".$refund_func_data['id']."' ");
echo ($refund_func_data['request_amt']+$refund_func_data['ewallet']);
}
update("UPDATE tbl_withdrawal SET txn_id = '$txn_id', withdrawal_status = '$withdrawal_status', remarks = '$remarks' WHERE withdrawal_id = '$wid' ");
echo 'Status updated Successfully';
}else{
echo 'Data already updated';
}
}



// coupon code checking

function coupon_code_check($code,$id){
global $date;

$where = ['tbl_coupons.coupon_code'=>$code, 'tbl_coupons.status' => 1];

$coupon_checking_data = "tbl_coupons.coupon_id AS COUPON_ID, tbl_coupons.coupon_code AS COUPON_CODE,tbl_coupons.coupon_type AS COUPON_TYPE, tbl_coupons.amount AS COUPON_AMT, tbl_coupons.max_limit AS COUPON_LIMIT,tbl_coupons.expiary_date AS COUPON_EXPIARY, tbl_coupons.status AS COUPON_STATUS, tbl_coupons.left_limit AS LEFT_LIMIT, tbl_coupons.allowed_products AS ALLOW, tbl_coupons.disallowed_products AS DISALLOW ";

$coupon_code_query = conditon_data('tbl_coupons',$coupon_checking_data,$where);


$coupon_products = false;
$coupon_ata['user_allow'] = true;
$coupon_ata['coupon_products'] = $coupon_products;

        if ($code != '') {

            if ($coupon_code_query['data']==true) {
                if ($coupon_code_query['all_data']['LEFT_LIMIT']>0) { // limit check
                        if (strtotime($date) <= strtotime($coupon_code_query['all_data']['COUPON_EXPIARY'])) { // expiary check

                          $check_user_exist = check("SELECT * FROM tbl_order_hdr WHERE coupon_id = '".$coupon_code_query['all_data']['COUPON_ID']."' && coupon_code = '".$coupon_code_query['all_data']['COUPON_CODE']."' && user_id = '$id'
                            ");
                          if ($check_user_exist['status']==true) {
                            $coupon_ata['coupon_msg'] = '<p class="text-danger">Coupon Code expired</p>';
                            $coupon_ata['coupon_code'] = '';
                            $coupon_ata['coupon_state'] = true;
                            $coupon_ata['user_allow'] = false;

                          }else{
                            // cross chekcing coupons for multiple products or not
                            if (($coupon_code_query['all_data']['ALLOW']=='') && ($coupon_code_query['all_data']['DISALLOW']=='')) {
                                $coupon_products = true;
                                $coupon_ata['coupon_products'] = $coupon_products;
                            }
                            
                            

                            $coupon_ata['coupon_msg'] = '<p class="text-success">Coupon Code applied</p>';
                            $coupon_ata['coupon_code'] = $code;
                            $coupon_ata['coupon_state'] = true;
                          }

                            
                        }else{ // coupon code date expired
                            $coupon_ata['coupon_msg'] = '<p class="text-danger">Coupon Code expired</p>';
                            $coupon_ata['coupon_code'] = '';
                            $coupon_ata['coupon_state'] = true;
                        }
                }else{ // limit over
                    $coupon_ata['coupon_msg'] = '<p class="text-danger">Coupon Code expired</p>';
                    $coupon_ata['coupon_code'] = '';
                    $coupon_ata['coupon_state'] = true;
                }
                $coupon_ata['all_data'] = $coupon_code_query['all_data'];
            }else{ // else for coupon code chekcing false
                $coupon_ata['coupon_msg'] = '<p class="text-danger">Invalid Coupon Code</p>';
                $coupon_ata['coupon_state'] = true;
                $coupon_ata['coupon_code'] = '';
            }
        }else{ // else for coupon passed is blank
            $coupon_ata['coupon_code'] ='';
            $coupon_ata['coupon_msg'] = '';
            $coupon_ata['coupon_state'] = false;
        }
 
 $coupon_ata['data'] = $coupon_code_query['data'];


return $coupon_ata;
}



// apply coupon code 
function apply_coupon_code($coupon_code,$multiple_product_status,$coupon_code_query,$qty,$price,$phid){
  $data['COUPON_ID'] = 0;
  $data['COUPON_CODE'] = NULL;
  $data['COUPON_TYPE'] = NULL;
  $data['COUPON_AMT'] = 0;
            if ($coupon_code_query['data']==true && ($_SESSION['coupon_code'] !='')) {
            $data['apply'] = false;
            $coupon_products = $multiple_product_status;
            if (($coupon_products==true) && ($coupon_code !='')) {
                if ($coupon_code_query['all_data']['COUPON_TYPE']=='FIXED') { // if coupoin fixed
                $coupon_amt = $coupon_code_query['all_data']['COUPON_AMT'];
                }elseif ($coupon_code_query['all_data']['COUPON_TYPE']=='PERCENTAGE') { // if coupon percentage
                $coupon_amt = (($price*$coupon_code_query['all_data']['COUPON_AMT'])/100);
                }

                $single_ph_amt = ($price-$coupon_amt);
                $product_val= ($qty*$single_ph_amt);
                $data['apply'] = true;
                
                $data['COUPON_ID'] = $coupon_code_query['all_data']['COUPON_ID'];
                $data['COUPON_CODE'] = $coupon_code_query['all_data']['COUPON_CODE'];
                $data['COUPON_TYPE'] = $coupon_code_query['all_data']['COUPON_TYPE'];
                $data['COUPON_AMT'] = $coupon_code_query['all_data']['COUPON_AMT'];

            }elseif(($coupon_products==false) && ($coupon_code_query['all_data']['DISALLOW'] !='') && ($coupon_code_query['all_data']['ALLOW'] =='')){
                $coupon_code_single_p = single_data("SELECT * FROM tbl_coupons
                                                            JOIN tbl_child_coupon_code
                                                            ON tbl_coupons.coupon_id = tbl_child_coupon_code.coupon_id
                                                            WHERE tbl_child_coupon_code.product_id = '".$phid."' && allow_type = 'DISALLOW' && tbl_coupons.coupon_code = '".$coupon_code."'
                        ");
                if ($coupon_code_single_p['data']==true) {
                    $coupon_amt = 0;
                    $product_val= ($qty*$price);
                }else{
                    if ($coupon_code_query['all_data']['COUPON_TYPE']=='FIXED') { // if coupoin fixed
                            $coupon_amt = $coupon_code_query['all_data']['COUPON_AMT'];
                            }elseif ($coupon_code_query['all_data']['COUPON_TYPE']=='PERCENTAGE') { // if coupon percentage
                            $coupon_amt = (($price*$coupon_code_query['all_data']['COUPON_AMT'])/100);
                            }

                        $single_ph_amt = ($price-$coupon_amt);
                        $product_val= ($qty*$single_ph_amt);

                        $data['COUPON_ID'] = $coupon_code_query['all_data']['COUPON_ID'];
                        $data['COUPON_CODE'] = $coupon_code_query['all_data']['COUPON_CODE'];
                        $data['COUPON_TYPE'] = $coupon_code_query['all_data']['COUPON_TYPE'];
                        $data['COUPON_AMT'] = $coupon_code_query['all_data']['COUPON_AMT'];

                }
            }

            elseif(($coupon_products==false) && ($coupon_code_query['all_data']['DISALLOW'] !='') && ($coupon_code_query['all_data']['ALLOW'] !='')){
                $coupon_code_single_p = single_data("SELECT tbl_child_coupon_code.allow_type AS ALLOW_TYPE FROM tbl_coupons
                                                            JOIN tbl_child_coupon_code
                                                            ON tbl_coupons.coupon_id = tbl_child_coupon_code.coupon_id
                                                            WHERE tbl_child_coupon_code.product_id = '".$phid."' && tbl_coupons.coupon_code = '".$coupon_code."'
                        ");
                if ($coupon_code_single_p['data']==true) {
                    if ($coupon_code_single_p['all_data']['ALLOW_TYPE']=='DISALLOW') {
                    $coupon_amt = 0;
                    $product_val= ($qty*$price);
                }else{
                    if ($coupon_code_query['all_data']['COUPON_TYPE']=='FIXED') { // if coupoin fixed
                            $coupon_amt = $coupon_code_query['all_data']['COUPON_AMT'];
                            }elseif ($coupon_code_query['all_data']['COUPON_TYPE']=='PERCENTAGE') { // if coupon percentage
                            $coupon_amt = (($price*$coupon_code_query['all_data']['COUPON_AMT'])/100);
                            }

                        $single_ph_amt = ($price-$coupon_amt);
                        $product_val= ($qty*$single_ph_amt);


                        $data['COUPON_ID'] = $coupon_code_query['all_data']['COUPON_ID'];
                $data['COUPON_CODE'] = $coupon_code_query['all_data']['COUPON_CODE'];
                $data['COUPON_TYPE'] = $coupon_code_query['all_data']['COUPON_TYPE'];
                $data['COUPON_AMT'] = $coupon_code_query['all_data']['COUPON_AMT'];

                }
                }else{
                    $coupon_amt = 0;
                    $product_val= ($qty*$price);
                }
            }

            elseif(($coupon_products==false) && ($_SESSION['coupon_code'] !='')){
                    $coupon_code_single_p = single_data("SELECT * FROM tbl_coupons
                                                            JOIN tbl_child_coupon_code
                                                            ON tbl_coupons.coupon_id = tbl_child_coupon_code.coupon_id
                                                            WHERE tbl_child_coupon_code.product_id = '".$phid."' && allow_type = 'ALLOW' && tbl_coupons.coupon_code = '".$coupon_code."'
                        ");
                    if ($coupon_code_single_p['data']==true) {
                        if ($coupon_code_query['all_data']['COUPON_TYPE']=='FIXED') { // if coupoin fixed
                            $coupon_amt = $coupon_code_query['all_data']['COUPON_AMT'];
                            }elseif ($coupon_code_query['all_data']['COUPON_TYPE']=='PERCENTAGE') { // if coupon percentage
                            $coupon_amt = (($price*$coupon_code_query['all_data']['COUPON_AMT'])/100);
                            }

                        $single_ph_amt = ($price-$coupon_amt);
                        $product_val= ($qty*$single_ph_amt);

                        $data['COUPON_ID'] = $coupon_code_query['all_data']['COUPON_ID'];
                $data['COUPON_CODE'] = $coupon_code_query['all_data']['COUPON_CODE'];
                $data['COUPON_TYPE'] = $coupon_code_query['all_data']['COUPON_TYPE'];
                $data['COUPON_AMT'] = $coupon_code_query['all_data']['COUPON_AMT'];

                
                    }
                    else{
                $coupon_amt = 0;
                $product_val= ($qty*$price);
                    }
            }else{
                $coupon_amt = 0;
                $product_val= ($qty*$price);
            }
          }else{
            $coupon_amt = 0;
                $product_val= ($qty*$price);
          }
            $data['coupon_amt'] = $coupon_amt;
            $data['product_val'] = $product_val;
            
            return $data;
}

// change/ update password
function change_user_password($id,$old_pass,$new_pass,$conf_pass){
  global $con;
  $old_pass = md5('salt0'.$old_pass);

  $return_pass = [];

  // check user old pass
    $pass_conditions = ["id"=>$id, 'pass' => $old_pass];
    $data = conditon_data('users','pass',$pass_conditions);
        if ($data['data']==true) {
      if ($data['all_data']['pass']==$old_pass) {
      
      // check confirm pass
      if ($new_pass == $conf_pass) {
        $new_pass = md5('salt0'.$new_pass);

        update("UPDATE users SET pass = '$new_pass' WHERE id = '$id' ");

        $return_pass['icon'] = 'fa fa-check';
        $return_pass['msg'] = 'Password updated';
        $return_pass['type'] = 'success';
        $return_pass['status'] = true;
      }else{
        $return_pass['icon'] = 'fa fa-times';
        $return_pass['msg'] = 'Confirm Password do not matched';
        $return_pass['type'] = 'error';
        $return_pass['status'] = false;
      }

    }else{
      $return_pass['icon'] = 'fa fa-times';
        $return_pass['msg'] = 'Old Password do not matched';
        $return_pass['type'] = 'error';
        $return_pass['status'] = false;
    }
    }else{
      $return_pass['icon'] = 'fa fa-times';
        $return_pass['msg'] = 'Old Password do not matched';
        $return_pass['type'] = 'error';
        $return_pass['status'] = false;
    }

    return $return_pass;

}

// change password query
if (isset($_POST['pass_token']) && isset($_POST['old_pass'])) {
    extract($_POST);
    
    $return_pass = change_user_password($_SESSION['id'],$old_pass,$new_pass,$conf_pass);
    echo json_encode($return_pass);
 
}

if (isset($_POST['pass_token']) && isset($_POST['min_withdrawal'])) {
extract($_POST);

$update_data=['min_withdrawal'=>$min_withdrawal, 'imps'=>$imps, 'tds'=>$tds, 'admin'=> $admin, 'gst'=>$gst ];
$condition=['wsid'=>1];

$data = conditon_update('tbl_withdrawal_setting',$update_data,$condition);


if ($data['data']==true) {
    $c_return['icon'] = 'fa fa-check';
    $c_return['msg'] = 'Data updated';
    $c_return['type'] = 'info';

}else{
    $c_return['icon'] = 'fa fa-times';
    $c_return['msg'] = 'Please try again';
    $c_return['type'] = 'error';
}

echo json_encode($c_return);

}

// signup bonus amount set

if (isset($_POST['signup_bonus_amount']) && isset($_POST['bonus_pass'])) {
  extract($_POST);
  $com_data=['customer_signup_bonus'=>$signup_bonus_amount];
$com_data_con=['csid'=>1];

$data_comm = conditon_update('common_settings',$com_data,$com_data_con);

if ($data_comm['data']==true) {
    $data_comm_c['comm_icon'] = 'fa fa-check';
    $data_comm_c['comm_msg'] = 'Bonus Amount Updated';
    $data_comm_c['comm_type'] = 'info';

}else{
    $data_comm_c['comm_icon'] = 'fa fa-times';
    $data_comm_c['comm_msg'] = 'Bonus amount not change';
    $data_comm_c['comm_type'] = 'error';
}
echo json_encode($data_comm_c);
}


// free delivery for min amount required on cart
if (isset($_POST['min_cart_val']) && isset($_POST['min_cart_val_pass'])) {
  extract($_POST);
  $com_data=['min_cart_val'=>$min_cart_val];
$com_data_con=['csid'=>1];

$data_comm = conditon_update('common_settings',$com_data,$com_data_con);

if ($data_comm['data']==true) {
    $data_comm_c['comm_icon'] = 'fa fa-check';
    $data_comm_c['comm_msg'] = 'Amount Updated';
    $data_comm_c['comm_type'] = 'info';

}else{
    $data_comm_c['comm_icon'] = 'fa fa-times';
    $data_comm_c['comm_msg'] = 'amount not change';
    $data_comm_c['comm_type'] = 'error';
}
echo json_encode($data_comm_c);
}
?>