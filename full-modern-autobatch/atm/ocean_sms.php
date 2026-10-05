<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php'); //file ket noi data o day nhe
$mobile = $_REQUEST['mobile'];
$phone = '+'.$mobile.'';
$phone = str_replace('+84','0', $phone);
$phone = str_replace('+01','01', $phone);
$phone= str_replace('+09','09', $phone);
$sdt = $phone; //so dien thoai da qua xu ly bo 84
$money = $_REQUEST['money'];
$info = $_REQUEST['info'];
$smskey = $_REQUEST['smskey'];
$codekey = '7432bd9a068e3de93c0cbf328a2cf427'; //edit smskey ban lay tu gatepay
$sub = explode('/', $info);
$ma = $sub[1];
$id = $sub[2];
$dem = ($connect->query("select count(*) from `users` where `id` = '".$id."'")->fetch_row()[0] ?? 0);
$us = $connect->fetch_assoc($connect->query("SELECT * FROM `users` WHERE `id`='".$id."' LIMIT 1"));
if($smskey == $codekey){
if($dem == 0){
$responseInfo = 'Tai khoan khong ton tai !';
}else{
if($ma == x || $ma = X){
$menhgia = $money;
@$connect->query("UPDATE users SET `tienxu`=`tienxu`+'$menhgia' WHERE `id`='{$id}'");
@$connect->query("INSERT INTO naptien SET user_id = '$id', tien = 'x', menhgia = '$menhgia', type = 'sms'");
$responseInfo = 'Chuc mung ban da nap '.$menhgia.' xu thanh cong !';
}elseif($ma == VN || $ma == Vn || $ma == vn || $ma == vN ){
$menhgia = $money/1000;
@$connect->query("UPDATE users SET `vinaxu`=`vinaxu`+'$menhgia' WHERE `id`='{$id}'");
@$connect->query("INSERT INTO naptien SET user_id = '$id', tien = 'vn', menhgia = '$money', type = 'sms'");
$responseInfo = 'Chuc mung ban da nap '.$menhgia.' vinaxu thanh cong !';
}else{
$responseInfo = 'Sai cu phap !';
} } }else{
$responseInfo = 'Sai du lieu !';
}
echo '0|'.$responseInfo;
?>