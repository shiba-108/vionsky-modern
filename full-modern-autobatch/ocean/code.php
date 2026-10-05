<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$tab = 'vui';
$textl = 'Gift Code';
require_once('../incfiles/head.php');
if (!$user_id) {
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
echo '<div class="codeinblok">';
switch($act) {
default:
echo '<div class="danhmuc"><b>Mã Quà Tặng</b></div>';
if($datauser['active'] ==0){
echo 'Vui lòng active tài khoản ở Khu Mua Sắm > Công Dân để sử dụng chức năng này!';
require '../incfiles/end.php';
exit;
}
$code = functions::checkout($_POST['code']);
$req = $connect->query("SELECT * FROM `giftcode` WHERE `code`='".$code."'");
$dem = $connect->query("SELECT * FROM ...")$req);
$res = $connect->fetch_array($req);
echo '<div class="list1">';

if(isset($_POST['submit'])) {
$check = ($connect->query("SELECT COUNT(*) FROM nhangiftcode WHERE user_id = '$user_id' AND loai = '1' AND nhan = '1'")->fetch_row()[0] ?? 0);
if($check ==1){
echo '<div class="rmenu">Code chỉ sử dụng được 1 lần/1 tài khoản</div>';
$connect->query("UPDATE giftcode SET nhan = '0' WHERE ma = '$ma'");
require '../incfiles/end.php';
exit;
}
if(empty($code)) {
echo '<center><font color="red"><b>Bạn chưa nhập code vào ô!</b></font></center>';
} else if($dem == 0) {
echo '<center><font color="red"><b>Mã gift không tồn tại hoặc đã được sử dụng!</b></font></center>';
} else {
if($res['tienxu'] != 0) {
$connect->query("UPDATE `users` SET `tienxu`=`tienxu` + '".$res['tienxu']."' WHERE `id`='".$user_id."'");
}

if($res['vinaxu'] != 0) {
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`+'".$res['vinaxu']."' WHERE `id`='".$user_id."'");
}
$connect->query("UPDATE `users` SET `code`=`code`+'1' WHERE `id`='".$user_id."'");

echo '<div class="rmenu"><b>Nhận thưởng thành công!</b><br>' . 'Với mã gift này bạn đã nhận được <b><font color="green">'.$res['tienxu'].'</b> Xu</font> và <b><font color=purple>'.$res['vinaxu'].'</b> Vinaxu</font></div>';
}
$connect->query("UPDATE nhangiftcode SET nhan = '1' WHERE code = '".$code."'");
$connect->query("DELETE FROM `giftcode` WHERE `code`='".$code."'");
}
echo '<form action="code.php" method="post"><input type="text" name="code" placeholder="Nhập code"> <input type="submit" name="submit" value="Nhận quà"/></form>';
echo '</div>';
Echo '<div class="danhmuc">Gift free</div><div class="gmenu"><a href="code.php?act=get">● Khai trương</a></div>';
if($datauser['rights'] == 9) {
echo '<div class="danhmuc"><b>Quản lí</b></div><div class="gmenu"><a href="code.php?act=add">Thêm mã gift</a><br><a href="code.php?act=panel">Quản lí codẽ gift</a></div>';
}
break;
case 'add':
echo '<div class="danhmuc"><b>Thêm code gift</b></div>';
if($datauser['rights'] < 7) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('../incfiles/end.php');
exit;
}
//random code gift
 function rand_string($length) {
$chars ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen($char);
for($i = 0; $i<$length; $i++) {
$str .= $chars[rand(0, $size -1)];
$str=substr(str_shuffle($chars), 0, $length);
}
return$str;
}
$random = rand_string(12);
$random1 = rand_string(12);
$random2 = rand_string(12);
$random3 = rand_string(12);
$random4 = rand_string(12);
$random5 = rand_string(12);
$random6 = rand_string(12);
$random7 = rand_string(12);
$random8 = rand_string(12);
$random9 = rand_string(12);
////
 $ktm = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random."'")->fetch_row()[0] ?? 0);
$ktm1 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random1."'")->fetch_row()[0] ?? 0);
$ktm2 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random2."'")->fetch_row()[0] ?? 0);
$ktm3 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random3."'")->fetch_row()[0] ?? 0);
$ktm4 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random4."'")->fetch_row()[0] ?? 0);
$ktm5 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random5."'")->fetch_row()[0] ?? 0);
$ktm6 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random6."'")->fetch_row()[0] ?? 0);
$ktm7 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random7."'")->fetch_row()[0] ?? 0);
$ktm8 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random8."'")->fetch_row()[0] ?? 0);
$ktm9 = ($connect->query("SELECT COUNT(`code`) FROM `giftcode` WHERE `code`='MXH".$random9."'")->fetch_row()[0] ?? 0);

echo '<div class="list1">';
$tienxu = (int)$_POST['tienxu'];
$vinaxu = (int)$_POST['vinaxu'];
$loai = (int)$_POST['loai'];
if(isset($_POST['submit'])) {
if(empty($tienxu) && empty($vinaxu)) {
echo '<center><font color="red"><b>Bạn đã để trống cả 2 ô!</b></font></center>';
} else if($ktm != 0 OR $ktm1 !=0 OR $ktm2 !=0 OR $ktm3 !=0 OR $ktm4 !=0 OR $ktm5 !=0 OR $ktm6 !=0 OR $ktm7 !=0 OR $ktm8 !=0 OR $ktm9 !=0) {
echo '<div class="rmenu"><b>Dường như code gift đã tồn tại vì hệ thống đã random trùng. Tỉ lệ này rất hiếm. Vui lòng làm lại!</b></div>';
} else {
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random1."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random2."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random3."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random4."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random5."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random6."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random7."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random8."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
$connect->query("INSERT INTO `giftcode` SET  `code`='MXH".$random9."',
`tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."', loai='".$loai."'");
echo '<div class="rmenu"><b>Tạo 10 mã gift thành công!</b><br>Bạn có thể quản lí<a href="code.php?act=panel"> ở đây</a>!</div>';
}
}
echo '<form action="code.php?act=add" method="post">Giá trị phần quà (Xu):<br><input type="text" name="tienxu" value="'.$_POST['tienxu'].'"/> <br>Giá trị phần quà (Vinaxu):<br><input type="text" name="vinaxu" value="'.$_POST['vinaxu'].'"/><br>Loại = 1: GC Khai trương<br><input type="text" name="loai"  value="'.$_POST['loai'].'"><br> <input type="submit" name="submit" value="Tạo 10 mã cùng lúc"/></form>';
echo '</div>';
break;
case'panel':
echo '<div class="danhmuc"><b>Quản lí</b></div>';
if($datauser['rights'] < 7) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('../incfiles/end.php');
exit;
}
$tong = ($connect->query("SELECT COUNT(*) FROM `giftcode`")->fetch_row()[0] ?? 0);
if($tong) {
$req = $connect->query("SELECT * FROM `giftcode` ORDER BY `id` ASC
LIMIT $start, $kmess");
$i = 1;
while ($res = $connect->fetch_array($req)) {
echo '<div class="list1">';

echo '<b>Mã: '.$res['code'].'</b><br>+ Giá trị Xu: '.$res['tienxu'].'<br>+ Giá trị Vinaxu: '.$res['vinaxu'].'';
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
echo '<div class="danhmuc">Còn lại: '.$tong.'</div>';
break;
case'get':
echo '<div class="danhmuc"><b>Nhận gift code</b></div>';
 $check = ($connect->query("SELECT COUNT(*) FROM nhangiftcode WHERE user_id = '$user_id' AND loai = '1'")->fetch_row()[0] ?? 0);
if($check > 0) {
$co = $connect->fetch_array($connect->query("SELECT * FROM nhangiftcode WHERE user_id = $user_id AND loai = '1'"),0);
echo '<div class="rmenu"><center><font color="red">Bạn đã nhận mã này rồi! Mã: <b>'.$co['code'].'</font></b></center></div>';
require('../incfiles/end.php');
exit;
}
$tong = ($connect->query("SELECT COUNT(*) FROM `giftcode` WHERE `nhan` = '0' AND loai = '1'")->fetch_row()[0] ?? 0);
if ($tong >0){
$check = ($connect->query("SELECT COUNT(*) FROM nhangiftcode WHERE user_id = '$user_id' AND loai = '1'")->fetch_row()[0] ?? 0);
if($check ==0){
 $connect->query("INSERT INTO nhangiftcode SET code = '".$res['code']."', user_id = '".$user_id."', loai = '".$res['loai']."'");
$connect->query("UPDATE giftcode SET nhan = '1' WHERE id = '".$res['id']."'");
}

if($tong) {
$req = $connect->query("SELECT * FROM `giftcode` WHERE `nhan` = '0' AND loai ='1' ORDER BY `id` ASC
LIMIT 1");
while ($res = $connect->fetch_array($req)) {

echo '<div class="list1">';

echo 'Copy: <b>'.$res['code'].'</b><br>+ Giá trị Xu: '.$res['tienxu'].'<br>+ Giá trị Vinaxu: '.$res['vinaxu'].'';
echo '</div>';
}
}
} else {
echo '<div class="rmenu" align="center"><b>Hết Gift Code! Quay lại sau!</b></div>';
}
echo '<div class="danhmuc">Còn lại: '.$tong.'</div>';
break;
case'edit':
echo '<div class="danhmuc"><b>Chỉnh sửa mã gift</b></div>';
if($datauser['rights'] < 7) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('../incfiles/end.php');
exit;
}
$id = (int)$_GET['id'];
$kt = $connect->query("SELECT * FROM ...")$connect->query("SELECT `id` FROM `giftcode` WHERE `id`='".$id."'"));
if($kt==0) {
echo '<div class="rmenu">Dữ liệu mã gift không tồn tại!</div>';
require('../incfiles/end.php');
exit;
}
$bv = $connect->fetch_array($connect->query("SELECT * FROM `giftcode` WHERE `id`='".$id."'"));
echo '<div class="list1">';
if(isset($_POST['submit'])) {
$tienxu = (int)$_POST['tienxu'];
 $loai = $_POST['loai'];
$vinaxu = (int)$_POST['vinaxu'];
if(empty($tienxu) && empty($vnd)) {
echo '<div class="rmenu">Bạn chưa nhập giá trị!</div>';
} else {
$connect->query("UPDATE `giftcode` SET `tienxu`='".$tienxu."', `loai`='".$loai."',  `vinaxu`='".$vinaxu."' WHERE `id`='".$id."'");
echo '<div class="rmenu">Bạn đã chỉnh sửa thành công!</div>';
}
} else {
echo '<form action="code.php?act=edit&id='.$id.'" method="post">Giá trị Xu:<br><input name="tienxu" type="text" value="'.$bv['tienxu'].'"/><br> Giá trị Vinaxu:<br><input name="vinaxu" type="text" value="'.$bv['vinaxu'].'"/><br> <input type="text" name="loai" value="Loại"><br><input type="submit" name="submit" value="Lưu"/></form>';
}
echo '</div>';
break;
case'del':
echo '<div class="danhmuc"><b>Xoá nã gift</b></div>';
if($datauser['rights'] < 7) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('../incfiles/end.php');
exit;
}

$id = (int)$_GET['id'];
$kt = $connect->query("SELECT * FROM ...")$connect->query("SELECT `id` FROM `giftcode` WHERE `id`='".$id."'"));
if($kt==0) {
echo '<div class="rmenu">Dữ liệu mã gift không tồn tại!</div>';
require('../incfiles/end.php');
exit;
}

echo '<div class="list1">';

if(isset($_POST['submit'])) {
$connect->query("DELETE FROM `giftcode` WHERE `id`='".$id."'");
echo '<div class="rmenu">Bạn đã xoá codẽ gift thành công!</div>';
} else {
echo 'Bạn có thực sự muốn xoá?<br><form action="code.php?act=del&id='.$id.'" method="post"><input type="submit" name="submit" value="Xoá"/> - <a href="code.php?act=panel">Hủy bỏ</a></form>';
}
echo '</div>';
break;
}

echo '</div>';
require('../incfiles/end.php');
?>

