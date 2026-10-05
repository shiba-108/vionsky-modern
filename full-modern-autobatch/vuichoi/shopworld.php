<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Cửa hàng';
$tab = 'vui';
require('../incfiles/head.php');
if($user_id){
?>
<?
if(isset($_GET['buy_ok']))msg('Mua!');
if(isset($_GET['buy_no']))msg("Không đủ tiền!");
if(isset($_GET['id'])){
$int=intval($_GET['id']);
$sql=$connect->query("SELECT `id` FROM `shopcm` WHERE `id`='$int' ");
$row=$connect->fetch_assoc($sql);

$post = $connect->fetch_array($connect->query("select * from `shopcm` WHERE  `id` = '$int'  LIMIT 1"));

$tien = $post['giamua'];
$kt = ($connect->query("SELECT COUNT(*) FROM `world` WHERE `user_id` = '$user_id' AND `odat` = '".$post['odat']."'")->fetch_row()[0] ?? 0);
if (isset($_POST['mua'])){
if($datauser['balans'] >= $tien && $kt == 0) { 
$giaban = $post['giamua']/2;
$connect->query("INSERT INTO `world` (`odat` , `giamua`, `giaban`, `danso`, `user_id`, `cap`) VALUES  ('".$post['odat']."', '".$post['giamua']."', '".$giaban."', '".$post['danso']."', '".$user_id."', '1') ");
$connect->query("UPDATE `users` SET `balans` = `balans`- $tien WHERE `id` = $user_id LIMIT 1");
echo '<div class="main-xmenu">
<div class="phdr"><b>Mua Hàng Thành công</b></div>';
echo '<div class="menu list-top"><img  src="/world/'.$post['odat'].'.png" width="70" height="45" /></div>';
echo '<div class="menu list-top"> <font color="gold">Giá: <b>'.$post['giamua'].'</b> Vàng</font></div>';
echo '<div class="menu list-top"> <font color="green">Dân số: <b>'.$post['danso'].'</b></font></div>';
echo '<div class="menu list-top"> <font color="gold">Giá bán lại: <b>'.$giaban.'</b> Vàng</font></div>';
} else { 
echo '<div class="main-xmenu">
<div class="phdr"><b>Lỗi Mua Hàng Không Thành công</b></div>';
echo '<div class="menu list-top">Có rồi hoặc không đủ tiền!</div>';
}
}
}else{
$tong = ($connect->query("SELECT COUNT(*) FROM `shopcm`")->fetch_row()[0] ?? 0);
$res = $connect->query("SELECT * FROM `shopcm` LIMIT $start, $kmess");
echo '<div class="main-xmenu"><div class="phdr"><b>Thế giới</b></div> ';
echo '<div class="menu">Có <b>'.$tong.'</b> đất nước tất cả! </div>';
while ($post = $connect->fetch_array($res)){

echo '<div class="menu list-top">
<table>
<tbody><tr><td width="80">
<img src="/world/'.$post['odat'].'.png" width="70" height="45" class="portrait"/>
</td><td width="auto" valign="top">
<form method="post" action="shopworld.php?id='.$post['id'].'"><br><input type="submit" name="mua" value="Mua"></form>
Dân số: <font color=green>'.$post['danso'].'</font><br>Giá mua: <font color=gold><b>'.$post['giamua'].'</b> G</font><br/><b>'.$post['odat'].'</b>';
echo '
</td></tr></tbody></table>
</div>';
}
if ($tong > $kmess){ //Phân Trang
echo '<div class="trang">' . functions::display_pagination('shopworld.php?', $start, $tong, $kmess) . '</div>';
}
}
echo "<div class='menu list-top'>";
if(isset($_GET['id']))
echo "&laquo; <a href='shopworld.php'>Cửa hàng</a>";
echo "</div></div>";
}else{
msg('Vui lòng đăng nhập!');
}
require('../incfiles/end.php');
?>