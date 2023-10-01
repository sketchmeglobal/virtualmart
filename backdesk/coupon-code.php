<?php
error_reporting(E_ALL);
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5(time()));
// fetching all products
$query = "SELECT * FROM tbl_coupons WHERE row_status = 1";
$all_vendors = all_data($query);
if($all_vendors['data'] == NULL){

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
    <title>Coupon Code</title>
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
    <!-- Select datatable -->
    <link href="assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
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
                    <div class="col-lg-10 ">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <div class="card-title d-flex justify-content-between">
                                    <p class="text-primary text-center">Coupon Code</p>
                                    <a href="coupon-new.php" class="btn btn-warning float-right">+ Add New</a>
                                </div>
                                <hr>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Coupon Code</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Max Usages</th>
                                            <!-- <th>Used</th> -->
                                            <th>Expiary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($all_vendors['data'] == true) {
                                        $iter = 1;
                                        foreach($all_vendors['all_data'] as $au){
                                    // echo '<pre>', print_r($au), '</pre>';
                                    ?>
                                    <tr>
                                        <td><?=$iter++?></td>
                                        <td><?=$au['coupon_code']?></td>
                                        <td><?=$au['coupon_type']?></td>
                                        <td><?=$au['amount']?></td>
                                        <td><?=$au['max_limit']?></td>
                                        <td><?=$au['expiary_date']?></td>
                                        <td>
                                            <a class="btn btn-primary" href="coupon-edit.php?id=<?=encode($au['coupon_id'])?>">
                                                <i class="zmdi zmdi-edit"></i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger" href="?del=<?=$au['coupon_id'] ?>" onclick="return confirm('Are you sure want to delete?')">
                                                <i class="zmdi zmdi-minus-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
            
            var table = $('table').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
            } );
            
            //  table.buttons().container()
            //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
            
            });
            </script>
        </body>
    </html>
            <?php
    if(isset($_GET['del'])){
        
        $id = $_GET['del'];
        soft_delete('tbl_coupons','coupon_id',$id);
        echo '<script>window.location.href="coupon-code.php";</script>';
    }
      ?>