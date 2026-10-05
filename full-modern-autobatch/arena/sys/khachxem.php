<?php
$online = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > " . (time() - 30) . " AND `place` = 'arena'")->fetch_row()[0] ?? 0); 
if ($online > 0) {
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khách Xem</div>';
echo '<div class="menu">';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 30) . " AND `place` = 'arena'");
while ($res = $connect->fetch_array($req)) {
$ban = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$res['id']."'"));
$thongtinsucmanh = $ban['sucmanh'];
$phantramban = floor(($ban['hp']*100)/$ban['hpfull']);
echo'<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'.$res['name'].'" class="avatar_vina"/></a> ';
}
echo '</div>';
}
?>