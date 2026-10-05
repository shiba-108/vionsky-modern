<?php
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
$textl = 'Tên thật của bạn'; 
$active = 1;
$active2 = 'class="active"';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tên thật của bạn</div>';
if ($rights < 6) {
    header('Location: '.$home.'/account/'.$user['id'].'');
    exit;
}
if (isset($_GET['dongy'])) {
if (isset($_GET['id'])) {
 $connect->query("UPDATE `nhom` SET
            `time` = '" . time() . "',
            `duyet` = '1' WHERE `id` = '" .$_GET['id']. "'");
    header('Location: '.$home.'/groups/duyetgroups.php');
}
}
if (isset($_GET['tuchoi'])) {
if (isset($_GET['id'])) {
$thongtinnhom = $connect->fetch_array($connect->query("SELECT * FROM `nhom` WHERE `id`='{$_GET['id']}'"));
$connect->query("update `users` set `tienxu` = `tienxu` + '200000' where `id` = '" . $thongtinnhom[user_id] . "'");
$connect->query("DELETE FROM `nhom` WHERE `id`='" .$_GET['id']. "'");
    header('Location: '.$home.'/groups/');
}
}
echo'<div class="menu congdong" style="margin-top: -2px"></div>';
$tongduyet = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `duyet` = '0'")->fetch_row()[0] ?? 0);
if ($tongduyet) {
$req = $connect->query("SELECT * FROM `nhom` WHERE `duyet` = '0'");
while ($res = $connect->fetch_array($req)) {
echo '<div class="menu list-top">Bạn '.nick($res['user_id']).'</a> đã tạo nhóm "<b>'.$res['name'].'</b>"</div>';
echo '<div class="menu"><a href="/groups/duyetgroups.php?dongy&id='.$res['id'].'">[<b>Đồng ý</b>]</a> <a href="/groups/duyetgroups.php?tuchoi&id='.$res['id'].'">[<b>Từ chối</b>]</a></div>';
}
} else {
echo'<div class="menu list-top">Hiện tại đã hết nhóm duyệt !</div>';
}
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo '</div>';
require_once ("../incfiles/end.php");
?>