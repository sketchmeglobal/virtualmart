<?php 
$_SESSION['msg']='';

if (isset($_POST)) {
    
	include '../function/functions.php';
	extract($_POST);
	
	$token;
	$company_name;
	$company_mobile;
	$company_mail;
	$ufname;
	$ulname;
	$user_mobile;
	$user_mail;
	
	$vendor_password;
	$salt = 'salt0';
    $enc_pass = md5($salt.$vendor_password);
    $ref = base64_decode($ref);

	// token checking
	if ($_SESSION['token']==$token) {

			// check vendor title
			$company_email_query = "SELECT * FROM vendors WHERE email = '$company_mail' && row_status = 1 ";
			$func1 = single_data($company_email_query);
			
			$ph_query = "SELECT * FROM vendors WHERE contact = '$company_mobile'  && row_status = 1 ";
			$func2 = single_data($ph_query);

			

			if ($func1['data']==true) {
				$_SESSION['msg'] = 'Company Email already exists';
			}else if($func2['data']==true){
			    $_SESSION['msg'] = 'Company Phone number already exists';
			}

			else{ // else for title function checking 

				// checking referral user id
				if (!empty($ref)) {
					$ref_user_check = conditon_data('users','*',['email'=>$ref, 'row_status' => 1 ],$additional = '');

					if ($ref_user_check['data']==true) {
						$ref_user_id = $ref_user_check['all_data']['id'];
					}else{
						$ref_user_id = 0;
					}
				}else{
					$ref_user_id = 0;
				}

				// insert vendor query 

				$last_id_query = bind_insert('vendors', ['ref_user_id' => $ref_user_id, 'company_name' => $company_name, 'email' => $company_mail, 'about' => 'Nothing found...', 'contact' => $company_mobile, 'status' => 1]);

				$last_id = $last_id_query['count']; // fetch last id using insert funciton

                // insert user query     
                $sql_ins = "INSERT INTO users SET vendor_id = '$last_id', f_name = '$ufname', l_name = '$ulname', contact = '$user_mobile', email = '$user_mail', pass='$enc_pass', status = 1";
				$last_id_query = insert($sql_ins);
			
				$_SESSION['msg']='Registration successfully.';
			}

 	}else{ // else for token
		$_SESSION['msg']="Please try again";
	}

}
echo $_SESSION['msg'];
header("location:../login.php?log_stat=success");
exit();
?>
