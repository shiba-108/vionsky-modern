<?php
$textl = 'Xóa bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$topchinh = $connect->fetch_array($connect->query("SELECT `text`,`from`,`refid`,`user_id` FROM `forum` WHERE `id` = '".$id."'"));
$tieude = $connect->fetch_array($connect->query("SELECT `text`,`groups`,`user_id` FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$hoinhom = $connect->fetch_array($connect->query("SELECT `id`, `name` FROM `nhom` WHERE `id` = '".$tieude[groups]."'"));
echo'<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/groups/forum/icon/groups.png" alt="icon" style="vertical-align: -3px;"/> <a href="/groups/">Hội Nhóm</a> › <a href="/groups/'.$hoinhom[id].'">'.$hoinhom[name].'</a></div>';
echo'<div class="menu">'.$tieude[text].'</div>';
echo '</div>';
if ($topchinh['user_id'] == $user_id || $rights >= 3) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Xóa bài viết</div>';
$noidung = functions::checkin($_POST['noidung']);
$noidungtrichdan = bbcode::notags($topchinh[text]);
if (isset($_POST['submit'])) {
header("Location: /groups/$tieude[groups]/forum/$topchinh[refid]");
$connect->query("DELETE FROM `forum` WHERE `id`='{$id}'");
} else {
echo'<div class="menu">';
echo'<form method="post">';
echo'Bạn muốn xóa bình luận này !<br />
<input type="submit" name="submit" value="Xoá" />&#160;<a href="/groups/'.$tieude[groups].'/forum/'.$topchinh[refid].'"><input type="button" value="Trở về" /></a></form>';
echo '</div>';
}
} else {
echo'<div class="menu list-top">Bạn không có quyền xóa bài viết này !<br/><a href="/groups/'.$tieude[groups].'/forum/'.$topchinh[refid].'"><input type="button" value="Trở về" /></a></div>';
}
echo'</div>';
///////////////// hết


?>