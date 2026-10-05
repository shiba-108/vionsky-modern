<?php

define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Đuổi khỏi phòng';
require('../incfiles/head.php');
if(!$user_id) {
echo '<div class="rmenu">Chỉ dành cho thành viên. Vui lòng đăng nhập!</div>';
}
$id = intval(abs($_GET['id']));
$nick = intval(abs($_GET['nick']));
$kiemtra = ($connect->query("SELECT COUNT(*) FROM `boss` WHERE `id`='".$id."'")->fetch_row()[0] ?? 0);
$kick = @$connect->fetch_array($connect->query("SELECT * FROM `boss` WHERE `id`='".$id."'"));
if($kiemtra == 0 || empty($id)) {
echo '<div class="menu">Phòng không tồn tại hoặc đã bị xoá !</div>';
require('../incfiles/end.php');
exit;
}
if($user_id!=$kick['user_id']) {
echo '<div class="rmenu">Bạn không phải chủ phòng !</div>';
require('../incfiles/end.php');
exit;
}
if($kick['wait']!=3) {
if ($nick == 1) {
$connect->query("UPDATE `boss` SET `nguoichoi`='0' WHERE `id`='".$id."'");
}
if ($nick == 2) {
$connect->query("UPDATE `boss` SET `nguoichoi2`='0' WHERE `id`='".$id."'");
}
if ($nick == 3) {
$connect->query("UPDATE `boss` SET `nguoichoi3`='0' WHERE `id`='".$id."'");
}
header("Location: /boss/$id");
}
require('../incfiles/end.php');
?>
