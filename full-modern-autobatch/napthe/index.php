<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Nạp thẻ mua Xu , Vina';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mua Xu , Vina</div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$pin = $_POST['pin'];
$seri = $_POST['seri'];
$type = $_POST['type'];
if(empty($user_id)){
echo'<div class="menu">Chức năng này chỉ thành viên mới được sử dụng nhé !</div>';
require('incfiles/end.php');
exit;
}
$azkey = '85c9b08917386e9a7c2562da920cf688';
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
$hienthi = '<span style="color:#ff1234;">Thông tin thẻ nạp sai</span>';
}elseif($lay == 2){
$hienthi = '<span style="color:#ff1234;">Chưa nhập Pin hoặc Seri</span>';
}elseif($lay >= 10000){
$menhgia = ($lay == 10000 ? '10000':NULL).($lay == 20000 ? '25000':NULL). ($lay == 50000 ? '75000':NULL).($lay == 100000 ? '175000':NULL).($lay == 200000 ? '400000':NULL).($lay == 500000 ? '1000000':NULL);
$xukm100 = $menhgia+$menhgia;
$xukm50chia = $menhgia/2;
$xukm50 = $menhgia+$xukm50chia;
$luong = ($lay == 10000 ? '100':NULL).($lay == 20000 ? '250':NULL). ($lay == 50000 ? '750':NULL).($lay == 100000 ? '1500':NULL).($lay == 200000 ? '3000':NULL).($lay == 500000 ? '10000':NULL);
$vinaxukm100 = $luong+$luong;
$vinaxukm50chia = $luong/2;
$vinaxukm50 = $luong+$vinaxukm50chia;
$loaithe = ($type == VTT ? 'VIETTEL':NULL).($type == VNP ? 'VINAPHONE':NULL).($type == VMS ? 'MOBIFONE':NULL).($type == FTP ? 'Gate':NULL).($type == VTC ? 'Vicoin':NULL); //loai the
$hienthi = '<span style="color:green;">Nạp thành công !</span><br/>
Loại thẻ : '.$loaithe.'<br/>';
//----cong tien cho user----//
if ($_POST['loaixu'] == 'vinaxu'){
echo'Ban nhận được: '.$luong.' vina';
@$connect->query("UPDATE users SET `vinaxu`=`vinaxu`+'$vinaxukm100' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='1'");
$connect->query("INSERT INTO `notice` SET
`user_id` = '".$user_id."',
`user_fr` = '1',
`time` = '" . time() . "',
`post` = '".$lay."',
`chiso` = '".$vinaxukm100."',
`type` = 'v'
");
}
if ($_POST['loaixu'] == 'xu'){
echo'Ban nhận được: '.$menhgia.' Xu';
@$connect->query("UPDATE users SET `tienxu`=`tienxu`+'$xukm100' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='1'");
$connect->query("INSERT INTO `notice` SET
`user_id` = '".$user_id."',
`user_fr` = '1',
`time` = '" . time() . "',
`post` = '".$lay."',
`chiso` = '".$xukm100."',
`type` = 'x'
");
}
}elseif($lay == 3){
$hienthi = 'Thẻ nạp đã sử dụng hoặc không đúng.'; }
echo '<form action="?" method="post" >
'.(!empty($_POST['pin']) ? '<div class="menu">'.trim(nl2br($hienthi)).'</div>':NULL).'
<div class="menu">Mã Thẻ: <br><input type="text" name="pin" size="22" value="">
<br>Seri: <br><input type="text" name="seri" size="22" value=""><br>Loại Thẻ:<br><select name="type"><option value="VTT">Viettel</option><option value="VNP">Vinaphone</option><option value="VMS">Mobifone</option><option value="FPT">FPT Gate</option><option value="VTC">VTC Vcoin</option></select>
</div><div class="menu">
Loại Xu:</br>
<select name="loaixu">
<option value="tienxu">Xu</option>
<option value="vinaxu">Vina</option>
</select>
</div>
<input type="submit" value="Nạp"></form>';
echo'</div>';

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bảng giá Vina</div>';
echo'<div class="menu">10.000 VNĐ = 100 vina<br>20.000 VNĐ = 250 vina<br>50.000 VNĐ = 750 vina<br>100.000 VNĐ = 1500 vina<br>200.000 VNĐ = 3000 vina<br>500.000 VNĐ = 10000 vina</div>';
echo'</div>';
echo'<div class="danhmuc">Bảng giá Xu</div><div class="menu">10.000 VNĐ = 10.000Xu<br>20.000 VNĐ = 25.000Xu<br>50.000 VNĐ = 75.000Xu<br>100.000 VNĐ = 175.000Xu<br>200.000 VNĐ = 400.000Xu<br>500.000 VNĐ = 1.000.000Xu</div>';
echo'</div>';
require('../incfiles/end.php');
?>
