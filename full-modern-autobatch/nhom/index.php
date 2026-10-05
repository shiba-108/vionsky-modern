<?php

define('_IN_JOHNCMS', 1);
$headmod = 'clan';
require('../incfiles/core.php');
$textl = 'Clan - Hội Nhóm';
require('../incfiles/head.php');
include_once('func.php');
if($datauser['rights'] >= 9 or $user_id==3)
	echo'<div class="phdr"><a href="../panel/clan.php"><font color="red">Panel clan</font></a> || <a href="../panel/themitemclan.php"><font color="red">Thêm item clan</font></a></div>';
$dv = $connect->fetch_array($connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='$user_id' OR `id`='$id'"));
if($dv['id'] > 0) {
} else {
echo '<form id="form" action="tao.php" method="GET"><button class="chat"/>Tạo Clan mới</button></form>';
}

echo '<div class="mainblok">';

if($dv['id'] >= 1) {
echo '<div class="phdr"><b>Clan tham gia</b></div>';
$dem = ($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `user_id`='$user_id' AND `duyet`='1'")->fetch_row()[0] ?? 0);
if($dem) {
$req = $connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='$user_id' AND `duyet`='1' ORDER BY `time` DESC LIMIT 5");
while($res=$connect->fetch_array($req)) {
$nhom = nhom($res['id']);
echo '<div class="omenu"><img class="avatar_aev" src="/avatar/'.$nhom['user_id'].'.png" alt="" /><a href="page.php?id='.$res['id'].'"><b><font color="2c5170">'.$nhom['name'].'</font><img src="'.$home.'/images/clan/'.$nhom['icon'].'.png"></b></a><br/>'.catchu($nhom['gt'],0,10).'</div>';
}
if($dem > 10)
echo '<div class="omenu" align="center"><a href="more.php">Xem thêm</a></div>';
} else {
echo '<div class="menu" align="center">Chưa tham gia Clan nào!</div>';
}
}
echo '<div class="phdr"><b>Danh sách Clan</b></div>';

$dem = ($connect->query("SELECT COUNT(*) FROM `nhom`")->fetch_row()[0] ?? 0);
if($dem) {
$req = $connect->query("SELECT * FROM `nhom` WHERE `user_id`!='$user_id' ORDER BY `id` DESC LIMIT 5");
while($res=$connect->fetch_array($req)) {
$nhom = nhom($res['id']);
$chunhom = user_nick($nhom['user_id']);
echo '<div class="omenu">

<img class="avatar_aev" src="/avatar/'.$nhom['user_id'].'.png" alt="" />

<a href="page.php?id='.$res['id'].'"><b>Tên Clan: <font color="2c5170">'.$nhom['name'].' </font><img src="'.$home.'/images/clan/'.$nhom['icon'].'.png"></b></a><br>Nhóm Trưởng:<font color="red"> '.$chunhom['name'].'</font>

</br>
<font color="blue">Khẩu Hiệu:</font> <b>'.$nhom['gt'].'</b>


</div>';
}
if($dem > 10)
echo '<div class="omenu" align="center"><a href="more.php?act=nhom">Xem thêm</a></div>';
} else {
echo '<div class="omenu" align="center">Chưa có clan nào!</div>';
}
echo '</div>';
require('../incfiles/end.php');
?>