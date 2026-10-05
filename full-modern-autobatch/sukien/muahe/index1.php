<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
$textl = 'XemLaSuong.Tk - Sự Kiện Mùa Hè Sôi Động';
require('../../incfiles/head.php');
echo '
<div class="phdr">NPC DoReKiDo</div>

<div class="nen_congvien"><marquee><img src="/congvien/img/cloud1.png">
<img src="/congvien/img/cloud2.png"></marquee>
<img src="/khugiaitri/img/cay.png">';
echo'<img src="/khusinhthai/img/den.png"/>
<img src="/khugiaitri/img/cay.png">
<img src="/khusinhthai/img/den.png"/></div>
';
echo'<div class="gmenu">';
if($user_id){
echo '
<div class="list1"><table width="100%"><tbody><tr><td width="6%"><img src="/congvien/img/ti.gif" alt="">&nbsp;</td><td style="padding: 0px;" width="80%"><b>[ <font color="red">DoReKiDo</font> ]</b>
<div class="list3"><a href="/sukien/muahe/doidiem.php">Đổi Điểm Sự Kiện</a></div>
<div class="list3"><a href="/sukien/muahe/doiqua">Đổi Quà Sự Kiện</a></div>
<div class="list3"><a href="/sukien/muahe/muadiem.php">Mua Điểm Sự Kiện</a></div>
<div class="list3"><a href="/sukien/muahe/bxh">Top Cao Thủ Ném Bóng</a></div>
<div class="list3"><a href="../">Quay lại</a></div>

</div></div></td></tr></tbody></table></div>
<div class="phdr">Event Mod By Chaudaik</div>
';

}else{
echo '<div class="list1">- Hãy đăng nhập để sử dụng chức năng này nhé!</div>';
}
require('../../incfiles/end.php');
?>
