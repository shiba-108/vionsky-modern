<?php
define('_IN_JOHNCMS', 1);
$noionline = 'home';
require('incfiles/core.php');
if (isset($_SESSION['ref']))
unset($_SESSION['ref']);
if (isset($_GET['error']))
$act = 404;
switch ($act) {
case '404':
$headmod = 'error404';
$textl = 'Đường dẫn hỏng';
require('incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Lỗi đường dẫn</div>';
echo '<div class="menu" style="color:red">Đường dẫn bạn vừa nhập không tồn tại hoặc đã bị xóa khỏi trang mong bạn thông cảm <br><div class="menu" style="color:green">code mod by Đức Nghĩa cần gì liên hệ fb.com/ducnghiaprovn</div>';
echo'</div>';
break;
default:
if (isset($_SESSION['ref']))
unset($_SESSION['ref']);
$page = ($_GET['trang']);
if ( $page >1 ){
$vina4u = ' | Page'.$page.'';
}
$page1 = ($_GET['page']);
if ( $page1 >1 ){
$vina4u1 = ' | Page '.$page1.'';
}
$textl = 'Mạng Xã HỘi Giải Trí Việt Nam';
$mota = 'Mạng xã hội giải trí cho tất cả mọi người trên toàn lãnh thổ Việt Nam và nước ngoài';
require('incfiles/head.php');
include 'systems/home-taikhoan.php';
include 'systems/home-game.php';
include 'systems/home-chatbox.php';
include 'systems/home-chude.php';
include 'systems/home-nhom.php';
include 'systems/home-menu.php';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thành viên online</div>';
echo'<div class="menu" style="text-align:left;">';
function show_online($user = array(), $status = 0, $ip = 0, $str = '', $text = '', $sub = '') { global $set_user, $realtime, $user_id, $admp, $home;
$out = false;
$out .= '<a href="/account/' . $user['id'] . '/' . functions::khongdau($user['name']) . '">'.nick($user['id']).'</a>, ';
return $out;
}
function timecount($var) {
if ($var < 0)
$var = 0;
$day = ceil($var / 86400);
if ($var > 345600) {
$str = $day . ' Giờ';
} elseif ($var >= 172800) {
$str = $day . ' Рhút';
} elseif ($var >= 86400) {
$str = '1 Giây';
} else {
$str = gmdate('G:i:s', $var);
}
return $str;
}
$on = $_GET['on'];
switch($on) {
default:
$total = ($connect->query("SELECT COUNT(*) FROM `" . ($act == 'guest' ? 'cms_guests' : 'users') . "` WHERE `lastdate` > '" . (time() - 1200) . "'")->fetch_row()[0] ?? 0);
if ($total > 0) {
$req = $connect->query("SELECT * FROM `" . ($act == 'guest' ? 'cms_guests' : 'users') . "` WHERE `preg`='1' and `lastdate` > '" . (time() - 1200) . "' ORDER BY " . ($act == 'guest' ? "`movings` DESC" : "`name` ASC") . " LIMIT 30");
while ($res = $connect->fetch_assoc($req)) {
echo show_online($res, 0, ($act == 'guest' || ($rights >= 1 && $rights >= $res['rights']) ? ($rights >= 6 ? 2 : 1) : 0), ' (' . $res['movings'] . ' - ' . timecount($realtime - $res['sestime']) . ') ' . $place);
++$l;
}
}
break;
}
echo'</div></div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chú thích</div>';
echo'<img src="/icon/bqt/ad.gif" alt="icon"/><b style="color:#ff1234;">Adminitrators</b> - <img src="/icon/bqt/sm.gif" alt="icon"/><b style="color:#7f1ea6;">S-Moderators</b> - <img src="/icon/bqt/m.gif" alt="icon"/><b style="color:#008000;">Moderators</b> - <img src="/icon/bqt/p.gif" alt="icon"/><b style="color:#555555;">Police</b> - <img src="/icon/bqt/tm.gif" alt="icon"/><b style="color:peru;">Trial Mod</b> - <img src="/images/vip.gif" alt="icon"/><b style="color:#417394;">VIP đặc biệt</b> - <b style="color:red;">[V.I.P]</b>thường - <img src="/icon/tunhan.png" alt="icon"/><b style="color:black;">Tù nhân</b></div>';
echo'</div>';
}
require('incfiles/end.php');
