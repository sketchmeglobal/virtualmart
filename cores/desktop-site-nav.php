<div class="col-auto col-lg-3 col-xl-3 col-xxl-2 header-left">
    <div class="dropdown category-dropdown show" data-visible="false">
        <a href="#" class="text-white dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
            Browse
        </a>
        <div class="dropdown-menu">
            <nav class="side-nav">
                <ul class="menu-vertical sf-arrows">
                    <?php
                    $all_categories = "SELECT * FROM `tbl_parent_category` WHERE p_c_status=1";
                    $product_data = (all_data($all_categories)['all_data']);
                    
                    foreach($product_data as $pd){
                    // print_r($pd);
                    $ppid = $pd['p_cid'];
                    $href= 'search-result.php?cat=' . $ppid . '&q=';
                    ?>
                    <li>
                        <a href="<?=$href?>"><?=$pd['p_c_name']?></a>
                    </li>
                    
                    <?php
                    }
                    ?>
                    
                </ul>
            </nav>
        </div>
    </div>
</div>