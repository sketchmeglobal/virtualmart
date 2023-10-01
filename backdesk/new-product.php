<?php
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
    <title>New Product</title>
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
                <div class="card-body">
                  <div class="card-title text-primary text-center">New Product</div>
                  <hr>
                  <form action="cores/new-product-ins.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                    <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>'?>
                    
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Vendor Name</label>
                      <div class="col-sm-6">
                        <select name="vendor_id" id="vendor_id" class="form-control form-control-rounded">
                          <option selected value="" disabled>select here</option>
                          <?php
                          $query = "SELECT * FROM vendors WHERE status = 1 ORDER BY company_name";
                          $data = all_data($query);
                          foreach($data['all_data'] as $key => $value){
                          ?>
                          <option value="<?=$value['id'];?>"><?=$value['company_name'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Parent Category</label>
                      <div class="col-sm-6">
                        <select name="parent_cat_id" id="parent_categoryy" onchange="parent_category()" class="form-control form-control-rounded">
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
                    </div>
                    <div id="get_child_category">
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Product Title</label>
                      <div class="col-sm-6">
                        <input type="text" name="title" class="form-control form-control-rounded" id="input-26" placeholder="Enter Product Title">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Product Short Description</label>
                      <div class="col-sm-6">
                        <textarea name="editor1"></textarea>
                      </div>
                    </div>
                    <div class="row py-3">
                      <h4>Product Description</h4>
                    </div>
                    <div class="wrap_desc">
                      <div class="form-group row">
                        <input type="text" name="p_desc_head[]" class="form-control form-control-rounded col-sm-6" id="input-26" placeholder="" required value="Model Number">
                        <div class="col-sm-6">
                          <input type="text" name="p_desc_data[]" class="form-control form-control-rounded" id="input-26" placeholder="" required>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="p_desc_cnt" value="0">
                    <a href="javaScript:void(0)" class="btn btn-primary" onclick="add_more_desc()"><i class="fa fa-plus"></i></a>
                    <hr>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Product Price/ MRP</label>
                      <div class="col-sm-6">
                        <input type="text" name="price" class="form-control form-control-rounded" placeholder="Product Price" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Product DP</label>
                      <div class="col-sm-6">
                        <input type="text" name="dp" class="form-control form-control-rounded" placeholder="Product dp" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Shipping Charges</label>
                      <div class="col-sm-6">
                        <input type="text" name="shipping_charges" class="form-control form-control-rounded" placeholder="Product shipping charges" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">TAX (%)</label>
                      <div class="col-sm-6">
                        <input type="text" name="tax" class="form-control form-control-rounded" placeholder="Product tax" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Bonus (%)</label>
                      <div class="col-sm-6">
                        <input type="text" name="bonus" class="form-control form-control-rounded" placeholder="Product bonus" required>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Feature Image</label>
                      <div class="col-sm-6">
                        <input type="file" name="feature_img" class="form-control form-control-rounded" placeholder="Product Price" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label">Gallery Images <a href="javaScript:void(0)" class="btn btn-sm btn-outline-info btn-info" onclick="add_more()"><i class="fa fa-plus"></i></a></label>
                      <input type="hidden" id="gallery_img_count" value="">
                      <div class="col-sm-6 wrap">
                        <input type="file" name="gallery_image[]" class="form-control form-control-rounded">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label"> Opening Stock</label>
                      <div class="col-sm-6">
                        <input min=1 type="number" name="opening_stock" class="form-control form-control-rounded" placeholder="Product Opening Stock">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="input-26" class="col-sm-6 col-form-label"> Quantity</label>
                      <div class="col-sm-6">
                        <input type="number" name="qty" class="form-control form-control-rounded" placeholder="Product Quantity">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="input-27" class="col-sm-6 col-form-label">Product Status</label>
                      <div class="col-sm-6">
                        <select name="product_status" id="" class="form-control form-control-rounded">
                          <option value="1">Active</option>
                          <option value="0">Deactive</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 d-flex justify-content-center">
                        <button type="submit" name="insert" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Add Now</button>
                      </div>
                    </div>
                    <div class="" style="float: right;">
                      <a href="all-products.php" class="btn btn-success"><-Back</a>
                    </div>
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
          <script>
          CKEDITOR.replace( 'editor1' );
          CKEDITOR.replace( 'editor2' );
          </script>
          <script>
          function add_more(){
          var inc_id = $('#gallery_img_count').val();
          inc_id++;
          $('#gallery_img_count').val(inc_id);
          $('.wrap').append('<div style="display:flex" id="remove_'+inc_id+'"><input type="file" name="gallery_image[]" class="form-control form-control-rounded m-1" style="width:85%"><a href="javascript:void(0)" onclick="remove('+inc_id+')" style="font-size:20px;color:red;margin-top:1.6%">X</a></div>');
          }
          function remove(id){
          $('#remove_'+id).remove();
          var inc_id = $('#gallery_img_count').val();
          --inc_id;
          $('#gallery_img_count').val(inc_id);
          }
          function parent_category(){
          var p_cat_id = document.getElementById("parent_categoryy").value;
          $.ajax({
          type: "post",
          url: "cores/get-child-cat-data.php",
          data: {
          p_cat_id : p_cat_id,
          },
          success: function(data) {
          $('#get_child_category').html(data);
          }
          });
          }
          function add_more_desc(){
          var p_inc_id = $('#p_desc_cnt').val();
          p_inc_id++;
          $('#p_desc_cnt').val(p_inc_id);
          $('.wrap_desc').append('<div class="form-group row" id="p_des_remove_'+p_inc_id+'"><a href="javascript:void(0)" onclick="p_des_remove('+p_inc_id+')" style="font-size:20px;color:red;margin-top:0.6%;margin-left: 4%;padding-right: 3%;">X</a><input type="text" name="p_desc_head[]" class="form-control form-control-rounded col-sm-5" id="input-26" placeholder="Title" value="" style="width:85%" required><div class="col-sm-6"><input type="text" name="p_desc_data[]" class="form-control form-control-rounded" id="input-26" placeholder="Description" required></div></div>');
          }
          function p_des_remove(id){
          var p_inc_id = $('#p_desc_cnt').val();
          --p_inc_id;
          $('#p_desc_cnt').val(p_inc_id);
          $('#p_des_remove_'+id).remove();
          }
          </script>
        </body>
      </html>