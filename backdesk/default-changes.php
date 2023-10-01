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
    <title>Common Setting</title>
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
  <style>
     .card.row{
      padding: 10px;
    }
    .card-col{
      height: fit-content;
      display: inline-block;
      border: 1px solid #66666691;
    border-radius: 5px;
    }
    .footer{
      bottom: auto !important;
    }
  </style>
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
            <div class="col-md-12 ">
              <div class="row justify-content-center">
                <!-- col-3 start -->
              <div class="card col-md-4 card-col">
                
                <div class="card-body">
                  
                  <div class="">
                    <div class="card-title text-primary text-center">Withdrawal Setting & Charges</div>
                  <?php
                  $withdrawal_data = single_data("SELECT * FROM tbl_withdrawal_setting WHERE wsid =  1 ");
                  $w_d = $withdrawal_data['all_data'];
                  ?>
                  <hr/>
                  <form id="withdrawal_setting" >
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
                        <label></label>
                        <input type="submit" class="btn-info btn float-right " value="Update">
                      </div>
                       </form>
                  </div> <!-- end col-md-3 -->
                </div>
              </div>

                  <!-- col-3 start -->
                  <div class="card card col-md-3 card-col ml-3">
                  <div class="card-body">
                    <div class="card-title text-primary text-center">Signup Bonus Amount</div>
                  <?php
                  $common_settings = single_data("SELECT * FROM common_settings WHERE csid =  1 ");
                  ?>
                  <hr/>
                  <form id="signup_bonus">
                    <input type="hidden" value="<?=time()?>" name="bonus_pass">
                      <div class="form-group">
                        <label for="">Signup Bonus Amount<span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" name="signup_bonus_amount" class="form-control form-control-rounded" id="input-26" placeholder="signup bonus" required value="<?=$common_settings['all_data']['customer_signup_bonus']?>">
                      </div>

                      <div class="form-group">
                        <label></label>
                        <input type="submit" class="btn-success btn float-right " value="Update">
                      </div>
                       </form>
                  </div> 
                  
                  </div><!-- end col-md-3 -->

                  <!-- col-3 start -->
                  <div class="card card col-md-3 card-col ml-1">
                  <div class="card-body">
                    <div class="card-title text-primary text-center">Fee Delivery</div>
                
                  <hr/>
                  <form id="min_cart_val">
                    <input type="hidden" value="<?=time()?>" name="min_cart_val_pass">
                      <div class="form-group">
                        <label for="">Delivery free for min amount<span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" name="min_cart_val" class="form-control form-control-rounded" id="input-26" placeholder="signup bonus" required value="<?=$common_settings['all_data']['min_cart_val']?>">
                      </div>

                      <div class="form-group">
                        <label></label>
                        <input type="submit" class="btn-primary btn float-right " value="Update">
                      </div>
                       </form>
                  </div> 
                  
                  </div><!-- end col-md-4 -->

               
              </div>
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
              default_noti($json_obj.type,$json_obj.icon,$json_obj.msg);
          }
          });
          e.preventDefault();
          });

          jQuery('#signup_bonus').on('submit',function(e){
          jQuery.ajax({
          url:'../function/functions.php',
          type:'post',
          data:jQuery('#signup_bonus').serialize(),
          success:function(result_d){
          $json_obj_d = JSON.parse(result_d);
              default_noti($json_obj_d.comm_type,$json_obj_d.comm_icon,$json_obj_d.comm_msg);
          }
          });
          e.preventDefault();
          });

          jQuery('#min_cart_val').on('submit',function(e){
          jQuery.ajax({
          url:'../function/functions.php',
          type:'post',
          data:jQuery('#min_cart_val').serialize(),
          success:function(result_d){
          $json_obj_d = JSON.parse(result_d);
              default_noti($json_obj_d.comm_type,$json_obj_d.comm_icon,$json_obj_d.comm_msg);
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