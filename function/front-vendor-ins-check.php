<?php 
include_once 'functions.php';

// only checking data
if (isset($_POST['only_company'])) {
	extract($_POST);
	$data = [];

	// check company details exist or not
	$company_check = $con->prepare('SELECT * FROM vendors WHERE (company_name = :only_company || email = :company_mail || contact = :company_mobile) && row_status = 1 ');
	$company_check->bindValue(':only_company',$only_company);
	$company_check->bindValue(':company_mail',$company_mail);
	$company_check->bindValue(':company_mobile',$company_mobile);
	$company_check->execute();


	if ($company_check->rowCount()>0) {
		$data['status']=true;
		$data['msg'] = 'Company details already exist.';
	}else{
		// check user data already exist or not
		$user_check = $con->prepare('SELECT * FROM users WHERE (contact = :user_mobile || email = :user_mail)  && row_status = 1  ');
		$user_check->bindValue(':user_mobile',$user_mobile);
		$user_check->bindValue(':user_mail',$user_mail);
		$user_check->execute();

		if ($user_check->rowCount()>0) {
			$data['status']=true;
			$data['msg']='User already exist';
		}else{
			$data['status']=false;
		}

		
	}
	echo json_encode($data);
}


// vendor ins query
if (isset($_POST['company_name'])) {

// checking referral user id
if (!empty($ref)) {
$ref_user_check = conditon_data('users','*',['email'=>$ref, 'row_status'=>1],$additional = '');

if ($ref_user_check['data']==true) {
	$ref_user_id = $ref_user_check['all_data']['id'];

}else{ // else for, referral id not found

	$ref_user_id = 0;
}
}else{ // else for if referral d is blank

$ref_user_id = 0;
}


	extract($_POST);
	extract($_FILES);
	$return_data = [];

	// check if data empty
	if (empty($token) || empty($company_name) || empty($company_mobile) || empty($company_mail) || 
		empty($ufname) || empty($ulname) || empty($user_mobile) || empty($user_mail) || empty($vendor_password) || empty($aadhaar_number) || empty($pan_number) || empty($aadhaar_front) || empty($aadhaar_back) || empty($pan_pic) ) {

		$return_data['status'] = true;
		$return_data['msg'] = 'Please fill all details';
		$return_data['icon'] = 'error';

	}else{ // else for if all data not empty
		// check company details exist or not
	$company_check = $con->prepare('SELECT * FROM vendors WHERE (company_name = :company_name || email = :company_mail || contact = :company_mobile)  && row_status = 1 ');
	$company_check->bindValue(':company_name',$company_name);
	$company_check->bindValue(':company_mail',$company_mail);
	$company_check->bindValue(':company_mobile',$company_mobile);
	$company_check->execute();


	if ($company_check->rowCount()>0) {
		$return_data['status']=true;
		$return_data['msg'] = 'Company details already exist.';
		$return_data['icon'] = 'error';
	}else{ // else for company data not exist

		// check user data already exist or not
		$user_check = $con->prepare('SELECT * FROM users WHERE (contact = :user_mobile || email = :user_mail)  && row_status = 1  ');
		$user_check->bindValue(':user_mobile',$user_mobile);
		$user_check->bindValue(':user_mail',$user_mail);
		$user_check->execute();

		if ($user_check->rowCount()>0) {
			$return_data['status']=true;
			$return_data['msg']='User already exist';
			$return_data['icon'] = 'error';
		}else{ // else for user data not exist

			// token checking
			if ($_SESSION['token']==$token){

				// check gst number
				$gst_number = ($gst_number == '') ? NULL:$gst_number;

					$gst_check = $con->prepare("SELECT * FROM vendor_kyc WHERE gst_number = :gst_number && gst_number !=''  && row_status = 1 ");
					$gst_check->bindValue(':gst_number',$gst_number);
					$gst_check->execute();

					if ($gst_check->rowCount()>0) {
						$return_data['status']=true;
						$return_data['msg']='GST already exist';
						$return_data['icon'] = 'error';
					}else{ // else for gst data not found

						// aadhaar number check
						$aadhaar_check = conditon_data('vendor_kyc', '*', ['aadhar_number'=>$aadhaar_number, 'row_status'=>1]);
						if ($aadhaar_check['data']==true) {
							$return_data['status']=true;
							$return_data['msg']='Aadhaar Number already exist';
							$return_data['icon'] = 'error';
						}else{ // else for, aadhaar number not found

							// pan number check
							$pan_check = conditon_data('vendor_kyc', '*', ['pan_number'=>$pan_number, 'row_status'=>1]);
							if ($pan_check['data']==true) {
								$return_data['status']=true;
								$return_data['msg']='PAN Number already exist';
								$return_data['icon'] = 'error';
							}else{ // else for, pan number not found

								//aadhaar front side checking
								$aadhaar_front_func = doc_check($aadhaar_front['name']);
								if ($aadhaar_front_func['data']==true) {
									$aadhaar_front_re = $aadhaar_front_func['file_name'];

									// store the file
									move_uploaded_file($aadhaar_front['tmp_name'], '../vendor-kyc/'.$aadhaar_front_re);

								//aadhaar back side checking
								$aadhaar_back_func = doc_check($aadhaar_back['name']);
								if ($aadhaar_back_func['data']==true) {
									$aadhaar_back_re = $aadhaar_back_func['file_name'];

									// store the file
									move_uploaded_file($aadhaar_back['tmp_name'], '../vendor-kyc/'.$aadhaar_back_re);

								//pan checking
								$pan_func = doc_check($pan_pic['name']);
								if ($pan_func['data']==true) {
									$pan_pic_re = $pan_func['file_name'];

									// store the file
									move_uploaded_file($pan_pic['tmp_name'], '../vendor-kyc/'.$pan_pic_re);


									// gst file checking
									if(!empty($gst_file['name']) || $gst_number !=''){
										$gst_file_check = doc_check($gst_file['name']);

										if ($gst_file_check['data']==true) {
											$gst_file_re = $gst_file_check['file_name'];
											// store the file
									move_uploaded_file($gst_file['tmp_name'], '../vendor-kyc/'.$gst_file_re);


								// trade license checking
									if(!empty($trade_license['name'])){
										$trade_license_check = doc_check($trade_license['name']);

										if ($trade_license_check['data']==true) {
											$trade_license_re = $trade_license_check['file_name'];

											// store the file
									move_uploaded_file($trade_license['tmp_name'], '../vendor-kyc/'.$trade_license_re);

											// call the function for insert query
									$all_data_ins = comm_vendor_ins($ref_user_id,$company_name,$company_mail,$company_mobile,$ufname,$ulname,$user_mobile,$user_mail,$vendor_password,$aadhaar_number,$pan_number,$aadhaar_front_re,$aadhaar_back_re,$pan_pic_re,$trade_license_re,$gst_file_re,$gst_number,$vendor_address,$vendor_state);
									$return_data['status']=false;
											
											
										}else{ // invalid trade_license file

											$return_data['status']=true;
											$return_data['msg']='Invalid trade license file';
											$return_data['icon'] = 'error';

										}

									}else{ // else for, continue without trade_license file
										$trade_license_re = NULL;
										// call the function for insert query
										$all_data_ins = comm_vendor_ins($ref_user_id,$company_name,$company_mail,$company_mobile,$ufname,$ulname,$user_mobile,$user_mail,$vendor_password,$aadhaar_number,$pan_number,$aadhaar_front_re,$aadhaar_back_re,$pan_pic_re,$trade_license_re,$gst_file_re,$gst_number,$vendor_address,$vendor_state);
										$return_data['status']=false;
									}

										}else{ // invalid gst file

											$return_data['status']=true;
											$return_data['msg']='Invalid or Please upload GST file';
											$return_data['icon'] = 'error';

										}

									}else{ // else for, continue without gst file
										$gst_file_re = NULL;
										// trade license checking
									if(!empty($trade_license['name'])){
										$trade_license_check = doc_check($trade_license['name']);

										if ($trade_license_check['data']==true) {
											$trade_license_re = $trade_license_check['file_name'];

											// store the file
									move_uploaded_file($trade_license['tmp_name'], '../vendor-kyc/'.$trade_license_re);
									
											// call the function for insert query
									$all_data_ins = comm_vendor_ins($ref_user_id,$company_name,$company_mail,$company_mobile,$ufname,$ulname,$user_mobile,$user_mail,$vendor_password,$aadhaar_number,$pan_number,$aadhaar_front_re,$aadhaar_back_re,$pan_pic_re,$trade_license_re,$gst_file_re,$gst_number,$vendor_address,$vendor_state);
									$return_data['status']=false;
											
											
										}else{ // invalid trade_license file

											$return_data['status']=true;
											$return_data['msg']='Invalid trade license file';
											$return_data['icon'] = 'error';

										}

									}else{ // else for, continue without trade_license file
										$trade_license_re = NULL;
										// call the function for insert query
										$all_data_ins = comm_vendor_ins($ref_user_id,$company_name,$company_mail,$company_mobile,$ufname,$ulname,$user_mobile,$user_mail,$vendor_password,$aadhaar_number,$pan_number,$aadhaar_front_re,$aadhaar_back_re,$pan_pic_re,$trade_license_re,$gst_file_re,$gst_number,$vendor_address,$vendor_state);
										$return_data['status']=false;
									}
									}

								}else{ // else for, invalid pan file

									$return_data['status']=true;
									$return_data['msg']='Invalid PAN file';
									$return_data['icon'] = 'error';

								}


								}else{ // else for, invalid aadhaar back file

									$return_data['status']=true;
									$return_data['msg']='Invalid aadhaar back file';
									$return_data['icon'] = 'error';

								}


								}else{ // else for, invalid aadhaar front file

									$return_data['status']=true;
									$return_data['msg']='Invalid aadhaar front file';
									$return_data['icon'] = 'error';

								}
							}
						}

					}
			
			}else{ // else for token not match

				$return_data['status']=true;
				$return_data['msg']='Please refresh the page';
				$return_data['icon'] = 'error';
			}
			
		}

		
	}
	}
	
	echo json_encode($return_data);
}

function comm_vendor_ins($ref_user_id,$company_name,$company_mail,$company_mobile,$ufname,$ulname,$user_mobile,$user_mail,$vendor_password,$aadhaar_number,$pan_number,$aadhaar_front_re,$aadhaar_back_re,$pan_pic_re,$trade_license_re,$gst_file_re,$gst_number,$vendor_address,$vendor_state){

$enc_pass = md5('salt0'.$vendor_password);
	// insert vendor query 

$vendor_query = bind_insert('vendors', ['ref_user_id' => $ref_user_id, 'company_name' => $company_name, 'email' => $company_mail, 'about' => 'Nothing found...', 'contact' => $company_mobile, 'status' => 1, 'vendor_address' => $vendor_address, 'state_tin' => $vendor_state]);

$vendor_id = $vendor_query['count']; // fetch last id using insert funciton

// insert user query     
$user_query = bind_insert('users', ['vendor_id' => $vendor_id, 'f_name' => $ufname, 'l_name' => $ulname, 'contact' => $user_mobile, 'email' => $user_mail, 'pass' => $enc_pass, 'status' => 2, 'user_type'=> 'VENDOR']);

$user_id = $user_query['count']; // fetch last id using insert function

// insert vendor kyc
$vendor_kyc = bind_insert('vendor_kyc',['vendor_id'=> $vendor_id,'aadhar_number'=> $aadhaar_number,'front_aadhar_pic'=> $aadhaar_front_re,'back_aadhar_pic'=> $aadhaar_back_re,'pan_number'=> $pan_number,'pan_pic'=> $pan_pic_re,'trade_license'=> $trade_license_re,'gst_number'=> $gst_number,'gst_file'=> $gst_file_re]);

}

 ?>