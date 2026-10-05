<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Đấu Trường';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Vực Đấu Trường</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom congdong"><a href="/arena/tao.php"><input type="button" value="Tạo phòng mới" /></a></div>';
echo'<div class="vina4u-tab"><div class="vina4u-tab-w">';
$req=$connect->query("SELECT * FROM `arena` WHERE `wait`!='4'  ORDER BY `id` DESC LIMIT $chuyentrang,$phannua");
$dem=($connect->query("SELECT COUNT(*) FROM `arena` WHERE `wait`!='4'")->fetch_row()[0] ?? 0);
$i=1;
if($dem) {
while($res=$connect->fetch_array($req)) {
$onlinearena = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "' AND `id`='".$res['user_id']."'")->fetch_row()[0] ?? 0);
if ($onlinearena == '0') {
if ($res['nguoichoi'] == 0) {
@$connect->query("DELETE FROM `arena` WHERE `id`='".$res['id']."'");
@$connect->query("DELETE FROM `arena_cmt` WHERE `sid`='".$res['id']."'");
} else {
$connect->query("UPDATE `arena` SET `win`='".$res['nguoichoi']."' WHERE `id`='".$res['id']."'");
}
}
echo''.(!empty($res['nguoichoi']) ? '':'<span class="arena_new"></span>').'';
echo'<h3 class="vina4u-tab-top">';
echo'<a href="phong.php?id='.$res['id'].'"> ';
echo'<img src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="'.$res['name'].'"/>';
echo''.(!empty($res['nguoichoi']) ? '<img src="'.$home.'/avatar/'.$res['nguoichoi'].'.png" alt="'.$res['nguoichoi'].'"/>':'').'';

echo'<br/>'.nick($res['user_id']).''.($res['win'] == $res['user_id'] ? '<img src="/icon/cup.png" alt="icon" style="vertical-align: -3px;"/>':'').''.(!empty($res['nguoichoi']) ? ' <img src="/icon/boxing.png" alt="icon" style="vertical-align: -3px;"/> '.nick($res['nguoichoi']).' '.($res['win'] == $res['nguoichoi'] ? '<img src="/icon/cup.png" alt="icon" style="vertical-align: -3px;"/>':'').'':'').'';

echo'<br/><p class="clearfix">Bàn '.(!empty($res['nguoichoi']) ? ''.($res['wait'] == 3 ? 'đã chơi':'chưa bắt đầu').'':'trống').'</p>';
echo'</a>';
echo'<br>';
}
echo'</div>';
echo'</div>';
if ($dem > $kmess){
echo '<div class="menu">' . functions::phan_trang('/arena/', $chuyentrang, $dem, $phannua) . '</div>';
}
} else {
echo '<div class="menu">Chưa có bàn nào!</div>';
}
echo'</div>';

require('../incfiles/end.php');
?>