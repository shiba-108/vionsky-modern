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
$sql=$connect->query("SELECT `id` FROM `shophero` WHERE `id`='$int' ");
$row=$connect->fetch_assoc($sql);

$post = $connect->fetch_array($connect->query("select * from `shophero` WHERE  `id` = '$int'  LIMIT 1"));

$tien = $post['giamua'];
$kt = ($connect->query("SELECT COUNT(*) FROM `tuihero` WHERE `id_user` = '$user_id' AND `set` = '".$post['set']."'")->fetch_row()[0] ?? 0);
$giamgia = $_POST['giamgia'];
if (isset($_POST['mua'])){
if ($giamgia ==0){
if($datauser['balans'] >= $tien && $kt == 0) { 
$connect->query("INSERT INTO `tuihero` (`set` , `capset`, `id_user`, `giamua`, `giaban`, `sucmanh`, `hp`, `mana`, `tc1`, `tc2`, `tc3`, `tc4`, `tc5`, `nameset`) VALUES  ('".$post['set']."', '".$post['capset']."', '".$user_id."', '".$post['giamua']."','".$post['giaban']."','".$post['sucmanh']."','".$post['hp']."','".$post['mana']."', '".$post['tc1']."', '".$post['tc2']."', '".$post['tc3']."', '".$post['tc4']."', '".$post['tc5']."', '".$post['nameset']."') ");
$connect->query("UPDATE `users` SET `balans` = `balans`- $tien WHERE `id` = $user_id LIMIT 1");
echo '<div class="main-xmenu">
<div class="phdr"><b>Mua Hàng Thành công</b></div>';
echo '<div class="menu list-top"><img class="cap'.$post['capset'].'" src="/heroes/'.$post['set'].'.png" width="150" height="200" /></div>';
echo '<div class="menu list-top"> <font color="gold">Giá: <b>'.$post['giamua'].'</b> Vàng</font></div>';
echo '<div class="menu list-top"> <font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font></div>';
echo '<div class="menu list-top"> <font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font></div>';
echo '<div class="menu list-top"> <font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font></div>';
echo '<div class="menu list-top"> <font color="gold">Giá bán lại: <b>'.$post['giaban'].'</b> Vàng</font></div>';
} else { 
echo '<div class="main-xmenu">
<div class="phdr"><b>Lỗi Mua Hàng Không Thành công</b></div>';
echo '<div class="menu list-top">Có rồi hoặc không đủ tiền!</div>';
}
}
if ($giamgia ==1){
$tiengiam = ($tien/100)*75;
if($datauser['balans'] >= $tiengiam && $kt == 0 && $datauser['shopdown'] >=1) { 
$connect->query("INSERT INTO `tuihero` (`set` , `capset`, `id_user`, `giamua`, `giaban`, `sucmanh`, `hp`, `mana`, `tc1`, `tc2`, `tc3`, `tc4`, `tc5`, `nameset`) VALUES  ('".$post['set']."', '".$post['capset']."', '".$user_id."', '".$post['giamua']."','".$post['giaban']."','".$post['sucmanh']."','".$post['hp']."','".$post['mana']."', '".$post['tc1']."', '".$post['tc2']."', '".$post['tc3']."', '".$post['tc4']."', '".$post['tc5']."', '".$post['nameset']."') ");
$connect->query("UPDATE `users` SET `balans` = `balans`- $tiengiam, `shopdown` = `shopdown` - 1 WHERE `id` = $user_id LIMIT 1");
echo '<div class="main-xmenu">
<div class="phdr"><b>Mua Hàng Thành công -25%</b></div>';
echo '<div class="menu list-top"><img class="cap'.$post['capset'].'" src="/heroes/'.$post['set'].'.png" width="150" height="200" /></div>';
echo '<div class="menu list-top"> <font color="gold">Giá: <b>'.$tiengiam.'</b> Vàng</font></div>';
echo '<div class="menu list-top"> <font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font></div>';
echo '<div class="menu list-top"> <font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font></div>';
echo '<div class="menu list-top"> <font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font></div>';
echo '<div class="menu list-top"> <font color="gold">Giá bán lại: <b>'.$post['giaban'].'</b> Vàng</font></div>';
} else { 
echo '<div class="main-xmenu">
<div class="phdr"><b>Lỗi Mua Hàng Không Thành công</b></div>';
echo '<div class="menu list-top">Có rồi hoặc không đủ tiền cũng có thể là thiếu thẻ giảm giá!</div>';
}
}
}
}else{
$tong = ($connect->query("SELECT COUNT(*) FROM `shophero`")->fetch_row()[0] ?? 0);
$res = $connect->query("SELECT * FROM `shophero` LIMIT $start, $kmess");
echo '<div class="main-xmenu"><div class="phdr"><b>Cửa hàng Hero</b></div> <div class="gmenu"><table><tbody><tr><td width="20"><img src="img/shop/shopdown.png" class="cap2"></td><td><b>'.$datauser['shopdown'].'</b> [<a href="shop.php">Mua</a>]</td></tr></tbody></table> </div> ';
echo '<div class="menu">Có <b>'.$tong.'</b> Hero tất cả! </div>';
while ($post = $connect->fetch_array($res)){
$sm= '<font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font>';
$gia = 'Giá tiền: <b>'.$post['giamua'].'</b> Vàng</font>';
$hp = '<font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font>';
$mana = '<font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font>';
echo '<div class="menu list-top">
<table>
<tbody><tr><td width="80">
<img class="cap'.$post['capset'].'" src="/heroes/'.$post['set'].'.png" width="150" height="200" class="portrait"/>
</td><td width="auto" valign="top">
<form method="post" action="shophero.php?id='.$post['id'].'"><select name="giamgia"><option value="0">100%</option><option value="1">75%</option></select><input type="submit" name="mua" value="Mua"></form>
'.$sm.'<br/>
'.$hp.'<br/>
'.$mana.'<br/>
'.$gia.'<br/><b>'.$post['nameset'].'</b>';
echo ' (<font color="red">+'.$post['capset'].'</font>)</b>';
echo '
</td></tr></tbody></table>
</div>';
}
if ($tong > $kmess){ //Phân Trang
echo '<div class="trang">' . functions::display_pagination('shophero.php?', $start, $tong, $kmess) . '</div>';
}
}
echo "<div class='menu list-top'>";
if(isset($_GET['id']))
echo "&laquo; <a href='shophero.php'>Cửa hàng</a>";
echo "</div></div>";
}else{
msg('Vui lòng đăng nhập!');
}
require('../incfiles/end.php');
?>