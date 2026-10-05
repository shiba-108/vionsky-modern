<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Đơn xin gia nhập nhóm';
$active = 1;
$active2 = 'class="active"';
require('../incfiles/head.php');
$id = intval(abs($_GET['id']));
$sid = intval(abs($_GET['sid']));
$dem = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'")->fetch_row()[0] ?? 0);
if(!isset($id) || $dem == 0) {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi nhóm</div>';
echo '<div class="menu">Nhóm không tồn tại hoặc đã bị xoá !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
$nhom = nhom($id);
if($nhom['user_id'] != $user_id) {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi nhóm</div>';
echo '<div class="menu">Bạn không đủ quyền để vào mục này !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
if($sid == $user_id) {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi nhóm</div>';
echo '<div class="menu">Bạn không đủ quyền để vào mục này !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_GET['duyet']) && isset($_GET['sid'])) {
$kt =($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `user_id`='$sid' AND `duyet`='0'")->fetch_row()[0] ?? 0);
if($kt > 0) {
$connect->query("UPDATE `nhom_user` SET `duyet`='1' WHERE `id`='$id' AND `user_id`='$sid'");
$tdem = ($connect->query("SELECT COUNT(*) FROM `nhom_tb` WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `fr_user`='".$sid."' AND `type`='4'")->fetch_row()[0] ?? 0);
if($sid!=$user_id) {
header('Location:/groups/'.$id.'');
if($tdem==0) {
$connect->query("INSERT INTO `nhom_tb` SET `id`='".$id."', `user_id`='".$user_id."', `fr_user`='".$sid."', `type`='4', `time`='".$time."'");
} else {
$connect->query("UPDATE `nhom_tb` SET `time`='".$time."', `read`='0' WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `fr_user`='".$sid."' AND `type`='4'");}
}
}
}
if(isset($_GET['huy']) && isset($_GET['sid'])) {
$kt =($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `user_id`='$sid' AND `duyet`='0'")->fetch_row()[0] ?? 0);
if($kt > 0) {
$connect->query("DELETE FROM `nhom_user` WHERE `id`='$id' AND `user_id`='$sid'");
header('Location:/groups/'.$id.'');
}
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Đơn xin gia nhập</div>';
$tong =($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `duyet`='0'")->fetch_row()[0] ?? 0);
if($tong){
$req = $connect->query("SELECT * FROM `nhom_user` WHERE `id`='$id' AND `duyet`='0' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res = $connect->fetch_array($req)) {
echo'<div class="menu">';
echo'<img class="item" src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="Avatar"/>';
echo'Bạn <a href="/account/'.$res['user_id'].'"><b>'.nick($res['user_id']).'</b></a> muốn xin vào nhóm !</br>';
echo'<a href="/groups/'.$id.'/donxin/duyet/'.$res['user_id'].'">[<b>Duyệt</b>]</a> <a href="/groups/'.$id.'/donxin/huy/'.$res['user_id'].'">[<b>Hủy</b>]</a>';
echo '</div>';
}
if ($tong > $kmess){echo '<div class="topmenu">' . functions::display_pagination('don.php?id='.$id.'&', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="menu">Không có đơn nào xin duyệt !</div>';
}
echo '</div>';
require('../incfiles/end.php');
?>