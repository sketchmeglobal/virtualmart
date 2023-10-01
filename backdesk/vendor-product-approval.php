<?php 
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5(time()));

$uid = decode($_GET['id']);

$all_vendors = conditon_data('vendors JOIN tbl_product_hdr ON vendors.id = tbl_product_hdr.vendor_id
  JOIN users ON users.vendor_id = vendors.id
  JOIN tbl_product_dtl ON tbl_product_dtl.product_id = tbl_product_hdr.phid
  ','*',['tbl_product_hdr.phid'=>$uid]);
// echo '<pre>', print_r($all_vendors), '</pre>';

if($all_vendors['data'] == NULL){
    echo '<pre>', print_r($all_vendors), '</pre>';
    die('Severe Error! Contact admin with the error message above.');    
}

$vendor_details = $all_vendors['all_data'];

if (isset($_POST['update'])) {
  extract($_POST);
  $commission; // consultant commission
  $product_status; // product showing status to public
  $token; 
  $vendor; 

  $vendorid = decode($vendor);
    $old_data = conditon_data('vendors JOIN tbl_product_hdr ON vendors.id = tbl_product_hdr.vendor_id
  JOIN users ON users.vendor_id = vendors.id
  ','*',['tbl_product_hdr.phid'=>$vendorid])['all_data'];
    user_log('tbl_product_hdr', $old_data['phid'], 'EDIT', $old_data,'PRODUCT');

    conditon_update('tbl_product_hdr',['show_trending_today'=>$show_trending_today,'ph_consultant_seller'=>$ph_consultant_seller, 'ph_consultant_supplier' => $ph_consultant_supplier, 'admin_commission'=>$admin_commission, 'ph_remarks'=>$ph_remarks, 'ph_status'=>$product_status, 'ph_bonus' => $Redemption],['phid'=>$old_data['phid']]);

    echo '<script>alert("Product updated");window.location.href="vendor-pending-products.php";</script>';

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
  <title>Edit Vendor</title>
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

<!--Vendor details-->


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
           <div class="card-body">
           <div class="card-title text-primary text-center">Vendor product Approval</div>
           <hr>
            <form action="" method="post" enctype="multipart/form-data">
              
              <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
              <input type="hidden" value="<?=$_GET['id']?>" name="vendor">
              
              <div class="row">
              
                <table class="table table-bordered col-md-8">
                  <tr>
                    <th colspan="2" class="text-warning text-center"><u>Vendor Data</u></th>
                  </tr>
                  <tr>
                    <th>Company Name</th>
                    <td><?=$vendor_details['company_name']?></td>
                  </tr>
                  <tr>
                    <th>Company Email</th>
                    <td><?=$vendor_details['email']?></td>
                  </tr>
                  <tr>
                    <th>Company Contact</th>
                    <td><?=$vendor_details['contact']?></td>
                  </tr>
                  <tr>
                    <th>Contact Person</th>
                    <td><?=$vendor_details['f_name'].' '.$vendor_details['l_name']?></td>
                  </tr>
                  <tr>
                    <th colspan="2" class="text-warning text-center"><u>Product Data</u></th>
                  </tr>
                  <tr>
                    <th>Product Name</th>
                    <td><?=$vendor_details['ph_title']?></td>
                  </tr>
                  <tr>
                    <th> QTY.</th>
                    <td><?=$vendor_details['ph_qty']?></td>
                  </tr>
                  <tr>
                    <th>Opening Stock</th>
                    <td><?=$vendor_details['opening_stock']?></td>
                  </tr>
                  <tr>
                    <th>MRP</th>
                    <td><?=$vendor_details['ph_price']?></td>
                  </tr>
                  <tr>
                    <th>DP</th>
                    <td><?=$vendor_details['ph_dp']?></td>
                  </tr>
                  <tr>
                    <th>Shipping Charges</th>
                    <td><?=$vendor_details['ph_shipping_charge']?></td>
                  </tr>
                  <tr>
                    <th>Tax(%)</th>
                    <td><?=$vendor_details['ph_tax']?></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <b>Short Description:</b><br>
                      <?=$vendor_details['ph_short_desc']?>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2" class="">Product Information:</th>
                  </tr>
                  <?php 
                 foreach(json_decode($vendor_details['ph_desc']) AS $key => $val){
                  ?>
                   <tr>
                     <th><?=$key?></th>
                     <td><?=$val?></td>
                   </tr>
                 <?php } ?>
                </table>
              <div class="form-group col-md-4">

                <label for="input-26" class="col-form-label">Show Home Page</label>

                <select name="show_trending_today" id="" class="form-control removed-form-control-rounded">
                  <option value="1" <?=($vendor_details['show_trending_today']==1) ? 'selected':''?>>Yes</option>
                  <option value="0" <?=($vendor_details['show_trending_today']==0) ? 'selected':''?>>No</option>
                </select>
            <br>

            <label for="input-26" class="col-form-label">Consultant Commission Seller (%)</label>

            <input type="text" name="ph_consultant_seller" class="form-control removed-form-control-rounded" id="title" placeholder="Enter Consultant seller Commission" required value="<?=$vendor_details['ph_consultant_seller']?>">
            <br>

            <label for="input-26" class="col-form-label">Consultant Commission Supplier (%)</label>

            <input type="text" name="ph_consultant_supplier" class="form-control removed-form-control-rounded" id="title" placeholder="Enter Consultant supplier Commission" required value="<?=$vendor_details['ph_consultant_supplier']?>">

            <br>

            <label for="input-26" class="col-form-label">Admin Commission (%)</label>
            <input type="text" name="admin_commission" class="form-control removed-form-control-rounded" id="title" placeholder="Enter admin Commission" required value="<?=$vendor_details['admin_commission']?>">

            <br>

            <label for="input-26" class="col-form-label">Redemption (%)</label>
            <input type="text" name="Redemption" class="form-control removed-form-control-rounded" id="title" placeholder="Enter customer bonus" required value="<?=$vendor_details['ph_bonus']?>">

            <br>
            <label for="input-26" class="col-form-label">Remarks</label>
            <input type="text" name="ph_remarks" class="form-control removed-form-control-rounded" id="title" placeholder="Enter remarks" value="<?=$vendor_details['ph_remarks']?>">

            <label for="input-27" class="col-form-label">Product Status</label>
              <select name="product_status" id="" class="form-control removed-form-control-rounded" required>
                <option value="1">Approve</option>
                <option value="4">Reject</option>
              </select>
              <br>
              <button type="submit" name="update" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
              <br><br>
              <a href="vendor-pending-products.php" class="btn btn-warning" onclick="return confirm('Are you sure want to back')"><-Back</a>

                <div class="feature-image mt-4" style="width: 50%;">
                  <label for="input-27" class="col-form-label pt-4">Feature Image</label>
                  <img src="../product-images/<?=$vendor_details['ph_feature_img']?>" alt="" class="img-fluid img-responsive">
                </div>

                <div class="gallery-image mt-4" >
                  <label for="input-27" class="col-form-label pt-4">Gallery Image</label>
                  <?php 
               $gallery_explode = explode(',', $vendor_details['ph_gallery_img']);
               for ($i=0; $i < count($gallery_explode); $i++){
                   ?>
                   <br>
                  <img src="../product-images/<?=$gallery_explode[$i]?>" alt="" class="img-fluid img-responsive" style="width: 50%;">
                  
                <?php } ?>
                </div>
          </div>


              </div>
              <hr>
          
 
          </form>
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

  <script src="assets/libs/datatables.net-keyTable/js/dataTables.keyTable.min.html"></script>
  <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>


    
</body>
</html>
