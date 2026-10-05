<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$tab = 'vui';
$text1 = 'Nạp Qua 9029';
require('../incfiles/head.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$tien = $_POST['tien'];
$type = $_POST['type'];
$loai = $_POST['loai'];
$giatri = number_format($tien);
$sub = explode(',', $giatri);
$lay = $sub[1];
if($type == VNP){
$dinhmuc = '50000';
}else{
$dinhmuc = '100000';
}
if($loai == X){
$ma = 'X'; }else{
$ma = 'VN'; }
if($type == VTT){
$cuphap = 'MW '.$tien.' AZ NAP MXH/'.$ma.'/'.$user_id; }else{
$cuphap = 'MW AZ NAP'.$sub[0].' MXH/'.$ma.'/'.$user_id; }
if(empty($tien)){
$hienthi = 'Chưa nhập số tiền muốn nạp !';
}elseif($tien < 1000){
$hienthi = 'Bạn phải nạp tối thiểu "1000đ" !';
}elseif($tien > $dinhmuc){
$hienthi = 'Bạn không phép nạp vược quá "'.$dinhmuc.'đ" !';
}elseif($lay != 0){
$hienthi = 'Bạn không được nhập số tiền nạp có bội khác "000" , số tiền nạp phải tròn "1000đ" trở lên !'; }else{
if($loai == 'X'){
$menhgia = $tien; }else{
$menhgia = $tien/1000; }
$loaithe = ($type == VTT ? 'VIETTEL':NULL).($type == VNP ? 'VINAPHONE':NULL).($type == VMS ? 'MOBIFONE':NULL); //loai the
if($loai == 'X'){
$hienthi = 'Bạn muốn nạp : '.$menhgia.' xu ?<br>Soạn tin nhắn :<br><center><b>'.$cuphap.'</b> gởi <b>9029</b><br>(dùng sim '.$loaithe.')</center><br>Số tiền thanh toán : '.$tien.'đ/sms<br>Chú ý : copy cú pháp cho chính xác không mất tiền vô ích vì nhắn sai !<br>'; }else{
$hienthi = 'Bạn muốn nạp : '.$menhgia.' Vinaxu ?<br>Soạn tin nhắn :<br><center><b>'.$cuphap.'</b> gởi <b>9029</b><br>(dùng sim '.$loaithe.')</center><br>Số tiền thanh toán : '.$tien.'đ/sms<br>Chú ý : copy cú pháp cho chính xác không mất tiền vô ích vì nhắn sai !<br>'; } }
echo '<div class="danhmuc">Nạp Tài Khoản</div><form action="?" method="post" >'.(!empty($_POST['tien']) ? '<div class="danhmuc">Tin trả về:</div><div class="list2">'.$hienthi.'</div>':NULL).'<div class="list1"><br><select name="loai"><option value="X">Xu</option><option value="VN">Vinaxu</option></select>
<br><input type="text" name="tien" size="22" placeholder="Số tiền nạp">
<br><select name="type"><option value="VTT">Viettel</option><option value="VNP">Vinaphone</option><option value="VMS">Mobifone</option></select><br><input type="submit" value="Lấy Cú Pháp"></form></div>';
if($datauser['rights'] ==9){
echo '<div class="danhmuc">Lịch sử nạp thẻ</div>';
$tong = mysqli_result($connect->query("SELECT COUNT(*) FROM naptien WHERE type='sms'") ,0);
 $req = $connect->query("SELECT * FROM `naptien` WHERE `type` = 'sms' ORDER BY `id` DESC LIMIT $start, $kmess");
if ($req) { {
$i = 0;
while ($res = $connect->fetch_assoc($req)) {
echo '<div class="list1">';
echo ''.nick($res['user_id']).' - Sms: <b>'.$res['menhgia'].' đ</b></div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="rmenu" align="center">' . functions::display_pagination('sms.php?', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Chưa có dữ liệu!</div>';
}
}
require('../incfiles/end.php');
?>
