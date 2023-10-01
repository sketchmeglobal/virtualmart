<?php
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5(time()));

if (isset($_GET['vid'])) {

$vid = $_GET['vid'];

$query = "SELECT *, users.status AS U_STATUS FROM vendors 
JOIN vendor_kyc ON vendors.id = vendor_kyc.vendor_id
JOIN users ON users.vendor_id = vendor_kyc.vendor_id
WHERE vendors.id=$vid";
$all_vendors = all_data($query);
// echo '<pre>', print_r($all_vendors), '</pre>';

if($all_vendors['data'] == NULL){
    echo '<pre>', print_r($all_vendors), '</pre>';
    die('Severe Error! Contact admin with the error message above.');    
}

$vendor_details = $all_vendors['all_data'][0];

}
else{
	header('location:../index.php');
}

if (isset($_POST['update'])) {
  extract($_POST);
  $vendor_status;
  $vid;
  update("UPDATE users SET status = $vendor_status WHERE vendor_id = $vid ");
  $_SESSION['msg']='Vendor Account activated';
  // code...
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
  <title>Edit Vendor</title>
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
  <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

</head>

<body>

<!--Vendor details-->


<!-- Start wrapper-->
 <div id="wrapper">
 
<?php include 'cores/menu.php' ?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->

      <div class="row mt-3  d-flex justify-content-center">

      <div class="col-lg-10 ">

       <div class="card">
           <div class="card-body">
           <div class="card-title text-primary text-center">Edit Vendor</div>
           <hr>
            <form action="" method="post" enctype="multipart/form-data">
              
              <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
              <input type="hidden" value="<?=$vid?>" name="vid">
              
              <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>'?>
              
              <div class="form-group row">
                <label for="input-26" class="col-sm-6 col-form-label">Logo</label>
                <div class="col-sm-6">
                      <input type="file" name="feature_img" class="form-control form-control-rounded">
                </div>
                <img style="height: 100px;display: block;margin-top: 5px;margin-right: 15px;margin-left: auto;" src="../vendor-images/<?=$vendor_details['logo']?>" alt="" class="" />
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Company name</label>
                  <div class="col-sm-6">
                    <input type="text" name="company_name" class="form-control form-control-rounded" id="input-26" placeholder="Enter Comapny Name" value="<?=$vendor_details['company_name']?>">
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Company Email</label>
                  <div class="col-sm-6">
                    <input type="text" name="company_email" class="form-control form-control-rounded" id="input-26" placeholder="Enter Company Email" value="<?=$vendor_details['email']?>">
                  </div>
              </div>

              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Company Contact</label>
                  <div class="col-sm-6">
                    <input type="text" name="company_contact" class="form-control form-control-rounded" id="input-26" placeholder="Enter Company Contact" required value="<?=$vendor_details['contact']?>">
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Company Website</label>
                  <div class="col-sm-6">
                    <input type="text" name="website" class="form-control form-control-rounded" id="input-26" placeholder="Enter Website" value="<?=$vendor_details['website']?>">
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-26" class="col-sm-6 col-form-label">Authority first name<sup class="text-danger">*</sup></label>
                  <div class="col-sm-6">
                    <input type="text" name="authority_f_name" class="form-control form-control-rounded" id="input-26" placeholder="Enter Authority name" required value="<?=$vendor_details['f_name']?>">
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-26" class="col-sm-6 col-form-label">Authority last name<sup class="text-danger">*</sup></label>
                  <div class="col-sm-6">
                    <input type="text" name="authority_l_name" class="form-control form-control-rounded" id="input-26" placeholder="Enter Authority name" required value="<?=$vendor_details['l_name']?>">
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-26" class="col-sm-6 col-form-label">Authority email<sup class="text-danger">*</sup></label>
                  <div class="col-sm-6">
                    <input type="email" name="authority_email" class="form-control form-control-rounded" id="input-26" placeholder="Enter Authority email" required value="<?=$vendor_details['email']?>">
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Authority Contact<sup class="text-danger">*</sup></label>
                  <div class="col-sm-6">
                    <input type="text" name="authority_contact" class="form-control form-control-rounded" id="input-26" placeholder="Enter Authority Contact" required value="<?=$vendor_details['contact']?>">
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">About Company</label>
                  <div class="col-sm-6">
                        <textarea placeholder="About the company" name="editor1">
                            <?= $vendor_details['about'] ?>
                        </textarea>
                  </div>
              </div>

              <!-- vendor kyc details -->

              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Aadhaar Number</label>
                  <div class="col-sm-6">
                    <input type="text" name="authority_contact" class="form-control form-control-rounded" id="input-26" placeholder="aadhaar_number" required value="<?=$vendor_details['aadhar_number']?>">
                    <a class="text-warning" href="../vendor-kyc/<?=$vendor_details['front_aadhar_pic']?>" target="_blank">Front Side</a> || <a class="text-info" href="../vendor-kyc/<?=$vendor_details['back_aadhar_pic']?>" target="_blank">Back Side</a>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">pan number</label>
                  <div class="col-sm-6">
                    <input type="text" name="authority_contact" class="form-control form-control-rounded" id="input-26" placeholder="pan_number" required value="<?=$vendor_details['pan_number']?>">
                    <a class="text-warning" href="../vendor-kyc/<?=$vendor_details['pan_pic']?>" target="_blank">PAN file</a>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">gst number</label>
                  <div class="col-sm-6">
                    <input type="text" name="authority_contact" class="form-control form-control-rounded" id="input-26" placeholder="gst_number" value="<?=$vendor_details['gst_number']?>">
                    <?php if($vendor_details['gst_number'] !=''): ?>
                    <a class="text-warning" href="../vendor-kyc/<?=$vendor_details['gst_file']?>" target="_blank">GST file</a>
                  <?php endif; ?>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">trade license</label>
                  <div class="col-sm-6">
                    <?php if($vendor_details['trade_license'] !=''): ?>
                    <a class="text-warning" href="../vendor-kyc/<?=$vendor_details['trade_license']?>" target="_blank">Trade License file</a>
                  <?php endif; ?>
                  </div>
              </div>

          <div class="form-group row">
            <label for="input-27" class="col-sm-6 col-form-label">Vendor Status</label>
            <div class="col-sm-6">
              <select name="vendor_status" id="" class="form-control form-control-rounded">
                <option <?= ($vendor_details['U_STATUS'] == 1 ? 'selected' : '') ?> value="1">Active</option>
                <option <?= ($vendor_details['U_STATUS'] == 2 ? 'selected' : '') ?> value="2">Inactive</option>
              </select>
            </div>
          </div>
           <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
            <button type="submit" name="update" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
            </div>
          </div>
          <div class="" style="float: right;">
            <a href="all-vendors.php" class="btn btn-success"><-Back</a>
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

    <script>
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
    </script>
    
</body>
</html>