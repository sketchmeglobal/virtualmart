<script>
$(document).ready(function(){
cart_header(); // cart function default call
cart_wishlist(); // wishlist function default call
cart_page_load(); // cart-page data load
cart_page_sidebar(); // cart-page-sidebar load for cart page
});
	// add to cart funciton
	function add_to_cart(data){
		//alert(data);
		var cart_token = $('#'+data+'_cart_token').val();
		var product = $('#'+data+'_product').val();
		var qty = $('#'+data+'_qty_product').val();
		var consultant = $('#'+data+'_consultant').val();
		var color = $("input[name='color']:checked").val();
		var size = $('select#size option:selected').val();
		//alert(qty);
		jQuery.ajax({
				url:'function/functions.php',
				type:'post',
				data:'cart_token='+cart_token+'&product='+product+'&qty='+qty+'&consultant='+consultant+'&color='+color+'&size='+size,
				success:function(result){
					//alert(result);
					if (result != 0) {
						cart_wishlist();
						cart_header(); // call the function for top bar cart data
						jQuery('#'+data+'_').html(result);
						jQuery('.'+data+'_addtocartbtn').attr('disabled',true);
					}
					
				}
			});
	}
	// auto load data for header cart
	function cart_header(){
		jQuery.ajax({
				url:'function/cart-top-bar.php',
				type:'post',
				data:'cart_header=updated',
				success:function(result){
						jQuery('#top-cart-data').html(result);
				}
			});
	}
	// product remove rrom cart function 
	function product_remove(data){
		jQuery.ajax({
				url:'function/cart-remove.php',
				type:'post',
				data:'cart_header='+data,
				success:function(result){
					cart_header();
					cart_page_load();
					cart_page_sidebar();
				}
			});
	}
	
		// product remove rrom wishlist function 
	function product_remove_wishlist(data){
		jQuery.ajax({
				url:'function/wishlist-remove.php',
				type:'post',
				data:'cart_header='+data,
				success:function(result){
					window.location.href="";
				}
			});
	}
	// add to wishlist funciton
	function add_to_wishlist(data){
		var cart_token_w = $('#'+data+'_w_token').val();
		var product_w = $('#'+data+'_product_w').val();
		var consultant = $('#'+data+'_consultant').val();
		var color = $("input[name='color']:checked").val();
		var size = $('select#size option:selected').val();
		var qty = $('#'+data+'_qty_product').val();
		jQuery.ajax({
				url:'function/functions.php',
				type:'post',
				data:'cart_token_w='+cart_token_w+'&product_w='+product_w+'&consultant_w='+consultant+'&color='+color+'&size='+size+'&qty='+qty,
				success:function(result){
					if (result != 0) {
						cart_wishlist(); // call the function for top bar cart data
						jQuery('#wishlist_msg_'+data).show();
						setInterval(function() {
							jQuery('#wishlist_msg_'+data).hide();
						}, 1500);
					}
					
				}
			});
	}
// auto load data for header cart
	function cart_wishlist(){
		jQuery.ajax({
				url:'function/wishlist-top-bar.php',
				type:'post',
				data:'wishlist_header=updated',
				success:function(result){
						jQuery('#top-bar-wishlist').html(result);
				}
			});
	}
// cart-page load.
function cart_page_load(){
var coupon_code = $('#coupon_code').val();
jQuery.ajax({
	url:'function/cart-page.php',
	type:'post',
	data:'cart_page=updated&coupon_code='+coupon_code,
	success:function(result){
		coupon_code = $('#coupon_code').val(coupon_code);
			jQuery('#cart-page').html(result);
			cart_page_sidebar();
			cart_header();
	}
});
}
// cart-page-sidebar load.
function cart_page_sidebar(){
var coupon_code = $('#coupon_code').val();
jQuery.ajax({
	url:'function/cart-page-sidebar.php',
	type:'post',
	data:'cart_page_sidebar=updated&coupon_code='+coupon_code,
	success:function(result){
		coupon_code = $('#coupon_code').val(coupon_code);
			jQuery('#cart-page-sidebar').html(result);
	}
});
}
// update quantity in cart page
function update_qty(val,product){
	//alert(val);die();
	$.ajax({
		url:'function/functions.php',
		type:'post',
		data:'cart_page_update_qty=updated&product_qty='+val+'&cart_page_qty_product='+product,
		//data:{cart_page_update_qty:'update', product_qty:val, product:product},
		success:function(data){
			cart_page_load();
		}
	});
}

$('.signin-modal').click(function(){
//get cover id
var product = $(this).attr('product');
var consultant = $(this).attr('consultant');
var qty = $('#'+product+'_qty_product').val();
var type = $(this).attr('type');

var color = $("input[name='color']:checked").val();
var size = $('select#size option:selected').val();

$('#signin_product').val(product);
$('#signin_consultant').val(consultant);
$('#signin_type').val(type);
$('#signin_qty').val(qty);
$('#signin_color').val(color);
$('#signin_size').val(size);

$('#reg_product').val(product);
$('#reg_consultant').val(consultant);
$('#reg_qty').val(qty);
$('#reg_type').val(type);
$('#reg_color').val(color);
$('#reg_size').val(size);
});


// coupon code

function coupon_code(){
	cart_page_load(); // cart-page data load
	cart_page_sidebar(); // cart-page-sidebar load for cart page
}
</script>