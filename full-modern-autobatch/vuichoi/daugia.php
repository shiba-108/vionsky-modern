<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Đấu giá';
$tab = 'vui';
require('../incfiles/head.php');
if($user_id){
?>
<?
if(isset($_GET['buy_ok']))msg('Mua!');
if(isset($_GET['buy_no']))msg("Không đủ tiền!");
if(isset($_GET['id'])){
$int=intval($_GET['id']);
$sql=$connect->query("SELECT `id` FROM `daugia` WHERE `id`='$int' ");
$row=$connect->fetch_assoc($sql);

$post = $connect->fetch_array($connect->query("select * from `daugia` WHERE  `id` = '$int'  LIMIT 1"));

$tien = $post['giaban2'];
$kt = ($connect->query("SELECT COUNT(*) FROM `tuihero` WHERE `id_user` = '$user_id' AND `set` = '".$post['set']."'")->fetch_row()[0] ?? 0);
$id = $post['id'];
$iddg = $post['iddg'];
$giamgia = $_POST['giamgia'];
if (isset($_POST['mua'])){
if ($giamgia ==0){
if($datauser['vnd'] >= $tien && $kt == 0) { 
$connect->query("INSERT INTO `tuihero` (`set` , `capset`, `id_user`, `giamua`, `giaban`, `sucmanh`, `hp`, `mana`, `tc1`, `tc2`, `tc3`, `tc4`, `tc5`, `nameset`) VALUES  ('".$post['set']."', '".$post['capset']."', '".$user_id."', '".$post['giamua']."','".$post['giaban']."','".$post['sucmanh']."','".$post['hp']."','".$post['mana']."', '".$post['tc1']."', '".$post['tc2']."', '".$post['tc3']."', '".$post['tc4']."', '".$post['tc5']."', '".$post['nameset']."') ");
$connect->query("UPDATE `users` SET `vnd` = `vnd`- $tien WHERE `id` = $user_id");
$connect->query("DELETE FROM daugia WHERE id = $id");
$connect->query("DELETE FROM tuihero WHERE id = $iddg");
$ids = $post['user_id'];
$connect->query("UPDATE `users` SET `vnd` = `vnd`+ $tien WHERE `id` = $ids");
$connect->query("INSERT INTO `cms_mail` SET
		`user_id` = '2',
		`from_id` = '" . $post['user_id'] . "',
		`text` = '[green][b]BÁN THÀNH CÔNG[/b][/green] - Hero [blue]".$post['nameset']."[/blue] với giá [green]".$post['giaban2']." VNĐ[/green]. Người mua: [b]".$datauser['name']."[/b]',
                `time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
echo '<div class="main-xmenu">
<div class="phdr"><b>Mua Hàng Thành công</b></div>';
echo '<div class="menu list-top"><img class="cap'.$post['capset'].'" src="/heroes/'.$post['set'].'.png" width="150" height="200" /></div>';
echo '<div class="menu list-top"> <font color="gold">Giá: <b>'.$post['giamua'].'</b> Vàng</font></div>';
echo '<div class="menu list-top"> <font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font></div>';
echo '<div class="menu list-top"> <font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font></div>';
echo '<div class="menu list-top"> <font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font></div>';
echo '<div class="menu list-top"> <font color="gold">Giá bán lại: <b>'.$post['giaban'].'</b> Vàng</font></div>';
} else { 
echo '<div class="main-xmenu">
<div class="phdr"><b>Lỗi Mua Hàng Không Thành công</b></div>';
echo '<div class="menu list-top">Có rồi hoặc không đủ tiền!</div>';
}
}
if($giamgia ==1){
$tiengiam = ($tien/100)*75;
if($datauser['vnd'] >= $tiengiam && $kt == 0 && $datauser['blackshopdown'] >=1) {
$connect->query("INSERT INTO `tuihero` (`set` , `capset`, `id_user`, `giamua`, `giaban`, `sucmanh`, `hp`, `mana`, `tc1`, `tc2`, `tc3`, `tc4`, `tc5`, `nameset`) VALUES  ('".$post['set']."', '".$post['capset']."', '".$user_id."', '".$post['giamua']."','".$post['giaban']."','".$post['sucmanh']."','".$post['hp']."','".$post['mana']."', '".$post['tc1']."', '".$post['tc2']."', '".$post['tc3']."', '".$post['tc4']."', '".$post['tc5']."', '".$post['nameset']."') ");
$connect->query("UPDATE `users` SET `vnd` = `vnd`- $tiengiam WHERE `id` = $user_id");
$connect->query("DELETE FROM daugia WHERE id = $id");
$connect->query("DELETE FROM tuihero WHERE id = $iddg");
$ids = $post['user_id'];
$connect->query("UPDATE `users` SET `vnd` = `vnd`+ $tien, `blackshopdown` = `blackshopdown`- 1 WHERE `id` = $ids");
$connect->query("INSERT INTO `cms_mail` SET
		`user_id` = '" . $post['user_id'] . "',
		`from_id` = '2',
		`text` = '[green][b]BÁN THÀNH CÔNG[/b][/green] - Hero [blue]".$post['nameset']."[/blue] với giá [green]".$post['giaban2']." VNĐ[/green]. Người mua: [b]".$datauser['name']."[/b]',
                `time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
echo '<div class="main-xmenu">
<div class="phdr"><b>Mua Hàng Thành công</b></div>';
echo '<div class="menu list-top"><img class="cap'.$post['capset'].'" src="/heroes/'.$post['set'].'.png" width="150" height="200" /></div>';
echo '<div class="menu list-top"> <font color="gold">Giá: <b>'.$post['giamua'].'</b> Vàng</font></div>';
echo '<div class="menu list-top"> <font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font></div>';
echo '<div class="menu list-top"> <font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font></div>';
echo '<div class="menu list-top"> <font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font></div>';
echo '<div class="menu list-top"> <font color="gold">Giá bán lại: <b>'.$post['giaban'].'</b> Vàng</font></div>';
} else { 
echo '<div class="main-xmenu">
<div class="phdr"><b>Lỗi Mua Hàng Không Thành công</b></div>';
echo '<div class="menu list-top">Có rồi hoặc không đủ tiền cũng có thể là thiếu thẻ giảm giá!</div>';
}
}
}
}else{
$tong = ($connect->query("SELECT COUNT(*) FROM `daugia`")->fetch_row()[0] ?? 0);
$res = $connect->query("SELECT * FROM `daugia` LIMIT $start, $kmess");
echo '<div class="main-xmenu"><div class="phdr"><b>Chợ đen</b></div> <div class="gmenu"><table><tbody><tr><td width="20"><img src="img/shop/shopdown.png" class="cap3"></td><td><b>'.$datauser['blackshopdown'].'</b> [<a href="shop.php">Mua</a>]</td></tr></tbody></table> </div> ';
echo '<div class="menu">Có <b>'.$tong.'</b> Hero tất cả </div>';
while ($post = $connect->fetch_array($res)){
$sm= '<font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font>';
$gia = 'Giá tiền: <font color="green"><b>'.$post['giaban2'].'</b> VNĐ</font>';
$hp = '<font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font>';
$mana = '<font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font>';
echo '<div class="menu list-top">
<table>
<tbody><tr><td width="80">
<img class="cap'.$post['capset'].'" src="/heroes/'.$post['set'].'.png" width="150" height="200" class="portrait"/>
</td><td width="auto" valign="top">
<form action="daugia.php?id='.$post['id'].'" method="post"><select name="giamgia"><option value="0">100%</option><option value="1">75%</option></select><input type="submit" name="mua" value="Mua"></form>
'.$sm.'<br/>
'.$hp.'<br/>
'.$mana.'<br/>
'.$gia.'<br/>';
echo '<b>'.$post['nameset'].'</b>';
echo ' (<font color="red">+'.$post['capset'].'</font>)</b><br>Người bán: '.nick($post['user_id']).'';
echo '
</td></tr></tbody></table>
</div>';
}
if ($tong > $kmess){ //Phân Trang
echo '<div class="trang">' . functions::display_pagination('daugia.php?', $start, $tong, $kmess) . '</div>';
}
}
echo "<div class='menu list-top'>";
if(isset($_GET['id']))
echo "&laquo; <a href='daugia.php'>Chợ đen</a>";
echo "</div></div>";
}else{
msg('Vui lòng đăng nhập!');
}
require('../incfiles/end.php');
?>