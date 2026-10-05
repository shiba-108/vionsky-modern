<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../../incfiles/core.php');
if(!$user_id){
require('../../../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../../../incfiles/end.php');
exit;
}
$textl = 'Đổi Quà - XemLaSuong.CF';
require('../../../incfiles/head.php');
echo '<div class="phdr"><b>Đổi Điểm Thưởng Lấy Quà</b></div>';
echo'<img src="/avatar/'.$datauser['id'].'.png"/><br/>';
echo '<font color="red">Xu : '.$datauser['tienxu'].'<br/>Vina: '.$datauser['vinaxu'].'<br/><br/></font>';
echo'<div class="list1"><img src="/images/canh/6010.png"/><br/>Đổi cánh bướm tím bóng đêm với 700 điểm .</div>';
echo'<form method="post"><input type="submit" name="doicanh" value="Đổi Cánh" /></form></center>';
if(isset($_POST['doicanh'])) {
if($datauser['diemevent'] <=699) {
echo '<b>Bạn đã không đủ điểm để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6010',`id_user`='$user_id',`name`='6010',`loaisp`='canh',`sucmanh`='1000',`tenvatpham`='Cánh Tím Bóng Đêm'");
$connect->query("UPDATE `users` SET `diemevent`=`diemevent`-'700' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi cánh tím bóng đêm thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}
echo'</div>';
echo'<div class="list1"><img src="/images/canh/6011.png"/><br/>Đổi cánh Tiểu Yến Tử với 500 điểm .</div>';
echo'<form method="post"><input type="submit" name="doicanh1" value="Đổi Cánh" /></form></center>';
if(isset($_POST['doicanh1'])) {
if($datauser['diemevent'] <=499) {
echo '<b>Bạn đã không đủ điểm để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6011',`id_user`='$user_id',`name`='6011',`loaisp`='canh',`sucmanh`='800',`tenvatpham`='Cánh Tiểu Yến Tử'");
$connect->query("UPDATE `users` SET `diemevent`=`diemevent`-'500' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi cánh tiểu yến tử thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}

echo'</div>';
echo'<div class="list1"><img src="/images/thucung/6012.png"/><br/>Đổi Thú Bay Kirty Với 600 điểm.</div>';
echo'<form method="post"><input type="submit" name="doithu" value="Đổi Thú" /></form></center>';
if(isset($_POST['doithu'])) {
if($datauser['diemevent'] <=599) {
echo '<b>Bạn đã không đủ điểm để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6012',`id_user`='$user_id',`name`='6012',`loaisp`='thucung',`sucmanh`='600',`tenvatpham`='Thú Bay Kirby'");
$connect->query("UPDATE `users` SET `diemevent`=`diemevent`-'600' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi thú bay Kirby thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}
echo'<div class="list1"><img src="/images/canh/6013.png"/><br/>Đổi Cánh Lửa Rồng Thiên Với 1000 điểm .</div>';
echo'<form method="post"><input type="submit" name="doithu1" value="Đổi Cánh" /></form></center>';
if(isset($_POST['doithu1'])) {
if($datauser['diemevent'] <=999) {
echo '<b>Bạn đã không đủ điểm để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6013',`id_user`='$user_id',`name`='6013',`loaisp`='canh',`sucmanh`='2000',`tenvatpham`='Cánh Lửa Rồng Thiên'");
$connect->query("UPDATE `users` SET `diemevent`=`diemevent`-'1000' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi cánh lửa rồng thiêng thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}
echo'<div class="list1"><img src="/images/canh/6014.png"/><br/>Đổi Cánh Vua Truyền Thuyết Với 1500 điểm .</div>';
echo'<form method="post"><input type="submit" name="doithu2" value="Đổi Cánh" /></form></center>';
if(isset($_POST['doithu2'])) {
if($datauser['diemevent'] <=1499) {
echo '<b>Bạn đã không đủ điểm để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6014',`id_user`='$user_id',`name`='6014',`loaisp`='canh',`sucmanh`='4000',`tenvatpham`='Cánh Vua Truyền Thuyết'");
$connect->query("UPDATE `users` SET `diemevent`=`diemevent`-'1500' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi cánh vua truyền thuyết thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}

echo'</div>';
require('../../../incfiles/end.php');
