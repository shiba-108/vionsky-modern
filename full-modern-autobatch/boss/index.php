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
echo'<div class="bautroiboss">';
echo'<a href="/boss/danhsach.php"><img src="img/nha.png" alt="icon" style="margin-bottom: -65px"/></a>';
echo'<div class="hangraoboss"></div>';
echo'<div class="datboss" style="height: 0px;"><div class="left"><a href="/ocean/hp.php"><img src="img/bs.gif"></a> <a href="/arena"><img src="img/dautrg.gif"></a><a href="/vuichoi"><img src="img/hero.gif"></a> </div><div class="right"><a href="bxh.php"><img src="/khusinhthai/img/bxh.png"></a></div></div>';
echo'<div class="datboss">';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'boss'");
while ($res = $connect->fetch_array($req)) {
$rand = rand(1,20);
if($rand <10){$c = '';} else {$c = 'class = "xavt"';}
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img src="'.$home.'/avatar/nen/'.$res['id'].'.png" '.$c.' alt="'. $res['name'] . '"/></a>';
}
echo'</div></div><div class="buico">';
echo'';
echo'</div>';
require('../incfiles/end.php');
?>
