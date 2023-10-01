<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Income Data</title>
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
                <div class="card-header"><i class="fa fa-table"></i> Income Data</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>SL. No</th>
                          <th>ORDER ID</th>
                          <th>Customer Name</th>
                          <th>Customer Email</th>
                          <th>Photo</th>
                          <th>Earnings</th>
                          <th>Earnings Type</th>
                          <th>Order Placed</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_commission_added
                        JOIN tbl_product_hdr ON tbl_commission_added.product_id = tbl_product_hdr.phid
                        JOIN tbl_order_hdr ON tbl_order_hdr.order_hdr_id = tbl_commission_added.order_hdr_id
                        JOIN users ON users.id = tbl_commission_added.purchase_usr_id
                        WHERE tbl_commission_added.consultant_id = '".$_SESSION['id']."'
                        ORDER BY tbl_commission_added.caid DESC";
                        $data = all_data($query);
                        if ($data['data']==true) {
                        foreach($data['all_data'] as $key4 => $od){
                        ?>
                        <tr>
                          <td><?=++$key4?></td>
                          <td><?=$od['order_id']?></td>
                          
                          <td><?=$od['f_name'] . ' ' .$od['l_name']?></td>
                          <td><?=$od['email']?></td>
                          <td><img src="../product-images/<?=$od['ph_feature_img']?>" style="width: 50px;"></td>
                          <td><?=$od['commission_amt']?></td>
                          <td><?=$od['amt_type']?></td>
                          <td><?=$od['added_on']?></td>
                          <?php } }else{ ?>
                          <tr>
                            <td colspan="4">No data found</td>
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