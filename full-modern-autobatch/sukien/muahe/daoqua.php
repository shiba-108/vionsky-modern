<?php
define('_IN_JOHNCMS', 1);
$textl = 'Đào Quà Cứu OzaWa';
$headmod = 'nick';
require_once ("../../incfiles/core.php");
require_once ("../../incfiles/head.php");
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);
}
else {
}
}
else {
$id = false;
$user = $datauser;
}
if (!$user_id) {
require_once ('../../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require_once ('../../incfiles/end.php');
exit;
}

switch($act){
case 'ok' :
if ($user['vinaxu'] <= 0)
echo '<div class="menu">Bạn làm gì đủ vina mà đòi đào <img src="http://ddvn.me/images/smileys/simply/)).gif"/></div>';
else {

echo'<div class="phdr">Kết Quả</div> ';
$qua= rand(1,10);


if ($qua == 1) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}

if ($qua == 2) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 3) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 4) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 5) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 6) {
echo'<div class="menu">Xin chúc mừng bạn đã đào được <b>hộp quà</b></div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `hopqua1`=`hopqua1`+1 WHERE `id` = '$user_id' LIMIT 1");

$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 7) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 8) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 9) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 10) {
echo'<div class="menu">Xin chúc mừng bạn đã đào được <b>hộp quà</b></div> ';
echo '<form action="daoqua.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `hopqua1`=`hopqua1`+1 WHERE `id` = '$user_id' LIMIT 1");

$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-1 WHERE `id` = '$user_id' LIMIT 1");
}
}
break;
default:


echo '<div class="main"><div class="phdr"><b>Đào Hộp Quà - Cứu OzaWa về Nhựt Bổn</b> - [<a href="/account/ruong/"><b>Rương Đồ</b></a>]</div>';
echo '<div class="menu"><b>Tài sản ' . $datauser['tienxu'] . ' Xu và ' . $datauser['vinaxu'] . ' Vina</b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<form action="daoqua.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm</div><div class="menu"><img src="/sukien/muahe/qua.png"/><b>Hãy đào hộp quà giúp <b>ozawa</b> về nhật nhé :D<br/><font color="0000ff">Đào hộp quà</font></b><br>Giá 1 lần đào là 1 vina<br/><input type="submit" name="submit" value="Đào luôn"/></form></form>';

echo'</div>';
echo'</div>';
break;
}
echo'<div class="phdr">Event Mod By XemLaSuong.TK</div>';
require_once ("../../incfiles/end.php");
?>
