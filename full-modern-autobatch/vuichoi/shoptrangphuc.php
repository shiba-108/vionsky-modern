<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Cửa hàng trang phục';
$tab = 'vui';
require('../incfiles/head.php');
if($user_id){
?>
<?
if(isset($_GET['buy_ok']))msg('Mua!');
if(isset($_GET['buy_no']))msg("Không đủ tiền!");
if(isset($_GET['id'])){
$int=intval($_GET['id']);
$sql=$connect->query("SELECT `id` FROM `trangphuchero` WHERE `id`='$int' ");
$row=$connect->fetch_assoc($sql);

$post = $connect->fetch_array($connect->query("select * from `trangphuchero` WHERE  `id` = '$int'  LIMIT 1"));

$tien = $post['giamua'];
$kt = ($connect->query("SELECT COUNT(*) FROM `trangphucherocuaban` WHERE `id_user` = '$user_id' AND `idtp` = '".$post['idtp']."'")->fetch_row()[0] ?? 0);
$giamgia = $_POST['giamgia'];
if (isset($_POST['mua'])){
if ($giamgia ==0){
if ($datauser['kc'] >= $tien and $kt ==0) {

$connect->query("INSERT INTO `trangphucherocuaban` (`id_set`,`giaban`, `id_user`, `sucmanh`, `hp`, `mana`, `nameset`, `idtp`) VALUES  ('".$post['id_set']."', '".$post['giaban']."', '".$user_id."','".$post['sucmanh']."','".$post['hp']."','".$post['mana']."', '".$post['nameset']."', '".$post['idtp']."') ");
$connect->query("UPDATE `users` SET `kc` = `kc`- $tien WHERE `id` = $user_id LIMIT 1");
echo '<div class="main-xmenu">
<div class="phdr"><b>Mua Hàng Thành công</b></div>';
echo '<div class="menu list-top"><img class="cap5" src="/heroes/'.$post['idtp'].'.png" width="50" height="50" /></div>';
echo '<div class="menu list-top"> <font color="purple">Giá: <b>'.$post['giamua'].'</b> Kim Cương</font></div>';
echo '<div class="menu list-top"> <font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font></div>';
echo '<div class="menu list-top"> <font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font></div>';
echo '<div class="menu list-top"> <font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font></div>';
echo '<div class="menu list-top"> <font color="purple">Giá bán lại: <b>'.$post['giaban'].'</b> Kim Cương</font></div>';
} else {
echo '<div class="main-xmenu">
<div class="phdr"><b>Lỗi Mua Hàng Không Thành công</b></div>';
echo '<div class="menu list-top">Có rồi hoặc không đủ tiền!</div>';
}
}
if ($giamgia ==1){
$tiengiam = ($tien/100)*75;
if ($datauser['kc'] >= $tiengiam and $kt ==0 and $datauser['shopweardown'] >=1) {
$connect->query("INSERT INTO `trangphucherocuaban` (`id_set`,`giaban`, `id_user`, `sucmanh`, `hp`, `mana`, `nameset`, `idtp`) VALUES  ('".$post['id_set']."', '".$post['giaban']."', '".$user_id."','".$post['sucmanh']."','".$post['hp']."','".$post['mana']."', '".$post['nameset']."', '".$post['idtp']."') ");
$connect->query("UPDATE `users` SET `kc` = `kc`- $tiengiam, `shopweardown` = `shopweardown` - 1 WHERE `id` = $user_id LIMIT 1");
echo '<div class="main-xmenu">
<div class="phdr"><b>Mua Hàng Thành công -25%</b></div>';
echo '<div class="menu list-top"><img class="cap5" src="/heroes/'.$post['idtp'].'.png" width="50" height="50" /></div>';
echo '<div class="menu list-top"> <font color="purple">Giá: <b>'.$tiengiam.'</b> Kim Cương</font></div>';
echo '<div class="menu list-top"> <font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font></div>';
echo '<div class="menu list-top"> <font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font></div>';
echo '<div class="menu list-top"> <font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font></div>';
echo '<div class="menu list-top"> <font color="purple">Giá bán lại: <b>'.$post['giaban'].'</b> Kim Cương</font></div>';
} else {
echo '<div class="main-xmenu">
<div class="phdr"><b>Lỗi Mua Hàng Không Thành công</b></div>';
echo '<div class="menu list-top">Có rồi hoặc không đủ tiền cũng có thể là thiếu thẻ giảm giá!</div>';
}
}
}
}else{
$tong = ($connect->query("SELECT COUNT(*) FROM `trangphuchero`")->fetch_row()[0] ?? 0);
$res = $connect->query("SELECT * FROM `trangphuchero` LIMIT $start, $kmess");
echo '<div class="main-xmenu"><div class="phdr"><b>Cửa hàng Trang phục</b></div> <div class="gmenu"><table><tbody><tr><td width="20"><img src="img/shop/shopdown.png" class="cap5"></td><td><b>'.$datauser['shopweardown'].'</b> [<a href="shop.php">Mua</a>]</td></tr></tbody></table> </div> ';
echo '<div class="menu">Có <b>'.$tong.' </b>trang phục hero tất cả!</div>';
while ($post = $connect->fetch_array($res)){
$sm= '<font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font>';
$gia = 'Giá tiền: <b>'.$post['giamua'].'</b> Kim Cương</font>';
$hp = '<font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font>';
$mana = '<font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font>';
echo '<div class="menu list-top">
<table>
<tbody><tr><td width="80">
<img class="trangphuc" src="/heroes/'.$post['idtp'].'.png" width="50" height="50" class="portrait"/>
</td><td width="auto" valign="top">
<form method="post" action="shoptrangphuc.php?id='.$post['id'].'"><select name="giamgia"><option value="0">100%</option><option value="1">75%</option></select><input type="submit" name="mua" value="Mua"></form>
'.$sm.'<br/>
'.$hp.'<br/>
'.$mana.'<br/>
'.$gia.'<br/><b>'.$post['nameset'].'</b>';
echo '
</td></tr></tbody></table>
</div>';
}
if ($tong > $kmess){ //Phân Trang
echo '<div class="trang">' . functions::display_pagination('shoptrangphuc.php?', $start, $tong, $kmess) . '</div>';
}
}
echo "<div class='menu list-top'>";
if(isset($_GET['id']))
echo "&laquo; <a href='shoptrangphuc.php'>Cửa hàng trang phục</a>";
echo "</div></div>";
}else{
msg('Vui lòng đăng nhập!');
}
require('../incfiles/end.php');
?>
