<?php
error_reporting(E_ALL);
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5(time()));

if (isset($_POST['new_color'])) {
    extract($_POST);
    $ins = insert("INSERT INTO tbl_color SET color_code  = '".$color_code."' ");
    if ($ins == true) {
        echo '<script>alert("Color Inserted");window.location.href="";</script>';
    }else{
       echo '<script>alert("Color Already exist");window.location.href="";</script>';
    }
}


if (isset($_POST['update_color'])) {
    extract($_POST);
    $ins = update("UPDATE tbl_color SET color_code  = '".$update_color_code."' WHERE tcid = '".$color_codepk."' ");
    if ($ins == true) {
        echo '<script>alert("Color Updated");window.location.href="";</script>';
    }else{
       echo '<script>alert("Please Try Again");window.location.href="";</script>';
    }
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
    <title>Products Colors</title>
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
                                    <p class="text-primary text-center">All Colors</p>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" href="#">
                                        <i class="zmdi zmdi-plus-circle"></i>
                                        Add new Color
                                    </a>
                                </div>
                                <hr>
                                <table class="table table-hover table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Color Code</th>
                                            <th>Color</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
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
                            <h5 class="modal-title" id="staticBackdropLabel">Add Colors</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                               
                                <div class="form-group row">
                                    <label for="input-26" class="col-sm-6 col-form-label">Color Code</label>
                                    <div class="col-sm-6">
                                        <input type="color" name="color_code" class="form-control form-control-rounded">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-12 d-flex justify-content-center">
                                        <button type="submit" name="new_color" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Add Now</button>
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


            <!-- Modal edit -->
            <div class="modal fade" id="staticBackdropEDIT" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelEDIT" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabelEDIT">Update Colors</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                               <input type="hidden" value="" id="color_code_id" name="color_codepk">
                                <div class="form-group row">
                                    <label for="input-26" class="col-sm-6 col-form-label">Color Code</label>
                                    <div class="col-sm-6">
                                        <input type="color" id="get_color_code" name="update_color_code" class="form-control form-control-rounded" value="#ffffff">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-12 d-flex justify-content-center">
                                        <button type="submit" name="update_color" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
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
                function edit(id){
                    $.ajax({
                        type:'POST',
                        url:'dt_parts/list_colors.php',
                        data:'color_code_id='+id,
                        success:function(result){
                            console.log(result);
                            var return_data = JSON.parse(result);
                             $('#get_color_code').val(return_data.color_code);
                             $('#color_code_id').val(return_data.id);
                        }
                    });
                }
            </script>

              <script>
     $(document).ready(function() {

        var table = $('#example').DataTable({
            lengthChange: true,
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ],
            processing: true,
            serverSide: true,
            ajax: 'dt_parts/list_colors.php',
            "columnDefs": [
                    { "orderable": false, "targets": 1 }
                ],
            "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
            });    
            
             table.buttons().container()
                .appendTo( '#example .col-md-4:eq(0)' );
      
     });
     function soft_delete(data){
        if (confirm("Are you sure want to delete")){
            window.location.href="colors.php?del="+data;
      }
    }
    </script>
        </body>
    </html>
          <?php
    if(isset($_GET['del'])){
        
        $id = $_GET['del'];
        soft_delete('tbl_color','tcid',$id);
        echo '<script>window.location.href="colors.php";</script>';
    }
      ?>