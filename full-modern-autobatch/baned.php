<?php
define('_IN_JOHNCMS', 1);
$baned3 = 2;
require_once ('incfiles/core.php');;
$textl = 'Vi phạm của bạn';
require('incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Vi phạm của bạn</div>';
$vipham = $connect->fetch_array($connect->query("SELECT * FROM `cms_ban_users` WHERE `user_id`='" . $user_id. "'"));
$remain = $vipham['ban_time'] - time();
$period = $vipham['ban_time'] - $vipham['ban_while'];
$draan = $vipham['ban_while'] - time();
$timeluyenvo1 = date('H', $draan);
$timeluyenvo2 = date('i', $draan);
echo'<div class="menu">Bạn bị <b>'.nick($vipham['ban_who']).'</b> khoá vì lý do "'.$vipham['ban_reason'].'"<br/></div>';
echo'</div>';
if (empty($ban)){
header('Location: '.$home.'');
} 
require('incfiles/end.php');