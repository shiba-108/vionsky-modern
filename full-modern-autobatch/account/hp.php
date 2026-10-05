<?php
define('_IN_JOHNCMS', 1);
require ('../incfiles/core.php');
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);
}
else {
}
}
else {
$id = false;
$user = $datauser;
}
$thongtinhp = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='{$user[id]}'"));
if(empty($thongtinhp[nick])) {header('Location: '.$home.'');}
$per = floor(($thongtinhp['hp']*100)/$thongtinhp['hpfull']);
if($per>100){
$per=100;
} 
if($per<0){
$per=0;
} 
Header("Content-Type: Image/PNG");
$image=ImageCreateFromPNG("icon/hp.png");
$bar=ImageCreateFromPNG("icon/bar.png"); imagecopy($image, $bar,0, 0, 0, 0, $per,imagesy($bar)); ImagePNG($image);
ImageDestroy($image);
?>
