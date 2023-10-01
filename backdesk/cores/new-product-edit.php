<?php 



if (isset($_POST['update'])) {

	include '../../function/functions.php';

	extract($_POST);

	

// 	echo '<pre>', print_r($_POST), '</pre>'; die;

	

	$token;

	$vendor_id;

	$productId;

	$parent_cat_id;

	$child_cat_id;

	$title;

	$editor1; // short desc

	$p_desc_head; // long description for table title

	$p_desc_data; // long description for table data



	$desc_combine = array_combine($p_desc_head, $p_desc_data);

	$editor2 = json_encode($desc_combine);



	$price;

	$gallery_image; // multiple images

	$qty;

	$product_status;



    if($_FILES['feature_img']['name'] != ''){

	    $feature_img = $_FILES['feature_img']['name'];

	}else{

	    $feature_img = NULL;

	}

    if($_FILES['gallery_image']['name'] != ''){

	    $gallery_images = $_FILES['gallery_image']['name'];

	    $total_gallery_img = count($gallery_images);

    }else{

        $gallery_images=NULL;

        $total_gallery_img = 0;

    }

    

	



	$allow_file_ext = array('png','jpg','jpeg','gif');



	// query for parent category

	$p_cat_query = "SELECT * FROM tbl_parent_category WHERE p_cid = '$parent_cat_id' ";

	$ret_p_cat = single_data($p_cat_query);

	

	// token checking

	if ($_SESSION['token']==$token) {



 		//checking parent category 

			if($ret_p_cat['data']==true){

				$p_cat_name = $ret_p_cat['all_data']['p_c_name'];



				// check product title

				$title_query = "SELECT * FROM tbl_product_hdr WHERE ph_title = '$title' ";

				$title_func = single_data($title_query);

     

				// ret child category data

				$child_query = "SELECT * FROM tbl_child_category WHERE tccid = '$child_cat_id' && tc_parent_cat_id = '$parent_cat_id' ";

				$child_cat_name_ret = single_data($child_query);

				$child_cat_name = $child_cat_name_ret['all_data']['tc_name'];



				// update product query 

				if($vendor_id == 'none'){

	                $sql_ins = "UPDATE tbl_product_hdr SET vendor_id = NULL, ph_title = '$title', p_cat_id = '$parent_cat_id', p_cat_name = '$p_cat_name', c_cat_id = '$child_cat_id', c_cat_name = '$child_cat_name', ph_price = '$price', ph_short_desc = '$editor1', ph_desc = '$editor2', ph_qty = '$qty', ph_status = '$product_status', ph_dp = '$dp', ph_shipping_charge = '$shipping_charges', ph_tax = '$tax', ph_bonus = '$bonus'  WHERE phid=$productId";

	            }else{

	                $sql_ins = "UPDATE tbl_product_hdr SET vendor_id = '$vendor_id', ph_title = '$title', p_cat_id = '$parent_cat_id', p_cat_name = '$p_cat_name', c_cat_id = '$child_cat_id', c_cat_name = '$child_cat_name', ph_price = '$price', ph_short_desc = '$editor1', ph_desc = '$editor2', ph_qty = '$qty', ph_status = '$product_status', ph_dp = '$dp', ph_shipping_charge = '$shipping_charges', ph_tax = '$tax', ph_bonus = '$bonus'  WHERE phid=$productId";

	            }

				

				$last_id_query = update($sql_ins);

				$last_id = $productId; 



				// feature image restrictions



				$feature_img_path = $_FILES['feature_img']['tmp_name'];

                

                if($feature_img != ''){

                    

					$feature_img_explode = explode('.',$feature_img);

					$check_feature_img_ext = strtolower(end($feature_img_explode));

					$rename_fetaure_img = date("YmdHis").sha1(md5($feature_img)).'.'.$check_feature_img_ext;



					if (in_array($check_feature_img_ext, $allow_file_ext)) { // feature image accept

					    move_uploaded_file($feature_img_path, '../../product-images/'.$rename_fetaure_img);

						$fertaure_img_update = "INSERT tbl_product_hdr SET ph_feature_img = '$rename_fetaure_img' WHERE phid = '$last_id' ";

						insert($fertaure_img_update);

					}

                }



				// gallery images 

				 

				if($gallery_images != '' or $gallery_images != NULL){ 

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

					if($implode_array_gallery_img != ''){

					    $gallery_images_insert = "INSERT tbl_product_dtl SET product_id = '$last_id', pd_images = '$implode_array_gallery_img'";

					    insert($gallery_images_insert);

					}

					

				}

				$_SESSION['msg']='Product Updated';

				



			}else{ // esle for parent category 

				$_SESSION['msg']="Invalid parent catergory";

			}



 	}else{ // else for token

		$_SESSION['msg']="Please try again";

	}



}

echo '<h2 style="text-center">';

echo $_SESSION['msg'];

header("Refresh:2; url=../product-form-edit.php?id=$productId");

 ?>