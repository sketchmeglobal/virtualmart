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
                                                    <th>Order ID</th>
                                                    <th>User Name</th>
                                                    <th>Amount</th>
                                                    <th>Discount</th>
                                                    <th>Status</th>
                                                    <th>Order Placed</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM tbl_order_hdr
                                                JOIN users ON tbl_order_hdr.user_id = users.id
                                                JOIN tbl_order_dtl ON tbl_order_hdr.phid = tbl_order_dtl.product_id
                                                WHERE tbl_order_dtl.cons_supplier_id = '".$_SESSION['id']."' || tbl_order_dtl.cons_seller_id = '".$_SESSION['id']."' 
                                                ORDER BY tbl_order_dtl.order_hdr_id DESC ";
                                                $data = all_data($query);
                                                if ($data['data']==true) {
                                                foreach ($data['all_data'] as $key => $value) {
                                                $pid = encode($value['order_hdr_id']);
                                                //   print_r($_SESSION); die;
                                                
                                                if($_SESSION['id'] == 1){
                                                
                                                ?>
                                                <tr>
                                                    <td><?=++$key;?></td>
                                                    <td><?=$value['order_id']?></td>
                                                    <td><?=$value['f_name']. ' ' .$value['l_name']?></td>
                                                    <td><?=$value['pay_amnt']?></td>
                                                    <td><?=number_format(($value['total_amt']-$value['pay_amnt']),2)?></td>
                                                    <td>
                                                        <?php
                                                        if ($value['order_status']==1) {
                                                        echo 'Order Plcaed';
                                                        }elseif($value['order_status']==2){
                                                        echo 'Order Delivered';
                                                        }else{
                                                        echo 'Order Cancelled';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= date("d M, Y - h:i:s", strtotime($value['added_on'])); ?></td>
                                                    <td>
                                                        <?=($value['order_status']==2) ? '<a href="#" data-pid="'.$pid.'" data-uid="'.$value['user_id'].'" data-toggle="modal" data-target="#staticBackdrop" class="btn-success p-2 rounded feedback"><i class="fa fa-comment"></i></a> |' : '' ?>
                                                        <a href="?page=order-data-details&order=<?=$pid?>" class="btn-info p-2 rounded"><i class="fa fa-edit"></i></a>
                                                        |
                                                        <a onclick="return confirm('Are you sure?');" href=""class="btn-danger p-2 rounded" onclick="return confirm('Are you sure want to delete?')"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                
                                                } else
                                                if($value['user_id'] == $_SESSION['id']){
                                                ?>
                                                
                                                <tr>
                                                    <td><?=++$key;?></td>
                                                    <td><?=$value['order_id']?></td>
                                                    <td><?=$value['f_name']. ' ' .$value['l_name']?></td>
                                                    <td><?=$value['pay_amnt']?></td>
                                                    <td>
                                                        <?php
                                                        if ($value['order_status']==1) {
                                                        echo 'Order Plcaed';
                                                        }elseif($value['order_status']==2){
                                                        echo 'Order Delivered';
                                                        }else{
                                                        echo 'Order Cancelled';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= date("d M, Y - h:i:s", strtotime($value['added_on'])); ?></td>
                                                    <td>
                                                        <?=($value['order_status']==2) ? '<a href="#" data-pid="'.$pid.'" data-uid="'.$value['user_id'].'" data-toggle="modal" data-target="#staticBackdrop" class="btn-success p-2 rounded feedback"><i class="fa fa-comment"></i></a> |' : '' ?>
                                                        <a href="?page=order-data-details&order=<?=$pid?>" class="btn-info p-2 rounded"><i class="fa fa-edit"></i></a>
                                                        |
                                                        <a onclick="return confirm('Are you sure?');" href=""class="btn-danger p-2 rounded" onclick="return confirm('Are you sure want to delete?')"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                                
                                                <?php
                                                }
                                                $pid = encode($value['order_hdr_id']);
                                                ?>
                                                
                                                <?php }} ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>SL</th>
                                                <th>Order ID</th>
                                                <th>User Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Order Placed</th>
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
                    
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add your feedback</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="#">
                                        <input type="hidden" name="product_id" id="modal_product_id" value="">
                                        <input type="hidden" name="user_id" id="modal_user_id" value="">
                                        
                                        <div class="form-group row">
                                            <label for="input-26" class="col-sm-6 col-form-label">Rating (1 - 5)<br>[ 5 being the best ] </label>
                                            <div class="col-sm-6">
                                                <input min=1 max=5 type="number" name="rating" class="form-control form-control-rounded" placeholder="Add rating" required value="<?=$feedback_data['rating']?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="input-26" class="col-sm-6 col-form-label">Review</label>
                                            <div class="col-sm-6">
                                                <textarea id="editor1" name="review" required>
                                                <?=$feedback_data['review']?>
                                                </textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-12 d-flex justify-content-center">
                                                <button type="submit" name="user_feedback" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
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
                    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
                    
                    <script>
                    $(document).ready(function() {
                    
                    CKEDITOR.replace( 'editor1' );
                    
                    $(".feedback").click(function(){
                    $this = $(this);
                    $('#staticBackdrop').on('show.bs.modal', function (event) {
                    pid = ($($this).data('pid'));
                    $('#modal_product_id').val(pid);
                    uid = ($($this).data('uid'));
                    $('#modal_user_id').val(uid);
                    })
                    
                    });
                    
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