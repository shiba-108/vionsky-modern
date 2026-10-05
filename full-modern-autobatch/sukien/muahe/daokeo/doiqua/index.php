<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../../../incfiles/core.php');
if(!$user_id){
require('../../../../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../../../../incfiles/end.php');
exit;
}
$textl = 'Đổi Quà - XemLaSuong.TK';
require('../../../../incfiles/head.php');
echo '<div class="phdr"><b>Đổi Kẹo , Hộp Quà Lấy Quà</b></div>';
echo'<img src="/avatar/'.$datauser['id'].'.png"/><br/>';
echo '<font color="red">Xu : '.$datauser['tienxu'].'<br/>Vina: '.$datauser['vinaxu'].'<br/><br/></font>';
echo'<div class="list1"><img src="/images/thucung/6020.png"/><br/>Đổi Thú Bù Nhìn với 500 cây kẹo .</div>';
echo'<form method="post"><input type="submit" name="doithu" value="Đổi Thú" /></form></center>';
if(isset($_POST['doithu'])) {
if($datauser['keo'] <=499) {
echo '<b>Bạn đã không đủ kẹo để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6020',`id_user`='$user_id',`name`='6020',`loaisp`='thucung',`sucmanh`='1000',`tenvatpham`='Thú Cưng Bù Nhìn'");
$connect->query("UPDATE `users` SET `keo`=`keo`-'500' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi thú cưng bù nhìn thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}
echo'</div>';
echo'<div class="list1"><img src="/images/thucung/6021.png"/><br/>Đổi Thú Dâu Tây với 700 hộp quà .</div>';
echo'<form method="post"><input type="submit" name="doicanh1" value="Đổi Thú" /></form></center>';
if(isset($_POST['doicanh1'])) {
if($datauser['hopqua1'] <=699) {
echo '<b>Bạn đã không đủ hộp quà để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6021',`id_user`='$user_id',`name`='6021',`loaisp`='thucung',`sucmanh`='5000',`tenvatpham`='Dâu Tây Thần Kỳ'");
$connect->query("UPDATE `users` SET `hopqua1`=`hopqua1`-'500' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi Dâu Tây Thần Kỳ thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}

echo'</div>';
echo'<div class="list1"><img src="/images/docamtay/6022.png"/><br/>Đổi Giáp Chiến Sỹ Cấp 1 với 300 kẹo.</div>';
echo'<form method="post"><input type="submit" name="doigiap" value="Đổi Giáp" /></form></center>';
if(isset($_POST['doigiap'])) {
if($datauser['keo'] <=299) {
echo '<b>Bạn đã không đủ kẹo để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6022',`id_user`='$user_id',`name`='6022',`loaisp`='docamtay',`sucmanh`='200',`tenvatpham`='Giáp Chiến Sỹ Cấp 1'");
$connect->query("UPDATE `users` SET `keo`=`keo`-'300' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi Giáp Chiến Sỹ Cấp 1 thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}
echo'<div class="list1"><img src="/images/docamtay/6023.png"/><br/>Đổi Giáp Chiến Sỹ Cấp 2 với 350 hộp quà .</div>';
echo'<form method="post"><input type="submit" name="doigiapp" value="Đổi Giáp" /></form></center>';
if(isset($_POST['doigiapp'])) {
if($datauser['hopqua1'] <=349) {
echo '<b>Bạn đã không đủ hộp quà để đổi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("INSERT INTO `kho` SET `id`='$user_id'+'6023',`id_user`='$user_id',`name`='6023',`loaisp`='docamtay',`sucmanh`='1000',`tenvatpham`='Giáp Chiến Sỹ Cấp 2'");
$connect->query("UPDATE `users` SET `hopqua1`=`hopqua1`-'350' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi Giáp Chiến Sỹ Cấp 2 thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}
require('../../../../incfiles/end.php');
