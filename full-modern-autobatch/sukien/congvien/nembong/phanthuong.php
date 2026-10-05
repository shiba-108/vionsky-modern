<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../../incfiles/core.php');
if(!$user_id){
require('../../../incfiles/head.php');
echo functions::display_error($lng['access_load_forbidden']);
require('../../../incfiles/end.php');
exit;
}
require('../../../incfiles/head.php');
echo'<title>XemLaSuong.Tk - Sự Kiện Mùa Hè 2015</title>';
echo'<div class="phdr">SỰ KIỆN MÙA HÈ SÔI ĐỘNG 2015</div>';
echo'
<div class="newsx"><img src="/khugiaitri/img/ct.gif"><br/><font color="red"></div>
<div class="list3">TOP Ném Bóng Xu :</div></font>
<div class="list1">Người ném vô địch thứ nhất : Nhận được 5 triệu xu và 200 vina + Pét Bù Nhìn</div>
<div class="list1">Người ném vô địch thứ hai : Nhận được 3 triệu xu và 100 vina + Pét Khủng Long Phun Lửa</div>
<div class="list1">Người ném vô địch thứ ba : Nhận được 1 triệu xu.</div>
<div class="list3"><font color="red">TOP Ném Bóng Vina :</font></font></div>
<div class="list1">Người ném vô địch thứ nhất : Nhận được 5 triệu xu và 500 vina + ( Pét Dâu Tây hoặc Quả Bóng RoNaDol).</div>
<div class="list1">Người ném vô địch thứ hai : Nhận được 3 triệu xu và 200 vina + Pét KirTy Pal.</div>
<div class="list1">Người ném vô địch thứ ba : Nhận được 1 triệu xu.<div>
</div>Chúc các bạn có 1 mùa hè vui vẻ.</div>
';

require('../../../incfiles/end.php');
