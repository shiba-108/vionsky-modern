<?php
if(isset($_POST['submit'])) {
$noidung = bbcode::notags($noidung);
$noidung = isset($_POST['text']) ? functions::checkin(functions::autolink(trim($_POST['text']))) : '';
if(empty($_POST['text'])) {
echo '<div class="menu">Bạn đã nhập nội dung đâu</div>';
} else if(strlen($_POST['text']) < 2) { // 2 là số kí tự ít nhất
echo '<div class="menu">Bạn phải viết trên 5 kí tự</div>';
} else if(strlen($_POST['text']) > 4000) {
echo '<div class="menu">Bạn không được viết quá 5000 kí tự</div>';
} else {
if($user_id){
$connect->query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='".$noidung."', `time`='".time()."'");
header("Location: $home/congvien/#chat");
}
}
}
if($user_id){
echo '<div class="menu list-top congdong">';
echo'<form name="text" method="post">';
echo'<input name="text" type="text">';
echo'<input type="submit" name="submit" value="Gửi"/>';
echo'</form>';
echo'</div>';
} else {
echo '<div class="menu list-top congdong">Hãy đăng nhập để cùng chém gió với các bạn đây nhé</div>';
}
echo'<div id="chat"></div>';
$tong = ($connect->query("SELECT COUNT(*) FROM `guest`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `guest` ORDER BY `time` DESC LIMIT $start, $kmess");
while ($vina4u = $connect->fetch_assoc($req)) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'"));
echo $i % 2 ? '<div class="menu list-top">' : '<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td
width="48px;" class="list_post">';
echo '<img src="'.$home.'/avatar/'.$vina4u['user_id'].'.png" alt="'.$vina4u['thongtin'].'" style="vertical-align: -5px;"/>';
echo'</td><td class="current-blog"><div class="blog-bg-left"><img src="/icon/left-blog.png"></div><span>';
echo (time() > $thongtin['lastdate'] + 300 ? '<img src="/icon/offline.png" title="OFF"/> ' : '<img src="/icon/online.png" title="ON"/> ');
echo'<a href="/account/'.$vina4u['user_id'].'">'.nick($vina4u['user_id']).'</a>: ';
echo'</span></div>';
echo'<div class="box_ndung_bviet">';
$ban = ($connect->query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" .$vina4u['user_id']. "' AND `ban_time` > '" . time() . "'")->fetch_row()[0] ?? 0);
if($ban > 0) {
echo'******bài viêt ẩn******';
} else {
$vina4u['text'] = functions::checkout($vina4u['text'], 1, 1);
echo functions::smileys(bbcode::tags($vina4u['text']));
}
echo' <span style="font-size:12px;color:#777;">' . functions::thoigian($vina4u['time']) . '</span>'.($rights >= 6 ? ' <a href="/?act=del&id='.$vina4u[id].'">[x]</a>':'').'';
echo '</td></tr></tbody></table></div>';
$i++;
}
} else {
echo '<div class="menu">Chưa có ai chát !</div>';
}
if ($tong > $kmess) {
echo '<div class="menu">' . functions::phan_trang('/congvien/', $start, $tong, $kmess) . '</div>';
}
?>