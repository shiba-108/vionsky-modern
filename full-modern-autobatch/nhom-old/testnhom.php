<?php
define('_IN_JOHNCMS',1);
include('../incfiles/core.php');
$check=$connect->query("select `id` from `nhom_user` where `user_id`='$user_id' and `duyet`='1' limit 1");
if(!$connect->query("SELECT * FROM ...")$check)){
	$connect->query("update `users` set `check`=1 where `id`='$user_id' limit 1");
	header('location: '.$home);
	exit;
}
$c=$connect->fetch_array($check);
$f=fopen('log.txt',a);
$clan=$connect->fetch_array($connect->query("select * from `nhom` where `id`='".$c['id']."' limit 1"));
if($datauser['check']==0)
	fwrite($f,'
'.$user_id.'-'.$c['id'].'-'.$clan['id']);
$connect->query("update `users` set `check`=1 where `id`='$user_id' limit 1");
	header('location: '.$home);
?>