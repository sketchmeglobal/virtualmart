<?php 
include 'cores/comm-head.php';
$_SESSION['msg']='';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_slider WHERE id = '$id' ";
    $data = single_data($sql);
    // print_r($data);
    $parent_category = all_data("SELECT * FROM tbl_parent_category WHERE p_c_status = 1")['all_data'];
    
}else{
header('location:slider.php');
}

if (isset($_POST['update'])) {
    extract($_POST);
    
    $muted_text;
    $heading;
    $category;
    $feature_img;
    $category_status;
    
    $sql = "UPDATE tbl_slider SET muted_text='$muted_text', header='$heading', category='$category', status = '$category_status' WHERE id = '$id' ";
    $dataa = update($sql);
   
    $feature_img = $_FILES['feature_img']['name'];
    if($feature_img != ''){
        $allow_file_ext = array('png','jpg','jpeg','gif');
        $feature_img = $_FILES['feature_img']['name'];
		$feature_img_path = $_FILES['feature_img']['tmp_name'];

		$feature_img_explode = explode('.',$feature_img);
		$check_feature_img_ext = strtolower(end($feature_img_explode));
		$rename_fetaure_img = date("YmdHis").sha1(md5($feature_img)).'.'.$check_feature_img_ext;

		if (in_array($check_feature_img_ext, $allow_file_ext)) { // feature image accept
			move_uploaded_file($feature_img_path, '../slider-images/'.$rename_fetaure_img);
			$fertaure_img_update = "UPDATE tbl_slider SET slider_image = '$rename_fetaure_img' WHERE id = '$id' ";
			update($fertaure_img_update);
		} 
    }
   
    if ($dataa!=false) {
         $_SESSION['msg']='data updated';

    }else{
         $_SESSION['msg']='Please try again';
    }
    
    //update
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Slider Edit</title>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">
 
<?php include 'cores/menu.php' ?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->
	  
      <div class="row mt-3  d-flex justify-content-center">
        
      <div class="col-lg-8">
         
       <div class="card">
           <div class="card-body">
           <div class="card-title text-primary text-center">Slider Edit</div>
           <hr>
            <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>';?></p>
               <form action="" method="post"  enctype="multipart/form-data">
              <input type="hidden" name="child_id" value="<?=$data['all_data']['id'];?>">
              
          
          <div class="form-group row">
            <label for="input-26" class="col-sm-6 col-form-label">Slider Image</label>
            <div class="col-sm-6">
                  <input type="file" name="feature_img" class="form-control form-control-rounded" placeholder="">
                  <img style="height: 150px;display: block;margin-top: 5px;margin-right: 15px;margin-left: auto;" src="../slider-images/<?=$data['all_data']['slider_image']?>" alt="" class="">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="input-26" class="col-sm-6 col-form-label">Muted Text</label>
            <div class="col-sm-6">
                  <input type="text" name="muted_text" class="form-control form-control-rounded" placeholder="Small muted text" value="<?=$data['all_data']['muted_text']?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="input-26" class="col-sm-6 col-form-label">Catchy Heading</label>
            <div class="col-sm-6">
                  <input type="text" name="heading" class="form-control form-control-rounded" placeholder="Catchy Heading" value="<?=$data['all_data']['header']?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="input-26" class="col-sm-6 col-form-label">Category</label>
            <div class="col-sm-6">
                <select name="category" class="form-control">
                    
                <?php
                foreach($parent_category as $pc){
                ?>
                      <option <?= ($pc['p_cid'] == $data['all_data']['category']) ? 'selected' : '' ?> value="<?=$pc['p_cid']?>"><?= $pc['p_c_name'] ?></option>
                <?php } ?>
                
                </select>
            </div>
          </div>
          
         
          <div class="form-group row">
            <label for="input-27" class="col-sm-6 col-form-label">Category Status</label>
            <div class="col-sm-6">
              <select name="category_status" id="" class="form-control form-control-rounded">
                  <option <?=$data['all_data']['status']==1 ? 'selected':''; ?> value="1">Active</option>
                  <option <?=$data['all_data']['status']==0 ? 'selected':''; ?> value="0">Deactive</option>
              </select>
            </div>
          </div>
           <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
            <button type="submit" name="update" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
            </div>
          </div>
          <div class="" style="float: right;">
            <a href="slider.php" class="btn btn-success"><-Back</a>
          </div>
          </form>
         </div>
         </div>

      </div>
      
      </div><!--End Row-->

      <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->

    <?php include 'cores/footer.php' ?>
   
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- waves effect js -->
  <script src="assets/js/waves.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <!-- Chart js -->
  <script src="assets/plugins/Chart.js/Chart.min.js"></script>
  <!--Peity Chart -->
  <script src="assets/plugins/peity/jquery.peity.min.js"></script>
  
</body>
</html>
