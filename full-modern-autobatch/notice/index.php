<?php
define('_IN_JOHNCMS', 1);
$noionline = 'notice';
require_once('../incfiles/core.php');
$textl = 'Thông báo của bạn';
require_once('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông báo</div>';
if($datauser['thongbaocanhan'] != 0) {
$connect->query("UPDATE `users` SET `thongbaocanhan`='0' WHERE `id`='{$user_id}'");
}


$tong = ($connect->query("SELECT COUNT(*) FROM `notice` WHERE `type` != 'b' AND `user_fr`='{$user_id}'")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `notice` WHERE `user_fr`='{$user_id}' ORDER BY `time` DESC LIMIT $start, $kmess");
while ($res = $connect->fetch_array($req)) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$res[baiviet]."'"));
$pagetopic = $set_forum['upfp'] ? 1 : ceil(($connect->query("SELECT COUNT(*) FROM `forum` WHERE `id`='".$res['sid']."'")->fetch_row()[0] ?? 0) / $kmess);
echo'<div class="menu list-bottom">';
$user_top = $res[user_id];
$user_bottom = ''.($res['user_fr'] == $user_id ? 'bạn' : ''.nick($res[user_fr]).'');

///// ket hon
if ($res['type'] == 'k') {
echo'<img src="'.$home.'/icon/tinhyeu.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã đồng ý lời cầu hôn và hai người đã trở thành vợ chồng xin chúc mừng';
}
if ($res['type'] == 'o') {
echo'<img src="'.$home.'/icon/tinhyeu.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã từ chối lời cầu hôn của bạn xin chia buồn';
}

///// nap xu
if ($res['type'] == 'x') {
echo'<img src="'.$home.'/icon/xu.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã nạp thẻ '.$res['post'].' và nhận '.$res['chiso'].' xu';
}
if ($res['type'] == 'v') {
echo'<img src="'.$home.'/icon/xu.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã nạp thẻ '.$res['post'].' và nhận '.$res['chiso'].' vinaxu';
}
if ($res['type'] == 'h') {
echo'<img src="'.$home.'/icon/xu.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã nạp thẻ '.$res['post'].' và '.$user_bottom.' nhận '.$res['chiso'].'xu';
}
if ($res['type'] == 'j') {
echo'<img src="'.$home.'/icon/xu.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã nạp thẻ '.$res['post'].' và '.$user_bottom.' nhận '.$res['chiso'].' Vinaxu';
}

if ($res['type'] == 'u') {
echo'<img src="'.$home.'/groups/img/img.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã like <a href="'.$home.'/photo/'.$res[baiviet].'">Hình ảnh</a> của '.$user_bottom.'';
}

//////////// trich
if ($res['type'] == 'c') {
if ($thongtin[groups] == 0) {
echo'<img src="'.$home.'/groups/forum/icon/quote.png" alt="quote" style="vertical-align: -3px;"/> '.nick($user_top).' đã bình luận <a href="'.$home.'/users/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
} else {
echo'<img src="'.$home.'/groups/forum/icon/quote.png" alt="quote" style="vertical-align: -3px;"/> '.nick($user_top).' đã bình luận <a href="'.$home.'/groups/'.$thongtin[groups].'/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
}
}
//////////// het

//////////// like
if ($res['type'] == 'l') {
if ($thongtin[groups] == 0) {
echo'<img src="'.$home.'/icon/like.png" alt="Like" style="vertical-align: -3px;"/> '.nick($user_top).' đã like <a href="'.$home.'/users/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
} else {
echo'<img src="'.$home.'/icon/like.png" alt="Like" style="vertical-align: -3px;"/> '.nick($user_top).' đã like <a href="'.$home.'/groups/'.$thongtin[groups].'/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
}
}

//////////// trich
if ($res['type'] == 'i') {
echo'<img src="'.$home.'/groups/img/img.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã bình luận <a href="'.$home.'/photo/'.$res[baiviet].'">Hình ảnh</a> của '.$user_bottom.'';
}
//////////// het

//////////// trich
if ($res['type'] == 'q') { 
if ($thongtin[groups] == 0) {
echo'<img src="'.$home.'/groups/forum/icon/quote.png" alt="quote" style="vertical-align: -3px;"/> '.nick($user_top).' đã trích dẫn <a href="'.$home.'/users/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
} else {
echo'<img src="'.$home.'/groups/forum/icon/quote.png" alt="quote" style="vertical-align: -3px;"/> '.nick($user_top).' đã trích dẫn <a href="'.$home.'/groups/'.$thongtin[groups].'/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
}
}
//////////// het
if ($res['type'] == 'n') {
echo'<img src="'.$home.'/groups/forum/icon/quote.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user_top).' đã bình luận trong <a href="'.$home.'/account/'.$res[pages].'">tường nhà</a> của '.$user_bottom.'';
}


//////////// het
if ($res['type'] == 'y') {
echo'<img src="'.$home.'/icon/name.gif" alt="icon" style="vertical-align: -3px;"/> Tên thật của bạn không được duyệt vì không đúng quy định !';
}
if ($res['type'] == 'e') {
echo'<img src="'.$home.'/icon/name.gif" alt="icon" style="vertical-align: -3px;"/> Tên thật của bạn đã được đổi thành công !';
}

if ($res['type'] == 'd') {
echo'<img src="'.$home.'/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/> Bài viết của bạn đã được '.nick($user_top).' duyệt thành công !';
}
if ($res['type'] == 'f') {
echo'<img src="'.$home.'/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/> Bài viết của bạn đã bị '.nick($user_top).' loại vì "'.$res['mota'].'" !';
}


echo'&#160;<span style="color:#888;font-size: 11px;">('.functions::thoigian($res['time']).')</span>';
echo '</div>';
$i++;
}

} else {
echo '<div class="menu">Không có thông báo nào mới</div>';
}
if ($tong > $kmess){
echo '<div class="menu">' . functions::display_pagination('?', $start, $tong, $kmess) . '</div>';
}
echo '</div>';
require('../incfiles/end.php');
?>