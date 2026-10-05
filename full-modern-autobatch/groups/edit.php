<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Chỉnh sửa nhóm';
require('../incfiles/head.php');
$id= intval(abs($_GET['id']));
$dem = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'")->fetch_row()[0] ?? 0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="tb">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$nhom = nhom($id);

if($nhom['user_id']!=$user_id) {
echo '<br/><div class="tb">Bạn không đủ quyền!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Thiết lập nhóm</div>';
$ten = functions::check($_POST['ten']);
$mota = functions::check($_POST['mota']);
$riengtu = intval($_POST['riengtu']);
$dem = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `name`='$ten'")->fetch_row()[0] ?? 0);

$kt = mysqli_result($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$id."'AND `user_id`='".$user_id."' AND `duyet`='1'") ,0);
if(isset($_POST['sub'])) {
if(empty($mota)) {
echo '<div class="tb">Bạn phải nhập mô tả về nhóm!</div>';
} else if(strlen($mota) > 300) {
echo '<div class="menu">Mô tả quá dài!</div>';
} else {
$connect->query("UPDATE `nhom` SET `gt`='$mota' WHERE `id`='$id'");
header('Location:/groups/'.$id.'');
}
}
echo '<form method="post"><div class="menu list-bottom congdong">Mô tả nhóm</div><div class="menu"><textarea rows="3" name="mota">'.$nhom['gt'].'</textarea><br/ ><span class="xam">Lưu ý: Mô tả phải viết bằng tiếng việt có dấu, không sử dụng ngôn ngữ teen, nghiêm cấm spam nếu không nhóm có thể bị xoá mà không báo trước.</span></div><input type="submit" name="sub" value="Tiếp tục" /></div></form>';
echo '</div>';
require('../incfiles/end.php');
?>
