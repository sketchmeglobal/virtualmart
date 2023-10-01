<?php 
// error_reporting(E_ALL);

include 'cores/comm-head.php';

if (isset($_POST['submit'])) {
$bname=$_POST['name'];
$title=$_POST['btitle'];
$website=$_POST['bwebsite'];
$bstatus=$_POST['status'];

$blogo=$_FILES['blogo']['name'];
$file_path = $_FILES['blogo']['tmp_name'];

$fileValid = img_check($blogo);
$destination = '../vendor-images/'.$fileValid['file_name'];
// image file validation
if ($blogo !='') {
  if ($fileValid['data']==true) {
      move_uploaded_file($file_path, $destination);
      bind_insert('tbl_brands',['logo' => $fileValid['file_name'], 'brand_name' => $bname, 'brand_title' => $title, 'website' => $website, 'status' => $bstatus]);
      echo '<script>alert("Brand added suucessfully");window.location.href="";</script>';
  }
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
  <title>All Brands</title>
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

  <style>
    
      #brands_paginate{float:right;margin-top: 10px;}
      #brands_info{margin-top: 15px;}
      #brands_filter{text-align:end;}
      
      /*modal area*/
        .modal .modal-content .modal-body {
          border-radius: 7px;
          overflow: hidden;
          background-color: #fff;
          padding-left: 0px;
          padding-right: 0px;
          -webkit-box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9);
          box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9); 
       }
       .modal {
          border-radius: 7px;
          overflow: hidden;
          background-color: transparent;
        }
        .modal .logo a img {
          width: 30px;
        }
        .modal .modal-content {
          background-color: transparent;
          border: none;
          border-radius: 7px;
        }
        .modal .modal-content .modal-body {
          border-radius: 7px;
          overflow: hidden;
          background-color: #fff;
          padding-left: 0px;
          padding-right: 0px;
          -webkit-box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9);
          box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9);
        }
        .modal .modal-content .modal-body h2 {
          font-size: 18px;
        }
        .modal .modal-content .modal-body p {
          color: #777;
          font-size: 14px;
        }
        .modal .modal-content .modal-body h3 {
            color: #fff;font-size: 16px;background: #166644;
        }
        .modal .modal-content .modal-body .close-btn {
          color: #000;
        }
        .modal .modal-content .modal-body .promo-img {
          -webkit-box-flex: 0;
          -ms-flex: 0 0 50%;
          flex: 0 0 50%;
        }
        .modal .modal-content .modal-body .promo-img .price {
          top: 20px;
          left: 20px;
          position: absolute;
          color: #fff;
        }
        .modal .btn {
          border-radius: 30px;
        }
        .modal .warp-icon {
          width: 80px;
          height: 80px;
          margin: 0 auto;
          position: relative;
          background: rgba(62, 100, 255, 0.05);
          color: #3e64ff;
          border-radius: 50%;
        }
        .modal .warp-icon span {
          font-size: 40px;
          position: absolute;
          left: 50%;
          top: 50%;
          -webkit-transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
        }
        
        .modal .form-control {
          border: none;
          border-radius: 0;
          border-bottom: 1px solid #ccc;
          padding-left: 0;
          padding-right: 0;
        }
        .modal .form-control:active,
        .modal .form-control:focus,
        .modal .form-control:hover {
          border-bottom: 1px solid #000;
          -webkit-box-shadow: none;
          box-shadow: none;
          outline: none;
        }
        
        .modal .btn {
          border-radius: 4px;
          border: none;
          padding-top: 10px;
          padding-bottom: 10px;
          padding-left: 30px;
          padding-right: 30px;
        }
        .modal .btn:active,
        .modal .btn:focus {
          outline: none;
          -webkit-box-shadow: none !important;
          box-shadow: none !important;
        }
        
        .modal .close-btn {
          position: absolute;
          right: 20px;
          top: 20px;
          font-size: 20px;
        }
        .close-btn span {
          color: #ccc;
        }
        .modal .close-btn:hover span {
          color: #000;
        }
        
        .modal button.close{
            position: absolute;
            right: 25px;
            top: 50px;
            z-index: 1;
            border: 1px solid #999;
            border-radius: 50%;
            height: 35px;
            width: 35px;
            padding: 5px;
            margin: 0;
        }
        
        .modal input{width: calc(100% - 100px);margin: auto;max-width: 500px;}
        .modal form label{margin: 0;}
      
  </style>    

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
                    <p class="text-primary text-center">All Brands</p>
                    <a class="btn btn-success" data-toggle="modal" data-target="#commonmodal" href="#">
                        <i class="zmdi zmdi-plus-circle"></i>  
                        Add new Brand
                    </a>
                </div>
                <hr>
                <table id="brands" class="table table-borderd table-hover table-striped" style="width:100%">
                    <tcpation></tcpation>
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Brand name</th>
                            <th>Title</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Logo</th>
                            <th>Brand name</th>
                            <th>Title</th>
                            <th>Website</th>
                            <th>Status</th>
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
  

    <!-- Modal -->
   <!-- Modal -->
    <div class="modal fade" id="commonmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="commonmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="commonmodalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="main-content p-3 text-center">
                <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><span class="icon-close2"></span></span>
                </a>
                <div class="warp-icon mb-4">
                    <!--<span class="icon-lock2"></span>-->
                    <img src="https://t4.ftcdn.net/jpg/03/56/17/75/240_F_356177598_bKRrM01JHWdF2sdABU5brZGTt3FqDqKf.jpg" class="w-100" />
                </div>
                
                <h3 id="modal-title h6">ADD NEW ROW</h3>
                <hr>
                <form class="row" method="post" action="" enctype="multipart/form-data">
                    
                    <div class="form-group mb-2 col-md-6 border-bottom">
                        <label for="logo">Upload Logo<sup class="text-danger">*</sup></label>
                        <input type="file" class="form-control" name="blogo" id="logo" aria-describedby="uploadLogo">
                        <small id="uploadLogo" class="form-text text-muted">We'll use these while adding products</small>
                    </div>
                    <div class="form-group mb-2 col-md-6 border-bottom">
                        <label for="brandName">Brand name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="name" id="brandName" aria-describedby="brandNameLabel">
                        <small id="brandNameLabel" class="form-text text-muted">We'll use these while adding products</small>
                    </div>
                    <div class="form-group mb-2 col-md-6 border-bottom">
                        <label for="title">Title<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="btitle" id="title" aria-describedby="titleLabel">
                        <small id="titleLabel" class="form-text text-muted">We'll use these while adding products</small>
                    </div>
                    <div class="form-group mb-2 col-md-6 border-bottom">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" name="bwebsite" id="website" aria-describedby="websiteLabel">
                        <small id="websiteLabel" class="form-text text-muted">We'll use these while adding products</small>
                    </div>
                    <div class="form-group mb-2 col-md-6 border-bottom">
                        <select class="form-control" name="status" id="">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="d-flex">
                        <div class="mx-auto">
                        <button type="Submit" class="btn btn-primary" name="submit">Submit</button> 
                        </div>
                    </div>
                    
                </form>
            </div>
            
          </div>
          
        </div>
      </div>
    </div>


  
  <!--modal area-->
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
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
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
     
        var table = $('#brands').DataTable({
            buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ],
            processing: true,
            serverSide: true,
            ajax: 'dt_parts/list-dt-brand.php',
            "columnDefs": [
                    { "orderable": false, "targets": 1 }
                ]
            });    
            
             table.buttons().container()
                .appendTo( '#brands .col-md-6:eq(0)' );
      
     });
    function soft_delete(data){
        if (confirm("Are you sure want to delete")){
            window.location.href="all-brands.php?del="+data;
      }
    }
    </script>
</body>
</html>
    <?php
    if(isset($_GET['del'])){
        
        $id = $_GET['del'];
        soft_delete('tbl_brands','id',$id);
        echo '<script>window.location.href="all-brands.php";</script>';
    }
    
    ?>