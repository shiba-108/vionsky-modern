<?php
define('_IN_JOHNCMS', 1);
$textl = 'Cao Thủ Đào Kẹo';
$headmod = 'nick';
require_once ("../../../incfiles/core.php");
require_once ("../../../incfiles/head.php");
$id = $_GET['id'];
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);}
}
if (!$user_id) {
echo 'Chỉ cho người dùng đăng ký';
require_once ('../../../incfiles/end.php');
exit;
}
echo '
<div class="mainblok"><div class="phdr"> TOP Cao Thủ Đào Kẹo</div></div><div class="gmenu">';
$tong = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `keo` > 0")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT `id`, `keo`, `name`, `rights` FROM `users` WHERE `keo` > 0 and rights <7 and id!=77 and id!=123 ORDER BY `keo` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
if ($res['rights'] == 0 ) {
$mau = '000000';
}
if ($res['rights'] == 1 ) {
$mau = '0000FF';
}
if ($res['rights'] == 2 ) {
$mau = '0000FF';
}
if ($res['rights'] == 3 ) {
$mau = '0000FF';
}
if ($res['rights'] == 4 ) {
$mau = '0000FF';
}
if ($res['rights'] == 5 ) {
$mau = '0000FF';
}
if ($res['rights'] == 6 ) {
$mau = '009900';
}
if ($res['rights'] == 7 ) {
$mau = 'ff00ff';
}
if ($res['rights'] == 9 ) {
$mau = 'FF0000';
}
echo '<div class="list1">';
echo '<table width="100%" cellpadding="0" cellspacing="0"><tr><td><img src="../avatar/'.$res['id'].'.png"></td>
<td width="90%">
<a href="/users/'.$res['id'].'/'.$res['name'].'"><span style="color:#'.$mau.'">'.$res['name'].'</span></a><br/>
Số kẹo đang sở hữu: '.$res['keo'].'<br/>';
if($i == 0){
echo '<b style="color: red; padding-top: 4px;">TOP 1 SỰ KIỆN MÙA HÈ<b>';
}
if($i == 1){
echo '<b>TOP 2<b>';
}
if($i == 2){
echo '<b>TOP 3<b>';
}
echo '</td></tr></table></div>';
++$i;
}
} else {
echo '<div class="list1">Trống</div>';
}
echo '</div>';
echo '</td></tr></table></div>';


require_once ("../../../incfiles/end.php");
?>
