<?php
$tab = 'vui';
$text1 = 'Ngân hàng';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');







echo '<div class="phdr">Ocean Bank</div>';
$ten = $connect->query("SELECT * FROM users LIMIT 1");
If ($user_id){
switch($act){
default:
echo '<div class="menu">'.$ten['id'].'<table><tbody><tr><td width="80"><img class="npc" src="/heroes/6.png" width="150" height="200"></td><td>
<div class="newsx">
<div class="menu"><a href="?act=gv">Gold > VNĐ</a><br>Chuyển từ vàng sang VNĐ. <br><font color="purple">1 D (>1000 G)</font></div>
<div class="menu"><a href="?act=vg">VNĐ > Gold</a><br>Chuyển từ VNĐ sang vàng.<br><font color="purple">1 D (>10000 V)</font></div><div class="menu"><a href="?act=send">Chuyển tiền</a><br>Chuyển từ VNĐ người này sang người khác<br><font color="purple">Cần thẻ chuyển tiền</font></div></div>
</td></tr></tbody></table></div> ';
break;
case 'gv':
if(isset($_POST['submit'])){
$gold = $_POST['gold'];
$str="/[0-9]/";
if (preg_match($str, $gold)){
if ($datauser['balans'] < $gold){
echo '<div class="rmenu">Số tiền bạn nhập lớn hơn số tiền bạn có</div>';
} else {
if ($gold <=0){
echo '<div class="rmenu">Số tiền bạn nhập qúa nhỏ</div>';
} else {
$vnd = $gold*10;
if ($gold <=1000){
$connect->query("UPDATE users SET balans = balans - $gold, vnd = vnd + $vnd WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Chuyển thành công '.$gold.' G sang '.$vnd.' V</div>';
} else {
if ($datauser['kc'] >=1){
$connect->query("UPDATE users SET balans = balans - $gold, vnd = vnd + $vnd, kc = kc -1 WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Chuyển thành công '.$gold.' G sang '.$vnd.' V. Phí 1 D</div>';
} else {
echo '<div class="rmenu">Không đủ kim cương</div>';
}
}
}
}
} else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
}
echo '<div class="newsx">Số tiền chuyển lớn hơn 1000 G phí 1 D</div><div class="menu"><form method="post">Nhập số G muốn chuyển:<br><input type="text" name="gold" value="1000"><br><input type="submit" name="submit" value="Chuyển"></form></div>';
break;
case 'vg':
if(isset($_POST['submit'])){
$gold = $_POST['gold'];
$str="/[0-9]/";
if (preg_match($str, $gold)){
if ($datauser['vnd'] < $gold){
echo '<div class="rmenu">Số tiền bạn nhập lớn hơn số tiền bạn có</div>';
} else {
if ($gold <=0){
echo '<div class="rmenu">Số tiền bạn nhập qúa nhỏ</div>';
} else {
$vnd = $gold/10;
if ($gold <=10000){
$connect->query("UPDATE users SET balans = balans + $vnd, vnd = vnd - $gold WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Chuyển thành công '.$vnd.' G từ '.$gold.' V</div>';
} else {
if ($datauser['kc'] >=1){
$connect->query("UPDATE users SET balans = balans + $vnd, vnd = vnd - $gold, kc = kc -1 WHERE id = $user_id LIMIT 1");
echo '<div class="bmenu">Chuyển thành công '.$vnd.' G từ '.$gold.' V. Phí 1 D</div>';
} else {
echo '<div class="rmenu">Không đủ kim cương</div>';
}
}
}
}
} else {
echo '<div class="rmenu">Không hợp lệ</div>';
}
}
echo '<div class="newsx">Số tiền chuyển lớn hơn 10000 V phí 1 D</div><div class="menu"><form method="post">Nhập số V muốn chuyển:<br><input type="text" name="gold" value="10000"><br><input type="submit" name="submit" value="Chuyển"></form></div>';
break;
case 'send':
if(isset($_POST['use'])){
$gettime = time() + 432000;
if ($datauser['usecct'] ==1){
echo '<div class="rmenu">Thẻ đã sử dụng rồi! Không sử dụng nữa</div>';
} else {
if ($datauser['cardchuyentien'] >=1){
$connect->query("UPDATE users SET usecct = '1', timecct = '$gettime' WHERE id = $user_id");
echo '<div class="bmenu">Sử dụng thẻ thành công</div>';
} else {
echo '<div class="rmenu">Không đủ thẻ chuyển tiền</div>';
}
}
}
if ($datauser['usecct'] ==1){
if (time() > $datauser['timecct']){
$connect->query("UPDATE users SET timecct = '', usecct = '0' WHERE id = $user_id LIMIT 1");
echo '<div class="rmenu">Thẻ của bạn đã hết hạn sử dụng</div>';
}
}
 echo '<div class="gmenu"><table><tbody><tr><td width="30"><img src="img/shop/chuyenxu.png" class="cap2"></td><td>Có <b>'.$datauser['cardchuyentien'].'</b> thẻ chuyển tiền<br>';
if ($datauser['usecct'] ==0){
echo ' <form method="post"><input type="submit" name="use" value="Sử dụng"> (HSD: 5 ngày)</form>';
} else {
$time = $datauser['timecct'] - time();
echo ' <font color="green">Sau <b>'.date('d', $time).'</b> ngày nữa thì card chuyển tiền hết hạn</font><br>';
}
echo ' <a href="shop.php">Mua thêm tại Shop</a></td></tr></tbody></table></div>';
if (isset($_POST['submit'])){
$toid = $_POST['toid'];
$tien = $_POST['tien'];
$mk = $_POST['mk'];
if ($mk != $datauser['macap2']){
echo '<div class="rmenu">Mật khẩu cấp 2 sai!</div>';
} else {
if ($datauser['usecct'] ==1){
$dem = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `id`='{$toid}'")->fetch_row()[0] ?? 0);
if($dem == 0) {
echo '<div class="menu list-top">Đối tượng không tồn tại!</div>';
} else {
if($datauser['vnd'] < $tien){
echo '<div class="rmenu">Số tiền nhập lớn hơn số tiền có!</div>';
} else {
if ($tien <=0){
echo '<div class="rmenu">Số tiền chuyển quá nhỏ!</div>';
} else {
$str="/[0-9]/";
if (preg_match($str,$tien)){
$connect->query("UPDATE users SET vnd=vnd - $tien WHERE id = $user_id");
$connect->query("UPDATE users SET vnd=vnd + $tien WHERE id = $toid");
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $toid . "',
		`user_id` = '2',
		`text` = '[blue]Thông tin chuyển tiền[/blue] - [b]".$datauser['name']."[/b] đã chuyển cho bạn [green]".$tien." VNĐ[/green]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
echo '<div class="bmenu">Chuyển thành công <font color=green><b>'.$tien.'</b> VNĐ</font> sang tài khoản: <b>'.nick($toid).'</b></div>';
} else {
echo '<div class="rmenu">Tiền chuyển không hợp lệ!</div>';
}
}
}
}
} else {
echo '<div class="rmenu">Chưa sử dụng thẻ chuyển tiền hoặc nó đã hết hạn</div>';
}
}
}
echo '<div class="menu"><form method="post">Nhập VNĐ muốn chuyển:<br><input type="text" name="tien"><br>ID người nhận<br><input type="text" name="toid"><br>Nhập mã cấp 2 (mặc định: 0)<br><input type="password" name="mk" value="0"><br><input type="submit" name="submit" value="Chuyển"></form></div>';
break;



}


}
Else {
Echo '<div class="rmenu">Đăng nhập đy thím!</div>';
}





        require('../incfiles/end.php');
?>