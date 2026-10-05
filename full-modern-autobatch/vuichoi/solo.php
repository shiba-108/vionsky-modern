<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
$tab = 'vui';
$textl = 'Tỉ thí';
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
if ($datauser['cong'] < 20){
require('../incfiles/head.php');
echo '<div class="main-xmenu">
<div class="phdr">Mẹ Biển</div>
<div class="menu list-top">Biển cả không dành cho những kẻ yếu ớt hãy đạt công kích từ 20 trở lên!</div>
<a href="index.php">Quay lai</a>
</div>';
require('../incfiles/end.php');
exit;
}

if (($datauser['cong'] <> $datauser['allcong'] or $datauser['cong2'] <> $datauser['allcong2'] or $datauser['cong3'] <> $datauser['allcong3'] or $datauser['edithp'] <> $datauser['allhp'] or $datauser['edithp2'] <> $datauser['allhp2'] or $datauser['edithp3'] <> $datauser['allhp3'] ) and $datauser['op1'] >0){
if ($datauser['edithp'] > $datauser['allhp']){
$connect->query("UPDATE `users` SET `cong`= '".$datauser['allcong']."', `cong2`= '".$datauser['allcong2']."', `cong3`= '".$datauser['allcong3']."', `edithp`= '".$datauser['allhp']."', `edithp2`= '".$datauser['allhp2']."', `edithp3`= '".$datauser['allhp3']."', `op1`='0' WHERE `id`='".$datauser['id']."'");
} elseif ($datauser['edithp'] <= $datauser['allhp']){
$connect->query("UPDATE `users` SET `cong`= '".$datauser['allcong']."', `cong2`= '".$datauser['allcong2']."', `cong3`= '".$datauser['allcong3']."', `op1`='0' WHERE `id`='".$datauser['id']."'");
}
if ($datauser['cong'] > $datauser['allcong']){
$connect->query("UPDATE `users` SET `cong`= '".$datauser['allcong']."', `cong2`= '".$datauser['allcong2']."', `cong3`= '".$datauser['allcong3']."', `op1`='0' WHERE `id`='".$datauser['id']."'");
}
}
require('../incfiles/head.php');
$id = intval($_GET['id']);

echo '<div class="main-xmenu"><div class="phdr">
<b>'.(isset($_GET['id']) ? 'Tấn công':'Đấu trường').'</b> ('.$datauser['win'].' lần thắng)</div>';

$room = $connect->fetch_array($connect->query("SELECT * FROM room WHERE id = $id"));
$cuoc = $room['cuoc'];

if(isset($_GET['id'])) {
if ($datauser['khoadt'] ==0){
echo '<div class="rmenu">Rút trận đấu trường mới có thể vào đây</div>';
require_once('../incfiles/end.php');
exit;
}
$dem = ($connect->query("SELECT COUNT(*) FROM `room` WHERE `id`='{$id}'")->fetch_row()[0] ?? 0);
if($dem == 0) {
echo '<div class="menu list-top">Phòng không tồn tại!</div>';
require('../incfiles/end.php');
exit;
}

if ($room['type'] ==0){
if ($room['mem'] ==1){
if (isset($_POST['xinvaophong'])){
if ($datauser['id'] == $room['user_id']){
echo '<div class="rmenu">Bạn là chủ phòng!</div>';
} else {
if ($room['mem'] ==2){
echo '<div class="rmenu">Phòng đã đầy</div>';
}
if ($room['mem'] ==1){
if ($datauser['id'] == $room['user_id2']){
echo '<div class="rmenu">Bạn đã xin vào phòng từ trước</div>';
} else {
$connect->query("UPDATE room SET user_id2 = $user_id, mem = 2 WHERE id = $id");
echo '<div class="bmenu">Xin vào phòng thành công! Tải lại trang để chiến đấu</div>';
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $room['user_id'] . "',
		`user_id` = '2',
				`text` = '".$datauser['name']." đã vào phòng tỉ thí của bạn: [url=http://vnfocean.org/vuichoi/solo.php?id=".$id."]#".$id."[/url]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
}
}
}
}
if (isset($_POST['submit'])){
if ($datauser['id'] != $room['user_id']){
echo '<div class="rmenu">Bạn không phải chủ phòng</d>';
} else {
$connect->query("DELETE FROM room WHERE id = $id");
echo '<div class="bmenu">Hủy phòng thành công</div>';
}
}
echo '<div class="newsx">Chủ phòng: <b>'.nick($room['user_id']).'</b><br>Khách: <font color="red">Đang chờ...</font><br>Cược: <font color=green>'.$room['cuoc'].' VNĐ</font>';
if($room['user_id'] == $datauser['id']){
echo '<form method="post"><input type="submit" name="submit" value="Hủy phòng"></form></div>';
}
if ($room['user_id2'] ==0 and $datauser['id'] != $room['user_id']){
echo '<form method="post"><input type="submit" name="xinvaophong" value="Vào trận"></form></div>';
}
}
if ($room['mem'] ==2){
$idr = $room['user_id2'];
 $idr2 = $room['user_id'];
if ($datauser['id'] == $room['user_id']){
 $ten = $connect->fetch_array($connect->query("SELECT * FROM users WHERE id = $idr"),0);
} else {
$ten = $connect->fetch_array($connect->query("SELECT * FROM users WHERE id = $idr2"),0);
}
if($datauser['set'] <10000000){
$icla = 'cap'.$datauser['capset'].'';
} else {
$icla = 'trangphuc';
}
if($ten['set'] <10000000){
$iclaz = 'cap'.$ten['capset'].'';
} else {
$iclaz = 'trangphuc';
}
if ($ten['vnd'] < $room['cuoc'] or $datauser['vnd'] < $room['cuoc']){
if(isset($_POST['huy'])){
if($datauser['id'] == $room['user_id']){
if($datauser['op'] != $ten['id']){
$connect->query("DELETE FROM room WHERE id = $id");
echo '<div class="bmenu">Hủy phòng thành công</div>';
}
}
}
if(isset($_POST['roi'])){
if ($datauser['op'] != $ten['id']){
if($room['user_id2'] == $datauser['id']){
$connect->query("UPDATE room SET mem = 1, user_id2 = '0' WHERE id = $id");
echo '<div class="bmenu">Rời phòng thành công</div>';
}
}
}
echo '<div class="rmenu">Bạn hoặc đối thủ không có đủ tiền cược';
if($datauser['id'] == $room['user_id']){
echo '<form method="post"><input type="submit" name="huy" value="Hủy phòng"></form>';
}
if ($datauser['id'] == $room['user_id2']){
echo '<form method="post"><input type="submit" name="roi" value="Rời phòng"></form>';
}
echo '</div>';
require_once('../incfiles/end.php');
exit;
}
if($ten['khoadt'] ==0 or $datauser['khoadt'] ==0){
if(isset($_POST['huy'])){
if($datauser['id'] == $room['user_id']){
if($datauser['op'] != $ten['id']){
$connect->query("DELETE FROM room WHERE id = $id");
echo '<div class="bmenu">Hủy phòng thành công</div>';
}
}
}
if(isset($_POST['roi'])){
if ($datauser['op'] != $ten['id']){
if($room['user_id2'] == $datauser['id']){
$connect->query("UPDATE room SET mem = 1, user_id2 = '0' WHERE id = $id");
echo '<div class="bmenu">Rời phòng thành công</div>';
}
}
}
echo '<div class="rmenu">Bạn hoặc đối thủ chưa rút trận đấu trường';
if($datauser['id'] == $room['user_id']){
echo '<form method="post"><input type="submit" name="huy" value="Hủy phòng"></form>';
}
if ($datauser['id'] == $room['user_id2']){
echo '<form method="post"><input type="submit" name="roi" value="Rời phòng"></form>';
}
echo '</div>';
require_once('../incfiles/end.php');
exit;
}
}
}
if ($room['type'] ==1){
if ($room['mem'] ==1){
if (isset($_POST['xinvaophong'])){
if ($datauser['id'] == $room['user_id']){
echo '<div class="rmenu">Bạn là chủ phòng!</div>';
} else {
if ($room['mem'] ==2){
echo '<div class="rmenu">Phòng đã đầy</div>';
}
if ($room['mem'] ==1){
if ($datauser['id'] != $room['user_id2']){
echo '<div class="rmenu">Bạn không được mời</div>';
} else {
$connect->query("UPDATE room SET user_id2 = $user_id, mem = 2 WHERE id = $id");
echo '<div class="bmenu">Xin vào phòng thành công! Tải lại trang để chiến đấu</div>';
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $room['user_id'] . "',
		`user_id` = '2',
				`text` = '".$datauser['name']." đã vào phòng tỉ thí của bạn: [url=http://vnfocean.org/vuichoi/solo.php?id=".$id."]#".$id."[/url]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
}
}
}
}
if (isset($_POST['submit'])){
$connect->query("DELETE FROM room WHERE id = $id");
echo '<div class="bmenu">Hủy phòng thành công</div>';
}
echo '<div class="newsx">Chủ phòng: <b>'.nick($room['user_id']).'</b><br>Khách: '.nick($room['user_id2']).' (<font color="red">Chưa vào</font>)<br>Cược: <font color=green>'.$room['cuoc'].' VND</font>';
if($room['user_id'] == $datauser['id']){
echo '<form method="post"><input type="submit" name="submit" value="Hủy phòng"></form></div>';
}
if ($room['user_id2'] == $datauser['id']){
echo '<form method="post"><input type="submit" name="xinvaophong" value="Sẵn sàng"></form></div>';
}
if ($datauser['id'] != $room['user_id'] and $datauser['id'] != $room['user_id2']){
echo '</div>';
}
}
if ($room['mem'] ==2){
$idr = $room['user_id2'];
 $idr2 = $room['user_id'];
if ($datauser['id'] == $room['user_id']){
 $ten = $connect->fetch_array($connect->query("SELECT * FROM users WHERE id = $idr"),0);
} else {
$ten = $connect->fetch_array($connect->query("SELECT * FROM users WHERE id = $idr2"),0);
}
if($datauser['set'] <10000000){
$icla = 'cap'.$datauser['capset'].'';
} else {
$icla = 'trangphuc';
}
if($ten['set'] <10000000){
$iclaz = 'cap'.$ten['capset'].'';
} else {
$iclaz = 'trangphuc';
}
if ($ten['vnd'] < $room['cuoc'] or $datauser['vnd'] < $room['cuoc']){
if(isset($_POST['huy'])){
if($datauser['id'] == $room['user_id']){
if($datauser['op'] != $ten['id']){
$connect->query("DELETE FROM room WHERE id = $id");
echo '<div class="bmenu">Hủy phòng thành công</div>';
}
}
}
if(isset($_POST['roi'])){
if ($datauser['op'] != $ten['id']){
if($room['user_id2'] == $datauser['id']){
$connect->query("UPDATE room SET mem = 1, user_id2 = '0' WHERE id = $id");
echo '<div class="bmenu">Rời phòng thành công</div>';
}
}
}
echo '<div class="rmenu">Bạn hoặc đối thủ không có đủ tiền cược';
if($datauser['id'] == $room['user_id']){
echo '<form method="post"><input type="submit" name="huy" value="Hủy phòng"></form>';
}
if ($datauser['id'] == $room['user_id2']){
echo '<form method="post"><input type="submit" name="roi" value="Rời phòng"></form>';
}
echo '</div>';
require_once('../incfiles/end.php');
exit;
}
}
}
if ($room['mem'] ==2){
echo '
<div class="menu" style="text-align:center;">
<table cellpadding="0" cellspacing="0"><tbody><tr>
<td style="padding:2px;text-align:center;">
<img class="'.$icla.'" src="'.$home.'/heroes/'.$datauser['set'].'.png" alt="'. $user['name'] . '" width="100" height="150">
<br>
<b><span style="color:#000;"><small>' . $datauser['name'] . '</span></b><br>
<font color="green"><b>' . $datauser['cong'] . '</b> SM</font><br>
<font color="red"><b>' . $datauser['edithp'] . '/'.$datauser['allhp'].'</b> HP</font><br>
<font color="blue"><b>' . $datauser['editmana'] . '/'.$datauser['allmana'].'</b> MP</font><br>';

echo '<font color=green>'.$datauser['nameset'].'</font>';
echo ' (<font color="red">+'.$datauser['capset'].'</small></font>)</td>
<td style="padding:2px;text-align:center;">
<big><b>Đối thủ:</b></big><br>';

echo '<form method="post"><input type="submit" name="submit" value="Đánh" /></form>';

echo '</td><td style="padding:2px;text-align:center;">
<img class="'.$iclaz.'" src="'.$home.'/heroes/'.$ten['set'].'.png" alt="'. $ten['name'] . '" width="100" height="150"><br>
<b><span style="color:#000;"><small>' . $ten['name'] . '</span></b><br>
<font color="green"><b>' . $ten['cong'] . '</b> SM</font><br>
<font color="red"><b>' . $ten['edithp'] . '/'.$ten['allhp'].'</b> HP</font><br>
<font color="blue"><b>' . $ten['editmana'] . '/'.$ten['allmana'].'</b> MP</font><br>'; 
echo '<font color=blue>'.$ten['nameset'].'</font>';
echo ' (<font color="red">+'.$ten['capset'].'</font>)</small>
</td>
</tr></tbody></table></div>';
if(isset($_POST['submit'])) {
If($datauser['set'] ==0 OR $ten['set'] ==0){
echo '<div class="rmenu">Bạn hoặc đối thủ chưa có HERO</div>';
}
If($datauser['set'] >0 and $ten['set'] >0){
if($datauser['op'] == $ten['id']){
if($datauser['edithp'] <0 or $ten['edithp'] <0){
if($datauser['edithp'] == $ten['edithp']){
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $ten['id'] . "',
		`user_id` = '2',
		`text` = '[blue][b]HUỀ NHAU[/b][/blue] - Trận chiến giữa bạn ([u]".$ten['nameset']."[/u]) và [b]".$datauser['name']."[/b] tại phòng tỷ thí',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
$connect->query("DELETE FROM room WHERE id = $id");
echo '<div class="rmenu"><center><font size=4>'.nick($datauser['id']).' Huề '.nick($ten['id']).'</font></div></center>';
$connect->query("UPDATE `users` SET `op`= '0' WHERE `id`='".$datauser['id']."'");
}
}
if($datauser['edithp'] <0 or $ten['edithp'] <0){
$randct = rand(1,5);
if ($randct ==1){$ct = 'Chiến thắng';}
if ($randct ==2){$ct = 'Chấm dứt';}
if ($randct ==3){$ct = 'Killed';}
if ($randct ==4){$ct = 'Đánh chết';}
if ($randct ==5){$ct = 'Xé từng mảnh';}
$randct2 = rand(1,5);
if ($randct2 ==1){$mauct = 'gold';}
if ($randct2 ==2){$mauct = 'green';}
if ($randct2 ==3){$mauct = 'purple';}
if ($randct2 ==4){$mauct = 'black';}
if ($randct2 ==5){$mauct = 'blue';}
$randct3 = rand(1,5);
if ($randct3 ==1){$mautb = 'gray';}
if ($randct3 ==2){$mautb = 'pink';}
if ($randct3 ==3){$mautb = 'yellow';}
if ($randct3 ==4){$mautb = 'orange';}
if ($randct3 ==5){$mautb = 'brown';}
if($datauser['edithp'] > $ten['edithp']){
if($datauser['usex2truyna'] ==1){
if($ten['truyna'] >=50000){
$beri = $ten['truyna']/2.5;
} else {
$beri = rand(2000,10000);
}
} else {
if($ten['truyna'] >=25000){
$beri = $ten['truyna']/5;
} else {
$beri = rand(1000,5000);
}
}
if ($cuoc >= 100000){
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$datauser['name']." ".$ct." ".$ten['name']." nhận được ".$cuoc." VNĐ tại tỉ thí',
            `ip` = '" . core::$ip . "'
       ");
}
$connect->query("DELETE FROM room WHERE id = $id");
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $ten['id'] . "',
		`user_id` = '2',
		`text` = '[red][b]THẤT BẠI[/b][/red] - Trận chiến giữa bạn ([u]".$ten['nameset']."[/u]) và [b]".$datauser['name']."[/b] ([u]".$datauser['nameset']."[/u]) tại phòng tỉ thí
P/s: mất [b]".$beri."[/b] truy nã (nếu bạn không có đủ số này bạn k bị trừ :kul2:) và [green][b]".$cuoc."[/b] VNĐ[/green]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());

$connect->query("UPDATE `users` SET `win`=`win` + '1', `op`= '0', `truyna`=`truyna` + '$beri', `vnd`=`vnd` + '$cuoc' WHERE `id`='".$datauser['id']."'");
if ($ten['win'] >0){
$connect->query("UPDATE `users` SET `win`=`win` - '1', `vnd`=`vnd` - '$cuoc' WHERE `id`='".$ten['id']."'");
} else {
$tid9 = $ten['id'];
$connect->query("UPDATE users SET vnd = vnd - $cuoc WHERE id = $tid9");
}
if ($ten['truyna'] >$beri){
$connect->query("UPDATE `users` SET `truyna`=`truyna` - '$beri' WHERE `id`='".$ten['id']."'");
}
echo '<div class="newsx"><center><font size="4"><font color='.$mauct.'><b>'.$datauser['name'].'</b></font> <font color="red">'.$ct.'</font> <font color='.$mautb.'>'.$ten['name'].'</font></font><br><b class="wanted">Nhận được '.$beri.' β</b> và <font color=green><b>'.$cuoc.'</b> VNĐ</font></center></div>';
}
if($datauser['edithp'] < $ten['edithp']){
if($ten['usex2truyna'] ==1){
if ($datauser['truyna'] >=50000){
$beri = $datauser['truyna']/2.5;
} else {
$beri = rand(2000,10000);
}
} else {
if ($datauser['truyna'] >=25000){
$beri = $datauser['truyna']/5;
} else {
$beri = rand(1000,5000);
}
}
if($cuoc >=100000){
$connect->query("INSERT INTO `guest` SET
            `adm` = '0',
 `timetg` = '".$time."',
`show` = '1',
            `time` = '" . time() . "',
            `user_id` = '2',
            `text` = '".$ten['name']." ".$ct." ".$datauser['name']." nhận được ".$cuoc." VNĐ tại tỉ thí',
            `ip` = '" . core::$ip . "'
       ");
}
$connect->query("DELETE FROM room WHERE id = $id");
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $ten['id'] . "',
		`user_id` = '2',
				`text` = '[green][b]CHIẾN THẮNG[/b][/green] - Trận chiến giữa bạn ([u]".$ten['nameset']."[/u]) và [b]".$datauser['name']."[/b] ([u]".$datauser['nameset']."[/u]) tại PHÒNG TỈ THÍ!
P/s: nhận được [b]".$beri."[/b] β và [green]".$room['cuoc']."[/green]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
if($datauser['truyna'] >$beri){
$connect->query("UPDATE users SET truyna = truyna - '$beri' WHERE id = $user_id LIMIT 1");
}
if($datauser['win'] >0){
$connect->query("UPDATE `users` SET `win`=`win` - '1', `op`= '0', `vnd`=`vnd` - '$cuoc' WHERE `id`='".$datauser['id']."'");
} else {
$connect->query("UPDATE `users` SET `op`= '0', `vnd`=`vnd` - '$cuoc' WHERE `id`='".$datauser['id']."'");
}
$connect->query("UPDATE `users` SET `win`=`win` + '1', `truyna`=`truyna` + '$beri', `vnd`=`vnd` + '$cuoc' WHERE `id`='".$ten['id']."'");
echo '<div class="newsx"><center><font size="4"><font color='.$mauct.'><b>'.$ten['name'].'</b></font> <font color="red">'.$ct.'</font> <font color='.$mautb.'>'.$datauser['name'].'</font></font><br><b class="wanted">Hắn nhận được '.$beri.' β</b> và <font color="green"><b>'.$room['cuoc'].'</b> VNĐ</font></center></div>';
}
}
}
if($datauser['edithp'] <=0 or $ten['edithp'] <=0){
if($datauser['op'] > $ten['id'] or $datauser['op'] < $ten['id']){
echo '<div class="rmenu">Bạn hoặc đối thủ đã hết máu</div>';
}
} else {
if ($datauser['khoadt'] ==0 or $ten['khoadt'] ==0){
echo '<div class="rmenu">Bạn hoặc đối thủ chưa tham gia chiến trường nên không thể tiếp tục!!!</div>';
} else {
Echo '<div class="thongke">';
$baogomtc =1;
if ($baogomtc == 1){
$tc = 1;
if ($tc ==1){ 
////1
if ($datauser['capset'] == 1){
if ($datauser['editmana'] >=100){
$randtc = rand(1,2);
}
if ($datauser['editmana'] <100){
$randtc = 1;
}
if ($randtc ==1){
$sk = 'đánh chay';
$mana =0;
$hp = $datauser['cong'];
}
if ($randtc ==2){
$sk = $datauser['tc1'];
$mana = 100;
$hp = $datauser['cong']*1.5;
}
} ////2
if ($datauser['capset'] == 2){
if ($datauser['editmana'] >=200){
$randtc = rand(1,3);
}
$mf2 = $datauser['editmana'];
if ($mf2 <200 AND $mf2 >= 100){
$randtc = rand(1,2);
}
if ($mf2 <100){
$randtc = 1;
}
if ($randtc ==1){
$sk = 'đánh chay';
$mana =0;
$hp = $datauser['cong'];
}
if ($randtc ==2){
$sk = $datauser['tc1'];
$mana = 100;
$hp = $datauser['cong']*1.5;
}
if ($randtc ==3){
$sk = $datauser['tc2'];
$mana = 200;
$hp = $datauser['cong']*2;
}
} ////3
if ($datauser['capset'] == 3){
if ($datauser['editmana'] >=300){
$randtc = rand(1,4);
}
$mf2 = $datauser['editmana'];
if ($mf2 <300 AND $mf2 >= 100){
$randtc = rand(1,3);
}
if ($mf2 <100){
$randtc = 1;
}
if ($randtc ==1){
$sk = 'đánh chay';
$mana =0;
$hp = $datauser['cong'];
}
if ($randtc ==2){
$sk = $datauser['tc1'];
$mana = 100;
$hp = $datauser['cong']*1.5;
}
if ($randtc ==3){
$sk = $datauser['tc2'];
$mana = 200;
$hp = $datauser['cong']*2;
}
if ($randtc ==4){
$sk = $datauser['tc3'];
$mana = 300;
$hp = $datauser['cong']*2.7;
}
} ////4
if ($datauser['capset'] == 4){
if ($datauser['editmana'] >=400){
$randtc = rand(1,5);
}
$mf2 = $datauser['editmana'];
if ($mf2 <400 AND $mf2 >= 100){
$randtc = rand(1,3);
}
if ($mf2 <100){
$randtc = 1;
}
if ($randtc ==1){
$sk = 'đánh chay';
$mana =0;
$hp = $datauser['cong'];
}
if ($randtc ==2){
$sk = $datauser['tc1'];
$mana = 100;
$hp = $datauser['cong']*1.5;
}
if ($randtc ==3){
$sk = $datauser['tc2'];
$mana = 200;
$hp = $datauser['cong']*2;
}
if ($randtc ==4){
$sk = $datauser['tc3'];
$mana = 300;
$hp = $datauser['cong']*2.7;
}
if ($randtc ==5){
$sk = $datauser['tc4'];
$mana = 400;
$hp = $datauser['cong']*4;
} 
}////5
if ($datauser['capset'] == 5){
if ($datauser['editmana'] >=500){
$randtc = rand(1,6);
}
$mf2 = $datauser['editmana'];
if ($mf2 <400 AND $mf2 >= 100){
$randtc = rand(1,3);
}
if ($mf2 <100){
$randtc = 1;
}
if ($randtc ==1){
$sk = 'đánh chay';
$mana =0;
$hp = $datauser['cong'];
}
if ($randtc ==2){
$sk = $datauser['tc1'];
$mana = 100;
$hp = $datauser['cong']*1.5;
}
if ($randtc ==3){
$sk = $datauser['tc2'];
$mana = 200;
$hp = $datauser['cong']*2;
}
if ($randtc ==4){
$sk = $datauser['tc3'];
$mana = 300;
$hp = $datauser['cong']*2.7;
}
if ($randtc ==5){
$sk = $datauser['tc4'];
$mana = 400;
$hp = $datauser['cong']*4;
}
if ($randtc ==6){
$sk = $datauser['tc5'];
$mana =500;
$hp = $datauser['cong']*6;
}
}
}
$tc2 = 1;
if ($tc2 ==1){ 
////1
if ($ten['capset'] == 1){
if ($ten['editmana'] >=100){
$randtc = rand(1,2);
}
if ($ten['editmana'] <100){
$randtc = 1;
}
if ($randtc ==1){
$sk2 = 'đánh chay';
$mana2 =0;
$hp2 = $ten['cong'];
}
if ($randtc ==2){
$sk2 = $ten['tc1'];
$mana2 = 100;
$hp2 = $ten['cong']*1.5;
}
} ////2
if ($ten['capset'] == 2){
if ($ten['editmana'] >=200){
$randtc = rand(1,3);
}
$mf2 = $ten['editmana'];
if ($mf2 <200 AND $mf2 >= 100){
$randtc = rand(1,2);
}
if ($mf2 <100){
$randtc = 1;
}
if ($randtc ==1){
$sk2 = 'đánh chay';
$mana2 =0;
$hp2 = $ten['cong'];
}
if ($randtc ==2){
$sk2 = $ten['tc1'];
$mana2 = 100;
$hp2 = $ten['cong']*1.5;
}
if ($randtc ==3){
$sk2 = $ten['tc2'];
$mana2 = 200;
$hp2 = $ten['cong']*2;
}
} ////3
if ($ten['capset'] == 3){
if ($ten['editmana'] >=300){
$randtc = rand(1,4);
}
$mf2 = $ten['editmana'];
if ($mf2 <300 AND $mf2 >= 100){
$randtc = rand(1,3);
}
if ($mf2 <100){
$randtc = 1;
}
if ($randtc ==1){
$sk2 = 'đánh chay';
$mana2 =0;
$hp2 = $ten['cong'];
}
if ($randtc ==2){
$sk2 = $ten['tc1'];
$mana2 = 100;
$hp2 = $ten['cong']*1.5;
}
if ($randtc ==3){
$sk2 = $ten['tc2'];
$mana2 = 200;
$hp2 = $ten['cong']*2;
}
if ($randtc ==4){
$sk2 = $ten['tc3'];
$mana2 = 300;
$hp2 = $ten['cong']*2.7;
}
} ////4
if ($ten['capset'] == 4){
if ($ten['editmana'] >=400){
$randtc = rand(1,5);
}
$mf2 = $ten['editmana'];
if ($mf2 <400 AND $mf2 >= 100){
$randtc = rand(1,3);
}
if ($mf2 <100){
$randtc = 1;
}
if ($randtc ==1){
$sk2 = 'đánh chay';
$mana2 =0;
$hp2 = $ten['cong'];
}
if ($randtc ==2){
$sk2 = $ten['tc1'];
$mana2 = 100;
$hp2 = $ten['cong']*1.5;
}
if ($randtc ==3){
$sk2 = $ten['tc2'];
$mana2 = 200;
$hp2 = $ten['cong']*2;
}
if ($randtc ==4){
$sk2 = $ten['tc3'];
$mana2 = 300;
$hp2 = $ten['cong']*2.7;
}
if ($randtc ==5){
$sk2 = $ten['tc4'];
$mana2 = 400;
$hp2 = $ten['cong']*4;
} 
}////5
if ($ten['capset'] == 5){
if ($ten['editmana'] >=500){
$randtc = rand(1,6);
}
$mf2 = $ten['editmana'];
if ($mf2 <400 AND $mf2 >= 100){
$randtc = rand(1,3);
}
if ($mf2 <100){
$randtc = 1;
}
if ($randtc ==1){
$sk2 = 'đánh chay';
$mana2 =0;
$hp2 = $ten['cong'];
}
if ($randtc ==2){
$sk2 = $ten['tc1'];
$mana2 = 100;
$hp2 = $ten['cong']*1.5;
}
if ($randtc ==3){
$sk2 = $ten['tc2'];
$mana2 = 200;
$hp2 = $ten['cong']*2;
}
if ($randtc ==4){
$sk2 = $ten['tc3'];
$mana2 = 300;
$hp2 = $ten['cong']*2.7;
}
if ($randtc ==5){
$sk2 = $ten['tc4'];
$mana2 = 400;
$hp2 = $ten['cong']*4;
}
if ($randtc ==6){
$sk2 = $ten['tc5'];
$mana2 =500;
$hp2 = $ten['cong']*6;
}
}
}
$tenid = $ten['id'];
$hpfg = $hp/55;
$hpf = round($hpfg,2);
$hpfg2 = $hp2/55;
$hpf2 = round($hpfg2,2);
$connect->query("UPDATE `users` SET `edithp`=`edithp`- '{$hpf2}', `editmana`=`editmana`- '{$mana}', `op`= '{$tenid}' WHERE `id`= '{$user_id}'");
$connect->query("UPDATE `users` SET `edithp`=`edithp`- '{$hpf}', `editmana`=`editmana`- '{$mana2}' WHERE `id`= '{$tenid}'");
$mau1 = rand(1,10);
if ($mau1==1){$mau ='red';}
if ($mau1==2){$mau ='blue';}
if ($mau1==3){$mau='gray';}
if ($mau1==4){$mau='orange';}
if ($mau1==5){$mau='gold';}
if ($mau1==6){$mau='violet';}
if ($mau1==7){$mau='purple';}
if ($mau1==8){$mau='green';}
if ($mau1==9){$mau='brown';}
if ($mau1==10){$mau='pink';}
$mau11 = rand(1,10);
if ($mau11==1){$mau2 ='red';}
if ($mau11==2){$mau2 ='blue';}
if ($mau11==3){$mau2='gray';}
if ($mau11==4){$mau2='orange';}
if ($mau11==5){$mau2='gold';}
if ($mau11==6){$mau2='violet';}
if ($mau11==7){$mau2='purple';}
if ($mau11==8){$mau2='green';}
if ($mau11==9){$mau2='brown';}
if ($mau11==10){$mau2='pink';}
Echo ' <div class="newsx">Bạn tấn công đối phương bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';
Echo '<div class="newsx">Đối phương cũng không phải dạng vừa sử dụng: <b><font color="'.$mau2.'">'.$sk2.'</font></b> (<font color="blue">-'.$mana2.'</font> Mana) khiến bạn mất<b><font color="red"> '.$hpf2.'</b> Máu</font></div>';
}
echo '</div></div>';
}
}
}
}
}
} else {

switch($act){
default:
echo '<div class="rmenu">Bản quyền Thịnh Gà Gô. Tỉ thí V1.0</div>';
echo '<div class="phdr"><b>Phòng sôlô:</b>';
$dem = ($connect->query("SELECT COUNT(*) FROM `room` WHERE mem = 1")->fetch_row()[0] ?? 0);
echo ' ('.$dem.') [<a href="?act=tao">Tạo</a>]</div>';
$req = $connect->query("SELECT * FROM `room` ORDER BY `id` DESC LIMIT $start, $kmess");
 $my = $connect->fetch_array($connect->query("SELECT * FROM room WHERE user_id = $user_id"),0);
$demy = ($connect->query("SELECT COUNT(*) FROM room WHERE user_id = $user_id")->fetch_row()[0] ?? 0);
$my2 = $connect->query("SELECT * FROM room WHERE user_id2 = $user_id");
$demy2 = ($connect->query("SELECT COUNT(*) FROM room WHERE user_id2 = $user_id")->fetch_row()[0] ?? 0);
if ($my['type'] ==0){
$typeget = '<font color="green">Tự do</font>';
} 
if ($my['type'] ==1){
$typeget = '<font color="red">Đóng: </font><b>'.nick($my['user_id2']).'</b>';
}
if($my['mem'] ==1){
$mem = '<font color="green">Chưa đánh</font>';
}
if($my['mem'] ==2){
$mem = '<font color="red">Đang đánh</font>';
}
if ($demy >0){
echo '<div class="bmenu">Phòng của bạn: <br>#'.$my['id'].': '.$typeget.' [<a href="?id='.$my['id'].'">Vào</a>]<br> Tình trạng: '.$mem.' <br>Cược: <font color="green">'.$my['cuoc'].' VNĐ</font></div>';
}
if($demy2 >0){
echo '<div class="newsx">Phòng tỷ thí cùng bạn</div>';
while ($myget = $connect->fetch_array($my2)){
if($myget['mem'] ==1){
$mem1 = '<font color="green">Chưa đánh</font>';
}
if($myget['mem'] ==2){
$mem1 = '<font color="red">Đang đánh</font>';
}
echo '<div class="list1">#'.$myget['id'].': '.nick($myget['user_id']).' [<a href="?id='.$myget['id'].'">Vào</a>]<br>Tình trạng: '.$mem1.' <br> Cược: <font color="green">'.$myget['cuoc'].' VNĐ</font></div>';
}
}
while ($res = $connect->fetch_array($req)) {
if ($res['type'] ==1){
$type = '<font color=red>Đóng</font>';
} 
if ($res['type'] ==0){
$type = '<font color=green>Tự do</font>';
}
if($res['mem'] ==1){
$mem2 = '<font color="green">Chưa đánh</font>';
}
if($res['mem'] ==2){
$mem2 = '<font color="red">Đang đánh</font>';
}
echo '<div class="menu list-top">
#'.$res['id'].': <b>'.nick($res['user_id']).'</b><br><font color="green">Cược: '.$res['cuoc'].' VNĐ</font> ['.$type.']<br>['.$mem2.'] <a href="?id='.$res['id'].'">Tham chiến</a>
</div>';
}
if ($dem > $kmess){
echo '<div class="topmenu">' . functions::display_pagination('solo.php?', $start, $dem, $kmess) . '</div>';
}
break;
case 'tao':
if (isset($_POST['submit'])){
echo '<div style="display:none">';
 $ktp = ($connect->query("SELECT * FROM room WHERE user_id = $user_id")->fetch_row()[0] ?? 0);
$ktp2 = ($connect->query("SELECT * FROM room WHERE user_id2 = $user_id AND mem = 2")->fetch_row()[0] ?? 0);
echo '</div>';
if ($ktp ==0 and $ktp2 ==0){
$type = $_POST['type'];
$cuoc = $_POST['cuoc'];
$user_id2 = $_POST['user_id2'];
$str="/[0-9]/";
if (preg_match($str,$cuoc)){
if ($cuoc <10000){
echo '<div class="rmenu">Tiền cược phải từ 10.000 VNĐ trở lên (có thể đổi tại ngân hàng)</div>';
} else {
if ($type ==0){
$connect->query("INSERT INTO room (user_id, type, cuoc, mem) VALUES ($user_id, 0, $cuoc, 1)");
$idgetz = mysql_insert_id();
echo '<div class="bmenu">Tạo thành công [<a href="?id='.$idgetz.'">Vào phòng</a>] </div>';
} 
if($type==1){
$check = ($connect->query("SELECT COUNT(*) FROM users WHERE id = $user_id2")->fetch_row()[0] ?? 0);
if ($check ==0){
echo '<div class="rmenu">Đối tượng không tồn tại</div>';
} else {
$connect->query("INSERT INTO room (user_id, type, cuoc, user_id2, mem) VALUES ($user_id, 1, $cuoc, $user_id2, 1)");
$idget = mysql_insert_id();
echo '<div class="bmenu">Tạo thành công! Chờ người chơi vào phòng! [<a href="?id='.$idget.'">Vào phòng</a>]</div>';
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $user_id2 . "',
		`user_id` = '2',
				`text` = '".$datauser['name']." mời bạn vào phòng tỉ thí: [url=http://vnfocean.org/vuichoi/solo.php?id=".$idget."]#".$idget."[/url]. Với mức cược: [green][b]".$cuoc."[/b] VNĐ[/green]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
}
}
}
} else {
echo '<div class="rmenu">Tiền cược không hợp lệ</div>';
}
} else {
echo '<div class="rmenu">Bạn đã tạo hoặc tham gia 1 phòng trước đó! Xóa nó đi hoặc đợi hết trận và tạo lại!́</div>';
}
}
echo '<div class="menu"><form method="post">Kiểu tham gia:<br><select name="type"><option value="0">Tự do</option><option value="1">Đóng</option></select><br>Tiền cược (vnđ):<br><input type="text" name="cuoc"><br>ID người sôlô (bỏ trống nếu kiểu tham gia là tự do):<br><input name="user_id2" type="text"><br><input type="submit" name="submit" value="Tạo phòng"></form></div>';
break;
}
}
echo '</div>';
require('../incfiles/end.php');
?>