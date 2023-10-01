<?php
error_reporting(E_ALL);
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5('admin'));
// fetching all product feedbacks
$query = "SELECT user_feedback.id, users.f_name, users.l_name, tbl_product_hdr.ph_title, rating, review, user_feedback.id AS FEEDBACK_ID, user_feedback.status
FROM `user_feedback`
LEFT JOIN tbl_product_hdr ON user_feedback.product_id = tbl_product_hdr.phid
LEFT JOIN users ON user_id = users.id";
$all_products = all_data($query);
if (isset($_POST['stock_update'])) {
extract($_POST);

$rating;
$review;
$feedback_id;
$status;

$sql1 = "UPDATE `user_feedback` SET `rating` = $rating, review ='". strip_tags($review) ."', `status` = $status WHERE `id` = $feedback_id";

if(update($sql1)){
// header("Refresh:0");
}else{
die('Update Issue');
}

// $last_id = $ins['count'];

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
        <title>All Feedbacks</title>
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
                                        <p class="text-primary text-center">All Feedbacks</p>
                                    </div>
                                    <hr>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Name</th>
                                                <th>Product Name</th>
                                                <th>Rating</th>
                                                <th>Review</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                       
                                        <tbody>
                                            <?php
                                            if ($all_products['data']) {
                                            $iter = 1;
                                            foreach($all_products['all_data'] as $ap){
                                        // echo '<pre>', print_r($ap), '</pre>';die;
                                        ?>
                                        <tr>
                                            <td><?=$iter++?></td>
                                            <td><?=$ap['f_name'] . ' ' . $ap['l_name'] ?></td>
                                            <td><?=$ap['ph_title']?></td>
                                            <td><?=$ap['rating']?></td>
                                            <td><?=$ap['review']?></td>
                                            <td><?=($ap['status']==0) ? 'Pending':'Approved'?></td>
                                            <td>
                                                <?php if($ap['status']==0){?>
                                                <a title="Edit" class="btn btn-warning feedback" href="?feedback_id=<?=$ap['FEEDBACK_ID']?>" onclick="return confirm('Are you sure want to approve?')" >
                                                    <i class="zmdi zmdi-plus-circle"></i>
                                                </a>
                                                <?php } ?>
                                                <a class="btn btn-danger" href="new-product.php">
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
                
                <!--modal data-->
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Product Feedback</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="">
                                    
                                    <div class="form-group row">
                                        <label for="input-26" class="col-sm-6 col-form-label">Rating (1 - 5)<br>[ 5 being the best ]: </label>
                                        <div class="col-sm-6">
                                            4
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="input-26" class="col-sm-6 col-form-label">Review:</label>
                                        <div class="col-sm-6">
                                            Good Product
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="input-26" class="col-sm-6 col-form-label">Status</label>
                                        <div class="col-sm-6">
                                            <select name="status" id="feedback_status" class="feedback_status">
                                                <option value="0">Hide</option>
                                                <option value="1">Show on website</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button type="submit" name="" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
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
                
                
                $(".feedback").click(function(){
                $this = $(this);
                $('#staticBackdrop').on('show.bs.modal', function (event) {
                fid = ($($this).data('id'));
                $('#modal_feedback_id').val(fid);
                
                $.ajax({
                method: 'POST',
                // contentType: "application/json",
                // dataType: "json",
                url: "cores/fetch_feedbackdata.php",
                data:{fid: fid},
                success: function(result){
                const myArray = result.split("##@##");
                $("#rating").val(myArray[0]);
                $("#editor1").html(myArray[1]);
                $("#feedback_status").val(myArray[2]);
                CKEDITOR.replace('editor1');
                },
                error: function(result){
                alert(2);
                }
                });
                
                });
                });
                
                $('#staticBackdrop').on('show.bs.modal', function (event) {
                // CKEDITOR.replace('#editor1');
                })
                
                
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

        <?php 

        if (isset($_GET['feedback_id'])) {
            $id = $_GET['feedback_id'];
            conditon_update('user_feedback',['status'=>1],['id'=>$id]);
            echo '<script>window.location.href="product-feedback.php"</script>';
        }
         ?>
