<?php
if(isset($_GET['xem'])) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nông Trại</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<style>body{min-width: 500px}</style>';
echo'<div class="cola" style="padding: 0;margin-bottom: 2px;margin-top: 3px;"><div class="nennongtrai"></div>';
echo'<div style="margin-top: -70px;text-align: center;">';
echo'<a href="/farm/"><img src="icon/farm.png"></a><a href="/atm/"><img src="icon/atm.png"></a>';
echo'<a href="/farm/shop.php"><img src="../icon/cuahangfarm.png"></a></div>';
echo'<div class="dat">';
echo'<a href="laibuon.php"><img src="icon/laibuon.gif" style="position: absolute;vertical-align: 0px;margin:-40px 0 0 60px;"></a>';
echo'<center>';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'farm'");
while ($res = $connect->fetch_array($req)) {
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img class="xavt" src="'.$home.'/avatar/nen/'.$res['id'].'.png" alt="'. $res['name'] . '"/></a>';
}
echo'</center>';

echo'</div>';
echo'</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}











?>