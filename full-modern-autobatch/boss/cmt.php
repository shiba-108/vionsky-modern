<?php
$dcmt = ($connect->query("SELECT COUNT(*) FROM `bosscmt` WHERE `sid`='$id' AND `type`='0'")->fetch_row()[0] ?? 0);
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chat bình luận</div>';
if(isset($_POST['dang'])) {
$text = isset($_POST['text']) ? functions::checkin(functions::autolink(trim($_POST['text']))) : '';
if(empty($text)) {
echo '<div class="menu list-top">Chưa nhập nội dung!</div>';
} else {
$connect->query("INSERT INTO `bosscmt` SET `sid`='".$id."',`user_id`='".$user_id."',`text`='".$text."', `time`='".time()."'");
header("Location: phong.php?id=$id");
}
}
echo '<div class="menu congdong"><form method="post"><input type="text" name="text"> <input type="submit" name="dang" value="Đăng" /></form></div>';
if($dcmt) {
$cmt=$connect->query("SELECT * FROM `bosscmt` WHERE `sid`='".$id."' ORDER BY `time` DESC LIMIT $chuyentrang,$phannua");
while($vina4u = $connect->fetch_array($cmt)) {
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

if($dcmt > $phannua){ echo '<div class="menu list-top">' . functions::phan_trang('/boss/'.$id.'/', $chuyentrang, $dcmt, $phannua) . '</div>';
}} else {
echo '<div class="menu list-top">Chưa có bình luận nào cho trận đấu !</div>';
}
echo'</div>';
?>
