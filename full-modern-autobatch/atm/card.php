<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Nạp Xu';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nạp Xu</div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$pin = $_POST['pin'];
$seri = $_POST['seri'];
$type = $_POST['type'];
if(empty($user_id)){
echo'<div class="menu">Chức năng này chỉ thành viên mới được sử dụng nhé !</div>';
require('incfiles/end.php');
exit;
}
$azkey = '845a376dcf77a26ac35f670449cb17d4'; 
$str_data='azkey='.$azkey.'&seri='.$seri.'&pin='.$pin.'&type='.$type;
$getCode=execPostRequest('http://alozui.mobi/AZNapCard/', $str_data);
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
$menhgia = ($lay == 10000 ? '10000':NULL).($lay == 20000 ? '25000':NULL). ($lay == 50000 ? '75000':NULL).($lay == 100000 ? '150000':NULL).($lay == 200000 ? '300000':NULL).($lay == 500000 ? '800000':NULL);
$xukm100 = $menhgia*2;
$xukm50chia = $menhgia/2;
$xukm50 = $menhgia+$xukm50chia;
$vinaxu = ($lay == 10000 ? '10':NULL).($lay == 20000 ? '25':NULL). ($lay == 50000 ? '75':NULL).($lay == 100000 ? '150':NULL).($lay == 200000 ? '300':NULL).($lay == 500000 ? '800':NULL);
$vinaxukm100 = $vinaxu*2;
$vinaxukm50chia = $vinaxu/2;
$vinaxukm50 = $vinaxu+$vinaxukm50chia;
$loaithe = ($type == VTT ? 'VIETTEL':NULL).($type == VNP ? 'VINAPHONE':NULL).($type == VMS ? 'MOBIFONE':NULL).($type == FTP ? 'Gate':NULL).($type == VTC ? 'Vicoin':NULL); //loai the
$hienthi = '<span style="color:green;">Nạp thành công !</span><br/>
Loại thẻ : '.$loaithe.'<br/>';
//----cong tien cho user----//
if ($_POST['loaixu'] == 'vinaxu'){
echo'Ban nhận được: '.$vinaxu.' Vinaxu';
@$connect->query("INSERT INTO naptien SET type = 'card', seri = '$seri', pin = '$pin', user_id = '$user_id', menhgia = '$lay', tien = 'vn', loai = '$type'");
@$connect->query("UPDATE users SET `vinaxu`=`vinaxu`+'$vinaxu' WHERE `id`='{$user_id}'");
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
@$connect->query("INSERT INTO naptien SET type = 'card', seri = '$seri', pin = '$pin', user_id = '$user_id', menhgia = '$lay', tien = 'x', loai = '$type'");
@$connect->query("UPDATE users SET `tienxu`=`tienxu`+'$menhgia' WHERE `id`='{$user_id}'");
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
$hienthi = 'Thẻ nạp đã sử dụng'; }
echo '<form action="?" method="post" >
'.(!empty($_POST['pin']) ? '<div class="menu">'.trim(nl2br($hienthi)).'</div>':NULL).'
<div class="menu"><input type="text" name="pin" size="22" placeholder="Mã thẻ">
<br><input type="text" name="seri" size="22" placeholder="Seri"><br><select name="type"><option value="VTT">Viettel</option><option value="VNP">Vinaphone</option><option value="VMS">Mobifone</option><option value="FPT">FPT Gate</option><option value="VTC">VTC Vcoin</option></select>
<select name="loaixu">
<option value="tienxu">Xu</option>
<option value="vinaxu">Vinaxu</option>
</select>
<input type="submit" value="Nạp"></form>';
echo'</div>';

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bảng giá Vinaxu</div>';
echo'<div class="menu">10.000 VNĐ = 10 Vinaxu<br>20.000 VNĐ = 25 Vinaxu<br>50.000 VNĐ = 75 Vinaxu<br>100.000 VNĐ = 150 Vinaxu<br>200.000 VNĐ = 300 Vinaxu<br>500.000 VNĐ = 800 Vinaxu</div>';
echo'</div>';

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bảng giá Xu</div>';
echo'<div class="menu">10.000 VNĐ = 15000Xu<br>20.000 VNĐ = 25000Xu<br>50.000 VNĐ = 75000Xu<br>100.000 VNĐ = 150000Xu<br>200.000 VNĐ = 300000Xu<br>500.000 VNĐ = 800000Xu</div>';
echo'</div>';
if($datauser['rights'] ==9){
echo '<div class="danhmuc">Lịch sử nạp thẻ</div>';
$tong = mysqli_result($connect->query("SELECT COUNT(*) FROM naptien WHERE type='card'") ,0);
 $req = $connect->query("SELECT * FROM `naptien` WHERE `type` = 'card' ORDER BY `id` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo ''.nick($res['user_id']).' - Thẻ: <b>'.$res['loai'].': '.$res['menhgia'].'</b> [Seri: '.$res['seri'].'/Pin: '.$res['pin'].'] - '.$res['tien'].'</div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('card.php?', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Chưa có dữ liệu!</div>';
}
}
require('../incfiles/end.php');
?>