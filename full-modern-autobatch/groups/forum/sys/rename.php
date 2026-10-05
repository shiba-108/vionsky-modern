<?php
$textl = 'Đổi tên bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$idnhom = intval(abs($_GET['idnhom']));
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$id."'"));
$tieude = $connect->fetch_array($connect->query("SELECT `text`,`groups` FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$hoinhom = $connect->fetch_array($connect->query("SELECT `id`, `name` FROM `nhom` WHERE `id` = '".$idnhom."'"));
echo'<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/groups/forum/icon/groups.png" alt="icon" style="vertical-align: -3px;"/> <a href="/groups/">Hội Nhóm</a> › <a href="/groups/'.$hoinhom[id].'">'.$hoinhom[name].'</a></div>';
echo'<div class="menu">'.htmlspecialchars($topchinh[text]).'</div>';
echo'</div>';
if ($rights >= 3) {
if ($topchinh[groups] == $idnhom) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Đổi tên bài viết</div>';
$noidung = functions::checkin($_POST['noidung']);
$noidungtrichdan = bbcode::notags($topchinh[text]);
if (isset($_POST['submit'])) {
$connect->query("UPDATE `forum` SET `text`='{$noidung}' WHERE `id`='{$id}'");
header("Location: /groups/$idnhom/forum/$id");
} else {
echo'<form method="post">';
echo'<div class="menu list-bottom congdong">';
echo'<textarea name="noidung" placeholder="Nhập tên muốn đổi">'.$topchinh[text].'</textarea>';
echo'</div>';
echo'<div class="menu">';
echo'<input type="submit" name="submit" value="Lưu" />';
echo'</div>';
echo'</div>';
}
} else {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi truy vấn</div>';
echo '<div class="menu list-top">Không tìm thấy được bài viết ở hội nhóm này !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo '</div>';
}
} else {
echo'<div class="menu list-top">Bạn không có quyền đổi tên bài viết này !<br/><a href="/groups/'.$tieude[groups].'/forum/'.$topchinh[refid].'"><input type="button" value="Trở về" /></a></div>';
}
///////////////// hết


?>