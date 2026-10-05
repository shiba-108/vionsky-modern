<?php
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Xóa ảnh</div>';
if ($rights >= 7) {
if (isset($_POST['submit'])) {
@unlink('../photo/images/'.$id.'.jpg'); 
$connect->query("DELETE FROM `photo` WHERE `id`='{$id}'");
$connect->query("DELETE FROM `photo_like` WHERE `idphoto`='{$id}'");
$connect->query("DELETE FROM `photo_comment` WHERE `idphoto`='{$id}'");
header("Location: /photo/");
} else {
echo'<div class="menu">';
echo'<form method="post">';
echo'<img id="images_post" src="/photo/images/'.$id.'.jpg" alt="image" /><br/>';
echo'Bạn muốn xóa ảnh này !<br />
<input type="submit" name="submit" value="Xoá ảnh này" /></form>';
echo '</div>';
}
} else {
echo'<div class="menu">Bạn phải là Admin mới sử dụng được chức năng này !</div>';
}
echo'</div>';
///////////////// hết


?>