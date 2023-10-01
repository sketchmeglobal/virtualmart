<?php
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5('admin'));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>New Vendor</title>
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
                  <div class="card-title text-primary text-center">New Vendor</div>
                  <hr>
                  <form action="cores/new-vendor-ins.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                    <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>'?>
                    
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Logo</label>
                      <div class="col-sm-6">
                        <input type="file" name="feature_img" class="form-control form-control-rounded" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Company name</label>
                      <div class="col-sm-6">
                        <input type="text" name="company_name" class="form-control form-control-rounded" id="input-26" placeholder="Enter Comapny Name" required>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Company Email</label>
                      <div class="col-sm-6">
                        <input type="email" name="company_email" class="form-control form-control-rounded" id="input-26" placeholder="Enter Company Email" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Company GST Number</label>
                      <div class="col-sm-6">
                        <input type="text" name="gst" class="form-control form-control-rounded" id="input-26" placeholder="Enter Company gst number" required>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Company Contact</label>
                      <div class="col-sm-6">
                        <input type="text" name="company_contact" class="form-control form-control-rounded" id="input-26" placeholder="Enter Company Contact" required>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Company Website</label>
                      <div class="col-sm-6">
                        <input type="text" name="website" class="form-control form-control-rounded" id="input-26" placeholder="Enter Website">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Authority name</label>
                      <div class="col-sm-6">
                        <input type="text" name="authority_name" class="form-control form-control-rounded" id="input-26" placeholder="Enter Authority name" required>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Authority email</label>
                      <div class="col-sm-6">
                        <input type="email" name="authority_email" class="form-control form-control-rounded" id="input-26" placeholder="Enter Authority email" required>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Authority Contact</label>
                      <div class="col-sm-6">
                        <input type="text" name="authority_contact" class="form-control form-control-rounded" id="input-26" placeholder="Enter Authority Contact" required>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">About Company</label>
                      <div class="col-sm-6">
                        <textarea placeholder="About the company" name="editor1"></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Vendor Status</label>
                      <div class="col-sm-6">
                        <select name="vendor_status" id="" class="form-control form-control-rounded">
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
                      <a href="all-vendors.php" class="btn btn-success"> <- Back </a>
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
          <script>
          CKEDITOR.replace( 'editor1' );
          CKEDITOR.replace( 'editor2' );
          </script>
        </body>
      </html>