<?php
$id = intval(abs($_GET['id']));
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `baivietgiaitri` WHERE `id` = '".$id."'"));
if ($rights >= 7 && $thongtin[user_id] == $user_id) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Đổi tên bài viết</div>';
$noidung = functions::checkin($_POST['noidung']);
$noidungtrichdan = bbcode::notags($topchinh[tieude]);
if (isset($_POST['submit'])) {
$connect->query("UPDATE `baivietgiaitri` SET `tieude`='{$noidung}' WHERE `id`='{$id}'");
header('Location: /hackgame/'.$id.'-'.functions::khongdau($topchinh[tieude]).'');
} else {
echo'<form method="post">';
echo'<div class="menu list-bottom congdong">';
echo'<input name="noidung" type="text" value="'.$topchinh[tieude].'">';
echo'</div>';
echo'<div class="menu">';
echo'<input type="submit" name="submit" value="Lưu" />';
echo'</div>';
}
} else {
echo'<div class="menu">Bạn phải là BQT và chủ bài viết mới sử dụng được chức năng này !</div>';
}
echo'</div>';
///////////////// hết


?>