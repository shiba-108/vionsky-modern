<?php
define('_IN_JOHNCMS', 1);
$headmod = 'khumuasam';
require('../incfiles/core.php');
$textl = 'Khu Mua Sắm';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="phdr">Khu Mua Sắm</div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
$connect->query("UPDATE `users` SET `online`='khumuasam' WHERE `id`='".$user_id."'");
echo '<div class="nenmuasam"><a href="/shop"><img src="/icon/shop.png"></a> <a href="/atm"><img src="/icon/atm.png"></a> <a href="/ruong"><img src="/icon/khodoss.png"></a> <a href="/shop/vatpham/"><img src="/icon/premium.png"></a> <a href="nangcap"><img src="/icon/kimhoan.gif"></a> <img src="/icon/cay.png"><a href="/mod/anmay.php"><img src="/icon/am.gif"></a> ';
echo'</div>';
echo '<div class="cotinhte" style="min-height: 100px;margin:0"><br><br><br><br><br> <br><br><br><br>    <center>                             ';
//-- Online Topic ---//
$online_u = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `online` = 'khumuasam'")->fetch_row()[0] ?? 0);
$online_g = ($connect->query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'khumuasam'")->fetch_row()[0] ?? 0);
$totalonline = $online_u + $online_g;
$q = @$connect->query("select * from `users` where `lastdate` > " . (time() - 300) . " AND `online` = 'khumuasam';");
$count = $connect->query("SELECT * FROM ...")$q);
while ($arr = $connect->fetch_array($q)){
$trinhtrangvip = $connect->query("select `rights` from `users` where id='" . $arr['id'] . "'");
$trinhtrangviphonnua = $connect->fetch_array($trinhtrangvip);
if($arr['id'] != $datauser['id']){
$u_on[]='<a href="../users/' . $arr['name'] . '_' . $arr['id'] . '.html"><img src="/avatar/nen/' . $arr['id'] . '.png"></a>';
}else{
	$u_on[]='<img src="/avatar/nen/' . $arr['id'] . '.png">';
}
}
//Keet thuc topic
if ($online_u > 0){
echo implode(' ',$u_on).'';
}else{
	echo 'COde mod by Đức Nghĩa .COppy nhớ Ghi Nguồn';
}
echo'</center></div> <div class="buico"></div>';
echo'</div>';
require('../incfiles/end.php');
?>