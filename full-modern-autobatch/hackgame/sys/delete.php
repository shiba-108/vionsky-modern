<?php
$textl = 'Xóa bài viết';
$id = intval(abs($_GET['id']));
if ($rights >= 1 && $thongtin[user_id] == $user_id) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Xóa bài viết</div>';
if (isset($_POST['submit'])) {
header("Location: /hackgame/");
$connect->query("DELETE FROM `baivietgiaitri` WHERE `id`='{$id}'");
$connect->query("DELETE FROM `baivietgiaitri_url` WHERE `baiviet`='{$id}'");
} else {
echo'<div class="menu">';
echo'<form method="post">';
echo'Bạn muốn xóa bài viết này !<br />
<input type="submit" name="submit" value="Xoá tin này" /></form>';
echo '</div>';
}
} else {
echo'<div class="menu">Bạn phải là BQT và chủ bài viết mới sử dụng được chức năng này !</div>';
}
echo'</div>';
///////////////// hết


?>