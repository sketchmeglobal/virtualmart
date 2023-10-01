<?php
if (isset($_POST['p_cat_id'])) {
include '../../function/functions.php';
$query = all_data("SELECT * FROM group_fields WHERE p_cat_id = '".$_POST['p_cat_id']."' && c_cat_id = '".$_POST['c_cat_id']."' ORDER BY gf_id DESC");

if (!empty($query['data'])) {
    echo '<div class="form-group row"> <select name="product_item" class="ml-2 form-control removed-form-control-rounded col-md-4" id="id_get_material_data" onchange="get_material_data(this.value)"><option value="" selected disabled>Select Item</option>';
   foreach ($query['all_data'] as $key => $value) {
?>
        <option value="<?=$value['gf_id']?>" <?=($_POST['ph_item']==$value['item_data']) ? 'selected':''?>><?=$value['item_data']?></option>
<?php } echo '</select><div class="material_data col-md-4"></div></div>';}} ?>



<!-- start material data fetching -->
<?php
if (isset($_POST['group_id'])) {
include '../../function/functions.php';
$q = single_data("SELECT * FROM group_fields WHERE gf_id = '".$_POST['group_id']."' ");

if (!empty($q['data'])) {
    echo '<select name="product_material" class="ml-2 form-control removed-form-control-rounded "><option value="" selected disabled>Select Material</option>';
   foreach (json_decode($q['all_data']['material_data']) as $k => $v) {

?>
        <option value="<?=$v?>" <?=($_POST['m_data']==$v) ? 'selected':''?>><?=$v?></option>
<?php } echo '</select>';}} ?>