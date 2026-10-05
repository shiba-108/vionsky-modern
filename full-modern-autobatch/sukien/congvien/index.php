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
</div>
<div class="list1">Click vào NPC <b>Cầu Thủ</b> để ném bóng mùa hè nào<br/><img src="/khugiaitri/img/cay.png">
<a href="/sukien/congvien/nembong"><img src="/khugiaitri/img/ct.gif"></a>
<img src="/khusinhthai/img/den.png"/></div>
<div class="list1">Click vào NPC <b>ToYoTa</b> để biết thêm thông tin chi tiết event<br/>
<img src="/images/on.png"><font color="red">NPC ToYoTa<img src="http://gocvuichoi.net/images/Admin.png"></font><br/>
<img src="/khusinhthai/img/den.png"/><a href="/sukien/congvien/thongtin"><img src="/avatar/1.png"/></a>
</div>';
echo'<div class="buico_2">';
require('../../incfiles/end.php');
