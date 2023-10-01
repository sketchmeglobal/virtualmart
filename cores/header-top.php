<div class="header-top">
    <div class="container">
        <div class="header-left">
            <a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a>
        </div>
        <div class="header-left ml-3">
            <a href="#"><i class="icon-envelope"></i>admin@gmail.com</a>
            </div><!-- End .header-left -->
            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul class="menus">

                                    <?php if (!isset($_SESSION['id'])) {
                                    ?>
                                    <li class="login">
                                        <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                                    </li>
                                    <li class="login">
                                        <a href="auth-consultant.php" class="font-weight-bold text-danger">Become a Consultant</a>
                                    </li>
                                    <li class="login">
                                        <a href="login.php" class="font-weight-bold text-danger">Become a Seller</a>
                                    </li>
                                    <?php }else{
                                        $check_user_role_type = single_data("SELECT user_type FROM users WHERE id = '".$_SESSION['id']."' ")['all_data'];
                                        if ($check_user_role_type['user_type']=='USER') {
                                            $dashboard_url = "account.php";
                                        }else{
                                            $dashboard_url = "backdesk/index.php";
                                        }
                                    ?>
                                    <li class="login">
                                        <a href="<?=$dashboard_url?>" class="font-weight-bold text-danger">My Account</a>
                                    </li>
                                    <li class="login">
                                        <a href="logout.php" class="font-weight-bold text-white bg-danger border border-dark px-3 py-2">Logout</a>
                                    </li>
                                    <?php
                                    } ?>
                                </ul>
                            </li>
                            </ul><!-- End .top-menu -->
                            </div><!-- End .header-right -->
                            </div><!-- End .container -->
                        </div>