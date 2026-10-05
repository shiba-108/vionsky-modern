<?php
define('_IN_JOHNCMS', 1);
require ('../../incfiles/core.php');
$textl = 'Viết bài mới';
$id= intval(abs($_GET['id']));
$active = 1;
$active2 = 'class="active"';
require ('../../incfiles/head.php');
$hoinhom = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id`='".$id."'"));
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Viết chủ đề nhóm '.htmlspecialchars($hoinhom[name]).'</div>';
if (isset($_POST['submit'])) {
$tieude = functions::checkin($_POST['tieude']);
$tieude = ucfirst($tieude);
$noidung = bbcode::notags($noidung);
$noidung = isset($_POST['noidung']) ? functions::checkin(functions::autolink(trim($_POST['noidung']))) : '';
$thanhviennhom = $connect->fetch_array($connect->query("SELECT `rights` FROM `nhom_user` WHERE `id` = '".$menunhom."' AND `user_id` = '".$user_id."'"));
if(empty($tieude)) {
echo '<div class="menu">Bạn chưa tiêu đề bài viết !</div>';
} else if (mb_strlen($tieude) <= 10) {
echo '<div class="menu">Tiêu đề bài viết phải trên 10 kí tự nhé !</div>';
} else if (mb_strlen($tieude) >= 200) {
echo '<div class="menu">Tiêu đề bài viết tối đa 200 kí tự nhé !</div>';
} else if(empty($noidung)) {
echo '<div class="mmenu">Bạn chưa nội dung bài viết !</div>';
} else if (mb_strlen($noidung) <= 20) {
echo '<div class="menu">Nội dung bài viết phải trên 20 kí tự nhé !</div>';
} else {
if ($rights >=3 || $thanhviennhom[rights] > 0 || $active >=1) {
$duyet = 1;
}
$connect->query("INSERT INTO `forum` SET
`refid` = '".$id."',
`type` = 't',
`time` = '" . time() . "',
`user_id` = '".$user_id."',
`from` = '".$login."',
`text` = '" . mysql_real_escape_string($tieude) . "',
`groups` = '".$id."',
`duyet` = '".$duyet."'
");
$rid = mysql_insert_id();

$connect->query("INSERT INTO `forum` SET
`refid` = '".$rid."',
`time` = '" . time() . "',
`user_id` = '".$user_id."',
`from` = '".$login."',
`text` = '" . mysql_real_escape_string($noidung) . "',
`groups` = '".$id."'
");
$postid = mysql_insert_id();
header("Location: $rid");
}
} else {
echo'<div class="menu list-bottom hot" style="margin-top: -2px">Chuyên đề bạn cần đăng phải liên quan mục đích với nhóm <span style="color:red">'.htmlspecialchars($hoinhom[name]).'</span> chúng tôi sẽ xóa bài viết của bạn nên bài viết sai mục đích thảo luận của nhóm này !</div>';
echo'<form method="post">';
echo'<div class="menu list-bottom">';
echo'<input name="tieude" type="text" placeholder="Tiêu đề">';
echo'</div>';
echo'<div class="menu">';
echo'<textarea name="noidung" type="text" placeholder="Nội dung bài viết"></textarea>';
echo'</div>';
echo'<div class="menu">';
echo'<input type="submit" name="submit" value="Đăng" />';
echo'</div>';
}
echo'</div>';
require ('../../incfiles/end.php');
