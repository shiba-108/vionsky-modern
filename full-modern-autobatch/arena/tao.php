<?php

define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Tạo Phòng Đấu Trường';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tạo phòng mới</div>';
if(!$user_id) {
echo '<div class="menu">Chỉ dành cho thành viên. Vui lòng đăng nhập!</div>';
require('../incfiles/end.php');
exit;
}
$vkt = ($connect->query("SELECT COUNT(*) FROM `arena` WHERE `post`='$user_id'")->fetch_row()[0] ?? 0);
if($vkt>=1) {
echo '<div class="menu">Bạn đã tạo 1 phòng rồi nếu muốn tạo phòng mới xin hủy bàn cũ !</div>';
echo'<a href="/arena/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
echo '</div>';
exit;
}
if(isset($_POST['sub'])) {
If($thongtinnhanvat['hp'] <=0){
Echo 'Hết máu rồi! Đến bác sĩ đi!';
Require '../incfiles/end.php';
Exit;
}
$wait = functions::checkout($_POST['wait']);
$datcuoc = functions::checkout($_POST['datcuoc']);
$tenphong = functions::checkout($_POST['tenphong']);
$time = functions::checkout($_POST['time']);
$connect->query("INSERT INTO `arena` SET `user_id`='".$user_id."', `datcuoc`='".$datcuoc."', `time`='".time()."', `luotdi`='1', `wait`='".$wait."', `post`='".$user_id."'");
$rd=mysql_insert_id();
header("Location: phong.php?id=$rd");
}
echo '<form method="post">
<div class="menu">
Đặt cược: (0 - 2000 Xu)<br/><input type="text" name="datcuoc" value="0" /></div>
<input type="submit" name="sub" value="Tiếp tục" /></form>';
echo '</div>';
require('../incfiles/end.php');
?>
