<?php
/*
*lay ma kich hoat
*Code viet boi ducnghia
*Khong bo nguon ra neu la nguoi van minh
**/
define('_IN_JOHNCMS', 1);
$textl = 'Lấy mã kích hoạt miễn phí';
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
if ($user['active'] >= 1)
echo '<div class="menu">Bạn đã lấy mã kích hoạt rùi nhé!</div>';
else {

echo'<div class="phdr">Mã kích hoạt</div> ';
$qua= rand(1,1);
$kh = rand(1,99999999);

if ($qua == 1) {
echo'<div class="menu">Lấy mã kích hoạt thành công! Mã của bạn là: <font color="ff0000"><b>'.$kh.'</b></font><br/>Hãy vào đây để nhập mã kích hoạt nhé.
<a href="/ocean/kichhoat.php"><font color="ff0000"><b>Nơi nhập mã kích hoạt</b></font></a></div> ';
$time = time();
$bot = ' @[b][blue]'.$login.'[/blue][/b] Vừa lấy [b][red]Mã Kích Hoạt[/red][/b] thành công từ sự kiện kích hoạt miễn phí :O';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '2',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '0000',
`browser` = 'IPHONE'
");
$connect->query("INSERT INTO `kichhoat` SET ma = '$kh', time = '$time', mb = 'XemLaSuong.Tk'");
$connect->query("UPDATE `users` SET `cauca`=`cauca`-0 WHERE `id` = '$user_id' LIMIT 1");
}

}
break;
default:
echo '<div class="main"><div class="phdr"><a href="/ocean/kichhoat.php"><font color="ff0000"><b>Nơi nhập mã kích hoạt</b></font></a></div>';
echo '<div class="menu"><b>Khi bạn kích hoạt thành cộng. Bạn sẽ là công dân vip. Có thể sử dụng hết chức năng của MXH.</b></div>';
echo '<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $datauser['id'] . '.png" alt="'. $datauser['name'] . '" />';
echo'</div>';
echo '<form action="makh.php?act=ok" name="but" method="post">';
echo'<div class="phdr">Lấy mã Kích Hoạt</div><div class="menu"><br/><input type="submit" name="submit" value="Lấy Mã Ngay"/></form></form>';

echo'</div>';

echo'</div>';
echo'<div class="danhmuc">Lấy mã Kích Hoạt Mod by  ducnghia</div>';

break;
}

require_once ("../incfiles/end.php");
?>
