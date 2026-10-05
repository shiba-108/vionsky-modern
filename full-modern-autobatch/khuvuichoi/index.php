<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khuvuichoi';
require('../incfiles/core.php');
$textl = 'Khu Vui Chơi';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Công Viên</div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}

echo '<div class="menu"><div class="nen_congvien"></div><div class="cola" style="min-height: 100px;margin:0"><a href="/bang-xep-hang"><img src="img/bxh.png"></a><a href="/ocean/pass2.php"><img src="img/pass2.gif"></a><center>';
echo'<a href="/khuvuichoi/quayso/"><img src="img/quayso.gif" style="margin-top: -120px;"><img src="img/quayso.png" style="margin-top: -120px;"></a>'; 
echo'<a href="/ocean/code.php"><img src="img/gc.gif"></a>';
echo'<br/>';

$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'khuvuichoi'");
while ($res = $connect->fetch_array($req)) {
$rand = rand(1,20);
If($rand <10){$c = '';} else {$c = 'class="xavt"';}
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><small></small><br><img src="'.$home.'/avatar/nen/'.$res['id'].'.png" '.$c.' alt="'. $res['name'] . '"/></a>';

}
echo'</center><div class="buico"></div></div>';
echo'</div>';
echo'</div>';
require('../incfiles/end.php');
?>