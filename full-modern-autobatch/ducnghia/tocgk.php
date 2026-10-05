<?php

define('_IN_JOHNCMS', 1);
$textl = 'Tóc Goku SS2';
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
if ($user['kem'] < 1000)
echo '<div class="menu">Bạn không Thể Đổi</div>';
else {

echo'<div class="phdr">Kết Quả</div> ';
$qua= rand(1,1);


if ($qua == 1) {
echo'<div class="menu">Xin chúc mừng bạn đã đổi vật phẩm  <b>  Tóc Goku SS2 </b> thành công, hãy kiểm tra ở Rương Đồ</div> ';
$time = time();
$bot = ' @'.$login.' Vừa Nhận [b] Tóc Goku SS2 [/b] Thành Công Từ Giải Thưởng Sự Kiện :O';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '256',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '0000',
`browser` = 'IPHONE'
");
$connect->query("INSERT INTO `kho` SET `nick`='" . $login . "',`ten`='810',`loai`='toc',`imgd`='/images/toc/810.png'");

$connect->query("UPDATE `users` SET `kem`=`kem`-1000 WHERE `id` = '$user_id' LIMIT 1");
}

}
break;
default:
echo '<div class="main"><div class="phdr"><b>Khu Đổi Quà</b> - [<a href="/avatar/bag.php"><b>Rương Đồ</b></a>]</div>';
echo '<div class="menu"><b>Nhận Thưởng Từ Sự Kiện</b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<form action="tocgk.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm Sự Kiện</div><div class="menu"><img src="/images/toc/810.png"/><b><font color="0000ff">  Tóc Goku SS2 </font></b><br> Nhận Từ Sự Kiện<br/><input type="submit" name="submit" value="Nhận Quà"/></form></form>';

echo'</div>';

echo'</div>';

break;
}

require_once ("../incfiles/end.php");
?>
