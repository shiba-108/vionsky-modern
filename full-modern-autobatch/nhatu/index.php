<?php
define('_IN_JOHNCMS', 1);
require ('../incfiles/core.php');
$baned3 = 2;
$textl = 'Nhà Tù';
require ('../incfiles/head.php');
if ($ditu == 1){ 
if ($vaotu[vinhvien] == 1) {
echo'<div class="thongbaomini">Bạn đã bị <b>'.nick($vaotu[nguoiband]).'</b> nhốt vào tù <span style="color:red">Vĩnh viễn</span> vì lý do "'.$vaotu[lydo].'" !</div>'; 
} else {
echo'<div class="thongbaomini">Bạn đã bị <b>'.nick($vaotu[nguoiband]).'</b> nhốt vào tù vì lý do "'.$vaotu[lydo].'" '.thoigiantinh($tinhthoigianvaotu).' nữa bạn sẽ được thả ra !</div>'; 
}
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nói chuyện cùng tù nhân</div>';
echo'<div class="viengame">';
echo'<div class="tuongnhatu"><div class="cuasonhatu"></div></div>';
echo '<div class="nennhatu" style="text-align: center;">';
$req = $connect->query("SELECT * FROM `nhatu`");
while ($res = $connect->fetch_array($req)) {
echo '<a href="/account/'.$res['user_id'].'"><img src="'.$home.'/avatar/nen/'.$res['user_id'].'.png" alt="Tù nhân"/></a>';
}
echo'</div>';
echo'</div>';
echo'</div>';
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chém gió'.($rights >= 6 ? ' [<a href="/?dondep">Dọn dẹp</a>]':'').'</div>';
if(isset($_GET['dondep'])){
if ($rights >= 6) {
if(isset($_POST['submit'])) {
header("Location: $home");
$connect->query("DELETE FROM `guest`");
} else {
echo '<div class="menu list-bottom congdong"><form method="post">Bạn có muốn dọn dẹp phòng chát không !<br /><input type="submit" name="submit" value="Dọn dẹp" /></form></div>'; 
}
} else {
header("Location: $home");
}
}
if(isset($_POST['submitchat'])) {
$noidungchat = bbcode::notags($noidungchat);
$noidungchat = isset($_POST['noidungchat']) ? functions::checkin(trim($_POST['noidungchat'])) : '';
if(empty($_POST['noidungchat'])) {
echo '<div class="menu">Bạn đã nhập nội dung đâu</div>';
} else if(strlen($_POST['noidungchat']) < 2) { // 2 là số kí tự ít nhất
echo '<div class="menu">Bạn phải viết trên 5 kí tự</div>';
} else if(strlen($_POST['noidungchat']) > 4000) {
echo '<div class="menu">Bạn không được viết quá 5000 kí tự</div>';
} else {
if($user_id){
$connect->query("INSERT INTO `nhatu_comment` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
header('Location: '.$home.''.$_SERVER['REQUEST_URI'].'');
}
}
}
if($user_id){
if (!$is_mobile) {
echo '<div class="menu list-bottom">';
} else {
echo '<div class="menu list-bottom congdong">';
}
echo'<form name="text" method="post">';
echo'<input name="noidungchat" type="text">';
echo'<input type="submit" name="submitchat" value="Gửi"/>';
echo'</form>';
echo'</div>';
} else {
}
$tong = ($connect->query("SELECT COUNT(*) FROM `guest`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `nhatu_comment` ORDER BY `time` DESC LIMIT 10");
while ($vina4u = $connect->fetch_assoc($req)) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'"));
echo $i % 2 ? '<div class="menu list-bottom">' : '<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td
width="48px;" class="list_post">';
echo '<img src="'.$home.'/avatar/'.$vina4u['user_id'].'.png" alt="'.$vina4u['thongtin'].'" style="vertical-align: -5px;"/>';
echo'</td><td class="current-blog"><div class="blog-bg-left"><img src="/icon/left-blog.png"></div><span>';
echo (time() > $thongtin['lastdate'] + 300 ? '<img src="/icon/offline.png" title="OFF"/> ' : '<img src="/icon/online.png" title="ON"/> ');
echo'<a href="/account/'.$vina4u['user_id'].'">'.nick($vina4u['user_id']).'</a>: ';
echo'</span></div>';
echo'<div class="box_ndung_bviet">';
$vina4u['text'] = functions::checkout($vina4u['text'], 1, 1);
echo functions::smileys(bbcode::tags($vina4u['text']));
echo' <span style="font-size:12px;color:#777;">' . functions::thoigian($vina4u['time']) . '</span>'.($rights >= 6 ? ' <a href="'.$urlhientai.'/del/'.$vina4u[id].'">[x]</a>':'').'';
if(isset($_GET['comment'])){
$id = intval(abs($_GET['del']));
if ($id && $id == $vina4u[id]) {
if ($rights >= 6) {
if(isset($_POST['submit'])) {
header("Location: $home");
$connect->query("DELETE FROM `guest` WHERE `id` = '$id'");
} else {
echo '<div class="menu"><form method="post"><input type="submit" name="submit" value="Xoá comment" /></form></div>'; 
}
} else {
header("Location: $home");
}
}
}
echo '</td></tr></tbody></table></div>';
$i++;
}
} else {
echo '<div class="menu list-bottom">Chưa có ai chát !</div>';
}
echo'</div>';
require ('../incfiles/end.php');