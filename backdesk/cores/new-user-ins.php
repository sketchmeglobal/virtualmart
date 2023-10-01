<?php 

if (isset($_POST['insert'])) {

	include '../../function/functions.php';
	extract($_POST);
// 	print_r($_POST);
	
	$token;
	$f_name;
	$l_name;
	$email;
	$contact;
	if ($user_type=='CONSULTANT') {
    	$commission;
    }
	$User_status;
	$user_type;

	$pass;
	$salt = 'salt0';
    $enc_pass = md5($salt.$pass);


	$feature_img = $_FILES['feature_img']['name'];
	$allow_file_ext = array('png','jpg','jpeg','gif');

	
	// token checking
	if ($_SESSION['token']==$token) {
	    
				// check product title

				$email_query = "SELECT * FROM users WHERE email = '$email' && row_status =  1 ";
				$title_func = single_data($email_query);

				$ph_query = "SELECT * FROM users WHERE contact = '$contact'  && row_status =  1 ";
				$ph_func = single_data($ph_query);

				if ($title_func['data']==true) {

					$_SESSION['msg'] = 'Email already exists';

				}else if($ph_func['data']==true){

				    $_SESSION['msg'] = 'Phone number already exists';

				}else{ // else for title function checking 


					// insert query 
					
					   $sql_ins = "INSERT INTO users SET vendor_id = NULL,f_name = '$f_name', l_name = '$l_name', email = '$email', contact = '$contact', pass = '$enc_pass', status = '$User_status', user_type = '$user_type' ";
				

					$last_id_query = insert($sql_ins);

					$last_id = $last_id_query['count']; // fetch last id using insert funciton

					// consultant data added
					if ($user_type=='CONSULTANT') {

						// update consultant commission
						$sql_consultant = "UPDATE users SET comission = '$commission' WHERE id = '$last_id' ";
						update($sql_consultant);

						// add consultant history
						$ins_consultant = "INSERT INTO tbl_commission_set SET user_id = '$last_id', commission = '$commission' ";
						insert($ins_consultant);
					}

					// feature image restrictions



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



					// gallery images 

					$array_gallery_img=[];

					$_SESSION['msg']='User added';

				}





 	}else{ // else for token

		$_SESSION['msg']="Please try again";

	}



}

echo '<script>alert("'.$_SESSION['msg'].'");window.location.href="../all-users.php";</script>';

 ?>