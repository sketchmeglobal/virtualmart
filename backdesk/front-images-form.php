<?php 
include 'cores/comm-head.php';
$_SESSION['msg']='';

if (isset($_POST['insert'])) {
    
    extract($_POST);
    
    $feature_img;
    $muted_text;
    $heading;
    $category;
    // $button_label;
    $category_status =  trim($category_status);
    
    $sql = "INSERT INTO tbl_front_images SET status = '$category_status'";
    $ins = insert($sql);
    $last_id = $ins['count'];
    
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
			$fertaure_img_update = "UPDATE tbl_front_images SET front_image = '$rename_fetaure_img' WHERE id = '$last_id' ";
			update($fertaure_img_update);
		} 
    }
       
    
    if ($ins['count']>0) {
        $_SESSION['msg'] = 'Data inserted';
    }else{
        $_SESSION['msg'] = 'Please try again';
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
  <title>Front Images</title>
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
  <!-- Select datatable -->
  <link href="assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  
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
           <div class="card-body ">
           <div class="card-title text-primary text-center">Front Image</div>
           <hr>
            <form action="" method="post"  enctype="multipart/form-data">
              <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>'?>
          
          
          <div class="form-group row">
            <label for="input-26" class="col-sm-6 col-form-label">Front Image</label>
            <div class="col-sm-6">
                  <input type="file" name="feature_img" class="form-control form-control-rounded" placeholder="">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="input-27" class="col-sm-6 col-form-label">Status</label>
            <div class="col-sm-6">
              <select name="category_status" id="" class="form-control form-control-rounded">
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
            </div>
          </div>

           <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
            <button type="submit" name="insert" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Add Now</button>
            </div>
          </div>
          <div class="" style="float: right;">
            <a href="front-images.php" class="btn btn-success"><-Back</a>
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

  <script src="assets/libs/datatables.net-keyTable/js/dataTables.keyTable.min.html"></script>
  <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
  
</body>
</html>
