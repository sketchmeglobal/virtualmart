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
                                    <div class="table-responsive">
                                        <table id="example" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product</th>
                                                    <th>Used</th>
                                                    <th>Link</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT *, COUNT(tbl_order_dtl.product_id) AS ttl FROM tbl_order_dtl
                                                JOIN users ON tbl_order_dtl.user_id = users.id
                                                JOIN tbl_product_hdr ON tbl_product_hdr.phid = tbl_order_dtl.product_id
                                                WHERE tbl_order_dtl.cons_supplier_id = '".$_SESSION['id']."' || tbl_order_dtl.cons_seller_id = '".$_SESSION['id']."' 
                                                GROUP BY tbl_order_dtl.product_id ";
                                                $data = all_data($query);
                                                if ($data['data']==true) {
                                                foreach ($data['all_data'] as $key => $value) {
                                                $pid = base64_encode(urlencode(encode($value['phid']).','.$_SESSION['id']));
                                                $div_id = sha1(md5($value['phid']));
                                                //   print_r($_SESSION); die;
                                                ?>
                                                <tr>
                                                    <td><?=++$key;?></td>
                                                    <td><?=$value['ph_title']?></td>
                                                    <td><?=$value['ttl']?></td>
                                                    <td>
                                                        <p id="<?=$div_id?>" class="d-none"><?=$_SERVER['HTTP_HOST']?>/product.php?product=<?=$pid?></p>
                                                        <button onclick="copyToClipboard('#<?=$div_id?>')" id="cpbutton" class="btn btn-info">Copy</button>
                                                        |
                                                        <a href="<?=(isset($_SERVER['HTTPS']) ? "https://" : "http://") .$_SERVER['HTTP_HOST']?>/product.php?product=<?=$pid?>" class="btn btn-success">View</a>
                                                    </td>
                                                </tr>
                                                <?php }} ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>SL</th>
                                                <th>Product</th>
                                                <th>Used</th>
                                                <th>Link</th>
                                            </tr>
                                            </tfoot>
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
                    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
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
                    function copyToClipboard(element) {
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val($(element).text()).select();
                    document.execCommand("copy");
                    $temp.remove();
                    document.getElementById('cpbutton').innerHTML='Copy';
                    alert('Link Copied');
                    }
                    </script>
                </body>
            </html>