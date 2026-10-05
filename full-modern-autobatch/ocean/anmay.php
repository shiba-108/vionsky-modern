<?php
$text1 = 'Nhà hảo tâm';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');







echo '<div class="danhmuc">Nhà hảo tâm</div>';
If ($user_id){
echo '<div class="menu list-top">';
switch($act){
default:
echo '<a href="?act=conghien">Cho xu</a><br><a href="?act=history">Lịch sử đóng góp</a><br><a href="?act=top">Bảng xếp hạng đóng góp</a>';
break;
case 'conghien':
if(isset($_POST['cho'])){
$xu = (int)$_POST['xu'];
if(empty($xu) OR $xu <=0){
echo 'Không hợp lệ!';
} else {
if($datauser['tienxu'] >= $xu){
if($xu >=50000){
$time = time() +18;
$connect->query("INSERT INTO `guest` SET `user_id`='2', `text`='Bạn [red]".$datauser['name']."[/red] vừa hiến tặng cho người nghèo [b]".$xu."[/b] Xu!', `time`='".time()."', `show` = '1', `timetg` = '".$time."'");
}
$connect->query("UPDATE users SET tienxu = tienxu -$xu WHERE id = $user_id");
$connect->query("INSERT INTO anmay SET user_id = '$user_id', tienxu = '$xu',  time = 'time()'");
Echo 'Bạn đã cống hiến thành công!';
} else {
echo 'Bạn không có đủ tiền!';
}
}
}
echo '<form method="post"><input type="number" name="xu" placeholder="Nhập xu"> <input type="submit" name="cho" value="Cho xu"></form>';
break;
case 'history':

echo'<div class="main-xmenu">';
echo'<div class="menu list-bottom congdong">'; 
$tongso = ($connect->query("SELECT COUNT(*) FROM `anmay`")->fetch_row()[0] ?? 0);
$req = $connect->query("SELECT * FROM `anmay`  ORDER BY `time` DESC LIMIT $start, $kmess");
while ($res = $connect->fetch_array($req)) {
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/account/'.$res['user_id'].'"><b>'.nick($res['user_id']).'</b></a><br/>
Cống hiến: '.$res['tienxu'].' Xu</div>';
}
if ($tongso > $kmess) {
echo '<div class="menu">' . functions::display_pagination('/ocean/anmay.php?act=history&', $start, $tongso, $kmess) . '</div>';
}
echo'</div>';
break;
case 'top':
echo'<div class="main-xmenu">';
echo'<div class="menu list-bottom congdong">'; 
$tongso = mysqli_result(mysqli_result("SELECT COUNT(*) FROM anmay WHERE SUM(tienxu) >0"),0);
$req = $connect->query("SELECT *, SUM(tienxu) FROM `anmay`  ORDER BY SUM(`tienxu`) DESC LIMIT $start, $kmess");
while ($res = $connect->fetch_array($req)) {
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/account/'.$res['user_id'].'"><b>'.nick($res['user_id']).'</b></a><br/>
Đóng góp: '.$res['SUM(tienxu)'].' Xu</div>';
}
if ($tongso > $kmess) {
echo '<div class="menu">' . functions::display_pagination('/ocean/anmay.php?act=top&', $start, $tongso, $kmess) . '</div>';
}
echo'</div>';

break;
}
echo '</div>';
}
Else {
Echo '<div class="rmenu">Đăng nhập đy thím!</div>';
}




        require('../incfiles/end.php');
?>