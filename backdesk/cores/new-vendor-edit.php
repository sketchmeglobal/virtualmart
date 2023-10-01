<?php
if (isset($_POST['update'])) {

	include '../../function/functions.php';

	extract($_POST);

	$VendorId;

	$token;

	$company_name;

	$company_email;

	$company_contact;

	$authority_f_name;
	$authority_l_name;

	$authority_email;

	$authority_contact;

	$website;

	$editor1;

	$vendor_status;

	$feature_img = $_FILES['feature_img']['name'];

	$allow_file_ext = array('png','jpg','jpeg','gif');



	

	// token checking

	if ($_SESSION['token']==$token) {

        



				{ 



					// update vendor query 

					$sql_ins = "UPDATE vendors SET company_name = '$company_name', email = '$company_email', contact = '$company_contact', 

					website = '$website', about = '$editor1', status = '$vendor_status' WHERE id='$VendorId'";

                    $sql_2_ins = "UPDATE users SET f_name = '$authority_f_name', l_name = '$authority_l_name', contact = '$authority_contact', email = '$authority_email', status = '$vendor_status' WHERE vendor_id = '$VendorId' ";
                    
                    update($sql_2_ins);
                    
					$last_id_query = update($sql_ins);

					$last_id = $VendorId; // fetch last id using insert funciton



					// feature image restrictions



                    if($_FILES['feature_img']['name'] != ''){    

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

                    }	



					$_SESSION['msg']='Vendor Updated';

				}





 	}else{ // else for token

		$_SESSION['msg']="Please try again";

	}



}
echo '<script>alert("'.$_SESSION['msg'].'");window.location.href="../all-vendors.php";</script>';
 ?>