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
          <!--Start Dashboard Content-->
          <div class="row mt-3">
            <div class="col-lg-12">
              <div class="card">
                <!-- <p><a href="child-category-form.php" class="btn btn-success btn-md col-1">+ Add New</a></p> -->
                <div class="card-header"><i class="fa fa-table"></i> Withdrawal Data</div>
                <div class="card-body">
                  <a href="?page=bank-details" class="btn btn-warning  float-right ">Bank Details</a>
                  <div class="table-responsive pt-5">
                    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>SL. No</th>
                          <th>txn. id.</th>
                          <th>invoice id</th>
                          <th>request amount</th>
                          <th>requested</th>
                          <th>status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_order_hdr
                      JOIN tbl_order_dtl ON tbl_order_hdr.order_hdr_id = tbl_order_dtl.order_hdr_id
                      JOIN tbl_product_hdr ON tbl_product_hdr.phid = tbl_order_dtl.product_id
                      JOIN vendors ON vendors.id = tbl_product_hdr.vendor_id
                      JOIN users ON users.vendor_id = vendors.id
                      JOIN tbl_order_amt_master ON tbl_order_hdr.order_amt_master_id = tbl_order_amt_master.master_id
                      WHERE users.id = '".$_SESSION['id']."' ";
                        $data = all_data($query);
                        if ($data['data']==true) {
                        foreach($data['all_data'] as $key4 => $od){
                        ?>
                        <tr>
                          <td><?=++$key4?></td>
                          <td><?=$od['vendor_txn_id']?></td>
                          <th><?=$od['order_id']?></th>
                          <td><?=$od['customer_paid_amt'] ?></td>
                          <td><?=$od['admin_process_date']?></td>
                          <td>
                            <?php
                            if ($od['vendor_payable_status']==0) { echo 'Pending'; }
                            elseif ($od['vendor_payable_status']==1) { echo 'Success'; }
                            elseif ($od['vendor_payable_status']==2) { echo 'Rejected'; }
                            ?>
                          </td>
                          <?php } }else{ ?>
                          <tr>
                            <td colspan="7">No data found</td>
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