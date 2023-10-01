<?php
include 'cores/comm-head.php';
$pid = decode($_GET['order']); // order = tbl_order_hdr.order_hdr_id
$order_data_query = "SELECT * FROM tbl_order_hdr
JOIN users ON tbl_order_hdr.user_id = users.id
WHERE tbl_order_hdr.order_hdr_id = '$pid'
ORDER BY tbl_order_hdr.order_hdr_id DESC ";
$order_data = single_data($order_data_query);
if(empty($order_data['all_data'])){
echo '<script>window.location.href="order-data.php"</script>';
}
$order_detail_query_group = "SELECT * FROM tbl_order_dtl
WHERE order_hdr_id = '$pid' GROUP BY order_hdr_id";
$order_details_grp_func = single_data($order_detail_query_group);
if(isset($_POST['submit'])){

extract($_POST);

$sql = "UPDATE `tbl_order_hdr` SET `order_status` = '$order_status' WHERE `order_hdr_id` =" . $_GET['order'];
if(update($sql)){
header('Location: '.$_SERVER['PHP_SELF']);
}

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
    <title>Order Data</title>
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
          <!--Start Dashboard Content-->
          
          <div class="row mt-3">
            
            <div class="col-lg-12">
              <div class="card">
                <!-- <p><a href="child-category-form.php" class="btn btn-success btn-md col-1">+ Add New</a></p> -->
                <div class="card-header"><i class="fa fa-table"></i> Order Data</div>
                <div class="card-body">
                  <form method="post">
                    <div class="row bg-light p-1 d-flex" style="justify-content:space-evenly">
                      
                      <label>Order Status : </label>
                      <select name="order_status" class="">
                        <option <?= ($order_data['all_data']['order_status'] == 0 ? 'Selected' : '') ?> value="0">Pending</option>
                        <option <?= ($order_data['all_data']['order_status'] == 1 ? 'Selected' : '') ?> value="1">Placed</option>
                        <option <?= ($order_data['all_data']['order_status'] == 2 ? 'Selected' : '') ?> value="2">Delivered</option>
                        <!--<option value="">Cancelled</option>-->
                      </select>
                      <input type="submit" name="submit" class="btn btn-sm btn-success" value="Update"/>
                    </div>
                  </form>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="float-left">
                        <p>
                          Order ID: <b><?=$order_data['all_data']['order_id']?></b>
                        </p>
                        <p>
                          Contact Details:
                          <br>
                          Name: <b> <?=$order_details_grp_func['all_data']['f_name']. ' '.$order_details_grp_func['all_data']['l_name'] ?></b>
                          <br>
                          Email: <b><?=$order_details_grp_func['all_data']['email']?></b>
                          <br>
                          Mobile: <b><?=$order_details_grp_func['all_data']['phone']?></b>
                        </p>
                      </div>
                      <div class="float-right">
                        <p>
                          Order Generated: <b><?= date("d M, Y - h:i:s", strtotime($order_data['all_data']['added_on'])); ?></b>
                        </p>
                        <p>
                          Address:
                          <br>
                          <?php
                          if (!empty($order_details_grp_func['all_data']['company'])) {
                          echo $order_details_grp_func['all_data']['company'] . ',';
                          }
                          ?>
                          <?=$order_details_grp_func['all_data']['country']?>, <?=$order_details_grp_func['all_data']['street_addrs']?>, <?=$order_details_grp_func['all_data']['apartment']?>,
                          <br>
                          <?=$order_details_grp_func['all_data']['town']?>, <?=$order_details_grp_func['all_data']['state']?>, <?=$order_details_grp_func['all_data']['zip']?>
                        </p>
                      </div>
                      
                    </div>
                    <div class="col-md-12">
                      <table class="table-bordered w-100">
                        <tr>
                          <th>Sl. No.</th>
                          <th>Product</th>
                          <th>QTY</th>
                          <th>Price</th>
                          <th class="float-right w-100"><span style="float:right;">Total</span></th>
                        </tr>
                        <?php
                        $order_details_query = "SELECT * FROM tbl_order_dtl
                        JOIN tbl_product_hdr ON tbl_order_dtl.product_id = tbl_product_hdr.phid
                        WHERE tbl_order_dtl.order_hdr_id = '$pid' ";
                        $order_det_data = all_data($order_details_query);
                        foreach ($order_det_data['all_data'] as $key => $value) {
                        ?>
                        <tr>
                          <td><?=++$key?></td>
                          <td><?=$value['ph_title']?></td>
                          <td><?=$value['product_qty']?></td>
                          <td><?=number_format($value['product_price'],2)?></td>
                          <td class="float-right w-100"><span style="float: right;"><?=number_format($value['product_qty']*$value['product_price'],2)?></span></td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <th class="p-2" colspan="5"><span style="float: right;">Subtotal: <?=$order_data['all_data']['total_amt']?></span></th>
                        </tr>
                        <?php 
                        if ($order_data['all_data']['coupon_code'] != '') {
                       ?>
                        <tr>
                          <th class="p-2" colspan="5"><span style="float: right;">Discount: (<?=$order_data['all_data']['coupon_code']?>) <?=number_format(($order_data['all_data']['total_amt']-$order_data['all_data']['pay_amnt']),2)?></span></th>
                        </tr>
                      <?php } ?>
                        <tr>
                          <th class="p-2" colspan="5"><span style="float: right;">Total: <?=$order_data['all_data']['pay_amnt']?></span></th>
                        </tr>
                      </table>
                    </div>
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
          <script>
          $(document).ready(function() {
          //Default data table
          $('#default-datatable').DataTable();
          var table = $('#example').DataTable( {
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
          } );
          
          table.buttons().container()
          .appendTo( '#example_wrapper .col-md-6:eq(0)' );
          
          } );
          </script>
          
        </body>
      </html>
      <?php
      if (isset($_GET['did'])) {
      $delete_sql = "DELETE FROM tbl_child_category WHERE tccid = '".$_GET['did']."' ";
      $data = delete($delete_sql);
      if ($data==true) {
      echo '<script>alert("Data deleted");window.location.href="child-category.php";</script>';
      }else{
      //echo '<script>alert("Please try again");window.location.href="";</script>';
      }
      }
      ?>