<?php
$id = intval(abs($_GET['id']));
if ($rights >= 7) {
if (isset($_GET['edit']))  {
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Gắn link bài viết</div>';
$chinhsua = $connect->query("SELECT * FROM `baivietgiaitri_url` WHERE `id` = '".$_GET['edit']."'");
$suaurl = $connect->fetch_assoc($chinhsua);
echo '<div class="menu">';
echo '<form method="post">';
echo 'URL Muốn sửa: <br /> 
<input type="text" name="url" cols="22" tabindex="4" class="form" value="'.$suaurl['url'].'"> <br />';
echo 'Tên hiển thị:<br/>
<input type="text" value="'.$suaurl['tieude'].'" cols="22" tabindex="4" class="form" name="tenurl"><br />';
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
$connect->query("UPDATE `baivietgiaitri_url` SET `url` = '$nhapurl',`tieude` = '$tenurl' WHERE `id` = '".$_GET['edit']."'");
$thongtinlink = $connect->fetch_array($connect->query("SELECT `tieude` FROM `baivietgiaitri` WHERE `id`='".$id."'"));
header('Location: '.$home.'/hackgame/'.$id.'-'.functions::khongdau($thongtinlink['tieude']).'');
}
}
echo '</div>';
require ('../incfiles/end.php');
exit;
}


if (isset($_GET['del']))  {
echo'<div class="danhmuc">Xóa gắn link</div>';
if(isset($_POST['submit'])) {
$connect->query("DELETE FROM `ganurl` WHERE `id`='".$_GET['del']."'");
$thongtinlink = $connect->fetch_array($connect->query("SELECT `tieude` FROM `baivietgiaitri` WHERE `id`='".$id."'"));
header('Location: '.$home.'/hackgame/'.$id.'-'.functions::khongdau($thongtinlink['tieude']).'');
} else {
echo '<div class="menu list-top">';
echo '<form method="post">Bạn muốn xóa gắn link này !<br /><input type="submit" name="submit" value="Xóa" /></form>'; 
echo '</div>';
}
require ('../incfiles/end.php');
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
$connect->query("INSERT INTO `baivietgiaitri_url` SET
`baiviet` = '$id',
`url` = '$nhapurl',
`tieude` = '$tenurl'
");
$thongtinlink = $connect->fetch_array($connect->query("SELECT `tieude` FROM `baivietgiaitri` WHERE `id`='".$id."'"));
header('Location: '.$home.'/hackgame/'.$id.'-'.functions::khongdau($thongtinlink['tieude']).'');
}
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Gắn link bài viết</div>';
echo '<div class="menu">';
echo '<form method="post">';
echo 'URL Đường dẫn:<br /> <input type="text" name="url"> <br />';
echo 'Tên hiển thị:<br/><input type="text" name="tenurl"><br />';
echo '<input type="submit" name="submit" value="Gắn"/></form>';
echo '</div>';
echo '</div>';
} else {
echo'<div class="menu list-top">Bạn không có quyền sử dụng hành động này !</div>';
}

///////////////// hết


?>