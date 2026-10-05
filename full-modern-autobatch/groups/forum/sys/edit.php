<?php
$textl = 'Sửa bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$topchinh = $connect->fetch_array($connect->query("SELECT `text`,`from`,`refid`,`user_id` FROM `forum` WHERE `id` = '".$id."'"));
$tieude = $connect->fetch_array($connect->query("SELECT `text`,`groups` FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$hoinhom = $connect->fetch_array($connect->query("SELECT `id`, `name` FROM `nhom` WHERE `id` = '".$tieude[groups]."'"));
echo '<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/groups/forum/icon/groups.png" alt="icon" style="vertical-align: -3px;"/> <a href="/groups/">Hội Nhóm</a> › <a href="/groups/'.$hoinhom[id].'">'.$hoinhom[name].'</a></div>';
echo'<div class="menu">'.htmlspecialchars($tieude[text]).'</div>';
echo'</div>';
echo '<div class="main-xmenu">';
echo'<div class="danhmuc">Sửa bài viết</div>';
if ($topchinh['user_id'] == $user_id || $rights >= 3) {
$noidung = functions::checkin($_POST['noidung']);
$noidungtrichdan = bbcode::notags($topchinh[text]);
if (isset($_POST['submit'])) {
$connect->query("UPDATE `forum` SET `text`='{$noidung}' WHERE `id`='{$id}'");
if ($tieude[groups] == 0) {
header("Location: /users/forum/$topchinh[refid]");
} else {
header("Location: /groups/$tieude[groups]/forum/$topchinh[refid]");
}
} else {
echo'<form method="post">';
echo'<div class="menu list-bottom congdong">';
echo'<textarea name="noidung" type="text">'.$topchinh[text].'</textarea>';
echo'</div>';
echo'<div class="menu">';
echo'<input type="submit" name="submit" value="Lưu" />';
echo'</div>';
}
} else {
echo'<div class="menu">Bạn không có quyền sửa bài viết này !<br/><a href="/groups/'.$tieude[groups].'/forum/'.$topchinh[refid].'"><input type="button" value="Trở về" /></a></div>';
}
echo'</div>';
///////////////// hết


?>