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
echo'<div class="danhmuc">Viết chủ đề</div>';
if (!$user_id) {
echo '<div class="menu" style="color:red"><img src="/images/smileys/user/matcuoi/0.gif" alt="" /> Bạn phải là thành viên mới được viết bài nhé !</div>';
echo '<div class="menu list-top congdong"><a href="/">Trở về trang chủ</a></div>';
echo'</div>';
require ('../../incfiles/end.php');
exit;
}
if (isset($_POST['submit'])) {
$menunhom = functions::checkout($_POST['menunhom']);
$tieude = functions::checkin($_POST['tieude']);
$tieude = ucfirst($tieude);
$noidung = bbcode::notags($noidung);
$noidung = isset($_POST['noidung']) ? functions::checkin(functions::autolink(trim($_POST['noidung']))) : '';
$thanhviennhom = $connect->fetch_array($connect->query("SELECT `rights` FROM `nhom_user` WHERE `id` = '".$menunhom."' AND `user_id` = '".$user_id."'"));
if(($datauser['lastpost'] + 100) > time()) {
echo '<div class="menu">Bạn đăng bài quá nhanh hãy đợi <b>'.(($datauser['lastpost']+100) - time()).'s</b> nữa để đăng tiếp !</div>';
} else if(empty($tieude)) {
echo '<div class="menu">Bạn chưa tiêu đề bài viết !</div>';
} else if (mb_strlen($tieude) <= 10) {
echo '<div class="menu">Tiêu đề bài viết phải trên 10 kí tự nhé !</div>';
} else if (mb_strlen($tieude) >= 200) {
echo '<div class="menu">Tiêu đề bài viết tối đa 200 kí tự nhé !</div>';
} else if(empty($noidung)) {
echo '<div class="menu">Bạn chưa nội dung bài viết !</div>';
} else if (mb_strlen($noidung) <= 20) {
echo '<div class="menu">Nội dung bài viết phải trên 20 kí tự nhé !</div>';
} else {
if ($rights >=3 || $thanhviennhom[rights] > 0) {
$duyet = 1;
}
        $connect->query("INSERT INTO `forum` SET
            `refid` = '".$menunhom."',
            `type` = 't',
            `time` = '" . time() . "',
            `user_id` = '".$user_id."',
            `from` = '".$login."',
            `text` = '" . mysql_real_escape_string($tieude) . "',
            `groups` = '".$menunhom."',
            `duyet` = '1'
        ");
        $rid = mysql_insert_id();

        $connect->query("INSERT INTO `forum` SET
            `refid` = '".$rid."',
            `time` = '" . time() . "',
            `user_id` = '".$user_id."',
            `from` = '".$login."',
            `text` = '" . mysql_real_escape_string($noidung) . "',
            `groups` = '".$menunhom."'
        ");
        $postid = mysql_insert_id();
        $fpst = $datauser['postforum'] + 1;
        $connect->query("UPDATE `users` SET 
       `lastpost`='".time()."',
       `postforum` = '$fpst'
       WHERE `id`='".$user_id."'");
header("Location: /groups/$menunhom/forum/$rid");
}
} else {
echo'<div class="menu list-bottom hot" style="margin-top: -2px">Bạn hãy chọn nhóm phù hợi với chuyên đề bạn cần đăng vì nếu bài viết sai mục đích với nhóm đấy sẽ bị loại ngay !</div>';
echo'<form method="post">';
echo'<div class="menu list-bottom">';
echo'<select name="menunhom">';
If($datauser['rights'] ==0){
$req = $connect->query("SELECT * FROM `nhom` WHERE `id`!='1' ORDER BY `id`");
} else {
$req = $connect->query("SELECT * FROM `nhom` ORDER BY `id`");
}
while ($res = $connect->fetch_assoc($req)) {
$thongtinnhom = $connect->fetch_array($connect->query("SELECT * FROM `nhom` WHERE `id`='".$res[id]."'"));
echo'<option value="'.$thongtinnhom['id'].'">'.htmlspecialchars($thongtinnhom['name']).'</option>';
++$i;
}
echo'</select>';
echo'</div>';
echo'<div class="menu">';
echo'Tiêu đề:<br/>';
echo'<input name="tieude" type="text">';
echo'</div>';
echo'<div class="menu">';
echo'Nội dung bài viết<br/>';
echo'<textarea name="noidung" type="text"></textarea>';
echo'</div>';
echo'<div class="menu">';
echo'<input type="submit" name="submit" value="Đăng" />';
echo'</div>';
echo'</form>';
}
echo'</div>';
require ('../../incfiles/end.php');