<?php 
error_reporting(E_ALL);
include 'function/functions.php';
/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';*/
$_SESSION['razorpay_token'] = sha1(md5(time().time().rand()));
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $user_data = single_data("SELECT * FROM users WHERE id = '$user_id' ")['all_data'];
	$avail_bonus_amt = $user_data['bonus_wallet'];

    // user hdr data
    $user_data_query = "SELECT * FROM users WHERE id = '$user_id' ";
    $user_data_ret = single_data($user_data_query);

    // retrive user details, 
    $user_det_data_query = "SELECT * FROM tbl_order_dtl WHERE user_id = '$user_id' ORDER BY order_dtl_id DESC LIMIT 1 ";
    $user_data_det_ret = single_data($user_det_data_query);
}
else{
	$avail_bonus_amt = 0;
    $user_id = 0;
}

if(isset($_POST['add_now'])){
    extract($_POST);
$order_first_name;
$order_last_name;
$orde_company_name;
$order_country;
$order_streeet_adrs;
$order_apartment;
$order_town;
$order_state;
$order_zip;
$order_phone;
$order_email;
$gst_number;

$user_id = $_SESSION['id'];
$ins_data = [
        'user_id' => $user_id, 
        'f_name' => $order_first_name, 
        'l_name' => $order_last_name, 
        'company' => $orde_company_name, 
        'country' => $order_country, 
        'street_addrs' => $order_streeet_adrs, 
        'apartment' => $order_apartment, 
        'town' => $order_town, 
        'state' => $order_state, 
        'zip' => $order_zp, 
        'phone' => $order_phone, 
        'email' => $order_email, 
        'gst_number' => $gst_number
    ];
bind_insert('tbl_address',$ins_data);

echo '<script>alert("Address Added successfully");window.location.href=""</script>';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Checkout | Sreyhva Ent. Pvt. Ltd.</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Sreyhva - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Sreyhva">
    <meta name="application-name" content="Sreyhva">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-14.css">
    <link rel="stylesheet" href="assets/css/demos/demo-14.css">
    <?php include 'cores/head-tag.php'; ?>
    <style>
        .address{
                border: 1px solid #ff396c;
                border-radius: 3px;
                /*width: fit-content;*/
                padding: 6px;
                
        }
        .address label{
            display:flex;
        }
    </style>
</head>

<body>
     <?php include 'cores/body-tag.php' ?>
    <div class="page-wrapper">
        <?php include 'cores/nav.php' ?>

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Checkout<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content m-5">
            	<div class="checkout">
	                <div class="container">
                        <div class="order-loading justify-content-center d-none">
                            <img src="assets/images/loading-load.gif" alt="" style="width:10%" id="loading_img">
                            <br>
                            <div class="checkout-msg"></div>
                        </div>
                        <?php if (isset($_SESSION['id'])) {
                           
                        ?>
                        <div class="checkout-form-content">
            			<div class="checkout-discount">
            				<form action="#">
        						<input type="text" class="form-control" required id="checkout-discount-input" value="<?=isset($_SESSION['coupon_code'])? $_SESSION['coupon_code']:null?>" readonly>
            					<!-- <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label> -->
            				</form>
            			</div><!-- End .checkout-discount -->

            			<form id="checkout_form">
            				<input type="hidden" name="p_token" id="pass_c_token" value="<?=$_SESSION['razorpay_token']?>">
		                	<div class="row">
		                	    <div class="col-md-9">
		                	        <br>
		                	         <a  href="#add-new-address" data-toggle="modal" class="btn btn-primary">Add New Address</a><br>
		                	         <br>
		                	        <?php
		                	           $ret_address = all_data("SELECT * FROM tbl_address WHERE user_id = '".$_SESSION['id']."' ");
		                	           if($ret_address['data']==true){
		                	           ?>
		                	         <p><b>Select Delivery Address</b></p>
		                	         
		                	         <br>
		                	        <div class="row">
		                	            
		                	           <?php $inc=1; foreach($ret_address['all_data'] as $ad_key => $ad){ ?>
		                	            <div class="col-md-4">
		                	                <div class="address">
		                	                    <label for="address_<?=$inc?>">
		                	                        <input required type="radio" name="address_id" class="address" id="address_<?=$inc?>" value="<?=$ad['address_id']?>">
		                	                        Name: <?=$ad['f_name'] .' '. $ad['l_name']?> <br>
		                	                        City: <?=$ad['town']?> <br>
		                	                        Street Address: <?=$ad['street_addrs'] .', '. $ad['apartment']?> <br>
		                	                        Mobile: <?=$ad['phone']?>
		                	                    </label>
		                	                </div>
		                	            </div>
		                	            <?php $inc++;} ?>
		                	        </div>
		                	        <?php } ?>
		                	    </div>
		                		<aside class="col-lg-3">
<?php 

$checkout_products = "SELECT
    `phid`,
    `ph_title`,
    `ph_shipping_charge`,
    `ph_feature_img`,
    `admin_commission`,
    `ph_bonus`,
`product_dtl_id`,
(SELECT ph_dp +  ROUND((`ph_dp` * `admin_commission`) / 100,2) AS ph_price
  FROM tbl_product_dtl WHERE `product_id` = `phid` && `pdid` = `product_dtl_id`)
 AS ph_price,
`product_id`,
`product_qty`,
`cartid`,
(
    SELECT
        COUNT(DISTINCT(vendor_id)) AS TOTAL_VENDOR
    FROM
        tbl_cart
    JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
    WHERE
        user_id = '".$user_id."' && cart_status = 1 && `phid` = `phid`
) AS TOTAL_VENDOR
FROM
    tbl_cart
JOIN tbl_product_hdr ON tbl_cart.product_id = tbl_product_hdr.phid
WHERE
    user_id = '".$user_id."' && cart_status = 1 ";
$checkout_func = all_data($checkout_products);
$checkout_amount = 0;
$total_bonus_amt = 0;
if (!empty($checkout_func['all_data'])) {



?>
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
		                							<th>Product</th>
		                							<th>Total</th>
		                						</tr>
		                					</thead>

		                					<tbody>
<?php 
$shipping_free_amt = single_data("SELECT min_cart_val FROM common_settings WHERE csid =  1 ")['all_data'];
$shipping_charges = 0;
$actual_order_value = 0;
foreach ($checkout_func['all_data'] as $key_p => $value_p) { 

// calculate bonus amount
if ($avail_bonus_amt>0) {
    $total_bonus_amt += ((($value_p['ph_price']*$value_p['product_qty'])*$value_p['ph_bonus'])/100);
}


$checkout_amount +=($value_p['product_qty']*$value_p['ph_price']);
$actual_order_value +=($value_p['product_qty']*$value_p['ph_price']);
$shipping_charges += ($value_p['ph_shipping_charge']);;

?>
		                						<tr>
		                							<td><a href="#"><?=$value_p['ph_title']?></a></td>
		                							<td>&#8377;<?=number_format(($value_p['product_qty']*$value_p['ph_price']),2)?></td>
		                						</tr>
                                            <?php }
if (isset($_SESSION['coupon_amount']) && $_SESSION['coupon_amount']>0 && $checkout_amount>0) {

   $checkout_amount = $_SESSION['coupon_amount'];
}


                                             ?>
		                						<tr class="summary-subtotal">
		                							<td>Subtotal:</td>
		                							<td>&#8377;<?=number_format($actual_order_value,2)?></td>
		                						</tr><!-- End .summary-subtotal -->
		                						<tr>
		                							<td>Shipping:</td>
		                							<td><?php 
                        if ($checkout_amount>=$shipping_free_amt['min_cart_val']) {
                         ?>
		                							Free shipping
		                						<?php } else{ ?>
		                							<b>
                           <?=number_format($shipping_charges,2)?>
                        </b>
		                						<?php $checkout_amount += $shipping_charges;} ?>
		                						</td>
		                						</tr>
		                						<tr class="summary-total">
                        <td>Bonus Applied:</td>
                        <td>
                            
                            <?php 
                            if ($avail_bonus_amt>0) {
                                //$total_bonus_amt;
                                
                                if ($avail_bonus_amt>=$total_bonus_amt) {
                                    $print_bonus_amt = $total_bonus_amt;
                                }
                                else{
                                    $print_bonus_amt = $avail_bonus_amt;
                                     
                                }

                            }else{
                                $print_bonus_amt = 0;
                            }

                            echo number_format($print_bonus_amt,2);
                             ?>

                        </td>
                    </tr>
                    <?php 
                    if (($actual_order_value-$checkout_amount)>0) {
                    ?>
				<tr class="summary-subtotal">
					<td>Discount:</td>
					<td>&#8377;<?=number_format(($actual_order_value-$checkout_amount),2)?></td>
					</tr><!-- End .summary-subtotal -->
				<?php } ?>
		                						<tr class="summary-total">
		                							<td>Total:</td>
		                							<td>&#8377;<?=number_format($checkout_amount-$print_bonus_amt,2)?></td>
		                						</tr><!-- End .summary-total -->
		                					</tbody>
		                				</table><!-- End .table table-summary -->

		                				<button type="submit" class="btn btn-outline-primary-2 btn-order btn-block" id="rzp-button1">
		                					<span class="btn-text">Place Order</span>
		                					<span class="btn-hover-text">Proceed to Checkout</span>
		                				</button>
		                			</div><!-- End .summary -->
                                <?php } ?>
		                		</aside><!-- End .col-lg-3 -->
		                	</div><!-- End .row -->


            			</form>
                    </div>
                    
                    
                    
                    
<div class="modal fade" id="add-new-address" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"><i class="icon-close"></i></span>
				</button>
				
				<div class="form-box">
				    <form action="" method="post">
				    
					<div class="row">
		                					<div class="col-sm-6">
		                						<label>First Name *</label>
		                						<input type="text" class="form-control" required name="order_first_name" id="order_first_name">
		                					</div>

		                					<div class="col-sm-6">
		                						<label>Last Name *</label>
		                						<input type="text" class="form-control" required  name="order_last_name" id="order_last_name">
		                					</div>
		                				</div>

	            						<label>Company Name (Optional)</label>
	            						<input type="text" class="form-control"  id="order_company_name" name="orde_company_name">

	            						<label>Country *</label>
	            						<input type="text" class="form-control" required id="order_country" name="order_country" >

	            						<label>Street address *</label>
	            						<input type="text" class="form-control" id="order_street_adrs" name="order_streeet_adrs" placeholder="House number and Street name" required >
	            						<input type="text" id="order_appartment" name="order_apartment" class="form-control" placeholder="Appartments, suite, unit etc ..." required >

	            						<div class="row">
		                					<div class="col-sm-6">
		                						<label>Town / City *</label>
		                						<input type="text" id="order_town" name="order_town" class="form-control" required >
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>State / County *</label>
		                						<select id="order_state" name="order_state" required  class="form-control">
		                							<?php 
		                							$ret_state = all_data("SELECT state_name,state_tin_number FROM tbl_state ORDER BY state_name ASC");
		                							foreach ($ret_state['all_data'] as  $val_state) {
		                							 ?>
		                							<option value="<?=$val_state['state_tin_number']?>"><?=$val_state['state_name']?></option>
		                						<?php } ?>
		                						</select>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>Postcode / ZIP *</label>
		                						<input type="text" class="form-control" name="order_zip" id="order_zip" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Phone *</label>
		                						<input type="tel" class="form-control" id="order_phone" name="order_phone" required >
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-6">
		                						<label>Email address *</label>
		                						<input type="email" class="form-control" id="order_email" name="order_email" required>
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-6">
		                						<label>GST Number </label>
		                						<input type="text" class="form-control" id="gst_number" name="gst_number">
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->
		                					<div class="form-footer">
												<button type="submit" class="btn btn-outline-primary-2" name="add_now">
												<span>Add Now</span>
												</button>
												</div><!-- End .form-footer -->
		                				
		            </form>
		          </div>
			</div><!-- End .modal-body -->
		</div><!-- End .modal-content -->
	</div><!-- End .modal-dialog -->
</div>
																		
																		
																		
                    <?php } 

                    if (!isset($_SESSION['id'])) {
                        // code...
                    ?>

                   <div class="text-center">
                        <button href="#signin-modal" data-toggle="modal" class="btn btn-primary">SIGN IN</button>
                   </div>


                <?php } ?>
                
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

         <?php include 'cores/footer.php' ?>
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <?php include 'cores/mobile-nav.php'; ?>
    <!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <?php include 'cores/modal-signin.php'; ?>
    
    <!-- End .modal -->

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->
    <!-- <script type="text/javascript" src="assets/js/razorpay.js?v=<?=time()?>"></script> -->

    <script>
// checkout form integration
jQuery('#checkout_form').on('submit',function(e){
    console.log(jQuery('#checkout_form').serialize());
			jQuery.ajax({
				url:'function/test-checkout.php',
				type:'post',
				data:jQuery('#checkout_form').serialize(),
				success:function(result){
				    console.log(result);
				    if(result==true){
    					$('.checkout-form-content').addClass('d-none');
    					$('.order-loading').removeClass('d-none').addClass('d-flex');
    					setTimeout(function(){
    					    
    						$('#loading_img').hide();
    						//$('.checkout-msg').html(result)
    						$('.checkout-msg').html('<p>Your order is placed successfully. <br><br><a href="account.php">Go to My Account</a></p>');
    					},1700)
				    }else{
				        alert('Please select your address');
				    }
					
				}
			});
			e.preventDefault();
		});
    </script>
</body>
</html>