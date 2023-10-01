
/*form data submit, using step method*/
function form_step($id){

if ($id == 1) {
  var form = $('#images')[0];
  var formData = new FormData(form);
  $.ajax({
    url:'cores/edit-products.php',
    type:'post',
    data:formData,
    contentType: false,
    processData: false,
    success:function(result){
      var r_decode = JSON.parse(result);
      if(r_decode.status !=true){
        notification("error",'fa fa-exclamation-circle',r_decode.msg);
      }else{
          //$('#home').css("background-color", "#959595");
          $('ul.product_form_tab li a[href="#menu1"]').click();
        notification("info",'fa fa-info-circle','Images updated');
      }
    }
  });


}

else if($id == 2){

  $.ajax({
    url:'cores/edit-products.php',
    type:'post',
    data:$('#second_step').serialize(),
    success:function(result){
      var r_decode = JSON.parse(result);
      if(r_decode.status !=true){
        notification("error",'fa fa-exclamation-circle',r_decode.msg);
      }else{
        $('ul.product_form_tab li a[href="#menu2"]').click();
        notification("info",'fa fa-info-circle','Basic detail updated');
      }
    }
  });


}else if($id == 3){
    var editor1 = CKEDITOR.instances['editor1'].getData();

    $.ajax({
    url:'cores/edit-products.php',
    type:'post',
    data:$('#third_sec').serialize()+'&editor1='+editor1,
    success:function(result){
      var r_decode = JSON.parse(result);
      if(r_decode.status !=true){
        notification("error",'fa fa-exclamation-circle',r_decode.msg);
      }else{
        $('ul.product_form_tab li a[href="#menu3"]').click();
        notification("info",'fa fa-info-circle','description updated');
      }
    }
  });


}else if($id == 4){

      $.ajax({
    url:'cores/edit-products.php',
    type:'post',
    data:$('#forth_sec').serialize(),
    success:function(result){
      var r_decode = JSON.parse(result);
      if(r_decode.status !=true){
        notification("error",'fa fa-exclamation-circle',r_decode.msg);
      }else{
        $('ul.product_form_tab li a[href="#menu4"]').click();
        notification("info",'fa fa-info-circle','Price updated');
      }
    }
  });
  
}
else if($id == 5){

      $.ajax({
    url:'cores/edit-products.php',
    type:'post',
    data:$('#last').serialize(),
    success:function(result){
      var r_decode = JSON.parse(result);
      if(r_decode.status !=true){
        notification("error",'fa fa-exclamation-circle',r_decode.msg);
      }else{
        notification("success",'fa fa-check-circle','Product updated');
        window.location.href="vendor.php?page=all-products";
      }
    }
  });
  
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
url:'cores/edit-products.php',
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




/*notification functions*/
function notification(type,icon,msg){
        Lobibox.notify(type, {
        pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            icon: icon,
            size: 'mini',
            position: 'top right',
            showClass: 'fadeInDown',
            hideClass: 'fadeOutDown',
            width: 350,
            msg: msg
        });
}