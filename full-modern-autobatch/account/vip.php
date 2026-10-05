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
$textl = 'Phong VIP cho '. $user['name'] . ''; 
require('../incfiles/head.php');
if ($rights < 6 || $user['rights'] > $rights) {
    echo functions::display_error($lng_profile['error_rights']);
    require('../incfiles/end.php');
    exit;
}
if (isset($_POST['submit'])) {
  if ($user['vip'] == 0) {
    $connect->query("UPDATE users SET vip = '1' WHERE id = '".$user['id']."'");
  } else {
    $connect->query("UPDATE users SET vip = '0' WHERE id = '".$user['id']."'");
  }
  header("location: /account/".$user['id']."");
}
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Phong VIP cho '.$user['name']. '</div>';
echo '<form method="POST" action="">';
if ($user['vip'] == 0) {
echo '<div class="menu"><img src="/avatar/'.$user['id']. '.png" alt="KenAn"/> Bạn muốn <span style="color:green">phong</span> danh hiệu VIP cho '.$user['name']. '</div>';
echo '<div class="menu"><input name="submit" type="submit" value="Phong VIP"></div>'; 
} else {
echo '<div class="menu"><img src="/avatar/'.$user['id']. '.png" alt="KenAn"/> Bạn muốn <span style="color:red">huỷ</span> danh hiệu VIP cho '.$user['name']. '</div>';
echo '<div class="menu"><input name="submit" type="submit" value="Hủy VIP"></div>'; 
}
echo '</div>';

require_once ("../incfiles/end.php");
?>