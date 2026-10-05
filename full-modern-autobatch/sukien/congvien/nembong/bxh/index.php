<?php
define('_IN_JOHNCMS', 1);
$textl = 'Cao Thủ Ném Bóng';
$headmod = 'nick';
require_once ("../../../incfiles/core.php");
require_once ("../../../incfiles/head.php");
$id = $_GET['id'];
if ($id && $id != $user_id) {
    $req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
    if ($req) { {
        $user = $connect->fetch_assoc($req);}
		}
if (!$user_id) {
    echo 'Chỉ cho người dùng đăng ký';
    require_once ('../../../incfiles/end.php');
    exit;
}
echo '<div class="list1"><a href="bongxu.php">Cao thủ ném bóng xu</a></div>';
echo'<div class="list1"><a href="bongluong">Cao thủ ném bóng lượng</a></div>';

require_once ("../../../incfiles/end.php");
?>