<?php
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
if ($id && $id != $user_id) {
$req = $connect->query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if ($req) { {
$user = $connect->fetch_assoc($req);
}
else {
}
}
else {
$id = false;
$user = $datauser;
}
$congdong = ' id="selected"';
$textl = 'Bắt vào tù bạn '. $user['name'] . ''; 
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Bắt vào tù bạn '. $user['name'] . '</div>';
if ($rights < 1 || ($rights < 3 && $user['rights']) || ($rights <= $user['rights'])) {
echo'<div class="menu">Bạn không đủ quyền để bắt vào tù người này !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$user['id'].'.png" alt="'.$user['name'].'"/></div>';
if(isset($_POST['submit'])){
$timeband = $_POST['timeband'];
$lydo = $_POST['lydo'];
if ($timeband == 'vinhvien') {
$connect->query("INSERT INTO `nhatu` SET 
`user_id`='".$user['id']."',
`nguoiband`='".$user_id."',
`time`='".time()."',
`timeband`='0',
`vinhvien`='1',
`lydo`='".$lydo."'
");
} else {
$connect->query("INSERT INTO `nhatu` SET 
`user_id`='".$user['id']."',
`nguoiband`='".$user_id."',
`time`='".time()."',
`timeband`='".$timeband."',
`vinhvien`='0',
`lydo`='".$lydo."'
");
}
header('Location: '.$home.'/account/'.$user['id'].'');
} else {
echo'<form enctype="multipart/form-data" method="post">';
echo'<div class="menu list-bottom hot">';
echo'Thời hạn band: <select name="timeband">
<option value = "3600">1 giờ</option>
<option value = "10800">3 giờ</option>
<option value = "18000">5 giờ</option>
<option value = "36000">10 giờ</option>
<option value = "54000">15 giờ</option>
<option value = "86400">1 ngày</option>
<option value = "259200">3 ngày</option>
<option value = "432000">5 ngày</option>
<option value = "864000">10 ngày</option>
<option value = "1728000">20 ngày</option>
<option value = "2592000">1 tháng</option>
<option value = "5184000">2 tháng</option>
<option value = "7776000">3 tháng</option>
<option value = "10368000">4 tháng</option>
<option value = "12960000">5 tháng</option>
<option value = "15552000">6 tháng</option>
<option value = "18144000">7 tháng</option>
<option value = "20736000">8 tháng</option>
<option value = "23328000">9 tháng</option>
<option value = "25920000">10 tháng</option>
<option value = "28512000">11 tháng</option>
<option value = "31104000">12 tháng</option>
<option value = "vinhvien">Vĩnh viễn</option>
</select>';
echo'</div>';
echo'<div class="menu">';
echo'Lý do band: (Phải ghi đầy đủ)<br/><input type="text" name="lydo" />';
echo'</div>';
echo'<input type="submit" value="Bắt vào tù" name="submit" />';
echo'</form>';
}

echo'</div>';
require_once ("../incfiles/end.php");
?>