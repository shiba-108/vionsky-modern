<?php
define('_IN_JOHNCMS',1);
include('../incfiles/core.php');
$textl='Quỹ bang hội';
include('../incfiles/head.php');
$check=$connect->query("select `id` from `nhom_user` where `user_id`='$user_id' and `duyet`='1' limit 1")or die(mysql_error());
if(!$connect->query("SELECT * FROM ...")$check)){
	echo functions::display_error('Bạn chưa có bang hội');
	include('../incfiles/end.php');
	exit;
}
$c=$connect->fetch_array($check);
$clan=$connect->fetch_array($connect->query("select * from `nhom` where `id`='".$c['id']."' limit 1"));
echo'<div class="phdr"> Đóng góp quỹ bang</div>';
if( isset($_POST['sub'])){
	$xu=intval($_POST['xu']);
	$luong=intval($_POST['luong']);
	if(($xu>$datauser['xu'])or ($luong>$datauser['luong'])){
		echo functions::display_error('Bạn không có đủ xu hoặc lượng');
		include('../incfiles/end.php');
		exit;
	}
	$quyxu=$clan['xu']+$xu;
	$quyluong=$clan['luong']+$luong;
	$connect->query("update `nhom` set `xu`='".$quyxu."',`luong`='".$quyluong."' where `id`='".$c['id']."' limit 1")or die( mysql_error());
	$xu=$datauser['xu']-$xu;
	$luong=$datauser['luong']-$luong;
	$connect->query("update `users` set `xu`='".$xu."' , `luong`='".$luong."' where `id`='".$user_id."' limit 1")or die( mysql_error());
	echo'<div class="label-success">bạn đã đóng góp thành công</div>';
}
echo'<div class="menu"><form method="post"><p>Nhập số xu bạn muốn đóng góp cho bang hội:</p>';
echo'<p><input type="number" name="xu" value="1"></p>';
echo'<p>Nhập số lượng bạn muốn đóng góp cho bang hội:</p>';
echo'<p><input type="number" name="luong" value="1"></p>';
echo'<p align="center"><input type="submit" name="sub" value="Đóng góp"></p></form></div>';
require('../incfiles/end.php');
?>