<?php
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);
}
else {
}
}
else {
$id = false;
$user = $datauser;
}
$textl = 'Up ảnh đại diện '. $user['name'] . ''; 
$upanh3 = 2;
require('../incfiles/head.php');
require('../incfiles/lib/class.upload.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Up ảnh đại diện</div>';
if (($user_id != $user['id'] && $rights < 7)
    || $user['rights'] > $datauser['rights']
) {
    echo'<div class="menu">Bạn không có quyền</div>';
    require('../incfiles/end.php');
    exit;
}
        if (isset($_POST['submit'])) {
            $handle = new upload($_FILES['imagefile']);
            if ($handle->uploaded) {
                // Обрабатываем фото
                $handle->file_new_name_body = $user['id'];
                //$handle->mime_check = false;
                $handle->allowed = array(
                    'image/jpeg',
                    'image/gif',
                    'image/png'
                );
                $handle->file_max_size = 1024 * $set['flsz'];
                $handle->file_overwrite = true;
                $handle->image_resize = true;
                $handle->image_x = 250;
                $handle->image_y = 320;
                $handle->image_convert = 'png';
                $handle->process('../download/avatar/');
                if ($handle->processed) {
                header('Location: /account/'.$user['id'].'/'.functions::khongdau($user['name']).'');
                } else {
                    echo functions::display_error($handle->error);
                }
                $handle->clean();
            }
        } else {
if ($user_id == $user['id']){
if ($user_id){
if (!file_exists(($rootpath . 'files/users/avatar/' . $user_id . '.png')))
echo '<div class="luuy">Bạn "<b>'.$user['name'].'</b>" ơi vina4u nhiều chức năng giải trí hay lắm như "shop đồ" và "đấu trường" và còn có rất nhiều bạn trên vina4u còn chờ bạn tham gia. Nhưng đầu tiên muốn tham gia <b>'.$user['name'].'</b> phải đăng 1 ảnh đại diện nhé không là không tham gia cộng đồng được đâu.</div>';
}else{
}
            echo'<form enctype="multipart/form-data" method="post" action="'.$home.'/account/'.$user['id'].'/'.functions::khongdau($user['name']).'/upavatar">' .
                '<div class="menu"><input type="file" name="imagefile" value="" /><br/>' .
                '<input type="submit" name="submit" value="Upload" />' .
                '</div></form>';
} else {
echo'<div class="menu">Bạn không được phép upload ảnh người khác</div>';
}
        }
echo'</div>';
require('../incfiles/end.php');
?>