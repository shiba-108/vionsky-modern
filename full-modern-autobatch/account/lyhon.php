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
$textl = 'Ly hôn với '. $user['name'] . ''; 
require('../incfiles/head.php');
echo'<div class="danhmuc">Kết hôn với '. $user['name'] . '</div>';

if (empty($datauser['nguoiyeu'])) {
echo'<div class="menu list-top">Bạn đã kết hôn đâu mà đòi ly hôn!</div>';
require('../incfiles/end.php');
exit;
}
if ($user['nguoiyeu']== $user_id) {
} else {
echo'<div class="menu list-top">'.nick($user['id']).' không phải là '.($user['sex']== zh ? 'vợ':'chồng').' của bạn nên không thể ly hôn nhé !</div>';
require('../incfiles/end.php');
exit;
}
if ($datauser['tienxu'] < 20000) { 
echo'<div class="menu list-top">Bạn phải có 20000 xu để ly hôn hé !</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_POST['submit'])) {
$connect->query("DELETE FROM `thongbaokethon` WHERE `user_id` = '".$user_id."'");
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`-'20000' WHERE `id` = '" . $user_id. "'");
echo'<div class="menu list-top">Bạn đã ly hôn '.nick($user['id']).' thành công bạn mất 20000 xu !</div>';
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$user['id']."'");
$connect->query("UPDATE `users` SET `nguoiyeu` = '0' WHERE `id` = '" . $user_id. "'");
$connect->query("UPDATE `users` SET `nguoiyeu` = '0' WHERE `id` = '" . $user['id']. "'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$user['id']."',
            `time` = '" . time() . "',
            `type` = 'h'
        ");
} else {
echo'<div class="menu list-top congdong">Bạn đã suy nghĩ kĩ chưa !</div>';
echo'<div class="menu list-top">';
echo'<img src="'.$home.'/avatar/'.$user_id.'.png" class="xavt">';
echo'<img src="'.$home.'/avatar/'.$user[id].'.png"/>';
echo '<form method="post">Bạn muốn ly hôn với '.nick($user['id']). ' !<br /><input type="submit" name="submit" value="Đồng ý" /></form>'; 
echo'</div>';
}
require_once ("../incfiles/end.php");
?>