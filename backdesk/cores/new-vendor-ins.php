<?php 
if (isset($_POST['insert'])) {
	include '../../function/functions.php';
	extract($_POST);
	$token;
	$company_name;
	$company_email;
	$company_contact;
	$authority_name;
	$authority_email;
	$authority_contact;
	$website;
	$editor1;
	$vendor_status;
	$feature_img = $_FILES['feature_img']['name'];
	$allow_file_ext = array('png','jpg','jpeg','gif');
	// token checking
	if ($_SESSION['token']==$token) {
				// check vendor title
				$company_email_query = "SELECT * FROM vendors WHERE email = '$company_email' ";
				$func1 = single_data($company_email_query);
				$ph_query = "SELECT * FROM vendors WHERE contact = '$company_contact' ";
				$func2 = single_data($ph_query);
				$query_gst = single_data("SELECT * FROM vendors WHERE gst = '$gst' ");
				
				if ($func1['data']==true) {
					$_SESSION['msg'] = 'Email already exists';
				}else if($func2['data']==true){
				    $_SESSION['msg'] = 'Phone number already exists';
				} else if($query_gst['data']==true){
					$_SESSION['msg'] = 'GST number already exists';
				}
				else{ // else for title function checking 
					// insert vendor query 
				$sql_ins = "INSERT INTO vendors SET company_name = '$company_name', email = '$company_email', gst = '$gst', contact = '$company_contact', 
					website = '$website', main_person_name = '$authority_name', main_person_email = '$authority_email', main_person_contact = '$authority_contact', 
					about = '$editor1', status = '$vendor_status'";
					$last_id_query = insert($sql_ins);
					$last_id = $last_id_query['count']; // fetch last id using insert funciton
					// feature image restrictions
					$feature_img = $_FILES['feature_img']['name'];
					$feature_img_path = $_FILES['feature_img']['tmp_name'];
					$feature_img_explode = explode('.',$feature_img);
					$check_feature_img_ext = strtolower(end($feature_img_explode));
					$rename_fetaure_img = date("YmdHis").sha1(md5($feature_img)).'.'.$check_feature_img_ext;
					if (in_array($check_feature_img_ext, $allow_file_ext)) { // feature image accept
						move_uploaded_file($feature_img_path, '../../vendor-images/'.$rename_fetaure_img);
						$fertaure_img_update = "UPDATE vendors SET logo = '$rename_fetaure_img' WHERE id = '$last_id' ";
						update($fertaure_img_update);
					}
					
				// 	add vendor to user table - new section (sayak)
				// $sql_ins = "INSERT INTO users SET vendor_id = '$last_id', f_name = '$authority_name', email = '$authority_email', contact = '$authority_contact', 
				// 	user_type = 'VENDOR'";
				// $last_id_query = insert($sql_ins);
				// 	add vendor to user table - new section (sayak)
				
					// gallery images 
					$array_gallery_img=[];
					$_SESSION['msg']='Vendor added | Vendor User created';
				}
 	}else{ // else for token
		$_SESSION['msg']="Please try again";
	}
}
echo '<h2 style="text-center">';
echo $_SESSION['msg'];
header("Refresh:2; url=../new-vendor.php");
 ?>