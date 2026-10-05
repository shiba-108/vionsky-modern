<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Thu hoạch khế';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thu hoạch khế</div>';
echo'<div class="menu">';
if (($datauser[timethuhoachkhe] + 3600 ) < $time) {
$randkhe = rand(100,500);
$remils = ($connect->query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '31'")->fetch_row()[0] ?? 0);
if($remils > 0) {
$connect->query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$randkhe."' WHERE `id_user` = $user_id AND `semen` = '31' LIMIT 1");
} else {
$connect->query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$randkhe."', '31', '".$user_id."') ");
}
$time = time();
echo '<img src="/icon/caykhechin.png" alt="icon" style="vertical-align: -5px;float: left;margin-right: 5px;"/><br/>Bạn vừa hái được '.$randkhe.' trái khế xin chúc mừng !';
$connect->query("UPDATE `users` SET `timethuhoachkhe` = '".time()."' WHERE `id` = $user_id");
} else {
$hoiphuc = $datauser['timethuhoachkhe'] + 3600 - time();
$timehoiphuc1 = date('H', $hoiphuc);
$timehoiphuc2 = date('i', $hoiphuc);
$timehoiphuc3 = date('s', $hoiphuc);
echo '<img src="/icon/caykhe.png" alt="icon"/><br/>Bạn còn '.(($datauser['timethuhoachkhe'] + 3600) < time() ? '':''.($timehoiphuc2 == 0 ? '' : ''.$timehoiphuc2.' phút ').''.$timehoiphuc3.' giây').' nữa để thu hoạch khế !';
}
echo'</div>';
echo "<div class='menu list-top congdong'>&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a></div>";
echo'</div>';
require('../incfiles/end.php');
?>