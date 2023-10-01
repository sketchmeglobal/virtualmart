<?php
include 'cores/comm-head.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Withdrawal Data</title>
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
    <!--Data Tables -->
    <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
    
  </head>
  <body>
    <!-- Start wrapper-->
    <div id="wrapper">
      
      <?php include 'cores/menu.php' ?>
      <div class="clearfix"></div>
      
      <div class="content-wrapper">
        <div class="container-fluid">
          <?php
          $wid = $_GET['wid'];
          $only_user_data = single_data("SELECT * FROM tbl_withdrawal
          JOIN users ON users.id = tbl_withdrawal.user_id
          JOIN tbl_kyc ON tbl_kyc.user_id = users.id
          WHERE tbl_withdrawal.withdrawal_id = '$wid' ");
          $od = $only_user_data['all_data'];
          ?>
          <!--Start Dashboard Content-->
          <div class="row mt-3 d-flex justify-content-center">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header"><i class="fa fa-table"></i> Withdrawal request Status</div>
                <div class="card-body">
                  <form id="withdrawal_status" method="post">
                    <input type="hidden" name="wid" value="<?=$od['withdrawal_id'] ?>">
                    <p class="text-center text-danger msg"></p>
                    
                    <div class="form-group row pt-5">
                      <label for="input-26" class="col-sm-6 col-form-label">Name</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="request amount" name="name" value="<?=$od['f_name'] . ' ' .$od['l_name']?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Email</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="request amount" name="email" value="<?=$od['email'] ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Available Balance</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded available_balance" id="input-26" placeholder="request amount" name="available_balance" value="<?=$od['ewallet'] ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Request Amount</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="request amount" name="request_amt" value="<?=$od['request_amt'] ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Payout/ Transfer Amount</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="request amount" name="payout" value="<?=$od['payout'] ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">A/C No</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="request amount" name="ac" value="<?=$od['bank_ac_no'] ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">IFSC</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="request amount" name="ac" value="<?=$od['bank_ifsc'] ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Request</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="request amount" name="ac" value="<?=$od['added_on'] ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Status</label>
                      <div class="col-sm-6">
                        <select class="form-control form-control-rounded" required name="withdrawal_status">
                          <option value="" disabled <?php
                            if ($od['withdrawal_status']==0) { echo 'selected'; }
                          ?>>select status</option>
                          <option value="1"
                            <?php
                            if ($od['withdrawal_status']==1) { echo 'selected'; }
                            ?>
                          >Approve</option>
                          <option value="2"
                            <?php
                            if ($od['withdrawal_status']==2) { echo 'selected'; }
                            ?>
                          >Reject</option>
                          <option value="3"
                            <?php
                            if ($od['withdrawal_status']==3) { echo 'selected'; }
                            ?>
                          >Delete</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">TXN ID</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="transaction id" name="txn_id" value="<?=$od['txn_id'] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Remarks</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="remarks" name="remarks" value="<?=$od['remarks'] ?>" >
                      </div>
                      <small class="text-danger">If, status <b>reject</b> or <b>delete</b>, then amount will be refund automatically.</small>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow-dark btn-round px-5" name="insert"><i class="icon-plus"></i> Update Request</button>
                      </div>
                    </div>
                    <div class="" style="float: right;">
                      <a href="user-withdrawal-data.php" class="btn btn-warning">&lt;-Back</a>
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
          <!--Data Tables js-->
          <script src="assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
          <script type="text/javascript">
          jQuery('#withdrawal_status').on('submit',function(e){
          jQuery.ajax({
          url:'../function/functions.php',
          type:'post',
          data:jQuery('#withdrawal_status').serialize(),
          success:function(result){
          if(result>0){
          $('.available_balance').val(result);
          $('.msg').html('Amount refunded');
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