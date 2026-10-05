<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Bảo mật';
require('../incfiles/head.php');
if($user_id){
?>
<div class="phdr">Mã cấp 2</div>
<?
switch($act){
default:
echo '<div class="menu"><a href="?act=tao">Tạo mã cấp 2</a></div><div class="menu"><a href="?act=doi">Đổi mã cấp 2</a></div><div class="menu"><a href="?act=xoa">Xóa mã</a></div>';
break;
case 'tao':
if (isset($_POST['submit'])){
$tenbang = $_POST['tenbang'];
$retenbang = $_POST['retenbang'];
if (empty($tenbang) or empty($retenbang)){
echo '<div class="rmenu">Không được bỏ trống 1 hoặc cả 2 trường̣!!!</div>';
} else {
if (mb_strlen($tenbang) > 10){
echo '<div class="rmenu">Mật mã cấp 2 chỉ được tối đa 10 ký tự và chỉ số!</div>';
} else {
if ($tenbang != $retenbang){
echo '<div class="rmenu">Mật khẩu nhập lại không đúng!</div>';
} else {
if ($macap2 !=0){
echo '<div class="rmenu">Lỗi! Đã tạo mã từ trước! Hãy xóa hoặc đổi mã!</div>';
} else {
$str="/[0-9]/";
if (preg_match($str,$tenbang)){
$connect->query("UPDATE users SET macap2 = '{$tenbang}', nhapmacap2 = '0' WHERE `id` = $user_id LIMIT 1");
echo '<div class="bmenu">Tạo thành công!</a></div>';
} else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
}
}
}
}
}
echo '<div class="menu"><form method="post">Mật mã mới: (chỉ số không chữ)<br><input type="password" name="tenbang"><br>Nhập lại mật mã mới:<br><input type="password" name="retenbang"><br><input type="submit" name="submit" value="Tạo"></form></div>';
break;
case 'xoa':
if (isset($_POST['submit'])){
$mk = $_POST['mk'];
if (empty($mk)){
echo '<div class="rmenu">Không được để trống mật khẩu</div>';
} else {
if ($mk == $datauser['macap2']){
$connect->query("UPDATE users SET macap2 = '0', nhapmacap2 = '0' WHERE id = $user_id");
echo '<div class="bmenu">Xóa mật khẩu thành công</div>';
} else {
echo '<div class="rmenu">Mật khẩu không đúng</div>';
}
}
}
echo '<div class="rmenu"> <form method="post"> <form method="post">Nhập mật khẩu cũ<br><input type="text" name="mk" value="123456"><br><input type="submit" name="submit" value="Xóa"></form></div>';
break;
case 'doi':
if (isset($_POST['submit'])){
$mkcu = $_POST['mkcu'];
$mkmoi = $_POST['mkmoi'];
$remk = $_POST['remk'];
if(empty($mkcu) or empty($mkmoi) or empty($remk)){
echo '<div class="rmenu">Không được để trống trường nào!</div>';
} else {
if ($mkcu != $datauser['macap2']){
echo '<div class="rmenu">Mật khẩu cũ không đúng!</div>';
} else {
if($mkmoi != $remk){
echo '<div class="rmenu">Mật khẩu nhập lại không đúng!</div>';
} else {
if (mb_strlen($mkmoi) >10){
echo '<div class="rmenu">Mật khẩu tối đa 10 ký tự!</div>';
} else {
$str="/[0-9]/";
if (preg_match($str,$mkmoi)){
$connect->query("UPDATE users SET macap2 = '{$mkmoi}', nhapmacap2 = '0' WHERE `id` = $user_id LIMIT 1");
echo '<div class="bmenu">Tạo thành công!</a></div>';
} else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
}
}
}
}
}
if ($datauser['macap2'] !=0){
echo '<form method="post">Mật khẩu cũ:<br><input type="text" name="mkcu" value="123456"><br>Mật khẩu mới (0-9):<br><input type="password" name="mkmoi"><br>Nhập lại mật khẩu mới:<br><input type="password" name="remk"><br><input type="submit" name="submit" value="Đổi"></form>';
} else {
echo '<div class="rmenu">Chưa có mật khẩu mà đổi!</div>';
}

break;
}
}else{
Echo '<div class="rmenu">Vui lòng đăng nhập!</div>';
}
require('../incfiles/end.php');
?>