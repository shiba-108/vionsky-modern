<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../../../incfiles/core.php');
if(!$user_id){
require('../../../../incfiles/head.php');
echo functions::display_error($lng['access_load_forbidden']);
require('../../../../incfiles/end.php');
exit;
}
require('../../../../incfiles/head.php');
echo'<title>XemLaSuong.TK - Sự Kiện Mùa Hè 2015</title>';
echo'<div class="phdr">SỰ KIỆN MÙA HÈ SÔI ĐỘNG 2015</div>';
echo'
<center><img src="http://gocvuichoi.net/images/on.png"><font color="red">Admin<img src="http://gocvuichoi.net/images/Admin.png"></br><img src="/avatar/1.png"></font></center></br><i><marquee>Chào mừng '.$datauser['name'].' đến với Sự tháng 8 của XemLaSuong.TK</marquee></i></br><br/><center><b><font color="red">Nội dung Sự Kiện Tháng 8</font></b></center><br/><b>I. Thời gian:</b><br/>
- Bắt đầu từ 10h sáng ngày 15/8 - 30/8/2015.
<br/><br/>
<b>II. Nội Dung:<br/>
1. Sự kiện đào vật phẩm:</b>
Trong thời gian diễn ra Sự kiện Công viên xuất hiện Khu Trung Tâm Sự Kiện tháng 8.
Tại đây bạn cần giúp đỡ NPC SuKiRo tìm các vật phẩm mà bé ấy đã đánh rơi tại XemLaSuong.Tk của chúng ta.
<b>Đào Vật phẩm</b> khi đào vật phẩm kẹo ma thuật bạn sẽ bị trừ - 1.000 xu <img src="/muahe/keo.png"> và khi đào vật phẩm Hộp quà bạn sẽ bị trừ 1 vina <img src="http://gocvuichoi.net/a/hopqua.png"><br/> . Tỉ lệ đào được là dựa vào may mắn.
Khi đào được các vật phẩm trên bạn có thể đem đến NPC SuKiRo để nhận thưởng bằng cách dùng vật phẩm đã đào được để đổi lấy item Sự kiện.
<br/><br/>
<b>2.</b>
Trong 2 Tuần đầu tiên diễn ra Sự kiện.<br/>
TOP 5 Bạn đào được nhiều Kẹo ma thuật nhất <b>Nhận Pet Pikachu. hoặc Pet Khủng long phun lửa.</b><br/>

TOP 5 bạn đào nhiều Hộp quà nhất <b>Nhận 1 Cánh Blue cấp 6</br>.
Ngoài ra những ngày cuối Sự kiện còn có NPC đi phát quà cho các bạn tại khu Công viên.</b><br/>

Chúc các bạn tham gia Sự kiện vui vẻ';
require('../../../../incfiles/end.php');
