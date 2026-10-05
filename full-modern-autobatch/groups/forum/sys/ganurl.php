<?php
$textl = 'Gắn link vào bài viết';
require ('../../incfiles/head.php');
$id = intval(abs($_GET['id']));
$idnhom = intval(abs($_GET['idnhom']));
$topchinh = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$id."'"));
$tieude = $connect->fetch_array($connect->query("SELECT `text`,`groups` FROM `forum` WHERE `id` = '".$topchinh[refid]."'"));
$hoinhom = $connect->fetch_array($connect->query("SELECT `id`, `name` FROM `nhom` WHERE `id` = '".$idnhom."'"));
echo '<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/groups/forum/icon/groups.png" alt="icon" style="vertical-align: -3px;"/> <a href="/groups/">Hội Nhóm</a> › <a href="/groups/'.$hoinhom[id].'">'.$hoinhom[name].'</a></div>';
echo'<div class="menu">'.$tieude[text].'</div>';
echo '</div>';
if ($topchinh['user_id'] == $user_id || $rights >= 3) {
if ($hoinhom[id] == $idnhom) {
if (isset($_GET['edit']))  {
echo '<div class="main-xmenu">';
echo'<div class="danhmuc">Gắn link bài viết</div>';
$chinhsua = $connect->query("SELECT * FROM `ganurl` WHERE `id` = '" . $_GET['edit'] . "'");
$suaurl = $connect->fetch_assoc($chinhsua);
echo '<div class="menu">';
echo '<form method="post">';
echo 'URL Muốn sửa: <br /> 
<input type="text" name="url" cols="22" tabindex="4" class="form" value="'.$suaurl['url'].'"> <br />';
echo 'Tên hiển thị:<br/>
<input type="text" value="'.$suaurl['tenurl'].'" cols="22" tabindex="4" class="form" name="tenurl"><br />';
echo '<input type="submit" name="submit" class="button" value="Sửa xong"/></form>';
echo '</div>';
$nhapurl = isset($_POST['url']) ? trim($_POST['url']) : '';
$ten = isset($_POST['tenurl']) ? trim($_POST['tenurl']) : '';
if (isset($_POST['submit']))
{
if (empty($nhapurl))
$error = 'Bạn chưa nhập link';
$posturl = basename($nhapurl);
$nameurl = trim($_POST['tenurl']);
$tenurl = (!empty($_POST['tenurl']) ? $nameurl : $va);
if (!$error)
{
$connect->query("UPDATE `ganurl` SET `url` = '$nhapurl',`tenurl` = '$tenurl' WHERE `id` = '".$_GET['edit']."'");
header('Location: '.$home.'/groups/'.$hoinhom[id].'/forum/'.$topchinh[refid].'');
}
}
echo '</div>';
require ('../../incfiles/end.php');
exit;
}


if (isset($_GET['del']))  {
echo '<div class="main-xmenu">';
echo'<div class="danhmuc">Xóa gắn link</div>';
if(isset($_POST['submit'])) {
$connect->query("DELETE FROM `ganurl` WHERE `id`='".$_GET['del']."'");
header('Location: '.$home.'/groups/'.$hoinhom[id].'/forum/'.$topchinh[refid].'');
} else {
echo '<div class="menu">';
echo '<form method="post">Bạn muốn xóa gắn link này !<br /><input type="submit" name="submit" value="Xóa" /></form>'; 
echo '</div>';
}
echo '</div>';
require ('../../incfiles/end.php');
exit;
}



$nhapurl = isset($_POST['url']) ? trim($_POST['url']) : '';
$tenurl = isset($_POST['tenurl']) ? trim($_POST['tenurl']) : '';

if (isset($_POST['submit'])) {
if (empty($nhapurl))
$error = 'Bạn chưa nhập link';
$posturl = basename($nhapurl);
$nameurl = trim($_POST['tenurl']);
$tenurl = (!empty($_POST['tenurl']) ? $nameurl : $posturl);
if (!$error) {
$connect->query("INSERT INTO `ganurl` SET
`refid` = '$id',
`url` = '$nhapurl',
`tenurl` = '$tenurl'
");
header('Location: '.$home.'/groups/'.$hoinhom[id].'/forum/'.$topchinh[refid].'');
}
}
echo '<div class="main-xmenu">';
echo'<div class="danhmuc">Gắn link bài viết</div>';
echo '<div class="menu">';
echo '<form method="post">';
echo 'URL Đường dẫn:<br /> <input type="text" name="url"> <br />';
echo 'Tên hiển thị:<br/><input type="text" name="tenurl"><br />';
echo '<input type="submit" name="submit" value="Gắn"/></form>';
echo '</div>';
echo '</div>';

} else {
echo '<div class="main-xmenu">';
echo '<div class="danhmuc">Lỗi truy vấn</div>';
echo '<div class="menu">Không tìm thấy được bài viết ở hội nhóm này !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo '</div>';
}
} else {
echo'<div class="menu list-top">Bạn không có quyền sử dụng hành động này !<br/><a href="/groups/'.$tieude[groups].'/forum/'.$topchinh[refid].'"><input type="button" value="Trở về" /></a></div>';
}

///////////////// hết


?>