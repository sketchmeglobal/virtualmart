<?php 
include '../../function/functions.php';

// gallery & features images update
if (isset($_FILES['feature_img'])) {
	$img_data=[];
	$img_data['status'] = true;
	extract($_FILES);
	extract($_POST);

	$img_data['msg'] = '';


	$users_data = single_data("SELECT user_type,vendor_id FROM users WHERE id = '".$_SESSION['id']."' ")['all_data'];

	// check user vendor type or not. for, product status and vendor id restrictions
	if ($users_data['user_type']=='VENDOR') {

		// vendor id, rstrictions
		$vendor_id = $users_data['vendor_id'];
	}else{
		$vendor_id;
	}

	// feature image restrictions
	if (!empty($feature_img['name'])) {
		
		$feature_img_func = img_check($feature_img['name']);
		if ($feature_img_func['data']==true){
			move_uploaded_file($feature_img['tmp_name'], '../../product-images/'.$feature_img_func['file_name']);

			conditon_update('tbl_product_hdr',['ph_feature_img' => $feature_img_func['file_name'], 'ph_status' => 3], ['phid'=>$_SESSION['edit_ph_id']]);

			$img_data['status'] = true;
			$img_data['msg'] = '';
		}else{
			$img_data['status'] = false;
			$img_data['msg'] = 'Invalid image type';
		}
	}

	// gallery image restrictions
	if (count($gallery_image['name'])>0) {
		$total_gallery_img = count($gallery_image['name']);
		$array_gallery_img=[];

			for ($i=0; $i < $total_gallery_img; $i++) { 

			$gallery_image_func = img_check($gallery_image['name'][$i]);

			if ($gallery_image_func['data']==true) {

				array_push($array_gallery_img, $gallery_image_func['file_name']);

				$gallery_img_path = $gallery_image['tmp_name'][$i];

				move_uploaded_file($gallery_img_path, '../../product-images/'.$gallery_image_func['file_name']);
			}
		
		} // end for loop, for store gallery images as array

		// add coma separte gallery images
		$implode_array_gallery_img = implode(',', $array_gallery_img);
        
        if(count($gallery_image_edit)>0){
            $gallery_image_edit = implode(',',$gallery_image_edit).','.$implode_array_gallery_img;
        }else{
            $gallery_image_edit = $implode_array_gallery_img;
        }
		

		conditon_update('tbl_product_hdr',['ph_gallery_img' => $gallery_image_edit, 'ph_status' => 3], ['phid'=>$_SESSION['edit_ph_id']]);
	}

	

	echo json_encode($img_data);				

} // end isset for, gallery images & feature images


// basic details for second step
if (isset($_POST['parent_cat_id'])) {
	extract($_POST);
	$return_data = [];
	// query for parent category
	$ret_p_cat = conditon_data('tbl_parent_category','*',['p_cid' => $parent_cat_id ]);

	if ($_SESSION['edit_ph_id']>0) {
		//checking parent category
	if($ret_p_cat['data']==true){
		$p_cat_name = $ret_p_cat['all_data']['p_c_name'];

			// ret child category data
			$child_cat_name_ret = conditon_data('tbl_child_category','*',['tccid' => $child_cat_id, 'tc_parent_cat_id' => $parent_cat_id]);
			$child_cat_name = $child_cat_name_ret['all_data']['tc_name'];

			conditon_update('tbl_product_hdr', ['ph_title' => $title, 'brand_id' => $brand_id, 'p_cat_id' => $parent_cat_id, 'p_cat_name' => $p_cat_name, 'c_cat_id' => $child_cat_id, 'c_cat_name' => $child_cat_name, 'ph_status' => 3],['phid'=>$_SESSION['edit_ph_id']]);
			$return_data['status'] = true;


	}else{
		$return_data['msg'] = 'Invalid parent catergory';
		$return_data['status'] = false;
	}
	}else{
		$return_data['msg'] = 'Please upload feature image';
		$return_data['status'] = false;
	}
	

	echo json_encode($return_data);


}



// query for description
if (isset($_POST['editor1'])) {
	extract($_POST);
	$return_data = [];
	$return_data['status']=false;

	$p_desc_head; // long description for table title
	$p_desc_data; // long description for table data
	$desc_combine = array_combine($p_desc_head, $p_desc_data);
	$editor2 = json_encode($desc_combine);

	if ($_SESSION['edit_ph_id']>0) {

		$cat_det = conditon_data('tbl_product_hdr','p_cat_id,c_cat_id',['phid' => $_SESSION['edit_ph_id']])['all_data'];

		if (empty($product_item)) {
			$product_item = NULL;
		}

		// get target_group data
		$target_group_q = conditon_data('group_fields','target_group AS target_group, item_data AS product_item',['p_cat_id'=>$cat_det['p_cat_id'], 'c_cat_id'=>$cat_det['c_cat_id'], 'gf_id'=>$product_item]);

		if ($target_group_q['data']==true) {
			$product_item = $target_group_q['all_data']['product_item'];
			$target_group = $target_group_q['all_data']['target_group'];
		}else{
			$product_item = NULL;
			$target_group = NULL;
		}

		if (empty($product_material)) {
			$product_material = NULL;
		}
		

		

		conditon_update('tbl_product_hdr', ['ph_short_desc' => $editor1, 'ph_desc' => $editor2, 'ph_target_group'=>$target_group , 'ph_item' =>$product_item , 'ph_material'=>$product_material, 'ph_status' => 3],['phid'=>$_SESSION['edit_ph_id']]);
			$return_data['status'] = true;
	}else{
		$return_data['msg'] = 'Please update basic details';
	}
echo json_encode($return_data);

}


/* query for prices*/
if (isset($_POST['price'])) {
	extract($_POST);
	$return_data = [];
	$return_data['status']=false;

	if ($_SESSION['edit_ph_id']>0) {
		delete("DELETE FROM tbl_product_dtl WHERE product_id = '".$_SESSION['edit_ph_id']."' ");
		for ($j=0; $j < count($price); $j++) {
						bind_insert('tbl_product_dtl',['product_id'=>$_SESSION['edit_ph_id'], 'pd_color' => $color[$j], 'pd_size' => $size[$j], 'ph_price'=>$price[$j], 'ph_dp' => $dp[$j], 'ph_qty'=> $qty[$j], 'opening_stock' => $opening_stock[$j] ]);
					}
			$return_data['status']=true;		
	}else{
		$return_data['msg'] = 'Please update description';
	}

	echo json_encode($return_data);
}


if (isset($_POST['product_status'])) {
	$return_data = [];
	$return_data['status']=false;
	extract($_POST);

	if ($_SESSION['edit_ph_id']>0) {
		conditon_update('tbl_product_hdr',['ph_status' => 3, 'ph_shipping_charge' => $shipping_charges, 'ph_tax' => $product_tax, 'ph_upload_type'=>'UPDATED', 'ph_status' => 3],['phid'=>$_SESSION['edit_ph_id']]);
		$_SESSION['edit_ph_id'] = 0;
		$return_data['status']=true;
	}else{
		$return_data['msg'] = 'Please update price details';
	}
	echo json_encode($return_data);
}

 ?>