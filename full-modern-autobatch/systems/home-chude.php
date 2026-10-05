<?php $duyetbai = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `duyet` = '0'")->fetch_row()[0] ?? 0); ?>
<?php echo'<div class="main-xmenu"><div class="danhmuc">Bài mới gửi '.($rights >= 3 ? ''.($duyetbai > 0 ? '[ <a href="/groups/forum/duyet.php">Có <span style="color:red">'.$duyetbai.'</span> bài cần duyệt</a> ]':'').'':'').'</div>';
$tong = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `duyet` = '1'")->fetch_row()[0] ?? 0);
$truyvan = $connect->query("SELECT * FROM `forum` WHERE `type` = 't' AND `duyet` = '1' ORDER BY `time` DESC LIMIT $start, $kmess");
for ($j = 0; $baiviet = $connect->fetch_assoc($truyvan); ++$j) {
$thongtinnhom = $connect->fetch_array($connect->query("SELECT `name` FROM `nhom` WHERE `id`='{$baiviet[groups]}'"));
$likeforum = ($connect->query("SELECT COUNT(*) FROM `hoinhom_forum_like` WHERE `user_id` = '".$user_id."' AND `topic_like` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$nguoicomment = $connect->fetch_array($connect->query("SELECT `user_id` FROM `forum` WHERE `refid` = '" . $baiviet['id'] . "'ORDER BY time DESC"));
$commentforum = ($connect->query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '".$baiviet[id]."'")->fetch_row()[0] ?? 0);
$gioithieu = functions::tranrss($baiviet['text'], 1, 1);
$baiviet['text'] = functions::checkout($baiviet['text']);
$nhom = $connect->fetch_array($connect->query("SELECT * FROM `nhom` WHERE `id`='".$id."'"));
?>
<?php if ($j == 0) { ?>
<div class="menu list-bottom" style="border-top: 1px solid #fff;">
<?php } else { ?>
<div class="menu list-bottom">
<?php } ?>
<img src="/icon/forum/post.png" alt="icon" style="vertical-align: -3px;"/>
<a href="<?php echo $home; ?>/groups/<?php echo $baiviet[groups]; ?>/forum/<?php echo $baiviet[id]; ?>"><span style="font-size:15px"><?php echo mb_substr($baiviet['text'], 0, 100); ?></span></a>
<div class="menu list-bottom hot"><span style="font-size:11px">[<font color="red">♥<?php echo $likeforum; ?></font>]</span> | <span style="font-size:11px">Thảo luận: <?php echo ($commentforum-1); ?></span> | <span style="font-size:11px">Gửi cuối:</span> <a href="/account/<?php echo $nguoicomment['user_id']; ?>"><?php echo nick($nguoicomment[user_id]); ?></a></div></div>
<?php if ($j == 9) { ?>
<div style="border-bottom: 1px solid #fff;">
<?php } ?>
<?php $i++;} ?>
<?php if ($tong > $kmess) { echo '<div class="menu list-top"><span class="left">' . functions::phan_trang('/', $start, $tong, $kmess) . '</span></div></div></div>'; } ?>
