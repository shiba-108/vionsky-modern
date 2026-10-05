<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$tab = 'vui';
$textl = 'One Piece';
require_once('../incfiles/head.php');
if (!$user_id) {
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
echo '<div class="mainblok">';
switch($act) {
default:
echo '<div class="phdr"><b>Kho báu đại dương</b></div>';
$ma = functions::checkout($_POST['ma']);
$req = $connect->query("SELECT * FROM `magift` WHERE `ma`='".$ma."'");
$dem = $connect->query("SELECT * FROM ...")$req);
$res = $connect->fetch_array($req);
echo '<div class="list1">';

if(isset($_POST['submit'])) {
if($datauser['code'] ==2){
echo '<div class="rmenu">Code chỉ sử dụng được 1 lần/1 tài khoản</div>';
}
if($datauser['code'] <2){
if(empty($ma)) {
echo '<center><font color="red"><b>Bạn chưa nhập mã vào ô!</b></font></center>';
} else if($dem == 0) {
echo '<center><font color="red"><b>Mã gift không tồn tại hoặc đã được sử dụng!</b></font></center>';
} else {
if($res['balans'] != 0) {
$connect->query("UPDATE `users` SET `balans`=`balans` + '".$res['balans']."' WHERE `id`='".$user_id."'");
}
if($res['vnd'] != 0) {
$connect->query("UPDATE `users` SET `vnd`=`vnd`+'".$res['vnd']."' WHERE `id`='".$user_id."'");
}

if($res['kc'] != 0) {
$connect->query("UPDATE `users` SET `kc`=`kc`+'".$res['kc']."' WHERE `id`='".$user_id."'");
}
$connect->query("UPDATE `users` SET `code`=`code`+'1' WHERE `id`='".$user_id."'");

echo '<div class="rmenu"><b>Nhận thưởng thành công!</b><br>' . 'Với mã gift này bạn đã nhận được <b><font color="gold">'.$res['balans'].'</b> G</font>, <b><font color="green">'.$res['vnd'].'</b> V</font> và <b><font color=purple>'.$res['kc'].'</b> D</font></div>';
}
$connect->query("DELETE FROM `magift` WHERE `ma`='".$ma."'");
}
}
echo '<form action="code.php" method="post"><input type="text" name="ma"  maxlength="8" size="10"> <input type="submit" name="submit" value="Mở"/></form>';echo '</div>';
Echo '<div class="phdr">Món quà mẹ biển</div><div class="gmenu"><a href="code.php?act=get">Tân thủ</a></div>';
if($datauser['rights'] == 9) {
echo '<div class="phdr"><b>Quản lí</b></div><div class="gmenu"><a href="code.php?act=add">Thêm mã gift</a><br><a href="code.php?act=panel">Quản lí mã gift</a></div>';
}
break;
case 'add':
echo '<div class="phdr"><b>Thêm mã gift</b></div>';
if($datauser['rights'] < 9) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('../incfiles/end.php');
exit;
}
//random ma gift
 function rand_string($length) {
$chars ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen($char);
for($i = 0; $i<$length; $i++) {
$str .= $chars[rand(0, $size -1)];
$str=substr(str_shuffle($chars), 0, $length);
}
return$str;
}
$random = rand_string(8);
////
$ktm = ($connect->query("SELECT COUNT(`ma`) FROM `magift` WHERE `ma`='".$random."'")->fetch_row()[0] ?? 0);
echo '<div class="list1">';
$balans = (int)$_POST['balans'];
$vnd = (int)$_POST['vnd'];
$kc = (int)$_POST['kc'];
if(isset($_POST['submit'])) {
if(empty($balans) && empty($vnd)) {
echo '<center><font color="red"><b>Bạn đã để trống cả 2 ô!</b></font></center>';
} else if($ktm != 0) {
echo '<div class="rmenu"><b>Dường như mã gift đã tồn tại vì hệ thống đã random trùng. Tỉ lệ này rất hiếm. Vui lòng làm lại!</b></div>';
} else {
$connect->query("INSERT INTO `magift` SET `user`='".$user_id."', `ma`='".$random."',
`time`='".time()."',`balans`='".$balans."', `kc`='".$kc."', `vnd`='".$vnd."'");
echo '<div class="rmenu"><b>Tạo mã gift thành công!</b><br>Mã:<b> '.$random.'</b><br>Bạn có thể quản lí<a href="code.php?act=panel"> ở đây</a>!</div>';
}
}
echo '<form action="code.php?act=add" method="post">Giá trị phần quà (Xu):<br><input type="text" name="balans" value="'.$_POST['balans'].'"/><br>Giá trị phần quà (VNĐ):<br><input type="text" name="vnd" value="'.$_POST['vnd'].'"/><br> <br>Giá trị phần quà (KC):<br><input type="text" name="kc" value="'.$_POST['kc'].'"/><br> <input type="submit" name="submit" value="Lưu"/></form>';
echo '<font color="red">Lưu ý:</font>Giá trị phần quà có thể là Xu hoặc VNĐ hay cả 2. Đối với phần quà có giá trị là VNĐ hoặc Xu thì ô còn lại hãy điền số 0 hoặc để trống.<br>-Mã gift sẽ được hệ thống random 8 kí tự ngẫu nhiên với giá trị mà bạn đã đặt và bạn hãy copy để sử dụng hay quản lí tại phần quản lí. Việc cuối cùng là sử dụng đúng mục đích!';
echo '</div>';
break;
case'panel':
echo '<div class="phdr"><b>Quản lí</b></div>';
if($datauser['rights'] < 9) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('../incfiles/end.php');
exit;
}
$tong = ($connect->query("SELECT COUNT(*) FROM `magift`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `magift` ORDER BY `time` ASC
LIMIT $start, $kmess");
$i = 1;
while ($res = $connect->fetch_array($req)) {
$name = $connect->fetch_array($connect->query("SELECT `name` FROM `users` WHERE `id`='".$res['user']."'"));

echo '<div class="gmenu"><b>#'.$i.'</b> - <a href="/users/profile.php?user='.$res['user'].'"><b>'.$name['name'].'</b></a> ('.functions::display_date($res['time']).')</div>';
echo '<div class="list1">';

echo '<b>Mã: '.$res['ma'].'</b><br>+ Giá trị Xu: '.$res['balans'].'<br>+ Giá trị VND: '.$res['vnd'].'<br>+ Giá trị KC: '.$res['kc'].'';
echo '<br><a href="code.php?act=edit&id='.$res['id'].'"><font color="red">[Sửa]</font></a> | <a href="code.php?act=del&id='.$res['id'].'"><font color="red">[Xoá]</font></a>';
echo '</div>';
++$i;
}
if ($tong > $kmess){
echo '<div class="topmenu">' . functions::display_pagination('code.php?act=panel&', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="rmenu" align="center"><b>Không có dữ liệu!</b></div>';
}
echo '<div class="phdr">Tổng: '.$tong.'</div>';
break;
case'get':
echo '<div class="phdr"><b>Nhận gift code</b></div>';
echo '<div style="display:none">';
$ktip = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `code` = '1', `ip`='" . core::$ip . "'")->fetch_row()[0] ?? 0);
echo '</div>';
if ($ktip == 1) {
echo '<div class="topmenu"><span class="prefix prefixRed">Chú ý</span> Bạn đã nhận 1 lần rồi</div>';
require('../incfiles/end.php');
exit;
}
if($datauser['code'] > 0) {
echo '<div class="rmenu"><center><b><font color="red">Chỉ nhận được 1 lần/1 tài khoản!</font></b></center></div>';
require('../incfiles/end.php');
exit;
}
$tong = ($connect->query("SELECT COUNT(*) FROM `magift` WHERE `use` = '0'")->fetch_row()[0] ?? 0);
if ($tong >0){
if($datauser['code'] ==0){
$connect->query("UPDATE `users` SET `code`=`code`+'1' WHERE `id`='".$user_id."'");
}

if($tong) {
$req = $connect->query("SELECT * FROM `magift` WHERE `use` = '0' ORDER BY `time` ASC
LIMIT 1");
while ($res = $connect->fetch_array($req)) {
$name = $connect->fetch_array($connect->query("SELECT `name` FROM `users` WHERE `id`='".$res['user']."'"));

echo '<div class="list1">';

echo 'Nhớ copy:<br><b>Mã: '.$res['ma'].'</b><br>+ Giá trị Vàng: '.$res['balans'].'<br>+ Giá trị VND: '.$res['vnd'].'<br>+ Giá trị Kim Cương: '.$res['kc'].'';
echo '</div>';
}
}
} else {
echo '<div class="rmenu" align="center"><b>Hết Gift Code! Quay lại sau!</b></div>';
}
echo '<div class="phdr">Còn lại: '.$tong.'</div>';
break;
case'edit':
echo '<div class="phdr"><b>Chỉnh sửa mã gift</b></div>';
if($datauser['rights'] < 9) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('../incfiles/end.php');
exit;
}
$id = (int)$_GET['id'];
$kt = $connect->query("SELECT * FROM ...")$connect->query("SELECT `id` FROM `magift` WHERE `id`='".$id."'"));
if($kt==0) {
echo '<div class="rmenu">Dữ liệu mã gift không tồn tại!</div>';
require('../incfiles/end.php');
exit;
}
$bv = $connect->fetch_array($connect->query("SELECT * FROM `magift` WHERE `id`='".$id."'"));
echo '<div class="list1">';
if(isset($_POST['submit'])) {
$balans = (int)$_POST['balans'];
$vnd = (int)$_POST['vnd'];
$kc = (int)$_POST['kc'];
if(empty($balans) && empty($vnd)) {
echo '<div class="rmenu">Bạn chưa nhập giá trị!</div>';
} else {
$connect->query("UPDATE `magift` SET `balans`='".$balans."', `vnd`='".$vnd."',  `kc`='".$kc."' WHERE `id`='".$id."'");
echo '<div class="rmenu">Bạn đã chỉnh sửa thành công!</div>';
}
} else {
echo '<form action="code.php?act=edit&id='.$id.'" method="post">Giá trị Xu:<br><input name="balans" type="text" value="'.$bv['balans'].'"/><br>Giá trị Xu:<br><input name="vnd" type="text" value="'.$bv['vnd'].'"/><br> Giá trị KC:<br><input name="kc" type="text" value="'.$bv['kc'].'"/><br> <input type="submit" name="submit" value="Lưu"/></form>';
}
echo '</div>';
break;
case'del':
echo '<div class="phdr"><b>Xoá mã gift</b></div>';
if($datauser['rights'] < 9) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('../incfiles/end.php');
exit;
}

$id = (int)$_GET['id'];
$kt = $connect->query("SELECT * FROM ...")$connect->query("SELECT `id` FROM `magift` WHERE `id`='".$id."'"));
if($kt==0) {
echo '<div class="rmenu">Dữ liệu mã gift không tồn tại!</div>';
require('../incfiles/end.php');
exit;
}

echo '<div class="list1">';

if(isset($_POST['submit'])) {
$connect->query("DELETE FROM `magift` WHERE `id`='".$id."'");
echo '<div class="rmenu">Bạn đã xoá mã gift thành công!</div>';
} else {
echo 'Bạn có thực sự muốn xoá?<br><form action="code.php?act=del&id='.$id.'" method="post"><input type="submit" name="submit" value="Xoá"/> - <a href="codd.php?act=panel">Hủy bỏ</a></form>';
}
echo '</div>';
break;
}

echo '</div>';
require('../incfiles/end.php');
?>
