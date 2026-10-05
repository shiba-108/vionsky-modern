<?php
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `photo` WHERE `id` = '".$id."'"));
if ($rights >= 7) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Đổi tên tiêu để ảnh</div>';
$noidung = functions::checkin($_POST['noidung']);
if (isset($_POST['submit'])) {
$connect->query("UPDATE `photo` SET `tieude`='{$noidung}' WHERE `id`='{$id}'");
header('Location: /photo/'.$id.'');
} else {
echo'<form method="post">';
echo'<div class="menu list-bottom congdong">';
echo'<textarea name="noidung" placeholder="Nhập tiêu đề">'.$topchinh[tieude].'</textarea>';
echo'</div>';
echo'<div class="menu">';
echo'<input type="submit" name="submit" value="Lưu" />';
echo'</div>';
}
} else {
echo'<div class="danhmuc">Bạn phải là Admin mới sử dụng được chức năng này !</div>';
}
echo'</div>';
///////////////// hết


?>