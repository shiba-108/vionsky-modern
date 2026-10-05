<?php
/*
*Doi ca lay qua
*Code viet boi Giang Henry
*Khong bo nguon ra neu la nguoi van minh
**/
define('_IN_JOHNCMS', 1);
$textl = 'Đổi Item Sk';
$headmod = 'nick';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
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
require_once ('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require_once ('../incfiles/end.php');
exit;
}

switch($act){
case 'ok' :
if ($user['soca'] < 100)
echo '<div class="menu">Bạn không đủ cá để đổi vật phẩm này nhé</div>';
else {

echo'<div class="phdr">Kết Quả</div> ';
$qua= rand(1,1);


if ($qua == 1) {
echo'<div class="menu">Đổi vật phẩm thành công, hãy kiểm tra ở Rương Đồ</div> ';
$time = time();
$bot = ' @'.$login.' Vừa đổi [b][red]Tóc SSJ đỏ[/red][/b] thành công từ sự kiện đổi cá :O';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '343',
`name` = 'Ông Già Noel',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '0000',
`browser` = 'IPHONE'
");
$connect->query("INSERT INTO `kho` SET `nick`='" . $login . "',`ten`='011',`loai`='toc',`imgd`='/images/toc/011.png'");

$connect->query("UPDATE `users` SET `soca`=`soca`-100 WHERE `id` = '$user_id' LIMIT 1");
}

}
break;
default:
echo '<div class="main"><div class="phdr"><b>Khu Đổi cá</b> - [<a href="/avatar/bag.php"><b>Rương Đồ</b></a>]</div>';
echo '<div class="menu"><b>Đang có ' . $datauser['soca'] . ' Số cá của bạn: </b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<form action="ssjdo.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm Đổi</div><div class="menu"><br>Cần 100 con cá để đổi nhé !<br/><input type="submit" name="submit" value="Đổi Ngay"/></form></form>';

echo'</div>';

echo'</div>';
echo'<div class="phdr">Đổi cái lấy quà Mod by Giang Henry</div>';

break;
}

require_once ("../incfiles/end.php");
?>
