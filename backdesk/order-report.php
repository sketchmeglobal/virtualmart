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
                  <div class="table-responsive pt-5">
                    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>SL. No</th>
                          <th>Order ID</th>
                          <th>Customer Name</th>
                          <th>Email</th>
                          <th>Vendor</th>
                          <th>Vendor Payable</th>
                          <th>Vendor Tax <br> = (DP + Shipping Amt.)</th>
                          <th>Consultant Seller Commission %</th>
                          <th>Consultant Seller Amt.</th>
                          <th>Consultant Supplier Commission %</th>
                          <th>Consultant Supplier Amt.</th>
                          <th>Order Placed</th>
                          <th>Order Amt.</th>
                          <th>Shipping Charges(Coll.)</th>
                          <th>Customer Paid</th>
                          <th>Gateway Charges base amt.</th>
                          <th>gateway charges gst amt.</th>
                          <th>Admin Commission</th>
                          <th>Reserve for Promotion %</th>
                          <th>Reserve for Promotion Amt.</th>
                          <th>Admin Profit</th>
                          <!-- custom -->
                          <th>order intemation to vendor</th>
                          <th>invoice generation status</th>
                          <th>invoice number</th>
                          <th>pickup status</th>
                          <th>shipping agent name</th>
                          <th>shipping reference number</th>
                          <th>shipped status</th>
                          <th>delivery status</th>
                          <th>order final status</th>
                          <th>vendor payable staus</th>
                          <th>vendor TXN ID</th>
                          <th>consultant seller payable status</th>
                          <th>Consultant Seller TXN ID</th>
                          <th>consultant supplier payable status</th>
                          <th>Consultant Supplier TXN ID</th>
                          <th>Amount paid to shipping agent</th>
                          <th>shipping agent payable status</th>
                          <th>shipping TXN ID</th>
                          <th>gateway sattlement status</th>
                          <th>admin banking status with bank name</th>
                          <th>gst amount</th>
                          <th>gst payment status (customer paid amt.)</th>
                          <th>gst challan Number</th>
                          <th>customer gst number (optional)</th>
                          
                          <th>total collection amt.</th>
                          <th>actual refundable amt.</th>
                          <th>reverse base amt.</th>
                          <th>reverse gst amt.</th>
                          <th>return charges amt.</th>
                          <th>customer review</th>
                          <!-- end custom column -->
                          <th>Order Summery</th>
                          <!-- <th>Action</th> -->
                        </tr>
                      </thead>
                      
                      <?php 
                      $order_summery = '<table>
                        <tr>
                          <td>Product</td>
                          <td>QTY.</td>
                          <td>Amt.</td>
                          <td>Color</td>
                          <td>Size</td>

                        </tr>
                        <tr>
                          <td><a href="demo-product-form-edit.php" >Bhagalpuri Art Silk Saree</a></td>
                          <td>1</td>
                          <td>360.00</td>
                          <td>Multicolor</td>
                          <td>5.5m</td>
                        </tr>

                      </table>';
                      $order_summery2 = '<table>
                        <tr>
                          <td>Product</td>
                          <td>QTY.</td>
                          <td>Amt.</td>
                          <td>Color</td>
                          <td>Size</td>

                        </tr>
                        <tr>
                          <td><a href="demo-product-form-edit.php" >Bhagalpuri Art Silk Saree</a></td>
                          <td>1</td>
                          <td>360.00</td>
                          <td>Multicolor</td>
                          <td>5.5m</td>
                        </tr>
                        <tr>
                          <td><a href="demo-product-form-edit.php" >Bhagalpuri Art Silk Saree</a></td>
                          <td>1</td>
                          <td>360.00</td>
                          <td>Multicolor</td>
                          <td>5.5m</td>
                        </tr>

                      </table>';
                      $data_product = array(
                        array('OD00225540','Sayub Ali','105@gmail.com','Vendor 2','285.71','14.29 (2.5%)','1','3.60','2','7.20','2023-02-15 14:0:53','360.00','50.00','410.00','8.28','1.55','60.00','30','12.28','40.92','2023-02-15',
                          '<a href="demo-invoice-details.php" >Invoice Generated</a> - 2023-02-15', // invoice status
                          'pay_hdg6s9hdkh', // invoice number
                          'Pending', // pickup status
                          'eKart', //shipping agent name
                          '57668868', // shipping reference number
                          'Pending', // shipped status

                          'Pending', //delivery status
                          'Ongoing', //order final status
                          'Pending', //vendor payable staus
                          'Pending', //vendor TXN ID {data = from bank with utr}
                          'Pending', // consultant seller payable status
                          'Pending', //Consultant Seller TXN ID {data = from bank name with utr}
                          'Pending', //consultant supplier payable status
                          'Pending', //Consultant Supplier TXN ID {data = from bank name with utr}
                          '45.00', // actual shipping amt.
                          'Paid - 2023-02-15', //shipping agent payable status
                          'From HDFC bank - UTR123456789012', //shipping TXN ID
                          'Pending', //gateway sattlement status
                          'Pending', //admin banking status with bank name
                          '19.52',// gst amount from customer paid amount
                          'Paid - 2023-02-15', //gst payment status (customer paid amt.)
                          '19123456789012', //gst challan Number
                          '19123456789012', //customer gst number (optional)
                          
                          '410.00', //total collection amt.
                          
                          '340.00', //actual refudable amt. customer_paid - extra charges for shipping
                          
                          '360.00', //reverse base amt. = product amt
                          '20.00', //reverse gst amt. = Tax = DP(CGST ₹10.25+ SGST ₹10.25): 20.50

                          '60.00', //return charges amt.
                          '4', //customer review
                          $order_summery2)

                      );
                        foreach($data_product as $det_k => $det ):
                      ?>
                      <tr>
                        <td><?=++$det_k?></td>
                        <td><?=$det[0]?></td>
                        <td><?=$det[1]?></td>
                        <td><?=$det[2]?></td>
                        <td><?=$det[3]?></td>
                        <td><?=$det[4]?></td>
                        <td><?=$det[5]?></td>
                        <td><?=$det[6]?></td>
                        <td><?=$det[7]?></td>
                        <td><?=$det[8]?></td>
                        <td><?=$det[9]?></td>
                        <td><?=$det[10]?></td>
                        <td><?=$det[11]?></td>
                        <td><?=$det[12]?></td>
                        <td><?=$det[13]?></td>
                        <td><?=$det[14]?></td>
                        <td><?=$det[15]?></td>
                        <td><?=$det[16]?></td>
                        <td><?=$det[17]?></td>
                        <td><?=$det[18]?></td>
                        <td><?=$det[19]?></td>
                        <td><?=$det[20]?></td>
                        <td><?=$det[21]?></td>
                        <td><?=$det[22]?></td>
                        <td><?=$det[23]?></td>
                        <td><?=$det[24]?></td>
                        <td><?=$det[25]?></td>
                        <td><?=$det[26]?></td>
                        <td><?=$det[27]?></td>
                        <td><?=$det[28]?></td>
                        <td><?=$det[29]?></td>
                        <td><?=$det[30]?></td>
                        <td><?=$det[31]?></td>
                        <td><?=$det[32]?></td>
                        <td><?=$det[33]?></td>
                        <td><?=$det[34]?></td>
                        <td><?=$det[35]?></td>
                        <td><?=$det[36]?></td>
                        <td><?=$det[37]?></td>
                        <td><?=$det[38]?></td>
                        <td><?=$det[39]?></td>
                        <td><?=$det[40]?></td>
                        <td><?=$det[41]?></td>
                        <td><?=$det[42]?></td>
                        <td><?=$det[43]?></td>
                        <td><?=$det[44]?></td>
                        <td><?=$det[45]?></td>
                        <td><?=$det[46]?></td>
                        <td><?=$det[47]?></td>
                        <td><?=$det[48]?></td>
                        <td><?=$det[49]?></td>
                        <td><?=$det[50]?></td>

                        <!-- <td><a href="demo-order-summry.php" class="btn btn-info"><i class="fa fa-eye"></i></a></td> -->
                      </tr>
                     <?php endforeach; ?>

                      <tbody>
                        <?php
                        // order_hdr_data
                        $query = "
                        SELECT
                          tbl_order_hdr.order_id,
                          CONCAT(tbl_order_dtl.f_name, ' ', tbl_order_dtl.l_name) AS c_name,
                          tbl_order_dtl.email,
                          tbl_order_hdr.order_hdr_id,
                          tbl_order_hdr.shipping_charges,
                          tbl_order_hdr.customer_state_tin,
                          tbl_order_dtl.cons_supplier_id,
                          tbl_order_dtl.cons_seller_id,
                          tbl_order_dtl.cons_supplier_percent,
                          tbl_order_dtl.cons_seller_percent
                          FROM tbl_order_hdr
                          JOIN tbl_order_dtl ON tbl_order_hdr.order_hdr_id = tbl_order_dtl.order_hdr_id
                          GROUP BY tbl_order_dtl.order_hdr_id
                        ";
                        $data = all_data($query);
                        if ($data['data']==true) {
                        foreach($data['all_data'] as $key4 => $od){

                          //vendor data
                          $vendor_data = single_data("SELECT
                            company_name, 
                            SUM(order_value) AS vendor_amt,
                            product_tax,
                            state_tin
                            FROM vendors
                            JOIN tbl_product_hdr ON tbl_product_hdr.vendor_id =  vendors.id
                            JOIN tbl_order_dtl ON tbl_order_dtl.product_id = tbl_product_hdr.phid
                            WHERE tbl_order_dtl.order_hdr_id = '".$od['order_hdr_id']."'
                            GROUP BY tbl_product_hdr.vendor_id")['all_data'];

                          $tax_set_amt = ($vendor_data['vendor_amt']+$od['shipping_charges']);
                          $tax_cal = gst($vendor_data['state_tin'],$od['customer_state_tin'],$vendor_data['product_tax'],$tax_set_amt);

                          // consultant data
                          if ($od['cons_seller_id']>0) {
                            $cons_seller = find_cosul_det($od['cons_seller_id']);
                          }  

                          if ($od['cons_supplier_id']>0) {
                             $cons_supplier = find_cosul_det($od['cons_supplier_id']);
                          }
                          
                         

                        ?>
                        <tr>
                          <td><?=++$key4?></td>
                          <td><?=$od['order_id']?></td>
                          <td><?=$od['c_name']?></td>
                          <td><?=$od['email']?></td>
                          <td><?=$vendor_data['company_name']?></td>
                          <td><?= ($vendor_data['vendor_amt']-$tax_cal['TAX_AMT']) ?></td>
                          <td><?= ($tax_cal['TAX_AMT']) ?> (<?= ($vendor_data['product_tax']) ?>%)</td>
                         
                          <th>Consultant Seller Commission %</th>
                          <th>Consultant Seller Amt.</th>
                          <th>Consultant Supplier Commission %</th>
                          <th>Consultant Supplier Amt.</th>
                          <th>Order Placed</th>
                          <th>Order Amt.</th>
                          <th>Shipping Charges(Coll.)</th>
                          <th>Customer Paid</th>
                          <th>Gateway Charges base amt.</th>
                          <th>gateway charges gst amt.</th>
                          <th>Admin Commission</th>
                          <th>Reserve for Promotion %</th>
                          <th>Reserve for Promotion Amt.</th>
                          <th>Admin Profit</th>
                          <!-- custom -->
                          <th>order intemation to vendor</th>
                          <th>invoice generation status</th>
                          <th>invoice number</th>
                          <th>pickup status</th>
                          <th>shipping agent name</th>
                          <th>shipping reference number</th>
                          <th>shipped status</th>
                          <th>delivery status</th>
                          <th>order final status</th>
                          <th>vendor payable staus</th>
                          <th>vendor TXN ID</th>
                          <th>consultant seller payable status</th>
                          <th>Consultant Seller TXN ID</th>
                          <th>consultant supplier payable status</th>
                          <th>Consultant Supplier TXN ID</th>
                          <th>Amount paid to shipping agent</th>
                          <th>shipping agent payable status</th>
                          <th>shipping TXN ID</th>
                          <th>gateway sattlement status</th>
                          <th>admin banking status with bank name</th>
                          <th>gst amount</th>
                          <th>gst payment status (customer paid amt.)</th>
                          <th>gst challan Number</th>
                          <th>customer gst number (optional)</th>
                          
                          <th>total collection amt.</th>
                          <th>actual refundable amt.</th>
                          <th>reverse base amt.</th>
                          <th>reverse gst amt.</th>
                          <th>return charges amt.</th>
                          <th>customer review</th>
                          <!-- end custom column -->
                          <th>Order Summery</th>
                          <!-- <th>Action</th> -->
                        </tr>
                          <?php } 
                          
                        }else{ ?>
                          <tr>
                            <td colspan="8">No data found</td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
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
        if (isset($_GET['order_id'])) {
        $sql = "UPDATE tbl_order_hdr SET admin_process = 1 WHERE order_hdr_id = '".$_GET['order_id']."' ";
        $data = delete($sql);
        if ($data==true) {
        echo '<script>alert("Order Transferred");window.location.href="order-report.php";</script>';
        }else{
        //echo '<script>alert("Please try again");window.location.href="";</script>';
        }
        }
        ?>