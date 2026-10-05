<?php
define('_IN_JOHNCMS', 1);
$textl = 'Cao Thủ Đào Quà';
$headmod = 'nick';
require_once ("../../../../incfiles/core.php");
require_once ("../../../../incfiles/head.php");
$id = $_GET['id'];
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);}
}
if (!$user_id) {
echo 'Chỉ cho người dùng đăng ký';
require_once ('../../../../incfiles/end.php');
exit;
}
echo '<div class="phdr">Thành Tích Của '.$datauser['name'].'</div>';
echo'<font color="red">Admin đã nói : </font> '.$datauser['name'].' , bạn hãy cố gắng nhé.';
echo'<div class="list1">Số Điểm Đạt Được : '.$datauser['diemevent'].' điểm</div>';
echo'<div class="list1">Số Lần Đào Được : '.$datauser['keo'].' số lần đào kẹo</div>';
echo'<div class="list1">Số Lần Đào Được : '.$datauser['hopqua1'].' số lần đào hộp quà</div>';
echo'<div class="list1">Số Bóng Xu Ném Được : '.$datauser['bongxu'].' số lần ném</div>';
echo'<div class="list1">Số Bóng Vina Ném Được : '.$datauser['bongluong'].' số lần ném</div>';


require_once ("../../../../incfiles/end.php");
?>
