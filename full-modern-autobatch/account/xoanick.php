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
$textl = 'Xóa nick '. $user['name'] . ''; 
require('../incfiles/head.php');
if ($rights >= 7) {
echo'<div class="danhmuc">Xóa nick '. $user['name'] . '</div>';
if(isset($_POST['submit'])) {
header('Location: '.$home.'');
$connect->query("DELETE FROM `users` WHERE `id`='".$user['id']."'");
} else {
echo'<img src="'.$home.'/avatar/'.$user[id].'.png"/>';
echo '<form method="post">Bạn muốn xóa nick '. $user['name'] . ' !<br /><input type="submit" name="submit" value="Xóa" /></form>'; 
}
} else {
header('Location: '.$home.'');
}
require_once ("../incfiles/end.php");
?>