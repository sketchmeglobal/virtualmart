<?php
include 'cores/comm-head.php';

$_SESSION['pass_token'] = sha1(md5(time().rand()));


 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Withdrawal Setting</title>
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
     <!-- notifications css -->
  <link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css"/>
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
            <div class="col-lg-4 ">
              <div class="card">
                <div class="card-body">
                  <div class="card-title text-primary text-center">Withdrawal Setting & Charges</div>
                  <?php
                  $withdrawal_data = single_data("SELECT * FROM tbl_withdrawal_setting WHERE wsid =  1 ");
                  $w_d = $withdrawal_data['all_data'];
                  ?>
                  <hr>
                  <form id="withdrawal_setting">
                  <input type="hidden" value="<?=$_SESSION['pass_token']?>" name="pass_token">
                      <div class="form-group">
                        <label for="">Min Withdrawal<span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" name="min_withdrawal" class="form-control form-control-rounded" id="input-26" placeholder="Min Withdrawal" required value="<?=$w_d['min_withdrawal']?>">
                      </div>

                      <div class="form-group">
                        <label for="">IMPS Charges (%)<span class="text-danger"><sup>*</sup></span></label>

                        <input type="text" name="imps" class="form-control form-control-rounded" id="input-26" placeholder="IMPS (%)" required value="<?=$w_d['imps']?>">
                      </div>
                      <div class="form-group">
                        <label for="">TDS charges (%)<span class="text-danger"><sup>*</sup></span></label>

                        <input type="text" name="tds" class="form-control form-control-rounded" id="input-26" placeholder="TDS (%)" required value="<?=$w_d['tds']?>">
                      </div>
                      <div class="form-group">
                        <label for="">Admin charges (%)<span class="text-danger"><sup>*</sup></span></label>

                        <input type="text" name="admin" class="form-control form-control-rounded" id="input-26" placeholder="ADMIN (%)" required value="<?=$w_d['admin']?>">
                      </div>
                      <div class="form-group">
                        <label for="">GST charges (%)<span class="text-danger"><sup>*</sup></span></label>

                        <input type="text" name="gst" class="form-control form-control-rounded" id="input-26" placeholder="GST (%)" required value="<?=$w_d['gst']?>">
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn-info btn float-right" value="Update">
                      </div>
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
        <script src="assets/plugins/notifications/js/lobibox.min.js"></script>
        <script src="assets/plugins/notifications/js/notifications.min.js"></script>
        <script type="text/javascript">
          jQuery('#withdrawal_setting').on('submit',function(e){

            
          jQuery.ajax({
          url:'../function/functions.php',
          type:'post',
          data:jQuery('#withdrawal_setting').serialize(),
          success:function(result){
            
          $json_obj = JSON.parse(result);
          console.log($json_obj);
              default_noti($json_obj.type,$json_obj.icon,$json_obj.msg);
            /*if ($json_obj.type=='success') {
              $('#password_change')[0].reset();
            }*/
          }
          });
          e.preventDefault();
          });

          function default_noti(type,icon,msg){
          Lobibox.notify(type, {
            size: 'mini',
            icon: icon,
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            msg: msg
            });
          }
          </script>
      </body>
    </html>