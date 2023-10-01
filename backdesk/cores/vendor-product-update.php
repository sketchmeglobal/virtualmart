<?php
if (isset($_POST['vendor_id'])) {
	include '../../function/functions.php';
	extract($_POST);

	// efine a array for return array using json_encode
	$return_data = [];
	$return_data['status']=false;
	
	$users_data = single_data("SELECT user_type,vendor_id FROM users WHERE id = '".$_SESSION['id']."' ")['all_data'];

	$token;

	// check user vendor type or not. for, product status and vendor id restrictions
	if ($users_data['user_type']=='VENDOR') {

		// product status change for, admin approval
		if ($product_status==1) {
			$product_status = 3;
		}else{
			$product_status = 0;
		}

		// vendor id, rstrictions
		$vendor_id = $users_data['vendor_id'];
	}else{
		$vendor_id;
		$product_status;
	}
	
	$parent_cat_id;
	$child_cat_id;
	$title;
	$editor1; // short desc
	$p_desc_head; // long description for table title
	$p_desc_data; // long description for table data
	$desc_combine = array_combine($p_desc_head, $p_desc_data);
	$editor2 = json_encode($desc_combine);
	$price;
	$feature_img = $_FILES['feature_img']['name'];
	$gallery_image; // multiple images
	$opening_stock;
	$qty;
	
	$gallery_images = $_FILES['gallery_image']['name'];
	$total_gallery_img = count($gallery_images);
	$allow_file_ext = array('png','jpg','jpeg','gif');
	// query for parent category

	$ret_p_cat = conditon_data('tbl_parent_category','*',['p_cid' => $parent_cat_id ]);
	
	// token checking
	if ($_SESSION['token']==$token) {
		
		//checking parent category
			if($ret_p_cat['data']==true){
				$p_cat_name = $ret_p_cat['all_data']['p_c_name'];
				// check product title
				$title_func = conditon_data('tbl_product_hdr','*',['ph_title'=> $title]);
				if ($title_func['data']==true) {
					$return_data['msg'] = 'Title already inserted';
				
				}else{ // else for title function checking
					// ret child category data
					$child_cat_name_ret = conditon_data('tbl_child_category','*',['tccid' => $child_cat_id, 'tc_parent_cat_id' => $parent_cat_id]);
					$child_cat_name = $child_cat_name_ret['all_data']['tc_name'];

					//retrive old data
					    $old_data = conditon_data('vendors JOIN tbl_product_hdr ON vendors.id = tbl_product_hdr.vendor_id
						  JOIN users ON users.vendor_id = vendors.id
						  ','*',['tbl_product_hdr.phid'=>$vendor_id])['all_data'];
						    
						    // update users log
						    user_log('tbl_product_hdr', $old_data['phid'], 'EDIT', $old_data,'PRODUCT');

						    // update product header
						    conditon_update('tbl_product_hdr',[ 'ph_title' => $title, 'p_cat_id' => $parent_cat_id, 'p_cat_name' => $p_cat_name,
					'c_cat_id' => $child_cat_id, 'c_cat_name' => $child_cat_name, 'ph_price' => $price, 'ph_short_desc' => $editor1, 'ph_desc' => $editor2, 'ph_qty' => $qty,
					'opening_stock' => $opening_stock, 'ph_status' => $product_status,
					'ph_dp' => $dp, 'ph_shipping_charge' => $shipping_charges, 'ph_tax' => $tax, 'ph_bonus' => $bonus],['phid'=>$old_data['phid'], 'vendor_id' => $vendor_id,]);

					$last_id = $old_data['phid']; // fetch last id using insert funciton
					// feature image restrictions
					$feature_img = $_FILES['feature_img']['name'];
					$feature_img_path = $_FILES['feature_img']['tmp_name'];
					$feature_img_explode = explode('.',$feature_img);
					$check_feature_img_ext = strtolower(end($feature_img_explode));
					$rename_fetaure_img = date("YmdHis").sha1(md5($feature_img)).'.'.$check_feature_img_ext;
					if (in_array($check_feature_img_ext, $allow_file_ext)) { // feature image accept
						move_uploaded_file($feature_img_path, '../../product-images/'.$rename_fetaure_img);

						conditon_update('tbl_product_hdr',['ph_feature_img' => $rename_fetaure_img],['phid' => $last_id]);
					}
					// gallery images
					
					$array_gallery_img=[];
					for ($i=0; $i < $total_gallery_img; $i++) {
						$gallery_img_path = $_FILES['gallery_image']['tmp_name'][$i];
						
						$ret_img = explode('.',$gallery_images[$i]);
						$check_file = strtolower(end($ret_img));
						if (in_array($check_file, $allow_file_ext)) {
							$rename = date("YmdHis").sha1(md5($gallery_images[$i])).'.'.$check_file;
							array_push($array_gallery_img, $rename);
							move_uploaded_file($gallery_img_path, '../../product-images/'.$rename);
							
						}
					}
					$implode_array_gallery_img = implode(',', $array_gallery_img);
					//insert gallery images

					bind_insert('tbl_product_dtl',['product_id' => $last_id, 'pd_images' => $implode_array_gallery_img]);

					$return_data['msg']='Product updated. Please wait, for admin approval';
					$return_data['status']=true;
					$_SESSION['token'] = sha1(md5(time()));
				}
			}else{ // esle for parent category
				$return_data['msg']="Invalid parent catergory";
			}
	}else{ // else for token
		$return_data['msg']="Please refresh the webpage";
	}

	echo json_encode($return_data);
	
}

?>