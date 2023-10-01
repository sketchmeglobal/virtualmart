<?php
//include 'cores/comm-head.php';
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
                  <div class="card-title text-primary text-center">Product Edit - <b class="text-warning">Bhagalpuri Art Silk Saree</b></div>
                  <hr>
                  <ul class="nav nav-tabs product_form_tab pb-3 d-flex justify-content-center">
                    <li><a data-toggle="tab" href="#home" class="active show">Images</a></li>
                    <li><a data-toggle="tab" href="#menu1">Basic Details</a></li>
                    <li><a data-toggle="tab" href="#menu2">Description</a></li>
                    <li><a data-toggle="tab" href="#menu3">Pricing & Status</a></li>
                    <li><a data-toggle="tab" href="#menu4">Charges</a></li>

                  </ul>
                  
                  <form class="" id="new_product" method="post" enctype="multiple/form-data">
                    <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
                    <!-- tab-content -->
                    <div class="tab-content">
                      <!-- home -->
                      <div class="tab-pane in active" id="home">
                        <div class="row">
                          <div class="col-md-8 mb-5">
                            <b>Gallery Images</b>
                            <br>
                            <?php 
                            for ($i=1; $i <= 3; $i++) {
                            ?>
                            <img src="../product-images/img<?=$i?>.png" alt="" style="width: 20%;">
                            <?php } ?>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="">Feature Image</label>
                            <br>
                            <img src="../product-images/img4.png" alt="" style="width: 45%;">
                          </div>
                          <div class="form-group col-md-12">
                            <label for=""></label>
                            <a href="javaScript:void(0)" class="ml-2 btn btn-primary col-md-2" onclick="form_step(1)" style="float:right;"> Next</a>
                          </div>
                          </div><!-- end row -->
                          </div> <!-- end home tabe -->
                          <div id="menu1" class="tab-pane">
                            <div class="row">
                            
                              <div class="form-group col-md-3">
                                <label for="input-27" class="col-form-label">Parent Category</label>
                                <select name="parent_cat_id" id="parent_categoryy" class="form-control removed-form-control-rounded">
                                  <option selected value="" disabled>select here</option>
                                  <?php
                                  $query = "SELECT * FROM tbl_parent_category ORDER BY p_cid DESC";
                                  $data = all_data($query);
                                  foreach($data['all_data'] as $key => $value){
                                  ?>
                                  <option <?= ($value['p_cid']==1)? 'selected':'' ?> value="<?=$value['p_cid'];?>"><?=$value['p_c_name'];?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="form-group col-md-3">
                                <label for="input-27" class="col-form-label">Child Category</label>
                                <select name="parent_cat_id" id="parent_categoryy" class="form-control removed-form-control-rounded">
                               
                                  <?php
                                  $q1 = "SELECT * FROM tbl_child_category ORDER BY tccid DESC";
                                  $d1 = all_data($q1);
                                  foreach($d1['all_data'] as $k1 => $v1){
                                  ?>
                                  <option <?= ($v1['tccid']==1)? 'selected':'' ?> value="<?=$v1['tccid'];?>"><?=$v1['tc_name'];?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="form-group col-md-3">
                                <label for="input-27" class="col-form-label">Brand</label>
                                <select name="product_brand" id="product_brand" onchange="product_brand()" class="form-control removed-form-control-rounded">
                                  <option selected value="" disabled>select here</option>
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="input-26" class="col-form-label">Product Title</label>
                                <input type="text" name="title" class="form-control removed-form-control-rounded" id="title" placeholder="Enter Product Title" required value="Bhagalpuri Art Silk Saree">
                              </div>
                              <div class="col-md-6">
                                <br><br>
                                <label class="col-form-label"for="">&nbsp;</label>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-primary col-md-2" onclick="form_step(2)" style="float:right;"> Next</a>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-warning col-md-2" onclick="form_step_back(1)" style="float:right;"> Back</a>
                                
                              </div>
                              </div> <!--  end row -->
                              </div> <!-- end menu1 -->
                              
                              <div id="menu2" class="tab-pane">
                                <div class="row">
                                  <div class="form-group col-md-12">
                                <label for="input-26" class="col-form-label">Product Short Description</label>
                                <textarea name="editor1" required>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam repellendus iure nihil repellat vero dicta voluptates iusto at, suscipit sint ea pariatur distinctio quod earum quis, velit unde. Velit, ratione?</textarea>
                              </div>
                              <div class="col-md-12">
                                <label for="input-26" class="col-form-label">Product Specifications</label>
                              </div>
                              <div class="form-group wrap_desc col-md-12 ">
                                <input type="hidden" id="p_desc_cnt" value="0">
                                <?php 
                                $p_des = [
                                  ['Material', 'Silk'],
                                  ['Type', 'Traditional/Fashion/Moderate'],
                                  ['Model Number', '154897'],
                                ];
                                foreach ($p_des as $v2) {
                                ?>
                                <div class="form-group row">
                                  <input type="text" name="p_desc_head[]" class="ml-3 form-control removed-form-control-rounded col-md-4" id="" placeholder="Title" required value="<?=$v2[0]?>">
                                  <input type="text" name="p_desc_data[]" class="ml-2 form-control removed-form-control-rounded col-md-4" id="" placeholder="Detail" required value="<?=$v2[1]?>">
                                  <!-- <a href="javaScript:void(0)" class="ml-2 btn btn-primary col-md-2" onclick="add_more_desc()"><i class="fa fa-plus"></i> Add More</a> -->
                                </div>
                              <?php } ?>
                              </div>
                              <div class="col-md-12">
                                <a href="javaScript:void(0)" class="ml-2 btn btn-info col-md-2" onclick="form_step(3)" style="float:right;"> Next</a>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-warning col-md-2" onclick="form_step_back(2)" style="float:right;"> Back</a>
                                
                              </div>
                                </div> <!-- end row -->
                              </div> <!-- end menu2 -->
                              <div id="menu3" class="tab-pane">
                                <?php 
                                $price = [
                                  ['350.00','300.00','30','Multicolor','5.5m','10'],
                                  ['340.00','310.00','20','White','5.5m','15'],
                                  ['370.00','325.00','45','Pink','5.5m','20'],
                                ];
                                foreach ($price as $k3 => $v3) {
                                ?>
                                <div class="row wrap_price">
                                <div class="form-group col-md-2">
                                <label for="input-26" class="col-form-label">Price</label>
                                <input type="text" name="price[]" class="form-control removed-form-control-rounded" id="" placeholder="" required value="<?=$v3[0]?>">
                              </div>
                              <div class="form-group col-md-2">
                                <label for="input-26" class="col-form-label">DP</label>
                                <input type="text" name="dp[]" class="form-control removed-form-control-rounded" id="" placeholder="" required value="<?=$v3[1]?>">
                              </div>
                              <div class="form-group col-md-1">
                                <label for="input-26" class="col-form-label">Stock</label>
                                <input type="text" name="opening_stock[]" class="form-control removed-form-control-rounded" id="" placeholder="" required value="<?=$v3[2]?>">
                              </div>
                              <div class="form-group col-md-2">
                                <label for="input-26" class="col-form-label">Color</label>
                                <input type="text" name="color[]" class="form-control removed-form-control-rounded" id="" placeholder="" required value="<?=$v3[3]?>">
                              </div>
                              <div class="form-group col-md-1">
                                <label for="input-26" class="col-form-label">Size</label>
                                <input type="text" name="size[]" class="form-control removed-form-control-rounded" id="" placeholder="" required value="<?=$v3[4]?>">
                              </div>
                              <div class="form-group col-md-1">
                                <label for="input-26" class="col-form-label">QTY.</label>
                                <input type="text" name="qty[]" class="form-control removed-form-control-rounded" id="" placeholder="" required value="<?=$v3[5]?>">
                              </div>
                                <div class="form-group col-md-2">
                                
                                <!-- <a href="javaScript:void(0)" class="ml-2 btn btn-success col-md-1" onclick="add_more_price()"><i class="fa fa-plus"></i></a> -->
                              </div>
                            </div>
                          <?php } ?>
                            <div class="row">
                              <input type="hidden" id="wrap_price_val" value="">

                              
                              
                              <div class="col-md-12">
                              <a href="javaScript:void(0)" class="ml-2 btn btn-info col-md-2" onclick="form_step(4)" style="float:right;"> Next</a>
                                <a href="javaScript:void(0)" class="ml-2 btn btn-warning col-md-2" onclick="form_step_back(3)" style="float:right;"> Back</a>
                                
                                
                              </div>
                                </div> <!-- end row -->
                              </div> <!-- end menu3 -->

                              <div id="menu4" class="tab-pane">
                                <div class="row">
                                  <div class="form-group col-md-3">
                                <label for="input-26" class="col-form-label">Shipping</label>
                                <input type="text" name="" class="form-control removed-form-control-rounded" id="" placeholder="" required value="50.00">
                              </div>

                              <div class="form-group col-md-4">
                                <label for="input-26" class="col-form-label">Tax (%)</label>
                                <select name="" class="form-control" id="">
                                  <option value="">2.5</option>
                                  <option value="">5</option>
                                  <option value="">9</option>
                                  <option value="">12</option>
                                </select>
                                
                              </div>

                              <div class="form-group col-md-2">
                                <label for="input-26" class="col-form-label">Bonus(%)</label>
                                <input type="text" name="" class="form-control removed-form-control-rounded" id="" placeholder="" required value="1">
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
                                <button type="submit" name="insert" class="btn btn-success shadow-dark btn-round" style="float:right;"><i class="icon-plus"></i> Update Now</button>
                              </div>
                              <div class="form-group col-md-2">
                                 <label for="" class="col-form-label">&nbsp;</label>
                                <br>
                              <a href="javaScript:void(0)" class="ml-2 btn btn-warning" onclick="form_step_back(4)" style="float:right;"> Back</a>
                                </div> <!-- end row -->
                              </div><!-- end menu4 -->


                              </div> <!-- end tab-content -->
                              
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
<script>


function form_step($id){
if ($id == 1) {
$('ul.product_form_tab li a[href="#menu1"]').click();
}else if($id == 2){
$('ul.product_form_tab li a[href="#menu2"]').click();
}else if($id == 3){
$('ul.product_form_tab li a[href="#menu3"]').click();
}else if($id == 4){
$('ul.product_form_tab li a[href="#menu4"]').click();
}
}
function form_step_back($id){
if ($id == 1) {
$('ul.product_form_tab li a[href="#home"]').click();
}else if($id == 2){
$('ul.product_form_tab li a[href="#menu1"]').click();
}else if($id == 3){
$('ul.product_form_tab li a[href="#menu2"]').click();
}else if($id == 4){
$('ul.product_form_tab li a[href="#menu3"]').click();
}
}
CKEDITOR.replace('editor1');
// CKEDITOR.replace('editor2');
</script>

</body>
</html>