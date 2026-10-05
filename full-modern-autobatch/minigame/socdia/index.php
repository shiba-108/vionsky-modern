<?php
define('_IN_JOHNCMS', 1);
session_name("SESID");
session_start();
$textl = 'Xóc Dĩa';
$rootpath = '../';
$noionline = 'socdia';
require_once ("../../incfiles/core.php");
require_once ("../../incfiles/head.php");
$act = isset($_GET['act']) ? $_GET['act'] : '';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Xóc Dĩa</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../../incfiles/end.php');
exit;
}
echo' <div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['tienxu'].' xu</div>';
$rand = mt_rand(100, 999);
$money_minus = "100";

if (!empty($_SESSION['uid'])) {

switch ($act) {
case "go":
echo '<div class="menu">';

$cuoc = intval(abs($_POST['cuoc']));
$thimble = intval($_POST['thimble']);

if(isset($_POST['submit'])) {
if ($datauser['tienxu'] >= $cuoc) {
if($cuoc <= 2000) {
if($cuoc >= 100) {
if (!empty($thimble)) {

$rand_thimble = mt_rand(1, 2);


if ($rand_thimble == "1") {
echo 'Mở Dĩa Là "<b>Chẵn</b>"';
} else {
}

if ($rand_thimble == "2") {
echo 'Mở Dĩa Là "<b>Lẻ</b>"';
} else {
}
if ($thimble == $rand_thimble) {
$money_plus_c = ($datauser['tienxu'] + $cuoc);
$connect->query("update `users` set `tienxu` ='" . $money_plus_c . "' WHERE `id` = '$user_id'");
echo '<div class="menu">Bạn đã <b>thắng</b> bạn sẽ nhận được '.($cuoc).' xu</div>';
} else {
$money_minus_с = ($datauser['tienxu'] - $cuoc);
$connect->query("update `users` set `tienxu`='" . $money_minus_с . "' WHERE `id` = '$user_id'");
echo '<div class="menu">Bạn đã <b>thua</b> bạn bị trừ '.$cuoc.' xu</div>';
}


} else {
echo '<div class="menu">Bạn phải chọn Chẵn hoặc Lẻ</div>';
}
echo '<div class="menu"><a href="/minigame/socdia/">Tiếp tục chơi</a></div>';
} else {
echo '<div class="menu">Số tiền đặt cược phải trên 100 Xu</div>';
echo '<div class="menu"><a href="/minigame/socdia/">Tiếp tục chơi</a></div>';
}
} else {
echo '<div class="menu">Số tiền đặt cược phải nhỏ hơn 2000 Xu</div>';
echo '<div class="menu"><a href="/minigame/socdia/">Tiếp tục chơi</a></div>';
}
} else {
echo '<div class="menu">Bạn không đủ tiền để chơi!</div>';
echo '<div class="menu"><a href="/minigame/socdia/">Tiếp tục chơi</a></div>';
}
} else {
echo '<div class="menu" align="center">Có lỗi xảy ra!</div>';
}
echo '</div>';
break;

default:
echo'<div class="menu">';
echo'<table cellpadding="0" cellspacing="0"><tr><td>';
echo'<img src="/icon/xocdia.png" alt="Xoc"/>';
echo'&#160;</td><td>';
echo '<div class="menu"><form action="?act=go" method="post">
<input type="radio" name="thimble" value="1">Chẵn<br/>
<input type="radio" name="thimble" value="2">Lẻ<br/>';
echo'</td></tr></table>';
echo '</div>';
echo'<div class="menu list-top">';
echo'<input type="text" name="cuoc" value=""><br><input type="submit" name="submit" value="Chơi"></form>';
echo '</div>';

break;
}


} else {
echo '<div class="rmenu">Bạn cần <a href="' . $home . '/login.php">Đăng Nhập</a> mới có thể bắt đầu cuộc chơi.<br/>';
echo 'Đăng Ký Tại: <a href="' . $home . '/registration.php">Đây</a></div>';
}
echo '</div>';
require_once ("../../incfiles/end.php");
?>