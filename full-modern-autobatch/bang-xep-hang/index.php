<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('../incfiles/core.php');
$textl = 'Bảng Xếp Hạng';
require ('../incfiles/head.php');

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Top Xu</div>';
$req = $connect->query("SELECT * FROM `users` ORDER BY `tienxu` DESC LIMIT 5");
while ($res = $connect->fetch_array($req)) {
$thongtindoithu = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$res['user_id']."'"));
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/account/'.$res['id'].'"><b>'.nick($res['id']).'</b></a><br/>
Xu: '.$res['tienxu'].'
</div>';
}
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Top VinaXu</div>';
$req = $connect->query("SELECT * FROM `users` WHERE `vinaxu`>'0' ORDER BY `vinaxu` DESC LIMIT 5");
while ($res = $connect->fetch_array($req)) {
$thongtindoithu = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$res['user_id']."'"));
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/account/'.$res['id'].'"><b>'.nick($res['id']).'</b></a><br/>
Xu: '.$res['vinaxu'].'
</div>';
}
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Top Đấu trường</div>';
$req = $connect->query("SELECT `user_id` FROM `nhanvat` ORDER BY `sucmanh` DESC LIMIT 5");
while ($res = $connect->fetch_array($req)) {
$thongtindoithu = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$res['user_id']."'"));
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/account/'.$res['user_id'].'"><b>'.nick($res['user_id']).'</b></a><br/>
Sức mạnh: '.$thongtindoithu['sucmanh'].'
</div>';
}
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Top Bài Viết</div>';
$req = $connect->query("SELECT * FROM `users` ORDER BY `postforum` DESC LIMIT 5");
while ($res = $connect->fetch_array($req)) {
$thongtindoithu = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$res['user_id']."'"));
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/account/'.$res['id'].'"><b>'.nick($res['id']).'</b></a><br/>
Bài viết: '.$res['postforum'].'
</div>';
}
echo'</div>';
require ('../incfiles/end.php');