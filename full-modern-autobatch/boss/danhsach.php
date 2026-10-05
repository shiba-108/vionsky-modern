<?php
define('_IN_JOHNCMS', 1);
$noionline = 'boss';
require('../incfiles/core.php');
$textl= 'Boss Online';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Boss Online</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom congdong"><a href="/boss/taophong.php"><input type="button" value="Tạo phòng mới" /></a></div>';
echo'<div class="bautroiboss">';
echo'<img src="img/nhaboss.png" alt="icon" style="margin-bottom: -65px"/>';
echo'<div class="hangraoboss"></div>';
echo'<div class="datboss" style="height: 0px;"></div>';
echo'<div class="datboss">';
$req=$connect->query("SELECT * FROM `boss` WHERE `wait`!='4'  ORDER BY `id`");
while ($res = $connect->fetch_array($req)) {
if (empty($res['user_id']) && empty($res['nguoichoi']) && empty($res['nguoichoi2']) && empty($res['nguoichoi3'])) {
$connect->query("DELETE FROM `boss` WHERE `id`='".$res['id']."'");
}
if (!empty($res['nguoichoi'])) {$songuoichoi = 1;}
if (!empty($res['nguoichoi2'])) {$songuoichoi2 = 1;}
if (!empty($res['nguoichoi3'])) {$songuoichoi3 = 1;}
$tongsonguoichoi = $songuoichoi+$songuoichoi2+$songuoichoi3+1;
echo'<a href="/boss/'.$res['id'].'">';
echo'<span class="listboss">';
if ($res['mucdo'] == 1) {echo'Dễ ';}
if ($res['mucdo'] == 2) {echo'Thường ';}
if ($res['mucdo'] == 3) {echo'Khó ';}
if ($tongsonguoichoi == 4) {
echo '[<span style="color:red">Đầy</span>]<br/>';
} else {
echo '('.$tongsonguoichoi.'/4)<br/>';
}
echo'<img src="'.$home.'/boss/icon/1/'.$res['boss'].'.png" alt="Boss" style="margin-top: 3px"/>';
echo'</span></a>';
}
echo'</div>';
echo'</div>';
echo'</div>';
require('../incfiles/end.php');
?>