<?php
include_once './function/functions.php';
?>
<div class="header-middle">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto col-lg-3 col-xl-3 col-xxl-2">
                <button class="mobile-menu-toggler">
                <span class="sr-only">Toggle mobile menu</span>
                <i class="icon-bars"></i>
                </button>
                <a href="index.php" class="logo">
                    <!-- <img src="assets/images/demos/demo-14/logo.png" alt="Sreyhva Logo" width="105" height="25"> -->
                    <h2><?=site_name?></h2>
                </a>
                </div><!-- End .col-xl-3 col-xxl-2 -->
                
                <div class="col col-lg-9 col-xl-9 col-xxl-10 header-middle-right">
                    <div class="row">
                        <div class="col-lg-8 col-xxl-4-5col d-lg-block">
                            <div class="header-search header-search-extended header-search-visible header-search-no-radius">
                                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                                <form action="search-result.php" method="get">
                                    <div class="header-search-wrapper search-wrapper-wide">
                                        <div class="select-custom">
                                            <select class="" id="cat" name="cat">
                                                <option disabled selected>All Categories</option>
                                                <?php
                                                $all_categories = "SELECT * FROM `tbl_parent_category` WHERE p_c_status=1";
                                                $product_data = (all_data($all_categories)['all_data']);
                                                
                                                foreach($product_data as $pd){
                                                ?>
                                                <option <?= (isset($_GET['cat'])== $pd['p_cid']) ? 'selected' : '' ?> value="<?=$pd['p_cid']?>"> - <?=$pd['p_c_name']?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            </div><!-- End .select-custom -->
                                            <label for="q" class="sr-only">Search</label>
                                            <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." value="<?=isset($_GET['q'])?>" required>
                                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                            </div><!-- End .header-search-wrapper -->
                                        </form>
                                        </div><!-- End .header-search -->
                                        </div><!-- End .col-xxl-4-5col -->
                                        <div class="col-lg-4 col-xxl-5col d-flex justify-content-end align-items-center">
                                            <div class="header-dropdown-link">
                                                <div class="dropdown compare-dropdown">
                                                    <!-- <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
                                                        <i class="icon-random"></i>
                                                        <span class="compare-txt">Compare</span>
                                                    </a> -->
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="compare-products">
                                                            <li class="compare-product">
                                                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                                                <h4 class="compare-product-title"><a href="product.html">Blue Night Dress</a></h4>
                                                            </li>
                                                            <li class="compare-product">
                                                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                                                <h4 class="compare-product-title"><a href="product.html">White Long Skirt</a></h4>
                                                            </li>
                                                        </ul>
                                                        <div class="compare-actions">
                                                            <a href="#" class="action-link">Clear All</a>
                                                            <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></a>
                                                        </div>
                                                        </div><!-- End .dropdown-menu -->
                                                        </div><!-- End .compare-dropdown -->
                                                        <!-- Header Wishlist Section -->
                                                        <?php include 'cores/wishlist-header.php' ?>
                                                        
                                                        <!-- Header Cart Section -->
                                                        <?php include 'cart-header.php' ?>
                                                        <!-- End .cart-dropdown -->
                                                    </div>
                                                    </div><!-- End .col-xxl-5col -->
                                                    </div><!-- End .row -->
                                                    </div><!-- End .col-xl-9 col-xxl-10 -->
                                                    </div><!-- End .row -->
                                                    </div><!-- End .container-fluid -->
                                                </div>