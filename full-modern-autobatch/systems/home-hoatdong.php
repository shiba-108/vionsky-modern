<?php
echo'<div class="main-xmenu">';
echo '<div class="danhmuc">Những hoạt động mới</div>';
$req = $connect->query("SELECT * FROM `notice` ORDER BY `time` DESC LIMIT 6");
while ($res = $connect->fetch_array($req)) {
$thongtin = $connect->fetch_array($connect->query("SELECT * FROM `forum` WHERE `id` = '".$res[baiviet]."'"));
$pagetopic = $set_forum['upfp'] ? 1 : ceil(($connect->query("SELECT COUNT(*) FROM `forum` WHERE `id`='".$res['sid']."'")->fetch_row()[0] ?? 0) / $kmess);
echo'<div class="menu">';
$user_top = $res[user_id];
$user_bottom = ''.($res['user_fr'] == $user_id ? 'bạn' : ''.nick($res[user_fr]).'');

///// ket hon
if ($res['type'] == 'b') {
echo''.nick($user_top).' đã gửi lời cầu hôn cho '.$user_bottom.'';
}
if ($res['type'] == 'k') {
echo''.nick($user_top).' đã đồng ý lời cầu hôn của '.$user_bottom.'';
}
if ($res['type'] == 'h') {
echo''.nick($user_top).' đã ly hôn '.$user_bottom.'';
}
if ($res['type'] == 'o') {
echo''.nick($user_top).' đã từ chối lời cầu hôn của '.$user_bottom.'';
}

if ($res['type'] == 'x') {
echo''.nick($user_top).' đã nạp thẻ '.$res['post'].' và nhận '.$res['chiso'].' xu';
}
if ($res['type'] == 'v') {
echo''.nick($user_top).' đã nạp thẻ '.$res['post'].' và nhận '.$res['chiso'].' vinaxu';
}
if ($res['type'] == 'n') {
echo''.nick($user_top).' đã bình luận trong <a href="'.$home.'/account/'.$res[pages].'">tường nhà</a> của '.$user_bottom.'';
}
if ($res['type'] == 'u') {
echo''.nick($user_top).' đã like <a href="'.$home.'/groups/photo/'.$res[baiviet].'">Hình ảnh</a> của '.$user_bottom.'';
}

//////////// trich
if ($res['type'] == 'c') {
echo''.nick($user_top).' đã bình luận <a href="'.$home.'/groups/'.$thongtin[groups].'/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
}
//////////// het

//////////// like
if ($res['type'] == 'l') {
echo''.nick($user_top).' đã like <a href="'.$home.'/groups/'.$thongtin[groups].'/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
}

//////////// trich
if ($res['type'] == 'i') {
echo''.nick($user_top).' đã bình luận <a href="'.$home.'/groups/photo/'.$res[baiviet].'">Hình ảnh</a> của '.$user_bottom.'';
}
//////////// het

//////////// trich
if ($res['type'] == 'q') {
echo''.nick($user_top).' đã trích dẫn <a href="'.$home.'/groups/'.$thongtin[groups].'/forum/'.$res[baiviet].''.($res[pages] < 2 ? '#post-'.$res[post].'' : '/page/'.$res[pages].'#post-'.$res[post].'').'">bài viết</a> của '.$user_bottom.'';
}
//////////// het


echo'&#160;<span style="color:#888;font-size: 11px;">('.functions::thoigian($res['time']).')</span>';
echo '</div>';
$i++;
}
echo '</div>';
?>