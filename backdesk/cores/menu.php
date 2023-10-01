<?php
// ret_user_type or user permission
$user_per_q = "SELECT * FROM users WHERE id = '".$_SESSION['id']."' ";
$func_user_per_q = single_data($user_per_q);
$user_menu_data = $func_user_per_q['all_data'];
$user_type = $user_menu_data['user_type'];
?>
<style>
  thead,tfoot{background: #172b4d;color: #fff;}
      .table td, .table th{padding: 10px; border: 1px solid #989;}
      .table a.btn{padding: 0 10px;}
      .table tfoot{text-transform: uppercase;font-size: .72rem;}
      #example_paginate{float:right;margin-top: 10px;}
      #example_info{margin-top: 15px;}
      #example_filter{text-align:end;}
</style>
<!-- Start sidebar-wrapper -->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
  <div class="brand-logo">
    <a href="index.php">
      <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
      <h5 class="logo-text"><?=site_name?></h5>
    </a>
  </div>
  <ul class="sidebar-menu do-nicescrol">
    <li class="sidebar-header">MAIN NAVIGATION</li>
    <li>
      <a href="index.php" class="waves-effect">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <?php if($user_type=='SUPERADMIN' || $user_type=='ADMIN'){ ?>
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-layers"></i>
        <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="all-brands.php"><i class="zmdi zmdi-star-outline"></i>Brands</a></li>
      <li><a href="parent-category.php"><i class="zmdi zmdi-star-outline"></i> Parent Category</a></li>
        <li><a href="child-category.php"><i class="zmdi zmdi-star-outline"></i> Child Category</a></li>
        <li><a href="common-group.php"><i class="zmdi zmdi-star-outline"></i> Common Group</a></li>
      <li><a href="default-changes.php"><i class="zmdi zmdi-star-outline"></i> Default Changes</a></li>
      <li><a href="colors.php"><i class="zmdi zmdi-star-outline"></i> Product Colors</a></li>
        <li><a href="sizes.php"><i class="zmdi zmdi-star-outline"></i> Product Sizes</a></li>
        <!-- <li><a href="#"><i class="zmdi zmdi-star-outline"></i> SMTP (Email) Configure</a></li> -->
        <!--<li><a href="all-users.php"><i class="zmdi zmdi-star-outline"></i> Users</a></li>-->
        <!--<li><a href="all-vendors.php"><i class="zmdi zmdi-star-outline"></i> Vendors</a></li>-->
        <!--<li><a href="consultant-kyc.php"><i class="zmdi zmdi-star-outline"></i> Users KYC</a></li>-->
        <!--<li><a href="coupon-code.php"><i class="zmdi zmdi-star-outline"></i> Coupons Code</a></li>-->
        
      </ul>
    </li>
    
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-layers"></i>
        <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="all-users.php"><i class="zmdi zmdi-star-outline"></i> Users</a></li>
      </ul>
    </li>
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-layers"></i>
        <span>Vendors</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="all-vendors.php"><i class="zmdi zmdi-star-outline"></i> Vendors</a></li>
        
      </ul>
    </li>
    
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-layers"></i>
        <span>Users KYC</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="consultant-kyc.php"><i class="zmdi zmdi-star-outline"></i> Users KYC</a></li>
        
      </ul>
    </li>
    
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-layers"></i>
        <span>Coupons Code</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="coupon-code.php"><i class="zmdi zmdi-star-outline"></i> Coupons Code</a></li>
        
      </ul>
    </li>
  
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="vendor-pending-products.php"><i class="zmdi zmdi-star-outline"></i> Pending Approval</a></li>
        <li><a href="all-products.php"><i class="zmdi zmdi-star-outline"></i> All Products</a></li>
        <li><a href="vendor-products.php"><i class="zmdi zmdi-star-outline"></i> Vendor Products</a></li>
        <li><a href="product-feedback.php"><i class="zmdi zmdi-star-outline"></i> Products Feedback</a></li>
        <!--<li><a href="#"><i class="zmdi zmdi-star-outline"></i> Active Products</a></li>-->
      </ul>
    </li>

    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Withdrawal</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="user-withdrawal-data.php"><i class="zmdi zmdi-star-outline"></i> Withdrawal Request</a></li>
        <li><a href="user-withdrawal-data-status.php"><i class="zmdi zmdi-star-outline"></i> Withdrawal History</a></li>
      </ul>
    </li>
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Order Data</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="checkout-order-data.php"><i class="zmdi zmdi-star-outline"></i> Order Data</a></li>
        <!-- <li><a href="order-data.php"><i class="zmdi zmdi-star-outline"></i> Order Data</a></li> -->
        <!-- <li><a href="order-master.php"><i class="zmdi zmdi-star-outline"></i> Order Master</a></li> -->
      </ul>
    </li>
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-layers"></i>
        <span>Website Data</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="slider.php"><i class="zmdi zmdi-star-outline"></i> Home Slider</a></li>
        <li><a href="front-images.php"><i class="zmdi zmdi-star-outline"></i> Home Images</a></li>
        <li><a href="newsletter.php"><i class="zmdi zmdi-star-outline"></i> Newsletter</a></li>
        <li><a href="front-about.php"><i class="zmdi zmdi-star-outline"></i> Page - about</a></li>
      </ul>
    </li>

    <!-- <li> -->
      <!-- <a href="javaScript:void();" class="waves-effect"> -->
        <!-- <i class="zmdi zmdi-widgets"></i> -->
        <!-- <span>Report Master</span> <i class="fa fa-angle-left pull-right"></i> -->
      <!-- </a> -->
      <!-- <ul class="sidebar-submenu"> -->
        <!-- <li><a href="order-report.php"><i class="zmdi zmdi-star-outline"></i> Order Report</a></li> -->
        <!-- <li><a href="product-feedback.php"><i class="zmdi zmdi-star-outline"></i> Products Feedback</a></li> -->
        <!--<li><a href="#"><i class="zmdi zmdi-star-outline"></i> Active Products</a></li>-->
      <!-- </ul> -->
    <!-- </li> -->

    <?php } ?>

    <?php if($user_type=='CONSULTANT'){ ?>
      <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="consultant.php?page=all-products-consultant"><i class="zmdi zmdi-star-outline"></i> Products </a></li>
      </ul>
    </li>

    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Referral Order</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="consultant.php?page=referral-order-data"><i class="zmdi zmdi-star-outline"></i> Order Data</a></li>
        <li><a href="consultant.php?page=my-income-data"><i class="zmdi zmdi-star-outline"></i> Payment History</a></li>
      </ul>
    </li>

    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Vendor</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="consultant.php?page=vendor-list"><i class="zmdi zmdi-star-outline"></i> Vendor List</a></li>
      </ul>
    </li>

    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Withdrawal Order</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="consultant.php?page=my-withdrawal-data"><i class="zmdi zmdi-star-outline"></i> Withdrawal Data</a></li>
      </ul>
    </li>


  <?php } ?>

  <?php if ($user_type=='VENDOR') {?>
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="vendor.php?page=all-products"><i class="zmdi zmdi-star-outline"></i> All Products</a></li>
      </ul>
    </li>
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Order Data</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="vendor.php?page=order-data"><i class="zmdi zmdi-star-outline"></i> Order Data</a></li>
        <!-- <li><a href="vendor.php?page=order-master"><i class="zmdi zmdi-star-outline"></i> Order Master</a></li> -->
      </ul>
    </li>
    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-widgets"></i>
        <span>Withdrawal Commission</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="vendor.php?page=my-withdrawal-data"><i class="zmdi zmdi-star-outline"></i> Withdrawal Data</a></li>
      </ul>
    </li>
  <?php } ?>
    
    
    
  </ul>
  
</div>
<!--End sidebar-wrapper-->
<!--Start topbar header-->
<header class="topbar-nav">
  <nav class="navbar navbar-expand fixed-top bg-white">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link toggle-menu" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <form class="search-bar">
          <input type="text" class="form-control" placeholder="Enter keywords">
          <a href="javascript:void();"><i class="icon-magnifier"></i></a>
        </form>
      </li> -->
    </ul>
    
    <ul class="navbar-nav align-items-center right-nav-link">
      
      <!--    <li class="nav-item dropdown-lg">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
          <i class="fa fa-bell-o"></i><span class="badge badge-info badge-up">14</span></a>
          <div class="dropdown-menu dropdown-menu-right">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                You have 14 Notifications
                <span class="badge badge-info">14</span>
              </li>
              <li class="list-group-item">
                <a href="javaScript:void();">
                  <div class="media">
                    <i class="zmdi zmdi-accounts fa-2x mr-3 text-primary"></i>
                    <div class="media-body">
                      <h6 class="mt-0 msg-title">New Registered Users</h6>
                      <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="list-group-item"><a href="javaScript:void();">See All Notifications</a></li>
            </ul>
          </div>
        </li> -->
        
        <li class="nav-item">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
            <span class="user-profile"><img src="assets/images/avatars/avatar-13.png" class="img-circle" alt="user avatar"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-item user-details">
              <a href="javaScript:void();">
                <div class="media">
                  <div class="avatar"><img class="align-self-start mr-3" src="../user-images/<?=$user_menu_data['profile_image']?>" alt="user avatar"></div>
                  <div class="media-body">
                    <h6 class="mt-2 user-title"><?=$_SESSION['fullname']?></h6>
                    <p class="user-subtitle"><?=$user_menu_data['email']?></p>
                  </div>
                </div>
              </a>
            </li>
            <li class="dropdown-divider"></li>
            <li class="dropdown-item"><a href="profile.php"><i class="icon-wallet mr-2"></i> Account</a></li>
            <li class="dropdown-divider"></li>
            <li class="dropdown-item"><a href="password-setting.php"><i class="icon-settings mr-2"></i> Setting</a></li>
            <li class="dropdown-divider"></li>
            <li class="dropdown-item"><a href="logout.php"><i class="icon-power mr-2"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <!--End topbar header-->