<?php
include 'cores/comm-head.php';
function find_cosul_det($id){
  return $return = single_data("SELECT CONCAT(f_name, ' ', l_name) AS name FROM users WHERE id = $id ")['all_data'];
}

function cons_calc($id,$type){
  global $con;
  $data = [];
  $data['amount'] = 0;
  $data['percent'] = 0;

$sql = all_data("SELECT
  cons_supplier_percent,
  cons_supplier_id,
  cons_seller_percent,
  cons_seller_id,
  order_value
        FROM tbl_order_hdr
          JOIN tbl_order_dtl ON tbl_order_hdr.order_hdr_id = tbl_order_dtl.order_hdr_id
          WHERE tbl_order_hdr.order_hdr_id = $id")['all_data'];

  foreach ($sql as $val) {
    if ($type=='seller') {
        
    }
  }


}

function order_hdr($order_id){
  return $return = single_data("SELECT * FROM tbl_order_hdr WHERE order_hdr_id = '$order_id' ");
}

function tbl_accounts($order_id){
  return $return = single_data("SELECT * FROM tbl_accounts WHERE pk = '$order_id' && (pk_type = 'ORDER' || pk_type = 'CONSULTANT' || pk_type = 'VENDOR' ) && action_type = 'ORDER_PROCESS' ");
}

function gateway_details($pay_id){
  return $data = single_data("SELECT * FROM tbl_payments WHERE tpid = '$pay_id' ")['all_data'];
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
    <title>Order Report</title>
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
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
  </head>
  <body>
    <!-- Start wrapper-->
    <div id="wrapper">
      <?php include 'cores/menu.php' ?>
      <div class="clearfix"></div>
      <div class="content-wrapper">
        <div class="container-fluid">
          <!--Start Dashboard Content-->
          <div class="row mt-3">
            <div class="col-lg-12">
              <div class="card">
                <!-- <p><a href="child-category-form.php" class="btn btn-success btn-md col-1">+ Add New</a></p> -->
                <div class="card-header"><i class="fa fa-table"></i> Order Report</div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-2">
                        <label for="">From Date</label>
                        <br>
                        <input type="date" id="from_date" class="">
                      </div>
                      <div class="col-md-2">
                        <label for="">To Date</label>
                        <br>
                        <input type="date" id="to_date" class="">
                      </div>
                      <div class="col-md-2">
                        <label for="">Select Vendor</label>
                        <br>
                        <select name="" id="vendor" class="form-control single-select">
                          <option value="">select here</option>
                          <?php 
                          $vendor_data = all_data("SELECT vendors.id AS V_ID, vendors.company_name FROM vendors JOIN users ON vendors.id = users.vendor_id");
                          if (!empty($vendor_data)) {
                          foreach($vendor_data['all_data'] as $vendor){

                           ?>
                          <option value="<?=$vendor['V_ID']?>"><?=$vendor['company_name']?></option>
                          <?php } }?>
                        </select>
                      </div>

                       <div class="col-md-2">
                        <label for="">Shippment Status</label>
                        <br>
                        <select name="" id="shippment_status" class="form-control single-select">
                          <option value="">select here</option>
                          <option value="Product Ready to shipped">Product Ready to shipped</option>
                          <option value="Product Shipped">Product Shipped</option>
                          <option value="Product Delivered">Product Delivered</option>
                          <option value="Product Retrun Request">Product Retrun Request</option>
                          <option value="Product Returned">Product Returned</option>
                          <option value="Product Amount Refunded">Product Amount Refunded</option>

                        </select>
                      </div>
                      <div class="col-md-2">
                        <label for="">&nbsp;</label>
                        <br>
                        <a href="javaScript:void(0)" class="" onClick="report_data()">Search</a>
                      </div>
                    </div>
                  <div class="table-responsive pt-5 " id="report-data">
                    
                    
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
            <script src="assets/plugins/select2/js/select2.min.js"></script>
            <script>
            

          $(document).ready(function() {
            report_data();
            $('.single-select').select2();
            $('.single-select2').select2();
            });
          

            function report_data(){
              var from_date = $('#from_date').val();
              var to_date = $('#to_date').val();
              var vendor = $('#vendor').val();
              var shippment_status = $('#shippment_status').val();

              $('#report-data').html('<div style="text-align:center;">loading...</div>');

              $.ajax({
                type:'post',
                url:'cores/custom-order-data-report.php',
                data:{
                  from_date:from_date,
                  to_date:to_date,
                  vendor:vendor,
                  shippment_status:shippment_status,

                },
                success:function(result){
                  $('#report-data').html(result);
                }
              });
            }
          
        </script>
          </body>
        </html>
        <?php
        if (isset($_GET['order_id'])) {
          date_default_timezone_set("Asia/Kolkata");
        $sql = "UPDATE tbl_order_hdr SET admin_process = 1, admin_process_date = '".date("Y-m-d H:i:s")."' WHERE order_hdr_id = '".$_GET['order_id']."' ";
        $data = update($sql);
        if ($data==true) {
        echo '<script>alert("Order Transferred");window.location.href="checkout-order-data.php";</script>';
        }else{
        //echo '<script>alert("Please try again");window.location.href="";</script>';
        }
        }
        ?>