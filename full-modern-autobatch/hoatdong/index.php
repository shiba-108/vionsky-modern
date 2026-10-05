<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('../incfiles/core.php');
$textl = 'Hoạt động';
$mota = 'Hoạt động mới nhất từ cộng đồng';
require ('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Hoạt Động Thành Viên</div>';
$tong = ($connect->query("SELECT COUNT(*) FROM `notice` WHERE `type`!='c' AND `type`!='s'")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `notice` WHERE `type`!='c' AND `type`!='s' ORDER BY `time` DESC LIMIT $start, $kmess");
while ($res = $connect->fetch_array($req)) {
$id_thongbao_sid = $connect->fetch_array($connect->query("SELECT `user_id` FROM `account` WHERE `id`='{$res['sid']}'"));
$databaiviet = $connect->fetch_array($connect->query("SELECT `text` FROM `account` WHERE `id`='{$res['sid']}'"));
$id_thongbao_tuongnha = $connect->fetch_array($connect->query("SELECT `id` FROM `users` WHERE `id`='{$res['sid']}'"));
$id_name_tuongnha = $connect->fetch_array($connect->query("SELECT `name` FROM `users` WHERE `id`='{$res['sid']}'"));
echo'<div class="menu list-bottom">';
$ten_name = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$res['user_fr']}'"));
$ten_name_cuoi = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$id_thongbao_sid['user_id']}'"));
$user_post = $connect->fetch_array($connect->query("SELECT * FROM `account` WHERE `id`='{$res['sid']}'"));
$idlike = $res['sid']; 
$likenoidung = $baiviet['text'];
$id_thongbao = $res['id']; 
$baiviet = $databaiviet['text'];
$video = $datavideo['text'];
##### like
$tennick = nick($res['user_fr']).' đã';
$tenphu = nick($res['user_id']).'';
if ($res['type'] == 'd'){
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu"/>&#160;'.$tennick.'&#160;đánh';
}

##### like
if ($res['type'] == 'l'){
echo'<img src="'.$home.'/icon/like.png" alt="Like"/> ';
echo'<a href="/account/'.$res['user_fr'].'/' . functions::khongdau($ten_name[name]) . '">'.nick($res['user_fr']).'</a> đã like <a href="'.$home.'/post/'.$res['sid'].'/">bài viết</a> của';
}
if ($res['type'] == 'h'){
echo'<img src="/icon/antrom.png" alt="icon" style="vertical-align: -3px;"/>&#160;'.$tennick.'&#160;ăn trộm nông sản của&#160;'.$tenphu.'&#160;';
}
if ($res['type'] == 'q'){
echo'<img src="/icon/giftbox.png" alt="icon" style="vertical-align: -3px;"/>&#160;'.$tennick.'&#160; vừa nhận được '.$res['sid'].' xu từ hộp quà !';
}
##### tag bai viet
if ($res['type'] == 't'){
echo'<img src="'.$home.'/icon/tag.png" alt="Tag"/> ';
echo''.$tennick.' <a href="/account/'.$res['user_fr'].'/' . functions::khongdau($ten_name[name]) . '">'.nick($res['user_fr']).'</a> đã nhắc tên <a href="/account/'.$res['user_id'].'/' . functions::khongdau($ten_name_cuoi[name]) . '">'.nick($res['user_id']).'</a> tại <a href="'.$home.'/post/'.$res['sid'].'-'.functions::khongdau($user_post[from]).'">bài viết</a> của';
}
##### tag tuong nha
if ($res['type'] == 'z'){
echo'<img src="'.$home.'/icon/tag.png" alt="Tag"/>&#160;'.$tennick.'&#160;<a href="/account/'.$res['user_fr'].'/' . functions::khongdau($ten_name[name]) . '">'.nick($res['user_fr']).'</a> đã nhắc tên <a href="/account/'.$res['user_id'].'/' . functions::khongdau($id_name_tuongnha[name]) . '">'.nick($res['user_id']).'</a> tại <a href="/account/'.$id_thongbao_tuongnha[id].'/' . functions::khongdau($id_name_tuongnha['name']) . '">tường nhà</a> của';
}
if ($res['type'] == 'l' || $res['type'] == 't'){
echo'&#160;'.($user_id == $id_thongbao_sid['user_id'] ? 'bạn' : ''.($id_thongbao_sid['user_id'] != $res['user_fr'] ? '<a href="/account/'.$id_thongbao_sid['user_id'].'/' . functions::khongdau($ten_name_cuoi[name]) . '">'.nick($id_thongbao_sid['user_id']).'</a>' : '').'').'
'.($id_thongbao_sid['user_id'] == $res['user_fr'] ? 'bạn ấy' : '').'';
}
if ($res['type'] == 's' || $res['type'] == 'z'){
echo '&#160;'.($user_id == $id_thongbao_tuongnha['id'] ? 'bạn' : ''.($id_thongbao_tuongnha['id'] != $res['user_fr'] ? '<a href="/account/'.$id_thongbao_tuongnha['id'].'/' . functions::khongdau($id_name_tuongnha['name']) . '">'.nick($id_thongbao_tuongnha['id']).'</a>' : '').'').''.($id_thongbao_tuongnha['id'] == $res['user_fr'] ? 'bạn ấy' : '').'';
}
if ($res['type'] == 'd'){
echo'&#160;'.($user_id == $res['user_id'] ? 'bạn' : ''.nick($res['user_id']).'').'';
}
if ($res['type'] == 'f'){
echo'<img src="/icon/caboi.png" alt="icon" style="vertical-align: -5px;"/>&#160;'.$tennick.'&#160;câu được cá và nhận được '.$res['sid'].'xu !';
}
if ($res['type'] == 'k'){
echo'<img src="/icon/khe.png" alt="icon" style="vertical-align: -3px;"/>&#160;'.$tennick.'&#160;nhận được '.$res['sid'].' xu từ cây khế !';
}
echo'&#160;<span style="color:#888;font-size: 11px;">('.functions::thoigian($res['time']).')</span>';
echo '</div>';
$i++;
}
if ($tong > $kmess) {
echo '<div class="menu">' . functions::phan_trang('/hoatdong/', $start, $tong, $kmess) . '</div>';
}
echo '</div>';
require ('../incfiles/end.php');