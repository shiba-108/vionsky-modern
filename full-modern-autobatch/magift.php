<?php
define('_IN_JOHNCMS', 1);
require_once('incfiles/core.php');
$textl = 'Đổi quà bằng mã gift';
require_once('incfiles/head.php');
if (!$user_id) {
echo functions::display_error($lng['access_guest_forbidden']);
require('incfiles/end.php');
exit;
}
echo '<div class="mainblok">';
switch($act) {
default:
echo '<div class="phdr"><b>Nhận quà từ mã gift</b></div>';
$ma = functions::checkout($_POST['ma']);
$req = $connect->query("SELECT * FROM `magift` WHERE `ma`='".$ma."'");
$dem = $connect->query("SELECT * FROM ...")$req);
$res = $connect->fetch_array($req);
echo '<div class="list1">';

if(isset($_POST['submit'])) {
if(empty($ma)) {
echo '<center><font color="red"><b>Bạn chưa nhập mã vào ô!</b></font></center>';
} else if($dem == 0) {
echo '<center><font color="red"><b>Mã gift không tồn tại hoặc đã được sử dụng!</b></font></center>';
} else {
if($res['tienxu'] != 0) {
$connect->query("UPDATE `users` SET `tienxu`=`tienxu` + '".$res['tienxu']."' WHERE `id`='".$user_id."'");
}
if($res['vinaxu'] != 0) {
$connect->query("UPDATE `users` SET `vinaxu`=`vinaxu`+'".$res['vinaxu']."' WHERE `id`='".$user_id."'");
}
echo '<div class="rmenu"><b>Nhận thưởng thành công công!</b><br>' . 'Với mã gift này bạn sẽ nhận được'.($res['tienxu'] != 0 ? '<b> '.$res['tienxu'].' Xu</b>':'').' '.($res['tienxu'] != 0 && $res['vinaxu'] != 0 ? '<b>và </b>':'').''.($res['vinaxu'] != 0 ? '<b>'.$res['vinaxu'].' Vina </b>':'').'cộng vào tài khoản!</div>';

$connect->query("DELETE FROM `magift` WHERE `ma`='".$ma."'");
}
}
echo '<form action="magift.php" method="post">Nhập mã vào ô:<br><input type="text" name="ma" value="'.$_POST['ma'].'" maxlength="8"/><br><input type="submit" name="submit" value="Nhận quà"/></form>';
echo 'Mã gift gồm 8 kí tự, có thể là chữ hoặc số, không phân biệt hoa thường.<br>';
echo '- Mã gift sẽ được share ở trên diễn đàn, quà tặng của event, người chiến thắng trong wap hay chỉ đơn giản là trả lương cho bạn.' . '<br>Mã có đủ mọi giá trị, ít cũng có mà nhiều cũng có. Phần thưởng bạn có thể nhận là Vina hoặc Xu. Để có mã gift hãy tích cực tham gia các hoạt động trên diễn đàn nhé!';
echo '</div>';
if($datauser['rights'] == 9) {
echo '<div class="phdr"><b>Quản lí</b></div><div class="gmenu"><a href="magift.php?act=add">Thêm mã gift</a><br><a href="magift.php?act=panel">Quản lí mã gift</a></div>';
}
break;
case 'add':
echo '<div class="phdr"><b>Thêm mã gift</b></div>';
if($datauser['rights'] < 9) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('incfiles/end.php');
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
$tienxu = (int)$_POST['tienxu'];
$vinaxu = (int)$_POST['vinaxu'];
if(isset($_POST['submit'])) {
if(empty($tienxu) && empty($vinaxu)) {
echo '<center><font color="red"><b>Bạn đã để trống cả 2 ô!</b></font></center>';
} else if($ktm != 0) {
echo '<div class="rmenu"><b>Dường như mã gift đã tồn tại vì hệ thống đã random trùng. Tỉ lệ này rất hiếm. Vui lòng làm lại!</b></div>';
} else {
$connect->query("INSERT INTO `magift` SET `user`='".$user_id."', `ma`='".$random."',
`time`='".time()."', `tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."'");
echo '<div class="rmenu"><b>Tạo mã gift thành công!</b><br>Mã:<b> '.$random.'</b><br>Bạn có thể quản lí<a href="magift.php?act=panel"> ở đây</a>!</div>';
}
}
echo '<form action="magift.php?act=add" method="post">Giá trị phần quà (Xu):<br><input type="text" name="tienxu" value="'.$_POST['tienxu'].'"/><br>Giá trị phần quà (Vina):<br><input type="text" name="vinaxu" value="'.$_POST['vinaxu'].'"/><br><input type="submit" name="submit" value="Lưu"/></form>';
echo '<font color="red">Lưu ý:</font>Giá trị phần quà có thể là Xu hoặc Vina hay cả 2. Đối với phần quà có giá trị là Vina hoặc Xu thì ô còn lại hãy điền số 0 hoặc để trống.<br>-Mã gift sẽ được hệ thống random 8 kí tự ngẫu nhiên với giá trị mà bạn đã đặt và bạn hãy copy để sử dụng hay quản lí tại phần quản lí. Việc cuối cùng là sử dụng đúng mục đích!';
echo '</div>';
break;
case'panel':
echo '<div class="phdr"><b>Quản lí</b></div>';
if($datauser['rights'] < 9) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('incfiles/end.php');
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

echo '<b>Mã: '.$res['ma'].'</b><br>+ Giá trị Xu: '.$res['tienxu'].'<br>+ Giá trị Vina: '.$res['vinaxu'].'';
echo '<br><a href="magift.php?act=edit&id='.$res['id'].'"><font color="red">[Sửa]</font></a> | <a href="magift.php?act=del&id='.$res['id'].'"><font color="red">[Xoá]</font></a>';
echo '</div>';
++$i;
}
if ($tong > $kmess){
echo '<div class="topmenu">' . functions::display_pagination('magift.php?act=panel&', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="rmenu" align="center"><b>Không có dữ liệu!</b></div>';
}
echo '<div class="phdr">Tổng: '.$tong.'</div>';
break;
case'edit':
echo '<div class="phdr"><b>Chỉnh sửa mã gift</b></div>';
if($datauser['rights'] < 9) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('incfiles/end.php');
exit;
}
$id = (int)$_GET['id'];
$kt = $connect->query("SELECT * FROM ...")$connect->query("SELECT `id` FROM `magift` WHERE `id`='".$id."'"));
if($kt==0) {
echo '<div class="rmenu">Dữ liệu mã gift không tồn tại!</div>';
require('incfiles/end.php');
exit;
}
$bv = $connect->fetch_array($connect->query("SELECT * FROM `magift` WHERE `id`='".$id."'"));
echo '<div class="list1">';
if(isset($_POST['submit'])) {
$tienxu = (int)$_POST['tienxu'];
$vinaxu = (int)$_POST['vinaxu'];
if(empty($tienxu) && empty($vinaxu)) {
echo '<div class="rmenu">Bạn chưa nhập giá trị!</div>';
} else {
$connect->query("UPDATE `magift` SET `tienxu`='".$tienxu."', `vinaxu`='".$vinaxu."' WHERE `id`='".$id."'");
echo '<div class="rmenu">Bạn đã chỉnh sửa thành công!</div>';
}
} else {
echo '<form action="magift.php?act=edit&id='.$id.'" method="post">Giá trị Xu:<br><input name="tienxu" type="text" value="'.$bv['tienxu'].'"/><br>Giá trị Vina:<br><input name="vinaxu" type="text" value="'.$bv['vinaxu'].'"/><br><input type="submit" name="submit" value="Lưu"/></form>';
}
echo '</div>';
break;
case'del':
echo '<div class="phdr"><b>Xoá mã gift</b></div>';
if($datauser['rights'] < 9) {
echo '<div class="rmenu"><center>Bạn không đủ thẩm quyền!</center></div>';
require('incfiles/end.php');
exit;
}

$id = (int)$_GET['id'];
$kt = $connect->query("SELECT * FROM ...")$connect->query("SELECT `id` FROM `magift` WHERE `id`='".$id."'"));
if($kt==0) {
echo '<div class="rmenu">Dữ liệu mã gift không tồn tại!</div>';
require('incfiles/end.php');
exit;
}

echo '<div class="list1">';

if(isset($_POST['submit'])) {
$connect->query("DELETE FROM `magift` WHERE `id`='".$id."'");
echo '<div class="rmenu">Bạn đã xoá mã gift thành công!</div>';
} else {
echo 'Bạn có thực sự muốn xoá?<br><form action="magift.php?act=del&id='.$id.'" method="post"><input type="submit" name="submit" value="Xoá"/> - <a href="magift.php?act=panel">Hủy bỏ</a></form>';
}
echo '</div>';
break;
}

echo '</div>';
require('incfiles/end.php');
?>
