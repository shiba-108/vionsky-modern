<?php
$tab = 'vui';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');
echo '<div class="phdr">Lễ đường</div>';
if($user_id){
switch($act){
default:
if($datauser['user_id2'] ==0){
echo '<div class="menu"><a href="?act=kethon">Đăng ký kết hôn</a> - <font color=purple>300 D</font></div>';
} else {
echo'<div class="menu"><a href="?act=lyhon">Ly hôn</a></div>';
}
break;
case 'kethon':
if(isset($_POST['kethon'])){
$name = $_POST['name'];
 $check = ($connect->query("SELECT COUNT(*) FROM users WHERE name = '$name'")->fetch_row()[0] ?? 0);
If($check ==0){
echo'<div class="rmenu">Tài khoản không tồn tại</div>';
} else {
$lay = $connect->fetch_array($connect->query("SELECT * FROM users WHERE name = '$name'"),0);
if($datauser['kc'] <300){
echo '<div class="rmenu">Bạn không đủ 300 D</div>';
require('../incfiles/end.php');
exit;
}
if($lay['sex'] ==$datauser['sex']){
echo '<div class="rmenu">Không được kết hôn cùng giới</div>';
} else {
if($lay['user_id2'] !=0 or $datauser['user_id2'] !=0){
echo '<div class="rmenu">Đối phương hoặc bạn đã có gia đình</div>';
require('../incfiles/end.php');
exit;
}
$connect->query("UPDATE users SET kc = kc -300 WHERE id = $user_id");
if($lay['sex'] ==m){
$id = $lay['id'];
$connect->query("UPDATE users SET user_id2 = $id WHERE id = $user_id");
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $lay['id'] . "',
		`user_id` = '2',
				`text` = '[color=red][b]Kết hôn[/b][/color] - ".$datauser['nameset']." muốn nhận bạn làm chồng. Còn bạn thì sao? [url=http://vnfocean.org/vuichoi/kethon.php?act=huy]Từ chối[/url] - [url=http://vnfocean.org/vuichoi/kethon.php?act=dongy]Bằng lòng[/url]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
echo '<div class="bmenu">Bạn tự nhận là vợ của '.nick($id).' hãy đợi phản hồi của đối phương</div>';
} else {
$id = $lay['id'];
$connect->query("UPDATE users SET user_id2 = $id WHERE id = $user_id");
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $lay['id'] . "',
		`user_id` = '2',
				`text` = '[color=red][b]Kết hôn[/b][/color] - ".$datauser['name']." muốn nhận bạn làm vợ. Còn bạn thì sao? [url=http://vnfocean.org/vuichoi/kethon.php?act=huy]Từ chối[/url] - [url=http://vnfocean.org/vuichoi/kethon.php?act=dongy]Bằng lòng[/url]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
echo '<div class="bmenu">Bạn tự nhận là chồng của '.nick($id).' hãy đợi phản hồi của đối phương</div>';
}
}
}
}
echo '<div class="menu"><form method="post">Nhập tên người ấy:<br><input type="text" name="name"><br><input type="submit" name="kethon" id="submit" value="Cầu hôn"></form></div>';
break;
case 'lyhon':
if($datauser['user_id2'] !=0){
if(isset($_POST['lyhon'])){
$macap2 = $_POST['macap2'];
if($macap2 == $datauser['macap2']){
$id2 = $datauser['user_id2'];
$connect->query("UPDATE users SET user_id2 = '0' WHERE id = $id2");
$connect->query("UPDATE users SET user_id2 = '0' WHERE id = $user_id");
echo '<div class="bmenu">Ly hôn thành công</div>';
} else {
echo '<div class="rmenu">Mật mã sai</div>';
}
}
echo '<div class="menu"><form method="post">Nhập mã cấp 2 để ly hôn (mặc định: <b>0</b>)<br><input type="text" name="macap2"><input type="submit" name="lyhon" id="submit" value="Ly hôn"></form></div>';
} else {
echo '<div class="rmenu">Chưa kết hôn!</div>';
}
break;
case 'huy':
if(isset($_POST['huy'])){
$connect->query("UPDATE users SET user_id2 = '0' WHERE user_id2 = $user_id");
 $req = $connect->query("SELECT * FROM users WHERE user_id2 = $user_id");
$ra = $connect->fetch_array($req);
$connect->query("UPDATE users SET user_id2 = '0' WHERE id = $user_id");
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $ra['id'] . "',
		`user_id` = '2',
				`text` = '[color=red][b]Hủy Kết Hôn[/b][/color] - ".$datauser['name']." không nhận yêu cầu của bạn. Chia buồn @@',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
echo '<div class="rmenu">Hủy thành công</div>';

}
Echo '<div class="rmenu">Bạn chắc chắn muốn hủy hết đám cưới? <form method="post"><input type="submit" name="huy" id="submit" value="Hủy"></form></div>';
break;
case 'dongy':
if(isset($_POST['dongy'])){
 
 $req = $connect->query("SELECT * FROM users WHERE user_id2 = $user_id");
$ra = $connect->fetch_array($req);
$id = $ra['id'];
$time = time() + 15;
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".nick($datauser['id'])." và ".nick($ra['id'])." đa trở thành vợ chồng. Mong chúc họ đầu bạc răng long!',
            `ip` = '" . core::$ip . "'
       ");
$connect->query("UPDATE users SET user_id2 = $id WHERE id = $user_id");
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $ra['id'] . "',
		`user_id` = '2',
				`text` = '[color=red][b]Kết Hôn[/b][/color] - ".$datauser['name']." đã chấp nhận yêu cầu của bạn. Xin chúc mừng :yahoo:',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
echo '<div class="rmenu">Đồng ý thành công</div>';

}
Echo '<div class="rmenu">Bạn chắc chắn muốn diễn ra đám cưới? <form method="post"><input type="submit" name="dongy" id="submit" value="Đồng ý"></form>';
break;
}
echo '<div class="phdr">Chờ bạn cầu hôn</div>';
if($datauser['sex'] =='m'){
 $tong = ($connect->query("SELECT COUNT(*) FROM users WHERE sex = 'zh' AND user_id2 = '0'")->fetch_row()[0] ?? 0);
if($tong ==0){
echo '<div class="rmenu">Chưa có dữ liệu</div>';
require '../incfiles/end.php';
exit;
}
$req = $connect->query("SELECT * FROM users WHERE sex = 'zh' AND user_id2 = '0' ORDER BY id DESC LIMIT $start, $kmess");
$i = 1;
while ($res = $connect->fetch_array($req)){
echo '<div class="list1">#<b>'.$i.'</b>: <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a>';
if($res['status'] !=0){echo ' ('.$res['status'].')';
}
echo '</div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="topmenu" align="center">' . functions::display_pagination('kethon.php?', $start, $tong, $kmess) . '</div>';
}
}
if($datauser['sex'] =='zh'){
 $tong = ($connect->query("SELECT COUNT(*) FROM users WHERE sex = 'm' AND user_id2 = '0'")->fetch_row()[0] ?? 0);
if($tong ==0){
echo '<div class="rmenu">Chưa có dữ liệu</div>';
require '../incfiles/end.php';
exit;
}
$req = $connect->query("SELECT * FROM users WHERE sex = 'm' AND user_id2 = '0' ORDER BY id DESC LIMIT $start, $kmess");
$i = 1;
while ($res = $connect->fetch_array($req)){
echo '<div class="list1">#<b>'.$i.'</b>: <a href="/users/profile.php?user='.$res['id'].'">'.nick($res['id']).'</a>';
if($res['status'] !=0){ echo '('.$res['status'].')';
}
echo '</div>';
++$i;
}
if ($tong > $kmess) {
                        echo '<div class="topmenu" align="center">' . functions::display_pagination('kethon.php?', $start, $tong, $kmess) . '</div>';
}
}
}
Else {
Echo '</div><div class="rmenu">Đăng nhập đy thím!</div>';
}





        require('../incfiles/end.php');
?>