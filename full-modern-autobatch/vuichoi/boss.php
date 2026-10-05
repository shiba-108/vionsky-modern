<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
$tab = 'vui';
$textl = 'Hành trình chinh phục';
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
if ($datauser['set'] >1000000){
$class = 'trangphuc';
} else {
$class = 'cap'.$datauser['capset'].'';
}
if ($datauser['set2'] >1000000){
$class2 = 'trangphuc';
} else {
$class2 = 'cap'.$datauser['capset2'].'';
}
if ($datauser['set3'] >1000000){
$class3 = 'trangphuc';
} else {
$class3 = 'cap'.$datauser['capset3'].'';
}
if ($datauser['set'] ==0 and $datauser['set2'] ==0 and $datauser['set3'] ==0){
require('../incfiles/head.php');
echo '<div class="main-xmenu">
<div class="phdr">Mẹ Biển</div>
<div class="menu list-top">Con nghĩ con là ai mà tới đây? Hãy có ít nhất 1 Hero để tham gia!</div>
<a href="index.php">Quay lại</a>
</div>';
require('../incfiles/end.php');
exit;
}

require('../incfiles/head.php');

$id = intval($_GET['id']);
echo '<div class="main-xmenu"><div class="phdr">
<b>'.(isset($_GET['id']) ? 'Phục kích':'Tìm one piece').'</b></div>';
echo '<div class="newsx">';
if ($datauser['landanh'] >0){
echo 'Bạn còn '.$datauser['landanh'].' lần đánh boss hôm nay!';
} else {
echo 'Bạn đã hết lượt chiến đấu! <a href="?act=hoiphuc"><button>Tăng 5 lượt</button></a>';
}
echo '</div>';
switch($act){
case 'hoiphuc':
$time = time();
if(($datauser['time'] + 86400) > time()) {
$time = $datauser['time'] + 86400 - time();
echo '<div class="rmenu">Sau '.date('H:i', $time).' bạn mới có thể tăng 5 lần đánh tiếp!</div>';
} else if($datauser['landanh'] >0) {
echo '<div class="rmemu">Bạn vẫn còn '.$datauser['landanh'].' lần đánh nữa mới được hồi phục!</div>';
} else {
$connect->query("UPDATE `users` SET `landanh`='5', `time`='{$time}' WHERE `id`='{$user_id}'");
echo '<div class="rmenu">Hồi phục thành công, quẩy tiếp nào!!!</div>';
}
break;
}
$ten = $connect->fetch_array($connect->query("SELECT * FROM `aivienchinh` WHERE `id`='{$id}'"));
$tenz = $connect->fetch_array($connect->query("SELECT * FROM `users` WHERE `op1`='{$id}'"));
if (($datauser['cong'] <> $datauser['allcong'] or $datauser['cong2'] <> $datauser['allcong2'] or $datauser['cong3'] <> $datauser['allcong3'] or $datauser['edithp'] <> $datauser['allhp'] or $datauser['edithp2'] <> $datauser['allhp2'] or $datauser['edithp3'] <> $datauser['allhp3'] ) and $datauser['op1'] <> $ten['id']){
if ($datauser['edithp'] > $datauser['edithp']){
$connect->query("UPDATE `users` SET `cong`= '".$datauser['allcong']."', `cong2`= '".$datauser['allcong2']."', `cong3`= '".$datauser['allcong3']."', `edithp`= '".$datauser['allhp']."', `edithp2`= '".$datauser['allhp2']."', `edithp3`= '".$datauser['allhp3']."' WHERE `id`='".$datauser['id']."'");
} else {
$connect->query("UPDATE `users` SET `cong`= '".$datauser['allcong']."', `cong2`= '".$datauser['allcong2']."', `cong3`= '".$datauser['allcong3']."' WHERE `id`='".$datauser['id']."'");
}
}
if(isset($_GET['id'])) {
$idz = $ten['id'];
$dem = ($connect->query("SELECT COUNT(*) FROM `aivienchinh` WHERE `id`='{$idz}'")->fetch_row()[0] ?? 0);
if($dem == 0) {
echo '<div class="menu list-top">Boss không tồn tại!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="bmenu"><marquee>Với boss này tối đa nhận được <font color=gold>'.$ten['balans'].' G </font>và<font color="purple"> '.$ten['kc'].' D</font> - Đánh boss không tốn mana</marquee></div><div class="menu list-top">
<div class="menu" style="text-align:center;">
<table cellpadding="0" cellspacing="0"><tbody><tr>
<td style="padding:2px;text-align:center;">
<img class="'.$class.'" src="'.$home.'/heroes/'.$datauser['set'].'.png" alt="'. $user['nameset'] . '" width="100" height="150">
<br>
<font color="green"><b><small>' . $datauser['cong'] . '/'.$datauser['allcong'].'</b> ♦</font><br>
<font color="red"><b>' . $datauser['edithp'] . '/'.$datauser['allhp'].'</b> ♥</font><br>';
$mau13 = rand(1,10);
if ($mau13==1){$mau3 ='red';}
if ($mau13==2){$mau3 ='blue';}
if ($mau13==3){$mau3='gray';}
if ($mau13==4){$mau3='orange';}
if ($mau13==5){$mau3='gold';}
if ($mau13==6){$mau3='violet';}
if ($mau13==7){$mau3='purple';}
if ($mau13==8){$mau3='green';}
if ($mau13==9){$mau3='brown';}
if ($mau13==10){$mau3='pink';}
echo '<font color='.$mau3.'>'.$datauser['nameset'].'</font>';
echo ' (<font color="red">+'.$datauser['capset'].'</font>)<br><font color="purple">[POWER]</font></small></td> <td style="padding:2px;text-align:center;">
<img class="'.$class2.'" src="'.$home.'/heroes/'.$datauser['set2'].'.png" alt="'. $user['nameset2'] . '" width="100" height="150">
<br>
<font color="green"><b><small>' . $datauser['cong2'] . '/'.$datauser['allcong2'].'</b> ♦</font><br>
<font color="red"><b>' . $datauser['edithp2'] . '/'.$datauser['allhp2'].'</b> ♥</font><br>';
$mau131 = rand(1,10);
if ($mau131==1){$mau31 ='red';}
if ($mau131==2){$mau31 ='blue';}
if ($mau131==3){$mau31='gray';}
if ($mau131==4){$mau31='orange';}
if ($mau131==5){$mau31='gold';}
if ($mau131==6){$mau31='violet';}
if ($mau131==7){$mau31='purple';}
if ($mau131==8){$mau31='green';}
if ($mau131==9){$mau31='brown';}
if ($mau131==10){$mau31='pink';}
echo '<font color='.$mau31.'>'.$datauser['nameset2'].'</font>';
echo ' (<font color="red">+'.$datauser['capset2'].'</font>)<br><font color="pink">[SUPPORT]</font></small></td><td style="padding:2px;text-align:center;">
<img class="'.$class3.'" src="'.$home.'/heroes/'.$datauser['set3'].'.png" alt="'. $user['nameset3'] . '" width="100" height="150">
<br>
<font color="green"><b><small>'.$datauser['cong3'] . '/'.$datauser['allcong3'].' ♦</b></font><br>
<font color="red"><b>' . $datauser['edithp3'] . '/'.$datauser['allhp3'].'</b> ♥</font><br>';
$mau1311 = rand(1,10);
if ($mau1311==1){$mau311 ='red';}
if ($mau1311==2){$mau311 ='blue';}
if ($mau1311==3){$mau311='gray';}
if ($mau1311==4){$mau311='orange';}
if ($mau1311==5){$mau311='gold';}
if ($mau1311==6){$mau311='violet';}
if ($mau1311==7){$mau311='purple';}
if ($mau1311==8){$mau311='green';}
if ($mau1311==9){$mau311='brown';}
if ($mau1311==10){$mau311='pink';}
echo '<font color='.$mau311.'>'.$datauser['nameset3'].'</font>';
echo ' (<font color="red">+'.$datauser['capset3'].'</font>)<br><font color="brown">[TANK]</font></small></td></tr></tbody></table>';
echo '
<big><b><center>TEAM Boss:</b></big><br></center>';

echo '<center><form method="post"><center><input type="submit" name="submit" value="Chiến đấu" /></center></form></center>';
$tenid = $ten['id'];
$checkz = ($connect->query("SELECT COUNT(*) FROM `users` WHERE `op1` ='{$tenid}'")->fetch_row()[0] ?? 0);
$check = $checkz-1;
if($check >0){
echo '<center>Có '.$check.' mem cùng đang đánh boss này! Cẩn thận bị <b>KS</b> oan!</center>';
}
echo '<br><td style="padding:2px;text-align:center;">
<img class="cap'.$ten['capset'].'" src="'.$home.'/heroes/'.$ten['set'].'.png" alt="'. $ten['nameset'] . '" width="100" height="150"><br>
<font color="green"><b>' . $ten['cong'] . '</b> ♦</font><br>
<font color="red"><b>' . $ten['edithp'] . '/'.$ten['allhp'].'</b> ♥</font><br>'; 
$mau1z = rand(1,10);
if ($mau1z==1){$maua ='red';}
if ($mau1z==2){$maua ='blue';}
if ($mau1z==3){$maua='gray';}
if ($mau1z==4){$maua='orange';}
if ($mau1z==5){$maua='gold';}
if ($mau1z==6){$maua='violet';}
if ($mau1z==7){$maua='purple';}
if ($mau1z==8){$maua='green';}
if ($mau1z==9){$maua='brown';}
if ($mau1z==10){$maua='pink';}
echo 'Boss: <font color='.$maua.'>'.$ten['nameset'].'</font>';
$linhz = $ten['linh']/1000;
$linh = round($linhz);
if ($linh >0){
echo '<br>Số thuyền viên: <b>'.$linh.'</b>';
}
echo ' (<font color="red">+'.$ten['capset'].'</font>)
</td>
</tr></tbody></table></div>';
if(isset($_POST['submit'])) {
$edithp = $datauser['edithp'] + $datauser['edithp2'] + $datauser['edithp3'];
If($datauser['set'] ==0){
echo '<div class="rmenu">Bạn chưa có tướng chủ lực.</div>';
}
If($datauser['set'] >0){
if($datauser['op1'] == $ten['id']){
if($edithp <0 or $ten['edithp'] <0){
if($edithp == $ten['edithp']){
echo '<div class="rmenu"><center><font size=4>Team '.nick($datauser['id']).' Huề  Team <font color="brown">'.$ten['nameset'].'</font></div></center>';
$connect->query("UPDATE `users` SET `landanh`=`landanh` - '1', `op1`= '0' WHERE `id`='".$datauser['id']."'");
$connect->query("UPDATE `users` SET `cong`= '".$datauser['allcong']."', `cong2`= '".$datauser['allcong2']."', `cong3`= '".$datauser['allcong3']."', `edithp`= '".$datauser['allhp']."', `edithp2`= '".$datauser['allhp2']."', `edithp3`= '".$datauser['allhp3']."', `editmana`='".$datauser['allmana']."' WHERE `id`='".$datauser['id']."'");
$connect->query("UPDATE `aivienchinh` SET `cong`= '".$ten['allcong']."', `linh`= '".$ten['alllinh']."', `edithp`='".$ten['allhp']."' WHERE `id`='".$ten['id']."'");
}
}
if($edithp <0 or $ten['edithp'] <0){
$randct = rand(1,5);
if ($randct ==1){$ct = 'Chiến thắng';}
if ($randct ==2){$ct = 'Chấm hết';}
if ($randct ==3){$ct = 'Killed';}
if ($randct ==4){$ct = 'Quét sạch';}
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
if($edithp > $ten['edithp']){
if ($tenz['op1'] == $ten['id']){
if ($tenz['id'] <> $datauser['id']){
$connect->query("UPDATE `users` SET `cong`= '".$tenz['allcong']."', `cong2`= '".$tenz['allcong2']."', `cong3`= '".$tenz['allcong3']."', `edithp`= '".$tenz['allhp']."', `edithp2`= '".$tenz['allhp2']."', `edithp3`= '".$tenz['allhp3']."', `editmana`='".$tenz['allmana']."',  `op1`='0' WHERE `id`='".$tenz['id']."'");
}
}
$connect->query("UPDATE `users` SET `cong`= '".$datauser['allcong']."', `cong2`= '".$datauser['allcong2']."', `cong3`= '".$datauser['allcong3']."', `edithp`= '".$datauser['allhp']."', `edithp2`= '".$datauser['allhp2']."', `edithp3`= '".$datauser['allhp3']."', `editmana`='".$datauser['allmana']."' WHERE `id`='".$datauser['id']."'");
$connect->query("UPDATE `aivienchinh` SET `cong`= '".$ten['allcong']."', `linh`= '".$ten['alllinh']."', `edithp`='".$ten['allhp']."' WHERE `id`='".$ten['id']."'");
$balansmax = $ten['balans'];
$balans = rand(1000,$balansmax);
$kcmax = $ten['kc'];
$kc = rand(0,$kcmax);
$connect->query("UPDATE `users` SET `balans`=`balans` + '{$balans}', `kc`=`kc` + '{$kc}' WHERE `id`='".$datauser['id']."'");
$connect->query("UPDATE `users` SET `landanh`=`landanh` - '1', `op1`= '0' WHERE `id`='".$datauser['id']."'");
echo '<div class="newsx"><center><font size="4">Team <font color='.$mauct.'><b>'.$datauser['name'].'</b></font> <font color="red">'.$ct.'</font> Team <font color='.$mautb.'>'.$ten['nameset'].'</font></font><font color="purple"><br>Nhận được: <b>'.$balans.' G</b> và <b>'.$kc.' D</b></font></center></div>';
}
if($edithp < $ten['edithp']){
$connect->query("UPDATE `users` SET `cong`= '".$datauser['allcong']."', `cong2`= '".$datauser['allcong2']."', `cong3`= '".$datauser['allcong3']."', `edithp`= '".$datauser['allhp']."', `edithp2`= '".$datauser['allhp2']."', `edithp3`= '".$datauser['allhp3']."', `editmana`='".$datauser['allmana']."' WHERE `id`='".$datauser['id']."'");
$connect->query("UPDATE `aivienchinh` SET `cong`= '".$ten['allcong']."', `linh`= '".$ten['alllinh']."', `edithp`='".$ten['allhp']."' WHERE `id`='".$ten['id']."'");
$connect->query("UPDATE `users` SET `landanh`=`landanh` - '1' WHERE `id`='".$datauser['id']."'");
echo '<div class="newsx"><center><font size="4">Team <font color='.$mauct.'><b>'.$ten['nameset'].'</b></font> <font color="red">'.$ct.'</font> Team <font color='.$mautb.'>'.$datauser['name'].'</font></font></center></div>';

}
}
}
if($edithp <=0 or $ten['edithp']<0){
if($datauser['op1'] > $ten['id'] or $datauser['op1'] < $ten['id']){
echo '<div class="rmenu">Bạn hoặc boss đã hết máu</div>';
}
} else {
if ($datauser['landanh'] ==0){
echo '<div class="rmenu">Bạn đã hết lần đánh nên không thể tiếp tục!!!</div>';
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
if ($datauser['edithp'] <=0 and $datauser['op1'] ==0){
echo '<div class="rmenu">Tướng chủ lực của bạn đã hết máu nên không thể tham gia</div>';
require('../incfiles/end.php');
exit;
}
if ($datauser['edithp'] <=0 and $datauser['op1'] >0){
echo '<div class="rmenu">Tướng chủ lực của bạn đã hết máu nên không thể chiến tiếp</div>';
require('../incfiles/end.php');
exit;
}
if (($datauser['edithp'] >0 or $datauser['edithp2'] >0 or $datauser['edithp3'] >0) and $ten['edithp'] >0){
$linhz = $ten['linh']/1000;
$linh = round($linhz);
$tenid = $ten['id'];
$hpfg = $hp/59;
$hpf = round($hpfg,2);
$skrand = rand(1,3);
if ($skrand ==1){
$sk11 = 'Tăng máu đội';
$tangmau = $datauser['edithp2']/91;
}
if ($skrand ==2){
$sk11 = 'Tăng công đội';
$tangcong = $datauser['cong2']/89;
}
if ($skrand ==3){
$sk11 = 'Đánh chay siêu cấp';
$tancong = $datauser['cong2']/49;
}
$tancongf = round($tancong,2);
$tangcongf = round($tangcong,2);
$tangmauf = round($tangmau,2);
$skr2 = rand(1,3);
$trumauz = $datauser['cong3']/59;
$trumauz2 = $datauser['cong3']/49;
$trumau = round($trumauz,2);
$trumau2 = round($trumauz2,2);
if($linh >0){
$tcr2 = rand(1,6);
if($tcr2 ==1){$tcl='Đấm';
$stlz=$ten['cong']/10;}
if($tcr2 ==2){$tcl='Dùi củ trỏ';
$stlz=$ten['cong']/9;}
if($tcr2 ==3){$tcl='Chém';
$stlz=$ten['cong']/8;}
if($tcr2 ==4){$tcl='Lên gối';
$stlz=$ten['cong']/7;}
if($tcr2 ==5){$tcl='Sút';
$stlz=$ten['cong']/6;}
if($tcr2 ==6){$tcl='Đánh lén';
$stlz=$ten['cong']/5;}
$hpfg2 = $stlz/50;
} else {
$hpfg2 = $hp2/59;
}
$hpf2 = round($hpfg2,2);
$hpf222 = $hpf2/2;
$hpf22 = round($hpf222,2);
if ($datauser['edithp2'] >0 and $datauser['edithp3'] <=0 and $datauser['edithp'] >0){
if ($skrand ==1){
$connect->query("UPDATE `users` SET `edithp`=`edithp`+ '{$tangmauf}', `edithp2`=`edithp2`+ '{$tangmauf}' WHERE `id`= '{$user_id}'");
}
if ($skrand ==2){
$connect->query("UPDATE `users` SET `cong`=`cong`+ '{$tangcongf}', `cong2`=`cong2`+ '{$tangcongf}' WHERE `id`= '{$user_id}'");
}
$connect->query("UPDATE `users` SET `edithp2`=`edithp2`- '{$hpf22}', `op1`= '{$tenid}' WHERE `id`= '{$user_id}'");
$connect->query("UPDATE `users` SET  `editmana`=`editmana`- '{$mana}', `edithp`=`edithp`- '{$hpf22}' WHERE `id`= '{$user_id}'");
}
if ($datauser['edithp2'] >0 and $datauser['edithp3'] >0 and $datauser['edithp'] >0){
if ($skr2 ==1){
$connect->query("UPDATE `users` SET `edithp3`=`edithp3`- '{$hpf2}', `op1`= '{$tenid}' WHERE `id`= '{$user_id}'");
$connect->query("UPDATE `users` SET `editmana`=`editmana`- '{$mana}'  WHERE `id`= '{$user_id}'");
}
if ($skr2 ==2){
$connect->query("UPDATE `users` SET `op1`= '{$tenid}' WHERE `id`= '{$user_id}'");
$connect->query("UPDATE `users` SET `editmana`=`editmana`- '{$mana}', `edithp`=`edithp`- '{$hpf22}', `edithp2`=`edithp2`- '{$hpf22}'  WHERE `id`= '{$user_id}'");
}
if ($skr2 ==3){
$connect->query("UPDATE `users` SET `op1`= '{$tenid}' WHERE `id`= '{$user_id}'");
$connect->query("UPDATE `users` SET `editmana`=`editmana`- '{$mana}', `edithp`=`edithp`- '{$hpf22}', `edithp2`=`edithp2`- '{$hpf22}'  WHERE `id`= '{$user_id}'");
}
if ($skrand ==1){
$connect->query("UPDATE `users` SET `edithp`=`edithp`+ '{$tangmauf}', `edithp2`=`edithp2`+ '{$tangmauf}',
`edithp3`=`edithp3`+ '{$tangmauf}'WHERE `id`= '{$user_id}'");
}
if ($skrand ==2){
$connect->query("UPDATE `users` SET `cong`=`cong`+ '{$tangcongf}', `cong2`=`cong2`+ '{$tangcongf}',
`cong3`=`cong3`+ '{$tangcongf}' WHERE `id`= '{$user_id}'");
}
}
if ($datauser['edithp2'] <=0 and $datauser['edithp3'] >0 and $datauser['edithp'] >0){
if ($skr2 ==1){
$connect->query("UPDATE `users` SET `edithp3`=`edithp3`- '{$hpf2}', `op1`= '{$tenid}' WHERE `id`= '{$user_id}'");
$connect->query("UPDATE `users` SET `editmana`=`editmana`- '{$mana}'  WHERE `id`= '{$user_id}'");
}
if ($skr2 ==2){
$connect->query("UPDATE `users` SET `op1`= '{$tenid}' WHERE `id`= '{$user_id}'");
$connect->query("UPDATE `users` SET `editmana`=`editmana`- '{$mana}', `edithp`=`edithp`- '{$hpf22}', `edithp2`=`edithp2`- '{$hpf22}'  WHERE `id`= '{$user_id}'");
}
if ($skr2 ==3){
$connect->query("UPDATE `users` SET `op1`= '{$tenid}' WHERE `id`= '{$user_id}'");
$connect->query("UPDATE `users` SET `editmana`=`editmana`- '{$mana}', `edithp`=`edithp`- '{$hpf22}', `edithp2`=`edithp2`- '{$hpf22}'  WHERE `id`= '{$user_id}'");
}
}
if($datauser['edithp2'] <=0 and $datauser['edithp3'] <=0 and $datauser['edithp'] >0){
$connect->query("UPDATE `users` SET `edithp`=`edithp`- '{$hpf2}', `editmana`=`editmana`- '{$mana}', `op1`= '{$tenid}' WHERE `id`= '{$user_id}'");
}
if($linh <=0){
$connect->query("UPDATE `aivienchinh` SET `edithp`=`edithp`- '{$hpf}' WHERE `id`= '{$tenid}'");
} else {
$connect->query("UPDATE `aivienchinh` SET `linh`=`linh`- '{$hpf}' WHERE `id`= '{$tenid}'");
}
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
$mau1b = rand(1,10);
if ($mau1b==1){$maux ='red';}
if ($mau1b==2){$maux ='blue';}
if ($mau1b==3){$maux='gray';}
if ($mau1b==4){$maux='orange';}
if ($mau1b==5){$maux='gold';}
if ($mau1b==6){$maux='violet';}
if ($mau1b==7){$maux='purple';}
if ($mau1b==8){$maux='green';}
if ($mau1b==9){$maux='brown';}
if ($mau1b==10){$maux='pink';}
$mau111 = rand(1,10);
if ($mau111==1){$mauc ='red';}
if ($mau111==2){$mauc ='blue';}
if ($mau111==3){$mauc='gray';}
if ($mau111==4){$mauc='orange';}
if ($mau111==5){$mauc='gold';}
if ($mau111==6){$mauc='violet';}
if ($mau111==7){$mauc='purple';}
if ($mau111==8){$mauc='green';}
if ($mau111==9){$mauc='brown';}
if ($mau111==10){$mauc='pink';}
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
if ($datauser['edithp'] >0 and $datauser['edithp2'] >0 and $datauser['edithp3'] >0){
if($linh>0){
Echo ' <div class="newsx"><div class="menu"><b>'.$datauser['nameset'].'</b> tấn công lính boss bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến tay sai đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';
if ($skrand ==2){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> giúp tăng tấn công toàn đội thêm: <b><font color="red"> '.$tangcongf.'</b></font></div>';
}
if ($skrand ==3){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> khiến tay sai đối thủ mất<b><font color="red"> '.$tancongf.'</b> Máu</font></div>';
}
if ($skrand ==1){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> giúp tăng hp toàn đội thêm: <b><font color="red"> '.$tangmauf.'</b> Máu</font></div>';
}
if ($skr2 ==1){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Anh dũng</font></b> nhận 100% sát thương lính bên địch vào người</div>';
}

if ($skr2 ==2){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Đánh chay siêu cấp</font></b> khiến lính đối thủ mất <font color="red">'.$trumau.'</font></div> ';
}
if ($skr2 ==3){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Dũng mãnh</font></b> khiến lính đối thủ mất <font color="red">'.$trumau2.'</font></div> ';
}
} else {
Echo ' <div class="newsx"><div class="menu"><b>'.$datauser['nameset'].'</b> tấn công boss bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến  đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';
if ($skrand ==2){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> giúp tăng tấn công toàn đội thêm: <b><font color="red"> '.$tangcongf.'</b></font></div> ';
}
if ($skrand ==3){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> khiến đối thủ mất<b><font color="red"> '.$tancongf.'</b> Máu</font></div> ';
}
if ($skrand ==1){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> giúp tăng hp toàn đội thêm: <b><font color="red"> '.$tangmauf.'</b> Máu</font></div> ';
}
if ($skr2 ==1){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Anh dũng</font></b> nhận 100% sát thương bên địch vào người</div> ';
}

if ($skr2 ==2){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Đánh chay siêu cấp</font></b> khiến đối thủ mất <font color="red">'.$trumau.'</font></div>';
}
if ($skr2 ==3){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Dũng mãnh</font></b> khiến đối thủ mất <font color="red">'.$trumau2.'</font></div> ';
}
}
}
if ($datauser['edithp'] >0 and $datauser['edithp2'] <=0 and $datauser['edithp3'] >0){
if($linh>0){
Echo ' <div class="newsx"><div class="menu"><b>'.$datauser['nameset'].'</b> tấn công lính boss bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến tay sai đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';

if ($skr2 ==1){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Anh dũng</font></b> nhận 100% sát thương lính bên địch vào người</div>';
}

if ($skr2 ==2){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Đánh chay siêu cấp</font></b> khiến lính đối thủ mất <font color="red">'.$trumau.'</font></div> ';
}
if ($skr2 ==3){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Dũng mãnh</font></b> khiến lính đối thủ mất <font color="red">'.$trumau2.'</font></div> ';
}
} else {
Echo ' <div class="newsx"><div class="menu"><b>'.$datauser['nameset'].'</b> tấn công boss bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến  đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';
if ($skr2 ==1){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Anh dũng</font></b> nhận 100% sát thương bên địch vào người</div> ';
}

if ($skr2 ==2){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Đánh chay siêu cấp</font></b> khiến đối thủ mất <font color="red">'.$trumau.'</font></div>';
}
if ($skr2 ==3){
echo ' <div class="menu"><b>'.$datauser['nameset3'].'</b> sử dụng: <b><font color="'.$mauc.'">Dũng mãnh</font></b> khiến đối thủ mất <font color="red">'.$trumau2.'</font></div> ';
}
}
}
if ($datauser['edithp'] >0 and $datauser['edithp2'] >0 and $datauser['edithp3'] <=0){
if($linh>0){
Echo ' <div class="newsx"><div class="menu"><b>'.$datauser['nameset'].'</b> tấn công lính boss bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến tay sai đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';
if ($skrand ==2){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> giúp tăng tấn công toàn đội thêm: <b><font color="red"> '.$tangcongf.'</b></font></div> ';
}
if ($skrand ==3){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> khiến tay sai đối thủ mất<b><font color="red"> '.$tancongf.'</b> Máu</font></div> ';
}
if ($skrand ==1){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> giúp tăng hp toàn đội thêm: <b><font color="red"> '.$tangmauf.'</b> Máu</font></div> ';
}
} else {
Echo ' <div class="newsx"><div class="menu"><b>'.$datauser['nameset'].'</b> tấn công boss bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến  đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';
if ($skrand ==2){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> giúp tăng tấn công toàn đội thêm: <b><font color="red"> '.$tangcongf.'</b></font></div> ';
}
if ($skrand ==3){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> khiến đối thủ mất<b><font color="red"> '.$tancongf.'</b> Máu</font></div> ';
}
if ($skrand ==1){
echo ' <div class="menu"><b>'.$datauser['nameset2'].'</b> sử dụng: <b><font color="'.$maux.'">'.$sk11.'</font></b> giúp tăng hp toàn đội thêm: <b><font color="red"> '.$tangmauf.'</b> Máu</font></div> ';
}
}
}
if ($datauser['edithp'] >0 and $datauser['edithp2'] <=0 and $datauser['edithp3'] <=0){
if($linh>0){
Echo ' <div class="newsx"><div class="menu"><b>'.$datauser['nameset'].'</b> tấn công lính boss bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến tay sai đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';
} else {
Echo ' <div class="newsx"><div class="menu"><b>'.$datauser['nameset'].'</b> tấn công boss bằng: <b><font color="'.$mau.'">'.$sk.'</font></b> (<font color="blue">-'.$mana.'</font> Mana) khiến  đối thủ mất<b><font color="red"> '.$hpf.'</b> Máu</font></div>';
}
}
if ($linh >0){
if($datauser['edithp'] >0 and $datauser['edithp2'] <=0 and $datauser['edithp3'] >0){
Echo '<div class="newsx">Lính của đối phương <font color="blue">'.$tcl.'</font> khiến <b>'.$datauser['nameset3'].'</b> mất<font color="red"> '.$hpf2.'</b> Máu</font></div>';
}
if($datauser['edithp'] >0 and $datauser['edithp2'] <=0 and $datauser['edithp3'] <=0){
Echo '<div class="newsx">Lính của đối phương <font color="blue">'.$tcl.'</font> khiến <b>'.$datauser['nameset'].'</b> mất<font color="red"> '.$hpf2.'</b> Máu</font></div>';
}
if($datauser['edithp'] >0 and $datauser['edithp2'] >0 and $datauser['edithp3'] >0){
Echo '<div class="newsx">Lính của đối phương <font color="blue">'.$tcl.'</font> khiến <b>'.$datauser['nameset3'].'</b> mất<font color="red"> '.$hpf2.'</b> Máu</font></div>';
}
if($datauser['edithp'] >0 and $datauser['edithp2'] >0 and $datauser['edithp3'] <=0){
Echo '<div class="newsx">Lính của đối phương <font color="blue">'.$tcl.'</font> khiến <b>'.$datauser['nameset'].'</b> và <b>'.$datauser['nameset2'].'</b> cùng mất<font color="red"> '.$hpf22.'</b> Máu</font></div>';
}
} else {
if($datauser['edithp'] >0 and $datauser['edithp2'] <=0 and $datauser['edithp3'] >0){
Echo '<div class="newsx"><b>'.$ten['nameset'].'</b> của đối phương <font color="blue">'.$tcl.'</font> khiến <b>'.$datauser['nameset3'].'</b> mất<font color="red"> '.$hpf2.'</b> Máu</font></div>';
}
if ($datauser['edithp'] >0 and $datauser['edithp2'] <=0 and $datauser['edithp3'] <=0){
echo '<div class="newsx"><b>'.$ten['nameset'].'</b> sử dụng <font color=purple>'.$sk2.'</font> khiến <b>'.$datauser['nameset'].'</b> mất <font color=red>'.$hpf2.'</font> máu</div>';
}
if ($datauser['edithp'] >0 and $datauser['edithp2'] >0 and $datauser['edithp3'] >0){
echo '<div class="newsx"><b>'.$ten['nameset'].'</b> sử dụng <font color="purple">'.$sk2.'</font> khiến <b>'.$datauser['nameset3'].'</b> mất <font color="red">'.$hpf2.' máu</div>';
}
if ($datauser['edithp'] >0 and $datauser['edithp2'] >0 and $datauser['edithp3'] <=0){
echo '<div class="newsx"><b>'.$ten['nameset'].'</b> sử dụng <font color=purple>'.$sk2.'</font> khiến <b>'.$datauser['nameset'].'</b> và <b>'.$datauser['nameset2'].'</b> cùng mất <font color=red>'.$hpf22.'</font> máu</div>';
}
}
}
echo '</font></div></div>';
}
}
}
}
}
} else {


echo '<div class="phdr"><b>Boss chiến:</b>';
$dem = ($connect->query("SELECT COUNT(*) FROM `aivienchinh` WHERE `edithp`>'0' AND `set`>'0'")->fetch_row()[0] ?? 0);
echo ' ('.$dem.')</div>';
$req = $connect->query("SELECT * FROM `aivienchinh` WHERE `edithp`>'0' AND `set`>'0' ORDER BY `id` ASC LIMIT $start, $kmess");
while ($res = $connect->fetch_array($req)) {
echo '<div class="menu list-top">
<table>
<tbody><tr><td width="75">
<img class="cap'.$res['capset'].'" src="/heroes/'.$res['set'].'.png" alt="'.$res['name'].'" width="100" height="150">
</td><td width="auto" valign="top"> <b><font color="brown">MAX GIFT: <b><font color=gold>'.$res['balans'].' G</font> + <font color=purple>'.$res['kc'].' D</font></b><br/></font>
 <font color="green"><b>'.$res['cong'].'</b> ♦</font><br/> <font color="red"><b>'.$res['edithp'].'/'.$res['allhp'].'</b> ♥</font><br/> 
';
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
echo '<font color="'.$mau.'">'.$res['nameset'].'</font>';
echo ' (<font color="red">+'.$res['capset'].'</font>)</b><br/>';
echo ' <a href="boss.php?id='.$res['id'].'">Chiến đấu</a>
</td></tr></tbody></table>
</div>';
}
if ($dem > $kmess){
echo '<div class="topmenu">' . functions::display_pagination('boss.php?', $start, $dem, $kmess) . '</div>';
}
}
echo '</div>';
require('../incfiles/end.php');
?>