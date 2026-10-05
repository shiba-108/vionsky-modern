<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../../incfiles/core.php');
if(!$user_id){
require('../../../../incfiles/head.php');
echo functions::display_error($lng['access_load_forbidden']);
require('../../../incfiles/end.php');
exit;
}
require('../../../incfiles/head.php');
echo'<title>XemLaSuong.Tk - Sự Kiện Mùa Hè 2015</title>';
echo'<div class="phdr">SỰ KIỆN MÙA HÈ SÔI ĐỘNG 2015</div>';
echo'<div class="nen_congvien">
</div>
<div class="newsx"><img src="/khugiaitri/img/ct.gif"><br/><font color="red">Khi bạn là người ném bóng xu or lượng nhiều nhất.
<br/>Bạn sẽ nhận được phần thưởng rất giá trị từ BQT</div></font>
<div class="list3"><a href="/sukien/congvien/nembong/phanthuong.php">Click để xem phần thưởng</a></div>
<div class="list1"><a href="bongxu.php"><img src="http://vietteen.org/systems/vao.gif"/>Ném Bóng Bằng Xu</a></div>
<div class="list1"><a href="bongluong.php"><img src="http://vietteen.org/systems/vao.gif"/>Ném Bóng Bằng Vina</a></div>';
echo'<div class="list3"><a href="/sukien/congvien/nembong/bxh">Top Cao Thủ Ném Bóng</a></div>
';
require('../../../incfiles/end.php');
