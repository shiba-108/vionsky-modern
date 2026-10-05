<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Kiểm tra thẻ cào';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Kiểm tra thẻ cào</div>';
$tong = ($connect->query("SELECT COUNT(*) FROM `napthe`")->fetch_row()[0] ?? 0);
$truyvan = $connect->query("SELECT * FROM `napthe` WHERE `tinhtrang` = '0' ORDER BY `time` DESC LIMIT $start, $kmess");
while ($napthe = $connect->fetch_array($truyvan)) { 
echo'<div class="menu list-bottom">';
echo'<b>Tài khoản nạp</b> '.nick($napthe['user_id']).'<br/>';
echo'<b>Mã thẻ</b> '.$napthe['mathe'].'<br/>';
echo'<b>Seri</b> '.$napthe['seri'].'<br/>';
echo'<b>Loại thẻ</b> '.$napthe['loaithe'].'<br/>';
echo'<b>Card </b> '.$napthe['sothe'].' VND<br/>';
echo'<b>Loại xu </b> '.$napthe['loaixu'].'<br/>';
echo'</div>';
}
echo'</div>';
require('../incfiles/end.php');
?>