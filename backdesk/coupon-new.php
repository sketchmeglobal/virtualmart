<?php
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5(time()));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>New Coupon</title>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select datatable -->
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
                  <div class="card-title text-primary text-center">New Coupon</div>
                  <hr>
                  <form action="cores/new-coupon-ins.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                    <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>'?>
                    
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">COUPON CODE<span class="text-danger">*</span></label>
                      <div class="col-sm-6">
                        <input type="text" name="coupon_code" class="form-control form-control-rounded" id="input-26" placeholder="Enter COUPON CODE" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">COUPON AMOUNT<span class="text-danger">*</span></label>
                      <div class="col-sm-6">
                        <input type="text" name="coupon_amount" class="form-control form-control-rounded" id="input-26" placeholder="Enter COUPON AMOUNT" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">COUPON TYPE<span class="text-danger">*</span></label>
                      <div class="col-sm-6">
                        <select name="coupon_type" id="" class="form-control form-control-rounded">
                          <option value="FIXED">FIXED</option>
                          <option value="PERCENTAGE">PERCANTAGE</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">ALLOWED PRODUCTS </label>
                      <div class="col-sm-6">
                        <select name="allowed_products[]" id="allowed_products" class="form-control form-control-rounded select2_1" multiple onchange="allow_product();">
                          <?php 
                          $all_products = all_data("SELECT phid, ph_title FROM tbl_product_hdr WHERE ph_status = 1 ORDER BY p_cat_name, c_cat_name ASC");
                          if(!empty($all_products['data'])){
                            foreach ($all_products['all_data'] as $ap) {
                          ?>
                          <option value="<?=$ap['phid']?>"><?=$ap['ph_title']?></option>
                         <?php } }?>
                        </select>
                      </div>

                    </div>

                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">DISALLOWED PRODUCTS</label>
                      <div class="col-sm-6">
                        <select name="disallowed_products[]" id="disallowed_products" class="form-control form-control-rounded select2_1" multiple onchange="disallow_product();">
                          <?php 
                          $all_products = all_data("SELECT phid, ph_title FROM tbl_product_hdr WHERE ph_status = 1 ORDER BY p_cat_name, c_cat_name ASC");
                          if(!empty($all_products['data'])){
                            foreach ($all_products['all_data'] as $ap) {
                          ?>
                          <option value="<?=$ap['phid']?>"><?=$ap['ph_title']?></option>
                         <?php } }?>
                        </select>
                        <div id="products_disallowed_dis" class="text-danger" style="display:none"></div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">MAX LIMIT<span class="text-danger">*</span></label>
                      <div class="col-sm-6">
                        <input type="number" name="max_limit" class="form-control form-control-rounded" id="input-26" placeholder="max limit" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Expiary Date<span class="text-danger">*</span></label>
                      <div class="col-sm-6">
                        <input type="date" name="expiary_date" class="form-control form-control-rounded" id="input-26" placeholder="" required>
                      </div>
                    </div>
                    

                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Coupon Status<span class="text-danger">*</span></label>
                      <div class="col-sm-6">
                        <select name="coupon_status" id="" class="form-control form-control-rounded">
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
                      <a href="coupon-code.php" class="btn btn-success"> <- Back </a>
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
          <!--Peity Chart -->
          <script src="assets/plugins/peity/jquery.peity.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
          <script>
            $(document).ready(function() {
                $('.select2_1').select2();
            });

            function allow_product(){
              var allowed_products = $('#allowed_products').val(); 
              var disallowed_products = $('#disallowed_products').val(); 
              $('#products_disallowed_dis').html('');
              $('#products_disallowed_dis').hide();

              if (disallowed_products != '') {
              $.ajax({
                type:'post',
                url:'cores/products-checking.php',
                data:'allow_check=yes&allowed_products='+allowed_products+'&disallowed_products='+disallowed_products,
                success:function(data){
                  if (data==1) {
                    $('#products_disallowed_dis').html('');
                    $('#products_disallowed_dis').hide();
                  }else{
                    $('#products_disallowed_dis').html('Product already added');
                  $('#products_disallowed_dis').show();
                  }
                  
                }

              });
            }
          }

          function disallow_product(){
              var allowed_products = $('#allowed_products').val(); 
              var disallowed_products = $('#disallowed_products').val(); 

              if (allowed_products != '') {
              $.ajax({
                type:'post',
                url:'cores/products-checking.php',
                data:'disallow_check=yes&allowed_products='+allowed_products+'&disallowed_products='+disallowed_products,
                success:function(data){
                  if (data==1) {
                    $('#products_disallowed_dis').html('');
                    $('#products_disallowed_dis').hide();
                  }else{
                    $('#products_disallowed_dis').html('Product already added');
                  $('#products_disallowed_dis').show();
                  }
                  
                }

              });
            }
          }



          </script> 
        </body>
      </html>