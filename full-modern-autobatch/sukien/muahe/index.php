<?php
///Event Mùa Hè Mod By Chaudaik///
//Hãy để nguồn nếu là người văn minh///
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
echo'<marquee><font color="red">Chào mừng bạn đến với SK Mùa Hè Sôi Động 2015 Chỉ có tại XemLaSuong.Tk</marquee></br></br><center><img src="http://gocvuichoi.net/images/on.png"><font color="red">NPC KID</font><img src="http://gocvuichoi.net/images/Admin.png"></br><img src="http://27.0.14.78/services/avatar/image2/trongniit.gif"/></center></br><b>- Hãy lựa chọn khu vực mà bạn muốn đi đến</b>.</font></br><br/>';
echo'<div class="list1">
<a href="/sukien/muahe/index1.php"><img src="http://gocvuichoi.net/congvien/vao.gif"/>Vào Trung tâm Sk Mùa hè sôi động 2015<img src="http://gocvuichoi.net/images/smileys/simply/hot:.gif"></a><br/></br>
<a href="/sukien/muahe/daokeo.php"><img src="http://gocvuichoi.net/congvien/vao.gif"/>Tham Gia Sự Kiện Đào Kẹo Tháng 8<img src="http://gocvuichoi.net/images/smileys/simply/hot1:.gif"/></a></div>
<div class="phdr">Event Mod By XemLaSuong.Tk</div>
';

require('../../incfiles/end.php');
