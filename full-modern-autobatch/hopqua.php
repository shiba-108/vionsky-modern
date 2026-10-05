<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require_once('incfiles/core.php');
$textl = 'Hộp Quà';
require('incfiles/head.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id) {
echo functions::display_error($lng['access_guest_forbidden']);
require('incfiles/end.php');
exit;
}else{
$timenhanqua = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$user_id}'"));
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Hộp Quà</div>';
switch($act){
default:
echo 'Xác xuất nhận điểm tích lũy là 20%. <a href="?act=nhan">Nhận</a>';
break;
case 'nhan':
if ($timenhanqua['hopqua'] =='0') {
$randnhan = rand(1,5);
if($rand !=2){
$randxu = rand(500,3000);
$connect->query("UPDATE users SET
`tienxu` = `tienxu`+'{$randxu}',
`hopqua` = '1'
WHERE `id` = '{$user_id}'");
echo'<div class="menu list-bottom"><img src="/icon/giftbox.png" alt="icon" style="vertical-align: -3px;"/> Bạn vừa nhận được '.$randxu.' xu từ hộp quà xin chúc mừng !</div>';
} else {
$randdtl = rand(1,2);
$connect->query("UPDATE users SET
`diemtichluy` = `diemtichluy`+'{$randdtl}',
`hopqua` = '1'
WHERE `id` = '{$user_id}'");
echo'<div class="menu list-bottom"><img src="/icon/giftbox.png" alt="icon" style="vertical-align: -3px;"/> Bạn vừa nhận được '.$randdtl.' điểm tích lũy từ hộp quà xin chúc mừng !</div>';
}
} else {
echo'<div class="menu">';
echo '<img src="/icon/giftbox.png" alt="icon" style="vertical-align: -3px;"/> Bạn đã mở hộp quà ngày hôm nay rồi nhé !';
echo '</div>';
}
break;
}
echo '</div>';
}
require('incfiles/end.php');
?>
