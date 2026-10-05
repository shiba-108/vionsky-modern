<?php
define('_IN_JOHNCMS', 1);
$noionline = 'shop';
require('../incfiles/core.php');
$textl= 'Boss';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';




echo '<div class="phdr"><b>Bảng xếp hạng Sức Mạnh</b></div>';
$req = $connect->query("SELECT * FROM `users` WHERE `sucmanh` >= 1 AND `rights` < 9  ORDER BY `sucmanh` DESC LIMIT 5");
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
echo '<div class="menu">';
echo '<b>'.$i.'. <a href="/users/profile.php?user='.$res['id'].'">
<font color="#'.$colornick['colornick'].'">'.$res['name'].'</font></a></b> - '.$res['sucmanh'].' Sức Mạnh';
echo '</div>';
++$i;
}

echo'<div class="phdr">Trung Tâm Oánh Boss</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu congdong"><a href="/boss/taophong.php"><input type="button" value="Tạo Phòng Mới" /></a></div>';
echo'<div class="phdr">Phòng đã tạo</div>';
$req=$connect->query("SELECT * FROM `boss` WHERE `wait`!='4'  ORDER BY `id` DESC");
$dem=($connect->query("SELECT COUNT(*) FROM `boss` WHERE `wait`!='4'")->fetch_row()[0] ?? 0);
$i=1;
if($dem) {
while($res=$connect->fetch_array($req)) {
$tenboss = $connect->fetch_array($connect->query("SELECT `tenboss` FROM `boss_chien` WHERE `idboss` = '".$res['boss']."'"));
echo'<div class="menu list-top">';
echo'<img src="/boss/img/boss_new.png" alt="icon" style="vertical-align: -4px;"/>';
echo'<a href="/boss/phong.php?id='.$res['id'].'"> ';
echo'Boss '.$tenboss[tenboss].'</a> ';
echo'Người chơi: '.nick($res['user_id']).''.(!empty($res['nguoichoi']) ? ', '.nick($res['nguoichoi']).''.(!empty($res['nguoichoi2']) ? ', '.nick($res['nguoichoi2']).'':'').''.(!empty($res['nguoichoi3']) ? ', '.nick($res['nguoichoi3']).'':'').'':'').'';
echo'<div style="margin-left: 18px">';
echo'Tình trạng: '.($res['win'] == 1 ? '<span style="font-size:12px;color:green;">Thắng</span>':''.($res['win'] == 3 ? '<span style="font-size:12px;color:red;">Thua</span>':''.($res['wait'] == 3 ? 'Đang đánh':'Chưa đánh').'').'').'';

echo'</div>';
echo'</div>';
}
} else {
echo '<div class="menu list-top">Chưa có phòng nào!</div>';
}
echo'</div>';

require('../incfiles/end.php');
?>
