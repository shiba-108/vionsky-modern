<?php
if ($user_id) {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Like bài viết</div>';
$kiemtra = ($connect->query("SELECT COUNT(*) FROM `photo_like` WHERE `user_id` = '".$user_id."' AND `idphoto`='$id'")->fetch_row()[0] ?? 0);
if ($kiemtra == 0) {
        $connect->query("INSERT INTO `photo_like` SET
            `user_id` = '".$user_id."',
            `idphoto` = '".$id."'
        ");

if($thongtin['user_id']!=$user_id) {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$thongtin['user_id']."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$thongtin['user_id']."',
            `time` = '" . time() . "',
            `baiviet` = '".$id."',
            `type` = 'u'
        ");
}
header("Location: /photo/$id");
} else {
echo'<div class="menu">Bạn đã like ảnh này rồi nhé !</div>';
echo'<div class="menu"><a href="/photo/'.$id.'"><input type="button" value="Trở về"/></a></div>';
}
echo'</div>';
} else {
header("Location: /photo/$id");
}
?>