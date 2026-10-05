<?php
define('_IN_JOHNCMS', 1);
$noionline = 'ruong';
require_once('../../incfiles/core.php'); 
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
$textl = 'Rương đồ của '.$user[name].'';
require_once('../../incfiles/head.php');
if (!$user_id) {
header('Location: '.$home.'/login.vn4u');
require('../../incfiles/end.php');
exit;
}
$loai = '' . $_GET['loai'] . '';
if ($_SERVER['REQUEST_URI'] == '/account/ruong/') {header('Location: '.$home.'/account/ruong/'. $user['id'] . '');}
if($user_id) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$user[id]."'"));
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nhân Vật '.$user[name].'</div>';
echo'<div class="menu">';
echo'<img src="'.$home.'/avatar/' . $user[id]. '.png" alt="'. $login. '" class="avatar_vina"/>';
echo'<img src="/icon/xu.png" alt="icon" style="vertical-align: -3px;"/> Xu: '.$user[tienxu].'<br/>';
echo'<img src="/icon/sucmanh.png" alt="icon" style="vertical-align: -3px;"/> SM: '.($thongtin['sucmanh'] == 0 ? 'chưa có gì' : ''.$thongtin['sucmanh']).'</div>'; 
echo'</div>';
echo '<div class="main-xmenu"><div class="danhmuc"><b>Kho đồ</b></div>';
$tong = ($connect->query("SELECT COUNT(*) FROM `kho` WHERE `type`!='1' AND `user_id` = '".$user[id]."'")->fetch_row()[0] ?? 0);
if($user_id == $user[id]){
echo'<div class="menu">Bạn đang có '.$tong.' món đồ !</div>';
} else {
echo'<div class="menu">Bạn '.nick($user[id]).' đang có '.$tong.' món đồ !</div>';
}
$req = $connect->query("SELECT * FROM `kho` WHERE `type`!='1' AND `user_id` = '".$user[id]."' ORDER BY `id` DESC LIMIT $start, $kmess");
$total = ($connect->query("SELECT COUNT(*) FROM `kho` WHERE `type`!='1' AND `user_id` = '$user[id]'")->fetch_row()[0] ?? 0);
while($mondo = $connect->fetch_array($req))
{
$dangmac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user[id]."'"));
echo'<div class="menu list-top">';
if ($mondo['loai'] == toc) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
}
if ($mondo['loai'] == ao) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
}

if ($mondo['loai'] == quan) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
}

if ($mondo['loai'] == non) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;"src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
}

if ($mondo['loai'] == kinh) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do">';
echo'&#160;</td><td>';
}


if ($mondo['loai'] == mat) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do">';
echo'&#160;</td><td>';
}


if ($mondo['loai'] == matna) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
}

if ($mondo['loai'] == canh) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
}

if ($mondo['loai'] == thucung) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do"/>';
echo'&#160;</td><td>';
}

if ($mondo['loai'] == docamtay) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
}

if ($mondo['loai'] == khuonmat) {
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png" alt="do"/>';
echo'&#160;</td><td>';
}
if ($mondo['loai'] == haoquang){
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img style="background:url(/icon/nen.png);text-align: center;" src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
                }
if ($mondo['loai'] == nensau){
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">';
echo '<img src="'.$home.'/images/'.$mondo['loai'].'/' . $mondo['id_loai'] . '.png "alt="do"/>';
echo'&#160;</td><td>';
                }
if ($user_id && $user_id != $user['id']) {
if ($dangmac[$mondo['loai']] == $mondo['id_loai']) {
echo'<span style="color:green;">Đang mặc</span><br/>';
}
}
if ($mondo['tangsucmanh'] > '0') {echo 'Tăng: '.$mondo['tangsucmanh'].' SM (<span style="color:green;"><b>+'.$mondo['cong'].'</b></span>)';}
if ($mondo['conghp'] > '0') {echo ' <span style="font-size:11px;color:#e2e2e2;">|</span> (<img src="http://vina4u.mobi/icon/hp.png" alt="icon" style="vertical-align: -3px;"/><span style="color:green;"><b>'.$mondo['conghp'].'</b></span>)';}
echo'<br/>';
if($user_id == $user[id]){
if ($dangmac[$mondo['loai']] == $mondo['id_loai']) {
echo'<a href="/shop/'.$mondo['loai'].'/thao"><span style="color:green;">[ <b>Tháo đồ</b> ]</a></span><br/>';
echo'<a href="/shop/'.$mondo['loai'].'/nangcap/' . $mondo['id'] . '"><span style="color:green;">[ <b>Cường hóa</b> ]</a></span><br/>';
echo'<a href="/shop/ban/' . $mondo['id'] . '"><span style="color:#ff1234;">[ <b>Bán đồ</b> ]</span></a>';
} else {

if ($mondo['loai'] == mat) {
if ($dangmac[mat] == '100') {
} else {
echo'<a href="/shop/'.$mondo['loai'].'/mac/' . $mondo['id'] . '"><span style="color:green;">[ <b>Mặc đồ</b> ]</a></span><br/>';
}
} else {
echo'<a href="/shop/'.$mondo['loai'].'/mac/' . $mondo['id'] . '"><span style="color:green;">[ <b>Mặc đồ</b> ]</a></span><br/>';
}
echo'<a href="/shop/'.$mondo['loai'].'/nangcap/' . $mondo['id'] . '"><span style="color:green;">[ <b>Cường hóa</b> ]</a></span><br/>';
echo'<a href="/shop/ban/' . $mondo['id'] . '"><span style="color:#ff1234;">[ <b>Bán đồ</b> ]</span></a>';
}
}
echo'</td></tr></table>';
echo'</div>';
}
if ($total > $kmess) {
echo '<div class="menu">' . functions::phan_trang('/account/ruong/' . $user[id]. '/', $start, $total, $kmess) . '</div>';
}
}
echo'</div>';
$vatpham = ($connect->query("SELECT COUNT(*) FROM `vatpham` WHERE `id_user` = '".$user[id]."' AND `soluong` > '0'")->fetch_row()[0] ?? 0);
if ($vatpham > 0) {
include'ngoc.php';
}
require('../../incfiles/end.php');
?>