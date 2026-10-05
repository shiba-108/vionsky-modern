<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'My Hero!';
require('../incfiles/head.php');

if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
?>
<div class="main-xmenu"><?
if(isset($_GET['id'])){
$int=intval($_GET['id']);
$post = $connect->fetch_array($connect->query("select * from `tuihero` WHERE `id`= '$int' LIMIT 1"));
$tien = $post['giaban'];
$tienm = $post['giamua'];
$cap = $post['capset'];
$sethr = $post['set'];
$tc1 = $post['tc1'];
$tc2 = $post['tc2'];
$tc3 = $post['tc3'];
$tc4 = $post['tc4'];
$tc5 = $post['tc5'];
$type = $post['type'];
$names = $post['nameset'];
$sp = $lsp['capset'];
$name = $post['name'];
$sucmanh = $post['sucmanh'] - 15;
$sucmanh2=intval($thanh['sucmanh']);
$addsm1 = $post['sucmanh']*3;
$addsm2 = $post['sucmanh']*8;
$addsm = rand($addsm1,$addsm2);
$addmn1 = $post['mana']*2;
$addmn2 = $post['mana']*4;
$addmn = rand($addmn1,$addmn2);
$addhp1 = $post['hp']*2;
$addhp2 = $post['hp']*8;
$addhp = rand($addhp1,$addhp2);
If ($post['hp'] >=120){
$hp = $post['hp'] - 120;
} else {
$hp = $post['hp'];
}
If ($post['mana'] >=100){
$mana = $post['mana'] - 100;
} else {
$mana = $post['mana'];
}
if ($datauser['id'] != $post['id_user']){
echo '<div class="phdr">Lỗi truy cập!</div><div class="rmenu">Đây không phải hero của bạn :)</div>';
require_once('../incfiles/end.php');
exit;
}
if ($post['set'] <10000000){
$class = 'cap'.$post['capset'].'';
} else {
$class = 'trangphuc';
}
if(isset($_GET['trieuhoi'])){

if($type ==0){
echo '<div class="rmenu">Đây không phải thẻ triệu hồi hero</div>';
} else{
echo '<div class="phdr">Triệu hồi hero</div>';
if (isset($_POST['submit'])){
$tke = ($connect->query("SELECT COUNT(*) FROM `tuihero` WHERE  `id_user` = '$user_id'")->fetch_row()[0] ?? 0);
$mo = rand(1,$tke);

$kt = ($connect->query("SELECT COUNT(*) FROM `tuihero` WHERE `id_user` = '$user_id' AND `set` = '".$mo."'")->fetch_row()[0] ?? 0);
if ($kt !=0){
echo'<div class="rmenu">Xin lỗi hệ thống tặng hero trùng với hero bạn đang có! Vui lòng click lại</div>';
} else {
$pos = $connect->fetch_array($connect->query("select * from `shophero` WHERE  `id` = '$mo'  LIMIT 1"));

$connect->query("INSERT INTO `tuihero` (`set` , `capset`, `id_user`, `giamua`, `giaban`, `sucmanh`, `hp`, `mana`, `tc1`, `tc2`, `tc3`, `tc4`, `tc5`, `nameset`) VALUES  ('".$pos['set']."', '".$pos['capset']."', '".$user_id."', '".$pos['giamua']."','".$pos['giaban']."','".$pos['sucmanh']."','".$pos['hp']."','".$pos['mana']."', '".$pos['tc1']."', '".$pos['tc2']."', '".$pos['tc3']."', '".$pos['tc4']."', '".$pos['tc5']."', '".$pos['nameset']."') ");
$connect->query("DELETE FROM `tuihero` WHERE `id` = '$int' LIMIT 1");
echo '<div class="main-xmenu">
<div class="bmenu"><b>Triệu hồi Thành công</b></div>';
echo '<div class="menu list-top"><img class="cap'.$post['capset'].'" src="/heroes/'.$post['set'].'.png" width="100" height="150" /></div>';
echo '<div class="menu list-top"> <font color="gold">Giá: <b>'.$post['giamua'].'</b> Vàng</font></div>';
echo '<div class="menu list-top"> <font color="green">Tăng: <b>'.$post['sucmanh'].'</b> ♦</font></div>';
echo '<div class="menu list-top"> <font color="blue">Tăng: <b>'.$post['mana'].'</b> ♣</font></div>';
echo '<div class="menu list-top"> <font color="red">Tăng: <b>'.$post['hp'].'</b> ♥</font></div>';
echo '<div class="menu list-top"> <font color="gold">Giá bán lại: <b>'.$post['giaban'].'</b> Vàng</font></div>';
}
}
echo '<div class="gmenu">Triệu hồi từ tướng cùi nhất đến tướng huyền thoại!<form method="post"><input type="submit" name="submit" id="submit" value="Triệu hồi"></form></div>';
}
}
if(isset($_GET['trangphuc'])) {
echo '<div class="phdr">Trang phục hero</div>';
if ($post['dg'] ==1){
echo '<div class="rmenu">Hero đang rao bán đấu giá nên không thể thao tác</div>';
} else {
if ($post['setbu'] ==0 AND $post['capset'] ==5){
$connect->query("UPDATE tuihero SET hpbu = '".$post['hp']."', manabu = '".$post['mana']."', setbu = '".$post['set']."', namesetbu = '".$post['nameset']."', sucmanhbu = '".$post['sucmanh']."' WHERE id = '".$post['id']."'");
echo '<div class="bmenu">Backup dữ liệu hero thành công vui lòng tải lại trang.</div>';
}
if ($post['capset'] ==5){
$tong = ($connect->query("SELECT COUNT(*) FROM `trangphuchero` WHERE `id_set` = '".$post['setbu']."'")->fetch_row()[0] ?? 0);
if ($tong==0){
if ($post['setbu'] >0){
echo '<div class="rmenu">Hero của bạn hiện chưa có trang phục</div>';
}
} else {
$all = ($connect->query("SELECT COUNT(*) FROM `trangphucherocuaban` WHERE `id_set` = '".$post['set']."' AND `id_user` = '".$user_id."'")->fetch_row()[0] ?? 0);
if ($all >=1){
echo '<div class="newsx">Bạn sở hữu '.$all.' trang phục của Hero này</div>';
}
$res = $connect->query("SELECT * FROM `trangphucherocuaban` LIMIT $start, $kmess");

$idz = $_POST['idz'];
$pra = $connect->fetch_array($connect->query("SELECT * FROM `trangphucherocuaban` WHERE `id`='{$idz}'"));
if (isset($_POST['ban'])){
if ($post['set'] == $pra['idtp']){
echo '<div class="rmenu">Tháo trang phục ra đã</div>';
} else {
$connect->query("DELETE FROM trangphucherocuaban WHERE id = '{$idz}'");
$connect->query("UPDATE users SET kc = kc + '".$pra['giaban']."' WHERE id = '".$user_id."'");
echo '<div class="bmenu">Bán thành công nhận được <font color="purple"><b>'.$pra['giaban'].'</b> Kim Cương</font></div>';
}
}
if (isset($_POST['mac'])){
if ($post['set'] == $pra['idtp']){
echo '<div class="rmenu">Mặc rồi còn đâu</div>';
} else {
$connect->query("UPDATE `tuihero` SET  `set` = '".$pra['idtp']."', `nameset` = '".$pra['nameset']."' WHERE `id` = '$id'");
$connect->query("UPDATE `tuihero` SET  `sucmanh` = `sucmanh` + '".$pra['sucmanh']."', `hp` = `hp` + '".$pra['hp']."', `mana` = `mana` + '".$pra['mana']."' WHERE `id` = '$id'");
echo '<div class="bmenu">Mặc thành công! Để sử dụng chỉ số mới, vui lòng tháo tướng ra và mặc lại!</div>';
}
}
if (isset($_POST['thao'])){
if ($post['set'] != $pra['idtp']){
echo '<div class="rmenu">Đã mặc đâu mà tháo?</div>';
} else {
if ($post['set'] == $datauser['set'] or $post['set'] == $datauser['set2'] or $post['set'] == $datauser['set3']){
echo '<div class="rmenu">Tháo hero này ra đã</div>';
} else {
$connect->query("UPDATE `tuihero` SET `set` = '".$post['setbu']."', `nameset` = '".$post['namesetbu']."', `hp` = '".$post['hpbu']."', `mana` = '".$post['manabu']."', `sucmanh` = '".$post['sucmanhbu']."' WHERE id = '$id'");
echo '<div class="bmenu">Tháo trang phục hero thành công! Reset hero về bản backup!</div>';
}
}
}
while ($trangphuc = $connect->fetch_array($res)){
echo '<table><tbody><tr><td width="80"><img src="/heroes/'.$trangphuc['idtp'].'.png" width="50" height="50" class="trangphuc"></td><td><b>'.$trangphuc['name'].'</b><br>Tăng: <br><font color=green>'.$trangphuc['sucmanh'].' công</font><br><font color="red">'.$trangphuc['hp'].' máu</font><br><font color=blue>'.$trangphuc['mana'].' mana</font><br>';
echo '<font color="purple">Giá bán: '.$trangphuc['giaban'].' Kim Cương</font><br> <form action="?id='.$post['id'].'&trangphuc" method="post"> <input type="hidden" name="idz" value="'.$trangphuc['id'].'"><input type="submit" name="ban" value="Bán"> ';
if ($post['set'] != $trangphuc['idtp']){
echo '<input type="submit" name="mac" value="Mặc">';
} else {
echo '<input type="submit" name="thao" value="Tháo">';
}
echo '</form></td></tr></tbody></table>';

}
echo '<div class="gmenu"><a href="/vuichoi/shoptrangphuc.php">« Shop trang phục</a></div>';
}
} else {
echo '<div class="rmenu">Hero đạt cấp 5 mới mở khóa trang phục</div>';
}
}
}
if(isset($_GET['rights'])){
if(isset($_POST['rights'])){$rights=$_POST['rights']; $connect->query("UPDATE users SET rights = $rights WHERE id =$user_id");}
}
if(isset($_GET['thao'])) {
if ($post['dg'] ==1){
echo '<div class="rmenu">Đồ đang bị đấu giá không thể thao tác</div>';
} else {
echo '<div class="bmenu">Chọn vị trí hero:<br><form method="post" action="?id='.$post['id'].'&thao"><input type="radio" value="1" name="mac"> POWER: <b>'.$datauser['nameset'].'</b> <font color=green>[Chủ lực]</font><br><input type="radio"  value="2" name="mac"> SUPPORT: <b>'.$datauser['nameset2'].'</b> [Hỗ trợ]<br><input type="radio" value="3" name="mac"> TANK: <b>'.$datauser['nameset3'].'</b> [Chắn đòn]<br><input type="submit" name="submit" value="Tháo"></form></div>';
if (isset($_POST['submit'])){
$mac = $_POST['mac'];
If ($post['set'] >100000000){
$str = $post['set'];
$cat = substr($str,-9,2);
}
If ($post['set'] >10000000 and $post['set'] < 100000000){
$str = $post['set'];
$cat = substr($str,-8,2);
}
If ($post['set'] < 1000000){
$cat = $post['set'];
}
$hpbu = $post['hpbu'];
$manabu = $post['manabu'];
if ($mac ==1){
if($datauser['set'] ==0){
echo '<div class="rmenu">Đã mặc đâu mà tháo</div>';
} else {
if ($datauser['set'] != $post['set'] and $datauser['set'] != $cat){
echo '<div class="rmenu">Vào hero đang mặc mới tháo được '.$cat.'</div>';
}
if ($datauser['set'] == $post['set'] or $datauser['set'] == $cat){
if ($datauser['set'] == $post['set']){
$connect->query("UPDATE `users` SET `set` = 0  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `capset` = 1  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allhp` = '120'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `edithp` = `edithp` - $hp  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allmana` = '100'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `editmana` = `editmana` - $mana  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `cong` = '15'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allcong` = '15'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `tc1` = 'TUYỆT CHIÊU 1'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc2` = 'TUYỆT CHIÊU 2'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc3` = 'TUYỆT CHIÊU 3'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc4` = 'TUYỆT CHIÊU 4'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc5` = 'UNTILMATE'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `nameset` = 'Không tên'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Tháo thành công</b></div>';
} else {
$connect->query("UPDATE `users` SET `set` = 0  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `capset` = 1  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allhp` = '120'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `edithp` = `edithp` - $hpbu  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allmana` = '100'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `editmana` = `editmana` - $manabu  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `cong` = '15'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allcong` = '15'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `tc1` = 'TUYỆT CHIÊU 1'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc2` = 'TUYỆT CHIÊU 2'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc3` = 'TUYỆT CHIÊU 3'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc4` = 'TUYỆT CHIÊU 4'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc5` = 'UNTILMATE'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `nameset` = 'Không tên'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Tháo thành công</b></div>';
}
}
}
}
if ($mac ==2){
if($datauser['set2'] ==0){
echo '<div class="rmenu">Đã mặc đâu mà tháo</div>';
} else {
if ($datauser['set2'] != $post['set'] and $datauser['set2'] != $cat){
echo '<div class="rmenu">Vào hero đang mặc mới tháo được</div>';
}
if ($datauser['set2'] == $post['set'] or $datauser['set2'] == $cat){
if ($datauser['set2'] == $post['set']){
$connect->query("UPDATE `users` SET `set2` = 0  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `capset2` = 1  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allhp2` = '120'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `edithp2` = `edithp2` - $hp  WHERE `id` = $user_id LIMIT 1");

$connect->query("UPDATE `users` SET `cong2` = '15'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allcong2` = '15' WHERE `id` = $user_id LIMIT 1");

$connect->query("UPDATE `users` SET `nameset2` = 'Không tên'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Tháo thành công</b></div>';
} else {
$connect->query("UPDATE `users` SET `allhp2` = '120'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `edithp2` = `edithp2` - $hpbu  WHERE `id` = $user_id LIMIT 1");

$connect->query("UPDATE `users` SET `cong2` = '15'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allcong2` = '15' WHERE `id` = $user_id LIMIT 1");

$connect->query("UPDATE `users` SET `nameset2` = 'Không tên'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Tháo thành công</b></div>';
}
}
}
}
if ($mac ==3){
if($datauser['set3'] ==0){
echo '<div class="rmenu">Đã mặc đâu mà tháo</div>';
} else {
if ($datauser['set3'] != $post['set'] and $datauser['set3'] != $cat){
echo '<div class="rmenu">Vào hero đang mặc mới tháo được</div>';
}
if ($datauser['set3'] == $post['set'] or $datauser['set3'] == $cat){
if ($datauser['set3'] == $post['set']){
$connect->query("UPDATE `users` SET `set3` = 0  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `capset3` = 1  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allhp3` = '120'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `edithp3` = `edithp3` - $hp  WHERE `id` = $user_id LIMIT 1");

$connect->query("UPDATE `users` SET `cong3` = '15'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allcong3` = '15' WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `nameset3` = 'Không tên'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Tháo thành công</b></div>';
} else {
$connect->query("UPDATE `users` SET `set3` = 0  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `capset3` = 1  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allhp3` = `allhp3` - $hpbu  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `edithp3` = `edithp3` - $hpbu  WHERE `id` = $user_id LIMIT 1");

$connect->query("UPDATE `users` SET `cong3` = '15'  WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `allcong3` = '15' WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `nameset3` = 'Không tên'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Tháo thành công</b></div>';
}
}
}
}

}
}
//header('Location: ruong.php');
}
if(isset($_GET['daugia'])) {
echo '<div class="phdr">Đấu giá</div>';
if($post['dg'] ==1){
echo '<div class="rmenu">Chắc chắn hủy đấu giá? Phí: <font color="purple">1 D</font> <form action="?id='.$post['id'].'&daugia" method="post"><input type="submit" name="submit" value="Hủy đấu giá"></form></div>';
if (isset($_POST['submit'])){
if ($datauser['kc'] <1){
echo '<div class="rmenu">Không đủ kim cương để trả phí (1)</div>';
} else {
$connect->query("UPDATE `users` SET `kc` = `kc` - 1 WHERE `id` = $user_id LIMIT 1");
$iddg = $post['id'];
$connect->query("UPDATE `tuihero` SET `dg` = 0  WHERE `id` = $iddg LIMIT 1");
$connect->query("DELETE FROM `daugia` WHERE `iddg` = $iddg LIMIT 1");
echo '<div class="bmenu">Hủy đấu giá thành công</div>';
}
}
} else {
if(isset($_POST['submit'])) {
$mk = $_POST['mk'];
if ($mk != $datauser['macap2']){
echo '<div class="rmenu">Mã cấp 2 sai</div>';
} else {
if($datauser['set'] == $post['set'] or $datauser['set2'] == $post['set'] or $datauser['set3'] == $post['set']){
Echo '<div class="rmenu">Tháo đồ ra trước</div>';
} else {
if ($datauser['kc'] <1){
echo '<div class="rmenu">Không đủ kim cương để trả phí (1)</div>';
} else {
$giabanz = $_POST['giabanz'];
if($giabanz <1000) {
echo '<div class="rmenu">Không hợp lệ hoặc giá dưới 1000 VNĐ</div>';
} else {
if ($post['set'] >10000000){
echo '<div class="rmenu">Đấu giá hero chứ không đấu giá trang phục của nó! Vui lòng tháo trang phục ra để tiếp tục thao tác</div>';
} else {
$connect->query("UPDATE `users` SET `kc` = `kc` - 1 WHERE `id` = $user_id LIMIT 1");
$connect->query("INSERT INTO `daugia` (`set` , `capset`, `user_id`, `giamua`, `giaban`, `sucmanh`, `hp`, `mana`, `tc1`, `tc2`, `tc3`, `tc4`, `tc5`, `nameset`, `giaban2`, `iddg`) VALUES  ('".$post['set']."', '".$post['capset']."', '".$user_id."', '".$post['giamua']."','".$post['giaban']."','".$post['sucmanh']."','".$post['hp']."','".$post['mana']."', '".$post['tc1']."', '".$post['tc2']."', '".$post['tc3']."', '".$post['tc4']."', '".$post['tc5']."', '".$post['nameset']."', '".$giabanz."', '".$post['id']."') ");
$postid = $post['id'];
$connect->query("UPDATE `tuihero` SET `dg` = 1  WHERE `id` = $postid LIMIT 1");
echo '<div class="rmenu"><font color="green">Đấu giá thành công</font> <b>'.$names.'</b> với giá: <font color="green">'.$giabanz.' VNĐ</font>!!!</div>';
}
}
}
}
}
}
echo '<div class="rmenu"><form method="post" action="?id='.$post['id'].'&daugia">Nhập giá bán (vnd)<br><input type="text" name="giabanz" value="0"><br>Mã cấp 2 (mặc định:0):<br><input type="password" name="mk" value="0"><br> <input type="submit" name="submit" value="Đấu giá"></form>Phí: <font color="purple">1 D</font>/1 lần</div>';
}
//header('Location: ruong.php');
}
if(isset($_GET['ban'])) {
echo '<div class="phdr">Bán hero</div>';
if ($post['dg'] ==1){
echo '<div class="rmenu">Đồ đang bị đấu giá không thể thao tác</div>';
} else {
if (isset($_POST['ban'])){
$mk = $_POST['mk'];
if($mk != $datauser['macap2']){
echo '<div class="rmenu">Mã cấp 2 sai!</div>';
} else{
if($datauser['set'] == $post['set'] or $datauser['set2'] == $post['set'] or $datauser['set3'] == $post['set']){
echo '<div class="rmenu">Vui lòng heroes ra trước khi có ý định bán một hero nào đó</div>';
} else {
$vnd = $post['giaban'];
$connect->query("UPDATE `users` SET `balans` = `balans` + $vnd WHERE `id` = $user_id LIMIT 1");

$connect->query("DELETE FROM `tuihero` WHERE `id` = $_GET[id] ");
echo "<div class='bmenu'><b>Bán Thành Công nhận được <b>".$vnd."</b> G</div>";
}
}
}
echo '<div class="rmenu"><form method="post">Nhập mã cấp 2 (mặc định: 0):<br><input type="password" name="mk" value="0"><br><input type="submit" name="ban" value="Xác nhận bán"></form></div>';
}
//header('Location: ruong.php');
}
if(isset($_GET['mac'])) {
echo '<div class="phdr">Trang bị hero</div>';
if($post['dg'] ==1){
echo '<div class="rmenu">Đồ đang bị đấu giá không thể thao tác</div>';
} else {
echo '<div class="bmenu">Chọn vị trí hero:<br><form method="post" action="?id='.$post['id'].'&mac"><input type="radio" value="1" name="mac"> POWER: <b>'.$datauser['nameset'].'</b> <font color=green>[Chủ lực]</font><br><input type="radio"  value="2" name="mac"> SUPPORT: <b>'.$datauser['nameset2'].'</b> [Hỗ trợ]<br><input type="radio" value="3" name="mac"> TANK: <b>'.$datauser['nameset3'].'</b> [Chắn đòn]<br><input type="submit" name="submit" value="Mặc"></form></div>';
if (isset($_POST['submit'])){
$mac = $_POST['mac'];
if ($mac ==1){
if ($datauser['set'] ==0) {
if ($datauser['set2'] == $post['set'] or $datauser['set3'] == $post['set']){
echo '<div class="rmenu">Mỗi tướng chỉ được ở 1 vị trí</div>';
} else {
$connect->query("UPDATE `users` SET `set` = $sethr  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `capset` = $cap  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `allhp` = `allhp` + $hp  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `edithp` = `edithp` + $hp  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `allmana` = `allmana` + $mana  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `editmana` = `editmana` + $mana  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `cong` = `cong` + $sucmanh  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `allcong` = `allcong` + $sucmanh  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc1` = '$tc1'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc2` = '$tc2'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc3` = '$tc3'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc4` = '$tc4'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `tc5` = '$tc5'  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `nameset` = '$names'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Trang bị thành công</b></div>';
}
} if($datauser['set'] >0){
echo '<div class="menu list-top"><b>Bỏ hero bạn đang dùng ra trước!</b></div>';
}
}
if ($mac ==2){
if ($datauser['set2'] ==0) {
if ($datauser['set'] == $post['set'] or $datauser['set3'] == $post['set']){
echo '<div class="rmenu">Mỗi tướng chỉ được ở 1 vị trí</div>';
} else {
$connect->query("UPDATE `users` SET `set2` = $sethr  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `capset2` = $cap  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `allhp2` = `allhp2` + $hp  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `edithp2` = `edithp2` + $hp  WHERE `id` = $user_id");

$connect->query("UPDATE `users` SET `cong2` = `cong2` + $sucmanh  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `allcong2` = `allcong2` + $sucmanh  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `nameset2` = '$names'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Trang bị thành công</b></div>';
}
} if($datauser['set2'] >0){
echo '<div class="menu list-top"><b>Bỏ hero bạn đang dùng ra trước!</b></div>';
}
}
if ($mac ==3){
if ($datauser['set3'] ==0) {
if ($datauser['set2'] == $post['set'] or $datauser['set'] == $post['set']){
echo '<div class="rmenu">Mỗi tướng chỉ được ở 1 vị trí</div>';
} else {
$connect->query("UPDATE `users` SET `set3` = $sethr  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `capset3` = $cap  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `allhp3` = `allhp3` + $hp  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `edithp3` = `edithp3` + $hp  WHERE `id` = $user_id");

$connect->query("UPDATE `users` SET `cong3` = `cong3` + $sucmanh  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `allcong3` = `allcong3` + $sucmanh  WHERE `id` = $user_id");
$connect->query("UPDATE `users` SET `nameset3` = '$names'  WHERE `id` = $user_id");
echo '<div class="menu list-top"><b>Trang bị thành công</b></div>';
}
} if($datauser['set3'] >0){
echo '<div class="menu list-top"><b>Bỏ hero bạn đang dùng ra trước!</b></div>';
}
}

}
}
}

if(isset($_GET['nangcap'])) {
echo '<div class="phdr">Nâng cấp hero</div><div class="gmenu"><small><center><table><tbody><tr><td><img class="cap3" src="img/shop/thanhcong.png" alt="Cẩn thận:"> <b>'.$datauser['tangthanhcong'].'</b></td><td><img class="cap4" src="img/shop/thanhcong.png" alt="Khéo léo:"> <b>'.$datauser['tangthanhcong2'].'</b></td><td><img class="cap5" src="img/shop/thanhcong.png" alt="Tinh tế:"> <b>'.$datauser['tangthanhcong3'].'</b></td></tr></tbody></table></center></div>';
echo '<div class="newsx">Sau khi nâng cấp thành công, để sử dụng chỉ số mới vui lòng tháo hero ra và mặc lại (nếu bạn đang mặc)! <form method="post" action="?id='.$post['id'].'&nangcap"><select name="tangthanhcong"><option value="0">Thường</option><option value="1">Cẩn thận</option><option value="2">Khéo léo</option><option value="3">Tinh tế</option></select>';
echo '<input type="submit" name="submit" value="Nâng cấp" id="submit"> [<font color="gold">-'.intval($post['giamua']*3).' vàng</font>] </form></div>';
if (isset($_POST['submit'])){
$tangthanhcong = $_POST['tangthanhcong'];
if ($post['dg'] ==1){
echo '<div class="rmenu">Đồ đang bị đấu giá không thể thao tác</div>';
} else {
$newm=$tienm*3;
if ($post['capset'] >=5){
echo '<div class="rmenu">Hero đã đạt cấp TÍM (tối đa)</div>';
}
if ($datauser['balans'] >= $newm && $post['capset'] < 5) {
if ($tangthanhcong ==0){
$connect->query("UPDATE `users` SET `balans` = `balans`- $newm WHERE `id` = $user_id LIMIT 1");
}
if ($tangthanhcong ==1){
if ($datauser['tangthanhcong'] >=1){
$connect->query("UPDATE `users` SET `tangthanhcong` = `tangthanhcong`- 1 WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `balans` = `balans`- $newm WHERE `id` = $user_id LIMIT 1");
} else {
echo '<div class="rmenu">Không đủ nhé bạn</div>';
require_once('../incfiles/end.php');
exit;
}
}
if ($tangthanhcong ==2){
if ($datauser['tangthanhcong2'] >=1){
$connect->query("UPDATE `users` SET `tangthanhcong2` = `tangthanhcong2`- 1 WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `balans` = `balans`- $newm WHERE `id` = $user_id LIMIT 1");
} else {
echo '<div class="rmenu">Không đủ nhé bạn</div>';
require_once('../incfiles/end.php');
exit;
}
}
if ($tangthanhcong ==3){
if ($datauser['tangthanhcong3'] >=1){
$connect->query("UPDATE `users` SET `tangthanhcong3` = `tangthanhcong3`- 1 WHERE `id` = $user_id LIMIT 1");
$connect->query("UPDATE `users` SET `balans` = `balans`- $newm WHERE `id` = $user_id LIMIT 1");
} else {
echo '<div class="rmenu">Không đủ nhé bạn</div>';
require_once('../incfiles/end.php');
exit;
}
}
if($cap ==1){
if ($tangthanhcong ==0){
$tc = rand(1,7);
}
if ($tangthanhcong ==1){
$tc = rand(1,5);
}
if ($tangthanhcong ==2){
$tc = rand(1,3);
}
if ($tangthanhcong ==3){
$tc = 3;
}
if($tc ==3){
$connect->query("UPDATE `tuihero` SET `sucmanh` = `sucmanh` +  $addsm  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `mana` = `mana` +  $addmn  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `hp` = `hp` +  $addhp  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `capset` = `capset` +  1  WHERE `id` = '$id' LIMIT 1");

echo '<div class="menu list-top"><b>Nâng cấp Thành Công</b><br/>Hero được cộng thêm <b><font color="green">'.$addsm.'</b> ♦</font>/<font color="blue"><b>'.$addmn.'</b> ♣</font>/<b><font color="red">'.$addhp.'</b> ♥</font> </div>';
} else {
echo '<div class="rmenu">Nâng cấp thất bại</div>';
}
} if($cap ==2){
if ($tangtancong ==0){
$tc = rand(1,7);
}
if ($tangtancong ==1){
$tc = rand(1,5);
}
if ($tangtancong ==2){
$tc = rand(1,3);
}
if ($tangtancong ==3){
$tc = rand(2,3);
}
if($tc ==3){
$connect->query("UPDATE `tuihero` SET `sucmanh` = `sucmanh` +  $addsm  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `mana` = `mana` +  $addmn  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `hp` = `hp` +  $addhp  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `capset` = `capset` +  1  WHERE `id` = '$id' LIMIT 1");
echo '<div class="menu list-top"><b>Nâng cấp Thành Công</b><br/>Hero được cộng thêm <b><font color="green">'.$addsm.'</b> ♦</font>/<font color="blue"><b>'.$addmn.'</b> ♣</font>/<b><font color="red">'.$addhp.'</b> ♥</font></div>';
} else {
echo '<div class="rmenu">Nâng cấp thất bại</div>';
}
} if($cap ==3){
if ($tangtancong ==0){
$tc = rand(1,11);
}
if ($tangtancong ==1){
$tc = rand(1,8);
}
if ($tangtancong ==2){
$tc = rand(1,5);
}
if ($tangtancong ==3){
$tc = rand(2,4);
}
if($tc ==3){
$connect->query("UPDATE `tuihero` SET `sucmanh` = `sucmanh` +  $addsm  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `mana` = `mana` +  $addmn  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `hp` = `hp` +  $addhp  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `capset` = `capset` +  1  WHERE `id` = '$id' LIMIT 1");
echo '<div class="menu list-top"><b>Nâng cấp Thành Công</b><br/>Hero được cộng thêm <b><font color="green">'.$addsm.'</b> ♦</font>/<font color="blue"><b>'.$addmn.'</b> ♣</font>/<b><font color="red">'.$addhp.'</b> ♥</font></div>';
} else {
echo '<div class="rmenu">Nâng cấp thất bại </div>';
}
} if($cap ==4){
if($tangtancong ==0){
$tc = rand(1,15);
}
if ($tangtancong ==1){
$tc = rand(1,12);
}
if ($tangtancong ==2){
$tc = rand(1,8);
}
if ($tangtancong ==3){
$tc = rand(1,5);
}
if($tc ==3){
$connect->query("UPDATE `tuihero` SET `sucmanh` = `sucmanh` +  $addsm  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `mana` = `mana` +  $addmn  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `hp` = `hp` +  $addhp  WHERE `id` = '$id' LIMIT 1");
$connect->query("UPDATE `tuihero` SET `capset` = `capset` +  1  WHERE `id` = '$id' LIMIT 1");
echo '<div class="menu list-top"><b>Nâng cấp Thành Công</b><br/>Hero được cộng thêm <b><font color="green">'.$addsm.'</b> ♦</font>/<font color="blue"><b>'.$addmn.'</b> ♣</font>/<b><font color="red">'.$addhp.'</b> ♥</font></div>';
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`timetg` = '".$time."',
`show` = '1',
`time` = '" . time() . "',
`user_id` = '2',
`text` = '".$datauser['name']." nâng cấp thành công ".$post['nameset']." lên +5 lực chiến nâng lên tầm cao mới',
`ip` = '" . core::$ip . "'
");
} else {
echo '<div class="rmenu">Nâng cấp thất bại!</div>';
}
}
} else {
if ($post['capset'] <5){
echo '<div class="rmenu">Không đủ tiền!</div>';
}
}
}
}
//header('Location: ruong.php');
}
echo '<div class="main-xmenu"><div class="phdr"><b>Túi Hero</b></div>';
echo '<div class="menu list-top">
<table>
<tbody><tr><td width="75">
<img class="'.$class.'" src="/heroes/'.$post['set'].'.png" width="100" height="150" />
</td><td width="auto" valign="top">';
echo ' <b><font color="gold">Giá tiền: '.$post['giamua'].'</b> Vàng</font><br/>';
echo ' Chỉ số: <font color="green"><b>'.$post['sucmanh'].'</b> SM</font>/<font color="blue"><b>'.$post['mana'].'</b> MP</font>/<font color="red"><b>'.$post['hp'].'</b> HP</font><br/>';
echo ' <font color="gold">Giá bán: <b>'.$post['giaban'].'</b> Vàng</font><br> '.$post['nameset'].'';
echo ' (<font color="red">+'.$post['capset'].'</font>)<br>
</td></tr></tbody></table></div>';

echo '<div class="menu list-top">';
if($type==0){
echo '<a href="?id='.$post['id'].'&amp;ban">Bán</a> | ';
echo '<a href="?id='.$post['id'].'&amp;mac">Mặc</a>';
echo '/<a href="?id='.$post['id'].'&amp;thao">Tháo</a>';
echo ' | <a href="?id='.$post['id'].'&amp;nangcap">Nâng cấp</a></div>';
if ($post['dg'] ==0){
echo '<div class="newsx">[<a href="?id='.$post['id'].'&daugia">Đấu giá</a>][<a href="?id='.$post['id'].'&trangphuc">Trang phục</a>]</div>';
} else {
echo '<div class="newsx">[<a href="?id='.$post['id'].'&daugia">Hủy đấu giá</a>][<a href="?id='.$post['id'].'&trangphuc">Trang phục</a>] </div>';
}
} else {
echo '<a href="?id='.$post['id'].'&trieuhoi">Mở thẻ</a></div>';
}
}else{
$k=($connect->query("SELECT COUNT(*) FROM `tuihero` WHERE `id_user` = '$user_id'")->fetch_row()[0] ?? 0);
echo "<div class='main-xmenu'><div class='phdr'><b>Túi hero</b></div>";
if($k==0){
echo '<div class="newsx">Bạn chưa có hero nào cả! Bạn có thể mua tại:<br><a href="shophero.php">Shop</a> - Với giá từ 500 vàng<br><a href="daugia.php">Chợ đen</a> - Nếu bạn có đủ VNĐ</div>';
}
$tong = ($connect->query("SELECT COUNT(*) FROM `tuihero` WHERE  `id_user` = '$user_id'")->fetch_row()[0] ?? 0);

$res = $connect->query("select * from `tuihero` WHERE `id_user` = '$user_id' LIMIT $start, $kmess;");
echo '<div class="menu">Bạn đang có <b>'.$tong.'</b> Hero !</div>';
while ($post = $connect->fetch_array($res)){
$sm= 'Tăng: <b>'.$post['sucmanh'].'</b> SM';
$gia = 'Giá trị: <b>'.$post['giaban'].'</b> Vàng';
if ($post['set'] <10000000){
$class = 'cap'.$post['capset'].'';
} else {
$class = 'trangphuc';
}
echo '<div class="menu list-top">
<table>
<tbody><tr><td width="80">
<img class="'.$class.'" src="/heroes/'.$post['set'].'';
echo '.png" width="150" height="200"/>
</td><td width="auto" valign="center">
<a href="ruong.php?id='.$post['id'].'">[Thao tác]</a><br/><b>'.$post['nameset'].'</b>';
echo ' (<font color="red">+'.$post['capset'].'</font>)<br>
<font color="green">'.$sm.'</font><br/>
<font color="gold">'.$gia.'</font><br/>
<font color="red">Tăng: <b>'.$post['hp'].'</b> HP</font><br/>
<font color="blue">Tăng: <b>'.$post['mana'].'</b> MP</font>
</td></tr></tbody></table>
</div>';
}
if ($tong > $kmess) {
echo '<div class="main-xmenu">' . functions::display_pagination('ruong.php?', $start, $tong, $kmess) . '</div>';
}

}

if ($tong1 > $kmess) {
echo '<div class="main-xmenu">' . functions::display_pagination('ruong.php?', $start, $tong1, $kmess) . '</div>';
}

echo "<div class='menu list-top'>";
if(isset($_GET['id']))
echo "<a href='ruong.php'>« Kho đồ »</a>";

else
echo "<a href='shophero.php'>« Shop</a>";
echo "</div></div>";
echo '</div>';
require('../incfiles/end.php');
?>
