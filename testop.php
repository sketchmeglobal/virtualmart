 <div class="col-md-6">
               <?php 
               $gallery_explode = explode(',', $product_data_fun['all_data']['ph_gallery_img']);
                ?>
                    <div class="img-magnifier-container">
                          <img class="imageBox" id="myimage" src="https://www.jqueryscript.net/dummy/4.jpg" width="600" height="400" >
                    </div>
                <div id="" class="d-flex justify-content-center">
                    <?php 
                    for ($i=0; $i < count($gallery_explode); $i++) {
                        if($gallery_explode[$i] !=''){
                     ?>
                    <a href="javaScript:void(0)" onclick="image_src('<?=$gallery_explode[$i]?>')" data-image="product-images" data-zoom-image="product-images/<?=$gallery_explode[$i]?>">
                        <img id="<?=$i?>" src="product-images/<?=$gallery_explode[$i]?>" style="width: 100px;height: 55px;" class="img_zoom_<?=$i?>" onclick="myFunction(this)"/>
                    </a>

                <?php }} ?>
                </div>

            </div><!-- End .col-md-6 -->
            
            <script>

        function myFunction(smallImg) {
            var fullImg = document.querySelector(".imageBox");
            fullImg.src = smallImg.src;
        }

    </script>
            <!--ONLY--TEST--THIS TEST ONLY FOR PRODUCT SECTION -->