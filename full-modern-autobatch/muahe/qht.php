<?php
/*
*Su kien JohnCMS
*Code viet boi Crimson
*Khong bo nguon ra xin phep ddos
**/
define('_IN_JOHNCMS', 1);
$textl = 'Mua Item Sk';
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
if ($user['luong'] < 300)
echo '<div class="menu">Bạn không đủ lượng để đổi mua vật phẩm này nhé</div>';
else {

echo'<div class="phdr">Kết Quả</div> ';
$qua= rand(1,1);


if ($qua == 1) {
echo'<div class="menu">Mua vật phẩm thành công, hãy kiểm tra ở Rương Đồ</div> ';
$time = time();
$bot = ' @'.$login.' Vừa mua [b][red]Quần hải tặc[/red][/b] Thành Công :O';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '343',
`name` = 'Ông Già Noel',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '0000',
`browser` = 'IPHONE'
");
$connect->query("INSERT INTO `kho` SET `nick`='" . $login . "',`ten`='002',`loai`='quan',`imgd`='/images/quan/002.png'");

$connect->query("UPDATE `users` SET `luong`=`luong`-300 WHERE `id` = '$user_id' LIMIT 1");
}

}
break;
default:
echo '<div class="main"><div class="phdr"><b>Khu Mua Item</b> - [<a href="/avatar/bag.php"><b>Rương Đồ</b></a>]</div>';
echo '<div class="menu"><b>Đang có ' . $datauser['luong'] . ' Lượng </b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<form action="qht.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Vật phẩm Mua</div><div class="menu"><br>Cần 300 lượng để Mua<br/><input type="submit" name="submit" value="MUA NGAY"/></form></form>';

echo'</div>';

echo'</div>';
echo'<div class="phdr">Giang Henry</div>';

break;
}

require_once ("../incfiles/end.php");
?>
