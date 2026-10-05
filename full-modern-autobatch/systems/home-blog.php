<div class="main-xmenu">
<div class="danhmuc">Store Update New</div>
<?php
$truyvan = $connect->query("SELECT * FROM `gamephanphoi` ORDER BY `time` DESC LIMIT 5");
for ($j = 0; $blogs = $connect->fetch_assoc($truyvan); ++$j) {
if ($blogs[hotro] == 1) {$dongmayhotro = '<img src="/icon/dongmay/java.png" alt="icon" style="vertical-align: -2px;"/>';}
if ($blogs[hotro] == 2) {$dongmayhotro = '<img src="/icon/dongmay/android.png" alt="icon" style="vertical-align: -2px;"/>';}
if ($blogs[hotro] == 3) {$dongmayhotro = '<img src="/icon/dongmay/ios.png" alt="icon" style="vertical-align: -2px;"/>';}
if ($blogs[hotro] == 4) {$dongmayhotro = '<img src="/icon/dongmay/java.png" alt="icon" style="vertical-align: -2px;"/> <img src="/icon/dongmay/android.png" alt="icon" style="vertical-align: -2px;"/>';}
if ($blogs[hotro] == 5) {$dongmayhotro = '<img src="/icon/dongmay/android.png" alt="icon" style="vertical-align: -2px;"/> <img src="/icon/dongmay/ios.png" alt="icon" style="vertical-align: -2px;"/>';}
if ($blogs[hotro] == 6) {$dongmayhotro = '<img src="/icon/dongmay/java.png" alt="icon" style="vertical-align: -2px;"/> <img src="/icon/dongmay/android.png" alt="icon" style="vertical-align: -2px;"/> <img src="/icon/dongmay/ios.png" alt="icon" style="vertical-align: -2px;"/>';}
?>
<div class="menu list-bottom">
 <img src="/icon/game.png" alt="icon" style="vertical-align: -3px;"/> 
<?php if ($blogs[type] == 1) { ?>
 <a href="<?php echo $home; ?>/store/game-offline/<?php echo $blogs[id]; ?>-<?php echo functions::khongdau($blogs['tieude']); ?>"> <?php echo mb_substr($blogs['tieude'], 0, 100); ?></a>
<?php } ?>
<?php if ($blogs[type] == 2) { ?>
 <a href="<?php echo $home; ?>/store/game-online/<?php echo $blogs[id]; ?>-<?php echo functions::khongdau($blogs['tieude']); ?>"> <?php echo mb_substr($blogs['tieude'], 0, 100); ?></a>
<?php } ?>
<?php if ($blogs[type] == 3) { ?>
 <a href="<?php echo $home; ?>/store/soft/<?php echo $blogs[id]; ?>-<?php echo functions::khongdau($blogs['tieude']); ?>"> <?php echo mb_substr($blogs['tieude'], 0, 100); ?></a>
<?php } ?>
</div>
<?php $i++;} ?>
<div class="menu congdong">
<a href="/store/">Xem thêm kho ứng dụng</a>
</div>
</div>