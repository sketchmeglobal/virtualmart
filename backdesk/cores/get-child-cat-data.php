<?php
if (isset($_POST['p_cat_id'])) {
    $cid = $_POST['c_id'];
include '../../function/functions.php';
$query = "SELECT * FROM tbl_child_category WHERE tc_parent_cat_id = '".$_POST['p_cat_id']."' ORDER BY tccid DESC";
?>
<div class="form-group">
    <label for="input-27" class="col-form-label">Child Category</label>
    <select name="child_cat_id" id="group_fileds_child_cat" class="form-control removed-form-control-rounded" onchange="group_fileds()">
        <option value="" disabled selected>select here</option>
        <?php
        $data = all_data($query);
        foreach($data['all_data'] as $key => $row)
        {
        ?>
        <option value="<?=$row['tccid'];?>" <?=($cid==$row['tccid']) ? 'selected':''?>><?=$row['tc_name'];?></option>
        <?php } ?>
    </select>
</div>

<?php }else{echo 'invalid';} ?>