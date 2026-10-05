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
$congdong = ' id="selected"';
$textl = 'Ân xá cho '. $user['name'] . ''; 
require('../incfiles/head.php');
$anxa = ($connect->query("SELECT COUNT(*) FROM `nhatu` WHERE `user_id` = '".$user['id']."'")->fetch_row()[0] ?? 0);
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Ân xá cho '. $user['name'] . '</div>';
echo'<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$user['id'].'.png" alt="'.$user['name'].'"/></div>';
if ($anxa == 0){ 
echo'<div class="menu">Bạn này có bị đi tù đâu !</div>'; 
} else {
if(isset($_POST['submit'])) {
$connect->query("DELETE FROM `nhatu` WHERE `user_id`='".$user['id']."'");
header('Location: '.$home.'/account/'.$user['id'].'');
} else {
echo '<form method="post">Bạn muốn ân xá cho '. $user['name'] . ' !<br /><input type="submit" name="submit" value="Ân xá" /></form>'; 
}
}
echo'</div>';
require_once ("../incfiles/end.php");
?>