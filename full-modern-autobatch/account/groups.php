<?php
define('_IN_JOHNCMS', 1);
$noionline = 'shop';
require('../incfiles/core.php'); 
$textl= 'Hội nhóm của bạn'; 
$id= intval(abs($_GET['id']));
require('../incfiles/head.php');
if (!$user_id){
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Hội nhóm</div>';
echo'<div class="menu">Chỉ thành viên mới được xem mục này nhé !</div>';
echo'</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nhóm của bạn</div>';
echo'<div class="menu congdong">Tổng hợp các hội nhóm bạn đã tham gia</div>';
$total = ($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `user_id` = '".$user_id."'")->fetch_row()[0] ?? 0);
if($total) {
$req = $connect->query("SELECT * FROM `nhom_user` WHERE `user_id` = '".$user_id."' ORDER BY `time` DESC LIMIT $start, $kmess");
while($res = $connect->fetch_array($req)) {
$thongtinnhom = $connect->fetch_array($connect->query("SELECT * FROM `nhom` WHERE `id`='".$res[id]."'"));
$thanhvien =mysqli_result($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$thongtinnhom['id']."' AND `duyet`='1'") ,0);
echo '<div class="menu list-top">';
$url = @getimagesize('../groups/avatar/'.$thongtinnhom['id'].'.png');
if(is_array($url)) {
echo'<img src="/groups/avatar/'.$thongtinnhom['id'].'.png" height="45" width="45" alt="Logo Đội" class="item"/>';
} else {
echo'<img src="/groups/img/nologo.png" height="45" width="45" alt="Logo Đội" class="item"/>';
}
echo'<a href="/groups/'.$thongtinnhom['id'].'"><b>'.$thongtinnhom['name'].'</b></a><br/><span class="post_mota">'.$thanhvien.' thành viên</span><br/ ><span class="post_mota">'.catchu($res['gt'],0,10).'</span><br/>';
echo'</div>';
}
if ($total > $kmess) {
echo '<div class="menu">' . functions::phan_trang('?', $start, $total, $kmess) . '</div>';
}
} else {
echo '<div class="menu">Chưa có nhóm nào được tạo !</div>';
}
echo'</div>';
require('../incfiles/end.php');
?>