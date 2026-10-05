<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../../../incfiles/core.php');
if(!$user_id){
require('../../../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../../../incfiles/end.php');
exit;
}
$textl = 'Ném Bóng Xu - XemLaSuong.Tk';
require('../../../incfiles/head.php');
echo '<div class="phdr"><b>Ném Bóng Xu</b></div>';
echo'<div class="nen_congvien"></div>';
echo'<img src="/avatar/'.$datauser['id'].'.png"/><br/>';
echo '<font color="red">Xu : '.$datauser['tienxu'].'<br/>Vina : '.$datauser['vinaxu'].'<br/><br/></font>';
echo'<div class="list1">Mỗi lần ném <img src="http://vietteen.org/images/ball.png"/> sẽ mất 3500 xu.</div>';
echo'<form method="post"><input type="submit" name="nembongxu" value="Ném Nào" /></form></center>';
if(isset($_POST['nembongxu'])) {
if($datauser['tienxu'] <= 3499) {
echo '<b>Bạn đã hết xu để ném bóng rồi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("UPDATE `users` SET `bongxu`=`bongxu`+'1' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-'3500' WHERE `id`='{$user_id}'");
echo 'Bạn vừa ném <img src="http://vietteen.org/images/ball.png"/> thành công.<br/>Bạn đã ném '.$datauser['bongxu'].' lần bóng xu.';
}
echo'</div>';
}
}
echo'</div>';
require('../../../incfiles/end.php');
