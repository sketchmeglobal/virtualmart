<?php 
include 'cores/comm-head.php';

$_SESSION['msg'] = '';
if (isset($_POST['insert'])) {
    extract($_POST);
    $category_name = trim($category_name);
    $category_status =  trim($category_status);
    if ( empty($category_name)) {
       $_SESSION['msg']='Please fill all details';
    }else{
       
       $check = check("SELECT * FROM tbl_parent_category WHERE p_c_name = '$category_name' ");
       if ($check['count']>0) {
         $_SESSION['msg'] = 'Data already added';
       }else{
        $ins = insert("INSERT INTO tbl_parent_category SET p_c_name = '$category_name', p_c_status = '$category_status' ");
        if ($ins['count']>0) {
            $_SESSION['msg'] = 'Data inserted';
        }else{
            $_SESSION['msg'] = 'Please try again';
        }
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
  <title>Parent Category</title>
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
        
      <div class="col-lg-6 ">
         
       <div class="card">
           <div class="card-body ">
           <div class="card-title text-primary text-center">Parent Category</div>
           <hr>
            <form action="" method="post">
              <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>'?>
           <div class="form-group row">
            <label for="input-26" class="col-sm-6 col-form-label">Category Name</label>
            <div class="col-sm-6">
            <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="Enter Category Name" name="category_name">
            </div>
          </div>
          <div class="form-group row">
            <label for="input-27" class="col-sm-6 col-form-label">Category Status</label>
            <div class="col-sm-6">
              <select name="category_status" id="" class="form-control form-control-rounded">
                <option value="" disabled selected>Select here</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
           <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary shadow-dark btn-round px-5" name="insert"><i class="icon-plus"></i> Add Now</button>
            </div>
          </div>
          <div class="" style="float: right;">
            <a href="parent-category.php" class="btn btn-success"><-Back</a>
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
