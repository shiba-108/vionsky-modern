<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'ATM - Ngân hàng Ocean';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">ATM - Ngân hàng OCEAN</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
switch ($act) { 
default:
echo'<div class="menu"><a href="?act=doivinaxu">Đổi Xu sang Vinaxu</a></div> <div class="menu"><a href="sms.php">Nạp tiền sms</a> (Vina, Mobi, Viettel)</div> <div class="menu"><a href="otp.php">Nạp tiền bằng tài khoản di động</a> (Viettel, Mobi)</div> <div class="menu"><a href="card.php">Nạp tiền bằng card </a>(Vina, Mobi, Viettel, VNM, FPT, VTC)</div> ';
break;
case 'doivinaxu':
echo'<div class="menu list-bottom"><font color=red>50.000 xu = 1 vinaxu!</font><form method="post"><input type="text" name="vn" placeholder="Nhập số Vinaxu"><input type="submit" name="submit" value="Đổi"></form></div>';
if (isset($_POST['submit'])) {
$vn = (int)$_POST['vn'];
$xuphaitra = $vn * 50000;
if($vn <=0 or empty($vn)){
echo 'Không hợp lệ!';
} else {
if($xuphaitra > $datauser['tienxu']){
echo 'Không đủ tiền!';
} else {
$connect->query("UPDATE users SET tienxu = tienxu - $xuphaitra, vinaxu = vinaxu + $vn WHERE id = $user_id");
echo 'Chuyển thành công <b>'.$vn.'</b> Vinaxu từ <b>'.$xuphaitra.'</b> Xu';
}
}
} 
break;
}
echo'</div>';
require('../incfiles/end.php');
?>