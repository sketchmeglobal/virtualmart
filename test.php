<?php 
include 'function/functions.php';
$_SESSION['id']=5;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    $ret_account_data = "SELECT
                                *
                            FROM
                                tbl_product_hdr
                            INNER JOIN tbl_order_dtl ON tbl_order_dtl.product_id = tbl_product_hdr.phid
                            LEFT JOIN tbl_order_hdr ON tbl_order_hdr.order_hdr_id = tbl_order_dtl.order_hdr_id
                            WHERE
                                tbl_order_dtl.user_id = '".$_SESSION['id']."'
                            GROUP BY
                                tbl_order_dtl.order_hdr_id
                            ORDER BY
                                tbl_order_hdr.order_hdr_id
                            DESC";
    $ret_account_data_func = all_data($ret_account_data);

    $user_data = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
    $full_user_data = all_data($user_data);

    // print_r($full_user_data);

}

// Update Tabs

if(isset($_POST['profile_update']) == 'Update'){

    $profile_update = '';
    extract($_POST);
    $user_f_name;$user_l_name;$user_email;$user_phone;
    $sql_update = "UPDATE users SET f_name = '".$user_f_name."', l_name = '".$user_l_name."', email = '".$user_email."', contact = '".$user_phone."' WHERE id = $user_id";
    if(update($sql_update)){
        $profile_update = 1;
    }else{
        $profile_update = 0;
    }

}

if(isset($_POST['address_update']) == 'address_update'){

    $profile_update = '';
    extract($_POST);
    $country;$street_addrs;$apartment;$town;$state;$zip;

    $sql_update = "UPDATE users SET country = '".$country."', street_addrs = '".$street_addrs."', apartment = '".$apartment."', town = '".$town."', state = '".$state."', zip = '".$zip."' WHERE id = $user_id";
    if(update($sql_update)){
        $profile_update = 1;
    }else{
        $profile_update = 0;
    }

}

$pass_msg['msg'] = '';
if(isset($_POST['password_update'])){

    $profile_update = '';
    extract($_POST);

    $change_pass = change_user_password($_SESSION['id'],$oldpassword,$newpassword,$confirmpassword);

    if($change_pass['status']==true){
        $pass_msg['msg'] = '';
        $profile_update = 1;
    }else{
        $pass_msg['msg'] = $change_pass['msg'];
        $profile_update = 0;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account | Sreyhva Ent. Pvt. Ltd.</title>
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
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <style>
    * {
      box-sizing: border-box
    }

    body {
      font-family: "Lato", sans-serif;
    }

    /* Style the tab */
    .tab {
      display:flex;
      border: 1px solid #ff396c;
      background-color: transparent;
      width: 100%;
      height: 50px;
    }

    /* Style the buttons inside the tab */
    .tab button {
      display: block;
      background-color: inherit;
      color: black;
      padding: 10px 10px;
      width: 100%;
      border: none;
      outline: none;
      text-align: left;
      cursor: pointer;
      transition: 0.3s;
      font-size: 17px;
      float: left;

    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
      background-color: #ff396c;
      color: white;
    }

    /* Style the tab content */
    .tabcontent {
      float: left;
      padding: 15px 12px;
      border: 1px solid #ff396c;
      width: 100%;
      /* border-left: none; */
      height: 300px;
      overflow-y:scroll;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {
      height: 550px
    }

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
       .d-flx-flc-clm{
      display:flex;
      flex-direction:column;
    }
    .tab{
      display:flex;
      flex-direction:column;
      height:300px;
    }
      .row.content {
        height: auto;
      }
      .tabcontent{
        height:auto;
      }
    }

    .well {
      border-color: #ff396c;
      border-width: 1px;
      background-color: transparent;
    }

    .panel-order .row {
      border-bottom: 1px solid #ccc;
    }

    .panel-order .row:last-child {
      border: 0px;
    }

    .panel-order .row .col-md-1 {
      text-align: center;
      padding-top: 15px;
    }

    .panel-order .row .col-md-1 img {
      width: 50px;
      max-height: 50px;
    }

    .panel-order .row .row {
      border-bottom: 0;
    }

    .panel-order .row .col-md-11 {
      border-left: 1px solid #ccc;
    }

    .panel-order .row .row .col-md-12 {
      padding-top: 7px;
      padding-bottom: 7px;
    }

    .panel-order .row .row .col-md-12:last-child {
      font-size: 11px;
      color: #555;
      background: #efefef;
    }

    .panel-order .btn-group {
      margin: 0px;
      padding: 0px;
    }

    .panel-order .panel-body {
      padding-top: 0px;
      padding-bottom: 0px;
    }

    .panel-order .panel-deading {
      margin-bottom: 0;
    }

    .small_btn .btn{
      min-width: fit-content;
    }
    .center{display: flex;justify-content: center;align-items: center;background: beige;flex-direction: column}
    .d-flx-flc-clm{
      display:flex;
      flex-direction:column;
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
        			<h1 class="page-title">My<span>Account</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Account</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

        </main><!-- End .main -->

        <div class="container page-content d-flx-flc-clm">

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
                                                <h5 class="card-text">Order ID: <b><?=$Pval['order_id']?></b></h5>
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
          </div><!-- End .page-content -->    

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
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <?php include 'cores/footer-tag.php' ?>
    <script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
  </script>
</body>
</html>