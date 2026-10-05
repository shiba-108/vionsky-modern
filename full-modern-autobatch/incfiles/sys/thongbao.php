<?php
$dem = ($connect->query("SELECT COUNT(*) FROM `nhom_tb` WHERE `fr_user`='$user_id'")->fetch_row()[0] ?? 0);
if($dem > 0) {
$req = $connect->query("SELECT * FROM `nhom_tb` WHERE `fr_user`='$user_id' AND `view` = '0' ORDER BY `time` DESC LIMIT 3");
while($res=$connect->fetch_array($req)) {
echo ''.($res['read']==0 ? '<div class="thongbaomini">':'<div class="thongbaomini">').'';
$anhnhom = $connect->fetch_array($connect->query("SELECT * FROM `nhom_bd` WHERE `id`='".$res['id']."'"));
$user = user_nick($res['user_id']);
$user2 = user_nick($res['fr_user']);
if($res['type']==0) {
$baidang = baidang($res['sid']);
echo '<img src="/icon/like.png" alt="icon" style="vertical-align: -3px;"/>&#160;<a href ="/account/'.$res['user_id'].'">'.$user['name'].'</a> đã thích bình luận <a href="/notice/?act=go&id='.$res['vid'].'">'.catchu($baidang['text'],0,5).'...</a> của bạn <span style="font-size:11px;color:#777;">'.functions::thoigian($res['time']).'</span>';
} else if ($res['type']==1) {
$baidang = baidang($res['sid']);
echo '<img src="/icon/like.png" alt="icon" style="vertical-align: -3px;"/>&#160;<a href ="/account/'.$res['user_id'].'">'.$user['name'].'</a> đã thích <a href="/notice/?act=go&id='.$res['vid'].'">Hình ảnh</a> của bạn <span style="font-size:11px;color:#777;">'.functions::thoigian($res['time']).'</span>';
} else if ($res['type']==2) {
$baidang = baidang($res['id']);
$binhluan = baidang($res['sid']);
$user3 = user_nick($baidang['user_id']);
echo '<img src="/groups/img/cmt.png" alt="icon" style="vertical-align: -3px;"/>&#160;<a href ="/account/'.$res['user_id'].'">'.$user['name'].'</a> đã bình luận <a href="/notice/?act=go&id='.$res['vid'].'">'.catchu($binhluan['text'],0,5).'...</a> trong bài viết của '.($user_id==$baidang['user_id'] ? 'bạn':'<a href="/account/'.$baidang['user_id'].'">'.$user3['name'].'</a>').' <span style="font-size:11px;color:#777;">'.functions::thoigian($res['time']).'</span>';
} else if ($res['type']==3) {
$baidang = baidang($res['id']);
$user3 = user_nick($baidang['user_id']);
echo '<img src="/groups/img/img.png" alt="icon" style="vertical-align: -3px;"/>&#160;<a href ="/account/'.$res['user_id'].'">'.$user['name'].'</a> đã bình luận <a href="/notice/?act=go&id='.$res['vid'].'">Hình ảnh</a> của '.($user_id==$baidang['user_id'] ? 'bạn':'<a href ="/account/'.$baidang['user_id'].'">'.$user3['name'].'</a>').' <span style="font-size:11px;color:#777;">'.functions::thoigian($res['time']).'</span>';
} else if ($res['type']==4) {
$nhom = nhom($res['id']);
echo '<img src="/groups/img/add.png" alt="icon" style="vertical-align: -3px;"/>&#160;<a href ="/account/'.$res['user_id'].'">'.$user['name'].'</a> đã cho bạn tham gia nhóm <a href="/notice/?act=go&id='.$res['vid'].'">'.$nhom['name'].'</a> <span style="font-size:11px;color:#777;">'.functions::thoigian($res['time']).'</span></a>';
}
echo '</div>';
}
}

?>