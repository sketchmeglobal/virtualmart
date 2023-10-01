<?php
//error_reporting(E_ALL);
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5('admin'));
// fetching all products
$query = "SELECT
    vendors.id AS V_ID,
    vendors.company_name,
    vendors.status,
    (
    SELECT
        COUNT(phid)
    FROM
        tbl_product_hdr
    WHERE
        vendor_id = V_ID
) AS TOTAL_PRODUCT
FROM
    vendors
LEFT JOIN  tbl_product_hdr ON tbl_product_hdr.vendor_id = vendors.id
WHERE vendors.row_status = 1
GROUP BY
    tbl_product_hdr.vendor_id
ORDER BY TOTAL_PRODUCT DESC
    ";
$all_products = all_data($query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>All Products</title>
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
                                    <p class="text-primary text-center">Vendor Products</p>
                                    
                                </div>
                                <hr>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Vendor</th>
                                            <th>Products</th>
                                            <th>Vendor Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php
                                        if ($all_products['data'] == true) {
                                        $iter = 1;
                                        foreach($all_products['all_data'] as $det_k => $det){
                                    ?>
                                    <tr>
                                            <td><?=++$det_k?></td>
                                            <td><?=$det['company_name']?></td>
                                            <td><?=$det['TOTAL_PRODUCT']?></td>
                                            <td>
                                                <?php 
                                                if ($det['status'] == 0) {
                                                ?>
                                                Inactive
                                        <?php }else { echo 'Active'; } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if ($det['TOTAL_PRODUCT'] > 0) {
                                                ?>
                                                <a class="btn btn-primary" href="view-vendor-products.php?id=<?=$det['V_ID']?>">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                        <?php }else { echo '---'; } ?>
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
            
            <!--modal data-->
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Stock</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="#">
                                <input type="hidden" name="stock_product_id" id="modal_product_id" value="">
                                
                                <div class="form-group row">
                                    <label for="input-26" class="col-sm-6 col-form-label">Add new stock amount</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="stock_quantity" class="form-control form-control-rounded" placeholder="Add stock">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="input-26" class="col-sm-6 col-form-label">Add stock arrival date</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="stock_date" class="form-control form-control-rounded" placeholder="Add stock date">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-12 d-flex justify-content-center">
                                        <button type="submit" name="stock_update" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
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
            
            $(".stockIn").click(function(){
            $this = $(this);
            $('#staticBackdrop').on('show.bs.modal', function (event) {
            pid = ($($this).data('id'));
            $('#modal_product_id').val(pid);
            })
            
            });
            
            
            var table = $('table').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
            });
            
            //  table.buttons().container()
            //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
            
            });
            </script>
        </body>
    </html>