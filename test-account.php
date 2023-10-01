 <div class="container page-content">
            <!-- <div class="row"> -->
                <?php 
                if(isset($profile_update)){
                    if($profile_update){
                        echo '<h4 class="text-success fw-bold p-2 text-center col-12" style="background:antiquewhite">Profile Updated Successfully</h5>';
                    }else{
                        echo '<h4 class="text-danger fw-bold p-2 text-center col-12" style="background:#fadfd7">
                        Error in Updating Profile. '.$pass_msg['msg'].'</h4>';
                    }
                }
                 ?>
            <!-- </div> -->
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'Dashboard')" id="defaultOpen">Dashboard</button>
              <button class="tablinks" onclick="openCity(event, 'Order')">Order History</button>
              <button class="tablinks" onclick="openCity(event, 'Ratings')">Ratings</button>
              <button class="tablinks" onclick="openCity(event, 'Address')">Order Address</button>
              <button class="tablinks" onclick="openCity(event, 'Profile')">Profile</button>
              <button class="tablinks" onclick="openCity(event, 'Password')">Change Password</button>
              <button class="tablinks" onclick="openCity(event, 'Logout')">Logout</button>
            </div>
            <div id="Dashboard" class="tabcontent">
              <div class="col-sm-6">
                <div class="well">
                  <h4>Sessions</h4>
                  <p>10 Million</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="well">
                  <h4>Bounce</h4>
                  <p>30%</p>
                </div>
              </div>
            </div>
            <div id="Profile" class="tabcontent">
              <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <?php
                    // echo '<pre>', print_r($full_user_data['all_data'][0]), '</pre>';
                    $userData = $full_user_data['all_data'][0];
                    ?>
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" id="name" name="user_f_name" value="<?=$userData['f_name']?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="name" name="user_l_name" value="<?=$userData['l_name']?>">
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="user_email" value="<?=$userData['email']?>">
                </div>

                <div class="col-md-6">
                  <label class="form-label">Phone</label>
                  <input type="text" class="form-control" id="phone" name="user_phone" value="<?=$userData['contact']?>">
                </div>
                <div class="col-md-2">
                  <button type="submit" name="profile_update" class="btn btn-primary" value="Update">Update</button>
                </div>
              </form>
            </div>

            <div id="Password" class="tabcontent">
              <form class="row g-3" action="" method="post">
                <div class="col-md-6">
                  <label class="form-label">Old Password</label>
                  <input type="text" class="form-control" name="oldpassword">
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                  <label class="form-label">New Password</label>
                  <input type="text" class="form-control" name="newpassword">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Confirm Password</label>
                  <input type="text" class="form-control" name="confirmpassword">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary" name="password_update">Submit</button>
                </div>
              </form>
            </div>

            <div id="Order" class="tabcontent">
              <div class="container bootdey">
                <div class="panel panel-default panel-order">
                  <div class="panel-heading">
                    <strong>Order history</strong>
                    <div class="btn-group pull-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Filter
                          history <i class="fa fa-filter"></i></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#">Approved orders</a></li>
                          <li><a href="#">Pending orders</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="panel-body">
                    <div class="row">
                        <div class="card mb-3" style="">
                            <?php if (isset($_SESSION['id'])) {
                                if (!empty($ret_account_data_func['all_data'])) {
                                    foreach($ret_account_data_func['all_data'] as $Pkey => $Pval){
                                        ?>
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                              <img src="product-images/<?=$Pval['ph_feature_img']?>" class="img-fluid rounded-start" style="width: 50%";/>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="card-body">
                                                <h5 class="card-text">Invoice ID: <b><?=$Pval['order_id']?></b></h5>
                                                <span>Amount: <b><?=$Pval['vendor_amt']?></b></span>
                                                <br><br>
                                                <!-- <span> </span> -->
                                                <span class="bg-warning p-2">
                                                    Order Status:
                                                    <?php
                                                    if ($Pval['order_status']==1) {
                                                        echo 'Order Plcaed';
                                                    }elseif($Pval['order_status']==2){
                                                        echo 'Order Delivered';
                                                    }else{
                                                        echo 'Order Cancelled';
                                                    }
                                                     ?>
                                                </span>
                                              </div>
                                            </div>
                                            <div class="col-md-2 center">
                                                <a class="mb-3" href="invoice.php?order=<?=$Pval['order_id']?>" class=""><b>Download Invoice</b></a>
                                                <p class="fs-6 text-center">On: 
                                                    <b><?= date("d M, Y - h:i:s", strtotime($Pval['added_on'])); ?></b>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                            <?php }else{ ?>
                            <div class="text-center">
                                <button href="#signin-modal" data-toggle="modal" class="btn btn-primary">SIGN IN</button>
                           </div>
                            <?php } ?>  
                        </div>    

                        <div class="col-md-4 col-lg-1 mx-auto">
                            
                        </div>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>


            
            <div id="Ratings" class="tabcontent">
              <div class="container bootdey">
                <div class="panel panel-default panel-order">
                  <div class="panel-body">
                    <div class="row">
                        <div class="card mb-3" style="">
                            <?php if (isset($_SESSION['id'])) {

                              $order_product = all_data("SELECT 
    tbl_order_dtl.order_hdr_id AS ORDER_ID,
    tbl_product_hdr.ph_feature_img,
    tbl_product_hdr.phid,
    tbl_product_hdr.ph_title,
    rating,
    user_feedback.order_hdr_id AS RAT_ORDER_HDR_ID


FROM tbl_product_hdr 
INNER JOIN tbl_order_dtl ON tbl_product_hdr.phid = tbl_order_dtl.product_id
LEFT JOIN user_feedback ON user_feedback.product_id = tbl_order_dtl.product_id
WHERE tbl_order_dtl.user_id = '".$_SESSION['id']."' ");
                                if (!empty($order_product['all_data'])) { 
                                  ?>

                                   <div class="row g-0">
                                          <div class="col-md-12">
                                            <table class="table table-bordered">
                                              <tr>
                                                <th>Product</th>
                                                <th>Name</th>
                                                <th>Ratings</th>
                                              </tr>
                                  <?php  foreach($order_product['all_data'] as $rkey => $rval){
                                        ?>
                                              <tr>
                                                <td><img src="product-images/<?=$rval['ph_feature_img']?>" class="img-fluid rounded-start" style="width: 40px"/></td>
                                                <td><?=$rval['ph_title']?></td>
                                                <td>
                                                  
                                                  <?=($rval['ORDER_ID']!=$rval['RAT_ORDER_HDR_ID']) ? '<a href="javascript:void(0)" onclick="rating_modal('.$rval['phid'].','.$rval['ORDER_ID'].')" class="btn btn-primary"</a>Modal</a>' :$rval['rating'].'/5';?>
                                                </td>
                                              </tr>
                                            
                                        <?php
                                    } ?>
                                  </table>
                                          </div>
                                        </div>
                                    <?php
                                }
                            ?>
                            <?php }else{ ?>
                            <div class="text-center">
                                <button href="#signin-modal" data-toggle="modal" class="btn btn-primary">SIGN IN</button>
                           </div>
                            <?php } ?>  
                        </div>    

                        <div class="col-md-4 col-lg-1 mx-auto">
                            
                        </div>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div id="Address" class="tabcontent small_btn">
              <div class="container bootdey">
                <div class="panel panel-default panel-order">
                  <div class="panel-heading">
                    <strong>Address</strong>
                    <div class="btn-group pull-right">
                      <div class="btn-group">
                
                      </div>
                    </div>
                  </div>

                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-1"><img src="user-images/<?=$userData['profile_image']?>"
                          class="media-object img-thumbnail" />
                      </div>
                      <div class="col-md-11">
                        <div class="row">
                          <div class="col-md-12">
                            <span><strong>Name</strong></span>: <span class="label label-info"><?=$userData['f_name'] . ' ' . $userData['l_name']?></span>
                            <br />
                            <span><strong>Address</strong></span> <span class="label label-info"><?=$userData['street_addrs']?></span>
                            <br />
                            <span><strong>Contact</strong></span>: <?=$userData['contact']?> 
                            <br />
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Show Details
                            </button>

                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Address Update</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form class="row" method="post" action="">
                                          <!-- <div class="col-md-6">
                                            <label for="recipient-name" class="col-form-label fw-bold">Company:</label>
                                            <input type="text" class="form-control" id="company" name="company" value="">
                                          </div> -->
                                          <div class="col-md-6">
                                            <label for="recipient-name" class="col-form-label fw-bold">Country:</label>
                                            <input type="text" class="form-control" id="country" name="country" value="<?=$userData['country']?>">
                                          </div>
                                          <div class="col-md-12">
                                            <label for="message-text" class="col-form-label fw-bold">Street Adress:</label>
                                            <input type="text" class="form-control" id="street_addrs" name="street_addrs" value="<?=$userData['street_addrs']?>">
                                          </div>
                                          <div class="col-md-12">
                                            <label for="message-text" class="col-form-label fw-bold">Apartment</label>
                                            <input type="text" class="form-control" id="apartment" name="apartment" value="<?=$userData['apartment']?>">
                                          </div>
                                          <div class="col-md-4">
                                            <label for="recipient-name" class="col-form-label fw-bold">Town/City:</label>
                                            <input type="text" class="form-control" id="Town/City" name="town" value="<?=$userData['town']?>">
                                          </div>
                                          <div class="col-md-4">
                                            <label for="recipient-name" class="col-form-label fw-bold">State:</label>
                                            <input type="text" class="form-control" id="state" name="state" value="<?=$userData['state']?>">
                                          </div>
                                          <div class="col-md-4">
                                            <label for="recipient-name" class="col-form-label fw-bold">Pincode:</label>
                                            <input type="text" class="form-control" id="zip" name="zip" value="<?=$userData['zip']?>">
                                          </div>
                                  
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary" value="address_update" name="address_update">Update</button>
                                          </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                          </div>




                        </div>
                      </div>
                    </div>
                  </div>
                 </div>
                </div>
              </div>
            </div>


            <div class="cart my-account">
              <div class="container">
                <div class="row d-flex justify-content-center px-3">


                  <div class="col-md-6 card">
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <a href="javaScript:void(0)"></a>
                      </div>
                    </div>
                  </div><!-- End .col-md-6 end card -->
                </div><!-- End .row -->
              </div><!-- End .container -->
            </div><!-- End .cart -->
          </div>