<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Bảng Xếp Hạng';
require_once('../incfiles/head.php');
echo '<div class="main-xmenu">';
echo '<div class="phdr">Bảng Xếp Hạng Top MŨ</div>';
$req = $connect->query("SELECT * FROM `users` WHERE `allkem` > 0 AND `rights` != '9'  ORDER BY `allkem` DESC LIMIT 10");
$i = 1;
while ($res=$connect->fetch_array($req)) {
//mau nick
if ($res['rights'] == 0 ) {
$colornick['colornick'] = '2c5170';
}
if ($res['rights'] == 3 ) {
$colornick['colornick'] = '1d7ca8';
}
if ($res['rights'] == 6 ) {
$colornick['colornick'] = '8A0886';
}
if ($res['rights'] == 7 ) {
$colornick['colornick'] = '008000';
}
if ($res['rights'] == 9 ) {
$colornick['colornick'] = 'FF0000';
}
//het mau nick
echo '<div class="omenu">';
echo '<img src="/avatar/'.$res['id'].'.png"></br> <b>Xếp Hạng:</b> '.$i.'</br><b>Nhân vật: <a href="/users/profile.php?user='.$res['id'].'">
<font color="#'.$colornick['colornick'].'"></b>'.$res['name'].'</font></a><b></br>Thành Tích:</b> '.$res['allkem'].' Que Kem<img src="../images/flags/vn.gif"/>';
echo '</div>';
++$i;
}
echo '</br>';
/*
echo '<div class="phdr">BXH thiết kế bởi Đức Nghĩa</div>';
*/
echo '</div>';
require_once('../incfiles/end.php');
?>