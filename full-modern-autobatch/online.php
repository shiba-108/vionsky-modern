<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('incfiles/core.php');
$lng_forum = core::load_lng('forum');
$textl = 'Thành viên online';
require ('incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thành viên online</div>';
echo'<div class="menu" style="text-align: center;">';
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
$total = ($connect->query("SELECT COUNT(*) FROM `" . ($act == 'guest' ? 'cms_guests' : 'users') . "` WHERE `lastdate` > '" . (time() - 300) . "'")->fetch_row()[0] ?? 0);
if ($total > 0) {
$req = $connect->query("SELECT * FROM `" . ($act == 'guest' ? 'cms_guests' : 'users') . "` WHERE `preg`='1' and `lastdate` > '" . (time() - 300) . "' ORDER BY " . ($act == 'guest' ? "`movings` DESC" : "`name` ASC") . " LIMIT 30");
while ($res = $connect->fetch_assoc($req)) {
echo show_online($res, 0, ($act == 'guest' || ($rights >= 1 && $rights >= $res['rights']) ? ($rights >= 6 ? 2 : 1) : 0), ' (' . $res['movings'] . ' - ' . timecount($realtime - $res['sestime']) . ') ' . $place);
++$l;
}
}
break;
}
echo'</div>';
echo'</div>';
require ('incfiles/end.php');