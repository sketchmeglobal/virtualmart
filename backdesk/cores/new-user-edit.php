<?php 

if (isset($_POST['update'])) {
	include '../../function/functions.php';
	extract($_POST);
	
// 	print_r($_POST);
	
	$UserId;
	$token;
	$vendor_id;
	$f_name;
	$l_name;
	$email;
	$contact;
	$commission;
	$wallet;
	$user_role;
	$User_status;
	
	$pass;
	$salt = 'salt0';
    $enc_pass = md5($salt.$pass);
	
	$feature_img = $_FILES['feature_img']['name'];
	$allow_file_ext = array('png','jpg','jpeg','gif');

	
	// token checking
	if ($_SESSION['token']==$token) {
        

				{ 

					// update user query
					if($vendor_id == 'none'){
					    $sql_ins = "UPDATE users SET vendor_id=NULL, f_name = '$f_name', l_name = '$l_name', email = '$email', contact = '$contact', pass = '$enc_pass', ewallet = '$wallet', comission = '$commission', role='$user_role', status = '$User_status' WHERE id= '$UserId'";
					}else{
					    $sql_ins = "UPDATE users SET vendor_id='$vendor_id', f_name = '$f_name', l_name = '$l_name', email = '$email', contact = '$contact', pass = '$enc_pass', ewallet = '$wallet', comission = '$commission', role='$user_role', status = '$User_status' WHERE id= '$UserId'";
					}
					$last_id_query = update($sql_ins);
					$last_id = $UserId; // fetch last id using insert funciton

					// feature image restrictions

                    if($_FILES['feature_img']['name'] != ''){    
    					$feature_img = $_FILES['feature_img']['name'];
    					$feature_img_path = $_FILES['feature_img']['tmp_name'];
    
    					$feature_img_explode = explode('.',$feature_img);
    					$check_feature_img_ext = strtolower(end($feature_img_explode));
    					$rename_fetaure_img = date("YmdHis").sha1(md5($feature_img)).'.'.$check_feature_img_ext;
    
    					if (in_array($check_feature_img_ext, $allow_file_ext)) { // feature image accept
    						move_uploaded_file($feature_img_path, '../../user-images/'.$rename_fetaure_img);
    						$fertaure_img_update = "UPDATE users SET profile_image = '$rename_fetaure_img' WHERE id = '$last_id' "; 
    						update($fertaure_img_update);
    					}
                    }	

					$_SESSION['msg']='User Updated';
				}


 	}else{ // else for token
		$_SESSION['msg']="Please try again";
	}

}else{
    echo 'Direct access not allowed';
}
echo '<h2 style="text-center">';
echo $_SESSION['msg'];
header("Refresh:2; url=../new-user.php");
 ?>