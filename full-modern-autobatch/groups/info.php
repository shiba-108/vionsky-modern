<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
require('../incfiles/lib/class.upload.php');
$id= intval(abs($_GET['id']));
$nhom = $connect->fetch_array($connect->query("SELECT * FROM `nhom` WHERE `id`='".$id."'"));
$textl= $nhom['name'];
$active = 1;
$active2 = 'class="active"';
require('../incfiles/head.php');
$dem = ($connect->query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'")->fetch_row()[0] ?? 0);
if (!isset($id) || $dem == 0) {
echo'<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi nhóm</div>';
echo '<div class="menu">Nhóm không tồn tại hoặc đã bị xoá !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
if ($nhom[duyet] == 0) {
echo'<div class="main-xmenu">';
echo '<div class="danhmuc">Nhóm đang chờ duyệt</div>';
echo '<div class="menu" style="color:red"><b>Nhóm đang được BQT kiểm duyệt, nó sẽ hiển thị công khai khi nhóm đúng quy định !</b></div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
//// head ///
$nhom = $connect->fetch_array($connect->query("SELECT * FROM `nhom` WHERE `id`='".$id."'"));
$thanhvien =mysqli_result($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$id."' AND `duyet`='1'") ,0);
$duyet =($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `duyet`='0'")->fetch_row()[0] ?? 0);
echo'<div class="main-xmenu">';
echo '<div class="danhmuc">'.htmlspecialchars($nhom['name']).'</div>';
echo '<div class="menu">';
$url = @getimagesize('avatar/'.$id.'.png');
if(is_array($url))
echo'<img src="/groups/avatar/'.$id.'.png" alt="Logo Đội"/>';
else
echo'<img src="/groups/img/nologo.png" alt="Logo Đội"/>';
echo '</div>';
if ($id=='21') {
} else {
echo '<div class="menu list-top hot"><img src="/groups/img/member.gif" alt="Thành viên" style="vertical-align: -3px;"/> <a href="/groups/member.php?id='.$id.'">Tổng thành viên '.$thanhvien.'</a></div>';
if($nhom['user_id'] == $user_id) {
echo '<div class="menu list-top"><img src="/groups/img/donxinvaonhom.png" alt="Đơn xin vào nhóm" style="vertical-align: -3px;"/> <a href="/groups/'.$id.'/donxin">Đơn xin vào nhóm ('.$duyet.')</a></div>';
}
}
if($user_id) {
$ktdem = ($connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `user_id`='".$user_id."' AND `id`='".$id."'")->fetch_row()[0] ?? 0);
$kt = $connect->fetch_array($connect->query("SELECT * FROM `nhom_user` WHERE `user_id`='".$user_id."' AND `id`='".$id."'"));
echo''.($ktdem == 0 ? '<div class="menu list-top"><form method="post" action="/groups/'.$id.'/participation"><input type="submit" name="sub" value="Xin vào nhóm" /></form></div>':''.($kt['duyet'] == 0 ? '<div class="menu list-top"><form method="post" action="/groups/'.$id.'/unparticipation"><input type="submit" name="sub" value="Đang chờ duyệt" /></form></div>':''.($kt['duyet'] == 1 && $kt['rights'] != 2 ? '<div class="menu list-top"><form method="post" action="/groups/'.$id.'/unparticipation"><input type="submit" name="sub" value="Rút khỏi nhóm" /></form></div>':'').'').'').'';
}
echo '<div class="menu list-top">'.$nhom['gt'].''.($nhom['user_id'] == $user_id ? ' <a href="/groups/'.$id.'/edit">[Sửa]</a> <a href="/groups/logo/'.$id.'">[Up logo nhóm]</a>':'').'</div>';
echo'</div>';
/////////////////////////////

$thanhvien = mysqli_result( $connect->query("SELECT COUNT(*) FROM `nhom_user` WHERE `user_id`='$user_id' AND `id`='$id'"),0);
if(isset($_GET['thamgia'])) {
if($thanhvien == 0) {
$connect->query("INSERT INTO `nhom_user` SET `user_id`='$user_id', `id`='$id', `time`='$time', `rights`='0', `duyet`='0'");
header('Location: /groups/'.$id.'');
}
}
if(isset($_GET['rutkhoi'])) {
if($thanhvien >= 1 && $nhom['user_id']!=$user_id) {
$connect->query("DELETE FROM `nhom_user` WHERE `user_id`='$user_id' AND `id`='$id'");
header('Location:/groups/'.$id.'');
}
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chủ đề của nhóm</div>';
if ($user_id && $id!=1 || $rights >= 3) {
echo'<div class="menu list-bottom"><a href="/groups/'.$id.'/forum/clear"><input type="button" value="Viết bài mới"/></a></div>';
}
$tong = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `groups` = '".$id."'")->fetch_row()[0] ?? 0);
if ($tong) {
$truyvan = $connect->query("SELECT * FROM `forum` WHERE `type` = 't' AND `groups` = '".$id."' ORDER BY `id` DESC LIMIT $start, $kmess");
$i = 1;
while ($baiviet = $connect->fetch_array($truyvan)) {
$thongtinnhom = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id`='{$baiviet[groups]}'"));
$likeforum = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `user_id` = '".$user_id."' AND `topic_like` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$commentforum = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$nguoicomment = $connect->fetch_array($connect->query("SELECT `user_id` FROM `forum` WHERE `refid` = '" . $baiviet['id'] . "'ORDER BY time DESC"));
?>
<div class="menu list-bottom forum">
<img src="/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/>
<a href="<?php echo $home; ?>/groups/<?php echo $baiviet[groups]; ?>/forum/<?php echo $baiviet[id]; ?>"><?php
$xss = htmlspecialchars($baiviet['text']);
echo mb_substr($xss, 0, 100); ?></a>
<span style="color:red">[♥<?php echo $likeforum; ?>/<?php echo ($commentforum-1); ?>]</span> <?php echo nick($nguoicomment[user_id]); ?>
</div>
<?php +$i; } ?>
<?php } else {
echo'<div class="menu">Nhóm chưa có chủ đề nào cả !</div>';
}
if ($tong > $kmess) { echo '<div class="menu">' . functions::phan_trang('/groups/'.$id.'/', $start, $tong, $kmess) . '</div>'; }
echo'</div>';
require('../incfiles/end.php');
?>
