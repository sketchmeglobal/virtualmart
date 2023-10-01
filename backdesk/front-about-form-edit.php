<?php 
include 'cores/comm-head.php';
$_SESSION['msg']='';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tbl_front_about` WHERE id = '$id' ";
    $data = single_data($sql);
}else{
header('location:front-about.php');
}

if (isset($_POST['update'])) {
    extract($_POST);
    
    $feature_img;
    $show_slider;
    $category_name = trim($category_name);
    $category_status =  trim($category_status);
    
    if ( empty($category_name)) {
       $_SESSION['msg']='Please fill all details';
    }else{
        $sql = "UPDATE tbl_child_category SET tc_parent_cat_id = '$parent_id', tc_name = '$category_name', show_slider = '$show_slider', tc_status = '$category_status'  WHERE id = '$about_id' ";
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
				move_uploaded_file($feature_img_path, '../product-images/'.$rename_fetaure_img);
				$fertaure_img_update = "UPDATE tbl_child_category SET feature_image = '$rename_fetaure_img' WHERE id = '$about_id' ";
				update($fertaure_img_update);
			} 
       }
       
        if ($dataa!=false) {
             $_SESSION['msg']='data updated';

        }else{
             $_SESSION['msg']='Please try again';
        }
        
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
  <title>Front About</title>
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
           <div class="card-title text-primary text-center">Front About Edit</div>
           <hr>
            <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>';?></p>
               <form action="" method="post"  enctype="multipart/form-data">
              <input type="hidden" name="about_id" value="<?=$data['all_data']['id'];?>">
          
            <div class="form-group row">
                <label for="input-26" class="col-md-3 col-form-label">Content</label>
                <div class="col-md-9">
                    <textarea name="editor1"><?=$data['all_data']['content'];?></textarea>
                </div>
            </div>
          
            <div class="form-group row">
                <label for="input-26" class="col-md-3 col-form-label">Info 1</label>
                <div class="col-md-9">
                    <textarea name="editor4"><?=$data['all_data']['info1'];?></textarea>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="input-26" class="col-md-3 col-form-label">Info 2</label>
                <div class="col-md-9">
                    <textarea name="editor2"><?=$data['all_data']['info2'];?></textarea>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="input-26" class="col-md-3 col-form-label">Info 3</label>
                <div class="col-md-9">
                    <textarea name="editor3"><?=$data['all_data']['info3'];?></textarea>
                </div>
            </div>
          
           <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
            <button type="submit" name="update" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
            </div>
          </div>
          <div class="" style="float: right;">
            <a href="front-about.php" class="btn btn-success"><-Back</a>
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
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    
  <script>
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
        CKEDITOR.replace( 'editor3' );
        CKEDITOR.replace( 'editor4' );
    </script>
</body>
</html>
