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
$textl = 'Đổi Điểm Thưởng - XemLaSuong.Tk';
require('../../incfiles/head.php');
echo '<div class="phdr"><b>Đổi Điểm Thưởng</b></div>';
echo'<div class="nen_congvien"></div>';
echo'<img src="/avatar/'.$datauser['id'].'.png"/><br/>';
echo '<font color="red">Xu : '.$datauser['tienxu'].'<br/>Vina: '.$datauser['vinaxu'].'<br/><br/></font>';
echo'<div class="list1">Mỗi lần đổi 1 điểm sẽ mất 1 sao và 200 xu.</div>';
echo'<form method="post"><input type="submit" name="doidiem" value="Đổi Điểm" /></form></center>';
if(isset($_POST['doidiem'])) {
if($datauser['saovang'] <=0 ) {
echo '<b>Bạn đã hết sao để đổi rồi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("UPDATE `users` SET `diemevent`=`diemevent`+'1' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-'200',`saovang`=`saovang`-'1' WHERE `id`='{$user_id}'");
echo 'Bạn vừa đổi điểm thưởng thành công.<br/>Bạn có '.$datauser['diemevent'].' điểm thưởng';
}
echo'</div>';
}
}
echo'</div>';
require('../../incfiles/end.php');
