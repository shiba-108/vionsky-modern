<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../incfiles/core.php');
if(!$user_id){
require('../../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../../incfiles/end.php');
exit;
}
$textl = 'Đổi Điểm Thưởng - Xemlasuong.Tk';
require('../../incfiles/head.php');
echo '<div class="phdr"><b>Đổi Điểm Thưởng</b></div>';
echo'<div class="nen_congvien"></div>';
echo'<img src="/avatar/'.$datauser['id'].'.png"/><br/>';
echo '<font color="red">Xu : '.$datauser['tienxu'].'<br/>Vina: '.$datauser['vinaxu'].'<br/><br/></font>';
echo'<div class="list1">Mua 2 điểm giá 5 VINA.</div>';
echo'<form method="post"><input type="submit" name="muadiem" value="Mua Điểm" /></form></center>';
if(isset($_POST['muadiem'])) {
if($datauser['vinaxu'] <= 4) {
echo '<b>Bạn ko đủ lượng để mua điểm nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("UPDATE `users` SET `diemevent`=`diemevent`+'2' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-'5' WHERE `id`='{$user_id}'");
echo 'Bạn vừa mua 2 điểm thưởng thành công.<br/>Bạn có '.$datauser['diemevent'].' điểm thưởng';
}
echo'</div>';
}
}
echo'</div>';
require('../../incfiles/end.php');
