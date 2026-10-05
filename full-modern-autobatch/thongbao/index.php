<?php
define('_IN_JOHNCMS', 1);
$noionline = 'congvien';
require('../incfiles/core.php');
$textl = 'Panel Notice';
$mota = 'Nơi hội tụ các bạn chém gió và các sự kiện mới nhất từ các NPC';
require('../incfiles/head.php');
if ($rights <= 8) {
echo'<div class="menu">Chỉ BQT mới được sử dụng chức năng này !</div>';
echo'</div>';
require_once ('../incfiles/end.php');
exit;
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Panel'.($rights >= 6 ? ' [<a href="/thongbao/?dondep">Dọn dẹp</a>]':'').'</div>';
if(isset($_GET['dondep'])){
if ($rights >= 9) {
if(isset($_POST['submit'])) {
header("Location: $home");
$connect->query("DELETE FROM `thongbao_head`");
} else {
echo '<div class="menu list-bottom congdong"><form method="post">Bạn có muốn dọn dẹp không !<br /><input type="submit" name="submit" value="Dọn dẹp" /></form></div>';
}
} else {
header("Location: $home/thongbao/");
}
}
if(isset($_POST['submitchat'])) {
$noidungchat = bbcode::notags($noidungchat);
$noidungchat = isset($_POST['noidungchat']) ? functions::checkin(trim($_POST['noidungchat'])) : '';
if(empty($_POST['noidungchat'])) {
echo '<div class="menu">Bạn đã nhập nội dung đâu</div>';
} else if(strlen($_POST['noidungchat']) < 2) { // 2 là số kí tự ít nhất
echo '<div class="menu">Bạn phải viết trên 5 kí tự</div>';
} else if(strlen($_POST['noidungchat']) > 5000) {
echo '<div class="menu">Bạn không được viết quá 5000 kí tự</div>';
} else {
if($user_id){
$connect->query("INSERT INTO `thongbao_head` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
header('Location: '.$home.'/thongbao/');
}
}
}
if($user_id){
if (!$is_mobile) {
echo '<div class="menu list-bottom">';
} else {
echo '<div class="menu list-bottom congdong">';
}
echo'<form name="text" method="post">';
echo'<input name="noidungchat" type="text">';
echo'<input type="submit" name="submitchat" value="Gửi"/>';
echo'</form>';
echo'</div>';
} else {
}
$tong = ($connect->query("SELECT COUNT(*) FROM `thongbao_head`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `thongbao_head` ORDER BY `time` DESC LIMIT $start, $kmess");
while ($vina4u = $connect->fetch_assoc($req)) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'"));
echo $i % 2 ? '<div class="menu list-bottom">' : '<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td>';
echo (time() > $thongtin['lastdate'] + 300 ? '<img src="/icon/offline.png" title="OFF"/> ' : '<img src="/icon/online.png" title="ON"/> ');
echo'<a href="/account/'.$vina4u['user_id'].'">'.nick($vina4u['user_id']).'</a>: ';
echo'</span></div>';
echo'<div class="box_ndung_bviet">';
$ban = ($connect->query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" .$vina4u['user_id']. "' AND `ban_time` > '" . time() . "'")->fetch_row()[0] ?? 0);
if($ban > 0) {
echo'******bài viêt ẩn******';
} else {
$vina4u['text'] = functions::checkout($vina4u['text'], 1, 1);
echo functions::smileys(bbcode::tags($vina4u['text']));
}
echo' <span style="font-size:12px;color:#777;">' . functions::thoigian($vina4u['time']) . '</span>'.($rights >= 6 ? ' <a href="'.$urlhientai.'/del/'.$vina4u[id].'">[x]</a>':'').'';
if(isset($_GET['comment'])){
$id = intval(abs($_GET['del']));
if ($id && $id == $vina4u[id]) {
if ($rights >= 6) {
if(isset($_POST['submit'])) {
header("Location: $home/thongbao/");
$connect->query("DELETE FROM `thongbao_head` WHERE `id` = '$id'");
} else {
echo '<div class="menu"><form method="post"><input type="submit" name="submit" value="Xoá" /></form></div>';
}
} else {
header("Location: $home/thongbao/");
}
}
}
echo '</td></tr></tbody></table></div>';
$i++;
}
} else {
echo '<div class="menu list-bottom">Chưa có ai chát !</div>';
}
if ($tong > $kmess) {
echo '<div class="menu">' . functions::phan_trang('/thongbao/', $start, $tong, $kmess) . '</div>';
}
echo'</div>';
require('../incfiles/end.php');
