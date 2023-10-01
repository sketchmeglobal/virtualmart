<?php
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
                  <div class="card-title text-primary">Withdrawal Request
                    <a href="?page=bank-details" class="btn btn-info  float-right ">Bank Details</a>
                  </div>
                  <hr>
                  <?php
                  $only_user_data = single_data("SELECT * FROM users WHERE id = '".$_SESSION['id']."' ");
                  $check_bak_bind_q = "SELECT * FROM tbl_kyc
                  JOIN users ON users.id = tbl_kyc.user_id
                  WHERE tbl_kyc.user_id = '".$_SESSION['id']."' ";
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
                  <form id="withdraw_request" method="post">
                    <p class="text-center text-danger msg"></p>
                    <div class="text-center">
                      Name: <b><?=$_SESSION['fullname']?></b> <br>
                      Bank: <b><?=$bank_name?></b> <br>
                      Bank IFSC: <b><?=$bank_ifsc?></b> <br>
                      A/C No: <b><?=$bank_ac_no?></b> <br>
                      Bank Branch: <b><?=$bank_branch?></b> <br>
                      Available Balance: <b> <span class="amount"><?=$only_user_data['all_data']['ewallet']?></span> </b> <br>
                    </div>
                    <div class="form-group row pt-5">
                      <label for="input-26" class="col-sm-6 col-form-label">Request Amount</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="request amount" name="request_amt">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow-dark btn-round px-5" name="insert"><i class="icon-plus"></i> Send request</button>
                      </div>
                    </div>
                    <div class="" style="float: right;">
                      <a href="?page=my-withdrawal-data" class="btn btn-warning"><-Back</a>
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
          jQuery('#withdraw_request').on('submit',function(e){
          jQuery.ajax({
          url:'../function/functions.php',
          type:'post',
          data:jQuery('#withdraw_request').serialize(),
          success:function(result){
          if(result>=0){
          $('.msg').html('Request sent successfully');
          $('.amount').html(result);
          }else{
          $('.msg').html(result);
          }
          
          }
          });
          e.preventDefault();
          });
          </script>
        </body>
      </html>