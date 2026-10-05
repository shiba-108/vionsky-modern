<?php
$textl = 'Xóa bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$idnhom = intval(abs($_GET['idnhom']));
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$id."'"));
$tieude = $connect->fetch_array($connect->query("SELECT `text`,`groups` FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$hoinhom = $connect->fetch_array($connect->query("SELECT `id`, `name` FROM `nhom` WHERE `id` = '".$idnhom."'"));
$thanhviennhom = $connect->fetch_array($connect->query("SELECT `rights` FROM `nhom_user` WHERE `id` = '".$topchinh[groups]."' AND `user_id` = '".$user_id."'"));
echo'<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/groups/forum/icon/groups.png" alt="icon" style="vertical-align: -3px;"/> <a href="/groups/">Hội Nhóm</a> › <a href="/groups/'.$hoinhom[id].'">'.$hoinhom[name].'</a></div>';
echo'<div class="menu">'.$topchinh[text].'</div>';
echo '</div>';
if ($rights >= 3 || $thanhviennhom[rights] > 0) {
if ($topchinh[groups] == $idnhom) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Xóa bài viết</div>';
if (isset($_POST['submit'])) {
header("Location: /groups/$idnhom/forum");
if ($rights >= 9) {
$connect->query("UPDATE `users` SET `vinaxu`= `vinaxu` - '1' WHERE `id`='".$topchinh[user_id]."'");
}
$connect->query("DELETE FROM `forum` WHERE `id`='{$id}'");
$connect->query("DELETE FROM `forum` WHERE `refid`='{$id}'");
} else {
echo'<div class="menu">';
echo'<form method="post">';
echo'Bạn muốn xóa bài viết này !<br />
<input type="submit" name="submit" value="Xoá" />&#160;<a href="/groups/'.$topchinh[groups].'/forum/'.$id.'"><input type="button" value="Trở về" /></a></form>';
echo '</div>';
echo '</div>';
}
} else {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi truy vấn</div>';
echo '<div class="menu list-top">Không tìm thấy được bài viết ở hội nhóm này !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo '</div>';
}
} else {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi truy vấn</div>';
echo'<div class="menu">Bạn không có quyền sử dụng chức năng này !<br/><a href="/groups/'.$topchinh[groups].'/forum/'.$id.'"><input type="button" value="Trở về" /></a></div>';
echo '</div>';
}
///////////////// hết


?>