<?
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
$mypost = 'style="color:#838c01"';
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
$mods = array(
'newtopic'
);
$textl = 'Bài viết của '. $user['name'] . '';
$mota = 'Ở đây sẽ tổng hợp lại những bài viết mới cũ của bạn '. $user['name'] . '';
require_once ('../incfiles/head.php');
if ($user_id) {
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'. $user['id'] . '') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'. $user['id'] . '/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
if ($_SERVER['REQUEST_URI'] == '/account/'. $user['id'] . '/') {header('Location: '.$home.'/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '');}
}else{
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/danh-sach');}
if ($_SERVER['REQUEST_URI'] == '/account/') {header('Location: '.$home.'/account/danh-sach/');}
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bài viết của '.($user_id == $user['id'] ? 'tôi' : ''. $user['name'] . '').'</div>';
$total = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `user_id` = '".$user['id']."'")->fetch_row()[0] ?? 0);
if($total > 0)
{
$i=0;
$truyvan = $connect->query("SELECT * FROM `forum` WHERE `type` = 't' AND `user_id` = '".$user['id']."' ORDER BY `time` DESC LIMIT $start, $kmess");
while ($baiviet = $connect->fetch_array($truyvan)) { 
$thongtinnhom = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id`='{$baiviet[groups]}'"));
$likeforum = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `topic_like` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$nguoicomment = $connect->fetch_array($connect->query("SELECT `user_id` FROM `forum` WHERE `refid` = '" . $baiviet['id'] . "'ORDER BY time DESC"));
$commentforum = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$randlabel = array("label-1","label-2","label-3","label-4","label-5","label-6","label-7","label-8");
$radom = rand(0,4);
$label = $randlabel[$radom];
?>
  <div class="menu list-bottom forum">
  <img src="/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/>
  <a href="<?php echo $home; ?>/groups/<?php echo $baiviet[groups]; ?>/forum/<?php echo $baiviet[id]; ?>"><?php 
$xss = htmlspecialchars($baiviet['text']);
echo mb_substr($xss, 0, 100); ?></a>
  <span style="color:#999;font-size:11px">(<?php echo ($commentforum-1); ?>)</span> <span style="font-size:12px"><?php echo nick($nguoicomment[user_id]); ?></span>
 </div>
<?php
$i++;
}
} else {
echo '<div class="menu">Bạn '.($user_id == $user['id'] ? '' : ''. $user['name'] . '').' chưa đăng bài viết nào</div>';
}
if ($total > $kmess) {
echo '<div class="topmenu">' . functions::phan_trang('/account/'. $user['id'] . '/' . functions::khongdau($user['name']) . '/mypost/', $start, $total, $kmess) . '</div>';
}
echo'</div>';
require_once ("../incfiles/end.php");
?>