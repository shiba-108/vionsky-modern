<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
$tab = 'vui';
$textl = 'Biển Cả';
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
echo '<div class="newsx">';
if ($datauser['khoadt'] ==0){
echo 'Bạn đang tham gia chiến trường! <a href="?act=out"><button>Rút trận</button></a>';
} else {
echo 'Bạn chưa tham gia chiến trường! <a href="?act=co"><button>Tham chiến</button></a>';
}
echo '</div>';
switch($act){
case 'out':
$connect->query("UPDATE `users` SET `khoadt`= '1', `op` = '0' WHERE `id`='".$datauser['id']."'");
echo '<div class="rmenu"><font color=red>Rút trận thành công! Bạn không thể chiến đấu cũng như người khác không thể đánh bạn.</font></div>';
break;
case 'co':
$connect->query("UPDATE `users` SET `khoadt`= '0' WHERE `id`='".$datauser['id']."'");
echo '<div class="rmenu"><font color="green">Tham chiến thành công! Dạy cho bọn bắt nạt bạn một bài học nào!!!</font></div>';
break;
}
$ten = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `id`='{$id}'"));
if ($ten['op1'] >0){
echo '<div class="rmenu">Đối thủ đang chiến boss nên bạn không thể đánh vào lúc này! Quay lại sau!</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_GET['id'])) {
$dem = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `id`='{$id}'")->fetch_row()[0] ?? 0);
if($dem == 0) {
echo '<div class="menu list-top">Đối tượng không tồn tại!</div>';
require('../incfiles/end.php');
exit;
}

if($datauser['id'] == $ten['id']){
echo '<div class="rmenu"><font color=red>Mẹ biển: Con đang tự làm đau mình đấy!</font></div>';
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
echo '
<div class="menu" style="text-align:center;">
<table cellpadding="0" cellspacing="0"><tbody><tr>
<td style="padding:2px;text-align:center;">
<img class="'.$icla.'" src="'.$home.'/heroes/'.$datauser['set'].'.png" alt="'. $user['name'] . '" width="100" height="150">
<br>
<b><span style="color:#000;"><small>' . $datauser['name'] . '</span></b><br>
<font color="green"><b>' . $datauser['cong'] . '</b> SM</font>';

echo '<br><font color=red><b>'.$datauser['edithp'].'/'.$datauser['allhp'].'</b> HP</font><br>';
echo '<font color=blue><b>'.$datauser['editmana'].'/'.$datauser['allmana'].'</b> MP</font><br>';

echo '<font color=purple>'.$datauser['nameset'].'</font>';
echo ' (<font color="red">+'.$datauser['capset'].'</small></font>)</td>
<td style="padding:2px;text-align:center;">
<big><b>Đối thủ:</b></big><br>';

echo '<form method="post"><input type="submit" id="submit" name="submit" value="Đánh" /></form>';

echo '</td><td style="padding:2px;text-align:center;">
<img class="'.$iclaz.'" src="'.$home.'/heroes/'.$ten['set'].'.png" alt="'. $ten['name'] . '" width="100" height="150"><br>
<b><span style="color:#000;"><small>' . $ten['name'] . '</span></b><br>
<font color="green"><b>' . $ten['cong'] . '</b> SM</font>';

echo '<br><font color=red><b>'.$ten['edithp'].'/'.$ten['allhp'].'</b> HP</font><br>';
echo '<font color=blue><b>'.$ten['editmana'].'/'.$ten['allmana'].'</b> MP</font><br>';

echo '<font color=orange>'.$ten['nameset'].'</font>';
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
		`text` = '[blue][b]HUỀ NHAU[/b][/blue] - Trận chiến giữa bạn ([u]".$ten['nameset']."[/u]) và [b]".$datauser['name']."[/b] ([u]".$datauser['nameset']."[/u]) [url=".$home."/vuichoi/garena.php?id=".$datauser['id']."]~Quyết đấu (chỉ 1 người mạnh)~[/url]',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());

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
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $ten['id'] . "',
		`user_id` = '2',
		`text` = '[red][b]THẤT BẠI[/b][/red] - Trận chiến giữa bạn ([u]".$ten['nameset']."[/u]) và [b]".$datauser['name']."[/b] ([u]".$datauser['nameset']."[/u]) [url=".$home."/vuichoi/garena.php?id=".$datauser['id']."]~Trả thù (10 năm chưa muộn)~[/url]
P/s: mất [b]".$beri."[/b] truy nã (nếu bạn không có đủ số này bạn k bị trừ :kul2:)',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());

$connect->query("UPDATE `users` SET `win`=`win` + '1', `op`= '0', `truyna`=`truyna` + '$beri' WHERE `id`='".$datauser['id']."'");
if ($ten['win'] >0){
$connect->query("UPDATE `users` SET `win`=`win` - '1' WHERE `id`='".$ten['id']."'");
}
if ($ten['truyna'] >=$beri){
$connect->query("UPDATE `users` SET `truyna`=`truyna` - '$beri' WHERE `id`='".$ten['id']."'");
}
echo '<div class="newsx"><center><font size="4"><font color='.$mauct.'><b>'.$datauser['name'].'</b></font> <font color="red">'.$ct.'</font> <font color='.$mautb.'>'.$ten['name'].'</font></font><br><b class="wanted">Nhận được '.$beri.' β</b></center></div>';
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
$connect->query("INSERT INTO `cms_mail` SET
		`from_id` = '" . $ten['id'] . "',
		`user_id` = '2',
				`text` = '[green][b]CHIẾN THẮNG[/b][/green] - Trận chiến giữa bạn ([u]".$ten['nameset']."[/u]) và [b]".$datauser['name']."[/b] ([u]".$datauser['nameset']."[/u]) [url=".$home."/vuichoi/garena.php?id=".$datauser['id']."]~Đánh tiếp (vì đánh lén)~[/url]
P/s: nhận được [b]".$beri."[/b] β',
		`time` = '" . time() . "',
    `cbao` = '1'") or die(mysql_error());
if($datauser['truyna'] >=$beri){
$connect->query("UPDATE users SET truyna = truyna - '$beri' WHERE id = $user_id LIMIT 1");
}
if($datauser['win'] >0){
$connect->query("UPDATE `users` SET `win`=`win` - '1', `op`= '0' WHERE `id`='".$datauser['id']."'");
} else {
$connect->query("UPDATE `users` SET `op`= '0' WHERE `id`='".$datauser['id']."'");
}
$connect->query("UPDATE `users` SET `win`=`win` + '1', `truyna`=`truyna` + '$beri' WHERE `id`='".$ten['id']."'");
echo '<div class="newsx"><center><font size="4"><font color='.$mauct.'><b>'.$ten['name'].'</b></font> <font color="red">'.$ct.'</font> <font color='.$mautb.'>'.$datauser['name'].'</font></font><br><b class="wanted">Hắn nhận được '.$beri.' β</b></center></div>';
}
}
}
if($datauser['edithp'] <=0 or $ten['edithp'] <=0){
if($datauser['op'] > $ten['id'] or $datauser['op'] < $ten['id']){
echo '<div class="rmenu">Bạn hoặc đối thủ đã hết máu</div>';
}
} else {
if ($datauser['khoadt'] ==1 or $ten['khoadt'] ==1){
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
$checkz = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `op` ='{$tenid}'")->fetch_row()[0] ?? 0);
$check = $checkz-1;
if($check >0){
echo 'Có '.$check.' mem cùng đang đánh hero này! Cẩn thận bị <b>KS</b> oan!';
}
}
echo '</div></div>';
}
}
}
}
} else {


echo '<div class="phdr"><b>Tham chiến:</b>';
$dem = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `edithp`>'0' AND `khoadt`='0' AND `set`>'0' AND `op1`='0'")->fetch_row()[0] ?? 0);
echo ' ('.$dem.')</div>';
$req = $connect->query("SELECT * FROM `users` WHERE `edithp`>'0' AND `khoadt`='0' AND `set`>'0' AND `op1`='0' ORDER BY `id` DESC LIMIT $start, $kmess");
while ($res = $connect->fetch_array($req)) {
if($res['set'] <10000000){
$class = 'cap'.$res['capset'].'';
} else {
$class = 'trangphuc';
}
echo '<div class="menu list-top">
<table>
<tbody><tr><td width="75"><small>
<img class="'.$class.'" src="/heroes/'.$res['set'].'.png" alt="'.$res['name'].'" width="100" height="150" class="avatar_vina">
</td><td width="auto" valign="top"> <b><font color="brown"><b>'.$res['name'].'</b><br/></font>
 <font color="green"><b>'.$res['cong'].'</b> SM</font><br>'; 

echo '<font color=red><b>'.$res['edithp'].'/'.$res['allhp'].'</b> HP</font><br>';
echo '<font color=blue><b>'.$res['editmana'].'/'.$res['allmana'].'</b> MP</font>';

echo '<br><font color="orange">'.$res['nameset'].'</font>';
echo ' (<font color="red">+'.$res['capset'].'</font>)</b><br/>';
echo ' <a href="garena.php?id='.$res['id'].'">Khiêu chiến</small></a>
</td></tr></tbody></table>
</div>';
}
if ($dem > $kmess){
echo '<div class="topmenu">' . functions::display_pagination('garena.php?', $start, $dem, $kmess) . '</div>';
}
}
echo '</div>';
require('../incfiles/end.php');
?>