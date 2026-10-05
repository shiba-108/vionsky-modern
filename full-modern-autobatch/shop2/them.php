<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
if (!$rights == 9) {
require('../incfiles/head.php');
header("Location: $home");
require('../incfiles/end.php');
exit;
}
$textl = 'Thêm đồ';
require('../incfiles/head.php');
require('../incfiles/lib/class.upload.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thêm đồ</div>';
if ($rights >= 9) {
if(isset($_POST['submit'])){
$loai = $_POST['loai'];
$loai = trim($_POST['loai']);
$chedo = $_POST['chedo'];
$chedo = trim($_POST['chedo']);
$id_loai = $_POST['id_loai'];
$loaixu = $_POST['loaixu'];
$gia = $_POST['gia'];
$pro = $_POST['pro'];
$hienthi = isset($_POST['hienthi']) ? 1 : 0;
$tenvatpham = $_POST['tenvatpham'];
if($loai == 'vatpham'){
$type = '1';
}
$total = count(array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/images/'.$loai.''), array('..', '.')));
$insertid = $total;

if($loaixu == 'xu'){
$connect->query("INSERT INTO `shop` SET
`loai`='".$loai."',
`id_loai`='".$insertid."',
`gia`='".$gia."',
`pro`='".$pro."',
`tenvatpham`='".$tenvatpham."',
`type`='".$type."',
`hienthi`='".$hienthi."'
");
}
if($loaixu == 'vnd'){
$connect->query("INSERT INTO `shop` SET
`loai`='".$loai."',
`id_loai`='".$insertid."',
`vnd`='".$gia."',
`pro`='".$pro."',
`tenvatpham`='".$tenvatpham."',
`type`='".$type."',
`hienthi`='".$hienthi."'
");
}
$file =  $_FILES['imagefile']['tmp_name'];
list($w, $h) = getimagesize($file);
$handle = new upload($_FILES['imagefile']);
if ($handle->uploaded) {
// Обрабатываем фото
$handle->file_new_name_body = $insertid;
//$handle->mime_check = false;
$handle->allowed = array(
'image/jpeg',
'image/gif',
'image/png'
);
$handle->file_max_size = 1024 * $set['flsz'];
$handle->file_overwrite = true;
if($w > 1000) {
$handle->image_resize = true;
$handle->image_x = 800;
$handle->image_y = false;
} else {
$handle->image_resize = false;
}
$handle->image_ratio_y = true;
$handle->image_convert = 'png';
$handle->process('../images/'.$loai.'/'.$chedo.'');
$handle->clean();
}

$file =  $_FILES['imagefile2']['tmp_name'];
list($w, $h) = getimagesize($file);
$handle = new upload($_FILES['imagefile2']);
if ($handle->uploaded) {
// Обрабатываем фото
$handle->file_new_name_body = $insertid;
//$handle->mime_check = false;
$handle->allowed = array(
'image/jpeg',
'image/gif',
'image/png'
);
$handle->file_max_size = 1024 * $set['flsz'];
$handle->file_overwrite = true;
if($w > 1000) {
$handle->image_resize = true;
$handle->image_x = 800;
$handle->image_y = false;
} else {
$handle->image_resize = false;
}
$handle->image_ratio_y = true;
$handle->image_convert = 'png';
$handle->process('../images/'.$loai.'/autoload');
$handle->clean();
}
header("Location: $home/shop/");
}else{
echo'<form enctype="multipart/form-data" method="post">';
echo'<div class="menu list-bottom congdong">';
echo'Loại: <select name="loai">
<option value = "vatpham">Vật Phẩm </option>
<option value = "toc">Tóc</option>
<option value = "ao">Áo</option>
<option value = "quan">Quần</option>
<option value = "non">Mũ</option>
<option value = "kinh">Kính</option>
<option value = "mat">Mắt</option>
<option value = "matna">Mặt Nạ</option>
<option value = "khuonmat">Khuôn Mặt</option>
<option value = "canh">Cánh</option>
<option value = "thucung">Thú Cưng</option>
<option value = "docamtay">Đồ Cầm Tay</option>
<option value = "haoquang">Hào Quang</option>
<option value = "nensau">Nền Sau</option>
</select>';
echo'</div>';
echo'<div class="menu">';
echo'<input type="hidden" name="MAX_FILE_SIZE" value="' . (1024 * $set['flsz']) . '" />';
echo'<input type="file" name="imagefile" value="" />';
echo'</div>';
echo'<div class="menu list-top hot">';
echo'Item động';
echo'</div>';
echo'<div class="menu list-top">';
echo'<input type="file" name="imagefile2" value="" />';
echo'</div>';
echo'<div class="menu list-top">';
echo'Tên item: <input type="text" name="tenvatpham" /><br/>';
echo'Loại xu: <select name="loaixu">
<option value = "xu">Xu</option>
<option value = "vnd">VNĐ</option>
</select><br/>';
echo'Giá: <input type="text" name="gia" /><br/>';
echo'</div>';
echo'<div class="menu list-top">';
echo'Không cho hiện trong shop <input type="checkbox" name="hienthi"/><br/>';
echo'</div>';
echo'<div class="menu list-top">';
echo '<select name="pro">
<option value="0"> Shop thường</option>
<option value="1"> Shop boss</option>
<option value="2"> Shop Hawaii</option>
</select><br/>';
echo'</div>';
echo'<input type="submit" value="Lưu lại" name="submit" />';
echo'</form>';
}
}
echo'</div>';
require_once('../incfiles/end.php');
?>