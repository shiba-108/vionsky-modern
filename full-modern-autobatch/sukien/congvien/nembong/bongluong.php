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
$textl = 'Ném Bóng Lượng - XemLaSuong.Tk';
require('../../../incfiles/head.php');
echo '<div class="phdr"><b>Ném Bóng Lượng</b></div>';
echo'<div class="nen_congvien"></div>';
echo'<img src="/avatar/'.$datauser['id'].'.png"/><br/>';
echo '<font color="red">Xu : '.$datauser['tienxu'].'<br/>Vina : '.$datauser['vinaxu'].'<br/><br/></font>';
echo'<div class="list1">Mỗi lần ném <img src="http://vietteen.org/images/ball.png"/> sẽ mất 3 vina.</div>';
echo'<form method="post"><input type="submit" name="nembongxu" value="Ném Nào" /></form></center>';
if(isset($_POST['nembongxu'])) {
if($datauser['vinaxu'] <= 2) {
echo '<b>Bạn đã hết vina để ném bóng rồi nhé.</b>';
} else {
$rand = rand(1, 1);
if($rand == 1) {
$connect->query("UPDATE `users` SET `bongluong`=`bongluong`+'1' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`-'3' WHERE `id`='{$user_id}'");
echo 'Bạn vừa ném <img src="http://vietteen.org/images/ball.png"/> thành công.<br/>Bạn đã ném '.$datauser['bongluong'].' lần bóng lượng.';
}
echo'</div>';
}
}
echo'</div>';
require('../../../incfiles/end.php');
