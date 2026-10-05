<?php

define('_IN_JOHNCMS', 1);
$textl = 'Pét Rồng xanh Bay';
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
if ($user['kem'] < 500)
echo '<div class="menu">Bạn không Thể Đổi</div>';
else {

echo'<div class="phdr">Kết Quả</div> ';
$qua= rand(1,1);


if ($qua == 1) {
echo'<div class="menu">Xin chúc mừng bạn đã đổi vật phẩm  <b>  Phét Rồng xanh Bay</b> thành công, hãy kiểm tra ở Rương Đồ</div> ';
$time = time();
$bot = ' @'.$login.' Vừa Nhận [b] Phét Rồng xanh Bay [/b] Thành Công Từ Giải Thưởng Sự Kiện :O';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '256',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '0000',
`browser` = 'IPHONE'
");
$connect->query("INSERT INTO `kho` SET `nick`='" . $login . "',`ten`='99',`loai`='thucung',`imgd`='/images/vatpham/99.png'");

$connect->query("UPDATE `users` SET `kem`=`kem`-500 WHERE `id` = '$user_id' LIMIT 1");
}

}
break;
default:
echo '<div class="main"><div class="phdr"><b>Khu Đổi Quà</b> - [<a href="/avatar/bag.php"><b>Rương Đồ</b></a>]</div>';
echo '<div class="menu"><b>Đổi Thưởng Từ Sự Kiện</b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<form action="petrongx.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm Sự Kiện</div><div class="menu"><img src="/images/vatpham/99.png"/><b><font color="0000ff">  PET Rồng Xanh Bay </font></b><br> Bạn Cần Có 500 Que Kem để Đổi <br/><input type="submit" name="submit" value="Đổi Quà"/></form></form>';

echo'</div>';

echo'</div>';

break;
}

require_once ("../incfiles/end.php");
?>
