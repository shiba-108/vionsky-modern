<?php
/*///////////////////////
//Diendanvn.me
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
require('../incfiles/lib/class.upload.php');

$textl= 'Up ảnh avatar nhóm';
$active = 1;
$active2 = 'class="active"';
require('../incfiles/head.php');
$id = intval(abs($_GET['id']));
$dem = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'")->fetch_row()[0] ?? 0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="tb">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$nhom = nhom($id);

if($nhom['user_id'] != $user_id) {
echo '<br/><div class="menu">Không đủ quyền!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Up avatar nhóm</div>';
if(isset($_POST['submit'])) {
$handle = new upload($_FILES['imagefile']);
if($handle->uploaded) {
$handle->file_new_name_body = $id;
//$handle->mime_check = false;
$handle->allowed = array('image/jpeg',
'image/gif',
'image/png');
$handle->file_max_size = 1024 * $set['flsz'];
$handle->file_overwrite = true;
$handle->image_resize = true;
$handle->image_x = 100;
$handle->image_y = 100;
$handle->image_convert ='png';
$handle->process('avatar/');
if ($handle->processed) {
header('Location: /groups/'.$id.'');
} else {
echo functions::display_error($handle->error);
}
$handle->clean();
}
} else {
echo'<div class="menu list-bottom congdong">Bạn hãy up ảnh logp phù hợp cho nhóm của bạn, Cấm up ảnh đồi bại nếu phát hiện xóa hội band vĩnh viễn !</div>';
echo'<div class="menu"><form method="post" enctype="multipart/form-data"><input type="file" name="imagefile" value=""/><input type="hidden" name="MAX_FILE_SIZE" value="'. (1024 * $set['flsz']) .'"/><br/><input type="submit" name="submit" value="Tải ảnh" /></div></form>';
}
echo '<div class="menu list-top congdong"><a href="page.php?id='.$id.'">Trở về nhóm</a></div>';
echo '</div>';
require('../incfiles/end.php');
?>
