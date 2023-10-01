<?php
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5(time()));
$pid = $_GET['id'];
$query = "SELECT * FROM tbl_product_hdr WHERE phid=$pid";
$all_products = all_data($query);
// echo '<pre>', print_r($all_products), '</pre>';
$query = "SELECT * FROM tbl_product_dtl WHERE product_id=$pid";
$all_product_images = all_data($query);
// echo '<pre>', print_r($all_product_images), '</pre>';
if($all_products['data'] == NULL){
echo '<pre>', print_r($all_products), '</pre>';
die('Severe Error! Contact admin with the error message above.');
}
$c_cat_id = $all_products['all_data'][0]['c_cat_id'];
$apd = $all_products['all_data'][0];
$apimages = $all_product_images['all_data'];
$json_product_details = json_decode($apd['ph_desc']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Product Edit</title>
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
           <div class="card-title text-primary text-center">
              <p>Edit Product</p>
              <p class="bg-success p-1 text-right d-table text-light">Opening Stock: <?=$apd['opening_stock']?></p>
            </div>
           <hr>

            <form class="row" id="new_product" method="post" enctype="multiple/form-data">
              <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
              <input type="hidden" value="<?=$pid?>" name="productId">

              <div class="col-md-8 mb-5">
                <input type="file" accept="png/image, jpg/image, jpeg/image, gif/image" multiple name="gallery_image[]" id="" required>

                 <?php
                $string = $apimages[0]['pd_images'];
                $arr = explode(',', $string);
              
              foreach($arr as $api){
              ?>
                <img style="height: 100px;width: 100px;object-fit: contain;" src="../product-images/<?=$api?>" alt="" class="" />
              <?php
              }
              ?>
              </div>

              <div class="form-group col-md-4 ">
            <label for="">Feature Image</label>
            <div class="drop-zone">
            <span class="drop-zone__prompt">Drop file here or click to upload</span>
            <input type="file" name="feature_img" id="feature_img" class="drop-zone__input" required>
          </div>
          <img style="height: 150px;margin-top: 5px;" src="../product-images/<?=$apd['ph_feature_img']?>" alt="" class="" />
          </div>



              <input type="hidden" value="<?=$_SESSION['token']?>" name="token">

              <div class="form-group col-md-3">
                <label for="" class="col-form-label">Vendor Name</label>
                <select name="vendor_id" id="vendor_id" class="form-control removed-form-control-rounded">
                              <?php

                              $query = "SELECT vendors.id AS id, vendors.company_name AS company_name FROM vendors 
                              JOIN users ON vendors.id = users.vendor_id
                              WHERE users.status = 1 && users.id = '".$_SESSION['id']."'";

                                $data = all_data($query);

                                foreach($data['all_data'] as $key => $value){

                                ?>

                                  <option value="<?=$value['id'];?>" <?= ($value['id'] == $apd['vendor_id'] ? 'selected' : '') ?>><?=$value['company_name'];?></option>

                               <?php } ?>

                      </select>
              </div>

            <div class="form-group col-md-3">

            <label for="input-27" class="col-form-label">Parent Category</label>

              <select name="parent_cat_id" id="parent_categoryy" onchange="parent_category()" class="form-control removed-form-control-rounded">
                
                      <?php

                      $query = "SELECT * FROM tbl_parent_category ORDER BY p_cid DESC";

                        $data = all_data($query);

                        foreach($data['all_data'] as $key => $value){

                        ?>

                          <option <?= ($value['p_cid'] == $apd['p_cat_id'] ? 'selected' : '') ?> value="<?=$value['p_cid'];?>"><?=$value['p_c_name'];?></option>

                       <?php } ?>

              </select>

          </div>

          <div id="get_child_category" class="col-md-3" style="display: none;">

          </div>

                      <div class="form-group col-md-3">

            <label for="input-27" class="col-form-label">Brand</label>

              <select name="product_brand" id="product_brand" onchange="product_brand()" class="form-control removed-form-control-rounded">

                <option selected value="" disabled>select here</option>
                <!-- <option value=""></option> -->

              </select>

          </div>


           <div class="form-group col-md-6">

            <label for="input-26" class="col-form-label">Product Title</label>

            <input type="text" value="<?=$apd['ph_title']?>" name="title" class="form-control removed-form-control-rounded" id="title" placeholder="Enter Product Title" required>

          </div>

          <div class="form-group col-md-3">

            <label for="input-26" class="col-form-label"> Opening Stock</label>

                  <input min=1 type="number" name="opening_stock" class="form-control removed-form-control-rounded" placeholder="Product Opening Stock" required value="<?=$apd['opening_stock']?>">

          </div>

          <div class="form-group col-md-3">

            <label for="input-26" class="col-form-label"> Quantity</label>

                  <input type="number" name="qty" class="form-control removed-form-control-rounded" placeholder="Product Quantity" required value="<?=$apd['ph_qty']?>">

          </div>

          <div class="form-group col-md-3">
            <label for="input-26" class="col-form-label">Product Price</label>
                  <input type="text" name="price" class="form-control removed-form-control-rounded" placeholder="Product Price" required value="<?=$apd['ph_price']?>">
          </div>


          <div class="form-group col-md-2">
            <label for="input-26" class="col-form-label">Product DP</label>
                  <input type="text" name="dp" class="form-control removed-form-control-rounded" placeholder="Product DP" required value="<?=$apd['ph_dp']?>">
          </div>
          <div class="form-group col-md-3">
            <label for="input-26" class="col-form-label">Shipping Charges</label>
                  <input type="text" name="shipping_charges" class="form-control removed-form-control-rounded" placeholder="Product shipping charges" required value="<?=$apd['ph_shipping_charge']?>">
          </div>
          <div class="form-group col-md-2">
            <label for="input-26" class="col-form-label">TAX (%)</label>
                  <input type="text" name="tax" class="form-control removed-form-control-rounded" placeholder="Product tax" required value="<?=$apd['ph_tax']?>">
          </div>
          <div class="form-group col-md-2">
            <label for="input-26" class="col-form-label">Bonus (%)</label>
                  <input type="text" name="bonus" class="form-control removed-form-control-rounded" placeholder="Product bonus" required value="<?=$apd['ph_bonus']?>">
          </div>

          <div class="form-group col-md-12">
            <label for="input-26" class="col-form-label">Product Short Description</label>
                  <textarea name="editor1" required><?=$apd['ph_short_desc']?></textarea>
          </div>

          <div class="col-md-12">
           <label for="input-26" class="col-form-label">Product Specifications</label>
          </div>
          <div class="form-group wrap_desc col-md-12 ">
            
            <?php
            $inc_det = 0;
                foreach ($json_product_details as $key => $val) {
                ?>

                <div class="form-group row" id="p_des_remove_<?=$inc_det?>">

                  <input type="text" name="p_desc_head[]" class="ml-3 form-control removed-form-control-rounded col-md-4" id="" placeholder="Title" required value="<?=$key?>">

                  <input type="text" name="p_desc_data[]" class="ml-2 form-control removed-form-control-rounded col-md-4" id="" placeholder="detail" required value="<?=$val?>">

                  <a href="javaScript:void(0)" class="ml-2 btn btn-primary col-md-1" onclick="add_more_desc()"><i class="fa fa-plus"></i></a>
                  <?php if($inc_det>0): ?>
                  <a href="javaScript:void(0)" class="ml-2 btn btn-danger col-md-1" onclick="p_des_remove(<?=$inc_det?>)"><i class="fa fa-close"></i></a>
                <?php endif; ?>
                </div>

                <?php $inc_det++; } ?>


            <input type="hidden" id="p_desc_cnt" value="<?=$inc_det?>">
          </div>

          <div class="form-group col-md-4">
            <label for="input-27" class="col-form-label">Product Status</label>
              <select name="product_status" id="" class="form-control removed-form-control-rounded" required>
                <option value="1" <?= ($apd['ph_status'] == 1 ? 'selected' : '') ?>>Active</option>
                <option value="0" <?= ($apd['ph_status'] == 0 ? 'selected' : '') ?>>Inactive</option>
              </select>
          </div>

          <div class="form-group col-md-4">
            <label for="" class="col-form-label">&nbsp;</label>
            <br>
            <button type="submit" name="insert" class="btn btn-success shadow-dark btn-round" style="float:right;"><i class="icon-plus"></i> Add Now</button>
          </div>


          

          <div class="form-group col-md-4">
            <label for="" class="col-form-label">&nbsp;</label>
            <br>

            <a href="child-category.php" class="btn btn-warning" style="float:right;"><-Back</a>

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
    CKEDITOR.replace('editor1');
    // CKEDITOR.replace('editor2');
  </script>

  <script>

$(document).ready(function() {
  $('input[type="file"]').imageuploadify();
})


  function parent_category(){
  var p_cat_id = document.getElementById("parent_categoryy").value;
  
  $.ajax({
  type: "post",
  url: "cores/get-child-cat-data.php",
  data: {
  p_cat_id : p_cat_id,
  },
  success: function(data) {
    $('#get_child_category').show();
  $('#get_child_category').html(data);
  },
  complete: function(data){
  var c_cat_id = <?=$c_cat_id?>;
  $("#get_child_category select").val(c_cat_id)
  }
  });
  }


  function add_more_desc(){
    var p_inc_id = $('#p_desc_cnt').val();
    p_inc_id++;
    $('#p_desc_cnt').val(p_inc_id);
    $('.wrap_desc').append('<div class="form-group row" id="p_des_remove_'+p_inc_id+'"><input type="text" name="p_desc_head[]" class="ml-3 form-control removed-form-control-rounded col-md-4" id="" placeholder="Title" required value=""><input type="text" name="p_desc_data[]" class="ml-2 form-control removed-form-control-rounded col-md-4" id="" placeholder="detail" required><a href="javaScript:void(0)" class="ml-2 btn btn-primary col-md-1" onclick="add_more_desc()"><i class="fa fa-plus"></i></a><a href="javaScript:void(0)" class="ml-2 btn btn-danger col-md-1" onclick="p_des_remove('+p_inc_id+')"><i class="fa fa-close"></i></a></div>');
    }

    function p_des_remove(id){
      var p_inc_id = $('#p_desc_cnt').val();
      --p_inc_id;
      $('#p_desc_cnt').val(p_inc_id);
      $('#p_des_remove_'+id).remove();
    }

$("#new_product").validate({
  submitHandler: function(form) {
    var form = $('#new_product')[0];
  var formData = new FormData(form);
    jQuery.ajax({
        url:'cores/vendor-product-update.php',
        type:'post',
        data:formData,
        contentType: false,
        processData: false,
        success:function(result){
          console.log(result);
          var r_decode = JSON.parse(result);
          if(r_decode.status !=true){
            swal({title: r_decode.msg,icon: "error",});
            
          }else{
            swal({title: 'Product added',icon: "success",});
            //$('#new_product')[0].reset();
          }
        }
      });
  }
 });
</script>

  <script>
  
  $(window).load(function(){
  // fetch product details
  var pid= $.trim(parseInt(<?=$pid?>));
  $('#parent_categoryy').trigger('change');
  })
  
  $('.delete').on('click', function(e){
  $iid = $(this).data('id');
  $iname= $(this).data('name');
  $this = $(this);
  
  $.ajax({
  type: "post",
  url: "cores/delete-product-image.php",
  data: {
  iid : $iid,
  name : $iname
  },
  success: function(data) {
  $this.closest('div').remove()
  alert('Image Deleted Successfully');
  }
  });
  })
  
  </script>


</body>

</html>

