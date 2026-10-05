<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
$textl = 'Nạp Tiền Qua OTP Pay';
require('../../incfiles/head.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(empty($user_id)){
echo '<div class="footer">Đăng Nhập</div><div class="menu"><center>Để sử dụng vui lòng đăng nhập!</center></div>';
require('../../incfiles/end.php');
exit;
}
$getip = $_SERVER['SERVER_ADDR'];
$otpkey = '715f8e7ba538aacb239aed87eba4ed2e'; //ma OTPKey do gatepay.vn cap . sau khi tich hop hay edit ma nay de tien dc ve tai khoan cua ban tai gatepay.vn
if(isset($_GET['otp'])){
//xac nhan ma otp
$otp = $_POST['otp'];
$loai = $_GET['loai'];
$requestId = $_GET['requestId'];
if($_POST){
$str_data='azkey='.$azkey.'&otp='.$otp.'&requestId='.$requestId;
$str_url='http://gatepay.vn/OTPPay/otp.php';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$str_url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $str_data);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$getCode = curl_exec($ch);
curl_close($ch);
}
$sub = explode('|', $getCode);
$lay= $sub[0];
$tien = $sub[1];
if($lay == 100){
if($loai == 1){
//xu
if($tien < 9000){
$gia = 1;
}elseif($tien >= 10000 && $tien < 19000){
$gia = 2;
}elseif($tien >= 20000 && $tien < 49000){
$gia = 3;
}elseif($tien >= 50000 && $tien < 99000){
$gia = 4;
}elseif($tien >= 100000){
$gia = 5;
}
$menhgia = $tien * $gia;
@$connect->query("UPDATE users SET `balans`=`balans`+'$menhgia' WHERE `id`='{$user_id}'");
$hienthi = 'Chúc mừng bạn đã nạp thành công!
Số vàng : '.$menhgia.'vàng
Số tiền thanh toán : '.$tien.' vnđ';
}elseif($loai == 2){
//luong
if($tien < 9000){
$gia = 41;
}elseif($tien >= 10000 && $tien < 19000){
$gia = 40;
}elseif($tien >= 20000 && $tien < 49000){
$gia = 39;
}elseif($tien >= 50000 && $tien < 99000){
$gia = 38;
}elseif($tien >= 100000){
$gia = 37;
}
$menhgia = $tien / $gia;
$menhgia = explode('.', $menhgia);
$menhgia = $menhgia[0];
@$connect->query("UPDATE users SET `kc`=`kc`+'$menhgia' WHERE `id`='{$user_id}'");
$hienthi = 'Chúc mừng bạn đã nạp thành công !
Số Kim cương : '.$menhgia.'kc
Số tiền thanh toán : '.$tien.' vnđ';
}else{
$hienthi = 'Giao dịch thành công ! Tuy nhiên không thể cộng tiền cho bạn vì phát sinh lỗi, vui lòng liên hệ Admin để được xữ lý !';
}
}elseif($lay == 101){ $hienthi = 'Lỗi, địa chỉ IP truy cập API bị từ chối';
}elseif($lay == 102){ $hienthi = 'Lỗi, tham số gửi từ merchant tới chưa chính xác (thường sai tên tham số hoặc thiếu tham số)';
}elseif($lay == 103){ $hienthi = 'Lỗi, merchant không tồn tại hoặc merchant đang bị khóa kết nối';
}elseif($lay == 105){ $hienthi = 'Trùng mã giao dịch (transRef)';
}elseif($lay == 106){ $hienthi = 'Mã giao dịch không tồn tại hoặc sai định dạng';
}elseif($lay == 107){ $hienthi = 'Thuê bao không hợp lệ';
}elseif($lay == 108){ $hienthi = 'Không gửi được mã OTP cho khách hàng';
}elseif($lay == 109){ $hienthi = 'Không kết nối được đến Charging Proxy';
}elseif($lay == 110){ $hienthi = 'Tài khoản không đủ để thực hiện trừ tiền';
}elseif($lay == 111){ $hienthi = 'Nhập sai mã OTP';
}elseif($lay == 112){ $hienthi = 'Lỗi gửi tin nhắn báo trừ tiền';
}elseif($lay == 114){ $hienthi = 'Số tiền thanh toán quá lớn';
}elseif($lay == 115){ $hienthi = 'Lỗi hệ thống GatePay';
}elseif($lay == 116){ $hienthi = 'Số tiền nạp trong ngày lớn hơn 500,000 vnd';
}elseif($lay == 117){ $hienthi = 'Hệ thống đơn vị phát hành (Telco) bị lỗi hoặc quá tải, thẻ chưa bị trừ.';
}elseif($lay == 119){ $hienthi = 'Số lần thực hiện giao dịch trong một đơn vị thời gian của thuê bao vượt quá giới hạn cho phép';
}elseif($lay == 120){ $hienthi = 'Số lần thử (nhập sai liên tiếp) của giao dịch vượt quá giới hạn cho phép';
}elseif($lay == 121){ $hienthi = 'Hệ thống đơn vị phát hành (Telco) bị lỗi hoặc quá tải, thuê bao chưa bị trừ';
}elseif($lay == 122){ $hienthi = 'Đơn vị phát hành không hỗ trợ nghiệp vụ này';
}elseif($lay == 123){ $hienthi = 'Kết nối tới hệ thống đơn vị phát hành (Telco) bị lỗi, thuê bao chưa bị trừ (thường do lỗi kết nối với Telco, ví dụ sai tham số kết nối, mà không liên quan đến merchant)';
}elseif($lay == 124){ $hienthi = 'Kết nối GatePay tới hệ thống đơn vị cung cấp bị lỗi, thuê bao chưa bị trừ';
}else{
$hienthi = 'Lỗi, tuy nhiên lỗi chưa được định nghĩa hoặc chưa xác định được nguyên nhân';
}
echo '<div class="bmenu">OTP Pay</div><form action="?otp&requestId='.$requestId.'&loai='.$loai.'" method="post" >'.(!empty($_POST['otp']) ? '<div class="list2">'.trim(nl2br($hienthi)).'</div>':NULL).'<div class="list1">ID Giao dịch: '.$requestId.'
<br>OTP: (hãy nhập mã otp từ sms để xác nhận giao dịch)<br><input type="text" name="otp" size="22" value=""><br><input type="submit" value="Xác nhận"></form></div>';
}else{
$sdt = $_POST['sdt'];
$tien = $_POST['tien'];
if($_POST){
$str_data='otpkey='.$otpkey.'&sdt='.$sdt.'&tien='.$tien.'&ip='.$getip;
$str_url='http://gatepay.vn/OTPPay/api.php';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$str_url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $str_data);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$getCode = curl_exec($ch);
curl_close($ch);
}
$sub = explode('|', $getCode);
$lay= $sub[0];
$requestId = $sub[1];
if($lay == 101){ $hienthi = 'Lỗi, địa chỉ IP truy cập API bị từ chối';
}elseif($lay == 102){ $hienthi = 'Lỗi, tham số gửi từ merchant tới chưa chính xác (thường sai tên tham số hoặc thiếu tham số)';
}elseif($lay == 103){ $hienthi = 'Lỗi, merchant không tồn tại hoặc merchant đang bị khóa kết nối';
}elseif($lay == 105){ $hienthi = 'Trùng mã giao dịch (transRef)';
}elseif($lay == 106){ $hienthi = 'Mã giao dịch không tồn tại hoặc sai định dạng';
}elseif($lay == 107){ $hienthi = 'Thuê bao không hợp lệ';
}elseif($lay == 108){ $hienthi = 'Không gửi được mã OTP cho khách hàng';
}elseif($lay == 109){ $hienthi = 'Không kết nối được đến Charging Proxy';
}elseif($lay == 110){ $hienthi = 'Tài khoản không đủ để thực hiện trừ tiền';
}elseif($lay == 111){ $hienthi = 'Nhập sai mã OTP';
}elseif($lay == 112){ $hienthi = 'Lỗi gửi tin nhắn báo trừ tiền';
}elseif($lay == 113){ $hienthi = 'Chưa khai báo mã OTPkey ở GatePay.VN hoặc bạn chèn OTPey không chính xác!';
}elseif($lay == 114){ $hienthi = 'Số tiền thanh toán quá lớn';
}elseif($lay == 115){ $hienthi = 'Lỗi hệ thống GatePay';
}elseif($lay == 116){ $hienthi = 'Số tiền nạp trong ngày lớn hơn 500,000 vnd';
}elseif($lay == 117){ $hienthi = 'Hệ thống đơn vị phát hành (Telco) bị lỗi hoặc quá tải, thẻ chưa bị trừ.';
}elseif($lay == 118){
$hienthi = 'Đã gửi OTP cho khách hàng';
$loai = $_POST['loai'];
header ("Location:?otp&requestId=$requestId&loai=$loai"); //chuyen den trang xac nhan otp
}elseif($lay == 119){ $hienthi = 'Số lần thực hiện giao dịch trong một đơn vị thời gian của thuê bao vượt quá giới hạn cho phép';
}elseif($lay == 120){ $hienthi = 'Số lần thử (nhập sai liên tiếp) của giao dịch vượt quá giới hạn cho phép';
}elseif($lay == 121){ $hienthi = 'Hệ thống đơn vị phát hành (Telco) bị lỗi hoặc quá tải, thuê bao chưa bị trừ';
}elseif($lay == 122){ $hienthi = 'Đơn vị phát hành không hỗ trợ nghiệp vụ này';
}elseif($lay == 123){ $hienthi = 'Kết nối tới hệ thống đơn vị phát hành (Telco) bị lỗi, thuê bao chưa bị trừ (thường do lỗi kết nối với Telco, ví dụ sai tham số kết nối, mà không liên quan đến merchant)';
}elseif($lay == 124){ $hienthi = 'Kết nối GatePay tới hệ thống đơn vị cung cấp bị lỗi, thuê bao chưa bị trừ';
}else{
$hienthi = 'Lỗi, tuy nhiên lỗi chưa được định nghĩa hoặc chưa xác định được nguyên nhân';
}
echo '<div class="danhmuc">Nạp Tiền bằng Tài Khoản Chính</div><form action="?" method="post" >'.(!empty($_POST['sdt']) ? '<div class="list2">'.trim(nl2br($hienthi)).$getCode.'</div>':NULL).'<div class="menu">Nạp  :<br><select name="loai"><option value="1">Vàng</option><option value="2">Kim Cương</option></select><br>Số Điện Thoại: (Viettel or Mobi)<br><input type="text" name="sdt" size="22" value="">
<br>Số Tiền: <br><input type="text" name="tien" size="22" value=""><br><input type="submit" value="Nạp"></form></div>';
}
echo '<div class="danhmuc">Bảng Giá Vàng</div><div class="list2">Từ 1k -> 9k : {số tiền} x 1 = số vàng<br>Từ 10k -> 19k : {số tiền} x 2 = số vàng<br>Từ 20k -> 49k : {số tiền} x 3 = số vàng<br>Từ 50k -> 99k : {số tiền} x 4 = số vàng<br>100k : 100k x 5 = số vàng<br>Ví dụ nạp 50k: => 50000x4=200000(vàng)</div>
<div class="danhmuc">Bảng Giá Kim Cương</div><div class="list2">Từ 1k -> 9k : {số tiền} : 41 = số kc<br>Từ 10k -> 19k : {số tiền} : 40 = số kc<br>Từ 20k -> 49k : {số tiền} : 39 = số kc<br>Từ 50k -> 99k : {số tiền} : 38 = số kc<br>100k : 100k : 37 = số kc<br>Ví dụ: nạp 50k: => số kc= 50000:38=1316 kc<br></div>
<div class="danhmuc">Thông Tin</div>
<div class="list2">Dịch vụ OTP Pay là dịch vụ nạp tiền bằng tài khoản điện thoại:<br>- Chỉ cần nhập số điện thoại bạn muốn dùng để thanh toán<br>- Sau đó nhà mạng sẻ gởi mã OTP qua tin nhắn đến số điện thoại bạn đã nhập để xác nhận chắc rằng bạn là người thực hiện giao dịch<br>- Bạn đã có mã OTP chỉ cần nhập vào ô OTP là bạn đã thực hiện nạp tiền vào wap (nếu không xác nhận trong vòng 5p xem như bạn hủy giao dịch tài khoản điện thoại của bạn không bị trừ)<br>Khuyến cáo : số nhập sai chỉ được 3 lần, nếu vược quá số sai cho phép hệ thống sẻ cấm IP giao dịch của bạn !</div>';
require('../../incfiles/end.php');
?>
