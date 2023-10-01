<?php 

if (isset($_POST['iid'])) {
    
    include '../../function/functions.php';

    $query = "DELETE FROM tbl_product_dtl WHERE pdid = '".$_POST['iid']."'";
    
    if(unlink( '../../product-images/' . $_POST['name']) and delete($query)){
        echo 'true';    
    }else{
        echo 'false';
    }
   
}else{
    
    echo 'invalid';
    
} 
?>