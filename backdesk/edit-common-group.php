<?php
include 'cores/comm-head.php';
$_SESSION['token'] = sha1(md5(time()));

$getid = $_GET['id'];
$getdataA = single_data("SELECT
*
FROM
group_fields
LEFT JOIN tbl_parent_category ON group_fields.p_cat_id = tbl_parent_category.p_cid
LEFT JOIN tbl_child_category ON group_fields.c_cat_id = tbl_child_category.tccid
WHERE group_fields.gf_id = '$getid'
");

$getdata = $getdataA['all_data'];
if (empty($getdataA['data'])) {
  header('location:common-group.php');
  
}

if (isset($_POST['insert'])) {
  extract($_POST);

$group_id;
delete("DELETE FROM group_fields WHERE gf_id = '$group_id' ");
  for ($i=0; $i < count($item_group); $i++) {
    // materials data store as json_encode
    if (!empty($material[$i])) {
      $material_data_ex = explode(',', $material[$i]);
    $material_data_js = json_encode($material_data_ex);
    }else{
      $material_data_js = NULL;
    }

    bind_insert('group_fields', ['p_cat_id' => $parent_cat_id,  'c_cat_id' => $child_cat_id,  'target_group' => $target_group[$i],  'item_data' => $item_group[$i], 'type_data' => $type_group[$i], 'material_data' => $material_data_js]);
  }
  echo '<script>alert("Common group updated");window.location.href="common-group.php";</script>';
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
    <title>New Common Group</title>
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
                  <div class="card-title text-primary text-center">Edit Common Group</div>
                  <hr>
      
                  <form action="" id="" method="post" enctype="multiple/form-data">
                    <input type="hidden" name="group_id" value="<?=$getdata['gf_id']?>">
                    <input type="hidden" value="<?=$_SESSION['token']?>" name="token">

                            <div class="row">
                         
                              <div class="form-group col-md-3">
                                <label for="input-27" class="col-form-label">Parent Category</label>
                                <select name="parent_cat_id" id="parent_categoryy" onchange="parent_category()" class="form-control removed-form-control-rounded">
                                  <option selected value="" disabled>select here</option>
                                  <?php
                                  $query = "SELECT * FROM tbl_parent_category ORDER BY p_cid DESC";
                                  $data = all_data($query);
                                  foreach($data['all_data'] as $key => $value){
                                  ?>
                                  <option value="<?=$value['p_cid'];?>" <?=($getdata['p_cid']==$value['p_cid']) ? 'selected':''?> ><?=$value['p_c_name'];?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div id="get_child_category" class="col-md-3" style="display: none;">
                              </div>


                              

                              </div> <!--  end row -->

                                <input type="hidden" id="count" value="0">
                                  <div class="group_field row">
                                      <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="" class="col-form-label">Target Group</label>
                                          <input type="text" class="form-control removed-form-control-rounded" name="target_group[]" value="<?=$getdata['target_group']?>">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="" class="col-form-label">Item</label>
                                          <input type="text" class="form-control removed-form-control-rounded" name="item_group[]" value="<?=$getdata['item_data']?>">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="" class="col-form-label">Type/ Style</label>
                                          <input type="text" class="form-control removed-form-control-rounded" name="type_group[]" value="<?=$getdata['type_data']?>">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                    <label for="" class="col-form-label">&nbsp;</label>
                                    <br>
                                      <a href="javaScript:void(0)" class="ml-2 btn btn-primary" onclick="add_more_field()"><i class="fa fa-plus"></i> Add More</a>
                                  </div>
                                
                                  <div class="col-md-9">
                                      <input type="text" class="form-control removed-form-control-rounded" name="material[]" placeholder="Material." value="<?=($getdata['material_data'] !='') ? implode(',', json_decode($getdata['material_data'])) : '';?>">
                                      <small class="text-danger">eg: tant, silk</small>
                                  </div>
                                  </div>

                              <div class="form-group col-md-4">
                                <label for="" class="col-form-label">&nbsp;</label>
                                <br>
                                <button type="submit" name="insert" class="btn btn-success shadow-dark btn-round" style="float:right;"><i class="icon-plus"></i> Add Now</button>
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
<script src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>


  $( document ).ready(function() {
   parent_category();
});


function add_more_field(){
var count = $('#count').val();
count++;
$('#count').val(count);

$('.group_field').append('<div class="group_id_'+count+' row"><div class="col-md-3"><div class="form-group"><label for="" class="col-form-label">Target Group</label><input type="text" class="form-control removed-form-control-rounded" name="target_group[]"></div></div><div class="col-md-3"><div class="form-group"><label for="" class="col-form-label">Item</label><input type="text" class="form-control removed-form-control-rounded" name="item_group[]"></div></div><div class="col-md-3"><div class="form-group"><label for="" class="col-form-label">Type/ Style</label><input type="text" class="form-control removed-form-control-rounded" name="type_group[]"></div></div><div class="col-md-1"><label for="" class="col-form-label">&nbsp;</label><br><a href="javaScript:void(0)" class="ml-2 btn btn-primary" onclick="add_more_field()"><i class="fa fa-plus"></i></a></div><div class="col-md-1"><label for="" class="col-form-label">&nbsp;</label><br><a href="javaScript:void(0)" class="ml-2 btn btn-danger" onclick="remove_more_field('+count+')"><i class="fa fa-minus"></i></a></div><div class="col-md-9"><input type="text" class="form-control removed-form-control-rounded" name="material[]" placeholder="Material."><small class="text-danger">eg: tant, silk</small></div></div>');

}

function remove_more_field(id){
    $('.group_id_'+id).remove();
    var count = $('#count').val();
count--;
$('#count').val(count);
}


function parent_category(){
var p_cat_id = document.getElementById("parent_categoryy").value;
$.ajax({
type: "post",
url: "cores/get-child-cat-data.php",
data: {
p_cat_id : p_cat_id,
c_id : '<?=$getdata['c_cat_id']?>',
},
success: function(data) {
$('#get_child_category').show();
$('#get_child_category').html(data);
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
url:'cores/new-product-ins.php',
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

</body>
</html>