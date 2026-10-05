<?php
define('_IN_JOHNCMS', 1);
require ('../../incfiles/core.php');
$textl = 'Duyệt bài';
$active = 1;
$active2 = 'class="active"';
require ('../../incfiles/head.php');
if ($rights <= 0) {
header("Location: $home");
}
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Duyệt bài</div>';
$truyvan = $connect->query("SELECT * FROM `forum` WHERE `type` = 't' AND `duyet` = '0' ORDER BY `id` DESC LIMIT $start, $kmess");
$tong = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `groups` = '".$id."'")->fetch_row()[0] ?? 0);
for ($j = 0; $baiviet = $connect->fetch_assoc($truyvan); ++$j) {
$thongtinnhom = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id`='{$baiviet[groups]}'"));
$likeforum = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `user_id` = '".$user_id."' AND `topic_like` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$commentforum = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$nguoicomment = $connect->fetch_array($connect->query("SELECT `user_id` FROM `forum` WHERE `refid` = '" . $baiviet['id'] . "'ORDER BY time DESC"));
?>
  <?php if ($j == 0) { ?>
  <div class="menu forum style="margin-top: -2px">
  <?php } else { ?>
  <div class="menu list-top forum">
  <?php } ?>
  <img src="/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/>
  <a href="<?php echo $home; ?>/groups/<?php echo $baiviet[groups]; ?>/forum/<?php echo $baiviet[id]; ?>"><?php echo mb_substr($baiviet['text'], 0, 100); ?></a>
 </div>
<?php
    +$i;
}
if ($tong > $kmess){
echo '<div class="menu">' . functions::phan_trang('/groups/forum/duyet/', $start, $tong, $kmess) . '</div>';
}
echo'</div>';
require ('../../incfiles/end.php'); 