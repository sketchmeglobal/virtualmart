<?php
include 'cores/comm-head.php';

$vendor_det = conditon_data("vendors JOIN users ON vendors.id = users.venodr_id",'*',['vendors.id'=>$_GET['vid']],'');
print_r($vendor_det);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Vendor Report</title>
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
                <div class="card-header"><i class="fa fa-table"></i> Vendor Report</div>
                <div class="card-body">
                  <div class="text-center">
                    Vendor Name: 
                  </div>
                  <div class="table-responsive pt-5">
                    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>SL. No</th>
                          <th>Order ID</th>
                          <th>Customer Name</th>
                          <th>Email</th>
                          <th>Vendor</th>
                          <th>Consultant</th>
                          <th>Order Placed</th>
                          <!-- <th>Action</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_order_dtl
                        JOIN tbl_product_hdr ON tbl_order_dtl.product_id = tbl_product_hdr.phid
                        JOIN vendors ON vendors.id = tbl_product_hdr.vendor_id
                        GROUP BY tbl_order_dtl.order_id 
                        ORDER BY tbl_order_dtl.order_dtl_id DESC
                        ";
                        $data = all_data($query);
                        if ($data['data']==true) {
                        foreach($data['all_data'] as $key4 => $od){
                        ?>
                        <tr>
                          <td><?=++$key4?></td>
                          <td>
                            <a href="order-data-details.php?order=<?=encode($od['order_hdr_id']) ?>" class="text-warning">
                            <?=$od['order_id'] ?>
                          </a>
                          </td>
                          <td><?=$od['f_name'] . ' ' .$od['l_name']?></td>
                          <td><?=$od['email'] ?></td>
                          <td><?=$od['company_name'] ?></td>
                          <td><?php
                          $find_cosul_det = find_cosul_det($od['consultant_id']);
                          echo $find_cosul_det['f_name'] . ' ' .$find_cosul_det['l_name']
                        ?></td>
                          <td><?=$od['added_on'] ?></td>
                          
                          <!-- <td>
                            <a target="_blank" href="order-data-details.php?order=< ?=encode($od['order_hdr_id']) ?>" class="btn btn-success">Change</a>
                          </td> -->
                          <?php } 
                          
                        }else{ ?>
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