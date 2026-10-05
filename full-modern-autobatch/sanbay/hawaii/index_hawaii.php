<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Hawaii';
$headmod='hawaii';
require('../../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$connect->query("UPDATE `users` SET `online`='hawaii' WHERE `id`='".$user_id."'");
echo '<div class="phdr">Hawaii</div>';
echo '<div class="bien"><a href="index.php"><div class="vaoshop"><br/></div></a></div>';
echo '<div class="nencat">';
echo '<div class="xxxmenu"><img src="/icon/ghehawai.png" alt="ghehawai" style="vertical-align: 4px;"/> <img src="/icon/duhawai.png" alt="duhawai" style="vertical-align: 4px;"/><img src="/icon/ghehawai.png" alt="ghehawai" style="vertical-align: 4px;"/> <img src="/icon/shophawai11.png" alt="shophawai11" style="vertical-align: 4px;"/> <img src="/icon/caydua.png" alt="caydua" style="vertical-align: 4px;"/> <img src="/icon/banghehawai.png" alt="banghehawai" style="vertical-align: 4px;"/><img src="/icon/ochawai.png" alt="ochawai" style="vertical-align: 4px;"/></div>';
//-- Online Topic ---//
$online_u = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `online` = 'hawaii'")->fetch_row()[0] ?? 0);
$online_g = ($connect->query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'hawaii'")->fetch_row()[0] ?? 0);
$totalonline = $online_u + $online_g;
$q = @$connect->query("select * from `users` where `lastdate` > " . (time() - 300) . " AND `online` = 'hawaii';");
$count = $connect->query("SELECT * FROM ...")$q);
while ($arr = $connect->fetch_array($q)){
$trinhtrangvip = $connect->query("select `rights` from `users` where id='" . $arr['id'] . "'");
$trinhtrangviphonnua = $connect->fetch_array($trinhtrangvip);
if($arr['id'] != $datauser['id']){
$u_on[]='<a href="../users/' . $arr['name'] . '_' . $arr['id'] . '.html"><img src="/avatar/nen/' . $arr['id'] . '.png"></a>';
}else{
	$u_on[]='<img src="/avatar/nen/' . $arr['id'] . '.png">';
}
}
//Keet thuc topic
if ($online_u > 0){
echo implode(' ',$u_on).'';
}else{
	echo 'Trống';
}
echo'</div>';
echo'</div>';
require('../../incfiles/end.php');
?>