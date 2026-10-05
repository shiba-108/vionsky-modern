<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
include_once('func.php');
$textl = 'Bảng xếp hạng';
require('../incfiles/head.php');
if ($_SERVER['REQUEST_URI'] == '/farm/bangxephang.php') {header('Location: '.$home.'/farm/bangxephang/');}
if ($_SERVER['REQUEST_URI'] == '/farm/bangxephang') {header('Location: '.$home.'/farm/bangxephang/');}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bảng xếp hạng nông trại</div>';
if($user_id){
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `fermer_oput`")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `users` WHERE `fermer_oput`>'0' ORDER BY `fermer_oput` DESC LIMIT $start, $kmess");
while ($danhsach = $connect->fetch_assoc($req)){
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr class="menu_top_baiviet"><td style="vertical-align: top;">';
echo'<img src="'.$home.'/avatar/'.$danhsach[id].'.png" alt="'. $user['name']. '"/>';
echo'&#160;</td><td>';
echo'<a href="/account/'.$danhsach[id].'"><b>'.nick($danhsach[id]).'</b></a><br/>';
echo'Xu: '.$danhsach[tienxu].'<br/>';
if ($danhsach[id] == $user_id) {
} else {
echo'<a href="/farm/account.php?id='.$danhsach[id].'">Ăn trộm</div>';
}
echo'</td></tr></table></div>';
}

}else{
header('Location: '.$home.'');
}
if ($tong > $kmess){
echo '<div class="topmenu">' . functions::phan_trang('/farm/bangxephang/', $start, $tong, $kmess) . '</div>';
}
echo'</div>';
require('../incfiles/end.php');
?>