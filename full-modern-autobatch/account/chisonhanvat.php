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
$textl = 'Sửa chỉ số nhân vật '. $user['name'] . ''; 
require('../incfiles/head.php');
if ($rights < 9) {
header('Location: /account/' . $user['id'] . '/' . functions::khongdau($user['name']) . '');
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Sửa thông tin</div>';
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$user['id']."'"));
if (isset($_POST['submit'])) {
    $sucmanh = isset($_POST['sucmanh']) ? functions::check(mb_substr($_POST['sucmanh'], 0, 500)) : ''; 
    $hp = isset($_POST['hp']) ? functions::check(mb_substr($_POST['hp'], 0, 500)) : ''; 
    $hpfull = isset($_POST['hpfull']) ? functions::check(mb_substr($_POST['hpfull'], 0, 500)) : ''; 
        $connect->query("UPDATE `nhanvat` SET
            `sucmanh` = '" .$sucmanh. "',
            `sucmanhgoc` = '" .$sucmanh. "',
            `hp` = '" .$hp. "',
            `hpfull` = '" .$hpfull. "'
            WHERE `user_id` = '" . $user['id'] . "'
        ");
    header('Location: /account/' . $user['id'] . '/' . functions::khongdau($user['name']) . '');
    exit;
}

echo '<form action="'.$home.'/account/' . $user['id'] . '/' . functions::khongdau($user['name']) . '/chiso" method="post">';
$link = '';
if ($rights >= 9) {
echo'<div class="menu">Sức mạnh <input type="text" value="' . $thongtin['sucmanh'] . '" name="sucmanh" /></div>';
echo'<div class="menu">HP <input type="text" value="' . $thongtin['hp'] . '" name="hp" /></div>';
echo'<div class="menu">HP Full <input type="text" value="' . $thongtin['hpfull'] . '" name="hpfull" /></div>';
}
echo '<div class="menu"><input type="submit" value="' . $lng['save'] . '" name="submit" /></div>' .
    '</form>';
echo '</div>';
require_once ("../incfiles/end.php");
?>