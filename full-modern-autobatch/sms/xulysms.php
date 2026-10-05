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
$sub = explode(' ', $info);
$ma = $sub[1];
if($ma == XLS || $ma == xls || $ma = Xls){
$kh = rand(1,99999999);
$time = time();
@$connect->query("INSERT INTO kichhoat SET ma = '$kh', time = '$time', mb = '$phone'");
$responseInfo = 'Ma kich hoat cua ban tai xemlasuong.tk la: '.$kh.' - Ma chi ton tai trong 1 gio';
} else{
$responseInfo  = 'Sai cu phap !';
}
echo '0|'.$responseInfo;
?>
