<?php
define('_IN_JOHNCMS', 1);
require ('../../incfiles/core.php');
$id = intval(abs($_GET['id']));
$tieude = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id` = '".$id."'"));
$textl = 'Forum - '.$tieude[name];
$active = 1;
$active2 = 'class="active"';
require ('../../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Chủ đề của nhóm [<a href="/groups/'.$id.'/forum/clear">Viết Bài Mới</a>]</div>';
$truyvan = $connect->query("SELECT * FROM `forum` WHERE `type` = 't' AND `groups` = '".$id."' ORDER BY `id` DESC LIMIT $start, $kmess");
$tong = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `groups` = '".$id."'")->fetch_row()[0] ?? 0);
while ($baiviet = $connect->fetch_array($truyvan)) { 
$thongtinnhom = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id`='{$baiviet[groups]}'"));
$likeforum = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `user_id` = '".$user_id."' AND `topic_like` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$commentforum = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$nguoicomment = $connect->fetch_array($connect->query("SELECT `user_id` FROM `forum` WHERE `refid` = '" . $baiviet['id'] . "'ORDER BY time DESC"));
?>
 <div class="menu list-bottom forum">
  <img src="/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/>
  <a href="<?php echo $home; ?>/groups/<?php echo $baiviet[groups]; ?>/forum/<?php echo $baiviet[id]; ?>"><?php
$xss = htmlspecialchars($baiviet['text']);
 echo mb_substr($xss, 0, 100); ?></a>
  <span style="color:red">[♥<?php echo $likeforum; ?>/<?php echo ($commentforum-1); ?>]</span> <?php echo nick($nguoicomment[user_id]); ?>
 </div>
<?php
    +$i;
}
if ($tong > $kmess){
echo '<div class="menu">' . functions::phan_trang('/groups/'.$id.'/forum/', $start, $tong, $kmess) . '</div>';
}
echo'</div>';
require ('../../incfiles/end.php'); 