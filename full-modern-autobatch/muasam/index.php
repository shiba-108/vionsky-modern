<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khumuasam';
require('../incfiles/core.php');
$textl = 'Khu Mua Sắm';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Mua Sắm</div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}

echo '<div class="nenmuasam"><a href="/shop"><img src="img/shop.png"></a> <a href="/atm"><img src="/farm/icon/atm.png"></a> <a href="/ocean/kichhoat.php"><img src="img/congdan.png"></a> <a href="/shop/vatpham/"><img src="img/premium.png"></a> <img src="/khugiaitri/img/cay.png"><a href="/ocean/anmay.php"><img src="img/am.gif"></a> ';
echo'</div>';
echo '<div class="cotinhte" style="min-height: 100px;margin:0"><br><br><br><br><br> <br><br><br><br>    <center>                             ';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'khumuasam'");
while ($res = $connect->fetch_array($req)) {
$rand = rand(1,20);
if($rand >10){$r='class="xavt"';}else{$r = '';}
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img '.$r.' src="'.$home.'/avatar/nen/'.$res['id'].'.png" alt="'. $res['name'] . '"/></a>';

}
echo'</center></div> <div class="buico"></div> </div></div>';
echo'</div>';
require('../incfiles/end.php');
?>

