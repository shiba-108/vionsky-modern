<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../incfiles/core.php');
if(!$user_id){
require('../../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../../incfiles/end.php');
exit;
}
$textl = 'Đổi Quà - XemLaSuong.Tk';
require('../../incfiles/head.php');
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
echo 'Bạn vừa đổi cánh tím bóng đêm thành công.<br/>Hãy vào <a href="/account/ruong/">rương đồ</a> để kiểm tra nhé.';
}
echo'</div>';
}
}
echo'</div>';
require('../../incfiles/end.php');
