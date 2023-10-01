<?php
error_reporting(E_ALL);
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5(time()));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Common Group</title>
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
                                    <p class="text-primary text-center">Common Group</p>
                                    <a class="btn btn-success" href="new-common-group.php">
                                        <i class="zmdi zmdi-plus-circle"></i>
                                        Common Group
                                    </a>
                                </div>
                                <hr>
                                <table id="example" class="table table-striped table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sl. No.</th>
                                            <th>Category Name</th>
                                            <th>Sub Category</th>
                                            <th>Target</th>
                                            <th>Item</th>
                                            <th>Material</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 

                                    $q = all_data("SELECT
                                            *
                                            FROM
                                            group_fields
                                            LEFT JOIN tbl_parent_category ON group_fields.p_cat_id = tbl_parent_category.p_cid
                                            LEFT JOIN tbl_child_category ON group_fields.c_cat_id = tbl_child_category.tccid 
                                            ORDER BY group_fields.gf_id DESC
                                        ");
                                    if (!empty($q)) {
                                        foreach($q['all_data'] as $adk=>$ad){
                                   ?>

                                   <tr>
                                       <td><?=++$adk?></td>
                                       <td><?=$ad['p_c_name']?></td>
                                       <td><?=$ad['tc_name']?></td>
                                       <td><?=$ad['target_group']?></td>
                                       <td><?=$ad['item_data']?></td>
                                       <td><?php echo $ad['material_data'] != NULL ? substr((implode(',', json_decode($ad['material_data']))), 0,50).'...':''; ?></td>
                                       <td>
                                           <a href="edit-common-group.php?id=<?=$ad['gf_id']?>"><i class="fa fa-edit"></i></a>
                                       </td>
                                   </tr>
                               <?php }}else{ ?>
                                <tr>
                                    <td colspan="6">No data found</td>
                                </tr>
                               <?php } ?>
                                    <tfoot>
                                        <tr>
                                            <th>Sl. No.</th>
                                            <th>Category Name</th>
                                            <th>Sub Category</th>
                                            <th>Target</th>
                                            <th>Item</th>
                                            <th>Material</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    
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
            <!-- sidebar-menu js -->
            <script src="assets/js/sidebar-menu.js"></script>
            <!-- Custom scripts -->
            <script src="assets/js/app-script.js"></script>
            
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
                var table = $('#example').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
            });
            </script>
        </body>
    </html>