<?php
$id = intval(abs($_GET['id']));
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `baivietgiaitri` WHERE `id` = '".$id."'"));
if ($rights >= 7 && $thongtin[user_id] == $user_id) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Sửa bài viết</div>';
if ($topchinh[html] == 0) {
$noidung = isset($_POST['noidung']) ? functions::checkin(functions::autolink(trim($_POST['noidung']))) : '';
} else {
$noidung = $_POST['noidung'];
}
if (isset($_POST['submit'])) {
$connect->query("UPDATE `baivietgiaitri` SET `noidung`='{$noidung}' WHERE `id`='{$id}'");
header('Location: /hackgame/'.$id.'-'.functions::khongdau($topchinh[tieude]).'');
} else {
echo'<form method="post">';
echo'<div class="menu">';
echo'<textarea name="noidung" type="text">'.$topchinh[noidung].'</textarea>';
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