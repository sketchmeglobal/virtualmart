<?php
include 'cores/comm-head.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
$data = all_data("SELECT
*, seller.f_name AS SELLER_F_NAME,
seller.l_name AS SELLER_L_NAME,
supplier.f_name AS SUPPLIER_F_NAME,
supplier.l_name AS SUPPLIER_L_NAME,
tbl_order_dtl.f_name AS invoice_f_name,
tbl_order_dtl.l_name AS invoice_l_name,
tbl_order_dtl.company AS invoice_company,
tbl_order_dtl.country AS invoice_country,
tbl_order_dtl.street_addrs AS invoice_street_addrs,
tbl_order_dtl.apartment AS invoice_apartment,
tbl_order_dtl.town AS invoice_town,
tbl_order_dtl.state AS invoice_state,
tbl_order_dtl.zip AS invoice_zip,
tbl_order_dtl.notes AS invoice_notes,
tbl_order_dtl.email AS invoice_email,
tbl_order_dtl.customer_gst_number AS invoice_customer_gst_number,
tbl_order_dtl.phone AS invoice_phone,
vendor.company_name as ven_company_name,
vendor.email as ven_email,
vendor.vendor_address,
vendor_kyc.gst_number as ven_gst_number
FROM
tbl_order_hdr
INNER JOIN tbl_order_dtl ON tbl_order_hdr.order_hdr_id = tbl_order_dtl.order_hdr_id
LEFT JOIN tbl_product_hdr ON tbl_product_hdr.phid = tbl_order_dtl.product_id
LEFT JOIN vendors vendor ON vendor.id = tbl_product_hdr.vendor_id
LEFT JOIN users seller ON seller.id = tbl_order_dtl.cons_seller_id
LEFT JOIN users supplier ON supplier.id = tbl_order_dtl.cons_supplier_id
LEFT JOIN tbl_order_amt_master ON tbl_order_hdr.order_amt_master_id = tbl_order_amt_master.master_id
LEFT JOIN vendor_kyc ON vendor_kyc.vendor_id = vendor.id
LEFT JOIN tbl_payments ON tbl_payments.tpid = tbl_order_hdr.payment_id
WHERE tbl_order_hdr.order_hdr_id = $id
ORDER BY
tbl_order_hdr.order_hdr_id
DESC")['all_data'];

}


/*start update query*/

if (isset($_POST['order_update'])) {
  extract($_POST);
  update("UPDATE tbl_order_hdr SET vendor_txn_id =  '$vendor_txn_id', vendor_payable_status = '$vendor_payable_status', credit_bank_name = '$credit_bank_name', gateway_sattlement_status ='$gateway_sattlement_status', reserve_amt_percent = '$reserve_amt_percent' WHERE order_hdr_id = '$order_id' ");
  header('location:update-order-vendor.php?id='.$order_id.'&msg=Order Updated');
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
    <title>Order Details</title>
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
    <style type="text/css">
      input[type="text"], input[type="number"], textarea[type="text"], input[type=""]{
        border:1px solid;
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
          
          <div class="row mt-3">
            
            <div class="col-lg-12">
              <div class="card">
                <!-- <p><a href="child-category-form.php" class="btn btn-success btn-md col-1">+ Add New</a></p> -->
                <div class="card-header"><i class="fa fa-table"></i> Order Details</div>
                <div class="card-body">
                  <div class="d-flex justify-content-center">
                        <h4><u>Invoice Details</u></h4>

                        
                      </div>

                    <div class="row bg-light p-1 d-flex" style="justify-content:space-evenly">
                      <?php if (isset($_GET['msg'])) {
                          echo '<span style="font-size:18px;color:green;">'.$_GET['msg'].'</span>';
                        } ?>
                      <!-- <label> Order ID: <b>OD00225540</b>  -->
                        <!-- <br><br>Order Status: <br> Invoice Generated - 2023-02-15 <br> Pickup - <b>Pending</b><br> Shipped - <b>Pending</b><br> Delivery - <b>Pending</b> -->
                      <!-- </label> -->
                    </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="float-left">
                        <p>
                          <b><u>Company Details:</u></b>
                          <br>
                          Company Name: <b> Sryahva PVT. LTD.</b>
                          <br>
                          Email: <b>sryahva@gmail.com</b>
                          <br>
                          GST Number: <b>19123456789012</b>
                          <br>
                          Order ID: <b><?=$data[0]['order_id']?></b>
                        </p>
                        <p>
                          Address:
                          <br>
                          Sryahva PVT. LTD., India, Kolkata, Barasat,
                          <br>
                          Kolkata, 700125, West Bengal
                        </p>
                        
                      </div>
                      <div class="float-right">
                        <p>
                          <b><u>Invoice from:</u></b>
                          <br>
                          Vendor Name: <b><?=$data[0]['ven_company_name']?></b>
                          <br>
                          Email: <b><?=$data[0]['ven_email']?></b>
                          <br>
                          GST Number: <b><?=$data[0]['ven_gst_number']?></b>
                          <br>
                          Invoice Number: <b><?=$data[0]['order_id']?></b>
                        </p>
                        <p>
                          Address:
                          <br>
                          <?=$data[0]['vendor_address']?>
                        </p>
                      </div>

                      <div class="float-left">
                        <hr>
                        <p>
                          <b><u>Invoice to:</u></b>
                          <br>
                         Name: <b> <?=$data[0]['invoice_f_name'] . ' ' . $data[0]['invoice_l_name']?></b>
                          <br>

                          Email: <b><?=$data[0]['invoice_email']?></b>
                          <br>
                          Mobile: <b><?=$data[0]['invoice_phone']?></b>
                          <br>
                          GST Number: <b><?=$data[0]['invoice_customer_gst_number']?></b>
                        </p>
                        <p>
                          Address:
                          <?php
                          if (!empty($data[0]['invoice_company'])) {
                          echo $data[0]['invoice_company'] . ',';
                          }
                          ?>
                          <?=$data[0]['invoice_country']?>, <?=$data[0]['invoice_state']?>, <?=$data[0]['invoice_apartment']?>,
                          <br>
                          <?=$data[0]['invoice_town']?>, <?=$data[0]['invoice_street_addrs']?>, <?=$data[0]['invoice_zip']?>

                        </p>
                      </div>
                      
                    </div>
                    <br>
                    <hr>
                    <div class="col-md-12">

                      <br><hr><br>
                      <h5><u>Update Details</u></h5>
                     <form class="row" action="" method="post">
                      <input type="hidden" name="order_id" value="<?=$data[0]['order_hdr_id']?>">
                       <div class="form-group col-md-4">
                         <label>Reserver Amount %</label>
                         <input type="" name="reserve_amt_percent" class="form-control" value="<?=$data[0]['reserve_amt_percent']?>">
                       </div>
                       <div class="form-group col-md-4">
                         <label>gateway sattlment status</label>
                         <select class="form-control" name="gateway_sattlement_status">
                           <option value="0" <?= ($data[0]['gateway_sattlement_status']==0) ? 'selected': ''; ?>>Pending</option>
                           <option value="1" <?= ($data[0]['gateway_sattlement_status']==1) ? 'selected': ''; ?>>Received</option>
                         </select>
                       </div>
                       <div class="form-group col-md-4">
                         <label>Credited amt. bank name</label>
                         <input type="" name="credit_bank_name" class="form-control" value="<?=$data[0]['credit_bank_name']?>">
                       </div>
                       <div class="form-group col-md-4">
                         <label>vendor payable status</label>
                         <select class="form-control" name="vendor_payable_status">
                           <option value="0" <?= ($data[0]['vendor_payable_status']==0) ? 'selected': ''; ?>>Pending</option>
                           <option value="1" <?= ($data[0]['vendor_payable_status']==1) ? 'selected': ''; ?>>Received</option>
                         </select>
                       </div>
                       <div class="form-group col-md-4">
                         <label>vendor TXN ID</label>
                         <input type="" name="vendor_txn_id" class="form-control" value="<?=$data[0]['vendor_txn_id']?>">
                       </div>
                       <div class="form-group col-md-12">
                        
                         <input type="submit" name="order_update" value="update" class="btn btn-primary" style="float:right;">
                       </div>
                     </form>
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