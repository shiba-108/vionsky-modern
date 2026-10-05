<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Bán quả cầu quay số';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Rương đạo cụ</div>';
echo'<div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['tienxu'].' Xu <span style="color:#e2e2e2">|</span> '.$datauser['vinaxu'].' Vinaxu</div>';
$id = intval($_GET['id']);
$post = $connect->fetch_array($connect->query("select * from `quayso_item` WHERE `id`= '$id' LIMIT 1"));
$thongtin = $connect->fetch_array($connect->query("select * from `quayso` WHERE  `id` = '$post[go]'  LIMIT 1"));
if(empty($thongtin[name])){
echo '<div class="menu">Quả cầu này Không tồn tại nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;">';
echo '<img src="/khuvuichoi/icon/'.$thongtin['id'].'.png" alt="*" />';
echo'&#160;</td><td>';
echo'<b>'.htmlspecialchars($thongtin['name']).'</b><br />';
echo "Số lượng: <b>".$post['soluong']."</b>";
echo'</td></tr></table></div>';
echo'<div class="menu">Bạn có '.$post['soluong'].' quả cầu "'.$thongtin['name'].'" quả cầu này sẽ bán với giá '.($thongtin[loaixu] == tienxu ? ''.($thongtin['gia']*$post['soluong']/2).' xu':'<span style="color:green">'.($thongtin['gia']*$post['soluong']).' vinaxu</span>').'</div>';
$xu = $thongtin['gia']*$post['soluong']/2;
$vinaxu = $thongtin['gia']*$post['soluong'];
if (isset($_POST['submit'])) {
header("Location: /khuvuichoi/quayso/");
$connect->query("DELETE FROM `quayso_item` WHERE `id`='{$id}'");
if ($thongtin[loaixu] == tienxu) {
$connect->query("UPDATE `users` SET `tienxu` = `tienxu`+ $xu WHERE `id` = $user_id LIMIT 1");
}
if ($thongtin[loaixu] == vinaxu) {
$connect->query("UPDATE `users` SET `vinaxu` = `vinaxu`+ $vinaxu WHERE `id` = $user_id LIMIT 1");
}
} else {
echo'<div class="menu list-top">';
echo'<form method="post">';
echo'<input type="submit" name="submit" value="Bán" />';
echo'</form>';
echo '</div>';
}
echo'</div>';
require('../incfiles/end.php');
?>