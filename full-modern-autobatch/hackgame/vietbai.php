<?php
define('_IN_JOHNCMS', 1);
require ('../incfiles/core.php');
$textl = 'Bài viết mới';
$id= intval(abs($_GET['id']));
require ('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Viết bài mới</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập viết bài nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
if ($rights >= 7) {
if (isset($_POST['submit'])) {
$tieude = functions::checkin($_POST['tieude']);
$nguon = functions::checkin($_POST['nguon']);
$tieude = ucfirst($tieude);
$noidung = isset($_POST['noidung']) ? functions::checkin(functions::autolink(trim($_POST['noidung']))) : '';
$html = isset($_POST['html']) ? 1 : 0;
if(empty($tieude)) {
echo '<div class="menu">Bạn chưa tiêu đề bài viết !</div>';
} else if (mb_strlen($tieude) <= 6) {
echo '<div class="menu">Tiêu đề bài viết phải trên 6 kí tự nhé !</div>';
} else if (mb_strlen($tieude) >= 200) {
echo '<div class="menu">Tiêu đề bài viết tối đa 200 kí tự nhé !</div>';
} else if(empty($noidung)) {
echo '<div class="menu">Bạn chưa nội dung bài viết !</div>';
} else if (mb_strlen($noidung) <= 20) {
echo '<div class="menu">Nội dung bài viết phải trên 20 kí tự nhé !</div>';
} else {
        $connect->query("INSERT INTO `baivietgiaitri` SET
            `time` = '" . time() . "',
            `user_id` = '" .$user_id. "',
            `tieude` = '" . mysql_real_escape_string($tieude) . "',
            `noidung` = '" . mysql_real_escape_string($noidung) . "',
            `nguon` = '" . mysql_real_escape_string($nguon) . "',
            `type` = '1',
            `html` = '".$html."'
        ");
        $rid = mysql_insert_id();
header('Location: /hackgame/'.$rid.'-'.functions::khongdau($tieude).'');
}
} else {
echo'<form method="post">';
echo'<div class="menu list-bottom">';
echo'Tiêu đề bài:<br/><input name="tieude" type="text">';
echo'</div>';
echo'<div class="menu">';
echo'Nội dung bài:<br/><textarea name="noidung" type="text"></textarea>';
echo'</div>';
echo'<div class="menu">';
echo'Nguồn bài:<br/><input name="nguon" type="text">';
echo'</div>';
echo'<div class="menu list-top hot">';
echo'HTML <input type="checkbox" name="html" />';
echo'</div>';
echo'<div class="menu list-top">';
echo'<input type="submit" name="submit" value="Đăng" />';
echo'</div>';
}
} else {
echo'<div class="menu">Bạn phải là Admin mới sử dụng được chức năng này !</div>';
}
echo'</div>';
require ('../incfiles/end.php');