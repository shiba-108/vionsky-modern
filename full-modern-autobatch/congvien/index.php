<?php
define('_IN_JOHNCMS', 1);
$noionline = 'congvien'; 
require('../incfiles/core.php');
$textl = 'Khu công viên';
$mota = 'Nơi hội tụ các bạn chém gió và các sự kiện mới nhất từ các NPC';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Công Viên'.($rights >= 6 ? ' [<a href="/congvien/?dondep">Dọn dẹp</a>]':'').'</div>';
echo '<div class="canhcv"><marquee><img src="/congvien/img/cloud1.png"> <img src="/congvien/img/cloud2.png"></marquee><img src="/khugiaitri/img/cay.png"><a href="/tien-ich"><img src="/congvien/img/ti.gif"></a><span class="right"><a href="/ocean/anmay.php"> <img src="/muasam/img/am.gif"></a><img src="/khugiaitri/img/cay.png"></span></div>';
echo '<div class="nencv" style="min-height: 100px;margin:0"><br><br><br><br><br> <br><br>                                 ';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'congvien'");
while ($res = $connect->fetch_array($req)) {
$rand = rand(1,20);
if($rand >10){$r='class="xavt"';}else{$r = '';}
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img '.$r.' src="'.$home.'/avatar/nen/'.$res['id'].'.png" alt="'. $res['name'] . '"/></a>';

}
echo'</div></div></div><div class="buico"></div>';
if(isset($_GET['dondep'])){
if ($rights >= 6) {
if(isset($_POST['submit'])) {
header("Location: $home");
$connect->query("DELETE FROM `guest`");
} else {
echo '<div class="menu list-bottom congdong"><form method="post">Bạn có muốn dọn dẹp phòng chát không !<br /><input type="submit" name="submit" value="Dọn dẹp" /></form></div>'; 
}
} else {
header("Location: $home/congvien/");
}
}
if(isset($_POST['submitchat'])) {
$tg = $_POST['tg'];
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
if($tg ==0){
$connect->query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
header('Location: '.$home.'/congvien/');
} 
if($tg ==1){
if($datauser['vinaxu'] >=25){
$time = time() +18;
$connect->query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."', `show` = '1', `timetg` = '".$time."'");
$connect->query("UPDATE users SET vinaxu = vinaxu -25 WHERE id = $user_id");
} else {
echo 'Không đủ tiền!';
}
header('Location: '.$home.'/congvien/');
}
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
echo'<textarea name="noidungchat" placeholder="Nhập nội dung chat"></textarea>';
echo'<br><input type="checkbox" value="1" name="tg">Thế giới (25 Vinaxu) <input type="submit" name="submitchat" value="Trò chuyện"/>';
echo'</form>';
echo'</div>';
} else {
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
echo' <span style="font-size:12px;color:#777;">' . functions::thoigian($vina4u['time']) . '</span>'.($rights >= 6 ? ' <a href="'.$urlhientai.'/del/'.$vina4u[id].'">[x]</a>':'').'';
if(isset($_GET['comment'])){
$id = intval(abs($_GET['del']));
if ($id && $id == $vina4u[id]) {
if ($rights >= 6) {
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
if ($tong > $kmess) {
echo '<div class="menu">' . functions::phan_trang('/congvien/', $start, $tong, $kmess) . '</div>';
}
echo'</div>';
require('../incfiles/end.php');