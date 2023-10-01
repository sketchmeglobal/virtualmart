<?php
include 'cores/comm-head.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Child Category</title>
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
                                <p><a href="child-category-form.php" class="btn btn-success btn-md col-1">+ Add New</a></p>
                                <div class="card-header"><i class="fa fa-table"></i> Child Category</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Category Name</th>
                                                    <th>Status</th>
                                                    <th>Parent Category</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            
                                        <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Parent Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                <script>
     $(document).ready(function() {

        var table = $('#example').DataTable({
            lengthChange: true,
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ],
            processing: true,
            serverSide: true,
            ajax: 'dt_parts/list_child_category.php',
            "columnDefs": [
                    { "orderable": false, "targets": 1 }
                ],
            "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
            });    
            
             table.buttons().container()
                .appendTo( '#category .col-md-6:eq(0)' );
      
     });
     function soft_delete(data){
        if (confirm("Are you sure want to delete")){
            window.location.href="child-category.php?del="+data;
      }
    }
    </script> 
            </body>
        </html>
      <?php
    if(isset($_GET['del'])){
        
        $id = $_GET['del'];
        soft_delete('tbl_child_category','tccid',$id);
        echo '<script>window.location.href="child-category.php";</script>';
    }
      ?>