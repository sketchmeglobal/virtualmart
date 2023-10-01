<?php
//include 'cores/comm-head.php';
$_SESSION['token'] = sha1(md5(time()));
$color_ret = all_data("SELECT * FROM `tbl_color` ORDER BY tcid DESC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>New Product</title>
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
     <!-- notifications css -->
  <link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css"/>
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
    <!-- <link href="assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="assets/css/feature-imgae.css">
    <link rel="stylesheet" href="assets/css/imageuploadify.min.css">
    <!-- <link rel="stylesheet" href="//www.jqueryscript.net/css/jquerysctipttop.css"> -->
    <style>
    .product_form_tab li{
    padding-left: 15px;
    padding-right: 15px;
    }
    .product_form_tab li a{
    padding:5px;
    }
    .product_form_tab a.active{
    background: #959595;
    font-size: 17px;
    border-radius: 5px;
    }
    .product_form_tab li a.active{
    color: #ffffff;
    }
    
    .disabled{
        pointer-events: none;
    }
/*  color dropdown list checking  */
<?php 
if ($color_ret['data'] == true) {
  foreach ($color_ret['all_data'] as $cl_bg_key => $color_val) {
    
    echo '
   #colors_bg .color_bg_'.++$cl_bg_key.'{background-color: '.$color_val['color_code'].' !important;padding:10px;}
    ';
  }
}

 ?>
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
                <div class="card-body">
                  <div class="card-title text-primary text-center">New Product</div>
                  <hr>
                  <ul class="nav nav-tabs product_form_tab pb-3 d-flex justify-content-center">
                    <li class="disabled"><a data-toggle="tab" href="#home" class="active show">Images</a></li>
                    <li class="disabled"><a data-toggle="tab" href="#menu1">Basic Details</a></li>
                    <li class="disabled"><a data-toggle="tab" href="#menu2">Description</a></li>
                    <li class="disabled"><a data-toggle="tab" href="#menu3">Pricing & Status</a></li>
                    <li class="disabled"><a data-toggle="tab" href="#menu4">Charges</a></li>
                  </ul>

                    <!-- tab-content -->
                    <div class="tab-content">
                      <!-- home -->
                      <div class="tab-pane in active" id="home">
                        <form class="" id="images" method="post" enctype="multiple/form-data">
                        <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                        <input type="hidden" value="" name="vendor_id">
                        <div class="row">
                          <div class="col-md-8 mb-5">
                            <input type="file" accept="png/image, jpg/image, jpeg/image, gif/image" multiple name="gallery_image[]" id="" required>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="">Feature Image</label>
                            <div class="drop-zone">
                              <span class="drop-zone__prompt">Drop file here or click to upload</span>
                              <input type="file" name="feature_img" id="feature_img" class="drop-zone__input" required>
                            </div>
                          </div>
                          <div class="form-group col-md-12">
                            <label for=""></label>
                            <a href="javaScript:void(0)" class="ml-2 btn btn-primary col-md-2" onclick="form_step(1)" style="float:right;"> Next</a>
                          </div>
                          </div><!-- end row -->
                        </form>
                          </div> <!-- end home tabe -->
                          <div id="menu1" class="tab-pane">
                            <form id="second_step">
                            <div class="row">
                              <!-- <div class="form-group col-md-3">
                                <label for="" class="col-form-label">Vendor Name</label>
                                <select name="vendor_id" id="vendor_id" class="form-control removed-form-control-rounded">
                                  <option selected value="" disabled>select here</option>
                                  <?php
                                  $query = "SELECT * FROM vendors
                                  JOIN users ON vendors.id = users.vendor_id
                                  WHERE users.status = 1 && users.id = '".$_SESSION['id']."'";
                                  $data = all_data($query);
                                  foreach($data['all_data'] as $key => $value){
                                  ?>
                                  <option value="<?=$value['id'];?>"><?=$value['company_name'];?></option>
                                  <?php } ?>
                                </select>
                              </div> -->
                              <div class="form-group col-md-3">
                                <label for="input-27" class="col-form-label">Parent Category</label>
                                <select name="parent_cat_id" id="parent_categoryy" onchange="parent_category()" class="form-control removed-form-control-rounded">
                                  <option selected value="" disabled>select here</option>
                                  <?php
                                  $query = "SELECT * FROM tbl_parent_category ORDER BY p_cid DESC";
                                  $data = all_data($query);
                                  foreach($data['all_data'] as $key => $value){
                                  ?>
                                  <option value="<?=$value['p_cid'];?>"><?=$value['p_c_name'];?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div id="get_child_category" class="col-md-3" style="display: none;">
                              </div>
                              <!-- <div id="get_target_group" class="col-md-3"> -->
                              <!-- </div> -->

                              <div class="form-group col-md-3">
                                <label for="input-27" class="col-form-label">Brand</label>
                                <select name="brand_id" id="product_brand" onchange="product_brand()" class="form-control removed-form-control-rounded">
                                  <option selected value="" disabled>select here</option>
                                  <?php 

                                  $brands = all_data("SELECT * FROM tbl_brands WHERE status = 1 ")['all_data'];
                                  if (!empty($brands)) {
                                    foreach ($brands as $brand_val) {
                                   ?>
                                   <option value="<?=$brand_val['id']?>"><?=$brand_val['brand_name']?></option>
                                 <?php } } ?>
                                  
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="input-26" class="col-form-label">Product Title</label>
                                <input type="text" name="title" class="form-control removed-form-control-rounded" id="title" placeholder="Enter Product Title" required>
                              </div>
                              <div class="col-md-6">
                                <br><br>
                                <label class="col-form-label"for="">&nbsp;</label>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-primary col-md-2" onclick="form_step(2)" style="float:right;"> Next</a>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-warning col-md-2" onclick="form_step_back(1)" style="float:right;"> Back</a>
                                
                              </div>
                              </div> <!--  end row -->
                              </form>
                              </div> <!-- end menu1 -->
                              
                              <div id="menu2" class="tab-pane">
                                <form id="third_sec">
                                <div class="row">
                                  <div class="form-group col-md-12">
                                <label for="input-26" class="col-form-label">Product Short Description</label>
                                <textarea name="editor1" required></textarea>
                              </div>
                              <div class="col-md-12">
                                <label for="input-26" class="col-form-label">Product Specifications</label>
                              </div>
                              <div class="form-group wrap_desc col-md-12">
                                <div class="group_fileds_cls">
                                  
                                </div>
                                <input type="hidden" id="p_desc_cnt" value="0">
                                <div class="form-group row">
                                  <input type="text" name="p_desc_head[]" class="ml-3 form-control removed-form-control-rounded col-md-4" id="" placeholder="Title" required value="Type">
                                  <input type="text" name="p_desc_data[]" class="ml-2 form-control removed-form-control-rounded col-md-4" id="" placeholder="Detail" required>
                                  <a href="javaScript:void(0)" class="ml-2 btn btn-primary col-md-2" onclick="add_more_desc()"><i class="fa fa-plus"></i> Add More</a>
                                </div>
                                
                              </div>
                              <div class="col-md-12">
                                <a href="javaScript:void(0)" class="ml-2 btn btn-info col-md-2" onclick="form_step(3)" style="float:right;"> Next</a>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-warning col-md-2" onclick="form_step_back(2)" style="float:right;"> Back</a>
                                
                              </div>
                                </div> <!-- end row -->
                              </form>
                              </div> <!-- end menu2 -->
                              <div id="menu3" class="tab-pane">
                                <form id="forth_sec">
                                <div class="row wrap_price">
                                <div class="form-group col-md-2">
                                <label for="input-26" class="col-form-label">Price</label>
                                <input type="text" name="price[]" class="form-control removed-form-control-rounded" id="" placeholder="" required>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="input-26" class="col-form-label">DP</label>
                                <input type="text" name="dp[]" class="form-control removed-form-control-rounded" id="" placeholder="" required>
                              </div>
                              <div class="form-group col-md-1">
                                <label for="input-26" class="col-form-label">Stock</label>
                                <input type="text" name="opening_stock[]" class="form-control removed-form-control-rounded" id="" placeholder="" required>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="input-26" class="col-form-label">Color</label>
                                <input type="color" name="color[]" class="form-control removed-form-control-rounded" value="#ffffff">
                              </div>
                              <div class="form-group col-md-2">
                                <label for="input-26" class="col-form-label">Size</label>
                                 <select name="size[]" class="form-control removed-form-control-rounded" id="">
                                     <option value="NULL">No size</option>
                               <?php 
                                  $size_ret = all_data("SELECT * FROM `tbl_size` ORDER BY tsid DESC");
                                  if ($size_ret['data']==true) {
                                    foreach($size_ret['all_data'] as $sd){
                                 ?>
                                  <option value="<?=$sd['size_name']?>"><?=$sd['size_name']?></option>
                                  <?php }} ?>
                                </select>
                              </div>
                              <div class="form-group col-md-1">
                                <label for="input-26" class="col-form-label">QTY.</label>
                                <input type="text" name="qty[]" class="form-control removed-form-control-rounded" id="" placeholder="" required>
                              </div>
                              <div class="col-md-2">
                                <br>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-success col-md-1" onclick="add_more_price()"><i class="fa fa-plus"></i></a>
                              </div>
                            </div>

                           <div class="row">
                              <input type="hidden" id="wrap_price_val" value="">
                              <div class="col-md-12">
                              <a href="javaScript:void(0)" class="ml-2 btn btn-info col-md-2" onclick="form_step(4)" style="float:right;"> Next</a>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-warning col-md-2" onclick="form_step_back(3)" style="float:right;"> Back</a>
                              </div>
                                </div> <!-- end row -->
                              </form>
                              </div> <!-- end menu3 -->

                               <div id="menu4" class="tab-pane">
                                <form id="last">
                                <div class="row">
                                  
                                  <div class="form-group col-md-3">
                                    <label for="input-26" class="col-form-label">Shipping</label>
                                    <input type="text" name="shipping_charges" class="form-control removed-form-control-rounded" id="" placeholder="" required value="">
                                  </div>

                              <div class="form-group col-md-4">
                                <label for="input-26" class="col-form-label">Tax (%)</label>
                                <select name="product_tax" class="form-control" id="">
                                  <option value="2.5">2.5</option>
                                  <option value="5">5</option>
                                  <option value="9">9</option>
                                  <option value="14">14</option>
                                </select>
                                
                              </div>
                                </div> <!-- end row -->
                                <div class="row">
                                  <div class="form-group col-md-4">
                                <label for="input-27" class="col-form-label">Product Status</label>
                                <select name="product_status" id="" class="form-control removed-form-control-rounded" required>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="" class="col-form-label">&nbsp;</label>
                                <br>
                                <a onclick="form_step(5)" class="btn btn-success shadow-dark btn-round" style="float:right;"><i class="icon-plus"></i> Add Now</a>
                              </div>
                              <div class="form-group col-md-2">
                                 <label for="" class="col-form-label">&nbsp;</label>
                                <br>
                              <a href="javaScript:void(0)" class="ml-2 btn btn-warning" onclick="form_step_back(4)" style="float:right;"> Back</a>
                                </div> <!-- end row -->
                              </div><!-- end menu4 -->
                              </form>
                              </div> <!-- end tab-content -->
                              
                            
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
<!-- <script src="assets/js/waves.js"></script> -->
<!-- sidebar-menu js -->
<script src="assets/js/sidebar-menu.js"></script>
<!-- Custom scripts -->
<script src="assets/js/app-script.js"></script>
<script src="assets/js/feature-imgae.js"></script>
<script src="assets/js/imageuploadify.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!--notification js -->
  <script src="assets/plugins/notifications/js/lobibox.min.js"></script>
  <script src="assets/plugins/notifications/js/notifications.min.js"></script>
  <script src="assets/plugins/notifications/js/notification-custom-script.js"></script>
<script src="assets/js/vendor-form.js?v=<?=time()?>"></script>

<script>
  function add_more_price() {

var wrap_price_id = $('#wrap_price_val').val();
wrap_price_id++;
$('#wrap_price_val').val(wrap_price_id);

$('.wrap_price').append('<div class="row" id="price_remove_'+wrap_price_id+'"><div class="form-group col-md-2"><label for="input-26" class="col-form-label">Price</label><input type="text" name="price[]" class="form-control removed-form-control-rounded" id="" placeholder="" required></div><div class="form-group col-md-2"><label for="input-26" class="col-form-label">DP</label><input type="text" name="dp[]" class="form-control removed-form-control-rounded" id="" placeholder="" required></div><div class="form-group col-md-1"><label for="input-26" class="col-form-label">Stock</label><input type="text" name="opening_stock[]" class="form-control removed-form-control-rounded" id="" placeholder="" required></div><div class="form-group col-md-2"><label for="input-26" class="col-form-label">Color</label><input type="color" name="color[]" value="#ffffff" class="form-control removed-form-control-rounded"></div><div class="form-group col-md-2"><label for="input-26" class="col-form-label">Size</label><select name="size[]" class="form-control removed-form-control-rounded" id=""><option value="NULL">no size</option><?php 
                                  $size_ret = all_data("SELECT * FROM `tbl_size` ORDER BY tsid DESC");
                                  if ($size_ret['data']==true) {
                                    foreach($size_ret['all_data'] as $sd){
                                 ?><option value="<?=$sd['size_name']?>"><?=$sd['size_name']?></option><?php }} ?></select></div><div class="form-group col-md-1"><label for="input-26" class="col-form-label">QTY.</label><input type="text" name="qty[]" class="form-control removed-form-control-rounded" id="" placeholder=""></div><div class="col-md-2"><br><a href="javaScript:void(0)" class="ml-2 btn btn-success col-md-1" onclick="add_more_price()"><i class="fa fa-plus"></i></a><a href="javaScript:void(0)" class="ml-2 btn btn-danger col-md-1" onclick="remove_price('+wrap_price_id+')"><i class="fa fa-minus"></i></a></div></div>');

}

function remove_price(id) {
  var wrap_price_id = $('#wrap_price_id').val();
--wrap_price_id;
$('#wrap_price_id').val(wrap_price_id);
$('#price_remove_'+id).remove();
}
</script>
</body>
</html>