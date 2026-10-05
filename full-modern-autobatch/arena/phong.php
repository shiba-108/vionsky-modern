<?php

define('_IN_JOHNCMS', 1);
require('../incfiles/core.php'); 
$textl= 'Phòng Đấu Trường'; 
$id= intval(abs($_GET['id']));
$areanonline = $connect->fetch_array($connect->query("SELECT * FROM `arena` WHERE `id`='".$id."'"));
if ($areanonline['user_id']!=$user_id && $areanonline['nguoichoi']!=$user_id) { 
$noionline = 'arena';
}
$hienluot3 = 2;
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Phòng Đấu Trường</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
$xoatb = $connect->fetch_array($connect->query("SELECT * FROM `arena_notice` WHERE `phong`='".$id."'"));
if($xoatb['type'] == a) {
if($xoatb['view'] == 0) {
$connect->query("UPDATE `arena_notice` SET `view`='1' WHERE `id`='".$xoatb[id]."'");
}
}
$ktcr = ($connect->query("SELECT COUNT(*) FROM `arena` WHERE `id`='".$id."'")->fetch_row()[0] ?? 0);
if($ktcr==0 || empty($id)) {
echo '<div class="menu">Bàn chơi không tồn tại hoặc đã bị xoá!</div>';
echo'<a href="/arena/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
}
$tuser = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
echo'<div class="menu list-bottom congdong">Phòng '.$id.' <span style="font-size:11px;color:#e2e2e2;">|</span> Cược '.$areanonline['datcuoc'].' xu';
if($areanonline['win'] == $areanonline['user_id']) {
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> ';
echo '<span style="color:green;">'.nick($areanonline['user_id']).' <img src="/icon/cup.png" alt="icon" style="vertical-align: -3px;"/></span>';
}
if($areanonline['win'] == $areanonline['nguoichoi']) {
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> ';
echo '<span style="color:green;">'.nick($areanonline['nguoichoi']).' <img src="/icon/cup.png" alt="icon" style="vertical-align: -3px;"/></span>';
}
echo'</div>';
if ($areanonline['win'] == '0') {
$onlinearena = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "' AND `id`='".$areanonline['user_id']."'")->fetch_row()[0] ?? 0);
if ($onlinearena == '0') {
if ($areanonline['nguoichoi'] == 0) {
@$connect->query("DELETE FROM `arena` WHERE `id`='".$id."'");
@$connect->query("DELETE FROM `arena_cmt` WHERE `sid`='".$id."'");
} else {
$connect->query("UPDATE `arena` SET `win`='".$areanonline['nguoichoi']."' WHERE `id`='".$id."'");
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$id."' LIMIT 1;");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `win`= `win`+'1' WHERE `user_id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `nhanvat` SET `lose`= `lose`+'1' WHERE `user_id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `arena` SET `post`='0' WHERE `id`='".$id."'");
}

$onlinearena2 = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "' AND `id`='".$areanonline['nguoichoi']."'")->fetch_row()[0] ?? 0);
if ($onlinearena2 == '0') {
if ($areanonline['nguoichoi'] == 0) {
} else {
$connect->query("UPDATE `arena` SET `win`='".$areanonline['user_id']."' WHERE `id`='".$id."'");
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$id."' LIMIT 1;");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `win`= `win`+'1' WHERE `user_id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `lose`= `lose`+'1' WHERE `user_id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `arena` SET `post`='0' WHERE `id`='".$id."'");
}
}
}
}
if(isset($_GET['thamgia']) && $user_id!=$areanonline['user_id'] && empty($areanonline['nguoichoi'])) {
$thongtinhp = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$user_id."'"));
if($thongtinhp[hp] <= 0) {
echo '<div class="menu">Bạn không thể sẵn sàng khi không còn HP!</div>';
echo'<a href="/arena/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
} 
if($datauser['tienxu']<$areanonline['datcuoc']) {
echo '<div class="menu">Bạn không đủ xu đặt cược để tham gia !</div>';
echo'<a href="/arena/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
} else {
$connect->query("UPDATE `arena` SET `nguoichoi`='$user_id' WHERE `id`='$id'");
header("Location: phong.php?id=$id");
}
}



if(isset($_GET['bothamgia']) && $user_id==$areanonline['nguoichoi'] && $areanonline['wait']!=3) {
$connect->query("UPDATE `arena` SET `nguoichoi`='0' WHERE `id`='$id'");
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$id."' LIMIT 1;");
header("Location: phong.php?id=$id");
}
if ($areanonline['nguoichoi'] == '0') {
$connect->query("DELETE FROM `arena_notice` WHERE `phong`='".$id."' LIMIT 1;");
}
if(isset($_GET['xinthua'])) {
if ($user_id == $areanonline['user_id']) {
$connect->query("UPDATE `arena` SET `win`='".$areanonline['nguoichoi']."' WHERE `id`='$id'");
$connect->query("UPDATE `arena` SET `post`='0' WHERE `id`='".$id."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `win`= `win`+'1' WHERE `user_id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `nhanvat` SET `lose`= `lose`+'1' WHERE `user_id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `arena` SET `post`='0' WHERE `id`='".$id."'");
$connect->query("INSERT INTO `arena_noidung` SET
`nguoidanh1` = '".$areanonline['user_id']."',
`nguoidanh2` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`type` = '2'
");
}
if ($user_id == $areanonline['nguoichoi']) {
$connect->query("UPDATE `arena` SET `win`='".$areanonline['user_id']."' WHERE `id`='$id'");
$connect->query("UPDATE `arena` SET `post`='0' WHERE `id`='".$id."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
$connect->query("UPDATE `users` SET `phongdautruongdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `win`= `win`+'1' WHERE `user_id`='".$areanonline['user_id']."'");
$connect->query("UPDATE `nhanvat` SET `lose`= `lose`+'1' WHERE `user_id`='".$areanonline['nguoichoi']."'");
$connect->query("INSERT INTO `arena_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi']."',
`nguoidanh2` = '".$areanonline['user_id']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`type` = '2'
");
}
header("Location: phong.php?id=$id");
}

if(isset($_GET['huyphong'])) {
if ($user_id == $areanonline['user_id']) {
$connect->query("DELETE FROM `arena` WHERE `id`='".$id."'");
$connect->query("DELETE FROM `arena_cmt` WHERE `sid`='".$id."'");
$connect->query("UPDATE `arena` SET `post`='0' WHERE `id`='".$id."'");
}
header("Location: /arena/");
}



include'sys/errorarena.php';
include'sys/timeluotdi.php';
include'sys/avatarwin.php';
include'sys/menuarena.php';
include'sys/avatardanhnhau.php';
include'sys/danh.php';
include'sys/thongbaotrongtran.php';
include'sys/avatarchuabatdau.php';

if($areanonline['wait'] == 0) {
include'sys/thongbaosansang.php';
include'sys/button.php';
}
include'sys/khachxem.php';
echo'</div>';
include 'cmt.php';
require('../incfiles/end.php');
?>