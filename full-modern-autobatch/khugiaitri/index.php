<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khugiaitri';
require('../incfiles/core.php');
$textl = 'Khu Giải Trí';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Giải Trí</div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}

echo '<div class="thanhpho"><a href="/minigame"><img src="img/game.png"></a> <img src="img/cay.png"><a href="xoso.php"><img src="img/vs.gif"></a> <a href="/quaytay"><img src="img/maria.gif"></a>';
echo' <a href="/minigame/sutphat"><img src="img/ct.gif"></a>';    echo' <a href="/game/rongcity.php"><img src="/images/dracula.gif"></a><br><a href="damcuoi.php"><img src="img/avatar3.png"></a></div>';
echo '<div class="nenda" style="min-height: 100px;margin:0"><br><br><br><br><br> <br><br>                                 ';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'khugiaitri'");
while ($res = $connect->fetch_array($req)) {
$rand = rand(1,20);
if($rand >10){$r='class="xavt"';}else{$r = '';}
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img '.$r.' src="'.$home.'/avatar/nen/'.$res['id'].'.png" alt="'. $res['name'] . '"/></a>';

}
echo'</div></div></div>';
echo'</div>';
require('../incfiles/end.php');
?>
