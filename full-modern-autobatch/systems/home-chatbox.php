<?php
echo'<div class="danhmuc">Chatbox</div>';
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
$connect->query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
header('Location: '.$home.''.$_SERVER['REQUEST_URI'].'');
}
}
}
?>
<?php if($user_id){ ?>
<form name="text" method="post">
<input name="noidungchat" type="text">
<input type="submit" name="submitchat" value="Gửi"/> <input type="submit" name="dondep" value="Dọn"/>
</form>
<?php } ?>
<?php if(isset($_POST['xoachat']) && $rights >= 6) {
header("Location: $home");
$connect->query("DELETE FROM `guest`");
}
if(isset($_POST['dondep']) && $rights >= 6){
echo '<div class="menu"><form method="post"><input type="submit" name="xoachat" value="Dọn dẹp ngay" style="background: #d47070;"/></form></div>';
}
$tong = ($connect->query("SELECT COUNT(*) FROM `guest`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `guest` ORDER BY `time` DESC LIMIT $start, $kmess");
while ($vina4u = $connect->fetch_assoc($req)) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'"));
echo $i % 2 ? '<div class="menu list-bottom">' : '<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td
width="48px;" class="list_post">';
echo '<img src="'.$home.'/avatar/'.$vina4u['user_id'].'.png" alt="'.$vina4u['thongtin'].'" style="vertical-align: -5px;"/>';
echo'</td><td class="current-blog"><div class="blog-bg-left"><img src="/icon/left-blog.png"></div><span>';
echo (time() > $thongtin['lastdate'] + 300 ? '<img src="/icon/offline.png" title="OFF"/> ' : '<img src="/icon/online.png" title="ON"/> ');
echo'<a href="/account/'.$vina4u['user_id'].'"><span style="color:#444;"><b>'.nick($vina4u['user_id']).'</b></span></a>: ';
echo'</span></div>';
echo'<div class="box_ndung_bviet">';
$ban = ($connect->query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" .$vina4u['user_id']. "' AND `ban_time` > '" . time() . "'")->fetch_row()[0] ?? 0);
if($ban > 0) {
echo'******bài viêt ẩn******';
} else {
$vina4u['text'] = functions::checkout($vina4u['text'], 1, 1);
echo functions::smileys(bbcode::tags($vina4u['text']));
}
echo' <span style="font-size:12px;color:#777;"></span>'.($rights >= 15 ? ' <a href="'.$urlhientai.'/del/'.$vina4u[id].'">[x]</a>':'').'';
if(isset($_GET['comment'])){
$id = intval(abs($_GET['del']));
if ($id && $id == $vina4u[id]) {
if ($rights >= 15) {
if(isset($_POST['submit'])) {
header("Location: $home/congvien/");
$connect->query("DELETE FROM `guest` WHERE `id` = '$id'");
} else {
echo '<div class="menu"><form method="post"><input type="submit" name="submit" value="Xoá comment" /></form></div>';
}
} else {
header("Location: $home/congvien/");
}
}
}
echo '</td></tr></tbody></table></div>';
$i++;
}
} else {
echo '<div class="menu list-bottom">Chưa có ai chát !</div>';
}
echo '<div style="padding: 6px"><a href="/congvien/">[ XEM THÊM CHAT CŨ ]</a></div>';
?>
