<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../incfiles/core.php');
if(!$user_id){
require('../../incfiles/head.php');
echo functions::display_error($lng['access_load_forbidden']);
require('../../incfiles/end.php');
exit;
}
require('../../incfiles/head.php');
echo'<title>XemLaSuong.Tk - Sự Kiện Mùa Hè 2015</title>';
echo'<div class="phdr">SỰ KIỆN MÙA HÈ SÔI ĐỘNG 2015</div>';
echo'<div class="nen_congvien">
</div>';
echo'<div class="list1">Huhu ta bị Admin tát tai giờ đánh rơi đồ tại công viên rồi, ai tìm giúp ta với ta sẽ trả ơn..</div></br></br><center><img src="http://gocvuichoi.net/images/on.png"><font color="red">NPC SiKuRo<img src="http://gocvuichoi.net/images/Admin.png"></font><br/><img src="http://gocvuichoi.net/avatar/2.gif"></center><br/><br/>';
echo'<div class="list1"><a href="/sukien/muahe/daokeo/doiqua">Đổi quà sự kiện</a><br/>
</div>';
echo'<div class="list1"><a href="/sukien/muahe/daokeo/huongdan">Hướng dẫn sự kiện</a><br/>
</div>';
echo'<div class="list1"><a href="/sukien/muahe/index2.php">Đào kẹo</a><br/>
</div>';
echo'<div class="list1"><a href="/sukien/muahe/daoqua.php">Đào hộp quà</a><br/>
</div>';
echo'<div class="list1"><a href="/sukien/muahe/bxh/topkeo.php">Cao thủ đào kẹo</a><br/>
</div>';
echo'<div class="list1"><a href="/sukien/muahe/bxh/topqua.php">Cao thủ đào hộp quà</a><br/>
</div>';
echo'<div class="list1"><a href="/sukien/muahe/daokeo/thanhtich">Thành tích bản thân</a><br/></div>
<div class="phdr">Event Mod By Chaudaik</div>
';
require('../../incfiles/end.php');
