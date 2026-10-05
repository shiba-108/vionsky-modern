<?php
define('_IN_JOHNCMS', 1);
$textl = 'Đào Kẹo Giúp Gái';
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
if ($user['tienxu'] <= 999)
echo '<div class="menu">Bạn làm gì đủ XU mà đòi đào <img src="http://ddvn.me/images/smileys/simply/)).gif"/></div>';
else {

echo'<div class="phdr">Kết Quả</div> ';
$qua= rand(1,10);


if ($qua == 1) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}

if ($qua == 2) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 3) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 4) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 5) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 6) {
echo'<div class="menu">Xin chúc mừng bạn đã đào được <b> Keo Phép Màu</b></div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `keo`=`keo`+1 WHERE `id` = '$user_id' LIMIT 1");

$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 7) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 8) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 9) {
echo'<div class="menu">Bạn không đào được gì cả. Cố gắng lên nhé!</div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
if ($qua == 10) {
echo'<div class="menu">Xin chúc mừng bạn đã đào được <b> Keo Phép Màu</b></div> ';
echo '<form action="index2.php?act=ok" name="but" method="post"><input type="submit" name="submit" value="Đào tiếp"/></form></form>';
$connect->query("UPDATE `users` SET `keo`=`keo`+1 WHERE `id` = '$user_id' LIMIT 1");

$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-1000 WHERE `id` = '$user_id' LIMIT 1");
}
}
break;
default:


echo '<div class="main"><div class="phdr"><b>Đào keo Phép Màu</b> - [<a href="/account/ruong/"><b>Rương Đồ</b></a>]</div>';
echo '<div class="menu"><b>Tài sản ' . $datauser['tienxu'] . ' xu và ' . $datauser['vinaxu'] . ' Vina</b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<form action="index2.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm</div><div class="menu"><img src="/sukien/muahe/keo.png"/><b><font color="0000ff">Đào keo Phép Màu</font></b><br>Giá 1 lần đào là 1000 xu<br/><input type="submit" name="submit" value="Đào luôn"/></form></form>';

echo'</div>';
echo'</div>';


break;
}

require_once ("../../incfiles/end.php");
?>
