<?php
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
$textl = 'Tên thật của bạn'; 
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tên thật của bạn</div>';
if ($rights < 6) {
    header('Location: '.$home.'/account/'.$user['id'].'');
    exit;
}
if (isset($_GET['dongy'])) {
if (isset($_GET['id'])) {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$_GET['id']."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$_GET['id']."',
            `time` = '" . time() . "',
            `type` = 'e'
        ");
 $connect->query("UPDATE `tenthat` SET
            `time` = '" . time() . "',
            `duyet` = '1' WHERE `user_id` = '" .$_GET['id']. "'");
    header('Location: '.$home.'/account/duyetten.php');
}
}
if (isset($_GET['tuchoi'])) {
if (isset($_GET['id'])) {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$_GET['id']."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$_GET['id']."',
            `time` = '" . time() . "',
            `type` = 'y'
        ");
$connect->query("DELETE FROM `tenthat` WHERE `user_id`='" .$_GET['id']. "'");
    header('Location: '.$home.'/account/duyetten.php');
}
}
echo'<div class="menu congdong" style="margin-top: -2px">BQT chỉ duyệt sử dụng họ tên thật của người ấy VD: <b>Hoàng Xuân Phúc</b> nếu phát hiện đổi tên bậy band 1 tuần !</div>';
$tongduyet = ($connect->query("SELECT COUNT(*) FROM `tenthat` WHERE `duyet` = '0'")->fetch_row()[0] ?? 0);
if ($tongduyet) {
$req = $connect->query("SELECT * FROM `tenthat` WHERE `duyet` = '0'");
while ($res = $connect->fetch_array($req)) {
echo '<div class="menu list-top">Bạn '.nick($res['user_id']).'</a> muốn đặt tên thật là "<b>'.$res['ten'].'</b>"</div>';
echo '<div class="menu"><a href="/account/duyetten.php?dongy&id='.$res['user_id'].'">[<b>Đồng ý</b>]</a> <a href="/account/duyetten.php?tuchoi&id='.$res['user_id'].'">[<b>Từ chối</b>]</a></div>';
}
} else {
echo'<div class="menu list-top">Hiện tại đã hết người duyệt !</div>';
}
echo '</div>';
require_once ("../incfiles/end.php");
?>