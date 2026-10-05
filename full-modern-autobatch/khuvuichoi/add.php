<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
if (!$rights == 9) {
header("Location: $home");
}
$textl = 'Thêm đồ';
require('../incfiles/head.php');
require('../incfiles/lib/class.upload.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thêm đồ</div>';
if(isset($_POST['submit'])){
$id_loai = $_POST['id_loai'];
$loai = $_POST['loai'];
$loai = trim($_POST['loai']);
$chedo = $_POST['chedo'];
$chedo = trim($_POST['chedo']);
$id_loai = $_POST['id_loai'];
$loaixu = $_POST['loaixu'];
$gia = $_POST['gia'];
$hp = $_POST['hp'];
$tenvatpham = $_POST['tenvatpham'];
$kt = $_POST['kt'];
$bd = $_POST['bd'];
$tangsucmanh = $_POST['tangsucmanh'];
if($loai == 'vatpham'){
$type = '1';
}
$connect->query("INSERT INTO `quayso` SET 
`loai`='".$loai."',
`id_loai`='".$id_loai."',
`gia`='".$gia."',
`rand1`='".$bd."',
`name`='".$tenvatpham."',
`rand2`='".$kt."',
`loaixu`='".$loaixu."'
");
$insertid = mysql_insert_id();
header("Location: $home/khuvuichoi/vatpham.php?id=$insertid");
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
$handle->process('icon');
$handle->clean();
}

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
</select>';
echo'</div>';
echo'<div class="menu">';
echo'<input type="hidden" name="MAX_FILE_SIZE" value="' . (1024 * $set['flsz']) . '" />';
echo'<input type="file" name="imagefile" value="" /><br/>';
echo'Tên: <input type="text" name="tenvatpham" /><br/>';
echo'Bắt Đầu: <input type="text" name="bd" /><br/>';
echo'Kết Thúc: <input type="text" name="kt" /><br/>';
echo'ID loại: <input type="text" name="id_loai" /><br/>';
echo'Loại xu: <select name="loaixu">
<option value = "tienxu">Xu</option>
<option value = "vinaxu">Vinaxu</option>
</select><br/>';
echo'Giá: <input type="text" name="gia" />';
echo'</div>';
echo'<input type="submit" value="Lưu lại" name="submit" />';
echo'</form>';
}
echo'</div>';
require_once('../incfiles/end.php');
?>