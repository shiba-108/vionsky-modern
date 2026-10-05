<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('../incfiles/core.php');
$textl = 'Bảng xếp hạng câu cá';
require ('../incfiles/head.php');

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Top câu cá</div>';
echo'<div class="menu list-bottom congdong"><img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Xu: '.$datauser[tienxu].' - Câu được: '.$datauser[cauca].' con cá </div>'; 
$tongso = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `cauca` > '0'")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `cauca` > '0' ORDER BY `cauca` DESC LIMIT $start, $kmess");
while ($res = $connect->fetch_array($req)) {
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/account/'.$res['id'].'"><b>'.nick($res['id']).'</b></a><br/>
Câu được: '.$res['cauca'].' con cá</div>';
}
if ($tongso > $kmess) {
echo '<div class="menu">' . functions::display_pagination('/khusinhthai/bangxephang.php?', $start, $tongso, $kmess) . '</div>';
}
echo'</div>';
require ('../incfiles/end.php');