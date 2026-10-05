<?php
$textl = 'Trích dẫn bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$topchinh = $connect->fetch_array($connect->query("SELECT `text`,`from`,`refid`,`user_id` FROM `forum` WHERE `id` = '".$id."'"));
$tieude = $connect->fetch_array($connect->query("SELECT `id`,`text`,`groups` FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$hoinhom = $connect->fetch_array($connect->query("SELECT `id`, `name` FROM `nhom` WHERE `id` = '".$tieude[groups]."'"));
echo '<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/groups/forum/icon/groups.png" alt="icon" style="vertical-align: -3px;"/> <a href="/groups/">Hội Nhóm</a> › <a href="/groups/'.$hoinhom[id].'">'.$hoinhom[name].'</a></div>';
echo'<div class="menu">'.htmlspecialchars($tieude[text]).'</div>';
echo'</div>';

if ($topchinh[user_id] == $user_id) {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi truy vấn</div>';
echo '<div class="menu">Bạn không thể trích dẫn bài của bạn !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo '</div>';
require('../../incfiles/end.php');
exit;
}
//////////////// phần trich dan
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nội dung trích dẫn của '.$topchinh[from].'</div>';
echo'<div class="menu congdong">';
echo'<textarea type="text">'.$topchinh[text].'</textarea>';
echo'</div>';
echo'</div>';
///////////////// hết

//////////////// phần tra loi
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Trả lời trích dẫn của bạn</div>';
$pagetopic = $set_forum['upfp'] ? 1 : ceil(($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid`='".$topchinh[refid]."'")->fetch_row()[0] ?? 0) / $kmess);
$noidung = functions::checkin($_POST['noidung']);
$noidungtrichdan = bbcode::notags($topchinh[text]);
if (isset($_POST['submit'])) {
$connect->query("UPDATE `forum` SET `time`= '" . time() . "' WHERE `id`='".$tieude[id]."'");
        $connect->query("INSERT INTO `forum` SET
            `refid` = '".$topchinh[refid]."',
            `time` = '" . time() . "',
            `user_id` = '".$user_id."',
            `from` = '".$login."',
            `text` = '".$noidung."',
            `quote` = '".$id."',
            `groups` = '".$xacnhan[refid]."',
            `pages` = '".$pagetopic."'
        ");
$postup = mysql_insert_id();
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$topchinh[user_id]."'");
        $connect->query("INSERT INTO `notice` SET
            `user_id` = '".$user_id."',
            `user_fr` = '".$topchinh[user_id]."',
            `time` = '" . time() . "',
            `baiviet` = '".$topchinh[refid]."',
            `post` = '".$postup."',
            `pages` = '".$pagetopic."',
            `type` = 'q'
        ");

if ($tieude[groups] == 0) {
if ($pagetopic == 1){
header("Location: /users/forum/$topchinh[refid]#post-$postup");
} else {
header("Location: /users/forum/$topchinh[refid]/page/$pagetopic#post-$postup");
}
} else {
if ($pagetopic == 1){
header("Location: /groups/$tieude[groups]/forum/$topchinh[refid]#post-$postup");
} else {
header("Location: /groups/$tieude[groups]/forum/$topchinh[refid]/page/$pagetopic#post-$postup");
}
}

} else {
echo'<form method="post">';
echo'<div class="menu list-bottom congdong">';
echo'<textarea name="noidung" type="text" placeholder="Trả lời trích dẫn"></textarea>';
echo'</div>';
echo'<div class="menu">';
echo'<input type="submit" name="submit" value="Đăng" />';
echo'</div>';
}
echo'</div>';
///////////////// hết


?>