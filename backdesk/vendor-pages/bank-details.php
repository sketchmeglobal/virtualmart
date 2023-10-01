<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Withdrawal Request</title>
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
                <div class="card-body">
                  <div class="card-title text-primary text-center">Bank Details
                  </div>
                  <hr>
                  <form id="bank_form" method="post">
                    
                    <?php
                    $check_bak_bind_q = "SELECT * FROM tbl_kyc WHERE user_id = '".$_SESSION['id']."' ";
                    $check_user_func_q = single_data($check_bak_bind_q);
                    if ($check_user_func_q['data']==true) {
                    $bank_name = $check_user_func_q['all_data']['bank_name'];
                    $bank_ifsc = $check_user_func_q['all_data']['bank_ifsc'];
                    $bank_ac_no = $check_user_func_q['all_data']['bank_ac_no'];
                    $bank_branch = $check_user_func_q['all_data']['bank_branch'];
                    }else{
                    $bank_name = null;
                    $bank_ifsc = null;
                    $bank_ac_no = null;
                    $conf_bank_ac_no = null;
                    $bank_branch = null;
                    }
                    ?>
                    <p class="text-center text-danger msg"></p>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Bank Name</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="Enter Bank Name" name="bank_name" value="<?=$bank_name?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Bank IFSC</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="Enter Bank IFSC" name="bank_ifsc" value="<?=$bank_ifsc?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Bank A/C No.</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control form-control-rounded" id="input-26" placeholder="Enter Bank ac no" name="bank_ac_no" value="<?=$bank_ac_no?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Confirm A/C No.</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="Enter Bank ac no" name="conf_bank_ac_no" value="<?=$bank_ac_no?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Bank Branch</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="Enter Bank branch" name="bank_branch" value="<?=$bank_branch?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow-dark btn-round px-5" name="insert"><i class="icon-plus"></i> Bind Bank</button>
                      </div>
                    </div>
                    <div class="" style="float: right;">
                      <a href="?page=new-withdrawal-request" class="btn btn-warning"><-Back</a>
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
          <script type="text/javascript">
          jQuery('#bank_form').on('submit',function(e){
          jQuery.ajax({
          url:'../function/functions.php',
          type:'post',
          data:jQuery('#bank_form').serialize(),
          success:function(result){
          //$('.checkout-msg').html(result)
          $('.msg').html(result);
          }
          });
          e.preventDefault();
          });
          </script>
        </body>
      </html>