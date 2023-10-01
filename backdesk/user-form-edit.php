<?php 
include 'cores/comm-head.php';
$_SESSION['msg']='';
$_SESSION['token'] = sha1(md5('admin'));

$uid = $_GET['id'];

$query = "SELECT * FROM users WHERE id=$uid";
$all_users = all_data($query);
// echo '<pre>', print_r($all_users), '</pre>';

if($all_users['data'] == NULL){
    echo '<pre>', print_r($all_users), '</pre>';
    die('Severe Error! Contact admin with the error message above.');    
}

$user_details = $all_users['all_data'][0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Edit User</title>
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

<!--User details-->


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
           <div class="card-title text-primary text-center">Edit User</div>
           <hr>
            <form action="cores/new-user-edit.php" method="post" enctype="multipart/form-data">
              
              <input type="hidden" value="<?=$_SESSION['token']?>" name="token">
              <input type="hidden" value="<?=$uid?>" name="UserId">
              
              <?='<p class="text-center text-danger">'.$_SESSION['msg'].'</p>'?>
              
              <div class="form-group row">
                <label for="input-27" class="col-sm-6 col-form-label">Vendor Name</label>
                <div class="col-sm-6">
                  <select name="vendor_id" id="vendor_id" class="form-control form-control-rounded">
                        <!--<option selected value="" disabled>Select here</option>-->
                        <option value="none">None</option>   
                          <?php
                            $query = "SELECT * FROM vendors WHERE status = 1 ORDER BY company_name ASC";
                            $data = all_data($query);
                            foreach($data['all_data'] as $key => $value){
                            ?>
                              <option <?= ($value['id'] == $user_details['vendor_id'] ? 'selected' : '') ?> value="<?=$value['id'];?>"><?=$value['company_name'];?></option>
                           <?php } ?>
                  </select>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="input-27" class="col-sm-6 col-form-label">User Role?</label>
                <div class="col-sm-6">
                  <select name="user_role" id="" class="form-control form-control-rounded">
                    <option <?= ($user_details['role'] == 0) ? 'selected' : ''?> value="0">User</option>
                    <option <?= ($user_details['role'] == 2) ? 'selected' : ''?> value="2">Consultant</option>
                  </select>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="input-26" class="col-sm-6 col-form-label">Profile Image</label>
                <div class="col-sm-6">
                      <input type="file" name="feature_img" class="form-control form-control-rounded">
                </div>
                <img style="height: 100px;display: block;margin-top: 5px;margin-right: 15px;margin-left: auto;" src="../user-images/<?=$user_details['profile_image']?>" alt="" class="" />
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">First name</label>
                  <div class="col-sm-6">
                    <input type="text" name="f_name" class="form-control form-control-rounded" id="input-26" placeholder="Enter First Name" value="<?=$user_details['f_name']?>" required>
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-26" class="col-sm-6 col-form-label">Last name</label>
                  <div class="col-sm-6">
                    <input type="text" name="l_name" class="form-control form-control-rounded" id="input-26" placeholder="Enter Last Name"  value="<?=$user_details['l_name']?>" required>
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Email</label>
                  <div class="col-sm-6">
                    <input type="email" name="email" class="form-control form-control-rounded" id="input-26" placeholder="Enter Email"  value="<?=$user_details['email']?>" required>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Contact</label>
                  <div class="col-sm-6">
                    <input type="text" name="contact" class="form-control form-control-rounded" id="input-26" placeholder="Enter Contact"  value="<?=$user_details['contact']?>" required>
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Commission</label>
                  <div class="col-sm-6">
                    <input type="text" name="commission" class="form-control form-control-rounded" id="input-26" placeholder="Enter Commission"  value="<?=$user_details['comission']?>">
                  </div>
              </div>

              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">Wallet Value</label>
                  <div class="col-sm-6">
                    <input type="text" name="wallet" class="form-control form-control-rounded" id="input-26" placeholder="Enter Wallet Value"  value="<?=$user_details['ewallet']?>">
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="input-27" class="col-sm-6 col-form-label">New Password</label>
                  <div class="col-sm-6">
                    <input type="text" name="pass" class="form-control form-control-rounded" id="input-26" placeholder="Enter Password"  value="" required>
                  </div>
              </div>          
            
         

          <div class="form-group row">
            <label for="input-27" class="col-sm-6 col-form-label">User Status</label>
            <div class="col-sm-6">
              <select name="User_status" id="" class="form-control form-control-rounded">
                <option <?= ($user_details['status'] == 1 ? 'selected' : '') ?> value="1">Active</option>
                <option <?= ($user_details['status'] == 0 ? 'selected' : '') ?> value="0">Deactive</option>
              </select>
            </div>
          </div>
           <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
            <button type="submit" name="update" class="btn btn-primary shadow-dark btn-round px-5"><i class="icon-plus"></i> Update Now</button>
            </div>
          </div>
          <div class="" style="float: right;">
            <a href="all-users.php" class="btn btn-success"><-Back</a>
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

              $('.wrap_desc').append('<div class="form-group row" id="p_des_remove_'+p_inc_id+'"><a href="javascript:void(0)" onclick="p_des_remove('+p_inc_id+')" style="font-size:20px;color:red;margin-top:0.6%;margin-left: 4%;padding-right: 3%;">X</a><input type="text" name="p_desc_head[]" class="form-control form-control-rounded col-sm-5" id="input-26" placeholder="Title" value="" style="width:85%" required><div class="col-sm-6"><input type="text" name="p_desc_data[]" class="form-control form-control-rounded" id="input-26" placeholder="Description" required></div></div>');
            }

            function p_des_remove(id){
                var p_inc_id = $('#p_desc_cnt').val();
                --p_inc_id;
                $('#p_desc_cnt').val(p_inc_id);
                $('#p_des_remove_'+id).remove();
            }
    </script>
    
    <script>
        
        $(window).load(function(){
            // fetch User details 
            var pid= $.trim(parseInt(<?=$uid?>));
            $('#parent_categoryy').trigger('change');
        })
        
        $('.delete').on('click', function(e){
            $iid = $(this).data('id');
            $iname= $(this).data('name');
            $this = $(this);
            
            $.ajax({
                type: "post",
                url: "cores/delete-User-image.php",
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
