<?php
//include 'functions.php';
$_SESSION['signup_msg']='';
if (isset($_POST['submit'])) {
extract($_POST);
if ($regtoken == $_SESSION['regtoken']) {
    $ins = register($Fname,$Lname,$mobile,$email,$password);
    if ($ins['status']==true) {
    if($reg_type=='cart'){
    tbl_cart($reg_product,$reg_consultant,$_SESSION['id'],$reg_color,$reg_size,$reg_qty);
    }
    elseif($reg_type=='wishlist'){
    tbl_wishlist($reg_product,$_SESSION['id'],$reg_consultant,$reg_color,$reg_size,$reg_qty);
    }
    echo '<script>window.location.href="";</script>';
    $_SESSION['signup_msg'] = '';
    }else{
        echo '<script>alert("Please try again");window.location.href="";</script>';
    }
}else{
    echo '<script>alert("Please try again");window.location.href="";</script>';
}
}

if (isset($_POST['usignin'])) {
extract($_POST);
if ($logtoken == $_SESSION['logtoken']) {
$user = login($userid,$password);
if ($user['status']>0) {
if($signin_type=='cart'){
tbl_cart($signin_product,$signin_consultant,$_SESSION['id'],$signin_color,$signin_size,$signin_qty);
}
elseif($signin_type=='wishlist'){
tbl_wishlist($signin_product,$_SESSION['id'],$signin_consultant,$signin_color,$signin_size,$signin_qty);
}
echo '<script>window.location.href="";</script>';
$_SESSION['signup_msg'] = '';
}else{
    echo '<script>alert("Invalid username or password");window.location.href="";</script>';
    
//$_SESSION['signup_msg'] = 'Invalid username or password';
}
}else{
    echo '<script>alert("Please try again");window.location.href="";</script>';
//$_SESSION['signup_msg'] = '';
}
}
$_SESSION['regtoken'] = sha1(rand());
$_SESSION['logtoken'] = sha1(rand());
?>
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"><i class="icon-close"></i></span>
				</button>
				<div class="form-box">
					<div class="form-tab">
						<?php echo '<p class="text-center text-danger">'.$_SESSION['signup_msg'].'</p>'; ?>
						<ul class="nav nav-pills nav-fill" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
							</li>
						</ul>
						<div class="tab-content" id="tab-content-5">
							<div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
								<form action="" method="post">
									<input type="hidden" name="signin_product" value="" id="signin_product">
									<input type="hidden" name="signin_consultant" value="" id="signin_consultant">
									<input type="hidden" name="signin_type" value="" id="signin_type">
									<input type="hidden" name="signin_qty" value="" id="signin_qty">
									
									<input type="hidden" name="signin_color" value="" id="signin_color">
									<input type="hidden" name="signin_size" value="" id="signin_size">
									
									<input type="hidden" name="logtoken" value="<?php echo $_SESSION['logtoken']; ?>">
									<div class="form-group">
										<label for="singin-email">Username or email address *</label>
										<input type="text" class="form-control" id="singin-email" name="userid" required>
										</div><!-- End .form-group -->
										<div class="form-group">
											<label for="singin-password">Password *</label>
											<input type="password" class="form-control" id="singin-password" name="password" required>
											</div><!-- End .form-group -->
											<div class="form-footer">
												<button type="submit" class="btn btn-outline-primary-2" name="usignin">
												<span>LOG IN</span>
												<i class="icon-long-arrow-right"></i>
												</button>
												<!-- <div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="signin-remember">
													<label class="custom-control-label" for="signin-remember">Remember Me</label>
												</div> -->
												<!-- <a href="#" class="forgot-link">Forgot Your Password?</a> -->
												</div><!-- End .form-footer -->
											</form>
											<!--  <div class="form-choice">
												<p class="text-center">or sign in with</p>
												<div class="row">
													<div class="col-sm-6">
														<a href="#" class="btn btn-login btn-g">
															<i class="icon-google"></i>
															Login With Google
														</a>
													</div>
													<div class="col-sm-6">
														<a href="#" class="btn btn-login btn-f">
															<i class="icon-facebook-f"></i>
															Login With Facebook
														</a>
													</div>
												</div>
											</div> -->
											</div><!-- .End .tab-pane -->
											<div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
											   <a href="login.php" class="font-weight-bold text-danger d-flex">Become a Seller <img src="<?=base_url.'/assets/images/right-arrow.png'?>" style="width:15px;" class="m-2"></a>
												
												<a href="auth-consultant.php" class="font-weight-bold text-danger d-flex">Become a Consultant  <img src="<?=base_url.'/assets/images/right-arrow.png'?>" style="width:15px;" class="m-2"></a>
												<form action="" method="post">
													<input type="hidden" name="reg_product" value="" id="reg_product">
													<input type="hidden" name="reg_consultant" value="" id="reg_consultant">
													<input type="hidden" name="reg_type" value="" id="reg_type">
													<input type="hidden" name="reg_qty" value="" id="reg_qty">
													
													<input type="hidden" name="reg_color" value="" id="reg_color">
													<input type="hidden" name="reg_size" value="" id="reg_size">
													
													<input type="hidden" name="regtoken" value="<?php echo $_SESSION['regtoken']; ?>">
													<div class="form-group">
														<label for="register-email">First Name *</label>
														<input type="text" class="form-control" id="register-email" name="Fname" required>
														</div><!-- End .form-group -->
														<div class="form-group">
															<label for="register-email">Last Name *</label>
															<input type="text" class="form-control" id="register-email" name="Lname" required>
															</div><!-- End .form-group -->
															<div class="form-group">
																<label for="register-email">Mobile *</label>
																<input type="text" class="form-control" id="register-email" name="mobile" required>
																</div><!-- End .form-group -->
																<div class="form-group">
																	<label for="register-email">Your email address *</label>
																	<input type="email" class="form-control" id="register-email" name="email" required>
																	</div><!-- End .form-group -->
																	<div class="form-group">
																		<label for="register-password">Password *</label>
																		<input type="password" class="form-control" id="register-password" name="password" required>
																		</div><!-- End .form-group -->
																		<div class="form-footer">
																			<button type="submit" class="btn btn-outline-primary-2" name="submit">
																			<span>SIGN UP</span>
																			<i class="icon-long-arrow-right"></i>
																			</button>
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" class="custom-control-input" id="register-policy" required>
																				<label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
																				</div><!-- End .custom-checkbox -->
																				</div><!-- End .form-footer -->
																			</form>
																			<!-- <div class="form-choice">
																				<p class="text-center">or sign in with</p>
																				<div class="row">
																					<div class="col-sm-6">
																						<a href="#" class="btn btn-login btn-g">
																							<i class="icon-google"></i>
																							Login With Google
																						</a>
																					</div>
																					<div class="col-sm-6">
																						<a href="#" class="btn btn-login  btn-f">
																							<i class="icon-facebook-f"></i>
																							Login With Facebook
																						</a>
																					</div>
																				</div>
																			</div> -->
																			</div><!-- .End .tab-pane -->
																			</div><!-- End .tab-content -->
																			</div><!-- End .form-tab -->
																			</div><!-- End .form-box -->
																			</div><!-- End .modal-body -->
																			</div><!-- End .modal-content -->
																			</div><!-- End .modal-dialog -->
																		</div>