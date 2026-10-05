<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
if (!$rights >= 7) {
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
if ($rights >= 7) {
if(isset($_POST['submit'])){
$tenvatpham = $_POST['tenvatpham'];
$tangsucmanh = $_POST['tangsucmanh'];
$hp = $_POST['hp'];
$point_need = $_POST['need'];
$loai = $_POST['loai'];
//// import
$nhapurl = trim($_POST['nhapurl']);
$nhapurlauto = trim($_POST['nhapurlauto']);
////
if($loai == 'vatpham'){
$type = '1';
}
//--Mod sự kiện bởi Trần Văn Hoài--//
$total = count(array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/images/'.$loai.''), array('..', '.')));
$insertid = $total-2;

if (mb_strlen($nhapurl) > 7) {
$img = '../images/'.$loai.'/'.$insertid.'.png';
file_put_contents($img, file_get_contents($nhapurl));
} if (mb_strlen($nhapurlauto) > 7) {
$imgauto = '../images/'.$loai.'/teentvh/'.$insertid.'.png';
file_put_contents($imgauto, file_get_contents($nhapurlauto));
}

    $connect->query("INSERT INTO `sukien` SET 
`loai`='".$loai."',
`id_loai`='".$insertid."',
`tenvatpham`='".$tenvatpham."',
`tanghp`='".$hp."',
`tangsucmanh`='".$tangsucmanh."',
`point_need` = '".$point_need."'
");
    $connect->query("INSERT INTO `shop` SET 
`loai`='".$loai."',
`id_loai`='".$insertid."',
`tenvatpham`='".$tenvatpham."',
`hp`='".$hp."',
`tangsucmanh`='".$tangsucmanh."',
`hienthi` = '1'
");


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
//--Mod sự kiện bởi Trần Văn Hoài--//


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
$handle->process('../images/'.$loai.'/teentvh');
$handle->clean();
}
//--Mod sự kiện bởi Trần Văn Hoài--//
header("Location: $home/sukien");
}else{
echo'<form enctype="multipart/form-data" method="post">';
echo'<div class="list-me">';
echo'Loại: <select name="loai">
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
echo'<div class="list-me">';
echo'<input type="hidden" name="MAX_FILE_SIZE" value="' . (1024 * $set['flsz']) . '" />';
echo'<input type="file" name="imagefile" value="" />';
echo'</div>';
echo'<div class="list-me">';
echo'Nhập URL: <input type="text" name="nhapurl" value="http://">';
echo'</div>';
echo'<div class="list-me">';
echo'Item động';
echo'</div>';
echo'<div class="list-me">';
echo'<input type="file" name="imagefile2" value="" />';
echo'</div>';
echo'<div class="list-me">';
echo'Nhập URL: <input type="text" name="nhapurlauto" value="http://">';
echo'</div>';

echo'<div class="list-me">';
echo'Tên Item: <input type="text" name="tenvatpham" /><br/>';
echo'</div><div class="list-me">';
echo'Tăng sức mạnh: <input type="text" name="tangsucmanh" /><br/>';
echo'</div><div class="list-me">';
echo'Tăng HP: <input type="text" name="hp" /><br/>';
echo'</div><div class="list-me">';
echo'Điểm cần: <input type="text" name="need" /><br/>';
echo'</div>';
echo'<input type="submit" value="Lưu lại" name="submit" />';
echo'</form>';
}
}
echo'</div>';
require_once('../incfiles/end.php');
?>
