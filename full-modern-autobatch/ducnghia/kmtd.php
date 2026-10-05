<?php

define('_IN_JOHNCMS', 1);
$textl = 'Khuôn Mặt Thần đèn';
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
if ($user['kem'] < 300)
echo '<div class="menu">Bạn không Thể Đổi</div>';
else {

echo'<div class="phdr">Kết Quả</div> ';
$qua= rand(1,1);


if ($qua == 1) {
echo'<div class="menu">Xin chúc mừng bạn đã đổi vật phẩm  <b>  Khuôn Mặt Thần đèn</b> thành công, hãy kiểm tra ở Rương Đồ</div> ';
$time = time();
$bot = ' @'.$login.' Vừa Nhận [b] Khuôn Mặt Thần đèn [/b] Thành Công Từ Giải Thưởng Sự Kiện :O';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '256',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '0000',
`browser` = 'IPHONE'
");
$connect->query("INSERT INTO `kho` SET `nick`='" . $login . "',`ten`='7',`loai`='khuonmat',`imgd`='/images/khuonmat/7.png'");

$connect->query("UPDATE `users` SET `kem`=`kem`-300 WHERE `id` = '$user_id' LIMIT 1");
}

}
break;
default:
echo '<div class="main"><div class="phdr"><b>Khu Đổi Quà</b> - [<a href="/avatar/bag.php"><b>Rương Đồ</b></a>]</div>';
echo '<div class="menu"><b>Đổi Thưởng Từ Sự Kiện</b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<form action="kmtd.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm Sự Kiện</div><div class="menu"><img src="/images/khuonmat/7.png"/><b><font color="0000ff">  Khuôn Mặt Thần đèn </font></b><br> Bạn Cần Có 300 Que Kem để Đổi <br/><input type="submit" name="submit" value="Đổi Quà"/></form></form>';

echo'</div>';

echo'</div>';

break;
}

require_once ("../incfiles/end.php");
?>
