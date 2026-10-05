<?php
define('_IN_JOHNCMS', 1);
$noionline = 'nhabep';
require_once('../incfiles/core.php'); 
$textl = 'Lái Buôn';
require_once('../incfiles/head.php'); 
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Lái Buôn</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom congdong">Bạn đang có <b style="color:green">'.$datauser[diemtichluy].'</b> điểm tích lũy !</div>';
switch ($act) { 
default:
echo'<div class="menu"><a href="?act=doivinaxu">Đổi điểm tích lũy lấy vinaxu</div><div class="menu"><a href="/share">Giới thiệu bạn bè</a></div>'; if ($datauser['hopqua'] =='0') { 
Echo '<div class="menu"><a href="'. $home.'/hopqua.php"><b style="color:red">Báo danh 24h</b></a></div>';
 }
break;
case 'doivinaxu':
echo'<div class="menu list-bottom"><span style="color:green">2 điểm</span> tích lũy bạn có thể đổi được <span style="color:green">1 vinaxu</span></div>';
$xutru = $_POST['kupit']*2;
if (isset($_POST['kupit']) && $xutru > $datauser[diemtichluy]) {
echo'<div class="menu list-bottom congdong"><b style="color:red">Bạn không đủ điểm tích lũy để đổi '.$_POST['kupit'].' vinaxu nhé bạn cần phải có '.$xutru.' điểm tích lũy để đổi nhé !</b></div>';
}
if(isset($_POST['kupit']) && strlen($_POST['kupit'])==0 || isset($_POST['kupit']) && $_POST['kupit']<1){
echo'<div class="menu list-bottom congdong"><b style="color:red">Chỉ được phép nhập số !</b></div>';
}
echo '<form method="post">Đổi <input type="text" name="kupit" size="1" value=""/> Vinaxu<br/><input type="submit" name="save" value="Đổi" /></form>';
if(isset($_POST['kupit']) && $datauser[diemtichluy]>=$xutru && $_POST['kupit']>0) {
$connect->query("UPDATE `users` SET `diemtichluy` = `diemtichluy`- $xutru WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `vinaxu` = `vinaxu` + '".$_POST['kupit']."' WHERE `id` = $user_id LIMIT 1");
echo'<div class="menu list-top congdong"><b style="color:green">Bạn đã đổi thành công '.$_POST['kupit'].' vinaxu '.$post['name'].' bạn mất '.$xutru.' điểm tích lũy</b></div>';
}



break;
}
echo'</div>';
require_once('../incfiles/end.php'); 