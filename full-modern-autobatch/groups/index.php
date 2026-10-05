<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Hội Nhóm';
$mota = 'Nơi tổng hợp các hội nhóm lớn nhỏ của xemlasuong.tk, Là nơi giao lưu giữa thành viên xemlasuong.tk';
$active = 1;
$active2 = 'class="active"';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Hội Nhóm</div>';
If($user_id){
$xacnhan = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `duyet` = '1' AND `user_id`='$user_id'")->fetch_row()[0] ?? 0);
if($xacnhan == 0 || $rights == 9) {
echo'<div class="menu"><a href="/groups/clear"><input type="button" value="Tạo nhóm" /></a></div>';
}
}
$total = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `duyet` = '1'")->fetch_row()[0] ?? 0);
if($total) {
$req = $connect->query("SELECT * FROM `nhom` WHERE `duyet` = '1' ORDER BY `time` DESC LIMIT $start, $kmess");
while($res=$connect->fetch_array($req)) {
$thanhvien =mysqli_result($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$res['id']."' AND `duyet`='1'") ,0);
echo '<div class="menu list-top">';
$url = @getimagesize('avatar/'.$res['id'].'.png');
if(is_array($url)) {
echo'<img src="/groups/avatar/'.$res['id'].'.png" height="45" width="45" alt="Logo Đội" class="item"/>';
} else {
echo'<img src="/groups/img/nologo.png" height="45" width="45" alt="Logo Đội" class="item"/>';
}
$xss = htmlspecialchars($res['name']);
echo'<a href="/groups/'.$res['id'].'"><b>'.$xss.'</b></a><br/><span class="post_mota">'.$thanhvien.' thành viên</span><br/ ><span class="post_mota">'.catchu($res['gt'],0,10).'</span><br/>';
echo'</div>';
}
if ($total > $kmess) {
echo '<div class="menu list-top">' . functions::phan_trang('/groups/', $start, $total, $kmess) . '</div>';
}
} else {
echo '<div class="menu list-top">Chưa có nhóm nào được tạo !</div>';
}
echo'</div>';
require('../incfiles/end.php');
?>
