<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Hệ thống';
$tab = 'vui';
require('../incfiles/head.php');
if($user_id){
?>
<?
if ($datauser['rights'] ==9){
switch($act){
default:
echo '<div class="phdr">SLV PANEL MORE</div><div class="menu"><a href="?act=shop">Thêm heroes vào shop</a></div><div class="menu"><a href="?act=boss">Thêm Boss</a></div><div class="menu"><a href="?act=wear">Thêm trang phục</a></div><div class="menu"><a href="?act=phuchoi">Phục hồi máy</a></div><div class="menu"><a href="?act=world">Thêm Đất nước</a></div>';
break;
case 'shop':
if (isset($_POST['submit'])){
$set = $_POST['set'];
$nameset = $_POST['nameset'];
$cong = $_POST['cong'];
$hp = $_POST['hp'];
$mn = $_POST['mn'];
$tc1 = $_POST['tc1'];
$tc2 = $_POST['tc2'];
$tc3 = $_POST['tc3'];
$tc4 = $_POST['tc4'];
$tc5 = $_POST['tc5'];
$giamua = $_POST['giamua'];
$giaban = $giamua/2;
$connect->query("INSERT INTO `shophero` (`set` , `capset`, `giamua`, `giaban`, `sucmanh`, `hp`, `mana`, `tc1`, `tc2`, `tc3`, `tc4`, `tc5`, `nameset`) VALUES  ('".$set."', '1', '".$giamua."', '".$giaban."','".$cong."','".$hp."','".$mn."', '".$tc1."', '".$tc2."', '".$tc3."', '".$tc4."', '".$tc5."', '".$nameset."') ");
echo '<div class="rmenu"><center>[OK]</center></div>';
} 
echo '<div class="menu"><form method="post" action="hethong.php?act=shop">
<input type="text" name="set" value="SET">
<input type="text" name="nameset" value="NAME SET">
<input type="text" name="cong" value="Công">
<input type="text" name="hp" value="HP">
<input type="text" name="mn" value="Mana">
<input type="text" name="giamua" value="$">
<input type="text" name="tc1" value="TC1">
<input type="text" name="tc2" value="TC2">
<input type="text" name="tc3" value="TC3">
<input type="text" name="tc4" value="TC4">
<input type="text" name="tc5" value="TC5"><br>
<input type="submit" name="submit" value="Tạo">';
break;
case 'boss':
if (isset($_POST['submit'])){
$set = $_POST['set'];
$nameset = $_POST['nameset'];
$cong = $_POST['cong'];
$hp = $_POST['hp'];
$tc1 = $_POST['tc1'];
$tc2 = $_POST['tc2'];
$tc3 = $_POST['tc3'];
$tc4 = $_POST['tc4'];
$tc5 = $_POST['tc5'];
$balans = $_POST['balans'];
$kc = $_POST['kc'];
$linh = $_POST['linh'];
$linhok = $linh*1000;
$connect->query("INSERT INTO `aivienchinh` (`set` , `capset`, `balans`, `linh`, `alllinh`, `kc`, `cong`, `allcong`, `edithp`, `allhp`, `tc1`, `tc2`, `tc3`, `tc4`, `tc5`, `nameset`) VALUES  ('".$set."', '5', '".$balans."', '".$linhok."', '".$linhok."', '".$kc."', '".$cong."', '".$cong."', '".$hp."', '".$hp."', '".$tc1."', '".$tc2."', '".$tc3."', '".$tc4."', '".$tc5."', '".$nameset."') ");
echo '<div class="rmenu"><center>[OK]</center></div>';
} 
echo '<div class="menu"><form method="post" action="hethong.php?act=boss">
<input type="text" name="set" value="SET">
<input type="text" name="nameset" value="NAME SET">
<input type="text" name="cong" value="Công">
<input type="text" name="hp" value="HP">
<input type="text" name="linh" value="Lính">
<input type="text" name="kc" value="KC">
<input type="text" name="balans" value="$">
<input type="text" name="tc1" value="TC1">
<input type="text" name="tc2" value="TC2">
<input type="text" name="tc3" value="TC3">
<input type="text" name="tc4" value="TC4">
<input type="text" name="tc5" value="TC5"><br>
<input type="submit" name="submit" value="Tạo">';
break;
case 'wear':
if(isset($_POST['submit'])){
$id_set = $_POST['id_set'];
$sucmanh = $_POST['sucmanh'];
$hp = $_POST['hp'];
$mana = $_POST['mana'];
$nameset = $_POST['nameset'];
$giamua = $_POST['giamua'];
$giaban = $giamua/2;
$stt = $_POST['stt'];
$idtp = ''.$id_set.'332000'.$stt.'';
$connect->query("INSERT INTO trangphuchero (id_set, sucmanh, hp, mana, nameset, giamua, giaban, idtp) VALUES ('$id_set', '$sucmanh', '$hp', '$mana', '$nameset', '$giamua', '$giaban', '$idtp') ");
echo '<div class="bmenu">Oke</div>';
}
echo '<form method="post"><input type="text" name="id_set" value="id set"><br><input type="text" name="sucmanh" value="SM"><input type="text" name="hp" value="hp"><br><input type="text" name="mana" value="Mana"><br><input type="text" name="giamua" value="giá mua"><br><input type="text" name="stt" value="stt"><br><input type="text" name="nameset" value="Tên"><br><input type="submit" name="submit" value="Tạo"></form>';
break;
   case 'phuchoi':
$connect->query("UPDATE users SET edithp = allhp, editmana = allmana WHERE rights = 5");
echo '<div class="bmenu">Ok</div>';
break;
case 'world':
if(isset($_POST['submit'])){
$danso = $_POST['danso'];
$odat = $_POST['odat'];
$giamua = $_POST['giamua'];
$connect->query("INSERT INTO shopcm (danso, odat, giamua) VALUES ('$danso', '$odat', '$giamua') ");
echo '<div class="bmenu">Ok</div>';
}
echo '<form method="post"><input type="text" name="danso" value="dân số"><br><input type="text" value="tên" name="odat"><br><input type="text" name="giamua" value="giá"><br><input type="submit" name="submit" value="Tạo"></form>';
break;
}
} else {
echo '<div class="rmenu">Bạn không có quyền</div>';
}

}else{
msg('Vui lòng đăng nhập!');
}
require('../incfiles/end.php');
?>