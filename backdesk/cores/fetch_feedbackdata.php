<?php
if (isset($_POST['fid'])) {
   include '../../function/functions.php';
   
   $sql = "SELECT * FROM user_feedback WHERE id=".$_POST['fid'];
   $rd = single_data($sql)['all_data'];
   echo $rd['rating']. '##@##' . $rd['review']. '##@##' . $rd['status'];
}
?>