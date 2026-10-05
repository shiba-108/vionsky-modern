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
$textl = 'Tiện Ích';
require('../incfiles/head.php');
echo '<div class="homeforum"><div class="icon-home"><div class="home">Khu Tiện Ích</div></div></div>';
echo'<div class="phdr"><center>Công Cụ</div></center>';
echo'<div class="omenu"><a href="/gt.php"><b>• Quảng Cáo Nhận Quà Hot</b></a></div>';


echo'<div class="omenu"><a href="/users/doiten.php"><b><font color="003366">Đổi Tên Thật</font></b></a></div>';


echo'<div class="phdr"><center>Sự Kiện Hàng Ngày</div></center>';
include 'nhanqua.php';
/*
if ($datauser[rights] >= ) {
echo'<div class="news"><a href="/panel/congtien.php"><font color="brown"><b> • Cộng Tiền Cho TV</b></font></a></div>';
}
*/
echo'<div class="phdr"><center>Trạm ATM</center></div>';
echo'<div class="omenu"><a href="/napthecao"><b><font color="003366">Nạp Xu Lượng</font></b></a><br/>';
echo'Nạp xu, lượng bằng thẻ cào, nhanh gọn, tiện lợi và an toàn!</div>';
echo'<div class="omenu"><a href="/njnnja"><b><font color="003366">Đấu trường Anime</font></b></a><br/>';
echo'Thiam gia và so tài cùng Boss njnnja Naruto Anime</div>';

echo'<div class="omenu"><a href="/rongcity/rongcity.php"><b><font color="003366">Thảnh Phố Rồng</font></b></a><br/>';
echo'Thiam gia và so tài cùng Rồng Của Bạn</div>';



echo'<div class="omenu"><a href="/kethonv1/index.php"><b><font color="003366">Kết hôn đơn phương</font></b></a><br/>';
echo'Chức năng kết hôn Ver dành cho ai FA.</div>';
echo'
<div class="omenu"><a href="/kethon/index.php"><b><font color="003366">Kết hôn ver 2</font></b></a><br/>';
echo'Chức năng kết hôn Ver 2 dành cho cặp đôi yêu thương kết hôn.</div>
<div class="phdr"><center>Khu tiện ích</center></div>';

echo'<div class="omenu"><a href="/users/profile.php?act=matkhau"><b><font color="003366">Đổi Mật Khẩu</font> </b></a><br/>';
echo'Đổi mật khẩu không mất phí.</div>';

echo'<div class="omenu"><a href="/quatang/ccbhv.php"><b><font color="003366">Đổi Quà Công Lao</font></b></a><br/>';
echo'Tham gia boss 20h để nhận điểm công lao</div>';
echo'<div class="omenu"><a href="/khusinhthai/?act=cauca"><b><font color="003366">Câu cá</font> </b></a><br/>';
echo'Tham gia ngay câu cá để kiếm thêm nguồn vốn nào</div>';
echo'<div class="omenu"><a href="/nongtrai/"><b><font color="003366">Nông Trại</font></b></a><br/>';
echo'Tham gia nông trại trồng trọt kiếm thêm nguồn vốn thu nhập nào</div>';
echo'<div class="omenu"><a href="/mod/bxh.php"><b><font color="003366">Bảng xếp hạng</font></b></a><br/>';
echo'Nơi dành cho các bạn đua top để dành lấy những phần quà có 1 không 2 tại diễn đàn</div>';
echo'<div class="omenu"><a href="/mod/minigame.php"><b><font color="003366">Mini Game</font></b></a><br/>';
echo'Tham gia giải trí cùng các trò chơi trực tuyến nhé</div>';

echo'<div class="omenu"><a href="/users/magift.php"><b><font color="003366">GiftCode</font></b></a><br/>';
echo' Nơi sử dụng mã gift để phát quà hoặc trả lương hay có thể là tặng tiền cho bạn</div>';




echo'<div class="omenu"><a href="/panel/danhhieu.php"><b><font color="003366">Mua danh hiệu</font></b></a><br/>Mua danh hiệu tím với giá 200 Lượng</div>';
/*
echo'
<div class="omenu"><a href="/mod/vip.php?act=ok"><b><font color="003366">Mua VIP</font> </b></a><br/>';
echo'Mua VIP bạn sẽ có quyền chuyển tiền cho thành viên khác, Giá chức năng này là 2,000 Lượng.</div>


';


<div class="phdr">Game Mod By Đức Nghĩa </div>';
*/
require('../incfiles/end.php');
?>
