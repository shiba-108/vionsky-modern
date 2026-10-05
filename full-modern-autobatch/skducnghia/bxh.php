<?
define('_IN_JOHNCMS', 1);
$noionline = 'quayso';
require_once ('../incfiles/core.php');
$textl = 'Sự Kiện Yêu Lao Động - TeenVui.Me';
require_once ('../incfiles/head.php');
if ($user_id){
echo'<div class="danhmuc">Bảng xếp hạng sự kiện</div>';
$call = $connect->query("SELECT * FROM `users` WHERE `point_all` > 0 ORDER BY `point_all` DESC LIMIT 10");
while($hoai = $connect->fetch_array($call))
{
echo'<div class="list-me"><img src="http://teenvui.me/avatar/'.$hoai['id'].'.png" alt="'.$hoai['name'].'" class="avatar_vina">
<a href="'.$set['homeurl'].'/account/'.$hoai['id'].'" title="'.$hoai['name'].'">'.nick($hoai['id']).'</a><br/>Điểm hiện có: <b>'.$hoai['point_all'].'</b> điểm</div>';
}

include'menu.php';
}
require_once ("../incfiles/end.php");


?>