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
echo'<div class="list1">Mua 5 trái giá 7 Vina .</div>';
echo'<form method="post"><input type="submit" name="muabong" value="Mua bóng" /></form></center>';
if(isset($_POST['muabong'])) {
if($datauser['vinaxu'] <= 6) {
echo '<b>Bạn đã hết Vina để mua rồi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("UPDATE `users` SET `bongevent`=`bongevent`+'5' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-'7' WHERE `id`='{$user_id}'");
echo 'Bạn vừa mua bóng thành công.<br/>Bạn có '.$datauser['bongevent'].' quả bóng<br/>Hãy ra công viên để ném bóng bạn nhé.';

}
echo'</div>';
}
}
echo'</div>';
require('../../incfiles/end.php');
