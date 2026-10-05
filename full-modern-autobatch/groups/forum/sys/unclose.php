<?php
$textl = 'Mở cửa bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$idnhom = intval(abs($_GET['idnhom']));
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$id."'"));
$tieude = $connect->fetch_array($connect->query("SELECT `text`,`groups` FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$hoinhom = $connect->fetch_array($connect->query("SELECT `id`, `name` FROM `nhom` WHERE `id` = '".$idnhom."'"));
echo'<div class="danhmuc"><img src="/groups/forum/icon/groups.png" alt="icon" style="vertical-align: -3px;"/> <a href="/groups/">Hội Nhóm</a> › <a href="/groups/'.$hoinhom[id].'">'.$hoinhom[name].'</a></div>';
echo'<div class="forum_title list-top">'.$topchinh[text].'</div>';
if ($rights >= 3) {
if ($topchinh[groups] == $idnhom) {
echo'<div class="danhmuc">Mở cửa bài viết</div>';
$connect->query("UPDATE `forum` SET `close`='0' WHERE `id`='{$id}'");
header("Location: /groups/$idnhom/forum/$id");
} else {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi truy vấn</div>';
echo '<div class="menu list-top">Không tìm thấy được bài viết ở hội nhóm này !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo '</div>';
}
} else {
echo'<div class="menu list-top">Bạn không có quyền sử dụng chức năng này !<br/><a href="/groups/'.$tieude[groups].'/forum/'.$topchinh[refid].'"><input type="button" value="Trở về" /></a></div>';
}
///////////////// hết


?>