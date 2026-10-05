<?php
define('_IN_JOHNCMS', 1);
$noionline = 'leduong';
require('../incfiles/core.php');
$textl = 'Lễ đường';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nhà Nghỉ</div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}

echo '<div class="damcuoi"><a href="?act=leduong"><center><br><img src="/systems/vao.gif" width="30" height="30"></a></center></div>';
echo '<div class="nengach" style="min-height: 100px;margin:0"><br><a href="/khugiaitri"><img width="30" height="30" src="/systems/vao.gif"></a><span class="right"><a href="/usersx/?act=userlist"><img src="/systems/vao.gif" width="30", height="30"></a></span>';
switch($act){
default:
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'leduong'");
while ($res = $connect->fetch_array($req)) {
$rand = rand(1,20);
if($rand >10){$r='class="xavt"';}else{$r = '';}
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img '.$r.' src="'.$home.'/avatar/nen/'.$res['id'].'.png" alt="'. $res['name'] . '"/></a>';
}
break;
case 'leduong':
echo '<br>';
$req = $connect->query("SELECT * FROM users WHERE nguoiyeu !=0 AND sex = 'm'");
while ($res = $connect->fetch_array($req)){
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"> <img src="/avatar/nen/'.$res['id'].'.png"></a><a href="/account/'.$res['nguoiyeu'].'"> <img src="/avatar/nen/'.$res['nguoiyeu'].'.png" class="xavt"></a> ';
}
break;
}
echo'</div></div>';
echo'</div>';
require('../incfiles/end.php');
?>