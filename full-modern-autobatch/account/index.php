<?
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
$noionline = 'tuongnha';
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);
}
else {
}
}
else {
$id = false;
$user = $datauser;
}
$textl = 'Tường Nhà '. $user['name'] . '';
$mota = 'Xem tường nhà của bạn '. $user['name'] . ' để biết thông tin và bài viết của bạn ấy';
require_once ('../incfiles/head.php');

if ($user['id'] == '559') {
header('Location: '.$home.'');
}
if(empty($user[id])) {
header('Location: '.$home.'');
}
$id_comment = $user['id'];
$phanbietbankhac = $connect->fetch_array($connect->query("SELECT `name` FROM `users` WHERE `id`='{$user['id']}'"));
$baned = ($connect->query("SELECT COUNT(*) FROM `nhatu` WHERE `user_id` = '" . $id . "'")->fetch_row()[0] ?? 0);
$thongtindoithu = $connect->fetch_array($connect->query("SELECT * FROM `nhanvat` WHERE `user_id`='".$user['id']."'"));
$phantram = floor(($thongtindoithu['sucmanh']*100)/$thongtindoithu['sucmanhgoc']);
$phantramhp = floor(($thongtindoithu['hp']*100)/$thongtindoithu['hpfull']);
if ($user_id) {
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'.$user['id'].'') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'.$user['id'].'/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'.$user['id'].'/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
}else{
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/danh-sach');}
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/danh-sach/');}
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin tài khoản '. $user['name'] . '</div>';
echo'<div class="menu"><img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Level: <span style="font-size:12px;color:green;">'.$user[level].'+'.$user[chisolevel].'%</span> <span style="font-size:11px;color:#e2e2e2;">|</span> SM: '.($thongtindoithu['sucmanh'] == 0 ? 'chưa có gì' : ''.$thongtindoithu['sucmanh'].'').'</div>';
echo'<div class="menu list-top"><img src="'.$home.'/icon/xu.png" alt="icon" style="vertical-align: -3px;"/> Xu: '.$user[tienxu].' <span style="font-size:11px;color:#e2e2e2;">|</span> Vinaxu: '.$user[vinaxu].'</div>';
echo'<div class="menu list-top"><img src="'.$home.'/images/kcx.png" alt="icon" style="vertical-align: -3px;"/> Kim cương: '.$user[kc].' </div>';
echo'<div class="menu list-top"><img src="'.$home.'/images/dollar.png" alt="icon" style="vertical-align: -3px;"/> Vàng: '.$user[balans].'</div>';
echo'<div class="menu list-top"><img src="'.$home.'/icon/xu.png" alt="icon" style="vertical-align: -3px;"/> VNĐ: '.$user[vnd].'</div>';
echo'<div class="menu list-top"><img src="'.$home.'/icon/hp.png" alt="icon" style="vertical-align: -3px;"/> Hp: '.$thongtindoithu['hp'].' <span style="font-size:11px;color:#e2e2e2;">/</span> '.$thongtindoithu['hpfull'].' <span style="font-size:12px;color:green;">('.$phantramhp.'%)</span></div>';
echo'<div class="menu list-top hot">';
echo'<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td width="48px;" class="list_post">';
echo '<img src="'.$home.'/avatar/'.$user['id'].'.png" alt="'.$user['name'].'"/>';
echo'</td><td width="600">';
echo'<b>'. nick($user['id']). '</b>';
echo' [<b>'.$user['name'].'</b>]';
if ($user['sex']==zh){
echo ' Nữ';
} else {
echo ' Nam';
}
if ($rights == 3 || $rights >= 6) {
if($baned > 0) {
echo'<br/><a href="'.$home.'/account/'. $user['id'] . '/unbaned/"><span style="color:green">[Unband]</span></a>';
}else{
echo'<br/><a href="'.$home.'/account/'. $user['id'] . '/baned/"><span style="color:red">[ Khoá ]</span></a>';
}
if ($rights >= 7) {
echo'<a href="'.$home.'/account/xoanick.php?id='. $user['id'] . '"><span style="color:red">[ Xoá nick ]</span></a><br/>';
}
if ($rights >= 7 && $user['rights'] < 6) {
if ($user['vip'] == 0) {
echo'<a href="'.$home.'/account/vip.php?id='. $user['id'] . '"><span style="color:green"><b>Phong VIP</b></span></a><br/>';
} else {
echo'<a href="'.$home.'/account/vip.php?id='. $user['id'] . '"><span style="color:red"><b>Hủy VIP</b></span></a><br/>';
}
}
}
if ($datauser['rights'] >= 7) {
echo'<a href="'.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '/positions" title = "Sửa chức vị">Sửa chức vị</a>';
}
if ($datauser['rights'] >= 7 || $user['id'] == $user_id) {
echo'<br/><a href="'.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '/edit" title = "Sửa thông tin">Sửa thông tin</a>';
}
if ($rights == 9) {
echo'<br/><a href="'.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '/chiso" title = "Sửa chỉ số">Sửa chỉ số</a>';
}
echo'</td></tr></table>';
echo'</div>';
$ip = long2ip($user['ip']);
if ($rights == 3 || $rights >= 6) {
if ($user['id']!=1 || $user['id'] == $user_id) {
echo'<div class="menu list-top"><img src="/icon/pass.png" alt="icon" style="vertical-align: -3px;"/> IP: '.$ip.' <a href="/cpadmin/index.php?act=search_ip&amp;ip=' . $ip. '">[Kiểm tra]</a></div>';
}
}
if ($rights >= 7 || $user['id'] == $user_id) {
echo'<div class="menu list-top"><img src="/icon/name.gif" alt="icon" style="vertical-align: -3px;"/> <a href="/account/tenthat.php?id=' . $user['id'] . '">Đổi tên thật</a></div>';
echo'<div class="menu list-top"><img src="/icon/pass.png" alt="icon" style="vertical-align: -3px;"/> <a href="/account/pass.php?id=' . $user['id'] . '">Đổi mật khẩu</a></div>';
}
echo'<div class="menu list-top"><img src="/icon/timereg.png" alt="icon" style="vertical-align: -3px;"/> Tham gia '.functions::thoigian($user['datereg']).'</div>';
if (!empty($user['nguoiyeu'])) {
echo'<div class="menu list-top"><img src="'.$home.'/icon/tinhyeu.png" alt="icon" style="vertical-align: -3px;"/> '.($user['sex']== zh ? 'Vợ':'Chồng').' của <a href="'.$home.'/account/'. $user['nguoiyeu'] . '">' .nick($user['nguoiyeu']). '</a> '.($user_id == $user['nguoiyeu'] ? '<a href="/account/lyhon.php?id=' . $user['id'] . '">[ly hôn]</a>' : '').'</div>';
}
if (empty($user['nguoiyeu'])) {
if ($user['sex']!==$datauser['sex']){
echo'<div class="menu list-top"><img src="/icon/tinhyeu.png" alt="icon" style="vertical-align: -3px;"/> <a href="/account/kethon.php?id=' . $user['id'] . '">Cầu hôn '. $user['name'] . '</a></div>';
}
}
if ($user_id && $user_id != $user['id']) {
echo'<div class="menu list-top"><img src="/account/icon/mail.png" alt="icon" style="vertical-align: -3px;"/> <a href="/mail/' . $user['id'] . '" title = "Nhắn tin">Nhắn tin cho '. $user['name'] . '</a></div>';
echo'<div class="menu list-top"><img src="/icon/ruong.png" alt="icon" style="vertical-align: -3px;"/> <a href="/account/ruong/'. $user['id'].'/">Rương đồ của '. $user['name'] . '</a></div>';
echo'<div class="menu list-top"><img src="/icon/farm-icon.png" alt="icon" style="vertical-align: -3px;"/> <a href="/farm/account.php?id='. $user['id'].'">Nông trại của '. $user['name'] . '</a></div>';
}
echo'<div class="menu list-top"><img src="/icon/newpost.png" alt="icon" style="vertical-align: -3px;"/> <a href="'.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '/mypost">Bài viết của '.($user_id == $user['id'] ? 'tôi' : ''. $user['name'] . '').'</a></div>';
echo '<div class="menu list-top">';
echo'<img src="/images/info.png" alt="icon" style="vertical-align: -3px;"/> '.nick($user['id']). ' đang '.functions::display_place($user['id'], $user['place']).'';
echo'</div>';
if (!empty($user['facebook'])) {
$link = $user['facebook'];
$temp = explode("/", $link);
$dem = count($temp);
$tenface = $temp[$dem-1];
$dia_chi_lay_thong_tin = "https://graph.facebook.com/{$tenface}";
$thong_tin = file_get_contents($dia_chi_lay_thong_tin);
$thong_tin = json_decode($thong_tin, true);
echo'<div class="menu list-top"><img src="'.$home.'/icon/facebook.png" alt="icon" style="vertical-align: -3px;"/> Fb: '.htmlspecialchars($user[facebook]).'</div>';
}
if (!empty($user['mibile'])) {
echo'<div class="menu list-top"><img src="'.$home.'/icon/hotel.png" alt="icon" style="vertical-align: -3px;"/> SĐT: ' .$user['mibile'] . '</div>';
}
if(!empty($user['mail'])){
echo '<div class="menu list-top"><img src="/icon/forum/post.png"> Mail: '.htmlspecialchars($user['mail']).'</div>';
}
$dh = $connect->query("SELECT * FROM danhhieu WHERE user_id = '".$user['id']."'");
$cdh = ($connect->query("SELECT COUNT(*) FROM danhhieu WHERE user_id = '".$user['id']."'")->fetch_row()[0] ?? 0);
if($cdh >=1){
Echo '<div class="menu list-top"><img src="/icon/medal_gold_1.png"> ';
}
while ($xdh = $connect->fetch_array($dh)){
if($xdh['cap'] ==1){$cap = 'blue';}
if($xdh['cap'] ==2){$cap = 'red';}
if($xdh['cap'] ==3){$cap = 'purple';
}
echo '<font color='.$cap.'><small>[<b>'.$xdh['text'].'</b>]</small></font>';
}
If($cdh >=1){
Echo '</div>';
}
echo'</div>';

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bình luận </div>';
/////////////////////////////////// phần bình luận
$tong = ($connect->query("SELECT COUNT(*) FROM `binh_luan_tai_khoan` WHERE `id`='$id_comment'")->fetch_row()[0] ?? 0);
//gui du lieu vao csdl
if(isset($_POST['submit'])) {
$noidung = functions::checkin($_POST['text']);
$timep = $connect->fetch_array($connect->query("SELECT `lastpost` FROM `users` WHERE `id`='{$user_id}'"));
if(($timep['lastpost'] + 30) > time()) {
echo '<div class="menu">Bạn có thể viết status tiếp theo sau <b>'.(($timep['lastpost'] + 30) - time()).'s</b> nữa!</div>';
} else if(empty($_POST['text'])) {
echo '<div class="rmenu">Bạn chưa nhập nội dung!</div>';
} else if(strlen($_POST['text']) < 4) {
echo '<div class="menu">Nội dung bình luận quá ngắn!</div>';
} else if(strlen($_POST['text']) > 5000) {
echo '<div class="menu">Nội dung bình luận của bạn đã quá 5000 kí tự!</div>';
} else {
if ($user[id]!=$user_id) {
$connect->query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$user[id]."'");
$connect->query("INSERT INTO `notice` SET
`user_id` = '".$user_id."',
`user_fr` = '".$user[id]."',
`time` = '" . time() . "',
`type` = 'n'
");
}
$connect->query("INSERT INTO `binh_luan_tai_khoan` SET `id`='".$id_comment."', `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidung) . "', `time`='".time()."'");
header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');
}
}
//nhap lieu
if($user_id){
echo '<div class="menu congdong">';
$trave = base64_encode($_SERVER['REQUEST_URI']);
echo '<form action="'.$home.'/account/'. $id_comment.'/' . functions::khongdau($user['name']) . '" method="post">';
echo'<textarea name="text" placeholder="Nhập nội dung nhắn nhủ"></textarea>';
echo'<input type="hidden" name="trave" value="'.$trave.'" />';
echo'<input type="submit" name="submit" value="Đăng lên tường"/>';
echo'</form>';
echo'</div>';
} else {
echo'<div class="luuy">Hãy là thành viên để bình luận về bạn này</div>';
}
//phan bai dang


if($tong) {
$req = $connect->query("SELECT * FROM `binh_luan_tai_khoan` WHERE `id`='{$id_comment}' ORDER BY `time` DESC LIMIT $start, $kmess");
$i = 0;
while ($res = $connect->fetch_array($req)) {
echo is_integer($i/2) ? '<div class="menu list-top">' : '<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td
width="48px;" class="list_post">';
echo'<img class="avatar" src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="'.$res['from'].'"/>';
$name = $connect->fetch_array($connect->query("SELECT `name`,`lastdate` FROM `users` WHERE `id`='{$res['user_id']}'"));
echo'</td><td class="current-blog"><div class="blog-bg-left"><img src="/icon/left-blog.png"></div><span>';
echo (time() > $name['lastdate'] + 300 ? '<span style="color:red">[off]</span> ' : '<span style="color:green">[on]</span> ');
echo ''.($user_id && $user_id != $res['user_id'] ? '<a href="/account/'.$res['user_id'].'/">'.nick($res['user_id']).'</a>' : ''.nick($res['user_id']).'').': ';
echo'</span></div>';
echo'<div class="box_ndung_bviet">';
$ban = ($connect->query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" .$res['user_id']. "' AND `ban_time` > '" . time() . "'")->fetch_row()[0] ?? 0);
if($ban > 0) {
echo'******bài viêt ẩn******';
} else {
$res['text'] = html_entity_decode($res['text'], ENT_QUOTES, 'UTF-8');
$res['text'] = functions::checkout($res['text'], 1, 1);
echo functions::smileys(bbcode::tags($res['text']));
}
echo'</div>';
echo' <span style="font-size:11px;color:#777;">' . functions::thoigian($res['time']) . '</span>';
echo '</td></tr></tbody></table></div>';
$i++;
}
} else {
echo '<div class="menu">Chưa có bình luận mới !</div>';
}
if ($tong > $kmess){
echo '<div class="menu list-top">' . functions::phan_trang('/account/'.$id_comment.'/'.functions::khongdau($user['name']).'/', $start, $tong, $kmess) . '</div>';
}
echo'</div>';
////////////////////////////// hết
require_once ("../incfiles/end.php");
?>
