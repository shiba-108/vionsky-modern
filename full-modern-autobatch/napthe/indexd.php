<?php
error_reporting(0);
/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
require('../incfiles/head.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$pin = $_POST['pin'];
$seri = $_POST['seri'];
$type = $_POST['type'];
if(empty($user_id)){
echo '<div class="footer">Đăng Nhập</div><div class="menu"><center>Để sử dụng vui lòng đăng nhập!</center></div>';
require('../incfiles/end.php');
exit;
}
$azkey = '85c9b08917386e9a7c2562da920cf688'; //ma AZKey do gatepay.vn cap . sau khi tich hop hay edit ma nay de tien dc ve tai khoan cua ban tai gatepay.vn
$str_data='azkey='.$azkey.'&seri='.$seri.'&pin='.$pin.'&type='.$type;
$getCode=execPostRequest('http://gatepay.vn/AZNapCard/', $str_data);
function execPostRequest($url,$data){
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($ch);
curl_close($ch);
return $result;
}
$lay= str_replace('-','', $getCode);
if($lay == 4){
$hienthi = 'Sai AZKey';
}elseif($lay == 1){
$hienthi = 'Thông tin thẻ nạp sai';
}elseif($lay == 2){
$hienthi = 'Chưa nhập Pin hoặc Seri';
}elseif($lay >= 10000){
$menhgia = $lay; //so tien menh gia the nap
$loaithe = ($type == VTT ? 'VIETTEL':NULL).($type == VNP ? 'VINAPHONE':NULL).($type == VMS ? 'MOBIFONE':NULL).($type == VNM ? 'VIETNAMOBILE':NULL).($type == FTP ? 'Gate':NULL).($type == VTC ? 'Vicoin':NULL).($type == AZP ? 'AZPay':NULL); //loai the
$hienthi = 'Nạp thành công:
Loại thẻ : '.$loaithe.'
Mệnh giá: '.$menhgia.' VNĐ';
//----cong tien cho user----//
@$connect->query("UPDATE users SET `tienxu`=`tienxu`+'$menhgia' WHERE `id`='{$user_id}'");
}elseif($lay == 3){
$hienthi = 'Thẻ nạp đã sử dụng hoặc thẻ sai'; }
echo '<div class="bmenu">Nạp Card</div><form action="?" method="post" >'.(!empty($_POST['pin']) ? '<div class="danhmuc">Tin trả về:</div>
<div class="list2">'.trim(nl2br($hienthi)).'</div>':NULL).'<div class="list1">
<br>Mã Thẻ: <br><input type="text" name="pin" size="22" value="">
<br>Seri: <br><input type="text" name="seri" size="22" value=""><br>Loại Thẻ:<br><select name="type"><option value="VTT">Viettel</option><option value="VNP">Vinaphone</option><option value="VMS">Mobifone</option><option value="VNM">Vietnamobile</option>
<option value="FPT">FPT Gate</option><option value="VTC">VTC Vcoin</option></select><br><input type="submit" value="Nạp"></form></div>';
require('../incfiles/end.php');
?>
