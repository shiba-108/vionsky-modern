<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
$bhead = 2;
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = 'Mẫu Quảng Cáo';
require('../incfiles/head.php');


echo'<div class="phdr"><b>Quảng Cáo Rồi Nộp Cho Admin Id 1.bạn sẽ được thăng chức nêu qc nhiều!!!</b></div>';
echo'<textarea>BÒ KHÔNG ĂN CỎ BÒ NGU>
BẠN KHÔNG VÔ WAP BẠN NGU HƠN BÒ.
xin chào nếu mình làm phiên.
1 mạng xã hội mới đã quay lại với vô vàn điều mới
không hề có tính năng nạp thẻ.
farm sôi động.
đồ được up liên tục.
bạn mong gì ở sự kiện noel.
1 sự kienẹ k hề hút máu.
1 chức năng mới mang tên TÌM THĂM QUAN và nữa....
tất cả chỉ có tại http://ducnghia.ga
http://ducnghia.ga
http://ducnghia.ga</textarea>';
require('../incfiles/end.php');
?>