<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$id = intval(abs($_GET['id']));
$nhom = $connect->fetch_array($connect->query("SELECT * FROM `nhom` WHERE `id`='".$id."'"));
$textl = 'Thành viên nhóm '.$nhom[name];
$active = 1;
$active2 = 'class="active"';
require('../incfiles/head.php');
switch($act) {
default:
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thành viên nhóm '.$nhom[name].'</div>';
$thanhvien = mysqli_result($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$id."' AND `duyet`='1'") ,0);
echo '<div class="menu congdong" style="margin-top: -2px">Nhóm có '.$thanhvien.' thành viên tham gia</div>';
$tong =($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `duyet`='1'")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `nhom_user` WHERE `id`='$id' AND `duyet`='1' ORDER BY `rights` DESC LIMIT $start,$kmess");
while($res = $connect->fetch_array($req)) {
$baiviet = mysqli_result($connect->query("SELECT COUNT(*) FROM `forum` WHERE `groups`='".$id."' AND `user_id`='".$user_id."' AND `type` = 't'") ,0);
if ($res[rights] == 0) {$chucvi = 'Thành viên chính'; }
if ($res[rights] == 1) {$chucvi = '<span style="color:green">Quản lý nhóm</span>'; }
if ($res[rights] == 2) {$chucvi = '<span style="color:red">Sáng viên nhóm</span>'; }
echo'<div class="menu list-top">';
echo'<img class="item" src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="Avatar"/>';
echo'<a href="/account/'.$res['user_id'].'"><b>'.nick($res['user_id']).'</b></a> ';
echo''.($res['user_id']!=$user_id && $nhom['user_id']==$user_id ? ''.($res['user_id']!=$user_id && $nhom['user_id']==$user_id ? ''.($res['rights'] == 1 ? '<a href="member.php?id='.$id.'&act=hachuc&nick='.$res['user_id'].'" style="color:green;">[Hạ chức]</a>':'<a href="member.php?id='.$id.'&act=phongchuc&nick='.$res['user_id'].'" style="color:green;">[Phong chức]</a>').'':'').'':'').' '.($res['user_id']!=$user_id && $nhom['user_id']==$user_id || $res['user_id']!=$user_id && $res['right']>=1 ? '<a href="member.php?id='.$id.'&act=duoi&nick='.$res['user_id'].'" style="color:red;">[Đuổi]</a>':'').'';
echo'</br/>Chức vị: '.$chucvi;
echo'</br/>Bài viết tại nhóm: '.$baiviet;
echo'</div>';
}
if ($tong > $kmess){echo '<div class="topmenu">' . functions::phan_trang('/groups/'.$id.'/member/', $start, $tong, $kmess) . '</div>';
}
echo'</div>';
break;
case 'duoi':
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Đuổi thành viên</div>';
if (isset($_GET['nick'])) {
$thongtinthanhvien = $connect->fetch_array($connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='{$_GET['nick']}'"));
$thongtinban = $connect->fetch_array($connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='{$user_id}'"));
if ($thongtinthanhvien[rights] >= $thongtinban[rights]) {
echo'<div class="menu">Bạn không có quyền đuổi người này !</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_POST['submit'])) {
header('Location: /groups/member.php?id='.$id.'');
$connect->query("DELETE FROM `nhom_user` WHERE `id`='".$id."' AND `user_id`='".$_GET['nick']."'");
} else {
echo'<img src="'.$home.'/avatar/'.$_GET['nick'].'.png"/>';
echo '<form method="post">Bạn muốn đuổi bạn "'.nick($_GET['nick']).'" ra khỏi nhóm này không !<br /><input type="submit" name="submit" value="Đuổi" /></form>'; 
}
}
echo'</div>';
break;

case 'phongchuc':
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Phong chức thành viên</div>';
if (isset($_GET['nick'])) {
$thongtinthanhvien = $connect->fetch_array($connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='{$_GET['nick']}'"));
$thongtinban = $connect->fetch_array($connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='{$user_id}'"));
if ($thongtinthanhvien[rights] >= $thongtinban[rights]) {
echo'<div class="menu">Bạn không có quyền phong chức cho người này !</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_POST['submit'])) {
header('Location: /groups/member.php?id='.$id.'');
$connect->query("UPDATE `nhom_user` SET `rights` = '1' WHERE `user_id` = '" .$_GET['nick']. "'");
} else {
echo'<img src="'.$home.'/avatar/'.$_GET['nick'].'.png"/>';
echo '<form method="post">Bạn muốn phong chức bạn "'.nick($_GET['nick']).'" lên <span style="color:green;">quản trị viên</span> nhóm này không !<br /><input type="submit" name="submit" value="Phong chức" /></form>'; 
}
}
echo'</div>';
break;

case 'hachuc':
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Hạ chức thành viên</div>';
if (isset($_GET['nick'])) {
$thongtinthanhvien = $connect->fetch_array($connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='{$_GET['nick']}'"));
$thongtinban = $connect->fetch_array($connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='{$user_id}'"));
if ($thongtinthanhvien[rights] >= $thongtinban[rights]) {
echo'<div class="menu">Bạn không có quyền hạ chức người này !</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_POST['submit'])) {
header('Location: /groups/member.php?id='.$id.'');
$connect->query("UPDATE `nhom_user` SET `rights` = '0' WHERE `user_id` = '" .$_GET['nick']. "'");
} else {
echo'<img src="'.$home.'/avatar/'.$_GET['nick'].'.png"/>';
echo '<form method="post">Bạn muốn hạ chức bạn "'.nick($_GET['nick']).'" không !<br /><input type="submit" name="submit" value="Hạ chức" /></form>'; 
}
}
echo'</div>';
break;
}
require('../incfiles/end.php');